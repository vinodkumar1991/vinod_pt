<?php

class VehicleCategory_Model extends CActiveRecord {

    public $strTable = 'vehicle_categories';
   

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
   
     public static function CreateCategory($objAddVehicleCategories) {
         
         
          $intCategoryId = NULL;
         
             // echo $subRepairName;
              $objveh_category = new VehicleCategory_Model();
             
              $objveh_category->vehicle_types_id = $objAddVehicleCategories['veh_type'];;
              $objveh_category->name = $objAddVehicleCategories['category_name'];;
              $objveh_category->code = $objAddVehicleCategories['code'];
              $objveh_category->description = $objAddVehicleCategories['desc'];
              $objveh_category->created_date = $objAddVehicleCategories['created_date'];
              $objveh_category->created_by = $objAddVehicleCategories['created_by'];
              $objveh_category->ip_address = $objAddVehicleCategories['ip_address'];
              $objveh_category->status = $objAddVehicleCategories['status_val'];
              $objveh_category->save();
             
                
          
            if($objveh_category->save()) {
              $intCategoryId = $objveh_category->id;
                }
                return $intCategoryId;
           
            
            
     }
      public static function getSubRepairs()
    {
        $arrVehicleBrandTypes = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('repli.id,repli.name');
        $objectDB->from('repairs_lists as repli');
        $objectDB->where('repli.repairs_id=:vehicleBrandTypeId and vbm.status=:status', array(':vehicleBrandTypeId' => $intVehicleBrandType, ':status' => $intStatus));
        $arrVehicleBrandTypes = $objectDB->queryAll();
        return $arrVehicleBrandTypes;
    }
    
      public static function getCategories($veh_type)
    {
        $arrVehicleBrandTypes = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vehcat.id,vehcat.name');
        $objectDB->from('vehicle_categories as vehcat');
       $objectDB->where('vehcat.vehicle_types_id=:vehicle_types_id', array(':vehicle_types_id'=>$veh_type));
        $arrVehicleBrandTypes = $objectDB->queryAll();
        return $arrVehicleBrandTypes;
    }
    

}
