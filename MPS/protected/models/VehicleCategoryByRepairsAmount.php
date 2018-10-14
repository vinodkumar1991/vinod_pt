<?php

class VehicleCategoryByRepairsAmount extends CActiveRecord {

    public $strTable = 'vehical_category_repairs_amount';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrBilling
     * @return integer It will return last inserted bill id
     */
    public static function create($arrBilling) {
        $intBill = NULL;
        $objBill = new VehicleCategoryByRepairsAmount();
        $objBill->repairs_id = $arrBilling['repairs_id'];
        $objBill->repairs_lists_id = $arrBilling['repairs_lists_id'];
        $objBill->vehicle_categories_id = $arrBilling['vehicle_category_id'];
        $objBill->vehicle_types_id = $arrBilling['vehicle_id'];
        $objBill->plans_types_id = $arrBilling['plan_id'];
        $objBill->is_recommended = $arrBilling['is_recommended'];
        $objBill->cost = $arrBilling['cost'];
        $objBill->status = $arrBilling['status'];
        $objBill->created_date = $arrBilling['created_date'];
        $objBill->created_by = $arrBilling['created_by'];
        $objBill->ip_address = $arrBilling['ip_address'];
        $objBill->device_id = $arrBilling['device_id'];
        if ($objBill->save()) {
            $intBill = $objBill->id;
        }
        return $intBill;
    }

    public static function billingReport($arrInput = array()) {
        //echo'<pre>';print_r($arrInput);exit;
        $arrBilling = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('r.name as repair_name,rl.name as repair_list_name,vc.name as vehicle_category_name,'
                . 'vt.name as vehicle_name,pt.name as plan_name,vcra.cost,vcra.status,vcra.id as amount_id');
        $objectDB->from('vehical_category_repairs_amount as vcra');
        $objectDB->join('repairs as r', 'r.id=vcra.repairs_id');
        $objectDB->join('repairs_lists rl', 'rl.id=vcra.repairs_lists_id');
        $objectDB->join('vehicle_categories vc', 'vc.id=vcra.vehicle_categories_id');
        $objectDB->join('vehicle_types vt', 'vt.id=vcra.vehicle_types_id');
        $objectDB->join('plans_types pt', 'pt.id=vcra.plans_types_id');
        if (isset($arrInput['status'])) {
            $objectDB->where('vcra.status:=status', array(':status' => $arrInput['status']));
        }
        
        if(isset($arrInput['veh_type']) && !empty($arrInput['veh_type'])){
             $objectDB->where('vt.id=:id', array(':id' => $arrInput['veh_type']));
        }
        if(isset($arrInput['vehicle_category_id']) && !empty($arrInput['vehicle_category_id'])){
             $objectDB->andWhere('vc.id=:vehicle_category_id', array(':vehicle_category_id' => $arrInput['vehicle_category_id']));
        }
        if(isset($arrInput['plan_id']) && !empty($arrInput['plan_id'])){
             $objectDB->andWhere('pt.id=:plan_id', array(':plan_id' => $arrInput['plan_id']));
        }        
        if(isset($arrInput['repairs_id']) && !empty($arrInput['repairs_id'])){
             $objectDB->andWhere('r.id=:repairs_id', array(':repairs_id' => $arrInput['repairs_id']));
        }
        
        $objectDB->order('vcra.id desc');
        $arrBilling = $objectDB->queryAll();        
        return $arrBilling;
    }
    
    public static function UpdateBillingReport($arrInput){
           
           $objCommon=new DataManager();
           $arrCommon = $objCommon->makeData($arrInput);
           $count=1;
           foreach($arrCommon['billReport'] as $amountID=>$updateValue){              
               if(!empty($updateValue['amount'])){
                    $setValue=array(
                                'cost'=>$updateValue['amount'],
                                'status'=>$updateValue['billstatus'],
                                'last_modified'=>$arrCommon['created_date'],
                                'ip_address'=>$arrCommon['ip_address']);
                    $objectDB=Yii::app()->db->createCommand();
                    $objectDB->update('vehical_category_repairs_amount',$setValue,'id=:id',array('id'=>$amountID));                    
                    $count++;
               }
               
           }
           //return $count;                      
    } 
}
