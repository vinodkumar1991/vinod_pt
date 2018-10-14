<?php
/**
 * This class handles the login check for the application.
 * Provides different service methods for performing transactions in relation with
 * athentication.
 * @author ctel.
 * @package components
 * @since 1.0
 */
class RequireLogin extends CBehavior
{

	public function attach($owner)
	{
		$owner->attachEventHandler('onBeginRequest', array($this, 'handleBeginRequest'));
	}


	public function handleBeginRequest($event)
	{
		$app = Yii::app();
		$user = $app->user;
                                                $handreq = array();
                                                
		$request = trim($app->urlManager->parseUrl($app->request), '/');
                                                $login = trim($user->loginUrl[0], '/');
		
		//allow following action(s) as public
		/*
		*****
		START
		*****
		*/
		
		$handreq1='HIREAMECHANIC/HireMechanicDetail';
		$handreq2 = 'Mpsbookservice/Gethomescreenimages';//bookservice_ctrl
		$handreq3 = 'Mpsbookservice/getcarLogos';//bookservice_ctrl
		$handreq4 = 'Mpsbookservice/getcarImages';//bookservice_ctrl
		
		
		$handreq6 = 'Mpsbookservice/AddVehiclesInfo';//bookservice_ctrl
		$handreq7 = 'Mpsbookservice/Getbackgroundscreenimages';//bookservice_ctrl
		$handreq8 = 'MPSSELFDRIVEAGENCY/SelfDriveDetails';
		
		$handreq9 = 'Mpsbookservice/VehicleModifyDetails';//modify_ctrl
	
		$handreq11 = 'Mpsbookservice/AddVehiclesAddedLists';//bookservice_ctrl
		$handreq12 = 'Mpsbookservice/vehicleServicesList';//bookservice_ctrl
		$handreq13 = 'Mpsbookservice/VehicleRepairLists';//bookservice_ctrl
		$handreq14 = 'Mpsbookservice/CustomerRegistration';//bookservice_ctrl/n/a
		$handreq15 = 'MPSSELFDRIVEAGENCY/SelfdriveserviceDetails';
		$handreq16 = 'Mpsbookservice/Checklogin';//bookservice_ctrl
		
		$handreq18 = 'HIREAMECHANIC/SearchMechanicsBylocations';
		$handreq19 = 'Mpsbookservice/ExlusiveServiceInfo';//bookservice_ctrl
		//$handreq20 = 'Mpsbookservice/OTPloginUser';//bookservice_ctrl//n/a
		$handreq21 = 'Mpsbookservice/FetchBookingDetails';//bookservice_ctrl
		$handreq22 = 'VehicleGuide/VehicleGuideService';
		$handreq23 = 'Modificationshop/ModificationService';
		$handreq24 = 'site/getBookingDetails';//n/a
		$handreq25 = 'Mpsbookservice/UpdateUserStatus';//bookservice_ctrl
		$handreq26 = 'Mpsbookservice/FetchUserTrackingStatus';//bookservice_ctrl
		$handreq27 = 'site/MechanicShopLogin';
		$handreq28 = 'HIREAMECHANIC/HireMechanicDetailsByLocation';
		$handreq29 = 'Mpsbookservice/saveInput';
		$handreq30 = 'MPSSELFDRIVEAGENCY/SelfdriveFilters';
		$handreq31 = 'Mpsbookservice/Login';//bookservice_ctrl
		
		
		$allowed = array($login,$handreq1,$handreq2,$handreq3,$handreq4,$handreq6,$handreq7,$handreq8,$handreq9,$handreq11,$handreq12,$handreq13,$handreq14,$handreq15,$handreq16,$handreq18,$handreq19,$handreq21,$handreq22,$handreq23,$handreq24,$handreq25,$handreq26,$handreq27,$handreq28,$handreq29,$handreq30,$handreq31);
		
		
		
		
		/* $allowed = array($login,
		,$handreq2,$handreq3,$handreq4,$handreq6,$handreq7,$handreq8,$handreq9,$handreq10,$handreq11,$handreq12,$handreq13,$handreq14,$handreq15,$handreq16,$handreq17,$handreq18,$handreq19,$handreq21,$handreq22,$handreq23,$handreq24,$handreq25,$handreq26,$handreq27,$handreq28); */
		/*
		***
		END
		***
		*/
		
		
		
		
		$handreq[] =$login= trim($user->loginUrl[0], '/');
		
		// Restrict guests to public pages.
		if ($user->isGuest && !in_array($request, $allowed))
		$user->loginRequired();

		// Prevent logged in users from viewing the login page.
		$request = substr($request, 0, strlen($login));
		if (!$user->isGuest && $request == $login)
		{
		        $url = Yii::app()->baseUrl;
			//$url =  $app->createUrl($app->request->baseUrl);
			$app->request->redirect($url);
		}
		 
	}

}
?>
