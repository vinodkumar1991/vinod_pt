

<?php
/**
 * Need to change entire
 */

class VehicleCategories extends CActiveRecord {

    public $strTable = 'vehicle_categories';

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
     * @return array It will return service plans by vehicle type wise
     */
    public static function getVehicleCategory($intBrand, $intModel, $intStatus = 1) {
        $intServiceCategory = NULL;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vc.id');
        $objectDB->from('vehicle_categories as vc');
        $objectDB->where('vc.status=:status and vc.status=:status and vc.status=:status', array(':status' => $intStatus));
        $intServiceCategory = $objectDB->queryAll();
        return $intServiceCategory;
    }

}
