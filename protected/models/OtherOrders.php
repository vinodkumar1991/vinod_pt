<?php

class OtherOrders extends CActiveRecord {

    public $strTable = 'other_orders';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrOther
     * @return integer It will return an integer response
     */
    public static function create($arrOther) {
        $intOtherOrderId = NULL;
        $objOther = new OtherOrders();
        $objOther->customer_id = isset($arrOther['customer_id']) ? $arrOther['customer_id'] : 0;
        $objOther->order_number = $arrOther['order_number'];
        $objOther->vehicle_types_id = $arrOther['vehicle_type'];
        $objOther->vehicle_brand_id = $arrOther['brand_id'];
        $objOther->vehicle_brand_model_id = $arrOther['model_id'];
        $objOther->vehicle_service_types_id = $arrOther['service_id'];
        $objOther->is_exclusive = $arrOther['is_exclusive'];
        $objOther->status = $arrOther['status'];
        $objOther->device_id = $arrOther['device_id'];
        $objOther->created_date = $arrOther['created_date'];
        $objOther->created_by = $arrOther['created_by'];
        $objOther->ip_address = $arrOther['ip_address'];
        $objOther->customer_added_vehicles_id = isset($arrOther['added_vehicles_id']) ? $arrOther['added_vehicles_id'] : NULL;
        if ($objOther->save()) {
            $intOtherOrderId = $objOther->id;
        }
        return $intOtherOrderId;
    }

    public static function otherOrdersReport($intVehicle, $intOrderStatus, $strServiceId, $arrMinMaxLatiLongis, $strOtherRejcted = NULL) {
        $arrOtherOrders = array();
        try {
            $strQuery = 'SELECT oo.order_number,oo.is_exclusive,osc.name as customer_name,osc.mobile as customer_mobile,
                     vb.id as brand_id,vb.name as brand_name,vb.logo as brand_logo,
                     CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/web/models/original/" ELSE "/bikes/web/models/original/" END AS model_path,
                     CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END AS brand_path,oo.is_exclusive,st.name as service_name,osc.booked_date,osc.booked_time,osc.latitude,osc.longitude,osc.location as customer_address,vbm.name as model_name,vb.name as brand_name,vbm.image_path as model_logo,oo.customer_id,oo.id as order_id
                        FROM `other_orders` `oo`
                        JOIN `other_services_communication` `osc` ON osc.other_orders_id = oo.id
                        JOIN `vehicle_types` `vt` ON vt.id = oo.vehicle_types_id
                        JOIN `vehicle_brands` `vb` ON vb.id = oo.vehicle_brand_id
                        JOIN `vehicle_brand_models` `vbm` ON vbm.id = oo.vehicle_brand_model_id
                        JOIN `service_types` `st` ON st.id = oo.vehicle_service_types_id where ';
            //$strQuery .='oo.vehicle_types_id = "' . $intVehicle . '" and oo.order_status = "' . $intOrderStatus . '" and oo.vehicle_service_types_id in("5")';
            $strQuery .= 'oo.vehicle_types_id = "' . $intVehicle . '" and oo.order_status = "' . $intOrderStatus . '" and oo.vehicle_service_types_id in(' . $strServiceId . ')';
            if (!empty($arrMinMaxLatiLongis)) {
                $strQuery .= ' and osc.longitude between "' . $arrMinMaxLatiLongis['min_lati'] . '" and "' . $arrMinMaxLatiLongis['max_lati'] . '"';
                $strQuery .= ' and osc.latitude between "' . $arrMinMaxLatiLongis['min_longi'] . '" and "' . $arrMinMaxLatiLongis['max_longi'] . '"';
            }
            if (!empty($strOtherRejcted)) {
                $strQuery .= ' and oo.id not in(' . $strOtherRejcted . ')';
            }
            $strQuery .= ' order by oo.id DESC';

            $arrOtherOrders = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $arrOtherOrders;
    }

    public static function updateOrderStatus($intOrder, $arrOrder, $intOtherOrderId = NULL) {
        $arrOrderDetails = array();
        $objCommand = Yii::app()->db->createCommand();
        if (empty($intOtherOrderId)) {
            $intUpdate = $objCommand->update('other_orders', $arrOrder, 'id=:id', array(':id' => $intOrder));
        } else {
            $intUpdate = $objCommand->update('other_orders', $arrOrder, 'id=:id', array(':id' => $intOrder));
        }

        return $intUpdate;
    }

    public function orderStatus($intOrder, $intStatus) {
        $arrOrders = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('o.id');
        $objectDB->from('other_orders as o');
        $objectDB->where('o.id=:orderId and o.order_status=:orderStatus', array(':orderId' => $intOrder, ':orderStatus' => $intStatus));
        $arrOrders = $objectDB->queryRow();
        return $arrOrders;
    }

    public static function otherAcceptedOrdersReport($intShop, $intVehicle, $intOrderStatus, $strServiceId, $arrMinMaxLatiLongis) {
        $arrOtherOrders = array();
        $intStatus = 1;
        try {
            $strQuery = 'SELECT oo.order_number,oo.is_exclusive,osc.name as customer_name,osc.mobile as customer_mobile,
                     vb.id as brand_id,vb.name as brand_name,vb.logo as brand_logo,
                     CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/web/models/original/" ELSE "/bikes/web/models/original/" END AS model_path,
                     CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END AS brand_path,oo.is_exclusive,st.name as service_name,osc.booked_date,osc.booked_time,osc.latitude,osc.longitude,osc.location as customer_address,vbm.name as model_name,vb.name as brand_name,vbm.image_path as model_logo,oo.customer_id,oo.id as order_id,concat_ws("",DATE_FORMAT(osc.booked_date,"%b %d %Y"),", ",osc.booked_time) as order_booked_date,
                     oo.vehicle_service_types_id,db.name as delivery_boy_name,db.phone as delivery_boy_phone,db.email as delivery_boy_email,
                     CASE WHEN oo.order_status = 2 THEN 0
                           WHEN oo.order_status = 4 THEN 1
                           WHEN oo.order_status = 6 THEN 2
                           WHEN oo.order_status = 7 THEN 3
                           WHEN oo.order_status = 10 THEN 4
                           WHEN oo.order_status = 8 THEN 5
                           ELSE 0 END AS delivery_status,
                           oo.order_status,round(oob.basic,2) as baic_amount,round(oob.final,2) as final_amount,round(oob.tax,2) as tax_amount
                        FROM other_orders as oo
                        LEFT JOIN other_services_communication as osc ON osc.other_orders_id = oo.id
                        LEFT JOIN vehicle_types as vt ON vt.id = oo.vehicle_types_id
                        LEFT JOIN vehicle_brands as vb ON vb.id = oo.vehicle_brand_id
                        LEFT JOIN vehicle_brand_models as  vbm ON vbm.id = oo.vehicle_brand_model_id
                        left join shop_other_orders as so on so.other_orders_id = oo.id
                        left join delivery_boys as db on db.users_id = so.delivery_boys_id
                        left join delivery_boys_details as dbd on dbd.delivery_boys_id = db.id
                        left join other_orders_billing as oob on oob.other_orders_id = oo.id
                        LEFT JOIN `service_types` `st` ON st.id = oo.vehicle_service_types_id where ';
            $strQuery .= 'so.shop_id = "' . $intShop . '" and oo.vehicle_types_id = "' . $intVehicle . '" and oo.order_status in("2","4","5","6","7","8","10") and oo.vehicle_service_types_id in("5") and so.is_closed !="' . $intStatus . '"';
            if (!empty($arrMinMaxLatiLongis)) {
                $strQuery .= ' and osc.longitude between "' . $arrMinMaxLatiLongis['min_lati'] . '" and "' . $arrMinMaxLatiLongis['max_lati'] . '"';
                $strQuery .= ' and osc.latitude between "' . $arrMinMaxLatiLongis['min_longi'] . '" and "' . $arrMinMaxLatiLongis['max_longi'] . '"';
            }
            $strQuery .= ' order by oo.id DESC';
            $arrOtherOrders = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $arrOtherOrders;
    }

    public static function getCRNDetails($strCRN) {
        $arrOrders = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('o.id as order_id');
        $objectDB->from('other_orders as o');
        $objectDB->where('o.crn=:CRN', array(':CRN' => $strCRN));
        $arrOrders = $objectDB->queryRow();
        return $arrOrders;
    }

    public static function OtherOrderInfo($intOtherOrder = NULL, $intOtherOrderNumber = NULL) {
        $arrOtherOrders = array();
        try {
            $strQuery = 'SELECT oo.order_number,
                                oo.is_exclusive,osc.name as customer_name,
                                osc.mobile as customer_mobile,
                                vb.id as brand_id,
                                vb.name as brand_name,
                                vb.logo as brand_logo,
                                CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/web/models/original/" ELSE "/bikes/web/models/original/" END AS model_path,
                                CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END AS brand_path,
                                oo.is_exclusive,
                                st.name as service_name,
                                osc.booked_date,osc.booked_time,
                                osc.latitude,
                                osc.longitude,
                                osc.location as customer_address,
                                vbm.name as model_name,
                                vb.name as brand_name,
                                vbm.image_path as model_logo,
                                oo.customer_id,
                                oo.id as order_id,
                                concat_ws("",DATE_FORMAT(osc.booked_date,"%b %d %Y"),", ",osc.booked_time) as order_booked_date,
                                oo.vehicle_service_types_id,
                                db.name as delivery_boy_name,
                                db.phone as delivery_boy_phone,
                                db.email as delivery_boy_email,
                                oo.order_status,
                                round(oob.basic,2) as basic,
                                round(oob.final,2) as final,
                                round(oob.tax,2) as tax,
                                oob.invoice_date,
                                oob.invoice_number,c.first_name as customer_primary_fullname,cp.phone as customer_phone
                                
                                FROM other_orders as oo
                                LEFT JOIN other_services_communication as osc ON osc.other_orders_id = oo.id
                                LEFT JOIN other_orders_billing as oob ON oob.other_orders_id = oo.id
                                LEFT JOIN vehicle_types as vt ON vt.id = oo.vehicle_types_id
                                LEFT JOIN vehicle_brands as vb ON vb.id = oo.vehicle_brand_id
                                LEFT JOIN vehicle_brand_models as  vbm ON vbm.id = oo.vehicle_brand_model_id
                                left join shop_other_orders as so on so.other_orders_id = oo.id
                                left join delivery_boys as db on db.users_id = so.delivery_boys_id
                                left join delivery_boys_details as dbd on dbd.delivery_boys_id = db.id
                                left join customer as c on c.id = oo.customer_id
                                left join customer_phone as cp on cp.customer_id = c.id
                                LEFT JOIN `service_types` `st` ON st.id = oo.vehicle_service_types_id where ';
            if (!empty($intOtherOrder)) {
                $strQuery .= ' oo.id = "' . $intOtherOrder . '"';
            } else {
                $strQuery .= ' oo.order_number = "' . $intOtherOrderNumber . '"';
            }
            $arrOtherOrders = Yii::app()->db->createCommand($strQuery)->queryRow();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $arrOtherOrders;
    }

    public static function getOtherOrders($intCustomer) {
        $arrOtherOrders = array();

        try {
            $strQuery = 'SELECT oo.order_number,
                oo.is_exclusive,
                osc.name as customer_name,
                osc.mobile as customer_mobile,
                     vb.id as brand_id,
                     vb.name as brand_name,
                     vb.logo as brand_logo,
                     CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/web/models/original/" ELSE "/bikes/web/models/original/" END AS model_path,
                     CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END AS brand_path,
                     oo.is_exclusive,
                     st.name as service_name,
                     osc.booked_date,
                     osc.booked_time,
                     osc.latitude,
                     osc.longitude,
                     osc.location as customer_address,
                     vbm.name as model_name,
                     vb.name as brand_name,
                     vbm.image_path as model_logo,
                     oo.customer_id,
                     oo.id as order_id,
                     cav.registration_number,
                     vt.id as vehicle_type_id,
                     (CASE WHEN oo.order_status = 1 THEN "NEW"
                           WHEN oo.order_status = 2 THEN "ACCEPTED"
                           WHEN oo.order_status = 3 THEN "REJECTED"
                           WHEN oo.order_status = 4 THEN "ASSIGNED"
                           WHEN oo.order_status = 5 THEN "PICKUP ACCEPTED"
                           WHEN oo.order_status = 6 THEN "STARTED"
                           WHEN oo.order_status = 7 THEN "REPAIRS STARTED"
                           WHEN oo.order_status = 8 THEN "REPAIRS COMPLETED"
                           WHEN oo.order_status = 9 THEN "READY FOR DELIVERY"
                           WHEN oo.order_status = 10 THEN "FINISHED"
                           WHEN oo.order_status = 11 THEN "VEHICLE_COLLECTED"
                           WHEN oo.order_status = 12 THEN "CANCELLED"
                           WHEN oo.order_status = 13 THEN "DELIVERY ACCEPTED"
                           ELSE "NEW" END) AS other_order_status,
                           oob.basic,
                           oob.tax,
                           oob.final,
                           (CASE WHEN oo.payment_modes_id = 4 THEN 0 ELSE 1 END) AS is_paid,
                           oo.crn as order_crn
                        FROM `other_orders` `oo`
                        LEFT JOIN `other_services_communication` `osc` ON osc.other_orders_id = oo.id
                        LEFT JOIN `other_orders_billing` as `oob` ON oob.other_orders_id = oo.id
                        LEFT JOIN `vehicle_types` `vt` ON vt.id = oo.vehicle_types_id
                        LEFT JOIN `vehicle_brands` `vb` ON vb.id = oo.vehicle_brand_id
                        LEFT JOIN `vehicle_brand_models` `vbm` ON vbm.id = oo.vehicle_brand_model_id
                        LEFT JOIN customer_add_vehicles as cav on cav.id = oo.customer_added_vehicles_id
                        LEFT JOIN `service_types` `st` ON st.id = oo.vehicle_service_types_id where oo.customer_id ="' . $intCustomer . '"';
            $strQuery .= ' order by oo.id DESC';
            $arrOtherOrders = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $arrOtherOrders;
    }

    public static function otherOrdersHistory($intShop = NULL, $intVehicle = NULL) {
        $arrOtherOrders = array();
        $intStatus = 1;
        try {
            $strQuery = 'SELECT oo.order_number,oo.is_exclusive,osc.name as customer_name,osc.mobile as customer_mobile,
                     vb.id as brand_id,vb.name as brand_name,vb.logo as brand_logo,
                     CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/web/models/original/" ELSE "/bikes/web/models/original/" END AS model_path,
                     CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END AS brand_path,oo.is_exclusive,st.name as service_name,osc.booked_date,osc.booked_time,osc.latitude,osc.longitude,osc.location as customer_address,vbm.name as model_name,vb.name as brand_name,vbm.image_path as model_logo,oo.customer_id,oo.id as order_id,concat_ws("",DATE_FORMAT(osc.booked_date,"%b %d %Y"),", ",osc.booked_time) as order_booked_date,
                     oo.vehicle_service_types_id,db.name as delivery_boy_name,db.phone as delivery_boy_phone,db.email as delivery_boy_email,
                     CASE WHEN oo.order_status = 2 THEN 0
                           WHEN oo.order_status = 4 THEN 1
                           WHEN oo.order_status = 6 THEN 2
                           WHEN oo.order_status = 7 THEN 3
                           WHEN oo.order_status = 10 THEN 4
                           WHEN oo.order_status = 8 THEN 5
                           ELSE 0 END AS delivery_status,
                           oo.order_status,round(oob.basic,2) as baic_amount,round(oob.final,2) as final_amount,round(oob.tax,2) as tax_amount,
                           (CASE WHEN oo.order_status = 1 THEN "NEW"
                           WHEN oo.order_status = 2 THEN "ACCEPTED"
                           WHEN oo.order_status = 3 THEN "REJECTED"
                           WHEN oo.order_status = 4 THEN "ASSIGNED"
                           WHEN oo.order_status = 5 THEN "PICKUP ACCEPTED"
                           WHEN oo.order_status = 6 THEN "COLLECTED"
                           WHEN oo.order_status = 7 THEN "REPAIRS STARTED"
                           WHEN oo.order_status = 8 THEN "REPAIRS COMPLETED"
                           WHEN oo.order_status = 9 THEN "READY FOR DELIVERY"
                           WHEN oo.order_status = 10 THEN "FINISHED"
                           WHEN oo.order_status = 11 THEN "VEHICLE_COLLECTED"
                           WHEN oo.order_status = 12 THEN "CANCELLED"
                           WHEN oo.order_status = 13 THEN "DELIVERY ACCEPTED"
                           ELSE "NEW" END) AS order_final_status
                        FROM other_orders as oo
                        LEFT JOIN other_services_communication as osc ON osc.other_orders_id = oo.id
                        LEFT JOIN vehicle_types as vt ON vt.id = oo.vehicle_types_id
                        LEFT JOIN vehicle_brands as vb ON vb.id = oo.vehicle_brand_id
                        LEFT JOIN vehicle_brand_models as  vbm ON vbm.id = oo.vehicle_brand_model_id
                        left join shop_other_orders as so on so.other_orders_id = oo.id
                        left join delivery_boys as db on db.users_id = so.delivery_boys_id
                        left join delivery_boys_details as dbd on dbd.delivery_boys_id = db.id
                        left join other_orders_billing as oob on oob.other_orders_id = oo.id
                        LEFT JOIN `service_types` `st` ON st.id = oo.vehicle_service_types_id where ';
            //$strQuery .='so.shop_id = "' . $intShop . '" and oo.vehicle_types_id = "' . $intVehicle . '" and oo.order_status in("2","4","5","6","7","8") and oo.vehicle_service_types_id in("5")';
            if (!empty($intShop)) {
                $strQuery .= 'so.shop_id = "' . $intShop . '" and oo.order_status in("2","4","5","6","7","8","10") and oo.vehicle_service_types_id in("5") and so.is_closed = "' . $intStatus . '"';
            }

            $strQuery .= ' order by oo.id DESC';
            $arrOtherOrders = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $arrOtherOrders;
    }

    public static function OtherOrderDesc($intOtherOrder = NULL, $intOtherOrderNumber = NULL, $intCustomer = NULL) {
        $arrOtherOrders = array();
        try {
            $strQuery = 'SELECT oo.order_number,
                                vb.name as brand_name,
                                vb.id as brand_id,
                                vb.logo as brand_logo,
                                vbm.name as model_name,
                                vbm.image_path as model_logo,
                                vbm.id as model_id,
                                CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/web/models/original/" ELSE "/bikes/web/models/original/" END AS model_path,
                                CASE WHEN oo.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END AS brand_path,
                                vt.id as vehicle_type_id,
                                vt.name as vehicle_name,
                                oo.order_status,
                                round(oob.final,2) as final_amount,
                                osc.booked_date as pickup_date,
                                osc.booked_time as  pickup_time,
                                concat_ws(" :: ",vb.name,vbm.name) as model_brand_name,
                                st.id as service_type_id,
                                st.name as service_name,
                                pm.id as payment_mode,
                                pm.name as payment_type,
                                osc.latitude as order_latitude,
                                osc.longitude as order_longitude,
                                osc.location as order_location,
                                msd.location as shop_location,
                                msd.latitude as shop_latitude,
                                msd.longitude as shop_longitude,
                                ms.name as shop_name,
                                ms.owner as shop_owner,
                                ms.email as shop_email,
                                ms.phone as shop_phone,
                                msd.photo_image as shop_image,
                                CASE WHEN msd.id > 0 THEN "/mechanics/photo/original/" ELSE "/mechanics/photo/original/" END AS shop_image_path,
                                db.name as runner_name,
                                db.email as runner_email,
                                db.phone as runner_phone,
                                CASE WHEN oo.id > 0 THEN "" ELSE "" END AS plan_name,
                                CASE WHEN oo.id > 0 THEN "" ELSE "" END AS vehicle_variant,
                                oo.id as orderId,
                                cav.registration_number,
                                msd.location as runner_location,
                                msd.latitude as runner_latitude,
                                msd.longitude as runner_longitude,
                                dbd.photo_path as runner_image,
                                CASE WHEN dbd.id > 0 THEN "/delivery_boys/photo/original/" ELSE "/delivery_boys/photo/original/" END AS runner_image_path,
                                DATE_FORMAT(oo.completed_date,"%b %d, %Y") as vehicle_delivery_date,
                                oo.completed_time as vehicle_delivery_time,
                                ms.id as shop_id,
                                db.id as delivery_boy_id,
                                CASE WHEN oo.order_status = 1 THEN "NEW"
                           WHEN oo.order_status = 2 THEN "ACCEPTED"
                           WHEN oo.order_status = 3 THEN "REJECTED"
                           WHEN oo.order_status = 4 THEN "ASSIGNED"
                           WHEN oo.order_status = 5 THEN "PICKUP ACCEPTED"
                           WHEN oo.order_status = 6 THEN "COLLECTED"
                           WHEN oo.order_status = 7 THEN "REPAIRS STARTED"
                           WHEN oo.order_status = 8 THEN "REPAIRS COMPLETED"
                           WHEN oo.order_status = 9 THEN "READY FOR DELIVERY"
                           WHEN oo.order_status = 10 THEN "FINISHED"
                           WHEN oo.order_status = 11 THEN "VEHICLE_COLLECTED"
                           WHEN oo.order_status = 12 THEN "CANCELLED"
                           WHEN oo.order_status = 13 THEN "DELIVERY ACCEPTED"
                           ELSE "NEW" END AS order_status,
                           (CASE WHEN oo.payment_modes_id = 4 THEN 0 ELSE 1 END) AS is_paid,
                           oo.crn as order_crn
                                

                                
                                FROM other_orders as oo
                                LEFT JOIN other_services_communication as osc ON osc.other_orders_id = oo.id
                                LEFT JOIN other_orders_billing as oob ON oob.other_orders_id = oo.id
                                LEFT JOIN vehicle_types as vt ON vt.id = oo.vehicle_types_id
                                LEFT JOIN vehicle_brands as vb ON vb.id = oo.vehicle_brand_id
                                LEFT JOIN vehicle_brand_models as  vbm ON vbm.id = oo.vehicle_brand_model_id
                                left join shop_other_orders as so on so.other_orders_id = oo.id
                                left join mechanic_shops as ms on ms.id = so.shop_id
                                left join mechanic_shop_details as msd on msd.mechanic_shops_id = ms.id
                                left join delivery_boys as db on db.users_id = so.delivery_boys_id
                                left join delivery_boys_details as dbd on dbd.delivery_boys_id = db.id
                                left join payment_modes as pm on pm.id = oo.payment_modes_id
                                left join customer_add_vehicles as cav on cav.id = oo.customer_added_vehicles_id
                                LEFT JOIN service_types as st ON st.id = oo.vehicle_service_types_id where ';
            if (!empty($intOtherOrder)) {
                $strQuery .= ' oo.id = "' . $intOtherOrder . '"';
            } else if (!empty($intOtherOrderNumber)) {
                $strQuery .= ' oo.order_number = "' . $intOtherOrderNumber . '"';
            } else if (!empty($intCustomer)) {
                $strQuery .= ' oo.customer_id = "' . $intCustomer . '"';
            }
            $strQuery .= ' order by oo.id desc';
            $arrOtherOrders = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $arrOtherOrders;
    }

}
