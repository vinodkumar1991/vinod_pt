<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class EnquiryForm extends CFormModel {

    public $enquiry_name;    
    public $enquiry_email;
    public $enquiry_phone;
    public $enquiry_content;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('enquiry_name, enquiry_email,enquiry_phone,enquiry_content', 'required'),
            array('enquiry_name','length','min'=>3,'max'=>55),
            array('enquiry_phone','length','min'=>10),            
            array('enquiry_phone', 'numerical', 'integerOnly'=>true),
            array('enquiry_email', 'email'),
            array('enquiry_email','length','max'=>55),
            array('enquiry_content','length','min'=>5),            
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'enquiry_name' => 'Name',
            'enquiry_email' => 'Email',
            'enquiry_phone' => 'Phone',
            'enquiry_content' => 'Message',
        );
    }
}
