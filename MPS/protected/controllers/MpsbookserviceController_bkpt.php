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
				$logosDetails=Yii::app()->db->createCommand("SELECT  distinct MPS_VEHICLES.logo_img, MPS_VEHICLE_MAKES.makes_name,
				MPS_VEHICLES.makes_id FROM `MPS_VEHICLE_MAKES`,MPS_VEHICLES where MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id and MPS_VEHICLES.veh_type ='$veh_type'  group by  MPS_VEHICLES.makes_id ")->queryAll();
				
				
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
		}
		exit;
		
		
		
	}
		public function actiongetcarImages()
	{
		
		$makes_id=$_GET['makes_id'];
		
		$carImageDetails=Yii::app()->db->createCommand("SELECT distinct MPS_VEHICLE_MODELS.models_id,MPS_VEHICLES.car_img as car_img,MPS_VEHICLE_MODELS.models_name,MPS_VEHICLE_MAKES.makes_name
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
					
		
		 $getcount=Yii::app()->db->createCommand("SELECT `id` FROM `MPS_VEHICLE_DETAILS` 
					WHERE makes_id=$makes_id and model_id=$model_id")->queryAll();
					
				if(count($getcount) < 1)
					{ 
	
		$model=new MPSVEHICLEDETAILS();	
		
		
	    $model->makes_id=$makes_id;
		$model->vehicle_type="$vehicle_type";
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
			$arry=array("Status"=>0,"Response"=>'Success',"lastid"=>$lastid);
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
			public function actionsaveInput()
		{
				$repairid=$_POST['repairid'];
				$checked=$_POST['checked'];
				$planid=$_POST['planid'];
				$serviceid=$_POST['serviceid'];
				
			    $amount=$_POST['amount'];
				$categoryid=$_POST['categoryid'];
				
				$adrs=$_POST['adrs'];
				
				
			  
				
				$getcount=Yii::app()->db->createCommand("SELECT  `id` FROM `MPS_PACKAGEWISE_AMT_DETAILS` WHERE repairid=$repairid and planid=$planid
				and categoryid=$categoryid")->queryAll();
				
				if(count($getcount)<1)
				{
				
			    $MPSpak=new MPSPACKAGEWISEAMTDETAILS();
				$MPSpak->serviceid=$serviceid;
				$MPSpak->repairid=$repairid;
				$MPSpak->categoryid=$categoryid;
				$MPSpak->status=$checked;
				$MPSpak->planid=$planid; 
				$MPSpak->amout=$amount;
				$MPSpak->save(); 
				//---------------------------
				/* $MPSpak=new MPS_FINAL_TRANS_DETAILS();
				$MPSpak->adrs=$adrs;
				$MPSpak->pickhr=$repairid;
				$MPSpak->pickdate=$categoryid;
				$MPSpak->userid=$checked;
				$MPSpak->pkid=$planid; 
				$MPSpak->make_id=$amount;
				$MPSpak->save();  */
				}
				else
				{
					
					if(isset(Yii::app()->session['lastid']))
					{
						$userid=Yii::app()->session['lastid'];
						$getcount2=Yii::app()->db->createCommand("update  MPS_PACKAGEWISE_AMT_DETAILS set status=1,userid=$userid WHERE repairid=$repairid 
						and planid=$planid")->execute();
					}
					else{
					$getcount2=Yii::app()->db->createCommand("update  MPS_PACKAGEWISE_AMT_DETAILS set status=1,userid=0 WHERE repairid=$repairid 
					 and planid=$planid")->execute();
					}
				}
		}
			public function actionVerify($mobile,$otp)
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
	public function actionLogin()
	     {
			 
				  /* if(!Yii::app()->user->isGuest)
				 {
						   $this->redirect(array('login'));
				 } */
			 
				 $uname=$_POST['uname'];
				 $password=$_POST['password'];
				 $getpassword=Yii::app()->db->createCommand("SELECT `id`, `username`, `password`, `status` FROM `MPS_CUSTOMERACC_INFO` 
				 WHERE username='$uname' and password='$password' and otp_status=1")->queryAll();
					 foreach($getpassword as $getpwd)
					{
						 $userid=$getpwd['id'];
						 $username=$getpwd['username'];
					}
					exit;
				
					  $getunm=Yii::app()->db->createCommand("SELECT  `username` FROM `MPS_CUSTOMER_INFO` 
				      WHERE emailid='$uname'")->queryAll();
					  
					   foreach($getunm as $getun)
					{
						 
						 $usname=$getun['username'];
					}
					if(!isset($userid))
					{
						 $userid=0;
						
					}
					else{
		
				   Yii::app()->session['lastid']=$userid;
				   Yii::app()->session['username']=$usname;
					}
				
			
		    
			
					if(count($getpassword)>0)
					{
						echo '2';
						Yii::app()->session['username']=$usname;
						Yii::app()->session['lastid']=$userid;
					}
					/* else if(empty($userid))
					{
						echo '1';
					} */
					else
					{
						echo '1';
					}
		 }
		public function actionAddVehiclesAddedLists()
	{ 
		 $images=Yii::app()->db->createCommand("SELECT distinct mvd.makes_id,mvd.model_id,mvd.id as regid,mvd.variant, mvd.vehicle_type, mvd.year, mvd.lastserviceon, mvd.veh_distance, mvd.reg_no,mvv.car_img,mvm.makes_name as make_name,mvmod.models_name as model_name FROM `MPS_VEHICLE_DETAILS` as mvd,MPS_VEHICLES as mvv,MPS_VEHICLE_MAKES as mvm, MPS_VEHICLE_MODELS as mvmod WHERE

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
	public function actionFetchBookingDetails()
	 {
		
    $fetchdata=Yii::app()->db->createCommand("select distinct a.models_name,a.variant,c.servicenames,d.pkname,mci.location,fn.bookid,mshh.imgpath from MPSVEHADDED_DETAILS as a,MPS_PACKAGEWISE_AMT_DETAILS as b,MPS_SERVICES_DETAILS as c, MPS_SERVICE_PACKAGE_DETAILS as d,MPS_CUSTOMER_INFO as mci,MPS_FINAL_TRANS_DETAILS as fn,MPSVEHADDED_DETAILS as mshh where b.serviceid=c.id and d.packageid=fn.pkid and mci.id=b.userid and mshh.model_id=b.model_id group by fn.pkid")->queryAll();
					$arr=array();
					foreach($fetchdata as $value)
					{
						$arr['Booking Details'][]=$value;//encode
						
				
					}
					echo json_encode($arr);
					//echo '<pre>';
					
										
		 
	 }
	 public function actionUpdateUserStatus()
	 {
		 $bookid=$_POST['bookid'];
		/*  $userid=$_POST['userid'];
		 $modelid=$_POST['modelid'];
		 $makeid=$_POST['makeid']; */
		 /* $getcount2=Yii::app()->db->createCommand("update MPS_FINAL_TRANS_DETAILS set mech_status=1 WHERE bookid= '$bookid' and userid=$userid and make_id= $makeid and model_id = $modelid ")->execute(); */
		 $getcount2=Yii::app()->db->createCommand("update MPS_FINAL_TRANS_DETAILS set mech_status=1 WHERE bookid='$bookid'")->execute(); 
		 $response=array("status"=>1);
		 echo json_encode($response);
	 }
	  public function actionFetchUserTrackingStatus()
	 {
		
					 $bookid=$_POST['bookid'];
					 $fetchstatus=Yii::app()->db->createCommand("SELECT bookid,mech_status,timestamp FROM MPS_FINAL_TRANS_DETAILS WHERE bookid = '$bookid'")->queryAll();
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
	
	
	
	
	
	 
}