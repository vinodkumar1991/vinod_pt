<?php

class ServiceByPlan_Model extends CActiveRecord {

    public $strTable = 'service_plans';
   

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
   
   
      public static function getVehicleServiceByPlans($serviceid)
    {
          $objectDB = Yii::app()->db->createCommand();
          $objectDB->select('plt.id,plt.name');
          $objectDB->from('plans_types as plt');
          $objectDB->join('service_plans serp', 'plt.id=serp.plans_types_id');
          $objectDB->where('serp.service_types_id=:service_types_id', array(':service_types_id'=>$serviceid));
          $arrVehicleSubRepaiLists = $objectDB->queryAll();
          return $arrVehicleSubRepaiLists;
    }
    
   
    

}
