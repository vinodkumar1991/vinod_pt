<?php

class SelfDriveOrdersCommunication extends CActiveRecord {

    public $strTable = 'self_drive_orders_communication';

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
        $intSelfOrderCommunicationId = NULL;
        $objSelfDriveOrderCommunication = new SelfDriveOrdersCommunication();
        $objSelfDriveOrderCommunication->self_drive_orders_id = $arrOrder['self_drive_orders_id'];
        $objSelfDriveOrderCommunication->start_date = $arrOrder['start_date'];
        $objSelfDriveOrderCommunication->start_time = $arrOrder['start_time'];
        $objSelfDriveOrderCommunication->end_date = $arrOrder['end_date'];
        $objSelfDriveOrderCommunication->end_time = $arrOrder['end_time'];
        $objSelfDriveOrderCommunication->location = $arrOrder['location'];
        $objSelfDriveOrderCommunication->latitude = $arrOrder['latitude'];
        $objSelfDriveOrderCommunication->longitude = $arrOrder['longitude'];
        $objSelfDriveOrderCommunication->is_pickup = $arrOrder['is_pickup'];
        $objSelfDriveOrderCommunication->is_drop = $arrOrder['is_drop'];
        $objSelfDriveOrderCommunication->pickup_location = $arrOrder['pickup_location'];
        $objSelfDriveOrderCommunication->pickup_latitude = $arrOrder['pickup_latitude'];
        $objSelfDriveOrderCommunication->pickup_longitude = $arrOrder['pickup_longitude'];
        $objSelfDriveOrderCommunication->drop_location = $arrOrder['drop_location'];
        $objSelfDriveOrderCommunication->drop_latitude = $arrOrder['drop_latitude'];
        $objSelfDriveOrderCommunication->drop_longitude = $arrOrder['drop_longitude'];
        $objSelfDriveOrderCommunication->email = $arrOrder['email'];
        $objSelfDriveOrderCommunication->phone = $arrOrder['phone'];
        $objSelfDriveOrderCommunication->pickup_amount = $arrOrder['pickup_amount'];
        $objSelfDriveOrderCommunication->door_step_amount = $arrOrder['door_step_amount'];
        if ($objSelfDriveOrderCommunication->save()) {
            $intSelfOrderCommunicationId = $objSelfDriveOrderCommunication->id;
        }
        return $intSelfOrderCommunicationId;
    }

}
