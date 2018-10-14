<?php

class UserServiceController extends Controller {

    public function actionVehicleByCategory() {
        $strCategoryid = NULL;
        $VehicleCategories = '<option value=""> -- Select Category -- </option>';
        if (Yii::app()->request->isPostRequest) {
            $intVehicleId = $_POST['veh_type'];

            $arrVehicleCategories = VehicleCategory_Model::getCategories($intVehicleId);

            if (!empty($arrVehicleCategories)) {
                foreach ($arrVehicleCategories as $arrVehicleCategory) {
                    $VehicleCategories .= '<option  value = ' . $arrVehicleCategory['id'] . '>' . $arrVehicleCategory['name'] . '</option>';
                }
            }
        }
        echo $VehicleCategories;
    }

    public function actionVehicleByServices() {
        $strCategoryid = NULL;
        $arrVehicleService = '<option value="">-- Select Vehicle Type -- </option>';
        if (Yii::app()->request->isPostRequest) {
            $intVehicleId = $_POST['veh_type'];

            $arrVehicleServices = VehicleServiceType_Model::getVehicleServices($intVehicleId);

            if (!empty($arrVehicleServices)) {

                foreach ($arrVehicleServices as $arrVehicleServiceNames) {
                    $arrVehicleService .= '<option value = ' . $arrVehicleServiceNames['id'] . '>' . $arrVehicleServiceNames['name'] . '</option>';
                }
            }
        }
        echo $arrVehicleService;
    }

    public function actionVehicleServiceByPlans() {
        $strPlanid = NULL;
        $arrVehicleServices_Plan = '';
        if (Yii::app()->request->isPostRequest) {
            $service_id = $_POST['service_id'];


            $arrVehicleServicesPlans = ServiceByPlan_Model::getVehicleServiceByPlans($service_id);

            if (!empty($arrVehicleServicesPlans)) {

                foreach ($arrVehicleServicesPlans as $arrVehicleServicesPlan) {
                    if ($arrVehicleServicesPlan['name'] != 'Bike') {
                        $arrVehicleServices_Plan .= '<option value = ' . $arrVehicleServicesPlan['id'] . '>' . $arrVehicleServicesPlan['name'] . '</option>';
                    }
                }
            }
        }

        echo $arrVehicleServices_Plan;
    }

    public function actionAddCategory() {
        $arrResponse = array();

        $objUserAddService = array();
        $arrCategoryResponse = array();

        $arrErrors = array();

        if (isset($_POST['add_cat'])) {



            $objCategory = new VehicleCategoryForm();
            $objCategory->attributes = $_POST;

            if ($objCategory->validate()) {
                $objectTransaction = Yii::app()->db->beginTransaction();
                $objectDataManager = new DataManager();

                $objAddCategories = $objectDataManager->makeData($objCategory->attributes);
                $intCategoryId = $this->AddCategories($objAddCategories);

                //$intSubRepairId = $this->AddVehiclesRepairList($intRepairId,$objAddUserRepairName);

                if (!empty($intCategoryId)) {
                    $objectTransaction->commit();
                } else {
                    $objectTransaction->rollback();
                }
                $arrCategoryResponse = array('type' => 'success', 'data' => 'Category added successfully.', 'message' => 'Category added successfully.', 'code' => 200);
            } else {
                $arrErrors = $objCategory->errors;
            }
        }
        $arrCategoryDetails = VehicleCategories::model()->fetchVehicleCategoryDetails();

        $this->render('/UserService/AddCategory', array('errors' => $arrErrors, 'response' => $arrCategoryResponse, 'CategoryDetails' => $arrCategoryDetails));
    }

    public function actionAddPlans() {

        $arrResponse = array();

        $objUserAddService = array();
        $arrPlanResponse = array();
        $arrErrors = array();

        if (isset($_POST['add_plan'])) {
            $objVehiclePlan = new VehiclePlanForm();
            $objVehiclePlan->attributes = $_POST;

            if ($objVehiclePlan->validate()) {
                $objectTransaction = Yii::app()->db->beginTransaction();
                $objectDataManager = new DataManager();

                $objAddVehicle_Plans = $objectDataManager->makeData($objVehiclePlan->attributes);
                $intVehiclePlanId = $this->AddPlanTypes($objAddVehicle_Plans);
                if (!empty($intVehiclePlanId)) {
                    $objectTransaction->commit();
                } else {
                    $objectTransaction->rollback();
                }
                $arrPlanResponse = array('type' => 'success', 'data' => 'Plan added successfully.', 'message' => 'Plan added successfully.', 'code' => 200);
            } else {
                $arrErrors = $objVehiclePlan->errors;
            }
        }
        $arrPlanDetails = Plan_Types::model()->fetchPlanDetails();
        $this->render('/UserService/AddPlanType', array('errors' => $arrErrors, 'response' => $arrPlanResponse, "PlanDetails" => $arrPlanDetails));
    }

    public function actionLogin() {

        $model = new MPSUSER;
        if (!Yii::app()->user->isGuest) {
            $this->redirect(array('login'));
        }
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['MPSUSER'])) {

            $model->attributes = $_POST['MPSUSER'];
            Yii::app()->session['username'] = $_POST['MPSUSER'];
            // validate user input and redirect to the previous page if valid
            if ($model->login()) {


                $this->redirect('dashboard');
            } else {
                
            }
        }


        $this->renderPartial('login', array('model' => $model));
    }

    public function actionGetRepairs() {
        $strRepairLists = NULL;
        $strVehicleRepairs = '';
        $arrRepair_Names = Repairs_Model::getRepairs();
        // print_r($arrRepair_Names);
        if (!empty($arrRepair_Names)) {
            foreach ($arrRepair_Names as $arrRepair_Name) {
                $strVehicleRepairs .= '<option id="' . $arrRepair_Name['id'] . '" value="' . $arrRepair_Name['id'] . '">' . $arrRepair_Name['name'] . '</option>';
            }
        }

        echo $strVehicleRepairs;
    }

    public function actionGetSubRepairs() {
        $strSubRepid = NULL;
        $arrVehicleSubRepairs_Names = '<option value=""> -- Select Repair List -- </option>';
        if (Yii::app()->request->isPostRequest) {
            $intRepairId = $_POST['repairlist_id'];

            $arrVehicleSubRepairs = RepairLists_Model::getSubRepairs($intRepairId);

            if (!empty($arrVehicleSubRepairs)) {

                foreach ($arrVehicleSubRepairs as $arrVehicleSubRepair) {
                    $arrVehicleSubRepairs_Names .= '<option value = ' . $arrVehicleSubRepair['id'] . '>' . $arrVehicleSubRepair['name'] . '</option>';
                }
            }
        }
        echo $arrVehicleSubRepairs_Names;
    }

    /**
     * @author Digital Today
     * @return array It will return an array response
     */
    public function actionRepairs() {
        $arrResponse = array();
        $arrErrors = array();
        $arrRepairs = Repairs::model()->repairsReport();
        if (isset($_POST['create_repair'])) {
            //$arrResponse = array('message' => 'Oops error occured. Please try again.'); 
            $objRepairForm = new RepairForm();
            $objRepairForm->attributes = $_POST;
            if ($objRepairForm->validate()) {
                $objDataManager = new DataManager();
                $arrNewRepair = $objDataManager->makeData($objRepairForm->attributes);
                $intRepair = Repairs::create($arrNewRepair);
                if (!empty($intRepair)) {
                    $arrResponse = array('message' => 'New Repair Item Added Successfully.', 'repair_id' => $intRepair);
                }
                unset($arrNewRepair);
                unset($intRepair);
            } else {
                $arrErrors = $objRepairForm->errors;
            }
        }
        $this->render('/UserService/Repairs', array("repairs" => $arrRepairs, 'errors' => $arrErrors, 'response' => $arrResponse));
    }

    public function actionEditRepairs() {
        $intRepairId = Yii::app()->request->getParam('id');
        $arrRepairDetails = array();
        $arrErrors = array();
        $arrRepairs = Repairs::model()->repairsReport();
        $objRepairForm = NULL;
        if (!empty($intRepairId)) {
            $arrRepairDetails = Repairs::model()->repairsReport(array('id' => $intRepairId));
             //print_r($arrRepairDetails);die();

            if (isset($_POST['create_repair'])) {
                try {
                    $objRepairForm = new RepairForm();
                    $objRepairForm->attributes = $_POST;

                    $objRepairForm->id = $intRepairId;

                    if ($objRepairForm->validate()) {

                        $ip_address = Yii::app()->request->userHostAddress;
                        $intVendorId = isset(Yii::app()->session['user_id']) ? Yii::app()->session['user_id'] : NULL;
                        $arrModifiedData = array_merge($objRepairForm->attributes, array('last_modified_by' => $intVendorId, 'ip_address' => $ip_address));
                        $objDataManager = new DataManager();
                        $arrModifiedData = $objDataManager->modifyRepairs($arrModifiedData);
                        $intRepair = Repairs::updateRepairs($arrModifiedData, $intRepairId);
                        if (!empty($intRepair)) {
                            Yii::app()->user->setFlash('success', Yii::t('common', 'common.form.update_success', array('{alias}' => $arrModifiedData['name'])));
                        } else {
                            Yii::app()->user->setFlash('failure', Yii::t('common', 'common.form.add_failure'));
                        }
                        Yii::app()->controller->refresh();
                    } else {
                        $arrErrors = $objRepairForm->errors;
                    }
                } catch (Exception $e) {
                    $arrResponse = array('type' => 'fail', 'data' => $e->getMessage(), 'code' => $e->getCode(), 'success' => 'fail');
                }
            }
        }
        //print_r($arrVehicleDetails);die();
        $this->render('/UserService/Repairs', array('errors' => $arrErrors, 'RepairForm' => $objRepairForm, 'repair_details' => $arrRepairDetails, 'repairs' => $arrRepairs));
    }

    /**
     * @author Digital Today
     * @return array It will return an array response
     */
    public function actionRepairList() {
        $arrResponse = array();
        $arrErrors = array();
        $arrRepairs = Repairs::model()->repairsReport();
        $arrRepairsList = RepairLists::model()->repairsListReport();
        if (isset($_POST['create_repair_list'])) {
            //$arrResponse = array('message' => 'Oops error occured. Please try again.');
            $objRepairListForm = new RepairListForm();
            $objRepairListForm->attributes = $_POST;
            if ($objRepairListForm->validate()) {
                $objDataManager = new DataManager();
                $arrNewRepairList = $objDataManager->makeData($objRepairListForm->attributes);
                $intRepairList = RepairLists::create($arrNewRepairList);
                if (!empty($intRepairList)) {
                    $arrResponse = array('message' => 'New Repair List Item Added Successfully.', 'repair_list_id' => $intRepairList);
                }
                unset($arrNewRepairList);
                unset($intRepairList);
            } else {
                $arrErrors = $objRepairListForm->errors;
            }
        }
        $this->render('/UserService/RepairsList', array("repairs" => $arrRepairs, 'repairs_lists' => $arrRepairsList, 'errors' => $arrErrors, 'response' => $arrResponse));
    }

    public function actionEditRepairList() {
        $intRepairListId = Yii::app()->request->getParam('id');
        $arrRepairListDetails = array();
        $arrErrors = array();
        $arrRepairsList = RepairLists::model()->repairsListReport();
        $arrRepairs = Repairs::model()->repairsReport();
        $objRepairListForm = NULL;
        if (!empty($intRepairListId)) {
            $arrRepairListDetails = RepairLists::model()->repairsListReport(array('id' => $intRepairListId));
            $arrRepairs = Repairs::model()->repairsReport();
            if (isset($_POST['create_repair_list'])) {
                try {
                    $objRepairListForm = new RepairListForm();
                    $objRepairListForm->attributes = $_POST;
                    $objRepairListForm->id = $intRepairListId;
                    if ($objRepairListForm->validate()) {
                        $ip_address = Yii::app()->request->userHostAddress;
                        $intVendorId = isset(Yii::app()->session['user_id']) ? Yii::app()->session['user_id'] : NULL;
                        $arrModifiedData = array_merge($objRepairListForm->attributes, array('last_modified_by' => $intVendorId, 'ip_address' => $ip_address));
                        $objDataManager = new DataManager();
                        $arrModifiedData = $objDataManager->modifyRepairList($arrModifiedData);
                        $intRepairList = RepairLists::updateRepairList($arrModifiedData, $intRepairListId);
                        if (!empty($intRepairList)) {
                            Yii::app()->user->setFlash('success', Yii::t('common', 'common.form.update_success', array('{alias}' => $arrModifiedData['name'])));
                        } else {
                            Yii::app()->user->setFlash('failure', Yii::t('common', 'common.form.add_failure'));
                        }
                        Yii::app()->controller->refresh();
                    } else {
                        $arrErrors = $objRepairListForm->errors;
                    }
                } catch (Exception $e) {
                    $arrResponse = array('type' => 'fail', 'data' => $e->getMessage(), 'code' => $e->getCode(), 'success' => 'fail');
                }
            }
        }
        $this->render('/UserService/RepairsList', array("repairs" => $arrRepairs, 'errors' => $arrErrors, 'RepairListForm' => $objRepairListForm, 'repairlist_details' => $arrRepairListDetails, 'repairs_lists' => $arrRepairsList));
    }

    public function actionRepairListBilling() {
        $arrResponse = array();
        $arrErrors = array();
        $arrRepairs = Repairs::model()->repairsReport();
        $arrVehicles = VehicleTypes::getVehicleTypes();
        if (isset($_POST['do_billing'])) {
            //$arrResponse = array('message' => 'Oops error occured. Please try again.');
            $objRepairBillingForm = new RepairsListBillingForm();
            $objRepairBillingForm->attributes = $_POST;
            if ($objRepairBillingForm->validate()) {
                $objDataManager = new DataManager();
                $arrModifiedBilling = $objDataManager->modifyBilling($objRepairBillingForm->attributes);
                $intBill = VehicleCategoryByRepairsAmount::create($arrModifiedBilling);
                if (!empty($intBill)) {
                    $arrResponse = array('message' => 'Billing Added Successfully.', 'bill_id' => $intBill);
                }
                unset($arrModifiedBilling);
                unset($intBill);
                //$this->refresh();
            } else {
                $arrErrors = $objRepairBillingForm->errors;
            }
        }
        $this->render('/UserService/RepairListBilling', array("repairs" => $arrRepairs, 'vehicle_types' => $arrVehicles, 'errors' => $arrErrors, 'response' => $arrResponse));
    }

    public function actionGetRepairsList() {
        $strRepairList = '<option value="">--Select Repairs List--</option>';
        $arrRepairList = array();
        if (Yii::app()->request->isPostRequest) {
            $intRepair = $_POST['repair_id'];
            $arrRepairList = RepairLists::repairsListReport(array('repair_id' => $intRepair));
            if (!empty($arrRepairList)) {
                foreach ($arrRepairList as $arrEleRepairList) {
                    $strRepairList .= '<option value="' . $arrEleRepairList['id'] . '">' . $arrEleRepairList['name'] . '</option>';
                }
            }
            unset($arrRepairList);
            unset($intRepair);
        }
        echo $strRepairList;
    }

    public function actionGetServicesList() {
        $strService = '<option value="">--Select Service--</option>';
        $arrServices = array();
        if (Yii::app()->request->isPostRequest) {
            $intStatus = 1;
            $intVehicle = $_POST['vehicle_id'];
            $arrServices = VehicleServiceTypes::getServiceTypes(1, $intVehicle);
            if (!empty($arrServices)) {
                foreach ($arrServices as $arrEleServices) {
                    $strService .= '<option value="' . $arrEleServices['id'] . '">' . $arrEleServices['name'] . '</option>';
                }
            }
            unset($arrServices);
            unset($intStatus, $intVehicle);
        }
        echo $strService;
    }

    public function actionPlans() {
        $strPlan = '<option value="">--Select Plan--</option>';
        $arrServices = array();
        if (Yii::app()->request->isPostRequest) {
            $intVehicle = $_POST['vehicle_id'];
            $intService = $_POST['service_id'];
            $arrPlans = ServicePlans::getServicePlans($intVehicle, $intService);
            if (!empty($arrPlans)) {
                foreach ($arrPlans as $arrElePlan) {
                    $strPlan .= '<option value="' . $arrElePlan['planId'] . '">' . $arrElePlan['name'] . '</option>';
                }
            }
            unset($arrPlans);
            unset($intVehicle, $intService);
        }
        echo $strPlan;
    }

    public function actionBillingReport() {
        $arrInput = $_POST;
        $arrRepairs = Repairs::repairsReport();
        $arrBillingDetails = VehicleCategoryByRepairsAmount::billingReport($arrInput);
        $this->render('/UserService/BillingReport', array('billing_details' => $arrBillingDetails, 'arrRepairs' => $arrRepairs,
        ));
    }

    public function actionUpdateBillingReport() {
        if (Yii::app()->request->isPostRequest) {
            $arrInput = $_POST;
            $Update = VehicleCategoryByRepairsAmount::UpdateBillingReport($arrInput);
            echo 'Updated Successfully';
            exit;
        }
    }

}
