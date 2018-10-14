<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class VehicleCategoryForm extends CFormModel {

   // public $vehicle_type;
    public $veh_type;
    public $category_name;
    public $code;
    public $desc;
    public $status_val;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
           array('veh_type,category_name,code,status_val', 'required'),
           array('category_name', 'check_CategoryName'),
             array('code', 'check_Code'),
             array('desc', 'check_Description'),
               //array('servicename', 'required')
            );
    }

  
    
public function attributeLabels() {
        return array(
            'veh_type' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Vehicle')),
            'category_name' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Category Name')),
            'code' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Code')),
            'desc' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Description')),
            'status_val' => Yii::t('vehicle', 'common.form.type',array('{alias}' => 'Status')),
        );
    }
    
     public function check_CategoryName($attribute, $params) {
        if (empty($this->category_name)) {
           $arrVehicleCatName = VehicleCategories::model()->iscategoryNameExist($this->category_name);
            if (!empty($arrVehicleCatName)) {
                $this->addError('category_name', $this->category_name . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Category Name')));
                return FALSE;
           } 
            else {

                 return TRUE;
            }
        
        }
    }
    public function check_Code($attribute, $params) {
        if (!empty($this->code)) {
           $arrVehicleCatCode = VehicleCategories::model()->isCategoryCodeExist($this->code);
            if (!empty($arrVehicleCatCode)) {
                $this->addError('code', $this->code . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Code')));
                return FALSE;
            } else {
                return TRUE;
            }
        
        }
    }
    
    public function check_Description($attribute, $params) {
        if (!empty($this->desc)) {
           $arrVehicleCatdesc = VehicleCategories::model()->isCategoryDescExist($this->desc);
            if (!empty($arrVehicleCatdesc)) {
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
