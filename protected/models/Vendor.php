<?php

class Vendor extends CActiveRecord 
{
    public $strTable = 'vendor';
    public function tableName()
    {
            return $this->strTable;
    }

    public static function model($className = __CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @author Ctel
     * @param string $strUsername
     * @return array It will return Vendor data
     */
    public static function getVendor($intStatus = 1, $intVendor = NULL) {
            $arrVendor = array();           
            $objectDB = Yii::app()->db->createCommand();
            $objectDB->select('v.id,v.password,v.verify_token,v.access_token,v.name as vendor_name');
            $objectDB->from('vendor as v');
            if (!empty($intVendor)) 
            {
                $objectDB->where('v.id=:id', array(':id' => $intVendor));
                $arrVendor = $objectDB->queryRow();
            } 
            else
            {
                $objectDB->where('v.status=:status', array(':status' => $intStatus));
                $arrVendor = $objectDB->queryAll();
            }


        return $arrVendor;
    }
     /**
     * get email
     * @author Ctel
     * @param array $arrVendor
     * @return integer It will return an integer response
     */
    public static function getEmail($strEmail) 
    {
            $arrCustomer = array();
            $objectDB = Yii::app()->db->createCommand();
            $objectDB->select('v.first_name');
            $objectDB->from('vendor as v');
            $objectDB->where('v.email=:email', array(':email' => $strEmail));
            $arrCustomer = $objectDB->queryRow();
            return $arrCustomer;
    }
    public static function getMobileNo($strMobile) 
    {
            $arrCustomer = array();
            $objectDB = Yii::app()->db->createCommand();
            $objectDB->select('v.first_name');
            $objectDB->from('vendor as v');
            $objectDB->where('v.mobile=:mobile', array(':mobile' => $strMobile));
            $arrCustomer = $objectDB->queryRow();
            return $arrCustomer;
    }

    /**
     * @author Ctel
     * @param array $arrVendor
     * @return integer It will return an integer response
     */
    public static function create($arrVendor)
    {
            $intVendorId = NULL;                  
            $objectVendor = new Vendor();                
            $objectVendor->vendor_types_id = $arrVendor['vendor_types_id'];
            $objectVendor->first_name = $arrVendor['first_name'];
            $objectVendor->email = $arrVendor['email'];
            $objectVendor->mobile = $arrVendor['mobile'];
            $objectVendor->status = $arrVendor['status']; 
            $objectVendor->created_date = $arrVendor['created_date'];
            $objectVendor->created_by = $arrVendor['created_by'];
            $objectVendor->ip_address = $arrVendor['ip_address'];
            $objectVendor->device_id = $arrVendor['device_id'];
        if ($objectVendor->save()) 
            {
                $intVendorId = $objectVendor->id;
            }
        return $intVendorId;
    }

}
