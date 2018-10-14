<?php

class UsersLogs extends CActiveRecord {

    public $strTable = 'users_logs';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrLog
     * @return integer It will return userslogs id
     */
    public static function create($arrLog) {
        $intUser = NULL;
        $objUsersLogs = new UsersLogs();
        $objUsersLogs->users_id = $arrLog['users_id'];
        $objUsersLogs->role_types_id = $arrLog['role_types_id'];
        $objUsersLogs->message = $arrLog['message'];
        $objUsersLogs->status = $arrLog['status'];
        $objUsersLogs->created_date = $arrLog['created_date'];
        $objUsersLogs->created_by = $arrLog['created_by'];
        $objUsersLogs->ip_address = $arrLog['ip_address'];
        $objUsersLogs->device_id = $arrLog['device_id'];
        $objUsersLogs->imei_no = $arrLog['imei_no'];
        if ($objUsersLogs->save()) {
            $intUser = $objUsersLogs->id;
        }

        return $intUser;
    }

}
