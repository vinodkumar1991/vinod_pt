<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class VendorForm extends CFormModel
{

    public $first_name;
    public $email;
    public $mobile;
    public $vendor_types_id;
    public $device_id;
    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() 
    {
        return array(
                        array('first_name, email,mobile,vendor_types_id', 'required'),
                        array('mobile','length','min'=>10),
                        array('mobile','numerical', 'integerOnly'=>true),
                        array('email', 'email'),
                        array('email', 'isEmailExist'),
                        array('mobile', 'isMobileExist'),                                       
                     );
    }
    /**
     * @author Ctel
     * @param array $attribute
     * @param array $params
     * @return boolean It will return either TRUE or FALSE
     */
    public function isEmailExist($attribute, $params)
    {
        if (!empty($this->email))
            {
                $arrCustomer = Vendor::model()->getEmail($this->email);
                if (!empty($arrCustomer)) 
                {
                    $this->addError('email', $this->email . ' is already exists. Try with another.');
                    return FALSE;
                }
                else 
                {
                    return TRUE;
                }
            }
    }

    /**
     * @author Ctel
     * @param array $attribute
     * @param array $params
     * @return boolean It will return either TRUE or FALSE
     */
    public function isMobileExist($attribute, $params)
    {
        if (!empty($this->mobile))
            {
                $arrCustomer = Vendor::model()->getMobileNo($this->mobile);
                if (!empty($arrCustomer)) 
                {
                    $this->addError('mobile', $this->mobile . ' is already exists. Try with another.');
                    return FALSE;
                } 
                else 
                {
                    return TRUE;
                }
            }
    }

  

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() 
    {
        return array(
                        'first_name' => 'Name',
                        'email' => 'Email',
                        'mobile' => 'Mobile',
                        'vendor_types_id' => 'Vendor ID', 
                    );
    }

}
