<?php

class VehicleBrandTypes extends CActiveRecord {

    public $strTable = 'vehicle_brands_types';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param integer $intStatus
     * @return array It will return vehicle brand types
     */
    public static function getVehicleBrandsTypes($intStatus = 1) {
        $arrVehicleBrandTypes = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vbt.id,vbt.name,vbt.code,vbt.description');
        $objectDB->from('vehicle_brands_types as vbt');
        $objectDB->where('vbt.status=:status', array(':status' => $intStatus));
        $arrVehicleBrandTypes = $objectDB->queryAll();
        return $arrVehicleBrandTypes;
    }

}
