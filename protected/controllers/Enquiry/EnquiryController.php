<?php

class EnquiryController extends Controller {

    public function actionContactUs() {
        if (isset($_POST)) {            
            $arrResponse = array();
            $intEnquiryId = 0;
            $objEnquiry = new EnquiryForm();
            $objEnquiry->attributes = $_POST;
            if ($objEnquiry->validate()) {
                $arrEnquiry = $this->actionPrepareInput($objEnquiry->attributes);                                                              
                $intEnquiryId = Enquiry::model()->create($arrEnquiry);           
                $arrResponse = array('type' => 'success', 'data' => $intEnquiryId, 'message' => 'Enquiry created successfully.', 'success' => 'success', 'customerId' => $intEnquiryId);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $objEnquiry->errors, 'message' => 'Enquiry creation failed. please try again.', 'success' => 'fail', 'post' => $objEnquiry->attributes);
            }
        }
        echo $result = json_encode($arrResponse);exit;       
    }

    public function actionPrepareInput($arrEnquiryrInput) {
        $objCommon = new DataManager();
        $arrCommon=$objCommon->getDefaults();
        $arrEnquiry = array_merge($arrEnquiryrInput, $arrCommon);
        $strVerifyToken = CommonFunctions::getSamllAlphaToken(6);                
        $arrEnquiry['code']=$strVerifyToken;
        $arrEnquiry['status'] = 1;
        return $arrEnquiry;
    }

}
