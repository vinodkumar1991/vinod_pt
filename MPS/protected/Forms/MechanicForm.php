<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class MechanicForm extends CFormModel {

    public $mechanic_shop_name;
    public $mechanic_shop_country;
    public $mechanic_shop_state;
    public $mechanic_shop_license;
    public $mechanic_shop_city;
    public $mechanic_vehicle_type;
    public $mechanic_owner_name;
    public $mechanic_area;
    public $mechanic_total;
    public $mechanic_selected_services;
    public $mechanic_email;
    public $mechanic_contact;
    public $mechanic_shop_capability;
    public $mechanic_username;
    public $mechanic_password;
    public $mechanic_confirm_password;
    //Documents :: START
    public $mechanic_address_proof;
    public $mechanic_id_proof;
    public $mechanic_photo;
    //Documents :: END
    public $adrs;
    public $location;
    public $id;
    public $shopUserId;
    public $mechanic_shop_address;
    public $mechanic_code;

    /**
     * @author Ctel
     * @return array It will return array of errors if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('mechanic_shop_name,mechanic_shop_country,mechanic_shop_state,mechanic_shop_license,'
                . 'mechanic_shop_city,mechanic_vehicle_type,mechanic_owner_name,mechanic_area,mechanic_total,'
                . 'mechanic_email,mechanic_contact,mechanic_shop_capability,mechanic_username,mechanic_password,mechanic_confirm_password,mechanic_selected_services,adrs', 'required', 'message' => '{attribute} is required.'),
            array('mechanic_password', 'length', 'min' => 5, 'max' => 55),
            array('mechanic_confirm_password', 'compare', 'compareAttribute' => 'mechanic_password', 'message' => "Passwords don't match"),
            array('mechanic_address_proof,mechanic_id_proof,mechanic_photo,adrs,location,id,mechanic_shop_address,mechanic_code', 'safe'),
            array('mechanic_address_proof', 'isValidImage', 'parameter' => 'mechanic_address_proof'),
            array('mechanic_id_proof', 'isValidImage', 'parameter' => 'mechanic_id_proof'),
            array('mechanic_photo', 'isValidImage', 'parameter' => 'mechanic_photo'),
            array('mechanic_username', 'isUserNameExist'),
            array('mechanic_shop_name', 'isShopNameExist'),
            array('mechanic_contact', 'isPhoneExist'),
            array('mechanic_email', 'isEmailExist'),
            array('mechanic_code', 'isValidCode')
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {

        return array(
            'mechanic_shop_name' => 'Name',
            'mechanic_shop_country' => 'Country',
            'mechanic_shop_state' => 'State',
            'mechanic_shop_license' => 'License',
            'mechanic_shop_city' => 'City',
            'mechanic_vehicle_type' => 'Vehicle Type',
            'mechanic_owner_name' => 'Owner',
            'mechanic_area' => 'Area',
            'mechanic_total' => 'Total Mechanics',
            'mechanic_selected_services' => 'Service',
            'mechanic_email' => 'Email',
            'mechanic_contact' => 'Contact',
            'mechanic_shop_capability' => 'Capability',
            'mechanic_username' => 'Username',
            'mechanic_password' => 'Password',
            'mechanic_address_proof' => 'Address Proof',
            'mechanic_id_proof' => 'Id Proof',
            'mechanic_photo' => 'Photo',
            'mechanic_confirm_password' => 'Confirm Password',
            'mechanic_address_proof' => 'Address Proof',
            'mechanic_id_proof' => 'Id Proof',
            'mechanic_photo' => 'Photo',
            'adrs' => 'Shop Location',
            'mechanic_code' => 'Code',
            
        );
    }

    public function isValidImage($attribute, $params) {
        $strFileName = $params['parameter'];
        if (isset($_FILES[$strFileName]['name']) && !empty($_FILES[$strFileName]['name']) && empty($this->id)) {
            $strOriginalFileName = $_FILES[$strFileName]['name'];
            $booleanIsMatch = $this->isMatch($strFileName);
            if ($booleanIsMatch) {
                return TRUE;
            } else {
                $this->addError($strFileName, $strFileName . ' ' . Yii::t('vehicle', 'common.form.invalidImage'));
                return FALSE;
            }
        } else if (empty($this->id)) {
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

    public function isUserNameExist($attribute, $params) {
        if (!empty($this->mechanic_username)) {
            $arrUsers = Users::model()->isUserNameExist($this->mechanic_username, $this->shopUserId);
            if (!empty($arrUsers)) {
                $this->addError('mechanic_username', $this->mechanic_username . ' is already exist. Try with another name.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isShopNameExist($attribute, $params) {
        if (!empty($this->mechanic_shop_name)) {
            $arrUsers = MechanicShops::model()->isShopNameExist($this->mechanic_shop_name, $this->id);
            if (!empty($arrUsers)) {
                $this->addError('mechanic_shop_name', $this->mechanic_shop_name . ' is already exist. Try with another name.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isPhoneExist($attribute, $params) {
        if (!empty($this->mechanic_contact)) {
            $arrUsers = MechanicShops::model()->isPhoneExist($this->mechanic_contact, $this->id);
            if (!empty($arrUsers)) {
                $this->addError('mechanic_contact', $this->mechanic_contact . ' is already exist. Try with another one.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isEmailExist($attribute, $params) {
        if (!empty($this->mechanic_email)) {
            $arrUsers = MechanicShops::model()->isEmailExist($this->mechanic_email, $this->id);
            if (!empty($arrUsers)) {
                $this->addError('mechanic_email', $this->mechanic_email . ' is already exist. Try with another one.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
        
        
        
    }
    public function isValidCode($attribute, $params) {
        if (!empty($this->mechanic_code) && !empty($this->id)) {
            $arrHirePhone = MechanicShops::isCodeExist($this->mechanic_code, $this->id);
            if (!empty($arrHirePhone)) {
                $this->addError('mechanic_code', $this->mechanic_code . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Code ')));
                return FALSE;
            } else {
                return TRUE;
            }
        } elseif (!empty($this->id) && empty($this->mechanic_code)) {
            $this->addError('mechanic_code', 'Code is required');
            return FALSE;
        } elseif (empty($this->id)) {
            return TRUE;
        }
    }

}
