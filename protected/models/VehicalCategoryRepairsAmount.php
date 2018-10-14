<?php

/**
 * Need to change entire
 */
class VehicalCategoryRepairsAmount extends CActiveRecord {

    public $strTable = 'vehical_category_repairs_amount';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param integer $intVehicleCategory
     * @param integer $intVehicleType
     * @param integer $intPlan
     * @param integer $intStatus
     * @return array It will return vehicle reapirs list
     */
    public static function getVehicleRepairs($intVehicleCategory, $intVehicleType, $intPlan, $intStatus = 1) {
        $arrVehileRepairsList = NULL;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vcra.id,vcra.cost,r.name as repairName,r.id as repairId,vcra.repairs_lists_id,vcra.is_recommended,vcra.plans_types_id as planId,vcra.vehicle_types_id as vehicleTypeId');
        $objectDB->from('vehical_category_repairs_amount as vcra');
        $objectDB->join('repairs as r', 'r.id = vcra.repairs_id');
        $objectDB->where('vcra.vehicle_categories_id=:categorId and vcra.vehicle_types_id=:vehicleTypeId'
                . '       and vcra.plans_types_id=:planTypeId and vcra.status =:status', array(':categorId' => $intVehicleCategory,
            ':vehicleTypeId' => $intVehicleType,
            ':planTypeId' => $intPlan,
            ':status' => $intStatus));
        $arrVehileRepairsList = $objectDB->queryAll();
        return $arrVehileRepairsList;
    }

    /**
     * @author Ctel
     * @param integer $intVehicleCategory
     * @param integer $intVehicleType
     * @param integer $intPlan
     * @param integer $intStatus
     * @return array It will return vehicle reapirs list
     */
    public static function getRepairListAmount($arrRepairsList, $intStatus = 1) {
        $arrRepairListAmountDetails = NULL;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vcra.cost');
        $objectDB->from('vehical_category_repairs_amount as vcra');
        $objectDB->join('repairs as r', 'r.id = vcra.repairs_id');
        $objectDB->where('vcra.vehicle_categories_id=:categorId and vcra.vehicle_types_id=:vehicleTypeId'
                . '       and vcra.plans_types_id=:planTypeId and vcra.status =:status and'
                . '       vcra.repairs_id=:repairId and vcra.is_recommended=:isRecommended', array(':categorId' => $arrRepairsList->vehicle_category_id,
            ':vehicleTypeId' => $arrRepairsList->vehicle_type_id,
            ':planTypeId' => $arrRepairsList->plan_id,
            ':repairId' => $arrRepairsList->repairId,
            ':isRecommended' => $arrRepairsList->is_recommended,
            ':status' => $intStatus)
        );
        $arrRepairListAmountDetails = $objectDB->queryAll();
        return $arrRepairListAmountDetails;
    }

}
