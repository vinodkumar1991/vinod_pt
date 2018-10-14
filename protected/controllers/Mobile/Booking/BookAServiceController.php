<?php

/**
 * @author Digital Today
 * @access public
 * @ignore It will handle booking operations
 */
class BookAServiceController extends Controller {

    public $notification_code = NULL;
    public $latest_push_notification_id = NULL;

    /**
     * @author Digital Today
     * @access public 
     * @return object It will return vehicle types
     */
    public function actionVehicles() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrVehicles = VehicleTypes::getVehicleTypes();
            $arrResponse = array('type' => 'success', 'data' => $arrVehicles, 'message' => 'Vehicle Types', 'code' => 200);
            unset($arrVehicles);
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    /**
     * @author Digital Today
     * @access public
     * @return object It will return car brands
     */
    public function actionBookACar() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $intVehicleType = 1;
            $strVehicleName = 'Car';
            $intStatus = 1;
            $strVehicleBrandPath = '/cars/mobile/brands/120X80/';
            $arrVehicle = $this->getVehicleDetails($intVehicleType, $intStatus);
            $arrVehicleBrands = $this->modifyVehicleDetails($arrVehicle, $intVehicleType, $strVehicleName, $strVehicleBrandPath);
            $arrResponse = array('type' => 'success', 'data' => $arrVehicleBrands, 'message' => 'Vehicle Car Brands', 'code' => 200);
            unset($arrVehicleBrands, $arrVehicle);
            unset($intVehicleType, $strVehicleName, $intStatus, $strVehicleBrandPath);
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    /**
     * @author Digital Today
     * @access public
     * @return object It will return bike brands
     */
    public function actionBookABike() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $intVehicleType = 2;
            $strVehicleName = 'Bike';
            $intStatus = 1;
            $strVehicleBrandPath = '/bikes/mobile/brands/120X80/';
            $arrVehicle = $this->getVehicleDetails($intVehicleType, $intStatus);
            $arrVehicleBrands = $this->modifyVehicleDetails($arrVehicle, $intVehicleType, $strVehicleName, $strVehicleBrandPath);
            $arrResponse = array('type' => 'success', 'data' => $arrVehicleBrands, 'message' => 'Vehicle Bike Brands', 'code' => 200);
            unset($arrVehicleBrands, $arrVehicle);
            unset($intVehicleType, $strVehicleName, $intStatus, $strVehicleBrandPath);
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    /**
     * @author Digital Today
     * @param integer $intVehicleType
     * @param integer $intStatus
     * @return array It will return vehicle wise brands and services
     */
    private function getVehicleDetails($intVehicleType, $intStatus) {
        $arrVehicle = array();
        $arrVehicle['vehicleBrands'] = VehicleBrands::getVehicleBrands($intStatus, $intVehicleType);
        $arrVehicle['serviceTypes'] = VehicleServiceTypes::getServiceTypes($intStatus, $intVehicleType);
        return $arrVehicle;
    }

    /**
     * @author Digital Today
     * @param array $arrVehicle
     * @param integer $intVehicle
     * @param string $strVehicle
     * @param string $strVehicleBrandPath
     * @return array It will modify vehicle brands data
     */
    private function modifyVehicleDetails($arrVehicle, $intVehicle, $strVehicle, $strVehicleBrandPath) {
        $arrModifiedBrands = array();
        if (!empty($arrVehicle['vehicleBrands'])) {
            foreach ($arrVehicle['vehicleBrands'] as $arrBrand) {
                $arrModifiedBrands[] = array_merge($arrBrand, array('vehicle_id' => $intVehicle, 'vehicle_name' => $strVehicle, 'path' => $strVehicleBrandPath)
                );
            }
            unset($arrVehicle);
            unset($intVehicle, $strVehicle, $strVehicleBrandPath);
        }
        return $arrModifiedBrands;
    }

    /**
     * @author Digital Today
     * @return object It will return vehicle wise models
     */
    public function actionModels() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['brand_id']) && isset($_POST['vehicle_id']) && !empty($_POST['vehicle_id']) && !empty($_POST['brand_id'])) {
                $intBrand = $_POST['brand_id'];
                $intVehicle = $_POST['vehicle_id'];
                $strVehicleModelPath = '/cars/mobile/models/120X70/';
                $strVehicleOriginalModelPath = '/cars/mobile/models/original/';
                $strVehicle = 'Car';
                if (2 == $intVehicle) {
                    $strVehicleModelPath = '/bikes/mobile/models/120X70/';
                    $strVehicleOriginalModelPath = '/bikes/mobile/models/original/';
                    $strVehicle = 'Bike';
                }

                $arrModels = VehicleBrandModels::getVehicleBrandModels($intBrand);
                $arrVehicleModels = $this->modifyBrandModels($arrModels, $strVehicle, $intVehicle, $strVehicleModelPath, $strVehicleOriginalModelPath);
                $arrResponse = array('type' => 'success', 'data' => $arrVehicleModels, 'message' => $strVehicle . ' Models', 'code' => 200);
            }
            unset($arrModels, $arrVehicleModels);
            unset($intBrand, $intVehicle, $strVehicleModelPath, $strVehicle);
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    /**
     * @author Digital Today
     * @param array $arrModels
     * @param integer $intVehicle
     * @param string $strVehicle
     * @param string $strVehicleModelPath
     * @return array It will modify vehicle models data
     */
    private function modifyBrandModels($arrModels, $strVehicle, $intVehicle, $strVehicleModelPath, $strVehicleOriginalModelPath) {
        $arrModifiedModels = array();
        if (!empty($arrModels)) {
            foreach ($arrModels as $arrEleModel) {
                $arrModifiedModels[] = array_merge($arrEleModel, array('vehicle_id' => $intVehicle, 'vehicle_name' => $strVehicle, 'path' => $strVehicleModelPath, 'original_model_path' => $strVehicleOriginalModelPath)
                );
            }
            unset($arrModels);
            unset($strVehicle, $intVehicle, $strVehicleModelPath);
        }

        return $arrModifiedModels;
    }

    /**
     * @author Digital Today
     * @return object It will return latest inserted id of added vehicle
     */
    public function actionCreateVehicle() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            $arrCustomerDet = Customer::getCustomer(NULL, $arrInputs['customer_id']);
            if (!empty($arrCustomerDet)) {
                $objDataManager = new DataManager();
                $arrNewVehicle = $objDataManager->modifyVehicleData($arrInputs);
                $intNewVehicleId = CustomerAddVehicles::create($arrNewVehicle);
                $arrResponse = array('type' => 'success', 'data' => $intNewVehicleId, 'message' => 'Vehicle Added Successfully.', 'code' => 200);
                unset($intNewVehicleId);
                unset($arrNewVehicle, $arrInputs);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Customer Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    /**
     * @author Digital Today
     * @return object It will return added vehicles list of customer
     */
    public function actionGetAddedVehicles() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['customer_id']) && !empty($_POST['customer_id'])) {
                $intStatus = 1;
                $intCustomer = $_POST['customer_id'];
                $arrAddedVehicles = CustomerAddVehicles::getAddedVehicles($intStatus, $intCustomer);
                $arrResponse = array('type' => 'success', 'data' => $arrAddedVehicles, 'message' => 'Added Vehicles Report.', 'code' => 200);
                unset($arrAddedVehicles);
                unset($intStatus, $intCustomer);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    /**
     * @author Digital Today
     * @return object It will return vehicle services
     */
    public function actionGetVehicleServices() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['vehicle_id'])) {
                $intStatus = 1;
                $intVehicle = $_POST['vehicle_id'];
                $strServiceIconPath = '/services_categories/';
                $arrVehicleServices = VehicleServiceTypes::getServiceTypes($intStatus, $intVehicle, 1);
                $arrResponse = array('type' => 'success', 'service_icon_path' => $strServiceIconPath, 'data' => $arrVehicleServices, 'message' => 'Vehicle Services.', 'code' => 200);
                unset($arrVehicleServices);
                unset($intStatus, $intVehicle, $strServiceIconPath);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    /**
     * @author Digital Today
     * @return object It will return vehicle service plans data
     */
    public function actionPlans() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['service_id']) && isset($_POST['vehicle_id'])) {
                $intServiceType = $_POST['service_id'];
                $intVehicle = $_POST['vehicle_id'];
                $arrPlans = ServicePlans::getServicePlans($intVehicle, $intServiceType);
                $arrResponse = array('type' => 'success', 'data' => $arrPlans, 'message' => 'Vehicle Service Plans', 'code' => 200);
                unset($arrPlans);
                unset($intServiceType, $intVehicle);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    /**
     * @author Digital Today
     * @return object It will return repairs list
     */
    public function actionRepairs() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['brand_id']) && !empty($_POST['brand_id']) && isset($_POST['model_id']) && !empty($_POST['model_id'])) {
                $int_brand = $_POST['brand_id'];
                $int_model = $_POST['model_id'];
                $int_vehicle = $_POST['vehicle_id'];
                $int_plan = $_POST['plan_id'];
                $int_service = $_POST['service_id'];
//Get Vehicle Brand Model Category
                $int_category = Vehicles::getVehicleCategory($int_brand, $int_model);
                $arrServicePackage = ServicePlans::getServicePackages($int_vehicle, $int_service, $int_plan, 1, $int_category);
//Get Repairs List
                $arrRepairs = VehicalCategoryRepairsAmount::getVehicleRepairs($int_category, $int_vehicle, $int_plan);
//Modified Repairs Data
                $arrModifiedRepairs = $this->modifyRepairsData($arrRepairs, $int_category, $arrServicePackage, $int_service);
                $arrResponse = array('type' => 'success', 'data' => $arrModifiedRepairs, 'message' => 'Repairs Data', 'code' => 200);
                unset($arrRepairs, $arrModifiedRepairs);
                unset($int_brand, $int_model, $int_vehicle, $int_plan, $int_service, $int_category);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Brand or Model is missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    /**
     * @author Digital Today
     * @param array $arrRepairs
     * @param integer $intVehicleCategoryId
     * @return array It will return modified repairs data
     */
    private function modifyRepairsData($arrRepairs, $intVehicleCategoryId, $arrServicePackage, $int_service) {
        $arrFinalRepairs = array();
        $arrPartialFinal = array();
        $doubleCost = 0.00;
        $arrModifiedRepairs = array();
        $arrRepairsList = RepairsLists::getRepairsList();
        $objDataManager = new DataManager();
        $arrModifiedRepairsList = $objDataManager->prepareRepairsList($arrRepairsList);
        if (!empty($arrRepairs)) {
            foreach ($arrRepairs as $eleKey => $eleRepair) {
                if (isset($arrModifiedRepairsList[$eleRepair['repairs_lists_id']])) {
                    $arrRepairs[$eleKey]['repairListName'] = $arrModifiedRepairsList[$eleRepair['repairs_lists_id']];
                }
            }
            foreach ($arrRepairs as $subArrRepair) {
                if ((1 == $subArrRepair['is_recommended'] && 2 == $int_service) || (1 == $subArrRepair['is_recommended'] && 3 == $int_service)) {
                    $doubleCost = $doubleCost + $subArrRepair['cost'];
                } else if (2 != $int_service && 3 != $int_service) {
                    $doubleCost = $doubleCost + $subArrRepair['cost'];
                }
                $arrModifiedRepairs[$subArrRepair['repairName']][] = array(
                    'cost' => $subArrRepair['cost'],
                    'repairId' => $subArrRepair['repairId'],
                    'repairs_lists_id' => $subArrRepair['repairs_lists_id'],
                    'repairName' => $subArrRepair['repairName'],
                    'repairListName' => isset($subArrRepair['repairListName']) ? $subArrRepair['repairListName'] : NULL,
                    'id' => $subArrRepair['id'],
                    'is_recommended' => $subArrRepair['is_recommended'],
                    'plan_id' => $subArrRepair['planId'],
                    'vehicle_type_id' => $subArrRepair['vehicleTypeId'],
                    'vehicle_category_id' => $intVehicleCategoryId,
                    'service_unique_id' => 'per_isr',
                );
            }
            unset($arrRepairs, $arrModifiedRepairsList, $arrRepairsList);
            $intIsPackage = Yii::app()->params['is_package'][$int_service];
            if (1 == $intIsPackage) {
                $arrFinalRepairs['total_amount'] = isset($arrServicePackage['package_amount']) ? $arrServicePackage['package_amount'] : $doubleCost;
            } else {
                $arrFinalRepairs['total_amount'] = $doubleCost;
            }
            $arrFinalRepairs['total_amount'] = round($arrFinalRepairs['total_amount'], 2);
            unset($doubleCost);
            $arrFinalRepairs['estimated_hours'] = '2-4 hours'; //Need to change
            foreach ($arrModifiedRepairs as $key => $value) {
                $arrPartialFinal[$key]['category'] = $key;
                $arrPartialFinal[$key][$key] = $value;
            }
            $arrFinalRepairs['repairs'] = array_values($arrPartialFinal);
        }
        unset($arrPartialFinal);
        return $arrFinalRepairs;
    }

    /**
     * @author Digital Today
     * @return object It will return mechanic shops details
     */
    public function actionMechanicShops($arrayInput) {
        $objDataManager = new DataManager();
        $arrLatiLongis = $objDataManager->getMinMaxLatiLongis($arrayInput['latitude'], $arrayInput['longitude']);
        $arrShops = MechanicShops::getMechanicShops($arrayInput['vehicle_id'], $arrayInput['service_id'], 1, $arrLatiLongis);
        return $arrShops;
    }

    /**
     * @author Digital Today
     * @return object It will return mechanic shops locations with order number and order id
     */
    public function actionBook() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrBook = $_POST;
            $arrMechanicInput = array(
                'vehicle_id' => $arrBook['vehicle_id'],
                'service_id' => $arrBook['service_id'],
                'latitude' => $arrBook['latitude'],
                'longitude' => $arrBook['longitude']
            );
//Get Mechanic Shops
            $arrMechanicShops = $this->actionMechanicShops($arrMechanicInput);
            unset($arrMechanicInput);
//Vehicle Category Id
            $intVehicleCategoryId = Vehicles::getVehicleCategory($_POST['brand_id'], $_POST['model_id']);
            $arrBook['vehicle_category_id'] = $intVehicleCategoryId;
            $objDataManager = new DataManager();
//Transaction :: START
            $objectTransaction = Yii::app()->db->beginTransaction();
//Orders
            $arrOrders = $objDataManager->makeMobileOrders($arrBook);
            $strOrderNumber = isset($arrOrders['order_number']) ? $arrOrders['order_number'] : NULL;
            $intOrderId = Orders::create($arrOrders);
            unset($arrOrders);

//Orders Coomunication
            $arrCustomer = Customer::getCustomer(NULL, $arrBook['customer_id']);
            $arrOrdersCommunication = $objDataManager->makeMobileOrderCommunications($arrBook, $intOrderId, $arrCustomer);
            $intOrderCommunication = OrdersCommunication::create($arrOrdersCommunication);
            unset($arrOrdersCommunication);


//Orders Billing
            $arrOrderBilling = $objDataManager->makeMobileOrderBilling($arrBook, $intOrderId);
            $intOrderBilling = OrdersBilling::create($arrOrderBilling);
            unset($arrOrderBilling);

//Orders Repairs
            $intOrderRepair = $intOrderBilling;
            //$arrOrderRepairs = $objDataManager->makeMobileOrderRepairs($arrBook, $intOrderId);
            //$intOrderRepair = OrdersRepairs::create($arrOrderRepairs);
            //unset($arrOrderRepairs);
//Push Notification
            $this->notification_code = 1; //1 => For New Order
            $arrNotification = array('order_id' => $intOrderId, 'order_number' => $strOrderNumber, 'notification_code' => 1, 'title' => 'New Order', 'role_id' => $_POST['role_id'], 'location' => $arrBook['location'], 'latitude' => $arrBook['latitude'], 'longitude' => $arrBook['longitude'], 'gcm_register_id' => $arrCustomer['gcm_register_id'], 'notification_type' => 'new');
            $intNotification = $this->actionSaveNotification($arrNotification, $arrMechanicShops);
            $this->latest_push_notification_id = $intNotification;
//$intNotificationUpdate = PushNotifications::updateNotificationStatus($intNotification, array('status' => 0));
            unset($arrNotification);
//unset($intNotificationUpdate, $intNotification);
            $this->actionSendOtherService(array('order_number' => $strOrderNumber, 'other_mobile' => $arrCustomer['phone'], 'customer_name' => $arrCustomer['first_name']), 4);
            unset($arrBook);
            if (!empty($intOrderRepair)) {
                $objectTransaction->commit();
            } else {
                $objectTransaction->rollback();
            }
            $arrResponse = array('order_id' => $intOrderId, 'order_number' => $strOrderNumber, 'mechanic_shops' => $arrMechanicShops);
            unset($intOrderId, $strOrderNumber);
            unset($arrMechanicShops, $arrCustomer);
            $arrResponse = array('type' => 'success', 'data' => $arrResponse, 'message' => 'Order Booked Successfully.', 'code' => 200);
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    /**
     * @author Digital Today
     * @return object It will return the status of an order
     */
    public function actionIsAccepted() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['is_other']) && 1 == $_POST['is_other']) {
                $arrOrder = OtherOrders::model()->orderStatus($_POST['order_id'], Yii::app()->params['order_staus']['ACCEPTED']);
            } else {
                $arrOrder = Orders::model()->orderStatus($_POST['order_id'], Yii::app()->params['order_staus']['ACCEPTED']);
            }
            sleep(2);
            if (!empty($arrOrder)) {
                $arrReasons = Reasons::getReasons(1, 1);
                if (isset($_POST['is_other']) && 1 == $_POST['is_other']) {
                    $arrShopDetails = ShopOtherOrders::model()->getShopDetails($_POST['order_id']);
                } else {
                    $arrShopDetails = ShopOrders::model()->getShopDetails($_POST['order_id']);
                }
                $arrResponse = array('type' => 'success', 'data' => $arrShopDetails, 'reasons' => $arrReasons, 'message' => 'Order Accepted By Mechanic Shop.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Waiting for a mechanic...', 'code' => 500);
            }
            unset($arrOrder);
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionIsDeliveryAccepted() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
                if (isset($_POST['is_other']) && 1 == $_POST['is_other']) {
                    $arrOrder = ShopOtherOrders::getOrderStatus($_POST['order_id'], Yii::app()->params['order_staus']['PICKUP_ACCEPTED']);
                } else {
                    $arrOrder = ShopOrders::getOrderStatus($_POST['order_id'], Yii::app()->params['order_staus']['PICKUP_ACCEPTED']);
                }
                sleep(2);
                if (!empty($arrOrder)) {
                    if (isset($_POST['is_other']) && 1 == $_POST['is_other']) {
                        $arrDeliveryBoyDetails = DeliveryBoys::getRunnerDetails($_POST['order_id']);
                    } else {
                        $arrDeliveryBoyDetails = DeliveryBoys::getDeliveryBoyDetails($_POST['order_id']);
                    }
                    $arrResponse = array('type' => 'success', 'data' => $arrDeliveryBoyDetails, 'message' => 'Order Accepted By Delivery Boy.', 'code' => 200);
                    unset($arrDeliveryBoyDetails);
                    unset($arrOrder);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrOrder, 'message' => 'Waiting for a delivery boy...', 'code' => 500);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Order Id Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionIsServiceStarted() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
                if (isset($_POST['is_other']) && 1 == $_POST['is_other']) {
                    $arrOrder = ShopOtherOrders::getOrderStatus($_POST['order_id'], Yii::app()->params['order_staus']['REPAIRS_STARTED']);
                } else {
                    $arrOrder = ShopOrders::getOrderStatus($_POST['order_id'], Yii::app()->params['order_staus']['REPAIRS_STARTED']);
                }
                sleep(2);
                if (isset($_POST['is_other']) && 1 == $_POST['is_other']) {
                    $arrDeliveryBoyDetails = DeliveryBoys::getRunnerDetails($_POST['order_id']);
                } else {
                    $arrDeliveryBoyDetails = DeliveryBoys::getDeliveryBoyDetails($_POST['order_id']);
                }
                $arrLiveDetails = LiveTracking::getLatestLongiLatis($arrDeliveryBoyDetails['delivery_boy_id'], 5);
                if (!empty($arrLiveDetails)) {
                    $arrDeliveryBoyDetails = array_merge($arrDeliveryBoyDetails, $arrLiveDetails);
                }
                if (!empty($arrOrder)) {
//$arrDeliveryBoyDetails = DeliveryBoys::getDeliveryBoyDetails($_POST['order_id']);
//$arrResponse = array('type' => 'success', 'data' => $arrDeliveryBoyDetails, 'message' => 'Delivery Boy Is Ready To Deliver The Vehicle.', 'code' => 200);
                    $arrResponse = array('type' => 'success', 'data' => $arrOrder, 'message' => 'Delivery Boy Is Ready To Deliver The Vehicle.', 'code' => 200);
//unset($arrDeliveryBoyDetails);
                    unset($arrOrder);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrDeliveryBoyDetails, 'message' => 'Waiting for vehicle delivery...', 'code' => 500);
                    unset($arrDeliveryBoyDetails);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Order Id Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionIsServiceFinished() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
                if (isset($_POST['is_other']) && 1 == $_POST['is_other']) {
                    $arrOrder = ShopOtherOrders::getOrderStatus($_POST['order_id'], Yii::app()->params['order_staus']['REPAIRS_COMPLETED']);
                } else {
                    $arrOrder = ShopOrders::getOrderStatus($_POST['order_id'], Yii::app()->params['order_staus']['REPAIRS_COMPLETED']);
                }
                sleep(2);
                if (!empty($arrOrder)) {
                    if (isset($_POST['is_other']) && 1 == $_POST['is_other']) {
                        $arrDeliveryBoyDetails = DeliveryBoys::getRunnerDetails($_POST['order_id']);
                    } else {
                        $arrDeliveryBoyDetails = DeliveryBoys::getDeliveryBoyDetails($_POST['order_id']);
                    }
                    $arrResponse = array('type' => 'success', 'data' => $arrDeliveryBoyDetails, 'message' => 'Delivery Boy Is Ready To Deliver The Vehicle.', 'code' => 200);
                    unset($arrDeliveryBoyDetails);
                    unset($arrOrder);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrOrder, 'message' => 'Waiting for vehicle delivery...', 'code' => 500);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Order Id Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionBookOther() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInput = $_POST;
            $arrModifiedExclusive = array();
            $strCustomSolider = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $strOrderNumber = CommonFunctions::getCustomToken($strCustomSolider, 6);
            $arrModifiedExclusive['order_number'] = $strOrderNumber;
            $arrModifiedExclusive['vehicle_type'] = $arrInput['vehicle_id'];
            $arrModifiedExclusive['brand_id'] = $arrInput['brand_id'];
            $arrModifiedExclusive['model_id'] = $arrInput['model_id'];
            $arrModifiedExclusive['service_id'] = $arrInput['service_id'];
            $arrModifiedExclusive['is_exclusive'] = 0;
            $arrModifiedExclusive['other_mobile'] = $arrInput['other_mobile'];
            $arrModifiedExclusive['other_name'] = $arrInput['other_name'];
            $arrModifiedExclusive['service_name'] = $arrInput['service_name'];
            $arrModifiedExclusive['additional_information'] = isset($arrInput['description']) ? $arrInput['description'] : NULL;
            $arrModifiedExclusive['location'] = $arrInput['location'];
            $arrModifiedExclusive['booked_date'] = $arrInput['booked_date'];
            $arrModifiedExclusive['booked_time'] = $arrInput['booked_time'];
            $arrModifiedExclusive['lati_longitude'] = $arrInput['latitude'] . ',' . $arrInput['longitude'];
            $arrModifiedExclusive['device_name'] = $arrInput['device_name'];
            $arrModifiedExclusive['customer_id'] = $arrInput['customer_id'];
            $arrModifiedExclusive['added_vehicles_id'] = $arrInput['added_vehicle_id'];
//Combine Defaults
            $objDataManager = new DataManager();
            $arrExclusive = $objDataManager->makeMobileData($arrModifiedExclusive);
//other_orders
            $intOtherOrder = OtherOrders::create($arrExclusive);
//Send SMS
            $strSMSToken = $this->actionSendOtherService($arrExclusive);
            sleep(2);
//other_services_communication
            $arrExclusive['other_orders_id'] = $intOtherOrder;
            $arrExclusive['sms_token'] = $strSMSToken;
            $intOtherService = OtherServicesCommunication::create($arrExclusive);
            $arrResponse = array('type' => 'success', 'data' => $arrExclusive, 'message' => 'We accepted you request and will contact you soon.', 'code' => 200);
            unset($arrExclusive, $arrModifiedExclusive, $intOtherOrder, $strSMSToken, $strCustomSolider, $intOtherService);
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionBookExclusive() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['customer_id'])) {
                $arrInput = $_POST;
                $arrMechanicInput = array(
                    'vehicle_id' => $arrInput['vehicle_id'],
                    'service_id' => $arrInput['service_id'],
                    'latitude' => $arrInput['latitude'],
                    'longitude' => $arrInput['longitude']
                );
//Get Mechanic Shops
                $arrMechanicShops = $this->actionMechanicShops($arrMechanicInput);
                unset($arrMechanicInput);
                $arrCustomer = Customer::getCustomer(NULL, $arrInput['customer_id']);
                $arrModifiedExclusive = array();
                $strCustomSolider = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $strOrderNumber = CommonFunctions::getCustomToken($strCustomSolider, 6);
                $arrModifiedExclusive['order_number'] = $strOrderNumber;
                $arrModifiedExclusive['vehicle_type'] = $arrInput['vehicle_id'];
                $arrModifiedExclusive['brand_id'] = $arrInput['brand_id'];
                $arrModifiedExclusive['model_id'] = $arrInput['model_id'];
                $arrModifiedExclusive['service_id'] = $arrInput['service_id'];
                $arrModifiedExclusive['is_exclusive'] = 1;
                $arrModifiedExclusive['other_mobile'] = $arrCustomer['phone'];
                $arrModifiedExclusive['other_name'] = $arrCustomer['first_name'];
                $arrModifiedExclusive['service_name'] = $arrInput['service_name'];
                $arrModifiedExclusive['additional_information'] = isset($arrInput['description']) ? $arrInput['description'] : NULL;
                $arrModifiedExclusive['location'] = $arrInput['location'];
                $arrModifiedExclusive['booked_date'] = date('Y-m-d H:i:s');
                $arrModifiedExclusive['booked_time'] = date('H:i:s');
                $arrModifiedExclusive['lati_longitude'] = $arrInput['latitude'] . ',' . $arrInput['longitude'];
                $arrModifiedExclusive['device_name'] = $arrInput['device_name'];
                $arrModifiedExclusive['customer_id'] = $arrInput['customer_id'];
                $arrModifiedExclusive['added_vehicles_id'] = $arrInput['added_vehicle_id'];
//Combine Defaults
                $objDataManager = new DataManager();
                $arrExclusive = $objDataManager->makeMobileData($arrModifiedExclusive);
//other_orders
                $intOtherOrder = OtherOrders::create($arrExclusive);
//Send SMS
                $strSMSToken = $this->actionSendOtherService($arrExclusive);
                sleep(2);
//other_services_communication
                $arrExclusive['other_orders_id'] = $intOtherOrder;
                $arrExclusive['sms_token'] = $strSMSToken;
                $intOtherService = OtherServicesCommunication::create($arrExclusive);
                $arrResponse = array('type' => 'success', 'data' => $arrExclusive, 'message' => 'We accepted you request and will contact you soon.', 'code' => 200, 'mechanic_shops' => $arrMechanicShops);
                unset($arrExclusive, $arrModifiedExclusive, $arrMechanicShops, $arrCustomer);
                unset($intOtherOrder, $strSMSToken, $strCustomSolider, $intOtherService);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Customer is not found.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionSendOtherService($arrOther, $intSign = NULL) {
        $strSMSToken = NULL;
        $arrSmsData = Yii::app()->params['sms'];
        $objDataManager = new DataManager();
        $arrCustomer = array();
        $arrCustomer['mobile'] = $arrOther['other_mobile'] . ',' . Yii::app()->params['customer_info']['admin_mobile'];
        if (empty($intSign)) {
            $arrCustomer['message'] = $objDataManager->getOtherServiceTemplate($arrOther);
        } else if (2 == $intSign) {
            $arrCustomer['message'] = $objDataManager->getCRNTemplate($arrOther);
        } elseif (3 == $intSign) {
            $arrCustomer['message'] = $objDataManager->getVerifyCustomerTemplate($arrOther);
        } elseif (4 == $intSign) {
            $arrCustomer['message'] = $objDataManager->getOrderTemplate($arrOther);
        } else {
            $arrCustomer['message'] = $objDataManager->getForgotTemplate($arrOther);
        }
        $arrSmsData = array_merge($arrSmsData, $arrCustomer);
        $objectSMSManager = new SMSManager($arrSmsData);
        $strSMSToken = $objectSMSManager->fireSMS();
        return $strSMSToken;
    }

    public function actionForgotPassword() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['mobile_number']) && !empty($_POST['mobile_number'])) {
                $objDataManager = new DataManager();
                $arrCustomerEmail = CustomerEmail::getPhoneDetails($_POST['mobile_number']);
                if (!empty($arrCustomerEmail)) {
                    $arrCustomer = Customer::getCustomerData($arrCustomerEmail['customer_id']);
                    $strSmsCode = CommonFunctions::getNumberToken(4);
                    $arrSmsData = array('other_mobile' => $arrCustomer['phone'], 'otp' => $strSmsCode);
                    $strSmsToken = $this->actionSendOtherService($arrSmsData, 1); // 1 => For Forgot Password
                    sleep(2);
                    $intUpdateToken = Customer::model()->updateCustomer(array('forgot_pwd_token' => $strSmsCode, 'forgot_sms_token' => $strSmsToken), $arrCustomerEmail['customer_id']);
                    $arrResponse = array('type' => 'success', 'data' => $strSmsToken, 'message' => 'Forgot Password OTP Sent Your Mobile Number', 'code' => 200, 'customer_id' => $arrCustomerEmail['customer_id']);
                    unset($strSmsToken);
                    unset($arrSmsData);
                    unset($strSmsCode);
                    unset($arrCustomer);
                    unset($arrCustomerEmail);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => array(), 'message' => 'Mobile number do not exist.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => array(), 'message' => 'Mobile number not given.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionChangePassword() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if ($_POST['password'] && $_POST['customer_id']) {
                $arrCustomer = Customer::getCustomer(NULL, $_POST['customer_id']);
                if (!empty($arrCustomer) && isset($arrCustomer['forgot_pwd_token']) && $_POST['otp'] == $arrCustomer['forgot_pwd_token']) {
                    $strModifiedPassword = CommonFunctions::generatePassword($_POST['password']);
                    $intUpdate = Customer::model()->updateCustomer(array('password' => $strModifiedPassword), $_POST['customer_id']);
                    $arrResponse = array('type' => 'success', 'data' => $intUpdate, 'message' => 'Password Changed Successfully.', 'code' => 200);
                    unset($intUpdate);
                    unset($strModifiedPassword);
                    unset($arrCustomer);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => array(), 'message' => 'Invalid OTP given.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => array(), 'message' => 'Password Or Customer Id is not given.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionOrderDetails() {
        $arrResponse = $arrOrder = array();
        $arrExtraRepairsList = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['order_id']) && empty($_POST['order_id']) && isset($_POST['order_number']) && empty($_POST['order_number'])) {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Order Number Not Found.', 'code' => 300);
            } else {
                if (isset($_POST['is_other']) && 1 == $_POST['is_other']) {
                    $arrOrderdetails = OtherOrders::model()->OtherOrderInfo($_POST['order_id']);
                    $arrOrder = array_merge($arrOrderdetails, array("repairs" => array()));
                } else {
                    if (isset($_POST['order_id'])) {
                        $arrOrderdetails = Orders::model()->orderInfo(NULL, $_POST['order_id']);
                        $arrExtraRepairsList["repairs"] = Orders::model()->extraRepairsList(NULL, $_POST['order_id']);
                    } else if (isset($_POST['order_number'])) {
                        $arrOrderdetails = Orders::model()->orderInfo($_POST['order_number']);
                        $arrExtraRepairsList["repairs"] = Orders::model()->extraRepairsList($_POST['order_number'], NULL);
                    }
                    $arrOrder = array_merge($arrOrderdetails, array("repairs" => $arrExtraRepairsList["repairs"]));
                }
                $arrResponse = array('type' => 'success', 'data' => $arrOrder, 'message' => 'Order Details.', 'code' => 200, 'service_icon_path' => '/services_categories/');
                unset($arrOrder, $arrExtraRepairsList);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionPaymentMode() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['order_id']) && !empty($_POST['order_id']) && isset($_POST['payment_modes_id']) && !empty($_POST['payment_modes_id'])) {
                $strCRN = CommonFunctions::getNumberToken(4);
                $strCRN = 'DELV-' . $strCRN;
                $intPaymentMode = $_POST['payment_modes_id'];
                $strRedirectURL = NULL;
                $strMessage = 'Delivery Boy Will Collect The Money As Soon..';
                $doubleAmount = isset($_POST['total_amount']) ? $_POST['total_amount'] : 0.00;
                if (3 == $intPaymentMode) {
                    $intPaymentMode = 4; // Mobile Order
                    $strRedirectURL = Yii::app()->params['webURL'] . '/Mobile/Booking/BookAService/DoPayment';
                    $strMessage = 'Redirecting To Payment Gateway...';
                }
                if (1 == $intPaymentMode) {
                    $this->actionSendOtherService(array('other_mobile' => $_POST['phone'], 'CRN' => $strCRN, 'order_number' => $_POST['order_number'], 'total_amount' => $doubleAmount), 2);
                }
                sleep(2);
                if (isset($_POST['is_other']) && !empty($_POST['is_other'])) {
                    $intUpdate = OtherOrders::updateOrderStatus($_POST['order_id'], array('payment_modes_id' => $intPaymentMode, 'crn' => $strCRN));
                } else {
                    $intUpdate = Orders::updateOrderStatus($_POST['order_id'], NULL, array('payment_modes_id' => $intPaymentMode, 'crn' => $strCRN));
                }
                $arrResponse = array('type' => 'success', 'data' => $intUpdate, 'message' => $strMessage, 'code' => 200, 'payment_mode' => $intPaymentMode, 'payment_url' => $strRedirectURL, 'crn' => $strCRN);
                unset($intUpdate);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Order Id or Payment Mode Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionNotificationManager($intNotificationCode = NULL) {
        //$arrNotifications = PushNotifications::getNotifications(array('status' => 1, 'notification_code' => $intNotificationCode));
        $arrNotifications = PushNotifications::getNotifications();
        return $arrNotifications;
    }

    public function actionSaveNotification($arrInput, $arrMechanicShops) {
//Notification Code 1 => New Order
        $arrNotification = array(
            'order_id' => $arrInput['order_id'],
            'order_number' => $arrInput['order_number'],
            //'message' => 'New Order : ' . $arrInput['order_number'],
            'message' => 'Yay! A new service order ' . $arrInput['order_number'] . ' has been submitted. Click here to accept or decline',
            'status' => 1,
            'notification_code' => $arrInput['notification_code'],
            'title' => $arrInput['title'],
            'role_id' => $arrInput['role_id'],
            'location' => $arrInput['location'],
            'latitude' => $arrInput['latitude'],
            'longitude' => $arrInput['longitude'],
            'gcm_register_id' => NULL,
            'notification_type' => $arrInput['notification_type'],
        );
        $objDataManager = new DataManager();
        $arrModifiedNotification = $objDataManager->makeMobileData($arrNotification);
        if (!empty($arrMechanicShops)) {
            foreach ($arrMechanicShops as $arrShop) {
                $arrModifiedNotification['gcm_register_id'] = $arrShop['gcm_register_id'];
                if (!empty($arrShop['gcm_register_id'])) {
                    $intNotification = PushNotifications::create($arrModifiedNotification);
                }
            }
            unset($arrMechanicShops);
        }
        unset($arrNotification, $arrModifiedNotification, $arrInput);
        return $intNotification;
    }

    public function actionCustomerOrders() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['customer_id']) && !empty($_POST['customer_id'])) {
                $arrCustomerOrders = Orders::getOrders($_POST['customer_id']);
                $arrReasons = Reasons::getReasons(1, 1);
                $arrResponse = array('type' => 'success', 'data' => $arrCustomerOrders, 'message' => 'Customer Orders', 'code' => 200, 'reasons' => $arrReasons);
                unset($arrCustomerOrders);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Customer is missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionCustomerOtherOrders() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['customer_id']) && !empty($_POST['customer_id'])) {
                $arrCustomerOrders = OtherOrders::getOtherOrders($_POST['customer_id']);
                $arrResponse = array('type' => 'success', 'data' => $arrCustomerOrders, 'message' => 'Customer Other Orders', 'code' => 200);
                unset($arrCustomerOrders);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Customer is missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionDoPayment1() {
        $arrResponse = array();
        $arrErrors = array();
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['customer_id']) && !empty($_POST['customer_id']) && isset($_POST['order_id']) && !empty($_POST['order_id'])) {
                $arrInput = $_POST;
                $arrInput['customer_id'] = 1;
                $arrInput['order_id'] = 1;
                $arrCustomer = Customer::getCustomer(NULL, $arrInput['customer_id']);
                $arrOrders = Orders::model()->orderInfo(NULL, $arrInput['order_id']);
                $arrCustomerOrderData = array_merge($arrCustomer, $arrOrders);
                $strEncodedBilling = $this->actionDoEncrypt($arrCustomerOrderData);
                $arrResponse = array('type' => 'success', 'data' => array('encRequest' => $strEncodedBilling, 'access_code' => Yii::app()->params['payment_keys']['ccavenue']['access_code'], 'secure_url' => Yii::app()->params['payment_keys']['ccavenue']['secure_url']), 'message' => 'Payment Gateway Data.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Order Or Customer Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionCancelOrder() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInput = $_POST;
            if (isset($arrInput['order_id']) && !empty($arrInput['order_id'])) {
                $intIsExclusive = isset($arrInput['is_other']) ? $arrInput['is_other'] : 0;
                if (0 == $intIsExclusive) {
                    $arrShopOrder = ShopOrders::model()->shopOrdersStatus($arrInput['order_id']);
                } elseif (1 == $intIsExclusive) {
                    $arrShopOrder = ShopOtherOrders::model()->shopOrdersStatus($arrInput['order_id']);
                }
                if ((isset($arrShopOrder['is_collected']) && 0 == $arrShopOrder['is_collected']) || empty($arrShopOrder)) {
                    if (isset($arrInput['reason_id']) && !empty($arrInput['reason_id'])) {
                        if (0 == $intIsExclusive) {
                            $intUpdate = Orders::updateOrderStatus($arrInput['order_id'], NULL, array('order_status' => Yii::app()->params['order_staus']['CANCELLED'], 'reasons_id' => $arrInput['reason_id']));
                            $intUpdateShopOrder = ShopOrders::model()->updateOrderStatus($arrInput['order_id'], array('delivery_boys_id' => 0));
                        } elseif (1 == $intIsExclusive) {
                            $intUpdate = OtherOrders::updateOrderStatus($arrInput['order_id'], array('order_status' => Yii::app()->params['order_staus']['CANCELLED'], 'reasons_id' => $arrInput['reason_id']));
                            $intUpdateShopOrder = ShopOtherOrders::model()->updateOrderStatus($arrInput['order_id'], array('delivery_boys_id' => 0));
                        }
                        $arrResponse = array('type' => 'success', 'data' => $intUpdate, 'message' => 'Order Cancelled Successfully.', 'code' => 200);
                        unset($arrInput);
                    } else {
                        $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Reason Is Missed.', 'code' => 300);
                    }
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Already Vehicle Collected. No Chance To Cancel An Order.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Order Id Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionDoEncrypt($arrBillingData) {
        $strMerchantData = NULL;
        $arrPaymentData = array();
        $arrInputs = $arrBillingData;
        $arrPaymentData = array(
            'billing_name' => isset($arrInputs['first_name']) ? $arrInputs['first_name'] : NULL,
            'billing_address' => $arrInputs['customer_address'] . $arrInputs['order_address2'],
            'billing_city' => isset($arrInputs['order_city']) ? $arrInputs['order_city'] : NULL,
            'billing_tel' => isset($arrInputs['phone']) ? $arrInputs['phone'] : NULL,
            'billing_email' => isset($arrInputs['email']) ? $arrInputs['email'] : NULL,
            'amount' => isset($arrInputs['final']) ? $arrInputs['final'] : NULL,
            'billing_zip' => isset($arrInputs['order_pincode']) ? $arrInputs['order_pincode'] : NULL,
            'order_id' => isset($arrBillingData['order_number']) ? $arrBillingData['order_number'] : NULL,
            'merchant_id' => '105397',
            'redirect_url' => 'http://202.56.199.159/mps/bookaservice/index.php/Booking/BookAService/PaymentResponse',
            'cancel_url' => 'http://202.56.199.159/mps/bookaservice/index.php/Booking/BookAService/PaymentResponse',
            'language' => 'EN',
            'currency' => 'INR',
        );
        if (!empty($arrPaymentData)) {
            foreach ($arrPaymentData as $strPaymentKey => $strPaymentValue) {
                $strMerchantData .= $strPaymentKey . '=' . $strPaymentValue . '&';
            }
        }
        $strEncypted = Payment::encrypt($strMerchantData, 'DB1FA0B166DBDD94EA6527B0418BCF8F');
        return $strEncypted;
    }

    public function actionVerifyCustomer() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $strCRN = CommonFunctions::getNumberToken(4);
            $this->actionSendOtherService(array('other_mobile' => $_POST['phone'], 'CRN' => $strCRN), 3);
            $arrResponse = array('type' => 'success', 'data' => $arrResponse, 'message' => 'Token Sent To Customer.', 'code' => 200, 'verify_token' => $strCRN);
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionDoPayment() {
        $arrModifiedOrderDetails = array();
        $objPaymentForm = $strEncryptedBookedData = NULL;
        $arrErrors = array();
        $intOrder = Yii::app()->getRequest()->getQuery('order_id');
        $intCustomer = Yii::app()->getRequest()->getQuery('customer_id');
        $strCity = Yii::app()->getRequest()->getQuery('order_city');
        $strPincode = Yii::app()->getRequest()->getQuery('pincode');
//        $intOrder = $_POST['order_id'];
//        $intCustomer = $_POST['customer_id'];
//        $strCity = $_POST['order_city'];
//        $strPincode = $_POST['pincode'];
        if (!empty($intOrder)) {
            $arrOrderDetails = Orders::orderInfo(NULL, $intOrder);
            $arrModifiedOrderDetails = array(
                'first_name' => $arrOrderDetails['customer_fullname'],
                'email' => $arrOrderDetails['customer_email'],
                'phone' => $arrOrderDetails['customer_phone'],
                'order_city' => $strCity,
                'order_pincode' => $strPincode,
                'customer_address' => $arrOrderDetails['customer_address'],
                'booked_date' => $arrOrderDetails['booked_date'],
                'booked_time' => $arrOrderDetails['booked_time'],
                'final' => $arrOrderDetails['final'],
                'order_number' => $arrOrderDetails['order_number'],
            );
            unset($arrOrderDetails);
        }
        if (isset($_POST['do_payment'])) {
            $objPaymentForm = new PaymentForm();
            $objPaymentForm->attributes = $_POST;
            if ($objPaymentForm->validate()) {
                $arrModifiedInputs = $objPaymentForm->attributes;
                $arrModifiedInputs = array_merge($arrModifiedInputs, array(
                    'booked_date' => $arrModifiedOrderDetails['booked_date'],
                    'booked_time' => $arrModifiedOrderDetails['booked_time'],
                    'final' => $arrModifiedOrderDetails['final'],
                    'order_number' => $arrModifiedOrderDetails['order_number'],
                        )
                );
                $strEncryptedBookedData = $this->actionDoEncrypt($arrModifiedInputs);
                $objSession = Yii::app()->session;
                $objSession['enc_booked_data'] = $strEncryptedBookedData;
                $strRedirectURL = Yii::app()->params['webURL'] . '/Mobile/Booking/BookAService/GoToCcavenue';
                $this->redirect($strRedirectURL);
            } else {
                $arrErrors = $objPaymentForm->errors;
            }
        }
        $this->render('/Booking/Mobile_PlaceOrder', array('order_info' => $arrModifiedOrderDetails, 'errors' => $arrErrors, 'payment_form' => $objPaymentForm));
    }

    public function actionGoToCcavenue() {
        $strEncBookedData = Yii::app()->session['enc_booked_data'];
//$strEncBookedData = 'c4db4535b113625a6e3a34c04a08eb214a739bced51fd8572c270392c7a0f500fc4bdc6e364e67fff675f021306aadee8f9e23f73e43ec504bb78ba0dd90d7226df2dd60d8567dde04aaf56a2c31c3b272d0800f249363d9e028e7b9926c6cc977f9f6463b24a74378e7b5e117ada669b8895884eedae614f8d8831bdbea0841c186366f7bc21ecff89fd19e59ed028601769d70a655a3358b27ec32c161a3993af5c0b75eea764d3f476d6532d94234bb95f71b5e6a287e0c15bfa9e372844dff093dd037e85b55fd7b0ebc303b4724bf9e5b65ec4d012d0e70d5653fcd9e9fd81dc04e2ef56467f587dcd058d382259bde7ddebc10a200886df9967c28f6b9bec0995439f6f584fd600c65ee3c3f2c0c7ac53dd7dc576c1c6267fff6896aea81f8535aa2c0f8b2896e770bbda7232552e983acc1f659278573830b61071f01052e64496492d720a6852cddea84f6ace8398586bfa3f26f235cf09b5190e2b9db597b855e835f6c3522a771840b144883c751c3391ba00c1aa6bc15a18572100bd6585ae819f9db59dde3be415e895103cf5565aa9a56547aec9b7469609f883f50632f7903b1951854d87819a2527ca77ee304cf9f98fc77fc8802611cb644abdd61d4b80373abc42f4231780fc97461cc9d72f34982f5d5c9e98af00878a03829fe7daf0a442d71567a2d446ebe0f367fb2cdebc1ce42d7ea50457035b4a5';
        $this->render('/Booking/Mobile_Ccavenue', array('encyprt_booked_data' => $strEncBookedData));
    }

    public function actionSuspendVehicle() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['customer_id']) && !empty($arrInputs['customer_id']) && isset($arrInputs['added_vehicle_id']) && !empty($arrInputs['added_vehicle_id'])) {
                $intUpdate = CustomerAddVehicles::updateVehicleStatus(array('status' => $arrInputs['status']), $arrInputs['customer_id'], $arrInputs['added_vehicle_id']);
                $arrResponse = array('type' => 'success', 'data' => $intUpdate, 'message' => 'Succesfully Vehicle Is Deleted.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Customer Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionGetNetwork() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['latitude']) && !empty($arrInputs['latitude']) && isset($arrInputs['longitude']) && !empty($arrInputs['longitude'])) {
                $objDataManager = new DataManager();
                $arrMinMaxLatiLongis = $objDataManager->getMinMaxLatiLongis($arrInputs['latitude'], $arrInputs['longitude']);
                $arrShops = MechanicShops::getNetWork($arrMinMaxLatiLongis);
                $arrResponse = array('type' => 'success', 'data' => $arrShops, 'message' => 'Mechanic Shops List.', 'code' => 200);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionGetExclusiveOrder() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['customer_id']) && !empty($arrInputs['customer_id'])) {
                $arrOrder = OtherOrders::OtherOrderDesc(NULL, NULL, $arrInputs['customer_id']);
                $arrReasons = Reasons::getReasons(1, 1);
                $arrResponse = array('type' => 'success', 'data' => $arrOrder, 'message' => 'Customer Orders.', 'code' => 200, 'reasons' => $arrReasons);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Customer Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionGetRSA() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['order_id']) && !empty($arrInputs['order_id'])) {
                $strAccessCode = Yii::app()->params['payment_keys']['ccavenue']['access_code'];
                if (isset($arrInputs['access_code']) && !empty($arrInputs['access_code'])) {
                    $strAccessCode = $arrInputs['access_code'];
                }
                $strCcavenueSecureURL = Yii::app()->params['payment_keys']['mobile_ccavenue']['secure_url'];
                //POST Fields :: START
                $arrCcavenuePOSTFields = array(
                    'access_code' => $strAccessCode,
                    'order_id' => $arrInputs['order_id'],
                );
                //POST Fields :: END
                $strCcavenueVariables = NULL;
                $strSeperator = '';
                foreach ($arrCcavenuePOSTFields as $key => $value) {
                    $strCcavenueVariables .= $strSeperator . urlencode($key) . '=' . urlencode($value);
                    $strSeperator = '&';
                }

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $strCcavenueSecureURL);
                curl_setopt($ch, CURLOPT_POST, count($arrCcavenuePOSTFields));
                curl_setopt($ch, CURLOPT_CAINFO, Yii::app()->params['webURL'] . 'images/files/cacert.pem');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $strCcavenueVariables);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $strPaymentEncodedData = curl_exec($ch);
                $arrResponse = array('type' => 'success', 'data' => $strPaymentEncodedData, 'message' => 'Ccavenue Encoded Data.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Order Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionPaymentStatus() {
        $workingKey = '6F6871227204E80B4AA7570E32BEEE30';
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

        //Orders
        Orders::updateOrderStatus($arrModifiedPaymentResponse['order_id'], NULL, array('payment_modes_id' => 3, 'status' => '1'));
        //Orders Billing
        OrdersBilling::updateOrderBillingStatus($arrModifiedPaymentResponse['order_id'], array('transaction_status' => $arrModifiedPaymentResponse['order_status'], 'order_transaction' => $arrModifiedPaymentResponse['tracking_id'], 'card_name' => $arrModifiedPaymentResponse['card_name'], 'payment_option' => $arrModifiedPaymentResponse['payment_mode']));


        //$strOrderStatus = Yii::app()->params['payment_status']['ccavenue'][$strPaymentStatus];
        $strOrderStatus = isset($arrModifiedPaymentResponse['order_status']) ? $arrModifiedPaymentResponse['order_status'] : NULL;
        if ($strOrderStatus == 'Success') {
            $strPaymentMessage = "Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
        } else if ($strOrderStatus == 'Aborted') {
            Orders::updateOrderStatus($arrModifiedPaymentResponse['order_id'], NULL, array('payment_modes_id' => '4'));
            $strPaymentMessage = "But you cancelled the payment.";
        } else if ($strOrderStatus == 'Failure') {
            $strPaymentMessage = "However,the transaction has been declined.";
        } else {
            $strPaymentMessage = "Security Error. Illegal access detected.";
        }
        $this->renderPartial('/Booking/MobileThankYou', array('payment_status' => $strPaymentMessage, 'payment_response' => $arrModifiedPaymentResponse));
    }

    public function actionFireFCM() {
        $data = array('post_id' => '12345', 'post_title' => 'A Blog post');
        $target = 'd4UIM6Z_VHo:APA91bF_duotRu9vNRw_7ioh77pKaU7iifJqH8sU3UEfK5W1F6TTkqa98zmJ2Z3EqJEhmo-me-NjFq0tnozYKow9WEClwuA5faoj0TGMojJbS55pJ9DRGGIROvcKd2D-8rPZ9dm3gN1T';


        $target = array('eueRlvdtDPo:APA91bGvSJlUmDgWR2OZ_E40ShbPgmIE7_QrM4rMpbUnY-0qou6zKXRn2KmnMOELZ9xwQoKoI6DDb-l71toEKgmLbiOm7L76cfq_cqZ7UhJ92VMSXSoPPpcYdjZSm2PO8gfPjh7pCa9v', 'dNmLVCwEnA4:APA91bFGNdx6fml9XiHh6kSL2hqPYQftncLwSLD92T3G5qJv4JiaAmHRw0IVFBKGIM-PgUlWYnXTxTNQD5HFPYFateFQ8Vfv7MmqLmJCt0uSkFS_bOpNas8g60kpixfEqZ6PyKK9DlG8');
        //$target = array('token1', 'token2', '...'); // up to 1000 in one request
        //FCM api URL
        $url = 'https://fcm.googleapis.com/fcm/send';
//api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        $server_key = 'AAAAfTz00Ew:APA91bEyhSY7-JIkpYLq35dMXlxslzZAue03esJuz1yZytiEi2pW_DTeqlgb5G1iq9BGE2kuz7WmNE98sr2DNywTP-6cBfzkjUQWAvnN1GNvRoXjvEHKr7_92RxdhEmqCh47i2fwYUEIg41GpR0vtmWrrSOFwof7ew';

        $fields = array();
        $fields['data'] = $data;
        if (is_array($target)) {
            $fields['registration_ids'] = $target;
        } else {
            $fields['to'] = $target;
        }
        print_r($fields);
        die();
//header with content_type api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $server_key
        );


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        print_r($result);
        die();
        return $result;
    }

    public function actionSelfPaymentStatus() {
        $strPaymentStatus = "";
        $encResponse = $arrModifiedPaymentResponse = array();
        $encResponse = isset($_POST["encResp"]) ? $_POST["encResp"] : NULL;
        if (!empty($encResponse)) {
            $workingKey = '6F6871227204E80B4AA7570E32BEEE30';
            $rcvdString = Payment::decrypt($encResponse, $workingKey);
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
            //Orders
            SelfDriveOrders::updateSelfOrder($arrModifiedPaymentResponse['order_id'], array('payment_modes_id' => 3, 'status' => '1'));
            //Orders Billing
            SelfDriveOrderBilling::updateSelfOrderBillingStatus($arrModifiedPaymentResponse['order_id'], array('transaction_status' => $arrModifiedPaymentResponse['order_status'], 'order_transaction' => $arrModifiedPaymentResponse['tracking_id'], 'card_name' => $arrModifiedPaymentResponse['card_name'], 'payment_option' => $arrModifiedPaymentResponse['payment_mode']));
            //$strOrderStatus = Yii::app()->params['payment_status']['ccavenue'][$strPaymentStatus];
            $strOrderStatus = isset($arrModifiedPaymentResponse['order_status']) ? $arrModifiedPaymentResponse['order_status'] : NULL;
            if ($strOrderStatus == 'Success') {
                $strPaymentMessage = "Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
            } else if ($strOrderStatus == 'Aborted') {
                SelfDriveOrders::updateSelfOrder($arrModifiedPaymentResponse['order_id'], array('payment_modes_id' => 4));
                $strPaymentMessage = "But you cancelled the payment.";
            } else if ($strOrderStatus == 'Failure') {
                $strPaymentMessage = "However,the transaction has been declined.";
            } else {
                $strPaymentMessage = "Security Error. Illegal access detected.";
            }
        }
        $this->renderPartial('/Booking/MobileThankYou', array('payment_status' => $strPaymentMessage, 'payment_response' => $arrModifiedPaymentResponse));
    }

    public function actionGrabImage() {
        //$arrData = $_POST;
        //if (!empty($arrData)) {
        //foreach ($arrData as $arrImg) {
//        $data = 'iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABl'
//                . 'BMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDr'
//                . 'EX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r'
//                . '8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==';
//        //$data = $arrImg['image'];
////                print_r($data);
////                die();
//        $data = base64_decode($data);
//        $im = imagecreatefromstring($data);
//        if ($im !== false) {
//            header('Content-Type: image/png');
//            //imagepng($im);
//            //file_put_contents(image.png,$decoded);
//            //echo $strPath = realpath(Yii::app()->basePath) . '/../images/uploadimages/home/new.png';
//            //die();
//            imagepng($im, 'test.png');
//        } else {
//            echo 'An error occurred.';
//        }
//        // }
//        //}
//        $data = 'iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABl'
//                . 'BMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDr'
//                . 'EX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r'
//                . '8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==';
        $data = $_POST['image'];
        $data = base64_decode($data);
        $im = imagecreatefromstring($data);
        if ($im !== false) {
            header('Content-Type: image/png');
            imagepng($im);
            //file_put_contents(image.png,$decoded);
            imagepng($im, "./images/new2.png");
        } else {
            echo 'An error occurred.';
        }
    }

    public function actionUploadAudio() {
        print_r($_FILES);
        die();
        print_r($_FILES['audio']['name']);
        //print_r($_FILES['audio']['tmp_name']);
        die();
        // Where the file is going to be placed
        $target_path = "images/";
        /* Add the original filename to our target path.
          Result is "uploads/filename.extension" */
        $target_path = $target_path . basename($_FILES['audio']['name']);

        if (move_uploaded_file($_FILES['audio']['tmp_name'], $target_path)) {
            echo "The file " . basename($_FILES['audio']['name']) .
            " has been uploaded";
        } else {
            echo "There was an error uploading the file, please try again!";
            echo "filename: " . basename($_FILES['audio']['name']);
            echo "target_path: " . $target_path;
        }
    }

    public function actionUploadVideo() {
        print_r($_FILES['myFile']['name']);
        print_r($_FILES['myFile']['tmp_name']);
        // Where the file is going to be placed
        $target_path = "images/";
        /* Add the original filename to our target path.
          Result is "uploads/filename.extension" */
        $target_path = $target_path . basename($_FILES['myFile']['name']);

        if (move_uploaded_file($_FILES['myFile']['tmp_name'], $target_path)) {
            echo "The file " . basename($_FILES['myFile']['name']) .
            " has been uploaded";
        } else {
            echo "There was an error uploading the file, please try again!";
            echo "filename: " . basename($_FILES['myFile']['name']);
            echo "target_path: " . $target_path;
        }
    }

    public function actionSpeak() {
        print_r($_POST);
        die();
    }

}

?>
