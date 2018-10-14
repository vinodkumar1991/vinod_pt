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
     
    /**
     * @author Ctel
     * @param array $arrEnquiry
     * @return integer It will return an integer response
     */
    public static function create($arrEnquiry)
    {
            $intEnquiryId = NULL;      
            $objEnquiry = new Enquiry();                      
            $objEnquiry->name = $arrEnquiry['enquiry_name'];
            $objEnquiry->code = $arrEnquiry['code'];
            $objEnquiry->email = $arrEnquiry['enquiry_email'];
            $objEnquiry->phone = $arrEnquiry['enquiry_phone'];
            $objEnquiry->description = $arrEnquiry['enquiry_content'];
            $objEnquiry->status =$arrEnquiry['status']; 
            $objEnquiry->created_date = $arrEnquiry['created_date'];
            $objEnquiry->created_by = $arrEnquiry['created_by'];
            $objEnquiry->ip_address = $arrEnquiry['ip_address'];           
        if ($objEnquiry->save()) 
            {
                $intEnquiryId = $objEnquiry->id;
            }
        return $intEnquiryId;
    }

}
