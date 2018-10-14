<?php

class OtherOrdersBilling extends CActiveRecord {

    public $strTable = 'other_orders_billing';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function create($arrOrderBilling) {
        $intOrderBilling = NULL;
        $obectjOrderBilling = new OtherOrdersBilling();
        $obectjOrderBilling->other_orders_id = $arrOrderBilling['other_orders_id'];
        $obectjOrderBilling->basic = $arrOrderBilling['basic'];
        $obectjOrderBilling->final = $arrOrderBilling['final'];
        $obectjOrderBilling->tax = $arrOrderBilling['tax'];
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
        $intUpdate = $objCommand->update('other_orders_billing', $arrOrderBilling, 'order_id=:orderId', array(':orderId' => $intOrder));
        return $intUpdate;
    }

}
