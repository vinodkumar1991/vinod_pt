<?php

class ModificationShops extends CActiveRecord{
    
    public $strTable = 'modification_shops';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function getModificationServices(){
            $arrServices=array();
            $objectDB=Yii::app()->db->createCommand();
            $objectDB->select('ms.id, ms.name');
            $objectDB->from('modification_services as ms');            
            $arrServices = $objectDB->queryAll();
            return $arrServices;
    }
    
    public static function getVehicleBrandName($intType){            
            $objectDB=Yii::app()->db->createCommand();
            $objectDB->select('vb.id, vb.name');
            $objectDB->from('vehicle_brands as vb');
            $objectDB->where('vb.vehicle_types_id=:vehicle_types',array(':vehicle_types'=>$intType['vehicle_type']));
            $objectDB->order('vb.name ASC');
            $arrBrand = $objectDB->queryAll();           
            return $arrBrand;
        
    }

    public function isShopNameExist($strShopName) {
        $arrShop = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ms.id');
        $objectDB->from('modification_shops as ms');
        $objectDB->where('ms.name=:name', array(':name' => $strShopName));        
        $arrShop = $objectDB->queryRow();
        return $arrShop;
    }
    
    public static function create($arrModificationShop) {
        //echo'<pre>';print_r($arrModificationShop);die();
        $intModificationShop = NULL;
        $intModificationShop = new ModificationShops();
        $intModificationShop->users_id = $arrModificationShop['user_id'];
        $intModificationShop->name = $arrModificationShop['name'];
        $intModificationShop->owner = $arrModificationShop['owner']; // Need to change
        $intModificationShop->code = $arrModificationShop['code'];       
        $intModificationShop->email = $arrModificationShop['email'];
        $intModificationShop->phone = $arrModificationShop['phone'];
        $intModificationShop->vehicle_types_id = $arrModificationShop['vehicle_type'];
        $intModificationShop->description = $arrModificationShop['shop_desc'];
        $intModificationShop->status = $arrModificationShop['status'];
        $intModificationShop->created_date = $arrModificationShop['created_date'];
        $intModificationShop->created_by = $arrModificationShop['created_by'];
        $intModificationShop->ip_address = $arrModificationShop['ip_address'];
        $intModificationShop->device_id = $arrModificationShop['device_id'];
        if ($intModificationShop->save()) {
            $intModificationShop = $intModificationShop->id;
        }         
        return $intModificationShop;
    }
    
    public static function getModificationShopsDetails(){
                $arrShops=array();
                $objectDB=Yii::app()->db->createCommand();
                $objectDB->select('ms.id,ms.code   AS shop_id, ms.name   AS shop_name,ms.owner AS owner_name,
                                ms.description,
                                ms.email, 
                                ms.phone, 
                                address     AS shop_address,
                                location    AS shop_location,
                                latitude,
                                longitude,
                                vt.name      AS vehicle_type,
                                GROUP_CONCAT(DISTINCT vb.name) 
                                             AS vehicle_name,
                                GROUP_CONCAT(DISTINCT mos.name) 
                                             AS service_name,
                                CASE ms.status WHEN 1 THEN "Active" WHEN 2 THEN "Inactive" END AS shop_status');
                $objectDB->from('modification_shops AS ms');
                $objectDB->join('modification_shop_details AS msd','msd.modification_shops_id=ms.id');
                $objectDB->join('modification_shops_services AS mss','mss.modification_shops_id=ms.id');
                $objectDB->join('modification_shops_brands AS msb','msb.modification_shops_id=ms.id');
                $objectDB->join('vehicle_types AS vt','vt.id=ms.vehicle_types_id');
                $objectDB->join('vehicle_brands AS vb','vb.id=msb.vehicle_brands_id');
                $objectDB->join('modification_services AS mos','mos.id=mss.modification_service_id');                               
                $objectDB->order('ms.id desc');
                $objectDB->group('ms.id');
                $arrShops= $objectDB->queryAll();        
                return $arrShops;
    }
}
