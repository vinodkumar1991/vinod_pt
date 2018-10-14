<?php

/*
 *
 * @author Ctel
 * @ignore It will handle the form validations
 */

class WeekForm extends CFormModel {

    public $kms_per_hr;
    public $price_per_hr;
    public $extra_rate_per_km;
    public $security_deposit;
    public $add_self_vehicle_price;
    public $pickup_amount;
    public $drop_amount;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('kms_per_hr,price_per_hr,extra_rate_per_km,security_deposit,pickup_amount,drop_amount', 'required', 'message' => '{attribute} is required.'),
            array('add_self_vehicle_price', 'safe'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'kms_per_hr' => 'Kms per Hour',
            'price_per_hr' => 'Price Per Hour',
            'extra_rate_per_km' => 'Extra Rate Per Kms ',
            'security_deposit' => 'Security Deposit',
        );
    }

}
