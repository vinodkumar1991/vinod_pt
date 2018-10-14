<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class AddServicePackageForm extends CFormModel {

   // public $vehicle_type;
    public $repairlist_id;
    public $subrepairlist_id;
    public $veh_type;
    public $veh_cat;
    public $service_type;
    public $is_rec;
    public $plan_type;
    public $cost;
    public $status_val;
    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(

           array('repairlist_id,subrepairlist_id,veh_type,veh_cat,service_type,cost,plan_type,status_val', 'required'),
         );
    }

  
    

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'repairlist_id' => Yii::t('vehicle', 'common.form.type',array('{alias}' => 'Repair Name')),
            'subrepairlist_id' => Yii::t('vehicle', 'common.form.type',array('{alias}' => 'RepairList Name')),
            'veh_type' => Yii::t('vehicle', 'common.form.type',array('{alias}' => 'Vehicle')),
            'veh_cat' => Yii::t('vehicle', 'common.form.type',array('{alias}' => 'Vehicle category')),
            'service_type' => Yii::t('vehicle', 'common.form.type',array('{alias}' => 'Service')),
            'is_rec' => Yii::t('vehicle', 'common.form.type',array('{alias}' => 'Recommended Status')),
            'plan_type' => Yii::t('vehicle', 'common.form.type',array('{alias}' => 'Plan')),
            'cost' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Cost')),
            'status_val' => Yii::t('vehicle', 'common.form.type',array('{alias}' => 'Status')),
        );
    }
        
    
    public function SelectRepairList($attribute, $params) {
        if (empty($this->repairlist_id)) {
            
          $this->addError('repairlist_id', $this->repairlist_id . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Sub Repair Name')));
                return FALSE;
            } else {
                return TRUE;
            }
        
        }
    
}
