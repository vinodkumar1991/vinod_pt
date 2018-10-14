<?php

class State_Model extends CActiveRecord {

    public $strTable = 'MPS_STATES';
   

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
   
      
    public static function FetchStateDetails($country_id) {
        
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ms.id,ms.name');
        $objectDB->from('MPS_STATES as ms');
        $objectDB->where('ms.country_id=:country_id', array(':country_id'=>$country_id));
        $arrStates = $objectDB->queryAll();
        return $arrStates;
    }
    
    

}
