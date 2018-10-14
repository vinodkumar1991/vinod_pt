<?php

class SelfVehiclesFeatures extends CActiveRecord {

    public $strTable = 'self_vehicles_features';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getVehicleFeatures($intStatus = 1, $intSelfVehicle = NULL) {
        $arrVehicleImages = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vf.name as feature_name,vf.id as feature_id,vf.image_name as feature_image,(CASE WHEN vf.id > 0 THEN "/vehicle_features/mobile/24x24/" ELSE "/vehicle_features/mobile/48x48/" END) AS vehicle_feature_image_path');
        $objectDB->from('self_vehicles_features as svf');
        $objectDB->join('self_vehicles as sv', 'sv.id = svf.self_vehicles_id');
        $objectDB->join('vehicle_fetures as vf', 'vf.id = svf.vehicle_fetures_id');
        $objectDB->where('svf.status=:status', array(':status' => $intStatus));
        if (!empty($intSelfVehicle)) {
            $objectDB->andWhere('svf.self_vehicles_id=:selfVehicleId', array(':selfVehicleId' => $intSelfVehicle));
        }
        $arrVehicleImages = $objectDB->queryAll();
        return $arrVehicleImages;
    }

}
