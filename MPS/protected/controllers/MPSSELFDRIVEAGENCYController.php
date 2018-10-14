<?php

class MPSSELFDRIVEAGENCYController extends Controller
{



	public function actionIndex()
	{
		
		$this->render('index');
	}
	public function actionselfdrivereports()
	{
		 
		
		
		$userData=Yii::app()->db->createCommand("SELECT * from MPS_CUSTOMER_INFO")->queryAll();
		$rawslfData=Yii::app()->db->createCommand("SELECT addv.username,book.status,book.user_id,book.book_id,addv.vehicle_id,addv.vehicle_type,addv.vehicle_category,addv.security_deposit,book.created_date,book.fromdate,book.todate,book.amount FROM SLD_ADD_VEHICLE as addv,selfdrive_bookings as book where addv.id=book.vehicle_id  ")->queryAll();
		
		$this->render('selfdrivereports',array("BookingDetails"=>$rawslfData,"users"=>$userData));
		
	}
	public function actionupdate_vehicle_details()
	{
		$message="";
		 if(isset($_POST['update']))
		 {
			
			 $updateuser =SLDADDVEHICLE::model()->findByPk($_POST['id']);
			 $updateuser->from_date=strtotime($_POST['from_date']);
			
			 $updateuser->to_date=strtotime($_POST['to_date']);
			 $updateuser->update();
			 $message="Update Sucessfully";
			
		 }
		$usercheck=Yii::app()->user->getState('user');
		
		 $self_details=Yii::app()->db->createCommand("SELECT sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`, 
sfd.`model_id`, sfd.`seating_capacity`,sfd.`price_per_hour`,sfd.`price`,sfd.`vehicle_image`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`from_date`,sfd.`to_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd WHERE sfd.`username`='$usercheck' ")->queryAll();
	
		$this->render('../mPSSELFDRIVEAGENCY/manageVehicleSelfdrive',array('self_details'=>$self_details,"message"=>$message));
		
	}
	public function actionaddVehicle()
	{
		
		$message='';
		/* if(isset($_POST['add_vehicle']))
		{
			
			$addmodel=new SLDADDVEHICLE();
			
			$addmodel->id=$this->id;
			$addmodel->vehicle_id=$_POST['vehicle_id'];	
			$addmodel->username=Yii::app()->user->getState('user');
			$addmodel->vehicle_category=$_POST['vehicle_category'];
			$addmodel->vehicle_type=$_POST['vehicle_type'];
			$addmodel->brand_name=$_POST['brand_name'];
			$addmodel->model_name=$_POST['model_name'];
			$addmodel->seating_capacity=$_POST['seating_capacity'];
			$addmodel->price_per_hour=$_POST['price_per_hour'];
			$addmodel->price=$_POST['price'];
			$addmodel->security_deposit=$_POST['security_deposit'];
			$addmodel->total_kms=$_POST['total_kms'];
			$addmodel->extra_rate_per_kms=$_POST['extra_rate_per_kms'];
			foreach($_POST['vehicle_features'] as $vehicle_cat )
			{
				
			$addmodel->vehicle_features.=$vehicle_cat.'/';
			
			}
			$addmodel->variant=$_POST['variant'];
			$idproof= Yii::app()->request->baseUrl;
			$url2=$_SERVER['DOCUMENT_ROOT']."$idproof/images/selfdrive/addvehicle/";
			$uploadfile1 = $url2 .basename($_FILES['vehicle_image']['tmp_name']);
			move_uploaded_file($_FILES['vehicle_image']['tmp_name'], $uploadfile1);
			$image1=file_get_contents($uploadfile1);
			$encrypted=base64_encode($image1);
			$addmodel->vehicle_image=$encrypted;
			$addmodel->img_path=$uploadfile1;				
			$addmodel->save();
			$message="successfully Added";
			
			
		} */
		$user1=strtoupper(Yii::app()->user->getState('user'));
		$user=Yii::app()->user->getState('user');
		// vehicle list
		$vmake = MPSVEHICLEMAKES::model()->findAll();
		//get vehicle id
		$rawslfData=Yii::app()->db->createCommand("SELECT max(vehicle_id) as vehicle_ids
        FROM SLD_ADD_VEHICLE where vehicle_id LIKE '%VEH%' and username='$user'")->queryAll();		
		$vehicle_unique_id=$rawslfData[0]['vehicle_ids'];
		$vehicle_id=explode('VEH',$vehicle_unique_id);
		if(empty($vehicle_id[1]))
		{
			 
			$vehicle_id='0';
			 $this->render('../mPSSELFDRIVEAGENCY/addVehicleSelfdrive',array("vehicleuniqueid"=>$vehicle_id,'vmakelist'=>$vmake,'message'=>$message));
		}
		else
		{
			
			$this->render('../mPSSELFDRIVEAGENCY/addVehicleSelfdrive',array("vehicleuniqueid"=>$vehicle_id[1],'vmakelist'=>$vmake,'message'=>$message));
			
		}
			
		
	}
	
	
	public function actionbookRequest()
	{
		$user=Yii::app()->user->getState('user');
		$rawslfData=Yii::app()->db->createCommand("SELECT book.book_id,addv.vehicle_id,addv.vehicle_type,addv.vehicle_category,addv.security_deposit,book.fromdate,book.todate,book.amount FROM SLD_ADD_VEHICLE as addv,selfdrive_bookings as book where addv.id=book.vehicle_id and book.status=1 and addv.username='$user' ")->queryAll();
		
		$this->render('bookingRequestSeldrive',array("self_details"=>$rawslfData));
		
	}
		public function actionVehicleList()
	
	{
		
		$message='';
	if(isset($_POST['update_vehicle'])){ 
				
			 $updateuser =SLDADDVEHICLE::model()->findByPk($_POST['id']);
			
			 $updateuser->price_per_hour=$_POST['price_per_hour'];
			 $updateuser->price=$_POST['price'];
			 $updateuser->security_deposit=$_POST['security_deposit'];
			 $updateuser->total_kms=$_POST['total_kms'];
			 $updateuser->extra_rate_per_kms=$_POST['extra_rate_per_kms'];
			 $vehic_cat='';
			 foreach($_POST['vehicle_features'] as $vehicle_cat )
			{
				
			$vehic_cat.=$vehicle_cat.',';
			
			}
			$updateuser->vehicle_features=$vehic_cat;
			 $updateuser->update();
			 $message="Update Sucessfully";
			
				}
		$usercheck=Yii::app()->user->getState('user');
		
		 $self_details=Yii::app()->db->createCommand("SELECT sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`, 
sfd.`model_id`, sfd.`seating_capacity`,sfd.`price_per_hour`,sfd.`price`,sfd.`vehicle_image`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd WHERE sfd.`username`='$usercheck' ")->queryAll();
	
		$this->render('../mPSSELFDRIVEAGENCY/VehicleListSelfdrive',array('self_details'=>$self_details,"message"=>$message));
		
	}
	public function actionmanageVehicle()
	
	{
		$message='';
		if(!empty($_POST['add_vehicle']))
		{
			
			$addmodel=new SLDADDVEHICLE();
			
			$addmodel->id=$this->id;
			$addmodel->vehicle_id=$_POST['vehicle_id'];	
			$addmodel->username=Yii::app()->user->getState('user');
			$addmodel->vehicle_category=$_POST['vehicle_category'];
			$addmodel->vehicle_type=$_POST['vehicle_type'];
			$addmodel->makes_id=$_POST['brand_name'];
			$addmodel->model_id=$_POST['model_name'];
			$addmodel->seating_capacity=$_POST['seating_capacity'];
			$addmodel->price_per_hour=$_POST['price_per_hour'];
			$addmodel->price=$_POST['price'];
			$addmodel->from_date=time();
			$addmodel->to_date=time();
			$addmodel->security_deposit=$_POST['security_deposit'];
			$addmodel->total_kms=$_POST['total_kms'];
			$addmodel->extra_rate_per_kms=$_POST['extra_rate_per_kms'];
			foreach($_POST['vehicle_features'] as $vehicle_cat )
			{
				
			$addmodel->vehicle_features.=$vehicle_cat.',';
			
			}
			$addmodel->variant=$_POST['variant'];
			$idproof= Yii::app()->request->baseUrl;
			$url2=$_SERVER['DOCUMENT_ROOT']."$idproof/images/selfdrive/addvehicle/";
			
			$uploadfile1 = $url2 .basename($_FILES['vehicle_image']['tmp_name']);
			$uploadfile1saved="/images/selfdrive/addvehicle/".basename($_FILES['vehicle_image']['tmp_name']);
			move_uploaded_file($_FILES['vehicle_image']['tmp_name'], $uploadfile1);
			$image1=file_get_contents($uploadfile1);
			$encrypted=base64_encode($image1);
			$addmodel->vehicle_image=$encrypted;
			$i=0;
			$images=array();
			foreach($_FILES['vehicle_images']['tmp_name'] as $key => $tmp_name )
				{
					
					$file_name = basename($_FILES['vehicle_images']['tmp_name'][$key]);
					$file_size =$_FILES['vehicle_images']['size'][$key];
					$file_tmp =$_FILES['vehicle_images']['tmp_name'][$key];
					$uploadfile1 = $url2 .$file_name;
					$images[]="/images/selfdrive/addvehicle/".basename($_FILES['vehicle_images']['tmp_name'][$key]);
					move_uploaded_file($file_tmp,$uploadfile1);
				}
				foreach($images as $img)
				{
					$addimg[]=$img; 
				}
				$addmodel->location=$_POST['name'];
				$lotlat=$_POST['location'];
				$latarray=explode(',',$lotlat);
				
				$addmodel->lat=$latarray[0];
				$addmodel->lon=$latarray[1];
			$addmodel->imagespath=serialize($addimg); 
			$addmodel->img_path=$uploadfile1saved;				
			$addmodel->save();
			$message="successfully Added";
			
			
		}
			
		$usercheck=Yii::app()->user->getState('user');
		
		 $self_details=Yii::app()->db->createCommand("SELECT sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`, 
sfd.`model_id`, sfd.`seating_capacity`,sfd.`imagespath`,sfd.`status`,sfd.`price_per_hour`,sfd.`price`,sfd.`vehicle_image`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`from_date`,sfd.`to_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd WHERE sfd.`username`='$usercheck' ")->queryAll();
	
		$this->render('../mPSSELFDRIVEAGENCY/manageVehicleSelfdrive',array('self_details'=>$self_details,"message"=>$message));
		
	}
	public function actionuserValidation()
	{
		$own_email=$_POST['suser'];
		 $rawData=Yii::app()->db->createCommand("SELECT username
        FROM SELF_DRIVE_AGENCY_USERS
        WHERE username='$own_email'")->queryAll();
		echo $emailcount=count($rawData);
	}
	
	
	public function actionSelfdrive()
	{
		$message='';
		if(!empty($_POST['selfsubmit'])){
		$agency_name=$_POST['agency_name'];
		$roleid=$_POST['sroletype'];
		$country=$_POST['scountry'];
		$state=$_POST['sstate'];
		$city=$_POST['scity'];
		$area=$_POST['sarea'];
		$zipcode=$_POST['szipcode'];		
		$selfdriveid=$_POST['slfid'];
		//$roletype=$_POST['roletype'];		
		$address=$_POST['saddress'];
		$email=$_POST['semail'];
		$contact=$_POST['contact_no'];
		$username=$_POST['susername'];
		$password=sha1($_POST['spassword']);
		$confirmpassword=$_POST['scpassword'];
		$idproof= Yii::app()->request->baseUrl;
		$url2=$_SERVER['DOCUMENT_ROOT']."$idproof/images/selfdrive/";
		$uploadfile1 = $url2 .basename($_FILES['userfile']['tmp_name']);
		$urlsaved="/images/selfdrive/".basename($_FILES['userfile']['tmp_name']);
		move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile1);
		$image1=file_get_contents($uploadfile1);
		$encrypted=base64_encode($image1);
		
		$modelu=new MPSUSER();
		$modelu->id=$this->id;
		$modelu->user=$_POST['susername'];	
		$modelu->password=$_POST['spassword'];
		$modelu->role_id=$roleid;
		$modelu->save(); 
		 
		 $models=new SELFDRIVEAGENCYUSERS();	
		$models->self_unique_id=$selfdriveid;
		$models->username=$_POST['susername'];	
		$models->role_id=$roleid;
		$models->password=$_POST['spassword'];
		$models->owner_emailid=$_POST['semail'];
		$models->save();
		//shopowner_details
		$model=new MPSSELFDRIVEAGENCYDETAILS();	
		//print_r($model->shop_id);
		$model->role_id=$roleid;
		$model->self_unique_id=$selfdriveid;				
		$model->agency_name=$agency_name;
		$model->address=$address;
		$model->contact_num=$contact;
		$model->country=$country;
		$model->state=$state;
		$model->city=$city;
		$model->sector=$area;	
		//$model->area=$area;
		$model->zipcode=$zipcode;	
		$model->img_path=$urlsaved;
		$model->email=$email;
		
		$model->id_proof=$encrypted;
		
		$model->save(); 
		$message='Successfully Inserted';		
	}
		//username password saving
		 $self_details=Yii::app()->db->createCommand("SELECT * FROM MPS_SELFDRIVEAGENCY_DETAILS")->queryAll();
	
		
		
		
		$this->render('../mPSUserRegistration/manageSelfusers', array('message'=>$message,'self_details'=>$self_details)); 
		
		
	}


	public function actiongetIds()
	{
		 $id=$_POST['roleval'];
		 
		if($id)
		{
	
			 $rawData=Yii::app()->db->createCommand("SELECT max(self_unique_id) as self_unique_id
        FROM SELF_DRIVE_AGENCY_USERS where role_id = $id")->queryAll();
		$shop_unique_id=$rawData[0]['self_unique_id'];
		
		//$dlbshopid=explode('dlb',$shop_unique_id);
		if(!isset($shop_unique_id))
		{
			echo $shop_unique_id='SLD001'; 
		}
		else
		{
			
			$shop_unique_id=explode('SLD',$shop_unique_id);
			$sp= $shop_unique_id[1]+1; 
			echo 'SLD00'.$sp;
		}
		
		}
		
	} 

public function actionemailValidation()
{
	
	$own_emailid=$_POST['semail'];
		 $rawData=Yii::app()->db->createCommand("SELECT owner_emailid
        FROM SELF_DRIVE_AGENCY_USERS
        WHERE owner_emailid='$own_emailid'")->queryAll();
		echo $emailcount=count($rawData);
}
public function actionFetchSelfDrivedata()//select users
	{
		
		if(Yii::app()->user->getState('role')==4)
		{
			$this->redirect('../site/dashboard');
		}
		//$self_details=new MPSSELFDRIVEAGENCYDETAILS();
		 $self_details=Yii::app()->db->createCommand("SELECT sfd.`id`,sfd.`self_unique_id`,sfd.`img_path`,sfd.`email`,sfd.`contact_num`,sfd.`id_proof`, 
sfd.`agency_name`, sfd.`address`,sfd.`created_date` FROM `MPS_SELFDRIVEAGENCY_DETAILS` as sfd ,`SELF_DRIVE_AGENCY_USERS` as sf where sf.self_unique_id=sfd.self_unique_id")->queryAll();
	
		$this->render('../mPSUserRegistration/manageSelfusers',array('self_details'=>$self_details));
		
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
	public function actionDeleteself()
	{
		
		$id=$_POST['id'];
		$delsql='DELETE FROM MPS_SELFDRIVEAGENCY_DETAILS WHERE id='.$id.'';
		$res = Yii::app()->db->createcommand($delsql)->execute();
		


	}
	public function actionTest()
	{
		
		$sql = "insert into MPS_USER values (:user,:password,:role_id)";
$parameters = array(':user' => '',':password'=>'',':role_id'=>4);
Yii::app()->db->createCommand($sql)->execute($parameters);


	}
	public function actioneditVehicleList()
	{
		$id=$_POST['id'];
		$self_details=Yii::app()->db->createCommand("SELECT * FROM `SLD_ADD_VEHICLE` where id='$id'")->queryAll();
		/*  
	 $out=array();
            foreach($self_details as $service)
            {
                $out[]=array('id'=>$service['id']);
            } */

		echo json_encode($self_details); 
           die;
		
	
	}
	public function actionupdateVehicleList()
	{
		
				if(isset($_POST['add_vehicle'])){ 
				
			 $updateuser =SLDADDVEHICLE::model()->findByPk($_POST['id']);
			
			 $updateuser->price_per_hour=$_POST['price_per_hour'];
			 $updateuser->price=$_POST['price'];
			 $updateuser->security_deposit=$_POST['security_deposit'];
			 $updateuser->total_kms=$_POST['total_kms'];
			 $updateuser->extra_rate_per_kms=$_POST['extra_rate_per_kms'];
			 $updateuser->update();
			 $message="Update Sucessfully";
			
				}
				
		
	}
		public function actionDeleteSelfdriveVehicle()
	{
		$id=$_POST['id'];
		$delsql='DELETE FROM SLD_ADD_VEHICLE WHERE id='.$id.'';
		$res = Yii::app()->db->createcommand($delsql)->execute();
	}
		public function actionUpdateVehicleTime()
		{
			$id=$_POST['id'];
			$self_details=Yii::app()->db->createCommand("SELECT FROM_UNIXTIME(from_date,'%d/%m/%Y %h:%i%p') as from_date,FROM_UNIXTIME(to_date,'%d/%m/%Y %h:%i%p') as to_date FROM `SLD_ADD_VEHICLE` where id='$id'")->queryAll();
			echo json_encode($self_details); 
			die;
			
		}
		public function actionupdateSelfdriveDetails()
		{
			$id=$_POST['id'];
		$self_details=Yii::app()->db->createCommand("SELECT * FROM `MPS_SELFDRIVEAGENCY_DETAILS` where id='$id'")->queryAll();
	
		echo json_encode($self_details); 
           die;
		}
	public function actionUpdateSelfdrive()
		{
			if(isset($_POST['update_selfdrive']))
			{
				$updateuser =MPSSELFDRIVEAGENCYDETAILS::model()->findByPk($_POST['id']);
			
			 $updateuser->agency_name=$_POST['agency_name'];
			 $updateuser->address=$_POST['saddress'];
			 $updateuser->email=$_POST['semail'];
			 $updateuser->contact_num=$_POST['contact_num'];
			
			 $updateuser->update();
			 $message="Update Sucessfully";
			}
		$self_details=Yii::app()->db->createCommand("SELECT sfd.`id`,sfd.`self_unique_id`,sfd.`img_path`,sfd.`email`,sfd.`contact_num`,sfd.`id_proof`, 
sfd.`agency_name`, sfd.`address`,sfd.`created_date` FROM `MPS_SELFDRIVEAGENCY_DETAILS` as sfd ,`SELF_DRIVE_AGENCY_USERS` as sf where sf.self_unique_id=sfd.self_unique_id")->queryAll();
	
		$this->render('../mPSUserRegistration/manageSelfusers',array('self_details'=>$self_details));
			
		}
	public function actionSelfdriveserviceDetails()
	{
				  $fromdate = $_GET['from_date'];
				  $todate = $_GET['to_date'];
				  $vehicle_type = $_GET['vehicle_type'];
				
				  $d=strtotime($fromdate);
				
					
				  $t=strtotime($todate); 
				 
				if(isset($_GET['id']))
				{
					$id=$_GET['id'];      
					$getdataself=Yii::app()->db->createCommand("SELECT imagespath from SLD_ADD_VEHICLE where id='$id' ")->queryAll();
				
					echo json_encode(unserialize($getdataself[0]['imagespath']));  
				}
				else if(isset($_GET['from_date'])&&isset($_GET['to_date'])&&isset($_GET['vehicle_type']))
				{ 
				$getdataself=Yii::app()->db->createCommand("SELECT 
		sfd.imagespath,sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`,mvm.makes_name, mvmm.models_name,
				sfd.`model_id`, sfd.`seating_capacity`,sfd.`location`,sfd.`lat`,sfd.`lon`,sfd.`price_per_hour`,sfd.`price`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`from_date`,
				sfd.`to_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd,MPS_VEHICLE_MAKES as mvm,MPS_VEHICLE_MODELS as mvmm where sfd.makes_id=mvm.makes_id and sfd.model_id=mvmm.models_id and sfd.vehicle_type='car' and from_date<='$d' and to_date>=$d")->queryAll();
				
				/* print_r($getdataself);
				exit; */
				if(!empty($getdataself)){
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
						'location'=>$value['location'],
						'lat'=>$value['lat'],
						'lon'=>$value['lon'],
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
				}else
				{
					$data['SelfDriveCarsDetails']=array("no vehicles available in this date");
				}
					
				echo json_encode($data);
				}
				
	}
	
		public  function actionSelfDriveDetails()
	{
				$images=Yii::app()->db->createCommand("SELECT sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`, 
				sfd.`model_id`, sfd.`seating_capacity`,sfd.`price_per_hour`,sfd.`price`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`from_date`,sfd.`to_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd")->queryAll();
				foreach($images as $image)
							{
						$imgcode['selfdrive'][]=$image['img_path'];//encode
						
			}
			print_r($imgcode);

		
	}
	public function actionSelfdriveFilters()
	{
				$fromdate= $_GET['from_date'];
				  $todate= $_GET['to_date'];
				   $d=strtotime($fromdate);
				
					 $vehicle_type = $_GET['vehicle_type'];
				  $t=strtotime($todate); 
				  $category= $_GET['vehicle_category'];
		if(isset($_GET['from_date'])&&isset($_GET['to_date'])&&isset($_GET['vehicle_category'])&&isset($_GET['vehicle_type']))
				{
					$getdataself=Yii::app()->db->createCommand("SELECT 
		sfd.imagespath,sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`,mvm.makes_name, mvmm.models_name,
				sfd.`model_id`, sfd.`seating_capacity`,sfd.`location`,sfd.`lat`,sfd.`lon`,sfd.`price_per_hour`,sfd.`price`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`from_date`,
				sfd.`to_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd,MPS_VEHICLE_MAKES as mvm,MPS_VEHICLE_MODELS as mvmm where sfd.makes_id=mvm.makes_id and sfd.model_id=mvmm.models_id and sfd.vehicle_type='car' and sfd.vehicle_category='$category' and from_date<='$d' and to_date>='$d'")->queryAll();
				
				/* print_r($getdataself);
				exit; */
				if(!empty($getdataself)){
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
						'location'=>$value['location'],
						'lat'=>$value['lat'],
						'lon'=>$value['lon'],
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
					
						echo json_encode($data);
						
										
						}
					}else
					{
						echo "no Data Available";
					}
				}else
				{
					echo  "Invalid parameters";
				
				}
			
	}
	
	public function actionSelfdrivemobileBook()
	{
		if(isset($_REQUEST['selfdrive_id'])&&isset($_REQUEST['user_id'])&&isset($_REQUEST['amount'])&&isset($_REQUEST['from_date'])&&isset($_REQUEST['to_date']))
			{
						$userid=$_REQUEST['user_id'];
						$mechanicid=$_REQUEST['selfdrive_id'];
						$sid=$_REQUEST['id'];
						$location=$_REQUEST['bookloc'];	
						$amount=$_REQUEST['amount'];
						$fromdate=$_REQUEST['from_date'];
						$todate=$_REQUEST['to_date'];
				$self_details=Yii::app()->db->createCommand("SELECT * from MPS_CUSTOMER_INFO where id='$userid'")->queryAll();
				$models=Yii::app()->db->createCommand("SELECT * FROM SLD_ADD_VEHICLE where id='$mechanicid'")->queryAll();
				
				if(!empty($models)&&!empty($self_details))
				{
												
						$gettransaction=Yii::app()->db->createCommand("SELECT book_id FROM selfdrive_bookings ORDER BY id DESC LIMIT 1")->queryAll();
						$gid=$gettransaction[0]['book_id'];
						$egid=explode('SLD',$gid);
						$bid=$egid[1]+1;
						$modeladddel=new SelfdriveBookings();
						
						$modeladddel->book_id='SLD'.$bid;
						$modeladddel->user_id=$userid;
						$modeladddel->amount=$amount;
						$modeladddel->vehicle_id=$mechanicid;
						$modeladddel->fromdate=$fromdate;
						$modeladddel->todate=$todate;
						$modeladddel->save(); 
						$bookid=$modeladddel->book_id;
						if($modeladddel->save())
						{
							$book_id=$modeladddel->book_id;
							
							$getdetails=Yii::app()->db->createCommand("SELECT * FROM selfdrive_bookings where book_id='$bookid'")->queryAll();
							$amount=$getdetails[0]['amount'];
							$date=date('d-m-Y h:m',strtotime($getdetails[0]['created_date']));
							
								$bookdetails=array("book_id"=>$book_id,"amount"=>$amount,"bookdate"=>$date,"Vehicle type"=>$models[0]['vehicle_type']);
								 echo json_encode($bookdetails);
						}
						else
						{
							echo "not inserted";
						}
						
					
				}
				else
				{
					echo "Invalid User Id or mechanic id";
				}
			}
			else
			{
				echo "Invalid parameters";
			}
	}
}