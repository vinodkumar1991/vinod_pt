<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class PaymentForm extends CFormModel {

    public $first_name;
    public $email;
    public $phone;
    public $order_city;
    public $order_pincode;
    public $customer_address;
    public $order_address2;
    public $terms_conditions;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('first_name, email,phone,order_city,order_pincode,customer_address,order_address2', 'required', 'message' => Yii::t('common', '{attribute} is required')),
            array('terms_conditions', 'isAcceptedTC'),
        );
    }

    public function isAcceptedTC() {
        if (!empty($this->terms_conditions) && 1 == $this->terms_conditions) {
            return true;
        } else {
            $this->addError('terms_conditions', 'Terms And Conditions Is Required.');
        }
    }

    public function attributeLabels() {
        return array(
            'first_name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'order_city' => 'City',
            'order_pincode' => 'Pincode',
            'customer_address' => 'Address',
            'order_address2' => 'Landmark',
            'terms_conditions' => 'Terms And Conditions'
        );
    }

}
