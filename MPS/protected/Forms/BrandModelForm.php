<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class BrandModelForm extends CFormModel {

    public $vehicle_types;
    public $vehicle_brand;
    public $model_name;
    public $model_code;
    public $model_description;
    public $vehicle_model_logo;
    public $model_status;

    /**
     * @author Ctel
     * @return array It will return array of errors if not satisfied the criteria
     */
    public function rules() {
        return array(
            //array('vehicle_types, vehicle_brand,model_name,model_code,model_status', 'required'),
            array('vehicle_types, vehicle_brand,model_name,model_status', 'required'),
            array('vehicle_types, vehicle_brand,model_name,model_code,model_status,model_description', 'filter', 'filter' => 'trim'),
            array('model_description', 'safe'),
            array('vehicle_model_logo', 'isValidImage'),
                //array('model_name', 'isModelExist'),
                // array('model_code', 'isModelCodeExist'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'vehicle_types' => Yii::t('vehicle', 'common.form.type', array('{alias}' => 'Vehicle')),
            'vehicle_brand' => Yii::t('vehicle', 'common.form.type', array('{alias}' => 'Vehicle Brand')),
            'model_name' => Yii::t('vehicle', 'common.form.name', array('{alias}' => 'Name')),
            'model_code' => Yii::t('vehicle', 'common.form.name', array('{alias}' => 'Code')),
            'model_description' => Yii::t('vehicle', 'common.form.name', array('{alias}' => 'Brand')),
            'vehicle_model_logo' => Yii::t('vehicle', 'common.form.logo', array('{alias}' => 'Logo')),
            'model_status' => Yii::t('vehicle', 'common.form.type', array('{alias}' => 'Status')),
        );
    }

    public function isModelExist($attribute, $params) {
        if (!empty($this->model_name)) {
            $arrVehicleBrand = VehicleBrandModels::model()->isModelExist($this->model_name);
            if (!empty($arrVehicleBrand)) {
                $this->addError('model_name', $this->model_name . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Model name')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isModelCodeExist($attribute, $params) {
        if (!empty($this->model_code)) {
            $arrVehicleBrandCode = VehicleBrandModels::model()->isModelCodeExist($this->model_code);
            if (!empty($arrVehicleBrandCode)) {
                $this->addError('model_code', $this->model_code . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Model code')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isValidImage($attribute, $params) {
        if (isset($_FILES['vehicle_model_logo'])) {
            $arrValidExtensions = array('jpg', 'jpeg', 'png', 'gif');
            $strImageExtension = strtolower(pathinfo($_FILES['vehicle_model_logo']['name'], PATHINFO_EXTENSION));
            if (in_array($strImageExtension, $arrValidExtensions)) {
                return TRUE;
            } else {
                $this->addError('vehicle_model_logo', $this->vehicle_model_logo . ' ' . Yii::t('vehicle', 'common.form.invalidImage'));
                return FALSE;
            }
        }
    }

}
