<?php

class SelfVehicles extends CActiveRecord {

    public $strTable = 'self_vehicles';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrAgentVehicle
     * @return integer It will return an integer response
     */
    public static function create($arrAgentVehicle) {
        $intSelfVehicle = NULL;
        $objSelfVehicle = new SelfVehicles();
        $objSelfVehicle->vehicle_types_id = $arrAgentVehicle['vehicle_type_id'];
        $objSelfVehicle->vehicle_classes_id = $arrAgentVehicle['vehicle_class_id'];
        $objSelfVehicle->vehicle_variants_id = $arrAgentVehicle['vehicle_variant_id'];
        $objSelfVehicle->vehicle_brand_models_id = $arrAgentVehicle['vehicle_brand_model_id'];
        $objSelfVehicle->agents_id = $arrAgentVehicle['agents_id'];
        $objSelfVehicle->seating = $arrAgentVehicle['vehicle_seating_capacity'];
        $objSelfVehicle->code = $arrAgentVehicle['code'];
        $objSelfVehicle->vehicle_registration_number = $arrAgentVehicle['vehicle_registration_number'];
        $objSelfVehicle->description = $arrAgentVehicle['vehicle_description'];
        $objSelfVehicle->status = $arrAgentVehicle['status'];
        $objSelfVehicle->created_date = $arrAgentVehicle['created_date'];
        $objSelfVehicle->created_by = $arrAgentVehicle['created_by'];
        $objSelfVehicle->ip_address = $arrAgentVehicle['ip_address'];
        if ($objSelfVehicle->save()) {
            $intSelfVehicle = $objSelfVehicle->id;
        }
        return $intSelfVehicle;
    }

    public function agentVehiclesReport($arrInputs = array()) {
        $arrSelfVehicles = array();
        $objDB = Yii::app()->db->createCommand();
        $objDB->select('sv.id as self_vehicles_id,sv.agents_id as agents_id,sv.vehicle_registration_number,at.id as agent_id,at.name as agent_name,vt.id as vehicle_type_id,'
                . 'vt.name as vehicle_type,sv.seating as seating,vc.name as vehicle_class_name,vc.id as vehicle_class_id,'
                . 'vv.id as vehicle_variant_id,sv.description as description,vv.name as vehicle_variant_name,'
                . 'vbm.name as vehicle_model_name,vbm.id as vehicle_model_id,'
                . 'vb.id as vehicle_brand_id,vb.name as vehicle_brand_name,'
                . '(CASE WHEN sv.seating = 1 THEN "1 To 4"
                           WHEN sv.seating = 2 THEN "4 To 6"
                           WHEN sv.seating = 3 THEN "6 To 10"
                           WHEN sv.seating = 4 THEN "10+"
                           ELSE "1 To 4" END) AS vehicle_seating_capacity,sv.status as vehicle_status,
                           (CASE WHEN sv.status = 1 THEN "Active" ELSE "Inactive" END) AS agent_vehicle_status,sv.id as self_vehicle_id');
        $objDB->from('self_vehicles as sv');
        $objDB->join('agents as at', 'at.id = sv.agents_id');
        $objDB->join('vehicle_types as vt', 'vt.id = sv.vehicle_types_id');
        $objDB->join('vehicle_classes as vc', 'vc.id = sv.vehicle_classes_id');
        $objDB->join('vehicle_variants as vv', 'vv.id = sv.vehicle_variants_id');
        $objDB->join('vehicle_brand_models as vbm', 'vbm.id = sv.vehicle_brand_models_id');
        $objDB->join('vehicle_brands as vb', 'vb.id = vbm.vehicle_brands_id');
        if (isset($arrInputs['status'])) {
            $objDB->where('sv.status=:status and at.status=:agentStatus', array(':status' => $arrInputs['status'], ':agentStatus' => $arrInputs['status']));
        }
        if (isset($arrInputs['id']) && !empty($arrInputs['id'])) {
            $objDB->where('sv.id=:id', array(':id' => $arrInputs['id']));
        }
        if (isset($arrInputs['agent_id']) && !empty($arrInputs['agent_id'])) {
            $objDB->where('at.id=:agentId', array(':agentId' => $arrInputs['agent_id']));
        }
        $arrSelfVehicles = $objDB->queryAll();
        $objDB->order('sv.id', 'at.name asc');
        return $arrSelfVehicles;
    }

    public static function updateSelfVehicles($arrSelfVehicle, $intSelfVehicle) {
        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('self_vehicles', $arrSelfVehicle, 'id=:id', array(':id' => $intSelfVehicle));
        return $intUpdate;
    }

}
