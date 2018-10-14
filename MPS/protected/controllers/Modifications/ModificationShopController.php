<?php

class ModificationShopController extends Controller{
    
    public function actionCreateModificationShop(){                       
        $arrErrors='';
        $intBrands=NULL;
        $intShopServices=NULL;
        $strMessage = NULL;
        //DropDown
        $arrServices=  ModificationShops::getModificationServices();
        $arrVehicles = VehicleTypes::getVehicleTypes();
        $arrCountry=Countries::countriesReport();
        
        //Create
        if (isset($_POST['addmodification'])) {
            //echo'<pre>';print_r($_POST);exit;
            $objModificationForm = new ModificationShopForm();
            $objModificationForm->attributes = $_POST;
            //
            
            if ($objModificationForm->validate()) {
                $objDataManager = new DataManager();
                $arrImagesParams = $this->actionUpload();
                $arrModificationShop = $objDataManager->modifyModificationShops($objModificationForm->attributes, $arrImagesParams);               
                $objectTransaction = Yii::app()->db->beginTransaction();
                //Users
                $intUser = Users::create($arrModificationShop['users']);
                
                //ModificationShop
                $arrShop = array_merge($arrModificationShop['modification_shops'], array('user_id' => $intUser));
                $intModificationShop = ModificationShops::create($arrShop);
                
                //Modification Shop Details
                $arrShopDetails = array_merge($arrModificationShop['modification_shop_details'], array('modification_shops_id' => $intModificationShop));
                $intMechanicShopDetails = ModificationShopDetails::create($arrShopDetails);
                
                //Modification Shop Brands
                if(isset($_POST['brand_name']) && !empty($_POST['brand_name'])){
                    $arrBrands=array();                    
                    foreach ($_POST['brand_name'] as $intSerKey => $intServalue) {
                         $arrBrands[] = array(
                            'modification_shops_id' => $intModificationShop,
                            'vehicle_types_id' =>$arrShop['vehicle_type'],
                            'vehicle_brands_id' => $intServalue,                            
                        );
                    }
                    $intBrands = ModificationShopsBrands::create($arrBrands);                    
                }
                
                //Modification Shop Services
                if(isset($_POST['list_modification']) && !empty($_POST['list_modification'])){
                    $arrShopServices=array();                    
                    foreach ($_POST['list_modification'] as $intSerKey => $intServalue) {
                         $arrShopServices[] = array(
                            'modification_shops_id' => $intModificationShop,
                            'vehicle_types_id' =>$arrShop['vehicle_type'],
                            'modification_service_id' => $intServalue,                            
                        );
                    }
                    //print_r($arrShopServices);die();
                    $intShopServices = ModificationShopsServices::create($arrShopServices,$arrBrands);                    
                }
                                           
                if (!empty($intShopServices)) {
                    $objectTransaction->commit();
                    $strMessage = 'Modification Shop details created successfully.';
                } else {
                    $objectTransaction->rollback();
                }
                unset($intShopServices, $intBrands, $intModificationShop,$intMechanicShopDetails, $intUser);
                unset($arrModificationShop,$arrShop, $arrShopDetails,$arrShopServices);
            }else {
              $arrErrors = $objModificationForm->errors;
              //echo'<pre>';print_r($arrErrors);
              //die();
            }
        }
        $this->render('/Modifications/CreateModificationShop',array('arrCountry'=>$arrCountry,'arrVehicles'=>$arrVehicles,'arrServices'=>$arrServices,'arrErrors'=>$arrErrors,'message'=>$strMessage));
    }
    
    public function actionBrands(){ 
        $strBrands='';
        $arrType = $_POST;
        $arrBrands = ModificationShops::getVehicleBrandName($arrType);        
        if (!empty($arrBrands)) {
            foreach ($arrBrands as $arrBrands) {
                $strBrands.= '<option value="' . $arrBrands['id'] . '">' . $arrBrands['name'] . '</option>';
            }
        }
        unset($arrBrands, $arrType);
        echo $strBrands;
    }
    
    public function actionUpload() {
        $arrModificationShop= array();
        $strFolderName = 'modificationshop';
        $arrImagesParams = array();
        //Shop Image
        if (isset($_FILES['shop_image'])) {
            $arrImagesParams['shop_image'] = $this->actionUploadPDF('shop_image', 'shop_image', $strFolderName);
        }
        //Logo
        if (isset($_FILES['brand_logo'])) {
            $arrImagesParams['brand_logo'] = $this->actionUploadPDF('brand_logo', 'logo', $strFolderName);
        }
        
        return $arrImagesParams;
    }

    public function actionUploadPDF($strFileName, $folder, $strDestination = 'modificationshop') {
        $arrImageNames = array();
        if (isset($_FILES[$strFileName])) {
            $errors = array();
            $file_name = $_FILES[$strFileName]['name'];
            $file_size = $_FILES[$strFileName]['size'];
            $file_tmp = $_FILES[$strFileName]['tmp_name'];
            $file_type = $_FILES[$strFileName]['type'];
            //$file_ext = strtolower(end(explode('.', $_FILES[$strFileName]['name'])));


            $randString = md5(time()); //encode the timestamp - returns a 32 chars long string
            $fileName = $_FILES[$strFileName]["name"]; //the original file name
            $splitName = explode(".", $fileName); //split the file name by the dot
            $fileExt = end($splitName); //get the file extension
            $newFileName = strtolower($randString . '.' . $fileExt);

            if (empty($errors) == true) {
                $fixedPath = realpath(Yii::app()->basePath) . '/../images/uploadimages/' . $strDestination . '/';
                $ss = md5(time()) . 'pdf';
                move_uploaded_file($file_tmp, $fixedPath . $folder . '/original/' . $newFileName);
                $arrImageNames['timestampName'] = $newFileName;
                $arrImageNames['original_name'] = $file_name;
            } else {
                print_r($errors);
            }
        }
        return $arrImageNames;
    }
    
    //ModificationShopsDetailsReport
    public function actionManageModificationShop(){                    
             $arrShops=  ModificationShops::getModificationShopsDetails();                    
             $this->render('/Modifications/ManageModificationShop', array('arrShops'=>$arrShops));
        
    }
    
}
