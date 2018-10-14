<?php

class GuideSubCategory extends CActiveRecord {

    public $strTable = 'guide_sub_category';

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
        $objGuideCategory = new GuideSubCategory();
        $objGuideCategory->guide_category_id = $arrGuideCategory['guide_category_id'];
        $objGuideCategory->name = $arrGuideCategory['guide_sub_category_name'];
        $objGuideCategory->code = $arrGuideCategory['guide_sub_category_code'];
        $objGuideCategory->description = $arrGuideCategory['guide_sub_category_description'];
        $objGuideCategory->image_name = $arrGuideCategory['timestampName'];
        $objGuideCategory->image_original_name = $arrGuideCategory['original_name'];
        $objGuideCategory->status = $arrGuideCategory['guide_sub_category_status'];
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
    public static function isCodeExist($strCode, $intCategory) {
        $arrGuideCategory = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('gc.id');
        $objectDB->from('guide_sub_category as gc');
        $objectDB->where('gc.code=:code and gc.guide_category_id=:category_id', array(':code' => $strCode,':category_id' => $intCategory));
        $arrGuideCategory = $objectDB->queryRow();
        return $arrGuideCategory;
    }

    /**
     * @author Digital Today
     * @param string $strUsernameOrMobile
     * @return array It will return customer details
     */
    public static function isNameExist($strName,$intCategory) {
        $arrGuideCategory = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('gc.id');
        $objectDB->from('guide_sub_category as gc');
        $objectDB->where('gc.name=:name and gc.guide_category_id=:category_id', array(':name' => $strName,':category_id' => $intCategory));
        $arrGuideCategory = $objectDB->queryRow();
        return $arrGuideCategory;
    }

    public static function getGuideSubCategories() {
        $objDB = Yii::app()->db->createCommand();
        $objDB->select('gc.name as category_name,gc.code as category_code, gc.description as category_description,gc.status as category_status,gsc.name as sub_category_name,gsc.code as sub_category_code,gsc.image_name,gsc.status as sub_category_status,gsc.description as sub_category_description,gsc.image_name');
        $objDB->from('guide_sub_category as gsc');
        $objDB->join('guide_category as gc', 'gc.id = gsc.guide_category_id');
        $objDB->order('gc.id desc');
        $arrEnquiry = $objDB->queryAll();
        return $arrEnquiry;
    }

}
