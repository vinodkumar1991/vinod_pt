<?php

class SelfVehicleImage extends CActiveRecord {

    public $strTable = 'self_vehicles_images';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param string $strUsername
     * @return array It will return VehicleTypes data
     */
    public static function create($arrSelfVehicleImages) {
        
        $intVehImageId = null;
        if(!empty($arrSelfVehicleImages)){
            foreach($arrSelfVehicleImages as $arrEleImage){
                $objectVehImage = new SelfVehicleImage();
                $objectVehImage->self_vehicles_id = $arrEleImage['self_vehicles_id'];
                $objectVehImage->path = $arrEleImage['original_name'];
                $objectVehImage->is_parent = $arrEleImage['is_parent'];

                if ($objectVehImage->save())
                {
                    $intVehImageId = $objectVehImage->id;
                }        
        }
    }
        
        return $intVehImageId;
    }

}
