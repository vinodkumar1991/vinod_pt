<?php

class PasswordForm extends CFormModel {

    public $update_otp;
    public $update_new_password;
    public $update_confirm_password;

    public function rules() {
        return array(
            array('update_otp,update_new_password,update_confirm_password', 'required', 'message' => '{attribute} is required.'),
            array('update_confirm_password', 'safe'),
             array('update_new_password, update_confirm_password', 'numerical', 'integerOnly'=>true),
            array('update_new_password, update_confirm_password', 'length', 'min' => 4, 'max' => 4),
            array('update_confirm_password', 'compare', 'compareAttribute' => 'update_new_password', 'message' => '{attribute} is does not match.'),
            array('update_otp', 'validateOTP'),
        );
    }

    public function validateOTP() {
        if ($this->update_otp) {
            $arrCustomer = Customer::model()->isPwdOTPExist($this->update_otp);
            if (empty($arrCustomer)) {
                $this->addError('update_otp', 'Invalid OTP is given.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function attributeLabels() {
        return array(
            'update_otp' => 'OTP',
            'update_new_password' => 'New Pin',
            'update_confirm_password' => 'Confirm Pin'
        );
    }

}
