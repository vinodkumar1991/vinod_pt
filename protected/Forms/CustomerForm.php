<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class CustomerForm extends CFormModel {

    public $first_name;
    public $username;
    public $mobile;
    public $password;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('first_name, username,mobile,password', 'required', 'message' => '{attribute} is required.'),
            array('first_name, username,mobile,password', 'filter', 'filter' => 'trim'),
            array('first_name', 'length', 'min' => 3, 'max' => 45),
            array('username', 'email'),
            array('username', 'isUsernameExist'),
            array('mobile', 'isMobileExist'),
            array('mobile', 'length', 'min' => 10),
            array('username', 'length', 'max' => 55),
            array('password', 'numerical', 'integerOnly'=>true),
            array('password', 'length', 'min' => 4, 'max' => 4),
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
            'first_name' => Yii::t('app', 'customer.form.name'),
            'username' => Yii::t('app', 'customer.form.username'),
            'mobile' => Yii::t('app', 'customer.form.mobile'),
            'password' => Yii::t('app', 'customer.form.password'),
        );
    }

}
