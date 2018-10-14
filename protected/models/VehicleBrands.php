<?php

class VehicleBrands extends CActiveRecord {

    public $strTable = 'vehicle_brands';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param string $strUsername
     * @return array It will return VehicleBrands data
     */
    public static function getVehicleBrands($intStatus = 1, $intVehicleType = NULL, $intVehicleBrands = NULL) {
        $arrVehicleBrands = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('v.id,v.name,v.code,v.logo');
        $objectDB->from('vehicle_brands as v');
        if (!empty($intVehicleBrands)) {
            $objectDB->where('v.id=:id', array(':id' => $intVehicleBrands));
            $arrVehicleBrands = $objectDB->queryRow();
        } elseif (!empty($intVehicleType)) {
            $objectDB->where('v.vehicle_types_id=:vehicleTypeId and v.status=:status', array(':vehicleTypeId' => $intVehicleType, ':status' => $intStatus));
            $arrVehicleBrands = $objectDB->queryAll();
        } else {
            $objectDB->where('v.status=:status', array(':status' => $intStatus));
            $arrVehicleBrands = $objectDB->queryAll();
        }
        return $arrVehicleBrands;
    }

}
