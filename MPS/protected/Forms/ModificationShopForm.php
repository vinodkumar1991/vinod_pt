<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModificationShopForm
 *
 * @author ctel-cpu-33
 */
class ModificationShopForm  extends CFormModel{
    
    public $shop_name;
    public $shop_country;
    public $shop_state;   
    public $shop_city;
    public $shop_area;
    public $shop_pincode;
    public $vehicle_type;
    public $owner_name;     
    public $shop_email;
    public $shop_contact;    
    public $username;
    public $password;
    public $confirm_password;    
    public $shop_adrs;
    public $adrs;
    public $location;
    public $shop_image;
    public $brand_logo;
    public $brand_name;
    public $list_modification;
    public $shop_description;

    /**
     * @author Ctel
     * @return array It will return array of errors if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('shop_name,shop_country,shop_state,'
                . 'shop_city,vehicle_type,owner_name,shop_area,shop_pincode,'
                . 'shop_email,shop_contact,username,password,confirm_password,shop_adrs,adrs,brand_name,list_modification', 'required'),
            array('password', 'length', 'min' => 5, 'max' => 55),
            array('confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"),
            array('shop_description,shop_image,brand_logo,location', 'safe'),
            array('shop_image', 'isValidImage', 'parameter' => 'shop_image'),
            array('brand_logo', 'isValidImage', 'parameter' => 'brand_logo'),            
            array('username', 'isUserNameExist'),
            array('shop_name', 'isShopNameExist'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {

        return array(
            'shop_name' => 'Name',
            'shop_country' => 'Country',
            'shop_state' => 'State',            
            'shop_city' => 'City',
            'vehicle_type' => 'Vehicle Type',
            'owner_name' => 'Owner Name',
            'shop_area' => 'Area',  
            'shop_adrs' => 'Shop Address',
            'adrs' => 'Shop Location',
            'shop_pincode'=>'Pincode',
            'shop_email' => 'Email ID',
            'shop_contact' => 'Contact No',            
            'username' => 'Username',
            'password' => 'Password',
            'confirm_password' => 'Confirm Password',    
            'shop_image' => 'Shop Image',
            'brand_logo' => 'Brand Logo',            
            'brand_name' => 'Brand Name',            
            'list_modification' => 'List of Modification',                        
         
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

    public function isUserNameExist($attribute, $params) {
        if (!empty($this->username)) {
            $arrUsers = Users::model()->isUserNameExist($this->username);
            if (!empty($arrUsers)) {
                $this->addError('username', $this->username . ' is already exist. Try with another name.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isShopNameExist($attribute, $params) {
        if (!empty($this->shop_name)) {
            $arrUsers = ModificationShops::model()->isShopNameExist($this->shop_name);
            if (!empty($arrUsers)) {
                $this->addError('shop_name', $this->shop_name . ' is already exist. Try with another name.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }
    
}
