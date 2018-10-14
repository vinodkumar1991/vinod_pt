<?php

class SelfdriveBookings extends CActiveRecord {

    public $strTable = 'self_drive_orders';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getOrders($arrInputs = array()) {
        $arrOrders = array();
        $objDB = Yii::app()->db->createCommand();
        $objDB->select('sdo.order_number,'
                . 'pm.name as payment_mode_name,'
                . 'sdo.payment_modes_id,'
                . 'round(sdob.basic) as basic_amount,'
                . 'round(sdob.final) as final_amount,'
                . 'round(sdob.tax_amount) as tax_amount,'
                . 'round(sdob.security_deposit) as security_deposit,'
                . 'DATE_FORMAT(sdoc.start_date,"%d %b %y") as start_date,'
                . 'TIME_FORMAT(sdoc.start_time, "%r") as start_time,'
                . 'DATE_FORMAT(sdoc.end_date,"%d %b %y") as end_date,'
                . 'TIME_FORMAT(sdoc.end_time, "%r") as end_time,'
                . 'sdoc.email as order_email,'
                . 'sdoc.phone as order_phone,'
                . 'sdoc.pickup_location as order_pickup_location,'
                . 'sdoc.drop_location as order_drop_location,'
                . 'sdoc.location as order_location,'
                . 'c.first_name as customer_name,'
                . 'vt.id as vehicle_id,'
                . 'vt.name as vehicle_name,'
                . 'vb.name as vehicle_brand_name,'
                . 'vb.id as vehicle_brand_id,'
                . 'vbm.name as vehicle_brand_model_name,'
                . 'vbm.id as vehicle_brand_model_id,'
                . 'round(sdoc.pickup_amount,2) as order_pickup_amount,'
                . 'round(sdoc.door_step_amount,2) as order_door_step_amount'
        );
        $objDB->from('self_drive_orders as sdo');
        $objDB->join('self_drive_orders_billing as sdob', 'sdob.self_drive_orders_id = sdo.id');
        $objDB->join('self_drive_orders_communication as sdoc', 'sdoc.self_drive_orders_id = sdo.id');
        $objDB->join('vehicle_types as vt', 'vt.id = sdo.vehicle_types_id');
        $objDB->join('vehicle_variants as vv', 'vv.id = sdo.vehicle_variants_id');
        $objDB->join('vehicle_classes as vc', 'vc.id = sdo.vehicle_classes_id');
        $objDB->join('vehicle_brand_models as vbm', 'vbm.id = sdo.vehicle_brand_models_id');
        $objDB->join('vehicle_brands as vb', 'vb.id = vbm.vehicle_brands_id');
        $objDB->join('self_vehicles as sv', 'sv.id = sdo.self_vehicles_id');
        $objDB->join('agents as a', 'a.id = sv.agents_id');
        $objDB->join('customer as c', 'c.id = sdo.customer_id');
        $objDB->join('payment_modes as pm', 'pm.id = sdo.payment_modes_id');
        if (isset($arrInputs['agent_user_id']) && !empty($arrInputs['agent_user_id'])) {
            $objDB->where('a.users_id=:agentUserId', array(':agentUserId' => $arrInputs['agent_user_id']));
        }
        $arrOrders = $objDB->queryAll();
        return $arrOrders;
    }

}
