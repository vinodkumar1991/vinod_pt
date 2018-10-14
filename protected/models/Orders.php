<?php

class Orders extends CActiveRecord {

    public $strTable = 'orders';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function create($arrOrder) {
        $intOrderId = NULL;
        $objectOrder = new Orders();
        $objectOrder->customer_id = $arrOrder['customer_id'];
        $objectOrder->order_number = $arrOrder['order_number'];
        $objectOrder->vehicle_types_id = $arrOrder['vehicle_types_id'];
        $objectOrder->vehicle_brand_id = $arrOrder['vehicle_brand_id'];
        $objectOrder->vehicle_brand_model_id = $arrOrder['vehicle_brand_model_id'];
        $objectOrder->vehicle_categories_id = $arrOrder['vehicle_categories_id'];
        $objectOrder->vehicle_service_type_id = $arrOrder['vehicle_service_type_id'];
        $objectOrder->vehicle_plan_id = $arrOrder['vehicle_plan_id'];
        $objectOrder->payment_modes_id = $arrOrder['payment_modes_id'];
        $objectOrder->created_date = $arrOrder['created_date'];
        $objectOrder->created_by = $arrOrder['created_by'];
        $objectOrder->ip_address = $arrOrder['ip_address'];
        $objectOrder->device_types_id = $arrOrder['device_types_id'];
        $objectOrder->customer_added_vehicles_id = isset($arrOrder['added_vehicles_id']) ? $arrOrder['added_vehicles_id'] : NULL;
        if ($objectOrder->save()) {
            $intOrderId = $objectOrder->id;
        }
        return $intOrderId;
    }

    public static function getOrders($intCustomerId) {
        $arrOrders = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('o.id as orderId,o.order_number, '
                . 'vt.name as  vehicle_name,'
                . 'st.name as service_name,'
                . 'pt.name as plan_name,'
                . 'round(ob.final,2) as final_amount,'
                . 'pm.name as payment_mode,'
                . 'DATE_FORMAT(oc.pickup_date,"%b %d, %Y")as pickup_date,'
                . 'oc.pickup_time,'
                . '(CASE WHEN o.order_status = 1 THEN "NEW"
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
                           WHEN o.order_status = 13 THEN "DELIVERY ACCEPTED"
                           ELSE "NEW" END) AS order_status,
                           vb.name as brand_name,
                           vbm.name as model_name,
                           concat_ws(" :: ",vb.name,vbm.name) as model_brand_name,
                           cav.registration_number,
                           vt.id as vehicle_type_id,
                           vb.id as brand_id,
                           vb.name as brand_name,
                           vb.logo as brand_logo,
                           vbm.id as model_id,
                           vbm.name as model_name,
                           vbm.image_path as model_logo,
                           CASE WHEN o.vehicle_types_id = 1 THEN "/cars/web/models/original/" ELSE "/bikes/web/models/original/" END AS model_path,
                           CASE WHEN o.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END AS brand_path,
                           CASE WHEN o.vehicle_variant_id = 1 THEN "Petrol" ELSE "Diesel" END AS vehicle_variant,
                           oc.latitude as order_latitude,
                           oc.longitude as order_longitude,
                           oc.location as order_location,
                           msd.location as shop_location,
                           msd.latitude as shop_latitude,
                           msd.longitude as shop_longitude,
                           ms.name as shop_name,
                           ms.owner as shop_owner,
                           ms.email as shop_email,
                           ms.phone as shop_phone,
                           msd.photo_image as shop_image,
                           db.name as runner_name,
                           db.email as runner_email,
                           db.phone as runner_phone,
                           msd.location as runner_location,
                           msd.latitude as runner_latitude,
                           msd.longitude as runner_longitude,
                           dbd.photo_path as runner_image,
                           DATE_FORMAT(o.completed_date,"%b %d, %Y") as vehicle_delivery_date,
                           o.completed_time as vehicle_delivery_time,
                           CASE WHEN dbd.id > 0 THEN "/delivery_boys/photo/original/" ELSE "/delivery_boys/photo/original/" END AS runner_image_path,
                           CASE WHEN msd.id > 0 THEN "/mechanics/photo/original/" ELSE "/mechanics/photo/original/" END AS shop_image_path,
                           ms.id as shop_id,
                           db.id as delivery_boy_id,
                           round(ob.basic,2) as order_basic_amount,
                           ob.invoice_number as order_invoice_number,
                           (CASE WHEN o.payment_modes_id = 4 THEN 0 ELSE 1 END) AS is_paid,
                           o.crn as order_crn,o.order_status as order_status_id
                           ');
        $objectDB->from('orders as o');
        $objectDB->join('orders_communication as oc', 'oc.order_id = o.id');
        $objectDB->join('orders_billing as ob', 'ob.order_id = o.id');
        $objectDB->join('vehicle_types as vt', 'vt.id = o.vehicle_types_id');
        $objectDB->join('service_types as st', 'st.id = o.vehicle_service_type_id');
        $objectDB->join('plans_types as pt', 'pt.id = o.vehicle_plan_id');
        $objectDB->join('payment_modes as pm', 'pm.id = o.payment_modes_id');
        $objectDB->leftJoin('customer_add_vehicles as cav', 'cav.id = o.customer_added_vehicles_id');
        $objectDB->join('vehicle_brands as vb', 'vb.id = o.vehicle_brand_id');
        $objectDB->join('vehicle_brand_models as vbm', 'vbm.id = o.vehicle_brand_model_id');
        $objectDB->leftJoin('shop_orders as so', 'so.order_id = o.id');
        $objectDB->leftJoin('mechanic_shops as ms', 'ms.id = so.shop_id');
        $objectDB->leftJoin('mechanic_shop_details as msd', 'msd.mechanic_shops_id = ms.id');
        $objectDB->leftJoin('delivery_boys as db', 'db.id = so.delivery_boys_id');
        $objectDB->leftJoin('delivery_boys_details as dbd', 'dbd.delivery_boys_id = db.id');
        $objectDB->where('o.customer_id=:customerId', array(':customerId' => $intCustomerId));
        $objectDB->order('o.id desc');
        $arrOrders = $objectDB->queryAll();
        return $arrOrders;
    }

    /**
     * @author Digital Today
     * @param integer $intVehicle
     * @param integer $intOrderStatus
     * @param string $strShopServices
     * @param array $arrMinMaxLatiLongis
     * @param integer $intStatus
     * @return array It will return orders by service wise
     */
    public function getShopOrders($intVehicle, $intOrderStatus, $strShopServices, $arrMinMaxLatiLongis, $intStatus = 1, $strRejected = NULL) {
        $arrOrders = array();
        try {
            $strQuery = 'select o.id,o.order_number,o.order_status,o.vehicle_service_type_id,st.name as service_name,vbm.name as model_name,vbm.image_path as  model_logo,
                     concat_ws("",DATE_FORMAT(oc.pickup_date,"%b %d %Y"),", ",oc.pickup_time) as order_booked_date,oc.location as customer_address,oc.latitude,oc.longitude,
                     oc.name as customer_fullname,oc.email as customer_email,oc.phone as customer_phone,
                     pt.name as plan_name,pt.id as plan_id,
                     vb.id as brand_id,vb.name as brand_name,vb.logo as brand_logo,
                      CASE WHEN o.vehicle_types_id = 1 THEN "/cars/web/models/original/" ELSE "/bikes/web/models/original/" END AS model_path,
                      CASE WHEN o.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END AS brand_path,
                      CASE WHEN o.vehicle_variant_id = 1 THEN "Petrol" ELSE "Diesel" END AS vehicle_variant,
                      concat_ws("",c.first_name," ",c.middle_name," ",c.last_name) as customer_primary_fullname,ce.email as customer_primary_email,cp.phone as customer_primary_phone,
                      c.id as customer_id,
                      CASE WHEN o.order_status = 2 THEN 0
                           WHEN o.order_status = 3 THEN 1
                           ELSE 2 END AS delivery_status
                        from orders as o
                        left join orders_communication as oc on oc.order_id = o.id
                        left join customer as c on c.id = o.customer_id
                        left join customer_email as ce on ce.customer_id = c.id and ce.status = "' . $intStatus . '" and ce.is_primary = "' . $intStatus . '"
                        left join customer_phone as cp on cp.customer_id = c.id and cp.status = "' . $intStatus . '" and cp.is_primary = "' . $intStatus . '"
                        left join plans_types as pt on pt.id = o.vehicle_plan_id
                        left join service_types as st on st.id = o.vehicle_service_type_id
                        left join vehicle_brands as vb on vb.id = o.vehicle_brand_id
                        left join vehicle_brand_models as vbm on vbm.id = o.vehicle_brand_model_id where ';
            //$strQuery .='o.vehicle_types_id = "' . $intVehicle . '" and o.order_status = "' . $intOrderStatus . '" and o.vehicle_service_type_id in("1","2","3","6","7","5")';
            $strQuery .= 'o.vehicle_types_id = "' . $intVehicle . '" and o.order_status = "' . $intOrderStatus . '" and o.vehicle_service_type_id in(' . $strShopServices . ')';
            if (!empty($arrMinMaxLatiLongis)) {
                $strQuery .= ' and oc.latitude between "' . $arrMinMaxLatiLongis['min_lati'] . '" and "' . $arrMinMaxLatiLongis['max_lati'] . '"';
                $strQuery .= ' and oc.longitude between "' . $arrMinMaxLatiLongis['min_longi'] . '" and "' . $arrMinMaxLatiLongis['max_longi'] . '"';
            }
            if (!empty($strRejected)) {
                $strQuery .= ' and o.id not in(' . $strRejected . ')';
            }
            $strQuery .= ' order by o.id DESC';
            $arrOrders = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            $arrOrders = $e->getMessage();
        }
        return $arrOrders;
    }

    //Need to change
    public function getShopOrdersCount() {
        $arrOrdersCount = array();
        try {
            $strQuery = 'select 
                     sum(IF(o.order_status = 1,1,0)) as new_orders,
                     sum(IF(o.order_status = 2,1,0)) as accepted_orders
                     from orders as o';
            $arrOrdersCount = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            $arrOrdersCount = $e->getMessage();
        }
        return $arrOrdersCount;
    }

    public function orderInfo($strOrderNo = NULL, $intOrder = NULL) {
        $arrOrder = array();
        $intStatus = 1;
        try {
            //CASE WHEN o.vehicle_types_id = 1 THEN "/cars/mobile/models/120X70/" ELSE "/bikes/mobile/models/120X70/" END AS model_path,
            $strQuery = 'select o.id,o.order_number,o.order_status,o.vehicle_service_type_id,st.name as service_name,vbm.name as model_name,vbm.image_path as  model_logo,
                     concat_ws("",DATE_FORMAT(oc.pickup_date,"%b %d %Y"),", ",oc.pickup_time) as order_booked_date,oc.location as customer_address,oc.latitude,oc.longitude,
                     oc.name as customer_fullname,oc.email as customer_email,oc.phone as customer_phone,
                     pt.name as plan_name,pt.id as plan_id,
                     vb.id as brand_id,vb.name as brand_name,vb.logo as brand_logo,
                      CASE WHEN o.vehicle_types_id = 1 THEN "/cars/web/models/original/" ELSE "/bikes/web/models/original/" END AS model_path,
                      CASE WHEN o.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END AS brand_path,
                      CASE WHEN o.vehicle_variant_id = 1 THEN "Petrol" ELSE "Diesel" END AS vehicle_variant,
                      pm.id as payment_mode_id,pm.name as payment_mode_name,ca.address as customer_primary_address,
                      ca.pincode as customer_primary_pincode,
                      concat_ws("",c.first_name," ",c.middle_name," ",c.last_name) as customer_primary_fullname,
                      ce.email as customer_primary_email,
                      cp.phone as customer_primary_phone,
                      round(ob.basic,2) as basic,round(ob.final,2) as final,round(ob.tax,2) as tax,dt.name as device_name,ob.invoice_number,ob.invoice_date,					                      
                      vt.name as vehicle_name, vt.id as vehicle_id,st.icon_path as service_image,                   
                    ms.name AS shopname, ms.email AS  shopemail,ms.phone AS shopphone,msd.location AS shopaddress,DATE_FORMAT(oc.pickup_date,"%d-%m-%Y") as booked_date,oc.pickup_time as booked_time,round(ob.extra_add_ons,2) as extra_add_ons,
                     msd.photo_image as shop_image,
                       CASE WHEN msd.id > 0 THEN "/mechanics/photo/original/" ELSE "/mechanics/photo/original/" END AS shop_image_path,
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
                           WHEN o.order_status = 13 THEN "DELIVERY ACCEPTED"
                           ELSE "NEW" END) AS order_status_desc,ob.transaction_status,ob.extra_add_ons
                        from orders as o
                        left join orders_communication as oc on oc.order_id = o.id
                        left join orders_billing as ob on ob.order_id = o.id
                        left join device_types as dt on dt.id = ob.device_types_id
                        left join payment_modes as pm on pm.id = o.payment_modes_id
                        left join customer as c on c.id = o.customer_id
                        left join customer_email as ce on ce.customer_id = c.id and ce.status = "' . $intStatus . '" and ce.is_primary = "' . $intStatus . '"
                        left join customer_phone as cp on cp.customer_id = c.id and cp.status = "' . $intStatus . '" and cp.is_primary = "' . $intStatus . '"
                        left join customer_address as ca on ca.customer_id = c.id and ca.status = "' . $intStatus . '" and ca.is_primary = "' . $intStatus . '"
                        left join plans_types as pt on pt.id = o.vehicle_plan_id
                        left join service_types as st on st.id = o.vehicle_service_type_id
                        left join vehicle_brands as vb on vb.id = o.vehicle_brand_id
                        left join vehicle_types as vt on vt.id = o.vehicle_types_id
                        left join shop_orders AS so ON so.order_id=o.id
                        left join mechanic_shops AS ms ON ms.id=so.shop_id
                        left join mechanic_shop_details AS msd ON msd.id=ms.id
                        left join vehicle_brand_models as vbm on vbm.id = o.vehicle_brand_model_id where ';
            if (!empty($intOrder)) {
                $strQuery .= 'o.id ="' . $intOrder . '"';
            } else {
                $strQuery .= 'o.order_number ="' . $strOrderNo . '"';
            }

            $arrOrder = Yii::app()->db->createCommand($strQuery)->queryRow();
        } catch (Exception $e) {
            $arrOrder = $e->getMessage();
        }
        return $arrOrder;
    }

    public function orderStatus($intOrder, $intStatus = NULL) {
        $arrOrders = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('o.id,o.order_status');
        $objectDB->from('orders as o');
        if (empty($intStatus)) {
            $objectDB->where('o.id=:orderId', array(':orderId' => $intOrder));
        } else {
            $objectDB->where('o.id=:orderId and o.order_status=:orderStatus', array(':orderId' => $intOrder, ':orderStatus' => $intStatus));
        }
        $arrOrders = $objectDB->queryRow();
        return $arrOrders;
    }

    public static function updateOrderStatus($intOrder, $intStatus, $arrOrder = array()) {
        $arrOrderDetails = array();
        if (empty($arrOrder)) {
            $arrOrderDetails = array('order_status' => $intStatus);
        } else {
            $arrOrderDetails = $arrOrder;
        }
        $objCommand = Yii::app()->db->createCommand();
        $intUpdate = $objCommand->update('orders', $arrOrderDetails, 'id=:id', array(':id' => $intOrder));
        return $intUpdate;
    }

    /**
     * @author Digital Today
     * @param integer $intVehicle
     * @param integer $intOrderStatus
     * @param string $strShopServices
     * @param array $arrMinMaxLatiLongis
     * @param integer $intStatus
     * @return array It will return orders by service wise
     */
    public function getAcceptedOrders($intShop, $intVehicle, $intOrderStatus, $strShopServices, $arrMinMaxLatiLongis, $intStatus = 1, $strRejected = NULL) {
        $arrOrders = array();
        try {
            //CASE WHEN o.vehicle_types_id = 1 THEN "/cars/mobile/models/120X70/" ELSE "/bikes/mobile/models/120X70/" END AS model_path,
            $strQuery = 'select o.id,o.order_number,o.order_status,o.vehicle_service_type_id,st.name as service_name,vbm.name as model_name,vbm.image_path as  model_logo,
                     concat_ws("",DATE_FORMAT(oc.pickup_date,"%b %d %Y"),", ",oc.pickup_time) as order_booked_date,oc.location as customer_address,oc.latitude,oc.longitude,
                     oc.name as customer_fullname,oc.email as customer_email,oc.phone as customer_phone,
                     pt.name as plan_name,pt.id as plan_id,
                     vb.id as brand_id,vb.name as brand_name,vb.logo as brand_logo,
                      CASE WHEN o.vehicle_types_id = 1 THEN "/cars/web/models/original/" ELSE "/bikes/web/models/original/" END AS model_path,
                      CASE WHEN o.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END AS brand_path,
                      CASE WHEN o.vehicle_variant_id = 1 THEN "Petrol" ELSE "Diesel" END AS vehicle_variant,
                      concat_ws("",c.first_name," ",c.middle_name," ",c.last_name) as customer_primary_fullname,ce.email as customer_primary_email,cp.phone as customer_primary_phone,
                      c.id as customer_id,
                      CASE WHEN o.order_status = 2 THEN 0
                           WHEN o.order_status = 4 THEN 1
                           WHEN o.order_status = 6 THEN 2
                           WHEN o.order_status = 7 THEN 3
                           WHEN o.order_status = 10 THEN 4
                           WHEN o.order_status = 8 THEN 5
                           ELSE 0 END AS delivery_status,
                           db.name as delivery_boy_name,db.email as delivery_boy_email,db.phone as delivery_boy_phone,o.completed_time,
                           round(ob.basic,2) as baic_amount,round(ob.final,2) as final_amount,round(ob.tax,2) as tax_amount
                        from orders as o
                        left join shop_orders as so on so.order_id = o.id
                        left join delivery_boys as db on db.users_id = so.delivery_boys_id
                        left join delivery_boys_details as dbd on dbd.delivery_boys_id = db.id
                        left join orders_communication as oc on oc.order_id = o.id
                        left join customer as c on c.id = o.customer_id
                        left join customer_email as ce on ce.customer_id = c.id and ce.status = "' . $intStatus . '" and ce.is_primary = "' . $intStatus . '"
                        left join customer_phone as cp on cp.customer_id = c.id and cp.status = "' . $intStatus . '" and cp.is_primary = "' . $intStatus . '"
                        left join plans_types as pt on pt.id = o.vehicle_plan_id
                        left join service_types as st on st.id = o.vehicle_service_type_id
                        left join vehicle_brands as vb on vb.id = o.vehicle_brand_id
                        left join orders_billing as ob on ob.order_id = o.id
                        left join vehicle_brand_models as vbm on vbm.id = o.vehicle_brand_model_id where ';
            $strQuery .= 'so.shop_id ="' . $intShop . '" and o.vehicle_types_id = "' . $intVehicle . '" and o.order_status in("2","4","5","6","7","8","10") and o.vehicle_service_type_id in("2","1","3","6","7") and so.is_closed !="' . $intStatus . '"';
            //$strQuery .='o.vehicle_types_id = "' . $intVehicle . '" and o.order_status in("2","4","5","6","7") and o.vehicle_service_type_id in(' . $strShopServices . ')';

            if (!empty($arrMinMaxLatiLongis)) {
                $strQuery .= ' and oc.latitude between "' . $arrMinMaxLatiLongis['min_lati'] . '" and "' . $arrMinMaxLatiLongis['max_lati'] . '"';
                $strQuery .= ' and oc.longitude between "' . $arrMinMaxLatiLongis['min_longi'] . '" and "' . $arrMinMaxLatiLongis['max_longi'] . '"';
            }
            if (!empty($strRejected)) {
                $strQuery .= ' and o.id not in(' . $strRejected . ')';
            }
            $strQuery .= ' order by o.id DESC';
            $arrOrders = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            $arrOrders = $e->getMessage();
        }
        return $arrOrders;
    }

    public static function getCRNDetails($strCRN) {
        $arrOrders = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('o.id as order_id');
        $objectDB->from('orders as o');
        $objectDB->where('o.crn=:CRN', array(':CRN' => $strCRN));
        $arrOrders = $objectDB->queryRow();
        return $arrOrders;
    }

    public function getMechanicHistory($intShop = NULL, $intVehicle = NULL) {
        $arrOrders = array();
        $intStatus = 1;
        try {
            $strQuery = 'select o.id,o.order_number,o.order_status,o.vehicle_service_type_id,st.name as service_name,vbm.name as model_name,vbm.image_path as  model_logo,
                     concat_ws("",DATE_FORMAT(oc.pickup_date,"%b %d %Y"),", ",oc.pickup_time) as order_booked_date,oc.location as customer_address,oc.latitude,oc.longitude,
                     oc.name as customer_fullname,oc.email as customer_email,oc.phone as customer_phone,
                     pt.name as plan_name,pt.id as plan_id,
                     vb.id as brand_id,vb.name as brand_name,vb.logo as brand_logo,
                      CASE WHEN o.vehicle_types_id = 1 THEN "/cars/web/models/original/" ELSE "/bikes/web/models/original/" END AS model_path,
                      CASE WHEN o.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END AS brand_path,
                      CASE WHEN o.vehicle_variant_id = 1 THEN "Petrol" ELSE "Diesel" END AS vehicle_variant,
                      concat_ws("",c.first_name," ",c.middle_name," ",c.last_name) as customer_primary_fullname,ce.email as customer_primary_email,cp.phone as customer_primary_phone,
                      c.id as customer_id,
                      CASE WHEN o.order_status = 2 THEN 0
                           WHEN o.order_status = 4 THEN 1
                           WHEN o.order_status = 6 THEN 2
                           WHEN o.order_status = 7 THEN 3
                           WHEN o.order_status = 10 THEN 4
                           WHEN o.order_status = 8 THEN 5
                           ELSE 0 END AS delivery_status,
                           db.name as delivery_boy_name,db.email as delivery_boy_email,db.phone as delivery_boy_phone,o.completed_time,
                           round(ob.basic,2) as baic_amount,round(ob.final,2) as final_amount,round(ob.tax,2) as tax_amount,(CASE WHEN o.order_status = 1 THEN "NEW"
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
                           WHEN o.order_status = 13 THEN "DELIVERY ACCEPTED"
                           ELSE "NEW" END) AS order_final_status
                        from orders as o
                        left join shop_orders as so on so.order_id = o.id
                        left join delivery_boys as db on db.users_id = so.delivery_boys_id
                        left join delivery_boys_details as dbd on dbd.delivery_boys_id = db.id
                        left join orders_communication as oc on oc.order_id = o.id
                        left join customer as c on c.id = o.customer_id
                        left join customer_email as ce on ce.customer_id = c.id and ce.status = "' . $intStatus . '" and ce.is_primary = "' . $intStatus . '"
                        left join customer_phone as cp on cp.customer_id = c.id and cp.status = "' . $intStatus . '" and cp.is_primary = "' . $intStatus . '"
                        left join plans_types as pt on pt.id = o.vehicle_plan_id
                        left join service_types as st on st.id = o.vehicle_service_type_id
                        left join vehicle_brands as vb on vb.id = o.vehicle_brand_id
                        left join orders_billing as ob on ob.order_id = o.id
                        left join vehicle_brand_models as vbm on vbm.id = o.vehicle_brand_model_id where ';
            if (!empty($intShop)) {
                $strQuery .= 'so.shop_id ="' . $intShop . '" and o.order_status in("2","4","5","6","7","8","10") and o.vehicle_service_type_id in("2","1","3","6","7") and so.is_closed ="' . $intStatus . '"';
            }
            //$strQuery .='o.vehicle_types_id = "' . $intVehicle . '" and o.order_status in("2","4","5","6","7") and o.vehicle_service_type_id in(' . $strShopServices . ')';
            $strQuery .= ' order by o.id DESC';
            $arrOrders = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            $arrOrders = $e->getMessage();
        }
        return $arrOrders;
    }
    public function extraRepairsList($strOrderNo = NULL, $intOrder = NULL) {
        $arrExtraReapirsList = array();
        $intStatus = 1;
        try {
            $strQuery = 'select oar.repair_name,oar.repair_amount from orders o inner join order_add_on_repairs '
                    . 'oar on oar.order_id =o.id where oar.status="' . $intStatus . '"';
             if (!empty($intOrder)) {
                $strQuery .= 'and o.id ="' . $intOrder . '"';
            } else {
                $strQuery .= 'and o.order_number ="' . $strOrderNo . '"';
            }
           $arrExtraReapirsList = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $ex) {
            $arrExtraReapirsList = $ex->getMessage();
        }
        return $arrExtraReapirsList;
    }
    public function getOrderNumber($intVehicle){
        $arrOrderNumberDetails = array();
        try {
           $strQuery = 'select order_number,id from orders where vehicle_types_id = "'.$intVehicle.'"  order by id desc limit 1';
           $arrOrderNumberDetails = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $ex) {
            $arrOrderNumberDetails = $ex->getMessage();
        }
       
        return $arrOrderNumberDetails;
    }

}
