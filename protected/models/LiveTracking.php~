<?php

class LiveTracking extends CActiveRecord {

    public $strTable = 'live_tracking';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrLiveTracking
     * @return integer It will return last inserted live tracking 
     */
    public static function create($arrLiveTracking) {
        $intLiveTrack = NULL;
        $objLiveTracking = new LiveTracking();
        $objLiveTracking->users_id = $arrLiveTracking['users_id'];
        $objLiveTracking->role_types_id = $arrLiveTracking['role_id'];
        $objLiveTracking->session_id = $arrLiveTracking['session_id'];
        $objLiveTracking->gps_point = $arrLiveTracking['gps_point'];
        $objLiveTracking->longitude = $arrLiveTracking['longitude'];
        $objLiveTracking->latitude = $arrLiveTracking['latitude'];
        $objLiveTracking->message = NULL;
        $objLiveTracking->status = $arrLiveTracking['status'];
        $objLiveTracking->created_date = $arrLiveTracking['created_date'];
        $objLiveTracking->created_by = $arrLiveTracking['created_by'];
        $objLiveTracking->ip_address = $arrLiveTracking['ip_address'];
        $objLiveTracking->device_id = 5; // 5 For Andriod
        $objLiveTracking->imei_no = $arrLiveTracking['imei_no'];
        if ($objLiveTracking->save()) {
            $intLiveTrack = $objLiveTracking->id;
        }
        return $intLiveTrack;
    }

    public static function getLatestLongiLatis($intUser, $intRole) {
        $arrDeliveryBoys = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('lt.gps_point,lt.message,lt.id,lt.latitude as latest_latitude, lt.longitude as latest_longitude');
        $objectDB->from('live_tracking as lt');
        $objectDB->where('lt.users_id=:userId and lt.role_types_id=:roleId', array(':userId' => $intUser, ':roleId' => $intRole));
        $objectDB->order('lt.id desc');
        $objectDB->limit(1);
        $arrDeliveryBoys = $objectDB->queryRow();
        return $arrDeliveryBoys;
    }

}
