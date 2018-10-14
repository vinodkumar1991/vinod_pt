<?php

class SelfDriveController extends Controller {
    /*
     * @Author Digitaltoday
     * @create Users for Mps
     * return array respose to action
     */
    
    public function actionSelfDrive()
    {
        $arrSelfAgentDetails = array();
        $arrSelfFeaturesDetails = array();
        $arrSelfImageDetails = array();
        $intStatus = 0;
        if(isset($_GET['id']) && isset($_GET['fromDate']) && isset($_GET['toDate']) && empty($_GET['location']))
        {
            
             $intVehicleClassesid = $_GET['id'];
             $strFromDate = strtotime($_GET['toDate']);
             $strToDate = $_GET['toDate'];
             
             $arrSelfAgentDetails = SelfVehicles::model()->getVehicleClassesByAgentDetails($strFromDate, $strToDate, $intVehicleClassesid, $longitude = 0, $latitude = 0);
             
             
        }
        else if((isset($_GET['id']) && isset($_GET['fromDate']) && isset($_GET['toDate']) && isset($_GET['location'])))
        {
            
           
                    $intVehicleClassesid = $_GET['id'];
                    $strFromDate = strtotime($_GET['toDate']);
                    $strToDate = $_GET['toDate'];
                    $doubleLocation = $_GET['location'];
                    $locationData = explode(',',$doubleLocation);
                    $latitude = $locationData[0];
                    $longitude = $locationData[1];
                    $arrSelfAgentDetails = SelfVehicles::model()->getVehicleClassesByAgentDetails($strFromDate, $strToDate, $intVehicleClassesid, $longitude, $latitude);
                   
        }
        else
        {
            $arrSelfAgentDetails = SelfVehicles::model()->getAgentDetails($intStatus);
        }
        
        $objDataManager = new DataManager();
        $arrSelfFeaturesDetails = $objDataManager->getFeatureDetails($arrSelfAgentDetails);
        $arrSelfImageDetails = $objDataManager->getSelfDriveImageDetails($arrSelfAgentDetails);
        $arrSelfVehicleClassesDetails = VehicleClasses::model()->getVehicleClasses();
        $arrSelfVehicleFeaturesDetails = VehicleFeatures::model()->getVehicleFeatures();
        
        $this->render('/Self/Selfdrive',array("VehicleDetails" =>$arrSelfAgentDetails,"FeatureDetails"=> $arrSelfFeaturesDetails,"SelfImages"=>$arrSelfImageDetails,"selfVehicleDetails" => $arrSelfVehicleClassesDetails,"selfVehicleFeatures"=>$arrSelfVehicleFeaturesDetails));
    }
    public function actionSelfDriveOrder()
	{
		
		        $id = $_GET['id'];
				
                $arrSelfAgentDetails = array();
                $arrSelfFeaturesDetails = array();
                $arrSelfChildImageDetails = array();
                $arrSelfAgentDetails = SelfVehicles::model()->getAgentDetails($id);
              
                $CustId =  Yii::app()->session['customerID'];
                $SelfVehicleId = $id;
                $fromdate=$_POST['fromdate'];
                $todate=$_POST['todate'];
                //self_orders
                //--start--//
                $arrSelfOrderData = array("CustId"=>$CustId,"SelfDriveId"=>$SelfVehicleId,"FromDate"=>$fromdate,"ToDate"=>$todate);
                $objDataManager = new DataManager();
                $arrSelfDriveOrderDetails = $objDataManager->makeData($arrSelfOrderData);//order details
               // $intSelfOrderId = SelfOrder::model()->Create($objSelfDriveOrderDetails);
                //--end--//
                $booklocation=$_POST['booklocation'];
			 
                $location=$_POST['location'];
				if(empty( $location))
				{
					$longitude = 67.374682735;
					$latitude = 34.456378;
				}
				else
				{
					$arrLocation = explode(',',$location);
					$longitude = $arrLocation[0];
					$latitude = $arrLocation[1];
				}
                $totalprice=$_POST['totalprice'];
                //$arrSelfOrderCommunicationData = array("Location"=>$booklocation,"Longitude"=>$longitude,"latitude"=>$latitude,"price"=>$totalprice);
				$arrSelfOrderCommunicationData = array("Location"=>$booklocation,"Longitude"=>56.65783653,"latitude"=>78.663658375,"price"=>$totalprice);
                $arrSelfDriveOrderCommuDetails = $objDataManager->makeData($arrSelfOrderCommunicationData);//billing details

                $arrSelfOrderInfoData = array_merge($arrSelfDriveOrderCommuDetails,$arrSelfDriveOrderDetails);
                $objSession = Yii::app()->session;
                $objSession['order_info'] = $arrSelfOrderInfoData;

                $arrSelfFeaturesDetails= $objDataManager->getFeatureDetails($arrSelfAgentDetails);
                $arrSelfChildImageDetails= $objDataManager->getImageChildDetails($arrSelfAgentDetails);
                
                $this->render('/Self/Selfdriveorder',array("VehicleDetails" =>$arrSelfAgentDetails,"FeatureDetails"=> $arrSelfFeaturesDetails,"SelfImages"=>$arrSelfChildImageDetails,"totalprice"=>$totalprice,"location"=>$booklocation,"SelfDriveDetails"=>$arrSelfOrderInfoData));
	

	}
         public function actionSelfDriveSearch()
	{
                
           
            $fromdate = '';
            $todate = '';
            $arrSelfAgentDetails = array();
            $arrSelfFeaturesDetails = array();
            $arrSelfImageDetails = array();
             if(isset($_POST['from_date']) && isset($_POST['to_date']) && !isset($_POST['bookloc']))
             {
                 
                  $fromdate = $_POST['from_date'];
                  $todate = $_POST['to_date'];
                  $start_time=strtotime($_POST['from_date']);
                  $end_time=strtotime($_POST['to_date']);
                  $arrSelfAgentDetails = SelfVehicles::model()->getTripByAgentDetails($start_time, $end_time, $longitude = 0, $latitude = 0);
             }
             else if(isset($_POST['from_date']) && isset($_POST['to_date']) && isset($_POST['bookloc']))
             {
         
                 $start_time=strtotime($_POST['from_date']);
                 $end_time=strtotime($_POST['to_date']);
                 $location = $_POST['location'];
                 $explodeLocation = explode(',',$location);
                 $latitude  =  $explodeLocation[0];
                 $longitude = $explodeLocation[1];
                 $arrSelfAgentDetails = SelfVehicles::model()->getTripByAgentDetails($start_time,$end_time, $latitude, $longitude);
                            
             }
             
              $objDataManager = new DataManager();
            
              $arrSelfFeaturesDetails = $objDataManager->getFeatureDetails($arrSelfAgentDetails);
              $arrSelfImageDetails = $objDataManager->getSelfDriveImageDetails($arrSelfAgentDetails);
              $arrSelfVehicleClassesDetails = VehicleClasses::model()->getVehicleClasses();
              $arrSelfVehicleFeaturesDetails = VehicleFeatures::model()->getVehicleFeatures();
              $this->render('/Self/Selfdrive',array("VehicleDetails" =>$arrSelfAgentDetails,"FeatureDetails"=> $arrSelfFeaturesDetails,"SelfImages"=>$arrSelfImageDetails,"fromdate" => $fromdate,"todate" => $todate,"selfVehicleDetails" => $arrSelfVehicleClassesDetails,"selfVehicleFeatures"=>$arrSelfVehicleFeaturesDetails));
	

	}
         public function actionBillingNewOrder() {
          
            
                $intCustomer = Yii::app()->session['customerID'];
                $arrCustomer = Customer::getCustomer(NULL, $intCustomer);
                //print_r($arrCustomer);
               
                if (isset($arrCustomer['password'])) {
                    unset($arrCustomer['password'], $arrCustomer['verify_token'], $arrCustomer['access_token']);
                }
                $this->render('/Self/SplaceOrder', array('customer_info' => $arrCustomer));
    }
      public function actionSaveOrder() {
        $intOrderId = 0;
        if (Yii::app()->request->isPostRequest) {
            $arrSelfOrderInfo = Yii::app()->session['order_info'];
            $arrSelfOrderAdrsDetails = $_POST;
            
             //Transaction :: Start
            $objectTransaction = Yii::app()->db->beginTransaction();
            $arrSelfOrderDetails = array_merge($arrSelfOrderAdrsDetails, $arrSelfOrderInfo);
            $intSelfOrderId = SelfOrder::model()->Create($arrSelfOrderDetails);
			
            $intSelfOrderCommId = SelfOrderCommunication::model()->Create($arrSelfOrderDetails, $intSelfOrderId);
            $intSelfOrderBillingId = SelfOrderBilling::model()->Create($arrSelfOrderDetails, $intSelfOrderId);
             if (!empty($intSelfOrderBillingId)) {
                $objectTransaction->commit();
            } else {
                $objectTransaction->rollback();
            }
            //Transaction :: END
            echo $intSelfOrderId;
            die();
          
        }
        echo $intOrderId;
    }
    public function actionFinalOrder() {
        $arrPayData = Yii::app()->session['payment_info'];
		
		/*if("Aborted" == $arrPayData['order_status'])
		{
			$intUpdatedStatus= SelfOrder::model()->updateStatus($arrPayData['order_id'],2);
		}
		else if('Failure' == $arrPayData['order_status'])
		{
			$intUpdatedStatus= SelfOrder::model()->updateStatus($arrPayData['order_id'],3);
		}
		else{*/
             $arrPayData = array();
             
             $arrPayData['tracking_id'] = 'zdjflsjgo';
	     $arrPayData['order_transaction'] = 'sifiiouoi';
             $arrPayData['transaction_status'] = 'djgslkgjlk';
             $arrPayData['invoice_date'] = '7/10/2016';
             $arrPayData['invoice_number'] = 'djhs';
			 //$intOrderUpdatedStatus= SelfOrder::model()->updateStatus($arrPayData['order_id'],1);
			 $intOrderId = Yii::app()->session['unique_order_id'];
			
			echo $intUpdatedStatus= SelfOrderBilling::model()->updateBillingStatus($arrPayData,$intOrderId);
                         die();
		//}
        $arrOrderDetails = Yii::app()->session['order_info'];
        $arrGetOrderedVehicleDetails= SelfVehicles::model()->getCustomerOrderedVehicleDetails($arrOrderDetails['SelfDriveId']);
       // print_r($arrOrderDetails);
       // die();
        $arrOrderDetails = array_merge($arrOrderDetails, array('order_number' => Yii::app()->session['order_number']),$arrGetOrderedVehicleDetails,$arrPayData);
      
        $this->render('/Self/SFinalOrders', array('order_details' => $arrOrderDetails));
    }
       public function actionDoEncrypt() {
        $strMerchantData = NULL;
        $arrPaymentData = array();
        $arrInputs = $_POST;
        $arrOrderInfo = Yii::app()->session['order_info'];
        $arrPaymentData = array(
            'billing_name' => isset($arrInputs['name']) ? $arrInputs['name'] : NULL,
            'billing_address' => $arrInputs['address1'] . $arrInputs['address2'],
            'billing_city' => isset($arrInputs['city']) ? $arrInputs['city'] : NULL,
            'billing_tel' => isset($arrInputs['phone']) ? $arrInputs['phone'] : NULL,
            'billing_email' => isset($arrInputs['email']) ? $arrInputs['email'] : NULL,
            //'amount' => $arrOrderInfo['total_amount'],
            'amount' => 1,
            'order_id' => Yii::app()->session['order_number'],
            'merchant_id' => '105397',
            'redirect_url' => 'http://202.56.199.159/mps/bookaservice/index.php/Self/SelfDrive/PaymentResponse',
            'cancel_url' => 'http://202.56.199.159/mps/bookaservice/index.php/Self/SelfDrive/PaymentResponse',
            'language' => 'EN',
            'currency' => 'INR',
                //'tid' => CommonFunctions::getToken(10),
        );
       
        if (!empty($arrPaymentData)) {
            foreach ($arrPaymentData as $strPaymentKey => $strPaymentValue) {
                $strMerchantData .= $strPaymentKey . '=' . $strPaymentValue . '&';
            }
        }
        $strEncypted = Payment::encrypt($strMerchantData, 'DB1FA0B166DBDD94EA6527B0418BCF8F');
        echo $strEncypted;
    }
	public function actionPaymentResponse() {

        $workingKey = 'DB1FA0B166DBDD94EA6527B0418BCF8F';
        $encResponse = $_POST["encResp"];
        $rcvdString = Payment::decrypt($encResponse, $workingKey);
        $strPaymentStatus = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        $arrPaymentResponse = array();
        $arrModifiedPaymentResponse = array();
        for ($i = 0; $i < $dataSize; $i++) {
            $arrResponse = explode('=', $decryptValues[$i]);
            $arrPaymentResponse[] = explode('=', $decryptValues[$i]);
            if ($i == 3)
                $strPaymentStatus = $arrResponse[1];
        }

        foreach ($arrPaymentResponse as $key => $value) {
            $arrModifiedPaymentResponse[$value[0]] = $value[1];
        }

        //$strOrderStatus = Yii::app()->params['payment_status']['ccavenue'][$strPaymentStatus];
        $strOrderStatus = isset($arrModifiedPaymentResponse['order_status']) ? $arrModifiedPaymentResponse['order_status'] : NULL;
		
        if ($strOrderStatus == 'Success') {
            $strPaymentMessage = "Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
        } else if ($strOrderStatus == 'Aborted') {
            $strPaymentMessage = "But you cancelled the payment.";
        } else if ($strOrderStatus == 'Failure') {
            $strPaymentMessage = "However,the transaction has been declined.";
        } else {
            $strPaymentMessage = "Security Error. Illegal access detected.";
        }
        $arrModifiedPaymentResponse['payment_message'] = $strPaymentMessage;
        $objSession = Yii::app()->session;
        $objSession['payment_info'] = $arrModifiedPaymentResponse;
        $this->actionFinalOrder();
        return TRUE;
    }
    
}
?>
