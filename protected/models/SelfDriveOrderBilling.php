<?php

class SelfDriveOrderBilling extends CActiveRecord {

    public $strTable = 'self_drive_orders_billing';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrOrder
     * @return integer It will return an integer response
     */
    public static function create($arrOrder) {
        $intSelfDriveOrderBillingId = NULL;
        $objSelfDriveOrderBilling = new SelfDriveOrderBilling();
        $objSelfDriveOrderBilling->self_drive_orders_id = $arrOrder['self_drive_orders_id'];
        $objSelfDriveOrderBilling->basic = $arrOrder['basic'];
        $objSelfDriveOrderBilling->final = $arrOrder['final'];
        $objSelfDriveOrderBilling->tax = $arrOrder['tax'];
        $objSelfDriveOrderBilling->tax_amount = $arrOrder['tax_amount'];
        $objSelfDriveOrderBilling->security_deposit = $arrOrder['security_deposit'];
        $objSelfDriveOrderBilling->invoice_date = $arrOrder['invocie_date'];
        $objSelfDriveOrderBilling->invoice_number = $arrOrder['invocie_number'];
        $objSelfDriveOrderBilling->order_transaction = $arrOrder['order_transaction'];
        $objSelfDriveOrderBilling->transaction_status = $arrOrder['transaction_status'];
        $objSelfDriveOrderBilling->created_date = $arrOrder['created_date'];
        $objSelfDriveOrderBilling->created_by = $arrOrder['created_by'];
        $objSelfDriveOrderBilling->ip_address = $arrOrder['ip_address'];
        $objSelfDriveOrderBilling->device_id = $arrOrder['device_id'];
        if ($objSelfDriveOrderBilling->save()) {
            $intSelfDriveOrderBillingId = $objSelfDriveOrderBilling->id;
        }
        return $intSelfDriveOrderBillingId;
    }

    public static function updateSelfOrderBillingStatus($intOrder, $arrSelfOrderBilling) {
        $objCommand = Yii::app()->db->createCommand();
            $intUpdate = $objCommand->update('self_drive_orders_billing', $arrSelfOrderBilling, 'self_drive_orders_id=:orderId', array(':orderId' => $intOrder));
        return $intUpdate;
    }

}
