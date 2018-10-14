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

    public function agentVehiclesReport($arrMinMaxLatiLongis = array(), $arrInputs = array()) {
        $arrSelfVehicles = array();
        $intStatus = 1;
        $strQuery = 'SELECT at.id as agent_id,at.name as agency_name,vt.id as vehicle_type_id,vt.name as vehicle_type,vc.name as vehicle_class_name,vc.id as vehicle_class_id,vv.id as vehicle_variant_id,vv.name as vehicle_variant_name,vbm.name as vehicle_model_name,vbm.id as vehicle_model_id,vb.id as vehicle_brand_id,vb.name as vehicle_brand_name,
                          (CASE WHEN sv.seating = 1 THEN "4"
                           WHEN sv.seating = 2 THEN "6"
                           WHEN sv.seating = 3 THEN "10"
                           WHEN sv.seating = 4 THEN "15"
                           ELSE "4" END) AS vehicle_seating_capacity,sv.status as vehicle_status,
                           (CASE WHEN sv.status = 1 THEN "Active" ELSE "Inactive" END) AS agent_vehicle_status,
                           sv.id as self_vehicle_id,
                           CASE WHEN sv.vehicle_types_id = 1 THEN "/cars/web/models/original/" ELSE "/bikes/web/models/original/" END AS model_path,
                           CASE WHEN sv.vehicle_types_id = 1 THEN "/cars/mobile/brands/120X80/" ELSE "/bikes/mobile/models/120X80/" END AS brand_path,
                           vbm.image_path as  model_logo,
                           round(svd.km_per_hr,2) as kmph,
                           round(svd.price_per_hr,2) as pphr,
                           round(svd.extra_rate_km,2) as erpkm,
                           round(svd.security_deposit,2) as security_deposit,
                           svd.week_day_or_end,
                           ad.location as agent_location,
                           ad.latitude as agent_latitude,
                           ad.longitude as agent_longitude,
                           round(svd.pickup_amount) as pickup_amount,
                           round(svd.drop_amount) as drop_amount,
                           ad.address as agent_address,
                           ad.pincode as agent_pincode,
                           at.email as agent_email,
                           at.phone as agent_phone,
                           at.owner as agent_name,
                           sv.vehicle_registration_number
                           
                                FROM self_vehicles as sv
                                INNER JOIN self_vehicles_details as svd ON svd.self_vehicles_id = sv.id and svd.status = "' . $intStatus . '" and svd.week_day_or_end = "' . $arrInputs['week_day_or_end'] . '"
                                INNER JOIN agents as at ON at.id = sv.agents_id
                                INNER JOIN agents_details as ad ON ad.agents_id = at.id
                                INNER JOIN vehicle_types as vt ON vt.id = sv.vehicle_types_id
                                INNER JOIN vehicle_classes as vc ON vc.id = sv.vehicle_classes_id
                                INNER JOIN vehicle_variants as  vv ON vv.id = sv.vehicle_variants_id
                                INNER JOIN vehicle_brand_models as vbm ON vbm.id = sv.vehicle_brand_models_id
                                INNER JOIN self_vehicles_timings as svt ON svt.self_vehicles_id = sv.id and svt.is_available = "' . $intStatus . '"
                                INNER JOIN vehicle_brands as vb ON vb.id = vbm.vehicle_brands_id where 1 ';

        if (!empty($arrMinMaxLatiLongis)) {
            $strQuery .=' and ad.latitude between "' . $arrMinMaxLatiLongis['min_lati'] . '" and "' . $arrMinMaxLatiLongis['max_lati'] . '"';
            $strQuery .=' and ad.longitude between "' . $arrMinMaxLatiLongis['min_longi'] . '" and "' . $arrMinMaxLatiLongis['max_longi'] . '"';
        }


        if (isset($arrInputs['start_date']) && !empty($arrInputs['start_date']) && isset($arrInputs['end_date']) && !empty($arrInputs['end_date'])) {
            //$strQuery .=' and DATE(svt.start_date)>="' . $arrInputs['start_date'] . '"';
            //$strQuery .=' and DATE(svt.end_date)<="' . $arrInputs['start_date'] . '"';
            //$strQuery .=' and DATE(svt.start_date) between "' . $arrInputs['start_date'] . '" and "' . $arrInputs['end_date'] . '"';
            $strQuery .=' and "' . $arrInputs['start_date'] . '" between DATE(svt.start_date) and DATE(svt.end_date)';
            
        }

        if (isset($arrInputs['vehicle_id']) && !empty($arrInputs['vehicle_id'])) {
            $strQuery .=' and sv.vehicle_types_id ="' . $arrInputs['vehicle_id'] . '"';
        }

        if (!empty($arrInputs['agent_id'])) {
            $strQuery .=' and at.id ="' . $arrInputs['agent_id'] . '"';
        }

        if (!empty($arrInputs['self_vehicle_id'])) {
            $strQuery .=' and sv.id ="' . $arrInputs['self_vehicle_id'] . '"';
        }
         if (isset($arrInputs['vehicle_class_name']) && !empty($arrInputs['vehicle_class_name'])) {
            $strQuery .=' and vc.name ="' . $arrInputs['vehicle_class_name'] . '"';
        }
        $strQuery .= ' group by sv.id order by sv.id,at.name ASC';
        $arrSelfVehicles = Yii::app()->db->createCommand($strQuery)->queryAll();
        return $arrSelfVehicles;
    }

}
