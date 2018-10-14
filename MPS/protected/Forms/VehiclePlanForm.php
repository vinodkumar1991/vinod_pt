<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class VehiclePlanForm extends CFormModel {

   // public $vehicle_type;
    public $plan_name;
    public $code;
    public $desc;
    public $status_val;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
           array('plan_name,code,status_val', 'required'), 
           
           array('plan_name', 'Check_Plan'),
           array('code', 'Check_Code'),
           array('desc', 'Check_Desc'),
            
               //array('servicename', 'required')
            );
    }

  
    public function attributeLabels() {
        return array(
            'plan_name' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Plan Name')),
            'code' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Code')),
            'desc' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Description')),
            'status_val' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Status')),
            
        );
    }

    
   public function Check_Plan($attribute, $params) {
        if (!empty($this->plan_name)) {
           $arrVehicleRepair = Plan_Types::model()->isPlanNameExist($this->plan_name);
            if (!empty($arrVehicleRepair)) {
                $this->addError('plan_name', $this->plan_name . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Repair Name')));
                return FALSE;
            } else {
                return TRUE;
            }
        
        }
    }
     public function Check_Code($attribute, $params) {
        if (!empty($this->code)) {
           $arrVehicleRepair = Plan_Types::model()->isPlanCodeExist($this->code);
            if (!empty($arrVehicleRepair)) {
                $this->addError('code', $this->code . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Code')));
                return FALSE;
            } else {
                return TRUE;
            }
        
        }
    }
    
    public function Check_Desc($attribute, $params) {
        if (!empty($this->desc)) {
           $arrVehicleRepair = Plan_Types::model()->isPlanDescExist($this->desc);
            if (!empty($arrVehicleRepair)) {
                $this->addError('desc', $this->desc . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Description')));
                return FALSE;
            } else {
                return TRUE;
            }
        
        }
    }
    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    /*public function attributeLabels() {
        return array(
            'vehicle_type' => Yii::t('app', 'addservice.form.veh_type'),
            'car_service_type' => Yii::t('app', 'addservice.form.car_service'),
            'servicename' => Yii::t('app', 'addservice.form.serv_name'),
            'user' => Yii::t('app', 'addservice.form.user'),
        );
    }*/

}
