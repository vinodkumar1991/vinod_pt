<?php

class OrdersBilling extends CActiveRecord {

    public $strTable = 'orders_billing';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function create($arrOrderBilling) {
        $intOrderBilling = NULL;
        $obectjOrderBilling = new OrdersBilling();
        $obectjOrderBilling->order_id = $arrOrderBilling['order_id'];
        $obectjOrderBilling->basic = $arrOrderBilling['basic'];
        $obectjOrderBilling->final = $arrOrderBilling['final'];
        $obectjOrderBilling->tax = $arrOrderBilling['tax'];
        $obectjOrderBilling->extra_add_ons = $arrOrderBilling['extra_add_ons'];
        $obectjOrderBilling->created_date = $arrOrderBilling['created_date'];
        $obectjOrderBilling->created_by = $arrOrderBilling['created_by'];
        $obectjOrderBilling->ip_address = $arrOrderBilling['ip_address'];
        $obectjOrderBilling->device_types_id = $arrOrderBilling['device_types_id'];
        if ($obectjOrderBilling->save()) {
            $intOrderBilling = $obectjOrderBilling->id;
        }
        return $intOrderBilling;
    }

    public static function updateOrderBillingStatus($intOrder, $arrOrderBilling) {
        $objCommand = Yii::app()->db->createCommand();
        $intUpdate = $objCommand->update('orders_billing', $arrOrderBilling, 'order_id=:orderId', array(':orderId' => $intOrder));
        return $intUpdate;
    }

    public static function getBillingDetails($intOrder) {
        $arrOrders = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('round(ob.basic,2) as basic,round(ob.final,2) as final,round(ob.tax,2) as tax,round(ob.extra_add_ons,2) as extra_add_ons');
        $objectDB->from('orders_billing as ob');
        $objectDB->where('ob.order_id=:orderId', array(':orderId' => $intOrder));
        $arrOrders = $objectDB->queryRow();
        return $arrOrders;
    }

}
