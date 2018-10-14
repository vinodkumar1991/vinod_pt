<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModificationOrdersCommunication
 *
 * @author ctel-cpu-33
 */
class ModificationOrdersCommunication extends CActiveRecord{
   
    private $strTable = 'modification_orders_communication';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    
    public static function create($arrInput,$intOrderID){
        $intOrderCommID='';    
        $objData=new ModificationOrdersCommunication();
        $objData->order_id=$intOrderID;
        $objData->name=$arrInput['name'];
        $objData->address=$arrInput['address'];
        $objData->pincode=$arrInput['pincode'];
        $objData->email=$arrInput['email'];
        $objData->phone=$arrInput['phone'];
        $objData->location=$arrInput['location'];
        $objData->latitude=$arrInput['latitude'];
        $objData->longitude=$arrInput['longitude'];
        $objData->send_request_datetime=$arrInput['send_request_datetime'];     
        
        if($objData->save()){
            $intOrderCommID=$objData->id;            
        }
        return $intOrderCommID;        
    }
    
}
