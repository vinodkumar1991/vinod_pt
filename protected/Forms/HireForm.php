<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class HireForm extends CFormModel {

    public $hire_location;
    public $hire_vehicle_id;
    public $hire_vehicle_brands;
    public $hire_vehicle_model;
    public $location;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('hire_location, hire_vehicle_id,hire_vehicle_brands,hire_vehicle_model', 'required'),
            array('location', 'safe'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'hire_location' => 'Location',
            'hire_vehicle_id' => 'Vehicle',
            'hire_vehicle_brands' => 'Vehicle Brand',
            'hire_vehicle_model' => 'Vehicle Model',
        );
    }

}
