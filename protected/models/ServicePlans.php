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
        //$arrServicePlans = array();
//        $objectDB = Yii::app()->db->createCommand();
//        $objectDB->select('pt.id as planId,pt.name,pt.description');
//        $objectDB->from('service_plans as s');
//        $objectDB->join('plans_types as pt', 'pt.id = s.plans_types_id');
//        $objectDB->where('s.vehicle_types_id=:vehicleTypeId and s.service_types_id=:serviceTypeId and s.status=:status', array(':vehicleTypeId' => $intVehicle, ':serviceTypeId' => $intServiceType, ':status' => $intStatus));
//        $arrServicePlans = $objectDB->queryAll();
//        return $arrServicePlans;
        $arrServicePlans = array();
        $strQuery = 'SELECT DISTINCT pt.id AS planId, pt.name, pt.description
                            FROM service_plans as s
                            JOIN plans_types as pt ON pt.id = s.plans_types_id
                            WHERE s.vehicle_types_id="' . $intVehicle . '" and s.service_types_id="' . $intServiceType . '" and s.status="' . $intStatus . '"';
        $arrServicePlans = Yii::app()->db->createCommand($strQuery)->queryAll();
        return $arrServicePlans;
    }

    public static function getServicePackages($intVehicle, $intServiceType, $intPlan, $intStatus = 1, $intVehicleCategory = NULL) {
        $arrServicePackage = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('s.package_amount,s.id as service_plan_id');
        $objectDB->from('service_plans as s');
        $objectDB->where('s.vehicle_types_id=:vehicleTypeId and s.service_types_id=:serviceTypeId and s.plans_types_id=:planTypeId and s.status=:status', array(':vehicleTypeId' => $intVehicle, ':serviceTypeId' => $intServiceType, ':planTypeId' => $intPlan, ':status' => $intStatus));
        if (!empty($intVehicleCategory)) {
            $objectDB->andWhere('s.vehicle_categories_id=:vehicleCategoryId', array(':vehicleCategoryId' => $intVehicleCategory));
        }
        $arrServicePackage = $objectDB->queryRow();
        return $arrServicePackage;
    }

}
