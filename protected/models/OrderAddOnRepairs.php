<?php

class OrderAddOnRepairs extends CActiveRecord {

    public $strTable = 'order_add_on_repairs';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function create($arrOrderAddons) {
        $intInsertedCount = 0;
        if (!empty($arrOrderAddons)) {
            foreach ($arrOrderAddons as $arrAddon) {
                $objectCommand = Yii::app()->db->createCommand();
                $intInsertedCount = $objectCommand->insert('order_add_on_repairs', $arrAddon);
            }
        }
        return $intInsertedCount;
    }

   
}
