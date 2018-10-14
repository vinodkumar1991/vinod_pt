<?php

class VehicleGuideController extends Controller {

    public function actionHome() {
        $arrModifiedCategories = array();
        $arrGuideCategories = GuideCategory::getGuideCategories();
        $intCategoryId = Yii::app()->getRequest()->getQuery('id');
        $intSubCategoryId = Yii::app()->getRequest()->getQuery('sub_category_id');
        $intSubReadMore = Yii::app()->getRequest()->getQuery('sub_category_read_more');
        $strSourceImageUrl = '/vehicle_guide/web/original/';
        $arrFixedCategories = GuideSubCategory::getGuideSubCategories(NULL, 0);
        $intSign = 0;
        if (!empty($intCategoryId)) {
            $arrCategories = GuideSubCategory::getGuideSubCategories($intCategoryId, 0);
        } else if (!empty($intSubCategoryId)) {
            $arrCategories = GuideSubCategory::getGuideSubCategories($intCategoryId, 0, $intSubCategoryId);
        } else if (!empty($intSubReadMore)) {
            $intSign = 1;
            $arrCategories = GuideSubCategory::getGuideSubCategories($intCategoryId, 0, $intSubReadMore);
        } else {
            $arrCategories = $arrFixedCategories;
        }
        $objDataManager = new DataManager();
        $arrModifiedGuideCategories = $objDataManager->modifyGuideCategories($arrGuideCategories);
        $arrModifiedCategories = $objDataManager->modifyGuide($arrFixedCategories);
        $this->render('/Guide/Guide_Home', array('modified_categories' => $arrModifiedCategories, 'all_sub_categories' => $arrCategories, 'source_image_url' => $strSourceImageUrl, 'primary_categories' => $arrModifiedGuideCategories, 'read_more' => $intSign));
    }

}
