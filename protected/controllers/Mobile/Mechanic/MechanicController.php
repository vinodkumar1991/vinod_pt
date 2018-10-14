<?php

/**
 * @author Digital Today
 * @access public
 * @ignore It will handle mechanics operations
 */
class MechanicController extends Controller {

    public $notification_code = 1;

    public function actionDefault($arrLog) {
        $intUsersLog = NULL;
        if (!empty($arrLog)) {
            $intUsersLog = UsersLogs::create($arrLog);
        }
        return $intUsersLog;
    }

    public function actionSignIn() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            $strPassword = CommonFunctions::generatePassword($arrInputs['password']);
            $arrUser = Users::model()->isUserNameExist($arrInputs['username'], $strPassword);
            if (!empty($arrUser)) {
                $strSessionId = Yii::app()->getSession()->getSessionId();
                $arrUserUpdates = array('is_loggedin' => 1, 'user_session_id' => $strSessionId, 'gcm_register_id' => $arrInputs['gcm_register_id']);
                try {
                    //Log :: START 1 => Status
                    $objDataManager = new DataManager();
                    $arrLog = array('users_id' => $arrUser['user_id'], 'role_types_id' => $arrUser['role_id'], 'message' => 'Loggedin Successfully.', 'device_name' => $arrInputs['device_name'], 'imei_no' => $arrInputs['imei_no']);
                    $arrModifiedLog = $objDataManager->makeMobileData($arrLog);
                    $intUsersLogId = $this->actionDefault($arrModifiedLog);
                    //Log :: END
                    $intUpdate = Users::model()->userUpdate($arrUserUpdates, $arrInputs ['username']);
                } catch (Exception $e) {
                    $arrResponse = $arrResponse = array('type' => 'fail', 'data' => $e->getMessage(), 'message' => 'Oops error occured. Please try again.', 'code' => 300);
                }
                if (isset($arrUser['role_id']) && 5 == $arrUser['role_id']) { //5 => Delivery Boy
                    $arrUser = Users::model()->getDeliveryBoy($arrUser['delivery_boy_id']);
                }
                $arrUser = array_merge($arrUser, $arrUserUpdates);
                $arrResponse = array('type' => 'success', 'data' => $arrUser, 'message' => 'User Loggedin.', 'code' => 200);
                unset($arrUser, $arrUserUpdates);
                unset($strSessionId);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Invalid username or password is given or account deactivated.', 'code' => 401);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionOrders() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $intMechanic = $_POST['shop_id'];
            $intOnline = isset($_POST['is_online']) ? $_POST['is_online'] : 0;
            $arrShopAcceptedOrders = array();
            if (0 == $intOnline) {
                $arrShopAcceptedOrders = ShopOrders::shopOrdersReport($intMechanic, 1, array('isAccepted' => 1, 'isCompleted' => 0));
            }
            if (empty($arrShopAcceptedOrders)) {
                $intIsOnline = MechanicShops::updateMechanicStatus($intMechanic, array('is_online' => $intOnline));
            }
            if (!empty($intMechanic) && !empty($intOnline)) {
                $intUser = $_POST['user_id'];
                $intOrderStatus = $_POST['order_status'];
                $arrShop = MechanicShops::model()->mechanicShopsReport(array('status' => 1, 'shop_id' => $intMechanic));
                $arrReasons = Reasons::getReasons(1, 0);
                if (!empty($arrShop)) {
                    $objDataManager = new DataManager();
                    $arrRejected = ShopOrderRejected::shopRejectedOrders($intMechanic);
                    $strRejected = $arrRejected[0]['order_ids'];
                    $arrOtherRejected = ShopOtherOrderRejected::shopRejectedOrders($intMechanic);
                    $strOtherRejected = $arrOtherRejected[0]['order_ids'];

                    $arrMinMaxLatiLongis = $objDataManager->getMinMaxLatiLongis($arrShop[0]['latitude'], $arrShop[0]['longitude']);
                    if (1 == $intOrderStatus) { //For NEW
                        $arrOtherOrders = OtherOrders::otherOrdersReport($arrShop[0]['vehicle_id'], 1, $arrShop[0]['service_ids'], $arrMinMaxLatiLongis, $strOtherRejected);
                        $arrAcceptedOrders = Orders::model()->getAcceptedOrders($intMechanic, $arrShop[0]['vehicle_id'], 2, $arrShop[0]['service_ids'], $arrMinMaxLatiLongis, 1, $strRejected);
                        $arrOrders = Orders::model()->getShopOrders($arrShop[0]['vehicle_id'], $intOrderStatus, $arrShop[0]['service_ids'], $arrMinMaxLatiLongis, 1, $strRejected);
                        $arrResponse = array(
                            'type' => 'success',
                            'data' => $arrOrders,
                            'message' => 'Shop Orders',
                            'new_orders_count' => count($arrOrders),
                            'accepted_orders_count' => count($arrAcceptedOrders),
                            'other_orders_count' => count($arrOtherOrders),
                            'reasons' => $arrReasons,
                            'code' => 200
                        );
                        unset($arrAcceptedOrders, $arrOtherOrders);
                    } elseif (2 == $intOrderStatus) { //For Accepted
                        //New Orders List
                        $arrOtherOrders = OtherOrders::otherOrdersReport($arrShop[0]['vehicle_id'], 1, $arrShop[0]['service_ids'], $arrMinMaxLatiLongis, $strOtherRejected);
                        $arrNewOrders = Orders::model()->getShopOrders($arrShop[0]['vehicle_id'], 1, $arrShop[0]['service_ids'], $arrMinMaxLatiLongis, 1);
                        $arrOrders = Orders::model()->getAcceptedOrders($intMechanic, $arrShop[0]['vehicle_id'], 2, $arrShop[0]['service_ids'], $arrMinMaxLatiLongis, 1);
                        $arrResponse = array(
                            'type' => 'success',
                            'data' => $arrOrders,
                            'message' => 'Shop Orders',
                            'new_orders_count' => count($arrNewOrders),
                            'accepted_orders_count' => count($arrOrders),
                            'other_orders_count' => count($arrOtherOrders),
                            'reasons' => $arrReasons,
                            'code' => 200
                        );
                        unset($arrNewOrders, $arrOtherOrders);
                    } elseif (3 == $intOrderStatus) {
                        //New Orders List
                        //$arrOtherOrders = OtherOrders::otherOrdersReport();
                        $arrOtherOrders = OtherOrders::otherOrdersReport($arrShop[0]['vehicle_id'], 1, $arrShop[0]['service_ids'], $arrMinMaxLatiLongis, $strOtherRejected);
                        $arrNewOrders = Orders::model()->getShopOrders($arrShop[0]['vehicle_id'], 1, $arrShop[0]['service_ids'], $arrMinMaxLatiLongis, 1);
                        $arrOrders = Orders::model()->getAcceptedOrders($intMechanic, $arrShop[0]['vehicle_id'], 2, $arrShop[0]['service_ids'], $arrMinMaxLatiLongis, 1);
                        $arrResponse = array(
                            'type' => 'success',
                            'data' => $arrOtherOrders,
                            'message' => 'Shop Orders',
                            'new_orders_count' => count($arrNewOrders),
                            'accepted_orders_count' => count($arrOrders),
                            'other_orders_count' => count($arrOtherOrders),
                            'reasons' => $arrReasons,
                            'code' => 200
                        );
                        unset($arrNewOrders, $arrOrders, $arrOtherOrders);
                    } elseif (4 == $intOrderStatus) {
                        //New Orders List
                        //$arrOtherOrders = OtherOrders::otherOrdersReport();
                        $arrOtherOngoing = OtherOrders::otherAcceptedOrdersReport($intMechanic, $arrShop[0]['vehicle_id'], 2, $arrShop[0]['service_ids'], $arrMinMaxLatiLongis);
                        $arrOtherOrders = OtherOrders::otherOrdersReport($arrShop[0]['vehicle_id'], 1, $arrShop[0]['service_ids'], $arrMinMaxLatiLongis, $strOtherRejected);
                        $arrNewOrders = Orders::model()->getShopOrders($arrShop[0]['vehicle_id'], 1, $arrShop[0]['service_ids'], $arrMinMaxLatiLongis, 1);
                        $arrOrders = Orders::model()->getAcceptedOrders($intMechanic, $arrShop[0]['vehicle_id'], 2, $arrShop[0]['service_ids'], $arrMinMaxLatiLongis, 1);
                        $arrResponse = array(
                            'type' => 'success',
                            'data' => $arrOtherOngoing,
                            'message' => 'Shop Orders',
                            'new_orders_count' => count($arrNewOrders),
                            'accepted_orders_count' => count($arrOrders),
                            'other_orders_count' => count($arrOtherOrders),
                            'other_ongoing_count' => count($arrOtherOngoing),
                            'reasons' => $arrReasons,
                            'code' => 200
                        );
                        unset($arrNewOrders, $arrOrders, $arrOtherOrders);
                    }
                    unset($arrOrders, $arrShop, $arrMinMaxLatiLongis, $arrReasons, $arrRejected);
                    unset($intMechanic, $intUser, $intOrderStatus, $strRejected);
                }
            } else {
                if (empty($intOnline)) {
                    $arrResponse = array('type' => 'success', 'data' => $arrResponse, 'message' => 'Shop Is In Offline Mode.', 'code' => 200);
                } else if (empty($intOnline) && empty($arrShopAcceptedOrders)) {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Shop have accepted orders.', 'code' => 300);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Shop Is Missing Or Shop Is In Offline Mode.', 'code' => 300);
                }
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionUpdateOrder() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInput = $_POST;
            $intOrder = $_POST['order_id'];
            if (!empty($intOrder)) {
                $arrOrderDet = ShopOrders::isAssigned($_POST['shop_id'], $_POST['order_id']);
                if (empty($arrOrderDet)) {
                    $arrOrder = Orders::model()->orderStatus($intOrder, 1);
                    if (!empty($arrOrder)) {
                        $intUpdate = Orders::model()->updateOrderStatus($intOrder, Yii::app()->params['order_staus']['ACCEPTED']);
                        if ($intUpdate > 0) {
                            $objDataManager = new DataManager();
                            //Users Logs :: START
                            $arrLog = array('users_id' => $arrInput['user_id'], 'role_types_id' => $arrInput['role_id'], 'message' => 'Order Status Changed From NEW To Accepted.', 'device_name' => $arrInput['device_name'], 'imei_no' => $arrInput['imei_no']);
                            $arrModifiedLog = $objDataManager->makeMobileData($arrLog);
                            $this->actionDefault($arrModifiedLog);
                            //Users Logs :: END
                            $arrModifiedInputs = $objDataManager->makeMobileData($arrInput);
                            $intShopOrder = ShopOrders::create($arrModifiedInputs);
                            if (!empty($intShopOrder)) {
                                //Users Logs :: START 
                                $arrModifiedLog['message'] = "Order Accepted By Shop ID : " . $arrInput['shop_id'];
                                $this->actionDefault($arrModifiedLog);
                                //Users Logs :: END
                                $arrResponse = array('type' => 'success', 'data' => $intShopOrder, 'message' => 'Order Accepted By Mechanic Shop.', 'code' => 200);
                            }
                            unset($arrModifiedInputs, $arrOrder, $arrInput);
                            unset($intOrder);
                        } else {
                            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
                        }
                    } else {
                        $arrResponse = array('type' => 'fail', 'data' => $arrOrder, 'message' => 'Already Order Accepted By Other Mechanic Shop.', 'code' => 300);
                    }
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Order Accepted By Mechanic Shop', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Order Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionDeliveryBoys() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['shop_id']) && !empty($_POST['shop_id'])) {
                $arrDeliveryBoys = MechanicShops::getDeliveryBoys($_POST['shop_id']);
                $arrResponse = array('type' => 'success', 'data' => $arrDeliveryBoys, 'message' => 'Shop Delivery Boys', 'code' => 200);
                unset($arrDeliveryBoys);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Shop is not found', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionDeliveryBoyHistory() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['shop_id']) && !empty($_POST['shop_id']) && isset($_POST['is_deliver'])) {
                $intHistory = isset($_POST['is_history']) ? $_POST['is_history'] : 0;
                $intIsDeliver = isset($_POST['is_deliver']) ? $_POST['is_deliver'] : 0;
                $arrDeliveryBoy = DeliveryBoys::getDeliveryBoy($_POST['shop_id'], $_POST['delivery_boy_id'], $intHistory, $intIsDeliver);
                $arrRunner = DeliveryBoys::getRunner($_POST['shop_id'], $_POST['delivery_boy_id'], $intHistory, $intIsDeliver);
                //$arrDeliveryBoy = array_merge($arrDeliveryBoy, $arrRunner);
                $arrDeliveryBoy = array_merge($arrRunner, $arrDeliveryBoy);
                $arrResponse = array('type' => 'success', 'data' => $arrDeliveryBoy, 'message' => 'Delivery Boy Details', 'code' => 200);
                unset($arrDeliveryBoy);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Shop or Delivery Boy is not found', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionAssignToDeliveryBoy() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['delivery_boy_id']) && !empty($_POST['delivery_boy_id'])) {
                if (isset($_POST['latitude']) && !empty($_POST['latitude']) && isset($_POST['longitude']) && !empty($_POST['longitude'])) {
//Check Is any order assigned to delivery boy or not
                    $arrDeliveryBoyOrders = ShopOrders::isDeliveryBoyHaveOrders($_POST['delivery_boy_id']);
                    $arrAssigned = ShopOrders::isAssigned($_POST['shop_id'], $_POST['order_id'], $_POST['delivery_boy_id']);
                    if (empty($arrDeliveryBoyOrders)) {
                        if (empty($arrAssigned)) {
                            $intAssign = ShopOrders::assignOrderToBoy($_POST['shop_id'], $_POST['order_id'], NULL, array('delivery_boys_id' => $_POST['delivery_boy_id']));
//Log :: START 1 => Status
                            $objDataManager = new DataManager();
                            $arrLog = array('users_id' => $_POST['delivery_boy_id'], 'role_types_id' => $_POST['role_id'], 'message' => 'Shop ( ' . $_POST['shop_id'] . ') ::  Order (' . $_POST['order_id'] . ') Assigned To Delivery Boy', 'device_name' => $_POST['device_name'], 'imei_no' => $_POST['imei_no']);
                            $arrModifiedLog = $objDataManager->makeMobileData($arrLog);
                            $intUsersLogId = $this->actionDefault($arrModifiedLog);
//Log :: END
                            $intUpdate = Orders::updateOrderStatus($_POST['order_id'], Yii::app()->params['order_staus']['ASSIGNED']);
//Log :: START 1 => Status
                            $arrModifiedLog['message'] = 'Shop ID ( ' . $_POST['shop_id'] . ' ) :: Delivery Boy ' . $_POST['delivery_boy_id'] . 'Order Status Updated From ACCEPTED TO ASSIGNED.';
                            $this->actionDefault($arrModifiedLog);
//Log :: END
//Notification
                            $this->notification_code = 2;
                            $strOrderNumber = isset($_POST['order_number']) ? $_POST['order_number'] : NULL;
                            $arrNotification = array('order_id' => $_POST['order_id'], 'shop_id' => $_POST['shop_id'], 'delivery_boy_id' => $_POST['delivery_boy_id'], 'notification_code' => $this->notification_code, 'title' => 'New Order From Mechanic', 'role_id' => $_POST['role_id'], 'user_id' => $_POST['delivery_boy_id'], 'location' => $_POST['location'], 'latitude' => $_POST['latitude'], 'longitude' => $_POST['longitude'], 'gcm_register_id' => $arrAssigned['gcm_register_id'], 'notification_type' => 'pick', 'order_number' => $strOrderNumber);
                            $intNotification = $this->actionSaveNotification($arrNotification, $this->notification_code);
//$intNotificationUpdate = PushNotifications::updateNotificationStatus($intNotification, array('status' => 0));
                            unset($arrNotification);
//unset($intNotificationUpdate, $intNotification);
                            unset($intNotification);

                            $arrResponse = array('type' => 'success', 'data' => $intAssign, 'message' => 'Assigned To Delivery Boy', 'code' => 200);
                            unset($arrModifiedLog);
                            unset($intUpdate);
                            unset($intUsersLogId);
                            unset($arrLog);
                            unset($intAssign);
                        } else {
                            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Order Assigned To Him.', 'code' => 300);
                        }
                    } else {
                        $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already This Delivery Boy Have Orders. Please Assign To Some Other.', 'code' => 300);
                    }
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Location is not found.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Delivery Boy Is Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionAccept() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['delivery_boy_id']) && !empty($_POST['delivery_boy_id'])) {
                $arrOrdersData = ShopOrders::isAssigned($_POST['shop_id'], $_POST['order_id']);
                if ((!empty($arrOrdersData) && isset($arrOrdersData['is_accepted']) && 0 == $arrOrdersData['is_accepted'] && (2 == $arrOrdersData['order_status'] || 4 == $arrOrdersData['order_status'])) || (!empty($arrOrdersData) && isset($arrOrdersData['is_completed']) && 1 == $arrOrdersData['is_accepted'] && 0 == $arrOrdersData['is_completed'] && 8 == $arrOrdersData['order_status'])) {
                    $intAccept = ShopOrders::assignOrderToBoy($_POST['shop_id'], $_POST['order_id'], $_POST['delivery_boy_id'], array('is_accepted' => 1));
//Log :: START 1 => Status
                    $objDataManager = new DataManager();
                    $arrLog = array('users_id' => $_POST['delivery_boy_id'], 'role_types_id' => $_POST['role_id'], 'message' => 'Delivery Boy ( ' . $_POST['delivery_boy_id'] . ') ::  Order (' . $_POST['order_id'] . ') Pickup Accepted.', 'device_name' => $_POST['device_name'], 'imei_no' => $_POST['imei_no']);
                    $arrModifiedLog = $objDataManager->makeMobileData($arrLog);
                    $intUsersLogId = $this->actionDefault($arrModifiedLog);
//Log :: END
                    if (isset($arrOrdersData['is_accepted']) && 1 == $arrOrdersData['is_accepted']) {
                        $intUpdate = Orders::updateOrderStatus($_POST['order_id'], Yii::app()->params['order_staus']['DELIVERY_ACCEPTED']);
                    } else {
                        $intUpdate = Orders::updateOrderStatus($_POST['order_id'], Yii::app()->params['order_staus']['PICKUP_ACCEPTED']);
                    }
//Log :: START 1 => Status
                    $arrModifiedLog['message'] = 'Delivery Boy ( ' . $_POST['delivery_boy_id'] . ' ) :: Order Id ' . $_POST['order_id'] . 'Order Status Updated From ASSIGNED TO PICKUP ACCEPTED.';
                    $this->actionDefault($arrModifiedLog);
//Log :: END
                    $arrResponse = array('type' => 'success', 'data' => $intAccept, 'message' => 'Delivery Boy Accepted The Pick UP', 'code' => 200);
                    unset($arrModifiedLog);
                    unset($intUpdate);
                    unset($intUsersLogId);
                    unset($arrLog);
                    unset($intAccept);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already you accepted it', 'code' => 700);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Delivery Boy Is Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionStart() { //collected
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['delivery_boy_id']) && !empty($_POST['delivery_boy_id'])) {
                $arrShopOrderStatus = ShopOrders::model()->shopOrdersStatus($_POST['order_id'], $_POST['delivery_boy_id']);
                if (!empty($arrShopOrderStatus)) {
                    $arrOrderStatusDetails = Orders::model()->orderStatus($_POST['order_id']);
                    if (isset($arrOrderStatusDetails['order_status']) && 12 != $arrOrderStatusDetails['order_status']) {
                        $arrShopOrders = ShopOrders::isAssigned($_POST['shop_id'], $_POST['order_id']);
                        if (!empty($arrShopOrders) && isset($arrShopOrders['is_collected']) && 0 == $arrShopOrders['is_collected']) {
                            $intStart = ShopOrders::assignOrderToBoy($_POST['shop_id'], $_POST['order_id'], $_POST['delivery_boy_id'], array('is_collected' => 1));
//Log :: START 1 => Status
                            $objDataManager = new DataManager();
                            $arrLog = array('users_id' => $_POST['delivery_boy_id'], 'role_types_id' => $_POST['role_id'], 'message' => 'Delivery Boy ( ' . $_POST['delivery_boy_id'] . ') ::  Order (' . $_POST['order_id'] . ') Service ( Collected )Started.', 'device_name' => $_POST['device_name'], 'imei_no' => $_POST['imei_no']);
                            $arrModifiedLog = $objDataManager->makeMobileData($arrLog);
                            $intUsersLogId = $this->actionDefault($arrModifiedLog);
//Log :: END
                            $intUpdate = Orders::updateOrderStatus($_POST['order_id'], Yii::app()->params['order_staus']['STARTED']);
//Log :: START 1 => Status
                            $arrModifiedLog['message'] = 'Delivery Boy ( ' . $_POST['delivery_boy_id'] . ' ) :: Order Id ' . $_POST['order_id'] . 'Order Status Updated From PICKUP ACCEPTED TO STARTED.';
                            $this->actionDefault($arrModifiedLog);
//Log :: END
                            $arrResponse = array('type' => 'success', 'data' => $intStart, 'message' => 'Delivery Boy Collected The Vehicle.', 'code' => 200);
                            unset($arrModifiedLog);
                            unset($intUpdate);
                            unset($intUsersLogId);
                            unset($arrLog);
                            unset($intStart);
                        } else {
                            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Vehicle Collected', 'code' => 300);
                        }
                    } else {
                        $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Order Cancelled By Customer.', 'code' => 300);
                    }
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Order Migrated.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Delivery Boy Is Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionStartRepair() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {

            if (isset($_POST['shop_id']) && !empty($_POST['shop_id'])) {
                $arrShopOrders = ShopOrders::isAssigned($_POST['shop_id'], $_POST['order_id']);
                if (!empty($arrShopOrders) && isset($arrShopOrders['is_started']) && 0 == $arrShopOrders['is_started']) {
                    $intRepairsStart = ShopOrders::assignOrderToBoy($_POST['shop_id'], $_POST['order_id'], NULL, array('is_started' => '1'));
//Log :: START 1 => Status
                    $objDataManager = new DataManager();
                    $arrLog = array('users_id' => $_POST['shop_id'], 'role_types_id' => $_POST['role_id'], 'message' => 'Shop ( ' . $_POST['shop_id'] . ') ::  Order (' . $_POST['order_id'] . ') Shop Started Repairs.', 'device_name' => $_POST['device_name'], 'imei_no' => $_POST['imei_no']);
                    $arrModifiedLog = $objDataManager->makeMobileData($arrLog);
                    $intUsersLogId = $this->actionDefault($arrModifiedLog);
//Log :: END
//$strExpectedDate = $objDataManager->modifyDate($_POST['complete_on_date']);
                    $intUpdate = Orders::updateOrderStatus($_POST['order_id'], Yii::app()->params['order_staus']['REPAIRS_STARTED'], array('order_status' => Yii::app()->params['order_staus']['REPAIRS_STARTED'], 'completed_date' => $_POST['complete_on_date'], 'completed_time' => $_POST['complete_on_time']));
//Log :: START 1 => Status
                    $arrModifiedLog['message'] = 'Shop ( ' . $_POST['shop_id'] . ' ) :: Order Id ' . $_POST['order_id'] . 'Order Status Updated From STARTED to REPAIRS STARTED On' . $_POST['complete_on_date'] . ' at' . $_POST['complete_on_time'];
                    $this->actionDefault($arrModifiedLog);
//Log :: END
                    $arrResponse = array('type' => 'success', 'data' => $intRepairsStart, 'message' => 'Repairs Started By Shop', 'code' => 200);
                    unset($arrModifiedLog);
                    unset($intUpdate);
                    unset($intUsersLogId);
                    unset($arrLog);
                    unset($intRepairsStart);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Service Started By Mechanic Shop.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Shop Is Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionIsRepairsCompleted() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['shop_id']) && !empty($_POST['shop_id'])) {
                if (isset($_POST['delivery_boy_id']) && !empty($_POST['delivery_boy_id'])) {
                    $arrShopOrders = ShopOrders::isAssigned($_POST['shop_id'], $_POST['order_id']);
                    if (!empty($arrShopOrders) && isset($arrShopOrders['is_repairs_completed']) && 0 == $arrShopOrders['is_repairs_completed']) {
                        $intRepairsComplete = ShopOrders::assignOrderToBoy($_POST['shop_id'], $_POST['order_id'], NULL, array('is_repairs_completed' => 1, 'is_repair_delivery_boy' => $_POST['delivery_boy_id']));
//Log :: START 1 => Status
                        $objDataManager = new DataManager();
                        $arrLog = array('users_id' => $_POST['shop_id'], 'role_types_id' => $_POST['role_id'], 'message' => 'Shop ( ' . $_POST['shop_id'] . ') ::  Order (' . $_POST['order_id'] . ') :: Delivery Boy ( ' . $_POST['delivery_boy_id'] . ' ) Shop Completed Repairs And Assigned Delivery Boy.', 'device_name' => $_POST['device_name'], 'imei_no' => $_POST['imei_no']);
                        $arrModifiedLog = $objDataManager->makeMobileData($arrLog);
                        $intUsersLogId = $this->actionDefault($arrModifiedLog);
//Log :: END
                        $strCRN = CommonFunctions::getNumberToken(4);
                        $strCRN = 'DELV-' . $strCRN;
                        //$strDeliveryDate = isset($_POST['delivery_date']) ? $_POST['delivery_date'] : NULL;
                        $strDeliveryDate = date('Y-m-d');
                        //$strDeliveryAt = isset($_POST['delivery_at']) ? $_POST['delivery_at'] : NULL;
                        $strDeliveryAt = date('h:i:s');
                        $intUpdate = Orders::updateOrderStatus($_POST['order_id'], Yii::app()->params['order_staus']['REPAIRS_COMPLETED'], array('order_status' => Yii::app()->params['order_staus']['REPAIRS_COMPLETED'], 'crn' => $strCRN, 'delivery_date' => $strDeliveryDate, 'delivery_at' => $strDeliveryAt));
                        //Update Billing Data :: START
                        if (isset($_POST['extra_items']) && !empty($_POST['extra_items']) && isset($_POST['extra_items_prices']) && !empty($_POST['extra_items_prices'])) {
                            $objDataManager = new DataManager();
                            $arrModifiedAddOns = array();
                            $arrModifiedAddOns = $objDataManager->modifyExtraAddOns(array($_POST['extra_items'], $_POST['extra_items_prices']), $_POST['order_id']);
                            $intInserted = OrderAddOnRepairs::create($arrModifiedAddOns);
                        }
                        $arrBillingDetails = OrdersBilling::getBillingDetails($_POST['order_id']);
                        $arrModifiedBillingDetails = $objDataManager->doBilling($arrBillingDetails, $_POST);
                        $intUpdateBilling = OrdersBilling::updateOrderBillingStatus($_POST['order_id'], $arrModifiedBillingDetails);
                        //Update Billing Data :: END
//Log :: START 1 => Status
                        $arrModifiedLog['message'] = 'Shop ( ' . $_POST['shop_id'] . ' ) :: Order Id ' . $_POST['order_id'] . 'Order Status Updated From REPAIRS STARTED to REPAIRS COMPLETED and Generate the unique crn number for delivery : ' . $strCRN;
                        $this->actionDefault($arrModifiedLog);
//Log :: END
//Notification
                        $this->notification_code = 3;
                        $strOrderNumber = isset($_POST['order_number']) ? $_POST['order_number'] : NULL;
                        $arrNotification = array('order_id' => $_POST['order_id'], 'shop_id' => $_POST['shop_id'], 'delivery_boy_id' => $_POST['delivery_boy_id'], 'role_id' => $_POST['role_id'], 'user_id' => $_POST['shop_id'], 'notification_code' => $this->notification_code, 'title' => 'New Delivery Order From Mechanic', 'notification_type' => 'delivery', 'order_number' => $strOrderNumber);
                        $intNotification = $this->actionSaveNotification($arrNotification, $this->notification_code);

                        $arrResponse = array('type' => 'success', 'data' => $intRepairsComplete, 'message' => 'Repairs Completed By Shop And Assigned A Delivery Boy.', 'code' => 200);
                        unset($arrModifiedLog);
                        unset($intUpdate);
                        unset($intUsersLogId);
                        unset($arrLog);
                        unset($intRepairsComplete);
                        unset($strCRN);
                    } else {
                        $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Service Completed By Mechanic Shop.', 'code' => 300);
                    }
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Delivery Boy Is Not Found.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Shop Is Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionLiveTracking() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInput = $_POST;
            $objDataManager = new DataManager();
            $arrModifiedLiveTracking = $objDataManager->modifyLiveTrackingData($arrInput);
            $arrLiveTracking = $objDataManager->makeMobileData($arrModifiedLiveTracking);
            $intLiveTrack = LiveTracking::create($arrLiveTracking);
            $arrResponse = array('type' => 'success', 'data' => $intLiveTrack, 'message' => 'Tracked User Location.', 'code' => 200);
            unset($intLiveTrack);
            unset($arrLiveTracking);
            unset($arrModifiedLiveTracking);
            unset($arrInput);
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionCollectCRN() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['CRN']) && !empty($_POST['CRN'])) {
                $strCRN = 'DELV-' . $_POST['CRN'];
                $arrOrder = Orders::getCRNDetails($strCRN);
                if (!empty($arrOrder)) {
                    $intIsCompleted = ShopOrders::assignOrderToBoy($_POST['shop_id'], $_POST['order_id'], NULL, array('is_completed' => 1));
                    $intUpdate = Orders::updateOrderStatus($arrOrder['order_id'], NULL, array('order_status' => Yii::app()->params['order_staus']['FINISHED'], 'status' => 1));
                    $arrResponse = array('type' => 'success', 'data' => $intUpdate, 'message' => 'Order Finished.', 'code' => 200);
                    unset($intUpdate);
                    unset($intIsCompleted);
                    unset($arrOrder);
                    unset($strCRN);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Invalid CRN is given.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'CRN Is Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionReject() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['order_id']) && !empty($_POST['order_id']) && isset($_POST['shop_id']) && !empty($_POST['shop_id'])) {
                if (isset($_POST['reasons_id']) && !empty($_POST['reasons_id']) && NULL != $_POST['reasons_id']) {
                    $arrInput = $_POST;
                    $objDataManager = new DataManager();
                    $arrModifiedInput = $objDataManager->makeMobileData($arrInput);
                    $intRejected = ShopOrderRejected::create($arrModifiedInput);
                    $arrResponse = array('type' => 'success', 'data' => $intRejected, 'message' => 'Order Rejected By Shop.', 'code' => 200);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Reason not found.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Shop Id Or Order Id is missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionUpdateLocation() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['shop_id']) && !empty($_POST['shop_id'])) {
                $intUpdate = MechanicShopDetails::updateShopLocation($_POST['shop_id'], array('location' => $_POST['location'], 'longitude' => $_POST['longitude'], 'latitude' => $_POST['latitude'], 'is_first_time' => 1));
                $arrResponse = array('type' => 'success', 'data' => $intUpdate, 'message' => 'Shop Location Updated.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Shop is missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionNotificationManager($intNotificationCode = NULL, $arrInput = NULL) {
        $objDataManager = new DataManager();
        $arrMinMaxLatiLongis = array();
        //if (isset($arrInput['latitude']) && !empty($arrInput['latitude'])) {
        //  $arrMinMaxLatiLongis = $objDataManager->getMinMaxLatiLongis($arrInput['latitude'], $arrInput['longitude']);
        //$arrNotifications = PushNotifications::getNotifications(array('status' => 1, 'notification_code' => $intNotificationCode, 'role_id' => $arrInput['role_id']), $arrMinMaxLatiLongis);
        $arrNotifications = PushNotifications::getNotifications(1, $arrInput['role_id']);
        // } else {
        //$arrNotifications = PushNotifications::getNotifications(array('status' => 1, 'notification_code' => $intNotificationCode, 'role_id' => $arrInput['role_id']), $arrMinMaxLatiLongis);
        //   $arrNotifications = PushNotifications::getNotifications();
        // }
        return $arrNotifications;
    }

    public function actionPushNotification() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            //$arrNotifications = $this->actionNotificationManager($intNotificationCode, $_POST);
            $arrNotifications = $this->actionNotificationManager(NULL, $_POST);
            if (!empty($arrNotifications)) {
                foreach ($arrNotifications as $arrNotify) {
                    $arrHotNotify = array();
                    $arrHotNotify = array(
                        'url' => Yii::app()->params['fcm_mechanic_runner']['secure_url'],
                        'key' => Yii::app()->params['fcm_mechanic_runner']['server_key'],
                        'registration_ids' => $arrNotify['gcm_register_id'],
                        'template' => $arrNotify['message'],
                        'title' => $arrNotify['title'],
                        'notification_type' => $arrNotify['notification_type'],
                    );
                    if (!empty($arrNotify['gcm_register_id'])) {
                        $objFCMManager = new FCMManager($arrHotNotify);
                        $objFCMManager->fireFCM();
                    }
                    unset($arrHotNotify);
                    $intNotificationUpdate = PushNotifications::updateNotificationStatus($arrNotify['notification_id'], array('status' => 0));
                }
            }
            if (!empty($arrNotifications)) {
                $arrResponse = array('type' => 'success', 'data' => $arrNotifications, 'message' => 'New Notification', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Notifications are not found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionSaveNotification($arrInput, $intNotificationCode) {
        $strMessage = 'Yay! A new Pick up/ Delivery order ' . $arrInput['order_number'] . ' has been assigned to you. Click here to view';
        $arrNotification = array('order_id' => $arrInput['order_id'], 'shop_id' => $arrInput['shop_id'], 'delivery_boy_id' => $arrInput['delivery_boy_id'], 'role_id' => $arrInput['role_id'], 'user_id' => $arrInput['user_id'], 'message' => $strMessage, 'status' => 1, 'notification_code' => $arrInput['notification_code'], 'title' => $arrInput['title'], 'location' => isset($arrInput['location']) ? $arrInput['location'] : NULL, 'latitude' => isset($arrInput['latitude']) ? $arrInput['latitude'] : NULL, 'longitude' => isset($arrInput['longitude']) ? $arrInput['longitude'] : NULL, 'notification_type' => $arrInput['notification_type']);
        unset($strMessage);
        $objDataManager = new DataManager();
        $this->notification_code = $intNotificationCode;
        $arrModifiedNotification = $objDataManager->makeMobileData($arrNotification);
        $intNotification = PushNotifications::create($arrModifiedNotification);
        unset($arrNotification, $arrModifiedNotification, $arrInput);
        return $intNotification;
    }

    public function actionOtherAccept() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInput = $_POST;
            $intOrder = $_POST['order_id'];
            if (!empty($intOrder)) {
                $arrOrder = OtherOrders::model()->orderStatus($intOrder, 1);
                $arrShopOrders = ShopOtherOrders::isAssigned($_POST['shop_id'], $intOrder);
                if (!empty($arrOrder)) {
                    if (empty($arrShopOrders)) {
                        if (isset($arrShopOrders['is_accepted']) && 1 == $arrShopOrders['is_accepted']) {
                            $intUpdate = OtherOrders::model()->updateOrderStatus($intOrder, array('order_status' => Yii::app()->params['order_staus']['DELIVERY_ACCEPTED']));
                        } else {
                            $intUpdate = OtherOrders::model()->updateOrderStatus($intOrder, array('order_status' => Yii::app()->params['order_staus']['ACCEPTED']));
                        }
                        if ($intUpdate > 0) {
                            $objDataManager = new DataManager();
                            $arrModifiedInputs = $objDataManager->makeMobileData($arrInput);
                            $intShopOrder = ShopOtherOrders::create($arrModifiedInputs);
                            unset($arrModifiedInputs, $arrOrder, $arrInput);
                            unset($intOrder);
                            $arrResponse = array('type' => 'success', 'data' => $intShopOrder, 'message' => 'Order Accepted By Mechanic Shop.', 'code' => 200);
                        } else {
                            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
                        }
                    } else {
                        $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Order Accepted By Mechanic Shop', 'code' => 300);
                    }
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrOrder, 'message' => 'Already Order Accepted By Other Mechanic Shop.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Order Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionOtherAssign() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['delivery_boy_id']) && !empty($_POST['delivery_boy_id'])) {
                //Check Is any order assigned to delivery boy or not
                $arrDeliveryBoyOrders = ShopOtherOrders::isDeliveryBoyHaveOrders($_POST['delivery_boy_id']);
                $arrAssigned = ShopOtherOrders::isAssigned($_POST['shop_id'], $_POST['order_id'], $_POST['delivery_boy_id']);
                if (empty($arrDeliveryBoyOrders)) {
                    if (empty($arrAssigned)) {
                        $intAssign = ShopOtherOrders::assignOrderToBoy($_POST['shop_id'], $_POST['order_id'], NULL, array('delivery_boys_id' => $_POST['delivery_boy_id']));
                        $intUpdate = OtherOrders::updateOrderStatus($_POST['order_id'], array('order_status' => Yii::app()->params['order_staus']['ASSIGNED']));
                        $arrResponse = array('type' => 'success', 'data' => $intAssign, 'message' => 'Assigned To Delivery Boy', 'code' => 200);
                        unset($intUpdate);
                        unset($intAssign);
                    } else {
                        $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Order Assigned To Him.', 'code' => 300);
                    }
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already This Delivery Boy Have Orders. Please Assign To Some Other.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Delivery Boy Is Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionOtherRunnerAccept() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['delivery_boy_id']) && !empty($_POST['delivery_boy_id'])) {
                $arrOtherOrders = ShopOtherOrders::isAssigned($_POST['shop_id'], $_POST['order_id']);
                if ((!empty($arrOtherOrders) && isset($arrOtherOrders['is_accepted']) && 0 == $arrOtherOrders['is_accepted']) || (!empty($arrOtherOrders) && 1 == $arrOtherOrders['is_accepted'] && isset($arrOtherOrders['is_completed']) && 0 == $arrOtherOrders['is_completed'])) {
                    $intAccept = ShopOtherOrders::assignOrderToBoy($_POST['shop_id'], $_POST['order_id'], $_POST['delivery_boy_id'], array('is_accepted' => 1));
                    if (isset($arrOtherOrders['is_accepted']) && 1 == $arrOtherOrders['is_accepted']) {
                        $intUpdate = OtherOrders::updateOrderStatus($_POST['order_id'], array('order_status' => Yii::app()->params['order_staus']['DELIVERY_ACCEPTED']));
                    } else {
                        $intUpdate = OtherOrders::updateOrderStatus($_POST['order_id'], array('order_status' => Yii::app()->params['order_staus']['PICKUP_ACCEPTED']));
                    }
                    $arrResponse = array('type' => 'success', 'data' => $intAccept, 'message' => 'Delivery Boy Accepted The Pick UP', 'code' => 200);
                    unset($intUpdate);
                    unset($intAccept);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Order Accepted By Runner.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Delivery Boy Is Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionOtherRunnerStart() { //collected
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['delivery_boy_id']) && !empty($_POST['delivery_boy_id'])) {
                $arrShopOrderStatus = ShopOtherOrders::model()->shopOrdersStatus($_POST['order_id'], $_POST['delivery_boy_id']);
                if (!empty($arrShopOrderStatus)) {
                    $arrOtherOrders = ShopOtherOrders::isAssigned($_POST['shop_id'], $_POST['order_id']);
                    if (!empty($arrOtherOrders) && isset($arrOtherOrders['is_collected']) && 0 == $arrOtherOrders['is_collected']) {
                        $objDataManager = new DataManager();
                        if (isset($_POST['repairs_data'])) {
                            $arrDefaults = $objDataManager->getMobileDefaults();
                            $arrModifiedOtherRepairs = $objDataManager->makeMobileOtherOrderRepairs($_POST, $_POST['order_id']);
                            $intRepair = OtherOrdersRepairs::create($arrModifiedOtherRepairs);
                            //Tax
                            $dobuleTax = (($_POST['others_repairs_amount'] * Yii::app()->params['current_tax']) / 100);
                            //Basic
                            $_POST['others_repairs_amount'] = $_POST['others_repairs_amount'] - $dobuleTax;
                            //Final
                            $dobuleFinal = ($_POST['others_repairs_amount'] + $dobuleTax);
                            $arrOrderBilling = array('other_orders_id' => $_POST['order_id'], 'basic' => $_POST['others_repairs_amount'], 'final' => $dobuleFinal, 'tax' => $dobuleTax, 'device_types_id' => 5);
                            $arrOrderBilling = array_merge($arrDefaults, $arrOrderBilling);
                            $intBilling = OtherOrdersBilling::create($arrOrderBilling);
                        }
                        $intStart = ShopOtherOrders::assignOrderToBoy($_POST['shop_id'], $_POST['order_id'], $_POST['delivery_boy_id'], array('is_collected' => 1));
                        $intUpdate = OtherOrders::updateOrderStatus($_POST['order_id'], array('order_status' => Yii::app()->params['order_staus']['STARTED']));
                        $arrResponse = array('type' => 'success', 'data' => $intStart, 'message' => 'Delivery Boy Collected The Vehicle.', 'code' => 200);
                        unset($intUpdate, $intRepair, $intStart, $intBilling);
                        unset($arrModifiedOtherRepairs);
                    } else {
                        $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Vehicle Collected By Runner.', 'code' => 300);
                    }
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Order is Migrated.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Delivery Boy Is Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionRunnerComplete() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['delivery_boy_id']) && !empty($_POST['delivery_boy_id'])) {
                $intComplete = ShopOtherOrders::assignOrderToBoy($_POST['shop_id'], $_POST['order_id'], $_POST['delivery_boy_id'], array('is_completed' => 1));
                $intUpdate = OtherOrders::updateOrderStatus($_POST['order_id'], Yii::app()->params['order_staus']['COMPLETED'], array('order_status' => Yii::app()->params['order_staus']['COMPLETED'], 'completed_date' => $_POST['completed_date'], 'completed_time' => $_POST['completed_time']));
                $arrResponse = array('type' => 'success', 'data' => $intComplete, 'message' => 'Delivery Boy Completed The Service', 'code' => 200);
                unset($intUpdate);
                unset($intComplete);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Delivery Boy Is Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionOtherStartRepair() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['shop_id']) && !empty($_POST['shop_id'])) {
                $arrOtherOrders = ShopOtherOrders::isAssigned($_POST['shop_id'], $_POST['order_id']);
                if (!empty($arrOtherOrders) && isset($arrOtherOrders['is_started']) && 0 == $arrOtherOrders['is_started']) {
                    $intRepairsStart = ShopOtherOrders::assignOrderToBoy($_POST['shop_id'], $_POST['order_id'], NULL, array('is_started' => '1'));
                    $intUpdate = OtherOrders::updateOrderStatus($_POST['order_id'], array('order_status' => Yii::app()->params['order_staus']['REPAIRS_STARTED'], 'completed_date' => $_POST['complete_on_date'], 'completed_time' => $_POST['complete_on_time']));
                    $arrResponse = array('type' => 'success', 'data' => $intRepairsStart, 'message' => 'Repairs Started By Shop', 'code' => 200);
                    unset($intUpdate);
                    unset($intRepairsStart);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Repairs Started By Mechanic Shop.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Shop Is Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionIsOtherRepairsCompleted() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['shop_id']) && !empty($_POST['shop_id'])) {
                if (isset($_POST['delivery_boy_id']) && !empty($_POST['delivery_boy_id'])) {
                    $arrOtherOrders = ShopOtherOrders::isAssigned($_POST['shop_id'], $_POST['order_id']);
                    if (!empty($arrOtherOrders) && isset($arrOtherOrders['is_repairs_completed']) && 0 == $arrOtherOrders['is_repairs_completed']) {
                        $intRepairsComplete = ShopOtherOrders::assignOrderToBoy($_POST['shop_id'], $_POST['order_id'], NULL, array('is_repairs_completed' => 1, 'is_repair_delivery_boy' => $_POST['delivery_boy_id']));
                        $strCRN = CommonFunctions::getNumberToken(4);
                        $strCRN = 'DELV-' . $strCRN;
                        //$strDeliveryDate = isset($_POST['delivery_date']) ? $_POST['delivery_date'] : NULL;
                        $strDeliveryDate = date('Y-m-d');
                        //$strDeliveryAt = isset($_POST['delivery_at']) ? $_POST['delivery_at'] : NULL;
                        $strDeliveryAt = date('h:i:s');
                        $intUpdate = OtherOrders::updateOrderStatus($_POST['order_id'], array('order_status' => Yii::app()->params['order_staus']['REPAIRS_COMPLETED'], 'crn' => $strCRN, 'delivery_date' => $strDeliveryDate, 'delivery_at' => $strDeliveryAt));
                        $arrResponse = array('type' => 'success', 'data' => $intRepairsComplete, 'message' => 'Repairs Completed By Shop And Assigned A Delivery Boy.', 'code' => 200);
                        unset($intUpdate);
                        unset($intRepairsComplete);
                        unset($strCRN);
                    } else {
                        $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Repairs Completed By Mechanic Shop.', 'code' => 300);
                    }
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Delivery Boy Is Not Found.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Shop Is Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionOtherReject() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['order_id']) && !empty($_POST['order_id']) && isset($_POST['shop_id']) && !empty($_POST['shop_id'])) {
                if (isset($_POST['reasons_id']) && !empty($_POST['reasons_id'])) {
                    $arrInput = $_POST;
                    $objDataManager = new DataManager();
                    $arrModifiedInput = $objDataManager->makeMobileData($arrInput);
                    $intRejected = ShopOtherOrderRejected::create($arrModifiedInput);
                    $arrResponse = array('type' => 'success', 'data' => $intRejected, 'message' => 'Order Rejected By Shop.', 'code' => 200);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Reason not found.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Shop Id Or Order Id is missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionRepairList() {
        $arrResponse = array();
        $arrPartialFinal = array();
        $intVehicleType = isset($_POST['vehicle_types_id']) ? $_POST['vehicle_types_id'] : 0;
        $arrRepairs = RepairsLists::getVehicleRepairs(1, $intVehicleType);
        $arrRepairsList = RepairsLists::getRepairsList();
        $objDataManager = new DataManager();
        $arrModifiedRepairsList = $objDataManager->prepareRepairsList($arrRepairsList);
        foreach ($arrRepairs as $eleKey => $eleRepair) {
            if (isset($arrModifiedRepairsList[$eleRepair['repairs_lists_id']])) {
                $arrRepairs[$eleKey]['repairListName'] = $arrModifiedRepairsList[$eleRepair['repairs_lists_id']];
            }
        }
        $arrModifiedRepairs = $objDataManager->modifyRepairsList($arrRepairs);
        foreach ($arrModifiedRepairs as $key => $value) {
            $arrPartialFinal[$key]['category'] = $key;
            $arrPartialFinal[$key][$key] = $value;
        }
        $arrFinalRepairs['total_amount'] = 0.00;
        $arrFinalRepairs['repairs'] = array_values($arrPartialFinal);
        $arrResponse = array('type' => 'success', 'data' => $arrFinalRepairs, 'message' => 'Repairs List', 'code' => 200);
        unset($arrRepairs, $arrRepairsList, $arrModifiedRepairsList, $arrFinalRepairs);
        $this->renderJSON($arrResponse);
    }

    public function actionOtherCollectCRN() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['CRN']) && !empty($_POST['CRN'])) {
                $strCRN = 'DELV-' . $_POST['CRN'];
                $arrOrder = OtherOrders::getCRNDetails($strCRN);
                if (!empty($arrOrder)) {
                    $intIsCompleted = ShopOtherOrders::assignOrderToBoy($_POST['shop_id'], $_POST['order_id'], NULL, array('is_completed' => 1));
                    $intUpdate = OtherOrders::updateOrderStatus($arrOrder['order_id'], array('order_status' => Yii::app()->params['order_staus']['FINISHED'], 'status' => 1));
                    $arrResponse = array('type' => 'success', 'data' => $intUpdate, 'message' => 'Order Finished.', 'code' => 200);
                    unset($intUpdate);
                    unset($intIsCompleted);
                    unset($arrOrder);
                    unset($strCRN);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Invalid CRN is given.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'CRN Is Not Found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionMechanicHistory() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['mechanic_id']) && !empty($arrInputs['mechanic_id'])) {
                $arrOrders = Orders::model()->getMechanicHistory($arrInputs['mechanic_id']);
                $arrResponse = array('type' => 'success', 'data' => $arrOrders, 'message' => 'Shop Orders List.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Mechanic Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionMechanicOthersHistory() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['mechanic_id']) && !empty($arrInputs['mechanic_id'])) {
                $arrOrders = OtherOrders::otherOrdersHistory($arrInputs['mechanic_id']);
                $arrResponse = array('type' => 'success', 'data' => $arrOrders, 'message' => 'Other Orders List.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Mechanic Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionIsClosed() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $intClosed = NULL;
            $arrOrder = array();
            if (isset($_POST['is_other']) && isset($_POST['order_id']) && !empty($_POST['order_id'])) {
                if (0 == $_POST['is_other']) {
                    $arrOrder = Orders::orderInfo(NULL, $_POST['order_id']);
                    $intClosed = ShopOrders::model()->updateOrderStatus($_POST['order_id'], array('is_closed' => 1));
                } elseif (1 == $_POST['is_other']) {
                    $arrOrder = OtherOrders::OtherOrderInfo($_POST['order_id']);
                    $intClosed = ShopOtherOrders::model()->updateOrderStatus($_POST['order_id'], array('is_closed' => 1));
                }
                if (!empty($arrOrder)) {
                    $this->actionSendOtherService(array('other_mobile' => $arrOrder['customer_phone'], 'first_name' => $arrOrder['customer_primary_fullname'], 'order_number' => $arrOrder['order_number']));
                }
                if (!empty($intClosed)) {
                    $arrResponse = array('type' => 'success', 'data' => $intClosed, 'message' => 'Order Is Closed.', 'code' => 200);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
                }
                unset($intClosed);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Order Id or Is Other Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionMigrateOrder() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['previous_runner_id']) && !empty($arrInputs['previous_runner_id'])) {
                if (isset($arrInputs['current_runner_id']) && !empty($arrInputs['current_runner_id']) && isset($arrInputs['order_id']) && !empty($arrInputs['order_id'])) {
                    if (isset($arrInputs['is_other']) && empty($arrInputs['is_other'])) {
                        $arrOrders = ShopOrders::model()->shopOrdersStatus($arrInputs['order_id']);
                    } else {
                        $arrOrders = ShopOtherOrders::model()->shopOrdersStatus($arrInputs['order_id']);
                    }
                    if (isset($arrOrders['is_collected']) && 0 == $arrOrders['is_collected']) {
                        $objDataManager = new DataManager();
                        $arrInputs['previous_runner_id'] = $arrOrders['delivery_boys_id'];
                        $arrModifiedInputs = $objDataManager->modifyMigration($arrInputs);
                        if (isset($arrInputs['is_other']) && empty($arrInputs['is_other'])) {
                            $intUpdateShopOrder = ShopOrders::updateOrderStatus($arrInputs['order_id'], $arrModifiedInputs);
                        } else {
                            $intUpdateShopOrder = ShopOtherOrders::updateOrderStatus($arrInputs['order_id'], $arrModifiedInputs);
                        }

                        $arrResponse = array('type' => 'success', 'data' => $intUpdateShopOrder, 'message' => 'Changed Runner Successfully.', 'code' => 200);
                    } else {
                        $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Order is already collected by other runner.', 'code' => 300);
                    }
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Current Runner Or Order Is Missed.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Previous Runner Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionSendOtherService($arrOther, $intSign = 0) {
        $strSMSToken = NULL;
        $arrSmsData = Yii::app()->params['sms'];
        $objDataManager = new DataManager();
        $arrCustomer = array();
        $arrCustomer['mobile'] = $arrOther['other_mobile'] . ',' . Yii::app()->params['customer_info']['admin_mobile'];
        $arrCustomer['message'] = $objDataManager->getCloseTemplate($arrOther);
        $arrSmsData = array_merge($arrSmsData, $arrCustomer);
        $objectSMSManager = new SMSManager($arrSmsData);
        $strSMSToken = $objectSMSManager->fireSMS();
        return $strSMSToken;
    }

}
