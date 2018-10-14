<?php

class City_Model extends CActiveRecord {

    public $strTable = 'MPS_CITIES';
   

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
   
      
    public static function FetchCityDetails($state_id) {
        
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('mc.id,mc.name');
        $objectDB->from('MPS_CITIES as mc');
        $objectDB->where('mc.state_id=:state_id', array(':state_id'=>$state_id));
        $arrCities = $objectDB->queryAll();
        return $arrCities;
    }
    
    

}
