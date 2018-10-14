<?php

class RepairsLists extends CActiveRecord {

    public $strTable = 'repairs_lists';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param integer $intRepair
     * @param integer $intStatus
     * @return array It will return repairst list data
     */
    public static function getRepairsList($intStatus = 1, $intRepair = NULL) {
        $arrRepairstList = NULL;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('rl.name,rl.id');
        $objectDB->from('repairs_lists as rl');
        if (!empty($intRepair)) {
            $objectDB->where('rl.status=:status and rl.id=:repairId', array(':status' => $intStatus, ':repairId' => $intRepair));
            $arrRepairstList = $objectDB->queryAll();
        } else {
            $objectDB->where('rl.status=:status', array(':status' => $intStatus));
            $arrRepairstList = $objectDB->queryAll();
        }
        return $arrRepairstList;
    }

    public static function getRepairListAndSubList($intStatus = 1, $intRepair = NULL) {
        $arrRepairstList = NULL;
        $objectDB = Yii::app()->db->createCommand();
        //$objectDB->select('r.id as repairs_id,r.name as repairs_name,rl.name as repairs_list_name,rl.id as repairs_lists_id,vcra.cost,vcra.id,vcra.vehicle_categories_id,vcra.vehicle_types_id');
        //$objectDB->select('r.id as repairs_id,r.name as repairs_name,rl.name as repairs_list_name,rl.id as repairs_lists_id');
        $objectDB->select('r.id as repairs_id,r.name as repairs_name,rl.name as repairs_list_name,rl.id as repairs_lists_id');
        $objectDB->from('repairs as r');
        //$objectDB->leftJoin('repairs_lists as rl', 'rl.repairs_id = r.id');
        $objectDB->leftJoin('vehical_category_repairs_amount as vcra', 'vcra.repairs_id = r.id');
        $objectDB->where('r.status=:status and rl.status=:listStatus', array(':status' => $intStatus, ':listStatus' => $intStatus));
        $arrRepairstList = $objectDB->queryAll();
        return $arrRepairstList;
    }

    public static function getVehicleRepairs($intStatus = 1, $intVehicleType = NULL) {
        $arrVehileRepairsList = NULL;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vcra.id,vcra.cost,r.name as repairName,r.id as repairId,vcra.repairs_lists_id,vcra.is_recommended,vcra.plans_types_id as planId,vcra.vehicle_types_id as vehicleTypeId');
        $objectDB->from('vehical_category_repairs_amount as vcra');
        $objectDB->join('repairs as r', 'r.id = vcra.repairs_id');
        $objectDB->where('vcra.status =:status', array(':status' => $intStatus));
        if (!empty($intVehicleType)) {
            $objectDB->andWhere('vcra.vehicle_types_id =:vehicleType', array(':vehicleType' => $intVehicleType));
        }
        $objectDB->group('vcra.repairs_lists_id');
        $arrVehileRepairsList = $objectDB->queryAll();
        return $arrVehileRepairsList;
    }

}
