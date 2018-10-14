<?php

class VehicleTimings extends CActiveRecord {

    public $strTable = 'self_vehicles_timings';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function create($arrVehicleTimings) {
        $intVehicleTiming = NULL;
        $objVehicleTimings = new VehicleTimings();
        $objVehicleTimings->self_vehicles_id = $arrVehicleTimings['self_vehicles_id'];
        $objVehicleTimings->start_date = $arrVehicleTimings['vehicle_start_date'];
        $objVehicleTimings->end_date = $arrVehicleTimings['vehicle_end_date'];
        $objVehicleTimings->status = $arrVehicleTimings['status'];
        $objVehicleTimings->created_date = $arrVehicleTimings['created_date'];
        $objVehicleTimings->created_by = $arrVehicleTimings['created_by'];
        $objVehicleTimings->ip_address = $arrVehicleTimings['ip_address'];
        $objVehicleTimings->device_id = $arrVehicleTimings['device_id'];
        if ($objVehicleTimings->save()) {
            $intVehicleTiming = $objVehicleTimings->id;
        }
        return $intVehicleTiming;
    }
    public static function VehicleTimingReport($arrInputs =  array()){
        $arrSelfVehiclesTimings = array();
        $objDB = Yii::app()->db->createCommand();
        $objDB->select('svt.*');
        $objDB->from('self_vehicles_timings as svt');
         if (isset($arrInputs['self_vehicles_id']) && !empty($arrInputs['self_vehicles_id'])) {
            $objDB->where('svt.self_vehicles_id=:id', array(':id' => $arrInputs['self_vehicles_id']));
        }
        $arrSelfVehiclesTimings = $objDB->queryAll();
        return $arrSelfVehiclesTimings;
           
    }

}
