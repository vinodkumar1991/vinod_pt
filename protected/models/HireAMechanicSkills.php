<?php

class HireAMechanicSkills extends CActiveRecord {

    public $strTable = 'hire_a_mechanic_skills';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
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
