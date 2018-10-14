<?php

class DeliveryBoysDetails extends CActiveRecord {

    public $strTable = 'delivery_boys_details';

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
        if ($objMechanicShop->save()) {
            $intMechanicShop = $objMechanicShop->id;
        }
        return $intMechanicShop;
    }

    public static function isShopNameExist($strShopName) {
        $arrShop = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ms.id');
        $objectDB->from('mechanic_shops as ms');
        $objectDB->where('ms.name=:name', array(':name' => $strShopName));
        $arrShop = $objectDB->queryRow();
        return $arrShop;
    }

    public static function mechanicShopsReport($arrInputs = array()) {
        $arrShop = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ms.id,ms.name as shop_name,ms.owner as shop_owner,ms.license as shop_license,'
                . 'ms.email as shop_email,'
                . 'ms.phone as shop_phone,'
                . 'u.username,u.first_name,ms.code as shop_code,group_concat(st.name) as service_names,msd.total_mechanics,msd.service_capability,ms.status,group_concat(st.id) as service_ids,msd.location,msd.latitude,msd.longitude,mss.vehicle_types_id as vehicle_id'
        );
        $objectDB->from('mechanic_shops as ms');
        $objectDB->join('users as u', 'u.id = ms.users_id');
        $objectDB->join('mechanic_shop_details as msd', 'msd.mechanic_shops_id = ms.id');
        $objectDB->join('mechanic_shops_services as mss', 'mss.mechanic_shops_id = ms.id');
        $objectDB->join('vehicle_types as vt', 'vt.id = mss.vehicle_types_id');
        $objectDB->join('service_types as st', 'st.id = mss.service_types_id');
        if (isset($arrInputs['status']) && !empty($arrInputs['status'])) {
            $objectDB->where('ms.status=:status', array(':status' => $arrInputs['status']));
        }
        if (isset($arrInputs['shop_id']) && !empty($arrInputs['shop_id'])) {
            $objectDB->andWhere('ms.id=:shop_id', array(':shop_id' => $arrInputs['shop_id']));
        }
        $objectDB->group('ms.id');
        $objectDB->order('ms.users_id', 'ms.id desc');

        $arrShop = $objectDB->queryAll();
        return $arrShop;
    }

    public static function getMechanicShops($intVehicle, $intService, $intStatus = 1, $arrLatiLongis) {
        $arrShops = array();
        try {
            $strQuery = 'SELECT  ms.id as shop_id,ms.name as shop_name,ms.owner as shop_owner,ms.code as shop_code,msd.latitude,msd.longitude,ms.email,ms.phone,msd.location as address
                     FROM mechanic_shops as ms 
                     left join mechanic_shop_details as msd on msd.mechanic_shops_id = ms.id
                     left join mechanic_shops_services as mss on mss.mechanic_shops_id = ms.id';

            $strQuery .=' where mss.vehicle_types_id ="' . $intVehicle . '" and mss.service_types_id ="' . $intService . '" and ms.status ="' . $intStatus . '" and mss.status ="' . $intStatus . '"';
            if (!empty($arrLatiLongis)) {
                $strQuery .='and msd.latitude between "' . $arrLatiLongis['min_lati'] . '" and "' . $arrLatiLongis['max_lati'] . '"';
                $strQuery .='and msd.longitude between "' . $arrLatiLongis['min_longi'] . '" and "' . $arrLatiLongis['max_longi'] . '"';
            }
            $strQuery .=' order by ms.id,ms.name';
            $arrShops = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            $arrShops = $e->getMessage();
        }
        return $arrShops;
    }

    public function getDeliveryBoys($intShop) {
        $arrDeliveryBoys = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('u.id as user_id,u.first_name as user_name,u.role_types_id as role_id,ms.id as shop_id,ms.name as shop_name,ms.code as shop_code,ms.owner as shop_owner,mss.vehicle_types_id as vehicle_id,vt.name as vehicle_type,db.id as delivery_boy_id,db.name as delivery_boy_name,db.email as delivery_boy_email,db.phone as delivery_boy_phone');
        $objectDB->from('delivery_boys as db');
        $objectDB->join('users as u', 'u.id = db.users_id');
        $objectDB->leftJoin('mechanic_shops as ms', 'ms.id = db.mechanic_shops_id');
        $objectDB->leftJoin('mechanic_shop_details as msd', 'msd.mechanic_shops_id = ms.id');
        $objectDB->leftJoin('mechanic_shops_services as mss', 'mss.mechanic_shops_id = ms.id');
        $objectDB->leftJoin('vehicle_types as vt', 'vt.id = mss.vehicle_types_id');
        $objectDB->where('db.mechanic_shops_id=:shopId', array(':shopId' => $intShop));
        $arrDeliveryBoys = $objectDB->queryRow();
        return $arrDeliveryBoys;
    }

}
