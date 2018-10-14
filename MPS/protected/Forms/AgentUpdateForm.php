<?php

class AgentUpdateForm extends CFormModel {

    public $agency_name;
    public $agent_owner;
    public $agent_email;
    public $agent_code;
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
    public $agent_location;
    public $location;
    public $agent_registration_certificate;
    public $agent_landline;
    public $id;

    public function rules() {
        return array(
            array('agency_name,agent_owner,agent_email,agent_phone,agent_address,agent_country,agent_state,'
                . 'agent_city,agent_area,agent_pincode,agent_location,agent_code', 'required'),
            array('location,agent_landline', 'safe'),
            array('agent_email', 'email'),
            array('agent_email', 'isEmailExist'),
            array('agent_phone', 'isMobileExist'),
            array('agent_code', 'isCodeExist'),
            //array('agent_address_proof', 'isValidImage', 'parameter' => 'agent_address_proof'),
            //array('agent_id_proof', 'isValidImage', 'parameter' => 'agent_id_proof'),
            //array('agent_photo', 'isValidImage', 'parameter' => 'agent_photo'),
            //array('agent_registration_certificate', 'isValidImage', 'parameter' => 'agent_registration_certificate'),
        );
    }

    public function attributeLabels() {
        return array(
            'agency_name' => 'Agency Name',
            'agent_owner' => 'Owner',
            'agent_email' => 'Email',
            'agent_code'  =>  'Code',
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

    public function isEmailExist($attribute, $params) {
        if (!empty($this->agent_email)) {
            $arrVehicleBrand = Agent::isEmailExist($this->agent_email, $this->id);
            if (!empty($arrVehicleBrand)) {
                $this->addError('agent_email', $this->agent_email . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Email')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isMobileExist($attribute, $params) {
        if (!empty($this->agent_phone)) {
            $arrVehicleBrand = Agent::isPhoneExist($this->agent_phone, $this->id);
            if (!empty($arrVehicleBrand)) {
                $this->addError('agent_phone', $this->agent_phone . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Phone')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isNameExist() {
        if (!empty($this->agency_name)) {
            $arrVehicleBrand = Agent::isAgentNameExist($this->agency_name, $this->id);
            if (!empty($arrVehicleBrand)) {
                $this->addError('agency_name', $this->agency_name . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Agency Name')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }
    
    public function isCodeExist(){
        if (!empty($this->agent_code)) {
            $arrAgentCode = Agent::isAgentCodeExist($this->agent_code, $this->id);
            if (!empty($arrAgentCode)) {
                $this->addError('agent_code', $this->agent_code . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Agency Code')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

}
