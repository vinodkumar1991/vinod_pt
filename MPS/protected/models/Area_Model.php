<?php

class Area_Model extends CActiveRecord {

    public $strTable = 'MPS_AREAS';
   

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
   
      
    public static function FetchAreaDetails($city_id) {
        
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('area.id,area.name');
        $objectDB->from('MPS_AREAS as area');
        $objectDB->where('area.city_id=:city_id', array(':city_id'=>$city_id));
        $arrArea = $objectDB->queryAll();
        return $arrArea;
    }
    
    

}
