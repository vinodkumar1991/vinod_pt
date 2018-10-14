<?php

/**
 * @author Digital Today
 * @ignore It will handle the form validations
 */
class VehiclesFeatureForm extends CFormModel {

    public $vehicle_feature_name;
    public $id;
    public $vehicle_feature_code;
    public $vehicle_feature_description;
    public $vehicle_feature_status;
    public $vehicle_feature_image;
    public $vehicle_id;

    public function rules() {
        return array(
            array('vehicle_feature_name,vehicle_feature_code,vehicle_feature_status,vehicle_id', 'required', 'message' => '{attribute} is required.'),
            array('vehicle_feature_name, vehicle_feature_code', 'filter', 'filter' => 'trim'),
            array('vehicle_feature_description,vehicle_feature_status', 'safe'),
            array('vehicle_feature_name', 'isNameExist'),
            array('vehicle_feature_code', 'isCodeExist'),
            array('vehicle_feature_image', 'isValidImage', 'parameter' => 'vehicle_feature_image'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'vehicle_feature_name' => 'Name',
            'vehicle_feature_code' => 'Code',
            'vehicle_feature_description' => 'Description',
            'vehicle_feature_status' => 'Status',
            'vehicle_feature_image' => 'Image',
            'vehicle_id' => 'Vehicle Type',
        );
    }

    public function isNameExist($attribute, $params) {
        if (!empty($this->vehicle_feature_name)) {
            $arrVehicleFeature = VehicleFeatures::model()->isNameExist($this->vehicle_feature_name, $this->id);
            if (!empty($arrVehicleFeature)) {
                $this->addError('vehicle_feature_name', $this->vehicle_feature_name . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Feature Name')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isCodeExist($attribute, $params) {
        if (!empty($this->vehicle_feature_code)) {
            $arrVehicleFeatureCode = VehicleFeatures::model()->isCodeExist($this->vehicle_feature_code, $this->id);
            if (!empty($arrVehicleFeatureCode)) {
                $this->addError('vehicle_feature_code', $this->vehicle_feature_code . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Feature code')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isValidImage($attribute, $params) {
        $strFileName = $params['parameter'];
        if (isset($_FILES[$strFileName]['name']) && !empty($_FILES[$strFileName]['name']) && empty($this->id)) {
            $strOriginalFileName = $_FILES[$strFileName]['name'];
            $booleanIsMatch = $this->isMatch($strFileName);
            if ($booleanIsMatch) {
                return TRUE;
            } else {
                $this->addError($strFileName, Yii::t('vehicle', 'common.form.invalidImage'));
                return FALSE;
            }
        } elseif (empty($this->id)) {
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

}
