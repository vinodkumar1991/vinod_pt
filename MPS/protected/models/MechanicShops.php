<?php

class MechanicShops extends CActiveRecord {

    public $strTable = 'mechanic_shops';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrMechanic
     * @return integer It will return mechanic shop id
     */
    public static function create($arrMechanic) {
        $intMechanicShop = NULL;
        $objMechanicShop = new MechanicShops();
        $objMechanicShop->users_id = $arrMechanic['user_id'];
        $objMechanicShop->name = $arrMechanic['mechanic_shop_name'];
        $objMechanicShop->owner = $arrMechanic['owner']; // Need to change
        $objMechanicShop->code = $arrMechanic['code'];
        $objMechanicShop->license = $arrMechanic['license'];
        $objMechanicShop->email = $arrMechanic['email'];
        $objMechanicShop->phone = $arrMechanic['phone'];
        $objMechanicShop->description = NULL;
        $objMechanicShop->status = $arrMechanic['status'];
        $objMechanicShop->created_date = $arrMechanic['created_date'];
        $objMechanicShop->created_by = $arrMechanic['created_by'];
        $objMechanicShop->ip_address = $arrMechanic['ip_address'];
        $objMechanicShop->device_id = $arrMechanic['device_id'];
        $objMechanicShop->present_address = $arrMechanic['present_address'];
        $objMechanicShop->permanent_address = NULL;
        if ($objMechanicShop->save()) {
            $intMechanicShop = $objMechanicShop->id;
        }
        return $intMechanicShop;
    }

    public static function isShopNameExist($strShopName, $intShop = NULL) {
        $arrShop = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ms.id');
        $objectDB->from('mechanic_shops as ms');
        $objectDB->where('ms.name=:name', array(':name' => $strShopName));
        if (!empty($intShop)) {
            $objectDB->andWhere('ms.id!=:id', array(':id' => $intShop));
        }
        $arrShop = $objectDB->queryRow();
        return $arrShop;
    }

    public static function mechanicShopsReport($arrInputs = array()) {
        $arrShop = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ms.id,ms.name as shop_name,ms.owner as shop_owner,ms.license as shop_license,'
                . 'ms.email as shop_email,'
                . 'ms.phone as shop_phone,'
                . 'u.username,u.first_name,ms.code as shop_code,group_concat(st.name) as service_names,msd.total_mechanics,msd.service_capability,ms.status,msd.location as shop_location,msd.latitude as shop_latitude,msd.longitude as  shop_longitude,'
                . 'ct.states_id as shop_state,'
                . 'msd.cities_id as shop_city,'
                . 'cs.id as shop_country,'
                . 'msd.areas_id as shop_area,'
                . 'mss.vehicle_types_id as shop_vehicle_id,'
                . 'vt.name as shop_vehicle_name,'
                . 'msd.address_image as shop_address_image,'
                . 'msd.id_image as shop_id_image,'
                . 'msd.photo_image as shop_photo_image,u.password as shop_password,u.id as shop_user_id,ms.present_address,ms.code as mechanic_code'
        );
        $objectDB->from('mechanic_shops as ms');
        $objectDB->join('users as u', 'u.id = ms.users_id');
        $objectDB->join('mechanic_shop_details as msd', 'msd.mechanic_shops_id = ms.id');
        $objectDB->join('mechanic_shops_services as mss', 'mss.mechanic_shops_id = ms.id');
        $objectDB->join('vehicle_types as vt', 'vt.id = mss.vehicle_types_id');
        $objectDB->join('service_types as st', 'st.id = mss.service_types_id');
        $objectDB->join('cities as ct', 'ct.id = msd.cities_id');
        $objectDB->join('states as sts', 'sts.id = ct.states_id');
        $objectDB->join('countries as cs', 'cs.id = sts.countries_id');
        if (isset($arrInputs['status']) && !empty($arrInputs['status'])) {
            $objectDB->where('ms.status=:status', array(':status' => $arrInputs['status']));
        }
        if (isset($arrInputs['mechanic_id']) && !empty($arrInputs['mechanic_id'])) {
            $objectDB->where('ms.id=:mechanicId', array(':mechanicId' => $arrInputs['mechanic_id']));
        }
        $objectDB->order('ms.users_id', 'ms.id desc');
        $objectDB->group('ms.id');
        $arrShop = $objectDB->queryAll();
        return $arrShop;
    }

    public static function getMechanicShops($intStatus = 1) {
        $arrShop = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ms.id,ms.name as shop_name,ms.owner as shop_owner,ms.code as shop_code');
        $objectDB->from('mechanic_shops as ms');
        $objectDB->where('ms.status=:status', array(':status' => $intStatus));
        $objectDB->order('ms.id', 'ms.name desc');
        $arrShop = $objectDB->queryAll();
        return $arrShop;
    }

    public static function isPhoneExist($strPhone, $intShop = NULL) {
        $arrShop = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ms.id');
        $objectDB->from('mechanic_shops as ms');
        $objectDB->where('ms.phone=:phone', array(':phone' => $strPhone));
        if (!empty($intShop)) {
            $objectDB->andWhere('ms.id!=:id', array(':id' => $intShop));
        }
        $arrShop = $objectDB->queryRow();
        return $arrShop;
    }

    public static function isEmailExist($strEmail, $intShop = NULL) {
        $arrShop = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ms.id');
        $objectDB->from('mechanic_shops as ms');
        $objectDB->where('ms.email=:email', array(':email' => $strEmail));
        if (!empty($intShop)) {
            $objectDB->andWhere('ms.id!=:id', array(':id' => $intShop));
        }
        $arrShop = $objectDB->queryRow();
        return $arrShop;
    }

    public static function updateShop($arrShop, $intShop) {
        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('mechanic_shops', $arrShop, 'id=:id', array(':id' => $intShop));
        return $intUpdate;
    }

    public static function getMechanicCode() {
        $arrCodeDetails = array();
        try {
            $strQuery = 'select code,id from mechanic_shops order by id desc limit 1';
            $arrCodeDetails = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $ex) {
            $arrCodeDetails = $ex->getMessage();
        }

        return $arrCodeDetails;
    }
    public static function isCodeExist($strCode,$intShop = NULL){
        $arrShop = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ms.id');
        $objectDB->from('mechanic_shops as ms');
        $objectDB->where('ms.code=:code', array(':code' => $strCode));
        if (!empty($intShop)) {
            $objectDB->andWhere('ms.id!=:id', array(':id' => $intShop));
        }
        $arrShop = $objectDB->queryRow();
        return $arrShop;
    }
}
