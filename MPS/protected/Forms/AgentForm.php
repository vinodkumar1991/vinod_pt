<?php

class AgentForm extends CFormModel {

    public $agent_name;
    public $agent_owner;
    public $agent_email;
    public $agent_phone;
    public $agent_address;
    public $agent_country;
    public $agent_state;
    public $agent_city;
    public $agent_area;
    public $agent_pincode;
    public $agent_id_proof;
    public $agent_photo;
    public $agent_address_proof;
    public $agent_username;
    public $agent_password;
    public $agent_confirm_password;
    public $agent_location;
    public $location;
    public $agent_registration_certificate;
    public $agent_landline;

    public function rules() {
        return array(
            array('agent_name,agent_owner,agent_email,agent_phone,agent_address,agent_country,agent_state,'
                . 'agent_city,agent_area,agent_pincode,agent_username,agent_password,agent_confirm_password,agent_location', 'required'),
            array('location,agent_landline', 'safe'),
            array('agent_email', 'email'),
            array('agent_email', 'isEmailExist'),
            array('agent_phone', 'isMobileExist'),
            array('agent_address_proof', 'isValidImage', 'parameter' => 'agent_address_proof'),
            array('agent_id_proof', 'isValidImage', 'parameter' => 'agent_id_proof'),
            array('agent_photo', 'isValidImage', 'parameter' => 'agent_photo'),
            array('agent_confirm_password', 'compare', 'compareAttribute' => 'agent_password', 'message' => "Passwords don't match"),
            array('agent_registration_certificate', 'isValidImage', 'parameter' => 'agent_registration_certificate'),
        );
    }

    public function attributeLabels() {
        return array(
            'agent_name' => 'Agency Name',
            'agent_email' => 'Email',
            'agent_phone' => 'Phone',
            'agent_address' => 'Address',
            'agent_country' => 'Country',
            'agent_state' => 'State',
            'agent_city' => 'City',
            'agent_area' => 'Area',
            'agent_pincode' => 'Pincode',
            'agent_id_proof' => 'ID Proof',
            'agent_photo' => 'Photo',
            'agent_address_proof' => 'Address Proof',
            'agent_username' => 'Username',
            'agent_password' => 'Password',
            'agent_confirm_password' => 'Confirm Password',
            'agent_location' => 'Location',
            'agent_registration_certificate' => 'Registration Certificate',
            'agent_landline' => 'Landline',
        );
    }

    public function isValidImage($attribute, $params) {
        $strFileName = $params['parameter'];
        if (!empty($_FILES[$strFileName]['name'])) {
            $strOriginalFileName = $_FILES[$strFileName]['name'];
            $booleanIsMatch = $this->isMatch($strFileName);
            if ($booleanIsMatch) {
                return TRUE;
            } else {
                $this->addError($strFileName, $strFileName . ' ' . Yii::t('vehicle', 'common.form.invalidImage'));
                return FALSE;
            }
        } else {
            $this->addError($strFileName, 'Document is required.');
            return FALSE;
        }
    }

    public function isMatch($strFileName) {
        $arrValidExtensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
        $strImageExtension = strtolower(pathinfo($_FILES[$strFileName]['name'], PATHINFO_EXTENSION));
        $intFileSize = $_FILES[$strFileName]['size'];
        //Less than 2 MB
        if (in_array($strImageExtension, $arrValidExtensions) && $intFileSize < 2097152) { // 2 MB
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isEmailExist() {
        if (!empty($this->agent_email)) {
            $arrVehicleBrand = Agent::isEmailExist($this->agent_email);
            if (!empty($arrVehicleBrand)) {
                $this->addError('agent_email', $this->agent_email . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Email')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isMobileExist() {
        if (!empty($this->agent_phone)) {
            $arrVehicleBrand = Agent::isPhoneExist($this->agent_phone);
            if (!empty($arrVehicleBrand)) {
                $this->addError('agent_phone', $this->agent_phone . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Phone')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isNameExist() {
        if (!empty($this->agent_name)) {
            $arrVehicleBrand = Agent::isAgentNameExist($this->agent_name);
            if (!empty($arrVehicleBrand)) {
                $this->addError('agent_name', $this->agent_name . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Agency Name')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

}
