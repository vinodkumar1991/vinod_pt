<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class RepairListForm extends CFormModel {

    // public $vehicle_type;
    public $repairs_id;
    public $repair_list_name;
    public $repair_list_code;
    public $repair_list_desc;
    public $repair_list_status;
    public $id;

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('repairs_id,repair_list_name,repair_list_code,repair_list_status', 'required'),
            array('repair_list_desc', 'safe'),
            array('repair_list_name', 'isNameExist'),
            array('repair_list_code', 'isCodeExist'),
        );
    }

    public function attributeLabels() {
        return array(
            'repairs_id' => 'Repair',
            'repair_list_name' => 'Name',
            'repair_list_code' => 'Code',
            'repair_list_desc' => 'Description',
            'repair_list_status' => 'Status',
        );
    }

    public function isNameExist() {
        if (!empty($this->repair_list_name)) {
            $arrRepairList = RepairLists::model()->isNameExist($this->repair_list_name,$this->id);
            if (!empty($arrRepairList)) {
                $this->addError('repair_list_name', $this->repair_list_name . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Name')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function isCodeExist() {
        if (!empty($this->repair_list_code)) {
            $arrRepairList = RepairLists::model()->isCodeExist($this->repair_list_code,$this->id);
            if (!empty($arrRepairList)) {
                $this->addError('repair_list_code', $this->repair_list_code . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Code')));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

}
