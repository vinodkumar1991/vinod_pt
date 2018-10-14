<?php

class VendorController extends Controller 
{
  
    public function actionVendor()
    {
        $getVendorTypes = VendorTypes::model()->getVendor();
        // print_r($getVendorTypes); exit;
        $this->render("/Vendor/Vendor",array("vendorTypes"=>$getVendorTypes));
    }


   public function actionCreateVendor()
   {
       $getVendorTypes = VendorTypes::model()->getVendor();
        if(isset($_POST))
            {    
                $strResponse = NULL;  
                $arrResponse = array();     
                $intVendorId = 0;
                $objVendor = new VendorForm();
                $objVendor->attributes = $_POST;
                    if ($objVendor->validate())
                        {            
                           
                            $arrCustomer = $this->actionPrepareInput($objVendor->attributes);                            
                            $intVendorId = Vendor::model()->create($arrCustomer);
                            $strTokenSolider = '0123456789'; // Need to change
                            $strVerifyToken = CommonFunctions::getToken(6, $strTokenSolider);
                                                  
                            $arrResponse = array('type' => 'success', 'data' => $intVendorId, 'message' => 'customer created successfully.', 'success' => 'success', 'customerId' => $intVendorId);
                        }
                        else
                        {
                            $arrResponse = array('type' => 'fail', 'data' => $objVendor->errors, 'message' => 'customer creation failed. please try again.', 'success' => 'fail','post'=>$objVendor->attributes);
                        }
                                    //  $strResponse = CommonFunctions::encodeData($arrResponse); echo $strResponse;
            }
           
            $this->render("/Vendor/Vendor",array("message"=>$arrResponse,"vendorTypes"=>$getVendorTypes));
    }
    

    public function actionPrepareInput($arrCustomerInput)
    {        
        $objCommon = new DataManager();
		$arrCommon=$objCommon->getDefaults();		
        $arrCustomer = array_merge($arrCustomerInput, $arrCommon);
        $arrCustomer['status']=1;
        return $arrCustomer;
    }

}
