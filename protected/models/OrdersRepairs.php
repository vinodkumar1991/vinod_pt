<?php

class OrdersRepairs extends CActiveRecord {

    public $strTable = 'orders_repairs';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function create($arrOrderRepairs) {
        $intInsertedCount = 0;
        if (!empty($arrOrderRepairs)) {
            foreach ($arrOrderRepairs as $arrEleRepair) {
                $objectCommand = Yii::app()->db->createCommand();
                $intInsertedCount = $objectCommand->insert('orders_repairs', $arrEleRepair);
            }
        }
        return $intInsertedCount;
    }

}
