<?php

class VehicleBrandModels extends CActiveRecord {

    public $strTable = 'vehicle_brand_models';

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
    public static function getVehicleBrandModels($intVehicleBrandType, $intStatus = 1) {
        $arrVehicleBrandTypes = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vbm.id,vbm.name,vbm.code,vbm.description,vbm.image_path,vb.name as brand_name');
        $objectDB->from('vehicle_brand_models as vbm');
        $objectDB->join('vehicle_brands vb', 'vb.id = vbm.vehicle_brands_id');
        if (2 == $intStatus) {
            $objectDB->where('vbm.id=:model_id and vbm.status=:status', array(':model_id' => $intVehicleBrandType, ':status' => 1));   
        } else {
            $objectDB->where('vbm.vehicle_brands_id=:vehicleBrandTypeId and vbm.status=:status', array(':vehicleBrandTypeId' => $intVehicleBrandType, ':status' => $intStatus));
        }
        $arrVehicleBrandTypes = $objectDB->queryAll();
        return $arrVehicleBrandTypes;
    }

}
