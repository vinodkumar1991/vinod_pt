<?php

/**
 * @author Digital Today
 * @ignore It will handle the form validations
 */
class GuideSubCategoryForm extends CFormModel {

    public $guide_category_id;
    public $guide_sub_category_name;
    public $guide_sub_category_code;
    public $guide_sub_category_description;
    public $guide_sub_category_logo;
    public $guide_sub_category_status;

    public function rules() {
        return array(
            array('guide_sub_category_name, guide_sub_category_code,guide_sub_category_status,guide_category_id', 'required'),
            array('guide_sub_category_name, guide_sub_category_code', 'filter', 'filter' => 'trim'),
            array('guide_sub_category_description,guide_sub_category_status', 'safe'),
            array('guide_sub_category_name', 'isNameExist'),
            array('guide_sub_category_code', 'isCodeExist'),
            array('guide_sub_category_logo', 'isValidImage'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'guide_sub_category_name' => 'Name',
            'guide_sub_category_code' => 'Code',
            'guide_sub_category_description' => 'Description',
            'guide_sub_category_logo' => 'Image',
            'guide_sub_category_status' => 'Status',
        );
    }

    public function isNameExist($attribute, $params) {
        if (!empty($this->guide_sub_category_name)) {
            $arrVehicleBrand = GuideSubCategory::model()->isNameExist($this->guide_sub_category_name,$this->guide_category_id);
            if (!empty($arrVehicleBrand)) {
                $this->addError('guide_sub_category_name', $this->guide_sub_category_name . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Category Name')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isCodeExist($attribute, $params) {
        if (!empty($this->guide_sub_category_code)) {
            $arrVehicleBrandCode = GuideSubCategory::model()->isCodeExist($this->guide_sub_category_code,$this->guide_category_id);
            if (!empty($arrVehicleBrandCode)) {
                $this->addError('guide_sub_category_code', $this->guide_sub_category_code . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Category code')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isValidImage($attribute, $params) {
        if (isset($_FILES['guide_sub_category_logo'])) {
            $arrValidExtensions = array('jpg', 'jpeg', 'png', 'gif');
            $strImageExtension = strtolower(pathinfo($_FILES['guide_sub_category_logo']['name'], PATHINFO_EXTENSION));
            if (in_array($strImageExtension, $arrValidExtensions)) {
                return TRUE;
            } else {
                $this->addError('guide_sub_category_logo', $this->guide_sub_category_logo . ' ' . Yii::t('vehicle', 'common.form.invalidImage'));
                return FALSE;
            }
        }
    }

}
