<?php

class ShopOtherOrders extends CActiveRecord {

    public $strTable = 'shop_other_orders';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrShopOtherOrders
     * @return integer It will return last inserted id of shop accepted orders
     */
    public static function create($arrShopOtherOrders) {
        $intShopOtherOrder = NULL;
        $objShopOtherOrders = new ShopOtherOrders();
        $objShopOtherOrders->shop_id = $arrShopOtherOrders['shop_id'];
        $objShopOtherOrders->other_orders_id = $arrShopOtherOrders['order_id'];
        $objShopOtherOrders->status = $arrShopOtherOrders['status'];
        $objShopOtherOrders->created_date = $arrShopOtherOrders['created_date'];
        $objShopOtherOrders->created_by = $arrShopOtherOrders['created_by'];
        $objShopOtherOrders->ip_address = $arrShopOtherOrders['ip_address'];
        $objShopOtherOrders->device_id = $arrShopOtherOrders['device_id'];
        $objShopOtherOrders->imei_no = $arrShopOtherOrders['imei_no'];
        if ($objShopOtherOrders->save()) {
            $intShopOtherOrder = $objShopOtherOrders->id;
        }
        return $intShopOtherOrder;
    }

    public function assignOrderToBoy($intShop, $intOrder, $intDeliveryBoy = NULL, $arrDeliveryBoy = array()) {
        $objCommand = Yii::app()->db->createCommand();
        if (empty($intDeliveryBoy)) {
            $intUpdate = $objCommand->update('shop_other_orders', $arrDeliveryBoy, 'shop_id=:shopId and other_orders_id=:orderId', array(':orderId' => $intOrder, ':shopId' => $intShop));
        } else if (!empty($intDeliveryBoy)) {
            $intUpdate = $objCommand->update('shop_other_orders', $arrDeliveryBoy, 'shop_id=:shopId and other_orders_id=:orderId and delivery_boys_id=:deliveryBoyId', array(':orderId' => $intOrder, ':shopId' => $intShop, ':deliveryBoyId' => $intDeliveryBoy));
        }
        return $intUpdate;
    }

    public function isDeliveryBoyHaveOrders($intDeliveryBoy) {
        $intActive = 1;
        $intInactive = 0;
        $strQuery = 'select so.id from shop_other_orders as so where so.delivery_boys_id = "' . $intDeliveryBoy . '"
                      and ((so.is_accepted = "' . $intActive . '" and so.is_collected = "' . $intInactive . '") or (so.is_accepted = "' . $intInactive . '" and so.is_collected = "' . $intActive . '") or (so.is_accepted = "' . $intInactive . '" and so.is_collected = "' . $intInactive . '"))';
        $arrOrders = Yii::app()->db->createCommand($strQuery)->queryAll();
        return $arrOrders;
    }

    public function getShopDetails($intOrder) {
        $arrShopDetails = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ms.id as shop_id,ms.name as shop_name,ms.owner as shop_owner,msd.location as shop_location,'
                . 'msd.longitude,msd.latitude,vt.name as vehicle_name,vt.id as vehicle_id,'
                . 'o.order_number,vbm.image_path as model_logo,(CASE WHEN  o.vehicle_types_id = 1 THEN "/cars/mobile/models/original/" ELSE "/bikes/mobile/models/original/" END) AS model_path,(CASE WHEN o.status = 1 THEN "Petrol" ELSE "Diesel" END) AS vehicle_variant,
                    (CASE WHEN o.order_status = 1 THEN "NEW"
                           WHEN o.order_status = 2 THEN "ACCEPTED"
                           WHEN o.order_status = 3 THEN "REJECTED"
                           WHEN o.order_status = 4 THEN "ASSIGNED"
                           WHEN o.order_status = 5 THEN "PICKUP ACCEPTED"
                           WHEN o.order_status = 6 THEN "STARTED"
                           WHEN o.order_status = 7 THEN "REPAIRS STARTED"
                           WHEN o.order_status = 8 THEN "REPAIRS COMPLETED"
                           WHEN o.order_status = 9 THEN "READY FOR DELIVERY"
                           WHEN o.order_status = 10 THEN "FINISHED"
                           WHEN o.order_status = 11 THEN "VEHICLE_COLLECTED"
                           WHEN o.order_status = 12 THEN "CANCELLED"
                           ELSE "NEW" END) AS order_status_stage,
                           msd.photo_image,
                           CASE WHEN msd.id > 0 THEN "/mechanics/photo/original/" ELSE "/mechanics/photo/original/" END AS mechanic_image_path');
        $objectDB->from('shop_other_orders as so');
        $objectDB->join('other_orders as o', 'o.id = so.other_orders_id');
        $objectDB->join('vehicle_types as vt', 'vt.id = o.vehicle_types_id');
        $objectDB->join('vehicle_brand_models as vbm', 'vbm.id = o.vehicle_brand_model_id');
        $objectDB->join('mechanic_shops as ms', 'ms.id = so.shop_id');
        $objectDB->join('mechanic_shop_details as msd', 'msd.mechanic_shops_id = so.shop_id');
        $objectDB->where('so.other_orders_id=:orderId', array(':orderId' => $intOrder));
        $arrShopDetails = $objectDB->queryRow();
        return $arrShopDetails;
    }

    public function getOrderStatus($intOrder, $intStatus) {
        $arrShopDetails = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('o.id,msd.location,msd.latitude,msd.longitude,o.completed_time as completedTime,concat_ws("",DATE_FORMAT(o.completed_date,"%b %d %Y"),", ",o.completed_time) as completed_time,(CASE WHEN o.order_status = 1 THEN "NEW"
                           WHEN o.order_status = 2 THEN "ACCEPTED"
                           WHEN o.order_status = 3 THEN "REJECTED"
                           WHEN o.order_status = 4 THEN "ASSIGNED"
                           WHEN o.order_status = 5 THEN "PICKUP ACCEPTED"
                           WHEN o.order_status = 6 THEN "COLLECTED"
                           WHEN o.order_status = 7 THEN "REPAIRS STARTED"
                           WHEN o.order_status = 8 THEN "REPAIRS COMPLETED"
                           WHEN o.order_status = 9 THEN "READY FOR DELIVERY"
                           WHEN o.order_status = 10 THEN "FINISHED"
                           WHEN o.order_status = 11 THEN "VEHICLE_COLLECTED"
                           WHEN o.order_status = 12 THEN "CANCELLED"
                           ELSE "NEW" END) AS order_status_stage');
        $objectDB->from('other_orders as o');
        $objectDB->leftJoin('shop_other_orders as so', 'so.other_orders_id = o.id');
        $objectDB->leftJoin('mechanic_shops as ms', 'ms.id = so.shop_id');
        $objectDB->leftJoin('mechanic_shop_details as msd', 'msd.mechanic_shops_id = ms.id');
        $objectDB->where('o.id=:orderId and o.order_status=:orderStatus', array(':orderId' => $intOrder, ':orderStatus' => $intStatus));
        $arrShopDetails = $objectDB->queryRow();
        return $arrShopDetails;
    }

//    public function isAssigned($intShop, $intOrder, $intRunner) {
//        $arrShopOrders = array();
//        $intStatus = 1;
//        $objectDB = Yii::app()->db->createCommand();
//        $objectDB->select('so.id');
//        $objectDB->from('shop_other_orders as so');
//        $objectDB->where('so.shop_id=:shopId and so.status=:status and so.other_orders_id=:orderId and so.delivery_boys_id=:deliveryBoyId', array(':shopId' => $intShop, ':status' => $intStatus, ':orderId' => $intOrder, ':deliveryBoyId' => $intRunner));
//        $arrShopOrders = $objectDB->queryRow();
//        return $arrShopOrders;
//    }

    public function isAssigned($intShop, $intOrder, $intRunner = 0) {
        $arrShopOrders = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('so.id,so.is_accepted,so.is_collected,so.is_completed,so.is_started,so.is_repairs_completed,so.is_repair_delivery_boy');
        $objectDB->from('shop_other_orders as so');
        if (empty($intRunner)) {
            $objectDB->where('so.shop_id=:shopId and so.status=:status and so.other_orders_id=:orderId', array(':shopId' => $intShop, ':status' => $intStatus, ':orderId' => $intOrder));
        } else if (!empty($intRunner)) {
            $objectDB->where('so.shop_id=:shopId and so.status=:status and so.other_orders_id=:orderId and so.delivery_boys_id=:deliveryBoyId', array(':shopId' => $intShop, ':status' => $intStatus, ':orderId' => $intOrder, ':deliveryBoyId' => $intRunner));
        } else if (!empty($isStarted)) {
            $objectDB->where('so.shop_id=:shopId and so.status=:status and so.other_orders_id=:orderId', array(':shopId' => $intShop, ':status' => $intStatus, ':orderId' => $intOrder));
        }
        $arrShopOrders = $objectDB->queryRow();
        return $arrShopOrders;
    }

    public function updateOrderStatus($intOrder, $arrOrder) {
        $objCommand = Yii::app()->db->createCommand();
        $intUpdate = $objCommand->update('shop_other_orders', $arrOrder, 'other_orders_id=:orderId', array(':orderId' => $intOrder));
        return $intUpdate;
    }

    public function shopOrdersStatus($intOrder, $intRunner = 0) {
        $arrShopOrders = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('so.id,so.is_collected,so.delivery_boys_id');
        $objectDB->from('shop_other_orders as so');
        if (!empty($intRunner)) {
            $objectDB->where('so.other_orders_id=:orderId and so.delivery_boys_id=:runnerId', array(':orderId' => $intOrder, ':runnerId' => $intRunner));
        } else {
            $objectDB->where('so.other_orders_id=:orderId', array(':orderId' => $intOrder));
        }
        $arrShopOrders = $objectDB->queryRow();
        return $arrShopOrders;
    }

}
