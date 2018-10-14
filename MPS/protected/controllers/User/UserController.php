<?php

class UserController extends Controller {

    public function actionCreate() {
        
    }

    public function actionMechanic() {
        $intRole = 1; // 1 => Mechanic ( Need to change)
        $intMechanicSkill = $objMechanicForm = NULL;
        $strMessage = NULL;
        $arrErrors = array();
        $arrVehicles = VehicleTypes::getVehicleTypes();
        $arrCountries = Countries::countriesReport();
        if (isset($_POST['mechanic_create'])) {
            $objMechanicForm = new MechanicForm();
            $objMechanicForm->attributes = $_POST;

            if ($objMechanicForm->validate()) {
                $objDataManager = new DataManager();
                $arrImagesParams = $this->actionUpload();
                //Assign Vehicle Type
                $intVehicleTypeID = $objMechanicForm->mechanic_vehicle_type;

                $arrModifiedMechanic = $objDataManager->modifyMechanic($objMechanicForm->attributes, $arrImagesParams);

                $objectTransaction = Yii::app()->db->beginTransaction();
                //Users
                $intUser = Users::create($arrModifiedMechanic['users']);
                //mechanic_shops
                $arrShop = array_merge($arrModifiedMechanic['mechanic_shops'], array('user_id' => $intUser));
                $intMechanicShop = MechanicShops::create($arrShop);
                //mechanic_shop_details
                $arrShopDetails = array_merge($arrModifiedMechanic['mechanic_shop_details'], array('mechanic_shop_id' => $intMechanicShop));
                $intMechanicShopDetails = MechanicShopDetails::create($arrShopDetails);

                //Mechanic Services
                if (isset($_POST['mechanic_selected_services']) && !empty($_POST['mechanic_selected_services'])) {
                    $arrMechanicShopSkills = array();
                    foreach ($_POST['mechanic_selected_services'] as $intSerKey => $intServalue) {
                        $arrMechanicShopSkills[] = array(
                            'mechanic_shops_id' => $intMechanicShop,
                            'vehicle_types_id' => $intVehicleTypeID,
                            'service_types_id' => $intServalue,
                            'total_mechanics' => $arrShopDetails['total_mechanics'],
                            'service_capability' => $arrShopDetails['service_capability'],
                        );
                    }
                    $intMechanicSkill = MechanicShopsServices::create($arrMechanicShopSkills);
                }
                if (!empty($intMechanicSkill)) {
                    $objectTransaction->commit();
                    $strMessage = 'Mechanic store created successfully.';
                } else {
                    $objectTransaction->rollback();
                }
                unset($intMechanicSkill, $intMechanicShopDetails, $intMechanicShop, $intUser);
                unset($arrMechanicShopSkills, $arrShopDetails, $arrShop, $arrShopDetails, $arrImagesParams, $arrModifiedMechanic);
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objMechanicForm->errors;
            }
        }
        $this->render('/User/Mechanic', array('vehicles' => $arrVehicles, 'countries' => $arrCountries, 'errors' => $arrErrors, 'message' => $strMessage, 'mechanicForm' => $objMechanicForm));
    }

    public function actionStates() {
        $strStates = '<option value="">--Select State--</option>';
        $arrCountryInput = $_POST;
        $arrStates = States::statesReport($arrCountryInput);
        if (!empty($arrStates)) {
            foreach ($arrStates as $arrEleState) {
                $strStates .= '<option value="' . $arrEleState['state_id'] . '">' . $arrEleState['state_name'] . '</option>';
            }
        }
        unset($arrCountryInput, $arrStates);
        echo $strStates;
    }

    public function actionCities() {
        $strCities = '<option value="">--Select City--</option>';
        $arrStateInput = $_POST;
        $arrCities = Cities::citiesReport($arrStateInput);
        if (!empty($arrCities)) {
            foreach ($arrCities as $arrEleCity) {
                $strCities .= '<option value="' . $arrEleCity['city_id'] . '">' . $arrEleCity['city_name'] . '</option>';
            }
        }
        unset($arrCities, $arrStateInput);
        echo $strCities;
    }

    public function actionAreas() {
        $strAreas = '<option value="">--Select Area--</option>';
        $arrCityInput = $_POST;
        $arrAreas = Areas::areasReport($arrCityInput);
        if (!empty($arrAreas)) {
            foreach ($arrAreas as $arrEleArea) {
                $strAreas .= '<option value="' . $arrEleArea['area_id'] . '">' . $arrEleArea['area_name'] . '</option>';
            }
        }
        unset($arrAreas, $arrCityInput);
        echo $strAreas;
    }

    public function actionServices() {
        $strServices = NULL;
        $intVehicle = $_POST['vehicle_id'];
        $arrServices = VehicleServiceTypes::getServiceTypes(1, $intVehicle);
        if (!empty($arrServices)) {
            foreach ($arrServices as $arrEleService) {
                $strServices .= '<option value="' . $arrEleService['id'] . '">' . $arrEleService['name'] . '</option>';
            }
        }
        unset($arrServices, $intVehicle);
        echo $strServices;
    }

    public function actionUpload($arrShopDetails = array()) {
        $arrModifiedMechanic = array();
        $strVehicleFolderName = 'mechanics';
        $arrImagesParams = array();
        //Photo
        if (isset($_FILES['mechanic_photo']['name']) && !empty($_FILES['mechanic_photo']['name'])) {
            if (isset($arrShopDetails[0]['shop_photo_image']) && !empty($arrShopDetails[0]['shop_photo_image'])) {
                $strPhotoPath = Yii::app()->params['real_image_path'] . 'mechanics/photo/original/' . $arrShopDetails[0]['shop_photo_image'];
                if (file_exists($strPhotoPath)) {
                    unlink($strPhotoPath);
                    unset($strPhotoPath);
                }
            }
            $arrImagesParams['mechanic_photo'] = $this->actionUploadPDF('mechanic_photo', 'photo', $strVehicleFolderName);
        }
        //ID Proof
        if (isset($_FILES['mechanic_id_proof']['name']) && !empty($_FILES['mechanic_id_proof']['name'])) {
            if (isset($arrShopDetails[0]['shop_id_image']) && !empty($arrShopDetails[0]['shop_id_image'])) {
                $strIdPath = Yii::app()->params['real_image_path'] . 'mechanics/id_proofs/original/' . $arrShopDetails[0]['shop_id_image'];
                if (file_exists($strIdPath)) {
                    unlink($strIdPath);
                    unset($strIdPath);
                }
            }
            $arrImagesParams['mechanic_id_proof'] = $this->actionUploadPDF('mechanic_id_proof', 'id_proofs', $strVehicleFolderName);
        }
        //Address Proof
        if (isset($_FILES['mechanic_address_proof']['name']) && !empty($_FILES['mechanic_address_proof']['name'])) {
            if (isset($arrShopDetails[0]['shop_address_image']) && !empty($arrShopDetails[0]['shop_address_image'])) {
                $strAddressPath = Yii::app()->params['real_image_path'] . 'mechanics/address/original/' . $arrShopDetails[0]['shop_address_image'];
                if (file_exists($strAddressPath)) {
                    unlink($strAddressPath);
                    unset($strAddressPath);
                }
            }
            $arrImagesParams['mechanic_address_proof'] = $this->actionUploadPDF('mechanic_address_proof', 'address', $strVehicleFolderName);
        }
        return $arrImagesParams;
    }

    public function actionUploadPDF($strFileName, $folder, $strDestination = 'mechanics') {
        $arrImageNames = array();
        if (isset($_FILES[$strFileName])) {
            $errors = array();
            $file_name = $_FILES[$strFileName]['name'];
            $file_size = $_FILES[$strFileName]['size'];
            $file_tmp = $_FILES[$strFileName]['tmp_name'];
            $file_type = $_FILES[$strFileName]['type'];
            //$file_ext = strtolower(end(explode('.', $_FILES[$strFileName]['name'])));


            $randString = md5(time()); //encode the timestamp - returns a 32 chars long string
            $fileName = $_FILES[$strFileName]["name"]; //the original file name
            $splitName = explode(".", $fileName); //split the file name by the dot
            $fileExt = end($splitName); //get the file extension
            $newFileName = strtolower($randString . '.' . $fileExt);

            if (empty($errors) == true) {
                $fixedPath = realpath(Yii::app()->basePath) . '/../images/uploadimages/' . $strDestination . '/';
                $ss = md5(time()) . 'pdf';
                move_uploaded_file($file_tmp, $fixedPath . $folder . '/original/' . $newFileName);
                $arrImageNames['timestampName'] = $newFileName;
                $arrImageNames['original_name'] = $file_name;
            }
        }
        return $arrImageNames;
    }

    public function actionMechanicReport() {
        $arrInputs = $_POST;
        $arrMechanicShops = MechanicShops::mechanicShopsReport();
        $this->render('/User/MechanicShopReport', array('mechanic_shops' => $arrMechanicShops));
    }

    public function actionCreateDeliveryBoys() {
        $arrErrors = array();
        $strMessage = NULL;
        $intMechanicShopDetails = NULL;
        $arrMechanicShops = MechanicShops::getMechanicShops();
        $objDeliveryForm = NULL;
        if (isset($_POST['delivery_create'])) {
            $objDeliveryForm = new DeliveryForm();
            $objDeliveryForm->attributes = $_POST;
            if ($objDeliveryForm->validate()) {
                $objDataManager = new DataManager();
                $arrImagesParams = $this->actionUploadDelivery();
                $arrModifiedDelivery = $objDataManager->modifyDelivery($objDeliveryForm->attributes, $arrImagesParams);
                $objectTransaction = Yii::app()->db->beginTransaction();
                //Users
                $intUser = Users::create($arrModifiedDelivery['users']);
                //delivery boys
                $arrDelivery = array_merge($arrModifiedDelivery['delivery_boys'], array('user_id' => $intUser));
                $intDelivery = DeliveryBoys::create($arrDelivery);
                //delivery_boys_details
                $arrDeliveryBoyAddressDetails = array_merge($arrModifiedDelivery['delivery_boy_address_details'], array('delivery_boys_id' => $intDelivery));
                $intMechanicShopDetails = DeliveryBoyAddressDetails::create($arrDeliveryBoyAddressDetails);
                if (!empty($intMechanicShopDetails)) {
                    $objectTransaction->commit();
                    unset($arrDeliveryBoyAddressDetails);
                    unset($intMechanicShopDetails);
                    $strMessage = 'Delivery boy created successfully.';
                } else {
                    $objectTransaction->rollback();
                }
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objDeliveryForm->errors;
            }
        }
        $this->render('/User/Delivery', array('mechanic_shops' => $arrMechanicShops, 'errors' => $arrErrors, 'message' => $strMessage, 'deliveryForm' => $objDeliveryForm));
    }

    public function actionDeliveryBoysReport() {
        $arrInputs = $_POST;
        $arrMechanicShops = DeliveryBoys::deliveryBoysReport($arrInputs);
        $this->render('/User/DeliveryBoysReport', array('delivery_boys' => $arrMechanicShops));
    }

    public function actionUploadDelivery($arrDeliveryBoy = array()) {
        $arrModifiedMechanic = array();
        $strDeliveryFolderName = 'delivery_boys';
        $arrImagesParams = array();
        //Photo
        if (isset($_FILES['delivery_photo']['name']) && !empty($_FILES['delivery_photo']['name'])) {
            if (isset($arrDeliveryBoy[0]['photo_path']) && !empty($arrDeliveryBoy[0]['photo_path'])) {
                $strPhotoPath = Yii::app()->params['real_image_path'] . 'delivery_boys/address/original/' . $arrDeliveryBoy[0]['photo_path'];
                if (file_exists($strPhotoPath)) {
                    unlink($strPhotoPath);
                }
            }
            $arrImagesParams['delivery_photo'] = $this->actionUploadPDF('delivery_photo', 'photo', $strDeliveryFolderName, 'delivery_boys');
        }
        //ID Proof
        if (isset($_FILES['delivery_id_proof']['name']) && !empty($_FILES['delivery_id_proof']['name'])) {
            if (isset($arrDeliveryBoy[0]['driving_license_path']) && !empty($arrDeliveryBoy[0]['driving_license_path'])) {
                $strLicensePath = Yii::app()->params['real_image_path'] . 'delivery_boys/id_proofs/original/' . $arrDeliveryBoy[0]['driving_license_path'];
                if (file_exists($strLicensePath)) {
                    unlink($strLicensePath);
                }
            }
            $arrImagesParams['delivery_id_proof'] = $this->actionUploadPDF('delivery_id_proof', 'id_proofs', $strDeliveryFolderName, 'delivery_boys');
        }
        //Address Proof
        if (isset($_FILES['delivery_address_proof']['name']) && !empty($_FILES['delivery_address_proof']['name'])) {
            if (isset($arrDeliveryBoy[0]['address_proof_path']) && !empty($arrDeliveryBoy[0]['address_proof_path'])) {
                $strAddressPath = Yii::app()->params['real_image_path'] . 'delivery_boys/address/original/' . $arrDeliveryBoy[0]['address_proof_path'];
                if (file_exists($strAddressPath)) {
                    unlink($strAddressPath);
                }
            }
            $arrImagesParams['delivery_address_proof'] = $this->actionUploadPDF('delivery_address_proof', 'address', $strDeliveryFolderName, 'delivery_boys');
        }
        return $arrImagesParams;
    }

    public function actionEditDeliveryBoy() {
        $arrErrors = array();
        $objDeliveryForm = NULL;
        $intDeliveryBoy = Yii::app()->request->getParam('id');
        $arrDeliveryBoy = DeliveryBoys::deliveryBoysReport(array('delivery_boy' => $intDeliveryBoy));
        if (isset($_POST['update_delivery_boys'])) {
            $objDeliveryForm = new DeliveryForm();
            $objDeliveryForm->attributes = $_POST;
            $objDeliveryForm->id = $intDeliveryBoy;
            $objDeliveryForm->delivery_username = $arrDeliveryBoy[0]['username'];
            $objDeliveryForm->delivery_password = $arrDeliveryBoy[0]['password'];
            $objDeliveryForm->delivery_confirm_password = $arrDeliveryBoy[0]['password'];
            $objDeliveryForm->users_id = $arrDeliveryBoy[0]['users_id'];
            if ($objDeliveryForm->validate()) {
                $arrInputs = $_POST;
                $arrImagesParams = $this->actionUploadDelivery($arrDeliveryBoy);
                $objDataManager = new DataManager();
                $arrModifiedInputs = $objDataManager->modifyDeliveryGuy($arrInputs, $arrImagesParams);
                //Delivery Boy
                $intUpdateDelivery = DeliveryBoys::updateDeliveryBoy($arrModifiedInputs['delivery_boy'], $intDeliveryBoy);
                //Delivery Boy Details
                $intUpdateDeliveryAddress = DeliveryBoyAddressDetails::updateDeliveryBoyDetails($arrModifiedInputs['delivery_boy_details'], $intDeliveryBoy);
                Yii::app()->user->setFlash('success', 'Updated Successfully');
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objDeliveryForm->errors;
            }
        }
        $this->render('/User/EditDeliveryBoy', array('errors' => $arrErrors, 'delivery_boy_details' => $arrDeliveryBoy, 'deliveryForm' => $objDeliveryForm));
    }

    public function actionEditMechanic() {
        $arrErrors = array();
        $objMechanicForm = NULL;
        $intMechanic = Yii::app()->request->getParam('id');
        $arrMechanic = MechanicShops::mechanicShopsReport(array('mechanic_id' => $intMechanic));
        //Countries
        $arrCountries = Countries::countriesReport(array('status' => 1));
        //States
        if (isset($arrMechanic[0]['shop_state']) && !empty($arrMechanic[0]['shop_state'])) {
            $arrStates = States::statesReport(array('state_id' => $arrMechanic[0]['shop_state']));
        }
        //Cities
        if (isset($arrMechanic[0]['shop_city']) && !empty($arrMechanic[0]['shop_city'])) {
            $arrCities = Cities::citiesReport(array('city_id' => $arrMechanic[0]['shop_city']));
        }
        //Area
        if (isset($arrMechanic[0]['shop_area']) && !empty($arrMechanic[0]['shop_area'])) {
            $arrAreas = Areas::areasReport(array('area_id' => $arrMechanic[0]['shop_area']));
        }
        //Vehicles
        $arrVehicles = VehicleTypes::getVehicleTypes();
        //Services
        $arrVehicleServices = VehicleServiceTypes::getServiceTypes(1, $arrMechanic[0]['shop_vehicle_id']);
        //Shop Services
        $arrMechanicServices = MechanicShopsServices::getMechanicServices($intMechanic);
        $objDataManager = new DataManager();
        $arrShopServices = $objDataManager->modifyShopServices($arrMechanicServices);
        if (isset($_POST['mechanic_update'])) {
            $objMechanicForm = new MechanicForm();
            $objMechanicForm->attributes = $_POST;
            $objMechanicForm->id = $intMechanic;
            $objMechanicForm->mechanic_username = $arrMechanic[0]['username'];
            $objMechanicForm->mechanic_password = $arrMechanic[0]['shop_password'];
            $objMechanicForm->mechanic_confirm_password = $arrMechanic[0]['shop_password'];
            $objMechanicForm->shopUserId = $arrMechanic[0]['shop_user_id'];
            if ($objMechanicForm->validate()) {
                $arrInputs = $_POST;
                $arrImageParams = $this->actionUpload($arrMechanic);
                $arrModifiedInputs = $objDataManager->modifyShop($arrInputs, $arrImageParams, $intMechanic);
                //Mechanic Shop
                MechanicShops::updateShop($arrModifiedInputs['mechanic_shops'], $intMechanic);
                //Mechanic Shop Details
                MechanicShopDetails::updateShopDetails($arrModifiedInputs['mechanic_shop_details'], $intMechanic);
                //Mechanic Shop Services
                MechanicShopsServices::create($arrModifiedInputs['selected_services'], $intMechanic);
                Yii::app()->user->setFlash('success', 'Updated Successfully');
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objMechanicForm->errors;
            }
        }
        $this->render('/User/EditMechanic', array('errors' => $arrErrors, 'mechanic_details' => $arrMechanic, 'editMechanicForm' => $objMechanicForm, 'countries' => $arrCountries, 'states' => $arrStates, 'cities' => $arrCities, 'areas' => $arrAreas, 'vehicles' => $arrVehicles, 'vehicle_services' => $arrVehicleServices, 'shop_services' => $arrShopServices));
    }
 public function actionGetCustomers(){
         $arrDetails = Customer::model()->getCustomer(NULL, NULL, NULL);
        
          $this->render('/User/Customers',array('arrCustomers' => $arrDetails));
    }

}
