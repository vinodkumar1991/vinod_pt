<?php

class Vehicles extends CActiveRecord {

    public $strTable = 'Vehicles';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param integer $intBrand
     * @param integer $intModel
     * @param integer $intStatus
     * @return integer It will return vehicle category id
     */
    public static function getVehicleCategory($intBrand, $intModel, $intStatus = 1) {
        $intServiceCategory = NULL;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('v.vehicle_categories_id as id');
        $objectDB->from('Vehicles as v');
        $objectDB->where('v.vehicle_brands_id=:brand and v.vehicle_brand_models_id=:model and v.status=:status', array(':brand' => $intBrand, ':model' => $intModel, ':status' => $intStatus));
        $arrServiceCategory = $objectDB->queryRow();
        $intServiceCategory = isset($arrServiceCategory['id']) ? $arrServiceCategory['id'] : 0;
        return $intServiceCategory;
    }

}
