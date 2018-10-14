<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class ForgotPasswordForm extends CFormModel {

    public $email_address;

    //public $password;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            //array('email_address,password', 'required'),
            array('email_address', 'required'),
            array('email_address', 'filter', 'filter' => 'trim'),
            array('email_address', 'email'),
            array('email_address', 'isUsernameExist'),
        );
    }

    /**
     * @author Ctel
     * @param array $attribute
     * @param array $params
     * @return boolean It will return either TRUE or FALSE
     */
    public function isUsernameExist($attribute, $params) {
        if (!empty($this->email_address)) {
            $arrCustomer = CustomerEmail::model()->getEmailDetails($this->email_address);
            if (empty($arrCustomer)) {
                 $this->addError('email_address', $this->email_address . Yii::t('app', 'customer.form.not_exist'));
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
            'email_address' => Yii::t('app', 'Email address'),
                //'password' => Yii::t('app', 'customer.form.password')
        );
    }

}
