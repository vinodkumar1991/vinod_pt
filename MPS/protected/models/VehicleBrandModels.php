<?php

class VehicleBrandModels extends CActiveRecord {

    public $strTable = 'vehicle_brand_models';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param integer $intStatus
     * @return array It will return vehicle brand types
     */
    public static function getVehicleBrandModels($intVehicleBrandType, $intStatus = 1) {
        $arrVehicleBrandTypes = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vbm.id,vbm.name,vbm.code,vbm.description');
        $objectDB->from('vehicle_brand_models as vbm');
        $objectDB->where('vbm.vehicle_brands_id=:vehicleBrandTypeId and vbm.status=:status', array(':vehicleBrandTypeId' => $intVehicleBrandType, ':status' => $intStatus));
        $arrVehicleBrandTypes = $objectDB->queryAll();
        return $arrVehicleBrandTypes;
    }

    public static function create($arrBrandModels) {
        $intVehicleModelId = NULL;
        try {
            $objVehicleBrandModels = new VehicleBrandModels();
            $objVehicleBrandModels->vehicle_brands_id = $arrBrandModels['vehicle_brands_id'];
            $objVehicleBrandModels->name = $arrBrandModels['name'];
            $objVehicleBrandModels->code = $arrBrandModels['code'];
            $objVehicleBrandModels->image_path = $arrBrandModels['image_path'];
            $objVehicleBrandModels->logo_original_name = $arrBrandModels['logo_original_name'];
            $objVehicleBrandModels->description = $arrBrandModels['description'];
            $objVehicleBrandModels->status = $arrBrandModels['status'];
            $objVehicleBrandModels->created_date = $arrBrandModels['created_date'];
            $objVehicleBrandModels->created_by = $arrBrandModels['created_by'];
            $objVehicleBrandModels->ip_address = $arrBrandModels['ip_address'];
            if ($objVehicleBrandModels->save()) {
                $intVehicleModelId = $objVehicleBrandModels->id;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $intVehicleModelId;
    }

    public static function isModelExist($strBrandModel) {
        $arrVehicleBrandModels = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vbm.id');
        $objectDB->from('vehicle_brand_models as vbm');
        $objectDB->where('vbm.name=:name', array(':name' => $strBrandModel));
        $arrVehicleBrandModels = $objectDB->queryRow();
        return $arrVehicleBrandModels;
    }

    public static function isModelCodeExist($strBrandModelCode) {
        $arrVehicleBrandModelCode = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vbm.id');
        $objectDB->from('vehicle_brand_models as vbm');
        $objectDB->where('vbm.code=:code', array(':code' => $strBrandModelCode));
        $arrVehicleBrandModelCode = $objectDB->queryRow();
        return $arrVehicleBrandModelCode;
    }

    public static function brandModelsReport($arrInputs) {
        $arrBrandModels = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vbm.id as brand_model_id,'
                . 'vbm.name as brand_model_name,'
                . 'vbm.code as brand_model_code,'
                . 'vbm.image_path as brand_model_logo,'
                . 'vbm.status as brand_model_status,'
                . 'vb.name as brand_name,'
                . 'vb.id as brand_id,vt.id as vehicle_id'
        );
        $objectDB->from('vehicle_brand_models as vbm');
        $objectDB->join('vehicle_brands as vb', 'vb.id = vbm.vehicle_brands_id');
        $objectDB->join('vehicle_types as vt', 'vt.id = vb.vehicle_types_id');
        if (isset($arrInputs['status'])) {
            $objectDB->where('vbm.status=:status', array(':status' => $arrInputs['status']));
        }
        if(isset($arrInputs['ModelID'])){
             $objectDB->where('vbm.id=:id', array(':id' => $arrInputs['ModelID']));
        }
        $arrBrandModels = $objectDB->queryAll();
        return $arrBrandModels;
    }
    
    public static function updateBrandModelDetails($arrInput){
            $setValue=array('status'=>$arrInput['model_status'],
                            'last_modified'=>$arrInput['created_date'],
                            'ip_address'=>$arrInput['ip_address']);           
            $objectDB=Yii::app()->db->createCommand();
            $objectDB->update('vehicle_brand_models',$setValue,'id=:id',array('id'=>$arrInput['model_id']));            
        
    }

}
