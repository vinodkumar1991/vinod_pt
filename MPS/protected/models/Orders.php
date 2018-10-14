<?php

class Orders extends CActiveRecord {

    public $strTable = 'orders';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getBookingOrdersList($intOrder = NULL, $strOrderNo = NULL) {
        $arrOrders = array();
        try {
            $strQuery = 'select o.id,o.order_number,o.order_status,o.previous_order_status,o.vehicle_service_type_id,st.name as service_name,vbm.name as model_name,vbm.image_path as  model_logo,
                     concat_ws("",DATE_FORMAT(oc.pickup_date,"%b %d %Y"),", ",oc.pickup_time) as order_booked_date,oc.location as location,oc.latitude,oc.longitude,
                     oc.name as customer_fullname,oc.email as customer_email,oc.phone as customer_phone,
                     pt.name as plan_name,pt.id as plan_id,
                     vb.id as brand_id,vb.name as brand_name,vb.logo as brand_logo,
                      CASE WHEN o.vehicle_types_id = 1 THEN "/cars/mobile/models/120X70/" ELSE "/bikes/mobile/models/120X70/" END AS model_path,
                      CASE WHEN o.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END AS brand_path,
                      CASE WHEN o.vehicle_variant_id = 1 THEN "Petrol" ELSE "Diesel" END AS vehicle_variant,
                      concat_ws("",c.first_name," ",c.middle_name," ",c.last_name) as customer_primary_fullname,ce.email as customer_primary_email,cp.phone as customer_primary_phone,
                      c.id as customer_id,
                      FORMAT(final,2) AS amount,basic AS basic,tax AS tax,final AS final,
                      ms.name AS shopname, ms.email AS  shopemail,ms.phone AS shopphone,msd.location AS shopaddress,
                      vt.name AS vehicle_type,pm.id as payment_mode_id,pm.name as payment_mode_name,
                      DATE_FORMAT(o.created_date,"%b %d %Y") AS order_created_date,
                      IF(oc.address_one !="",oc.address_one,oc.address_two) AS customer_address
                        from orders as o
                        left join orders_communication as oc on oc.order_id = o.id
                        left join orders_billing AS ob ON ob.order_id=o.id
                        left join customer as c on c.id = o.customer_id
                        left join customer_email as ce on ce.customer_id = c.id 
                        left join customer_phone as cp on cp.customer_id = c.id 
                        left join plans_types as pt on pt.id = o.vehicle_plan_id
                        left join service_types as st on st.id = o.vehicle_service_type_id
                        left join vehicle_brands as vb on vb.id = o.vehicle_brand_id
                        left join vehicle_brand_models as vbm on vbm.id = o.vehicle_brand_model_id
                        LEFT JOIN vehicle_types AS vt ON vt.id=o.vehicle_types_id
                        LEFT JOIN shop_orders AS so ON so.order_id=o.id
                        LEFT JOIN mechanic_shops AS ms ON ms.id=so.shop_id
                        LEFT JOIN mechanic_shop_details AS msd ON msd.id=ms.id
                        left join payment_modes as pm on pm.id = o.payment_modes_id
                        ';
            if (!empty($strOrderNo)) {
                $strQuery .= ' where o.order_number ="' . $strOrderNo . '"';
            }
            if (!empty($intOrder)) {
                $strQuery .= ' and o.id ="' . $intOrder . '"';
            }
            $strQuery .= ' order by o.id DESC';
            //echo'<pre>';echo $strQuery;die();
            $arrOrders = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            $arrOrders = $e->getMessage();
        }
        return $arrOrders;
    }

    public function getModificationBookingOrdersList() {
        $arrModificationOrders = array();
        try {
            $Query = 'SELECT
                            mo.id,
                            mo.shop_id,
                            mo.order_number,
                            mo.order_status,
                            moc.name,moc.address, 
                            moc.pincode, 
                            moc.email,
                            moc.phone, 
                            moc.location    AS customer_location, 
                            moc.latitude, 
                            moc.longitude,
                            ms.name         AS shop_name,
                            ms.owner        AS owner_name,
                            vt.name         AS vehicle_type,
                            vb.name         AS brand_name,
                            mss.name        AS service_name,
                            msd.address     AS shop_adrs,
                            msd.location    AS shop_location,
                            ms.phone        AS shop_phone,
                            ms.email        AS shop_email,
                            DATE_FORMAT(moc.send_request_datetime,"%b %d %Y, %h:%i:%s %p") AS requested_datetime
                        FROM modification_orders AS mo
                        JOIN modification_orders_communication AS moc ON moc.order_id=mo.id
                        JOIN modification_shops AS ms ON ms.id=mo.shop_id
                        LEFT JOIN modification_shop_details AS msd ON ms.id=modification_shops_id
                        LEFT JOIN vehicle_types AS vt ON vt.id=mo.vehicle_types_id
                        LEFT JOIN vehicle_brands AS vb ON vb.id=vehicle_brand_id
                        LEFT JOIN modification_services AS mss ON mss.id=mo.vehicle_service_type_id
                        ORDER BY mo.id DESC ';
            $arrModificationOrders = Yii::app()->db->createCommand($Query)->queryAll();
        } catch (Exception $e) {
            $arrModificationOrders = $e->getMessage();
        }
        return $arrModificationOrders;
    }

    //Package Amount List
    public static function getServicePackageAmount($ServiceID) {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('st.id 		AS service_type_id,
                           pt.id 		AS plans_type_id,
                           sp.id 		AS service_plan_id,
                           st.name 		AS servicename, 
                           SUBSTRING_INDEX(pt.name,"_",-1) 
                                                AS planname, 
                           FORMAT(sp.package_amount,2) 	AS amount, 
                           vt.name 		AS vehicle_type,vc.id as vehicle_category_id,vc.name as vehicle_category_name');
        $objectDB->from('service_plans 	AS sp');
        $objectDB->leftJoin('plans_types   AS pt', 'pt.id=sp.plans_types_id');
        $objectDB->leftJoin('service_types   AS st', 'st.id=sp.service_types_id');
        $objectDB->leftJoin('vehicle_types   AS vt', 'vt.id=sp.vehicle_types_id');
        $objectDB->leftJoin('vehicle_categories   AS vc', 'vc.id=sp.vehicle_categories_id');

        if (isset($ServiceID) && !empty($ServiceID)) {
            $objectDB->where('sp.id=:id', array(':id' => $ServiceID));
        }
        $objectDB->order('st.id, pt.id, vt.id ASC');
        $arrPackage = $objectDB->queryAll();
        return $arrPackage;
    }

    // Dropw Down 
    public static function getVehicleType() {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('id, name');
        $objectDB->from('vehicle_types');
        $objectDB->order('id asc');
        $arrVehicleType = $objectDB->queryAll();
        return $arrVehicleType;
    }

    public static function getServiceType() {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('id, name');
        $objectDB->from('service_types');
        $objectDB->order('id asc');
        $arrServiceType = $objectDB->queryAll();
        return $arrServiceType;
    }

    public static function getPlanType() {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('id, SUBSTRING_INDEX(NAME,"_",-1) AS name');
        $objectDB->from('plans_types');
        $objectDB->order('id asc');
        $arrPlanType = $objectDB->queryAll();
        return $arrPlanType;
    }

    public static function updateServicePackageAmount($arrInput) {
        $setValue = array('package_amount' => $arrInput['amount'],
            'last_modified' => $arrInput['created_date'],
            'ip_address' => $arrInput['ip_address']);

        $objectDB = Yii::app()->db->createCommand();
        $objectDB->update('service_plans', $setValue, 'id=:id', array('id' => $arrInput['service_id']));
    }
    public static function UpdateDelayOrders($arrInput, $strOrderNo){
        $objCommand = Yii::app()->db->createCommand();
        $intUpdate = $objCommand->update('orders', $arrInput, 'order_number=:order_number', array(':order_number' => $strOrderNo));
        return $intUpdate;
        
        
    }

}
