<?php

class VehicleFeatures extends CActiveRecord {

    public $strTable = 'vehicle_fetures';

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
    public static function getVehicleFeatures($intStatus = 1, $intVehicleFeature = NULL, $intVehicle = NULL) {
        $arrVehicleTypes = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('v.id,v.name,v.code');
        $objectDB->from('vehicle_fetures as v');
        //Vehicle Feature
        if (!empty($intVehicleFeature)) {
            $objectDB->where('v.id=:id', array(':id' => $intVehicleFeature));
            $arrVehicleTypes = $objectDB->queryRow();
        } else if (empty($intVehicleFeature) && empty($intVehicle)) {
            $objectDB->where('v.status=:status', array(':status' => $intStatus));
            $arrVehicleTypes = $objectDB->queryAll();
        } else if (!empty($intStatus) && !empty($intVehicle)) {
            $objectDB->where('v.status=:status and v.vehicle_types_id=:vehicleId', array(':status' => $intStatus, ':vehicleId' => $intVehicle));
            $arrVehicleTypes = $objectDB->queryAll();
        }

        return $arrVehicleTypes;
    }

    public static function create($arrModifiedInput) {
        $intVehicleFeatureId = NULL;
        $objVehicleFeature = new VehicleFeatures();
        $objVehicleFeature->name = $arrModifiedInput['vehicle_feature_name'];
        $objVehicleFeature->code = $arrModifiedInput['vehicle_feature_code'];
        $objVehicleFeature->description = $arrModifiedInput['vehicle_feature_description'];
        $objVehicleFeature->status = $arrModifiedInput['vehicle_feature_status'];
        $objVehicleFeature->created_date = $arrModifiedInput['created_date'];
        $objVehicleFeature->created_by = $arrModifiedInput['created_by'];
        $objVehicleFeature->ip_address = $arrModifiedInput['ip_address'];
        $objVehicleFeature->image_name = $arrModifiedInput['timestampName'];
        $objVehicleFeature->image_original_name = $arrModifiedInput['original_name'];
        $objVehicleFeature->vehicle_types_id = $arrModifiedInput['vehicle_id'];

        if ($objVehicleFeature->save()) {
            $intVehicleFeatureId = $objVehicleFeature->id;
        }
        return $intVehicleFeatureId;
    }

    public static function vehiclefeatureReport($arrInputs = array()) {
        $arrVehicleFeature = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vf.id,vf.name,vf.code,vf.description,vf.status,vf.image_name,vt.id as vehicle_type_id,vt.name as vehicle_type_name,vf.image_name as feature_image');
        $objectDB->from('vehicle_fetures as vf');
        $objectDB->join('vehicle_types as vt', 'vt.id = vf.vehicle_types_id');
        if (isset($arrInputs['status'])) {
            $objectDB->where('vf.status=:status', array(':status' => $arrInputs['status']));
        }

        if (isset($arrInputs['id']) && !empty($arrInputs['id'])) {
            $objectDB->where('vf.id=:id', array(':id' => $arrInputs['id']));
        }

        if (empty($arrInputs['id'])) {
            $arrVehicleFeature = $objectDB->queryAll();
        } else {
            $arrVehicleFeature = $objectDB->queryRow();
        }
        return $arrVehicleFeature;
    }

    public static function updatevehicleFeature($arrVehicleFeature, $intFeatureId) {
        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('vehicle_fetures', $arrVehicleFeature, 'id=:id', array(':id' => $intFeatureId));
        return $intUpdate;
    }

    public static function isCodeExist($strCode, $intFeatureId = NULL) {
        $arrVehicleFeature = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vf.id');
        $objectDB->from('vehicle_fetures as vf');
        $objectDB->where('vf.code=:code', array(':code' => $strCode));
        if (!empty($intFeatureId)) {
            $objectDB->andWhere('vf.id!=:featureId', array(':featureId' => $intFeatureId));
        }
        $arrVehicleFeature = $objectDB->queryRow();
        return $arrVehicleFeature;
    }

    /**
     * @author Digital Today
     * @param string $strUsernameOrMobile
     * @return array It will return customer details
     */
    public static function isNameExist($strName, $intFeatureId = NULL) {
        $arrVehicleFeature = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vf.id');
        $objectDB->from('vehicle_fetures as vf');
        $objectDB->where('vf.name=:name', array(':name' => $strName));
        if (!empty($intFeatureId)) {
            $objectDB->andWhere('vf.id!=:featureId', array(':featureId' => $intFeatureId));
        }
        $arrVehicleFeature = $objectDB->queryRow();
        return $arrVehicleFeature;
    }

}
