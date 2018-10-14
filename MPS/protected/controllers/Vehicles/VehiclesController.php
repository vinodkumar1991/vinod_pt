<?php

class VehiclesController extends Controller {

    /**
     * @author Ctel
     * @return array It will return an array response
     */
    public function actionVehicle() {
        $arrErrors = array();
        $strMsg = NULL;
        $arrVehicles = VehicleTypes::getVehicleTypes();
        $objDataManager = new DataManager();
        $arrYears = $objDataManager->getYears();

        if (isset($_POST['createVehicle'])) {
            $objVehicle = new VehicleForm();
            $objVehicle->attributes = $_POST;
            if ($objVehicle->validate()) {
                $objDataManager = new DataManager();
                $arrVehicle = $objDataManager->makeData($objVehicle->attributes);
                $intVehicleId = Vehicles::create($arrVehicle);
                if (!empty($intVehicleId)) {
                    $strMsg = 'Vehicle mapped successfully.';
                }
            } else {
                $arrErrors = $objVehicle->errors;
            }
        }
        $this->render('/Vehicles/Vehicles', array('vehicles' => $arrVehicles, 'years' => $arrYears, 'errors' => $arrErrors, 'success' => $strMsg));
    }

    /**
     * @author Ctel
     * @return string It will return a string
     */
    public function actionGetVehicleBrandModels() {
        $strVehicleModel = '<option value="">--Select Model--</option>';
        $arrVehicleModels = array();
        if (Yii::app()->request->isPostRequest) {
            $intVehicleBrandType = $_POST['vehicleBrand'];
            $arrVehicleModels = VehicleBrandModels::getVehicleBrandModels($intVehicleBrandType);
            if (!empty($arrVehicleModels)) {
                foreach ($arrVehicleModels as $arrModel) {
                    $strVehicleModel .= '<option value="' . $arrModel['id'] . '">' . $arrModel['name'] . '</option>';
                }
            }
        }
        echo $strVehicleModel;
    }

    public function actionGetVehicleCategories() {
        $strVehicleCategories = '<option value="">--Select Categories--</option>';
        $arrVehicleModels = array();
        if (Yii::app()->request->isPostRequest) {
            $intVehicle = $_POST['vehicle_id'];
            $arrVehicleCategories = VehicleCategories::getVehicleCategories(1, $intVehicle);
            if (!empty($arrVehicleCategories)) {
                foreach ($arrVehicleCategories as $arrCategory) {
                    $strVehicleCategories .= '<option value="' . $arrCategory['id'] . '">' . $arrCategory['name'] . '</option>';
                }
            }
        }
        echo $strVehicleCategories;
    }

    public function actionGetVehicleBrands() {
        $strVehicleBrand = '<option value="">--Select Brand--</option>';
        $arrVehicleBrands = array();
        if (Yii::app()->request->isPostRequest) {
            $intVehicle = $_POST['vehicle_id'];
            $arrVehicleBrands = VehicleBrands::getVehicleBrands(1, $intVehicle);
            if (!empty($arrVehicleBrands)) {
                foreach ($arrVehicleBrands as $arrBrand) {
                    $strVehicleBrand .= '<option value="' . $arrBrand['id'] . '">' . $arrBrand['name'] . '</option>';
                }
            }
        }
        echo $strVehicleBrand;
    }

    public function actionVehiclesReport() {
        $arrInputs = $_POST;
        $arrVehicleCategoryMapping = Vehicles::vehiclesReport($arrInputs);
        $this->render('/Vehicles/VehiclesReport', array('vehicle_mapping' => $arrVehicleCategoryMapping));
    }

    public function actionEditVehiclesReport() {
        $arrErrors = array();
        $strMsg = NULL;
        $objVehicleUpdateForm = NULL;
        $arrVehiclesTypes = VehicleTypes::getVehicleTypes();
        $intVehicleId = Yii::app()->request->getParam('id');
        $arrVehicleDetails = Vehicles::model()->vehiclesReport(array('id' => $intVehicleId));
        $objDataManager = new DataManager();
        $arrYears = $objDataManager->getYears();
        if (isset($_POST['update_vehicle'])) {
            $objVehicleUpdateForm = new VehicleUpdateForm();
            $objVehicleUpdateForm->attributes = $_POST;
            $objVehicleUpdateForm->id = $intVehicleId;
            if ($objVehicleUpdateForm->validate()) {
                $arrInputs = $objVehicleUpdateForm->attributes;
                $objDataManager = new DataManager();
                $arrInputs = $objDataManager->makeUpdateData($arrInputs);
                $arrModifiedInputs = $objDataManager->modifyVehicle($arrInputs);
                $intUpdateVehicle = Vehicles::updateVehicles($arrModifiedInputs["vehicles"], $intVehicleId);
                Yii::app()->user->setFlash('success', 'Updated Successfully.');
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objVehicleUpdateForm->errors;
            }
        }
        $this->render('/Vehicles/VehiclesEdit', array('errors' => $arrErrors, 'vehicle_details' => $arrVehicleDetails[0], 'vehicles' => $arrVehiclesTypes, 'years' => $arrYears, 'success' => $strMsg));
    }

}
