<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class BookOthersForm extends CFormModel {

    public $additional_information;
    public $other_name;
    public $other_mobile;
    public $others_file;

    /**
     * @author Ctel
     * @return array It will return array of errors if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('additional_information,other_name,other_mobile', 'required'),
            array('others_file', 'isValidImage', 'on' => 'Others'),
        );
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() {
        return array(
            'additional_information' => 'Additional Information',
            'other_name' => 'Name',
            'other_mobile' => 'Mobile',
            'others_file' => 'File',
        );
    }

    public function isValidImage($attribute, $params) {
        if (isset($_FILES['others_file'])) {
            $arrValidExtensions = array('mp4', 'mp3', 'wma', 'gif', 'pjpeg');
            $strImageExtension = strtolower(pathinfo($_FILES['others_file']['name'], PATHINFO_EXTENSION));
            //if (in_array($strImageExtension, $arrValidExtensions)) {
            return TRUE;
            //} else {
            //  $this->addError('others_file', $this->others_file . ' ' . Yii::t('app', 'customer.form.invalidFile'));
            // return FALSE;
            // }
        }
    }

}
