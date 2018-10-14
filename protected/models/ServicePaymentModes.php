<?php

class ServicePaymentModes extends CActiveRecord {

    public $strTable = 'service_payment_modes';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getServicePaymentModes($intVehicle, $intServiceType, $intPlan, $intStatus = 1) {
        $arrServicePaymentModes = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('pm.id,pm.name,pm.description');
        $objectDB->from('service_payment_modes as spm');
        $objectDB->join('payment_modes as pm', 'pm.id = spm.payment_modes_id');
        $objectDB->where('spm.vehicle_types_id=:vehicleTypeId and spm.service_types_id=:serviceTypeId and spm.plan_types_id=:planTypeId and spm.status=:status and pm.status=:paystatus', array(':vehicleTypeId' => $intVehicle, ':serviceTypeId' => $intServiceType, ':planTypeId' => $intPlan, ':status' => $intStatus, ':paystatus' =>$intStatus));
        $arrServicePaymentModes = $objectDB->queryAll();
        return $arrServicePaymentModes;
    }

}
