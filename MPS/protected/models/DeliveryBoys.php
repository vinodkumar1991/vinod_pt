<?php

/**
 * @author Digital Today
 * @access public
 * @ignore It will handle Sector activities
 */
class DeliveryBoys extends CActiveRecord {

    private $strTable = 'delivery_boys';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrDelivery
     * @return integer It will return sector item id
     */
    public static function create($arrDelivery) {
        $intDelivery = NULL;
        try {
            $objDelivery = new DeliveryBoys();
            if (isset($arrDelivery['id']) && !empty($arrDelivery['id'])) {
                $objDelivery = DeliveryBoys::model()->find('id=:id', array(':id' => $arrDelivery['id']));
            }
            $objDelivery->mechanic_shops_id = $arrDelivery['mechanic_shops_id'];
            $objDelivery->users_id = $arrDelivery['user_id'];
            $objDelivery->name = $arrDelivery['name'];
            $objDelivery->code = $arrDelivery['code'];
            $objDelivery->email = $arrDelivery['email'];
            $objDelivery->phone = $arrDelivery['phone'];
            $objDelivery->age = $arrDelivery['age'];
            $objDelivery->description = NULL;
            $objDelivery->status = $arrDelivery['status'];
            $objDelivery->created_date = $arrDelivery['created_date'];
            $objDelivery->created_by = $arrDelivery['created_by'];
            $objDelivery->ip_address = $arrDelivery['ip_address'];
            if ($objDelivery->save()) {
                $intDelivery = $objDelivery->id;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $intDelivery;
    }

    public static function deliveryBoysReport($arrInputs = array()) {

        $arrDelivery = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ms.name as shop_name,ms.code as shop_code,'
                . 'db.name as delivery_boy_name,db.code as delivery_boy_code,db.email as delivery_boy_email,'
                . 'db.phone as delivery_boy_phone,db.status,u.username,dbd.address_one,dbd.address_two,'
                . 'db.id,db.age,'
                . 'dbd.address_proof_path,'
                . 'dbd.photo_path,'
                . 'dbd.driving_license_path,u.username,u.password,db.users_id,db.code as delivery_code'
        );
        $objectDB->from('delivery_boys as db');
        $objectDB->join('mechanic_shops as ms', 'ms.id = db.mechanic_shops_id');
        $objectDB->join('users as u', 'u.id = db.users_id');
        $objectDB->join('delivery_boys_details as dbd', 'dbd.delivery_boys_id = db.id');
        if (isset($arrInputs['status']) && !empty($arrInputs['status'])) {
            $objectDB->where('db.status=:status', array(':status' => $arrInputs['status']));
        }
        if (isset($arrInputs['delivery_boy']) && !empty($arrInputs['delivery_boy'])) {
            $objectDB->where('db.id=:deliveryBoyId', array(':deliveryBoyId' => $arrInputs['delivery_boy']));
        }
        $objectDB->order('db.id', 'db.name desc');
        $arrDelivery = $objectDB->queryAll();
        return $arrDelivery;
    }

    public static function isEmailExist($strEmail, $intDelivery = NULL) {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('db.id');
        $objectDB->from('delivery_boys as db');
        $objectDB->where('db.email=:email', array(':email' => $strEmail));
        if (!empty($intDelivery)) {
            $objectDB->andWhere('db.id!=:id', array(':id' => $intDelivery));
        }
        $arrDelivery = $objectDB->queryRow();
        return $arrDelivery;
    }

    public static function isPhoneExist($strPhone, $intDelivery = NULL) {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('db.id');
        $objectDB->from('delivery_boys as db');
        $objectDB->where('db.phone=:phone', array(':phone' => $strPhone));
        if (!empty($intDelivery)) {
            $objectDB->andWhere('db.id!=:id', array(':id' => $intDelivery));
        }
        $arrDelivery = $objectDB->queryRow();
        return $arrDelivery;
    }

    public static function updateDeliveryBoy($arrDeliveryBoy, $intDeliveryBoy) {
        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('delivery_boys', $arrDeliveryBoy, 'id=:id', array(':id' => $intDeliveryBoy));
        return $intUpdate;
    }

    public static function getDeliveryCode() {
        $arrCodeDetails = array();
        try {
            $strQuery = 'select code,id from delivery_boys order by id desc limit 1';
            $arrCodeDetails = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $ex) {
            $arrCodeDetails = $ex->getMessage();
        }

        return $arrCodeDetails;
    }
    public static function isCodeExist($strCode,$intDelivery=NULL){
         $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('db.id');
        $objectDB->from('delivery_boys as db');
        $objectDB->where('db.code=:code', array(':code' => $strCode));
        if (!empty($intDelivery)) {
            $objectDB->andWhere('db.id!=:id', array(':id' => $intDelivery));
        }
        $arrDelivery = $objectDB->queryRow();
        return $arrDelivery;
    }

}
