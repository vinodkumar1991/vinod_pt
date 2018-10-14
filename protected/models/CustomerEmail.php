<?php

class CustomerEmail extends CActiveRecord {

    public $strTable = 'customer_email';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrEmailInput
     * @return integer It will return an customer email id
     */
    public static function create($arrEmailInput, $intCustomerId, $isMobileService = NULL) {
        $intCustomerEmailId = NULL;
        $objCustomerEmail = new CustomerEmail();
        $objCustomerEmail->customer_id = $intCustomerId;
        if (!empty($isMobileService)) {
            $objCustomerEmail->email = $arrEmailInput['email'];
        } else {
            $objCustomerEmail->email = $arrEmailInput['username'];
        }
        $objCustomerEmail->status = 1;
        $objCustomerEmail->is_primary = 1;
        $objCustomerEmail->created_date = $arrEmailInput['created_date'];
        $objCustomerEmail->created_by = $arrEmailInput['created_by'];
        $objCustomerEmail->ip_address = $arrEmailInput['ip_address'];
        if ($objCustomerEmail->save()) {
            $intCustomerEmailId = $objCustomerEmail->id;
        }
        return $intCustomerEmailId;
    }

    /**
     * @author Ctel
     * @param string $strEmail
     * @return array It will return customer phone data
     * @ignore need to change
     */
    public static function getEmailDetails($strEmail) {
        $arrEmail = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ce.id,ce.customer_id');
        $objectDB->from('customer_email as ce');
        $objectDB->where('ce.email=:email', array(':email' => $strEmail));
        $arrEmail = $objectDB->queryRow();
        return $arrEmail;
    }

    public static function getPhoneDetails($strPhone) {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('cp.id,cp.customer_id');
        $objectDB->from('customer_phone as cp');
        $objectDB->where('cp.phone=:phone', array(':phone' => $strPhone));
        $arrPhone = $objectDB->queryRow();
        return $arrPhone;
    }

}
