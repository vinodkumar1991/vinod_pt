<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class VehicleForm extends CFormModel {

    public $vehicle_types;
    public $vehicle_categories;
    public $brand;
    public $brandModel;
    public $modelYear;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('vehicle_types,vehicle_categories,brand,brandModel,modelYear', 'required'),
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
            'vehicleImage' => Yii::t('vehicle', 'vehicle.form.image'),
        );
    }

}
