<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class Mob_CustomerForm extends CFormModel {

    public $username;
    public $password;
    public $confirm_password;
    public $email;
    public $verify_token;
    public $phone;
    public $device_name;
    public $imei_no;
    public $gcm_register_id;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('username,password,confirm_password,email,phone', 'required'),
            array('username,email,verify_token,phone', 'filter', 'filter' => 'trim'),
            array('verify_token,device_name,imei_no', 'safe'),
            array('username', 'length', 'min' => 5, 'max' => 55),
            array('username', 'isUsernameExist'),
            array('password', 'length', 'min' => 4, 'max' => 50),
            array('confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', 'customer.form.do_not_match')),
            array('phone', 'isMobileExist'),
            array('email', 'isEmailExist'),
            array('gcm_register_id', 'safe'),
        );
    }

    /**
     * @author Ctel
     * @param array $attribute
     * @param array $params
     * @return boolean It will return either TRUE or FALSE
     */
    public function isUsernameExist($attribute, $params) {
        if (!empty($this->username)) {
            $arrCustomer = Customer::model()->getCustomer($this->username);
            if (!empty($arrCustomer)) {
                $this->addError('username', $this->username . Yii::t('app', 'customer.form.exist'));
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
    public function isEmailExist($attribute, $params) {
        if (!empty($this->email)) {
            $arrCustomer = CustomerEmail::model()->getEmailDetails($this->email);
            if (!empty($arrCustomer)) {
                $this->addError('email', $this->email . Yii::t('app', 'customer.form.exist'));
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
        if (!empty($this->phone)) {
            $arrCustomer = CustomerPhone::model()->getPhoneDetails($this->phone);
            if (!empty($arrCustomer)) {
                $this->addError('phone', $this->phone . Yii::t('app', 'customer.form.exist'));
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
            'username' => Yii::t('app', 'customer.form.username'),
            'password' => Yii::t('app', 'customer.form.password'),
            'confirm_password' => Yii::t('app', 'customer.form.confirm_password'),
            'email' => Yii::t('app', 'customer.form.email'),
            'verify_token' => Yii::t('app', 'customer.form.verify_token'),
            'phone' => Yii::t('app', 'customer.form.mobile'),
            'device_name' => Yii::t('app', 'customer.form.device_name'),
            'imei_no' => Yii::t('app', 'customer.form.imei_no'),
        );
    }

}
