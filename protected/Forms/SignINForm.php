<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class SignINForm extends CFormModel {

    public $username;
    public $password;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('username,password', 'required', 'message' => '{attribute} is required.'),
            array('username', 'filter', 'filter' => 'trim'),
            array('username', 'email'),
            array('username', 'isUsernameExist'),
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
            if (empty($arrCustomer)) {
                $this->addError('username', Yii::t('app', 'common.ctrl.notExist', array('{alias}' => $this->username)));
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
            'password' => Yii::t('app', 'customer.form.password')
        );
    }

}
