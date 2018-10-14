<?php

class VehicleGuideController extends Controller {

    public function actionGuideCategory() {
        $arrErrors = array();
        $objGuideCategoryForm = NULL;
        $arrGuideCategories = GuideCategory::getGuideCategories();
        if (isset($_POST['guide_create_category'])) {
            $objGuideCategoryForm = new GuideCategoryForm();
            $objGuideCategoryForm->attributes = $_POST;
            if ($objGuideCategoryForm->validate()) {
                $objDataManager = new DataManager();
                $arrModifiedInput = $objDataManager->makeData($objGuideCategoryForm->attributes);
                $arrModifiedInput['guide_category_status'] = $objGuideCategoryForm->guide_category_status;
                $intGuideCategory = GuideCategory::create($arrModifiedInput);
                if (!empty($intGuideCategory)) {
                    Yii::app()->user->setFlash('success', $arrModifiedInput['guide_category_name'] . ' is aded successfully.');
                } else {
                    Yii::app()->user->setFlash('failure', 'Oops error occured. Please try again.');
                }
                unset($intGuideCategory);
                unset($arrModifiedInput);
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objGuideCategoryForm->errors;
            }
        }
        $this->render('/Guide/Category', array('errors' => $arrErrors, 'guide_category_form' => $objGuideCategoryForm, 'guide_categories' => $arrGuideCategories));
    }

    public function actionGuideSubCategory() {
        $arrErrors = array();
        $arrGuideCategories = GuideCategory::getGuideCategories();
        $arrGuideSubCategories = GuideSubCategory::getGuideSubCategories();
        $objSubCategoryForm = NULL;
        if (isset($_POST['guide_sub_create_category'])) {
            $objSubCategoryForm = new GuideSubCategoryForm();
            $objSubCategoryForm->attributes = $_POST;
            if ($objSubCategoryForm->validate()) {
                $strVehicleFolderName = 'vehicle_guide';
                $strFileName = 'guide_sub_category_logo';
                $strFileTempName = $_FILES[$strFileName]['tmp_name'];
                $arrImageDim = getimagesize($strFileTempName);
                $arrImageDimensions = array(
                    array('width' => 830, 'height' => 360, "device" => "830X360", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                    array('width' => 120, 'height' => 80, "device" => "120X80", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                    array('width' => $arrImageDim[0], 'height' => $arrImageDim[1], "device" => "original", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                    array('width' => 830, 'height' => 360, "device" => "830X360", 'folder_path' => $strVehicleFolderName . '/web/'),
                    array('width' => 120, 'height' => 80, "device" => "120X80", 'folder_path' => $strVehicleFolderName . '/web/'),
                    array('width' => $arrImageDim[0], 'height' => $arrImageDim[1], "device" => "original", 'folder_path' => $strVehicleFolderName . '/web/'),
                );
                $objDataManager = new DataManager();
                $arrImageParams = $objDataManager->uploadFile($strFileName, $arrImageDimensions);
                $arrInputs = array_merge($objSubCategoryForm->attributes, $arrImageParams);
                $arrModifiedInputs = $objDataManager->makeData($arrInputs);
                $intSubCategory = GuideSubCategory::create($arrModifiedInputs);
                if (!empty($intSubCategory)) {
                    Yii::app()->user->setFlash('success', $arrModifiedInputs['guide_sub_category_name'] . ' is aded successfully.');
                } else {
                    Yii::app()->user->setFlash('failure', 'Oops error occured. Please try again.');
                }
            } else {
                $arrErrors = $objSubCategoryForm->errors;
            }
        }
        $this->render('/Guide/SubCategory', array('errors' => $arrErrors, 'guide_categories' => $arrGuideCategories, 'guide_sub_categories' => $arrGuideSubCategories));
    }

    public function actionPosts() {
        $arrGuideSubCategories = GuideSubCategory::getGuideSubCategories();
        $strGuideLogoPath = Yii::app()->request->baseUrl . '/images/uploadimages/vehicle_guide/web/120X80/';
        $this->render('/Guide/Posts', array('guide_sub_categories' => $arrGuideSubCategories,'guide_images_path' => $strGuideLogoPath));
    }

}
