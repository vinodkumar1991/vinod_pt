<?php

/*
 *
 * @author Ctel
 * @ignore It will handle the form validations
 */

class AddSelfdriveForm extends CFormModel {

    public $vehicle_types_id;
    public $vehicle_classes_id;
    public $vehicle_variants_id;
    public $vehicle_brand_models_id;
    public $seating;
    public $loc_adrs;
    public $latitude;
    public $longitude;
    public $location;
    public $priceperhr;
    public $extrarate;
    public $deposit;
    public $kmperhr;
    public $veh_features;
    public $vehicle_image;
    public $vehicle_multiple_images;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('vehicle_types_id,vehicle_classes_id,kmperhr,vehicle_variants_id,loc_adrs,vehicle_brand_models_id,seating,location,priceperhr,extrarate,deposit,veh_features', 'required'),
            array('vehicle_types_id,vehicle_classes_id,vehicle_variants_id,vehicle_brand_models_id', 'filter', 'filter' => 'trim'),
            array('vehicle_image', 'isValidImage', 'parameter' => 'vehicle_image'),
            array('veh_features', 'safe'),
            array('vehicle_multiple_images', 'isValidImage', 'parameter' => 'vehicle_multiple_images'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'vehicle_types_id' => Yii::t('vehicle', 'common.form.type', array('{alias}' => 'Select Type')),
            'vehicle_classes_id' => Yii::t('vehicle', 'common.form.type', array('{alias}' => 'Select Category')),
            'kmperhr' => Yii::t('vehicle', 'common.form.name', array('{alias}' => 'Select KM Per Hour')),
            'vehicle_variants_id' => Yii::t('vehicle', 'common.form.type', array('{alias}' => 'Select Variant')),
            'veh_features' => 'Feature',
            'loc_adrs' => Yii::t('vehicle', 'common.form.name', array('{alias}' => 'Enter Address')),
            'vehicle_brand_models_id' => Yii::t('vehicle', 'common.form.type', array('{alias}' => 'Select Model')),
            'seating' => Yii::t('vehicle', 'common.form.name', array('{alias}' => 'Enter Seating Capacity')),
            'priceperhr' => Yii::t('vehicle', 'common.form.name', array('{alias}' => 'Enter Price Per Hour')),
            'extrarate' => Yii::t('vehicle', 'common.form.name', array('{alias}' => 'Enter Extra Per Rate')),
            'deposit' => Yii::t('vehicle', 'common.form.name', array('{alias}' => 'Enter Security Deposit')),
        );
    }

    public function isValidImage($attribute, $params) {
        $strFileName = $params['parameter'];
        $strMulFileName = $_FILES['vehicle_multiple_images']['name'];
        $booleanIsMatch = 0;
        /* if(!empty($_FILES[$strFileName]['name']))
          { */
        if (is_array($_FILES[$strFileName])) {



            foreach ($strMulFileName as $key => $value) {


                $booleanIsMatch = $this->isMulMatch($_FILES['vehicle_multiple_images']['name'][$key], $_FILES['vehicle_multiple_images']['size'][$key]);
            }
        } else {
            $strOriginalFileName = $_FILES[$strFileName]['name'];
            $booleanIsMatch = $this->isMatch($strFileName);
        }

        if ($booleanIsMatch) {
            return TRUE;
        } else {
            $this->addError($strFileName, $strFileName . ' ' . Yii::t('vehicle', 'common.form.invalidImage'));
            return FALSE;
        }
        // }
        /* else {
          $this->addError($strFileName, 'Document is required.');
          return FALSE;
          } */
    }

    public function isMatch($strFileName) {

        $arrValidExtensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
        $strImageExtension = strtolower(pathinfo($strFileName, PATHINFO_EXTENSION));
        $intFileSize = $_FILES[$strFileName]['size'];
        //Less than 2 MB
        if (in_array($strImageExtension, $arrValidExtensions) && $intFileSize < 2097152) { // 2 MB
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isMulMatch($filename, $size) {
        $arrValidExtensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
        $strImageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $intFileSize = $size;
        //Less than 2 MB
        if (in_array($strImageExtension, $arrValidExtensions) && $intFileSize < 2097152) { // 2 MB
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
