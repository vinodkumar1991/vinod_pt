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

    // public $customer_location;

    // public $customer_latitude;

    // public $customer_longitude;
    public $total_estimated_cost;

    public $vehicle_manfacture_year;

    public $vehicle_fuel_type;

    public $customer_area;

    /**
     *
     * @author Ctel
     * @return array It will return array of errors if not satisfied the criteria
     */
    public function rules()
    {
        // customer_location,customer_latitude,customer_longitude,
        return array(
            array(
                'customer_name,customer_mobile,make_id,model_id,vehicle_service_id,booking_date,booking_time_slot,total_estimated_cost,vehicle_manfacture_year,vehicle_fuel_type,customer_area',
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
            ),
            // Vehicle Manfacture Year
            array(
                'vehicle_manfacture_year',
                'match',
                'pattern' => '/^[0-9]+$/u',
                'message' => 'Vehicle manfacture year allows only numerics'
            ),
            array(
                'vehicle_manfacture_year',
                'length',
                'min' => 4,
                'max' => 4
            ),
            // Customer Area
            array(
                'customer_area',
                'match',
                'pattern' => '/^[A-Za-z0-9 \']+$/u',
                'message' => 'Customer area allows only alphabets and numerics'
            ),
            array(
                'customer_area',
                'length',
                'min' => 2,
                'max' => 55
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
            'customer_longitude' => 'Google Longitude',
            // 'vehicle_manfacture_year' => 'Vehicle Manfacture Year',
            'vehicle_fuel_type' => 'Vehicle Fuel Type',
            'customer_area' => 'Customer Area'
        );
    }
}
