<?php

class SelfVehiclesFeatures extends CActiveRecord {

    public $strTable = 'self_vehicles_features';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrAddSelfdrive
     * @return integer It will return an integer response
     */
    public static function create($arrVehicleFeatures, $intSelfVehicle = NULL) {
        $intInserted = 0;
        $objDbCommand = Yii::app()->db->createCommand();
        if (!empty($intSelfVehicle)) {
            self::deleteSelfVehicleFeatures($intSelfVehicle);
        }
        foreach ($arrVehicleFeatures as $arrVehicleFeature) {
            $intInserted = $objDbCommand->insert('self_vehicles_features', $arrVehicleFeature);
        }
        return $intInserted;
    }

    public static function getVehicleFeturesReport($arrInputs = array()) {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('svf.id,svf.vehicle_fetures_id,vf.name,vf.id');
        $objectDB->from('self_vehicles_features as svf');
        $objectDB->join('vehicle_fetures as vf', 'vf.id = svf.vehicle_fetures_id');

        if (isset($arrInputs['status'])) {
            $objectDB->where('vf.status=:status', array(':status' => $arrInputs['status']));
        }

        if (isset($arrInputs['self_vehicles_id']) && !empty($arrInputs['self_vehicles_id'])) {
            $objectDB->where('svf.self_vehicles_id=:id', array(':id' => $arrInputs['self_vehicles_id']));
        }

        $arrFeatureTypes = $objectDB->queryAll();
        return $arrFeatureTypes;
    }

    public static function deleteSelfVehicleFeatures($intSelfVehicle) {
        $objCommand = Yii::app()->db->createCommand();
        $intDelete = $objCommand->delete('self_vehicles_features', 'self_vehicles_id=:selfVehicleId', array(':selfVehicleId' => $intSelfVehicle));
        return $intDelete;
    }

}
