<?php

class HireOrders extends CActiveRecord {

    public $strTable = 'hire_orders';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getOrders($arrInputs = array()) {
        $arrOrders = array();
        $objDB = Yii::app()->db->createCommand();
        $objDB->select('hoc.location,round(hoc.hr_price,2) as order_hr_price,c.first_name,ce.email,cp.phone,h.first_name as hire_name,hamp.phone as hire_phone,hame.email as hire_email,ho.order_number');
        $objDB->from('hire_orders as ho');
        $objDB->join('hire_orders_communication as hoc', 'hoc.hire_orders_id = ho.id');
        $objDB->join('vehicle_types as vt', 'vt.id = ho.vehicle_types_id');
        $objDB->join('vehicle_categories as vc', 'vc.id = ho.vehicle_categories_id');
        $objDB->join('vehicle_brand_models as vbm', 'vbm.id = ho.vehicle_brand_models_id');
        $objDB->join('vehicle_brands as vb', 'vb.id = vbm.vehicle_brands_id');
        $objDB->join('hire_a_mechanic as h', 'h.id = ho.hire_a_mechanic_id');
        $objDB->join('customer as c', 'c.id = ho.customer_id');
        $objDB->join('customer_email as ce', 'ce.customer_id = c.id');
        $objDB->join('customer_phone as cp', 'cp.customer_id = c.id');
        $objDB->join('hire_a_mechanic_email as hame', 'hame.hire_a_mechanic_id = h.id');
        $objDB->join('hire_a_mechanic_phone as hamp', 'hamp.hire_a_mechanic_id = h.id');
        $arrOrders = $objDB->queryAll();
        return $arrOrders;
    }

}
