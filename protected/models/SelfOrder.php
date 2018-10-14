<?php

class SelfOrder extends CActiveRecord {

    public $strTable = 'self_orders';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    
    public static function create($arrAddSelfdriveOrders)
    {
        
        $intAddSelfdriveOrderId = '';
        $strCustomSolider = 'abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012345678910124';
        $arrModifiedOrders['order_number'] = CommonFunctions::getCustomToken($strCustomSolider, 5);
        $objSession = Yii::app()->session;
        $start_time=strtotime($arrAddSelfdriveOrders['FromDate']);
	    $end_time=strtotime($arrAddSelfdriveOrders['ToDate']);
        
        $objSession['order_number'] = $arrModifiedOrders['order_number'];
        $objectSelfOrder = new SelfOrder();
        $objectSelfOrder->customer_id = $arrAddSelfdriveOrders['CustId'];
        $objectSelfOrder->order_no = $arrModifiedOrders['order_number'];
        $objectSelfOrder->self_vehicle_id = $arrAddSelfdriveOrders['SelfDriveId'];
        $objectSelfOrder->start_date = $arrAddSelfdriveOrders['FromDate'];
        $objectSelfOrder->end_date = $arrAddSelfdriveOrders['ToDate'];
        $objectSelfOrder->start_time = $start_time;
        $objectSelfOrder->end_time = $end_time;
        $objectSelfOrder->order_status = 0;
        $objectSelfOrder->created_date = $arrAddSelfdriveOrders['created_date'];
        $objectSelfOrder->created_by = $arrAddSelfdriveOrders['created_by'];
        $objectSelfOrder->ip_address = $arrAddSelfdriveOrders['ip_address'];

        if ($objectSelfOrder->save())
        {
            $intAddSelfdriveOrderId = $objectSelfOrder->id;
			$objSession = Yii::app()->session;
	        $objSession['unique_order_id'] = $intAddSelfdriveOrderId;
        }
        return $intAddSelfdriveOrderId;
    }
	 public static function updateStatus($intOrderId, $intStatus)
    {
		
		$intUpdateStatus = Yii::app()->db->createCommand("UPDATE `self_orders` SET order_status = $intStatus where order_no = '$intOrderId'")->execute();
        return $intUpdateStatus;
	}

   
}
