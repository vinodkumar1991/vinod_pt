<?php

class Customer extends CActiveRecord {

    public $strTable = 'customer';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param string $strUsername
     * @return array It will return customer data
     */
    public static function getCustomer($strUsername = NULL, $intCustomerId = NULL, $strEmail = NULL) {
        $arrCustomer = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        if (!empty($strUsername)) {
            $objectDB->select('c.id,c.password,c.verify_token,c.access_token,c.first_name,c.middle_name,c.last_name,c.status,c.gcm_register_id');
            $objectDB->from('customer as c');
            $objectDB->where('c.username=:username', array(':username' => $strUsername));
        } else if (!empty($intCustomerId)) {
            $objectDB->select('c.id,c.password,c.verify_token,c.access_token,c.first_name,c.middle_name,c.last_name,c.status,ce.email,cp.phone,ca.address,ca.pincode,c.forgot_pwd_token,c.gcm_register_id');
            $objectDB->from('customer as c');
            $objectDB->join('customer_email as ce', 'ce.customer_id = c.id and ce.status ="' . $intStatus . '" and ce.is_primary ="' . $intStatus . '" ');
            $objectDB->join('customer_phone as cp', 'cp.customer_id = c.id and cp.status ="' . $intStatus . '" and cp.is_primary ="' . $intStatus . '"');
            $objectDB->leftJoin('customer_address as ca', 'ca.customer_id = c.id and ca.status ="' . $intStatus . '" and ca.is_primary ="' . $intStatus . '"');
            $objectDB->where('c.id=:id and c.status=:status', array(':id' => $intCustomerId, ':status' => $intStatus));
        } else if (!empty($strEmail)) {
            $objectDB->select('c.id,c.password,c.verify_token,c.access_token,c.first_name,c.middle_name,c.last_name,c.status,ce.email,cp.phone,ca.address,ca.pincode,c.forgot_pwd_token,c.gcm_register_id');
            $objectDB->from('customer as c');
            $objectDB->join('customer_email as ce', 'ce.customer_id = c.id and ce.status ="' . $intStatus . '" and ce.is_primary ="' . $intStatus . '" ');
            $objectDB->join('customer_phone as cp', 'cp.customer_id = c.id and cp.status ="' . $intStatus . '" and cp.is_primary ="' . $intStatus . '"');
            $objectDB->leftJoin('customer_address as ca', 'ca.customer_id = c.id and ca.status ="' . $intStatus . '" and ca.is_primary ="' . $intStatus . '"');
            $objectDB->where('ce.email=:email', array(':email' => $strEmail));
        }
        $arrCustomer = $objectDB->queryRow();
        return $arrCustomer;
    }

    /**
     * @author Ctel
     * @param array $arrCustomer
     * @return integer It will return an integer response
     */
    public static function create($arrCustomer) {
        $intCustomerId = NULL;
        $objectCustomer = new Customer();
        $objectCustomer->first_name = $arrCustomer['first_name'];
        $objectCustomer->username = $arrCustomer['username'];
        $objectCustomer->password = $arrCustomer['password'];
        $objectCustomer->customer_code = $arrCustomer['customer_code'];
        $objectCustomer->status = $arrCustomer['status'];
        $objectCustomer->created_date = $arrCustomer['created_date'];
        $objectCustomer->created_by = $arrCustomer['created_by'];
        $objectCustomer->ip_address = $arrCustomer['ip_address'];
        $objectCustomer->gcm_register_id = isset($arrCustomer['gcm_register_id']) ? $arrCustomer['gcm_register_id'] : NULL;
        $objectCustomer->device_id = $arrCustomer['device_id'];
        if (isset($arrCustomer['imei_no'])) {
            $objectCustomer->imei_no = $arrCustomer['imei_no'];
            $objectCustomer->verify_token = $arrCustomer['verify_token'];
        }
        if ($objectCustomer->save()) {
            $intCustomerId = $objectCustomer->id;
        }
        return $intCustomerId;
    }

    /**
     * @author Ctel
     * @param array $arrVerfication
     * @param integer $intCustomerId
     * @return integer It will return affected rows count
     */
    public static function updateCustomer($arrVerfication, $intCustomerId) {
        $intUpdateRows = Yii::app()->db->createCommand()
                ->update('customer', $arrVerfication, 'id=:id', array(':id' => $intCustomerId)
        );
        return $intUpdateRows;
    }

    /**
     * @author Ctel
     * @param string $strOTP
     * @return array It will otp details
     */
    public static function isOTPExist($strOTP, $intCustomer = NULL) {
        $arrCustomer = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('c.id');
        $objectDB->from('customer as c');
        $objectDB->where('c.verify_token=:token', array(':token' => $strOTP));
        if (!empty($intCustomer)) {
            $objectDB->andWhere('c.id=:customerId', array(':customerId' => $intCustomer));
        }
        $arrCustomer = $objectDB->queryRow();
        return $arrCustomer;
    }

    /**
     * @author Ctel
     * @param string $strUsernameOrMobile
     * @return array It will return customer details
     */
    public static function isUsernameExist($strUsernameOrMobile) {
        $arrCustomer = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('c.id,cp.phone');
        $objectDB->from('customer as c');
        $objectDB->join('customer_phone as cp', 'cp.customer_id = c.id');
        $objectDB->where('c.username=:username or cp.phone=:phone', array(':username' => $strUsernameOrMobile, ':phone' => $strUsernameOrMobile));
        $arrCustomer = $objectDB->queryRow();
        return $arrCustomer;
    }

    public static function customerSIGNIN($strUsername, $strPassword) {
        $arrCustomer = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('c.id as customer_id,c.first_name as customer_name');
        $objectDB->from('customer as c');
        $objectDB->where('c.username=:username and c.password=:password and c.status=:status', array(':username' => $strUsername, ':password' => $strPassword, ':status' => $intStatus));
        $arrCustomer = $objectDB->queryRow();
        return $arrCustomer;
    }

    public static function getCustomerData($intCustomerId) {
        $arrCustomer = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('cp.phone');
        $objectDB->from('customer_phone as cp');
        $objectDB->where('cp.customer_id=:id and cp.status=:status', array(':id' => $intCustomerId, ':status' => $intStatus));
        $arrCustomer = $objectDB->queryRow();
        return $arrCustomer;
    }

    public static function isPwdOTPExist($strOTP) {
        $arrCustomer = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('c.id');
        $objectDB->from('customer as c');
        $objectDB->where('c.forgot_pwd_token=:token', array(':token' => $strOTP));
        $arrCustomer = $objectDB->queryRow();
        return $arrCustomer;
    }

    public static function getCustomerCode() {
        $arrCodeDetails = array();
        try {
            $strQuery = 'select customer_code,id from customer order by id desc limit 1';
            $arrCodeDetails = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $ex) {
            $arrCodeDetails = $ex->getMessage();
        }

        return $arrCodeDetails;
    }

}
