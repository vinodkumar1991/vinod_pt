<?php

class CustomerAddVehicles extends CActiveRecord {

    public $strTable = 'customer_add_vehicles';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrVehicle
     * @return integer It will return an integer response
     */
    public static function create($arrVehicle) {
        $intVehicle = NULL;
        $objAddVehicle = new CustomerAddVehicles();
        $objAddVehicle->customer_id = $arrVehicle['customer_id'];
        $objAddVehicle->vehicle_brands_id = $arrVehicle['vehicle_brands_id'];
        $objAddVehicle->vehicle_brand_models_id = $arrVehicle['vehicle_brand_models_id'];
        $objAddVehicle->vehicle_variant_id = $arrVehicle['vehicle_variant_id'];
        $objAddVehicle->manufacture_year = $arrVehicle['manufacture_year'];
        $objAddVehicle->last_serviced = $arrVehicle['last_serviced'];
        $objAddVehicle->age = $arrVehicle['age'];
        $objAddVehicle->registration_number = $arrVehicle['registration_number'];
        $objAddVehicle->status = $arrVehicle['status'];
        $objAddVehicle->created_date = $arrVehicle['created_date'];
        $objAddVehicle->created_by = $arrVehicle['created_by'];
        $objAddVehicle->ip_address = $arrVehicle['ip_address'];
        $objAddVehicle->device_types_id = $arrVehicle['device_types_id'];
        if ($objAddVehicle->save()) {
            $intVehicle = $objAddVehicle->id;
        }
        return $intVehicle;
    }

    public static function getAddedVehicles($intStatus = 1, $intCustomer) {
        $arrAddedVehicles = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('cav.manufacture_year,cav.age,cav.registration_number,
            CASE WHEN cav.vehicle_variant_id = 2 THEN "diesel" ELSE "petrol" END AS vehicle_variant_name,
            DATE_FORMAT(cav.last_serviced,"%d/%m/%Y") as last_serviced,vb.id as vehicle_brand_id,
            vb.name as vehicle_brand_name,
            vb.logo as vehicle_brand_logo,
            vbm.id as vehicle_brand_model_id,
            vbm.name as vehicle_brand_model_name,
            vbm.image_path as vehicle_brand_model_logo,
            vt.id as vehicle_id,vt.name as vehicle_name,
            CASE WHEN vt.id = 1 THEN "/cars/mobile/models/120X70/" ELSE "/bikes/mobile/models/120X70/" END AS path,CASE WHEN vt.id = 1 THEN "/cars/mobile/models/original/" ELSE "/bikes/mobile/models/original/" END AS original_model_path,cav.id as added_vehicle_id'
        );
        $objectDB->from('customer_add_vehicles as cav');
        $objectDB->join('vehicle_brands as vb', 'vb.id = cav.vehicle_brands_id');
        $objectDB->join('vehicle_types as vt', 'vt.id = vb.vehicle_types_id');
        $objectDB->join('vehicle_brand_models as vbm', 'vbm.id = cav.vehicle_brand_models_id');
        $objectDB->where('cav.status=:status and cav.customer_id=:customerId', array(':status' => $intStatus, ':customerId' => $intCustomer));
        $objectDB->order('cav.id desc');
        $arrAddedVehicles = $objectDB->queryAll();
        return $arrAddedVehicles;
    }

    public function updateVehicleStatus($arrVehicle, $intCustomer, $intAddedVehicle) {
        $objCommand = Yii::app()->db->createCommand();
        $intUpdate = $objCommand->update('customer_add_vehicles', $arrVehicle, 'id=:id and customer_id=:customerId', array(':id' => $intAddedVehicle, ':customerId' => $intCustomer));
        return $intUpdate;
    }

}
