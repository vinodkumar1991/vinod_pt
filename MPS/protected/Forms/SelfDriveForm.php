<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class SelfDriveForm extends CFormModel {

    public $agency_name;
    public $saddress;
    public $scountry;
    public $sstate;
    public $scity;
    public $semail;
    public $sarea;
    public $contact_no;
    public $userfile;
    /*   
   
  
   
    public $userfile;
    public $szipcode;
    public $zipcode;
    public $susername;
    public $spassword;*/
    

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            //array('agency_name, saddress,scountry,sstate,scity,semail,sarea,contact_no,userfile,szipcode,susername,spassword', 'required')
            array('agency_name,saddress,scountry,sstate,scity,semail,sarea,contact_no,userfile', 'required')
            /*array('agency_name, semail,contact_no,spassword', 'filter', 'filter' => 'trim'),
            array('agency_name', 'length', 'min' => 3, 'max' => 45),
            array('saddress', 'length', 'min' => 5, 'max' => 45),
            array('semail', 'email'),
           // array('semail', 'isUsernameExist'),
           // array('contact_no', ''),
            array('semail', 'length', 'max' => 55),
            array('spassword', 'length', 'min' => 5, 'max' => 50),*/
        );
    }

    /**
     * @author Ctel
     * @param array $attribute
     * @param array $params
     * @return boolean It will return either TRUE or FALSE
     */
    public function isUsernameExist($attribute, $params) {
        if (!empty($this->user)) {
            $arrCustomer = Agent::model()->getCustomer($this->user);
            if (!empty($arrCustomer)) {
                $this->addError('username', $this->user . Yii::t('app', 'customer.form.exist'));
                return FALSE;
            } else {
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
    public function isMobileExist($attribute, $params) {
        if (!empty($this->mobile)) {
            $arrCustomer = CustomerPhone::model()->getPhoneDetails($this->mobile);
            if (!empty($arrCustomer)) {
                $this->addError('mobile', $this->mobile . Yii::t('app', 'customer.form.exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'first_name' => Yii::t('app', 'agent.form.name'),
            'username' => Yii::t('app', 'agent.form.username'),
            'mobile' => Yii::t('app', 'agent.form.mobile'),
            'password' => Yii::t('app', 'agent.form.password'),
        );
    }
    
    

}
