<?php

class MpsbookserviceController extends Controller
{
		public function actionIndex()
	{
		$this->render('index');
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
	public function actiongetcarLogos()
	{
		if(isset($_GET['vehicle_type']))
		{
				$veh_type = $_GET['vehicle_type'];
				if($veh_type == 'car')
				{
						$logosDetails=Yii::app()->db->createCommand("SELECT  distinct MPS_VEHICLES.logo_img, MPS_VEHICLE_MAKES.makes_name,
						MPS_VEHICLES.makes_id FROM `MPS_VEHICLE_MAKES`,MPS_VEHICLES where MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id and MPS_VEHICLES.status=0 and MPS_VEHICLES.veh_type ='$veh_type'  group by  MPS_VEHICLES.makes_id ")->queryAll();
						
						
						$i=0;
						//echo '<pre>';
						foreach($logosDetails as $logosDetail=>$logosDeta)
						{
							
							
							$arrCarLogos['VehicleBrand'][] = $logosDeta;
							
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
				}
				else
				{
					   $vbikemodels=Yii::app()->db->createCommand("SELECT brand_id,brand_name, brand_logo_path, brand_logo_img FROM bike_brands")->queryAll();
						
						
						$i=0;
						//echo '<pre>';
						foreach($vbikemodels as $vbikemodel=>$BikeData)
						{
							
							
							$arrBikeLogos['VehicleBrand'][] = $BikeData;
							
							$i++;
						}
						if(empty($arrBikeLogos))
						{
							echo 'No Data Available';
						}
						else{
							
						$endata=json_encode($arrBikeLogos);
						print_r($endata);
						}
				}
		}
		exit;
		
		
		
	}
		public function actionGetVehicleModels()
	{
		
		$makes_id=$_GET['makes_id'];
		if(isset($_GET['vehicle_type']))
		{
				$veh_type = $_GET['vehicle_type'];
				if($veh_type == 'car')
				{
					$carImageDetails=Yii::app()->db->createCommand("SELECT distinct MPS_VEHICLE_MODELS.models_id,MPS_VEHICLES.car_img as car_img,MPS_VEHICLE_MODELS.models_name,MPS_VEHICLE_MAKES.makes_name
										 FROM MPS_VEHICLES,MPS_VEHICLE_MODELS,MPS_VEHICLE_MAKES where MPS_VEHICLES.models_id=MPS_VEHICLE_MODELS.models_id 
										 and MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id and MPS_VEHICLES.status=0 and MPS_VEHICLES.makes_id=$makes_id")->queryAll();
					
					
					
				
				
					foreach($carImageDetails as $carImageDetail=>$carData)
					{
						
						
						$arrCarImages['CarImages'][] =$carData;
						
						
					}
					
					
					if(empty($arrCarImages))
					{
						echo 'No Data Available';
					}
					else{
					 echo $endata=json_encode($arrCarImages);
					
					}
				}
				else{
					
					$vbikemodels=Yii::app()->db->createCommand("SELECT bike_model_id, brand_id,bike_model_name,bike_model_img_path FROM bike_models WHERE brand_id=$makes_id")->queryAll();
					
					
					
				
				
					foreach($vbikemodels as $vbikemodel=>$BikeData)
					{
						
						
						$arrBikeImages['BikeModels'][] =$BikeData;
						
						
					}
					
					
					if(empty($arrBikeImages))
					{
						echo 'No Data Available';
					}
					else{
					 echo $endata=json_encode($arrBikeImages);
					
					}
					
					
				}
		}
		
		exit;
		 
		
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
		
		//echo  $makes_id.'**'.$vehicle_type.'**'.$model_id.'**'.$variant.'**'.$year.'**'.$lastservice_on.'**'.$vehicle_age.'**'.$regno;
		if($vehicle_type == 'car')
		{
		$getcat_ids=Yii::app()->db->createCommand("SELECT category_id FROM `MPS_VEHICLES`
					WHERE makes_id=$makes_id and models_id=$model_id")->queryAll();
					foreach($getcat_ids as $getcat_id)
					{
						$getcat=$getcat_id['category_id'];
					}
		}
		else{
			
			$getcat_bike_ids=Yii::app()->db->createCommand("SELECT `bike_model_id` `brand_id`, `category_id` FROM `bike_models` WHERE `bike_model_id`=$model_id and `brand_id`=$makes_id")->queryAll();
					foreach($getcat_bike_ids as $get_bike_id)
					{
						$getcat=$get_bike_id['category_id'];
					}
		}
		
		 $getcount=Yii::app()->db->createCommand("SELECT `id` FROM `MPS_VEHICLE_DETAILS` 
					WHERE makes_id=$makes_id and model_id=$model_id")->queryAll();
					
			if(count($getcount) < 1)
				{ 
	
					$model=new MPSVEHICLEDETAILS();	
					$model->makes_id=$makes_id;
					$model->vehicle_type="$vehicle_type";
					$model->category_id=$getcat;
					$model->model_id=$model_id; 
					$model->variant=$variant;
					$model->year=$year;
					$model->lastserviceon="$lastservice_on";
					$model->veh_distance=$vehicle_age;
					$model->reg_no=$regno;
					$model->save();
					
					 if($model->save())
					{
						 $lastid=$model->id;
					} 
					
					$arr=array("Response"=>"Add vehicle Successfully","Regid"=>$lastid);
					echo json_encode($arr);
				}
				 else{
					$arr=array("Response"=>"error","Regid"=>$lastid);
					echo json_encode($arr);
				}  
				
		//exit;
		
		
		
		
		
	}
	
	 public function actionCustomerRegistration()
			{
			
			
			$Usernmame=$_POST['regemail'];
			$mobNo=$_POST['mobNo'];
			$uname=$_POST['uname']; 
			$upwd=$_POST['upwd'];
			$repwd=$_POST['repwd'];
			$verifyid=$_POST['verifyid'];
			/*$Usernmame='ggjgjkjk@gmail.com';
			$upwd='abc';
			$repwd='abc';
			$mobNo=8801855576;
			$uname='beena'; 
			$verify=$_POST[''];*/
			 $getusercount=Yii::app()->db->createCommand("SELECT `id` FROM `MPS_CUSTOMERACC_INFO` 
					WHERE username='$Usernmame'")->queryAll();
			if(strcmp($upwd, $repwd) !== 0)
			{
				$arry=array("Status"=>1,"Response"=>'Password and Retype password is mismatched');
			    echo json_encode($arry);
			}				
			else if(count($getusercount)<=0 && strcmp($upwd, $repwd) == 0)
			{	
			
			$MPSCUSTOMERINFO=new MPSCUSTOMERINFO();	
			$MPSCUSTOMERINFO->username=$uname;
			$MPSCUSTOMERINFO->emailid=$Usernmame; 
			$MPSCUSTOMERINFO->mobile_no=$mobNo; 
			$MPSCUSTOMERINFO->status=$verifyid; 
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
			$arry=array("Status"=>0,"Response"=>'Success',"lastid"=>$lastid,"user_name"=>$uname,"emailid"=>$Usernmame,"mobileno"=>$mobNo);
			echo json_encode($arry);
			}
			else{
				$arry=array("Status"=>1,"Response"=>'Email ID already exist');
			    echo json_encode($arry);
			}
			
			
			/* else{
			
			$mobNo=$_POST['mobNo'];
			//$mobNo=8801855576;
			$otppewd=mt_rand(100000, 999999);
			$this->actionVerify($mobNo,$otppewd);
			} */
			
			}
			public function actionUserStatus()
			{
				
			}
		public function actionSaveInput()
		{
				$getBookid=Yii::app()->db->createCommand("SELECT bookid FROM MPS_PACKAGEWISE_AMT_DETAILS ORDER BY id DESC LIMIT 1")->queryAll();
				
				if(count($getBookid)>0)
				{
					foreach($getBookid as $Book_id)
					{
						$bookid=$Book_id['bookid']+1;
						
					}
				}
				else{
					$bookid='100000001';
				}
				 $service_name=$_POST['service_name'];
				 $service_id=$_POST['service_id'];
				 
				 $uname=$_POST['username'];
				 $mobileno=$_POST['mobile_no'];
				 $emailid=$_POST['emailid'];
				 
				 $plan_name=$_POST['plan_name'];
				 $pkid=$_POST['pkid'];
				 $userid=$_POST['userid'];
			     $model_id=$_POST['model_id'];
				 $makes_id=$_POST['makes_id'];
				 $repairid=$_POST['repair_id'];
				 $veh_type=$_POST['veh_type']; 
				 $amount=$_POST['amount'];
				 $pickadrs=$_POST['pickadrs'];
				 $pickdate=$_POST['pickdate'];
				 $pickhr=$_POST['pickhr']; 
			     $categoryid=$_POST['category_id'];
				 $addinfo=$_POST['addinfo']; 
				 
				 
				 //$bookid='BOK'.rand(1111111111,9999999999);
				//echo $model_id.'**'. $makes_id.'**'. $planid.'**'.$categoryid;
				//exit;
				
			    $MPSpak=new MPSPACKAGEWISEAMTDETAILS();
				$MPSpak->bookid=$bookid;
				$MPSpak->service_name=$service_name;
				$MPSpak->service_id=$service_id;
				$MPSpak->plan_name=$plan_name;
				
				$MPSpak->f_name=$uname;
				$MPSpak->emailid=$emailid;
				$MPSpak->mobno=$mobileno;
				
				
				$MPSpak->planid=$pkid;
				$MPSpak->userid=$userid;
				$MPSpak->model_id=$model_id;
				$MPSpak->makes_id=$makes_id;
				$MPSpak->repairid=$repairid;
				$MPSpak->vehicle_type=$veh_type;
				$MPSpak->amout=$amount; 
				$MPSpak->pickadrs=$pickadrs; 
				$MPSpak->pickdate=$pickdate;
				$MPSpak->pickhr=$pickhr; 
				$MPSpak->status=1; 
				$MPSpak->categoryid=$categoryid; 
				$MPSpak->addinfo=$addinfo; 
				$MPSpak->save(); 
				
				$book_details=array("Response"=>"Successfully Inserted","bookid"=>$bookid,"service_name"=>$service_name);
				echo json_encode($book_details);
		}
		public function actionFinalBooking()
		{
			$userid=$_POST['userid'];
			$bookid=$_POST['bookid'];
			
			$getcount2=Yii::app()->db->createCommand("update  MPS_PACKAGEWISE_AMT_DETAILS set status=1 WHERE userid=$userid and bookid='$bookid'")->execute();
		    $response=array("status"=>"Booked successfully");
			echo json_encode($response);
			
		}
			public function actionVerify($mobile,$ot)
			 {
				 $authKey = "115157AMKmh06wPVxg57566184";

				//Multiple mobiles numbers separated by comma
				$mobileNumber =$mobile;


				//Sender ID,While using route4 sender id should be 6 characters long.
				$senderId = "VERIFY";

				//Your message to send, Add URL encoding here.
				$message = urlencode($otp." is your verification code");

				//Define route 
				$route = 4;

				//Prepare you post paramete
				$postData = array(
					'authkey' => $authKey,
					'mobiles' => $mobileNumber,
					'message' => $message,
					'sender' => $senderId,
					'route' => $route
				);

				//API URL
				$url="https://control.msg91.com/api/sendhttp.php";

				// init the resource
				$ch = curl_init();
				curl_setopt_array($ch, array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => $postData
					//,CURLOPT_FOLLOWLOCATION => true
				));


				//Ignore SSL certificate verification
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


				//get response
				 $output = curl_exec($ch);
				 if(!empty($output))
				 {
					 $arry=array("Status"=>0,"Response"=>'OTP has sent to your mobile');
					 echo json_encode($arry);
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
	
	public function actionFetchPeriodicService()
	{
		 $getDetails=Yii::app()->db->createCommand("SELECT  `package`,`pkname`, `packageid` FROM `MPS_SERVICE_PACKAGE_DETAILS` WHERE `packageid` in (4,5,6,7,8,9,10,11,12)")->queryAll();
		 $arr=array();
					foreach($getDetails as $getDetai)
					{
						$arr['Periodic Details'][]=$getDetai;//encode
						
				
					}
					echo json_encode($arr);
		 
	}
	public function actionLogin()//User login
	     {
			 
				 $uname=$_POST['uname'];
				 $password=$_POST['password'];
				 
				 $getpassword=Yii::app()->db->createCommand("SELECT `loginid`, `username`, `password`, `status` FROM `MPS_CUSTOMERACC_INFO` 
				 WHERE username='$uname' and password='".md5($password)."' and otp_status=1")->queryAll();
					 foreach($getpassword as $getpwd)
					{
						 $userid=$getpwd['loginid'];
						 $username=$getpwd['username'];
					}
				
					  $getunm=Yii::app()->db->createCommand("SELECT  `username`,`emailid`,`mobile_no` FROM `MPS_CUSTOMER_INFO` 
				      WHERE emailid='$uname'")->queryAll();
					  
					   foreach($getunm as $getun)
						{
							 $usname=$getun['username'];
							 $emailid=$getun['emailid'];
							 $mobileno=$getun['mobile_no'];
						}
					
					if(count($getpassword)>0)
					{
						$users_details=array("status"=>"Login Sucessfully","userid"=> $userid,"user_name"=>$usname,"emailid"=>$emailid,"mobileno"=>$mobileno);
						echo json_encode($users_details);
						
					}
					
					else
					{
						$users_details=array("status"=>"Invalid Login");
						echo json_encode($users_details);
					}
			 
				 
		 }
	
		public function actionMechanicShopLogin()
		{
			
			  $username=$_POST['username'];
			  $pwd=$_POST['password'];
			  
			 
			  $fetchdatas=Yii::app()->db->createCommand("SELECT b.id,a.shop_nm,a.shop_id,a.shopowner_nm,a.address,a.country,a.state,a.city,a.sector,a.contact_num,a.img_path, a.shop_img,a.count_service,a.status,a.created_date,a.latitude,a.longitude FROM shop_details as a, shopowner_details as b WHERE 
			  a.shop_id=b.shop_unique_id and b.username='$username' and b.password='".md5($pwd)."'")->queryAll();
			
				if(count($fetchdatas)>0)
				{
					
					foreach($fetchdatas as $fetchdata)
					{
						 $userid=$fetchdata['id'];
						 $shop_nm=$fetchdata['shop_nm'];
						 $shopowner_nm=$fetchdata['shopowner_nm'];
						 $shop_id=$fetchdata['shop_id'];
						 $latitude=$fetchdata['latitude'];
						 $longitude=$fetchdata['longitude'];
						 if(empty($latitude) || empty($longitude))
							 {
								 $latitude  = 0.00;
								 $longitude = 0.00;
							 }
					}
					
						$users_details=array("Status"=>1,"Response"=>"Login Sucessfully","userid"=>$userid,"shop_id"=>$shop_id,"shop_nm"=>$shop_nm,"shop_owner_nm"=>$shopowner_nm,"longitude"=>$latitude,"latitude"=>$longitude);
						echo json_encode($users_details);
					
				
				
					
				}
				else{
					
					
					$fetchdeldatas=Yii::app()->db->createCommand("SELECT b.latitude,b.longitude,b.shop_id,b.del_nm,b.delv_id FROM  shopowner_details as a, delv_details as b WHERE 
						a.shop_unique_id=b.delv_id and a.username='$username' and a.password='".md5($pwd)."'")->queryAll();
					if(count($fetchdatas)>0)
					{
						$users_details=array("Status"=>0,"Response"=>"Invalid Login");
						echo json_encode($users_details);
					}
					else if(count($fetchdeldatas)>0)
					{
						foreach($fetchdeldatas as $fetchdel)
						{
							 $del_nm=$fetchdel['del_nm'];
							 $delv_id=$fetchdel['delv_id'];
							 $del_shop_id=$fetchdel['shop_id'];
							 $latitude=$fetchdel['latitude'];
							 $longitude=$fetchdel['longitude'];
							if(empty($latitude) || empty($longitude))
							 {
								 $latitude  = 0.00;
								 $longitude = 0.00;
							 }
							
						}
						$users_details=array("Status"=>1,"Response"=>"Login Sucessfully","del_shop_id"=>$del_shop_id,"delv_id"=>$delv_id,"del_nm"=>$del_nm,"longitude"=>$latitude,"latitude"=>$longitude);
						echo json_encode($users_details);
					}
					else
					{
						$users_details=array("Status"=>0,"Response"=>"Invalid Login");
						echo json_encode($users_details);
					}
				}
			 
			
		 } 
		 public function actionUpdateDeliveryBoyStatus()//update
		{
			 $bookid=$_POST['bookid'];
			 $delv_id=$_POST['delv_id'];
			
			//$mech_p=$_POST['mech_person_Id'];
			$getcount2=Yii::app()->db->createCommand("update MPS_PACKAGEWISE_AMT_DETAILS set delv_status=1   WHERE bookid='$bookid' and delv_id='$delv_id'")->execute(); 
			$array=array("Response" =>"updated");
			echo json_encode($array); 
		}
		public function actionStartServicingStatus()
		{
			 $bookid=$_POST['bookid'];
			 $delv_id=$_POST['delv_id'];
			 $shopid=$_POST['shopid'];
			 $servicetime=$_POST['servicetime'];
			 
			$getcount2=Yii::app()->db->createCommand("update MPS_PACKAGEWISE_AMT_DETAILS set serviceon=1,servicetime='$servicetime'   WHERE bookid='$bookid' and delv_id='$delv_id' and mechp_id='$shopid'")->execute(); 
			$array=array("Response" =>"Service Started");
			echo json_encode($array); 
		}
		public function actionDelBoyVehicleCollectedStatus()
		{
			 $bookid=$_POST['bookid'];
			 $delv_id=$_POST['delv_id'];
			
			//$mech_p=$_POST['mech_person_Id'];
			$getcount2=Yii::app()->db->createCommand("update MPS_PACKAGEWISE_AMT_DETAILS set pickup_tatus=1   WHERE bookid='$bookid' and delv_id='$delv_id'")->execute(); 
			$array=array("Response" =>"Vehicle Collected");
			echo json_encode($array); 
		}
		public function actionDeliveryBoyAssignDetails()
		{
			$delvid=$_POST['delv_id'];
			$fetchdataDel=Yii::app()->db->createCommand("SELECT  distinct a.bookid,a.model_id,b.models_name,c.makes_name,a.makes_id,a.service_name,a.plan_name, a.amout,a.timestamp,a.pickadrs,e.car_img,a.status,max(a.timestamp) FROM MPS_PACKAGEWISE_AMT_DETAILS as a,MPS_VEHICLE_MODELS as b,MPS_VEHICLE_MAKES as c,MPS_CUSTOMER_INFO as mci,MPS_CUSTOMERACC_INFO as mcc,MPS_VEHICLES as e WHERE  b.models_id=a.model_id and c.makes_id=a.makes_id and mcc.loginid=a.userid and e.models_id=a.model_id and a.status=1 and a.delv_status=0 and a.mech_status=1 and a.assignstatus=1 and a.delv_id='$delvid'")->queryAll();
	
	 
					foreach($fetchdataDel as $value)
					{
						//encode
						$arr2['PickBoy Details'][]=$value;
					}
				$getCount=Yii::app()->db->createCommand("SELECT count(a.status) as pickupcount FROM MPS_PACKAGEWISE_AMT_DETAILS as a where a.status=1 and a.mech_status=1 and a.delv_status=1")->queryAll();
				foreach($getCount as $getCou)
					{
						//encode
						$arr2['pickboy']=$getCou['pickupcount'];
					}						
				
					
					$data=array("DelBoys Details"=>$arr2);
					echo json_encode($data);
		}
	public function actionAddVehiclesAddedLists()
	{ 
		$images=Yii::app()->db->createCommand("SELECT distinct mvd.category_id,mvd.makes_id,mvd.model_id,mvd.id as regid,mvd.variant, mvd.vehicle_type, mvd.year, mvd.lastserviceon, mvd.veh_distance, mvd.reg_no,mvv.car_img,mvm.makes_name as make_name,mvmod.models_name as model_name FROM `MPS_VEHICLE_DETAILS` as mvd,MPS_VEHICLES as mvv,MPS_VEHICLE_MAKES as mvm, MPS_VEHICLE_MODELS as mvmod WHERE

		mvd.makes_id=mvv.makes_id and mvv.models_id=mvd.model_id and mvm.makes_id= mvd.makes_id and mvmod.models_id=mvd.model_id")->queryAll();
	  
	    
		
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
	public function actionMechanicTransUserInfo()
	{
		
		$makes_id=$_POST['makes_id'];
		$model_id=$_POST['model_id'];
		$bookid=$_POST['bookid'];
		$fetchdata=Yii::app()->db->createCommand("SELECT  mpa.userid,mpa.f_name,mpa.emailid,mpa.mobno,mpa.pickadrs,mpa.vehicle_type,mvd.lastserviceon FROM MPS_PACKAGEWISE_AMT_DETAILS as mpa,MPS_VEHICLE_DETAILS as mvd WHERE mpa.makes_id=mvd.makes_id and mpa.model_id=mvd.model_id and mpa.makes_id=$makes_id and mpa.model_id=$model_id and  mpa.bookid='$bookid'")->queryAll();
		foreach($fetchdata as $value)
				{
					$cust_details=$value;
				}
		$array=array("Customer Details" => $cust_details);
		echo json_encode($array); 
	}
	public function actionFetchBookingDetails()//for mechanic booking details
	 {
		
		
		$fetchdata=Yii::app()->db->createCommand("SELECT  distinct a.vehicle_type,a.bookid,a.model_id,b.models_name,c.makes_name,a.makes_id,a.service_name,a.plan_name, a.amout,a.timestamp,a.pickadrs,e.car_img,a.status,max(a.timestamp) FROM MPS_PACKAGEWISE_AMT_DETAILS as a,MPS_VEHICLE_MODELS as b,MPS_VEHICLE_MAKES as c,MPS_CUSTOMER_INFO as mci,MPS_CUSTOMERACC_INFO as mcc,MPS_VEHICLES as e WHERE  b.models_id=a.model_id and c.makes_id=a.makes_id and mcc.loginid=a.userid and e.models_id=a.model_id and a.status=1 and a.mech_status=0  group by a.id")->queryAll();
		/* $fetchdata1=Yii::app()->db->createCommand("SELECT  distinct a.vehicle_type,a.bookid,c.bike_model_id,c.bike_model_name,b.brand_name,b.brand_id,a.service_name,a.plan_name, a.amout,a.timestamp,a.pickadrs,c.bike_model_img_path,a.status,max(a.timestamp) FROM MPS_PACKAGEWISE_AMT_DETAILS as a,bike_brands as b,bike_models as c,MPS_CUSTOMER_INFO as mci,MPS_CUSTOMERACC_INFO as mcc WHERE  c.bike_model_id=a.model_id and b.brand_id=a.makes_id and mcc.loginid=a.userid and a.vehicle_type='bike' and a.status=1 and a.mech_status=0  group by a.id")->queryAll(); */
   
	//$arr=array();
	//$arr1=array();
	 
					foreach($fetchdata as $value)
					{
						//encode
						$arr['Book Details'][]=$value;
					}
				$getCount=Yii::app()->db->createCommand("SELECT count(a.status) as TotalBooking FROM MPS_PACKAGEWISE_AMT_DETAILS as a where a.status=1 and a.mech_status=0")->queryAll();
				foreach($getCount as $getCou)
					{
						//encode
						$arr['TotalBooking']=$getCou['TotalBooking'];
					}
					
	//---------------------------------------
	$fetchdataongoing=Yii::app()->db->createCommand("SELECT  distinct a.bookid,a.model_id,b.models_name,c.makes_name,a.makes_id,a.service_name,a.plan_name, a.amout,a.timestamp,a.pickadrs,e.car_img,a.status,max(a.timestamp) FROM MPS_PACKAGEWISE_AMT_DETAILS as a,MPS_VEHICLE_MODELS as b,MPS_VEHICLE_MAKES as c,MPS_CUSTOMER_INFO as mci,MPS_CUSTOMERACC_INFO as mcc,MPS_VEHICLES as e WHERE  b.models_id=a.model_id and c.makes_id=a.makes_id and mcc.loginid=a.userid and e.models_id=a.model_id and a.status=1 and a.mech_status=1  group by a.id")->queryAll();
	
	 
					foreach($fetchdataongoing as $value)
					{
						//encode
						$arr1['OnGoing Details'][]=$value;
					}
				$getCount=Yii::app()->db->createCommand("SELECT count(a.status) as TotalBooking FROM MPS_PACKAGEWISE_AMT_DETAILS as a where a.status=1 and a.mech_status=1")->queryAll();
				foreach($getCount as $getCou)
					{
						//encode
						$arr1['OnGoing']=$getCou['TotalBooking'];
					}					
				
	//------------------------------------
				$fetchdataDel=Yii::app()->db->createCommand("SELECT dd.delv_id,dd.shop_id,dd.del_nm,dd.latitude,dd.longitude  FROM MPS_PACKAGEWISE_AMT_DETAILS as a, delv_details as dd WHERE  a.status=1 and a.mech_status=1 and a.delv_status=1 and a.assignstatus=1 and a.delv_id=dd.delv_id and a.mechp_id=dd.shop_id and a.mechp_id ='mse004' and a.delv_id='dlb002' and a.userid=9")->queryAll();
	
	 
					foreach($fetchdataDel as $value)
					{
						//encode
						$arr2['PickBoy Details'][]=$value;
					}
				$getCount=Yii::app()->db->createCommand("SELECT count(a.status) as pickupcount FROM MPS_PACKAGEWISE_AMT_DETAILS as a where a.status=1 and a.mech_status=1 and a.delv_status=1")->queryAll();
				foreach($getCount as $getCou)
					{
						//encode
						$arr2['pickboy']=$getCou['pickupcount'];
					}						
				
					
					$data=array("Booking Details"=>$arr,"On Going"=>$arr1,"DelBoys Details"=>$arr2);
					echo json_encode($data);
										
		 
	 }
	 public function actionFetchPickBoyStatusDetails()
	 {
		 //echo 'dngskgjsjd';
		 $mechp_id=$_POST['mechp_id'];
		 $userid=$_POST['userid'];
		 $bookid=$_POST['bookid'];
		 
		$fetchdataDel=Yii::app()->db->createCommand("SELECT dd.contact,a.delv_status,dd.delv_id,dd.shop_id,dd.del_nm,dd.latitude,dd.longitude  FROM MPS_PACKAGEWISE_AMT_DETAILS as a, delv_details as dd WHERE  a.status=1 and a.mech_status=1 and a.delv_status=1 and a.assignstatus=1 and a.delv_id=dd.delv_id and a.mechp_id=dd.shop_id and a.mechp_id ='$mechp_id' and a.bookid='$bookid' and a.userid=$userid")->queryAll();
	
	 
					 foreach($fetchdataDel as $value)
					 {
					
						 $arr2['PickBoy Details'][]=$value;
					 }
		 $array=array("PickBoy Del" => $arr2);
		 echo json_encode($array); 		
					
	 }
	 public function actionUpdateCurrentLocation()
	 {
		$latitude=$_POST['latitude'];
		$longitude=$_POST['longitude'];
		$delv_id=$_POST['delv_id'];
		$shop_id=$_POST['shop_id'];
		$fetchdata=Yii::app()->db->createCommand("UPDATE `delv_details` SET `latitude`='$latitude' ,`longitude`='$longitude'  WHERE `delv_id`='$delv_id' and `shop_id`='$shop_id'")->execute();
		$array=array("Response" => 'updated');
		echo json_encode($array); 
	 }
	 public function actionUserBookingDetails()//for User booking details
	 {
		$userid=$_POST['userid'];
		$bookid=$_POST['bookid'];
		$fetchdata=Yii::app()->db->createCommand("SELECT  a.model_id,b.models_name,c.makes_name,a.makes_id,a.service_name,a.plan_name, a.amout,a.timestamp,mci.location,e.car_img,
		a.status,a.mech_status,a.delv_status,a.mechp_id FROM MPS_PACKAGEWISE_AMT_DETAILS as a,MPS_VEHICLE_MODELS as b,MPS_VEHICLE_MAKES as c,MPS_CUSTOMER_INFO as mci,MPS_VEHICLES as e WHERE  b.models_id=a.model_id and (a.status=1 or a.mech_status=1) and  c.makes_id=a.makes_id and mci.id=a.userid and e.models_id=a.model_id and a.userid=$userid and a.bookid='$bookid'")->queryAll();
		
		
		
					$arr=array();
					foreach($fetchdata as $value)
					{
						//encode
						$arr=$value;
					    $mechp_id=$value['mechp_id'];//encode
						
						if(!empty($mechp_id))
						{
							$fetchMechanicData=Yii::app()->db->createCommand("SELECT `veh_type`,`shop_id`,`id`, `shop_nm`,`shopowner_nm`,`address`,`latitude`,`longitude` FROM `shop_details` WHERE `shop_id`='$mechp_id'")->queryAll();
							foreach($fetchMechanicData as $fetchMechanic)
							{   
								
								$arr1=$fetchMechanic;
								//$arr['Book Details']=$fetchMechanic;
							} 
						} 
						 
					}
					
					$data=array("Book Details" => $arr, "Shop Details" => $arr1);
					//echo json_encode($data);
					//print_r($data);
					//exit;
					 if(!empty($data))
					{
					echo json_encode($data);
					//print_r($arr);
					}
					else{
						$status=array("status"=>"No Data Available");
						echo json_encode($status);
					}
					//echo '<pre>';
					
										
		 
	 }
	 public function actionFetchDeliveryBoys()//for mechanic shop
	 {
		 
		    $shopid=$_POST['shopid'];
		    
			$fetchdata=Yii::app()->db->createCommand("SELECT  latitude,longitude,shop_id,del_nm,delv_id,contact,status FROM delv_details WHERE shop_id='$shopid'")->queryAll();
			$arr=array();
				foreach($fetchdata as $value)
				{
						if(empty($value['latitude']) || empty($value['longitude']))
							 {
								 $value['latitude']  = "0.00";
								 $value['longitude'] = "0.00";
							 }
						 $arr['PickBoy Details'][]=$value;//encode
						
				
				}
				echo json_encode($arr);
		 
	 }
	  public function actionFetchCustomerDetailsForMechanics()//for mechanic shop
	 {
		 
		    $delvid=$_POST['delvid'];
			$bookid=$_POST['bookid'];
		    
			$fetchdata=Yii::app()->db->createCommand("SELECT a.bookid,b.del_nm,b.delv_id,b.contact FROM MPS_PACKAGEWISE_AMT_DETAILS as a, delv_details as b
			WHERE a.delv_id='$delvid' and a.delv_id=b.delv_id AND a.delv_status =1 AND  a.bookid='$bookid'")->queryAll();
			$arr=array();
				foreach($fetchdata as $value)
				{
						
						 $arr['PickBoy Details'][]=$value;//encode
						
				
				}
				echo json_encode($arr);
		 
	 }
	 public function actionCustomerDetailsForPickupBoy()
	 {
		$bookid=$_POST['bookid'];
		$delv_id=$_POST['delv_id'];
		
		$fetchdata=Yii::app()->db->createCommand("SELECT  bookid, userid, f_name, emailid, mobno, pickadrs, vehicle_type, billingadrs, pickhr, pickdate, service_name,plan_name FROM MPS_PACKAGEWISE_AMT_DETAILS WHERE bookid='$bookid' and delv_id='$delv_id'")->queryAll();
		foreach($fetchdata as $value)
				{
					$cust_details=$value;
				}
		$array=array("Customer Details" => $cust_details);
		echo json_encode($array); 
	 }
	 public function actionFetchEachVehicleDetails()
	 {
		    $model_id=$_POST['model_id'];
		    $makes_id=$_POST['makes_id'];
			$fetchdata=Yii::app()->db->createCommand("SELECT  a.service_name,a.plan_name, a.amout,a.total,a.timestamp,mci.location,e.car_img,a.status FROM MPS_PACKAGEWISE_AMT_DETAILS as a,MPS_VEHICLE_MODELS as b,MPS_VEHICLE_MAKES as c,MPS_CUSTOMER_INFO as mci,MPS_VEHICLES as e WHERE  b.models_id=a.model_id and c.makes_id=a.makes_id and mci.id=a.userid and e.models_id=a.model_id and a.model_id=$model_id and a.makes_id=$makes_id and a.status=1")->queryAll();
					$arr=array();
					foreach($fetchdata as $value)
					{
						$arr['VehicleByDetails'][]=$value;//encode
						
				
					}
					echo json_encode($arr);
					//echo '<pre>';
					
										
		 
	 }
	 public function actionUpdateUserStatus()//mechanic shop accept status and update the mech_status as 1 for that login user
	 {
		 $bookid=$_POST['bookid'];
		 $mech_p=$_POST['mech_person_Id'];
		
		
	
		 $getcount2=Yii::app()->db->createCommand("update MPS_PACKAGEWISE_AMT_DETAILS set mech_status=1,mechp_id='$mech_p' WHERE bookid='$bookid' and status=1")->execute(); 
		 echo 'suc';
		 // $response=array("status"=>'1');
		 // echo json_encode($response);
	 }
	  public function actionUpdateAssignDeliveryBoyStatus()//kkk
	 {
		 $bookid=$_POST['bookid'];
		 $delv_id=$_POST['delv_id'];
		 $shopid=$_POST['shopid'];
	
		
		$getcount2=Yii::app()->db->createCommand("update MPS_PACKAGEWISE_AMT_DETAILS set assignstatus=1,delv_id='$delv_id' WHERE bookid='$bookid' and  mechp_id='$shopid'")->execute();
		//$getcount2=Yii::app()->db->createCommand("update MPS_PACKAGEWISE_AMT_DETAILS set assignstatus=1 , delv_id='$delv_id' WHERE bookid='$bookid'")->execute();
		$response=array("Response"=>'Success');
		echo json_encode($response);
	 } 
	  public function actionFetchUserTrackingStatus()
	 {
		
					 $bookid=$_POST['bookid'];
					 $userid=$_POST['userid'];
					 $fetchstatus=Yii::app()->db->createCommand("SELECT bookid,mech_status,timestamp FROM MPS_PACKAGEWISE_AMT_DETAILS
					 WHERE bookid = '$bookid' and userid=$userid and mech_status=1")->queryAll();
					 $arr=array();
					foreach($fetchstatus as $key=>$value)
					{
						$arr['UserStatus_Details'][]=$value;//encode
						
				    }
					//echo '<pre>';
					echo json_encode($arr);
				
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
	public function actionTest()
	{
		$servicesid=$_GET['service_id'];//service id
		$idd=$_GET['plan_id'];
		$models_id=$_GET['model_id'];
		
		//plan id example(basic,elite,advanced)
		//$models_id=$_GET['model_id'];//model id
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
			
			
			
			
			//-----------------------
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
						if(empty($basicamt))
						{
							$basicamt=0;	
						}
			//------------------------------------------------------
			
			
			$basicid=Yii::app()->db->createCommand("SELECT msr.repairid,mcd.sname,mcd.id,count(mcd.id) as amount FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$value=$idd group by mcd.id")->queryAll();
					
					//$data = array();
					$subvalues=array();
					$i=0;
					foreach($basicid as $basici)
					{
						 $id=$basici['id'];
						 $snm=$basici['sname'];
						 $repairids[]=$basiclist['repairid'];
						$basiclists=Yii::app()->db->createCommand("SELECT distinct msr.repairid,msr.sname,msr.subvalue FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$value=$idd and repairid =$id")->queryAll();
						 foreach($basiclists as $basiclist)
						{
							
							 
							 $data[$i][$basiclist['sname']][]=$basiclist['subvalue'];
							
							 
							  
							
						} 
						 $i++;
					}
					
				  
					
					$reps=implode(',',$repairids);
					//$basicamt["amout"]=$basicamt;
					//$servhr["Estimated Time"]=$servhr;
					//array_push($data,$basicamt,$servhr);
					
					$datas=array("$servicename"=>
						array(
					
						"$value" =>$data,
						"amout"=>$basicamt,
						"Estimated Time"=>$servhr,
						"Repairids"=>$reps
						
					
						),
						
					);
					
					echo '<pre>';
					//print_r($datas);
				echo json_encode($datas);
		}
		
		else{
			$servicename="Periodic Service";
			/* $idd=8;//plan id example(basic,elite,advanced)
			$models_id=59; */
			if($idd==4)
			{
				$value="one";
			}
			else if($idd==5)
			{
				$value="five";
			}
			else if($idd==6)
			{
				$value="ten";
			}
			else if($idd==7)
			{
				$value="twenty";
			}
			else if($idd==8)
			{
				$value="thirty";
			}
			else if($idd==9)
			{
				$value="fourty";
			}
			else if($idd==10)
			{
				$value="fifty";
			}
			else if($idd==11)
			{
				$value="sixty";
			}
			else if($idd==12)
			{
				$value="msixty";
			}
			
			
			  $GETCATEIDs=Yii::app()->db->createCommand("SELECT `category_id` FROM `MPS_VEHICLES` WHERE models_id=$models_id")->queryAll();
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
			
			$basicid=Yii::app()->db->createCommand("SELECT msr.repairid,mcd.sname,mcd.id,count(mcd.id) as amount FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$value=$idd group by mcd.id")->queryAll();
					
					//$data = array();
					$data['Recommended']= array();
					$i=0;
					$j=0;
					foreach($basicid as $basici)
					{
						 $id=$basici['id'];
						 $snm=$basici['sname'];
						
						
						 $count=Yii::app()->db->createCommand("SELECT id,repid  FROM MPS_RECOMENDED_SERVICE WHERE periodicstatus=10 and repid='$id' and 
			             pkid='$idd' and cat_id='$category_id'")->queryAll();
						
						 if(count($count) > 0)
						 {
							 
							 $basiclists=Yii::app()->db->createCommand("SELECT msr.repairid,msr.sname,msr.subvalue FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$value=$idd and repairid =$id")->queryAll();
							 foreach($basiclists as $basiclist)
							{
								
								// $recrepairids[]=$basiclist['repairid'];
								 $data['Recommended'][$i][$basiclist['sname']][]=$basiclist['subvalue'];
								
								  
								
							} 
							 $i++;
						 }
						 else{
							 
							
						$basiclists=Yii::app()->db->createCommand("SELECT msr.repairid,msr.sname,msr.subvalue FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$value=$idd and repairid =$id")->queryAll();
							 foreach($basiclists as $basiclist)
							{
								
								 //$sugrepairids[]=$basiclist['repairid'];
								 $data['Suggested'][$j][$basiclist['sname']][]=$basiclist['subvalue'];
								
								
								  
								
							} 
							$j++;
						 }
						
						 
					}
				    $recreps=implode(',',array_unique($recrepairids));
				    $sugreps=implode(',',array_unique($sugrepairids));
				
					
					if($value=='one')
					{
						$value1='1,000';
					}
					if($value=='five')
					{
						$value1='5,000';
					}
					if($value=='ten')
					{
						$value1='10,000';
					}
					if($value=='twenty')
					{
						$value1='20,000';
					}
					if($value=='thirty')
					{
						$value1='30,000';
					}
					if($value=='fourty')
					{
						$value1='40,000';
					}
					if($value=='fifty')
					{
						$value1='50,000';
					}
					if($value=='sixty')
					{
						$value1='60,000';
					}
					$data["amout"]=$basicamt;
					$data["Estimated Time"]=$servhr;
					//$data["RecRepairIds"]=$recreps;
					//$data["SugRepairIds"]=$sugreps;
					$datas=array("$servicename"=>array($data));
					echo '<pre>';
					print_r($datas);
					//echo json_encode($datas);
		}
		
	}
	public function actionVehicleRepairLists()
	{
		
		$servicesid=$_GET['service_id'];//service id
		$idd=$_GET['plan_id'];
		$models_id=$_GET['model_id'];
		
		//plan id example(basic,elite,advanced)
		//$models_id=$_GET['model_id'];//model id
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
			
			
			
			
			//-----------------------
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
						if(empty($basicamt))
						{
							$basicamt=0;	
						}
			//------------------------------------------------------
			
			
			$basicid=Yii::app()->db->createCommand("SELECT msr.repairid,mcd.sname,mcd.id,count(mcd.id) as amount FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$value=$idd group by mcd.id")->queryAll();
					
					//$data = array();
					$subvalues=array();
					$i=0;
					foreach($basicid as $basici)
					{
						$id=$basici['id'];
						$snm=$basici['sname'];
						$repairids[]=$basiclist['repairid'];
						$basiclists=Yii::app()->db->createCommand("SELECT distinct msr.repairid,msr.sname,msr.subvalue FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$value=$idd and repairid =$id")->queryAll();
						 foreach($basiclists as $basiclist)
						{
							
							 
							 $data[$i][$basiclist['sname']][]=$basiclist['subvalue'];
							
							 
							  
							
						} 
						 $i++;
					}
					
					
					$reps=implode(',',$repairids);
					
					//$basicamt["amout"]=$basicamt;
					//$servhr["Estimated Time"]=$servhr;
					//array_push($data,$basicamt,$servhr);
					
					$datas=array("$servicename"=>
						array(
					
						"$value" =>$data,
						"amout"=>$basicamt,
						"Estimated Time"=>$servhr,
						"Repairids"=>$reps
						
					
						),
						
					);
					
					//echo '<pre>';
					//print_r($datas);
				echo json_encode($datas);
		}
		
		else{
			$servicename="Periodic Service";
			/* $idd=8;//plan id example(basic,elite,advanced)
			$models_id=59; */
			if($idd==4)
			{
				$value="one";
			}
			else if($idd==5)
			{
				$value="five";
			}
			else if($idd==6)
			{
				$value="ten";
			}
			else if($idd==7)
			{
				$value="twenty";
			}
			else if($idd==8)
			{
				$value="thirty";
			}
			else if($idd==9)
			{
				$value="fourty";
			}
			else if($idd==10)
			{
				$value="fifty";
			}
			else if($idd==11)
			{
				$value="sixty";
			}
			else if($idd==12)
			{
				$value="msixty";
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
			
			$basicid=Yii::app()->db->createCommand("SELECT mcd.sname,mcd.id,count(mcd.id) as amount FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$value=$idd group by mcd.id")->queryAll();
					
					//$data = array();
					$data['Recommended']= array();
					$i=0;
					$j=0;
					foreach($basicid as $basici)
					{
						 $id=$basici['id'];
						 $snm=$basici['sname'];
						 
						 $count=Yii::app()->db->createCommand("SELECT id  FROM MPS_RECOMENDED_SERVICE WHERE periodicstatus=10 and repid='$id' and 
			             pkid='$idd' and cat_id='$category_id'")->queryAll();
						 if(count($count) > 0)
						 {
							 $basiclists=Yii::app()->db->createCommand("SELECT msr.repairid,msr.sname,msr.subvalue FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$value=$idd and repairid =$id")->queryAll();
							 foreach($basiclists as $basiclist)
							{
								
								
								 $data['Recommended'][$i][$basiclist['sname']][]=$basiclist['subvalue'];
								 $rerepairids[]=$basiclist['repairid'];
								
							} 
							 $i++;
						 }
						 else{
						$basiclists=Yii::app()->db->createCommand("SELECT msr.repairid,msr.sname,msr.subvalue FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$value=$idd and repairid =$id")->queryAll();
						
							 foreach($basiclists as $basiclist)
							{
							$amotrepair=$basiclist['repairid'];
							
							$basicamts=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from 
							MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a 
							where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.$value='$idd' and a.category_id='$category_id' and a.repair_id='$amotrepair'")->queryAll();
		
							
								//$fetch_amount=Yii::app()->db->createCommand("select  `amount` FROM `repairlist_package_details` WHERE `subrepair_id` in ($imp) and `repair_id`= $repid and category_id=$category_id")->queryAll();
								
							$data['Suggested'][$j][$basiclist['sname']][]=$basiclist['subvalue'];
							$sugrepairids[]=$basiclist['repairid'];
							$data['Suggested'][$j]['id']=$basiclist['repairid'];
							$data['Suggested'][$j]['subamt']=$basicamts[0]['amount'];
								  
								
							} 
							$j++;
						 }
						
						 
					}
				  
					$rec=implode(',',array_unique($rerepairids));
					$sug=implode(',',array_unique($sugrepairids));
					
					if($value=='one')
					{
						$value1='1,000';
					}
					if($value=='five')
					{
						$value1='5,000';
					}
					if($value=='ten')
					{
						$value1='10,000';
					}
					if($value=='twenty')
					{
						$value1='20,000';
					}
					if($value=='thirty')
					{
						$value1='30,000';
					}
					if($value=='fourty')
					{
						$value1='40,000';
					}
					if($value=='fifty')
					{
						$value1='50,000';
					}
					if($value=='sixty')
					{
						$value1='60,000';
					}
					$data["amout"]=$basicamt;
					$data["Estimated Time"]=$servhr;
					$data["RecomendId"]=$rec;
					
					$datas=array("$servicename"=>array($data));
					echo json_encode($datas);
		}
		
		
		
	}
	public function actionBikeRepairlists()
	{
				$model_id=$_POST['model_id'];
				$service_id=$_POST['service_id'];
				
				$GETCATEIDs=Yii::app()->db->createCommand("SELECT  category_id  FROM bike_models where bike_model_id=$model_id")->queryAll();
			    foreach($GETCATEIDs as $GETCATEID)
					{
						$category_id=$GETCATEID['category_id'];
					} 
					
					
					
					
					$repairid=array();
					$basicid=Yii::app()->db->createCommand("SELECT repair_id, repair_name, service_id FROM mps_bike_repair_lists where service_id=$service_id")->queryAll();
					$i=0;
					foreach($basicid as $basici)
					{
						   $id=$basici['repair_id'];
						   $repairid=$basici['repair_id'];
							$basiclists=Yii::app()->db->createCommand("SELECT bsr.sub_repair_id, bsr.sub_name FROM bike_sub_repairlists as bsr,mps_bike_repair_lists as mbr where bsr.repair_id=mbr.repair_id and mbr.repair_id=$id and bsr.status=1 ")->queryAll();
						if(!empty($basiclists))
						{
						
						
							$basicamts=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from bike_repair_package_list as a where  a.repair_id and a.repair_id = $id and  a.category_id=$category_id")->queryAll();
					
					
						foreach($basicamts as $basicamt)
							{
								//echo $basiclist['subvalue'];
								$basicamt= $basicamt['amount'];
							} 
							
							foreach($basiclists as $basiclist)
							{
							
								 $data[$i][$basici['repair_name']][]=$basiclist['sub_name'];
								 $data[$i]['id']=$repairid;
							
								
							} 
							$i++;
						}
							
					}
					if($service_id == 1)
					{
						$service_name='General_Services';
					}
					else
					{
						$service_name='Repair_Job';
					}
					$repair_ids=implode(',',$repairids);
					$datas=array("Bike Services"=>
						array(
					
						"$service_name" =>$data,
						"amout"=>$basicamt
						
						
					
						 )
						
					);
//					print_r($datas);
					echo json_encode($datas);
					
	}
	
	
	
	
	
	 
}