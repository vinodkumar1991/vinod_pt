<?php

/**
 * @author Digital Today
 * @ignore It will handle the form validations
 */
class RepairForm extends CFormModel {

    public $repair_name;
    public $repair_code;
    public $repair_description;
    public $repair_status;
    public $id;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('repair_name,repair_code,repair_status', 'required'),
            array('repair_description', 'safe'),
            array('repair_name', 'isNameExist'),
            array('repair_code', 'isCodeExist'),
        );
    }

    public function attributeLabels() {
        return array(
            'repair_name' => 'Name',
            'repair_code' => 'Code',
            'repair_description' => 'Description',
            'repair_status' => 'Status'
        );
    }

    public function isNameExist() {
        if (!empty($this->repair_name)) {
            $arrRepair = Repairs::model()->isNameExist($this->repair_name,$this->id);
            if (!empty($arrRepair)) {
                $this->addError('repair_name', $this->repair_name . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Name')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isCodeExist() {
        if (!empty($this->repair_code)) {
            $arrRepair = Repairs::model()->isCodeExist($this->repair_code,$this->id);
            if (!empty($arrRepair)) {
                $this->addError('repair_code', $this->repair_code . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Code')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

}
