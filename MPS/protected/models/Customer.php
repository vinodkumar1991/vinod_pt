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
    public static function getCustomer($strUsername = NULL, $intCustomerId = NULL ,  $strEmail = NULL) {
        $arrCustomer = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('c.id,c.password,c.verify_token,c.access_token,c.first_name,c.customer_code,c.middle_name,c.last_name,c.status,ce.email,cp.phone,ca.address,ca.pincode,c.forgot_pwd_token,c.created_date,c.username');
            $objectDB->from('customer as c');
            $objectDB->join('customer_email as ce', 'ce.customer_id = c.id and ce.status ="' . $intStatus . '" and ce.is_primary ="' . $intStatus . '" ');
            $objectDB->join('customer_phone as cp', 'cp.customer_id = c.id and cp.status ="' . $intStatus . '" and cp.is_primary ="' . $intStatus . '"');
            $objectDB->leftJoin('customer_address as ca', 'ca.customer_id = c.id and ca.status ="' . $intStatus . '" and ca.is_primary ="' . $intStatus . '"');
           // $objectDB->where('c.status=:status', array(':status' => $intStatus));
        
        $arrCustomer = $objectDB->queryAll();
        return $arrCustomer;
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





  

  
       
    
    

}
