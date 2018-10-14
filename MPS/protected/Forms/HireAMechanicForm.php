<?php

class HireAMechanicForm extends CFormModel {

    public $hire_name;
    public $hire_vehicle_id;
    public $hire_permanent_address;
    public $hire_present_address;
    public $hire_location;
    public $location;
    public $hire_email;
    public $hire_phone;
    public $hire_id_proof;
    public $hire_certificates;
    public $hire_photo;
    public $hire_address_proof;
    public $create_hire;
    public $hire_description;
    public $id;
    public $hire_code;

    public function rules() {
        return array(
            array('hire_name,hire_vehicle_id,hire_permanent_address,hire_present_address,'
                . 'hire_location,hire_email,'
                . 'hire_phone', 'required', 'message' => '{attribute} is required.'),
            array('location,hire_description,id,location,hire_code', 'safe'),
            array('hire_name,hire_vehicle_id,hire_permanent_address,hire_present_address,hire_location,location,hire_email,hire_phone', 'filter', 'filter' => 'trim'),
            array('hire_email', 'email'),
            array('hire_id_proof', 'isValidImage', 'parameter' => 'hire_id_proof'),
            array('hire_certificates', 'isValidMultipleImages', 'parameter' => 'hire_certificates'),
            array('hire_photo', 'isValidImage', 'parameter' => 'hire_photo'),
            array('hire_address_proof', 'isValidImage', 'parameter' => 'hire_address_proof'),
            array('hire_email', 'validateEmail'),
            array('hire_phone', 'validatePhone'),
            array('hire_code', 'isValidCode')
        );
    }

    public function attributeLabels() {
        return array(
            'hire_name' => 'Name',
            'hire_vehicle_id' => 'Vehicle Type',
            'hire_permanent_address' => 'Permanent Address',
            'hire_present_address' => 'Present Address',
            'hire_location' => 'Location',
            'hire_email' => 'Email',
            'hire_phone' => 'Phone',
            'hire_id_proof' => 'ID Proof',
            'hire_certificates' => 'Certificates',
            'hire_photo' => 'Photo',
            'hire_address_proof' => 'Address Proof',
            'hire_code' => 'Code',
        );
    }

    public function isValidMultipleImages($attribute, $params) {
        $strFileName = $params['parameter'];
        $arrMultiFiles = $_FILES[$strFileName]['name'];
        $booleanIsMatch = 0;
        if (is_array($_FILES[$strFileName]) && !empty($arrMultiFiles[0]) && empty($this->id)) {
            foreach ($arrMultiFiles as $key => $value) {
                $booleanIsMatch = $this->isMulMatch($_FILES['hire_certificates']['name'][$key], $_FILES['hire_certificates']['size'][$key]);
            }
        }
        if ($booleanIsMatch && empty($this->id)) {
            return TRUE;
        } else if (empty($this->id)) {
            $this->addError($strFileName, Yii::t('vehicle', 'common.form.invalidImage'));
            return FALSE;
        }
    }

    public function isValidImage($attribute, $params) {
        $strFileName = $params['parameter'];
        if (isset($_FILES[$strFileName]['name']) && !empty($_FILES[$strFileName]['name']) && empty($this->id)) {
            $strOriginalFileName = $_FILES[$strFileName]['name'];
            $booleanIsMatch = $this->isMatch($strFileName);
            if ($booleanIsMatch) {
                return TRUE;
            } else {
                $this->addError($strFileName, Yii::t('vehicle', 'common.form.invalidImage'));
                return FALSE;
            }
        } else if (empty($this->id)) {
            $this->addError($strFileName, Yii::t('vehicle', 'common.form.invalidImage'));
            return FALSE;
        }
    }

    public function isMatch($strFileName) {
        $arrValidExtensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
        $strOriginalFileName = $_FILES[$strFileName]['name'];
        $strImageExtension = strtolower(pathinfo($strOriginalFileName, PATHINFO_EXTENSION));
        $intFileSize = $_FILES[$strFileName]['size'];
        if (in_array($strImageExtension, $arrValidExtensions) && $intFileSize < 2097152) { // 2 MB
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isMulMatch($strFileName, $intFileSize) {
        $arrValidExtensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
        $strImageExtension = strtolower(pathinfo($strFileName, PATHINFO_EXTENSION));
        if (in_array($strImageExtension, $arrValidExtensions) && $intFileSize < 2097152) { // 2 MB
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function validateEmail($attribute, $params) {
        if (!empty($this->hire_email)) {
            $arrHireEmail = HireAMechanicEmail::isEmailExist($this->hire_email, $this->id);
            if (!empty($arrHireEmail)) {
                $this->addError('hire_email', $this->hire_email . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Email ')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function validatePhone($attribute, $params) {
        if (!empty($this->hire_phone)) {
            $arrHirePhone = HireAMechanicPhone::isPhoneExist($this->hire_phone, $this->id);
            if (!empty($arrHirePhone)) {
                $this->addError('hire_phone', $this->hire_phone . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Phone ')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isValidCode($attribute, $params) {
        if (!empty($this->hire_code) && !empty($this->id)) {
            $arrHirePhone = HireAMechanic::isCodeExist($this->hire_code, $this->id);
            if (!empty($arrHirePhone)) {
                $this->addError('hire_code', $this->hire_code . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Code ')));
                return FALSE;
            } else {
                return TRUE;
            }
        } elseif (!empty($this->id) && empty($this->hire_code)) {
            $this->addError('hire_code', 'Code is required');
            return FALSE;
        } elseif (empty($this->id)) {
            return TRUE;
        }
    }

}
