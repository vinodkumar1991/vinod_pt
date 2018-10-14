<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class Mob_SignInForm extends CFormModel {

    public $username;
    public $password;
    public $gcm_register_id;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('username,password', 'required'),
            array('username', 'filter', 'filter' => 'trim'),
            array('username', 'length', 'min' => 5, 'max' => 55),
            array('username', 'isUsernameExist'),
            array('password', 'length', 'min' => 4, 'max' => 50),
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
            $arrCustomer = Customer::model()->isUsernameExist($this->username);
            if (!empty($arrCustomer)) {
                return TRUE;
            } else {
                $this->addError('username', Yii::t('app', 'common.ctrl.notExist', array('{alias}' => $this->username)));
                return FALSE;
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
        );
    }

}
