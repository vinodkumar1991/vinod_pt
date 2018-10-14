<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class BrandForm extends CFormModel {

    public $vehicle_types;
    public $brand_name;
    public $brand_code;
    public $brand_description;
    public $vehicle_logo;
    public $brand_status;

    /**
     * @author Ctel
     * @return array It will return array of errors if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('vehicle_types, brand_name,brand_code,brand_status', 'required'),
            array('vehicle_types, brand_name,brand_code,brand_description', 'filter', 'filter' => 'trim'),
            array('brand_description', 'safe'),
            array('vehicle_logo', 'isValidImage'),
            //array('brand_name', 'isBrandExist'), //Need to change
            array('brand_code', 'isBrandCodeExist'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'vehicle_types' => Yii::t('vehicle', 'common.form.type', array('{alias}' => 'Vehicle')),
            'brand_name' => Yii::t('vehicle', 'common.form.name', array('{alias}' => 'Name')),
            'brand_code' => Yii::t('vehicle', 'common.form.name', array('{alias}' => 'Code')),
            'brand_description' => Yii::t('vehicle', 'common.form.name', array('{alias}' => 'Brand')),
            'vehicle_logo' => Yii::t('vehicle', 'common.form.logo', array('{alias}' => 'Logo')),
            'brand_status' => Yii::t('vehicle', 'common.form.type', array('{alias}' => 'Status')),
        );
    }

    public function isBrandExist($attribute, $params) {
        if (!empty($this->brand_name)) {
            $arrVehicleBrand = VehicleBrands::model()->isBrandExist($this->brand_name);
            if (!empty($arrVehicleBrand)) {
                $this->addError('brand_name', $this->brand_name . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Brand name')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isBrandCodeExist($attribute, $params) {
        if (!empty($this->brand_code)) {
            $arrVehicleBrandCode = VehicleBrands::model()->isBrandCodeExist($this->brand_code);
            if (!empty($arrVehicleBrandCode)) {
                $this->addError('brand_code', $this->brand_code . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Brand code')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isValidImage($attribute, $params) {
        if (isset($_FILES['vehicle_logo'])) {
            $arrValidExtensions = array('jpg', 'jpeg', 'png', 'gif');
            $strImageExtension = strtolower(pathinfo($_FILES['vehicle_logo']['name'], PATHINFO_EXTENSION));
            if (in_array($strImageExtension, $arrValidExtensions)) {
                return TRUE;
            } else {
                $this->addError('vehicle_logo', $this->vehicle_logo . ' ' . Yii::t('vehicle', 'common.form.invalidImage'));
                return FALSE;
            }
        }
    }

}
