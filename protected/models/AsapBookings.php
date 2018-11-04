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

    /**
     *
     * @author Digital Today
     * @param array $arrBookingInputs
     * @return integer It will return sector item id
     */
    public static function create($arrBookingInputs)
    {
        $strBookingId = NULL;
        try {
            $objBooking = new AsapBookings();
            $objBooking->order_number = $arrBookingInputs['order_number'];
            $objBooking->order_status = $arrBookingInputs['order_status'];
            $objBooking->customer_name = $arrBookingInputs['customer_name'];
            $objBooking->customer_phone = $arrBookingInputs['customer_mobile'];
            $objBooking->make_id = $arrBookingInputs['make_id'];
            $objBooking->model_id = $arrBookingInputs['model_id'];
            $objBooking->vehicle_service_type_id = $arrBookingInputs['vehicle_service_id'];
            $objBooking->labour_amount = $arrBookingInputs['total_estimated_cost'];
            $objBooking->total_amount = $arrBookingInputs['total_amount'];
            $objBooking->booked_date = $arrBookingInputs['booking_date'];
            $objBooking->booked_start_slot = $arrBookingInputs['booked_start_slot'];
            $objBooking->booked_end_slot = $arrBookingInputs['booked_end_slot'];
            $objBooking->year_of_manfacture = $arrBookingInputs['vehicle_manfacture_year'];
            $objBooking->fuel_type = $arrBookingInputs['vehicle_fuel_type'];
            $objBooking->customer_area = $arrBookingInputs['customer_area'];
            $objBooking->created_date = $arrBookingInputs['created_date'];
            if ($objBooking->save()) {
                $strBookingId = $objBooking->order_number;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $strBookingId;
    }

    public static function getNextOrderNumber($arrInputs = array())
    {
        $arrCities = array();
        try {
            $objDB = Yii::app()->db->createCommand();
            $objDB->select('ab.order_number');
            $objDB->from('asap_bookings as ab');
            $objDB->order(array(
                'ab.order_number desc'
            ));
            $objDB->limit(1);
            $arrCities = $objDB->queryRow();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $arrCities;
    }
}
