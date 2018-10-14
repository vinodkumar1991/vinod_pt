<?php

class OrdersCommunication extends CActiveRecord {

    public $strTable = 'orders_communication';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function create($arrOrderCommunication) {
        $intOrderCommunicationId = NULL;
        $objectOrderCommunication = new OrdersCommunication();
        $objectOrderCommunication->order_id = $arrOrderCommunication['order_id'];
        $objectOrderCommunication->name = $arrOrderCommunication['name'];
        $objectOrderCommunication->additional_info = $arrOrderCommunication['additional_info'];
        $objectOrderCommunication->door_no = $arrOrderCommunication['door_no'];
        $objectOrderCommunication->address_one = $arrOrderCommunication['address_one'];
        $objectOrderCommunication->address_two = $arrOrderCommunication['address_two'];
        $objectOrderCommunication->pincode = $arrOrderCommunication['pincode'];
        $objectOrderCommunication->email = $arrOrderCommunication['email'];
        $objectOrderCommunication->alternate_email = $arrOrderCommunication['alternate_email'];
        $objectOrderCommunication->phone = $arrOrderCommunication['phone'];
        $objectOrderCommunication->alternate_phone = $arrOrderCommunication['alternate_phone'];
        $objectOrderCommunication->location = $arrOrderCommunication['location'];
        $objectOrderCommunication->latitude = $arrOrderCommunication['latitude'];
        $objectOrderCommunication->longitude = $arrOrderCommunication['longitude'];
        $objectOrderCommunication->pickup_date = $arrOrderCommunication['pickup_date'];
        $objectOrderCommunication->pickup_time = $arrOrderCommunication['pickup_time'];
        $objectOrderCommunication->imei_no = isset($arrOrderCommunication['imei_no']) ? $arrOrderCommunication['imei_no'] : NULL;
        if ($objectOrderCommunication->save()) {
            $intOrderCommunicationId = $objectOrderCommunication->id;
        }
        return $intOrderCommunicationId;
    }

}
