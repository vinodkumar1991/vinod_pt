<?php

class GuideSubCategory extends CActiveRecord {

    public $strTable = 'guide_sub_category';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getGuideSubCategories($intCategory = NULL, $intSign = 1, $intSubCategory = NULL, $strSearch = NULL) {
        $objDB = Yii::app()->db->createCommand();
        if (1 == $intSign) {
            $objDB->select('gsc.name as sub_category_name,gsc.code as sub_category_code,gsc.image_name,gsc.status as sub_category_status,
                           (CASE WHEN gsc.status =1  THEN "/vehicle_guide/web/original/"  ELSE "/vehicle_guide/web/original/" END) AS sub_category_path,
                           (CASE WHEN gsc.status =1  THEN "/vehicle_guide/mobile/original/"  ELSE "/vehicle_guide/mobile/original/" END) AS sub_mobile_category_path,gsc.id as sub_category_id,
                           (CASE WHEN gsc.id > 0  THEN "/VehicleGuide/Home/sub_category_id/"  ELSE "/VehicleGuide/Home/sub_category_id/" END) AS web_view_url,gc.id as guide_category_id
                           
                           ');
        } else if (0 == $intSign) {
            $objDB->select('gc.name as category_name,'
                    . 'gc.code as category_code,'
                    . ' gsc.name as sub_category_name,'
                    . 'gsc.code as sub_category_code,'
                    . 'gsc.image_name,'
                    . 'gsc.status as sub_category_status,'
                    . 'gsc.image_name,'
                    . 'gc.id as category_id,'
                    . 'gsc.id as sub_category_id,'
                    . 'gsc.description as sub_category_description,DATE_FORMAT(gsc.created_date,"%b %d, %Y")as post_created_date'
            );
        }
        $objDB->from('guide_sub_category as gsc');
        $objDB->join('guide_category as gc', 'gc.id = gsc.guide_category_id');

        if (!empty($intCategory)) {
            $objDB->where('gsc.guide_category_id=:id', array(':id' => $intCategory));
        }
        if (!empty($intSubCategory)) {
            $objDB->where('gsc.id=:id', array(':id' => $intSubCategory));
        }

        if (!empty($strSearch)) {
            $objDB->where(array('like', 'gsc.name', array('%' . $strSearch . '%')));
        }
        $objDB->order('gc.name asc');
        $arrEnquiry = $objDB->queryAll();
        return $arrEnquiry;
    }

}
