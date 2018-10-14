<?php

class SelfDriveController extends Controller {
    /*
     * @Author Digitaltoday
     * @create Users for Mps
     * return array respose to action
     */

    public function actionSelfDrive() {
        $arrModifiedSelfVehicles = array();
        $arrErrors = array();
        $objSelfDriveForm = NULL;
        $arrVehicleTypes = VehicleTypes::getVehicleTypes();
        if (isset($_POST['self_book'])) {
            $objSelfDriveForm = new SelfDriveForm();
            $objSelfDriveForm->attributes = $_POST;
            $arrInputs = $_POST;
            if ($objSelfDriveForm->validate()) {
                $explodeLocation = explode(',', $_POST['location']);
                $latitude = $explodeLocation[0];
                $longitude = $explodeLocation[1];
                $intIsWeekEndOrDay = 2;
                $objDataManager = new DataManager();
                $intDay = $objDataManager->getDay();
                if (1 == $intDay || 7 == $intDay) {
                    $intIsWeekEndOrDay = 1;
                }
                if($arrInputs['self_collection_mode'] == 'doorstep'){
                    $is_door_step=1;
                    $is_pickup=0;
                }
                if($arrInputs['self_collection_mode'] == 'pickup'){
                    $is_door_step=0;
                    $is_pickup=1;
                }
                $arrMinMaxLatiLongis = $objDataManager->getMinMaxLatiLongis($latitude, $longitude);
                $startdate = new DateTime($_POST['trip_start_date_time']);
                $strStartDateNTime = $startdate->format('Y-m-d');
                $startTime = $startdate->format('H:i');
                $enddate = new DateTime($_POST['trip_end_date_time']);
                $strEndDateNTime = $enddate->format('Y-m-d');
                $endTime = $enddate->format('H:i');
                $arrSelfVehicles = SelfVehicles::model()->agentVehiclesReport($arrMinMaxLatiLongis, array('week_day_or_end' => $intIsWeekEndOrDay, 'start_date' => $strStartDateNTime, 'end_date' => $strEndDateNTime, 'vehicle_id' => $_POST["self_vehicle_id"]));
                $arrModifiedSelfVehicles = $objDataManager->modifySelfVehicles($arrSelfVehicles, array('start_date' => $strStartDateNTime, 'end_date' => $strEndDateNTime, 'start_time' => $startTime, 'end_time' => $endTime, 'is_door_step' =>$is_door_step,'is_pickup' =>$is_pickup ));
            } else {
                $arrErrors = $objSelfDriveForm->errors;
            }
        }

        $this->render('/Self/Selfdrive', array('VehicleDetails' => $arrModifiedSelfVehicles, 'selfForm' => $objSelfDriveForm, 'errors' => $arrErrors, 'VehicleTypes' => $arrVehicleTypes));
    }

    public function actionSelfDriveOrder() {
        $intSelfVehicleId = Yii::app()->request->getParam('id');
        $arrInputs = array();
        $arrModifiedBookVehicle = array();
        $arrBookVehicaldetails = array();
        if (isset($_POST['BookOrder'])) {
            // print_r($_POST);die();
            $arrInputs = $_POST;
            $explodeLocation = explode(',', $_POST['Trip_agent_location']);
            $latitude = $explodeLocation[0];
            $longitude = $explodeLocation[1];

            $intIsWeekEndOrDay = 2;
            $objDataManager = new DataManager();
            $intDay = $objDataManager->getDay();
            if (1 == $intDay || 7 == $intDay) {
                $intIsWeekEndOrDay = 1;
            }
            
            if($arrInputs['pickupmode'] == 'doorstep'){
                    $is_door_step=1;
                    $is_pickup=0;
                }
                if($arrInputs['pickupmode'] == 'pickup'){
                    $is_door_step=0;
                    $is_pickup=1;
                }
            
            $arrMinMaxLatiLongis = $objDataManager->getMinMaxLatiLongis($latitude, $longitude);
            $startdate = new DateTime($_POST['TripStart']);
            $strStartDateNTime = $startdate->format('Y-m-d');
            $startTime = $startdate->format('H:i');
            $enddate = new DateTime($_POST['TripEnd']);
            $strEndDateNTime = $enddate->format('Y-m-d');
            $endTime = $enddate->format('H:i');
            $arrBookVehicle = SelfVehicles::model()->agentVehiclesReport($arrMinMaxLatiLongis, array('week_day_or_end' => $intIsWeekEndOrDay, 'start_date' => $strStartDateNTime, 'end_date' => $strEndDateNTime, 'vehicle_id' => $_POST["VehicleType"], 'self_vehicle_id' => $intSelfVehicleId));
            $arrModifiedBookVehicle = $objDataManager->modifySelfVehicles($arrBookVehicle, array('start_date' => $strStartDateNTime, 'end_date' => $strEndDateNTime, 'start_time' => $startTime, 'end_time' => $endTime,'is_door_step' =>$is_door_step,'is_pickup' =>$is_pickup ));
            $arrBookVehicaldetails = $arrModifiedBookVehicle[0];
        }

        $this->render('/Self/Selfdriveorder', array('BookVehicleDetails' => $arrBookVehicaldetails, 'SelfFormDetails' => $arrInputs));
    }

    public function actionSelfDriveOrderBooking() {

        $strCity = NUll;
        $arrErrors = array();
        $arrSelfDriveOrders = array();
        $objSelfDriveBookForm = array();
        $arrOrderInfo = array_merge(Yii::app()->session['self_order_info'], $_POST);
        if (isset($arrOrderInfo['pickup_location']) && !empty($arrOrderInfo['pickup_location'])) {
            $arrBreakCity = explode(',', $arrOrderInfo['pickup_location']);
            $strCity = isset($arrBreakCity[count($arrBreakCity) - 3]) ? $arrBreakCity[count($arrBreakCity) - 3] : NULL;
        }
        $arrOrderInfo['order_city'] = $strCity;

        $intCustomer = Yii::app()->session['customerID'];
        $arrCustomer = Customer::getCustomer(NULL, $intCustomer);
        if (isset($arrCustomer['password'])) {
            unset($arrCustomer['password'], $arrCustomer['verify_token'], $arrCustomer['access_token']);
        }

        if (isset($_POST['final_self_book'])) {
            $objSelfDriveBookForm = new SelfDriveBookForm();
            $objSelfDriveBookForm->attributes = $_POST;
            if ($objSelfDriveBookForm->validate()) {
               
                $objOrderInfoDetails = array_merge(Yii::app()->session['self_order_info'], $_POST);
                Yii::app()->session['self_customer_order_info'] = $_POST;
                $startdate = new DateTime($objOrderInfoDetails['start_date']);
                $strStartDateNTime = $startdate->format('Y-m-d');
                $startTime = $startdate->format('H:i');
                $enddate = new DateTime($objOrderInfoDetails['end_date']);
                $strEndDateNTime = $enddate->format('Y-m-d');
                $endTime = $enddate->format('H:i');


                $SearchLocation = explode(',', $objOrderInfoDetails['location']);
                $latitude = $SearchLocation[0];
                $longitude = $SearchLocation[1];

                $PickupLocation = explode(',', $objOrderInfoDetails['pickup_location_latlng']);
                $pickup_latitude = $PickupLocation[0];
                $pickup_longitude = $PickupLocation[1];

                $DropLocation = explode(',', $objOrderInfoDetails['drop_location_latlng']);
                $drop_latitude = $DropLocation[0];
                $drop_longitude = $DropLocation[1];
                //array modification  
                $arrInputs = array_merge($objOrderInfoDetails, array('customer_id' => $intCustomer, 'customer_email' => $objOrderInfoDetails["self_order_email"], 'customer_phone' => $objOrderInfoDetails["self_order_phone"],
                    'start_date' => $strStartDateNTime, 'end_date' => $strEndDateNTime,
                    'start_time' => $startTime, 'end_time' => $endTime,
                    'vehicle_id' => $objOrderInfoDetails["vehicle_type_id"],
                    'is_pickup' => $objOrderInfoDetails["is_pickup"],
                    'is_door_step' => $objOrderInfoDetails["is_door_step"],
                    'location' => $objOrderInfoDetails["selflocation"], 'latitude' => $latitude, 'longitude' => $longitude,
                    'pickup_latitude' => $pickup_latitude, 'pickup_longitude' => $pickup_longitude,
                    'drop_latitude' => $drop_latitude, 'drop_longitude' => $drop_longitude));

                $objDataManager = new DataManager();
                $objectTransaction = Yii::app()->db->beginTransaction();
                $arrModifiedInputs = $objDataManager->modifySelfDriveOrder($arrInputs);

                $arrCustomerDetails = Customer::getCustomer(NULL, $arrInputs['customer_id']);
                //SelfDrive Orders
                $intSelfDriveOrderId = SelfDriveOrders::create($arrModifiedInputs['self_drive_orders']);
                //SelfDrive Orders Communication
                $arrModifiedInputs['self_drive_orders_communication'] = array_merge($arrModifiedInputs['self_drive_orders_communication'], array('self_drive_orders_id' => $intSelfDriveOrderId));
                $intSelfOrderCommunication = SelfDriveOrdersCommunication::create($arrModifiedInputs['self_drive_orders_communication']);
                //SelfDrive Orders Billing
                $arrModifiedInputs['self_drive_orders_billing'] = array_merge($arrModifiedInputs['self_drive_orders_billing'], array('self_drive_orders_id' => $intSelfDriveOrderId));
                $intSelfOrderCommunication = SelfDriveOrderBilling::create($arrModifiedInputs['self_drive_orders_billing']);
                //SMS Sending
                //$this->actionSendSms($arrModifiedInputs, $arrCustomerDetails);
                //Vehicle Timing update            
               
                if (!empty($intSelfOrderCommunication)) {
                    $objectTransaction->commit();
                    $strOrderNumber = $arrModifiedInputs['self_drive_orders']['order_number'];
                    Yii::app()->session['order_number'] = $strOrderNumber;
                    $arrSelfDriveOrders = SelfDriveOrders::model()->selfOrders(array('order_number' => $strOrderNumber));
                    //unset($arrModifiedInputs, $arrInputs,$objOrderInfoDetails,$arrCustomer,$objSelfDriveBookForm,$arrOrderInfo);
                } else {
                    $objectTransaction->rollback();
                    //unset($arrModifiedInputs,$arrInputs,$objOrderInfoDetails,$arrCustomer,$objSelfDriveBookForm,$arrOrderInfo);
                }

                Yii::app()->session['order_details'] = $arrSelfDriveOrders;

                if ($_POST['payment_mode_id'] == 3) {
                    $strRedirectURL = Yii::app()->params['webURL'] . 'Self/SelfDrive/PaymentOrder';
                    $this->redirect($strRedirectURL);
                    //  $this->redirect(['Self/SelfDrive/PaymentOrder/']);
                } else {
                     VehicleTimings::model()->updateVehicleTimings(array('is_available' => 0), $arrInputs['self_vehicle_id']);
                    $this->actionSendSms($arrModifiedInputs, $arrCustomerDetails);
                    $strRedirectURL = Yii::app()->params['webURL'] . 'Self/SelfDrive/ThankYou';
                    $this->redirect($strRedirectURL);
                   // $this->redirect(['Self/SelfDrive/ThankYou/']);
                }
            } else {
                $arrErrors = $objSelfDriveBookForm->errors;
            }
        }
        $this->render('/Self/SplaceOrder', array('customer_info' => $arrCustomer, 'errors' => $arrErrors, 'order_info' => $arrOrderInfo, 'orderdetails' => $objSelfDriveBookForm));
    }

    public function actionSendSms($arrInputs, $arrCustomerDetails) {
        $strSMSToken = NULL;
        $arrSmsData = Yii::app()->params['sms'];
        $objDataManager = new DataManager();
        $arrCustomer = array();
        $arrCustomer['mobile'] = $arrCustomerDetails['phone'] . ',' . Yii::app()->params['customer_info']['admin_mobile'];
        $arrCustomer['message'] = $objDataManager->getSelfDriveSms($arrInputs);
        $arrSmsData = array_merge($arrSmsData, $arrCustomer);
        $objectSMSManager = new SMSManager($arrSmsData);
        $strSMSToken = $objectSMSManager->fireSMS();
        unset($arrInputs, $arrCustomerDetails);
        return $strSMSToken;
    }

    public function actionThankYou() {
        $arrSelfDriveOrdersdet = Yii::app()->session['order_details'];
        $arrOrderDetails = Yii::app()->session['self_order_info'];
        $arrSelfDriveOrders = array_merge($arrSelfDriveOrdersdet, $arrOrderDetails);
        $this->render('/Self/ThankYou', array('order_details' => $arrSelfDriveOrders));
    }

    public function actionPaymentOrder() {

        $this->render('/Self/PaymentOrder');
    }

    public function actionDoEncrypt($arrInputs = array()) {
        $strMerchantData = NULL;
        $arrPaymentData = array();
        $arrInputs = Yii::app()->session['self_customer_order_info'];
        $arrOrderInfo = Yii::app()->session['self_order_info'];
        $arrSelfDriveOrders = Yii::app()->session['order_details'];

        $arrPaymentData = array(
            'billing_name' => isset($arrInputs['self_order_name']) ? $arrInputs['self_order_name'] : NULL,
            'billing_address' => $arrInputs['self_order_address1'] . $arrInputs['self_order_address1'],
            'billing_city' => isset($arrInputs['self_order_city']) ? $arrInputs['self_order_city'] : NULL,
            'billing_tel' => isset($arrInputs['self_order_phone']) ? $arrInputs['self_order_phone'] : NULL,
            'billing_email' => isset($arrInputs['self_order_email']) ? $arrInputs['self_order_email'] : NULL,
            'amount' => $arrOrderInfo['final_amount'],
            //'amount' => 1,
            'billing_zip' => isset($arrInputs['self_order_pincode']) ? $arrInputs['self_order_pincode'] : NULL,
            'order_id' => Yii::app()->session['order_number'],
            'merchant_id' => '105397',
            //'redirect_url' => 'http://10.10.10.74/DT/MeterPerSecond/bookaservice/index.php/Self/SelfDrive/PaymentResponse',
            //'cancel_url' => 'http://10.10.10.74/DT/MeterPerSecond/bookaservice/index.php/Self/SelfDrive/PaymentResponse',
            'redirect_url' =>  Yii::app()->params['payment_keys']['ccavenue']['self_redirect_url'],
            'cancel_url' => Yii::app()->params['payment_keys']['ccavenue']['self_cancel_url'],
            'language' => 'EN',
            'currency' => 'INR',
                //'tid' => CommonFunctions::getToken(10),
        );

        if (!empty($arrPaymentData)) {
            foreach ($arrPaymentData as $strPaymentKey => $strPaymentValue) {
                $strMerchantData .= $strPaymentKey . '=' . $strPaymentValue . '&';
            }
        }
        $strEncypted = Payment::encrypt($strMerchantData, Yii::app()->params['payment_keys']['ccavenue']['working_key']);

        echo $strEncypted;
    }

    public function actionPaymentResponse() {

        $workingKey = Yii::app()->params['payment_keys']['ccavenue']['working_key'];
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

    public function actionFinalOrder() {
        $$arrModifiedInputs= $arrOrderFinalDetails = array();
        $arrOrderDetails = Yii::app()->session['self_order_info'];
        $arrPaymentDetails = Yii::app()->session['payment_info'];
         $arrCustomerDetails = Customer::getCustomer(NULL, Yii::app()->session['customerID']);
         $arrModifiedInputs['self_drive_orders']['order_number']=Yii::app()->session['order_number'];
               
        $arrSelfOrderBillingData = array();
        if (isset($arrPaymentDetails['order_status']) && 'Success' == $arrPaymentDetails['order_status']) {
            VehicleTimings::model()->updateVehicleTimings(array('is_available' => 0), $arrInputs['self_vehicle_id']);
            $this->actionSendSms($arrModifiedInputs, $arrCustomerDetails);
             unset($arrInputs, $arrCustomerDetails);
            $arrSelfOrderBillingData['order_transaction'] = isset($arrPaymentDetails['tracking_id']) ? $arrPaymentDetails['tracking_id'] : NULL;
            $arrSelfOrderBillingData['transaction_status'] = isset($arrPaymentDetails['order_status']) ? $arrPaymentDetails['order_status'] : NULL;
            $arrSelfOrderBillingData['invoice_date'] = date('Y-m-d H:i:s');
            $arrSelfOrderBillingData['invoice_number'] = CommonFunctions::getToken(5);
        } else {
             VehicleTimings::model()->updateVehicleTimings(array('is_available' => 1), $arrOrderDetails['self_vehicle_id']);

            $arrSelfOrderBillingData['order_transaction'] = isset($arrPaymentDetails['tracking_id']) ? $arrPaymentDetails['tracking_id'] : NULL;
            $arrSelfOrderBillingData['transaction_status'] = isset($arrPaymentDetails['order_status']) ? $arrPaymentDetails['order_status'] : NULL;
        }
        $intUpdate = SelfDriveOrderBilling::updateSelfOrderBillingStatus(Yii::app()->session['latest_order_id'], $arrSelfOrderBillingData);
        $arrOrderDetails1 = array_merge($arrSelfOrderBillingData, array('order_number' => Yii::app()->session['order_number']));
        $arrOrderFinalDetails=array_merge($arrOrderDetails,$arrOrderDetails1);      
// unset(Yii::app()->session['self_order_info'], Yii::app()->session['payment_info'],Yii::app()->session['order_details']);
        $this->render('/Self/FinalOrders', array('order_details' => $arrOrderFinalDetails, 'payment_details' => $arrPaymentDetails));
    }

}

?>
