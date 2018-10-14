<?php

class HireExperienceForm extends CFormModel {

    public $hire_vehicle_category;
    public $hire_vehicle_brand;
    public $hire_vehicle_model;
    public $hire_years;
    public $hire_months;
    public $hire_per_hr_price;

    public function rules() {
        return array(
            array('hire_vehicle_category,hire_vehicle_brand,hire_vehicle_model,hire_years,hire_months,hire_per_hr_price', 'required', 'message' => '{attribute} is required.'),
        );
    }

    public function attributeLabels() {
        return array(
            'hire_vehicle_category' => 'Vehicle Category',
            'hire_vehicle_brand' => 'Vehicle Brand',
            'hire_vehicle_model' => 'Vehicle Model',
            'hire_years' => 'Years',
            'hire_months' => 'Months',
            'hire_per_hr_price' => 'Price Per Hour',
        );
    }

}
