<?php

class VehicleVariants extends CActiveRecord {

    public $strTable = 'vehicle_variants';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param integer $intStatus
     * @return array It will return VehicleVariants
     */
    public static function getVehicleVeriants($intStatus = 1) {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('v.id,v.name,v.code');
        $objectDB->from('vehicle_variants as v');
        $objectDB->where('v.status=:status', array(':status' => $intStatus));
        $arrVehicleTypes = $objectDB->queryAll();
        return $arrVehicleTypes;
    }

}
