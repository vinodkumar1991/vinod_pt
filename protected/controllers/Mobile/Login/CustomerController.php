<?php

/**
 * @author Digital Today
 * @ignore It will handle customer operations
 */
class CustomerController extends Controller {

    /**
     * @author Digital Today
     * @param array $arrCustomer
     * @param integer $intCustomerId
     * @return integer It will return last inserted customer email id
     */
    public function createEmail($arrCustomer, $intCustomerId, $isMobileService = NULL) {
        $intCustomerEmailId = CustomerEmail::model()->create($arrCustomer, $intCustomerId, $isMobileService);
        return $intCustomerEmailId;
    }

    /**
     * @author Ctel
     * @param array $arrCustomer
     * @param integer $intCustomerId
     * @return integer It will return last inerted phone id
     */
    public function createPhone($arrCustomer, $intCustomerId) {
        $arrCustomer = array_merge($arrCustomer, array('phone_type_id' => 1));
        $arrCustomer['mobile'] = isset($arrCustomer['phone']) ? $arrCustomer['phone'] : NULL;
        $intCustomerPhoneId = CustomerPhone::model()->create($arrCustomer, $intCustomerId);
        return $intCustomerPhoneId;
    }

    /**
     * @author Digital Today
     * @param array $arrCustomerInput
     * @return integer It will return last inserted customer id
     */
    public function createCustomer($arrCustomerInput) {
        $intCustomerId = 0;
        //Password
        if (isset($arrCustomerInput['password'])) {
            $arrCustomerInput['password'] = CommonFunctions::generatePassword($arrCustomerInput['password']);
        }
        $arrCustomerInput['first_name'] = isset($arrCustomerInput['username']) ? $arrCustomerInput['username'] : NULL;
        
        $arrHotOrderData = Customer::getCustomerCode();
        $strKey = Yii::app()->params['service_codes']['registration_ids']['customer'];
        $strCustomerCode = 'MPSCUST0000001';
        $intDigit = Yii::app()->params['service_codes']['registration_ids']['customer_digit'];
        $intPadding = Yii::app()->params['service_codes']['registration_ids']['customer_padding'];

        if (!empty($arrHotOrderData)) {
            $objectDataManager = new DataManager();
            $intPartialMaxNumber = $objectDataManager->getHotOrderNumber($arrHotOrderData[0]['customer_code'], $intDigit);
            $strCustomerCode = $objectDataManager->getNewOrderNumber($intPartialMaxNumber, $strKey, $intPadding);
        }
        $arrCustomerInput['customer_code'] = $strCustomerCode;
        
        $intCustomerId = Customer::model()->create($arrCustomerInput);
        return $intCustomerId;
    }

    /**
     * @author Digital Today
     * @access public 
     * @return object It will return customer data
     */
    public function actionSignIN() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $objCustomer = new Mob_SignInForm();
            $objCustomer->attributes = $_POST;
            if ($objCustomer->validate()) {
                $strPassword = CommonFunctions::generatePassword($objCustomer->password);
                $arrCustomer = Customer::model()->customerSIGNIN($objCustomer->username, $strPassword);
                if (!empty($arrCustomer)) {
                    Customer::updateCustomer(array('gcm_register_id' => $objCustomer->gcm_register_id), $arrCustomer['customer_id']);
                    $arrCustomer = array_merge($arrCustomer, array('session_id' => Yii::app()->getSession()->getSessionId()));
                    $arrResponse = array('type' => 'success', 'data' => $arrCustomer, 'message' => 'Successfully loggedin.', 'code' => 200);
                } else {
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Invalid username or password given.', 'code' => 300);
                }
            } else {
                $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Invalid username or password given.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again later.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

    /**
     * @author Digital Today
     * @access public
     * @return object It will return customer data
     */
    public function actionSignUP() {
        $arrResponse = array();
        if (Yii::app()->request->isPostRequest) {
            $objCustomer = new Mob_CustomerForm();
            $objCustomer->attributes = $_POST;
            $objectDataManager = new DataManager();
            if ($objCustomer->validate()) {
                $arrCustomer = $objectDataManager->makeMobileData($objCustomer->attributes);
                $objTransaction = Yii::app()->db->beginTransaction();
                //customer
                $intCustomer = $this->createCustomer($arrCustomer); //1 => Mobile Sigup
                //customer_email
                $intEmail = $this->createEmail($arrCustomer, $intCustomer, 1); //1 => Mobile Sigup
                //customer_phone
                $intPhone = $this->createPhone($arrCustomer, $intCustomer);
                if (!empty($intPhone)) {
                    $objTransaction->commit();
                    $arrResponse = array('customer_id' => $intCustomer, 'customer_name' => $arrCustomer['username'], 'session_id' => Yii::app()->getSession()->getSessionId());
                    $arrResponse = array('type' => 'success', 'data' => $arrResponse, 'message' => 'Registered Successfully.', 'code' => 200);
                } else {
                    $objTransaction->rollback();
                    $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again later.', 'code' => 300);
                }
            } else {
                $arrModifiedErrors = $objectDataManager->modifyMobileErrors($objCustomer->errors);
                $arrResponse = array('type' => 'fail', 'data' => $arrModifiedErrors, 'message' => 'Username or Email Or Phonenumber already exists. Please Try With Other Details.', 'code' => 300);
            }
        } else {
            $arrResponse = array('type' => 'fail', 'data' => $arrResponse, 'message' => 'Oops error occured. Please try again later.', 'code' => 300);
        }
        $this->renderJSON($arrResponse);
    }

}
