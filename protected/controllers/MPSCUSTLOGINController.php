<?php

class MPSCUSTLOGINController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionCustLogin()
	{
		$this->render('MPSCUSTLOGIN');
	}
	public function actionDashboard()
	{
		
		if ($session->isActive)
		{
		//unset(Yii::app()->session['username']);
		$session->close();
		$this->actionAddVehicle();
		}
		
	}
	public function actionAddVehicle()
	{   
		//$vmake = MPSVEHICLEMAKES::model()->findAll();
		
 // Pri
 
		//$this->render('MPSVEHICLES_DETAILS');
		 //unset(Yii::app()->session['username']);
		 $vmake=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MAKES.makes_id,MPS_VEHICLE_MAKES.makes_name,MPS_VEHICLES.logo_img
							FROM MPS_VEHICLES right JOIN MPS_VEHICLE_MAKES ON MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id
							group by  MPS_VEHICLE_MAKES.makes_name")->queryAll();
							
							$this->render('MPSaddVehicle',array('vmakelist'=>$vmake));
		
	}
	public function actionBookingsevicedetails()
	{
		
		if(!isset( $_POST['picdate'],$_POST['adrs'],$_POST['Usernmame']))
		{
			Yii::app()->session['picdate'] = $_POST['picdate'];
		Yii::app()->session['adrs'] =$_POST['adrs'];
		Yii::app()->session['Usernmame'] = $_POST['Usernmame'];
		Yii::app()->session['emailId'] = $_POST['emailId'];
		Yii::app()->session['uname'] = $_POST['uname'];
		Yii::app()->session['mobNo'] = $_POST['mobNo'];
		}
		
	
		$variant='car';
	
		$picdate=$_POST['picdate'];
		$adrs=$_POST['adrs'];
		/* if(!empty(Yii::app()->session['username'])
		{ */
		$model_id=$_POST['model_id'];
		$makes_id=$_POST['makes_id'];
		$addinfo=$_POST['addinfo'];
		$servnm=$_POST['servnm'];
		
		
		
		
		
		$uname=$_POST['uname'];
		$emailId=$_POST['emailId'];
		$mobNo=$_POST['mobNo'];
		
		// $location=$_POST['location']; 
		// $datas=explode(',',$location);
		// $longitude=$datas[0]; 
		// $latitude=$datas[1]; 
		
		
		$Usernmame=$_POST['Usernmame'];
		$upwd=$_POST['upwd'];
		
		//$vefinfo=$_POST['vefinfo'];
		$regcert= Yii::app()->request->baseUrl;
		$url=$_SERVER['DOCUMENT_ROOT']."$regcert/custvedfile/";
		$uploadfile = $url .basename($_FILES['vefinfo']['tmp_name']);
		move_uploaded_file($_FILES['vefinfo']['tmp_name'], $uploadfile);
		
		
		
		$MPSCUSTOMERINFO=new MPSCUSTOMERINFO();	
		$MPSCUSTOMERINFO->username=$uname;
		
		$MPSCUSTOMERINFO->emailid=$emailId;
		$MPSCUSTOMERINFO->mobile_no=$mobNo;
		$MPSCUSTOMERINFO->location=$adrs; 
		$MPSCUSTOMERINFO->longitude='464.336'; 
		$MPSCUSTOMERINFO->latitude='464.43636'; 
		$MPSCUSTOMERINFO->save();
		
		
	    $MPSCUSTOMER=new MPSCUSTOMERACCINFO();	
		$MPSCUSTOMER->username=$Usernmame;
		$MPSCUSTOMER->password=$upwd;
		Yii::app()->session['username']=$Usernmame;
		if($MPSCUSTOMER->save())
		{
			$lastid=$MPSCUSTOMER->id;
			Yii::app()->session['lastid']=$lastid;
		}
		
		$model=new MPSCUSTSERVICEDETAILS();
		$model->custid=$lastid;		
		$model->modelid=$model_id;
		$model->makesid=$makes_id;
		$model->pickadrs=$adrs;
		$model->pickdate=$picdate;
		$model->variant=$variant;
		$model->addinfo=$addinfo;
		$model->vediofile=basename($_FILES['vefinfo']['tmp_name']);
		$model->seviceid=$servnm;
		$model->save(); 
		
		
		
		$getcarImages=Yii::app()->db->createCommand("SELECT 
		`car_img` FROM `MPS_VEHICLES` WHERE makes_id=$makes_id and models_id=$model_id")->queryAll();
	    foreach($getcarImages as $carimgg)
		{
			$carimg=$carimgg['car_img'];
		}
		//fetch makes name and model name
		$getcarnames=Yii::app()->db->createCommand("SELECT distinct MPS_VEHICLE_MODELS.`models_name`,MPS_VEHICLE_MAKES.makes_name FROM `MPS_VEHICLE_MODELS`,MPS_VEHICLE_MAKES WHERE MPS_VEHICLE_MODELS.makes_id=MPS_VEHICLE_MAKES.makes_id and MPS_VEHICLE_MAKES.makes_id=$makes_id and MPS_VEHICLE_MODELS.models_id=$model_id")->queryAll();
	    foreach($getcarnames as $getcarname)
		{
			$getcarnmodel=$getcarname['models_name'];
			$getcarmake=$getcarname['makes_name'];
		}
		
		
		Yii::app()->session['makes_id'] = $makes_id;
		Yii::app()->session['model_id'] = $model_id;
		Yii::app()->session['getcarnmodel'] = $getcarnmodel;
		Yii::app()->session['getcarmake'] = $getcarmake;
		if(!empty($carimg))
		{
		Yii::app()->session['car_img'] = $carimg;
		
		$carimgg=$carimg;
		}
		else{
			Yii::app()->session['car_img'] = '/images/uploadimages/models/car/php2C3E.tmp';
			$carimgg='/images/uploadimages/models/car/php2C3E.tmp';
		}
		$modeladddel=new MPSVEHADDEDDETAILS();	
		$modeladddel->makes_id=$model_id;
	    $modeladddel->model_id=$makes_id;
		$modeladddel->imgpath="$carimgg";
		$modeladddel->models_name="$getcarnmodel";
		$modeladddel->makes_name="$getcarmake";
		$modeladddel->user_id=Yii::app()->session['lastid'];
		$modeladddel->save();  
		$userid=Yii::app()->session['lastid'];
		
	    $carimges=Yii::app()->db->createCommand("SELECT distinct MPSVEHADDED_DETAILS.makes_name,MPSVEHADDED_DETAILS.models_name,MPSVEHADDED_DETAILS.`imgpath`
		FROM MPSVEHADDED_DETAILS
		left JOIN MPS_VEHICLES
		ON MPS_VEHICLES.makes_id=MPSVEHADDED_DETAILS.makes_id and MPS_VEHICLES.models_id=MPSVEHADDED_DETAILS.model_id and MPSVEHADDED_DETAILS.user_id=$userid")->queryAll();
		
		
		
		$this->render('MPSVehiclelists',array('carimges'=>$carimges,"message"=>"Vehicle added successfully"));
	}
	public function actionloginuser()
	{
		
		
		
		if(!isset($_POST['uname']))
		{
			$this->render('../mPSVEHICLES_DETAILS/AddVehicle');
		}
		else
		{
			$uname=$_POST['uname'];
		}
		$password=$_POST['password'];
		Yii::app()->session['username']=$uname;
		
		$getpassword=Yii::app()->db->createCommand("SELECT `id`, `username`, `password`, `status` FROM `MPS_CUSTOMERACC_INFO` 
		WHERE username='$uname' and password='$password'")->queryAll();
		 foreach($getpassword as $getpwd)
		{
			$userid=$getpwd['id'];
		} 
		Yii::app()->session['lastid']=$userid;
		if(count($getpassword)>0)
		{
			
			
			
			 $vmake=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MAKES.makes_id,MPS_VEHICLE_MAKES.makes_name,MPS_VEHICLES.logo_img
							FROM MPS_VEHICLES right JOIN MPS_VEHICLE_MAKES ON MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id
							group by  MPS_VEHICLE_MAKES.makes_name")->queryAll();
							
							$this->render('../mPSVEHICLES_DETAILS/MPSaddVehicle',array('vmakelist'=>$vmake,"uname"=>$uname)); 
							
			/*  $carimges=Yii::app()->db->createCommand("SELECT distinct MPSVEHADDED_DETAILS.makes_name,MPSVEHADDED_DETAILS.models_name,MPSVEHADDED_DETAILS.`imgpath`
			FROM MPSVEHADDED_DETAILS
			left JOIN MPS_VEHICLES
			ON MPS_VEHICLES.makes_id=MPSVEHADDED_DETAILS.makes_id and MPS_VEHICLES.models_id=MPSVEHADDED_DETAILS.model_id")->queryAll(); 
			$this->render('../mPSVEHICLES_DETAILS/MPSVehiclelists',array('carimges'=>$carimges)); */
			//$this->render('../mPSVEHICLES_DETAILS/AddVehicle');
			
		}
		else
		{
			$this->render('MPSCUSTLOGIN',array('message'=>'Invalid data'));
		}
	    
	}
	public function actionBooking()
	{   
		
		  //$lastid=Yii::app()->session['userid'];
		  $lastid=Yii::app()->session['lastid'];
	
		if(!empty(Yii::app()->session['username']))
		{
			 $vmodel=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MODELS.models_id, MPSVEHADDED_DETAILS.imgpath,MPS_VEHICLE_MODELS.models_name 
							FROM MPS_VEHICLE_MODELS,MPSVEHADDED_DETAILS
							where MPS_VEHICLE_MODELS.models_id=MPSVEHADDED_DETAILS.model_id and MPSVEHADDED_DETAILS.user_id=$lastid")->queryAll();
							$getservices=Yii::app()->db->createCommand("SELECT `id`, `servicenames` FROM `MPS_SERVICES_DETAILS`")->queryAll();
							$this->render('bookAService',array("getservices"=>$getservices,"vmodel"=>$vmodel));
		}
		else{
					$vmake=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MAKES.makes_id,MPS_VEHICLE_MAKES.makes_name,MPS_VEHICLES.logo_img
							FROM MPS_VEHICLES right JOIN MPS_VEHICLE_MAKES ON MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id
							group by  MPS_VEHICLE_MAKES.makes_name")->queryAll();
					$getservices=Yii::app()->db->createCommand("SELECT `id`, `servicenames` FROM `MPS_SERVICES_DETAILS`")->queryAll();
					$this->render('bookAService',array("getservices"=>$getservices,"vmakelist"=>$vmake));
		}
		
		//$this->redirect('bookAService');
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}