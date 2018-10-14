<?php

class HIREAMECHANICController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
public function actionHireMechanicDetail()
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
	public function actiongetIds()
	{ 
		$id=$_POST['roleval'];
	 	if($id>4)
		{
					$rawData=Yii::app()->db->createCommand("SELECT max(hire_mechanic_id) as self_unique_id,id as id
					FROM HIRE_A_MECHANIC where role_id = $id")->queryAll();
					$shop_unique_id=$rawData[0]['id'];

					//$dlbshopid=explode('dlb',$shop_unique_id);
					/* 	if(!isset($shop_unique_id))
					{
					echo $shop_unique_id='HMC001'; 
					}
					else
					{ */

					/* $shop_unique_id=explode('HMC',$shop_unique_id);
					if($shop_unique_id[1]=='0010'){
					$sp= 10+1; 
					}else
					{

					} */
					$sp= $shop_unique_id+1; 
					echo 'HMC00'.$sp;
		} 
		
	} 

	
	public function actionFetchHireData()
	{
		Yii::app()->session['sleep'] =Yii::app()->request->baseUrl;
		$message='';
		if(isset($_POST['addhire']))
		{
			$model=new HIREAMECHANIC();
			$model->id=$this->id;
			$model->hire_mechanic_id=$_POST['hire_mechanic_id'];
			$model->role_id=$_POST['hroletype'];
			$model->location=$_POST['name'];
			$lotlat=$_POST['location'];
			$latarray=explode(',',$lotlat);
			
			$model->lag=$latarray[0];
			$model->lat=$latarray[1];
			
			$model->vehicle_type=$_POST['vehicle_type'];
			if(isset($_POST['profesional'][0]))
			{
					foreach($_POST['profesional'] as $vehicle_cat )
					{
						
					$model->profesional.=$vehicle_cat.'/';
					
					}
			}
			else
			{
				$model->profesional=$_POST['profesional'];
			}
				$model->booking_charge=$_POST['booking_charge'];
				$model->name=$_POST['mechanic_name'];
				$model->mobileno=$_POST['mobile_no'];
				$model->email=$_POST['email'];
				$model->company_name=$_POST['company_name'];
				$model->Year_of_exp=$_POST['year_of_exp'];
				$model->address=$_POST['address'];
				$model->description=$_POST['description'];
				$idproof= Yii::app()->request->baseUrl;
				$url=$_SERVER['DOCUMENT_ROOT']."$idproof/images/hiremechanic/";
				$urlsaved="images/hiremechanic/".basename($_FILES['upload_pic']['tmp_name']);
				$uploadfile = $url.basename($_FILES['upload_pic']['tmp_name']);
				move_uploaded_file($_FILES['upload_pic']['tmp_name'], $uploadfile);
				
				$image=file_get_contents($uploadfile);
				$encrypted=base64_encode($image);
				$model->upload_pic_path=$urlsaved;
				$model->upload_pic=$encrypted;
				$url1="images/hiremechanic/";
				$uploadfile1 = $url1.basename($_FILES['work_cerftificate']['tmp_name']);
				$url1saved="/images/hiremechanic/".basename($_FILES['work_cerftificate']['tmp_name']);
				move_uploaded_file($_FILES['work_cerftificate']['tmp_name'], $uploadfile1);
				$image1=file_get_contents($uploadfile1);
	
				$encrypted1=base64_encode($image1);	
				$model->work_certificate_path=$uploadfile1;
				$model->work_certificate_pic=$encrypted1;		
	
			$url2="images/hiremechanic/";
			$uploadfile2 = $url.basename($_FILES['id_proof']['tmp_name']);
			move_uploaded_file($_FILES['id_proof']['tmp_name'], $uploadfile2);
			$image2=file_get_contents($uploadfile2);
			$encrypted2=base64_encode($image2);
			$model->id_proof_path=$uploadfile2;
			$model->id_proof=$encrypted2;		
			$model->save();
			$message="Sucessfully Registered";
		}
			$self_details=Yii::app()->db->createCommand("SELECT sfd.`id`,sfd.`hire_mechanic_id`,sfd.`role_id`,sfd.`vehicle_type`,sfd.`profesional`,sfd.`booking_charge`, 
			sfd.`name`, sfd.`mobileno`,sfd.`created_date`,sfd.`email`,sfd.`upload_pic_path`,sfd.`company_name`,sfd.`Year_of_exp`,sfd.`work_certificate_path`,sfd.`id_proof_path`,sfd.`address` FROM `HIRE_A_MECHANIC` as sfd")->queryAll();
	
		$this->render('../mPSUserRegistration/manageHireMechanics',array('self_details'=>$self_details,"message"=>$message));
		
	}
	public function actionDeletehire()
	{
		$id=$_POST['id'];
		$delsql='DELETE FROM HIRE_A_MECHANIC WHERE id='.$id.'';
		$res = Yii::app()->db->createcommand($delsql)->execute();
	}
	public function actionUpdateHire()
	{
		$id=$_POST['id'];
		$self_details=Yii::app()->db->createCommand("SELECT * FROM `HIRE_A_MECHANIC` where id='$id'")->queryAll();
		echo json_encode($self_details);
        die;
	}
	public function actionUpdatehiredata()
	{
		 if(isset($_POST['updateHired']))
			{
				
				$updateuser =HIREAMECHANIC::model()->findByPk($_POST['id']);
			
		
			 $updateuser->booking_charge=$_POST['booking_charge'];
			 $updateuser->name=$_POST['name'];
			 $updateuser->mobileno=$_POST['mobileno'];
			 $updateuser->email=$_POST['email'];
			 $updateuser->company_name=$_POST['company_name'];
			 $updateuser->Year_of_exp=$_POST['Year_of_exp'];
			 $updateuser->location=$_POST['location'];
			 $updateuser->update();
			 $message="Update Sucessfully";
			}
			$self_details=Yii::app()->db->createCommand("SELECT * FROM `HIRE_A_MECHANIC`")->queryAll();
			$this->render('../mPSUserRegistration/manageHireMechanics',array('self_details'=>$self_details,"message"=>$message));
		 
	}
	//services
			
		
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
			public function actionHireMechanicDetailsByLocation()
		{
			  $lat=$_POST['lat'];
			  //$long=$_POST['long'];17.399272
			  $long=$_POST['long'];
			  $veh_type=$_POST['vehicle_type'];
			  $mechanicdetailsbyLoc=Yii::app()->db->createCommand("SELECT 
			  `id`, `hire_mechanic_id`,`vehicle_type`, `profesional`, `booking_charge`, `name`, `mobileno`, `email`,upload_pic_path,  `company_name`, `Year_of_exp`, `address`, `description`, `location`, (
				3959 * acos (
				  cos ( radians($lat) )
				  * cos( radians( lag ) )
				  * cos( radians( lat ) - radians($long) )
				  + sin ( radians($lat) )
				  * sin( radians( lag ) )
				)
				  ) AS distance
				FROM HIRE_A_MECHANIC 
				HAVING distance < 100 and vehicle_type='$veh_type'
				ORDER BY distance
				LIMIT 0 , 10")->queryAll();
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
				else
				{
					echo 'No Data Available';
				}
		}
		public function actionHireBookings()
		{
			
			 $userData=Yii::app()->db->createCommand("SELECT * from MPS_CUSTOMER_INFO")->queryAll();
			 $models=Yii::app()->db->createCommand("SELECT book.status,hire.hire_mechanic_id,book.book_id,book.userid,book.amount,book.billingaddrs,book.location,book.created_date,hire.vehicle_type,hire.name FROM HIRE_A_MECHANIC as hire,hire_mechanic_trans as book where book.mechanic_id=hire.id")->queryAll();
			$this->render("hirebookreports",array("users"=>$userData,"BookingDetails"=>$models));
		}
		public function actionhirebook()
		{
			if(isset($_REQUEST['mechanic_id'])&&isset($_REQUEST['user_id']))
			{
				$userid=$_REQUEST['user_id'];
				$mechanicid=$_REQUEST['mechanic_id'];
				$self_details=Yii::app()->db->createCommand("SELECT * from MPS_CUSTOMER_INFO where id='$userid'")->queryAll();
				$models=Yii::app()->db->createCommand("SELECT * FROM HIRE_A_MECHANIC where id='$mechanicid'")->queryAll();
				
				if(!empty($models)&&!empty($self_details))
				{
						
						$gettransaction=Yii::app()->db->createCommand("SELECT book_id FROM hire_mechanic_trans ORDER BY id DESC LIMIT 1")->queryAll();
						$gid=$gettransaction[0]['book_id'];
						$egid=explode('HIRE',$gid);
						$bid=$egid[1]+1;
						$modeladddel=new HireMechanicTrans();						
						$modeladddel->book_id='HIRE'.$bid;
						$modeladddel->userid=$userid;
						$modeladddel->amount=$models[0]['booking_charge'];
						$modeladddel->mechanic_id=$models[0]['id'];
						$modeladddel->location=$models[0]['location'];						
						$modeladddel->status=1;						
						$modeladddel->save(); 
						if($modeladddel->save())
						{
							$book_id=$modeladddel->book_id;
							
							$getdetails=Yii::app()->db->createCommand("SELECT * FROM hire_mechanic_trans where book_id='$book_id'")->queryAll();
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