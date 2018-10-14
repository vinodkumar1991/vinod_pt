<?php

class SelfDriveOrders extends CActiveRecord {

    public $strTable = 'self_drive_orders';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrOrder
     * @return integer It will return an integer response
     */
    public static function create($arrOrder) {
        $intSelfOrderId = NULL;
        $objSelfDriveOrder = new SelfDriveOrders();
        $objSelfDriveOrder->customer_id = $arrOrder['customer_id'];
        $objSelfDriveOrder->self_vehicles_id = $arrOrder['self_vehicles_id'];
        $objSelfDriveOrder->vehicle_types_id = $arrOrder['vehicle_types_id'];
        $objSelfDriveOrder->vehicle_classes_id = $arrOrder['vehicle_classes_id'];
        $objSelfDriveOrder->vehicle_brand_models_id = $arrOrder['vehicle_brand_models_id'];
        $objSelfDriveOrder->order_number = $arrOrder['order_number'];
        $objSelfDriveOrder->order_status = $arrOrder['order_status'];
        $objSelfDriveOrder->status = $arrOrder['status'];
        $objSelfDriveOrder->created_date = $arrOrder['created_date'];
        $objSelfDriveOrder->created_by = $arrOrder['created_by'];
        $objSelfDriveOrder->ip_address = $arrOrder['ip_address'];
        $objSelfDriveOrder->device_id = $arrOrder['device_id'];
        $objSelfDriveOrder->payment_modes_id = $arrOrder['payment_mode_id'];
        $objSelfDriveOrder->vehicle_variants_id = $arrOrder['vehicle_variants_id'];
        if ($objSelfDriveOrder->save()) {
            $intSelfOrderId = $objSelfDriveOrder->id;
        }
        return $intSelfOrderId;
    }

    public function selfOrders($arrInputs = array()) {
        $arrOrders = array();
        $objDB = Yii::app()->db->createCommand();
        $objDB->select('sdo.order_number,pm.name as payment_mode_name,'
                . 'pm.id as payment_mode_id,'
                . 'sdo.id as self_order_id,'
                . 'sdo.order_status,'
                . 'vt.name as vehicle_type,'
                . 'vt.id as vehicle_id,'
                . 'sv.vehicle_registration_number,'
                . 'vb.id as vehicle_brand_id,'
                . 'vb.name as vehicle_brand_name,'
                . 'vbm.id as vehicle_brand_id,'
                . 'vbm.name as vehicle_model_name,'
                . 'vv.id as vehicle_variant_id,'
                . 'vv.name as vehicle_variant_name,
                    (CASE WHEN sdo.status = "1" THEN "CONFIRMED"
                           WHEN sdo.status = "0" THEN "NOT CONFIRMED"
                           ELSE "CONFIRMED" END) AS self_order_status,
                           (CASE WHEN sdo.order_status = "1" THEN "NEW"
                           WHEN sdo.order_status = "10" THEN "FINISHED"
                           ELSE "NEW" END) AS order_status,
                           vcs.name as vehicle_calsses_name,
                           vcs.id as vehicle_classes_id,
                           svi.image_name as self_vehicle_image,
                           (CASE WHEN (svi.is_parent = 1 and sv.vehicle_types_id = 1) THEN "/selfdrive/cars/mobile/280X162/" ELSE "/selfdrive/cars/mobile/450X260/" END) AS vehicle_car_parent_image_path,
                           (CASE WHEN (svi.is_parent = 1 and sv.vehicle_types_id = 2) THEN "/selfdrive/bikes/mobile/280X162/" ELSE "/selfdrive/bikes/mobile/450X260/" END) AS vehicle_bike_parent_image_path'
        );
        $objDB->from('self_drive_orders as sdo');
        $objDB->join('self_drive_orders_communication as sdoc', 'sdoc.self_drive_orders_id = sdo.id');
        $objDB->join('self_drive_orders_billing as sdob', 'sdob.self_drive_orders_id = sdo.id');
        $objDB->join('vehicle_types as vt', 'vt.id = sdo.vehicle_types_id');
        $objDB->join('payment_modes as pm', 'pm.id = sdo.payment_modes_id');
        $objDB->join('self_vehicles as sv', 'sv.id = sdo.self_vehicles_id');
        $objDB->join('self_vehicles_images as svi', 'svi.self_vehicles_id = sv.id and svi.is_parent = "1" and svi.status = "1"');
        $objDB->join('vehicle_brand_models as vbm', 'vbm.id = sdo.vehicle_brand_models_id');
        $objDB->join('vehicle_brands as vb', 'vb.id = vbm.vehicle_brands_id');
        $objDB->join('vehicle_variants as vv', 'vv.id = sdo.vehicle_variants_id');
        $objDB->join('vehicle_classes as vcs', 'vcs.id = sdo.vehicle_classes_id');
        if (isset($arrInputs['customer_id']) && !empty($arrInputs['customer_id'])) {
            $objDB->where('sdo.customer_id=:customerId', array(':customerId' => $arrInputs['customer_id']));
        }
        if (isset($arrInputs['order_number']) && !empty($arrInputs['order_number'])) {
            $objDB->where('sdo.order_number=:orderNumber', array(':orderNumber' => $arrInputs['order_number']));
        }
        $objDB->order('sdo.id desc');
        $arrOrders = $objDB->queryAll();
        return $arrOrders;
    }

    public static function updateSelfOrder($intOrder, $arrSelfOrder) {
        $objCommand = Yii::app()->db->createCommand();
        $intUpdate = $objCommand->update('self_drive_orders', $arrSelfOrder, 'id=:orderId', array(':orderId' => $intOrder));
        return $intUpdate;
    }
    
      public function getOrderNumber($intVehicle){
        $arrOrderNumberDetails = array();
        try {
           $strQuery = 'select order_number,id from self_drive_orders where vehicle_types_id = "'.$intVehicle.'"  order by id desc limit 1';
           $arrOrderNumberDetails = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $ex) {
            $arrOrderNumberDetails = $ex->getMessage();
        }
       
        return $arrOrderNumberDetails;
    }

}
