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
     * @return array It will return AddSelfdrive data
     */
    
    

    public static function getVehicleClasses() {
        
        $arrVehicleClasses = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('id, vehicle_types_id, name');
        $objectDB->from('vehicle_classes');
        $arrVehicleClasses = $objectDB->queryAll();
        return $arrVehicleClasses;
    }
  
}
