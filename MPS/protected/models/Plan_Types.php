<?php

class Plan_Types extends CActiveRecord {

    public $strTable = 'plans_types';
   

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
   
    public static function fetchPlanDetails($intStatus = 1) {
        $arrPlans = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('pt.id,pt.name,pt.code,pt.description,pt.created_date');
        $objectDB->from('plans_types as pt');
        $objectDB->where('pt.status=:status', array(':status' => $intStatus));
        $arrPlans = $objectDB->queryAll();
        return $arrPlans;
    }
   
     public static function isPlanNameExist($strPlanName) {
        $arrRepairName = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('pt.id');
        $objectDB->from('plans_types as pt');
        $objectDB->where('pt.name=:name', array(':name' => $strPlanName));
        $arrVehiclePlan= $objectDB->queryRow();
        return $arrVehiclePlan;
    }
    
    public static function isPlanCodeExist($strPlanCode) {
        $arrRepairName = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('pt.id');
        $objectDB->from('plans_types as pt');
        $objectDB->where('pt.code=:code', array(':code' => $strPlanCode));
        $arrVehiclePlanCode = $objectDB->queryRow();
        return $arrVehiclePlanCode;
    }
     public static function isPlanDescExist($strPlanDesc) {
        $arrRepairName = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('pt.id');
        $objectDB->from('plans_types as pt');
        $objectDB->where('pt.description=:description', array(':description' => $strPlanDesc));
        $arrVehiclePlanDesc = $objectDB->queryRow();
        return $arrVehiclePlanDesc;
    }
   
    

}
