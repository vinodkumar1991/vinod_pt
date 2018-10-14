<?php

class SelfOrderBilling extends CActiveRecord {

    public $strTable = 'self_order_billing';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    
    public static function create($arrSelfdriveBillingDetails,$intSelfOrderId)
    {
        $intSelfdriveBillingId = '';
       
        $objectSelfOrderBill = new SelfOrderBilling();
        $objectSelfOrderBill->orderid = $intSelfOrderId;
        $objectSelfOrderBill->basic = $arrSelfdriveBillingDetails['price'];
        $objectSelfOrderBill->final = $arrSelfdriveBillingDetails['price'];
        $objectSelfOrderBill->tax = 0.00;
        $objectSelfOrderBill->created_date = $arrSelfdriveBillingDetails['created_date'];
        $objectSelfOrderBill->created_by = $arrSelfdriveBillingDetails['created_by'];
        $objectSelfOrderBill->ip_address = $arrSelfdriveBillingDetails['ip_address'];
        

        if ($objectSelfOrderBill->save())
        {
            $intSelfdriveBillingId = $objectSelfOrderBill->id;
        }
        return $intSelfdriveBillingId;
    }
	 public static function updateBillingStatus($arrPayData, $intOrderId)
    {
		
		$intUpdateStatus = Yii::app()->db->createCommand("UPDATE `self_order_billing` SET order_transaction='".$arrPayData['tracking_id']."',invoice_number = '".$arrPayData['invoice_number']."',transaction_status = '".$arrPayData['transaction_status']."',invoice_date = '".$arrPayData['invoice_date']."' where orderid = ".$intOrderId."")->execute();
        return $intUpdateStatus;
	}

   
}
