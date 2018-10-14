<?php

class Users extends CActiveRecord {

    public $strTable = 'users';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrVehicle
     * @return integer It will return user id
     */
    public static function create($arrVehicle) {
        $intUser = NULL;
        $objUser = new Users();
        $objUser->role_types_id = $arrVehicle['role_types_id'];
        $objUser->first_name = $arrVehicle['first_name'];
        $objUser->username = $arrVehicle['username'];
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

    public function isUserNameExist($strUserName, $strPassword = NULL) {
        $arrUsers = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        if (!empty($strPassword)) {
            $objectDB->select('u.id as user_id,u.first_name as user_name,u.role_types_id as role_id,ms.id as shop_id,ms.name as shop_name,ms.code as shop_code,ms.owner as shop_owner,mss.vehicle_types_id as vehicle_id,vt.name as vehicle_type,db.id as delivery_boy_id,db.name as delivery_boy_name,msd.is_first_time,msd.location,msd.latitude,msd.longitude');
            $objectDB->from('users as u');
            $objectDB->leftJoin('mechanic_shops as ms', 'ms.users_id = u.id and ms.status = "' . $intStatus . '"');
            $objectDB->leftJoin('mechanic_shop_details as msd', 'msd.mechanic_shops_id = ms.id');
            $objectDB->leftJoin('mechanic_shops_services as mss', 'mss.mechanic_shops_id = ms.id');
            $objectDB->leftJoin('vehicle_types as vt', 'vt.id = mss.vehicle_types_id');
            $objectDB->leftJoin('delivery_boys as db', 'db.users_id = u.id');
        } else {
            $objectDB->select('u.id as user_id,u.first_name as user_name,u.role_types_id as role_id');
            $objectDB->from('users as u');
        }
        $objectDB->where('u.username=:username', array(':username' => $strUserName));
        if (!empty($strPassword)) {
            $objectDB->andWhere('u.password=:password', array(':password' => $strPassword));
            $objectDB->group('ms.id');
        }
        $arrUsers = $objectDB->queryRow();
        return $arrUsers;
    }

    public function userUpdate($arrUsers, $strUsername) {
        $intUpdate = NULL;
        try {
            $objCommand = Yii::app()->db->createCommand();
            $intUpdate = $objCommand->update('users', $arrUsers, 'username=:username', array(':username' => $strUsername));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $intUpdate;
    }

    public function getDeliveryBoy($intDeliveryBoy) {
        $arrDeliveryBoy = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('u.id as user_id,u.first_name as user_name,u.role_types_id as role_id,ms.id as shop_id,ms.name as shop_name,ms.code as shop_code,ms.owner as shop_owner,mss.vehicle_types_id as vehicle_id,vt.name as vehicle_type,db.id as delivery_boy_id,db.name as delivery_boy_name,(CASE WHEN u.status = 1 THEN 1 ELSE 0 END) AS  is_first_time,msd.location,msd.latitude,msd.longitude');
        $objectDB->from('delivery_boys as db');
        $objectDB->join('users as u', 'u.id = db.users_id');
        $objectDB->leftJoin('mechanic_shops as ms', 'ms.id = db.mechanic_shops_id');
        $objectDB->leftJoin('mechanic_shop_details as msd', 'msd.mechanic_shops_id = ms.id');
        $objectDB->leftJoin('mechanic_shops_services as mss', 'mss.mechanic_shops_id = ms.id');
        $objectDB->leftJoin('vehicle_types as vt', 'vt.id = mss.vehicle_types_id');
        $objectDB->where('db.id=:id', array(':id' => $intDeliveryBoy));
        $arrDeliveryBoy = $objectDB->queryRow();
        return $arrDeliveryBoy;
    }

}
