<?php

class VehicleTimings extends CActiveRecord {

    public $strTable = 'self_vehicles_timings';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function updateVehicleTimings($arrVehicleData, $intSelfVehicle) {
        $objCommand = Yii::app()->db->createCommand();
        $intUpdate = $objCommand->update('self_vehicles_timings', $arrVehicleData, 'self_vehicles_id=:selfVehicleId', array(':selfVehicleId' => $intSelfVehicle));
        return $intUpdate;
    }

}
