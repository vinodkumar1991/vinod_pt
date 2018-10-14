<?php

class LoginController extends Controller {

    public function actionSignIN() {
        $arrErrors = array();
        $objLoginForm = $strError = NULL;
        if (isset($_POST['btn_login'])) {
            $objLoginForm = new LogINForm();
            $objLoginForm->attributes = $_POST;
            if ($objLoginForm->validate()) {
                $arrInputs = $objLoginForm->attributes;
                $strNewPassword = CommonFunctions::generatePassword($arrInputs['password']);
                $arrUser = Users::IsUserAccountExist($arrInputs['username'], $strNewPassword);
                if (!empty($arrUser)) {
                    if (isset($arrUser['status']) && 1 == $arrUser['status']) {
                        $intRole = $arrUser['role_id'];
                        switch ($intRole) {
                            case 1: //Mechanic
                                $this->actionMechanic($arrUser);
                                break;
                            case 2: //Agent
                                $this->actionSelfDrive($arrUser);
                                break;
                            case 5: //Delivery Boy (Runner)
                                $this->actionDeliveryBoy($arrUser);
                                break;
                            default:
                                $this->actionSuperAdmin($arrUser);
                        }
                    } else {
                        $strError = 'Account is deactivated.';
                    }
                } else {
                    $strError = 'Invalid Username Or Password Is Given';
                }
            } else {
                $arrErrors = $objLoginForm->errors;
            }
        }
        $this->render('/User/Login', array('errors' => $arrErrors, 'loginForm' => $objLoginForm));
    }

    public function actionMechanic($arrUser) {
        
    }

    public function actionSelfDrive($arrUser) {
        $this->actionSetSession($arrUser);
        $strRedirect = Yii::app()->params['webURL'] . '/SelfDrive/Agent/AgentVehicle';
        $this->redirect($strRedirect);
    }

    public function actionHireMechanic() {
        
    }

    public function actionModification() {
        
    }

    public function actionDeliveryBoy($arrUser) {
        $strRedirect = Yii::app()->params['webURL'] . '/';
    }

    public function actionSuperAdmin($arrUser) {
        $this->actionSetSession($arrUser);
        $strRedirect = Yii::app()->params['webURL'] . '/User/User/Mechanic';
        $this->redirect($strRedirect);
    }

    private function actionSetSession($arrData) {
        $objSession = Yii::app()->session;
        $objSession['user_id'] = $arrData['id'];
        $objSession['role_id'] = $arrData['role_id'];
        $objSession['username'] = $arrData['username'];
        $objSession['fullname'] = $arrData['first_name'];
        return $objSession;
    }

    public function actionSignOUT() {
        Yii::app()->session->clear();
        Yii::app()->session->destroy();
        $strRedirectURL = Yii::app()->params['webURL'] . 'User/Login/SignIN';
        $this->redirect($strRedirectURL);
    }

}
