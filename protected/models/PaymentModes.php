<?php

class PaymentModes extends CActiveRecord {

    public $strTable = 'payment_modes';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getPaymentModes($intStatus = 1) {
        $arrPaymentModes = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('pt.id,pt.name,pt.code,pt.description');
        $objectDB->from('payment_modes as pt');
        $objectDB->where('pt.status=:status', array(':status' => $intStatus));
        $arrPaymentModes = $objectDB->queryAll();
        return $arrPaymentModes;
    }

}
