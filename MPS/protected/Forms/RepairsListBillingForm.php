<?php

/**
 * @author Digital Today
 * @ignore It will handle the form validations
 */
class RepairsListBillingForm extends CFormModel {

    public $repairs_id;
    public $repairs_lists_id;
    public $vehicle_id;
    public $vehicle_category_id;
    public $service_type_id;
    public $is_recommended = 0; //optional
    public $plan_id; //optional
    public $cost;
    public $status;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('repairs_id,repairs_lists_id,vehicle_id,vehicle_category_id,service_type_id,cost,status', 'required'),
            array('plan_id,is_recommended', 'safe'),
        );
    }

    public function attributeLabels() {
        return array(
            'repairs_id' => 'Repair',
            'repairs_lists_id' => 'Repair List',
            'vehicle_id' => 'Vehicle Type',
            'vehicle_category_id' => 'Vehicle Category',
            'service_type_id' => 'Service Type',
            'plan_id' => 'Plan',
            'is_recommended' => 'Recommended',
            'cost' => 'Cost',
            'status' => 'Status',
        );
    }

}
