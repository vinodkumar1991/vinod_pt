<?php

/**
 * @author Digital Today
 * @access public
 * @ignore It will handle booking operations
 */
class VehicleGuideController extends Controller {

    public function actionGetCategories() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['customer_id']) && !empty($arrInputs['customer_id'])) {
                $arrCategories = GuideCategory::getGuideCategories();
                $arrAllSubCategories = GuideSubCategory::getGuideSubCategories(NULL, 1, NULL);
                $arrResponse = array('type' => 'success', 'data' => $arrCategories, 'message' => 'Vehicel Categories List', 'code' => 200, 'no_of_tabs' => count($arrCategories), 'all_sub_categories' => $arrAllSubCategories);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Customer Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionGetSubCategories() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['customer_id']) && !empty($arrInputs['customer_id'])) {
                if (isset($arrInputs['guide_category_id']) && !empty($arrInputs['guide_category_id'])) {
                    $arrSubCategories = GuideSubCategory::getGuideSubCategories($arrInputs['guide_category_id']);
                    $arrResponse = array('type' => 'success', 'data' => $arrSubCategories, 'message' => 'Vehicel Categories List', 'code' => 200);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Category Is Missed.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Customer Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    public function actionGetView() {
        $arrModifiedCategories = array();
        $strSourceImageUrl = '/vehicle_guide/web/original/';
        $intCategory = Yii::app()->getRequest()->getQuery('guide_category_id');
        $intSubCategory = Yii::app()->getRequest()->getQuery('guide_sub_category_id');
        $arrCategories = GuideSubCategory::getGuideSubCategories($intCategory, 0, $intSubCategory);
        $this->render('/Guide/Mobile_Guide_Home', array('all_sub_categories' => $arrCategories, 'source_image_url' => $strSourceImageUrl));
    }

    public function actionSearch() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            if (isset($arrInputs['search_key']) && !empty($arrInputs['search_key'])) {
                $arrCategories = GuideSubCategory::getGuideSubCategories(NULL, 1, NULL, $arrInputs['search_key']);
                $arrResponse = array('type' => 'success', 'data' => $arrCategories, 'message' => 'Search List.', 'code' => 200);
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Search Key Is Missed.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }
    
    
    public function actionTesttwo(){
                    $ch = curl_init();
                    
                    curl_setopt($ch, CURLOPT_URL, "https://carpm.in/users/sign_in");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"user\": {\"email\": \"rk@metrepersecond.com\", \"password\": \"rakesh@carpm\"}}");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
                    
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    $headers = array();
                    $headers[] = "Content-Type: application/json";
                    $headers[] = "Accept: application/json";
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    
                    echo $result = curl_exec($ch);
                    if (curl_errno($ch)) {
                        echo 'Error:' . curl_error($ch);
                    }
                    curl_close ($ch);
        
            }
    
    

}
