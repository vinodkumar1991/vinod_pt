<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrdersController
 *
 * @author ctel-cpu-33
 */
class OrdersController extends Controller {

    public function actionOrders() {
        $arrOrders = Orders::getBookingOrdersList($intOrder = NULL, $strOrderNo = NULL);
        $this->render('/Reports/Orders/Bookings', array('arrOrders' => $arrOrders));
    }

    //Modification Shops Orders
    public function actionModificationOrders() {
        $objOrders = new Orders();
        $arrModificationOrders = $objOrders->getModificationBookingOrdersList();
        $this->render('/Reports/Orders/ModificationOrders', array('arrModificationOrders' => $arrModificationOrders));
    }

    /* function actionGeneratePDF(){
      //echo 'Hi';exit;
      $mPDF1 = Yii::app()->ePdf->mpdf();

      # You can easily override default constructor's params
      $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');

      $objOrders=new Orders();
      $arrOrders=$objOrders->getBookingOrdersList();

      # render (full page)
      $mPDF1->WriteHTML($this->renderPartial('/Reports/Orders/Bookings',array('arrOrders'=>$arrOrders), true));
      # Outputs ready PDF
      $mPDF1->Output();

      } */

    //Package listing Screen
    public function actionAddPackageAmount() {

        $arrVehicleType = Orders::getVehicleType();
        $arrPlanType = Orders::getPlanType();
        $arrServiceType = Orders::getServiceType();
        $arrPackage = Orders::getServicePackageAmount($ServiceID = NULL);
        $this->render('/Reports/Orders/AddPackageAmount', array('arrPackage' => $arrPackage,
            'arrVehicleType' => $arrVehicleType,
            'arrPlanType' => $arrPlanType,
            'arrServiceType' => $arrServiceType)
        );
    }

    //Ajax View Details
    public function actionViewPackageDetails() {
        if (Yii::app()->request->isPostRequest) {
            $ServiceID = $_POST['Service_ID'];
            $arrDetails = Orders::getServicePackageAmount($ServiceID);
            echo json_encode($arrDetails);
            exit;
        }
    }

    //Ajax  Update the values
    public function actionUpdateServicePackage() {
        if (Yii::app()->request->isPostRequest) {
            $arrInput = $_POST;
            $arrValue = $this->actionPrepareInput($arrInput);
            $arrResponse = Orders::updateServicePackageAmount($arrValue);
            echo 'Updated Successfully';
            exit;
        }
    }

    public function actionPrepareInput($arrInput) {
        $objCommon = new DataManager();
        $arrCommon = $objCommon->getDefaults();
        $arrValue = array_merge($arrInput, $arrCommon);
        return $arrValue;
    }

    public function actionAddVehiclePackageAmount() {
        $arrErrors = array();
        $objPackageForm = NULL;
        $arrVehicles = VehicleTypes::getVehicleTypes();
        $arrPlans = Plan_Types::fetchPlanDetails();
        if (isset($_POST['create_package'])) {
            $objPackageForm = new PackageForm();
            $objPackageForm->attributes = $_POST;
            if ($objPackageForm->validate()) {
                $arrInputs = $_POST;
                $objDataManager = new DataManager();
                $arrModifiedInput = $objDataManager->makeData($arrInputs);
                $intServicePlan = ServicePlans::create($arrModifiedInput);
                Yii::app()->user->setFlash('success', 'Updated Successfully');
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objPackageForm->errors;
            }
        }
        $this->render('/Reports/Orders/AddVehiclePackageAmount', array('errors' => $arrErrors, 'vehicles' => $arrVehicles, 'plans' => $arrPlans, 'packageForm' => $objPackageForm));
    }

    public function actionSelfDriveOrders() {
        $intAgentUserId = 0;
        if (!empty(Yii::app()->session['user_id']) && 6 != Yii::app()->session['role_id']) { // 6 for superadmin
            $intAgentUserId = Yii::app()->session['user_id'];
        }
        $arrOrders = SelfdriveBookings::model()->getOrders(array('agent_user_id' => $intAgentUserId));

        $this->render('/Reports/Orders/SelfDriveOrders', array('orders' => $arrOrders));
    }

    public function actionHireOrders() {
        $arrOrders = HireOrders::model()->getOrders();
        $this->render('/Reports/Orders/HireOrders', array('orders' => $arrOrders));
    }

    public function actionDelayOrders() {
        if (Yii::app()->request->isPostRequest) {
            $arrInput = $_POST;
            if ($arrInput["delayflag"] == 1) {
                $arrDelayOrders = Orders::model()->UpdateDelayOrders(array('order_status' => 14, 'previous_order_status' => $arrInput['order_status']), $arrInput['order_number']);
            } else {
                $arrDelayOrders = Orders::model()->UpdateDelayOrders(array('order_status' => $arrInput['previous_order_status']), $arrInput['order_number']);
            }
            echo $arrDelayOrders;
        }
    }

}
