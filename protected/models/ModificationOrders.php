<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModificationOrders
 *
 * @author ctel-cpu-33
 */
class ModificationOrders extends CActiveRecord{
    
    private $strTable = 'modification_orders';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function create($arrInput){
        $intOrderID='';    
        $objData=new ModificationOrders();
        $objData->shop_id=$arrInput['shop_id'];
        $objData->customer_id=$arrInput['customer_id'];
        $objData->order_number=$arrInput['order_number'];
        $objData->order_status=$arrInput['order_status'];
        $objData->vehicle_types_id=$arrInput['vehicle_type_id'];
        $objData->vehicle_brand_id=$arrInput['vehicle_brand_id'];
        $objData->vehicle_service_type_id=$arrInput['vehicle_service_type_id'];
        $objData->created_date=$arrInput['created_date'];
        $objData->created_by=$arrInput['created_by'];
        $objData->ip_address=$arrInput['ip_address'];
        $objData->status=$arrInput['status'];
        $objData->device_types_id=$arrInput['device_id'];       
        
        if($objData->save()){
            $intOrderID=$objData->id;            
        }
        return $intOrderID;        
    }
    
}
