<?php

class SelfAgentController extends Controller {
    /*
     * @Author Digitaltoday
     * @create Users for Mps
     * return array respose to action
     */
    public function actionSelfVehicle_Details()
    {
        $arrSelfAgentDetails = SelfVehicles::model()->getAgentDetails();
       
        $objDataManager = new DataManager();
        $arrFeatureDetails= $objDataManager->getFeatureDetails($arrSelfAgentDetails);
       // print_r($arrFeatureDetails);
      
      $this->render('/SelfDrive/self_vehiclelist',array("VehicleDetails" =>$arrSelfAgentDetails, "FeatureDetails"=> $arrFeatureDetails));
    }
    public function actionSelfBookingVehicles()
    {
        $arrFeatureDetails = array();
        $arrSelfAgentDetails = array();
        $arrSelfAgentDetails = SelfVehicles::model()->getAgentBookingDetails();
        if(!empty($arrSelfAgentDetails))
        {
        $objDataManager = new DataManager();
        $arrFeatureDetails= $objDataManager->getFeatureDetails($arrSelfAgentDetails);
        }
        $this->render('/SelfDrive/SelfBooking',array("VehicleDetails" =>$arrSelfAgentDetails, "FeatureDetails"=> $arrFeatureDetails));
    }
    public function actionSelfManageVehicles()
    {
        $arrSelfAgentDetails = SelfVehicles::model()->getAgentDetails();
       
        $objDataManager = new DataManager();
        $arrFeatureDetails= $objDataManager->getFeatureDetails($arrSelfAgentDetails);
       // print_r($arrFeatureDetails);
      
        $this->render('/SelfDrive/ManageVehicles',array("VehicleDetails" =>$arrSelfAgentDetails, "FeatureDetails"=> $arrFeatureDetails));
    }
      public function actionDeleteVehicleStatus()
    {
           //echo 'dfkljsilj';
           $intVehicleId = $_POST['vehicle_id'];
           echo $intDeleteStatus = SelfVehicles::model()->deleteVehicle($intVehicleId);
    }
    public function actionEditVehicleDetails()
	{
		$vehicle_id=$_POST['vehicle_id'];
                $arrSelfAgentDetails = SelfVehicles::model()->getAgentDetails();
       
                $objDataManager = new DataManager();
                $arrFeatureDetails= $objDataManager->getFeatureDetails($arrSelfAgentDetails);
                print_r($arrFeatureDetails);
		//$self_details=Yii::app()->db->createCommand("SELECT * FROM `SLD_ADD_VEHICLE` where id='$id'")->queryAll();
	
		//echo json_encode($arrFeatureDetails); 
                die;
		
	
	}
        public function actionUpdateVehicleDetails()
        {
              $message = '';
              $arrSelfAgentDetails = array();
              $arrFeatureDetails = array();
              if(isset($_POST['id'],$_POST['from_date'],$_POST['to_date']))
              {
                    $intSelfVehicleId = $_POST['id'];
                    $strFromDate = $_POST['from_date'];
                    $strToDate =   $_POST['to_date'];
                    $arrSelfAgentDetails = SelfVehicles::model()->getAgentDetails();
                    $objDataManager = new DataManager();
                    $arrFeatureDetails= $objDataManager->getFeatureDetails($arrSelfAgentDetails);
                    $intUpdateStatus = SelfVehiclesDetails::model()->UpdateVehicleDetails($strFromDate,$strToDate,$intSelfVehicleId);
              }
             /// $this->actionSelfManageVehicles();
             // $this->redirent(array("/SelfDrive/ManageVehicles","VehicleDetails" =>$arrSelfAgentDetails, "FeatureDetails"=> $arrFeatureDetails));
              
                  $this->render('/SelfDrive/ManageVehicles',array("VehicleDetails" =>$arrSelfAgentDetails, "FeatureDetails"=> $arrFeatureDetails));
              
             
              
               
             /* if($intUpdateStatus > 0)
              {
                  $message = 'Successfully Updated';
              }*/
             // $this->render('/selfdrive/ManageVehicles',array("VehicleDetails" =>$arrSelfAgentDetails, "FeatureDetails"=> $arrFeatureDetails));
            
            
        }
     public function actionGetVehicleDetails()
    {
         if (Yii::app()->request->isPostRequest) {
            $intSelfVehicleId = $_POST['id'];
            $arrVehicleTimeDetails = SelfVehiclesDetails::model()->GetVehicleDetails($intSelfVehicleId);
            
         // print_r($arrVehicleTimeDetails);
            //die();
            echo json_encode($arrVehicleTimeDetails); 
            
         }
    }
    public function actionSelfAgent()
    {
        $arrSelfAgentResponse = array();
        $objSelfAgentDetails = array();
        $strVehicleFolderName = 'agents';
        $arrErrors = array();
        $arrImagesParams = array();
        $arrCountries = countries::FetchCountryDetails();
        $intAgentId= Agent::GetAgentId();
        if (isset($_POST['SelfAgentSub'])) {
            $objSelfAgent = new SelfAgentForm();
            $objSelfAgent->attributes = $_POST;
            
            if ($objSelfAgent->validate()) {
                
                $objectTransaction = Yii::app()->db->beginTransaction();
                $objectDataManager = new DataManager();

                $objSelfAgentDetails = $objectDataManager->makeData($objSelfAgent->attributes);
                $roletype = 2;
                $intUserId = $this->AddUserDetails($objSelfAgentDetails,$roletype);
                $intAgentId = $this->AddAgent($objSelfAgentDetails ,$intUserId);
                
                if (isset($_FILES['userfile'])) {
                    $folderPath = 'idproof';
                $arrImagesParams['userfile'] = $this->actionUploadPDF('userfile', $folderPath , $strVehicleFolderName);
                }
                //$objSelfAgentDetails['userfile']['name'] =  $arrImagesParams['userfile'];
                $intAgentDetailsId = $this->AddAgent_Details($objSelfAgentDetails ,$intAgentId , $arrImagesParams['userfile']);
                if (!empty($intAgentDetailsId)) {
                    $objectTransaction->commit();
                } else {
                    $objectTransaction->rollback();
                }
               $arrSelfAgentResponse = array('type' => 'success', 'data' => 'Agent added successfully.', 'message' => 'Agent added successfully.', 'code' => 200);
            } else {
                $arrErrors = $objSelfAgent->errors;
            }
        }
      
        
              
        $this->render('/SelfDrive/self_agent', array('errors' => $arrErrors, 'response' => $arrSelfAgentResponse, 'getCountries' => $arrCountries , "AgentId" => $intAgentId));
          
          
       
    }
    public function actionUploadPDF($strFileName, $folder, $strDestination = 'agents') {
        $arrImageNames = array();
        if (isset($_FILES[$strFileName])) {
            $errors = array();
            $file_name = $_FILES[$strFileName]['name'];
            $file_size = $_FILES[$strFileName]['size'];
            $file_tmp = $_FILES[$strFileName]['tmp_name'];
            $file_type = $_FILES[$strFileName]['type'];
            $file_ext = strtolower(end(explode('.', $_FILES[$strFileName]['name'])));


            $randString = md5(time()); //encode the timestamp - returns a 32 chars long string
            $fileName = $_FILES[$strFileName]["name"]; //the original file name
            $splitName = explode(".", $fileName); //split the file name by the dot
            $fileExt = end($splitName); //get the file extension
            $newFileName = strtolower($randString . '.' . $fileExt);

            if (empty($errors) == true) {
                $fixedPath = realpath(Yii::app()->basePath) . '/../images/uploadimages/' . $strDestination . '/';
                $ss = md5(time()) . 'pdf';
                move_uploaded_file($file_tmp, $fixedPath . $folder . '/original/' . $newFileName);
                $arrImageNames['timestampName'] = $file_tmp;
                $arrImageNames['original_name'] = $file_name;
            } else {
                print_r($errors);
            }
        }
        return $newFileName;
    }
    public function  AddSelfDrive($objSelfData)
    {
        $intSelfAgentId = SelfDriveAgency_Model::model()->CreateSelfDriveDetails($objSelfData);
        return $intSelfAgentId;
    }

    public function  actiongetState()
    {
         $strSubRepid = NULL;
        $arrState_Names = '<option value=""> -- Select State -- </option>';
        if (Yii::app()->request->isPostRequest) {
            $country_id = $_POST['country_id'];

            $arrStatesDetails = States::FetchStateDetails($country_id);

            if (!empty($arrStatesDetails)) {

                foreach ($arrStatesDetails as $arrStatesDetail) {
                    $arrState_Names .= '<option  value = ' . $arrStatesDetail['id'] . '>' . $arrStatesDetail['name'] . '</option>';
                }
            }
        }
        echo $arrState_Names;
    }
    public function  actionGetCity()
    {
         $strSubRepid = NULL;
          $arrCity_Names = '<option value=""> -- Select City -- </option>';
        if (Yii::app()->request->isPostRequest) {
            $state_id = $_POST['state_id'];

            $arrCityDetails = Cities::FetchCityDetails($state_id);

            if (!empty($arrCityDetails)) {

                foreach ($arrCityDetails as $arrCityDetail) {
                    $arrCity_Names .= '<option  value = ' . $arrCityDetail['id'] . '>' . $arrCityDetail['name'] . '</option>';
                }
            }
        }
        echo $arrCity_Names;
    }
    public function actionGetArea()
    {
        //$strSubRepid = NULL;
          $arrArea_Names = '<option value=""> -- Select Area -- </option>';
        if (Yii::app()->request->isPostRequest) {
            $city_id = $_POST['city_id'];

            $arrAreaDetails = Areas::FetchAreaDetails($city_id);

            if (!empty($arrAreaDetails)) {

                foreach ($arrAreaDetails as $arrAreaDetails) {
                    $arrArea_Names .= '<option  value = ' . $arrAreaDetails['id'] . '>' . $arrAreaDetails['name'] . '</option>';
                }
            }
        }
        echo $arrArea_Names;
    }
    public function  AddUserDetails($arrUserDetails,$roletype)
    {
        $intUserId = Users::CreateUserDetails($arrUserDetails,$roletype);
        return $intUserId;

    }
     public function  AddAgent($arrAgent,$IntUserId)
    {
        $intAgentId = Agent::create($arrAgent,$IntUserId);
        return $intAgentId;

    }
      public function  AddAgent_Details($arrAgentDetails,$IntUserId,$file_Name)
    {
        $intAgentDelId = AgentDetails::create($arrAgentDetails,$IntUserId,$file_Name);
        return $intAgentDelId;

    }
  
}
