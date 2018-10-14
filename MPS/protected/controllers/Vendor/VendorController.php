<?php

class VendorController extends Controller 
{

    public  function actionVendorReport(){
        
        $arrVendor=Vendor::getVendorRegisteredReorts();
        $this->render('/Vendor/Vendor',array('arrVendor'=>$arrVendor));
    }

}
