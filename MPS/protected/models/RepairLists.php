<?php

class RepairLists extends CActiveRecord {

    public $strTable = 'repairs_lists';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function create($arrRepairs) {
        $intRepair = NULL;
        $objRepair = new RepairLists();
        $objRepair->repairs_id = $arrRepairs['repairs_id'];
        $objRepair->name = $arrRepairs['repair_list_name'];
        $objRepair->code = $arrRepairs['repair_list_code'];
        $objRepair->description = $arrRepairs['repair_list_desc'];
        $objRepair->status = $arrRepairs['repair_list_status'];
        $objRepair->created_date = $arrRepairs['created_date'];
        $objRepair->created_by = $arrRepairs['created_by'];
        $objRepair->ip_address = $arrRepairs['ip_address'];
        $objRepair->device_id = $arrRepairs['device_id'];
        if ($objRepair->save()) {
            $intRepair = $objRepair->id;
        }
        return $intRepair;
    }

    /**
     * @author Digital Today
     * @return array It will repairs report
     */
    public static function repairsListReport($arrInput = array()) {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('rl.id,rl.name,rl.code,rl.description,rl.status,r.name as repair_name,rl.repairs_id');
        $objectDB->from('repairs_lists as rl');
        $objectDB->join('repairs as r', 'r.id = rl.repairs_id');
       
        if (isset($arrInput['status']) && !empty($arrInput['status'])) {
            $objectDB->where('rl.status:=status', array(':status' => $arrInput['status']));
        } elseif (isset($arrInput['repair_id']) && !empty($arrInput['repair_id'])) {
            $objectDB->where('rl.repairs_id=:repairId', array(':repairId' => $arrInput['repair_id']));
        }
         if (isset($arrInput['id']) && !empty($arrInput['id'])) {
            $objectDB->where('rl.id=:id', array(':id' => $arrInput['id']));
        }
        if (empty($arrInput['id'])) {
           $arrRepairList = $objectDB->queryAll();
        } else {
            $arrRepairList = $objectDB->queryRow();
        }
        $objectDB->order('rl.id DESC');
        //$arrRepairList = $objectDB->queryAll();
        return $arrRepairList;
    }
      public static function updateRepairList($arrRepairList, $intRepairListId) {

        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('repairs_lists', $arrRepairList, 'id=:id', array(':id' => $intRepairListId));
        return $intUpdate;
    }

    public static function isNameExist($strName,$intRepairListId = NULL) {
        $arrRepairList = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('rl.id');
        $objectDB->from('repairs_lists as rl');
        $objectDB->where('rl.name=:name', array(':name' => $strName));
         if (!empty($intRepairListId)) {
            $objectDB->andWhere('rl.id!=:repairListId', array(':repairListId' => $intRepairListId));
        }
        $arrRepairList = $objectDB->queryRow();
        return $arrRepairList;
    }

    public static function isCodeExist($strCode,$intRepairListId = NULL) {
        $arrRepairList = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('rl.id');
        $objectDB->from('repairs_lists as rl');
        $objectDB->where('rl.code=:code', array(':code' => $strCode));
         if (!empty($intRepairListId)) {
            $objectDB->andWhere('rl.id!=:repairListId', array(':repairListId' => $intRepairListId));
        }
        $arrRepairList = $objectDB->queryRow();
        return $arrRepairList;
    }

}
