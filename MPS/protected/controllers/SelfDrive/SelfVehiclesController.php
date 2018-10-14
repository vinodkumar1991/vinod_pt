<?php

class SelfVehiclesController extends Controller {
    /*
     * @Author Digitaltoday
     * @create Users for Mps
     * return array respose to action
     */

    public function actionCreate() {



        $arrErrors = array();
        $arrVehicleResponse = array();
        $intSelfdriveDetails = 0;
        $intSelfdriveId = 0;
        $imageTimestampFile = '';
        $arrCommon = array();
        $arrayobj = VehicleTypes::getVehicleTypes();
        $arrayClasses = VehicleClasses::getVehicleClasses();
        $arrayBrands = VehicleBrands::getVehicleBrands();
        $arrayVeriants = VehicleVariants::getVehicleVeriants();
        $arrayFeatures = VehicleFeatures::getVehicleFeatures();

        if (isset($_POST['addvehicle'])) {
            $objSelfdrive = new AddSelfdriveForm();
            $objSelfdrive->attributes = $_POST;

            $objDataManager = new DataManager();
            if ($objSelfdrive->validate()) {
                
                
                if ($_FILES['vehicle_image']) {

                    $strFileName = 'vehicle_image';
                    $strVehicleFolderName = '';
                    if (1 == $objSelfdrive->vehicle_types_id) {
                        $strVehicleFolderName = '/selfdrive/cars';
                    } else {
                        $strVehicleFolderName = '/selfdrive/bikes';
                    }

                    $arrImageDimensions = array(
                        array('width' => 450, 'height' => 260, "device" => "450x260", 'folder_path' => $strVehicleFolderName . '/web/'),
                        array('width' => 280, 'height' => 162, "device" => "280x162", 'folder_path' => $strVehicleFolderName . '/web/'),
                        array('width' => 60, 'height' => 35, "device" => "60x35", 'folder_path' => $strVehicleFolderName . '/web/'),
                        array('width' => 768, 'height' => 576, "device" => "768x576", 'folder_path' => $strVehicleFolderName . '/web/'),
                        
                        array('width' => 450, 'height' => 260, "device" => "450x260", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                        array('width' => 280, 'height' => 162, "device" => "280x162", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                        array('width' => 60, 'height' => 35, "device" => "60x35", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                        array('width' => 768, 'height' => 576, "device" => "768x576", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                    );
                    $arrCommon[] = $objDataManager->uploadFile($strFileName, $arrImageDimensions);
                    //$imageTimestampFile = $arrCommon['timestampName'];
                  
                }
                
                
                if ($_FILES['vehicle_multiple_images']) {
                    $strMulFileName = $_FILES['vehicle_multiple_images']['name'];

                    $strMulVehicleFolderName = '';
                    if (1 == $objSelfdrive->vehicle_types_id) {
                        $strMulVehicleFolderName = '/selfdrive/multi_images/cars';
                    } else {
                        $strMulVehicleFolderName = '/selfdrive/multi_images/bikes';
                    }
                    $arrImageDimensions = array(
                        array('width' => 450, 'height' => 260, "device" => "450x260", 'folder_path' => $strMulVehicleFolderName . '/web/'),
                        array('width' => 280, 'height' => 162, "device" => "280x162", 'folder_path' => $strMulVehicleFolderName . '/web/'),
                        array('width' => 60, 'height' => 35, "device" => "60x35", 'folder_path' => $strMulVehicleFolderName . '/web/'),
                        array('width' => 768, 'height' => 576, "device" => "768x576", 'folder_path' => $strMulVehicleFolderName . '/web/'),
                        
                        array('width' => 450, 'height' => 260, "device" => "450x260", 'folder_path' => $strMulVehicleFolderName . '/mobile/'),
                        array('width' => 280, 'height' => 162, "device" => "280x162", 'folder_path' => $strMulVehicleFolderName . '/mobile/'),
                        array('width' => 60, 'height' => 35, "device" => "60x35", 'folder_path' => $strMulVehicleFolderName . '/mobile/'),
                        array('width' => 768, 'height' => 576, "device" => "768x576", 'folder_path' => $strMulVehicleFolderName . '/mobile/'),
                    );


                    foreach ($strMulFileName as $key => $value) {

                        $collectTempNames = array();
                        $collectOriginalNames = array();
                        $arrImages[] = $objDataManager->uploadMultipleFiles($_FILES['vehicle_multiple_images']['name'][$key], $arrImageDimensions, $_FILES['vehicle_multiple_images']['tmp_name'][$key]);
                       
                    }
                    
                }
               $arrUploadedImageFiles = array_merge($arrCommon,$arrImages);
                
                try {
                    $objectTransaction = Yii::app()->db->beginTransaction();
                    $arrCustomer = $this->actionPrepareInput($objSelfdrive->attributes);

                    $intSelfdrive = SelfVehicles::model()->create($arrCustomer);
                    $arrImagedatas = $objDataManager->modifyVehicleImageData($intSelfdrive);
                  
                    $arrVehicleImage = SelfVehicleImage::model()->create($arrImagedatas, $arrUploadedImageFiles);
                   
                    $intSelfdriveDetails = SelfVehiclesDetails::model()->create($arrCustomer, $intSelfdrive);
                    $featuresarray = $_POST['veh_features'];
                    $arrCommon = $objDataManager->prepareSelfFeatures($featuresarray, $arrCustomer, $intSelfdrive);
                    $intSelfdriveFeatures = SelfVehiclesFeatures::model()->create($arrCustomer, $arrCommon, $intSelfdrive);

                   if (!empty($intSelfdriveFeatures)) {
                        $objectTransaction->commit();
                    } else {
                        $objectTransaction->rollback();
                    }
                    
                } catch (Exception $e) {
                    print_r($e->getMessage());
                    die();
                }
                  
                $arrVehicleResponse = array('type' => 'success', 'data' => 'Data added successfully.', 'message' => 'Vehicle Details added successfully.', 'code' => 200);
            } else {

                $arrErrors = $objSelfdrive->errors;
            }
        }



        $this->render('/selfdrive/self_vehicle', array("errors" => $arrErrors, 'vehicle_types' => $arrayobj, 'vehicle_classes' => $arrayClasses, 'arrayVeriants' => $arrayVeriants, 'vehicle_Brands' => $arrayBrands, 'arrayFeatures' => $arrayFeatures, "response" => $arrVehicleResponse));
    }

    /*
     * @author Digital today
     */

    
    public function actionVehicleDetails()
    {
        $getModels = vehicleBrandModels::model()->getAgentDetails($intBrandId);
    }
    public function actionGetModels() {
        $intBrandId = $_POST['brand_id'];
        $getModels = vehicleBrandModels::model()->getVehicleBrandModels($intBrandId);
        $this->renderJSON($getModels);
        die();
    }

    public function actionPrepareInput($arrMechanicInput) {
        $arrMechanic = array();
        $arrCommon = DataManager::getDefaults();
        $arrMechanic = array_merge($arrMechanicInput, $arrCommon);
        return $arrMechanic;
    }

}
