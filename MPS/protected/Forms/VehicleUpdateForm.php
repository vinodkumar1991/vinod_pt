<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class VehicleUpdateForm extends CFormModel {

    public $id;
    public $vehicle_types;
    public $vehicle_categories;
    public $brand;
    public $brandModel;
    public $modelYear;
    public $vehicle_status;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('vehicle_types,vehicle_categories,brand,brandModel,modelYear,', 'required'),
            array('vehicle_status,','safe'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'vehicle_types' => 'Vehicle Type',
            'category' => Yii::t('vehicle', 'vehicle.form.category'),
            'brand' => Yii::t('vehicle', 'vehicle.form.brand'),
            'brandModel' => Yii::t('vehicle', 'vehicle.form.model'),
            'modelYear' => Yii::t('vehicle', 'vehicle.form.year'),
            'vehicle_status' =>yii::t('status', 'vehicle.form.status'),
            
        );
    }

}

