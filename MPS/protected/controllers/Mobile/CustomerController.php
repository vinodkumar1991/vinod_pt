<?php

class CustomerController extends Controller {

    /**
     * @author Ctel
     * @return string It will succes or fail response
     */
    public function actionTestWeb() {
        echo "You are in create method";
            die();
        if (Yii::app()->request->isPostRequest) {
            
            $arrResponse = array();
            $intCustomerId = 0;
            $objCustomer = new CustomerForm();
            $objCustomer->attributes = $_POST;
            if ($objCustomer->validate()) {
                $objectTransaction = Yii::app()->db->beginTransaction();
                $objectDataManager = new DataManager();
                $arrCustomer = $objectDataManager->makeData($objCustomer->attributes);
                $intCustomerId = $this->createCustomer($arrCustomer);
                $this->createEmail($arrCustomer, $intCustomerId);
                $intCustomerPhoneId = $this->createPhone($arrCustomer, $intCustomerId);
                $strVerificationCode = $this->createVerificationCode($intCustomerId);
                $strSMSToken = $this->actionSendToken(array('otp' => $strVerificationCode, 'mobile' => $objCustomer->mobile));
                if (!empty($intCustomerPhoneId)) {
                    $objectTransaction->commit();
                } else {
                    $objectTransaction->rollback();
                }
                $arrResponse = array('type' => Yii::t('app', 'common.ctrl.success'), 'data' => array('customerId' => $intCustomerId, 'verifyToken' => $strVerificationCode, 'mobile' => $objCustomer->mobile, 'first_name' => $objCustomer->first_name, 'smsToken' => $strSMSToken), 'message' => Yii::t('app', 'customer.ctrl.regSuccess'), 'success' => Yii::t('app', 'common.ctrl.success'));
            } else {
                $arrResponse = array('type' => Yii::t('app', 'common.ctrl.fail'), 'data' => $objCustomer->errors, 'message' => Yii::t('app', 'customer.ctrl.regFail'), 'success' => Yii::t('app', 'common.ctrl.fail'));
            }
        } else {
            $arrResponse = array('type' => Yii::t('app', 'common.ctrl.fail'), 'data' => Yii::t('app', 'customer.ctrl.invalidCode'), 'message' => Yii::t('app', 'customer.ctrl.invalidAccess'), 'success' => Yii::t('app', 'common.ctrl.fail'));
        }
        $this->renderJSON($arrResponse);
    }

    /**
     * @author Ctel
     * @param array $arrCustomer
     * @param integer $intCustomerId
     * @return integer It will return last inserted customer email id
     */
    public function createEmail($arrCustomer, $intCustomerId) {
        $intCustomerEmailId = CustomerEmail::model()->create($arrCustomer, $intCustomerId);
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
        $intCustomerPhoneId = CustomerPhone::model()->create($arrCustomer, $intCustomerId);
        return $intCustomerPhoneId;
    }

    /**
     * @author Ctel
     * @param array $arrCustomerInput
     * @return integer It will return last inserted customer id
     */
    public function createCustomer($arrCustomerInput) {
        $intCustomerId = 0;
        if (isset($arrCustomerInput['password'])) {
            $arrCustomerInput['password'] = CommonFunctions::generatePassword($arrCustomerInput['password']);
        }
        $intCustomerId = Customer::model()->create($arrCustomerInput);
        return $intCustomerId;
    }

    /**
     * @author Ctel
     * @param integer $intCustomerId
     * @return string It will return verfication code
     */
    public function createVerificationCode($intCustomerId) {
        $objectDataManager = new DataManager();
        $arrVerfication = $objectDataManager->getVerificationCode();
        $intUpdate = Customer::model()->updateCustomer($arrVerfication, $intCustomerId);
        return $arrVerfication['verify_token'];
    }

    /**
     * @author Ctel
     * @return string It will succes or fail response
     */
    public function actionSendToken($arrCustomer) {
        $strSMSToken = NULL;
        $arrSmsData = Yii::app()->params['sms'];
        $objDataManager = new DataManager();
        $arrCustomer['message'] = $objDataManager->getOTPTemplate($arrCustomer['otp']);
        $arrSmsData = array_merge($arrSmsData, $arrCustomer);
        $objectSMSManager = new SMSManager($arrSmsData);
        $strSMSToken = $objectSMSManager->fireSMS();
        return $strSMSToken;
    }

    public function actionSignIN() {
        if (Yii::app()->request->isPostRequest) {
            $objLogin = new SignINForm();
            $objLogin->attributes = $_POST;
            if ($objLogin->validate()) {
                $arrCustomer = Customer::model()->getCustomer($objLogin->username);
                if (!empty($arrCustomer) && isset($arrCustomer['status']) && 1 == $arrCustomer['status']) {
                    $objDataManager = new DataManager();
                    $intIsValidated = $objDataManager->validateCredentials($arrCustomer['password'], $objLogin->password);
                    if (1 == $intIsValidated) {
                        $this->actionSetSession($arrCustomer);
                        $arrResponse = array('type' => Yii::t('app', 'common.ctrl.success'), 'data' => 1, 'message' => 1, 'success' => Yii::t('app', 'common.ctrl.success'));
                    } else {
                        $arrResponse = array('type' => Yii::t('app', 'common.ctrl.fail'), 'data' => Yii::t('app', 'common.ctrl.inCorrect', array('{alias}' => "Password")), 'message' => Yii::t('app', 'customer.ctrl.forgot', array('{alias}' => '<a href="">Forgot Password</a>')), 'success' => Yii::t('app', 'common.ctrl.fail'));
                    }
                } else {
                    $arrResponse = array('type' => Yii::t('app', 'common.ctrl.fail'), 'data' => Yii::t('app', 'common.ctrl.notExist', array('{alias}' => $objLogin->username)), 'message' => Yii::t('app', 'customer.ctrl.registerWithUs', array('{alias}' => 'SignUp')), 'success' => Yii::t('app', 'common.ctrl.fail'));
                }
            } else {
                $arrResponse = array('type' => Yii::t('app', 'common.ctrl.fail'), 'data' => $objLogin->errors, 'message' => Yii::t('app', 'customer.ctrl.invalidDetails'), 'success' => Yii::t('app', 'common.ctrl.fail'));
            }
        } else {
            $arrResponse = array('type' => Yii::t('app', 'common.ctrl.fail'), 'data' => Yii::t('app', 'customer.ctrl.invalidCode'), 'message' => Yii::t('app', 'customer.ctrl.invalidAccess'), 'success' => Yii::t('app', 'common.ctrl.fail'));
        }
        $this->renderJSON($arrResponse);
    }

    /**
     * @author Ctel
     * @param array $arrData
     * @return boolean It will return a boolean response
     */
    public function actionSetSession($arrData) {
        $objSession = Yii::app()->session;
        $objSession['customerID'] = $arrData['id'];
        $objSession['customerName'] = $arrData['first_name'];
        return TRUE;
    }

    /**
     * @author Ctel
     * @ignore It will return home page on session destroy
     */
    public function actionSignOUT() {
        Yii::app()->session->clear();
        Yii::app()->session->destroy();
        $this->redirect($this->createUrl('mPSVEHICLES_DETAILS/AddVehicle'));
    }

    /**
     * @author Ctel
     * @return string It will validate otp and will activate the customer
     */
    public function actionVerifyToken() {
        if (Yii::app()->request->isPostRequest) {
            $objVerifcation = new VerificationForm();
            $objVerifcation->attributes = $_POST;
            if ($objVerifcation->validate()) {
                $objectTransaction = Yii::app()->db->beginTransaction();
                $intUpdate = Customer::model()->updateCustomer(array('status' => 1, 'sms_token' => $objVerifcation->smsToken), $objVerifcation->customerId);
                if (!empty($intUpdate)) {
                    $this->actionSetSession(array('id' => $objVerifcation->customerId, 'first_name' => $objVerifcation->first_name));
                    $objectTransaction->commit();
                } else {
                    $objectTransaction->rollback();
                }
                $arrResponse = array('type' => Yii::t('app', 'common.ctrl.success'), 'data' => $intUpdate, 'message' => Yii::t('app', 'customer.ctrl.verSuccess'), 'success' => Yii::t('app', 'common.ctrl.success'));
            } else {
                $arrResponse = array('type' => Yii::t('app', 'common.ctrl.fail'), 'data' => $objVerifcation->errors, 'message' => Yii::t('app', 'customer.ctrl.verFail'), 'success' => Yii::t('app', 'common.ctrl.fail'));
            }
        } else {
            $arrResponse = array('type' => Yii::t('app', 'common.ctrl.fail'), 'data' => Yii::t('app', 'customer.ctrl.invalidCode'), 'message' => Yii::t('app', 'customer.ctrl.invalidAccess'), 'success' => Yii::t('app', 'common.ctrl.fail'));
        }
        $this->renderJSON($arrResponse);
    }

    public function actionTest() {
        $session = Yii::app()->session;
        echo $session['customerID'] . "Username : " . $session['customerName'];
        die();
    }

    /**
     * @author Ctel
     * @return string It will return the resend code details
     */
    public function actionResendToken() {
        if (Yii::app()->request->isPostRequest) {
            $arrResendInputs = $_POST;
            $strVerificationCode = $this->createVerificationCode($arrResendInputs['customerId']);
            $strSMSToken = $this->actionSendToken(array('mobile' => $arrResendInputs['mobile'], 'otp' => $strVerificationCode));
            $arrResponse = array('type' => Yii::t('app', 'common.ctrl.success'), 'data' => array('smsToken' => $strSMSToken, 'verifyToken' => $strVerificationCode), 'message' => Yii::t('app', 'customer.ctrl.resend'), 'success' => Yii::t('app', 'common.ctrl.success'));
        } else {
            $arrResponse = array('type' => Yii::t('app', 'common.ctrl.fail'), 'data' => Yii::t('app', 'customer.ctrl.invalidCode'), 'message' => Yii::t('app', 'customer.ctrl.invalidAccess'), 'success' => Yii::t('app', 'common.ctrl.fail'));
        }
        $this->renderJSON($arrResponse);
    }

}
