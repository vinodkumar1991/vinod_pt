<?php
class MPSCustome_Webservice extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	

			public function actionIndex()
			{
				
			}
			public function actionRegisterCustlogin()
			{
			
			$Usernmame=$_POST['regemail'];
			$upwd=$_POST['upwd'];
			$mobNo=$_POST['mobNo'];
			$uname=$_POST['uname'];
			
			$MPSCUSTOMERINFO=new MPSCUSTOMERINFO();	
			$MPSCUSTOMERINFO->username=$uname;
			$MPSCUSTOMERINFO->emailid=$Usernmame; 
			$MPSCUSTOMERINFO->mobile_no=$mobNo; 
			$MPSCUSTOMERINFO->save();
			if($MPSCUSTOMERINFO->save())
			{
				$lastid=$MPSCUSTOMERINFO->id;
				Yii::app()->session['lastid']=$lastid;
			}  
			$MPSCUSTOMER=new MPSCUSTOMERACCINFO();	
			$MPSCUSTOMER->username=$Usernmame;
			$MPSCUSTOMER->password=$upwd;
			$MPSCUSTOMER->save(); 
			Yii::app()->session['username'] = $uname;
			echo '1';
				}
			public function actionSelfdriveserviceDetails()
				{
					  $fromdate = $_GET['from_date'];
					  $todate = $_GET['to_date'];
					
					  $d=strtotime("$fromdate");
					  $t=strtotime("$todate");
		 

	
		$getdataself=Yii::app()->db->createCommand("SELECT sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`,mvm.makes_name, mvmm.models_name,
		sfd.`model_id`, sfd.`seating_capacity`,sfd.`price_per_hour`,sfd.`price`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`from_date`,
		sfd.`to_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd,MPS_VEHICLE_MAKES as mvm,MPS_VEHICLE_MODELS as mvmm where sfd.makes_id=mvm.makes_id and sfd.model_id=mvmm.models_id and sfd.from_date <='$d' and sfd.to_date>='$t'")->queryAll();
		
		/* print_r($getdataself);
		exit; */
		 foreach($getdataself as $key=>$value)
			{
				
				$data['VehicleServiceDetails'][]=$value;
			
				
			}
		
	}
			
	 }
	
