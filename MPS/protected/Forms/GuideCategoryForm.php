<?php

/**
 * @author Digital Today
 * @ignore It will handle the form validations
 */
class GuideCategoryForm extends CFormModel {

    public $guide_category_name;
    public $guide_category_code;
    public $guide_category_description;
    public $guide_category_status;

    public function rules() {
        return array(
            array('guide_category_name, guide_category_code,guide_category_status', 'required'),
            array('guide_category_name, guide_category_code', 'filter', 'filter' => 'trim'),
            array('guide_category_description,guide_category_status', 'safe'),
            array('guide_category_name', 'isNameExist'),
            array('guide_category_code', 'isCodeExist'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'guide_category_name' => 'Name',
            'guide_category_code' => 'Code',
            'guide_category_description' => 'Description',
            'guide_category_status' => 'Status',
        );
    }

    public function isNameExist($attribute, $params) {
        if (!empty($this->guide_category_name)) {
            $arrVehicleBrand = GuideCategory::model()->isNameExist($this->guide_category_name);
            if (!empty($arrVehicleBrand)) {
                $this->addError('guide_category_name', $this->guide_category_name . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Category Name')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isCodeExist($attribute, $params) {
        if (!empty($this->guide_category_code)) {
            $arrVehicleBrandCode = GuideCategory::model()->isCodeExist($this->guide_category_code);
            if (!empty($arrVehicleBrandCode)) {
                $this->addError('guide_category_code', $this->guide_category_code . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Category code')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

}
