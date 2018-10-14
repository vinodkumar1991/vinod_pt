<?php

class ServiceTypes extends CActiveRecord {

    public $strTable = 'service_types';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param integer $intStatus
     * @return array It will return all service types
     */
    public static function getServiceTypes($intStatus = 1) {
        $arrServiceTypes = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('st.id,st.name,st.code');
        $objectDB->from('service_types as st');
        $objectDB->where('st.status=:status', array(':status' => $intStatus));
        $arrServiceTypes = $objectDB->queryAll();
        return $arrServiceTypes;
    }

}
