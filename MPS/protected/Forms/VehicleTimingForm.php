<?php

class VehicleTimingForm extends CFormModel {

    public $vehicle_start_date;
    public $vehicle_end_date;

    public function rules() {
        return array(
            array('vehicle_start_date,vehicle_end_date', 'required', 'message' => '{attribute} is required.'),
        );
    }

    public function attributeLabels() {
        return array(
            'vehicle_start_date' => 'Start Date',
            'vehicle_end_date' => 'End Date',
        );
    }

}
