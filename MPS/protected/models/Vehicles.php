<?php

class Vehicles extends CActiveRecord {

    public $strTable = 'Vehicles';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrVehicle
     * @return integer It will return an integer response
     */
    public static function create($arrVehicle) {
        $intVehicleId = NULL;
        $objVehicle = new Vehicles();
        $objVehicle->vehicle_categories_id = $arrVehicle['vehicle_categories'];
        $objVehicle->vehicle_brands_id = $arrVehicle['brand'];
        $objVehicle->vehicle_brand_models_id = $arrVehicle['brandModel']; // Need to change
        $objVehicle->vehicle_year = $arrVehicle['modelYear'];
        $objVehicle->status = $arrVehicle['status'];
        $objVehicle->created_date = $arrVehicle['created_date'];
        $objVehicle->created_by = $arrVehicle['created_by'];
        $objVehicle->ip_address = $arrVehicle['ip_address'];
        if ($objVehicle->save()) {
            $intVehicleId = $objVehicle->id;
        }
        return $intVehicleId;
    }

    public static function vehiclesReport($arrInputs = array()) {
        $arrVehicles = array();
        $objDB = Yii::app()->db->createCommand();
        $objDB->select('v.id as vehicleid,vc.id as vehicle_category_id,vc.name as vehicle_category,vb.id as brand_id,vb.name as brand_name,vbm.id as model_id,vbm.name as model_name,v.vehicle_year,v.status,vt.name as vehicle_name,vt.id as vehicle_id');
        $objDB->from('Vehicles as v');
        $objDB->join('vehicle_categories as vc', 'vc.id = v.vehicle_categories_id');
        $objDB->join('vehicle_brands as vb', 'vb.id = v.vehicle_brands_id');
        $objDB->join('vehicle_types as vt', 'vt.id = vb.vehicle_types_id');
        $objDB->join('vehicle_brand_models as vbm', 'vbm.id = v.vehicle_brand_models_id');
        
        if (isset($arrInputs['id']) && !empty($arrInputs['id'])) {
            $objDB->where('v.id=:vehicleId', array(':vehicleId' => $arrInputs['id']));
        }
        
        if (isset($arrInputs['status'])) {
            $objDB->where('v.status=:status', array(':status' => $arrInputs['status']));
        }
        $objDB->order('vc.name', 'v.id ASC');
        $arrVehicles = $objDB->queryAll();
        return $arrVehicles;
    }
    
    public static function updateVehicles($arrVehicle, $intVehicleId) {
        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('Vehicles', $arrVehicle, 'id=:id', array(':id' => $intVehicleId));
        return $intUpdate;
    }

}
