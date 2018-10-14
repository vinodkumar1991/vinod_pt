<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModificationShopsBrands
 *
 * @author ctel-cpu-33
 */
class ModificationShopsBrands extends CActiveRecord{
    
    public $strTable = 'modification_shops_brands';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function create($arrBrands) {
        $intInserted = NULL;
        if (!empty($arrBrands)) {
            foreach ($arrBrands as $arrBrands) {
                $objCommand = Yii::app()->db->createCommand();
                $intInserted = $objCommand->insert('modification_shops_brands', $arrBrands);
            }
        }
        return $intInserted;
    }
}
