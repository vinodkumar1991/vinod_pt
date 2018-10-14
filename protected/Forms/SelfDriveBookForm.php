<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations of Self Drive Booking confirmation
 */
class SelfDriveBookForm extends CFormModel {

    public $self_order_name;
    public $self_order_email;
    public $self_order_phone;
    public $self_order_city;
    public $self_order_pincode;
    public $self_order_address1;
    public $self_order_address2 ;
    public $radioInline;
    public $checkboxa1;
   public $payment_mode_id;

    /**
     * @author Ctel
     * @return array It will return array of errors if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('radioInline,checkboxa1,payment_mode_id,self_order_name,self_order_email,self_order_phone,self_order_city,self_order_pincode,self_order_address1,self_order_address2', 'required'),
            array('self_order_pincode', 'numerical', 'integerOnly'=>true),
            array('self_order_pincode', 'length', 'min' => 6, 'max' => 6),
             array('self_order_address1', 'length', 'max' => 150),
            array('self_order_address2', 'length', 'max' => 150),
            
        );
    }
    
       public function attributeLabels() {
        return array(
            'self_order_name' => 'Name',
            'self_order_email' => 'Email',
            'self_order_phone' => 'Phone',
            'self_order_city' => 'City',
            'self_order_pincode' => 'Pincode ',
            'self_order_address1' => 'Address',
            'self_order_address2' => 'Landmark',
            'radioInline' => 'Gender',
            'checkboxa1' => 'Please agree the term and conditions',
            'payment_mode_id' =>'Payment',
        );
    }


  

 

}
