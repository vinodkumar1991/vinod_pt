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
        //$strDevice = CommonFunctions::getDevice();
        $strDevice = 'Comuter';
        $intDeviceId = CommonFunctions::getDeviceId($strDevice);
        return array(
            'created_date' => date('Y-m-d h:i:s'),
            'created_by' => 1,
            'ip_address' => Yii::app()->request->userHostAddress,
            'status' => 0,
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

    public function getSelfDriveImageDetails($arrSelfAgentDetails) {
        $arrSelfImageDetails = array();
        foreach ($arrSelfAgentDetails as $selfvehicleId) {
            //echo $selfvehicleId['id'];
            $arrSelfImageDetails['images'][] = SelfVehicles::model()->getImageDetails($selfvehicleId['id']);
        }
        return $arrSelfImageDetails;
    }

    public function getImageChildDetails($arrSelfAgentDetails) {
        $arrSelfChildImageDetails = array();
        foreach ($arrSelfAgentDetails as $selfvehicleId) {
            //echo $selfvehicleId['id'];
            $arrSelfChildImageDetails = SelfVehicles::model()->getImageChildDetails($selfvehicleId['id']);
        }
        return $arrSelfChildImageDetails;
    }

    public function getFeatureDetails($arrSelfAgentDetails) {
        $arrSelfFeaturedDetails = array();
        foreach ($arrSelfAgentDetails as $selfvehicleId) {
            $arrSelfFeaturedDetails[] = SelfVehicles::model()->getFeaturesDetails($selfvehicleId['id']);
        }

        return $arrSelfFeaturedDetails;
    }

    /**
     * @author Ctel
     * @return array It will return verification code
     */
    public function getVerificationCode() {
        $strVerifyToken = CommonFunctions::getNumberToken();
        return array('verify_token' => $strVerifyToken);
    }

    /**
     * @author Ctel
     * @param string $strUsername
     * @param string $strPassword
     * @return integer It will return an integer response
     */
    public function validateCredentials($strDBPwd, $strPassword) {
        $strMD5Pwd = CommonFunctions::generatePassword($strPassword);
        $intIsMatch = strcmp($strDBPwd, $strMD5Pwd);
        if (0 != $intIsMatch) {
            return 0;
        } else {
            return 1;
        }
    }

    public function getOTPTemplate($strOTP) {
        $strTemplate = 'Yay! Metre Per Second OTP is ' . $strOTP . '. Happy to help with all your vehicle needs.';
        return $strTemplate;
    }

    /**
     * @author Ctel
     * @return array It will return common columns data of table
     */
    public function getMobileDefaults() {
        return array(
            'created_date' => date('Y-m-d h:i:s'),
            'created_by' => 1,
            'ip_address' => Yii::app()->request->userHostAddress,
            'status' => 1,
        );
    }

    /**
     * @author Ctel
     * @param array $arrInput
     * @return array It will combine table default values with input
     */
    public function makeMobileData($arrInput) {
        $arrCommon = self::getMobileDefaults();
        $arrData = array_merge($arrInput, $arrCommon);
        if (isset($arrData['device_name'])) {
            $arrData['device_id'] = CommonFunctions::getDeviceId($arrData['device_name']);
        }
        return $arrData;
    }

    public function prepareRepairsList($arrRepairs) {
        $arrModifiedRepairs = array();
        if (!empty($arrRepairs)) {
            foreach ($arrRepairs as $objRepair) {
                $arrModifiedRepairs[$objRepair['id']] = $objRepair['name'];
            }
        }
        return $arrModifiedRepairs;
    }

    public function makeSelfOrder() {
        
    }

    public function makeOrders($arrOrderDetails) {
        $arrModifiedOrders = array();
        if (!empty($arrOrderDetails)) {
            $arrDefaults = $this->getDefaults();
            $arrOrders = $arrOrderDetails;
            $arrModifiedOrders['customer_id'] = Yii::app()->session['customerID'];

            /* Order ID format :: start */
            $strKey = $strOrderNumber = $intDigit = NULL;
            if (1 == $arrOrders['vehicle_type']) {
                $arrHotOrderData = Orders::getOrderNumber($arrOrders['vehicle_type']);
                $strKey = Yii::app()->params['service_codes']['bookaservice']['car'];
                $strOrderNumber = Yii::app()->params['service_codes']['bookaservice']['car_format'];
                $intDigit = Yii::app()->params['service_codes']['bookaservice']['car_digit'];
                $intPadding = Yii::app()->params['service_codes']['bookaservice']['car_padding'];
            } elseif (2 == $arrOrders['vehicle_type']) {
                $arrHotOrderData = Orders::getOrderNumber($arrOrders['vehicle_type']);
                $strKey = Yii::app()->params['service_codes']['bookaservice']['bike'];
                $strOrderNumber = Yii::app()->params['service_codes']['bookaservice']['bike_format'];
                $intDigit = Yii::app()->params['service_codes']['bookaservice']['bike_digit'];
                $intPadding = Yii::app()->params['service_codes']['bookaservice']['bike_padding'];
            }

            if (!empty($arrHotOrderData)) {
                $intPartialMaxNumber = self::getHotOrderNumber($arrHotOrderData[0]['order_number'], $intDigit);
                $strOrderNumber = self::getNewOrderNumber($intPartialMaxNumber, $strKey, $intPadding);
            }
            $arrModifiedOrders['order_number'] = $strOrderNumber;
            /* Order ID format :: END */

            //$strCustomSolider = '0123456789abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            //$arrModifiedOrders['order_number'] = CommonFunctions::getCustomToken($strCustomSolider, 5);
            $arrModifiedOrders['order_status'] = Yii::app()->params['order_staus']['NEW'];
            $arrModifiedOrders['vehicle_variant_id'] = 1; //Need to change
            $arrModifiedOrders['vehicle_types_id'] = $arrOrders['vehicle_type'];
            $arrModifiedOrders['vehicle_brand_id'] = $arrOrders['brand_id'];
            $arrModifiedOrders['vehicle_brand_model_id'] = $arrOrders['model_id'];
            $arrModifiedOrders['vehicle_categories_id'] = $arrOrders['order_summary']['vehicle_category_id'];
            $arrModifiedOrders['vehicle_service_type_id'] = $arrOrders['service_id'];
            $arrModifiedOrders['vehicle_plan_id'] = $arrOrders['plan_id'];
            $arrModifiedOrders['payment_modes_id'] = $arrOrders['payment_mode'];
            $arrModifiedOrders['created_date'] = $arrDefaults['created_date'];
            $arrModifiedOrders['created_by'] = $arrDefaults['created_by'];
            $arrModifiedOrders['ip_address'] = $arrDefaults['ip_address'];
            $arrModifiedOrders['device_types_id'] = $arrDefaults['device_id'];
        }
        return $arrModifiedOrders;
    }

    public function makeOrderCommunications($arrOrderDetails, $intOrderId) {
        $arrOrderCommunication = array();
        if (!empty($arrOrderDetails)) {
            $arrOrderCommunication['order_id'] = $intOrderId;
            $arrOrderCommunication['name'] = $arrOrderDetails['name'];
            $arrOrderCommunication['additional_info'] = $arrOrderDetails['additional'];
            $arrOrderCommunication['door_no'] = NULL;
            $arrOrderCommunication['address_one'] = $arrOrderDetails['address1'];
            $arrOrderCommunication['address_two'] = $arrOrderDetails['address2'];
            $arrOrderCommunication['pincode'] = '500016'; //Need to change
            $arrOrderCommunication['email'] = $arrOrderDetails['email'];
            $arrOrderCommunication['alternate_email'] = NULL;
            $arrOrderCommunication['phone'] = $arrOrderDetails['phone'];
            $arrOrderCommunication['alternate_phone'] = NULL;
            $arrOrderCommunication['location'] = $arrOrderDetails['location'];
            if (isset($arrOrderDetails['lati_longitude']) && !empty($arrOrderDetails['lati_longitude'])) {
                $arrLongiLatitudes = explode(',', $arrOrderDetails['lati_longitude']);
                $strLatitude = $arrLongiLatitudes[0];
                $strLongitude = $arrLongiLatitudes[1];
            } else {
                $strLatitude = isset($arrOrderDetails['latitude']) ? $arrOrderDetails['latitude'] : NULL;
                $strLongitude = isset($arrOrderDetails['longitude']) ? $arrOrderDetails['longitude'] : NULL;
            }
            $arrOrderCommunication['latitude'] = $strLatitude;
            $arrOrderCommunication['longitude'] = $strLongitude;
            $strBookedDate = $this->modifyDate($arrOrderDetails['booked_date']);
            $arrOrderCommunication['pickup_date'] = $strBookedDate;
            $arrOrderCommunication['pickup_time'] = $arrOrderDetails['booked_time'];
        }
        unset($arrOrderDetails);
        unset($intOrderId);
        return $arrOrderCommunication;
    }

    public function makeOrderBilling($arrOrderDetails, $intOrderId) {
        $arrModifiedOrderBilling = array();
        if (!empty($arrOrderDetails)) {
            $arrDefaults = $this->getDefaults();
            $arrModifiedOrderBilling['order_id'] = $intOrderId;
            $arrFinalOrderBilling = $this->doBilling($arrOrderDetails);
            $arrModifiedOrderBilling['basic'] = isset($arrFinalOrderBilling['basic']) ? $arrFinalOrderBilling['basic'] : 0.00;
            $arrModifiedOrderBilling['final'] = isset($arrFinalOrderBilling['final']) ? $arrFinalOrderBilling['final'] : 0.00;
            $arrModifiedOrderBilling['tax'] = isset($arrFinalOrderBilling['tax']) ? $arrFinalOrderBilling['tax'] : 0.00;
            $arrModifiedOrderBilling['extra_add_ons'] = isset($arrFinalOrderBilling['extra_add_ons']) ? $arrFinalOrderBilling['extra_add_ons'] : 0.00;
            $arrModifiedOrderBilling['created_date'] = $arrDefaults['created_date'];
            $arrModifiedOrderBilling['created_by'] = $arrDefaults['created_by'];
            $arrModifiedOrderBilling['ip_address'] = $arrDefaults['ip_address'];
            $arrModifiedOrderBilling['device_types_id'] = $arrDefaults['device_id'];
        }
        unset($arrOrderDetails, $intOrderId);
        return $arrModifiedOrderBilling;
    }

    public function makeOrderRepairs($arrOrderDetails, $intOrderId) {
        $arrModifiedOrderRepairs = array();
        $arrRepairsList = array();
        $arrDefaults = $this->getDefaults();
        if (isset($arrOrderDetails['order_summary']['repairs_subrepairs_list'])) {
            $arrRepairsList = $arrOrderDetails['order_summary']['repairs_subrepairs_list'];
            foreach ($arrRepairsList as $arrEleRepair) {
                foreach ($arrEleRepair as $intRepair => $intSubRepair) {
                    $arrSubRepair = explode('_', $intSubRepair);
                    $arrModifiedOrderRepairs[] = array(
                        'order_id' => $intOrderId,
                        'repairs_id' => $intRepair,
                        'repairs_list_id' => $arrSubRepair[0],
                        'cost' => $arrSubRepair[1],
                        'created_date' => $arrDefaults['created_date'],
                        'created_by' => $arrDefaults['created_by'],
                        'ip_address' => $arrDefaults['ip_address'],
                        'device_types_id' => $arrDefaults['device_id'],
                    );
                }
            }
        }
        unset($arrRepairsList, $arrDefaults);
        return $arrModifiedOrderRepairs;
    }

    public function modifyDate($strDate, $strFormat = 'Y-m-d') {
        $strModifiedDate = NULL;
        $strTimeStamp = date_create($strDate);
        $strModifiedDate = date_format($strTimeStamp, $strFormat);
        unset($strTimeStamp, $strFormat);
        return $strModifiedDate;
    }

    public function modifyVehicleData($arrInput) {
        $arrVehicleVariants = Yii::app()->params['vehicle_variants'];
        $arrCommon = self::getMobileDefaults();
        $arrData = array_merge($arrInput, $arrCommon);
        if (isset($arrData['device_name'])) {
            $arrData['device_types_id'] = CommonFunctions::getDeviceId($arrData['device_name']);
            $arrData['vehicle_variant_id'] = $arrVehicleVariants[$arrData['vehicle_variant_name']];
        }
        if (isset($arrData['last_serviced'])) {
            $strLastServiced = NULL;
            $arrLastServiced = explode('/', $arrData['last_serviced']);
            //Year
            $strLastServiced .= $arrLastServiced[2] . '-';
            //Month
            if ($arrLastServiced[1] < 10) {
                $strLastServiced .= '0' . $arrLastServiced[1] . '-';
            } else {
                $strLastServiced .= $arrLastServiced[1] . '-';
            }
            //Date
            if ($arrLastServiced[0] < 10) {
                $strLastServiced .= '0' . $arrLastServiced[0];
            } else {
                $strLastServiced .= $arrLastServiced[0];
            }
            $arrData['last_serviced'] = $strLastServiced;
        }
        unset($arrData['vehicle_variant_name'], $arrData['device_name']);
        return $arrData;
    }

    public function getOtherServiceTemplate($arrData) {
        $strTemplate = NULL;
        $strOrderNumber = isset($arrData['order_number']) ? $arrData['order_number'] : NULL;
        $strServiceName = isset($arrData['service_name']) ? $arrData['service_name'] : NULL;
        $strVehicleName = isset($arrData['vehicle_name']) ? $arrData['vehicle_name'] : NULL;
        $strPalnName = isset($arrData['plan_name']) ? $arrData['plan_name'] : NULL;
        $strTemplate .= 'Hi ' . $arrData['other_name'] . ', This is your order number : ' . $strOrderNumber . ' for vehicle type: ' . $strVehicleName . ' , service name : ' . $strServiceName . ' and paln :' . $strPalnName;
        return $strTemplate;
    }

    public function makeMobileOrders($arrOrderDetails) {
        $arrModifiedOrders = array();
        if (!empty($arrOrderDetails)) {
            $arrDefaults = $this->getDefaults();
            $arrOrders = $arrOrderDetails;

            /* Order ID format :: start */
            $strKey = $strOrderNumber = $intDigit = NULL;
            if (1 == $arrOrders['vehicle_id']) {
                $arrHotOrderData = Orders::getOrderNumber($arrOrders['vehicle_id']);
                $strKey = Yii::app()->params['service_codes']['bookaservice']['car'];
                $strOrderNumber = Yii::app()->params['service_codes']['bookaservice']['car_format'];
                $intDigit = Yii::app()->params['service_codes']['bookaservice']['car_digit'];
                $intPadding = Yii::app()->params['service_codes']['bookaservice']['car_padding'];
            } elseif (2 == $arrOrders['vehicle_id']) {
                $arrHotOrderData = Orders::getOrderNumber($arrOrders['vehicle_id']);
                $strKey = Yii::app()->params['service_codes']['bookaservice']['bike'];
                $strOrderNumber = Yii::app()->params['service_codes']['bookaservice']['bike_format'];
                $intDigit = Yii::app()->params['service_codes']['bookaservice']['bike_digit'];
                $intPadding = Yii::app()->params['service_codes']['bookaservice']['bike_padding'];
            }

            if (!empty($arrHotOrderData)) {
                $intPartialMaxNumber = self::getHotOrderNumber($arrHotOrderData[0]['order_number'], $intDigit);
                $strOrderNumber = self::getNewOrderNumber($intPartialMaxNumber, $strKey, $intPadding);
            }

            /* Order ID format :: END */


            $arrModifiedOrders['customer_id'] = $arrOrders['customer_id'];
            // $strCustomSolider = '0123456789abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            //$arrModifiedOrders['order_number'] = CommonFunctions::getCustomToken($strCustomSolider, 5);
            $arrModifiedOrders['order_number'] = $strOrderNumber;
            $arrModifiedOrders['order_status'] = Yii::app()->params['order_staus']['NEW'];
            $arrModifiedOrders['vehicle_types_id'] = $arrOrders['vehicle_id'];
            $arrModifiedOrders['vehicle_brand_id'] = $arrOrders['brand_id'];
            $arrModifiedOrders['vehicle_brand_model_id'] = $arrOrders['model_id'];
            $arrModifiedOrders['vehicle_categories_id'] = $arrOrders['vehicle_category_id'];
            $arrModifiedOrders['vehicle_service_type_id'] = $arrOrders['service_id'];
            $arrModifiedOrders['vehicle_plan_id'] = $arrOrders['plan_id'];
            $arrModifiedOrders['payment_modes_id'] = 4; // 4 => For partial payment mode
            $arrModifiedOrders['created_date'] = $arrDefaults['created_date'];
            $arrModifiedOrders['created_by'] = $arrDefaults['created_by'];
            $arrModifiedOrders['ip_address'] = $arrDefaults['ip_address'];
            $arrModifiedOrders['device_types_id'] = $arrDefaults['device_id'];
            $arrModifiedOrders['added_vehicles_id'] = isset($arrOrderDetails['added_vehicle_id']) ? $arrOrderDetails['added_vehicle_id'] : NULL;
        }
        return $arrModifiedOrders;
    }

    public function makeMobileOrderCommunications($arrOrderDetails, $intOrderId, $arrCustomer) {
        $arrOrderCommunication = array();
        $strLatitude = $strLongitude = NULL;
        if (!empty($arrOrderDetails)) {
            //c.id,c.password,c.verify_token,c.access_token,c.first_name,c.middle_name,c.last_name,c.status,ce.email,cp.phone,ca.address,ca.pincode
            $arrOrderCommunication['order_id'] = $intOrderId;
            $arrOrderCommunication['name'] = $arrCustomer['first_name'];
            $arrOrderCommunication['additional_info'] = NULL;
            $arrOrderCommunication['door_no'] = NULL;
            $arrOrderCommunication['address_one'] = $arrOrderDetails['location'];
            $arrOrderCommunication['address_two'] = $arrOrderDetails['location'];
            $arrOrderCommunication['pincode'] = '500016'; //Need to change
            $arrOrderCommunication['email'] = $arrCustomer['email'];
            $arrOrderCommunication['alternate_email'] = NULL;
            $arrOrderCommunication['phone'] = $arrCustomer['phone'];
            $arrOrderCommunication['alternate_phone'] = NULL;
            $arrOrderCommunication['location'] = $arrOrderDetails['location'];
            if (!empty($arrOrderDetails['lati_longitude'])) {
                $arrLongiLatitudes = explode(',', $arrOrderDetails['lati_longitude']);
                $strLatitude = $arrLongiLatitudes[0];
                $strLongitude = $arrLongiLatitudes[1];
            } else {
                $strLatitude = $arrOrderDetails['latitude'];
                $strLongitude = $arrOrderDetails['longitude'];
            }
            $arrOrderCommunication['latitude'] = $strLatitude;
            $arrOrderCommunication['longitude'] = $strLongitude;
            $strBookedDate = $this->modifyDate($arrOrderDetails['booked_date']);
            $arrOrderCommunication['pickup_date'] = $strBookedDate;
            $arrOrderCommunication['pickup_time'] = $arrOrderDetails['booked_time'];
            $arrOrderCommunication['imei_no'] = $arrOrderDetails['imei_no'];
        }
        unset($arrCustomer);
        unset($arrOrderDetails);
        unset($intOrderId);
        return $arrOrderCommunication;
    }

    public function makeMobileOrderBilling($arrOrderDetails, $intOrderId) {
        $arrModifiedOrderBilling = array();
        if (!empty($arrOrderDetails)) {
            $arrDefaults = $this->getDefaults();
            $arrFinalOrderBilling = $this->doBilling($arrOrderDetails);
            $arrModifiedOrderBilling['order_id'] = $intOrderId;
            $arrModifiedOrderBilling['basic'] = isset($arrFinalOrderBilling['basic']) ? $arrFinalOrderBilling['basic'] : 0.00;
            $arrModifiedOrderBilling['final'] = isset($arrFinalOrderBilling['final']) ? $arrFinalOrderBilling['final'] : 0.00;
            $arrModifiedOrderBilling['tax'] = isset($arrFinalOrderBilling['tax']) ? $arrFinalOrderBilling['tax'] : 0.00;
            $arrModifiedOrderBilling['extra_add_ons'] = isset($arrFinalOrderBilling['extra_add_ons']) ? $arrFinalOrderBilling['extra_add_ons'] : 0.00;
            $arrModifiedOrderBilling['created_date'] = $arrDefaults['created_date'];
            $arrModifiedOrderBilling['created_by'] = $arrDefaults['created_by'];
            $arrModifiedOrderBilling['ip_address'] = $arrDefaults['ip_address'];
            $arrModifiedOrderBilling['device_types_id'] = $arrDefaults['device_id'];
        }
        unset($arrOrderDetails);
        unset($intOrderId);
        return $arrModifiedOrderBilling;
    }

    public function makeMobileOrderRepairs($arrOrderDetails, $intOrderId) {
        $arrModifiedOrderRepairs = array();
        $arrDefaults = $this->getDefaults();
        if (isset($arrOrderDetails['repairs_data'])) {
            $arrBookInput = json_decode($arrOrderDetails['repairs_data'], TRUE);
            $arrRepairsList = $arrBookInput['repairs'];
            $arrCheckPoint = array();
            foreach ($arrRepairsList as $arrEleRepair) {
                $arrCheckPoint[] = $arrEleRepair[$arrEleRepair['category']];
            }
            foreach ($arrCheckPoint as $arrEleSubRepair) {
                foreach ($arrEleSubRepair as $arrRepariValues) {
                    $arrModifiedOrderRepairs[] = array(
                        'order_id' => $intOrderId,
                        'repairs_id' => $arrRepariValues['repairId'],
                        'repairs_list_id' => $arrRepariValues['repairs_lists_id'],
                        'cost' => $arrRepariValues['cost'],
                        'created_date' => $arrDefaults['created_date'],
                        'created_by' => $arrDefaults['created_by'],
                        'ip_address' => $arrDefaults['ip_address'],
                        'device_types_id' => $arrDefaults['device_id'],
                    );
                }
            }
            unset($arrRepairsList, $arrDefaults, $arrBookInput, $arrCheckPoint);
        }
        return $arrModifiedOrderRepairs;
    }

    /**
     * @author Digital Today
     * @param type $strLatitude
     * @param type $strLongitude
     * @return array It will return max and min longitudes and latitudes
     */
    public function getMinMaxLatiLongis($strLatitude, $strLongitude) {
        $arrLatiLongis = array();
        // we'll want everything within, say, 10km distance
        $strDistance = Yii::app()->params['distance_in_kms'];
        // earth's radius in km = ~6371
        $strRadius = 6371;
        // latitude boundaries
        $strMaxLatitude = $strLatitude + rad2deg($strDistance / $strRadius);
        $strMinLatitude = $strLatitude - rad2deg($strDistance / $strRadius);
        // longitude boundaries (longitude gets smaller when latitude increases)
        $strMaxLongitude = $strLongitude + rad2deg($strDistance / $strRadius / cos(deg2rad($strLatitude)));
        $strMinLongitude = $strLongitude - rad2deg($strDistance / $strRadius / cos(deg2rad($strLatitude)));
        unset($strDistance, $strRadius, $strLatitude, $strLongitude);
        return array(
            'min_lati' => $strMinLatitude,
            'max_lati' => $strMaxLatitude,
            'min_longi' => $strMinLongitude,
            'max_longi' => $strMaxLongitude
        );
    }

    public function makeModificationShopOrders($arrInput) {

        $arrModification = array();
        if (!empty($arrInput)) {
            $arrCommon = self::getDefaults();
            $strCustomSolider = '0123456789abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $strOrderNumber = CommonFunctions::getCustomToken($strCustomSolider, 5);
            $arrCommon['status'] = 1;

            //ModificationOrders
            $arrModification['modification_orders'] = array(
                'shop_id' => $arrInput['id'],
                'customer_id' => $arrInput['custid'],
                'order_number' => $strOrderNumber,
                'order_status' => Yii::app()->params['order_staus']['NEW'],
                'status' => $arrCommon['status'],
                'vehicle_type_id' => $arrInput['vehicle_type'],
                'vehicle_brand_id' => $arrInput['brandID'],
                'vehicle_service_type_id' => $arrInput['serviceTypeID']
            );
            $arrModification['modification_orders'] = array_merge($arrModification['modification_orders'], $arrCommon);

            //ModificationShopOrders Billing
            $arrModification['modification_orders_communication'] = array(
                'name' => $arrInput['custname'],
                'address' => $arrInput['custadrs'],
                'pincode' => $arrInput['pincode'],
                'email' => $arrInput['custmail'],
                'phone' => $arrInput['custphone'],
                'location' => $arrInput['locationStr'],
                'latitude' => $arrInput['latitude'],
                'longitude' => $arrInput['longitude'],
                'send_request_datetime' => $arrCommon['created_date']
            );
            $arrModification['modification_orders_communication'] = $arrModification['modification_orders_communication'];
            return $arrModification;
        }
    }

    public function modifyMobileErrors($arrErrors) {
        $arrModifiedErrors = array();
        if (!empty($arrErrors)) {
            foreach ($arrErrors as $key => $value) {
                $arrModifiedErrors[] = array($key => $value[0]);
            }
        }
        return $arrModifiedErrors;
    }

    public function modifyLiveTrackingData($arrInput) {
        $arrModifedInput = array();
        if (!empty($arrInput)) {
            $arrModifedInput['users_id'] = $arrInput['userId'];
            $arrModifedInput['role_id'] = $arrInput['roleId'];
            $arrModifedInput['session_id'] = $arrInput['sessionId'];
            $arrModifedInput['imei_no'] = $arrInput['imei_no'];
            $strGPS = isset($arrInput['gps_point']) ? $arrInput['gps_point'] : NULL;
            $arrModifedInput['gps_point'] = serialize($strGPS);
            $arrModifedInput['latitude'] = isset($arrInput['latitude']) ? $arrInput['latitude'] : NULL;
            $arrModifedInput['longitude'] = isset($arrInput['longitude']) ? $arrInput['longitude'] : NULL;
        }
        return $arrModifedInput;
    }

    public function getForgotTemplate($arrData) {
        $strTemplate = 'Yay! Metre Per Second OTP is ' . $arrData['otp'] . '. Happy to help with all your vehicle needs.';
        unset($arrData);
        return $strTemplate;
    }

    public function getCRNTemplate($arrData) {
        $strTemplate = "Thank you! We request you to pay Rs." . $arrData['total_amount'] . ' towards your order ' . $arrData['order_number'] . ' at your door step, we are coming! Your CRN is: ' . $arrData['CRN'];
        return $strTemplate;
    }

    public function modifyRepairsList($arrRepairs) {
        $arrModifiedRepairs = array();
        if (!empty($arrRepairs)) {
            foreach ($arrRepairs as $arrRepairItem) {
                $arrModifiedRepairs[$arrRepairItem['repairName']][] = array(
                    'cost' => $arrRepairItem['cost'],
                    'repairId' => $arrRepairItem['repairId'],
                    'repairs_lists_id' => $arrRepairItem['repairs_lists_id'],
                    'repairName' => $arrRepairItem['repairName'],
                    'repairListName' => isset($arrRepairItem['repairListName']) ? $arrRepairItem['repairListName'] : NULL,
                    'id' => $arrRepairItem['id'],
                    'is_recommended' => 2,
                    'vehicle_type_id' => $arrRepairItem['vehicleTypeId'],
                );
            }
            unset($arrRepairs);
        }
        return $arrModifiedRepairs;
    }

    public function makeMobileOtherOrderRepairs($arrOrderDetails, $intOrderId) {
        $arrModifiedOrderRepairs = array();
        $arrDefaults = $this->getDefaults();
        if (isset($arrOrderDetails['repairs_data'])) {
            $arrBookInput = json_decode($arrOrderDetails['repairs_data'], TRUE);
            $arrRepairsList = $arrBookInput['repairs'];
            $arrCheckPoint = array();
            foreach ($arrRepairsList as $arrEleRepair) {
                $arrCheckPoint[] = $arrEleRepair[$arrEleRepair['category']];
            }
            foreach ($arrCheckPoint as $arrEleSubRepair) {
                foreach ($arrEleSubRepair as $arrRepariValues) {
                    $arrModifiedOrderRepairs[] = array(
                        'other_orders_id' => $intOrderId,
                        'repairs_id' => $arrRepariValues['repairId'],
                        'repairs_list_id' => $arrRepariValues['repairs_lists_id'],
                        'cost' => $arrRepariValues['cost'],
                        'created_date' => $arrDefaults['created_date'],
                        'created_by' => $arrDefaults['created_by'],
                        'ip_address' => $arrDefaults['ip_address'],
                        'device_types_id' => $arrDefaults['device_id'],
                    );
                }
            }
            unset($arrRepairsList, $arrDefaults, $arrBookInput, $arrCheckPoint);
        }
        return $arrModifiedOrderRepairs;
    }

    public function getVerifyCustomerTemplate($arrData) {
        $strTemplate = 'Yay! Metre Per Second OTP is ' . $arrData['CRN'] . ' Happy to help with all your vehicle needs.';
        return $strTemplate;
    }

    public function modifyGuide($arrInput) {
        $arrModifiedInput = array();
        if (!empty($arrInput)) {
            foreach ($arrInput as $arrCategory) {
                $arrModifiedInput[$arrCategory['category_name']][] = $arrCategory;
            }
        }
        return $arrModifiedInput;
    }

    public function modifyGuideCategories($arrGuideCategories) {
        $arrModifiedGuides = array();
        if (!empty($arrGuideCategories)) {
            foreach ($arrGuideCategories as $arrGuide) {
                $arrModifiedGuides[$arrGuide['category_name']] = $arrGuide['category_id'];
            }
        }
        return $arrModifiedGuides;
    }

    public function modifyExtraAddOns($arrAddOnsInput, $intOrder) {
        $arrModifiedAddOns = array();
        if (!empty($arrAddOnsInput)) {
            $arrCommon = self::getDefaults();
            $arrCommon['status'] = 1;
            unset($arrCommon['device_name']);
            //Items
            $strAddOnItems = str_replace('[', '', $arrAddOnsInput[0]);
            $strAddOnItems = str_replace(']', '', $strAddOnItems);
            $arrAddOnItems = explode(',', $strAddOnItems);
            //Prices
            $strAddOnPrices = str_replace('[', '', $arrAddOnsInput[1]);
            $strAddOnPrices = str_replace(']', '', $strAddOnPrices);
            $arrAddOnPrices = explode(',', $strAddOnPrices);
            foreach ($arrAddOnItems as $intKey => $strAddOn) {
                $arrModifiedAddOns[] = array_merge($arrCommon, array('order_id' => $intOrder, 'repair_name' => $strAddOn, 'repair_amount' => $arrAddOnPrices[$intKey]));
            }
        }
        return $arrModifiedAddOns;
    }

    public function doBilling($arrOrderDetails, $arrInput = array()) {
        $arrModifiedOrderDetails = array();
        $doubleExtraAddon = 0.00;
        if (!empty($arrOrderDetails)) {
            $doubleTax = Yii::app()->params['current_tax'];
            if (isset($arrInput['repairs_total_amount']) && !empty($arrInput['repairs_total_amount'])) {
                $doubleExtraAddon = isset($arrInput['repairs_total_amount']) ? $arrInput['repairs_total_amount'] : '0.00';
            }
            if (isset($arrOrderDetails['amount']) && !empty($arrOrderDetails['amount'])) {
                $doubleAmount = isset($arrOrderDetails['amount']) ? $arrOrderDetails['amount'] : '0.00';
            } else if (isset($arrOrderDetails['total_amount']) && !empty($arrOrderDetails['total_amount'])) {
                $doubleAmount = isset($arrOrderDetails['total_amount']) ? $arrOrderDetails['total_amount'] : '0.00';
            } else {
                //$doubleAmount = isset($arrOrderDetails['basic']) ? $arrOrderDetails['basic'] : '0.00';
                $doubleAmount = isset($arrOrderDetails['final']) ? $arrOrderDetails['final'] : '0.00';
            }
//            if ($doubleExtraAddon > $doubleAmount) {
//                $doubleExtraAddon = $doubleExtraAddon - $doubleAmount;
//            }

            $doubleAmount = $doubleAmount + $doubleExtraAddon;
            $doubleTaxAmount = ($doubleAmount * ($doubleTax / 100));
            $doubleAmount = $doubleAmount - $doubleTaxAmount;
            $doubleFinalAmount = $doubleAmount + $doubleTaxAmount;

            $arrModifiedOrderDetails = array(
                'basic' => $doubleAmount,
                'tax' => $doubleTaxAmount,
                'final' => $doubleFinalAmount,
                'extra_add_ons' => $doubleExtraAddon,
                'invoice_date' => date('Y-m-d H:i:s'),
                'invoice_number' => CommonFunctions::getNumberToken(6),
                'last_modified_by' => 1,
                'ip_address' => Yii::app()->request->userHostAddress,
            );
        }
        return $arrModifiedOrderDetails;
    }

    public function getDay() {
        $arrWeekDays = array('sunday' => 1, 'monday' => 2, 'tuesday' => 3, 'wednesday' => 4, 'thursday' => 5, 'friday' => 6, 'saturday' => 7);
        $strCurrentDate = date('Y/m/d');
        $strDay = date('l', strtotime($strCurrentDate));
        $strDay = strtolower($strDay);
        $intDayKey = $arrWeekDays[$strDay];
        return $intDayKey;
    }

    public function modifySelfVehicles($arrSelfVehicles, $arrInputs = array(), $arrCustomer = array()) {
        $arrModifiedSelfVehicles = array();
        if (!empty($arrSelfVehicles)) {
            $floatHours = 1;
            $strStartDate = $arrInputs['start_date'] . ' ' . $arrInputs['start_time'];
            $strEndDate = $arrInputs['end_date'] . ' ' . $arrInputs['end_time'];
            $arrDateDiffs = CommonFunctions::getDateDifferences($strStartDate, $strEndDate);
            if (isset($arrDateDiffs['minutes']) && !empty($arrDateDiffs['minutes'])) {
                $floatHours = ($arrDateDiffs['minutes'] / 60);
            }
            $floatHours = ceil($floatHours);
            foreach ($arrSelfVehicles as $arrVehicle) {
                $arrTemp = array();
                $arrVehicleImages = SelfVehicleImage::getVehicleImages(1, $arrVehicle['self_vehicle_id']);
                $arrVehicleFeatures = SelfVehiclesFeatures::getVehicleFeatures(1, $arrVehicle['self_vehicle_id']);
                $arrTemp = array(
                    'agent_id' => $arrVehicle['agent_id'],
                    'agency_name' => $arrVehicle['agency_name'],
                    'vehicle_type_id' => $arrVehicle['vehicle_type_id'],
                    'vehicle_type' => $arrVehicle['vehicle_type'],
                    'vehicle_class_name' => $arrVehicle['vehicle_class_name'],
                    'vehicle_class_id' => $arrVehicle['vehicle_class_id'],
                    'vehicle_variant_id' => $arrVehicle['vehicle_variant_id'],
                    'vehicle_variant_name' => $arrVehicle['vehicle_variant_name'],
                    'vehicle_model_name' => $arrVehicle['vehicle_model_name'],
                    'vehicle_model_id' => $arrVehicle['vehicle_model_id'],
                    'vehicle_brand_id' => $arrVehicle['vehicle_brand_id'],
                    'vehicle_brand_name' => $arrVehicle['vehicle_brand_name'],
                    'vehicle_seating_capacity' => $arrVehicle['vehicle_seating_capacity'],
                    'vehicle_status' => $arrVehicle['vehicle_status'],
                    'agent_vehicle_status' => $arrVehicle['agent_vehicle_status'],
                    'self_vehicle_id' => $arrVehicle['self_vehicle_id'],
                    'model_path' => $arrVehicle['model_path'],
                    'brand_path' => $arrVehicle['brand_path'],
                    'model_logo' => $arrVehicle['model_logo'],
                    'kmph' => $arrVehicle['kmph'],
                    'pphr' => $arrVehicle['pphr'],
                    'erpkm' => $arrVehicle['erpkm'],
                    'security_deposit' => $arrVehicle['security_deposit'],
                    'week_day_or_end' => $arrVehicle['week_day_or_end'],
                    'agent_location' => $arrVehicle['agent_location'],
                    'agent_latitude' => $arrVehicle['agent_latitude'],
                    'agent_longitude' => $arrVehicle['agent_longitude'],
                    'total_amount' => ($floatHours * $arrVehicle['pphr']),
                    'vehicle_images' => $arrVehicleImages,
                    'vehicle_features' => $arrVehicleFeatures,
                    'agent_address' => $arrVehicle['agent_address'],
                    'agent_pincode' => $arrVehicle['agent_pincode'],
                    'agent_email' => $arrVehicle['agent_email'],
                    'agent_phone' => $arrVehicle['agent_phone'],
                    'customer_email' => isset($arrCustomer['email']) ? $arrCustomer['email'] : NULL,
                    'customer_phone' => isset($arrCustomer['phone']) ? $arrCustomer['phone'] : NULL,
                    'customer_address' => isset($arrCustomer['address']) ? $arrCustomer['address'] : NULL,
                    'customer_pincode' => isset($arrCustomer['pincode']) ? $arrCustomer['pincode'] : NULL,
                    'customer_name' => isset($arrCustomer['first_name']) ? $arrCustomer['first_name'] : NULL,
                    'agent_name' => isset($arrVehicle['agent_owner']) ? $arrVehicle['agent_owner'] : NULL,
                    'vehicle_registration_number' => $arrVehicle['vehicle_registration_number'],
                    'total_estimated_hours' => $floatHours,
                );

                $doublDropAmount = $doublePickUpAmount = 0.00;
                //Drop Amount
                if (isset($arrInputs['is_door_step']) && !empty($arrInputs['is_door_step'])) {
                    $doublDropAmount = $arrVehicle['drop_amount'];
                }

                //Pickup Amount
                if (isset($arrInputs['is_pickup']) && !empty($arrInputs['is_pickup'])) {
                    $doublePickUpAmount = 0.00;
                    //$doublePickUpAmount = $arrVehicle['pickup_amount'];
                }
                $arrTemp = array_merge($arrTemp, array('door_step_amount' => $doublDropAmount));
                $arrTemp = array_merge($arrTemp, array('pickup_amount' => $doublePickUpAmount));
                $arrTemp['tax_amount'] = $this->getFinalAmount($arrTemp);
                $arrTemp['tax'] = Yii::app()->params['tax'];
                //$arrTemp['final_amount'] = $arrTemp['tax_amount'] + $arrTemp['total_amount'] + $doublDropAmount + $doublePickUpAmount + $arrTemp['security_deposit'];
                $arrTemp['final_amount'] = $arrTemp['total_amount'] + $doublDropAmount + $doublePickUpAmount + $arrTemp['security_deposit'];
                $arrModifiedSelfVehicles[] = $arrTemp;
            }
        }
        return $arrModifiedSelfVehicles;
    }

    public function getFinalAmount($arrTemp) {
        $doubleFinalAmount = 0.00;
        if (!empty($arrTemp)) {
            $doublePartialAmount = $arrTemp['total_amount'] + $arrTemp['door_step_amount'] + $arrTemp['pickup_amount'];
            $doubleFinalAmount = (($doublePartialAmount * Yii::app()->params['tax']) / 100);
        }
        return $doubleFinalAmount;
    }

    public function modifySelfDriveOrder($arrInputs) {
        $arrModifiedInputs = array();
        if (!empty($arrInputs)) {
            $arrCommon = self::getDefaults();
            $arrCommon['status'] = 1;
            $intPaymentMode = isset($arrInputs['payment_mode_id']) ? $arrInputs['payment_mode_id'] : 1;

            $strKey = $strOrderNumber = $intDigit = NULL;
            if (1 == $arrInputs['vehicle_id']) {
                $arrHotOrderData = SelfDriveOrders::getOrderNumber($arrInputs['vehicle_id']);
                $strKey = Yii::app()->params['service_codes']['selfdrive']['car'];
                $strOrderNumber = Yii::app()->params['service_codes']['selfdrive']['car_format'];
                $intDigit = Yii::app()->params['service_codes']['selfdrive']['car_digit'];
                $intPadding = Yii::app()->params['service_codes']['selfdrive']['car_padding'];
            } elseif (2 == $arrInputs['vehicle_id']) {
                $arrHotOrderData = SelfDriveOrders::getOrderNumber($arrInputs['vehicle_id']);
                $strKey = Yii::app()->params['service_codes']['selfdrive']['bike'];
                $strOrderNumber = Yii::app()->params['service_codes']['selfdrive']['bike_format'];
                $intDigit = Yii::app()->params['service_codes']['selfdrive']['bike_digit'];
                $intPadding = Yii::app()->params['service_codes']['selfdrive']['bike_padding'];
            }

            if (!empty($arrHotOrderData)) {
                $intPartialMaxNumber = self::getHotOrderNumber($arrHotOrderData[0]['order_number'], $intDigit);
                $strOrderNumber = self::getNewOrderNumber($intPartialMaxNumber, $strKey, $intPadding);
            }

            //SelfDriveOrders
            $arrModifiedInputs['self_drive_orders'] = array(
                'customer_id' => $arrInputs['customer_id'],
                'self_vehicles_id' => $arrInputs['self_vehicle_id'],
                'vehicle_types_id' => $arrInputs['vehicle_id'],
                'vehicle_classes_id' => $arrInputs['vehicle_class_id'],
                'vehicle_brand_models_id' => $arrInputs['vehicle_model_id'],
                //'order_number' => CommonFunctions::getSamllAlphaToken(6),
                'order_number' => $strOrderNumber,
                'order_status' => Yii::app()->params['order_staus']['NEW'],
                'status' => 1,
                'payment_mode_id' => $intPaymentMode,
                'vehicle_variants_id' => $arrInputs['vehicle_variant_id'],
            );
            $arrModifiedInputs['self_drive_orders'] = array_merge($arrModifiedInputs['self_drive_orders'], $arrCommon);


            //SelfDrive Order Communication
            $arrModifiedInputs['self_drive_orders_communication'] = array(
                'start_date' => $arrInputs['start_date'],
                'start_time' => $arrInputs['start_time'],
                'end_date' => $arrInputs['end_date'],
                'end_time' => $arrInputs['end_time'],
                'location' => $arrInputs['location'],
                'latitude' => $arrInputs['latitude'],
                'longitude' => $arrInputs['longitude'],
                'is_pickup' => $arrInputs['is_pickup'],
                'is_drop' => $arrInputs['is_door_step'],
                'pickup_location' => isset($arrInputs['pickup_location']) ? $arrInputs['pickup_location'] : NULL,
                'drop_location' => isset($arrInputs['drop_location']) ? $arrInputs['drop_location'] : NULL,
                'email' => isset($arrInputs['customer_email']) ? $arrInputs['customer_email'] : NULL,
                'phone' => isset($arrInputs['customer_phone']) ? $arrInputs['customer_phone'] : NULL,
                'pickup_latitude' => isset($arrInputs['pickup_latitude']) ? $arrInputs['pickup_latitude'] : NULL,
                'pickup_longitude' => isset($arrInputs['pickup_longitude']) ? $arrInputs['pickup_longitude'] : NULL,
                'drop_latitude' => isset($arrInputs['drop_latitude']) ? $arrInputs['drop_latitude'] : NULL,
                'drop_longitude' => isset($arrInputs['drop_longitude']) ? $arrInputs['drop_longitude'] : NULL,
                'pickup_amount' => isset($arrInputs['pickup_amount']) ? $arrInputs['pickup_amount'] : 0.00,
                'door_step_amount' => isset($arrInputs['door_step_amount']) ? $arrInputs['door_step_amount'] : 0.00,
            );



            //SelfDrive Order Billing
            $strInvoiceDate = $strInvoiceNumber = NULL;
            if (1 == $intPaymentMode) {
                $strInvoiceDate = date('Y-m-d H:i:s');
                $strInvoiceNumber = '#SD-' . CommonFunctions::getNumberToken(6);
            }
            $arrModifiedInputs['self_drive_orders_billing'] = array(
                'basic' => $arrInputs['total_amount'],
                'final' => $arrInputs['final_amount'],
                'tax' => $arrInputs['tax'],
                'tax_amount' => $arrInputs['tax_amount'],
                'security_deposit' => $arrInputs['security_deposit'],
                'invocie_date' => $strInvoiceDate,
                'invocie_number' => $strInvoiceNumber,
                'order_transaction' => NULL,
                'transaction_status' => NULL,
            );


            $arrModifiedInputs['self_drive_orders_billing'] = array_merge($arrModifiedInputs['self_drive_orders_billing'], $arrCommon);
        }
        return $arrModifiedInputs;
    }

    public function getSelfDriveSms($arrInputs) {
        $strTemplate = "Hurray! We have received your order " . $arrInputs['self_drive_orders']['order_number'] . " We'll call your shortly. Thank you for choosing Metre Per Second. Drive safe!";
        return $strTemplate;
    }

    public function getHireSMS($arrInputs) {
        $strName = isset($arrInputs['first_name']) ? $arrInputs['first_name'] : NULL;
        $strTemplate = "Hurray! " . $strName . ", we have received your order " . $arrInputs['order_number'] . " We'll call your shortly. Thank you for choosing Metre Per Second";
        return $strTemplate;
    }

    public function modifyHirePoints($arrHires) {
        $arrModifiedData = $arrHireViews = array();
        if (!empty($arrHires)) {
            $strAdminImageURL = Yii::app()->params['adminImgURL'];
            $strHireDetailsURL = Yii::app()->params['webURL'] . 'HireMechanic/HireDetails/id/';
            foreach ($arrHires as $arrHire) {
                $strHireView = NULL;
                $strHireView = '<div class="map_details"><img src="' . $strAdminImageURL . $arrHire['hire_image_path'] . $arrHire['hire_image'] . '" width="100" height="70" /><br><strong>&#x20B9;' . $arrHire['hire_price_hr'] . '</strong><a href="' . $strHireDetailsURL . $arrHire['hire_id'] . '/model/' . $arrHire['vehicle_brand_models_id'] . '/vehicle_id/' . $arrHire['vehicle_id'] . '" class="btn btn-block btn-submit ripple-effect btn-theme" style="margin-bottom:10px;">Hire</a>';
                $arrHireViews[] = array("lat" => $arrHire['hire_latitude'], "lon" => $arrHire['hire_longitude'], "title" => $arrHire['hire_location'], "zoom" => 10, "featureType" => 'water', "icon" => '../bookaservice/assets/img/hire-map-marker.png', "animation" => 'google.maps.Animation.DROP', "html" => $strHireView);
            }
            $arrModifiedData = $arrHireViews;
        }
        return $arrModifiedData;
    }

    public function getHireCustomerTemplate($arrInputs, $arrCustomer) {
        $strTemplate = NULL;
        $strTemplate .= 'New Order Number : ' . $arrInputs['order_number'] . '\n';
        $strTemplate .= 'Customer Name : ' . $arrCustomer['first_name'] . '\n';
        $strTemplate .= 'Customer Phone : ' . $arrCustomer['phone'] . '\n';
        return $strTemplate;
    }

    public function modifyMigration($arrInputs) {
        $arrModifiedInputs = array();
        if (!empty($arrInputs)) {
            $arrModifiedInputs = array(
                'is_migrated' => 1,
                'migrated_from' => $arrInputs['previous_runner_id'],
                'migrated_to' => $arrInputs['current_runner_id'],
                'delivery_boys_id' => $arrInputs['current_runner_id'],
            );
        }
        return $arrModifiedInputs;
    }

    public function getOrderTemplate($arrData) {
        $strTemplate = 'Hurray! ' . $arrData['customer_name'] . ', we received your order ' . $arrData['order_number'] . ' Track your order via Metre Per Second App:' . Yii::app()->params['app_download_link'];
        return $strTemplate;
    }

    public function getNumberFormat($intNumber, $intPadding = 0) {
        $intModifiedNumber = 0;
        $intModifiedNumber = sprintf("%'.0" . $intPadding . "d\n", $intNumber);
        return $intModifiedNumber;
    }

    public function getHotOrderNumber(
    $strOrderNumber, $intDigit) {
        $intNumber = substr($strOrderNumber, $intDigit);
        return $intNumber;
    }

    public function getNewOrderNumber($intNumber, $strKey, $intPadding) {
        $strNewOrderNumber = NULL;
        $intNumber = $intNumber + 1;
        $intNumber = self::getNumberFormat($intNumber, $intPadding);
        $strNewOrderNumber = $strKey . $intNumber;
        $strNewOrderNumber = trim($strNewOrderNumber);
        return $strNewOrderNumber;
    }

    public function getOnlineCRNTemplate($arrData) {
        $strTemplate = "Thank you! We received your payment of Rs." . $arrData['total_amount'] . " towards your order " . $arrData['order_number'] . " Your CRN is: " . $arrData['CRN'];
        return $strTemplate;
    }

    public function getCloseTemplate($arrOther) {
        $strTemplate = "Yes! " . $arrOther['first_name'] . ", your order has been completed. Thank you for choosing us. Cheers!";
        return $strTemplate;
    }

}

?>
