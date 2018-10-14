<?php

class VehicleServiceType_Model extends CActiveRecord {

    public $strTable = 'vehicle_service_types';
   

    public function tableName() {
        return $this->strTable;
      
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    

    /**
     * @author Ctel
     * @param array $arrCustomer
     * @return integer It will return an integer response
     */
   
   
      public static function getVehicleServices($veh_type_id)
    {
          $objectDB = Yii::app()->db->createCommand();
          $objectDB->select('sty.id,sty.name');
          $objectDB->from('service_types as sty');
          $objectDB->join('vehicle_service_types vst', 'vst.service_types_id=sty.id');
          $objectDB->where('vst.vehicle_types_id=:vehicle_types_id', array(':vehicle_types_id'=>$veh_type_id));
          $arrVehicleSubRepaiLists = $objectDB->queryAll();
          return $arrVehicleSubRepaiLists;
    }
    
   
    

}
