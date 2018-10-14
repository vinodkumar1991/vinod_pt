<?php

class VehicleCategories extends CActiveRecord {

    public $strTable = 'vehicle_categories';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param integer $intStatus
     * @return array It will return vehicle categories data
     */
    public static function getVehicleCategories($intStatus = 1, $intVehicle = NULL) {
        $arrVehicleCategories = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vc.id,vc.name,vc.code,vc.description');
        $objectDB->from('vehicle_categories as vc');
        $objectDB->where('vc.status=:status', array(':status' => $intStatus));
        if (!empty($intVehicle)) {
            $objectDB->where('vc.vehicle_types_id=:vehicleTypeId', array(':vehicleTypeId' => $intVehicle));
        }
        if (!empty($intStatus) && !empty($intVehicle)) {
            $objectDB->where('vc.status=:status and vc.vehicle_types_id=:vehicleTypeId', array(':status' => $intStatus, ':vehicleTypeId' => $intVehicle));
        }
        $arrVehicleCategories = $objectDB->queryAll();
        return $arrVehicleCategories;
    }

    public static function fetchVehicleCategoryDetails($intStatus = 1) {
        $arrVehicleCategories = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vc.id,vc.name,vc.code,vc.description,vt.name as VehType,vc.created_date');
        $objectDB->from('vehicle_categories as vc');
        $objectDB->join('vehicle_types vt', 'vc.vehicle_types_id=vt.id');
        $objectDB->where('vc.status=:status', array(':status' => $intStatus));
        $arrVehicleCategories = $objectDB->queryAll();
        return $arrVehicleCategories;
    }
     public static function isCategoryNameExist($strCatName) {
        
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('veh_cat.id');
        $objectDB->from('vehicle_categories as veh_cat');
        $objectDB->where('veh_cat.name=:veh_cat', array(':veh_cat' => $strCatName));
        $arrVehicleCat = $objectDB->queryRow();
        return $arrVehicleCat;
    }
    public static function isCategoryCodeExist($strRepairCode) {
        $arrRepairName = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('veh_cat.id');
        $objectDB->from('vehicle_categories as veh_cat');
        $objectDB->where('veh_cat.code=:code', array(':code' => $strRepairCode));
        $arrVehiclecatCode = $objectDB->queryRow();
        return $arrVehiclecatCode;
    }
     public static function isCategoryDescExist($strCatDesc) {
        $arrRepairName = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('veh_cat.id');
        $objectDB->from('vehicle_categories as veh_cat');
        $objectDB->where('veh_cat.description=:description', array(':description' => $strCatDesc));
        $arrVehiclecatDesc = $objectDB->queryRow();
        return $arrVehiclecatDesc;
    }
    
    
}
