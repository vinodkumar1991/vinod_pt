<?php

class OrdersController extends Controller {

    public function actionOrders() {
        $intCustomerId = Yii::app()->session['customerID'];
        $arrCustomerOrders = array();
        if (!empty($intCustomerId)) {
            //Book a service :: START
            $arrCustomerOrders = Orders::getOrders($intCustomerId);
            //Book a service :: END
            //Self drive :: START
            //Self drive :: END
            //Hire a mechanic :: START
            //Hire a mechanic :: END
        }
        $this->render('/Booking/CustomerOrders', array('customer_orders' => $arrCustomerOrders));
    }
    
    public function actionCancelOrder(){
        $arrInputs=$_POST;
        $intCustomerId = Yii::app()->session['customerID'];
        if (!empty($intCustomerId) && !empty($arrInputs['order_id'])) {
            $intStatus = 12;
        $intUpdate=Orders::updateOrderStatus($arrInputs['order_id'], $intStatus);
        echo $intUpdate;
        }
        
    }

}

?>
