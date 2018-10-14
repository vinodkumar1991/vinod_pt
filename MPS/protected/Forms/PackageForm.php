<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class PackageForm extends CFormModel {

    public $vehicle_types;
    public $vehicle_categories;
    public $service_type_id;
    public $plan_id;
    public $amount;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('vehicle_types,vehicle_categories,service_type_id,plan_id,amount', 'required', 'message' => '{attribute} is required.'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'vehicle_types' => 'Vehicle Type',
            'vehicle_categories' => 'Vehicle Category',
            'service_type_id' => 'Service Type',
            'plan_id' => 'Plan',
            'amount' => 'Amount',
        );
    }

}
