<?php

class PushNotifications extends CActiveRecord {

    public $strTable = 'push_notifications';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function create($arrNotification) {
        $intNotification = NULL;
        $objPushNotification = new PushNotifications();
        $objPushNotification->order_id = isset($arrNotification['order_id']) ? $arrNotification['order_id'] : NULL;
        $objPushNotification->order_number = isset($arrNotification['order_number']) ? $arrNotification['order_number'] : NULL;
        $objPushNotification->role_id = isset($arrNotification['role_id']) ? $arrNotification['role_id'] : NULL;
        $objPushNotification->user_id = isset($arrNotification['user_id']) ? $arrNotification['user_id'] : NULL;
        $objPushNotification->shop_id = isset($arrNotification['shop_id']) ? $arrNotification['shop_id'] : NULL;
        $objPushNotification->delivery_boy_id = isset($arrNotification['delivery_boy_id']) ? $arrNotification['delivery_boy_id'] : NULL;
        $objPushNotification->message = isset($arrNotification['message']) ? $arrNotification['message'] : NULL;
        $objPushNotification->notification_code = isset($arrNotification['notification_code']) ? $arrNotification['notification_code'] : NULL;
        $objPushNotification->title = isset($arrNotification['title']) ? $arrNotification['title'] : NULL;
        $objPushNotification->status = isset($arrNotification['status']) ? $arrNotification['status'] : 1;
        $objPushNotification->created_date = $arrNotification['created_date'];
        $objPushNotification->created_by = $arrNotification['created_by'];
        $objPushNotification->ip_address = $arrNotification['ip_address'];
        $objPushNotification->location = $arrNotification['location'];
        $objPushNotification->latitude = $arrNotification['latitude'];
        $objPushNotification->longitude = $arrNotification['longitude'];
        $objPushNotification->gcm_register_id = isset($arrNotification['gcm_register_id']) ? $arrNotification['gcm_register_id'] : NULL;
        $objPushNotification->notification_type = isset($arrNotification['notification_type']) ? $arrNotification['notification_type'] : NULL;
        if ($objPushNotification->save()) {
            $intNotification = $objPushNotification->id;
        }
        return $intNotification;
    }

    //public static function getNotifications($arrInput, $arrMinMaxLatiLongis = array(), $intStatus = 1) {
    public static function getNotifications($intStatus = 1, $intRole = NULL) {
        $arrNotifications = array();
//        $strQuery = 'SELECT pn.id AS notification_id, pn.order_id, pn.order_number, pn.message, pn.title
//                        FROM push_notifications as pn
//                        WHERE pn.status ="' . $intStatus . '"';
//        if (!empty($arrInput['role_id'])) {
//            $strQuery .= ' and pn.role_id ="' . $arrInput['role_id'] . '"';
//        }
//        if (!empty($arrInput['notification_code'])) {
//            $strQuery .= ' and pn.notification_code ="' . $arrInput['notification_code'] . '"';
//        }
//        if (!empty($arrMinMaxLatiLongis)) {
//            $strQuery .=' and pn.latitude between "' . $arrMinMaxLatiLongis['min_lati'] . '" and "' . $arrMinMaxLatiLongis['max_lati'] . '"';
//            $strQuery .=' and pn.longitude between "' . $arrMinMaxLatiLongis['min_longi'] . '" and "' . $arrMinMaxLatiLongis['max_longi'] . '"';
//        }
//        $strQuery .= ' order by pn.id desc';

        $strQuery = 'SELECT pn.id AS notification_id, pn.order_id, pn.order_number, pn.message, pn.title,pn.gcm_register_id,pn.notification_type
                        FROM push_notifications as pn
                        WHERE pn.status ="' . $intStatus . '"';
        if (!empty($intRole)) {
            $strQuery .= ' and pn.role_id =' . $intRole;
        }
        $strQuery .= ' order by pn.id desc';
        $arrNotifications = Yii::app()->db->createCommand($strQuery)->queryAll();
        return $arrNotifications;
    }

    public static function updateNotificationStatus($intNotification, $arrNotification) {
        //$objCommand = Yii::app()->db->createCommand();
        $strQuery = 'update push_notifications set status ="' . $arrNotification['status'] . '" where id="' . $intNotification . '"';
        $intUpdate = Yii::app()->db->createCommand($strQuery)->execute();
        //$intUpdate = $objCommand->update('push_notifications', $arrNotification, 'notification_code=:id', array(':id' => $intNotification));
        return $intUpdate;
    }

}
