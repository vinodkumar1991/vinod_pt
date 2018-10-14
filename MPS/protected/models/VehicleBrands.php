<?php

class VehicleBrands extends CActiveRecord {

    public $strTable = 'vehicle_brands';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param string $strUsername
     * @return array It will return VehicleBrands data
     */
    public static function getVehicleBrands($intStatus = 1, $intVehicleType = NULL, $intVehicleBrands = NULL) {
        $arrVehicleBrands = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('v.id,v.name,v.code');
        $objectDB->from('vehicle_brands as v');
        if (!empty($intVehicleBrands)) {
            $objectDB->where('v.id=:id', array(':id' => $intVehicleBrands));
            $arrVehicleBrands = $objectDB->queryRow();
        } elseif (!empty($intVehicleType)) {
            $objectDB->where('v.vehicle_types_id=:vehicleTypeId', array(':vehicleTypeId' => $intVehicleType));
            $arrVehicleBrands = $objectDB->queryAll();
        } else {
            $objectDB->where('v.status=:status', array(':status' => $intStatus));
            $arrVehicleBrands = $objectDB->queryAll();
        }
        return $arrVehicleBrands;
    }

    public static function create($arrBrand) {
        $intVehicleId = NULL;
        try {
            $objVehicleBrand = new VehicleBrands();
            $objVehicleBrand->vehicle_types_id = $arrBrand['vehicle_types_id'];
            $objVehicleBrand->name = $arrBrand['name'];
            $objVehicleBrand->code = $arrBrand['code'];
            $objVehicleBrand->logo = $arrBrand['logo'];
            $objVehicleBrand->logo_original_name = $arrBrand['logo_original_name'];
            $objVehicleBrand->description = $arrBrand['description'];
            $objVehicleBrand->status = $arrBrand['status'];
            $objVehicleBrand->created_date = $arrBrand['created_date'];
            $objVehicleBrand->created_by = $arrBrand['created_by'];
            $objVehicleBrand->ip_address = $arrBrand['ip_address'];
            if ($objVehicleBrand->save()) {
                $intVehicleId = $objVehicleBrand->id;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $intVehicleId;
    }

    public static function isBrandExist($strBrand) {
        $arrVehicleBrands = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vb.id');
        $objectDB->from('vehicle_brands as vb');
        $objectDB->where('vb.name=:name', array(':name' => $strBrand));
        $arrVehicleBrands = $objectDB->queryRow();
        return $arrVehicleBrands;
    }

    public static function isBrandCodeExist($strCode) {
        $arrVehicleBrandCode = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vb.id');
        $objectDB->from('vehicle_brands as vb');
        $objectDB->where('vb.code=:code', array(':code' => $strCode));
        $arrVehicleBrandCode = $objectDB->queryRow();
        return $arrVehicleBrandCode;
    }

    public static function brandsReport($arrInputs) {
        $arrBrands = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vb.id as brand_id,'
                . 'vb.name as brand_name,'
                . 'vb.code as brand_code,'
                . 'vb.logo as brand_logo,'
                . 'vb.status as brand_status,'
                . 'vt.name as vehicle_type,'
                . 'vt.id as vehicle_id'
        );
        $objectDB->from('vehicle_brands as vb');
        $objectDB->join('vehicle_types as vt', 'vt.id = vb.vehicle_types_id');
        if (isset($arrInputs['status'])) {
            $objectDB->where('vb.status=:status', array(':status' => $arrInputs['status']));
        }
        if (isset($arrInputs['BrandID'])) {
            $objectDB->where('vb.id=:id', array(':id' => $arrInputs['BrandID']));
        }
        $arrBrands = $objectDB->queryAll();
        return $arrBrands;
    }

    public static function updateBrandDetails($arrInput) {
        $setValue = array('status' => $arrInput['brand_status'],
            'last_modified' => $arrInput['created_date'],
            'ip_address' => $arrInput['ip_address']);

        $objectDB = Yii::app()->db->createCommand();
        $objectDB->update('vehicle_brands', $setValue, 'id=:id', array('id' => $arrInput['brand_id']));
    }

}
