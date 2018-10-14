<?php

class DeliveryBoys extends CActiveRecord {

    public $strTable = 'delivery_boys';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getDeliveryBoy($intShop, $intDeliveryBoy, $intHistory = 0, $intIsDeliver = 0) {
        $arrDeliveryBoys = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $strQuery = 'SELECT vbm.name as model_name,vbm.image_path as  model_logo,(CASE WHEN o.vehicle_types_id = 1 THEN "/cars/mobile/models/120X70/" ELSE "/bikes/mobile/models/120X70/" END) AS model_path,
                     (CASE WHEN o.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END) AS brand_path,
                     (CASE WHEN o.vehicle_variant_id = 1 THEN "Petrol" ELSE "Diesel" END) AS vehicle_variant,o.id,o.order_number,o.order_status,o.vehicle_service_type_id,st.name as service_name,
                     pt.name as plan_name,pt.id as plan_id,db.name as delivery_boy_name,u.id as delivery_boy_id,ms.id as shop_id,ms.name as shop_name,ms.owner as shop_owner,ROUND(ob.basic,2) as basic,ROUND(ob.tax,2) as tax,ROUND(ob.final,2) as final,
                     oc.location as booked_address,oc.latitude,oc.longitude,oc.pickup_date as booked_date,oc.pickup_time as booked_time,vb.id as brand_id,vb.name as brand_name,vb.logo as brand_logo,oc.name as customer_fullname,oc.email as customer_email,
                     oc.phone as customer_phone,
                     o.payment_modes_id,
                     so.is_repair_delivery_boy,
                     (CASE WHEN o.payment_modes_id = 1 THEN "COD"
                           WHEN o.payment_modes_id = 3 THEN "ONLINE"
                           ELSE "NOT PAID" END) AS payment_type,
                           (CASE WHEN (so.is_repair_delivery_boy > 0 && so.delivery_boys_id > 0) THEN 3
                                 WHEN so.is_repair_delivery_boy > 0 THEN 2
                                 WHEN so.delivery_boys_id > 0 THEN 1
                           ELSE "0" END) AS runner_role,o.vehicle_types_id
                     
                    FROM `delivery_boys` `db`
                    JOIN `users` `u` ON u.id = db.users_id
                    LEFT JOIN `mechanic_shops` `ms` ON ms.id = db.mechanic_shops_id
                    LEFT JOIN `mechanic_shop_details` `msd` ON msd.mechanic_shops_id = ms.id
                    LEFT JOIN `shop_orders` `so` ON so.delivery_boys_id = db.users_id
                    LEFT JOIN `orders` `o` ON o.id = so.order_id
                    LEFT JOIN `orders_communication` `oc` ON oc.order_id = o.id
                    LEFT JOIN `orders_billing` `ob` ON ob.order_id = o.id
                    LEFT JOIN `plans_types` `pt` ON pt.id = o.vehicle_plan_id
                    LEFT JOIN `service_types` `st` ON st.id = o.vehicle_service_type_id
                    LEFT JOIN `vehicle_brands` `vb` ON vb.id = o.vehicle_brand_id
                    LEFT JOIN `vehicle_brand_models` `vbm` ON vbm.id = o.vehicle_brand_model_id';
        if (!empty($intHistory)) {
            if (0 == $intIsDeliver) {
                $strQuery .= ' WHERE so.shop_id=' . $intShop . ' and so.is_repair_delivery_boy=' . $intDeliveryBoy . ' and o.order_status in("4","5","8","13","10") order by id desc';
            }
        } else {
            if (2 == $intIsDeliver) {
                $strQuery .= ' WHERE so.shop_id=' . $intShop . ' and so.is_repair_delivery_boy=' . $intDeliveryBoy . ' and o.order_status in("4","5","8","13") order by id desc';
            } elseif (1 == $intIsDeliver) {
                $strQuery .= ' WHERE so.shop_id=' . $intShop . ' and so.delivery_boys_id=' . $intDeliveryBoy . ' and o.order_status in("4","5","8","13") order by id desc';
            }
        }

        $arrDeliveryBoys = Yii::app()->db->createCommand($strQuery)->queryAll();
        return $arrDeliveryBoys;
    }

    public static function getDeliveryBoyDetails($intOrder, $intAnotherDeliveryBoy = NULL) {
        $arrDeliveryBoys = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('db.users_id as delivery_boy_id,ms.name as shop_name,db.email as delivery_boy_email,db.phone as delivery_boy_phone,ms.name as shop_name,db.name as delivery_boy_name,msd.location,msd.latitude,msd.longitude,concat_ws("",DATE_FORMAT(o.completed_date,"%b %d %Y"),", ",o.completed_time ) as  order_completed_on,o.crn,o.completed_time,
            (CASE WHEN o.order_status = 1 THEN "NEW"
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
                           ELSE "NEW" END) AS order_status_stage,
                           msd.photo_image,
                           CASE WHEN msd.id > 0 THEN "/mechanics/photo/original/" ELSE "/mechanics/photo/original/" END AS mechanic_image_path,
                           dbd.photo_path,
                           CASE WHEN dbd.id > 0 THEN "/delivery_boys/photo/original/" ELSE "/delivery_boys/photo/original/" END AS delivery_image_path,so.is_collected');
        $objectDB->from('shop_orders as so');
        if (empty($intAnotherDeliveryBoy)) {
            $objectDB->leftJoin('delivery_boys as db', 'so.delivery_boys_id = db.users_id');
        } else {
            $objectDB->leftJoin('delivery_boys as db', 'so.is_repair_delivery_boy = db.users_id');
        }
        $objectDB->leftJoin('delivery_boys_details as dbd', 'dbd.delivery_boys_id = db.id');
        $objectDB->leftJoin('mechanic_shops as ms', 'ms.id = db.mechanic_shops_id');
        $objectDB->leftJoin('mechanic_shop_details as msd', 'msd.mechanic_shops_id = ms.id');
        $objectDB->leftJoin('orders as o', 'o.id = so.order_id');
        $objectDB->where('so.order_id=:orderId', array(':orderId' => $intOrder));
        $arrDeliveryBoys = $objectDB->queryRow();
        return $arrDeliveryBoys;
    }

    public static function getRunner($intShop, $intDeliveryBoy, $intHistory = 0, $intIsDeliver = 0) {
        $arrDeliveryBoys = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $strQuery = 'SELECT vbm.name as model_name,
                            vbm.image_path as  model_logo,
                            (CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/mobile/models/120X70/" ELSE "/bikes/mobile/models/120X70/" END) AS model_path,
                            (CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END) AS brand_path,
                            oo.id,
                            oo.order_number,
                            oo.order_status,
                            oo.vehicle_service_types_id as vehicle_service_type_id,
                            st.name as service_name,
                            db.name as delivery_boy_name,
                            u.id as delivery_boy_id,
                            ms.id as shop_id,
                            ms.name as shop_name,
                            ms.owner as shop_owner,
                            ROUND(oob.basic,2) as basic,
                            ROUND(oob.tax,2) as tax,
                            ROUND(oob.final,2) as final,
                            osc.location as booked_address,
                            osc.latitude,
                            osc.longitude,
                            osc.booked_date,
                            osc.booked_time,
                            vb.id as brand_id,
                            vb.name as brand_name,
                            vb.logo as brand_logo,
                            osc.name as customer_fullname,
                            osc.mobile as customer_email,
                            osc.mobile as customer_phone,
                            oo.payment_modes_id,
                            oo.payment_modes_id as vehicle_variant,
                            soo.is_repair_delivery_boy,
                            (CASE WHEN oo.payment_modes_id = 1 THEN "COD"
                           WHEN oo.payment_modes_id = 3 THEN "ONLINE"
                           ELSE "NOT PAID" END) AS payment_type,
                           (CASE WHEN (soo.is_repair_delivery_boy > 0 && soo.delivery_boys_id > 0) THEN 3
                                 WHEN soo.is_repair_delivery_boy > 0 THEN 2
                                 WHEN soo.delivery_boys_id > 0 THEN 1
                           ELSE 0 END) AS runner_role,oo.vehicle_types_id
                           
                    FROM `delivery_boys` `db`
                    JOIN `users` as `u` ON u.id = db.users_id
                    LEFT JOIN `mechanic_shops` as `ms` ON ms.id = db.mechanic_shops_id
                    LEFT JOIN `mechanic_shop_details` as `msd` ON msd.mechanic_shops_id = ms.id
                    LEFT JOIN `shop_other_orders` as `soo` ON soo.delivery_boys_id = db.users_id
                    LEFT JOIN `other_orders` as `oo` ON oo.id = soo.other_orders_id
                    LEFT JOIN `other_services_communication` `osc` ON osc.other_orders_id = oo.id
                    LEFT JOIN `other_orders_billing` `oob` ON oob.other_orders_id = oo.id
                    LEFT JOIN `service_types` `st` ON st.id = oo.vehicle_service_types_id
                    LEFT JOIN `vehicle_brands` `vb` ON vb.id = oo.vehicle_brand_id
                    LEFT JOIN `vehicle_brand_models` `vbm` ON vbm.id = oo.vehicle_brand_model_id';

        if (!empty($intHistory)) {
            if (0 == $intIsDeliver) {
                $strQuery .= ' WHERE soo.shop_id=' . $intShop . ' and soo.delivery_boys_id=' . $intDeliveryBoy . ' and oo.order_status in("4","5","8","13","10") order by id desc';
            }
        } else {
            if (1 == $intIsDeliver) {
                $strQuery .= ' WHERE soo.shop_id=' . $intShop . ' and soo.delivery_boys_id=' . $intDeliveryBoy . ' and oo.order_status in("4","5","8","13") order by id desc';
            } elseif (2 == $intIsDeliver) {
                $strQuery .= ' WHERE soo.shop_id=' . $intShop . ' and soo.is_repair_delivery_boy=' . $intDeliveryBoy . ' and oo.order_status in("4","5","8","13") order by id desc';
            }
        }

        $arrDeliveryBoys = Yii::app()->db->createCommand($strQuery)->queryAll();
        return $arrDeliveryBoys;
    }

    public static function getRunnerDetails($intOrder, $intAnotherDeliveryBoy = NULL) {
        $arrDeliveryBoys = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('db.users_id as delivery_boy_id,ms.name as shop_name,db.email as delivery_boy_email,db.phone as delivery_boy_phone,ms.name as shop_name,db.name as delivery_boy_name,msd.location,msd.latitude,msd.longitude,concat_ws("",DATE_FORMAT(o.completed_date,"%b %d %Y"),", ",o.completed_time ) as  order_completed_on,o.crn,o.completed_time,
            (CASE WHEN o.order_status = 1 THEN "NEW"
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
                           ELSE "NEW" END) AS order_status_stage,
                           msd.photo_image,
                           CASE WHEN msd.id > 0 THEN "/mechanics/photo/original/" ELSE "/mechanics/photo/original/" END AS mechanic_image_path,
                           dbd.photo_path,
                           CASE WHEN dbd.id > 0 THEN "/delivery_boys/photo/original/" ELSE "/delivery_boys/photo/original/" END AS delivery_image_path,so.is_collected
                           ');
        $objectDB->from('shop_other_orders as so');
        if (empty($intAnotherDeliveryBoy)) {
            $objectDB->leftJoin('delivery_boys as db', 'so.delivery_boys_id = db.users_id');
        } else {
            $objectDB->leftJoin('delivery_boys as db', 'so.is_repair_delivery_boy = db.users_id');
        }
        $objectDB->leftJoin('delivery_boys_details as dbd', 'dbd.delivery_boys_id = db.id');
        $objectDB->leftJoin('mechanic_shops as ms', 'ms.id = db.mechanic_shops_id');
        $objectDB->leftJoin('mechanic_shop_details as msd', 'msd.mechanic_shops_id = ms.id');
        $objectDB->leftJoin('other_orders as o', 'o.id = so.other_orders_id');
        $objectDB->where('so.other_orders_id=:orderId', array(':orderId' => $intOrder));
        $arrDeliveryBoys = $objectDB->queryRow();
        return $arrDeliveryBoys;
    }

}
