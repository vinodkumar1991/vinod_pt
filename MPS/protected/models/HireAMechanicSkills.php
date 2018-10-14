<?php

class HireAMechanicSkills extends CActiveRecord {

    public $strTable = 'hire_a_mechanic_skills';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrHireSkills
     * @return integer It will return last inserted live tracking 
     */
    public static function create($arrHireSkills) {
        $intHireAMechanic = NULL;
        $objHireAMechanic = new HireAMechanicSkills();
        $objHireAMechanic->hire_a_mechanic_id = $arrHireSkills['hire_a_mechanic_id'];
        $objHireAMechanic->vehicle_categories_id = $arrHireSkills['hire_vehicle_category'];
        $objHireAMechanic->vehicle_brand_models_id = $arrHireSkills['hire_vehicle_model'];
        $objHireAMechanic->vehicle_skeleton_parts_id = NULL;
        $objHireAMechanic->years = $arrHireSkills['hire_years'];
        $objHireAMechanic->months = $arrHireSkills['hire_months'];
        $objHireAMechanic->price_per_hr = $arrHireSkills['hire_per_hr_price'];
        $objHireAMechanic->status = $arrHireSkills['status'];
        $objHireAMechanic->created_date = $arrHireSkills['created_date'];
        $objHireAMechanic->created_by = $arrHireSkills['created_by'];
        $objHireAMechanic->device_id = $arrHireSkills['device_id'];
        $objHireAMechanic->ip_address = $arrHireSkills['ip_address'];
        if ($objHireAMechanic->save()) {
            $intHireAMechanic = $objHireAMechanic->id;
        }
        return $intHireAMechanic;
    }

    public static function getSkills($intHire, $intStatus = 1) {
        $objDB = Yii::app()->db->createCommand();
        $objDB->select('vc.name as vehicle_category,vbm.name as vehicle_model,vb.name as vehicle_brand,hams.years,hams.months,round(hams.price_per_hr) as price_per_hr');
        $objDB->from('hire_a_mechanic_skills as hams');
        $objDB->join('vehicle_categories as vc', 'vc.id = hams.vehicle_categories_id');
        $objDB->join('vehicle_brand_models as vbm', 'vbm.id = hams.vehicle_brand_models_id');
        $objDB->join('vehicle_brands as vb', 'vb.id = vbm.vehicle_brands_id');
        $objDB->where('hams.hire_a_mechanic_id=:hireId and hams.status=:status', array(':hireId' => $intHire, ':status' => $intStatus));
        $arrEnquiry = $objDB->queryAll();
        return $arrEnquiry;
    }

}
