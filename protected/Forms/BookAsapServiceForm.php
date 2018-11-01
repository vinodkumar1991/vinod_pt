<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class BookAsapServiceForm extends CFormModel
{

    public $customer_name;

    public $customer_mobile;

    public $make_id;

    public $model_id;

    public $vehicle_service_id;

    public $booking_date;

    public $booking_time_slot;

    public $customer_location;

    public $customer_latitude;

    public $customer_longitude;

    public $total_estimated_cost;

    /**
     *
     * @author Ctel
     * @return array It will return array of errors if not satisfied the criteria
     */
    public function rules()
    {
        return array(
            array(
                'customer_name,customer_mobile,make_id,model_id,vehicle_service_id,booking_date,booking_time_slot,customer_location,customer_latitude,customer_longitude,total_estimated_cost',
                'required',
                'message' => '{attribute} is required'
            ),
            // Customer Name
            array(
                'customer_name',
                'match',
                'pattern' => '/^[A-Za-z \']+$/u',
                'message' => 'Name allows only alpha charactes'
            ),
            array(
                'customer_name',
                'length',
                'min' => 3,
                'max' => 100
            ),
            // Customer Mobile
            array(
                'customer_mobile',
                'match',
                'pattern' => '/^[0-9]+$/u',
                'message' => 'Mobile allows only numerics'
            ),
            array(
                'customer_mobile',
                'length',
                'min' => 10,
                'max' => 10
            ),
            // Booking Date
            array(
                'booking_date',
                'type',
                'type' => 'date',
                'message' => '{attribute} is not a date',
                'dateFormat' => 'yyyy-mm-dd'
            )
            // Booking Time Slot
            // Customer Google Address
            // Google Latitude
            // Google Longitude
        );
    }

    /**
     *
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels()
    {
        return array(
            'customer_name' => 'Name',
            'customer_mobile' => 'Mobile',
            'make_id' => 'Make',
            'model_id' => 'Model',
            'vehicle_service_id' => 'Vehicle Service Type',
            'booking_date' => 'Service Booking Date',
            'booking_time_slot' => 'Service Booking Time Slot',
            'customer_location' => 'Customer Address',
            'customer_latitude' => 'Google Latitude',
            'customer_longitude' => 'Google Longitude'
        );
    }
}
