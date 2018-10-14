<?php

class SelfVehiclesDetails extends CActiveRecord {

    public $strTable = 'self_vehicles_details';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrSelfVehicle
     * @return integer It will return an integer response
     */
    public static function create($arrSelfVehicle) {

        $intSelfVehicleDetails = NULL;
        $objectAddSelfdrive = new SelfVehiclesDetails();
       //print_r($arrSelfVehicle);die();
        if (isset($arrSelfVehicle['week_form_id']) && !empty($arrSelfVehicle['week_form_id'])) {
            $objectAddSelfdrive = SelfVehiclesDetails::model()->find('id=:id', array(':id' => $arrSelfVehicle['week_form_id']));
        }
        $objectAddSelfdrive->self_vehicles_id = $arrSelfVehicle['self_vehicles_id'];
        $objectAddSelfdrive->km_per_hr = $arrSelfVehicle['kms_per_hr'];
        $objectAddSelfdrive->price_per_hr = $arrSelfVehicle['price_per_hr'];
        $objectAddSelfdrive->extra_rate_km = $arrSelfVehicle['extra_rate_per_km'];
        $objectAddSelfdrive->security_deposit = $arrSelfVehicle['security_deposit'];
        $objectAddSelfdrive->pickup_amount = $arrSelfVehicle['pickup_amount'];
        $objectAddSelfdrive->drop_amount = $arrSelfVehicle['drop_amount'];
        $objectAddSelfdrive->week_day_or_end = $arrSelfVehicle['week_day_or_end'];
        $objectAddSelfdrive->status = $arrSelfVehicle['status'];
        if (isset($arrSelfVehicle['week_form_id']) && !empty($arrSelfVehicle['week_form_id'])) {
            $objectAddSelfdrive->last_modified_by = 1;
        } else {
            $objectAddSelfdrive->created_date = $arrSelfVehicle['created_date'];
            $objectAddSelfdrive->created_by = $arrSelfVehicle['created_by'];
        }
        $objectAddSelfdrive->ip_address = $arrSelfVehicle['ip_address'];
        $objectAddSelfdrive->device_id = $arrSelfVehicle['device_id'];
        if ($objectAddSelfdrive->save()) {
            $intSelfVehicleDetails = $objectAddSelfdrive->id;
        }
        return $intSelfVehicleDetails;
    }

    public function getSelfVehicleDetails($arrInputs) {

        $arrSelfVehicles = array();
        $intStatus = 1;
        $objDB = Yii::app()->db->createCommand();
        $objDB->select('svd.id,round(svd.km_per_hr,2) as km_per_hr,round(svd.price_per_hr,2) as price_per_hr,round(svd.extra_rate_km,2) as extra_rate_km,round(svd.security_deposit,2) as security_deposit,round(svd.pickup_amount,2) as pickup_amount,round(svd.drop_amount,2) as drop_amount,at.name as agent_name');
        $objDB->from('self_vehicles_details as svd');
        $objDB->join('self_vehicles as sv', 'sv.id = svd.self_vehicles_id');
        $objDB->join('agents as at', 'at.id = sv.agents_id');
        if (isset($arrInputs['self_vehicles_id']) && !empty($arrInputs['self_vehicles_id']) && isset($arrInputs['week_day_or_end']) && !empty($arrInputs['week_day_or_end'])) {
            $objDB->where('svd.self_vehicles_id=:selfVehicleId and svd.week_day_or_end=:weekDayOrEnd and svd.status=:status', array(':selfVehicleId' => $arrInputs['self_vehicles_id'], ':weekDayOrEnd' => $arrInputs['week_day_or_end'], ':status' => $intStatus));
        }
        $arrSelfVehicles = $objDB->queryRow();
        
        return $arrSelfVehicles;
    }

}
