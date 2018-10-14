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
    
    public static function getVendorRegisteredReorts(){
        $objDB=Yii::app()->db->createCommand();
        $objDB->select('first_name AS name,
                        email,
                        mobile,
                        name AS vendor_type,
                        DATE_FORMAT(v.created_date,"%d %b, %Y") AS created_date');
        $objDB->from('vendor as v');
        $objDB->join('vendor_types as vt','vt.id=v.vendor_types_id');
        $objDB->order('v.id DESC');
        $arrVendor=$objDB->queryAll();
        return $arrVendor;
    }
}
