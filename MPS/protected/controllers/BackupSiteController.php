
<?php
class SiteController extends Controller
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
	


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	
	
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('addSelfVehicle');
	}
	public function actionSelfdriveserviceDetails()
	{
		   $fromdate = $_GET['from_date'];
		  $todate = $_GET['to_date'];
		
		  $d=strtotime($fromdate);
		
		
		  $t=strtotime($todate); 
		  //and sfd.from_date ='$d'
		

/* echo "SELECT sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`,mvm.makes_name, mvmm.models_name,
		sfd.`model_id`, sfd.`seating_capacity`,sfd.`price_per_hour`,sfd.`price`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`from_date`,
		sfd.`to_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd,MPS_VEHICLE_MAKES as mvm,MPS_VEHICLE_MODELS as mvmm where sfd.makes_id=mvm.makes_id and sfd.model_id=mvmm.models_id and sfd.from_date <='$d' and sfd.to_date>='$t'";
		exit; */
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];      
			$getdataself=Yii::app()->db->createCommand("SELECT imagespath from SLD_ADD_VEHICLE where id='$id' ")->queryAll();
		
			echo json_encode(unserialize($getdataself[0]['imagespath']));  
		}
		else
		{ 
		$getdataself=Yii::app()->db->createCommand("SELECT 
sfd.imagespath,sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`,mvm.makes_name, mvmm.models_name,
		sfd.`model_id`, sfd.`seating_capacity`,sfd.`price_per_hour`,sfd.`price`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`from_date`,
		sfd.`to_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd,MPS_VEHICLE_MAKES as mvm,MPS_VEHICLE_MODELS as mvmm where sfd.makes_id=mvm.makes_id and sfd.model_id=mvmm.models_id and sfd.vehicle_type='car'")->queryAll();
		
		/* print_r($getdataself);
		exit; */

		 foreach($getdataself as $key=>$value)
			{
			
				$data['SelfDriveCarsDetails'][]= array('imagespath'=>unserialize($value['imagespath']),
				'vehicle_id'=>$value['vehicle_id'],
				'id'=>$value['id'],
				'username'=>$value['username'],
				'vehicle_category'=>$value['vehicle_category'],
				'vehicle_type'=>$value['vehicle_type'],
				'makes_name'=>$value['makes_name'],
				'seating_capacity'=>$value['seating_capacity'],
				'price_per_hour'=>$value['price_per_hour'],
				'price'=>$value['price'],
				'extra_rate_per_kms'=>$value['extra_rate_per_kms'],
				'img_path'=>$value['img_path'],
				'total_kms'=>$value['total_kms'],
				'to_date'=>$value['to_date'],
				'vehicle_features'=>$value['vehicle_features'],
				'variant'=>$value['variant'],
				'model_id'=>$value['model_id'],
				'from_date'=>$value['from_date'],
				'created_date'=>$value['created_date'],
				'security_deposit'=>$value['security_deposit'],
				'makes_id'=>$value['makes_id'],
				'models_name'=>$value['models_name']
				
				);
			
				
				
								
			}
			
		echo json_encode($data);
		}
	}
	
	public function actionuserRegister()//select users
	{
		$getcountries=Yii::app()->db->createCommand("SELECT distinct MPS_COUNTRIES.name FROM `MPS_LOCATIONS`,MPS_COUNTRIES WHERE
		MPS_LOCATIONS.country_code=MPS_COUNTRIES.id")->queryAll();
		
		//$cities = Cities::model()->findAll();
	   // $this->render('userRegi',array('cities'=>$cities));
	   $this->render('userRegi',array("MPSCOUNTRIES"=>$getcountries));
		
	}
	public function actionuserSelfdrivedetails()//select users
	{
		$getcountries=Yii::app()->db->createCommand("SELECT distinct MPS_COUNTRIES.name FROM `MPS_LOCATIONS`,MPS_COUNTRIES WHERE
		MPS_LOCATIONS.country_code=MPS_COUNTRIES.id")->queryAll();
		
		//$cities = Cities::model()->findAll();
	   // $this->render('userRegi',array('cities'=>$cities));
	   $this->render('userRegi',array("MPSCOUNTRIES"=>$getcountries));
		
	}
	
	public function actionManagermechanicshop()//select users
	{
		
		 $rawData=Yii::app()->db->createCommand("SELECT `id`, `shop_nm`, `shop_id`, `contact_num`,`shopowner_nm`, `num_mechanic`, `address`, `city`,
		 `sector`, `contact_num`, `zipcode`, `owner_emailid`, `img_path`, `count_service`, `created_date` FROM `shop_details`")->queryAll();
// or using: $rawData=User::model()->findAll();
$dataProvider=new CArrayDataProvider($rawData, array(
   'keyField' => 'shop_nm',
    'sort'=>array(
        'attributes'=>array(
             'shop_nm','shop_id','shopowner_nm','address','contact_num','city','sector','zipcode','created_date'
        ),
    ),
    'pagination'=>array(
        'pageSize'=>2,
    ),
));
		
		$this->render('manageMechanicusers',array('dataProvider'=>$dataProvider));
		
	}
	
	public function actionsaveUser()
	{
		
		$shop_nm=$_POST['shop_nm'];
		$city=$_POST['city'];
		$shopid=$_POST['shopid'];
		$area=$_POST['area'];
		$ownername=$_POST['ownername'];
		$num_mec=$_POST['num_mech'];
		$address=$_POST['adrs'];
		$email=$_POST['email'];
		$zipcode=$_POST['zipcode'];
		$img_path=$_POST['imgpic'];
		$count_service=$_POST['count_service'];
		
		$contact_num=$_POST['cont'];
		
		$typeofservices=$_POST['typeofservices'];
		//shopowner_details
		
		$username=$_POST['username'];
		$password=sha1($_POST['password']);
		
		
		//shop details
		$model=new ShopDetails();	
		
		
		$model->shop_nm=$shop_nm;
		$model->city=$city;
		$model->shop_id=$shopid;
		$model->sector=$area;
		$model->shopowner_nm=$ownername;
		$model->num_mechanic=$num_mec;
		$model->address=$address;
		$model->owner_emailid=$email;
		$model->zipcode=$zipcode;
		$model->img_path=$img_path;
		$model->contact_num=$contact_num;
		
		
		$model->count_service=$count_service;
		
		$model->save();
		
		//SHOP OWNER DETAILS
		$models=new ShopownerDetails();	
		$models->shop_unique_id=$shopid;
		$models->username=$username;
		$models->password=$password;
		$models->save();
		
		//services details
		
		foreach($typeofservices as $typeserve)
		{
		$modelservice=new ShopServicesDetails();	
		$modelservice->shop_unique_id=$shopid;
		$modelservice->service_name=$typeserve;
		$modelservice->save();
		}
		//$this->actionSendEmail();
		
	}
	public function actionSendEmail()
	{
		            $transport = Swift_SmtpTransport::newInstance("smtp.gmail.com", 568,'ssl');
					$transport->setUsername("beenapaninaik1991@gmail.com");
					$transport->setPassword("@!@!beena");
					$mailer = Swift_Mailer::newInstance($transport);
					$emailBody='dhkfsjklfj';
					/* $message = Swift_Message::newInstance();
					$message->setTo(array(
					   "beenapaninaik1991@gmail.com" => "beena",
					  
					));
					
					
                    $mailer->send($message); 
					
					/* $mailer = Swift_Mailer::newInstance($transporter);
					$emailBody='dfhdfkjljklhk';*/
					$message = Swift_Message::newInstance()
							          ->setFrom(array('beena'=>'beenapaninaik1991@gmail.com'))
							          ->setTo(array("ani"=>"laughingstarbeena@gmail.com"))
								      ->setBody($emailBody,'text/html');
								echo $result = $mailer->send($message); 
	}
	
	
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
		public function actionLogin()
	{     
	     $model= new MPSUSER;  
	     if(!Yii::app()->user->isGuest)
             {
                       $this->redirect(array('login'));
                      

             }
                
                
		

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['MPSUSER']))
		{
		
			$model->attributes=$_POST['MPSUSER'];
			Yii::app()->session['username']=$_POST['MPSUSER'];
			// validate user input and redirect to the previous page if valid
			if($model->login())
			{
                //$url=$_SERVER["REQUEST_URI"]
				$this->redirect('dashboard');
			}
		}
		// display the login form
                
		$this->renderPartial('login',array('model'=>$model));
	}
	
	public function actionDashboard()
	{
		/*  if(isset(Yii::app()->session['username']))
		{  */
	    $country = MPSCOUNTRIES::model()->findAll();
	    // print_r($country);
	    // exit;   
            if(Yii::app()->user->getState('role')==4)
				{
					 $this->render('addSelfVehicle');
				}else{
	       $this->render('dashboard',array('countrylist'=>$country));
				}
		/* }
		else
		{
			$this->render('login');
		}  */
	}
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
				 Yii::app()->session->destroy();
                 Yii::app()->session->clear();
                 Yii::app()->user->logout();
				 $this->redirect(Yii::app()->homeUrl);
	}


	/**
	*Function to get the state list based on the country selection
	*/
	public function actionGetstate()
	{
		$country_id = $_POST['Country'];
		$Criteria = new CDbCriteria();
		$Criteria->condition = "country_id = $country_id";
		$statelist = MPSSTATES::model()->findAll($Criteria);
		$sid   = array();
		$sname = array();
		$html = "";
		$html.="<option value=''>Select State</option>";
		foreach($statelist as $state)
		{

			$html .="<option value='".$state['id']."'>".$state['name']."</option>";

		}

	echo $html;

	}
	public function actionGetstatedel()
	{
		$country_id = $_POST['Country'];
		$Criteria = new CDbCriteria();
		$Criteria->condition = "country_id = $country_id";
		$statelist = MPSSTATES::model()->findAll($Criteria);
		$sid   = array();
		$sname = array();
		$html = "";
		$html.="<option value=''>Select State</option>";
		foreach($statelist as $state)
		{

			$html .="<option value='".$state['id']."'>".$state['name']."</option>";

		}

	echo $html;

	}
	/**
	*Function to get the city list based on the state selection
	*/
	public function actionGetcity()
	{
		$state_id = $_POST['State'];
		
		$Criteria = new CDbCriteria();
		$Criteria->condition = "state_id = $state_id";
		$citylist = MPSCITIES::model()->findAll($Criteria);
		$cid   = array();
		$cname = array();
		$html = "";
		$html.="<option value=''>Select City</option>";
		foreach($citylist as $city)
		{

			$html .="<option value='".$city['id']."'>".$city['name']."</option>";

		}

	echo $html;

	
	}
	/**
	*Function to get the area list based on the city selection
	*/
	public function actionGetarea()
	{
		$city_id = $_POST['City'];
		
		$Criteria = new CDbCriteria();
		$Criteria->condition = "city_id = $city_id";
		$arealist = MPSAREAS::model()->findAll($Criteria);
		$aid   = array();
		$aname = array();
		$html = "";
		$html.="<option value=''>Select Area</option>";
		foreach($arealist as $area)
		{
			if($area['id']!='1')
			{
				$html .="<option value='".$area['id']."'>".$area['name']."</option>";
			}


		}
		$html .="<option value='1'>Others</option>";
		echo $html;

	
	}
	public function actionlocationslist()
	{
	  $arealist = MPSLOCATIONS::model()->findAll();
	  
	  $arearesult = array();	  
	  foreach($arealist as $arealist) 
	  {
	         
			try
			{
			        $column1 = 'COUNTRYID';
			        $column2 = 'COUNTRYNAME';
			        $column3 = 'STATEID';
			        $column4 = 'STATENAME';
			        $column5 = 'CITYID';
			        $column6 = 'CITYNAME';
			        $column7 = 'AREAID';
			        $column8 = 'AREANAME';
			        $table1 = 'MPS_COUNTRIES';
			        $table2 = 'MPS_STATES';
			        $table3 = 'MPS_CITIES';
			        $table4 = 'MPS_AREAS';
			
                                $sql = "
                                SELECT 
                                MPS1.ID AS ".$column1.", 
                                MPS1.NAME AS ".$column2.", 
                                MPS2.ID AS ".$column3.", 
                                MPS2.NAME AS ".$column4.", 
                                MPS3.ID AS ".$column5.", 
                                MPS3.NAME AS ".$column6.", 
                                MPS4.ID AS ".$column7.", 
                                MPS4.NAME AS ".$column8." 
                                FROM ".$table1." MPS1, 
                                ".$table2." MPS2, 
                                ".$table3." MPS3, 
                                ".$table4." MPS4 
                                WHERE 
                                MPS1.ID=:firstid 
                                AND MPS2.ID=:secondid 
                                AND MPS3.ID=:thirdid 
                                AND MPS4.ID=:fourthid";
				$command =Yii::app()->db->createCommand($sql);
    			        $command->bindValue(":firstid", $arealist['country_code'], PDO::PARAM_STR);
    			        $command->bindValue(":secondid", $arealist['state_code'], PDO::PARAM_STR);
    			        $command->bindValue(":thirdid", $arealist['city_code'], PDO::PARAM_STR);
    			        $command->bindValue(":fourthid", $arealist['area_code'], PDO::PARAM_STR);
    			        $execute =$command->queryRow();			
			}
			catch(CDbException $e)
    		        {
     			        $execute = array();
			}
	        
     
	        $arearesult[] = array('ID'=>$arealist['id'],'AREANAME'=>$execute['AREANAME'],'CITYNAME'=>$execute['CITYNAME'],'STATENAME'=>$execute['STATENAME'],'COUNTRYNAME'=>$execute['COUNTRYNAME'],'ZIPCODE'=>$arealist['zipcode'],'LOCATIONNAME'=>$arealist['location_name']);

	  }

	  $this->render('locationlist',array('arealist'=>$arearesult));
	}
	public function actionSave()
		{
		$country=$_POST['country'];
		$state=$_POST['state'];
		$city=$_POST['city'];
		$area=$_POST['area'];
		$areatext=$_POST['areatext'];
		$zmps=$_POST['zmps'];
		$model=new MPSLOCATIONS();	
		$model->country_code=$country;
		$model->state_code=$state;
		$model->city_code=$city;
		$model->area_code=$area;
		$model->zipcode=$zmps;
		$model->location_name=$areatext;
		$model->save();

	} 

	public function actionVehicle()
	{
		$vmake = MPSVEHICLEMAKES::model()->findAll();
		$this->render('vehicle',array('vmakelist'=>$vmake));
	} 
	public function actionGetvmodel()
	{
		$makes_id = $_POST['Maker'];
		$Criteria = new CDbCriteria();
		$Criteria->condition = "makes_id = $makes_id";
		$vmodellist = MPSVEHICLEMODELS::model()->findAll($Criteria);

		$vid   = array();
		$vname = array();
		$html = "";
		$html.="<option value=''>Select Vehicle Model</option>";
		foreach($vmodellist as $vmodel)
		{

			$html .="<option value='".$vmodel['models_id']."'>".$vmodel['models_name']."</option>";

		}
		echo $html;
	}
	public function actiondeleterec()
    {
        echo $id = $_POST['delval'];
        
        $whosloggedin=MPSLOCATIONS::model()->find('id=:id',array(':id'=>$id) ); 
        $status = $whosloggedin->delete();
        if($status)
        {
                echo "1-success";
        }
        else
        {
                echo "0-fail";
        }
              
    }
          
    public function actionedit()
    {
       
		echo $id = $_POST['editval'];
		$arealist = MPSLOCATIONS::model()->findByPk($id);
        print_r($arealist);
    }
	public function actioneditsave()
	{
	//echo"gftrgt";
	}  
	public function actionvsave()
	{
		$vmake=$_POST['vmake'];
		$vmodel=$_POST['vmodel'];
		$vyear=$_POST['valyear'];
		$category_id=$_POST['category_id'];
		$countcat=Yii::app()->db->createCommand("SELECT `id` from  MPS_VEHICLES WHERE  `category_id`=$category_id and `makes_id`=$vmake and `models_id`=$vmodel")->queryAll();
		
		 if(count($countcat)<1)
		{
			//echo 'if';
			$sql=Yii::app()->db->createCommand("UPDATE  MPS_VEHICLES SET `category_id`=$category_id  WHERE `makes_id`=$vmake and `models_id`=$vmodel ")->execute();
			$vmake = MPSVEHICLEMAKES::model()->findAll();
		
		$message='Inserted Successfully';
		$this->render('vehicle',array('message'=>$message,"vmakelist"=>$vmake));
			
		} 
		
		
		else{
			
			
		
		$Criteria = new CDbCriteria();
		$Criteria->condition = "makes_id = $vmake";
		$vmakest = MPSVEHICLEMAKES::model()->findAll($Criteria);
		foreach($vmakest as $vmod)
		{
			$makesname=$vmod['makes_name'];
		}
		
		$Criteria = new CDbCriteria();
		$Criteria->condition = "models_id = $vmodel";
		$vmodellist = MPSVEHICLEMODELS::model()->findAll($Criteria);
		foreach($vmodellist as $vmod)
		{
			$modelnm=$vmod['models_name'];
		}
		
		$makermnm=$makesname.$modelnm;
		
		
		
		$idproof= Yii::app()->request->baseUrl;
		$url2=$_SERVER['DOCUMENT_ROOT']."$idproof/images/uploadimages/models/car/";
		$uploadfile1 = $url2 .basename($_FILES['logofile']['tmp_name']);
		move_uploaded_file($_FILES['logofile']['tmp_name'], $uploadfile1);
		$logos=file_get_contents($uploadfile1);
	    $logoencrypted=base64_encode($logos);
		
		
		$idproof2= Yii::app()->request->baseUrl;
		$url3=$_SERVER['DOCUMENT_ROOT']."$idproof2/images/uploadimages/models/car/";
		$uploadfile3 = $url3 .basename($_FILES['carfile']['tmp_name']);
		move_uploaded_file($_FILES['carfile']['tmp_name'], $uploadfile3);
		$cars=file_get_contents($uploadfile3);
	    $carencrypted=base64_encode($cars);
		
		
		//$makermodelname = $makermnm;
		$model=new MPSVEHICLES();	
		$model->makes_id=$vmake;
		$model->models_id=$vmodel;
		$model->year=$vyear;
		$model->category_id=$category_id;
		$model->logo_img='/images/uploadimages/models/car/'.basename($_FILES['logofile']['tmp_name']);
		$model->car_img='/images/uploadimages/models/car/'.basename($_FILES['carfile']['tmp_name']);
		$model->models_id=$vmodel;
		$model->logo_data= $logoencrypted;
		$model->car_data=$carencrypted;
		$model->save();
		
		$vmake = MPSVEHICLEMAKES::model()->findAll();
		
		$message='Inserted Successfully';
		$this->render('vehicle',array('message'=>$message,"vmakelist"=>$vmake));
		}
    } 
	
	
	
	public function actiongetcarLogosdup()
	{
		
		
		$logosDetails=Yii::app()->db->createCommand("SELECT  distinct MPS_VEHICLES.logo_data, MPS_VEHICLE_MAKES.makes_name,
		MPS_VEHICLES.makes_id FROM `MPS_VEHICLE_MAKES`,MPS_VEHICLES where MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id")->queryAll();
		$keys = array('Brands_Data');
		/* foreach($logosDetailsdatas as $logosDetailsdata)
		{
			//$val = array('logo_data','makes_name','makes_id');
			$logo_data[]=$logosDetail['logo_data'];
			$makes_name[]=$logosDetail['makes_name'];
			$makes_id[]=$logosDetail['makes_id'];
			
			
		}
		 */
		$i=0;
			//echo '<pre>';
		foreach($logosDetails as $logosDetail=>$logosDeta)
		{
			
			
			$a['Carimages'][$i] = array_fill_keys($keys,$logosDeta);
			
			$i++;
		}
		
	   
		print_r($a);
		exit;
		
		
		
	}
	
	public function actiongetcarLogos()
	{
		$logosDetails=Yii::app()->db->createCommand("SELECT  distinct MPS_VEHICLES.logo_data, MPS_VEHICLE_MAKES.makes_name,
		MPS_VEHICLES.makes_id FROM `MPS_VEHICLE_MAKES`,MPS_VEHICLES where MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id")->queryAll();
		
		
		$i=0;
		//echo '<pre>';
		foreach($logosDetails as $logosDetail=>$logosDeta)
		{
			
			
			$arrCarLogos['CarLogos'][] = $logosDeta;
			
			$i++;
		}
		if(empty($arrCarLogos))
		{
			echo 'No Data Available';
		}
		else{
			
		$endata=json_encode($arrCarLogos);
		print_r($endata);
		}
		exit;
		
		
		
	}
		public function actiongetcarImages()
	{
		
		$makes_id=$_GET['makes_id'];
		
		$carImageDetails=Yii::app()->db->createCommand("SELECT distinct MPS_VEHICLE_MODELS.models_id,MPS_VEHICLES.car_data as car_data,MPS_VEHICLE_MODELS.models_name,MPS_VEHICLE_MAKES.makes_name
                             FROM MPS_VEHICLES,MPS_VEHICLE_MODELS,MPS_VEHICLE_MAKES where MPS_VEHICLES.models_id=MPS_VEHICLE_MODELS.models_id 
							 and MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id and MPS_VEHICLES.makes_id=$makes_id")->queryAll();
		
		
		
		$i=0;
		//echo '<pre>';
		foreach($carImageDetails as $carImageDetail=>$carData)
		{
			
			
			$arrCarImages['CarImages'][] =$carData;
			
			$i++;
		}
		
		
		if(empty($arrCarImages))
		{
			echo 'No Data Available';
		}
		else{
		 $endata=json_encode($arrCarImages);
		print_r($endata);
		}
		
		
		exit;
		 
		
	}
	public function actionvehiclelist()
	{
		if(isset($_GET['id'])){
	$id=$_GET['id'];
	$vlist=Yii::app()->db->createCommand("SELECT * FROM `MPS_VEHICLES` where category_id=$id")->queryAll();
		}else
		{
			$vlist=Yii::app()->db->createCommand("SELECT * FROM `MPS_VEHICLES` where category_id=1")->queryAll();
		}
			
      
		
	/*	$vlist = MPSVEHICLES::model()->findAll(); */
		$vresult = array();	  
		foreach($vlist  as $vlist) 
	  	{
         	try
				{
			        $column1 = 'makes_id';
			        $column2 = 'makes_name';
			        $column3 = 'models_id';
			        $column4 = 'models_name';
			        $table1 = 'MPS_VEHICLE_MAKES';
			        $table2 = 'MPS_VEHICLE_MODELS';
			        
			
                    $sql = "
                    SELECT 
                    MPS1.makes_id, 
                    MPS1.makes_name, 
                    MPS2.models_id, 
                    MPS2.models_name
                   
                    FROM ".$table1." MPS1, 
                    ".$table2." MPS2
                   
                    WHERE 
                    MPS1.makes_id=:firstid 
                    AND MPS2.models_id=:secondid";
                    
				$command =Yii::app()->db->createCommand($sql);
    		    $command->bindValue(":firstid", $vlist['makes_id'], PDO::PARAM_STR);
    		    $command->bindValue(":secondid", $vlist['models_id'], PDO::PARAM_STR);
    			$res =$command->queryAll();			
			}
			catch(CDbException $e)
    		        {
     			        $res = array();
			}
	        
	        
     
	       $vresult[] = array('ID'=>$vlist['id'],'makename'=>$res[0]['makes_name'],'modelname'=>$res[0]['models_name'],'year'=>$vlist['year'],'logo'=>$vlist['logo_img']);

	  	}
	  //print_r($res);

	  $this->render('vehiclelist',array('vlist'=>$vresult));
	}   
	public function actionimages()
	{                                      
		$this->render('images');
	}
	public function actionManageRepairList()
	{
		$this->render('ManageRepairList');
	}
	public function actionimageupload()
	{	
	
    
		if(isset($_FILES['userfile']))
		{
		$imake=$_POST['imake'];
		
		$imodel=$_POST['imodel'];
        $var=basename($_FILES['userfile']['tmp_name']);
		$allowed =  array(
		'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png');
		$message = '';  
		echo $filesize = $_FILES['userfile']['size'];
if($imake==1){
        $maxsize='262144';
}else{
        $maxsize='262144000000';
}


                        if((!in_array($_FILES['userfile']['type'],$allowed)) && (!empty($_FILES['userfile']['type']))){
                                                $message = '1';
                        }else if(($_FILES['userfile']['size'] >= $maxsize) || ($_FILES['userfile']['size'] == 0)){
                                                $message = '2';
                        }else{
                                                $message = '0';
                        }
  
        if($message=='0')
        {
			if($imake=='1'&& $imodel=='1')
			{
			$path= Yii::app()->request->baseUrl;
			//$url=$_SERVER['DOCUMENT_ROOT']."/$path/MPS/images/";
			$url=$_SERVER['DOCUMENT_ROOT']."$path/images/";
			$uploadfile = $url . basename($_FILES['userfile']['tmp_name']);
			move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
			$image=file_get_contents($uploadfile);
			$encrypted=base64_encode($image);
			
			$description = $_POST['imake'];
			$model = new MPSUPLOADS();
			$model->description=$description;
			$model->image_name=$var;
			$model->imagepath=$uploadfile;
			$model->data=$encrypted;
			$model->save();

			}
			else if($imake=='1'&& $imodel=='2')
			{
			//$url='/var/www/html/rihi/MPS/newmps/images/uploadimages/models/bike/';
			//$url='C:/xampp/htdocs/beena/MPS/images/uploadimages/models/bike/';
			$path= Yii::app()->request->baseUrl;
			//$url=$_SERVER['DOCUMENT_ROOT']."/$path/MPS/images/";
			$url=$_SERVER['DOCUMENT_ROOT']."$path/images/uploadimages/models/bike/";
			
			$uploadfile = $url . basename($_FILES['userfile']['tmp_name']);
			move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
			$image=file_get_contents(''.$uploadfile.'');
			$encrypted=base64_encode($image);
			$description = $_POST['imake'];
			$model = new MPSUPLOADS();
			$model->description=$description;
			$model->image_name=$var;
			$model->imagepath=$uploadfile;
			$model->data=$encrypted;
			$model->save();
			}
			else
			{
				
			//$url='/var/www/html/rihi/MPS/newmps/images/uploadimages/home/';
			//$url='C:/xampp/htdocs/beena/MPS/images/uploadimages/home/';
			$path= Yii::app()->request->baseUrl;
			//$url=$_SERVER['DOCUMENT_ROOT']."/$path/MPS/images/";
			$url=$_SERVER['DOCUMENT_ROOT'].Yii::app()->baseUrl."/images/uploadimages/home/";
			$imagepath = Yii::app()->baseUrl."/images/uploadimages/home/".basename($_FILES['userfile']['tmp_name']);
			
			$uploadfile = $url . basename($_FILES['userfile']['tmp_name']);
			move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
			$image=file_get_contents(''.$uploadfile.'');
			$encrypted=base64_encode($image);
			$description = $_POST['imake'];
			$model = new MPSUPLOADS();
			$model->description=$description;
			$model->image_name=$var;
			$model->imagepath="/images/uploadimages/home/".basename($_FILES['userfile']['tmp_name']);
			$model->data=$encrypted;
			$model->save();

			}
			    $this->redirect('images?message='.$message.'');


		}
		else{
			    $this->redirect('images?message='.$message.'');
			}
		}
	}
	 public function actionGetbackgroundscreenimages()
	{
		$images=Yii::app()->db->createCommand("SELECT imagepath from MPS_UPLOADS where description=4")->queryAll();
		 //var_dump($images);
		 //exit;
		 //$images = MPSUPLOADS::model()->findAll();
		 $imgcode = array();
		
		
		 foreach($images as $image)
			{
				$imgcode['slides'][]=$image['imagepath'];//encode
				
			}
			
			if(empty($imgcode))
					{
						
					echo 'No data available';	
					}
					else{
						
						
						echo $endata =json_encode($imgcode);
						
					}
		 exit;
	}
	 public function actionVehicleModifyDetails()
	 {
		 
		 $fetch_makes=Yii::app()->db->createCommand("SELECT * FROM `MPS_VEHICLE_MAKES`")->queryAll();
		 $fetch_model=Yii::app()->db->createCommand("SELECT *  FROM `MPS_VEHICLE_MODELS`")->queryAll();
		 $fetch_mod=Yii::app()->db->createCommand("SELECT * FROM `MPS_MODIFICATION_TYPES`")->queryAll();
		 $makes = array();
		 $models = array();
		 $mod_type = array();
		 $arrr=array();
		 foreach($fetch_makes as $makess=>$value)
			{
				$makes['makes'][]=$value;//encode
				
			}
			
			 foreach($fetch_model as $model=>$value1)
			{
				$models['models'][]=$value1;//encode
				
			}
			foreach($fetch_mod as $mods_type=>$value3)
			{
				$mod_type['mod_type'][]=$value3;//encode
				
			} 
			//echo '<pre>';
			//print_r($mod_type);
			$arr1=array_push($arrr,$makes,$models,$mod_type);
			echo json_encode($arrr);
			
	 }
	public function actionmanageRepairlists()
	{
		$this->render('repairlist');
	}
	public function actioncreateService()
        {
			
			$services=Yii::app()->db->createCommand("SELECT `id`, `servicenames` FROM `MPS_SERVICES_DETAILS`")->queryAll();
           
            if(isset($_POST['add']))
            {
               
                $model=new MPSCARSERVICESLISTDETAILS();
                //$model->id=$this->id;
                $model->sname=$_POST['servicename'];
                $model->save();
                $agent=MPSCARSERVICESLISTDETAILS::model()->findByPk($_POST['servicename']);
                $id=$agent->id;
                $i=0;
                foreach($_POST['user'] as $sublist){
                   
                $model1=new MPSSUBREPAIRLISTDETAILS();
                $model1->id=$this->id;
               
                $model1->repairid=$id;
                $model1->sname=$_POST['servicename'];
               
                $model1->srepairid=$i+1;
                $model1->subvalue=$_POST['user'][$i];
               
                $model1->save();
                $i++;
                }
           
            }
         $this->render('services',array("services"=>$services));
        }
		
		public function actionChecklogin()
	     {
			 
			 
				 $uname=$_POST['uname'];
				 $password=$_POST['unmpwd'];
				 
				 $getpassword=Yii::app()->db->createCommand("SELECT `id`, `username`, `password`, `status` FROM `MPS_CUSTOMERACC_INFO` 
					WHERE username='$uname' and password='$password'")->queryAll();
					 foreach($getpassword as $getpwd)
					{
						 $userid=$getpwd['id'];
						 $username=$getpwd['username'];
					}
				
					 
					if(!isset($userid))
					{
						 $userid=0;
						
					}
					else{
		
				   Yii::app()->session['lastid']=$userid;
				   Yii::app()->session['username']=$uname;
					}
				
				
		   
			
					if(count($getpassword)>0)
					{
						
						Yii::app()->session['username']=$uname;
						Yii::app()->session['lastid']=$userid;
						$arry=array("Status"=>0,"Response"=>'Success');
						echo json_encode($arry);
					}
					
					else
					{
						$arr1=array("Status"=>1,"Response"=>'Invalid');
						echo json_encode($arr1);
					}
		 }
		
		public function actionHireMechanicDetails()
		{
			 $self_details=Yii::app()->db->createCommand("SELECT `id`, `hire_mechanic_id`, `role_id`, `vehicle_type`, `profesional`, `booking_charge`, `name`, `mobileno`, `email`,`company_name`, `Year_of_exp`, `work_certificate_path`, `id_proof_path`,`address`, `created_date`, `description`, `location`, `lag`, `lat` FROM `HIRE_A_MECHANIC`")->queryAll();
			 $selfdata = array();
		
		//echo '<pre>';
		 foreach($self_details as $key=>$value)
			{
				$selfdata['MechanicsPersonsDetails'][]=$value;//encode
				
			}
			//echo '<pre>';
		//print_r($selfdata);
		//exit;
				if(!empty($selfdata))
				{
					
				   echo json_encode($selfdata);
				}
				else{
					echo 'No Data Available';
				}
		}
		public function actionHireMechanicDetailsByLocation()
		{
			  $lat=$_POST['lat'];
			  $long=$_POST['long'];
			  $veh_type=$_POST['vehicle_type'];
			 $mechanicdetailsbyLoc=Yii::app()->db->createCommand("SELECT `id`, `hire_mechanic_id`,`vehicle_type`, `profesional`, `booking_charge`, `name`, `mobileno`, `email`,upload_pic_path,  `company_name`, `Year_of_exp`, `address`, `description`, `location` FROM `HIRE_A_MECHANIC` WHERE lag='$lat' and lat='$long' and vehicle_type='$veh_type'")->queryAll();
			 $locdata = array();
		
		//echo '<pre>';
		 foreach($mechanicdetailsbyLoc as $key=>$value)
			{
				$locdata['MechanicsPersonsDetailsByLocation'][]=$value;//encode
				
			}
		
				if(!empty($locdata))
				{
					
				   echo json_encode($locdata);
				}
				else{
					echo 'No Data Available';
				}
		}
		public function actionSearchMechanicsBylocations()
		{
			 $self_details=Yii::app()->db->createCommand("SELECT * FROM HIRE_A_MECHANIC")->queryAll();
			 $selfdata = array();
		
		//echo '<pre>';
		 foreach($self_details as $key=>$value)
			{
				$selfdata['MechanicsPersonsDetails'][]=$value;//encode
				
			}
		
				if(!empty($selfdata))
				{
					
				   echo json_encode($selfdata);
				}
				else{
					echo 'No Data Available';
				}
		}
		
	public function actionGethomescreenimages()
	{
		 $images=Yii::app()->db->createCommand("SELECT imagepath from MPS_UPLOADS where description=2")->queryAll();
		 //var_dump($images);
		 //exit;
		 //$images = MPSUPLOADS::model()->findAll();
		 $imgcode = array();
		
		
		 foreach($images as $image)
			{
				$imgcode['slides'][]=$image['imagepath'];//encode
				
			}
			
			if(empty($imgcode))
					{
						
					echo 'No data available';	
					}
					else{
						
						
						echo $endata =json_encode($imgcode);
						
					}
		 exit;
		
					
		
		
	}
	
	public function actionGetvehiclemodelDetails()
	{
		$makes_id=$_POST['makes_id'];
		$model_id=$_POST['model_id'];
		
		
	}
	public  function actionSelfDriveDetails()
	{
		$images=Yii::app()->db->createCommand("SELECT sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`, 
sfd.`model_id`, sfd.`seating_capacity`,sfd.`price_per_hour`,sfd.`price`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`from_date`,sfd.`to_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd")->queryAll();
foreach($images as $image)
			{
				$imgcode['selfdrive'][]=$image['img_path'];//encode
				
			}
			//print_r($imgcode);

		
	}
	public function actionAddVehiclesAddedLists()
	{ 
		 $images=Yii::app()->db->createCommand("SELECT distinct mvd.makes_id,mvd.model_id,mvd.id as regid,mvd.variant, mvd.vehicle_type, mvd.year, mvd.lastserviceon, mvd.age, mvd.reg_no,mvv.car_img,mvm.makes_name as make_name,mvmod.models_name as model_name FROM `MPS_VEHICLE_DETAILS` as mvd,MPS_VEHICLES as mvv,MPS_VEHICLE_MAKES as mvm, MPS_VEHICLE_MODELS as mvmod WHERE

      mvd.makes_id=mvv.makes_id and mvv.models_id=mvd.model_id and mvm.makes_id= mvd.makes_id and mvmod.models_id=mvd.model_id")->queryAll();
	  $keys = array("");
		
		$i=0;
		 $imgcode = array();
		
		//echo '<pre>';
		 foreach($images as $logosDetail=>$logosDeta)
			{
				$imgcode['VehicleListDetails'][]=$logosDeta;//encode
				
			}
		/* 	
		foreach($images as $logosDetail=>$logosDeta)
		{
			
			
			$a['details'][$i] = array_fill_keys($keys,$logosDeta);
			
			$i++;
		} */
		/* echo '<pre>';
		print_r($imgcode);
		exit; */
		if(!empty($imgcode))
		{
		echo json_encode($imgcode);
		}
		else{
			echo 'No Data Available';
		}
	//	print_r($a);
			
	}
	public function actionExlusiveServiceInfo()//excecute 
	{
		  $veh_info=$_POST['veh_info'];
		  $pick_date=$_POST['pick_date'];
		  $pick_time=$_POST['pick_time'];
		  $model_id=$_POST['model_id'];
		  $make_id=$_POST['make_id'];
		 // $user_id=$_POST['user_id']; 
		/*  $veh_info='sgdjakshfkh';
		$pick_date='09/02/2016';
		$pick_time='7:15';
		$model_id=1;
		$make_id=2;
		$user_id=1;   */
		$model=new MPSEXCLUSIVEDETAILS();	
		
		
	     $model->comments=$veh_info;
		 $model->makes_id=$make_id;
		 $model->models_id=$model_id; 
	     //$model->use_id=$user_id;
		 $model->pickdate=$pick_date;
	     $model->pictime=$pick_time;
		 $model->save();
		
		$arr=array("Status"=>0,"Response"=>"ExclusService Details Successfully Added");
	    echo json_encode($arr);
		
		
		
	}
	public function actionUserPlaceInfo()//excecute 
	{
		 
		 $emailid=$_POST['emailid'];
		 $latlong=Yii::app()->db->createCommand("SELECT id,emailid,longitude, latitude FROM MPS_CUSTOMER_INFO WHERE emailid='$emailid'")->queryAll();
		 $data = array();
		
		//echo '<pre>';
		 foreach($latlong as $key=>$value)
			{
				
				$data['users_place_info'][]=$value;
			}
			echo json_encode($data);
		
	}
	public function actionAddVehiclesInfo()//excecute 
	{
		
		$makes_id=$_POST['makes_id'];
		$vehicle_type=$_POST['vehicle_type'];
		$model_id=$_POST['model_id'];
		$variant=$_POST['variant'];  
		$year=$_POST['year'];
		$lastservice_on=$_POST['lastservice_on'];
		$vehicle_age=$_POST['veh_age'];
		$regno=$_POST['regno']; 
		
		
		/* $getcount=Yii::app()->db->createCommand("SELECT `id` FROM `MPS_VEHICLE_DETAILS` 
					WHERE makes_id=$makes_id and model_id=$model_id")->queryAll();
				if(count($getcount) <= 0)
					{ */
	
		$model=new MPSVEHICLEDETAILS();	
		
		
	    $model->makes_id=$makes_id;
		$model->vehicle_type=$vehicle_type;
		$model->model_id=$model_id; 
	    $model->variant=$variant;
		$model->year=$year;
		$model->lastserviceon=$lastservice_on;
		$model->age=$vehicle_age;
		$model->reg_no=$regno;
		
		$model->save();
		if($model->save())
		{
			$lastid=$model->id;
		}
		
		$arr=array("Response"=>"Add vehicle Successfully","Regid"=>$lastid);
	    echo json_encode($arr);
				/* }
				else{
					$arr=array("Response"=>"Add vehicle Successfully","Regid"=>$lastid);
					echo json_encode($arr);
				} */
				
		//exit;
		
		
		
		
		
	}
	public function actionvehicleServicesList()
	{
		$servicedelimg=Yii::app()->db->createCommand("SELECT distinct msd.id,msd.servicenames,msp.packageid
FROM MPS_SERVICES_DETAILS as msd
LEFT JOIN MPS_SERVICE_PACKAGE_DETAILS as msp
ON msd.id=msp.serviceid")->queryAll();
		 $data = array();
		
		//echo '<pre>';
		 foreach($servicedelimg as $id=>$snm)
			{
				//$gen[]=$snm['packageid'];
				$data['VehicleServiceDetails'][]=$snm;
				//$data['VehicleServiceDetails'][]=$snm['packageid'];//encode
				
			}
			
			//$data['VehicleServiceDetails']=$gen;
			//echo '<pre>';
			//print_r($data);
			echo json_encode($data);
	}
	
	public function actionVehicleRepairLists()
	{
		
		$servicesid=$_GET['service_id'];//service id
		$idd=$_GET['plan_id'];
		$models_id=$_GET['model_id'];
		
		//plan id example(basic,elite,advanced)
		$models_id=$_GET['model_id'];//model id
		if($servicesid==1)
		{   
			$servicename="General Services";
			if($idd==1)
			{
				$value="basic";
			}
			else if($idd==2)
			{
				$value="elite";
			}
			else if($idd==3)
			{
				$value="advanced";
			}
		}
		
		else{
			$servicename="Periodic Service";
			/* $idd=8;//plan id example(basic,elite,advanced)
			$models_id=59; */
			if($idd==4)
			{
				$value="ten";
			}
			else if($idd==5)
			{
				$value="twenty";
			}
			else if($idd==6)
			{
				$value="thirty";
			}
			else if($idd==7)
			{
				$value="fourty";
			}
			else if($idd==8)
			{
				$value="fifty";
			}
			else if($idd==8)
			{
				$value="sixty";
			}
		}
		
		//EXIT;
		//$servicedelimg=Yii::app()->db->createCommand("select id,servicenames from MPS_SERVICES_DETAILS")->queryAll();
		$basicid=Yii::app()->db->createCommand("SELECT mcd.sname,mcd.id,count(mcd.id) as amount FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$value=$idd group by mcd.id")->queryAll();
					
					$data = array();

					foreach($basicid as $basici)
					{
						 $id=$basici['id'];
						 $snm=$basici['sname'];
						 
						$basiclists=Yii::app()->db->createCommand("SELECT msr.sname,msr.subvalue FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.basic=1 and repairid =$id")->queryAll();
						 foreach($basiclists as $basiclist)
						{
							
							
							 $data[$basiclist['sname']][]=$basiclist['subvalue'];
							  
							
						} 
						 
					}
				  $GETCATEIDs=Yii::app()->db->createCommand("SELECT  `category_id` FROM `MPS_VEHICLES` WHERE models_id=$models_id")->queryAll();
			       foreach($GETCATEIDs as $GETCATEID)
					{
						$category_id=$GETCATEID['category_id'];
					} 
					/* echo "SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.$value=$idd and a.category_id=$category_id";
					exit; */
					$basicamts=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.$value=$idd and a.category_id=$category_id")->queryAll();
					 foreach($basicamts as $basicamt)
						{
							//echo $basiclist['subvalue'];
							 $basicamt= $basicamt['amount'];
						} 
						 $servicehr=Yii::app()->db->createCommand("SELECT servicehr as hour from MPS_SERVICE_PACKAGE_DETAILS where id=$idd")->queryAll();
						  foreach($servicehr as $hour)
						{
							//echo $basiclist['subvalue'];
							 $servhr = $hour['hour'];
						}  
					
					$data["$value amout"][]=$basicamt;
					$data["Estimated Time"][]=$servhr;
					$datas=array("$servicename"=>array("$value"=>$data));
					
					//echo '<pre>';
					echo json_encode($datas);
		           // print_r($datas);
		//}
		
	}
	
	public function actiongetModelImages()//excecute 
	{
		
		$images = MPSUPLOADS::model()->findAll();
		$array1 = array();
		$keys = array('Models');
		
		foreach($images as $image)
		{
			
			$a['images'][] = array_fill_keys($keys, $image['data']);
			
		}
		$endata=json_encode($a);
		print_r($endata);
		exit;
		/* //$array8['img']=$imgcode;
		//$imgcode['slides']=$imgcode['Images'];
		
					$endata=json_encode($imgcode);
					
					//print_r($endata);
					exit;
					//$path=Yii::app()->request->baseUrl ;
					//$url="var/www/".$path."/MPS/index.php/site/FetchData";
					$url="http://localhost/beena/mps/index.php/site/FetchData";
					$ch = curl_init($url);
					// Disable SSL verification
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					// Will return the response, if false it print the response
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_POSTFIELDS,$endata);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					// Set the url
					curl_setopt($ch, CURLOPT_URL,$url);
					// Execute
					$result=curl_exec($ch);
					
					curl_close($ch); 
					
					print_r($result); */
					
					
	  }
	  public function actionFetchDataHomescreen()
		{
			
		
			//exit;
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$rawData1=json_decode($rawData,true);
			print_r( $rawData1 );
			if(empty($rawData1))
					{
						
					echo 'No data available';	
					}
					else{
						
						print_r($rawData1);
					}
			//
		}
		public function actionFetchData()
		{
			ECHO 'DJKLSDGKMLGFK';
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$rawData1=json_decode($rawData,true);
			print_r( $rawData1 );
			if(empty($rawData1))
					{
						
					echo 'No data available';	
					}
					else{
						
						print_r($rawData1);
					}
			//
		}
		
	public function actioncreateVehicleaddimage()
	{
		
		
		$message="";
		if(isset($_POST['add'])){
			
		$vmake=$_POST['vmake'];
		
		
		$img='/images/uploadimages/models/car/'.basename($_FILES['logofile']['tmp_name']);
		$idproof= Yii::app()->request->baseUrl;
		$url2=$_SERVER['DOCUMENT_ROOT']."$idproof/images/uploadimages/models/car/";
		$uploadfile1 = $url2 .basename($_FILES['logofile']['tmp_name']);
		move_uploaded_file($_FILES['logofile']['tmp_name'], $uploadfile1);
		$logos=file_get_contents($uploadfile1);
	    $logoencrypted=base64_encode($logos);
		
		
		
		 $i=0;
		
		foreach($_POST['vmodel'] as $vmodel){
			
			$model=new MPSVEHICLES();	
		$model->makes_id=$vmake;
		$model->year=0;
		$model->category_id=$_POST['cat'][$i];
		$model->logo_img=$img;
		$idproof2= Yii::app()->request->baseUrl;
		$url3=$_SERVER['DOCUMENT_ROOT']."$idproof2/images/uploadimages/models/car/";
		$uploadfile3 = $url3 .basename($_FILES['carfile']['tmp_name'][$i]);
		move_uploaded_file($_FILES['carfile']['tmp_name'][$i], $uploadfile3);
		$cars=file_get_contents($uploadfile3);
	    $carencrypted=base64_encode($cars);
		$model->car_img='/images/uploadimages/models/car/'.basename($_FILES['carfile']['tmp_name'][$i]);
		$model->logo_data= $logoencrypted;
		$model->car_data=$carencrypted;
		$model->models_id=$_POST['vmodel'][$i];
			$model->save(); 
			$i++;
		}
			$message='Inserted Successfully';
		/* $model->models_id=$vmodel;
		$model->logo_img='/images/uploadimages/models/car/'.basename($_FILES['logofile']['tmp_name']);
		$model->car_img='/images/uploadimages/models/car/'.basename($_FILES['carfile']['tmp_name']);
		$model->models_id=$vmodel;
		$model->logo_data= $logoencrypted;
		$model->car_data=$carencrypted; */
		
		}
		$vmake = MPSVEHICLEMAKES::model()->findAll();
		
	
		$this->render('vehicleSample',array('message'=>$message,"vmakelist"=>$vmake));
	}
	public function actionRepairlist()
	{
		 $message="";
		 if(isset($_POST['add']))
			{
						 // $_POST['rid'];
						 $rid=$_POST['rid'];
						 $srid=$_POST['srid'];
						 //$repairLists=Yii::app()->db->createCommand("SELECT * from repairlist_package_details where repair_id=$rid and subrepair_id=$srid and category_id=1 ")->queryAll();
						 $model=new RepairlistPackageDetails();
						if(isset($_POST['hatchback']))
					    {
							  $repairamountht=Yii::app()->db->createCommand("SELECT * from repairlist_package_details where repair_id=$rid and subrepair_id=$srid and category_id=1")->queryAll();
							  if(empty($repairamountht[0]))
							  {
								 $model->id=$this->id;
								 $model->repair_id=$_POST['rid'];
								 $model->subrepair_id=$_POST['srid'];
								 $model->category_id=1;
								 $model->amount=$_POST['hatchback'];
								 $model->save();
							 }
							 else
							  {
								 $amountlxy=$_POST['hatchback'];
								 $sql=Yii::app()->db->createCommand("UPDATE repairlist_package_details SET amount = $amountlxy WHERE repair_id=$rid and subrepair_id=$srid and category_id=1")->execute();
									
							  } 
						} 
						  if(isset($_POST['sedan']))
						  {
							   $repairamountseden=Yii::app()->db->createCommand("SELECT * from repairlist_package_details where repair_id=$rid and subrepair_id=$srid and category_id=2")->queryAll();
						  if(empty($repairamountseden[0]))
						  {
							 $model1=new RepairlistPackageDetails();
							 $model1->id=$this->id;
							 $model1->repair_id=$_POST['rid'];
							 $model1->subrepair_id=$_POST['srid'];
							 $model1->category_id=2;
							 $model1->amount=$_POST['sedan'];
							 $model1->save();
						  }
						  else
						  {
							   $amountlxy=$_POST['sedan'];
							 $sql=Yii::app()->db->createCommand("UPDATE repairlist_package_details SET amount = $amountlxy WHERE repair_id=$rid and subrepair_id=$srid and category_id=2")->execute();
								
						   } 
						 }
						 if(isset($_POST['svu']))
						  {
							  $repairamountsvu=Yii::app()->db->createCommand("SELECT * from repairlist_package_details where repair_id=$rid and subrepair_id=$srid and category_id=3")->queryAll();
							  if(empty($repairamountsvu[0]))
							   {
								 $model2=new RepairlistPackageDetails();
								 $model2->id=$this->id;
								 $model2->repair_id=$_POST['rid'];
								 $model2->subrepair_id=$_POST['srid'];
								 $model2->category_id=3;
								 $model2->amount=$_POST['svu'];
								 $model2->save();
							  }
							  else
							  {
								   $amountlxy=$_POST['svu'];
								 $sql=Yii::app()->db->createCommand("UPDATE repairlist_package_details SET amount = $amountlxy WHERE repair_id=$rid and subrepair_id=$srid and category_id=3")->execute();
									
							   } 
						  
						 }
						  if(isset($_POST['Luxury']))
						  {
								  $repairamountlxy=Yii::app()->db->createCommand("SELECT * from repairlist_package_details where repair_id=$rid and subrepair_id=$srid and category_id=4")->queryAll();
								  if(empty($repairamountlxy[0]))
								  {
											 $model3=new RepairlistPackageDetails();
											 $model3->id=$this->id;
											 $model3->repair_id=$_POST['rid'];
											 $model3->subrepair_id=$_POST['srid'];
											 $model3->category_id=4;
											 $model3->amount=$_POST['Luxury'];								
											 $model3->save();
								  }else
								  {
											 $amountlxy=$_POST['Luxury'];
											$sql=Yii::app()->db->createCommand("UPDATE repairlist_package_details SET amount = $amountlxy WHERE repair_id=$rid and subrepair_id=$srid and category_id=4")->execute();
										
								   } 
						 }
						$message="update Sucessful";
				}
		
		$repairLists=Yii::app()->db->createCommand("SELECT MPS_CARSERVICESLIST_DETAILS.sname,MPS_CARSERVICESLIST_DETAILS.id,count(MPS_SUB_REPAIRLIST_DETAILS.srepairid) as count from MPS_CARSERVICESLIST_DETAILS,MPS_SUB_REPAIRLIST_DETAILS where MPS_CARSERVICESLIST_DETAILS.id=MPS_SUB_REPAIRLIST_DETAILS.repairid group by MPS_CARSERVICESLIST_DETAILS.id")->queryAll();
		$html='<table class=" table responsive" cellspacing="0" width="100%" border="1">
                                        <thead bgcolor="#eaeaea">
                                            <tr>
											<th>Slno<th>
											Repair List
											<th>Sub Repairs List</th>
                                            <th>Hatchback</th>
                                            <th>Sedan</th>
                                            <th>SUV / CUV</th>
                                            <th>Luxury</th>
                                            <th>Status</th>
                                            </tr>
                                        </thead>
           
		   <tbody>';
		  $i=0;
		// $arr=array("4","2");
		$br='';
		 foreach($repairLists as $repairList)
		{    
			$repairid = $repairList['id'];
			$html.='<tr><td rowspan="'.$repairList['count'].'">'.$repairid.'</td><th rowspan="'.$repairList['count'].'">'.$repairList['sname'].'</th>';
			
			$repairsubLists=Yii::app()->db->createCommand("SELECT subvalue,srepairid from MPS_SUB_REPAIRLIST_DETAILS where repairid=$repairid")->queryAll();
			//echo '<pre>';
			foreach($repairsubLists as $repairsubList)
				{
			//echo count($repairList['count']);
					$srid=$repairsubList['srepairid'];
					$repairamountht=Yii::app()->db->createCommand("SELECT * from repairlist_package_details where repair_id=$repairid and subrepair_id=$srid and category_id=1")->queryAll();
					$repairamountseden=Yii::app()->db->createCommand("SELECT * from repairlist_package_details where repair_id=$repairid and subrepair_id=$srid and category_id=2")->queryAll();
					$repairamountsvu=Yii::app()->db->createCommand("SELECT * from repairlist_package_details where repair_id=$repairid and subrepair_id=$srid and category_id=3")->queryAll();
					$repairamountlxy=Yii::app()->db->createCommand("SELECT * from repairlist_package_details where repair_id=$repairid and subrepair_id=$srid and category_id=4")->queryAll();
					
					if(!empty($repairamountht[0]['amount']))
					{
						$amount=$repairamountht[0]['amount'];
						
					}else
					{
						$amount=0;
					
					}
					if(!empty($repairamountseden[0]['amount']))
					{
						
						$sedenamount=$repairamountseden[0]['amount'];
					}else
					{
						
						$sedenamount=0;
					}
						if(!empty($repairamountsvu[0]['amount']))
					{
						
						$svuamount=$repairamountsvu[0]['amount'];
					}else
					{
						
						$svuamount=0;
					}	
					if(!empty($repairamountlxy[0]['amount']))
					{
						
						$lxyamount=$repairamountlxy[0]['amount'];
					}else
					{
						
						$lxyamount=0;
					}
					
					$html.= '<td>'.$repairsubList['subvalue'].'</td>
												<td>
												
												<form name="" action="Repairlist" method="post">
												<input type="hidden" name="rid" value="'.$repairList['id'].'" />
												<input type="hidden" name="srid" value="'.$repairsubList['srepairid'].'" />
												
											<input type="text" class="1" name="hatchback" placeholder="Enter Amount" value="'.$amount.'"></td>
                                         
                                            <td><input type="text" class="2" id="ht" name="sedan" placeholder="Enter Amount" value="'.$sedenamount.'"></td>
                                            <td><input type="text" class="3" name="svu" placeholder="Enter Amount" value="'.$svuamount.'"></td>
											 <td><input type="text" class="4" name="Luxury" placeholder="Enter Amount" value="'.$lxyamount.'"></td><td valign="middle" align="center">
                                            <input type="submit" class="edit-u test btn-primary" name="add"
											value="update"/>
											</form>
                                           </td>
										   </tr>';
											
											 
			
			
				}
	 
		} 
		$html.='</tbody></table>';
		 
		$this->render('repairList',array('repairlist'=>$html,'message'=>$message));
  }
  public function actionInsertStatusofperiodic()
  {
	  $status=$_POST['status'];
	  if($status==1)
	  {
	   $repid=$_POST['repid'];
	   $pakageid=$_POST['pakageid'];
	   $cat_id=$_POST['cat_id'];
	   
	   $getcount=Yii::app()->db->createCommand("SELECT `id`, `repid`, `pkid` FROM `MPS_RECOMENDED_SERVICE` WHERE repid=$repid and pkid= $pakageid")->queryAll();
	   if(count($getcount)<1)
	   {
								$model2=new MPSRECOMENDEDSERVICE();
								
								 $model2->cat_id=$cat_id;
								  $model2->repid=$repid;
								 $model2->pkid=$pakageid;
								 $model2->periodicstatus=10;
								 
								 $model2->save();
	   } 
	  }
	  else{
		 // echo 'else';
	   $repid=$_POST['repid'];
	   $pakageid=$_POST['pakageid'];
	    $cat_id=$_POST['cat_id'];
	   $getcount=Yii::app()->db->createCommand("SELECT `id`, `repid`, `pkid` FROM `MPS_RECOMENDED_SERVICE` WHERE repid=$repid and pkid= $pakageid")->queryAll();
	   if(count($getcount)>0)
	   {
		   $sql=Yii::app()->db->createCommand("UPDATE `MPS_RECOMENDED_SERVICE` SET `periodicstatus`=0 WHERE `repid`=$repid and `pkid`=$pakageid ")->execute();
	   }
	  }
	   
	  
  }
  public function actionTypePeriodicService()
  {
	 $periid=$_POST['periid'];
	 
	 $repairst=Yii::app()->db->createCommand("SELECT  repid,pkid FROM `MPS_RECOMENDED_SERVICE`")->queryAll();
			 foreach($repairst as $repairst)
				{
					$repid=$repairst['repid'];
					$pkid=$repairst['pkid'];
				}
	if($periid==4)
	{
		$repairLists=Yii::app()->db->createCommand("SELECT MPS_CARSERVICESLIST_DETAILS.sname,MPS_CARSERVICESLIST_DETAILS.id,MPS_RECOMENDED_SERVICE.pkid,
		count(MPS_CARSERVICESLIST_DETAILS.id) as count
FROM MPS_CARSERVICESLIST_DETAILS
LEFT OUTER JOIN MPS_RECOMENDED_SERVICE ON MPS_CARSERVICESLIST_DETAILS.id=MPS_RECOMENDED_SERVICE.repid group by MPS_CARSERVICESLIST_DETAILS.id")->queryAll();
	  
	 
 
	$html='<table class=" table responsive" cellspacing="0" width="100%" border="1">
                                        <thead bgcolor="#eaeaea"><tr><th>Slno<th>
											Repair List
											<th>Sub Repairs List</th>';
	 
	
		 $html='<table class=" table responsive" cellspacing="0" width="100%" border="1">
                                        <thead bgcolor="#eaeaea"><tr><th>Slno<th>
											Repair List
											';
	$servicelist=Yii::app()->db->createCommand("SELECT `package`, `packageid` ,`pkname` 
		FROM `MPS_SERVICE_PACKAGE_DETAILS` WHERE serviceid=2")->queryAll();
		
	foreach($servicelist as  $serviceli)
	{
											$pacakges[]=$serviceli['package'];
											$packageid[]=$serviceli['packageid'];
                                            $html.='<th>'.$serviceli['package'].'</th>';
                                         
	}
	$i=0;
	 $html.='</tr></thead><tbody>';
	 foreach($repairLists as $repairList)
		{
		
			$repairid = $repairList['id'];
			$pkid = $repairList['pkid'];
			$html.='<tr><td rowspan="'.$repairList['count'].'">'.$repairid.'</td><th rowspan="'.$repairList['count'].'">'.$repairList['sname'].'</th>';
			    
				
				
			
				
	 
	 
		 foreach($servicelist as $service){
			 $pkid=$service['packageid'];
			 $count=Yii::app()->db->createCommand("SELECT `id`  FROM `MPS_RECOMENDED_SERVICE` WHERE `periodicstatus`=10 and `repid`=$repairid and 
			`pkid`=$pkid")->queryAll();
			 if(count($count)>0)
			{
				$html.='<td><input type="checkbox" id="'.$service['packageid'].'" onclick=checkper('.$repairid.','.$service['packageid'].') checked></td>';
			}
			else
			{
				$html.='<td><input type="checkbox" id="'.$service['packageid'].'" onclick=checkper('.$repairid.','.$service['packageid'].')></td>';
			}
	 
		     
			}
			
	 //
	 		
	 
		  /* foreach($repairstatus as $repairst)
				{
					$count=$repairst['count'];
							
							foreach($servicelist as $service){
							
				$html.='<td><input type="checkbox" id="'.$service['packageid'].'" onclick=checkper('.$repairid.','.$service['packageid'].')></td>';
							
							}
				
				} */
	 
			
			
					
							
				//}
		
				$html.='</tr>';	 
		
			
				
					$html.='</thead><tbody>';
				$i++;
	 }
	 echo $html;
	}
	else{
	$repairLists=Yii::app()->db->createCommand("SELECT MPS_CARSERVICESLIST_DETAILS.sname,MPS_CARSERVICESLIST_DETAILS.id,count(MPS_SUB_REPAIRLIST_DETAILS.srepairid) as count from MPS_CARSERVICESLIST_DETAILS,MPS_SUB_REPAIRLIST_DETAILS where
	MPS_CARSERVICESLIST_DETAILS.id=MPS_SUB_REPAIRLIST_DETAILS.repairid group by MPS_CARSERVICESLIST_DETAILS.id")->queryAll();
	  
	 
 
	$html='<table class=" table responsive" cellspacing="0" width="100%" border="1">
                                        <thead bgcolor="#eaeaea"><tr><th>Slno<th>
											Repair List
											<th>Sub Repairs List</th>';
	 
	  $servicelist=Yii::app()->db->createCommand("SELECT `package`, `packageid` 
		FROM `MPS_SERVICE_PACKAGE_DETAILS` WHERE serviceid=2")->queryAll();
		 $html='<table class=" table responsive" cellspacing="0" width="100%" border="1">
                                        <thead bgcolor="#eaeaea"><tr><th>Slno<th>
											Repair List
											<th>Sub Repairs List</th>';
	foreach($servicelist as  $serviceli)
	{
											$pacakges[]=$serviceli['package'];
                                            $html.='<th>'.$serviceli['package'].'</th>';
                                         
	}
	 $html.='</tr></thead><tbody>';

	      
  foreach($repairLists as $repairList)
		{    
			$repairid = $repairList['id'];
			$html.='<tr><td rowspan="'.$repairList['count'].'">'.$repairid.'</td><th rowspan="'.$repairList['count'].'">'.$repairList['sname'].'</th>';
			    
			$repairsubLists=Yii::app()->db->createCommand("SELECT * from MPS_SUB_REPAIRLIST_DETAILS where repairid=$repairid")->queryAll();
							
			//echo '<pre>';
			foreach($repairsubLists as $repairsubList)
				{
			//echo '<pre>';
			
			//echo count($repairList['count']);
					
					
					$html.= '<td>'.$repairsubList['subvalue'].'</td>';
					foreach($servicelist as $service){
					$html.='<td><input type="checkbox" 
					value="'.$service['packageid'].'/'.$repairsubList['id'].'" id="id'.$service['packageid'].''.$repairsubList['id'].'" 
					onclick=check('.$service['packageid'].''.$repairsubList['id'].');';

					 if(($service['packageid']==$repairsubList['ten'])|| ($service['packageid']==$repairsubList['twenty'])|| ($service['packageid']==$repairsubList['thirty'])  || ($service['packageid']==$repairsubList['fourty']) || ($service['packageid']==$repairsubList['fifty']) || ($service['packageid']==$repairsubList['sixty']))
						{
							if($periid==4)
							{
								if($repairsubList['ten']!=0 ||$repairsubList['twenty']!=0||$repairsubList['thirty']!=0 || $repairsubList['fourty']!=0 || $repairsubList['fifty']!=0 || $repairsubList['sixty']!=0)
								{ 
									$html.='';
								}
							}
							
							else{
								if($repairsubList['ten']!=0 ||$repairsubList['twenty']!=0||$repairsubList['thirty']!=0 || $repairsubList['fourty']!=0 || $repairsubList['fifty']!=0 || $repairsubList['sixty']!=0)
								{ 
									$html.=' checked ';
								}
							}
						}
						$html.='></td>';
											
					}					 
			
			
				//$i++;
	$html.='</tr>';
				}
	}		$html.='<tr>                        <td align="center" colspan="2"></td>
                                            <td align="right"><strong>Total</strong></td>
                                            <td align="center"><strong><span class="basic"></span></strong></td>
                                            <td align="center"><strong><span class="elite"></span></strong></td>
                                            <td align="center"><strong><span class="advanced"></span></strong></td>
                                        </tr>';		
		$html.='</tbody></table>';
		echo $html;
	  
	}
  }
public function actionService()
   {
	    $servicesid=$_POST['servicesid'];
	   
$repairLists=Yii::app()->db->createCommand("SELECT MPS_CARSERVICESLIST_DETAILS.sname,MPS_CARSERVICESLIST_DETAILS.id,count(MPS_SUB_REPAIRLIST_DETAILS.srepairid) as count from MPS_CARSERVICESLIST_DETAILS,MPS_SUB_REPAIRLIST_DETAILS where
 MPS_CARSERVICESLIST_DETAILS.id=MPS_SUB_REPAIRLIST_DETAILS.repairid group by MPS_CARSERVICESLIST_DETAILS.id")->queryAll();
 
 $html='<table class=" table responsive" cellspacing="0" width="100%" border="1">
                                        <thead bgcolor="#eaeaea"><tr><th>Slno<th>
											Repair List
											<th>Sub Repairs List</th>';
	
	if($servicesid==1)
	{
		$servicelist=Yii::app()->db->createCommand("SELECT `package`, `packageid` 
		FROM `MPS_SERVICE_PACKAGE_DETAILS` WHERE serviceid=1")->queryAll();
		
	foreach($servicelist as  $serviceli)
	{
											$pacakges[]=$serviceli['package'];
                                            $html.='<th>'.$serviceli['package'].'</th>';
                                         
	}
	 $html.='</tr></thead><tbody>';

	      
  foreach($repairLists as $repairList)
		{    
			$repairid = $repairList['id'];
			$html.='<tr><td rowspan="'.$repairList['count'].'">'.$repairid.'</td><th rowspan="'.$repairList['count'].'">'.$repairList['sname'].'</th>';
			
			$repairsubLists=Yii::app()->db->createCommand("SELECT * from MPS_SUB_REPAIRLIST_DETAILS where repairid=$repairid")->queryAll();
			//echo '<pre>';
			foreach($repairsubLists as $repairsubList)
				{
			//echo '<pre>';
			
			//echo count($repairList['count']);
					
					
					$html.= '<td>'.$repairsubList['subvalue'].'</td>';
					foreach($servicelist as $service){
					$html.='<td><input type="checkbox" value="'.$service['packageid'].'/'.$repairsubList['id'].'" id="id'.$service['packageid'].''.$repairsubList['id'].'" onclick=check('.$service['packageid'].''.$repairsubList['id'].');';
					 if($service['packageid']==$repairsubList['basic']||$service['packageid']==$repairsubList['elite']||$service['packageid']==$repairsubList['advanced'])
						{
							if($repairsubList['basic']!=0 ||$repairsubList['elite']!=0||$repairsubList['advanced']!=0)
							{ 
								$html.=' checked ';
							}
						}
						$html.='></td>';
											
					}					 
			
			
				//$i++;
	$html.='</tr>';
				}
	}		$html.='<tr>                        <td align="center" colspan="2"></td>
                                            <td align="right"><strong>Total</strong></td>
                                            <td align="center"><strong><span class="basic"></span></strong></td>
                                            <td align="center"><strong><span class="elite"></span></strong></td>
                                            <td align="center"><strong><span class="advanced"></span></strong></td>
                                        </tr>';		
		$html.='</tbody></table>';
	echo $html;	
	}
		/*else
		{
				
				
			$servicelist=Yii::app()->db->createCommand("SELECT `package`, `packageid` 
		FROM `MPS_SERVICE_PACKAGE_DETAILS` WHERE serviceid=2")->queryAll();
		 $html='<table class=" table responsive" cellspacing="0" width="100%" border="1">
                                        <thead bgcolor="#eaeaea"><tr><th>Slno<th>
											Repair List
											<th>Sub Repairs List</th>';
	foreach($servicelist as  $serviceli)
	{
											$pacakges[]=$serviceli['package'];
                                            $html.='<th>'.$serviceli['package'].'</th>';
                                         
	}
	 $html.='</tr></thead><tbody>';

	      
  foreach($repairLists as $repairList)
		{    
			$repairid = $repairList['id'];
			$html.='<tr><td rowspan="'.$repairList['count'].'">'.$repairid.'</td><th rowspan="'.$repairList['count'].'">'.$repairList['sname'].'</th>';
			
			
			$repairsubLists=Yii::app()->db->createCommand("SELECT * from MPS_SUB_REPAIRLIST_DETAILS where repairid=$repairid")->queryAll();
			//echo '<pre>';
			foreach($repairsubLists as $repairsubList)
				{
			//echo '<pre>';
			
			//echo count($repairList['count']);
					
					
					$html.= '<td>'.$repairsubList['subvalue'].'</td>';
					foreach($servicelist as $service){
					$html.='<td><input type="checkbox" 
value="'.$service['packageid'].'/'.$repairsubList['id'].'" id="id'.$service['packageid'].''.$repairsubList['id'].'" 
onclick=check('.$service['packageid'].''.$repairsubList['id'].');';

					 if(($service['packageid']==$repairsubList['ten'])|| ($service['packageid']==$repairsubList['twenty'])|| ($service['packageid']==$repairsubList['thirty'])  || ($service['packageid']==$repairsubList['fourty']) || ($service['packageid']==$repairsubList['fifty']) || ($service['packageid']==$repairsubList['sixty']))
						{
							
							if($repairsubList['ten']!=0 ||$repairsubList['twenty']!=0||$repairsubList['thirty']!=0 || $repairsubList['fourty']!=0 || $repairsubList['fifty']!=0 || $repairsubList['sixty']!=0)
							{ 
								$html.=' checked ';
							}
						}
						$html.='></td>';
											
					}					 
			
			
				//$i++;
	$html.='</tr>';
				}
	}		$html.='<tr>                        <td align="center" colspan="2"></td>
                                            <td align="right"><strong>Total</strong></td>
                                            <td align="center"><strong><span class="basic"></span></strong></td>
                                            <td align="center"><strong><span class="elite"></span></strong></td>
                                            <td align="center"><strong><span class="advanced"></span></strong></td>
                                        </tr>';		
		$html.='</tbody></table>';
		echo $html;


		}*/

	}
	
  // thiis package list for general service
 public function actionServicepackagelist()
 {

	 $repairLists=Yii::app()->db->createCommand("SELECT 
		MPS_CARSERVICESLIST_DETAILS.sname,MPS_CARSERVICESLIST_DETAILS.id,
		count(MPS_SUB_REPAIRLIST_DETAILS.srepairid) as count 
		from MPS_CARSERVICESLIST_DETAILS,MPS_SUB_REPAIRLIST_DETAILS 
		where MPS_CARSERVICESLIST_DETAILS.id=MPS_SUB_REPAIRLIST_DETAILS.repairid group by MPS_CARSERVICESLIST_DETAILS.id")->queryAll();
	 
	 $s=1;
	if(isset($s))
	{
		$servicelist=Yii::app()->db->createCommand("SELECT `package`, `packageid` FROM `MPS_SERVICE_PACKAGE_DETAILS` WHERE serviceid=1")->queryAll();
		  $html='<table class=" table responsive" cellspacing="0" width="100%" border="1">
                                        <thead bgcolor="#eaeaea"><tr><th>Slno<th>
											Repair List
											<th>Sub Repairs List</th>';
	foreach($servicelist as  $serviceli)
	{
											$pacakges[]=$serviceli['package'];
                                            $html.='<th>'.$serviceli['package'].'</th>';
                                         
	}
	$html.='</tr></thead><tbody>';
	//echo $html;
	}
	
	 
	                        
		   foreach($repairLists as $repairList)
		{    
			$repairid = $repairList['id'];
			$html.='<tr><td rowspan="'.$repairList['count'].'">'.$repairid.'</td><th rowspan="'.$repairList['count'].'">'.$repairList['sname'].'</th>';
			
			$repairsubLists=Yii::app()->db->createCommand("SELECT * from MPS_SUB_REPAIRLIST_DETAILS where repairid=$repairid")->queryAll();
			//echo '<pre>';
			foreach($repairsubLists as $repairsubList)
				{
			//echo '<pre>';
			
			//echo count($repairList['count']);
					
					
					$html.= '<td>'.$repairsubList['subvalue'].'</td>';
					foreach($servicelist as $service){
					$html.='<td><input type="checkbox" value="'.$service['packageid'].'/'.$repairsubList['id'].'" id="id'.$service['packageid'].''.$repairsubList['id'].'" onclick=check('.$service['packageid'].''.$repairsubList['id'].');';
					 if($service['packageid']==$repairsubList['basic']||$service['packageid']==$repairsubList['elite']||$service['packageid']==$repairsubList['advanced'])
						{
							if($repairsubList['basic']!=0 ||$repairsubList['elite']!=0||$repairsubList['advanced']!=0)
							{ 
								$html.=' checked ';
							}
						}
						$html.='></td>';
											
					}					 
			
			
				//$i++;
	$html.='</tr>';
				}
	}		$html.='<tr>                        <td align="center" colspan="2"></td>
                                            <td align="right"><strong>Total</strong></td>
                                            <td align="center"><strong><span class="basic"></span></strong></td>
                                            <td align="center"><strong><span class="elite"></span></strong></td>
                                            <td align="center"><strong><span class="advanced"></span></strong></td>
                                        </tr>';		
		$html.='</tbody></table>';
		 
		 $services=Yii::app()->db->createCommand("SELECT * from MPS_SERVICES_DETAILS")->queryAll();
		$categories=Yii::app()->db->createCommand("SELECT * from MPS_VEHICLE_CAT")->queryAll();
		
		$this->render('service_packages',array('services'=>$services,'categories'=>$categories,'html'=>$html)); 
 }
 
  public function actionupdatepackages()
 {
	// echo 'zjhzlk';
	
	 $servicesid=$_POST['servicesid'];
	 
	 $id=$_POST['id'];
	 $package=explode('/',$id);
	 $pk_id=$package[0];
	 $sid=$package[1];
	if($servicesid == 1)
	{
	 
	
	 $services=Yii::app()->db->createCommand("SELECT package from MPS_SERVICE_PACKAGE_DETAILS where packageid=$pk_id")->queryAll();
		foreach($services as $serv)
		{
			 $package=strtolower($serv['package']);
		} 
		 $sql=Yii::app()->db->createCommand("UPDATE MPS_SUB_REPAIRLIST_DETAILS SET $package = $pk_id WHERE id=$sid ")->execute();
	
		   
	}
	 else if($servicesid == 2){
		//echo 'sfjhasjkh';
	    $periid=$_POST['periid'];
		if($periid==5)
		{
	    $services=Yii::app()->db->createCommand("SELECT pkname from MPS_SERVICE_PACKAGE_DETAILS where packageid=$pk_id")->queryAll();
		foreach($services as $serv)
		{
			 $package1=strtolower($serv['pkname']);
			// echo $package = str_replace(',', '', $package1);
		} 
		$sql=Yii::app()->db->createCommand("UPDATE MPS_SUB_REPAIRLIST_DETAILS SET $package1 = $pk_id WHERE id=$sid ")->execute();
		}
		else{
			$services=Yii::app()->db->createCommand("SELECT pkname from MPS_SERVICE_PACKAGE_DETAILS where packageid=$pk_id")->queryAll();
		foreach($services as $serv)
		{
			 $package1=strtolower($serv['pkname']);
			// echo $package = str_replace(',', '', $package1);
		} 
		$sql=Yii::app()->db->createCommand("UPDATE MPS_SUB_REPAIRLIST_DETAILS SET periodicstatus = 10 WHERE id=$sid ")->execute();
		}
	}
	
 }
   public function actionuncheckpackages()
 {
	  $servicesid=$_POST['servicesid'];

	 $id=$_POST['id'];
	
	 $package=explode('/',$id);
	  $pk_id=$package[0];
	  $sid=$package[1]; 
	/* print_r($package);
	exit; */
	if($servicesid == 1)
	{
	 
	
	 $services=Yii::app()->db->createCommand("SELECT package from MPS_SERVICE_PACKAGE_DETAILS where packageid=$pk_id")->queryAll();
		foreach($services as $serv)
		{
			 $package=strtolower($serv['package']);
		} 
		 $sql=Yii::app()->db->createCommand("UPDATE MPS_SUB_REPAIRLIST_DETAILS SET $package = 0 WHERE id=$sid ")->execute();
	
		 
	}
	  else if($servicesid == 2){
		
	 
	    $services=Yii::app()->db->createCommand("SELECT pkname from MPS_SERVICE_PACKAGE_DETAILS where packageid=$pk_id")->queryAll();
		foreach($services as $serv)
		{
			 $package=strtolower($serv['pkname']);
		} 
		 $sql=Yii::app()->db->createCommand("UPDATE MPS_SUB_REPAIRLIST_DETAILS SET $package = 0 WHERE id=$sid ")->execute();
	}
	
 }
	 public function actionamountCalculation()
	 {
		  $cat_id=$_POST['id'];
		  $serviceid=$_POST['servicesid'];
	
		 if($serviceid==1)
		 {
		 $amount=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.basic>0 and a.category_id=$cat_id")->queryAll();
		$amountelite=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.elite>0 and a.category_id=$cat_id")->queryAll();
		$amountadvanced=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.advanced>0 and a.category_id=$cat_id")->queryAll();
		$basic=$amount[0]['amount'];
		$elite=$amountelite[0]['amount'];
		$adv=$amountadvanced[0]['amount'];
		$totalamount=array('basic'=>$basic,'elite'=>$elite,'adv'=>$adv,"plan"=>'general');
	
			echo json_encode($totalamount);
				die;
		 }
		  else if($serviceid==2){
			  $tenamt=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.ten>0 and a.category_id=$cat_id")->queryAll();
		$twentyamt=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.twenty>0 and a.category_id=$cat_id")->queryAll();
		$thirtamt=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.thirty>0 and a.category_id=$cat_id")->queryAll();
		
		 $fourthamt=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.fourty>0 and a.category_id=$cat_id")->queryAll();
		 
		 $fifthamt=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.fifty>0 and a.category_id=$cat_id")->queryAll();
		 
		 $sixthamt=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.sixty>0 and a.category_id=$cat_id")->queryAll();
		
	/*	$fifthamt=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.fifth>0 and a.category_id=$cat_id")->queryAll();
		
		$sixthamt=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.sixth>0 and a.category_id=$cat_id")->queryAll(); */
		
		$ten=$tenamt[0]['amount'];
		
		$twenty=$twentyamt[0]['amount'];
		$thirty=$thirtamt[0]['amount'];
		$fourty=$fourthamt[0]['amount'];
		$fifty=$fifthamt[0]['amount'];
		$sixth=$sixthamt[0]['amount'];
		/* $fourty=$fourthamt[0]['amount'];
		
		$sixth=$sixthamt[0]['amount']; */
	
		 
		$totalamountt=array('Ten'=>$ten,'twenty'=>$twenty,'thirty'=>$thirty,"fourty"=>$fourty,"fifty"=>$fifty,"sixty"=>$sixth,"plan"=>'periodic');
	
			echo json_encode($totalamountt);
				die;
		 } 
		 
	 }
}

