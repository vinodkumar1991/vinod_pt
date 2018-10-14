<?php

class SelfDriveAgency_Model extends CActiveRecord {

    public $strTable = 'MPS_SELFDRIVEAGENCY_DETAILS';
   

    public function tableName() {
        return $this->strTable;
      
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    

    /**
     * @author Ctel
     * @param array $arrCustomer
     * @return integer It will return an integer response
     */
   
      
    public static function CreateSelfDriveDetails($objSelfDetails) {
        
        $intSelfDriveId = NULL;
       
       
        $objSelfDrive = new SelfDriveAgency_Model();
        $objSelfDrive->self_unique_id =$objSelfDetails['slfid'];
        $objSelfDrive->agency_name = $objSelfDetails['agency_name'];
        $objSelfDrive->country = $objSelfDetails['scountry'];
        $objSelfDrive->img_path = $_FILES['userfile']['name'];
        
        $objSelfDrive->state = $objSelfDetails['sstate'];
        $objSelfDrive->city = $objSelfDetails['scity'];
       // $objSelfDrive->sector = $objSelfDetails['sarea'];
        $objSelfDrive->zipcode = $objSelfDetails['szipcode'];
        $objSelfDrive->contact_num = $objSelfDetails['contact_no'];
        $objSelfDrive->email = $objSelfDetails['semail'];
        $objSelfDrive->img_path = $objSelfDetails['created_by'];
        $objSelfDrive->address = $objSelfDetails['saddress'];
      
        $objSelfDrive->save();
        
        if ($objSelfDrive->save()) {
            $intSelfDriveId = $objSelfDrive->id;
        }
        return $intSelfDriveId;
    }
    
    

}
