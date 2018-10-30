<?php

/**
 * @author Ctel
 * @access public
 * @ignore It will handle booking operations
 */
class BookAServiceController extends Controller
{

    /**
     *
     * @author Ctel
     * @access public
     * @ignore It will handle booking a car operations
     */
    public function actionBookACar()
    {
        $intVehicleType = 1; // 1 => Car
        $strVehicleName = 'Car';
        $intStatus = 1;
        $arrVehicle = $this->getVehicleDetails($intVehicleType, $intStatus);
        $this->render('/Booking/BookService', array(
            'services' => $arrVehicle['serviceTypes'],
            'brands' => $arrVehicle['vehicleBrands'],
            'vehicles' => $arrVehicle['vehicleTypes'],
            'vehicleType' => $intVehicleType,
            'vehicleName' => $strVehicleName,
            'vehicleFolderPath' => '/cars/web/brands/60X40/',
            'vehicleModelFolderPath' => '/cars/web/models/60X35/',
            'vehicleModelRightFolderPath' => '/cars/web/models/180X104/',
            'isCar' => $intStatus,
            'isBike' => 0,
            'book_location' => isset($_POST['bookloc']) ? $_POST['bookloc'] : NULL,
            'booked_date' => isset($_POST['picdate']) ? $_POST['picdate'] : NULL,
            'booked_time' => isset($_POST['pictimer']) ? $_POST['pictimer'] : NULL
        ));
    }

    /**
     *
     * @author Ctel
     * @return string It will return a string
     */
    public function actionGetVehicleBrandModels()
    {
        $strVehicleModel = NULL;
        $arrVehicleModels = array();
        if (Yii::app()->request->isPostRequest) {
            $intVehicleBrandType = $_POST['brandId'];
            $intVehicle = $_POST['vehicle_type_id'];
            $strVehicleFolderPath = $_POST['vehicle_folder_path'];
            $strRightVehicleFolderPath = $_POST['vehicle_right_folder_path'];
            $strImgURL = Yii::app()->params['adminImgURL'];
            $arrVehicleModels = VehicleBrandModels::getVehicleBrandModels($intVehicleBrandType);
            if (! empty($arrVehicleModels)) {
                foreach ($arrVehicleModels as $arrModel) {
                    $strVehicleModel .= '<li id="' . $arrModel['id'] . '_' . $strImgURL . $strRightVehicleFolderPath . $arrModel['image_path'] . '">' . '<a href="#">' . $arrModel['name'] . '<img src="' . $strImgURL . $strVehicleFolderPath . $arrModel['image_path'] . '"/>' . '</a>' . '</li>';
                }
            }
        }
        echo $strVehicleModel;
    }

    /**
     *
     * @author Ctel
     * @access public
     * @ignore It will handle book a bike operations
     */
    public function actionBookABike()
    {
        $intVehicleType = 2; // 2 => Bike
        $strVehicleName = 'Bike';
        $intStatus = 1;
        $arrVehicle = $this->getVehicleDetails($intVehicleType, $intStatus);
        $this->render('/Booking/BookService', array(
            'services' => $arrVehicle['serviceTypes'],
            'brands' => $arrVehicle['vehicleBrands'],
            'vehicles' => $arrVehicle['vehicleTypes'],
            'vehicleType' => $intVehicleType,
            'vehicleFolderPath' => '/bikes/web/brands/60X40/',
            'vehicleModelFolderPath' => '/bikes/web/models/60X35/',
            'vehicleModelRightFolderPath' => '/bikes/web/models/220X127/',
            'isBike' => 1,
            'isCar' => 0,
            'vehicleName' => $strVehicleName
        ));
    }

    /**
     *
     * @author Ctel
     * @param integer $intVehicleType
     * @param integer $intStatus
     * @return array It will return vehicle types, vehicle brands and service types
     */
    private function getVehicleDetails($intVehicleType, $intStatus)
    {
        $arrVehicle = array();
        $arrVehicle['vehicleTypes'] = VehicleTypes::getVehicleTypes();
        $arrVehicle['vehicleBrands'] = VehicleBrands::getVehicleBrands($intStatus, $intVehicleType);
        $arrVehicle['serviceTypes'] = VehicleServiceTypes::getServiceTypes($intStatus, $intVehicleType);
        return $arrVehicle;
    }

    public function actionGetRepairs($arrRepairsInput = array())
    {
        $arrResponse = array();
        $arrRepairs = array();
        // Variable Intialization :: START
        $intBrand = isset($arrRepairsInput['brand_id']) ? $arrRepairsInput['brand_id'] : $_POST['brand_id'];
        $intModel = isset($arrRepairsInput['model_id']) ? $arrRepairsInput['model_id'] : $_POST['model_id'];
        $intVehicle = isset($arrRepairsInput['vehicle_type']) ? $arrRepairsInput['vehicle_type'] : $_POST['vehicle_id'];
        $intPlan = isset($arrRepairsInput['plan_id']) ? $arrRepairsInput['plan_id'] : $_POST['plan_id'];
        $intService = isset($arrRepairsInput['service_id']) ? $arrRepairsInput['service_id'] : $_POST['service_id'];
        // Variable Intialization :: END
        $intVehicleCategoryId = Vehicles::getVehicleCategory($intBrand, $intModel);
        $arrServicePackage = ServicePlans::getServicePackages($intVehicle, $intService, $intPlan, 1, $intVehicleCategoryId);
        $arrEleRepairs = VehicalCategoryRepairsAmount::getVehicleRepairs($intVehicleCategoryId, $intVehicle, $intPlan);
        $arrRepairs[] = $this->modifyRepairsData($arrEleRepairs, $intVehicleCategoryId);
        if (2 == $intService) {
            $arrResponse = $this->makeSheetGood($arrRepairs, $intService, $intVehicleCategoryId, $intPlan);
        } else if (1 == $intService || 3 == $intService || 6 == $intService || 7 == $intService) {
            $arrResponse = $this->makeSheet($arrRepairs, $intService, $intVehicleCategoryId, $arrServicePackage, $intPlan);
        }
        unset($arrRepairs);
        if (empty($arrRepairsInput)) {
            $this->renderJSON($arrResponse);
        } else {

            return $arrResponse;
        }
    }

    /**
     *
     * @author Enterpi
     * @param type $arrRepairs
     * @return array It will add repair list name for each repair array
     */
    private function modifyRepairsData($arrRepairs, $intVehicleCategoryId)
    {
        $arrModifiedRepairs = array();
        $arrRepairsList = RepairsLists::getRepairsList();
        $objDataManager = new DataManager();
        $arrModifiedRepairsList = $objDataManager->prepareRepairsList($arrRepairsList);
        if (! empty($arrRepairs)) {
            foreach ($arrRepairs as $eleKey => $eleRepair) {
                $arrRepairs[$eleKey]['repairListName'] = $arrModifiedRepairsList[$eleRepair['repairs_lists_id']];
            }
            foreach ($arrRepairs as $subArrRepair) {
                $arrModifiedRepairs[$subArrRepair['repairName']][] = array(
                    'cost' => $subArrRepair['cost'],
                    'repairId' => $subArrRepair['repairId'],
                    'repairs_lists_id' => $subArrRepair['repairs_lists_id'],
                    'repairListName' => $subArrRepair['repairListName'],
                    'id' => $subArrRepair['id'],
                    'is_recommended' => $subArrRepair['is_recommended'],
                    'plan_id' => $subArrRepair['planId'],
                    'vehicle_type_id' => $subArrRepair['vehicleTypeId'],
                    'vehicle_category_id' => $intVehicleCategoryId,
                    'service_unique_id' => 'per_isr'
                );
            }
        }
        unset($arrRepairs);
        return $arrModifiedRepairs;
    }

    /**
     *
     * @author Ctel
     * @param array $arrRepairsSource
     * @return string It will prepare the repairs and sub-repairs sheet
     */
    private function makeSheet($arrRepairsSource, $intServiceId, $intVehicleCategoryId, $arrServicePackage = array(), $intPlan = NULL)
    {
        $strHtml = NULL;
        $arrRepairSheet = NULL;
        $doubleAmount = 0.00;
        $arrRepairsAndSubRepairs = array();
        if (! empty($arrRepairsSource)) {
            foreach ($arrRepairsSource as $arrRepairs) {
                $i = 0;
                foreach ($arrRepairs as $strRepair => $arrSubRepair) {
                    $i ++;
                    $intRepairList = $arrSubRepair[0]['is_recommended'];
                    $intRepairId = $arrSubRepair[0]['repairId'];
                    $strPopUpId = NULL;
                    $strPopUpAccess = NULL;
                    $strPopUpId = '#myModal' . $i . $intServiceId . $intPlan;
                    $strPopUpAccess = 'myModal' . $i . $intServiceId . $intPlan;
                    $strHtml .= '<div class="col-md-4">';
                    $strSample = Yii::app()->params['imgURL'] . 'service_icon.png'; // Need to remove
                    switch ($intServiceId) {
                        case 1:
                            $strHtml .= '<a data-toggle="modal" data-target="' . $strPopUpId . '">' . '<img src="' . $strSample . '" class="pull-left"/><h3 class="block-title">' . $strRepair . '<i class="fa fa-arrow-circle-right pull-right" aria-hidden="true"></i></h3></a>';
                            $strHtml .= '<div class="modal fade" id="' . $strPopUpAccess . '" role="dialog">';
                            $strHtml .= '<div class="modal-dialog">';
                            $strHtml .= '<div class="modal-content">';
                            $strHtml .= '<div class="modal-header">';
                            $strHtml .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                            $strHtml .= '<h4 class="modal-title">' . $strRepair . '</h4>';
                            $strHtml .= '</div>';
                            $strHtml .= '<div class="modal-body">';
                            $strHtml .= '<ul class="list-check">';
                            break;
                        case 2:
                            $strRepairsList = json_encode($arrSubRepair[0]);
                            $strHtml .= '<ul class="list-check">';
                            if (2 == $arrSubRepair[0]['is_recommended']) { // 2 => editable => suggested
                                $strHtml .= '<h3 class="block-title"><input type="checkbox" name ="per_isr_' . $intRepairId . '" id ="per_isr_' . $intRepairId . '" class="periodic_suggested" onclick="getRepairAmount(\'' . htmlentities($strRepairsList) . '\');">' . $strRepair . '</input></h3></font>';
                            } else if (1 == $arrSubRepair[0]['is_recommended']) { // 1 => non editable => recommended
                                $strHtml .= '<h3 class="block-title"><font color="green">' . $strRepair . '</h3></font>';
                            }
                            break;
                        case 3:
                            $arrSubRepair[0]['service_unique_id'] = 'rep_isr';
                            $strRepairsList = json_encode($arrSubRepair[0]);
                            $strHtml .= '<input type="checkbox" class="repair_service pull-left" name ="rep_isr_' . $intRepairId . $intPlan . '" id ="rep_isr_' . $intRepairId . $intPlan . '" onclick="getRepairAmount(\'' . htmlentities($strRepairsList) . '\');"></input><a data-toggle="modal" data-target="' . $strPopUpId . '"><h3 class="block-title">' . $strRepair . '</h3></a>';
                            $strHtml .= '<div class="modal fade" id="' . $strPopUpAccess . '" role="dialog">';
                            $strHtml .= '<div class="modal-dialog">';
                            $strHtml .= '<div class="modal-content">';
                            $strHtml .= '<div class="modal-header">';
                            $strHtml .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                            $strHtml .= '<h4 class="modal-title">' . $strRepair . '</h4>';
                            $strHtml .= '</div>';
                            $strHtml .= '<div class="modal-body">';
                            $strHtml .= '<ul class="list-check">';
                            break;
                        case 6:
                            $strHtml .= '<a data-toggle="modal" data-target="' . $strPopUpId . '">' . '<img src="' . $strSample . '" class="pull-left"/><h3 class="block-title">' . $strRepair . '<i class="fa fa-arrow-circle-right pull-right" aria-hidden="true"></i></h3></a>';
                            $strHtml .= '<div class="modal fade" id="' . $strPopUpAccess . '" role="dialog">';
                            $strHtml .= '<div class="modal-dialog">';
                            $strHtml .= '<div class="modal-content">';
                            $strHtml .= '<div class="modal-header">';
                            $strHtml .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                            $strHtml .= '<h4 class="modal-title">' . $strRepair . '</h4>';
                            $strHtml .= '</div>';
                            $strHtml .= '<div class="modal-body">';
                            $strHtml .= '<ul class="list-check">';
                            break;
                        case 7:
                            $strHtml .= '<a data-toggle="modal" data-target="' . $strPopUpId . '">' . '<img src="' . $strSample . '" class="pull-left"/><h3 class="block-title">' . $strRepair . '<i class="fa fa-arrow-circle-right pull-right" aria-hidden="true"></i></h3></a>';
                            $strHtml .= '<div class="modal fade" id="' . $strPopUpAccess . '" role="dialog">';
                            $strHtml .= '<div class="modal-dialog">';
                            $strHtml .= '<div class="modal-content">';
                            $strHtml .= '<div class="modal-header">';
                            $strHtml .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                            $strHtml .= '<h4 class="modal-title">' . $strRepair . '</h4>';
                            $strHtml .= '</div>';
                            $strHtml .= '<div class="modal-body">';
                            $strHtml .= '<ul class="list-check">';
                            break;
                        default:
                            echo "Your favorite color is neither red, blue, nor green!";
                    }

                    foreach ($arrSubRepair as $eleSubRepair) {
                        $arrRepairsAndSubRepairs[] = array(
                            $eleSubRepair['repairId'] => $eleSubRepair['repairs_lists_id'] . '_' . $eleSubRepair['cost']
                        );
                        $strHtml .= '<li>' . $eleSubRepair['repairListName'] . '</li>';
                        if (1 == $eleSubRepair['is_recommended']) { // Periodic Services => Recommended
                            $doubleAmount = $doubleAmount + $eleSubRepair['cost'];
                        } else if (0 == $eleSubRepair['is_recommended']) { // General Services
                            $doubleAmount = $doubleAmount + $eleSubRepair['cost'];
                        }
                    }
                    $strHtml .= '</ul>';
                    $strHtml .= '</div></div></div></div></div>';
                }
            }
        }
        $arrRepairSheet['sheet'] = $strHtml;
        $intIsPackage = Yii::app()->params['is_package'][$intServiceId];
        if (1 == $intIsPackage) {
            $arrRepairSheet['amount'] = isset($arrServicePackage['package_amount']) ? $arrServicePackage['package_amount'] : $doubleAmount;
        } else {
            $arrRepairSheet['amount'] = $doubleAmount;
        }
        $arrRepairSheet['amount'] = round($arrRepairSheet['amount'], 2);
        $arrRepairSheet['repairs_subrepairs_list'] = $arrRepairsAndSubRepairs;
        $arrRepairSheet['vehicle_category_id'] = $intVehicleCategoryId;
        unset($arrRepairsSource);
        unset($strHtml);
        unset($doubleAmount);
        unset($arrRepairsAndSubRepairs);
        unset($intVehicleCategoryId);
        return $arrRepairSheet;
    }

    public function actionGetRepairAmount()
    {
        $doubleRepair = 0.00;
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            $arrRepairsList = $arrInputs['repairsList'];
            if (! empty($arrRepairsList)) {
                $arrRepairsList = json_decode($arrRepairsList);
                $arrRepairsListAmount = VehicalCategoryRepairsAmount::getRepairListAmount($arrRepairsList);
                if (! empty($arrRepairsListAmount)) {
                    foreach ($arrRepairsListAmount as $arrListAmount) {
                        $doubleRepair = $doubleRepair + $arrListAmount['cost'];
                    }
                }
            }
        }
        unset($arrRepairsList, $arrRepairsListAmount, $arrInputs);
        echo $doubleRepair;
    }

    public function actionConfirmOrder()
    {
        if (isset($_POST['move_to_confirm'])) {
            $arrOrderDetails = array();
            // $strVehiclePath = '/cars/web/models/180X104/';
            $strVehiclePath = '/cars/web/models/original/';
            $strRepairsSheet = 'No details found.';
            if (isset($_POST['book_a_vehicle'])) {
                $arrOrderDetails = json_decode($_POST['book_a_vehicle'], TRUE);
                if (isset($_POST['location']) && ! empty($_POST['location'])) {
                    $arrOrderDetails['latitude'] = explode(',', $_POST['location'])[0];
                    $arrOrderDetails['longitude'] = explode(',', $_POST['location'])[1];
                }
                // ModelId
                if (isset($arrOrderDetails['model_id'])) {
                    $arrVehicleBrands = VehicleBrandModels::getVehicleBrandModels($arrOrderDetails['model_id'], 2);
                    $arrOrderDetails['model_logo'] = $arrVehicleBrands[0]['image_path'];
                }
                // Vehicle Path
                if (isset($arrOrderDetails['vehicle_type']) && 2 == $arrOrderDetails['vehicle_type']) {
                    // $strVehiclePath = '/bikes/web/models/220X127/';
                    $strVehiclePath = '/bikes/web/models/original/';
                }
                $strRepairsSheet = $this->actionGetRepairs($arrOrderDetails);
            }
        }
        $this->render("/Booking/ConfirmOrder", array(
            'order_details' => $arrOrderDetails,
            'order_info' => $strRepairsSheet,
            'vehicle_path' => $strVehiclePath
        ));
    }

    public function actionBillingNewOrder()
    {
        $strCity = NULL;
        $arrOrderInfo = Yii::app()->session['order_info'];
        $arrPaymentModes = ServicePaymentModes::getServicePaymentModes($arrOrderInfo['vehicle_type'], $arrOrderInfo['service_id'], $arrOrderInfo['plan_id']);
        if (isset($arrOrderInfo['location']) && ! empty($arrOrderInfo['location'])) {
            $arrBreakCity = explode(',', $arrOrderInfo['location']);
            $strCity = isset($arrBreakCity[count($arrBreakCity) - 3]) ? $arrBreakCity[count($arrBreakCity) - 3] : NULL;
        }
        $arrOrderInfo['order_city'] = $strCity;
        $intCustomer = Yii::app()->session['customerID'];
        $arrCustomer = Customer::getCustomer(NULL, $intCustomer);
        if (isset($arrCustomer['password'])) {
            unset($arrCustomer['password'], $arrCustomer['verify_token'], $arrCustomer['access_token']);
        }
        $this->render('/Booking/PlaceOrder', array(
            'order_info' => $arrOrderInfo,
            'customer_info' => $arrCustomer,
            'payment_modes' => $arrPaymentModes
        ));
    }

    public function actionSaveOrder()
    {
        $intOrderId = 0;
        if (Yii::app()->request->isPostRequest) {
            $arrOrderInfo = Yii::app()->session['order_info'];
            $arrOrderDetails = $_POST;
            Yii::app()->session['book_customer_info'] = $_POST;
            // $arrOrderInfo['order_summary'] = json_decode($arrOrderInfo['order_summary'],TRUE);
            $arrOrderDetails = array_merge($arrOrderDetails, $arrOrderInfo);
            $objDataManager = new DataManager();
            // Transaction :: START
            $objectTransaction = Yii::app()->db->beginTransaction();
            // Orders
            $arrOrders = $objDataManager->makeOrders($arrOrderDetails);
            $objSession = Yii::app()->session;
            $objSession['order_number'] = $arrOrders['order_number'];
            $intOrderId = Orders::create($arrOrders);
            $objSession['latest_order_id'] = $intOrderId;
            unset($arrOrders);
            // Orders Coomunication
            $arrOrdersCommunication = $objDataManager->makeOrderCommunications($arrOrderDetails, $intOrderId);
            $intOrderCommunication = OrdersCommunication::create($arrOrdersCommunication);
            unset($arrOrdersCommunication);
            // Orders Billing
            $arrOrderBilling = $objDataManager->makeOrderBilling($arrOrderDetails, $intOrderId);
            $intOrderBilling = OrdersBilling::create($arrOrderBilling);
            unset($arrOrderBilling);
            // Orders Repairs
            $arrOrderRepairs = $objDataManager->makeOrderRepairs($arrOrderDetails, $intOrderId);
            $intOrderRepair = OrdersRepairs::create($arrOrderRepairs);
            unset($arrOrderRepairs);
            unset($arrOrderDetails);
            if (! empty($intOrderRepair)) {
                $objectTransaction->commit();
            } else {
                $objectTransaction->rollback();
            }
            // Transaction :: END
        }
        echo $intOrderId;
    }

    // public function actionFinalOrder() {
    // $arrOrderDetails = Yii::app()->session['order_info'];
    // $strOrderNumber = Yii::app()->session['order_number'];
    // $intUpdate = OrdersBilling::updateOrderBillingStatus(Yii::app()->session['latest_order_id']);
    // $arrOrderDetails = array_merge($arrOrderDetails, array('order_number' => $strOrderNumber));
    // $this->render('/Booking/FinalOrders', array('order_details' => $arrOrderDetails));
    // }
    public function actionFinalOrder()
    {
        $arrOrderDetails = Yii::app()->session['order_info'];
        $arrPaymentDetails = Yii::app()->session['payment_info'];
        $arrCustomerInfo = Yii::app()->session['book_customer_info'];
        $arrOrderBillingData = array();
        if (isset($arrPaymentDetails['order_status']) && 'Success' == $arrPaymentDetails['order_status']) {
            $arrOrderBillingData['order_transaction'] = isset($arrPaymentDetails['tracking_id']) ? $arrPaymentDetails['tracking_id'] : NULL;
            $arrOrderBillingData['transaction_status'] = isset($arrPaymentDetails['order_status']) ? $arrPaymentDetails['order_status'] : NULL;
        } else {
            $arrOrderBillingData['order_transaction'] = isset($arrPaymentDetails['tracking_id']) ? $arrPaymentDetails['tracking_id'] : NULL;
            $arrOrderBillingData['transaction_status'] = isset($arrPaymentDetails['order_status']) ? $arrPaymentDetails['order_status'] : NULL;
        }
        $this->actionSendOtherService(array(
            'other_mobile' => $arrCustomerInfo['phone'],
            'order_number' => Yii::app()->session['order_number'],
            'service_name' => $arrOrderDetails['service_name'],
            'vehicle_name' => $arrOrderDetails['vehicle_name'],
            'plan_name' => $arrOrderDetails['plan_name'],
            'other_name' => $arrCustomerInfo['name']
        ));
        $arrOrderBillingData['invoice_date'] = date('Y-m-d H:i:s');
        $arrOrderBillingData['invoice_number'] = CommonFunctions::getToken(5);
        $intUpdate = OrdersBilling::updateOrderBillingStatus(Yii::app()->session['latest_order_id'], $arrOrderBillingData);
        $arrOrderDetails = array_merge($arrOrderDetails, array(
            'order_number' => Yii::app()->session['order_number']
        ));
        $this->render('/Booking/FinalOrders', array(
            'order_details' => $arrOrderDetails,
            'payment_details' => $arrPaymentDetails
        ));
    }

    public function actionBookOthers()
    {
        $arrErrors = array();
        $intOtherService = NULL;
        if (isset($_POST['book_other_service'])) {
            $strCustomSolider = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $objOthersForm = new BookOthersForm();
            $objOthersForm->scenario = 'Others';
            $objOthersForm->attributes = $_POST;
            if ($objOthersForm->validate()) {
                if (isset($_FILES['others_file']['name']) && ! empty($_FILES['others_file']['name'])) {
                    $arrFileParams = $this->actionUploadPDF('others_file', NULL);
                }
                $objDataManager = new DataManager();
                $arrOther = $objDataManager->makeData($objOthersForm->attributes);
                $strOrderNumber = CommonFunctions::getCustomToken($strCustomSolider, 6);
                if (isset($arrOther['status'])) {
                    $arrOther['status'] = 1;
                    $arrOther['order_number'] = $strOrderNumber;
                    $arrOther['is_exclusive'] = 0;
                }
                $arrOrderInfo = json_decode($_POST['book_a_otherservice'], TRUE);
                $arrOrderInfo['booked_date'] = $objDataManager->modifyDate($arrOrderInfo['booked_date']);
                $arrOther = array_merge($arrOther, $arrOrderInfo);
                $intOtherOrder = OtherOrders::create($arrOther);
                $strSMSToken = $this->actionSendOtherService($arrOther);
                $arrOther['other_orders_id'] = $intOtherOrder;
                $arrOther['sms_token'] = $strSMSToken;
                $arrOther['path'] = isset($arrFileParams['timestampName']) ? $arrFileParams['timestampName'] : NULL;
                $arrOther['original_file_name'] = isset($arrFileParams['original_name']) ? $arrFileParams['original_name'] : NULL;
                $arrOther['lati_longitude'] = isset($_POST['location']) ? $_POST['location'] : NULL;
                $intOtherService = OtherServicesCommunication::create($arrOther);
                unset($arrOther, $arrOrderInfo);
                unset($intOtherOrder, $strSMSToken, $strCustomSolider);
            } else {
                $arrErrors = $objOthersForm->errors;
            }
        }
        $this->redirect('BookACar', array(
            'errors' => $arrErrors,
            'other_service_id' => $intOtherService
        ));
    }

    public function actionSendOtherService($arrOther, $intSign = 0)
    {
        $strSMSToken = NULL;
        $arrSmsData = Yii::app()->params['sms'];
        $objDataManager = new DataManager();
        $arrCustomer = array();
        $arrCustomer['mobile'] = $arrOther['other_mobile'] . ',' . Yii::app()->params['customer_info']['admin_mobile'];
        if (0 == $intSign) {
            $arrCustomer['message'] = $objDataManager->getOtherServiceTemplate($arrOther);
        } elseif (1 == $intSign) {
            $arrCustomer['message'] = $objDataManager->getOnlineCRNTemplate($arrOther);
        }
        $arrSmsData = array_merge($arrSmsData, $arrCustomer);
        $objectSMSManager = new SMSManager($arrSmsData);
        $strSMSToken = $objectSMSManager->fireSMS();
        return $strSMSToken;
    }

    public function actionBookExclusive()
    {
        $arrErrors = array();
        $intOtherService = NULL;
        if (isset($_POST['other_exlusive_service'])) {
            $strCustomSolider = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $objOthersForm = new BookOthersForm();
            $objOthersForm->attributes = $_POST;
            if ($objOthersForm->validate()) {
                $objDataManager = new DataManager();
                $arrOther = $objDataManager->makeData($objOthersForm->attributes);
                $strOrderNumber = CommonFunctions::getCustomToken($strCustomSolider, 6);
                if (isset($arrOther['status'])) {
                    $arrOther['status'] = 1;
                    $arrOther['order_number'] = $strOrderNumber;
                    $arrOther['is_exclusive'] = 1;
                }
                $arrOrderInfo = json_decode($_POST['book_a_exclusiveservice'], TRUE);
                $arrOrderInfo['booked_date'] = $objDataManager->modifyDate($arrOrderInfo['booked_date']);
                $arrOther = array_merge($arrOther, $arrOrderInfo);
                $intOtherOrder = OtherOrders::create($arrOther);
                $strSMSToken = $this->actionSendOtherService($arrOther);
                $arrOther['other_orders_id'] = $intOtherOrder;
                $arrOther['sms_token'] = $strSMSToken;
                $arrOther['lati_longitude'] = isset($_POST['location']) ? $_POST['location'] : NULL;
                $intOtherService = OtherServicesCommunication::create($arrOther);
                unset($arrOther, $arrOrderInfo);
                unset($intOtherOrder, $strSMSToken, $strCustomSolider);
            } else {
                $arrErrors = $objOthersForm->errors;
            }
        }
        $this->redirect('BookACar', array(
            'errors' => $arrErrors,
            'other_service_id' => $intOtherService
        ));
    }

    /**
     *
     * @author Ctel
     * @param array $arrRepairsSource
     * @return string It will prepare the repairs and sub-repairs sheet
     */
    private function makeSheetGood($arrRepairsSource, $intServiceId, $intVehicleCategoryId, $intPlan = NULL)
    {
        $strHtml = NULL;
        $arrRepairSheet = NULL;
        $doubleAmount = 0.00;
        $arrRepairsAndSubRepairs = array();
        if (! empty($arrRepairsSource)) {
            $arrCollection = array();

            foreach ($arrRepairsSource as $arrRepairs) {
                $strPartialSheet = NULL;
                $i = 0;
                foreach ($arrRepairs as $strRepair => $arrSubRepair) {
                    $i ++;
                    $intRepairList = $arrSubRepair[0]['is_recommended'];
                    $intRepairId = $arrSubRepair[0]['repairId'];
                    if (1 == $arrSubRepair[0]['is_recommended']) { // 1 => Recommended
                        $strPartialSheet = $this->sheetBarrier($arrSubRepair, $strRepair, $intServiceId, $intRepairId, $intPlan, $i);
                        $arrCollection['recommended'][] = explode('$', $strPartialSheet)[0];
                        $doubleAmount = $doubleAmount + explode('$', $strPartialSheet)[1];
                    } elseif (2 == $arrSubRepair[0]['is_recommended']) { // 2 => Suggested
                        $strPartialSheet = $this->sheetBarrier($arrSubRepair, $strRepair, $intServiceId, $intRepairId, $intPlan, $i);
                        $arrCollection['suggested'][] = explode('$', $strPartialSheet)[0];
                        $doubleAmount = $doubleAmount + explode('$', $strPartialSheet)[1];
                    }
                }
            }
        }

        $strFinalSheet = NULL;
        if (! empty($arrCollection)) {
            $arrCollection = array_reverse($arrCollection);
            foreach ($arrCollection as $key => $value) {
                if ('recommended' == $key) {
                    $strFinalSheet .= '<div class="recommended-div"><h2>Recommended</h2><div class="col-md-12">';
                    foreach ($value as $strItem) {
                        $strFinalSheet .= $strItem;
                    }
                    $strFinalSheet .= '</div></div>';
                } elseif ('suggested' == $key) {
                    $strFinalSheet .= '<div class="suggested-div"><h2>Suggested</h2><div class="col-md-12">';
                    foreach ($value as $strItem) {
                        $strFinalSheet .= $strItem;
                    }
                    $strFinalSheet .= '</div></div>';
                }
            }
        }
        $arrRepairSheet['sheet'] = $strFinalSheet;
        $arrRepairSheet['amount'] = $doubleAmount;
        $arrRepairSheet['repairs_subrepairs_list'] = $arrRepairsAndSubRepairs;
        $arrRepairSheet['vehicle_category_id'] = $intVehicleCategoryId;
        unset($strFinalSheet);
        unset($arrRepairsSource, $arrCollection);
        unset($strHtml);
        unset($doubleAmount);
        unset($arrRepairsAndSubRepairs);
        unset($intVehicleCategoryId);
        return $arrRepairSheet;
    }

    private function sheetBarrier($arrSubRepair, $strRepair, $intServiceId, $intRepairId, $intPlan, $i)
    {
        $strHtml = NULL;
        $doubleAmount = 0.00;
        $strPopUpId = NULL;
        $strPopUpAccess = NULL;
        $strPopUpId = '#myModal' . $i . $intServiceId . $intPlan;
        $strPopUpAccess = 'myModal' . $i . $intServiceId . $intPlan;
        $strHtml .= '<div class="col-md-4">';
        switch ($intServiceId) {
            case 1:
                $strHtml .= '<ul class="list-check">';
                $strHtml .= '<h3 class="block-title">' . $strRepair . '</h3>';
                break;
            case 2:
                $strRepairsList = json_encode($arrSubRepair[0]);

                if (2 == $arrSubRepair[0]['is_recommended']) { // 2 => editable => suggested
                    $strHtml .= '<input type="checkbox" name ="per_isr_' . $intRepairId . $intPlan . '" id ="per_isr_' . $intRepairId . $intPlan . '" class="periodic_suggested pull-left" onclick="getRepairAmount(\'' . htmlentities($strRepairsList) . '\');"></input><a data-toggle="modal" data-target="' . $strPopUpId . '"><h3 class="block-title">' . $strRepair . '</h3></a>';
                    $strHtml .= '<div class="modal fade" id="' . $strPopUpAccess . '" role="dialog">';
                    $strHtml .= '<div class="modal-dialog">';
                    $strHtml .= '<div class="modal-content">';
                    $strHtml .= '<div class="modal-header">';
                    $strHtml .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                    $strHtml .= '<h4 class="modal-title">' . $strRepair . '</h4>';
                    $strHtml .= '</div>';
                    $strHtml .= '<div class="modal-body">';
                    $strHtml .= '<ul class="list-check">';
                } else if (1 == $arrSubRepair[0]['is_recommended']) { // 1 => non editable => recommended
                    $strHtml .= '<a data-toggle="modal" data-target="' . $strPopUpId . '"><h3 class="block-title">' . $strRepair . '</h3></a>';
                    $strHtml .= '<div class="modal fade" id="' . $strPopUpAccess . '" role="dialog">';
                    $strHtml .= '<div class="modal-dialog">';
                    $strHtml .= '<div class="modal-content">';
                    $strHtml .= '<div class="modal-header">';
                    $strHtml .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                    $strHtml .= '<h4 class="modal-title">' . $strRepair . '</h4>';
                    $strHtml .= '</div>';
                    $strHtml .= '<div class="modal-body">';
                    $strHtml .= '<ul class="list-check">';
                }

                break;
            case 3:
                $arrSubRepair[0]['service_unique_id'] = 'rep_isr';
                $strRepairsList = json_encode($arrSubRepair[0]);
                $strHtml .= '<ul class="list-check">';
                $strHtml .= '<h3 class="block-title"><input type="checkbox" class="repair_service" name ="rep_isr_' . $intRepairId . $intPlan . '" id ="rep_isr_' . $intRepairId . $intPlan . '" onclick="getRepairAmount(\'' . htmlentities($strRepairsList) . '\');">' . $strRepair . '</input></h3></font>';
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        }

        foreach ($arrSubRepair as $eleSubRepair) {
            $arrRepairsAndSubRepairs[] = array(
                $eleSubRepair['repairId'] => $eleSubRepair['repairs_lists_id'] . '_' . $eleSubRepair['cost']
            );
            $strHtml .= '<li>' . $eleSubRepair['repairListName'] . '</li>';
            if (1 == $eleSubRepair['is_recommended']) { // Periodic Services => Recommended
                $doubleAmount = $doubleAmount + $eleSubRepair['cost'];
            } else if (0 == $eleSubRepair['is_recommended']) { // General Services
                $doubleAmount = $doubleAmount + $eleSubRepair['cost'];
            }
        }
        $strHtml .= '</ul>';
        $strHtml .= '</div></div></div></div></div>';
        unset($arrSubRepair);
        unset($strRepair, $intServiceId, $intRepairId);
        return $strHtml . '$' . $doubleAmount;
    }

    // public function actionDoEncrypt() {
    // $strMerchantData = NULL;
    // $arrPaymentData = array();
    // $arrInputs = $_POST;
    // $arrPaymentData = array(
    // 'billing_name' => isset($arrInputs['name']) ? $arrInputs['name'] : NULL,
    // 'billing_address' => $arrInputs['address1'] . $arrInputs['address2'],
    // 'billing_city' => isset($arrInputs['city']) ? $arrInputs['city'] : NULL,
    // 'billing_tel' => isset($arrInputs['phone']) ? $arrInputs['phone'] : NULL,
    // 'billing_email' => isset($arrInputs['email']) ? $arrInputs['email'] : NULL,
    // 'amount' => Yii::app()->session['total_amount'],
    // 'order_id' => Yii::app()->session['order_number'],
    // 'merchant_id' => Yii::app()->params['payment_keys']['ccavenue']['merchant_id'],
    // 'redirect_url' => Yii::app()->params['payment_keys']['ccavenue']['redirect_url'],
    // 'cancel_url' => Yii::app()->params['payment_keys']['ccavenue']['cancel_url'],
    // 'language' => Yii::app()->params['payment_keys']['ccavenue']['language'],
    // 'currency' => Yii::app()->params['payment_keys']['ccavenue']['currency'],
    // 'tid' => CommonFunctions::getToken(10),
    // );
    // if (!empty($arrPaymentData)) {
    // foreach ($arrPaymentData as $strPaymentKey => $strPaymentValue) {
    // $strMerchantData .= $strPaymentKey . '=' . $strPaymentValue . '&';
    // }
    // }
    // $strEncypted = Payment::encrypt($strMerchantData, Yii::app()->params['payment_keys']['ccavenue']['working_key']);
    // echo $strEncypted;
    // }
    //
    // public function actionPaymentResponse() {
    //
    // $workingKey = Yii::app()->params['payment_keys']['ccavenue']['working_key'];
    // $encResponse = $_POST["encResp"];
    // $rcvdString = decrypt($encResponse, $workingKey);
    // $strPaymentStatus = "";
    // $decryptValues = explode('&', $rcvdString);
    // $dataSize = sizeof($decryptValues);
    //
    // for ($i = 0; $i < $dataSize; $i++) {
    // $arrResponse = explode('=', $decryptValues[$i]);
    // if ($i == 3)
    // $strPaymentStatus = $arrResponse[1];
    // }
    // $arrStatus = Yii::app()->params['payment_status']['ccavenue'][$strPaymentStatus];
    // if ($arrStatus == 1) {
    // echo $ResponseMessage = "Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
    // } else if ($arrStatus == 2) {
    // echo $ResponseMessage = "Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail.";
    // } else if ($arrStatus == 3) {
    // echo $ResponseMessage = "Thank you for shopping with us.However,the transaction has been declined.";
    // } else {
    // echo $ResponseMessage = "Security Error. Illegal access detected.";
    // }
    // echo'<pre>';
    // print_r($decryptValues);
    // die();
    // }
    // public function actionDoEncrypt() {
    // $strMerchantData = NULL;
    // $arrPaymentData = array();
    // $arrInputs = $_POST;
    // $arrOrderInfo = Yii::app()->session['order_info'];
    // $arrPaymentData = array(
    // 'billing_name' => isset($arrInputs['name']) ? $arrInputs['name'] : NULL,
    // 'billing_address' => $arrInputs['address1'] . $arrInputs['address2'],
    // 'billing_city' => isset($arrInputs['city']) ? $arrInputs['city'] : NULL,
    // 'billing_tel' => isset($arrInputs['phone']) ? $arrInputs['phone'] : NULL,
    // 'billing_email' => isset($arrInputs['email']) ? $arrInputs['email'] : NULL,
    // //'amount' => $arrOrderInfo['total_amount'],
    // 'amount' => 1,
    // 'order_id' => Yii::app()->session['order_number'],
    // 'merchant_id' => '105397',
    // 'redirect_url' => 'http://202.56.199.159/mps/bookaservice/index.php/Booking/BookAService/PaymentResponse',
    // 'cancel_url' => 'http://202.56.199.159/mps/bookaservice/index.php/Booking/BookAService/PaymentResponse',
    // 'language' => 'EN',
    // 'currency' => 'INR',
    // //'tid' => CommonFunctions::getToken(10),
    // );
    // if (!empty($arrPaymentData)) {
    // foreach ($arrPaymentData as $strPaymentKey => $strPaymentValue) {
    // $strMerchantData .= $strPaymentKey . '=' . $strPaymentValue . '&';
    // }
    // }
    // $strEncypted = Payment::encrypt($strMerchantData, 'DB1FA0B166DBDD94EA6527B0418BCF8F');
    // echo $strEncypted;
    // }
    //
    // public function actionPaymentResponse() {
    //
    // $workingKey = 'DB1FA0B166DBDD94EA6527B0418BCF8F';
    // $encResponse = $_POST["encResp"];
    // $rcvdString = Payment::decrypt($encResponse, $workingKey);
    // $strPaymentStatus = "";
    // $decryptValues = explode('&', $rcvdString);
    // $dataSize = sizeof($decryptValues);
    // $arrPaymentResponse = array();
    // $arrModifiedPaymentResponse = array();
    // for ($i = 0; $i < $dataSize; $i++) {
    // $arrResponse = explode('=', $decryptValues[$i]);
    // $arrPaymentResponse[] = explode('=', $decryptValues[$i]);
    // if ($i == 3)
    // $strPaymentStatus = $arrResponse[1];
    // }
    //
    // foreach ($arrPaymentResponse as $key => $value) {
    // $arrModifiedPaymentResponse[$value[0]] = $value[1];
    // }
    //
    // //$strOrderStatus = Yii::app()->params['payment_status']['ccavenue'][$strPaymentStatus];
    // $strOrderStatus = isset($arrModifiedPaymentResponse['order_status']) ? $arrModifiedPaymentResponse['order_status'] : NULL;
    // if ($strOrderStatus == 'Success') {
    // $strPaymentMessage = "Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
    // } else if ($strOrderStatus == 'Aborted') {
    // $strPaymentMessage = "But you cancelled the payment.";
    // } else if ($strOrderStatus == 'Failure') {
    // $strPaymentMessage = "However,the transaction has been declined.";
    // } else {
    // $strPaymentMessage = "Security Error. Illegal access detected.";
    // }
    // $arrModifiedPaymentResponse['payment_message'] = $strPaymentMessage;
    // $objSession = Yii::app()->session;
    // $objSession['payment_info'] = $arrModifiedPaymentResponse;
    // $this->actionFinalOrder();
    // return TRUE;
    // }
    public function actionUploadPDF($strFileName, $folder = NULL, $strDestination = 'others')
    {
        $arrImageNames = array();
        if (isset($_FILES['others_file'])) {

            $strFileName = $_FILES['others_file']['name'];
            $intFileSize = $_FILES['others_file']['size'];
            $strFileTemp = $_FILES['others_file']['tmp_name'];
            $strFileType = $_FILES['others_file']['type'];
            $strFileExtension = strtolower(end(explode('.', $_FILES['others_file']['name'])));
            $randString = md5(time()); // encode the timestamp - returns a 32 chars long string
            $fileName = $_FILES['others_file']["name"]; // the original file name
            $splitName = explode(".", $fileName); // split the file name by the dot
            $fileExt = end($splitName); // get the file extension
            $newFileName = strtolower($randString . '.' . $fileExt);

            $fixedPath = realpath(Yii::app()->basePath) . '/../images/uploadimages/' . $strDestination . '/';

            move_uploaded_file($strFileTemp, $fixedPath . $newFileName);

            $arrImageNames['timestampName'] = $newFileName;

            $arrImageNames['original_name'] = $strFileName;
        }
        return $arrImageNames;
    }

    public function actionDoEncrypt_local()
    {
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
            // 'amount' => $arrOrderInfo['total_amount'],
            'amount' => 1,
            'billing_zip' => isset($arrInputs['pincode']) ? $arrInputs['pincode'] : NULL,
            'order_id' => Yii::app()->session['order_number'],
            'merchant_id' => '105397',
            'redirect_url' => 'http://202.56.199.159/mps/bookaservice/index.php/Booking/BookAService/PaymentResponse',
            'cancel_url' => 'http://202.56.199.159/mps/bookaservice/index.php/Booking/BookAService/PaymentResponse',
            'language' => 'EN',
            'currency' => 'INR'
            // 'tid' => CommonFunctions::getToken(10),
        );
        if (! empty($arrPaymentData)) {
            foreach ($arrPaymentData as $strPaymentKey => $strPaymentValue) {
                $strMerchantData .= $strPaymentKey . '=' . $strPaymentValue . '&';
            }
        }
        $strEncypted = Payment::encrypt($strMerchantData, 'DB1FA0B166DBDD94EA6527B0418BCF8F');
        echo $strEncypted;
    }

    public function actionPaymentResponse_local()
    {
        $workingKey = 'DB1FA0B166DBDD94EA6527B0418BCF8F';
        $encResponse = $_POST["encResp"];
        $intOrder = isset($encResponse['order_id']) ? $encResponse['order_id'] : 0;
        $strCRN = CommonFunctions::getNumberToken(4);
        $strCRN = 'DELV-' . $strCRN;
        $rcvdString = Payment::decrypt($encResponse, $workingKey);
        $strPaymentStatus = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        $arrPaymentResponse = array();
        $arrModifiedPaymentResponse = array();
        for ($i = 0; $i < $dataSize; $i ++) {
            $arrResponse = explode('=', $decryptValues[$i]);
            $arrPaymentResponse[] = explode('=', $decryptValues[$i]);
            if ($i == 3)
                $strPaymentStatus = $arrResponse[1];
        }

        foreach ($arrPaymentResponse as $key => $value) {
            $arrModifiedPaymentResponse[$value[0]] = $value[1];
        }

        // $strOrderStatus = Yii::app()->params['payment_status']['ccavenue'][$strPaymentStatus];
        $strOrderStatus = isset($arrModifiedPaymentResponse['order_status']) ? $arrModifiedPaymentResponse['order_status'] : NULL;
        if ($strOrderStatus == 'Success') {
            $arrOrderDetails = Orders::orderInfo(NULL, $intOrder);
            Orders::updateOrderStatus($intOrder, NULL, array(
                'status' => '1',
                'crn' => $strCRN
            ));
            $this->actionSendOtherService(array(
                'other_mobile' => $arrOrderDetails['customer_phone'],
                'CRN' => $strCRN,
                'order_number' => $arrOrderDetails['order_number'],
                'total_amount' => $arrOrderDetails['final']
            ), 1);
            unset($strCRN, $arrOrderDetails);
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

    public function actionDoEncrypt()
    {
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
            'amount' => $arrOrderInfo['total_amount'],
            // 'amount' => 1,
            'billing_zip' => isset($arrInputs['pincode']) ? $arrInputs['pincode'] : NULL,
            'order_id' => Yii::app()->session['order_number'],
            'merchant_id' => Yii::app()->params['payment_keys']['ccavenue']['merchant_id'],
            // 'redirect_url' => 'http://202.56.199.159/mps/bookaservice/index.php/Booking/BookAService/PaymentResponse',
            // 'cancel_url' => 'http://202.56.199.159/mps/bookaservice/index.php/Booking/BookAService/PaymentResponse',
            'redirect_url' => Yii::app()->params['payment_keys']['ccavenue']['redirect_url'],
            'cancel_url' => Yii::app()->params['payment_keys']['ccavenue']['cancel_url'],
            'language' => 'EN',
            'currency' => 'INR'
            // 'tid' => CommonFunctions::getToken(10),
        );
        if (! empty($arrPaymentData)) {
            foreach ($arrPaymentData as $strPaymentKey => $strPaymentValue) {
                $strMerchantData .= $strPaymentKey . '=' . $strPaymentValue . '&';
            }
        }
        $strEncypted = Payment::encrypt($strMerchantData, Yii::app()->params['payment_keys']['ccavenue']['working_key']);
        echo $strEncypted;
    }

    public function actionPaymentResponse()
    {
        $workingKey = Yii::app()->params['payment_keys']['ccavenue']['working_key'];
        $encResponse = $_POST["encResp"];
        $rcvdString = Payment::decrypt($encResponse, $workingKey);
        $strPaymentStatus = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        $arrPaymentResponse = array();
        $arrModifiedPaymentResponse = array();
        for ($i = 0; $i < $dataSize; $i ++) {
            $arrResponse = explode('=', $decryptValues[$i]);
            $arrPaymentResponse[] = explode('=', $decryptValues[$i]);
            if ($i == 3)
                $strPaymentStatus = $arrResponse[1];
        }

        foreach ($arrPaymentResponse as $key => $value) {
            $arrModifiedPaymentResponse[$value[0]] = $value[1];
        }

        // $strOrderStatus = Yii::app()->params['payment_status']['ccavenue'][$strPaymentStatus];
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

    public function actionTest()
    {
        // http://api.smscountry.com/SMSCwebservice_bulk.aspx
        // User=chandu4130
        // passwd=Metre@2016
        // mobilenumber=9705999270
        // message=hiii
        // sid=smscntry
        // mtype=N
        // DR=Y
        //
        // Please Enter Your Details
        $user = "chandu4130"; // your username
        $password = "Metre@2016"; // your password
        $mobilenumbers = "9494005552"; // enter Mobile numbers comma seperated
        $message = "Yay! Metre Per Second OTP is 1234. Happy to help with all your vehicle needs."; // enter Your Message
        $senderid = "MPSMSG"; // Your senderid
        $messagetype = "N"; // Type Of Your Message
        $DReports = "Y"; // Delivery Reports
        $url = "http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
        $message = urlencode($message);

        $ch = curl_init();
        if (! $ch) {
            die("Couldn't initialize a cURL handle");
        }
        $ret = curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
        $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // If you are behind proxy then please uncomment below line and provide your proxy ip with port.
        // $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
        $curlresponse = curl_exec($ch); // execute
        if (curl_errno($ch))
            echo 'curl error : ' . curl_error($ch);
        if (empty($ret)) {
            // some kind of an error happened
            die(curl_error($ch));
            curl_close($ch); // close cURL handler
        } else {
            $info = curl_getinfo($ch);
            curl_close($ch); // close cURL handler
                             // echo "";
            echo $curlresponse; // echo "Message Sent Succesfully" ;
        }
    }

    public function actionAuth()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://carpm.in/users/sign_in");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"user\": {\"email\": \"rk@metrepersecond.com\", \"password\": \"rakesh@carpm\"}}");
        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "Accept: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        echo $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }

    public function actionGetReports()
    {
        $ch = curl_init();
        $strFromDate = '2017-01-01';
        $strToDate = '2017-05-01';
        curl_setopt($ch, CURLOPT_URL, "http://carpm.in/user_car_models/get_reports?from_date=$strFromDate&to_date=$strToDate");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        $headers = array();
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";
        $headers[] = "X-User-Email: rk@metrepersecond.com";
        $headers[] = "X-User-Token: nzzYx2BszLRqvS1YXT4R";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        echo $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }

    public function actionGetPlate()
    {
        $arrInputs = $_POST;
        // $strLicensePlate = 'AP28DW4500';
        $strLicensePlate = $arrInputs['license_plate'];
        $strMechanicEmail = 'rk%2Bapp@metrepersecond.com';
        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();
        $strURL = "https://carpm.in/mechanic/reports/get_report?license_plate=$strLicensePlate&mechanic_email=$strMechanicEmail";
        curl_setopt($ch, CURLOPT_URL, $strURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        $headers = array();
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";
        $headers[] = "X-User-Email: rk@metrepersecond.com";
        $headers[] = "X-User-Token: nzzYx2BszLRqvS1YXT4R";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        echo $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }

    public function actionAsapBooking()
    {
        $intVehicleType = 1; // 1 => Car
        $intStatus = 1;
        $arrVehicle = $this->getVehicleDetails($intVehicleType, $intStatus);
        $this->render('/Booking/AsapService', array(
            'services' => $arrVehicle['serviceTypes'],
            'makes' => $arrVehicle['vehicleBrands']
        ));
    }

    public function actionSaveAsapService()
    {
        $arrResponse = [];
        $arrInputs = $_POST;
        if (! empty($arrInputs)) {
            $objBookAsapServiceForm = new BookAsapServiceForm();
            $objBookAsapServiceForm->attributes = $arrInputs;
            if ($objBookAsapServiceForm->validate()) {
                $arrValidatedInputs = $objBookAsapServiceForm->attributes;
            } else {
                $arrResponse['errors'] = $objBookAsapServiceForm->errors;
            }
        }
        echo json_encode($arrResponse);
    }

    public function actionGetVehicleModels()
    {
        $strVehicleModel = '<option value="">--Choose Model--</option>';
        if (Yii::app()->request->isPostRequest) {
            $intVehicleBrandType = $_POST['brandId'];
            $arrVehicleModels = VehicleBrandModels::getVehicleBrandModels($intVehicleBrandType);
            if (! empty($arrVehicleModels)) {
                foreach ($arrVehicleModels as $arrModel) {
                    $strVehicleModel .= '<option value="' . $arrModel['id'] . '">' . $arrModel['name'] . '</option>';
                }
            }
        }
        echo $strVehicleModel;
    }
}

?>
