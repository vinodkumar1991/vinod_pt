<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class VerificationForm extends CFormModel {

    public $mobile;
    public $otp;
    public $customerId;
    public $first_name;
    public $smsToken;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('otp', 'required'),
            array('mobile,customerId,first_name,smsToken', 'safe'),
            array('otp', 'filter', 'filter' => 'trim'),
            array('otp', 'length', 'min' => 6, 'max' => 7),
            array('otp', 'isOTPExist'),
        );
    }

    /**
     * @author Ctel
     * @param array $attribute
     * @param array $params
     * @return boolean It will return either TRUE or FALSE
     */
    public function isOTPExist($attribute, $params) {
        if (!empty($this->otp)) {
            $arrCustomer = Customer::model()->isOTPExist($this->otp, $this->customerId);
            if (empty($arrCustomer)) {
                $this->addError('otp', $this->otp . ' - ' . Yii::t('app', 'verify.form.invalid'));
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
            'otp' => Yii::t('app', 'verify.form.otp'),
        );
    }

}
