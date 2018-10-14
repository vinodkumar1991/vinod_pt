<?php

class Users extends CActiveRecord {

    public $strTable = 'users';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function create($arrVehicle) {
        $intUser = NULL;
        $objUser = new Users();
        $objUser->role_types_id = $arrVehicle['role_types_id'];
        $objUser->first_name = $arrVehicle['first_name'];
        $objUser->username = $arrVehicle['username']; // Need to change
        $objUser->password = $arrVehicle['password'];
        $objUser->status = $arrVehicle['status'];
        $objUser->created_date = $arrVehicle['created_date'];
        $objUser->created_by = $arrVehicle['created_by'];
        $objUser->ip_address = $arrVehicle['ip_address'];
        $objUser->device_id = $arrVehicle['device_id'];
        if ($objUser->save()) {
            $intUser = $objUser->id;
        }
        return $intUser;
    }

    public static function IsUserAccountExist($strUsername, $strPassword = NULL) {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('u.id,u.role_types_id as role_id,u.username,u.first_name,u.status');
        $objectDB->from('users as u');
        $objectDB->where('u.username=:username', array(':username' => $strUsername));
        if (!empty($strPassword)) {
            $objectDB->andWhere('u.password=:password', array(':password' => $strPassword));
        }
        $intUserAcc = $objectDB->queryRow();
        return $intUserAcc;
    }

    public function isUserNameExist($strUserName, $intUser = NULL) {
        $arrUsers = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('u.id');
        $objectDB->from('users as u');
        $objectDB->where('u.username=:username', array(':username' => $strUserName));
        if (!empty($intUser)) {
            $objectDB->andWhere('u.id!=:userId', array(':userId' => $intUser));
        }
        $arrUsers = $objectDB->queryRow();
        return $arrUsers;
    }

}
