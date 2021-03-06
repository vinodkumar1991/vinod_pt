<?php

class ServicePlans extends CActiveRecord {

    public $strTable = 'service_plans';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param integer $intVehicle
     * @param integer $intServiceType
     * @param integer $intStatus
     * @return array It will return service plans by vehicle type wise
     */
    public static function getServicePlans($intVehicle, $intServiceType, $intStatus = 1) {
        $arrServicePlans = array();
        $strQuery = 'SELECT DISTINCT pt.id AS planId, pt.name, pt.description
                            FROM service_plans as s
                            JOIN plans_types as pt ON pt.id = s.plans_types_id
                            WHERE s.vehicle_types_id="' . $intVehicle . '" and s.service_types_id="' . $intServiceType . '" and s.status="' . $intStatus . '"';
        $arrServicePlans = Yii::app()->db->createCommand($strQuery)->queryAll();
        return $arrServicePlans;
    }

    public static function getServicePackages($intVehicle, $intServiceType, $intPlan, $intStatus = 1) {
        $arrServicePackage = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('s.package_amount,s.id as service_plan_id');
        $objectDB->from('service_plans as s');
        $objectDB->where('s.vehicle_types_id=:vehicleTypeId and s.service_types_id=:serviceTypeId and s.plans_types_id=:planTypeId and s.status=:status', array(':vehicleTypeId' => $intVehicle, ':serviceTypeId' => $intServiceType, ':planTypeId' => $intPlan, ':status' => $intStatus));
        $arrServicePackage = $objectDB->queryRow();
        return $arrServicePackage;
    }

    public static function create($arrInputs) {
        $intServicePlan = NULL;
        $objServicePlan = new ServicePlans();
        $objServicePlan->plans_types_id = $arrInputs['plan_id'];
        $objServicePlan->service_types_id = $arrInputs['service_type_id'];
        $objServicePlan->vehicle_types_id = $arrInputs['vehicle_types'];
        $objServicePlan->vehicle_categories_id = $arrInputs['vehicle_categories'];
        $objServicePlan->status = $arrInputs['status'];
        $objServicePlan->package_amount = $arrInputs['amount'];
        $objServicePlan->created_date = $arrInputs['created_date'];
        $objServicePlan->created_by = $arrInputs['created_by'];
        $objServicePlan->ip_address = $arrInputs['ip_address'];
        if ($objServicePlan->save()) {
            $intServicePlan = $objServicePlan->id;
        }
        return $intServicePlan;
    }

}
