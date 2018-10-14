<?php

class VehicleClasses extends CActiveRecord {

    public $strTable = 'vehicle_classes';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param string $strUsername
     * @return array It will return VehicleTypes data
     */
    public static function getVehicleClasses($intStatus = 1, $intVehicleClass = NULL, $intVehicleTypes = NULL) {
        $arrVehicleTypes = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('v.id,v.name,v.code');
        $objectDB->from('vehicle_classes as v');
        if (!empty($intVehicleClass)) {
            $objectDB->where('v.id=:id', array(':id' => $intVehicleClass));
            $arrVehicleTypes = $objectDB->queryRow();
        } else if (empty($intVehicleTypes) && empty($intVehicleClass)) {
            $objectDB->where('v.status=:status', array(':status' => $intStatus));
            $arrVehicleTypes = $objectDB->queryAll();
        } else if (!empty($intStatus) && !empty($intVehicleTypes)) {
            $objectDB->where('v.vehicle_types_id=:vehicleId and v.status=:status', array(':vehicleId' => $intVehicleTypes, ':status' => $intStatus));
            $arrVehicleTypes = $objectDB->queryAll();
        }
        return $arrVehicleTypes;
    }

}
