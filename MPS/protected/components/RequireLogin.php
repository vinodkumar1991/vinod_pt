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
		$handreq4 = 'Mpsbookservice/GetVehicleModels';//bookservice_ctrl
		
		
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
		$handreq27 = 'Mpsbookservice/MechanicShopLogin';
		$handreq28 = 'HIREAMECHANIC/HireMechanicDetailsByLocation';
		$handreq29 = 'Mpsbookservice/SaveInput';
		
		$handreq30 = 'MPSSELFDRIVEAGENCY/SelfdriveFilters';
		$handreq31 = 'Mpsbookservice/Login';//bookservice_ctrl
		$handreq32 = 'Mpsbookservice/FetchPeriodicService';//bookservice_ctrl
		$handreq33 = 'Mpsbookservice/UserBookingDetails';
		$handreq34 = 'Mpsbookservice/FetchEachVehicleDetails';
		$handreq35 = 'Mpsbookservice/Test';
		$handreq36 = 'Mpsbookservice/FinalBooking';
		$handreq37 = 'Mpsbookservice/BikeRepairlists';
		$handreq38 = 'HIREAMECHANIC/hirebook';
		$handreq39 = 'MPSSELFDRIVEAGENCY/SelfdrivemobileBook';
		$handreq40 = 'Mpsbookservice/MechanicTransUserInfo';
		$handreq41 = 'Mpsbookservice/FetchDeliveryBoys';
		$handreq42 = 'Mpsbookservice/UpdateCurrentLocation';
		//$handreq43 = 'Mpsbookservice/DeliveryBoyAssignDetails';
		$handreq43 = 'Mpsbookservice/UpdateAssignDeliveryBoyStatus';
		$handreq44 = 'Mpsbookservice/DeliveryBoyAssignDetails';
		$handreq45 = 'Mpsbookservice/FetchPickBoyStatusDetails';
		$handreq46 = 'Mpsbookservice/FetchCustomerDetailsForMechanics';
		$handreq47 = 'Mpsbookservice/UpdateDeliveryBoyStatus';
		$handreq48 = 'Mpsbookservice/CustomerDetailsForPickupBoy';
		$handreq49 = 'Mpsbookservice/DelBoyVehicleCollectedStatus';
		$handreq50 = 'Mpsbookservice/StartServicingStatus';
		
		$handreq51 = 'Mpsbookservice/FetchCustomerServiceDetails';
		$handreq52 = 'Mpsbookservice/FetchMechanicService';
		$handreq53 = 'Mpsbookservice/FetchCustomerTimeDetails';
		$handreq54 = 'Mpsbookservice/UpdateDropPickBoyStatus';
		$handreq55 = 'Mpsbookservice/FetchDropPickBoyDetails';
		$handreq56 = 'Mpsbookservice/UpdateMechanicCompletedStatus';
		$handreq57 = 'Mpsbookservice/FetchServiceCompletedStatus';
		$handreq58 = 'Mpsbookservice/FetchDeliveruBoyServicetimeDetails';
                $handreq59 = 'Mobile/Customer/testWeb';
		
		
	
		//$handreq53 = 'Mpsbookservice/FetchCustomerTimeDetails';
		
		
		
		
	
		
		
		
		
		
		
		
		
		
		
		$allowed = array($login,$handreq1,$handreq2,$handreq3,$handreq4,$handreq6,$handreq7,$handreq8,$handreq9,$handreq11,$handreq12,$handreq13,$handreq14,$handreq15,$handreq16,$handreq18,$handreq19,$handreq21,$handreq22,$handreq23,$handreq24,$handreq25,$handreq26,$handreq27,$handreq28,$handreq29,$handreq30,$handreq31,$handreq32,$handreq33,$handreq34,
		$handreq35,$handreq36,$handreq37,$handreq38,$handreq39,$handreq40,$handreq41,$handreq42,$handreq43,$handreq44,$handreq45,$handreq46,$handreq47,$handreq48,$handreq49,$handreq50,$handreq51,$handreq52,$handreq53,$handreq54,$handreq55,$handreq56,$handreq57,$handreq58,$handreq59);
		
		
		
		
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
