<?php

class AgentController extends Controller {

    public function actionCreate() {
        $arrErrors = array();
        $objAgentForm = $strMessage = NULL;
        $arrCountries = Countries::countriesReport(array('status' => 1));
        if (isset($_POST['create_agent'])) {
            $objAgentForm = new AgentForm();
            $objAgentForm->attributes = $_POST;
            if ($objAgentForm->validate()) {
                $arrImagesParams = $this->actionUpload();
                $objDataManager = new DataManager();
                $arrModifiedAgent = $objDataManager->modifyAgentDetails($_POST, $arrImagesParams);
                $objectTransaction = Yii::app()->db->beginTransaction();
//Users        
                $intUser = Users::create($arrModifiedAgent['user']);
//Agent
                $arrAgent = array_merge($arrModifiedAgent['agent'], array('user_id' => $intUser));
                $intAgent = Agent::create($arrAgent);
//Agent Details
                $arrAgentDetails = array_merge($arrModifiedAgent['agent_communication'], array('agents_id' => $intAgent));
                $intAgentDetails = AgentDetails::create($arrAgentDetails);
                if (!empty($intAgentDetails)) {
                    $objectTransaction->commit();
                    $strMessage = 'Agent created successfully.';
                } else {
                    $objectTransaction->rollback();
                }
            } else {
                $arrErrors = $objAgentForm->errors;
            }
        }
        $this->render('/SelfDrive_NEW/Agents', array('errors' => $arrErrors, 'countries' => $arrCountries, 'message' => $strMessage));
    }

    public function actionUpload($arrAgentDetails = array()) {
        $arrModifiedAgent = array();
        $strAgentFolder = 'selfdrive';
        $arrImagesParams = array();
//Photo
        if (isset($_FILES['agent_photo']) && !empty($_FILES['agent_photo']['name'])) {
            if (isset($arrAgentDetails[0]['agent_photo']) && !empty($arrAgentDetails[0]['agent_photo'])) {
                $strAddressPath = Yii::app()->params['real_image_path'] . 'selfdrive/agents/photo/original/' . $arrAgentDetails[0]['agent_photo'];
                if (file_exists($strAddressPath)) {
                    unlink($strAddressPath);
                }
            }
            $arrImagesParams['agent_photo'] = $this->actionUploadPDF('agent_photo', 'photo', $strAgentFolder);
        }
//ID Proof
        if (isset($_FILES['agent_id_proof']) && !empty($_FILES['agent_id_proof']['name'])) {
            if (isset($arrAgentDetails[0]['id_image']) && !empty($arrAgentDetails[0]['id_image'])) {
                $strIdProofPath = Yii::app()->params['real_image_path'] . '/selfdrive/agents/id_proofs/original/' . $arrAgentDetails[0]['id_image'];
                if (file_exists($strIdProofPath)) {
                    unlink($strIdProofPath);
                }
            }
            $arrImagesParams['agent_id_proof'] = $this->actionUploadPDF('agent_id_proof', 'id_proofs', $strAgentFolder);
        }
//Address Proof
        if (isset($_FILES['agent_address_proof']) && !empty($_FILES['agent_address_proof']['name'])) {
            if (isset($arrAgentDetails[0]['address_image']) && !empty($arrAgentDetails[0]['address_image'])) {
                $strPhotoPath = Yii::app()->params['real_image_path'] . '/selfdrive/agents/address/original/' . $arrAgentDetails[0]['address_image'];
                if (file_exists($strPhotoPath)) {
                    unlink($strPhotoPath);
                }
            }
            $arrImagesParams['agent_address_proof'] = $this->actionUploadPDF('agent_address_proof', 'address', $strAgentFolder);
        }
        //Registration Certificate
        if (isset($_FILES['agent_registration_certificate']) && !empty($_FILES['agent_registration_certificate']['name'])) {
            if (isset($arrAgentDetails[0]['register_image']) && !empty($arrAgentDetails[0]['register_image'])) {
                $strRegistrationPath = Yii::app()->params['real_image_path'] . '/selfdrive/agents/registration/original/' . $arrAgentDetails[0]['register_image'];
                if (file_exists($strRegistrationPath)) {
                    unlink($strRegistrationPath);
                }
            }
            $arrImagesParams['agent_registration_certificate'] = $this->actionUploadPDF('agent_registration_certificate', 'registration', $strAgentFolder);
        }
        return $arrImagesParams;
    }

    public function actionUploadPDF($strFileName, $folder, $strDestination = 'selfdrive', $strTo = 'agents') {
        $arrImageNames = array();
        if (isset($_FILES[$strFileName])) {
            $errors = array();
            $file_name = $_FILES[$strFileName]['name'];
            $file_size = $_FILES[$strFileName]['size'];
            $file_tmp = $_FILES[$strFileName]['tmp_name'];
            $file_type = $_FILES[$strFileName]['type'];


            $randString = md5(time()); //encode the timestamp - returns a 32 chars long string
            $fileName = $_FILES[$strFileName]["name"]; //the original file name
            $splitName = explode(".", $fileName); //split the file name by the dot
            $fileExt = end($splitName); //get the file extension
            $newFileName = strtolower($randString . '.' . $fileExt);


            if (empty($errors) == true) {
                $fixedPath = realpath(Yii::app()->basePath) . '/../images/uploadimages/' . $strDestination . '/';
                if ('hire' == $strTo) {
                    
                } elseif ('agents' == $strTo) {
                    $fixedPath .= $strTo . '/';
                }

                move_uploaded_file($file_tmp, $fixedPath . $folder . '/original/' . $newFileName);
                $arrImageNames['timestampName'] = $newFileName;
                $arrImageNames['original_name'] = $file_name;
            }
        }
        return $arrImageNames;
    }

    public function actionAgentsReport() {
        $arrInputs = array();
        $arrAgents = Agent::agentsReoport($arrInputs);
        $this->render('/SelfDrive_NEW/AgentsReport', array('agents_report' => $arrAgents));
    }

    public function actionVehicleFeatureform() {
        $arrErrors = array();
        $objVehicleFeatureForm = NULL;
        $arrVehicles = VehicleTypes::getVehicleTypes();
        if (isset($_POST['vehicle_feature_create'])) {
            $objVehicleFeatureForm = new VehiclesFeatureForm();
            $objVehicleFeatureForm->attributes = $_POST;
            if ($objVehicleFeatureForm->validate()) {
                $arrCommon = array();
                $arrInputs = $objVehicleFeatureForm->attributes;
                $objDataManager = new DataManager();
                //Feature Image :: START
                if (isset($_FILES['vehicle_feature_image']['name'])) {
                    $strFileName = 'vehicle_feature_image';
                    $strVehicleFolderName = '/vehicle_features/';
                    $arrImageDimensions = array(
                        array('width' => 24, 'height' => 24, "device" => "24x24", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                        array('width' => 48, 'height' => 48, "device" => "48x48", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                        array('width' => 72, 'height' => 72, "device" => "72x72", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                    );
                    $arrCommon = $objDataManager->uploadFile($strFileName, $arrImageDimensions);
                }
                //Feature Image :: END
                $arrModifiedInput = $objDataManager->makeData($arrInputs);
                $arrModifiedInput = array_merge($arrModifiedInput, $arrCommon);
                $intVehicleFeature = VehicleFeatures::create($arrModifiedInput);
                if (!empty($intVehicleFeature)) {
                    Yii::app()->user->setFlash('success', $arrModifiedInput['vehicle_feature_name'] . ' is aded successfully.');
                } else {
                    Yii::app()->user->setFlash('failure', 'Oops error occured. Please try again.');
                }
                unset($intVehicleFeature);
                unset($arrModifiedInput);
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objVehicleFeatureForm->errors;
            }
        }
        return $this->render('/SelfDrive_NEW/Vehicle_feature_form', array('errors' => $arrErrors, 'vehiclefeatureForm' => $objVehicleFeatureForm, 'vehicle_types' => $arrVehicles));
    }

    public function actionVehicleFeatureReport() {
        $arrInputs = array();
        $arrVehicleFeature = VehicleFeatures::vehiclefeatureReport($arrInputs);
        $this->render('/SelfDrive_NEW/VehicleFeatureReport', array('vehicle_report' => $arrVehicleFeature));
    }

    public function actionEditVehicleFeature() {
        $arrErrors = $arrCommon = array();
        $objVehicleFeatureForm = NULL;
        $intFeatureId = Yii::app()->request->getParam('id');
        $arrVehicleDetails = VehicleFeatures::vehiclefeatureReport(array('id' => $intFeatureId));
        $arrVehicles = VehicleTypes::getVehicleTypes();
        if (isset($_POST['vehicle_feature_create'])) {
            $objVehicleFeatureForm = new VehiclesFeatureForm();
            $objVehicleFeatureForm->attributes = $_POST;
            $objVehicleFeatureForm->id = $intFeatureId;
            if ($objVehicleFeatureForm->validate()) {
                $arrInputs = $_POST;
                $objDataManager = new DataManager();
                $arrModifiedData = $objDataManager->makeUpdateData($arrInputs);
                //Vehicle Feature Image :: START
                if (isset($_FILES['vehicle_feature_image']['name']) && !empty($_FILES['vehicle_feature_image']['name'])) {
                    $strFileName = 'vehicle_feature_image';
                    $strVehicleFolderName = '/vehicle_features/';
                    $arrImageDimensions = array(
                        array('width' => 24, 'height' => 24, "device" => "24x24", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                        array('width' => 48, 'height' => 48, "device" => "48x48", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                        array('width' => 72, 'height' => 72, "device" => "72x72", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                    );
                    $arrCommon = $objDataManager->uploadFile($strFileName, $arrImageDimensions);
                }
                //Vehicle Feature Image :: END
                $arrModifiedData = array_merge($arrCommon, $arrModifiedData);
                $arrModifiedData = $objDataManager->modifyVehicleFeatureData($arrModifiedData);
                $intVehicleFeature = VehicleFeatures::updatevehicleFeature($arrModifiedData, $intFeatureId);
                if (!empty($intVehicleFeature)) {
                    Yii::app()->user->setFlash('success', 'Updated Successfully.');
                } else {
                    Yii::app()->user->setFlash('failure', Yii::t('common', 'common.form.add_failure'));
                }
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objVehicleFeatureForm->errors;
            }
        }
        $this->render('/SelfDrive_NEW/Vehicle_feature_form', array('errors' => $arrErrors, 'vehiclefeatureForm' => $objVehicleFeatureForm, 'vehicle_details' => $arrVehicleDetails, 'vehicle_types' => $arrVehicles));
    }

    public function actionAgentVehicle() {
        $strMessage = NULL;
        $arrErrors = array();
        $intAgentId = NULL;
        if (6 != Yii::app()->session['role_id']) {
            $arrAgents = Agent::agentsReoport(array('agent_user_id' => Yii::app()->session['user_id']));
            $intAgentId = $arrAgents[0]['agent_id'];
        } else if (6 == Yii::app()->session['role_id']) {
            $arrAgents = Agent::agentsReoport();
        }
        $arrVehicles = VehicleTypes::getVehicleTypes();
        $arrVehicleSeatings = array(
            '1' => '4 Seater',
            '2' => '6 Seater',
            '3' => '10 Seater',
            '4' => '15 Seater',
        );
        $arrVehicleVariants = VehicleVariants::getVehicleVeriants();
        $arrVehicleFeatures = VehicleFeatures::getVehicleFeatures(1, NULL, 1);
        $objAgentVehicleForm = NULL;
        if (isset($_POST['create_agent_vehicle'])) {
            $objAgentVehicleForm = new AgentVehicleForm();
            $objAgentVehicleForm->attributes = $_POST;
            if (!empty($intAgentId)) {
                $objAgentVehicleForm->vehicle_agent_id = $intAgentId;
            }
            if ($objAgentVehicleForm->validate()) {
                $arrUploadedImageFiles = array();
                $arrCommon = array();
                $arrInputs = $objAgentVehicleForm->attributes;
                $objDataManager = new DataManager();
//Vehicle Primary Image :: START
                if (isset($_FILES['vehicle_primary_image']['name']) && !empty($_FILES['vehicle_primary_image']['name'])) {
                    $strFileName = 'vehicle_primary_image';
                    $strVehicleFolderName = NULL;
                    if (1 == $arrInputs['vehicle_type_id']) {
                        $strVehicleFolderName = '/selfdrive/cars';
                    } else {
                        $strVehicleFolderName = '/selfdrive/bikes';
                    }

                    $arrImageDimensions = array(
                        array('width' => 450, 'height' => 260, "device" => "450X260", 'folder_path' => $strVehicleFolderName . '/web/'),
                        array('width' => 280, 'height' => 162, "device" => "280X162", 'folder_path' => $strVehicleFolderName . '/web/'),
                        array('width' => 60, 'height' => 35, "device" => "60X35", 'folder_path' => $strVehicleFolderName . '/web/'),
                        array('width' => 768, 'height' => 576, "device" => "768X576", 'folder_path' => $strVehicleFolderName . '/web/'),
                        array('width' => 450, 'height' => 260, "device" => "450X260", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                        array('width' => 280, 'height' => 162, "device" => "280X162", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                        array('width' => 60, 'height' => 35, "device" => "60X35", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                        array('width' => 768, 'height' => 576, "device" => "768X576", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                    );
                    $arrCommon[] = $objDataManager->uploadFile($strFileName, $arrImageDimensions);
                }
//Vehicle Primary Image :: END
//Vehicle Multiple Images :: START
                if (isset($_FILES['vehicle_multiple_images']['name']) && !empty($_FILES['vehicle_multiple_images']['name'])) {
                    $arrMultiFileNames = $_FILES['vehicle_multiple_images']['name'];
                    $strMulVehicleFolderName = NULL;
                    if (1 == $arrInputs['vehicle_type_id']) {
                        $strMulVehicleFolderName = '/selfdrive/multi_images/cars';
                    } else {
                        $strMulVehicleFolderName = '/selfdrive/multi_images/bikes';
                    }
                    $arrImageDimensions = array(
                        array('width' => 450, 'height' => 260, "device" => "450X260", 'folder_path' => $strMulVehicleFolderName . '/web/'),
                        array('width' => 280, 'height' => 162, "device" => "280X162", 'folder_path' => $strMulVehicleFolderName . '/web/'),
                        array('width' => 60, 'height' => 35, "device" => "60X35", 'folder_path' => $strMulVehicleFolderName . '/web/'),
                        array('width' => 768, 'height' => 576, "device" => "768X576", 'folder_path' => $strMulVehicleFolderName . '/web/'),
                        array('width' => 450, 'height' => 260, "device" => "450X260", 'folder_path' => $strMulVehicleFolderName . '/mobile/'),
                        array('width' => 280, 'height' => 162, "device" => "280X162", 'folder_path' => $strMulVehicleFolderName . '/mobile/'),
                        array('width' => 60, 'height' => 35, "device" => "60X35", 'folder_path' => $strMulVehicleFolderName . '/mobile/'),
                        array('width' => 768, 'height' => 576, "device" => "768X576", 'folder_path' => $strMulVehicleFolderName . '/mobile/'),
                    );


                    foreach ($arrMultiFileNames as $key => $value) {
                        $collectTempNames = array();
                        $collectOriginalNames = array();
                        $arrImages[] = $objDataManager->uploadMultipleFiles($_FILES['vehicle_multiple_images']['name'][$key], $arrImageDimensions, $_FILES['vehicle_multiple_images']['tmp_name'][$key]);
                    }
                }
//Vehicle Multiple Images :: END
                $arrUploadedImageFiles = array_merge($arrCommon, $arrImages);
                $arrModifiedInputs = $objDataManager->makeData($arrInputs);
                $strAgentVehicleCode = 'AV-' . CommonFunctions::getNumberToken(5);
                $intAgent = $arrModifiedInputs['vehicle_agent_id'];
                $arrModifiedInputs = array_merge($arrModifiedInputs, array('code' => $strAgentVehicleCode, 'agents_id' => $intAgent));
                $objectTransaction = Yii::app()->db->beginTransaction();
//Self Vehicles :: START
                $intSelfVehicle = SelfVehicles::create($arrModifiedInputs);
//Self Vehicles :: END
//Self Vehicle Features :: START
                $arrVehicleFeatures = $objDataManager->modifyVehicleFeatures($arrInputs, $intSelfVehicle);
                $intVehicleFeature = SelfVehiclesFeatures::create($arrVehicleFeatures);
//Self Vehicle Features :: END
//Self Vehicle Images :: START
                $arrModifiedImages = $objDataManager->modifyVehicleImages($arrUploadedImageFiles, $intSelfVehicle);
                $intSelfVehicleImage = SelfVehicleImage::create($arrModifiedImages, $intSelfVehicle);
//Self Vehicle Images :: END
                if (!empty($intSelfVehicleImage)) {
                    $strMessage = 'Vehicle Created';
                    $objectTransaction->commit();
                } else {
                    $strMessage = 'Oops error occured.';
                    $objectTransaction->rollback();
                }
                unset($arrModifiedInputs, $arrModifiedImages, $arrVehicleFeatures);
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objAgentVehicleForm->errors;
            }
        }

        $this->render('/SelfDrive_NEW/AddVehicles', array("errors" => $arrErrors, 'vehicles' => $arrVehicles, 'vehicle_seating' => $arrVehicleSeatings, 'vehicle_variants' => $arrVehicleVariants, 'vehicle_features' => $arrVehicleFeatures, 'agentVehicleForm' => $objAgentVehicleForm, 'message' => $strMessage, 'agents' => $arrAgents));
    }

    /**
     * @author Ctel
     * @return string It will return a string
     */
    public function actionGetVehicleClasses() {
        $strVehicleClass = '<option value="">--Select Category--</option>';
        if (Yii::app()->request->isPostRequest) {
            $intVehicle = $_POST['vehicle_id'];
            $arrVehicleClasses = VehicleClasses::getVehicleClasses(1, NULL, $intVehicle);
            if (!empty($arrVehicleClasses)) {
                foreach ($arrVehicleClasses as $arrClass) {
                    $strVehicleClass .= '<option value="' . $arrClass['id'] . '">' . $arrClass['name'] . '</option>';
                }
            }
        }
        echo $strVehicleClass;
    }

    public function actionAgentVehiclesReport() {
        $intAgentId = NULL;
        if (6 != Yii::app()->session['role_id']) {
            $arrAgents = Agent::agentsReoport(array('agent_user_id' => Yii::app()->session['user_id']));
            $intAgentId = $arrAgents[0]['agent_id'];
        }
        $arrVehiclesReport = SelfVehicles::agentVehiclesReport(array('agent_id' => $intAgentId));
        $this->render('/SelfDrive_NEW/AgentVehiclesReport', array('vehicles_report' => $arrVehiclesReport));
    }

    public function actionWeekEndORDays() {
        $arrErrors = array();
        $objWeekForm = NULL;
        $arrVehicleDetails = array();
        $isWeekEndOrWeekDay = Yii::app()->getRequest()->getQuery('type');
        $intSelfVehicle = Yii::app()->getRequest()->getQuery('id');
        $arrVehicleBillDetails = SelfVehiclesDetails::getSelfVehicleDetails(array('self_vehicles_id' => $intSelfVehicle, 'week_day_or_end' => $isWeekEndOrWeekDay));
        if (isset($_POST['add_self_vehicle_price'])) {
            $objWeekForm = new WeekForm();
            $objWeekForm->attributes = $_POST;

            if ($objWeekForm->validate()) {
                $arrInputs = $_POST;
                $objDataManager = new DataManager();
                $arrModifiedInputs = $objDataManager->makeData($arrInputs);
                $arrModifiedInputs = array_merge($arrModifiedInputs, array('week_day_or_end' => $isWeekEndOrWeekDay, 'self_vehicles_id' => $intSelfVehicle));
                $intSelfVehicleDetails = SelfVehiclesDetails::create($arrModifiedInputs);
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objWeekForm->errors;
            }
        }
        $this->render('/SelfDrive_NEW/WeekDays', array('errors' => $arrErrors, 'vehicle_billing' => $arrVehicleBillDetails, 'weekForm' => $objWeekForm));
    }

    public function actionVehicleTimings() {
        $intSelfVehicle = Yii::app()->getRequest()->getQuery('id');
        $arrErrors = array();
        $objVehicleTimingForm = NULL;
        $arrSelfVehiclesTiming = VehicleTimings::VehicleTimingReport(array('self_vehicles_id' => $intSelfVehicle));
        if (isset($_POST['add_vehicles_timings'])) {
            $objVehicleTimingForm = new VehicleTimingForm();
            $objVehicleTimingForm->attributes = $_POST;
            if ($objVehicleTimingForm->validate()) {
                $arrInputs = $_POST;
                $objDataManager = new DataManager();
                $arrModifiedInputs = $objDataManager->makeData($arrInputs);
                $arrModifiedInputs = array_merge($arrModifiedInputs, array('self_vehicles_id' => $intSelfVehicle));
                $intVehicleTiming = VehicleTimings::create($arrModifiedInputs);
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objVehicleTimingForm->errors;
            }
        }
        $this->render('/SelfDrive_NEW/VehicleTimings', array('errors' => $arrErrors, 'vehicleTimingsForm' => $objVehicleTimingForm, 'SelfVehiclesTiming' => $arrSelfVehiclesTiming));
    }

    public function actionCreate1() {
        $arrErrors = array();
        $objHireAMechanicForm = NULL;
        $arrVehicles = VehicleTypes::getVehicleTypes();
        if (isset($_POST['create_hire'])) {
            $objHireAMechanicForm = new HireAMechanicForm();
            $objHireAMechanicForm->attributes = $_POST;
            if ($objHireAMechanicForm->validate()) {
                $arrInputs = $objHireAMechanicForm->attributes;
                $arrFileParams = $this->actionUploads();
                $objDataManager = new DataManager();
                //Feature Image :: START
                if (isset($_FILES['hire_photo']['name'])) {
                    $strFileName = 'hire_photo';
                    $strVehicleFolderName = '/hireamechanic/';
                    $arrImageDimensions = array(
                        array('width' => 280, 'height' => 162, "device" => "280X162", 'folder_path' => $strVehicleFolderName . '/photo/'),
                        array('width' => 450, 'height' => 260, "device" => "450X260", 'folder_path' => $strVehicleFolderName . '/photo/'),
                        array('width' => 60, 'height' => 35, "device" => "60X35", 'folder_path' => $strVehicleFolderName . '/photo/'),
                        array('width' => 768, 'height' => 576, "device" => "768X576", 'folder_path' => $strVehicleFolderName . '/photo/'),
                    );
                    $arrPhoto = $objDataManager->uploadFile($strFileName, $arrImageDimensions);
                }
                //Feature Image :: END
                $arrFileParams = array_merge($arrFileParams, array('hire_photo' => $arrPhoto));
                $objDataManager = new DataManager();
                // $arrInputs = array_merge($arrInputs, array('hire_code' => 'HM-' . CommonFunctions::getNumberToken(4)));

                /* Code Format START */
                $arrHotOrderData = HireAMechanic::getHireCode();
                $strKey = Yii::app()->params['service_codes']['registration_ids']['hireamechanic'];
                $strHireCode = 'MPSHMCH0000001';
                $intDigit = Yii::app()->params['service_codes']['registration_ids']['hire_digit'];
                $intPadding = Yii::app()->params['service_codes']['registration_ids']['hire_padding'];

                if (!empty($arrHotOrderData)) {
                    $objectDataManager = new DataManager();
                    $intPartialMaxNumber = $objectDataManager->getHotOrderNumber($arrHotOrderData[0]['code'], $intDigit);
                    $strHireCode = $objectDataManager->getNewOrderNumber($intPartialMaxNumber, $strKey, $intPadding);
                }
                /* Code Format END */

                $arrInputs = array_merge($arrInputs, array('hire_code' => $strHireCode));
                $arrModifiedInputs = $objDataManager->modifyHire($arrInputs, $arrFileParams);
                $objectTransaction = Yii::app()->db->beginTransaction();
                //HireaMechanic :: START
                $intHire = HireAMechanic::create($arrModifiedInputs['hire_a_mechanic']);
                //HireaMechanicEmail :: START
                $arrModifiedInputs['hire_a_mechanic_email'] = array_merge($arrModifiedInputs['hire_a_mechanic_email'], array('hire_a_mechanic_id' => $intHire));
                $intHireEmailId = HireAMechanicEmail::create($arrModifiedInputs['hire_a_mechanic_email']);
                //HireaMechanicPhone :: START
                $arrModifiedInputs['hire_a_mechanic_phone'] = array_merge($arrModifiedInputs['hire_a_mechanic_phone'], array('hire_a_mechanic_id' => $intHire));
                $intHirePhoneId = HireAMechanicPhone::create($arrModifiedInputs['hire_a_mechanic_phone']);
                //HireaMechanicAddress :: START
                $arrModifiedInputs['hire_a_mechanic_address'] = array_merge($arrModifiedInputs['hire_a_mechanic_address'], array('hire_a_mechanic_id' => $intHire));
                $intHireAddressId = HireAMechanicAddress::create($arrModifiedInputs['hire_a_mechanic_address']);
                //HireaMechanicCommunication :: START
                $arrModifiedInputs['hire_a_mechanic_communication'] = array_merge($arrModifiedInputs['hire_a_mechanic_communication'], array('hire_a_mechanic_id' => $intHire));
                $intHireCommunicationId = HireAMechanicCommunication::create($arrModifiedInputs['hire_a_mechanic_communication']);
                $arrModifiedCertificates = $objDataManager->modifyHireCertificates($arrFileParams['hire_certificates'], $intHire);
                $intCertificateId = HireAMechanicCertificates::create($arrModifiedCertificates);
                if (!empty($intCertificateId)) {
                    $objectTransaction->commit();
                } else {
                    $objectTransaction->rollback();
                }
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objHireAMechanicForm->errors;
            }
        }
        $this->render('/HireAMechanic/HireAMechanic', array('errors' => $arrErrors, 'vehicles' => $arrVehicles, 'hireForm' => $objHireAMechanicForm));
    }

    public function actionUploads($arrHire = array(), $arrHireCertificates = array()) {
        $arrModifiedAgent = array();
        $strHireFolder = 'hireamechanic';
        $arrImagesParams = array();
        $strTo = 'hire';
//ID Proof
        if (isset($_FILES['hire_id_proof']['name']) && !empty($_FILES['hire_id_proof']['name'])) {
            if (isset($arrHire[0]['hire_id_image']) && !empty($arrHire[0]['hire_id_image'])) {
                $strHireIdPath = Yii::app()->params['real_image_path'] . 'hireamechanic/id_proofs/original/' . $arrHire[0]['hire_id_image'];
                if (file_exists($strHireIdPath)) {
                    unlink($strHireIdPath);
                }
            }
            $arrImagesParams['hire_id_proof'] = $this->actionUploadPDF('hire_id_proof', 'id_proofs', $strHireFolder, $strTo);
        }
//Address Proof
        if (isset($_FILES['hire_address_proof']['name']) && !empty($_FILES['hire_address_proof']['name'])) {
            if (isset($arrHire[0]['hire_address_image']) && !empty($arrHire[0]['hire_address_image'])) {
                $strHireAddressPath = Yii::app()->params['real_image_path'] . 'hireamechanic/address/original/' . $arrHire[0]['hire_address_image'];
                if (file_exists($strHireAddressPath)) {
                    unlink($strHireAddressPath);
                }
            }
            $arrImagesParams['hire_address_proof'] = $this->actionUploadPDF('hire_address_proof', 'address', $strHireFolder, $strTo);
        }
        //Registration Certificate
        if (isset($_FILES['hire_certificates']['name']) && !empty($_FILES['hire_certificates']['name'])) {
            $arrCertificates = $_FILES['hire_certificates']['name'];
            if (!empty($arrHireCertificates[0]) && !empty($arrCertificates[0])) {
                foreach ($arrHireCertificates as $arrCertificate) {
                    $strHireCertificate = Yii::app()->params['real_image_path'] . 'hireamechanic/certificates/original/' . $arrCertificate['image_name'];
                    if (file_exists($strHireCertificate)) {
                        unlink($strHireCertificate);
                    }
                }
            }
            foreach ($arrCertificates as $key => $value) {
                $arrCertificateParams[] = $this->uploadMultiPDFS($_FILES['hire_certificates']['name'][$key], $_FILES['hire_certificates']['tmp_name'][$key], 'hireamechanic', $key);
            }
            $arrImagesParams['hire_certificates'] = $arrCertificateParams;
        }
        return $arrImagesParams;
    }

    public function uploadMultiPDFS($strFileName, $strTempFile, $strDestination = 'hireamechanic', $i = 1) {
        $arrImageNames = array();
        $randString = md5(time()) . $i;
        $splitName = explode(".", $strFileName);
        $fileExt = end($splitName);
        $newFileName = strtolower($randString . '.' . $fileExt);
        $fixedPath = realpath(Yii::app()->basePath) . '/../images/uploadimages/' . $strDestination . '/certificates/original/';
        move_uploaded_file($strTempFile, $fixedPath . $newFileName);
        $arrImageNames['timestampName'] = $newFileName;
        $arrImageNames['original_name'] = $strFileName;
        return $arrImageNames;
    }

    public function actionAddExperience() {
        $arrErrors = array();
        $intVehicle = Yii::app()->request->getParam('vehicle_type');
        $intHire = Yii::app()->request->getParam('id');
        $arrVehicleCategories = VehicleCategories::getVehicleCategories(1, $intVehicle);
        $arrVehicleBrands = VehicleBrands::getVehicleBrands(1, $intVehicle);
        $arrSkills = HireAMechanicSkills::getSkills($intHire);
        if (isset($_POST['hire_add_experience'])) {
            $objHireExperienceForm = new HireExperienceForm();
            $objHireExperienceForm->attributes = $_POST;
            if ($objHireExperienceForm->validate()) {
                $objDataManager = new DataManager();
                $arrInputs = $objHireExperienceForm->attributes;
                $arrModifiedInuts = $objDataManager->makeData($arrInputs);
                $arrModifiedInuts = array_merge($arrModifiedInuts, array('hire_a_mechanic_id' => $intHire));
                $intHireSkillId = HireAMechanicSkills::create($arrModifiedInuts);
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objHireExperienceForm->errors;
            }
        }
        $this->render('/HireAMechanic/HireAMechanicDetails', array('errors' => $arrErrors, 'vehicle_brands' => $arrVehicleBrands, 'vehicle_categories' => $arrVehicleCategories, 'hire_skills' => $arrSkills));
    }

    public function actionHireReport() {
        $arrHires = HireAMechanic::hireReport();
        $this->render('/HireAMechanic/HireAMechanicReport', array('hires' => $arrHires));
    }

    public function actionEditAgentsReport() {
        $arrErrors = array();
        $objAgentUpdateForm = NULL;
        $arrCountries = Countries::countriesReport(array('status' => 1));
        $intAgentId = Yii::app()->request->getParam('id');
        $arrAgentDetails = Agent::model()->agentsReoport(array('agent_id' => $intAgentId));
        $arrStates = States::statesReport(array('country_type' => $arrAgentDetails[0]['agent_country_id']));
        $arrCities = Cities::citiesReport(array('state_type' => $arrAgentDetails[0]['agent_state_id']));
        $arrAreas = Areas::areasReport(array('city_type' => $arrAgentDetails[0]['agent_city_id']));
        if (isset($_POST['update_agent'])) {
            $objAgentUpdateForm = new AgentUpdateForm();
            $objAgentUpdateForm->attributes = $_POST;
            $objAgentUpdateForm->id = $intAgentId;
            if ($objAgentUpdateForm->validate()) {
                $arrImagesParams = $this->actionUpload($arrAgentDetails);
                $arrInputs = $objAgentUpdateForm->attributes;
                $objDataManager = new DataManager();
                $arrInputs = $objDataManager->makeUpdateData($arrInputs);
                $arrModifiedInputs = $objDataManager->modifyAgent($arrInputs, $arrImagesParams);
                $intUpdateAgent = Agent::updateAgents($arrModifiedInputs['agent'], $intAgentId);
                $intUpdateAgentDetails = AgentDetails::updateAgentsDetails($arrModifiedInputs['agent_details'], $intAgentId);
                Yii::app()->user->setFlash('success', 'Updated Successfully');
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objAgentUpdateForm->errors;
            }
        }
        $this->render('/SelfDrive_NEW/AgentsEdit', array('errors' => $arrErrors, 'countries' => $arrCountries, 'AgentUpdateForm' => $objAgentUpdateForm, 'agent_details' => $arrAgentDetails, 'agent_states' => $arrStates, 'agent_cities' => $arrCities, 'agent_areas' => $arrAreas, 'agentUpdateForm' => $objAgentUpdateForm));
    }

    public function actionEditHire() {
        $arrErrors = $arrPhoto = array();
        $objHireAMechanicForm = NULL;
        $intHire = Yii::app()->request->getParam('id');
        $arrVehicles = VehicleTypes::getVehicleTypes();
        $arrHires = HireAMechanic::hireReport(array('hire_id' => $intHire));
        $arrHireCertificates = HireAMechanicCertificates::getCertificates($intHire);
        if (isset($_POST['update_hire'])) {
            $objHireAMechanicForm = new HireAMechanicForm();
            $objHireAMechanicForm->attributes = $_POST;
            $objHireAMechanicForm->id = $intHire;
            if ($objHireAMechanicForm->validate()) {
                $arrInputs = $_POST;
                $arrImageParams = $this->actionUploads($arrHires, $arrHireCertificates);
                //Hire A Mechanic Photo :: START
                $objDataManager = new DataManager();
                if (isset($_FILES['hire_photo']['name']) && !empty($_FILES['hire_photo']['name'])) {
                    $strFileName = 'hire_photo';
                    $strVehicleFolderName = '/hireamechanic/';
                    $arrImageDimensions = array(
                        array('width' => 280, 'height' => 162, "device" => "280X162", 'folder_path' => $strVehicleFolderName . '/photo/'),
                        array('width' => 450, 'height' => 260, "device" => "450X260", 'folder_path' => $strVehicleFolderName . '/photo/'),
                        array('width' => 60, 'height' => 35, "device" => "60X35", 'folder_path' => $strVehicleFolderName . '/photo/'),
                        array('width' => 768, 'height' => 576, "device" => "768X576", 'folder_path' => $strVehicleFolderName . '/photo/'),
                    );
                    $arrPhoto = $objDataManager->uploadFile($strFileName, $arrImageDimensions);
                }
                //Hire A Mechanic Photo :: END
                $arrFileParams = array_merge($arrImageParams, array('hire_photo' => $arrPhoto));
                $arrModifiedInputs = $objDataManager->modifyHireData($arrFileParams, $arrInputs);
                //Hire A Mechanic
                HireAMechanic::updateHire($arrModifiedInputs['hire_a_mechanic'], $intHire);
                //Hire Address Details
                HireAMechanicAddress::updateHireAddress($arrModifiedInputs['hire_a_mechanic_address'], $intHire);
                //Hire Email
                HireAMechanicEmail::updateHireEmail($arrModifiedInputs['hire_a_mechanic_email'], $intHire);
                //Hire Phone
                HireAMechanicPhone::updateHirePhone($arrModifiedInputs['hire_a_mechanic_phone'], $intHire);
                //Hire Communication
                HireAMechanicCommunication::updateHireCommunication($arrModifiedInputs['hire_a_mechanic_communication'], $intHire);
                //Hire Certificates
                if (isset($arrModifiedInputs['hire_a_mechanic_certificates']) && !empty($arrModifiedInputs['hire_a_mechanic_certificates'])) {
                    HireAMechanicCertificates::create($arrModifiedInputs['hire_a_mechanic_certificates'], $intHire);
                }
                Yii::app()->user->setFlash('success', 'Updated Successfully');
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objHireAMechanicForm->errors;
            }
        }
        $this->render('/HireAMechanic/HireEdit', array('errors' => $arrErrors, 'hire_details' => $arrHires, 'vehicles' => $arrVehicles, 'hireForm' => $objHireAMechanicForm, 'hire_certificates' => $arrHireCertificates));
    }

    public function actionEditAgentVehicle() {
        $arrErrors = $arrVehicleFeatures = $arrCommon = $arrImages = $arrUploadedImageFiles = array();
        $objAgentVehicleForm = NULL;
        $intAgentVehicle = Yii::app()->request->getParam('id');
        //Agents
        $arrAgents = Agent::agentsReoport(array('status' => 1));
        //Agent Vehicle Details
        $arrSelfVehicles = SelfVehicles::agentVehiclesReport(array('id' => $intAgentVehicle));

        //Agent Vehicle Images
        $arrVehicleImages = SelfVehicleImage::getVehicleImages(1, $intAgentVehicle);
        //Vehicle Types
        $arrVehicles = VehicleTypes::getVehicleTypes();
        $objDataManager = new DataManager();
        //Agent Vehicle Facilities
        $arrSelfVehicleFeatures = SelfVehiclesFeatures::getVehicleFeturesReport(array('self_vehicles_id' => $intAgentVehicle));
        $arrModifiedSelfVehicleFeatures = $objDataManager->modifySelfVehicleFacilities($arrSelfVehicleFeatures);


//Vehicle Seating Capacity
        $arrVehicleSeatings = array(
            '1' => '4 Seater',
            '2' => '6 Seater',
            '3' => '10 Seater',
            '4' => '15 Seater',
        );
        //Vehicle Variatns
        $arrVehicleVariants = VehicleVariants::getVehicleVeriants();
        //Vehicle Features
        $strSelfDriveImagePath = '/selfdrive/bikes/web/60X35/';
        $strSelfDriveMultipleImagePath = '/selfdrive/multi_images/bikes/web/60X35/';
        if (isset($arrSelfVehicles[0]['vehicle_type_id']) && !empty($arrSelfVehicles[0]['vehicle_type_id'])) {
            $arrVehicleFeatures = VehicleFeatures::getVehicleFeatures(1, NULL, $arrSelfVehicles[0]['vehicle_type_id']);
            if (1 == $arrSelfVehicles[0]['vehicle_type_id']) {
                $strSelfDriveImagePath = '/selfdrive/cars/web/60X35/';
                $strSelfDriveMultipleImagePath = '/selfdrive/multi_images/cars/web/60X35/';
            }
        }
        //Form Operations
        if (isset($_POST['update_agent_vehicle'])) {
            $objAgentVehicleForm = new UpdateAgentVehicleForm();
            $objAgentVehicleForm->attributes = $_POST;
            $objAgentVehicleForm->id = $intAgentVehicle;
            if ($objAgentVehicleForm->validate()) {
                $arrInputs = $objAgentVehicleForm->attributes;
                //Vehicle Primary Image :: START
                if (isset($_FILES['vehicle_primary_image']['name']) && !empty($_FILES['vehicle_primary_image']['name'])) {
                    $strFileName = 'vehicle_primary_image';
                    $strVehicleFolderName = NULL;
                    if (1 == $arrInputs['vehicle_type_id']) {
                        $strVehicleFolderName = '/selfdrive/cars';
                    } else {
                        $strVehicleFolderName = '/selfdrive/bikes';
                    }

                    $arrImageDimensions = array(
                        array('width' => 450, 'height' => 260, "device" => "450X260", 'folder_path' => $strVehicleFolderName . '/web/'),
                        array('width' => 280, 'height' => 162, "device" => "280X162", 'folder_path' => $strVehicleFolderName . '/web/'),
                        array('width' => 60, 'height' => 35, "device" => "60X35", 'folder_path' => $strVehicleFolderName . '/web/'),
                        array('width' => 768, 'height' => 576, "device" => "768X576", 'folder_path' => $strVehicleFolderName . '/web/'),
                        array('width' => 450, 'height' => 260, "device" => "450X260", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                        array('width' => 280, 'height' => 162, "device" => "280X162", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                        array('width' => 60, 'height' => 35, "device" => "60X35", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                        array('width' => 768, 'height' => 576, "device" => "768X576", 'folder_path' => $strVehicleFolderName . '/mobile/'),
                    );
                    $arrCommon[] = $objDataManager->uploadFile($strFileName, $arrImageDimensions);
                }
                //Vehicle Primary Image :: END
                //Vehicle Multiple Images :: START
                if (isset($_FILES['vehicle_multiple_images']['name']) && !empty($_FILES['vehicle_multiple_images']['name'])) {
                    $arrMultiFileNames = $_FILES['vehicle_multiple_images']['name'];
                    if (isset($arrMultiFileNames[0]) && !empty($arrMultiFileNames[0])) {
                        $strMulVehicleFolderName = NULL;
                        if (1 == $arrInputs['vehicle_type_id']) {
                            $strMulVehicleFolderName = '/selfdrive/multi_images/cars';
                        } else {
                            $strMulVehicleFolderName = '/selfdrive/multi_images/bikes';
                        }
                        $arrImageDimensions = array(
                            array('width' => 450, 'height' => 260, "device" => "450X260", 'folder_path' => $strMulVehicleFolderName . '/web/'),
                            array('width' => 280, 'height' => 162, "device" => "280X162", 'folder_path' => $strMulVehicleFolderName . '/web/'),
                            array('width' => 60, 'height' => 35, "device" => "60X35", 'folder_path' => $strMulVehicleFolderName . '/web/'),
                            array('width' => 768, 'height' => 576, "device" => "768X576", 'folder_path' => $strMulVehicleFolderName . '/web/'),
                            array('width' => 450, 'height' => 260, "device" => "450X260", 'folder_path' => $strMulVehicleFolderName . '/mobile/'),
                            array('width' => 280, 'height' => 162, "device" => "280X162", 'folder_path' => $strMulVehicleFolderName . '/mobile/'),
                            array('width' => 60, 'height' => 35, "device" => "60X35", 'folder_path' => $strMulVehicleFolderName . '/mobile/'),
                            array('width' => 768, 'height' => 576, "device" => "768X576", 'folder_path' => $strMulVehicleFolderName . '/mobile/'),
                        );
                        foreach ($arrMultiFileNames as $key => $value) {
                            $collectTempNames = array();
                            $collectOriginalNames = array();
                            $arrImages[] = $objDataManager->uploadMultipleFiles($_FILES['vehicle_multiple_images']['name'][$key], $arrImageDimensions, $_FILES['vehicle_multiple_images']['tmp_name'][$key]);
                        }
                    }
                }
                //Vehicle Multiple Images :: END
                $arrUploadedImageFiles = array_merge(array('primary_image' => $arrCommon), array('multi_images' => $arrImages));
                $arrModifiedInputs = $objDataManager->modifyAgentVehicles($arrUploadedImageFiles, $arrInputs, $intAgentVehicle);
                //Self Vehicles
                SelfVehicles::updateSelfVehicles($arrModifiedInputs['self_vehicles'], $intAgentVehicle);
                //Self Vehicles Images
                if (isset($arrModifiedInputs['self_vehicles_images']) && !empty($arrModifiedInputs['self_vehicles_images'])) {
                    SelfVehicleImage::create($arrModifiedInputs['self_vehicles_images'], $intAgentVehicle);
                }
                //Self Vehicles Features
                if (isset($arrModifiedInputs['self_vehicles_features']) && !empty($arrModifiedInputs['self_vehicles_features'])) {
                    $arrModifiedInputs['self_vehicles_features'] = array_reverse($arrModifiedInputs['self_vehicles_features']);
                    SelfVehiclesFeatures::create($arrModifiedInputs['self_vehicles_features'], $intAgentVehicle);
                }
                Yii::app()->user->setFlash('success', 'Updated Successfully');
                Yii::app()->controller->refresh();
            } else {
                $arrErrors = $objAgentVehicleForm->errors;
            }
        }
        $this->render('/SelfDrive_NEW/UpdateAgentVehicles', array("errors" => $arrErrors, 'selfVehicleFeatures' => $arrSelfVehicleFeatures, 'selfVehicles' => $arrSelfVehicles, 'agentVehicleForm' => $objAgentVehicleForm, 'vehicle_features' => $arrVehicleFeatures, 'vehicle_variants' => $arrVehicleVariants, 'vehicles' => $arrVehicles, 'vehicle_seating' => $arrVehicleSeatings, 'agents' => $arrAgents, 'vehicle_images' => $arrVehicleImages, 'vehicle_image_path' => $strSelfDriveImagePath, 'vehicle_multiimages_path' => $strSelfDriveMultipleImagePath, 'self_existed_features' => $arrModifiedSelfVehicleFeatures));
    }

    public function actionAgentLogin() {
        $this->render('/SelfDrive_NEW/AgentLogin');
    }

}
