<?php

class AgentVehicleForm extends CFormModel {

    public $vehicle_type_id;
    public $vehicle_brand_id;
    public $vehicle_brand_model_id;
    public $vehicle_class_id;
    public $vehicle_seating_capacity;
    public $vehicle_variant_id;
    public $vehicle_features;
    public $vehicle_primary_image;
    public $vehicle_multiple_images;
    public $create_agent_vehicle;
    public $vehicle_description;
    public $vehicle_agent_id;
    public $vehicle_registration_number;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('vehicle_type_id,vehicle_brand_id,vehicle_brand_model_id,vehicle_class_id,vehicle_seating_capacity,vehicle_variant_id,vehicle_agent_id,vehicle_registration_number', 'required', 'message' => '{attribute} is required.'),
            array('create_agent_vehicle,vehicle_description,vehicle_registration_number', 'safe'),
            array('vehicle_description', 'filter', 'filter' => 'trim'),
            array('vehicle_features', 'isValidFeature'),
            array('vehicle_primary_image', 'isValidImage', 'parameter' => 'vehicle_primary_image'),
            array('vehicle_multiple_images', 'isValidMultipleImages', 'parameter' => 'vehicle_multiple_images'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'vehicle_type_id' => 'Vehicle',
            'vehicle_brand_id' => 'Vehicle Brand',
            'vehicle_brand_model_id' => 'Vehicle Model',
            'vehicle_class_id' => 'Vehicle Category',
            'vehicle_seating_capacity' => 'Seating Capacity',
            'vehicle_variant_id' => 'Vehicle Variant',
            'vehicle_features' => 'Features',
            'vehicle_primary_image' => 'Vehicle Primary Image',
            'vehicle_multiple_images' => 'Vehicle Images',
            'vehicle_agent_id' => 'Agent',
        );
    }

    public function isValidFeature($attribute, $params) {
        $arrVehicleFeatures = $this->vehicle_features;
        if (!empty($arrVehicleFeatures[0])) {
            return TRUE;
        } else {
            $this->addError('vehicle_features', 'Vehicle Features Is Required.');
        }
    }

    public function isValidMultipleImages($attribute, $params) {
        $strFileName = $params['parameter'];
        $arrMultiFiles = $_FILES[$strFileName]['name'];
        $booleanIsMatch = 0;
        if (is_array($_FILES[$strFileName]) && !empty($arrMultiFiles[0])) {
            foreach ($arrMultiFiles as $key => $value) {
                $booleanIsMatch = $this->isMulMatch($_FILES['vehicle_multiple_images']['name'][$key], $_FILES['vehicle_multiple_images']['size'][$key]);
            }
        }
        if ($booleanIsMatch) {
            return TRUE;
        } else {
            $this->addError($strFileName, Yii::t('vehicle', 'common.form.invalidImage'));
            return FALSE;
        }
    }

    public function isValidImage($attribute, $params) {
        $strFileName = $params['parameter'];
        if (isset($_FILES[$strFileName]['name']) && !empty($_FILES[$strFileName]['name'])) {
            $strOriginalFileName = $_FILES[$strFileName]['name'];
            $booleanIsMatch = $this->isMatch($strFileName);
            if ($booleanIsMatch) {
                return TRUE;
            } else {
                $this->addError($strFileName, Yii::t('vehicle', 'common.form.invalidImage'));
                return FALSE;
            }
        } else {
            $this->addError($strFileName, Yii::t('vehicle', 'common.form.invalidImage'));
            return FALSE;
        }
    }

    public function isMatch($strFileName) {
        $arrValidExtensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
        $strOriginalFileName = $_FILES[$strFileName]['name'];
        $strImageExtension = strtolower(pathinfo($strOriginalFileName, PATHINFO_EXTENSION));
        $intFileSize = $_FILES[$strFileName]['size'];
        if (in_array($strImageExtension, $arrValidExtensions) && $intFileSize < 2097152) { // 2 MB
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isMulMatch($strFileName, $intFileSize) {
        $arrValidExtensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
        $strImageExtension = strtolower(pathinfo($strFileName, PATHINFO_EXTENSION));
        if (in_array($strImageExtension, $arrValidExtensions) && $intFileSize < 2097152) { // 2 MB
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
