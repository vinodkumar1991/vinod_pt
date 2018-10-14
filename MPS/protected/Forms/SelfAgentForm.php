
<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class SelfAgentForm extends CFormModel {

   // public $vehicle_type;
    public $agency_name;
    public $scountry;
    public $sstate;
    public $scity;
    public $sarea;
    public $saddress;
    public $semail;
    public $userfile;
    public $contact_no;
    public $szipcode;
    public $susername;
    public $spassword;
    public $scpassword;
    
    
     

    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() {
        return array(
           array('agency_name,scountry,sstate,scity,sarea,saddress,semail,contact_no,szipcode,susername,spassword,scpassword', 'required'),
           array('agency_name', 'Check_Agency'),
           array('scountry', 'Check_Country'),
           array('semail', 'Check_Email'),
           array('susername', 'Check_User'),
           array('contact_no', 'Check_Contact'),
           array('userfile', 'isValidImage'), 
           array('spassword, spassword', 'required', 'on'=>'insert'),
           array('spassword, spassword', 'length', 'min'=>5, 'max'=>40),
           array('scpassword', 'compare', 'compareAttribute'=>'spassword'),
           //array('semail','semail', 'checkMX' => true),
           array('semail','safe'),            
            );
    }
    
    public function attributeLabels() {
        return array(
            'agency_name' => Yii::t('vehicle', 'common.form.type',array('{alias}' => 'Agent Name')),
            'scountry' => Yii::t('vehicle', 'common.form.type',array('{alias}' => 'Select Country')),
            'sstate' => Yii::t('vehicle', 'common.form.type',array('{alias}' => 'Select State')),
            'scity' => Yii::t('vehicle', 'common.form.type',array('{alias}' => 'Select City')),
            'saddress' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Enter Address')),
            
            'semail' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Enter Email')),
            'contact_no' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Enter Contact')),
            'szipcode' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Enter ZipCode')),
            'susername' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Enter UserName')),
            'spassword' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Enter Password')),
            'spassword' => Yii::t('vehicle', 'common.form.name',array('{alias}' => 'Enter Password')),
            
        );
    }
    public function Check_Agency($attribute, $params) {
        if (!empty($this->agency_name)) {
           $strAgent = Agent::model()->isAgentNameExist($this->agency_name);
            if (!empty($strAgent)) {
                $this->addError('agency_name', $this->agency_name . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Repair Name')));
                return FALSE;
            } else {
                return TRUE;
            }
        
        }
    }
    public function Check_Country($attribute, $params) {
        if (empty($this->scountry)) {
            
          $this->addError('scountry', $this->scountry . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Sub Repair Name')));
                return FALSE;
            } else {
                return TRUE;
            }
        
        }
        
        public function Check_User($attribute, $params) {
        if (!empty($this->susername)) {
           $strUser = Users::model()->IsUserAccountExist($this->susername);
            if (!empty($strUser)) {
                $this->addError('susername', $this->susername . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'User Name')));
                return FALSE;
            } else {
                return TRUE;
            }
        
        }
    }
    
    public function Check_Email($attribute, $params) {
        if (!empty($this->semail)) {
           $strEmail = Agent::model()->IsEmailId($this->semail);
            if (!empty($strEmail)) {
                $this->addError('semail', $this->semail . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Email Address')));
                return FALSE;
            } else {
                return TRUE;
            }
        
        }
    }
    public function Check_Contact($attribute, $params) {
        if (!empty($this->contact_no)) {
           $strContanct = Agent::model()->isContactExist($this->contact_no);
            if (!empty($strContanct)) {
                $this->addError('contact_no', $this->contact_no . ' ' . Yii::t('vehicle', 'common.form.exist', array('{alias}' => 'Contact Number')));
                return FALSE;
            } else {
                return TRUE;
            }
        
        }
    }
    public function isValidImage($attribute, $params) {
        if (isset($_FILES['userfile'])) {
            $arrValidExtensions = array('jpg', 'jpeg', 'png', 'gif');
            $strImageExtension = strtolower(pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION));
            if (in_array($strImageExtension, $arrValidExtensions)) {
                return TRUE;
            } else {
                $this->addError('userfile', $this->userfile . ' ' . Yii::t('vehicle', 'common.form.invalidImage'));
                return FALSE;
            }
        }
    }
    
   
   
    
    
    
    
    

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
   

}


