<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class DeliveryForm extends CFormModel {

    public $mechanic_shop;
    public $delivery_name;
    public $delivery_boy_age;
    public $delivery_address_one;
    public $delivery_address_two;
    public $delivery_address_proof;
    public $delivery_id_proof;
    public $delivery_photo;
    public $delivery_email;
    public $delivery_contact;
    public $delivery_username;
    public $delivery_password;
    public $delivery_confirm_password;
    public $delivery_status;
    public $id;
    public $users_id;
    public $delivery_code;

    //Documents :: END

    /**
     * @author Ctel
     * @return array It will return array of errors if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('mechanic_shop,delivery_name,delivery_boy_age,delivery_address_one,'
                . 'delivery_email,'
                . 'delivery_contact,delivery_username,delivery_password,delivery_confirm_password', 'required'),
            array('delivery_password', 'length', 'min' => 5, 'max' => 55),
            array('delivery_confirm_password', 'compare', 'compareAttribute' => 'delivery_password', 'message' => "Passwords don't match"),
            array('delivery_address_proof,delivery_id_proof,delivery_photo,delivery_address_two,delivery_code', 'safe'),
            array('delivery_address_proof', 'isValidImage', 'parameter' => 'delivery_address_proof'),
            array('delivery_id_proof', 'isValidImage', 'parameter' => 'delivery_id_proof'),
            array('delivery_photo', 'isValidImage', 'parameter' => 'delivery_photo'),
            array('delivery_username', 'isUserNameExist'),
            array('delivery_email', 'isEmailExist'),
            array('delivery_contact', 'isPhoneExist'),
            array('delivery_code','isValidCode'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'mechanic_shop' => 'Mechanic Shop',
            'delivery_name' => 'Name',
            'delivery_boy_age' => 'Age',
            'delivery_address_one' => 'Address One',
            'delivery_address_two' => 'Address Two',
            'delivery_address_proof' => 'Address Proof',
            'delivery_id_proof' => 'ID Proof',
            'delivery_photo' => 'Photo',
            'delivery_email' => 'Email',
            'delivery_contact' => 'Contact',
            'delivery_username' => 'Username',
            'delivery_password' => 'Password',
            'delivery_confirm_password' => 'Confirm Password',
        );
    }

    public function isValidImage($attribute, $params) {
        $strFileName = $params['parameter'];
        $intDelivery = $this->id;
        if (!empty($_FILES[$strFileName]['name']) && empty($intDelivery)) {
            $strOriginalFileName = $_FILES[$strFileName]['name'];
            $booleanIsMatch = $this->isMatch($strFileName);
            if ($booleanIsMatch) {
                return TRUE;
            } else {
                $this->addError($strFileName, $strFileName . ' ' . Yii::t('vehicle', 'common.form.invalidImage'));
                return FALSE;
            }
        } else if (empty($intDelivery)) {
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
        if (!empty($this->delivery_email)) {
            $arrUsers = DeliveryBoys::model()->isEmailExist($this->delivery_email, $this->id);
            if (!empty($arrUsers)) {
                $this->addError('delivery_email', $this->delivery_email . ' is already exist. Try with another name.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isPhoneExist($attribute, $params) {
        if (!empty($this->delivery_contact)) {
            $arrUsers = DeliveryBoys::model()->isPhoneExist($this->delivery_contact, $this->id);
            if (!empty($arrUsers)) {
                $this->addError('delivery_contact', $this->delivery_contact . ' is already exist. Try with another name.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isUserNameExist($attribute, $params) {
        if (!empty($this->delivery_username)) {
            $arrUsers = Users::model()->isUserNameExist($this->delivery_username, $this->users_id);
            if (!empty($arrUsers)) {
                $this->addError('delivery_username', $this->delivery_username . ' is already exist. Try with another name.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }
    public function isValidCode($attribute, $params) {
        if (!empty($this->delivery_code) && !empty($this->id)) {
            $arrHirePhone = DeliveryBoys::isCodeExist($this->delivery_code, $this->id);
            if (!empty($arrHirePhone)) {
                $this->addError('delivery_code', $this->delivery_code . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Code ')));
                return FALSE;
            } else {
                return TRUE;
            }
        } elseif (!empty($this->id) && empty($this->delivery_code)) {
            $this->addError('delivery_code', 'Code is required');
            return FALSE;
        } elseif (empty($this->id)) {
            return TRUE;
        }
    }

}
