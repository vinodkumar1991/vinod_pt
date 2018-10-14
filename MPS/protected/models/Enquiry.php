<?php

class Enquiry extends CActiveRecord 
{
    public $strTable = 'enquiry';
    public function tableName()
    {
            return $this->strTable;
    }

    public static function model($className = __CLASS__)
    {
            return parent::model($className);
    }
     
    public static function getCustomerEnquiryReports(){
        $objDB=Yii::app()->db->createCommand();
        $objDB->select('*,DATE_FORMAT(created_date,"%d %b, %Y") AS created_date');
        $objDB->from('enquiry');
        $objDB->order('id desc');                    
        $arrEnquiry=$objDB->queryAll();
        return $arrEnquiry;
    }
}
?>
