<?php

/**
 * @author Digital Today
 * @access public
 * @ignore It will handle mechanics operations
 */
class HireAMechanicController extends Controller {

    public function actionHire() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['latitude']) && !empty($arrInputs['latitude']) && isset($arrInputs['longitude']) && !empty($arrInputs['longitude'])) {
                $objDataManager = new DataManager();
                $arrMinMaxLatiLongis = $objDataManager->getMinMaxLatiLongis($arrInputs['latitude'], $arrInputs['longitude']);
                $arrHires = HireAMechanic::hireReport($arrMinMaxLatiLongis, $arrInputs);
                $arrResponse = array('type' => 'success', 'data' => $arrHires, 'message' => 'Hires Data.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Location Is Not Found', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionHireBrands() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['vehicle_id']) && !empty($arrInputs['vehicle_id'])) {
                $arrVehicleBrands = VehicleBrands::getVehicleBrands(1, $arrInputs['vehicle_id']);
                $arrResponse = array('type' => 'success', 'data' => $arrVehicleBrands, 'message' => 'Vehicle Brands.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Vehicle Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionHireModels() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['brand_id']) && !empty($arrInputs['brand_id'])) {
                $arrVehicleModels = VehicleBrandModels::getVehicleBrandModels($arrInputs['brand_id']);
                $arrResponse = array('type' => 'success', 'data' => $arrVehicleModels, 'message' => 'Vehicle Models.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Vehicle Brand Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionFireHire() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['model_id']) && !empty($arrInputs['model_id'])) {
                $arrMinMaxLongisLatis = array();
                $arrHires = HireAMechanic::hireReport($arrMinMaxLongisLatis, $arrInputs);
                $arrResponse = array('type' => 'success', 'data' => $arrHires, 'message' => 'Hires List.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Vehicle Model Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionHireUS() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['customer_id']) && !empty($arrInputs['customer_id']) && isset($arrInputs['hire_id']) && !empty($arrInputs['hire_id'])) {
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
                $strSmsConfirmation = $this->sendSms($arrInputs, $arrCustomerDetails);
                $arrModifiedInputs = array_merge($arrModifiedInputs, array('sms_confirm_token' => $strSmsConfirmation));
                //Sms :: END
                $intHireOrder = HireOrders::create($arrModifiedInputs);
                $arrModifiedInputs = array_merge($arrModifiedInputs, array('hire_orders_id' => $intHireOrder));
                $intHireCommunication = HireOrdersCommunication::create($arrModifiedInputs);
                $arrResponse = array('type' => 'success', 'data' => $intHireCommunication, 'message' => 'Successfully You Hired A Mechanic.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Customer Or Hire Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionHireProfession() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['hire_id']) && !empty($arrInputs['hire_id'])) {
                $arrHireSkills = HireAMechanicSkills::getSkills($arrInputs['hire_id']);
                $arrResponse = array('type' => 'success', 'data' => $arrHireSkills, 'message' => 'Hire Skills.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Hire Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function sendSms($arrInputs, $arrCustomerDetails) {
        $strSMSToken = NULL;
        $arrSmsData = Yii::app()->params['sms'];
        $objDataManager = new DataManager();
        $arrCustomer = array();
        $arrCustomer['mobile'] = $arrCustomerDetails['phone'] . ',' . Yii::app()->params['customer_info']['admin_mobile'];
        $arrInputs['first_name'] = isset($arrCustomerDetails['first_name']) ? $arrCustomerDetails['first_name'] : NULL;
        $arrCustomer['message'] = $objDataManager->getHireSMS($arrInputs);
        $arrSmsData = array_merge($arrSmsData, $arrCustomer);
        $objectSMSManager = new SMSManager($arrSmsData);
        $strSMSToken = $objectSMSManager->fireSMS();
        unset($arrInputs, $arrCustomerDetails);
        return $strSMSToken;
    }

    public function actionOrders() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInput = $_POST;
            if (isset($arrInput['customer_id']) && !empty($arrInput['customer_id'])) {
                $arrOrders = HireOrders::model()->hireOrdersList($arrInput);
                $arrResponse = array('type' => 'success', 'data' => $arrOrders, 'message' => 'Orders List.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Customer Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

}
