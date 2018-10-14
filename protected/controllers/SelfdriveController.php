<?php

class SelfdriveController extends Controller
{
	public function actionCarServiceOrderSummary()
	{
		if(!empty(Yii::app()->session['username']))
		{
                    $lastid=Yii::app()->session['lastid'];		
                    $getuserinfo=Yii::app()->db->createCommand("SELECT  `pickadrs`, `billingadrs`, `pickhr`, `pickdate`, `amout` FROM `MPS_PACKAGEWISE_AMT_DETAILS` WHERE `userid`=$lastid")->queryAll();
                    foreach($getuserinfo as $getuser)
			{
                            $pickadrs=$getuser['pickadrs'];
                            $pickhr=$getuser['pickhr'];
                            $pickdate=$getuser['pickdate'];
                            $payamount=$getuser['amout'];
			 } 
			
                    $this->render('carserviceBilling',array("pickadrs"=>$pickadrs,"pickhr"=>$pickhr,"pickdate"=>$pickdate,"payamount"=>$payamount));
		}
		else
                {
                    $this->render('carserviceBilling');
		}
		
	}
	public function actionIndex()
	{
		if(isset($_GET['id']))
                    {
								
			$id=$_GET['id'];
			$self_details=Yii::app()->db->createCommand("SELECT * FROM SLD_ADD_VEHICLE where vehicle_category like '$id' and status=0")->queryAll();
			$vresult = array();
                        foreach($self_details  as $self_details) 
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
                                    $command->bindValue(":firstid", $self_details['makes_id'], PDO::PARAM_STR);
                                    $command->bindValue(":secondid", $self_details['model_id'], PDO::PARAM_STR);
                                    $res =$command->queryAll();			
                                    }
                                    catch(CDbException $e)
                                    {
                                        $res = array();
                                    }
                                    $vresult[] = array('ID'=>$self_details['id'],'makename'=>$res[0]['makes_name'],
                                    'modelname'=>$res[0]['models_name'],'img_path'=>$self_details['img_path'],
                                    'price_per_hour'=>$self_details['price_per_hour'],'vehicle_features'=>$self_details['vehicle_features'],
                                    'price'=>$self_details['price'],'seating_capacity'=>$self_details['seating_capacity'],'from_date'=>$self_details['from_date'],'location'=>$self_details['location'],
                                    'to_date'=>$self_details['to_date'],'to_date'=>$self_details['to_date'],'security_deposit'=>$self_details['security_deposit'],'extra_rate_per_kms'=>$self_details['extra_rate_per_kms']);

                                }
                                
							 $self_details_range=Yii::app()->db->createCommand("SELECT max(price) as max,min(price) as min FROM `SLD_ADD_VEHICLE` where vehicle_category like '$id'")->queryAll();
							
					
						$this->render('index',array('vehicle_details'=> $vresult,'range'=>$self_details_range));  
							
							
							}
							else
							{
								
							
							$self_details=Yii::app()->db->createCommand("SELECT sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`, 
							sfd.`model_id`, sfd.`seating_capacity`,sfd.`price_per_hour`,sfd.`price`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`from_date`,sfd.`to_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd where  sfd.status=0 ")->queryAll();
						
						//start
						
							$vresult = array();	  
							foreach($self_details  as $self_details) 
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
								$command->bindValue(":firstid", $self_details['makes_id'], PDO::PARAM_STR);
								$command->bindValue(":secondid", $self_details['model_id'], PDO::PARAM_STR);
								$res =$command->queryAll();			
								}
							catch(CDbException $e)
									{
										$res = array();
							}
							
							
					 
						   $vresult[] = array('ID'=>$self_details['id'],'makename'=>$res[0]['makes_name'],
						   'modelname'=>$res[0]['models_name'],'img_path'=>$self_details['img_path'],
						   'price_per_hour'=>$self_details['price_per_hour'],
						   'price'=>$self_details['price'],'seating_capacity'=>$self_details['seating_capacity'],'vehicle_category'=>$self_details['vehicle_category'],'from_date'=>$self_details['from_date'],'vehicle_features'=>$self_details['vehicle_features'],
						   'to_date'=>$self_details['to_date'],'to_date'=>$self_details['to_date'],'security_deposit'=>$self_details['security_deposit'],'extra_rate_per_kms'=>$self_details['extra_rate_per_kms']);

						}
						//end
						
						
							 $self_details_range=Yii::app()->db->createCommand("SELECT max(price) as max,min(price) as min FROM `SLD_ADD_VEHICLE`")->queryAll();
							
					
						$this->render('index',array('vehicle_details'=> $vresult,'range'=>$self_details_range));  
	}
	}
		public function actionBikeServiceOrderSummary()
		{
			
			$location=$_POST['bookloc'];
			$this->render('order_detail',array('location'=>$location));
		}
		 public function actionVerify()
	 {
		 
		     $mobile=$_POST['mobileno'];
			//exit;
		    $otp=$_POST['otp'];
			$authKey = "115157ACrUVUhXjZT5765202d";

			//Multiple mobiles numbers separated by comma
			$mobileNumber =$_POST['mobileno'];


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
			echo $output = curl_exec($ch); 
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
			$MPSCUSTOMER->otp_status=1;
			$MPSCUSTOMER->save(); 
			Yii::app()->session['username'] = $uname;
			echo '1';
		}
		public function actionChecklogin()
	     {
			 
			 
				 $uname=$_POST['uname'];
				 $password=md5($_POST['password']);
				
				 $getpassword=Yii::app()->db->createCommand("SELECT loginid FROM MPS_CUSTOMERACC_INFO 
				 WHERE username='$uname' and password='$password' and otp_status=1")->queryAll();
				// echo count($getpassword);
				
				 
					 foreach($getpassword as $getpwd)
					{
						 $userid=$getpwd['loginid'];
						 $username=$getpwd['username'];
					}
				
					  $getunm=Yii::app()->db->createCommand("SELECT  username,emailid,mobile_no FROM MPS_CUSTOMER_INFO 
				      WHERE emailid='$uname'")->queryAll();
					  
					   foreach($getunm as $getun)
					{
						 
						 $usname=$getun['username'];
						 $emailid=$getun['emailid'];
						 $mobile_no=$getun['mobile_no'];
						 
					}
					
					if(!isset($userid))
					{
						 $userid=0;
						
					}
					else{
					Yii::app()->session['username']=$usname;
				    Yii::app()->session['lastid']=$userid;
				    Yii::app()->session['emailid']=$emailid;
				    Yii::app()->session['mobile_no']=$mobile_no;
					
					
					}
				
			
				
					if(count($getpassword)>0)
					{
						echo '2';
				    Yii::app()->session['username']=$usname;
					Yii::app()->session['lastid']=$userid;
				    Yii::app()->session['emailid']=$emailid;
				    Yii::app()->session['mobile_no']=$mobile_no;
					
						
					}
					/* else if(empty($userid))
					{
						echo '1';
					} */
					else
					{
						echo '1';
						//$this->renderPartial('addVehicle',array('model'=>$model));
					}
		 }
	public function actionSearchSelfDrive()
	{
            
	if(!empty($_POST['search']))
		{
						if(isset($_GET['fromdates']))
						{
							$fromdates=$_GET['fromdates'];
							$todates=$_GET['todates'];
						}else
						{
							$fromdates=$_POST['fromdates'];
							$todates=$_POST['todates'];
						}
						$d=strtotime($_POST['start_date']);
						$t=strtotime($_POST['end_date']);
						//echo date('d-m-Y h:m:s',$d);
					
					/*  	$self_details=Yii::app()->db->createCommand("SELECT sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`, 
				sfd.`model_id`, sfd.`seating_capacity`,sfd.`price_per_hour`,sfd.`price`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`from_date`,sfd.`to_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd where from_date between '$from_date' and '$to_date'")->queryAll();
						$this->render('Selfdrive',array('vehicle_details'=> $self_details)); 
					*/
				 
					 $self_details=Yii::app()->db->createCommand("SELECT * FROM `SLD_ADD_VEHICLE` where sfd.status=0  ")->queryAll();
					 $vresult = array();	  
						foreach($self_details  as $self_details) 
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
								$command->bindValue(":firstid", $self_details['makes_id'], PDO::PARAM_STR);
								$command->bindValue(":secondid", $self_details['model_id'], PDO::PARAM_STR);
								$res =$command->queryAll();			
							}
							catch(CDbException $e)
									{
										$res = array();
							}
							
							
					 
						   $vresult[] = array('ID'=>$self_details['id'],'makename'=>$res[0]['makes_name'],
						   'modelname'=>$res[0]['models_name'],'img_path'=>$self_details['img_path'],
						   'price_per_hour'=>$self_details['price_per_hour'],
						   'price'=>$self_details['price'],'seating_capacity'=>$self_details['seating_capacity'],'from_date'=>$self_details['from_date'],
						   'to_date'=>$self_details['to_date'],'security_deposit'=>$self_details['security_deposit'],'extra_rate_per_kms'=>$self_details['extra_rate_per_kms']);

						}
					 $self_details_range=Yii::app()->db->createCommand("SELECT max(price) as max,min(price) as min  FROM `SLD_ADD_VEHICLE` where  from_date <='$d' and to_date>='$d' ")->queryAll();
					
						$this->render('index',array('vehicle_details'=> $vresult,'range'=>$self_details_range,'fromdates'=>$fromdates,"todates"=>$todates));   
						
						
		}
	}
	public function actionSelfDriveBookconfirm()
	{
		if(isset($_POST['order']))
		{
			$sid=$_POST['id'];
		$location=$_POST['bookloc'];	
		$amount=$_POST['amount'];
		$fromdate=$_POST['fromdate'];
		$todate=$_POST['todate'];
		$gettransaction=Yii::app()->db->createCommand("SELECT book_id FROM selfdrive_bookings ORDER BY id DESC LIMIT 1")->queryAll();
		$gid=$gettransaction[0]['book_id'];
		$egid=explode('SLD',$gid);
		$bid=$egid[1]+1;
		$modeladddel=new SelfdriveBookings();
		
		$modeladddel->book_id='SLD'.$bid;
		$modeladddel->user_id=Yii::app()->session['lastid'];
		$modeladddel->amount=$amount;
		$modeladddel->vehicle_id=$sid;
		$modeladddel->fromdate=$fromdate;
		$modeladddel->todate=$todate;
		$modeladddel->save(); 
		$bookid=$modeladddel->book_id;
			
		$this->redirect(array('SelfDriveBookconfirm1','transactionid'=>$bookid));
		}
		$sid=$_POST['id'];
		$location=$_POST['bookloc'];	
		$amount=$_POST['amount'];
		$fromdate=$_POST['fromdate'];
		$todate=$_POST['todate'];
		$gettransaction=Yii::app()->db->createCommand("SELECT book_id FROM selfdrive_bookings ORDER BY id DESC LIMIT 1")->queryAll();
		$gid=$gettransaction[0]['book_id'];
		$egid=explode('SLD',$gid);
		$bid=$egid[1]+1;
		$modeladddel=new SelfdriveBookings();
		
		$modeladddel->book_id='SLD'.$bid;
		$modeladddel->user_id=Yii::app()->session['lastid'];
		$modeladddel->amount=$amount;
		$modeladddel->vehicle_id=$sid;
		$modeladddel->fromdate=$fromdate;
		$modeladddel->todate=$todate;
		$modeladddel->save(); 
		$bookid=$modeladddel->book_id;
		echo $bookid; exit;
		
	}
	public function actionSelfDriveBookconfirm1($transactionid)
	{
		$id=Yii::app()->session['lastid'];
		$details=Yii::app()->db->createCommand("select *from MPS_CUSTOMER_INFO where id='$id'")->queryAll();	
	
		$name=$details[0]['username'];
		$email=$details[0]['emailid'];
		$mobile=$details[0]['mobile_no'];
		$city=$details[0]['city'];
		$address=$details[0]['billingaddrs'];
		$gettransaction=Yii::app()->db->createCommand("SELECT amount FROM selfdrive_bookings where book_id='$transactionid'")->queryAll();
		$amount=$gettransaction[0]['amount'];
		$this->render('selfdrivebookconfirm',array('city'=>$city,'address'=>$address,'name'=>$name,"email"=>$email,"mobile"=>$mobile,'location'=>$location,'amount'=>$amount,"bookid"=>$bookid,"fromdate"=>$fromdate,"todate"=>$todate));
			
	}
	
	public function actionOrder()
	{
		$bookid=$_GET['transactionid'];
		$details=Yii::app()->db->createCommand("select *from selfdrive_bookings where book_id='$bookid'")->queryAll();
		$fromdate=$details[0]['fromdate'];
		$todate=$details[0]['todate'];
		$amount=$details[0]['amount'];
		$id=$details[0]['vehicle_id'];
		$getcount1=Yii::app()->db->createCommand("update SLD_ADD_VEHICLE set status=1 WHERE id='$id'")->execute();
		
		$billadrs='';
		if(isset($_POST['city']))
		{
		$city=$_POST['city'];
		$adrs1=$_POST['adress1'];
		$adrs2=$_POST['adress2'];
		$billadrs=$adrs1.'*'.$adrs2;
		$uid=Yii::app()->session['lastid'];
		$updateaddrs=Yii::app()->db->createCommand("update MPS_CUSTOMER_INFO set city='$city',billingaddrs='$billadrs' WHERE id='$uid'")->execute();	
		}
		$getcount=Yii::app()->db->createCommand("update selfdrive_bookings set city='$city',billingadrs='$billadrs',status=1 WHERE book_id='$bookid'")->execute();
			
		
		$this->render('order-received',array("bookid"=>$bookid,"fromdate"=>$fromdate,"todate"=>$todate,"amount"=>$amount));
	}
	public function actionSaveSelfDrive_Details()
	{
		$model_id=$_POST['model_id'];
		$makes_id=$_POST['makes_id'];
		$amount=$_POST['amount'];
										
		try
		{
	    $modeladddel=new SelfdriveBookings();	
		$modeladddel->book_id='SLD'.rand(1111111111,9999999999);			 
		$modeladddel->make_id=$makes_id;
	    $modeladddel->model_id=$model_id;
		$modeladddel->user_id=Yii::app()->session['lastid'];
		$modeladddel->booking_date=date('d/m/y'); 
		$modeladddel->amount=$amount;
		$modeladddel->save(); 
		echo '1';
		}
		catch(CDbException $e)
		{
			print_r($e);
		}
		
	}
	public function actionPrivacypolicy()
	{
		$this->render('privacypol');
	}
	public function actionselfdrivebook($id)
	{
		$bookloc=$_POST['bookloc'];
		$totalprice=$_POST['totalprice'];
		$fdate=$_POST['fromdate'];
		$tdate=$_POST['todate'];
		$self_details=SLDADDVEHICLE::model()->findByPk($id);
					
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
								$command->bindValue(":firstid", $self_details['makes_id'], PDO::PARAM_STR);
								$command->bindValue(":secondid", $self_details['model_id'], PDO::PARAM_STR);
								$res =$command->queryAll();			
							}
							catch(CDbException $e)
									{
										$res = array();
							}
							
							
					 
	$bookorder = array('ID'=>$self_details['id'],'makename'=>$res[0]['makes_name'],
	'modelname'=>$res[0]['models_name'],'models_id'=>$res[0]['models_id'],'makes_id'=>$res[0]['makes_id'],'img_path'=>$self_details['img_path'],'imagespath'=>$self_details['imagespath'],
	'price_per_hour'=>$self_details['price_per_hour'],'variant'=>$self_details['variant'],'location'=>$self_details['location'],
	'vehicle_features'=>$self_details['vehicle_features'],
	'price'=>$self_details['price'],'seating_capacity'=>$self_details['seating_capacity'],'from_date'=>$self_details['from_date'],
	'to_date'=>$self_details['to_date'],'to_date'=>$self_details['to_date'],'security_deposit'=>$self_details['security_deposit'],
	 'extra_rate_per_kms'=>$self_details['extra_rate_per_kms']);
	$userid=Yii::app()->session['lastid'];
	$userdetails=MPSCUSTOMERINFO::model()->findByPk($userid);
	$this->render('selfdrive_book',array("fromdate"=>$fdate,'bookloc'=>$bookloc,"todate"=>$tdate,'bookorder'=>$bookorder,'totalprice'=>$totalprice,'user_details'=>$userdetails));   
	

	}	

	
	public function actionSelfdrivedetailsSearch()
	{   
            $fromdates='';
                                                $todates='';
				if(!empty($_GET['fromdate']))
						{
							$fromdates=$_GET['fromdate'];
							$todates=$_GET['todate'];
						}
					if(!empty($_POST['search'])){
						$fromdates='';
                                                $todates='';
							if(!empty($_POST['from_date']))
                                                        {
                                                            $fromdates=$_POST['from_date'];

                                                            $todates=$_POST['to_date'];

							
                                                        }
						$bookloc='';
							if(isset($_POST['bookloc1'])){
						$bookloc=$_POST['bookloc1'];
                                                        }
						$d=strtotime($_POST['from_date']);
						$t=strtotime($_POST['to_date']);
						//echo date('d-m-Y h:m:s',$d);
					
					/*  	$self_details=Yii::app()->db->createCommand("SELECT sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`, 
				sfd.`model_id`, sfd.`seating_capacity`,sfd.`price_per_hour`,sfd.`price`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`from_date`,sfd.`to_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd where from_date between '$from_date' and '$to_date'")->queryAll();
						$this->render('Selfdrive',array('vehicle_details'=> $self_details)); 
					*/
				  $vresult='';
					// $self_details=Yii::app()->db->createCommand("SELECT * FROM `SLD_ADD_VEHICLE` where  from_date <='$d' and to_date>='$d'  ")->queryAll();
					$self_details=Yii::app()->db->createCommand("SELECT * FROM `SLD_ADD_VEHICLE` where status=0")->queryAll();
					 if(!empty($self_details)){
                                        $vresult = array();	  
						foreach($self_details  as $self_details) 
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
								$command->bindValue(":firstid", $self_details['makes_id'], PDO::PARAM_STR);
								$command->bindValue(":secondid", $self_details['model_id'], PDO::PARAM_STR);
								$res =$command->queryAll();			
							}
							catch(CDbException $e)
									{
										$res = array();
							}
							
							
					 
						   $vresult[] = array('ID'=>$self_details['id'],'makename'=>$res[0]['makes_name'],
						   'modelname'=>$res[0]['models_name'],'img_path'=>$self_details['img_path'],
						   'price_per_hour'=>$self_details['price_per_hour'], 'vehicle_features'=>$self_details['vehicle_features'],
						   'price'=>$self_details['price'],'seating_capacity'=>$self_details['seating_capacity'],'from_date'=>$self_details['from_date'],
						   'to_date'=>$self_details['to_date'],'security_deposit'=>$self_details['security_deposit'],'extra_rate_per_kms'=>$self_details['extra_rate_per_kms']);

						}
                                         }
					
						$this->render('index',array('vehicle_details'=> $vresult,'bookloc'=>$bookloc,'fromdates'=>$fromdates,"todates"=>$todates));   
						
						
					}else{
                                            
                                            if(isset($_POST['bookloc1'])){
						$bookloc=$_POST['bookloc'];
                                            }
						 $self_details=Yii::app()->db->createCommand("SELECT sfd.`id`,sfd.`vehicle_id`,sfd.`username`,sfd.`vehicle_category`,sfd.`vehicle_type`,sfd.`makes_id`, 
				sfd.`model_id`, sfd.`seating_capacity`,sfd.`price_per_hour`,sfd.`price`,sfd.`img_path`,sfd.`security_deposit`,sfd.`created_date`,sfd.`from_date`,sfd.`to_date`,sfd.`total_kms`,sfd.`extra_rate_per_kms`,sfd.`vehicle_features`,sfd.`variant` FROM `SLD_ADD_VEHICLE` as sfd where sfd.status=0")->queryAll();
					 $self_details_range=Yii::app()->db->createCommand("SELECT max(price),min(price) FROM `SLD_ADD_VEHICLE`")->queryAll();
					  $vresult = array();
                                          if(!empty($self_details))
                                          {
						foreach($self_details  as $self_details) 
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
								$command->bindValue(":firstid", $self_details['makes_id'], PDO::PARAM_STR);
								$command->bindValue(":secondid", $self_details['model_id'], PDO::PARAM_STR);
								$res =$command->queryAll();			
							}
							catch(CDbException $e)
									{
										$res = array();
							}
							
							
					 
						   $vresult[] = array('ID'=>$self_details['id'],'makename'=>$res[0]['makes_name'],
						   'modelname'=>$res[0]['models_name'],'img_path'=>$self_details['img_path'],
						   'price_per_hour'=>$self_details['price_per_hour'],'vehicle_features'=>$self_details['vehicle_features'],
						   'price'=>$self_details['price'],'seating_capacity'=>$self_details['seating_capacity'],'from_date'=>$self_details['from_date'],
						   'to_date'=>$self_details['to_date'],'to_date'=>$self_details['to_date'],'security_deposit'=>$self_details['security_deposit'],'extra_rate_per_kms'=>$self_details['extra_rate_per_kms']);

						}
                                          }
						$this->render('index',array('vehicle_details'=> $vresult,'bookloc'=>$bookloc,'fromdates'=>$fromdates,"todates"=>$todates));  
					 
					 
	}
	}
	
}