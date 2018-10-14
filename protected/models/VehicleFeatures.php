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
     * @return array It will return AddSelfdrive data
     */
    
    

    public static function getVehicleFeatures() {
        
        $arrVehicleFeatures = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('id, name');
        $objectDB->from('vehicle_fetures');
        $arrVehicleFeatures = $objectDB->queryAll();
        return $arrVehicleFeatures;
    }
  
}
