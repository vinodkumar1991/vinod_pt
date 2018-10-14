<?php

/**
 * @author Ctel
 * @ignore It will handle data modification on transaction
 */
class DataManager {

    /**
     * @author Ctel
     * @return array It will return common columns data of table
     */
    public function getDefaults() {
        $strDevice = CommonFunctions::getDevice();
        $intDeviceId = CommonFunctions::getDeviceId($strDevice);
        return array(
            'created_date' => date('Y-m-d h:i:s'),
            'created_by' => 1,
            'ip_address' => Yii::app()->request->userHostAddress,
            'status' => 1,
            'device_id' => $intDeviceId,
            'device_name' => $strDevice,
        );
    }

    /**
     * @author Ctel 
     * @param array $arrInput
     * @return array It will combine inputs with common data of table
     */
    public function makeData($arrInput) {
        $arrCommon = self::getDefaults();
        $arrData = array_merge($arrInput, $arrCommon);
        return $arrData;
    }

    public function validateCredentials($strDBPwd, $strPassword) {
        echo $strDBPwd;
        echo '================================';
        echo $strPassword;
        echo '================================';
        echo $strMD5Pwd = CommonFunctions::generatePassword($strPassword);
        //$strDBPwd ='90147133d92844a385d7ad1a32f2e92fb063bc3b';
        $intIsMatch = strcmp($strDBPwd, $strMD5Pwd);
        if (0 != $intIsMatch) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * @author Ctel
     * @return array It will return verification code
     */
    public function getVerificationCode() {
        $strVerifyToken = CommonFunctions::getNumberToken();
        return array('verify_token' => $strVerifyToken);
    }

    public function getYears() {
        $arrYears = array();
        for ($i = 1900; $i <= 2016; $i++) {
            $arrYears[$i] = $i;
        }
        return $arrYears;
    }

    public function modifyVehicleImageData($intVehicleId) {
        $arrVehicledata = array();
        if (isset($_FILES['vehicle_image']) && count($_FILES['vehicle_image']['name']) > 0) {
            $fileName = $_FILES['vehicle_image']['name'];
            $arrVehicledata[] = array("self_vehicles_id" => $intVehicleId, "original_name" => "$fileName", "is_parent" => 1);
        }
        if (isset($_FILES['vehicle_multiple_images']) && count($_FILES['vehicle_multiple_images']['name']) > 1) {
            $is_parent = 0;
            $Child_Image = $_FILES['vehicle_multiple_images']['name'];
            foreach ($Child_Image as $ChildImg) {
                $arrVehicledata[] = array("self_vehicles_id" => $intVehicleId, "original_name" => "$ChildImg", "is_parent" => 0);
            }
        }
        return $arrVehicledata;
    }

    public function modifyBrand($arrBrand, $arrLogo) {
        $arrModifiedBrand = array();
        if (!empty($arrBrand)) {
            $arrModifiedBrand['vehicle_types_id'] = $arrBrand['vehicle_types'];
            $arrModifiedBrand['name'] = $arrBrand['brand_name'];
            $arrModifiedBrand['code'] = $arrBrand['brand_code'];
            $arrModifiedBrand['description'] = $arrBrand['brand_description'];
            $arrModifiedBrand['logo'] = $arrLogo['timestampName'];
            $arrModifiedBrand['logo_original_name'] = $arrLogo['original_name'];
            $arrModifiedBrand['status'] = $arrBrand['brand_status'];
            $arrDefaults = self::getDefaults();
            unset($arrDefaults['status']);
            $arrModifiedBrand = array_merge($arrModifiedBrand, $arrDefaults);
        }

        return $arrModifiedBrand;
    }

    public function uploadFile($strFileName, $arrImageDimensions) {
        $arrImageNames = array();
        $strTimestampName = NULL;
        $strOriginalImageName = NULL;
        $strImageExtension = strtolower(pathinfo($_FILES[$strFileName]['name'], PATHINFO_EXTENSION));
        $strOriginalImageName = $_FILES[$strFileName]['name'];
        $intImageDimensionsCount = count($arrImageDimensions);
        $strTimestampName = '' . uniqid() . '.' . $strImageExtension;
        for ($i = 0; $i < $intImageDimensionsCount; $i++) {
            //if (array_sum($arrImageDimensions[$i]) < 2000) {
            $strImagePath = realpath(Yii::app()->basePath) . '/../images/uploadimages/' . $arrImageDimensions[$i]['folder_path'] . $arrImageDimensions[$i]['device'] . '/' . $strTimestampName;
            //}
            $strFileTempName = $_FILES[$strFileName]['tmp_name'];
            $arrImageDim = getimagesize($strFileTempName);
            $floatXCoordinates = 0;
            $floatYCoordinates = 0;
            $floatImageWidth = 0 ? 0 : $arrImageDim[0];
            $floatImageHeight = 0 ? 0 : $arrImageDim[1];
            $arrImageInputs = array(
                'imageTempName' => $_FILES[$strFileName]['tmp_name'],
                'imageSizeOne' => $arrImageDimensions[$i]['width'],
                'imageSizeTwo' => $arrImageDimensions[$i]['height'],
                'imagePath' => $strImagePath,
                'imageXCoordinate' => $floatXCoordinates,
                'imageYCoordinate' => $floatYCoordinates,
                'imageWidth' => $floatImageWidth,
                'imageHeight' => $floatImageHeight,
            );
            $intCropRes = self::cropImage($arrImageInputs);
        }
        $arrImageNames['timestampName'] = $strTimestampName;
        $arrImageNames['original_name'] = $strOriginalImageName;
        return $arrImageNames;
    }

    public function cropImage($arrImageInputs) {
        //Get the original image and converted it as encoded string
        $stringEncodedImage = file_get_contents($arrImageInputs['imageTempName']);

        //Create a static image as original image from string 
        $strOriginalImage = imagecreatefromstring($stringEncodedImage);

        //Create a custom image by passing width and height
        $strFinalImage = imagecreatetruecolor($arrImageInputs['imageSizeOne'], $arrImageInputs['imageSizeTwo']);
        //Apply background effects to image
        $strImageTransparent = imagecolorallocate($strFinalImage, 0, 0, 0);
        //Create a final image
        imagefill($strFinalImage, 0, 0, $strImageTransparent);
        imagealphablending($strFinalImage, false);
        imagesavealpha($strFinalImage, true);
        imagecopyresampled($strFinalImage, $strOriginalImage, 0, 0, $arrImageInputs['imageXCoordinate'], $arrImageInputs['imageYCoordinate'], $arrImageInputs['imageSizeOne'], $arrImageInputs['imageSizeTwo'], $arrImageInputs['imageWidth'], $arrImageInputs['imageHeight']);

        //Create a png image
        imagepng($strFinalImage, $arrImageInputs['imagePath']);
        imagedestroy($strFinalImage);

        return 1;
    }

    public function modifyBrandModel($arrModel, $arrLogo) {
        $arrModifiedBrandModel = array();
        if (!empty($arrModel)) {
            $arrModifiedBrandModel['vehicle_types_id'] = $arrModel['vehicle_types'];
            $arrModifiedBrandModel['vehicle_brands_id'] = $arrModel['vehicle_brand'];
            $arrModifiedBrandModel['name'] = $arrModel['model_name'];
            $arrModifiedBrandModel['code'] = $arrModel['model_code'];
            $arrModifiedBrandModel['description'] = $arrModel['model_description'];
            $arrModifiedBrandModel['image_path'] = $arrLogo['timestampName'];
            $arrModifiedBrandModel['logo_original_name'] = $arrLogo['original_name'];
            $arrModifiedBrandModel['status'] = $arrModel['model_status'];
            $arrDefaults = self::getDefaults();
            unset($arrDefaults['status']);
            $arrModifiedBrandModel = array_merge($arrModifiedBrandModel, $arrDefaults);
        }

        return $arrModifiedBrandModel;
    }

    public function prepareSelfFeatures($featuresarray, $arrMechanic, $intMechanicId) {


        //$arrLatLong=explode(',',$arrMechanic['latlong']);
        if (!empty($arrMechanic)) {

            $arrMechanicSkills = '';
            $i = 0;
            foreach ($featuresarray as $objectBrand) {
                $arrMechanicSkills[] = array('self_vehicles_id' => $intMechanicId, 'vehicle_fetures_id' => $featuresarray[$i],
                );

                $i++;
            }
        }
        return $arrMechanicSkills;
    }

    public function uploadMultipleFiles($strFileName, $arrImageDimensions, $strTempName) {

        $arrImageNames = array();
        $strTimestampName = NULL;
        $strOriginalImageName = NULL;
        $strImageExtension = strtolower(pathinfo($strFileName, PATHINFO_EXTENSION));
        $strOriginalImageName = $strFileName;
        $intImageDimensionsCount = count($arrImageDimensions);
        $strTimestampName = '' . uniqid() . '.' . $strImageExtension;
        for ($i = 0; $i < $intImageDimensionsCount; $i++) {
            //if (array_sum($arrImageDimensions[$i]) < 2000) {
            $strImagePath = realpath(Yii::app()->basePath) . '/../images/uploadimages/' . $arrImageDimensions[$i]['folder_path'] . $arrImageDimensions[$i]['device'] . '/' . $strTimestampName;
            //}

            $strFileTempName = $strTempName;
            $arrImageDim = getimagesize($strFileTempName);
            $floatXCoordinates = 0;
            $floatYCoordinates = 0;
            $floatImageWidth = 0 ? 0 : $arrImageDim[0];
            $floatImageHeight = 0 ? 0 : $arrImageDim[1];
            $arrImageInputs = array(
                'imageTempName' => $strTempName,
                'imageSizeOne' => $arrImageDimensions[$i]['width'],
                'imageSizeTwo' => $arrImageDimensions[$i]['height'],
                'imagePath' => $strImagePath,
                'imageXCoordinate' => $floatXCoordinates,
                'imageYCoordinate' => $floatYCoordinates,
                'imageWidth' => $floatImageWidth,
                'imageHeight' => $floatImageHeight,
            );

            $intCropRes = self::cropImage($arrImageInputs);
        }

        $arrImageNames['timestampName'] = $strTimestampName;
        $arrImageNames['original_name'] = $strOriginalImageName;
        return $arrImageNames;
    }

    public function modifyMechanic($arrMechanic, $arrImagesParams) {

        $arrModifiedMechanic = array();
        if (!empty($arrMechanic)) {
            $arrCommon = self::getDefaults();
            // $strMechanicCode = 'MS-';
            //$strMechanicCode .= CommonFunctions::getNumberToken();

            /* Code Format START */
            $arrHotOrderData = MechanicShops::getMechanicCode();
            $strKey = Yii::app()->params['service_codes']['registration_ids']['mechanic'];
            $strMechanicCode = 'MPSMECH0000001';
            $intDigit = Yii::app()->params['service_codes']['registration_ids']['mechanic_digit'];
            $intPadding = Yii::app()->params['service_codes']['registration_ids']['mechanic_padding'];

            if (!empty($arrHotOrderData)) {
                $objectDataManager = new DataManager();
                $intPartialMaxNumber = $objectDataManager->getHotOrderNumber($arrHotOrderData[0]['code'], $intDigit);
                $strMechanicCode = $objectDataManager->getNewOrderNumber($intPartialMaxNumber, $strKey, $intPadding);
            }
            /* Code Format END */


            //Users
            $arrModifiedMechanic['users'] = array(
                'role_types_id' => 1,
                'first_name' => $arrMechanic['mechanic_username'],
                'username' => $arrMechanic['mechanic_username'],
                'password' => CommonFunctions::generatePassword($arrMechanic['mechanic_password']),
            );
            $arrModifiedMechanic['users'] = array_merge($arrModifiedMechanic['users'], $arrCommon);

            //Mechanic Shops
            $arrModifiedMechanic['mechanic_shops'] = array(
                'mechanic_shop_id' => $arrMechanic['id'],
                'mechanic_shop_name' => $arrMechanic['mechanic_shop_name'],
                'owner' => $arrMechanic['mechanic_owner_name'],
                'code' => $strMechanicCode,
                'license' => $arrMechanic['mechanic_shop_license'],
                'email' => $arrMechanic['mechanic_email'],
                'phone' => $arrMechanic['mechanic_contact'],
                'present_address' => $arrMechanic['mechanic_shop_address'],
            );
            $arrModifiedMechanic['mechanic_shops'] = array_merge($arrModifiedMechanic['mechanic_shops'], $arrCommon);

            //Mechanic Shop Details
            $arrModifiedMechanic['mechanic_shop_details'] = array(
                'address' => 'Hyderabad', //Need to change
                'total_mechanics' => $arrMechanic['mechanic_total'],
                'service_capability' => $arrMechanic['mechanic_shop_capability'],
                'cities_id' => $arrMechanic['mechanic_shop_city'],
                'areas_id' => $arrMechanic['mechanic_area'],
                'pincode' => NULL,
                'location' => $arrMechanic['adrs'], //Need to change
                'latitude' => explode(',', $arrMechanic['location'])[0], //Need to change
                'longitude' => explode(',', $arrMechanic['location'])[1], //Need to change
                'address_image' => $arrImagesParams['mechanic_photo']['timestampName'],
                'address_original_image' => $arrImagesParams['mechanic_photo']['original_name'],
                'id_image' => $arrImagesParams['mechanic_id_proof']['timestampName'],
                'id_original_image' => $arrImagesParams['mechanic_id_proof']['original_name'],
                'photo_image' => $arrImagesParams['mechanic_address_proof']['timestampName'],
                'photo_original_image' => $arrImagesParams['mechanic_address_proof']['original_name'],
            );
            $arrModifiedMechanic['mechanic_shop_details'] = array_merge($arrModifiedMechanic['mechanic_shop_details'], $arrCommon);

            return $arrModifiedMechanic;
        }
    }

    public function modifyDelivery($arrDelivery, $arrImagesParams) {
        $arrModifiedDelivery = array();
        $arrCommon = self::getDefaults();
        //$strDeliveryCode = 'DB-';
        //$strDeliveryCode .= CommonFunctions::getNumberToken();

        /* Code Format START */
        $arrHotOrderData = DeliveryBoys::getDeliveryCode();
        $strKey = Yii::app()->params['service_codes']['registration_ids']['runner'];
        $strDeliveryCode = 'MPSRUNN0000001';
        $intDigit = Yii::app()->params['service_codes']['registration_ids']['runner_digit'];
        $intPadding = Yii::app()->params['service_codes']['registration_ids']['runner_padding'];

        if (!empty($arrHotOrderData)) {
            $objectDataManager = new DataManager();
            $intPartialMaxNumber = $objectDataManager->getHotOrderNumber($arrHotOrderData[0]['code'], $intDigit);
            $strDeliveryCode = $objectDataManager->getNewOrderNumber($intPartialMaxNumber, $strKey, $intPadding);
        }
        /* Code Format END */


        //Users
        $arrModifiedDelivery['users'] = array(
            'role_types_id' => 5,
            'first_name' => $arrDelivery['delivery_name'],
            'username' => $arrDelivery['delivery_username'],
            'password' => CommonFunctions::generatePassword($arrDelivery['delivery_password']),
        );
        $arrModifiedDelivery['users'] = array_merge($arrModifiedDelivery['users'], $arrCommon);

        //Delivery Boy
        $arrModifiedDelivery['delivery_boys'] = array(
            'mechanic_shops_id' => $arrDelivery['mechanic_shop'],
            'name' => $arrDelivery['delivery_name'],
            'code' => $strDeliveryCode,
            'email' => $arrDelivery['delivery_email'],
            'phone' => $arrDelivery['delivery_contact'],
            'age' => $arrDelivery['delivery_boy_age'],
            'description' => NULL,
        );
        $arrModifiedDelivery['delivery_boys'] = array_merge($arrModifiedDelivery['delivery_boys'], $arrCommon);

        //Delivery Boy Address Details
        $arrModifiedDelivery['delivery_boy_address_details'] = array(
            'address_one' => $arrDelivery['delivery_address_one'],
            'address_two' => $arrDelivery['delivery_address_two'],
            'driving_original_path' => $arrImagesParams['delivery_id_proof']['original_name'],
            'driving_license_path' => $arrImagesParams['delivery_id_proof']['timestampName'],
            'address_original_path' => $arrImagesParams['delivery_address_proof']['original_name'],
            'address_proof_path' => $arrImagesParams['delivery_address_proof']['timestampName'],
            'photo_original_path' => $arrImagesParams['delivery_photo']['original_name'],
            'photo_path' => $arrImagesParams['delivery_photo']['timestampName']
        );
        return $arrModifiedDelivery;
    }

    /**
     * @author Digital Today
     * @param array $arrBilling
     * @return array It will return modified billing details
     */
    public function modifyBilling($arrBilling) {
        $intIsRecommended = 0;
        $arrDefaults = self::getDefaults();
        //Is Recommended :: START
        if (isset($arrBilling['is_recommended']) && !empty($arrBilling['is_recommended'])) {
            $intIsRecommended = $arrBilling['is_recommended'];
        }
        $arrBilling['is_recommended'] = $intIsRecommended;
        //Is Recommended :: END
        //Plan Id :: START
        if (empty($arrBilling['plan_id'])) {
            if (3 == $arrBilling['service_type_id']) {
                $arrBilling['plan_id'] = 8; // 8 => Plan Id For Repair Service :: CAR    
                $arrBilling['is_recommended'] = 2; // 2 => Repair Job :: CAR
            } elseif (1 == $arrBilling['service_type_id'] && 2 == $arrBilling['vehicle_id']) {
                $arrBilling['plan_id'] = 21; // 8 => Plan Id For Repair Service :: BIKE    
            }
        }
        //Plan Id :: END
        $arrBilling = array_merge($arrBilling, $arrDefaults);
        return $arrBilling;
    }

    public function modifyModificationShops($arrModification, $arrImagesParams) {
        $arrModificationShop = array();
        if (!empty($arrModification)) {
            $arrCommon = self::getDefaults();
            $strModificationShopCode = 'MSP-';
            $strModificationShopCode .= CommonFunctions::getNumberToken();
            //Users
            $arrModificationShop['users'] = array(
                'role_types_id' => 4,
                'first_name' => $arrModification['username'],
                'username' => $arrModification['username'],
                'password' => CommonFunctions::generatePassword($arrModification['password']),
            );
            $arrModificationShop['users'] = array_merge($arrModificationShop['users'], $arrCommon);

            //Modification Shops
            $arrModificationShop['modification_shops'] = array(
                'name' => $arrModification['shop_name'],
                'owner' => $arrModification['owner_name'],
                'code' => $strModificationShopCode,
                'email' => $arrModification['shop_email'],
                'phone' => $arrModification['shop_contact'],
                'vehicle_type' => $arrModification['vehicle_type'],
                'shop_desc' => $arrModification['shop_description'],
            );
            $arrModificationShop['modification_shops'] = array_merge($arrModificationShop['modification_shops'], $arrCommon);

            //Modification Shop Details
            $arrModificationShop['modification_shop_details'] = array(
                'address' => $arrModification['shop_adrs'],
                'cities_id' => $arrModification['shop_city'],
                'areas_id' => $arrModification['shop_area'],
                'pincode' => $arrModification['shop_pincode'],
                'location' => $arrModification['adrs'], //Need to change
                'latitude' => explode(',', $arrModification['location'])[0], //Need to change
                'longitude' => explode(',', $arrModification['location'])[1], //Need to change
                'shop_image' => $arrImagesParams['shop_image']['timestampName'],
                'shop_original_image' => $arrImagesParams['shop_image']['original_name'],
                'brand_logo' => $arrImagesParams['brand_logo']['timestampName'],
                'brand_original_logo' => $arrImagesParams['brand_logo']['original_name'],
            );
            $arrModificationShop['modification_shop_details'] = array_merge($arrModificationShop['modification_shop_details'], $arrCommon);
            return $arrModificationShop;
        }
    }

    public function modifyAgentDetails($arrAgentDetails, $arrImageParams) {
        $arrModifiedAgentDetails = array();
        if (!empty($arrAgentDetails)) {
            $arrCommon = self::getDefaults();
            //$strAgentCode = 'MPA-';
            //$strAgentCode .= CommonFunctions::getNumberToken();

            /* Code Format START */
            $arrHotOrderData = Agent::getAgentCode();
            $strKey = Yii::app()->params['service_codes']['registration_ids']['selfdriveagent'];
            $strAgentCode = 'MPSSDRV0000001';
            $intDigit = Yii::app()->params['service_codes']['registration_ids']['selfagent_digit'];
            $intPadding = Yii::app()->params['service_codes']['registration_ids']['selfagent_padding'];

            if (!empty($arrHotOrderData)) {
                $objectDataManager = new DataManager();
                $intPartialMaxNumber = $objectDataManager->getHotOrderNumber($arrHotOrderData[0]['code'], $intDigit);
                $strAgentCode = $objectDataManager->getNewOrderNumber($intPartialMaxNumber, $strKey, $intPadding);
            }
            /* Code Format END */

            //User
            $arrModifiedAgentDetails['user'] = array(
                'role_types_id' => 2,
                'first_name' => $arrAgentDetails['agent_name'],
                'username' => $arrAgentDetails['agent_username'],
                'password' => CommonFunctions::generatePassword($arrAgentDetails['agent_password']),
            );
            $arrModifiedAgentDetails['user'] = array_merge($arrModifiedAgentDetails['user'], $arrCommon);

            //Agent Details
            $arrModifiedAgentDetails['agent'] = array(
                'name' => $arrAgentDetails['agent_name'],
                'owner' => $arrAgentDetails['agent_owner'],
                'code' => $strAgentCode,
                'email' => $arrAgentDetails['agent_email'],
                'phone' => $arrAgentDetails['agent_phone'],
                'landline' => $arrAgentDetails['agent_landline'],
            );
            $arrModifiedAgentDetails['agent'] = array_merge($arrModifiedAgentDetails['agent'], $arrCommon);

            //Agent Address Details
            //Modification Shop Details
            $arrModifiedAgentDetails['agent_communication'] = array(
                'address' => $arrAgentDetails['agent_address'],
                'cities_id' => $arrAgentDetails['agent_city'],
                'areas_id' => $arrAgentDetails['agent_area'],
                'pincode' => $arrAgentDetails['agent_pincode'],
                'location' => $arrAgentDetails['agent_location'], //Need to change
                'latitude' => explode(',', $arrAgentDetails['location'])[0], //Need to change
                'longitude' => explode(',', $arrAgentDetails['location'])[1], //Need to change
                'photo' => $arrImageParams['agent_photo']['timestampName'],
                'original_photo' => $arrImageParams['agent_photo']['original_name'],
                'address_image' => $arrImageParams['agent_address_proof']['timestampName'],
                'address_original_image' => $arrImageParams['agent_address_proof']['original_name'],
                'id_image' => $arrImageParams['agent_id_proof']['timestampName'],
                'id_original_proof' => $arrImageParams['agent_id_proof']['original_name'],
                'register_original_image' => $arrImageParams['agent_registration_certificate']['original_name'],
                'register_image' => $arrImageParams['agent_registration_certificate']['timestampName'],
            );
            $arrModifiedAgentDetails['agent_communication'] = array_merge($arrModifiedAgentDetails['agent_communication'], $arrCommon);
        }
        return $arrModifiedAgentDetails;
    }

    public function modifyVehicleImages($arrImages, $intSelfVehicle) {
        $arrModifiedImages = array();
        if (!empty($arrImages)) {
            foreach ($arrImages as $key => $arrImage) {
                $intParent = 0;
                if (0 == $key) {
                    $intParent = 1;
                }
                $arrModifiedImages[] = array(
                    'self_vehicles_id' => $intSelfVehicle,
                    'original_name' => $arrImage['original_name'],
                    'image_name' => $arrImage['timestampName'],
                    'is_parent' => $intParent,
                    'status' => 1,
                );
            }
        }
        return $arrModifiedImages;
    }

    public function modifyVehicleFeatures($arrInputs, $intSelfVehicle) {
        $arrModifedFeatures = array();
        $arrCommon = self::getDefaults();
        if (isset($arrInputs['vehicle_features']) && !empty($arrInputs['vehicle_features'])) {
            $arrVehicleFeatures = $arrInputs['vehicle_features'];
            foreach ($arrVehicleFeatures as $strFeatureKey => $strFeatureId) {
                $arrModifedFeatures[] = array(
                    'self_vehicles_id' => $intSelfVehicle,
                    'vehicle_fetures_id' => $strFeatureId,
                    'status' => $arrCommon['status'],
                    'created_date' => $arrCommon['created_date'],
                    'created_by' => $arrCommon['created_by'],
                    'ip_address' => $arrCommon['ip_address'],
                );
            }
        }
        return $arrModifedFeatures;
    }

    public function getDay() {
        $arrWeekDays = array('sunday' => 1, 'monday' => 2, 'tuesday' => 3, 'wednesday' => 4, 'thursday' => 5, 'friday' => 6, 'saturday' => 7);
        $strCurrentDate = date('Y/m/d');
        $strDay = date('l', strtotime($strCurrentDate));
        $strDay = strtolower($strDay);
        $intDayKey = $arrWeekDays[$strDay];
        return $intDayKey;
    }

    public function modifyVehicleFeatureData($arrInputs) {
        $arrModifiedData = array();
        if (!empty($arrInputs)) {
            $arrModifiedData = array(
                'name' => $arrInputs['vehicle_feature_name'],
                'vehicle_types_id' => $arrInputs['vehicle_id'],
                'description' => $arrInputs['vehicle_feature_description'],
                'status' => $arrInputs['vehicle_feature_status'],
                'last_modified_by' => $arrInputs['last_modified_by'],
                'ip_address' => $arrInputs['ip_address'],
            );
            if (isset($arrInputs['original_name']) && !empty($arrInputs['original_name'])) {
                $arrModifiedData = array_merge($arrModifiedData, array('image_name' => $arrInputs['timestampName'], 'image_original_name' => $arrInputs['timestampName']));
            }
            return $arrModifiedData;
        }
    }

    public function modifyRepairs($arrInputs) {
        $arrModifiedData = array();
        if (!empty($arrInputs)) {
            $arrModifiedData = array(
                'name' => $arrInputs['repair_name'],
                'code' => $arrInputs['repair_code'],
                'description' => $arrInputs['repair_description'],
                'status' => $arrInputs['repair_status'],
            );
            unset($arrInputs);
        }
        return $arrModifiedData;
    }

    public function modifyAgents($arrInputs) {
        $arrModifiedData = array();
        if (!empty($arrInputs)) {
            $arrModifiedData = array(
                'name' => $arrInputs['agency_name'],
                'owner' => $arrInputs['agent_owner'],
                'email' => $arrInputs['agent_email'],
                'phone' => $arrInputs['agent_phone'],
                'address' => $arrInputs['agent_address'],
                'cities_id' => $arrInputs['agent_city'],
                'areas_id' => $arrInputs['agent_area'],
                'pincode' => $arrInputs['agent_pincode'],
                'location' => $arrInputs['agent_location'],
                'photo' => $arrImageParams['agent_photo']['timestampName'],
                'original_photo' => $arrImageParams['agent_photo']['original_name'],
                'address_image' => $arrImageParams['agent_address_proof']['timestampName'],
                'address_original_image' => $arrImageParams['agent_address_proof']['original_name'],
                'id_image' => $arrImageParams['agent_id_proof']['timestampName'],
                'id_original_proof' => $arrImageParams['agent_id_proof']['original_name'],
                'register_original_image' => $arrImageParams['agent_registration_certificate']['original_name'],
                'register_image' => $arrImageParams['agent_registration_certificate']['timestampName'],
                'landline' => $arrInputs['agent_landline'],
            );
            unset($arrInputs);
        }
        return $arrModifiedData;
    }

    public function modifyRepairList($arrInputs) {

        //print_r($arrInputs);die();
        $arrModifiedData = array();
        if (!empty($arrInputs)) {
            $arrModifiedData = array(
                'repairs_id' => $arrInputs['repairs_id'],
                'name' => $arrInputs['repair_list_name'],
                'code' => $arrInputs['repair_list_code'],
                'description' => $arrInputs['repair_list_desc'],
                'status' => $arrInputs['repair_list_status'],
            );
            return $arrModifiedData;
        }
    }

    public function modifyMechanicShopData($arrInputs) {

        //  print_r($arrInputs);die();
        $arrModifiedData = array();
        if (!empty($arrInputs)) {
            $arrModifiedData = array(
                'license' => $arrInputs['shop_license'],
                'name' => $arrInputs['shop_name'],
                'code' => $arrInputs['shop_code'],
                'description' => $arrInputs['shop_description'],
                'status' => $arrInputs['shop_status'],
            );
            return $arrModifiedData;
        }
    }

    public function modifyHire($arrInputs, $arrFileParams) {

        $arrModifiedHire = array();
        $intStatus = 1;
        $arrDefaults = self::getDefaults();
        if (!empty($arrInputs)) {
            //Hire A Mechanic
            $arrModifiedHire['hire_a_mechanic'] = array(
                'first_name' => $arrInputs['hire_name'],
                'middle_name' => NULL,
                'last_name' => NULL,
                'vehicle_types_id' => $arrInputs['hire_vehicle_id'],
                'hire_description' => $arrInputs['hire_description'],
                'hire_code' => $arrInputs['hire_code'],
            );
            $arrModifiedHire['hire_a_mechanic'] = array_merge($arrModifiedHire['hire_a_mechanic'], $arrDefaults);

            //Hire A Mechanic Email
            $arrModifiedHire['hire_a_mechanic_email'] = array(
                'email' => $arrInputs['hire_email'],
                'status' => $intStatus,
                'is_primary' => $intStatus,
            );
            //Hire A Mechanic Phone
            $arrModifiedHire['hire_a_mechanic_phone'] = array(
                'phone' => $arrInputs['hire_phone'],
                'status' => $intStatus,
                'is_primary' => $intStatus,
            );

            //Hire A Mechanic Address
            $arrModifiedHire['hire_a_mechanic_address'] = array(
                'permanent_address' => $arrInputs['hire_permanent_address'],
                'present_address' => $arrInputs['hire_present_address'],
                'status' => $intStatus,
                'is_primary' => $intStatus,
            );

            //Hire A Mechanic Communication
            $arrModifiedHire['hire_a_mechanic_communication'] = array(
                'image_name' => $arrFileParams['hire_photo']['timestampName'],
                'original_image_name' => $arrFileParams['hire_photo']['original_name'],
                'id_proof_name' => $arrFileParams['hire_id_proof']['timestampName'],
                'id_proof_original_name' => $arrFileParams['hire_id_proof']['original_name'],
                'address_proof_name' => $arrFileParams['hire_address_proof']['timestampName'],
                'original_address_proof_name' => $arrFileParams['hire_address_proof']['original_name'],
                'location' => $arrInputs['hire_location'],
                'latitude' => explode(',', $arrInputs['location'])[0],
                'longitude' => explode(',', $arrInputs['location'])[1],
            );

//            //Hire A Mechanic Certificates
//            if (isset($arrFileParams['hire_certificates']) && !empty($arrFileParams['hire_certificates'])) {
//                $arrHireCertificates = $arrFileParams['hire_certificates'];
//                if (!empty($arrHireCertificates)) {
//                    foreach ($arrHireCertificates as $arrCertificate) {
//                        $arrModifiedHire['hire_a_mechanic_certificates']
//                    }
//                }
//            }
        }
        return $arrModifiedHire;
    }

    public function modifyHireCertificates($arrCertificates, $intHire) {
        $arrModifiedCertificates = array();
        if (!empty($arrCertificates)) {
            foreach ($arrCertificates as $arrCertificate) {
                $arrModifiedCertificates[] = array(
                    'hire_a_mechanic_id' => $intHire,
                    'image_name' => $arrCertificate['timestampName'],
                    'original_image_name' => $arrCertificate['original_name'],
                    'status' => 1,
                );
            }
        }
        return $arrModifiedCertificates;
    }

    public function makeUpdate() {
        $strDevice = CommonFunctions::getDevice();
        $intDeviceId = CommonFunctions::getDeviceId($strDevice);
        return array(
            'last_modified_by' => 1,
            'ip_address' => Yii::app()->request->userHostAddress,
            'device_id' => $intDeviceId,
            'device_name' => $strDevice,
        );
    }

    public function makeUpdateData($arrInput) {
        $arrBinds = self::makeUpdate();
        $arrData = array_merge($arrInput, $arrBinds);
        return $arrData;
    }

    public function modifyAgent($arrInputs, $arrImageParams) {
        $arrModifiedInputs = array();
        if (!empty($arrInputs)) {
            //Agent
            $arrModifiedInputs['agent'] = array(
                'name' => $arrInputs['agency_name'],
                'owner' => $arrInputs['agent_owner'],
                'email' => $arrInputs['agent_email'],
                'code' => $arrInputs['agent_code'],
                'phone' => $arrInputs['agent_phone'],
                'landline' => $arrInputs['agent_landline'],
                'last_modified_by' => $arrInputs['last_modified_by'],
                'ip_address' => $arrInputs['ip_address'],
                'device_id' => $arrInputs['device_id'],
            );
            //Agent Details
            $arrModifiedInputs['agent_details'] = array(
                'address' => $arrInputs['agent_address'],
                'cities_id' => $arrInputs['agent_city'],
                'areas_id' => $arrInputs['agent_area'],
                'pincode' => $arrInputs['agent_pincode'],
                'last_modified_by' => $arrInputs['last_modified_by'],
                'ip_address' => $arrInputs['ip_address'],
                    //'device_id' => $arrInputs['device_id'],
            );
            //Location
            if (isset($arrInputs['location']) && !empty($arrInputs['location'])) {
                $arrModifiedInputs['agent_details'] = array_merge($arrModifiedInputs['agent_details'], array('location' => $arrInputs['agent_location'], 'latitude' => explode(',', $arrInputs['location'])[0], 'longitude' => explode(',', $arrInputs['location'])[1]));
            }
            //Photo
            if (isset($arrImageParams['agent_photo']['original_name']) && !empty($arrImageParams['agent_photo']['original_name'])) {
                $arrModifiedInputs['agent_details'] = array_merge($arrModifiedInputs['agent_details'], array('original_photo' => $arrImageParams['agent_photo']['original_name'], 'photo' => $arrImageParams['agent_photo']['timestampName']));
            }
            //Id Proof
            if (isset($arrImageParams['agent_id_proof']['original_name']) && !empty($arrImageParams['agent_id_proof']['original_name'])) {
                $arrModifiedInputs['agent_details'] = array_merge($arrModifiedInputs['agent_details'], array('id_original_proof' => $arrImageParams['agent_id_proof']['original_name'], 'id_image' => $arrImageParams['agent_id_proof']['timestampName']));
            }
            //Address
            if (isset($arrImageParams['agent_address_proof']['original_name']) && !empty($arrImageParams['agent_address_proof']['original_name'])) {
                $arrModifiedInputs['agent_details'] = array_merge($arrModifiedInputs['agent_details'], array('address_original_image' => $arrImageParams['agent_address_proof']['original_name'], 'address_image' => $arrImageParams['agent_address_proof']['timestampName']));
            }
            //Registration Certificate
            if (isset($arrImageParams['agent_registration_certificate']['original_name']) && !empty($arrImageParams['agent_registration_certificate']['original_name'])) {
                $arrModifiedInputs['agent_details'] = array_merge($arrModifiedInputs['agent_details'], array('register_original_image' => $arrImageParams['agent_registration_certificate']['original_name'], 'register_image' => $arrImageParams['agent_registration_certificate']['timestampName']));
            }
        }
        return $arrModifiedInputs;
    }

    public function modifyDeliveryGuy($arrInputs, $arrImageParams) {
        $arrModifiedInputs = array();
        $arrInputs = self::makeUpdateData($arrInputs);
        if (!empty($arrInputs)) {
            $arrModifiedInputs['delivery_boy'] = array(
                'name' => $arrInputs['delivery_name'],
                'email' => $arrInputs['delivery_email'],
                'phone' => $arrInputs['delivery_contact'],
                'age' => $arrInputs['delivery_boy_age'],
                'status' => $arrInputs['delivery_status'],
                'last_modified_by' => $arrInputs['last_modified_by'],
                'ip_address' => $arrInputs['ip_address'],
                //'device_id' => $arrInputs['device_id'],
                'code' => $arrInputs['delivery_code'],
            );

            $arrModifiedInputs['delivery_boy_details'] = array(
                'address_one' => $arrInputs['delivery_address_one'],
                'address_two' => $arrInputs['delivery_address_two'],
            );
            //Photo
            if (isset($arrImageParams['delivery_photo']['original_name']) && !empty($arrImageParams['delivery_photo']['original_name'])) {
                $arrModifiedInputs['delivery_boy_details'] = array_merge($arrModifiedInputs['delivery_boy_details'], array('photo_original_path' => $arrImageParams['delivery_photo']['original_name'], 'photo_path' => $arrImageParams['delivery_photo']['timestampName']));
            }
            //Address
            if (isset($arrImageParams['delivery_address_proof']['original_name']) && !empty($arrImageParams['delivery_address_proof']['original_name'])) {
                $arrModifiedInputs['delivery_boy_details'] = array_merge($arrModifiedInputs['delivery_boy_details'], array('address_original_path' => $arrImageParams['delivery_address_proof']['original_name'], 'address_proof_path' => $arrImageParams['delivery_address_proof']['timestampName']));
            }
            //License
            if (isset($arrImageParams['delivery_id_proof']['original_name']) && !empty($arrImageParams['delivery_id_proof']['original_name'])) {
                $arrModifiedInputs['delivery_boy_details'] = array_merge($arrModifiedInputs['delivery_boy_details'], array('driving_original_path' => $arrImageParams['delivery_id_proof']['original_name'], 'driving_license_path' => $arrImageParams['delivery_id_proof']['timestampName']));
            }
        }
        return $arrModifiedInputs;
    }

    public function modifyHireData($arrImageParams, $arrInputs) {
        $arrModifiedInputs = array();
        if (!empty($arrInputs)) {
            $arrInputs = self::makeUpdateData($arrInputs);

            //Hire A Mechanic
            $arrModifiedInputs['hire_a_mechanic'] = array(
                'first_name' => $arrInputs['hire_name'],
                'vehicle_types_id' => $arrInputs['hire_vehicle_id'],
                'description' => $arrInputs['hire_description'],
                'last_modified_by' => $arrInputs['last_modified_by'],
                'ip_address' => $arrInputs['ip_address'],
                'device_id' => $arrInputs['device_id'],
                'code' => $arrInputs['hire_code'],
            );

            //Address Details
            $arrModifiedInputs['hire_a_mechanic_address'] = array(
                'permenant_address' => $arrInputs['hire_permanent_address'],
                'present_address' => $arrInputs['hire_present_address'],
                'status' => 1,
                'is_primary' => 1,
            );

            //Communication
            $arrModifiedInputs['hire_a_mechanic_communication'] = array(
                'location' => $arrInputs['hire_location'],
            );

            //Location
            if (isset($arrInputs['location']) && !empty($arrInputs['location'])) {
                $arrModifiedInputs['hire_a_mechanic_communication'] = array_merge($arrModifiedInputs['hire_a_mechanic_communication'], array('latitude' => explode(',', $arrInputs['location'])[0], 'longitude' => explode(',', $arrInputs['location'])[1]));
            }


            //ID Proof
            if (isset($arrImageParams['hire_id_proof']['original_name']) && !empty($arrImageParams['hire_id_proof']['original_name'])) {
                $arrModifiedInputs['hire_a_mechanic_communication'] = array_merge($arrModifiedInputs['hire_a_mechanic_communication'], array('id_proof_name' => $arrImageParams['hire_id_proof']['timestampName'], 'id_proof_original_name' => $arrImageParams['hire_id_proof']['original_name']));
            }
            //Address
            if (isset($arrImageParams['hire_address_proof']['original_name']) && !empty($arrImageParams['hire_address_proof']['original_name'])) {
                $arrModifiedInputs['hire_a_mechanic_communication'] = array_merge($arrModifiedInputs['hire_a_mechanic_communication'], array('address_proof_name' => $arrImageParams['hire_address_proof']['timestampName'], 'original_address_proof_name' => $arrImageParams['hire_address_proof']['original_name']));
            }
            //Photo
            if (isset($arrImageParams['hire_photo']['original_name']) && !empty($arrImageParams['hire_photo']['original_name'])) {
                $arrModifiedInputs['hire_a_mechanic_communication'] = array_merge($arrModifiedInputs['hire_a_mechanic_communication'], array('image_name' => $arrImageParams['hire_photo']['timestampName'], 'original_image_name' => $arrImageParams['hire_photo']['original_name']));
            }


            //Certificates
            if (isset($arrImageParams['hire_certificates'][0]['original_name']) && !empty($arrImageParams['hire_certificates'][0]['original_name'])) {
                $arrCertificatesData = $arrImageParams['hire_certificates'];
                foreach ($arrCertificatesData as $arrCertificate) {
                    $arrModifiedInputs['hire_a_mechanic_certificates'][] = array(
                        'image_name' => $arrCertificate['timestampName'],
                        'original_image_name' => $arrCertificate['original_name'],
                        'status' => 1,
                    );
                }
                unset($arrCertificatesData);
            }
            //Email
            $arrModifiedInputs['hire_a_mechanic_email'] = array(
                'email' => $arrInputs['hire_email'],
                'status' => 1,
                'is_primary' => 1,
            );
            //Phone
            $arrModifiedInputs['hire_a_mechanic_phone'] = array(
                'phone' => $arrInputs['hire_phone'],
                'status' => 1,
                'is_primary' => 1,
            );
        }
        return $arrModifiedInputs;
    }

    public function modifyShop($arrInputs, $arrImageParams, $intMechanic = NULL) {
        $arrModifiedInputs = array();
        if (!empty($arrInputs)) {
            $arrInputs = self::makeUpdateData($arrInputs);
            //Mechanic Shops
            $arrModifiedInputs['mechanic_shops'] = array(
                'name' => $arrInputs['mechanic_shop_name'],
                'owner' => $arrInputs['mechanic_owner_name'],
                'email' => $arrInputs['mechanic_email'],
                'phone' => $arrInputs['mechanic_contact'],
                'last_modified_by' => $arrInputs['last_modified_by'],
                'ip_address' => $arrInputs['ip_address'],
                'device_id' => $arrInputs['device_id'],
                'present_address' => $arrInputs['mechanic_shop_address'],
                'code' => $arrInputs['mechanic_code'],
            );
            //Mechanic Shop Details
            $arrModifiedInputs['mechanic_shop_details'] = array(
                'address' => 'Hyderabad', //Need To Change
                'total_mechanics' => $arrInputs['mechanic_total'],
                'service_capability' => $arrInputs['mechanic_shop_capability'],
                'cities_id' => $arrInputs['mechanic_shop_city'],
                'areas_id' => $arrInputs['mechanic_area'],
                'pincode' => NULL,
                'location' => $arrInputs['adrs'],
                'last_modified_by' => $arrInputs['last_modified_by'],
                'ip_address' => $arrInputs['ip_address'],
                'device_id' => $arrInputs['device_id'],
            );

            //Location
            if (isset($arrInputs['location']) && !empty($arrInputs['location'])) {
                $arrModifiedInputs['mechanic_shop_details'] = array_merge($arrModifiedInputs['mechanic_shop_details'], array('latitude' => explode(',', $arrInputs['location'])[0], 'longitude' => explode(',', $arrInputs['location'])[1]));
            }

            //Shop Photo
            if (isset($arrImageParams['mechanic_photo']['original_name']) && !empty($arrImageParams['mechanic_photo']['original_name'])) {
                $arrModifiedInputs['mechanic_shop_details'] = array_merge($arrModifiedInputs['mechanic_shop_details'], array('photo_image' => $arrImageParams['mechanic_photo']['timestampName'], 'photo_original_image' => $arrImageParams['mechanic_photo']['original_name']));
            }

            //Shop Id Proof
            if (isset($arrImageParams['mechanic_id_proof']['original_name']) && !empty($arrImageParams['mechanic_id_proof']['original_name'])) {
                $arrModifiedInputs['mechanic_shop_details'] = array_merge($arrModifiedInputs['mechanic_shop_details'], array('id_image' => $arrImageParams['mechanic_id_proof']['timestampName'], 'id_original_image' => $arrImageParams['mechanic_id_proof']['original_name']));
            }

            //Shop Address Proof 
            if (isset($arrImageParams['mechanic_address_proof']['original_name']) && !empty($arrImageParams['mechanic_address_proof']['original_name'])) {
                $arrModifiedInputs['mechanic_shop_details'] = array_merge($arrModifiedInputs['mechanic_shop_details'], array('address_image' => $arrImageParams['mechanic_address_proof']['timestampName'], 'address_original_image' => $arrImageParams['mechanic_address_proof']['original_name']));
            }

            if (isset($arrInputs['mechanic_selected_services']) && !empty($arrInputs['mechanic_selected_services'])) {
                $arrShopServices = $arrInputs['mechanic_selected_services'];
                if (!empty($arrShopServices)) {
                    foreach ($arrShopServices as $intService) {
                        $arrModifiedInputs['selected_services'][] = array(
                            'mechanic_shops_id' => $intMechanic,
                            'vehicle_types_id' => $arrInputs['mechanic_vehicle_type'],
                            'service_types_id' => $intService,
                            'status' => 1,
                            'total_mechanics' => 0,
                            'service_capability' => 0,
                        );
                    }
                }
            }
        }
        return $arrModifiedInputs;
    }

    public function modifyShopServices($arrShopServices) {
        $arrModifiedServices = array();
        if (!empty($arrShopServices)) {
            foreach ($arrShopServices as $arrService) {
                $arrModifiedServices[] = $arrService['serviceTypeId'];
            }
        }
        return $arrModifiedServices;
    }

    public function modifyAgentVehicles($arrImageParams, $arrInputs, $intSelfVehicle = NULL) {
        $arrModifiedInputs = array();
        $arrInputs = self::makeUpdateData($arrInputs);
        if (!empty($arrInputs)) {
            //Self Vehicles
            $arrModifiedInputs['self_vehicles'] = array(
                'vehicle_types_id' => $arrInputs['vehicle_type_id'],
                'vehicle_classes_id' => $arrInputs['vehicle_class_id'],
                'vehicle_variants_id' => $arrInputs['vehicle_variant_id'],
                'vehicle_brand_models_id' => $arrInputs['vehicle_brand_model_id'],
                'agents_id' => $arrInputs['vehicle_agent_id'],
                'seating' => $arrInputs['vehicle_seating_capacity'],
                'vehicle_registration_number' => $arrInputs['vehicle_registration_number'],
                'description' => $arrInputs['vehicle_description'],
                'last_modified_by' => $arrInputs['last_modified_by'],
                'ip_address' => $arrInputs['ip_address'],
                    //'device_id' => $arrInputs['device_id'],
            );

            //Self Vehicle Features
            $arrModifiedInputs['self_vehicles_features'] = array();
            if (isset($arrInputs['vehicle_features']) && !empty($arrInputs['vehicle_features'])) {
                $arrVehicleFeatures = array();
                foreach ($arrInputs['vehicle_features'] as $intFacility) {
                    $arrVehicleFeatures[] = array(
                        'self_vehicles_id' => $intSelfVehicle,
                        'vehicle_fetures_id' => $intFacility,
                        'status' => 1,
                        'last_modified_by' => $arrInputs['last_modified_by'],
                        'ip_address' => $arrInputs['ip_address'],
                            //'device_id' => $arrInputs['device_id'],
                    );
                }
                $arrModifiedInputs['self_vehicles_features'] = $arrVehicleFeatures;
                unset($arrVehicleFeatures);
            }

            //Self Vehicle Images
            $arrModifiedInputs['self_vehicles_images'] = array();
            //Vehicle Multiple Images
            if (isset($arrImageParams['multi_images']) && !empty($arrImageParams['multi_images'])) {
                $arrMultiImages = $arrImageParams['multi_images'];
                if (!empty($arrMultiImages)) {
                    $arrFinalMultiImages = array();
                    foreach ($arrMultiImages as $arrImage) {
                        $arrFinalMultiImages[] = array('image_name' => $arrImage['timestampName'], 'original_name' => $arrImage['original_name'], 'self_vehicles_id' => $intSelfVehicle, 'status' => 1, 'is_parent' => 0);
                    }
                    $arrModifiedInputs['self_vehicles_images'] = $arrFinalMultiImages;
                }
            }

            //Vehicle Primary Image
            if (isset($arrImageParams['primary_image']) && !empty($arrImageParams['primary_image'])) {
                $arrModifiedInputs['self_vehicles_images'] = array_merge($arrModifiedInputs['self_vehicles_images'], array(array('image_name' => $arrImageParams['primary_image'][0]['timestampName'], 'original_name' => $arrImageParams['primary_image'][0]['original_name'], 'self_vehicles_id' => $intSelfVehicle, 'status' => 1, 'is_parent' => 1)));
            }
        }
        unset($arrInputs, $arrImageParams, $intSelfVehicle);
        return $arrModifiedInputs;
    }

    public function modifySelfVehicleFacilities($arrSelfVehicleFeatures) {
        $arrModifiedFeatures = array();
        if (!empty($arrSelfVehicleFeatures)) {
            foreach ($arrSelfVehicleFeatures as $arrFeatures) {
                $arrModifiedFeatures[] = $arrFeatures['vehicle_fetures_id'];
            }
        }
        return $arrModifiedFeatures;
    }

    public function modifyVehicle($arrInputs) {

        $arrModifiedInputs = array();
        //$arrInputs = self::makeUpdateData($arrInputs);
        if (!empty($arrInputs)) {
            //Vehicles
            $arrModifiedInputs['vehicles'] = array(
                'vehicle_categories_id' => $arrInputs['vehicle_categories'],
                'vehicle_brands_id' => $arrInputs['brand'],
                'vehicle_brand_models_id' => $arrInputs['brandModel'],
                'vehicle_year' => $arrInputs['modelYear'],
                'last_modified_by' => $arrInputs['last_modified_by'],
                'ip_address' => $arrInputs['ip_address'],
                'status' => $arrInputs['vehicle_status'],
            );
        }
        return $arrModifiedInputs;
    }

    public function getNumberFormat($intNumber, $intPadding = 0) {
        $intModifiedNumber = 0;
        $intModifiedNumber = sprintf("%'.0" . $intPadding . "d\n", $intNumber);
        return $intModifiedNumber;
    }

    public function getHotOrderNumber($strOrderNumber, $intDigit) {
        $intNumber = substr($strOrderNumber, $intDigit);
        return $intNumber;
    }

    public function getNewOrderNumber($intNumber, $strKey, $intPadding) {
        $strNewOrderNumber = NULL;
        $intNumber = $intNumber + 1;
        $intNumber = self::getNumberFormat($intNumber, $intPadding);
        $strNewOrderNumber = $strKey . $intNumber;
        return $strNewOrderNumber;
    }

}

?>