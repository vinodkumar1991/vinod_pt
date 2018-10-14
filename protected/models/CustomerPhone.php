<?php

class CustomerPhone extends CActiveRecord {

    public $strTable = 'customer_phone';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrPhoneInput
     * @return integer It will return an customer phone id
     * @ignore Need to change and also add foreign key to phone type table
     */
    public static function create($arrPhoneInput, $intCustomerId) {

        $intCustomerPhoneId = NULL;
        $objCustomerPhone = new CustomerPhone();
        $objCustomerPhone->customer_id = $intCustomerId;
        $objCustomerPhone->phone_type_id = $arrPhoneInput['phone_type_id'];
        $objCustomerPhone->phone = $arrPhoneInput['mobile'];
        $objCustomerPhone->status = 1;
        $objCustomerPhone->is_primary = 1;
        $objCustomerPhone->created_date = $arrPhoneInput['created_date'];
        $objCustomerPhone->created_by = $arrPhoneInput['created_by'];
        $objCustomerPhone->ip_address = $arrPhoneInput['ip_address'];
        if ($objCustomerPhone->save()) {
            $intCustomerPhoneId = $objCustomerPhone->id;
        }
        return $intCustomerPhoneId;
    }
    
    /**
     * @author Ctel
     * @param string $strPhone
     * @return array It will return customer phone data
     * @ignore need to change
     */
    public static function getPhoneDetails($strPhone) {
        $arrPhone = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('cp.id,cp.customer_id');
        $objectDB->from('customer_phone as cp');
        $objectDB->where('cp.phone=:phone', array(':phone' => $strPhone));
        $arrPhone = $objectDB->queryRow();
        return $arrPhone;
    }

}
