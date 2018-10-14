<?php

class GuideCategory extends CActiveRecord {

    public $strTable = 'guide_category';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getGuideCategories($intStatus = 1) {
        $objDB = Yii::app()->db->createCommand();
        $objDB->select('gc.id as category_id,gc.name as category_name,gc.code as category_code, gc.description as category_description,gc.status as category_status');
        $objDB->from('guide_category as gc');
        $objDB->where('gc.status=:status', array(':status' => $intStatus));
        $objDB->order('gc.name asc');
        $arrEnquiry = $objDB->queryAll();
        return $arrEnquiry;
    }

}
