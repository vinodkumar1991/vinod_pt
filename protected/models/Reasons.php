<?php

class Reasons extends CActiveRecord {

    public $strTable = 'reasons';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param integer $intShop
     * @param integer $intStatus
     * @return array It will return shop orders
     */
    public static function getReasons($intStatus = 1,$is_customer_side = 0) {
        $arrReasons = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('rs.id as reason_id,rs.name as reason_name');
        $objectDB->from('reasons as rs');
        if (!empty($intStatus)) {
            $objectDB->where('rs.status=:status and rs.is_customer_side =:isCustomerSide', array(':status' => $intStatus,':isCustomerSide' => $is_customer_side));
        }
        $arrReasons = $objectDB->queryAll();
        return $arrReasons;
    }

}
