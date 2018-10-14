<?php

class EnquiryController extends Controller {

    public function actionEnquiryReport(){
        
       $arrEnquiry=Enquiry::getCustomerEnquiryReports();      
       $this->render('/Enquiry/Enquiry',array('arrEnquiry'=>$arrEnquiry));               
    }
}
