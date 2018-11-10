<?php

/**
 * @author Digital Today
 * @access public
 * @ignore It will handle Sector activities
 */
class AsapBookings extends CActiveRecord
{

    private $strTable = 'asap_bookings';

    public function tableName()
    {
        return $this->strTable;
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function asapOrders($arrInputs = array())
    {
        $arrOrders = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ab.id as order_id,ab.order_number,ab.order_status,ab.customer_name,ab.customer_phone,vb.name as brand_name,vbm.name as brand_model_name,st.name as vehicle_service_type,ROUND(ab.labour_amount, 2) as labour_amount,ROUND(ab.total_amount, 2) as total_amount,date_format(ab.booked_date,"%D %b %Y") as order_booked_date,date_format(ab.booked_start_slot,"%l:%i %p") as order_start_time,date_format(ab.booked_end_slot,"%l:%i %p") as order_end_time,ab.year_of_manfacture,ab.fuel_type,ab.customer_area,date_format(ab.created_date,"%D %b %Y %l:%i %p") as customer_booked_date_time');
        $objectDB->from('asap_bookings as ab');
        $objectDB->join('vehicle_brands as vb', 'vb.id = ab.make_id');
        $objectDB->join('vehicle_brand_models as vbm', 'vbm.id = ab.model_id');
        $objectDB->join('service_types as st', 'st.id = ab.vehicle_service_type_id');
        $objectDB->order('ab.id desc');
        $arrOrders = $objectDB->queryAll();
        return $arrOrders;
    }
}
