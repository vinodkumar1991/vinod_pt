<?php

class AssignBrandModelForm extends CFormModel
{

    public $id;

    public $vehicle_type_id;

    public $vehicle_brand_id;

    public $vehicle_model_id;

    public $vehicle_category_id;

    public $status;

    public function rules()
    {
        return array(
            array(
                'vehicle_brand_id,vehicle_model_id,vehicle_category_id,vehicle_type_id,status',
                'required',
                'message' => '{attribute} is required.'
            ),
            array(
                'vehicle_category_id',
                'isAlreadyAssigned'
            )
        );
    }

    public function isAlreadyAssigned($attribute, $params)
    {
        if (! empty($this->vehicle_brand_id)) {
            $arrResponse = VehicleCategoryBrandModels::vehicleBrandModelCategories(array(
                'brand_id' => $this->vehicle_brand_id,
                'model_id' => $this->vehicle_model_id,
                'category_id' => $this->vehicle_category_id
            ));
            if (! empty($arrResponse)) {
                $this->addError('vehicle_category_id', 'This brand and model combination already Assigned');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function attributeLabels()
    {
        return array(
            'vehicle_type_id' => 'Vehicle Type',
            'vehicle_brand_id' => 'Vehicle Brand',
            'vehicle_model_id' => 'Vehicle Model',
            'vehicle_category_id' => 'Vehicle Category',
            'status' => 'Status'
        );
    }
}
