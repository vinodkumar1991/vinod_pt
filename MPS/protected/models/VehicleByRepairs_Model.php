<?php

class VehicleByRepairs_Model extends CActiveRecord {

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
   
     public static function CreateVehiclePlans($objArrCategories) {
         
              $intPlanId = NULL;
              $objveh_plan= new VehicleByRepairs_Model();
              $objveh_plan->name = $objArrCategories['plan_name'];;
              $objveh_plan->code = $objArrCategories['code'];
              $objveh_plan->description = $objArrCategories['desc'];
              $objveh_plan->created_date = $objArrCategories['created_date'];
              $objveh_plan->created_by = $objArrCategories['created_by'];
              $objveh_plan->ip_address = $objArrCategories['ip_address'];
              $objveh_plan->status = $objArrCategories['status_val'];
              $objveh_plan->save();
             
                
          
            if($objveh_plan->save()) {
              $intPlanId = $objveh_plan->id;
                }
                return $intPlanId;
           
            
            
     }
    

    

}
