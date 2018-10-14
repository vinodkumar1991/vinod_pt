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
	
/* public function accessRules()
/* public function accessRules()
{
    return array(
        array('allow', // allow authenticated user to perform 'create' and 'update' actions
            'actions'=>array('create','update', 'view', 'index', 'dashboard'),
            'users'=>array('*'),
        ),
        array('allow', // allow admin user to perform 'admin' and 'delete' actions
            'actions'=>array('admin','delete', 'view', 'index', 'dashboard'),
            'users'=>array('admin'),
        ),
        /* array('deny',  // deny all users
            'users'=>array('*'),
        ), 
    );
} */

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
	public function actionuserRegister()//select users
	{
		$getcountries=Yii::app()->db->createCommand("SELECT distinct MPS_COUNTRIES.name FROM `MPS_LOCATIONS`,MPS_COUNTRIES WHERE
		MPS_LOCATIONS.country_code=MPS_COUNTRIES.id")->queryAll();
		
		//$cities = Cities::model()->findAll();
	   // $this->render('userRegi',array('cities'=>$cities));
	   $this->render('userRegi',array("MPSCOUNTRIES"=>$getcountries));
		
	}
	public function actionManageruser()//select users
	{
		
		
		$this->render('customers');
		
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
		
		$vmodel=$_GET['makes_id'];
		
		$carImageDetails=Yii::app()->db->createCommand("SELECT distinct MPS_VEHICLE_MODELS.models_id,MPS_VEHICLES.car_data as car_data,MPS_VEHICLE_MODELS.models_name,MPS_VEHICLE_MAKES.makes_name
                             FROM MPS_VEHICLES,MPS_VEHICLE_MODELS,MPS_VEHICLE_MAKES where MPS_VEHICLES.models_id=MPS_VEHICLE_MODELS.models_id 
							 and MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id and MPS_VEHICLES.makes_id=$vmodel")->queryAll();
		
		
		
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
		/* //print_r($endata);
			   
		           $url="http://localhost/beena/MPS/index.php/site/FetchDataHomescreen";
				  
				  //   $url="http://10.10.10.94/beena/MPS/index.php/site/FetchDataHomescreen";
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
					//echo count($result);
					//var_dump($result);
					// Closing
					curl_close($ch); 
					ECHO '<PRE>';
					//$res=json_decode($result);
					print_r($result); */
					
		
		
	}
	
	public function actionGetvehiclemodelDetails()
	{
		$makes_id=$_POST['makes_id'];
		$model_id=$_POST['model_id'];
		
		
	}
	public function actionAddVehiclesInfo()//excecute 
	{
		
		/* $makes_id=$_POST['makes_id'];
		$model_id=$_POST['model_id']; */
		$vehicle_type='Car';
		/* $variant='Petrol';
		$year=$_POST['year'];
		
		$lastservice_on=$_POST['lastservice_on'];
		$vehicle_age=$_POST['veh_age'];
		$regno=$_POST['regno']; */
		
		/*$vehicle_type=$_POST['vehicle_type'];
		$model_id=$_POST['model_id'];
		$year=$_POST['year'];
		$lastservice_on=$_POST['lastservice_on'];
		$vehicle_age=$_POST['vehicle_age'];
		$regno=$_POST['regno'];  */
		
		/* if(isset($model_id) && isset($year) && isset($lastservice_on) )
		{ */
		$model=new MPSVEHICLEDETAILS();	
		
		/* $model->model_id=$model_id;
		$model->makes_id=$makes_id; */
		$model->vehicle_type=$vehicle_type;
	   /*  $model->variant=$variant;
		$model->year=$year;
		$model->lastserviceon=$lastservice_on;
		$model->age=$vehicle_age;
		$model->reg_no=$regno; */
		//$model->vehicle_type=$vehicle_type;
		/*$model->year=$year;
		$model->lastserviceon=$lastservice_on;
		$model->age=$vehicle_age;
		$model->reg_no=$regno;  */
		$model->save();
		echo 'Add vehicle Successfully';
		/* }
		else{
			
			echo 'Please enter correct data';
		} */
		
		
		
		
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
  // thiis package list for general service
 public function actionServicepackagelist()
 {
	 $repairLists=Yii::app()->db->createCommand("SELECT MPS_CARSERVICESLIST_DETAILS.sname,MPS_CARSERVICESLIST_DETAILS.id,count(MPS_SUB_REPAIRLIST_DETAILS.srepairid) as count from MPS_CARSERVICESLIST_DETAILS,MPS_SUB_REPAIRLIST_DETAILS where MPS_CARSERVICESLIST_DETAILS.id=MPS_SUB_REPAIRLIST_DETAILS.repairid group by MPS_CARSERVICESLIST_DETAILS.id")->queryAll();
	 
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
else{
	     $servicelist=Yii::app()->db->createCommand("SELECT `package`, `packageid` FROM `MPS_SERVICE_PACKAGE_DETAILS` WHERE serviceid=2")->queryAll();
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
	 
	 // else{
		 
		 // $html='<table class=" table responsive" cellspacing="0" width="100%" border="1">
                                            // <thead bgcolor="#eaeaea"><tr><th>Slno<th>
											// Repair List
											// <th>Sub Repairs List</th>
                                            // <th>10,000</th>
                                            // <th>20,000</th>
                                            // <th>30,000</th>
											 // <th>40,000</th></tr></thead><tbody>';
	 // }
	 
              //$i=0;                         
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
	 $id=$_POST['id'];
	 $package=explode('/',$id);
	 $pk_id=$package[0];
	 $sid=$package[1];
	if($pk_id==1)
	{
	 $sql=Yii::app()->db->createCommand("UPDATE MPS_SUB_REPAIRLIST_DETAILS SET basic = $pk_id WHERE id=$sid ")->execute();
							
	}
	if($pk_id==2)
	{
	 $sql=Yii::app()->db->createCommand("UPDATE MPS_SUB_REPAIRLIST_DETAILS SET elite = $pk_id WHERE id=$sid ")->execute();
							
	}
	if($pk_id==3)
	{
	 $sql=Yii::app()->db->createCommand("UPDATE MPS_SUB_REPAIRLIST_DETAILS SET advanced = $pk_id WHERE id=$sid ")->execute();
							
	}
 }
   public function actionuncheckpackages()
 {
	 $id=$_POST['id'];
	 $package=explode('/',$id);
	 $pk_id=$package[0];
	 $sid=$package[1];
	if($pk_id==1)
	{
	 $sql=Yii::app()->db->createCommand("UPDATE MPS_SUB_REPAIRLIST_DETAILS SET basic = 0 WHERE id=$sid ")->execute();
							
	}
	if($pk_id==2)
	{
	 $sql=Yii::app()->db->createCommand("UPDATE MPS_SUB_REPAIRLIST_DETAILS SET elite = 0 WHERE id=$sid ")->execute();
							
	}
	if($pk_id==3)
	{
	 $sql=Yii::app()->db->createCommand("UPDATE MPS_SUB_REPAIRLIST_DETAILS SET advanced = 0 WHERE id=$sid ")->execute();
							
	}
 }
	 public function actionamountCalculation()
	 {
		 $cat_id=$_POST['id'];
		 $amount=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.basic>0 and a.category_id=$cat_id")->queryAll();
		$amountelite=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.elite>0 and a.category_id=$cat_id")->queryAll();
		$amountadvanced=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.advanced>0 and a.category_id=$cat_id")->queryAll();
		$basic=$amount[0]['amount'];
		$elite=$amountelite[0]['amount'];
		$adv=$amountadvanced[0]['amount'];
		$totalamount=array('basic'=>$basic,'elite'=>$elite,'adv'=>$adv);
	
			echo json_encode($totalamount);
				die;
		 
	 }
}
