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
            array('username,password', 'required'),
            array('username', 'filter', 'filter' => 'trim'),
            array('username', 'email'),
           
        );
    }

    /**
     * @author Ctel
     * @param array $attribute
     * @param array $params
     * @return boolean It will return either TRUE or FALSE
     */
    /*public function isUsernameExist($attribute, $params) {
        if (!empty($this->username)) {
            $arrCustomer = Users::model()->getCustomer($this->username);
            if (empty($arrCustomer)) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }*/

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password')
        );
    }

}
