<?php

class HireMechanicController extends Controller {

    public function actionHire() {
        $arrErrors = $arrInputs = array();
        $objHireForm = $strHires = NULL;
        $arrHires = HireAMechanic::hireReport(array(),array('is_display' => 1));
        $objDataManager = new DataManager();
        $arrModifiedData = $objDataManager->modifyHirePoints($arrHires);
        $strHires = json_encode($arrModifiedData);
        $arrVehicles = VehicleTypes::getVehicleTypes();
        if (isset($_POST['hire_mechanic_search'])) {
            $objHireForm = new HireForm();
            $objHireForm->attributes = $_POST;
            if ($objHireForm->validate()) {
                $strLatitude = $strLongitude = NULL;
                $arrInputs = $_POST;
                $arrInputs['vehicle_id'] = $arrInputs['hire_vehicle_id'];
                $arrInputs['model_id'] = $arrInputs['hire_vehicle_model'];
                unset($arrInputs['hire_vehicle_id'], $arrInputs['hire_vehicle_model']);
                $arrLatiLongis = explode(',', $arrInputs['location']);
                $strLatitude = $arrLatiLongis[0];
                $strLongitude = $arrLatiLongis[1];
                //Cookie Values :: START
                Yii::app()->request->cookies['customer_search_location'] = new CHttpCookie('order_from_location', $arrInputs['hire_location']);
                Yii::app()->request->cookies['customer_latitude'] = new CHttpCookie('customer_latitude', $strLatitude);
                Yii::app()->request->cookies['customer_longitude'] = new CHttpCookie('customer_longitude', $strLongitude);
                //Cookie Values :: END
                $arrMinMaxLatiLongis = $objDataManager->getMinMaxLatiLongis($strLatitude, $strLongitude);
                $arrHires = HireAMechanic::hireReport($arrMinMaxLatiLongis, $arrInputs);
                $arrModifiedData = $objDataManager->modifyHirePoints($arrHires);
                $strHires = json_encode($arrModifiedData);
            } else {
                $arrErrors = $objHireForm->errors;
            }
        }
        $this->render('/HireAMechanic/HireList', array('vehicles' => $arrVehicles, 'errors' => $arrErrors, 'hireForm' => $objHireForm, 'hireList' => $arrHires, 'hires' => $strHires, 'customer_inputs' => $arrInputs));
    }

    public function actionGetVehicleBrands() {
        $strVehicleBrand = '<option value="">--Select Brand--</option>';
        $arrVehicleBrands = array();
        if (Yii::app()->request->isPostRequest) {
            $intVehicle = $_POST['vehicle_id'];
            $arrVehicleBrands = VehicleBrands::getVehicleBrands(1, $intVehicle);
            if (!empty($arrVehicleBrands)) {
                foreach ($arrVehicleBrands as $arrBrand) {
                    $strVehicleBrand .= '<option value="' . $arrBrand['id'] . '">' . $arrBrand['name'] . '</option>';
                }
            }
        }
        echo $strVehicleBrand;
    }

    public function actionGetVehicleBrandModels() {
        $strVehicleModel = '<option value="">--Select Model--</option>';
        $arrVehicleModels = array();
        if (Yii::app()->request->isPostRequest) {
            $intVehicleBrandType = $_POST['vehicleBrand'];
            $arrVehicleModels = VehicleBrandModels::getVehicleBrandModels($intVehicleBrandType);
            if (!empty($arrVehicleModels)) {
                foreach ($arrVehicleModels as $arrModel) {
                    $strVehicleModel .= '<option value="' . $arrModel['id'] . '">' . $arrModel['name'] . '</option>';
                }
            }
        }
        echo $strVehicleModel;
    }

    public function actionHireDetails() {
        $intHire = Yii::app()->getRequest()->getQuery('id');
        $intModel = Yii::app()->getRequest()->getQuery('model');
        $intVehicle = Yii::app()->getRequest()->getQuery('vehicle_id');
        $strCustomerLocation = $strLatitude = $strLongitude = NULL;
        //Customer Order Location
        if (isset(Yii::app()->request->cookies['order_from_location']->value) && !empty(Yii::app()->request->cookies['order_from_location']->value)) {
            $strCustomerLocation = Yii::app()->request->cookies['order_from_location']->value;
        }
        //Latitude
        if (isset(Yii::app()->request->cookies['customer_latitude']->value) && !empty(Yii::app()->request->cookies['customer_latitude']->value)) {
            $strLatitude = Yii::app()->request->cookies['customer_latitude']->value;
        }
        //Longitude
        if (isset(Yii::app()->request->cookies['customer_longitude']->value) && !empty(Yii::app()->request->cookies['customer_longitude']->value)) {
            $strLongitude = Yii::app()->request->cookies['customer_longitude']->value;
        }
        $arrCookieValues = array(
            'customer_location' => $strCustomerLocation,
            'customer_latitude' => $strLatitude,
            'customer_longitude' => $strLongitude,
        );
        $arrInputs = array('hire_id' => $intHire, 'model_id' => $intModel, 'vehicle_id' => $intVehicle);
        $arrHire = HireAMechanic::hireReport(array(), $arrInputs);
        $this->render('/HireAMechanic/HireDetails', array('hire_details' => $arrHire, 'customer_location' => $arrCookieValues));
    }

    public function actionHireUS() {
        $arrInputs = $_POST;
        $objDataManager = new DataManager();
       //$strOrderNumber = CommonFunctions::getSamllAlphaToken(5);
        
        
         $strKey = $strOrderNumber = $intDigit = NULL;
            if (1 == $arrInputs['vehicle_id']) {
                $arrHotOrderData = HireOrders::getOrderNumber($arrInputs['vehicle_id']);
                $strKey = Yii::app()->params['service_codes']['hireamechanic']['car'];
                $strOrderNumber = Yii::app()->params['service_codes']['hireamechanic']['car_format'];
                $intDigit = Yii::app()->params['service_codes']['hireamechanic']['car_digit'];
                $intPadding = Yii::app()->params['service_codes']['hireamechanic']['car_padding'];
            } elseif (2 == $arrInputs['vehicle_id']) {
                $arrHotOrderData = HireOrders::getOrderNumber($arrInputs['vehicle_id']);
                $strKey = Yii::app()->params['service_codes']['hireamechanic']['bike'];
                $strOrderNumber = Yii::app()->params['service_codes']['hireamechanic']['bike_format'];
                $intDigit = Yii::app()->params['service_codes']['hireamechanic']['bike_digit'];
                $intPadding = Yii::app()->params['service_codes']['hireamechanic']['bike_padding'];
            }

            if (!empty($arrHotOrderData)) {
                $intPartialMaxNumber = $objDataManager->getHotOrderNumber($arrHotOrderData[0]['order_number'], $intDigit);
                $strOrderNumber = $objDataManager->getNewOrderNumber($intPartialMaxNumber, $strKey, $intPadding);
            }
        
        $arrInputs = array_merge($arrInputs, array('order_number' => $strOrderNumber));
        $arrModifiedInputs = $objDataManager->makeData($arrInputs);
        $arrCustomerDetails = Customer::getCustomer(NULL, $arrInputs['customer_id']);
        $arrModifiedInputs['status'] = 1;
        //Sms :: START
        $strMechanicSmsConfirmation = $this->sendCustomerDetails($arrInputs, $arrCustomerDetails);
        $strSmsConfirmation = $this->sendSms($arrInputs, $arrCustomerDetails);
        $arrModifiedInputs = array_merge($arrModifiedInputs, array('sms_confirm_token' => $strSmsConfirmation));
        //Sms :: END
        //Keep Order Number In Session :: START
        Yii::app()->session['hire_order_number'] = $strOrderNumber;
        //Keep Order Number In Session :: END
        $intHireOrder = HireOrders::create($arrModifiedInputs);
        $arrModifiedInputs = array_merge($arrModifiedInputs, array('hire_orders_id' => $intHireOrder));
        $intHireCommunication = HireOrdersCommunication::create($arrModifiedInputs);
        echo 1;
    }

    public function sendSms($arrInputs, $arrCustomerDetails) {
        $strSMSToken = NULL;
        $arrSmsData = Yii::app()->params['sms'];
        $objDataManager = new DataManager();
        $arrCustomer = array();
        $arrCustomer['mobile'] = $arrInputs['hire_phone'];
        $arrInputs['first_name'] = isset($arrCustomerDetails['first_name']) ? $arrCustomerDetails['first_name'] : NULL;
        $arrCustomer['message'] = $objDataManager->getHireSMS($arrInputs);
        $arrSmsData = array_merge($arrSmsData, $arrCustomer);
        $objectSMSManager = new SMSManager($arrSmsData);
        $strSMSToken = $objectSMSManager->fireSMS();
        unset($arrInputs, $arrCustomerDetails);
        return $strSMSToken;
    }

    public function actionThankYou() {
        $strOrderNumber = Yii::app()->session['hire_order_number'];
        $arrHireOrders = HireOrders::model()->hireOrdersList(array('order_number' => $strOrderNumber));
        $this->render('/HireAMechanic/ThankYou', array('order_details' => $arrHireOrders));
    }

    public function sendCustomerDetails($arrInputs, $arrCustomerDetails) {
        $strSMSToken = NULL;
        $arrSmsData = Yii::app()->params['sms'];
        $objDataManager = new DataManager();
        $arrCustomer = array();
        $arrCustomer['mobile'] = $arrCustomerDetails['phone'] . ',' . Yii::app()->params['customer_info']['admin_mobile'];
        $arrCustomer['message'] = $objDataManager->getHireCustomerTemplate($arrInputs,$arrCustomerDetails);
        $arrSmsData = array_merge($arrSmsData, $arrCustomer);
        $objectSMSManager = new SMSManager($arrSmsData);
        $strSMSToken = $objectSMSManager->fireSMS();
        unset($arrInputs, $arrCustomerDetails);
        return $strSMSToken;
    }

}
