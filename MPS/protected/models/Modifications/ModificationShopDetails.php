<?php

class ModificationShopDetails extends CActiveRecord{
    public $strTable = 'modification_shop_details';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function create($arrModificationShop) {        
        $intModificationShop = NULL;
        $intModificationShop = new ModificationShopDetails();
        $intModificationShop->modification_shops_id = $arrModificationShop['modification_shops_id'];
        $intModificationShop->address = $arrModificationShop['address'];  
        $intModificationShop->description=NULL;
        $intModificationShop->cities_id = $arrModificationShop['cities_id'];
        $intModificationShop->areas_id = $arrModificationShop['areas_id'];
        $intModificationShop->pincode = $arrModificationShop['pincode'];
        $intModificationShop->location = $arrModificationShop['location'];
        $intModificationShop->longitude = $arrModificationShop['longitude'];
        $intModificationShop->latitude = $arrModificationShop['latitude'];
        $intModificationShop->shop_image = $arrModificationShop['shop_image'];      
        $intModificationShop->shop_original_image = $arrModificationShop['shop_original_image'];
        $intModificationShop->brand_logo = $arrModificationShop['brand_logo'];
        $intModificationShop->brand_original_logo = $arrModificationShop['brand_original_logo'];
        $intModificationShop->created_date = $arrModificationShop['created_date'];
        $intModificationShop->created_by = $arrModificationShop['created_by'];
        $intModificationShop->ip_address = $arrModificationShop['ip_address'];
        $intModificationShop->device_id = $arrModificationShop['device_id'];
        if ($intModificationShop->save()) {
            $intModificationShop = $intModificationShop->id;
        }
        return $intModificationShop;
    }
    
}
