<?php

class HireOrders extends CActiveRecord {

    public $strTable = 'hire_orders';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrHireOrder
     * @return integer It will return an customer phone id
     * @ignore Need to change and also add foreign key to phone type table
     */
    public static function create($arrHireOrder) {
        $intHire = NULL;
        $objHireOrders = new HireOrders();
        $objHireOrders->customer_id = $arrHireOrder['customer_id'];
        $objHireOrders->hire_a_mechanic_id = $arrHireOrder['hire_id'];
        $objHireOrders->vehicle_types_id = $arrHireOrder['vehicle_id'];
        $objHireOrders->vehicle_categories_id = $arrHireOrder['vehicle_categories_id'];
        $objHireOrders->vehicle_brand_models_id = $arrHireOrder['vehicle_brand_models_id'];
        $objHireOrders->order_number = $arrHireOrder['order_number'];
        $objHireOrders->status = $arrHireOrder['status'];
        $objHireOrders->sms_confirm_token = $arrHireOrder['sms_confirm_token'];
        $objHireOrders->created_date = $arrHireOrder['created_date'];
        $objHireOrders->created_by = $arrHireOrder['created_by'];
        $objHireOrders->ip_address = $arrHireOrder['ip_address'];
        $objHireOrders->device_id = $arrHireOrder['device_id'];
        if ($objHireOrders->save()) {
            $intHire = $objHireOrders->id;
        }
        return $intHire;
    }

    public function hireOrdersList($arrInputs = array()) {
        $arrOrders = array();
        $objDB = Yii::app()->db->createCommand();
        $objDB->select('ho.order_number,vt.id as vehicle_id,vt.name as vehicle_name,round(hoc.hr_price,2) as hire_hour_price,'
                . 'ham.first_name as hire_name,'
                . 'ham.code as hire_code,'
                . 'vbm.name as vehicle_model_name,'
                . 'vbm.id as vehicle_model_id,'
                . 'vb.id as vehicle_brand_id,'
                . 'vb.name as vehicle_brand_name,
                    hmc.image_name as hire_image,
                    (CASE WHEN ham.id > 0 THEN "/hireamechanic/photo/450X260/" ELSE "/hireamechanic/photo/280X162/" END) AS hire_image_path,
                    (CASE WHEN ho.order_status = "1" THEN "NEW"
                           WHEN ho.order_status = "10" THEN "FINISHED"
                           ELSE "NEW" END) AS order_status,
                           (CASE WHEN ho.status = "1" THEN "CONFIRMED"
                           WHEN ho.status = "0" THEN "NOT CONFIRMED"
                           ELSE "CONFIRMED" END) AS hire_order_status'
        );
        $objDB->from('hire_orders as ho');
        $objDB->join('hire_orders_communication as hoc', 'hoc.hire_orders_id = ho.id');
        $objDB->join('hire_a_mechanic as ham', 'ham.id = ho.hire_a_mechanic_id');
        $objDB->join('hire_a_mechanic_communication as hmc', 'hmc.hire_a_mechanic_id = ham.id');
        $objDB->join('vehicle_types as vt', 'vt.id = ho.vehicle_types_id');
        $objDB->join('vehicle_brand_models as vbm', 'vbm.id = ho.vehicle_brand_models_id');
        $objDB->join('vehicle_brands as vb', 'vb.id = vbm.vehicle_brands_id');
        $objDB->join('vehicle_categories as vc', 'vc.id = ho.vehicle_categories_id');
        //Customer Id
        if (isset($arrInputs['customer_id']) && !empty($arrInputs['customer_id'])) {
            $objDB->where('ho.customer_id=:customerId', array(':customerId' => $arrInputs['customer_id']));
        }
        //Order Number
        if (isset($arrInputs['order_number']) && !empty($arrInputs['order_number'])) {
            $objDB->where('ho.order_number=:orderNumber', array(':orderNumber' => $arrInputs['order_number']));
        }
        $objDB->order('ho.id desc');
        $arrOrders = $objDB->queryAll();
        return $arrOrders;
    }
    
     public function getOrderNumber($intVehicle){
        $arrOrderNumberDetails = array();
        try {
           $strQuery = 'select order_number,id from hire_orders where vehicle_types_id = "'.$intVehicle.'"  order by id desc limit 1';
           $arrOrderNumberDetails = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $ex) {
            $arrOrderNumberDetails = $ex->getMessage();
        }
       
        return $arrOrderNumberDetails;
    }

}
