<?php

class GuideCategory extends CActiveRecord {

    public $strTable = 'guide_category';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrGuideCategory
     * @return integer It will return an integer response
     */
    public static function create($arrGuideCategory) {
        $intGuideCategoryId = NULL;
        $objGuideCategory = new GuideCategory();
        $objGuideCategory->name = $arrGuideCategory['guide_category_name'];
        $objGuideCategory->code = $arrGuideCategory['guide_category_code'];
        $objGuideCategory->description = $arrGuideCategory['guide_category_description'];
        $objGuideCategory->status = $arrGuideCategory['guide_category_status'];
        $objGuideCategory->created_date = $arrGuideCategory['created_date'];
        $objGuideCategory->created_by = $arrGuideCategory['created_by'];
        $objGuideCategory->ip_address = $arrGuideCategory['ip_address'];
        $objGuideCategory->device_id = $arrGuideCategory['device_id'];
        if ($objGuideCategory->save()) {
            $intGuideCategoryId = $objGuideCategory->id;
        }
        return $intGuideCategoryId;
    }

    /**
     * @author Digital Today
     * @param string $strOTP
     * @return array It will otp details
     */
    public static function isCodeExist($strCode) {
        $arrGuideCategory = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('gc.id');
        $objectDB->from('guide_category as gc');
        $objectDB->where('gc.code=:code', array(':code' => $strCode));
        $arrGuideCategory = $objectDB->queryRow();
        return $arrGuideCategory;
    }

    /**
     * @author Digital Today
     * @param string $strUsernameOrMobile
     * @return array It will return customer details
     */
    public static function isNameExist($strName) {
        $arrGuideCategory = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('gc.id');
        $objectDB->from('guide_category as gc');
        $objectDB->where('gc.name=:name', array(':name' => $strName));
        $arrGuideCategory = $objectDB->queryRow();
        return $arrGuideCategory;
    }

    public static function getGuideCategories() {
        $objDB = Yii::app()->db->createCommand();
        $objDB->select('gc.id as category_id,gc.name as category_name,gc.code as category_code, gc.description as category_description,gc.status as category_status');
        $objDB->from('guide_category as gc');
        $objDB->order('gc.id desc');
        $arrEnquiry = $objDB->queryAll();
        return $arrEnquiry;
    }

}
