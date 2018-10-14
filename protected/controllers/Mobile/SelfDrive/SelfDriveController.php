<?php

/**
 * @author Digital Today
 * @access public
 * @ignore It will handle mechanics operations
 */
class SelfDriveController extends Controller {

    public function actionVehicles() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInput = $_POST;
            if (isset($arrInput['latitude']) && !empty($arrInput['latitude']) && isset($arrInput['longitude']) && !empty($arrInput['longitude'])) {
                $intIsWeekEndOrDay = 2;
                $objDataManager = new DataManager();
                $intDay = $objDataManager->getDay();
                if (1 == $intDay || 7 == $intDay) {
                    $intIsWeekEndOrDay = 1;
                }
                $arrMinMaxLatiLongis = $objDataManager->getMinMaxLatiLongis($arrInput['latitude'], $arrInput['longitude']);
                //$strStartDateNTime = $arrInput['start_date'] . ' ' . $arrInput['start_time'];
                $strStartDateNTime = $arrInput['start_date'];
                //$strEndDateNTime = $arrInput['end_date'] . ' ' . $arrInput['end_time'];
                $strEndDateNTime = $arrInput['end_date'];
                $arrSelfVehicles = SelfVehicles::model()->agentVehiclesReport($arrMinMaxLatiLongis, array('week_day_or_end' => $intIsWeekEndOrDay, 'start_date' => $strStartDateNTime, 'end_date' => $strEndDateNTime, 'vehicle_id' => $arrInput['vehicle_id']));
                $arrModifiedSelfVehicles = $objDataManager->modifySelfVehicles($arrSelfVehicles, $arrInput);
                $arrResponse = array('type' => 'success', 'data' => $arrModifiedSelfVehicles, 'message' => 'Vehicles List', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Location Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionGetSelfVehicle() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            $arrCustomerDetails = array();
            if (isset($arrInputs['self_vehicle_id']) && !empty($arrInputs['self_vehicle_id']) && isset($arrInputs['agent_id']) && !empty($arrInputs['agent_id'])) {
                $intIsWeekEndOrDay = 2;
                $objDataManager = new DataManager();
                $intDay = $objDataManager->getDay();
                if (1 == $intDay || 7 == $intDay) {
                    $intIsWeekEndOrDay = 1;
                }
                if (isset($arrInputs['customer_id']) && !empty($arrInputs['customer_id'])) {
                    $arrCustomerDetails = Customer::getCustomer(NULL, $arrInputs['customer_id']);
                }
                $arrSelfVehicles = SelfVehicles::model()->agentVehiclesReport(array(), array('week_day_or_end' => $intIsWeekEndOrDay, 'self_vehicle_id' => $arrInputs['self_vehicle_id'], 'agent_id' => $arrInputs['agent_id']));
                $objDataManager = new DataManager();
                $arrModifiedSelfVehicles = $objDataManager->modifySelfVehicles($arrSelfVehicles, $arrInputs, $arrCustomerDetails);
                $arrResponse = array('type' => 'success', 'data' => $arrModifiedSelfVehicles, 'message' => 'Vehicles Details', 'code' => 200);
                unset($arrSelfVehicles, $arrModifiedSelfVehicles);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Vehicle Or Agent Is Missed', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionBook() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
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
            $this->actionSendSms($arrModifiedInputs, $arrCustomerDetails);
            VehicleTimings::model()->updateVehicleTimings(array('is_available' => 0), $arrInputs['self_vehicle_id']);
            if (!empty($intSelfOrderCommunication)) {
                $objectTransaction->commit();
                unset($arrModifiedInputs, $arrInputs);
            } else {
                $objectTransaction->rollback();
                unset($arrModifiedInputs, $arrInputs);
            }
            $arrResponse = array('type' => 'success', 'data' => $intSelfDriveOrderId, 'message' => 'Vehicle Is Booked.', 'code' => 200);
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
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

    public function actionOrders() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInput = $_POST;
            if (isset($arrInput['customer_id']) && !empty($arrInput['customer_id'])) {
                $arrOrders = SelfDriveOrders::model()->selfOrders($arrInput);
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
