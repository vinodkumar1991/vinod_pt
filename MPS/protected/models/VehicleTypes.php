<?php

class VehicleTypes extends CActiveRecord 
{
    public $strTable = 'vehicle_types';
    public function tableName()
    {
            return $this->strTable;
    }

    public static function model($className = __CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @author Ctel
     * @param string $strUsername
     * @return array It will return VehicleTypes data
     */
   public static function getVehicleTypes($intStatus = 1, $intVehicleTypes = NULL) 
    {
            $arrVehicleTypes = array();           
            $objectDB = Yii::app()->db->createCommand();
            $objectDB->select('v.id,v.name,v.code');
            $objectDB->from('vehicle_types as v');
            if (!empty($intVehicleTypes)) 
            {
                $objectDB->where('v.id=:id', array(':id' => $intVehicleTypes));
                $arrVehicleTypes = $objectDB->queryRow();
            } 
            else
            {
                $objectDB->where('v.status=:status', array(':status' => $intStatus));
                $arrVehicleTypes = $objectDB->queryAll();
            }


        return $arrVehicleTypes;
    } 
     

}
