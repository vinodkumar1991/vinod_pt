<?php

class BrandsController extends Controller {

    public function actionCreateBrand() {
        $strErrorMessage = NULL;
        $arrBrandResponse = array();
        $arrErrors = array();
        $arrVehicleTypes = VehicleTypes::getVehicleTypes();
        if (isset($_POST['create_brand'])) {
            $objBrand = new BrandForm();
            $objBrand->attributes = $_POST;
            if ($objBrand->validate()) {
                $strFileName = 'vehicle_logo';
                $strVehicleFolderName = 'bikes';
                if (1 == $objBrand->vehicle_types) {
                    $strVehicleFolderName = 'cars';
                }
                $arrImageDimensions = array(
                    array('width' => 60, 'height' => 40, "device" => "60X40", 'folder_path' => $strVehicleFolderName . '/web/brands/'),
                    array('width' => 120, 'height' => 80, "device" => "120X80", 'folder_path' => $strVehicleFolderName . '/mobile/brands/'),
                );
                $objDataManager = new DataManager();
                $arrLogo = $objDataManager->uploadFile($strFileName, $arrImageDimensions);
                $arrBrand = $objDataManager->modifyBrand($objBrand->attributes, $arrLogo);
                $intBrand = VehicleBrands::create($arrBrand);
                unset($arrLogo);
                unset($arrBrand);
                $arrBrandResponse = array('type' => 'success', 'data' => 'Brand added successfully.', 'message' => 'Brand added successfully.', 'code' => 200);
                unset($intBrand);
                unset($strFileName);
                unset($strVehicleFolderName);
            } else {
                $arrErrors = $objBrand->errors;
            }
        }
        $this->render('/Vehicles/Brands', array('vehicle_types' => $arrVehicleTypes, 'errors' => $arrErrors, 'response' => $arrBrandResponse));
    }

    public function actionCreateBrandReport() {
        $arrInputs = $_POST;
        $arrBrands = VehicleBrands::brandsReport($arrInputs);
        $strBikeLogoPath = Yii::app()->request->baseUrl . '/images/uploadimages/bikes/web/brands/60X40';
        $strCarLogoPath = Yii::app()->request->baseUrl . '/images/uploadimages/cars/web/brands/60X40';
        $this->render('/Vehicles/BrandsReport', array('brands' => $arrBrands,
            'bike_logo_path' => $strBikeLogoPath,
            'car_logo_path' => $strCarLogoPath,
        ));
    }

    public function actionCreateBrandModels() {
        $arrErrors = array();
        $arrBrandModelsResponse = array();
        $arrVehicleTypes = VehicleTypes::getVehicleTypes();
        if (isset($_POST['create_model'])) {
            $objBrandModel = new BrandModelForm();
            $objBrandModel->attributes = $_POST;
            if ($objBrandModel->validate()) {
                $strFileName = 'vehicle_model_logo';
                $strVehicleFolderName = 'bikes';
                $arrImageDim = getimagesize($_FILES[$strFileName]['tmp_name']);
                if (1 == $objBrandModel->vehicle_types) {
                    $strVehicleFolderName = 'cars';
                    $arrImageDimensions = array(
                        array('width' => 60, 'height' => 35, "device" => "60X35", 'folder_path' => $strVehicleFolderName . '/web/models/'),
                        array('width' => 120, 'height' => 70, "device" => "120X70", 'folder_path' => $strVehicleFolderName . '/mobile/models/'),
                        array('width' => 180, 'height' => 104, "device" => "180X104", 'folder_path' => $strVehicleFolderName . '/web/models/'),
                        array('width' => $arrImageDim[0], 'height' => $arrImageDim[1], "device" => "original", 'folder_path' => $strVehicleFolderName . '/mobile/models/'), //Web Images
                        array('width' => $arrImageDim[0], 'height' => $arrImageDim[1], "device" => "original", 'folder_path' => $strVehicleFolderName . '/web/models/'), //Web Images
                    );
                } else {
                    $arrImageDimensions = array(
                        array('width' => 60, 'height' => 35, "device" => "60X35", 'folder_path' => $strVehicleFolderName . '/web/models/'),
                        array('width' => 120, 'height' => 70, "device" => "120X70", 'folder_path' => $strVehicleFolderName . '/mobile/models/'),
                        array('width' => 220, 'height' => 127, "device" => "220X127", 'folder_path' => $strVehicleFolderName . '/web/models/'),
                        array('width' => $arrImageDim[0], 'height' => $arrImageDim[1], "device" => "original", 'folder_path' => $strVehicleFolderName . '/mobile/models/'), //Web Images
                        array('width' => $arrImageDim[0], 'height' => $arrImageDim[1], "device" => "original", 'folder_path' => $strVehicleFolderName . '/web/models/'), //Web Images
                    );
                }

                $objDataManager = new DataManager();
                $arrLogo = $objDataManager->uploadFile($strFileName, $arrImageDimensions);
                $arrBrandModel = $objDataManager->modifyBrandModel($objBrandModel->attributes, $arrLogo);
                $intBrandModel = VehicleBrandModels::create($arrBrandModel);
                unset($arrLogo);
                unset($arrBrandModel);
                $arrBrandModelsResponse = array('type' => 'success', 'data' => 'Brand model added successfully.', 'message' => 'Brand model added successfully.', 'code' => 200);
                unset($intBrandModel);
                unset($strFileName);
                unset($strVehicleFolderName);
            } else {
                $arrErrors = $objBrandModel->errors;
            }
        }
        $this->render('/Vehicles/BrandModels', array('vehicle_types' => $arrVehicleTypes, 'errors' => $arrErrors, 'response' => $arrBrandModelsResponse));
    }

    public function actionCreateBrandModelsReport() {
        $arrInputs = $_POST;
        $arrBrandModels = VehicleBrandModels::brandModelsReport($arrInputs);
        $strBikeModelPath = Yii::app()->request->baseUrl . '/images/uploadimages/bikes/web/models/60X35';
        $strCarModelPath = Yii::app()->request->baseUrl . '/images/uploadimages/cars/web/models/60X35';
        $this->render('/Vehicles/BrandModelsReport', array('brandModels' => $arrBrandModels,
            'bike_model_path' => $strBikeModelPath,
            'car_model_path' => $strCarModelPath,
        ));
    }

    public function actionGetVehicleBrands() {
        $strVehicleBrand = '<option value="">--Select Vehicle Brand--</option>';
        $arrVehicleBrands = array();
        if (Yii::app()->request->isPostRequest) {
            $intStatus = 1;
            $intVehicle = $_POST['vehicle_id'];
            $arrVehicleBrands = VehicleBrands::getVehicleBrands($intStatus, $intVehicle);
            if (!empty($arrVehicleBrands)) {
                foreach ($arrVehicleBrands as $arrBrands) {
                    $strVehicleBrand .= '<option value="' . $arrBrands['id'] . '">' . $arrBrands['name'] . '</option>';
                }
            }
            unset($intStatus, $intVehicle);
        }
        echo $strVehicleBrand;
    }

    //Brand Update Start
    public function actionViewBrand() {
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            $arrBrands = VehicleBrands::brandsReport($arrInputs);
            echo json_encode($arrBrands);
            exit;
        }
    }

    public function actionUpdateBrandDetails() {
        if (Yii::app()->request->isPostRequest) {
            $arrInput = $_POST;
            $arrValue = $this->actionPrepareInput($arrInput);
            $arrResponse = VehicleBrands::updateBrandDetails($arrValue);
            echo 'Updated Successfully';
            exit;
        }
    }

    //END

    public function actionPrepareInput($arrInput) {
        $objCommon = new DataManager();
        $arrCommon = $objCommon->getDefaults();
        $arrValue = array_merge($arrInput, $arrCommon);
        return $arrValue;
    }

    //Brand Model Update Start
    public function actionViewModels() {
        if (Yii::app()->request->isPostRequest) {
            $arrInputs = $_POST;
            $arrModels = VehicleBrandModels::brandModelsReport($arrInputs);
            echo json_encode($arrModels);
            exit;
        }
    }

    public function actionUpdateModelDetails() {
        if (Yii::app()->request->isPostRequest) {
            $arrInput = $_POST;
            $arrValue = $this->actionPrepareInput($arrInput);
            $arrResponse = VehicleBrandModels::updateBrandModelDetails($arrValue);
            echo 'Updated Successfully';
            exit;
        }
    }

    //END
}
