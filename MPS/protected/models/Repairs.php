<?php

class Repairs extends CActiveRecord {

    public $strTable = 'repairs';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrRepairs
     * @return integer It will return last inserted repair id
     */
    public static function create($arrRepairs) {
        $intRepair = NULL;
        $objRepair = new Repairs();
        $objRepair->name = $arrRepairs['repair_name'];
        $objRepair->code = $arrRepairs['repair_code'];
        $objRepair->description = $arrRepairs['repair_description'];
        $objRepair->status = $arrRepairs['repair_status'];
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
    public static function repairsReport($arrRepairs = array()) {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('r.id,r.name,r.code,r.description,r.status');
        $objectDB->from('repairs as r');
        if (isset($arrRepairs['status']) && !empty($arrRepairs['status'])) {
            $objectDB->where('r.status:=status', array(':status' => $arrRepairs['status']));
        }
        if (isset($arrRepairs['id']) && !empty($arrRepairs['id'])) {
            $objectDB->where('r.id=:id', array(':id' => $arrRepairs['id']));
        }
        
        if (empty($arrRepairs['id'])) {
           $arrRepairs = $objectDB->queryAll();
        } else {
            $arrRepairs = $objectDB->queryRow();
        }
        $objectDB->order('r.id desc');
      //  $arrRepairs = $objectDB->queryAll();
        return $arrRepairs;
    }
    public static function updateRepairs($arrRepairs, $intRepairId) {

        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('repairs', $arrRepairs, 'id=:id', array(':id' => $intRepairId));
        return $intUpdate;
    }

    public static function isNameExist($strName,$intRepairId = NULL) {
        $arrRepair = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('r.id');
        $objectDB->from('repairs as r');
        $objectDB->where('r.name=:name', array(':name' => $strName));
         if (!empty($intRepairId)) {
            $objectDB->andWhere('r.id!=:repairId', array(':repairId' => $intRepairId));
        }
        $arrRepair = $objectDB->queryRow();
        return $arrRepair;
    }

    public static function isCodeExist($strCode,$intRepairId = NULL) {
        $arrRepair = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('r.id');
        $objectDB->from('repairs as r');
        $objectDB->where('r.code=:code', array(':code' => $strCode));
         if (!empty($intRepairId)) {
            $objectDB->andWhere('r.id!=:repairId', array(':repairId' => $intRepairId));
        }
        $arrRepair = $objectDB->queryRow();
        return $arrRepair;
    }

}
