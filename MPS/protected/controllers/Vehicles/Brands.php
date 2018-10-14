<?php

class BrandsController extends Controller {

    /**
     * @author Ctel
     * @return array It will return an array response
     */
    public function actionVehicle() {
        $arrErrors = array();
        $arrVehicleCategories = VehicleCategories::getVehicleCategories();
        $intCars = 1;
        $arrVehicleBrands = VehicleBrands::getVehicleBrands(1, $intCars);
        $objDataManager = new DataManager();
        $arrYears = $objDataManager->getYears();

        if (isset($_POST['createVehicle'])) {
            $objVehicle = new VehicleForm();
            $objVehicle->attributes = $_POST;
            if ($objVehicle->validate()) {
                $strFileName = CommonFunctions::uploadImage($strInputName = 'vehicleImage');
                $objDataManager = new DataManager();
                $arrVehicle = $objDataManager->makeData($objVehicle->attributes);
                $intVehicleId = Vehicles::create($arrVehicle);
                $arrResponse = array();
            } else {
                $arrErrors = $objVehicle->errors;
            }
        }
        $this->render('/Vehicles/Vehicles', array('categories' => $arrVehicleCategories, 'brands' => $arrVehicleBrands, 'years' => $arrYears, 'errors' => $arrErrors));
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

    public function actionTest() {
        
    }

}
