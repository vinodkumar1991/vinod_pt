<?php

class Country_Model extends CActiveRecord {

    public $strTable = 'MPS_COUNTRIES';
   

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
   
      public static function FetchCountryDetails() {
        
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('mc.id,mc.name');
        $objectDB->from('MPS_COUNTRIES as mc');
        $arrCountries = $objectDB->queryAll();
        return $arrCountries;
    }
    public static function FetchStateDetails($country_id) {
        
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('mc.id,mc.name');
        $objectDB->from('MPS_COUNTRIES as mc');
        $arrCountries = $objectDB->queryAll();
        return $arrCountries;
    }
    
    

}
