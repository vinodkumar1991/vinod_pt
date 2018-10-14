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
            if (array_sum($arrImageDimensions[$i]) < 2000) {
                $strImagePath = realpath(Yii::app()->basePath) . '/../images/uploadimages/' . $arrImageDimensions[$i]['folder_path'] . $arrImageDimensions[$i]['device'] . '/' . $strTimestampName;
            }
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
            if (array_sum($arrImageDimensions[$i]) < 2000) {
                $strImagePath = realpath(Yii::app()->basePath) . '/../images/uploadimages/' . $arrImageDimensions[$i]['folder_path'] . $arrImageDimensions[$i]['device'] . '/' . $strTimestampName;
            }
            
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
       
           // die();
        return $arrImageNames;
    }

    public function modifyMechanic($arrMechanic, $arrImagesParams) {

        $arrModifiedMechanic = array();
        if (!empty($arrMechanic)) {
            $arrCommon = self::getDefaults();
            $strMechanicCode = 'MS-';
            $strMechanicCode .= CommonFunctions::getNumberToken();
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
                'mechanic_shop_name' => $arrMechanic['mechanic_shop_name'],
                'owner' => $arrMechanic['mechanic_owner_name'],
                'code' => $strMechanicCode,
                'license' => $arrMechanic['mechanic_shop_license'],
                'email' => $arrMechanic['mechanic_email'],
                'phone' => $arrMechanic['mechanic_contact'],
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
                'photo_image' => $arrImagesParams['mechanic_address_proof']['original_name'],
                'photo_original_image' => $arrImagesParams['mechanic_address_proof']['original_name'],
            );
            $arrModifiedMechanic['mechanic_shop_details'] = array_merge($arrModifiedMechanic['mechanic_shop_details'], $arrCommon);

            return $arrModifiedMechanic;
        }
    }

    public function modifyDelivery($arrDelivery, $arrImagesParams) {
        $arrModifiedDelivery = array();
        $arrCommon = self::getDefaults();
        $strDeliveryCode = 'DB-';
        $strDeliveryCode .= CommonFunctions::getNumberToken();
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
                'pincode' =>$arrModification['shop_pincode'], 
                'location' => $arrModification['shop_adrs'], //Need to change
                //'latitude' => explode(',', $arrModification['shop_location'])[0], //Need to change
                //'longitude' => explode(',', $arrModification['shop_location'])[1], //Need to change
                'shop_image' => $arrImagesParams['shop_image']['timestampName'],
                'shop_original_image' => $arrImagesParams['shop_image']['original_name'],
                'brand_logo' => $arrImagesParams['brand_logo']['timestampName'],
                'brand_original_logo' => $arrImagesParams['brand_logo']['original_name'], 
            );
            $arrModificationShop['modification_shop_details'] = array_merge($arrModificationShop['modification_shop_details'], $arrCommon);                                    
           //echo'<pre>'; print_r($arrModificationShop);die();
            return $arrModificationShop;
        }
    }

}

?>