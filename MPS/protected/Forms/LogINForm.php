<?php

class LogINForm extends CFormModel {

    public $username;
    public $password;

    public function rules() {
        return array(
            array('username,password', 'required', 'message' => '{attribute} is required.'),
            array('username', 'filter', 'filter' => 'trim'),
            array('username', 'isUsernameExist'),
        );
    }

    public function isUsernameExist($attribute, $params) {
        if (!empty($this->username)) {
            $arrCustomer = Users::model()->isUserNameExist($this->username);
            if (empty($arrCustomer)) {
                $this->addError('username', 'Username do not exist.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function attributeLabels() {
        return array(
            'username' => 'Username',
            'password' => 'Password',
        );
    }

}
