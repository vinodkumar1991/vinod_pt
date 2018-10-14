<?php

class DeviceTypes extends CActiveRecord {

    public $strTable = 'device_types';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @return array It will return device types
     */
    public static function getDeviceTypes($intStatus = 1, $strDevice = NULL) {
        $arrDeviceTypes = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('dt.id as deviceId,dt.name as deviceName,dt.code as deviceCode');
        $objectDB->from('device_types as dt');
        if (!empty($strDevice)) {
            $objectDB->where('dt.status=:status and dt.name=:name', array(':status' => $intStatus, ':name' => $strDevice));
            $arrDeviceTypes = $objectDB->queryRow();
        } else {
            $objectDB->where('dt.status=:status', array(':status' => $intStatus));
            $arrDeviceTypes = $objectDB->queryAll();
        }
        return $arrDeviceTypes;
    }

}
