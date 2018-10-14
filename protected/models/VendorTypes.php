<?php

class VendorTypes extends CActiveRecord {

    public $strTable = 'vendor_types';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

//$arrVendorTypes = VendorTypes::model()->getVendorTypes();
    /**
     * @author Ctel
     * @param string $strUsername
     * @return array It will return customer data
     */
      public static function getVendor($intStatus = 1, $intVendor = NULL) {
        $arrVendor = array();

        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('*');
        $objectDB->from('vendor_types as v');
        if (!empty($intVendor)) {
            $objectDB->where('v.id=:id', array(':id' => $intVendor));
            $arrVendor = $objectDB->queryRow();
        } else {
            $objectDB->where('v.status=:status', array(':status' => $intStatus));
            $arrVendor = $objectDB->queryAll();
        }


        return $arrVendor;
    }
}
