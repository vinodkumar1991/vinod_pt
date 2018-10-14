<?php

class ModificationShopsServices extends CActiveForm{
   public $strTable = 'modification_shops_services';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function create($arrShopServices) {
        $intInserted = NULL;
        if (!empty($arrShopServices)) {
            foreach ($arrShopServices as $arrShopServices) {
                $objCommand = Yii::app()->db->createCommand();
                $intInserted = $objCommand->insert('modification_shops_services', $arrShopServices);
            }
        }
        return $intInserted;
    }
}
