<?php

class MPSVEHICLES_DETAILSController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionappfeature()
	{
		$this->render('appfeatures');
	}

	public function actionFetchselfdriveCars()
	{
		
		
	}
	
	public function actionCarServiceOrderSummary()
	{
		if(!empty(Yii::app()->session['username']))
		{
			   // session_start();
			   $lastid=Yii::app()->session['lastid'];
			   $sess_id=Yii::app()->session['sess_id'];
			
			 $lastid=Yii::app()->session['lastid'];
		
			  $getuserinfo=Yii::app()->db->createCommand("SELECT  `pickadrs`, `billingadrs`, `pickhr`, `pickdate`, `amout` FROM `MPS_PACKAGEWISE_AMT_DETAILS` WHERE `userid`=$lastid and sess_id='$sess_id'")->queryAll();
			 foreach($getuserinfo as $getuser)
			 {
				 $pickadrs=$getuser['pickadrs'];
				 $pickhr=$getuser['pickhr'];
				 $pickdate=$getuser['pickdate'];
				 $payamount=$getuser['amout'];
			 } 
			
			$this->render('carserviceBilling',array("pickadrs"=>$pickadrs,"pickhr"=>$pickhr,"pickdate"=>$pickdate,"payamount"=>$payamount));
		}
		else{
			$this->render('carserviceBilling');
		}
		
	}
	public function actionBikeServiceOrderSummary()
	{
		$this->render('carserviceBilling');
	}
	public function actionfblogout()
	{
		$this->render('fblogout');
	}
	public function actionUpdateRecomendedamounts()
	{
		$model_id=$_POST['model_id'];
		$getcatid=Yii::app()->db->createCommand("SELECT category_id  FROM MPS_VEHICLES WHERE models_id='$model_id'")->queryAll();
		$cat_id=$getcatid[0]['category_id'];
		$planid=$_POST['planid'];
		 $getRepairId=Yii::app()->db->createCommand("SELECT repid  FROM MPS_RECOMENDED_SERVICE WHERE periodicstatus=10 and  
			             pkid='$planid' and cat_id='$cat_id'")->queryAll();
						 $amount=0;
						 
		foreach($getRepairId as $ids)
		{
			$id=$ids['repid'];
			$getRepairIdamount=Yii::app()->db->createCommand("select sum(amount) as amount from	
			repairlist_package_details where repair_id='$id' and category_id='$cat_id'")->queryAll();
			$amount=$amount+$getRepairIdamount[0]['amount'];
		}
		if(empty($amount))
		{
			echo '0';			 
		}
		else
		{
			echo $amount;			
		}
		
	}
	public function actionUpdatecaramounts()
	{
		
		$rid=$_POST['id'];
		$pkid=$_POST['pkd'];
		$modelid=$_POST['modelid'];
		$brandid=$_POST['brandid'];
			$get_cat_id=Yii::app()->db->createCommand("SELECT category_id as cid from MPS_VEHICLES where makes_id=$brandid and models_id=$modelid")->queryAll();
		$cat_id=$get_cat_id[0]['cid'];	

		if($pkid==4)
		{
			$pknm='ten';
		}elseif($pkid==5)
		{
			$pknm='twenty';
		}elseif($pkid==6)
		{
			$pknm='thirty';
		}elseif($pkid==7)
		{
			$pknm='fourty';
		}elseif($pkid==8)
		{
			$pknm='fifty';
		}elseif($pkid==9)
		{
			$pknm='sixty';
		}
	
		$basicamts=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from 
					MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a 
					where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.$pknm='$pkid' and a.category_id='$cat_id' and a.repair_id='$rid'")->queryAll();
		
		echo $basicamts[0]['amount'];
		
	}
	public function actionfacebookresi()
	{
		    // $adrs=$_POST['address'];
	  	    //exit;
			$userid=$_POST['userid'];
			//$email=$_POST['email'];
			$uname=$_POST['name'];
			$bodytag = str_replace(" ", "+", "$adrs"); 
			$url = "http://maps.google.com/maps/api/geocode/json?address=$bodytag&sensor=false&region=India";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$response = curl_exec($ch);
			curl_close($ch);
			$response_a = json_decode($response);
			 $lat = $response_a->results[0]->geometry->location->lat;
			
			 $long = $response_a->results[0]->geometry->location->lng; 
		
			 $getcountcust=Yii::app()->db->createCommand("SELECT  `id` FROM `MPS_CUSTOMER_INFO` where emailid='$email'")->queryAll();
			
			if(count($getcountcust)<1)
			{
				$MPSCUSTOMERINFO=new MPSCUSTOMERINFO();	
				$MPSCUSTOMERINFO->username=$uname;
				//$MPSCUSTOMERINFO->emailid=$email; 
			//	$MPSCUSTOMERINFO->location=$adrs; 
				$MPSCUSTOMERINFO->longitude=$lat; 
				$MPSCUSTOMERINFO->latitude=$long; 
				
				if($MPSCUSTOMERINFO->save())
				{
					$lastid=$MPSCUSTOMERINFO->id;
					Yii::app()->session['lastid']=$lastid;
				}  
			}
		
		    $getcount=Yii::app()->db->createCommand("SELECT  `id` FROM `MPS_CUSTOMERACC_INFO` where fbid='$userid'")->queryAll();
			if(count($getcount)<1)
			{
					$MPSCUSTOMER=new MPSCUSTOMERACCINFO();	
					$MPSCUSTOMER->username=$userid;
					$MPSCUSTOMER->fbid=$userid;
					$MPSCUSTOMER->save(); 
					echo '0';
			}
			else
			{
			echo '1';
			}
		
	}
	public function actionBookingDetails()
	{
		   $model_id=$_POST['model_id'];
		 
		 $getmodelnm=Yii::app()->db->createCommand("SELECT  `car_img`, `veh_type` FROM `MPS_VEHICLES` WHERE `models_id`=$model_id and status=0")->queryAll();
		 foreach($getmodelnm as $getmode)
		 {
			 echo $model =  $getmode['car_img'];
		 } 
		 /* $userid=Yii::app()->session['lastid'];
		 $getdetails=Yii::app()->db->createCommand("SELECT  MPS_CARSERVICESLIST_DETAILS.sname,MPS_PACKAGEWISE_AMT_DETAILS.amout FROM `MPS_PACKAGEWISE_AMT_DETAILS`, MPS_CARSERVICESLIST_DETAILS WHERE MPS_PACKAGEWISE_AMT_DETAILS.repairid=MPS_CARSERVICESLIST_DETAILS.id and MPS_PACKAGEWISE_AMT_DETAILS.userid=$userid")->queryAll();
		 foreach($getdetails as $getdeta)
		 {
			 $model=  $getdeta['sname'];
		 } */
		
		//$this->redirect('user_book');
	}
	public function actionCustLogin()
	{
		
		if(isset(Yii::app()->session['username']))
		{
		$this->render('MPSCUSTLOGIN');
		}
		else{
			$this->render('MPSCUSTLOGIN');
		}
	}
	public function actionFetchBikeBrands()
	{
		 $vbikebrand=Yii::app()->db->createCommand("SELECT brand_id,brand_name, brand_logo_path, brand_logo_img FROM bike_brands")->queryAll();
		 $this->render('bookService-bike',array("bikebrands"=>$vbikebrand));
	}
	public function actionFetchBikeModels()
	{
		$makeid=$_POST['makeid'];
	
		$vbikemodel=Yii::app()->db->createCommand("SELECT bike_model_id, brand_id,bike_model_name,bike_model_img_path FROM bike_models WHERE brand_id=$makeid")->queryAll();
		
		$html='';
		foreach($vbikemodel as $vbikemo)
						{
							$html.='<li id="'.$vbikemo['bike_model_id'].'"><a href="#">'.$vbikemo['bike_model_name'].'<img src="http://metrepersecond.com/MPS'.$vbikemo['bike_model_img_path'].'"></a></li>';
						}  
		echo $html;
		 
	}
	public function actionBikeDetails()
	{
		$vbikemodel=Yii::app()->db->createCommand("SELECT brand_id,brand_name, brand_logo_path, brand_logo_img FROM bike_brands")->queryAll();
		$this->render('bookService-bike',array("bikebrands"=>$vbikemodel));
	}
	
	public function actionFetchRepairListsRepairJob()
		{
					$model_id=$_POST['model_id'];
					$pkid=$_POST['pkid'];
		
		
					$GETdetails=Yii::app()->db->createCommand("SELECT  `pkname` FROM `MPS_SERVICE_PACKAGE_DETAILS` 
					where packageid = $pkid ")->queryAll();
			
			
					$GETCATEIDs=Yii::app()->db->createCommand("SELECT  `category_id` FROM `MPS_VEHICLES` WHERE models_id=$model_id")->queryAll();
					foreach($GETCATEIDs as $GETCATEID)
					{
						$category_id=$GETCATEID['category_id'];
					} 
					 
					$html='<script src="'.Yii::app()->baseUrl.'/assets/plugins/jquery/jquery-1.11.1.min.js"></script>
					<input type="hidden" name="repjobamt" id="repjobamt'.$pkid.'"/>';
					 
					$amtvalue='';
					 
					foreach($GETdetails as $GETdet)
					{	 
					 $pknm=$GETdet['pkname'];
					}
					$basicamts=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from 
					MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a 
					where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.$pknm=$pkid and a.category_id=$category_id")->queryAll();
					foreach($basicamts as $basicamt)
						{
							//echo $basiclist['subvalue'];
							 $basicamt= $basicamt['amount'];
						}
						
						
					$basicid=Yii::app()->db->createCommand("SELECT mcd.sname,msr.srepairid,mcd.id,count(mcd.id) FROM `MPS_CARSERVICESLIST_DETAILS` 
					as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$pknm=$pkid group by mcd.id")->queryAll();
					
					foreach($basicid as $basici)
					{
						$id=$basici['id'];
						$sid=$basici['srepairid'];
						
						$getsum=Yii::app()->db->createCommand("SELECT sum(`amount`) as amt FROM `repairlist_package_details` WHERE 
						repair_id= $id and subrepair_id= $sid and category_id=$category_id")->queryAll();
						foreach($getsum as $amout)
						{
							$amt=$amout['amt'];
							 
						}
						 
						$basicamtspak=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from 
						MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a 
						where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.repairid=$id and b.$pknm=$pkid and a.category_id=$category_id")->queryAll();
						foreach($basicamtspak as $basicpak)
							{
								
								 $basicamtpack= $basicpak['amount'];
							}
						if(empty($basicamtpack))
							{
								 $basicamtpack = 0;
							}
					
						$getcoun1t=Yii::app()->db->createCommand("SELECT  `repairid` FROM `MPS_PACKAGEWISE_AMT_DETAILS` WHERE repairid=$id and 
						planid=$pkid and categoryid=$category_id and status=1")->queryAll();
						
						foreach($getcoun1t as $getco)
						{
							$idty[]=$getco['repairid'];
						}
						if(!empty($idty))
						{
						  $rat=implode(',',$idty);
						}
						else
						{
							$rat=0;
						}
						 
						$getcount=Yii::app()->db->createCommand("SELECT  `id` FROM `MPS_PACKAGEWISE_AMT_DETAILS` WHERE 
						repairid=$id and planid=$pkid and status=1 and categoryid=$category_id")->queryAll();
						  
						 
						if(count($getcount)>0)
						{
						 $html.= '<div class="col-md-4">
                                      <h3 class="block-title"><input type="checkbox" id="chk1'.($id).''.$pkid.'" value="'.$id.'-'.$amt.'-'.$pkid.'" 
									  name="check" class="checkbox_check" onclick="checkrepair('.$id.','.$pkid.');" />'.$basici['sname'].'</h3>
										<ul class="list-check"><input type="hidden" name="val2" id="val2'.($id+1).'" value="'.$id.'-'.$pkid.'"/>';
						}
						else{
							 $html.= '<div class="col-md-4">
                                      <h3 class="block-title"><input type="checkbox" id="chk1'.($id).''.$pkid.'" value="'.$id.'-'.$amt.'-'.$pkid.'" 
									  name="check" class="checkbox_check" onclick="checkrepair('.$id.','.$pkid.');"/>'.$basici['sname'].'</h3>
										<ul class="list-check"><input type="hidden" name="val2" id="val2'.($id+2).'" value="'.$id.'-'.$pkid.'"/>';
						}
						$basiclists=Yii::app()->db->createCommand("SELECT distinct msr.sname,msr.srepairid,msr.subvalue FROM 
						`MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr 
						where mcd.id=msr.repairid and msr.$pknm=$pkid and msr.repairid=$id")->queryAll();
						
						
						
						
						 foreach($basiclists as $basiclist)
						{
							
							 $html.= '<li>'.$basiclist['subvalue'].'</li>';
							 $srepairid=$basiclist['srepairid'];
						} 
						$basnan=Yii::app()->db->createCommand("SELECT sum(`amout`) as amt
						FROM `MPS_PACKAGEWISE_AMT_DETAILS` WHERE `planid`=$pkid and status=1 and categoryid=$category_id")->queryAll();
						
						
						
						
						foreach($basnan as $basna)
						{
							$planamt=$basna['amt'];
						} 
						$reducedamt=$basicamt-$basicamtpack;
					
						 $html.= '<!-- <script>
							$(document).ready(function()
							{
								
								$("#repjobamt'.$pkid.'").val('.$planamt.');
								$("#val'.$id.'").val('.$id.');
								model_id=$("#model_id").val();
								plan='.$pkid.';
								
								$("#chk2'.($id+1).'chk2'.$pkid.'").change(function(){
									if($(this).prop("checked")==true)
									{
										
									
										$("#repjobamt'.$pkid.'").val('.($planamt).');
										$.post("saveInput",{
											
											repairid:'.$id.',
											checked:1,
											planid:'.$pkid.',
											serviceid:3,
											categoryid:'.$category_id.',
											amount:'.$basicamtpack.',
											
										},
										function(data)
										{
											fetchRepairjob(model_id,plan);
											
										}); 
											
											
									}
									else
									{
										
										    $.post("UncheckInput",{
											
											repairid:'.$id.',
											checked:1,
											planid:'.$pkid.',
											categoryid:'.$category_id.',
											
										},
										function(data)
										{
											$("#repjobamt'.$pkid.'").val('.($planamt).');
											
											fetchRepairjob(model_id,plan);
										}); 
										
										
									
									}
									
								
								});
								
							});
					</script> --></ul></div>';
					}
				
					 
						$servicehr=Yii::app()->db->createCommand("SELECT servicehr as hour from MPS_SERVICE_PACKAGE_DETAILS where id=$pkid")->queryAll();
						foreach($servicehr as $hour)
						{
							
							 $servhr= $hour['hour'];
						} 
				$html.='<input type="hidden" name="valrep" id="valrep'.$pkid.'" value="'.$rat.'-'.$pkid.'-'.Yii::app()->session['lastid'].'" class="bkp"/>';
			
				echo  $html.'**'.'Package:'.$basicamt.'**'.$servhr.'**'.$pkid.'**'.$planamt;		//echo  $html;
			
		}
		
		// on click update amounts in bike service
		public function actionUpdateBikeRepairAmounts()
		{
			
			$id=$_POST['id'];
			$brandid=$_POST['brandid'];
			$modelid=$_POST['modelid'];
			$get_cat_id=Yii::app()->db->createCommand("SELECT category_id as cid from bike_models where bike_model_id='$modelid' and brand_id='$brandid'")->queryAll();
			$cat_id=$get_cat_id[0]['cid'];
			$basicamts1=Yii::app()->db->createCommand("SELECT sum( bp.amount ) AS amount
							FROM bike_repair_package_list AS bp,mps_bike_repair_lists AS rp
							WHERE bp.repair_id = '$id' and bp.repair_id = rp.repair_id
							AND bp.category_id ='$cat_id' and bp.status=1 ")->queryAll();
							
			echo $basicamts1[0]['amount'];
		}
	
		public function actionBookBikeSummary()
		{
			$model_id=$_POST['modelid'];			
			$total_amount=$_POST['bamount'];
			
			$service=$_POST['services'];
			$subservices=explode(',',$service);
			//$html='';
				$html.='<div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">';
                      
			for($i=0;$i<sizeof($subservices)-1;$i++)
			{
				$sbid=$subservices[$i];
				$service_details=Yii::app()->db->createCommand("select * from bike_sub_repairlists where repair_id='$sbid' ")->queryAll();
				$rbid=$service_details[0]['repair_id'];
				$repair_name=Yii::app()->db->createCommand("select repair_name as name from mps_bike_repair_lists where repair_id='$rbid' ")->queryAll();
				
			  
                          $html.=' <div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading';
					if($i==0){}else{ $html.=$i; }
				$html.='">
                                    <h4 class="panel-title">
                                        <a ';
					 $html.='class="collapsed"'; 
				$html.=' data-toggle="collapse" data-parent="#accordion" href="#collapse'.($i).'" aria-expanded="true" aria-controls="collapse'.($i).'">
                                            <span class="dot"></span> '.$repair_name[0]['name'].'
                                        </a>
                                    </h4>
                                </div> <div id="collapse'.$i.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.($i).'">
                                    <div class="panel-body">
                                        <ul>';
											
											foreach($service_details as $sub)
											{
                                                $html.='<li class="col-md-6">'.$sub['sub_name'].'</li>';
											} 
                                          $html.='</ul>
                                    </div>
                                </div>
                                           </div>';
			}	
			$html.='</div>';			
			$service_category=$_POST['bserviceid'];
			$bikedetails=Yii::app()->db->createCommand("select bb.brand_name as brand_name,bb.brand_logo_path as brand_logo_img,
			bm.bike_model_img_path as model_img,bm.bike_model_name as model_name from			
			bike_models as bm,bike_brands as bb where bm.brand_id=bb.brand_id and bm.bike_model_id='$model_id'")->queryAll();	
			$scat=Yii::app()->db->createCommand("select snames as cat_name from bike_service_names where id='$service_category' ")->queryAll();
			$this->render('bookService_Summary',array("bikedetails"=>$bikedetails,"html"=>$html,"service_cat"=>$scat,"total_amount"=>$total_amount));
		}
		
		public function actionFetchBikegenServiceDetails()
		{
			
				$model_id=$_POST['model_id'];
				$GETCATEIDs=Yii::app()->db->createCommand("SELECT  category_id  FROM bike_models where bike_model_id=$model_id")->queryAll();
			    foreach($GETCATEIDs as $GETCATEID)
					{
						$category_id=$GETCATEID['category_id'];
					} 
				$html='<script src="'.Yii::app()->baseUrl.'/assets/plugins/jquery/jquery-1.11.1.min.js"></script>';
				$basicid=Yii::app()->db->createCommand("SELECT repair_id, repair_name, service_id FROM mps_bike_repair_lists where service_id=1")->queryAll();
					
					foreach($basicid as $basici)
					{
						$id=$basici['repair_id'];
							$basiclists=Yii::app()->db->createCommand("SELECT bsr.sub_repair_id, bsr.sub_name FROM bike_sub_repairlists as bsr,mps_bike_repair_lists as mbr where bsr.repair_id=mbr.repair_id and mbr.repair_id=$id and bsr.status=1 ")->queryAll();
						if(!empty($basiclists))
						{
						
						
						 
						$html.= '<div class="col-md-4">
                                      <h3 class="block-title"><input type="checkbox" name="chk'.$id.'" id="chk'.$id.'" onclick=checkper('.$id.'); />'.$basici['repair_name'].'</h3>
										<ul class="list-check">';
					
					
						$basicamts=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from bike_repair_package_list as a where  a.repair_id and a.repair_id = $id and  a.category_id=$category_id")->queryAll();
					
					
						foreach($basicamts as $basicamt)
							{
								//echo $basiclist['subvalue'];
								$basicamt= $basicamt['amount'];
							}
						
						
						
						foreach($basiclists as $basiclist)
						{
						
							 $html.= '<li>'.$basiclist['sub_name'].'</li>';
							
						} 
						}
							$html.='<!--<script>
							$(document).ready(function()
							{
								
								$("#chk'.($id+1).'").change(function(){
									if($(this).prop("checked")==true)
									{
										alert("checked");
									}
								});
							});
							</script> --></ul></div>';
					}					
			
				echo  $html.'**'.$basicamt;		
			
		}
		
		
		public function actionFetchBikerepairServiceDetails()
		{
				$model_id=$_POST['model_id'];
				$GETCATEIDs=Yii::app()->db->createCommand("SELECT  category_id  FROM bike_models where bike_model_id=$model_id")->queryAll();
			    foreach($GETCATEIDs as $GETCATEID)
					{
						$category_id=$GETCATEID['category_id'];
					} 
				$html='<script src="'.Yii::app()->baseUrl.'/assets/plugins/jquery/jquery-1.11.1.min.js"></script>';
				$basicid=Yii::app()->db->createCommand("SELECT repair_id, repair_name, service_id FROM mps_bike_repair_lists where service_id=2")->queryAll();
					
					foreach($basicid as $basici)
					{
						$id=$basici['repair_id'];
							$basiclists=Yii::app()->db->createCommand("SELECT bsr.sub_repair_id, bsr.sub_name FROM bike_sub_repairlists as bsr,mps_bike_repair_lists as mbr where bsr.repair_id=mbr.repair_id and mbr.repair_id=$id and bsr.status=1 ")->queryAll();
						if(!empty($basiclists))
						{
						
						
						 
						$html.= '<div class="col-md-4">
                                      <h3 class="block-title"><input type="checkbox" name="chk'.$id.'" id="chk'.$id.'" onclick=checkper('.$id.'); />'.$basici['repair_name'].'</h3>
										<ul class="list-check">';
					
					
						$basicamts=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from bike_repair_package_list as a where  a.repair_id and a.repair_id = $id and  a.category_id=$category_id")->queryAll();
					
					
						foreach($basicamts as $basicamt)
							{
								//echo $basiclist['subvalue'];
								$basicamt= $basicamt['amount'];
							}
						
						
						
						foreach($basiclists as $basiclist)
						{
						
							 $html.= '<li>'.$basiclist['sub_name'].'</li>';
							
						} 
						}
							$html.='<!--<script>
							$(document).ready(function()
							{
								
								$("#chk'.($id+1).'").change(function(){
									if($(this).prop("checked")==true)
									{
										alert("checked");
									}
								});
							});
							</script> --></ul></div>';
					}					
			
				echo  $html.'**'.$basicamt;			
		}
	    public function actionSaveBikeInput()
		{
				$repairid=$_POST['repairid'];
				$checked=$_POST['checked'];
				$serviceid=$_POST['serviceid'];
				$categoryid=$_POST['categoryid'];
				$amount=$_POST['amount'];
				$MPSbtrans=new bike_trans_details();
				//$MPSpak->bookid='BOK'.rand(1111111111,9999999999);
				$MPSbtrans->make_id=$serviceid;
				$MPSbtrans->model_id=$repairid;
				$MPSbtrans->repairid=$categoryid;
				$MPSbtrans->subrepairid=$checked;
				
				$MPSbtrans->category_id=$amount;
				$MPSbtrans->save(); 
		}
		public function actionFetchRepairListsAdvance()
		{
			$model_id=$_POST['model_id'];
			//exit;
			
			$GETCATEIDs=Yii::app()->db->createCommand("SELECT  `category_id` FROM `MPS_VEHICLES` WHERE models_id=$model_id")->queryAll();
			foreach($GETCATEIDs as $GETCATEID)
					{
						$category_id=$GETCATEID['category_id'];
					} 
					
			$basicid=Yii::app()->db->createCommand("SELECT mcd.sname,mcd.id,count(mcd.id) FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.advanced=3 group by mcd.id")->queryAll();
					$html='';
					foreach($basicid as $basici)
					{
						$id=$basici['id'];
						$html.= '<div class="col-md-4">
                                         <h3 class="block-title">'.$basici['sname'].'</h3><ul class="list-check">';
						$basiclists=Yii::app()->db->createCommand("SELECT msr.sname,msr.subvalue FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.advanced=3 and repairid =$id")->queryAll();
						
						foreach($basiclists as $basiclist)
						{
							//echo $basiclist['subvalue'];
							 $html.= '<li>'.$basiclist['subvalue'].'</li>';
						} 
						 $html.= ' </ul></div>';
					}
						$advanceamts=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount 
						from MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details 
						as a where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and
						b.advanced=3 and a.category_id=$category_id")->queryAll();
					 foreach($advanceamts as $advance)
						{
							//echo $basiclist['subvalue'];
							 $advanceamt= $advance['amount'];
						} 
						 $servicehr=Yii::app()->db->createCommand("SELECT servicehr as hour from MPS_SERVICE_PACKAGE_DETAILS where id=3")->queryAll();
						  foreach($servicehr as $hour)
						{
							//echo $basiclist['subvalue'];
							 $servhr = $hour['hour'];
						}
					
						echo  $html.'**'.$advanceamt.'**'.$servhr;
					//echo  $html;
			
		}
	
		public function actionFetchRepairListsElite()
		{
			  /*$makes_id=$_POST['makes_id'];*/
			 $model_id=$_POST['model_id']; 
			//exit;
			
			 $GETCATEIDs=Yii::app()->db->createCommand("SELECT  `category_id` FROM `MPS_VEHICLES` WHERE models_id=$model_id")->queryAll();
			foreach($GETCATEIDs as $GETCATEID)
					{
						$category_id=$GETCATEID['category_id'];
					}  
			$basicid=Yii::app()->db->createCommand("SELECT mcd.sname,mcd.id,count(mcd.id) FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.elite=2 group by mcd.id")->queryAll();
					$html='';
					foreach($basicid as $basici)
					{
						 $id=$basici['id'];
						// echo "SELECT msr.sname,msr.subvalue FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and basic in (1) and repairid =$id";
						 $html.= '<div class="col-md-4">
                                         <h3 class="block-title">'.$basici['sname'].'</h3><ul class="list-check">';
						$basiclists=Yii::app()->db->createCommand("SELECT distinct msr.sname,msr.subvalue FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.elite=2 and repairid =$id")->queryAll();
						
						 foreach($basiclists as $basiclist)
						{
							//echo $basiclist['subvalue'];
							 $html.= '<li>'.$basiclist['subvalue'].'</li>';
						} 
						 $html.= '</ul></div>';
					}
					$eliteamts=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from 
					MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a where 
					a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.elite=2 and a.category_id=$category_id")->queryAll();
					 foreach($eliteamts as $eliteamt)
						{
							//echo $basiclist['subvalue'];
							 $amount=$eliteamt['amount'];
						} 
						
						 $servicehr=Yii::app()->db->createCommand("SELECT servicehr as hour from MPS_SERVICE_PACKAGE_DETAILS where id=2")->queryAll();
						  foreach($servicehr as $hour)
						{
							//echo $basiclist['subvalue'];
							 $servhr= $hour['hour'];
						}
					echo  $html.'**'.$amount.'**'.$servhr;
			
		}
			public function actionUpdateuserpackage()
		{
			
			if(empty(Yii::app()->session['username']))
			{
				
			       $value=$_POST['value'];
				 
				   $uname=$_POST['uname'];
				  
				   $makes_id=$_POST['makes_id'];
				   $model_id=$_POST['model_id'];
				   $datas=explode('-',$value);
				   $usertot=$_POST['usertot'];
				   
				   $pkid=$_POST['pkid'];
				   $serviceid=$_POST['serviceid'];
				  
			       $repairids=explode(',',$datas[0]);
				   $planid=$datas[1];
				   $GETCATEIDs=Yii::app()->db->createCommand("SELECT  `category_id` FROM `MPS_VEHICLES` WHERE models_id=$model_id")->queryAll();
						foreach($GETCATEIDs as $GETCATEID)
						{
							$category_id=$GETCATEID['category_id'];
						} 
						
				   $getuserid=Yii::app()->db->createCommand("SELECT  username,id FROM  `MPS_CUSTOMER_INFO` WHERE emailid =  '$uname'")->queryAll();
					 foreach($getuserid as $getuser)
					{
						  $username=$getuser['username'];
						  $userid=$getuser['id'];
						 
					}
					Yii::app()->session['username']=$username;
					Yii::app()->session['lastid']=$userid;
				    if(count($getuserid)>0)
				   { 
				   $getcountmodel=Yii::app()->db->createCommand("SELECT  id FROM  `MPSVEHADDED_DETAILS` WHERE makes_id =  $makes_id and model_id = $model_id ")->queryAll();
				  
				 
				  if(count($getcountmodel)<1)
				  {
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
						
						$getcountcars=Yii::app()->db->createCommand("SELECT `id` FROM `MPSVEHADDED_DETAILS` WHERE makes_id=$makes_id and model_id=$model_id")->queryAll();
						if(count($getcountcars)<1)
						{
						$modeladddel=new MPSVEHADDEDDETAILS();	
						$modeladddel->makes_id=$makes_id;
						$modeladddel->model_id=$model_id;
						$modeladddel->imgpath="$carimgg";
						$modeladddel->models_name="$getcarnmodel";
						$modeladddel->makes_name="$getcarmake";
						$modeladddel->user_id=Yii::app()->session['lastid'];
						$modeladddel->save();  
						}
						$userid=Yii::app()->session['lastid'];
						
						
				  }
				  
				 
				
				 
				   
					/* echo "update MPS_PACKAGEWISE_AMT_DETAILS set userid=$userid,model_id=$model_id,makes_id=$makes_id WHERE repairid=$repairid 
					 and planid=$planid";
					exit; */
					
				 if(count($repairids)<2)
					 {
				    foreach($repairids as $repairid)
				  { 
					
					    $getcount2=Yii::app()->db->createCommand("update MPS_PACKAGEWISE_AMT_DETAILS set userid=$userid,model_id = $model_id,amout = $usertot,makes_id = $makes_id WHERE repairid=$repairids[0]
					 and planid=$planid")->execute();
					  
						
				  }  
					 }
					 else{
						  foreach($repairids as $repairid)
				  { 
					 
					    $getcount2=Yii::app()->db->createCommand("update MPS_PACKAGEWISE_AMT_DETAILS set amout = $usertot,model_id=$model_id,makes_id=$makes_id WHERE repairid=$repairid and planid=$planid")->execute();
				  } 
					 }
					
						$getcount=Yii::app()->db->createCommand("SELECT  `id` FROM `MPS_PACKAGEWISE_AMT_DETAILS` WHERE repairid in ($repairid) and planid=$planid
						and categoryid=$category_id")->queryAll();
				
						$getcount2=Yii::app()->db->createCommand("SELECT  `id` FROM `MPS_PACKAGEWISE_AMT_DETAILS` WHERE repairid in ($repairid) and planid=$planid
						and categoryid=$category_id")->queryAll();
				if(count($getcount)<1)
				{
						foreach($repairids as $newrep)
						{
							$MPSpak=new MPSPACKAGEWISEAMTDETAILS();
						   // $MPSpak->bookid='BOK'.rand(1111111111,9999999999);
							$MPSpak->serviceid=2;
							$MPSpak->userid=$userid;
							$MPSpak->repairid=$newrep;
							$MPSpak->makes_id=$makes_id;
							$MPSpak->model_id=$model_id;
							$MPSpak->categoryid=$category_id;
							$MPSpak->status=1;
							$MPSpak->planid=$pkid; 
							$MPSpak->amout=$usertot; 
							$MPSpak->save(); 
						}
						
				}	        $MPSpak1=new MPSFINALTRANSDETAILS();
						    $MPSpak1->bookid='BOK'.rand(1111111111,9999999999);
							$MPSpak1->userid=$userid;
							$MPSpak1->make_id=$makes_id;
							$MPSpak1->model_id=$model_id;
							//$MPSpak1->cat_id=$category_id;
							
							$MPSpak1->pkid=$pkid; 
							$MPSpak1->total=$usertot; 
							$MPSpak1->save(); 
				
						//print_r($repairids);
						 echo '2';
				   }
				   else{

				  echo '1'; 
				   }
				        
				   
			}
			else{
				
				
				      $model_id=$_POST['model_id'];
					  $usertot=$_POST['usertot'];
					   $pkid=$_POST['pkid'];
					   
					    $GETCATEIDs=Yii::app()->db->createCommand("SELECT  `category_id` FROM `MPS_VEHICLES` WHERE models_id=$model_id")->queryAll();
						foreach($GETCATEIDs as $GETCATEID)
						{
							$category_id=$GETCATEID['category_id'];
						} 
				  // echo "SELECT  makes_id FROM  `MPS_VEHICLE_MODELS` WHERE models_id = $model_id";
				  
				    $fetchmakeid=Yii::app()->db->createCommand("SELECT  makes_id FROM  `MPS_VEHICLE_MODELS` WHERE models_id = $model_id")->queryAll();
					
						  foreach($fetchmakeid as $fetchmake)
						  { 
						    $makes_id=$fetchmake['makes_id'];
						  }
					
				    $value = $_POST['value'];
				   $datas = explode('-',$value);
			       $repairids=explode(',',$datas[0]);
				  // print_r($datas);
				  // print_r(count($repairids));
				   $planid = $datas[1];
				   $userid = $datas[2];
				   
				 
					
					 if(count($repairids)<2)
					 {
						
						  $getcount2=Yii::app()->db->createCommand("update MPS_PACKAGEWISE_AMT_DETAILS set userid=$userid,model_id=$model_id,amout = $usertot,makes_id=$makes_id WHERE repairid=$repairids[0] and planid=$planid")->execute();
				
					 }
					 else{
						  foreach($repairids as $repairid)
					  { 
						 
							$getcount2=Yii::app()->db->createCommand("update MPS_PACKAGEWISE_AMT_DETAILS set model_id=$model_id,amout = $usertot,makes_id=$makes_id WHERE repairid=$repairid and planid=$planid")->execute();
					  } 
						
					 }
				
				        $MPSpak=new MPSPACKAGEWISEAMTDETAILS();
						$MPSpak->bookid='BOK'.rand(1111111111,9999999999);
						$MPSpak->serviceid=2;
						$MPSpak->repairid=$repairids;
						$MPSpak->categoryid=$category_id;
						$MPSpak->status=1;
						$MPSpak->planid=$pkid; 
						$MPSpak->amout=$usertot;
						$MPSpak->save();
				
			}
				  
				
		}
		public function actionCarDetails()
		{
			
			
			
			if(isset($_POST['service_job'])&&$_POST['service_job']=='periodic_serv')
			{
			$ser_name="Periodic Service";
			$brand_id=$_POST['post_brand_id'];
			$model_id=$_POST['post_mod_id'];
			$post_brand_id=$_POST['post_brand_nm'];
			$post_mod_id=$_POST['post_mod_nm'];
			$sernm=$_POST['sernm'];			
			$plannm=$_POST['plannm'];
			$payamount=$_POST['payamount'];
			$planid=$_POST['planid'];
			$pkid=$_POST['planid'];
			$mod_path=$_POST['mod_path'];
			
			$adrs=$_POST['hidadrs'];
			
			$picdate=$_POST['hidpicdate'];
			$pickhr=$_POST['hidpickhr'];
			
			$service=$_POST['services1'];
			
			$subservices=explode(',',$service);
			array_pop($subservices);
			$cat_id=Yii::app()->db->createCommand("select category_id as id from MPS_VEHICLES where makes_id='$brand_id' and models_id='$model_id'")->queryAll();
			$cid=$cat_id[0]['id'];
			$service_recommended=Yii::app()->db->createCommand("select repid as id from MPS_RECOMENDED_SERVICE where pkid='$pkid' and periodicstatus=10 and cat_id='$cid'")->queryAll();
			
				$html='';
			foreach($service_recommended as $service_recommendeds)
			{
				$subservices[]=$service_recommendeds['id'];
			}
		

				$html.='';
           
			for($i=0;$i<sizeof($subservices);$i++)
			{
				$sbid=$subservices[$i];
				$service_details=Yii::app()->db->createCommand("select * from MPS_SUB_REPAIRLIST_DETAILS where repairid='$sbid' ")->queryAll();
				
				$rbid=$service_details[0]['repairid'];
				$repair_name=Yii::app()->db->createCommand("select sname as name from MPS_CARSERVICESLIST_DETAILS where id='$rbid' ")->queryAll();
				
			  	   $html.= '<div class="col-md-4">
                                         <h3 class="block-title">'.$repair_name[0]['name'].'</h3><ul class="list-check">';
						
						 foreach($service_details as $basiclist)
						{
							//echo $basiclist['subvalue'];
							 $html.= '<li>'.$basiclist['subvalue'].'</li>';
						} 
						 $html.= '</ul></div>';
                                           
			}
		
			}
			else if(isset($_POST['service_job'])&&$_POST['service_job']=='repair_serv')
			{
			$ser_name="Repair Job";
			$brand_id=$_POST['post_brand_id'];
			$model_id=$_POST['post_mod_id'];
			
			$post_brand_id=$_POST['post_brand_nm'];
			$post_mod_id=$_POST['post_mod_nm'];
			$sernm=$_POST['sernm'];			
			$plannm=$_POST['plannm'];
			$planid=$_POST['planid'];
			$payamount=$_POST['payamount'];
			$pkid=$_POST['planid'];
			$mod_path=$_POST['mod_path'];
			
			$adrs=$_POST['hidadrs'];
			$picdate=$_POST['hidpicdate'];
			$pickhr=$_POST['hidpickhr'];
			
			$service=$_POST['services1'];
			
			$subservices=explode(',',$service);
			array_pop($subservices);
			$cat_id=Yii::app()->db->createCommand("select category_id as id from MPS_VEHICLES where makes_id='$brand_id' and models_id='$model_id'")->queryAll();
			$cid=$cat_id[0]['id'];
			
		

				$html.='';
           
				for($i=0;$i<sizeof($subservices);$i++)
				{
					$sbid=$subservices[$i];
					$service_details=Yii::app()->db->createCommand("select * from MPS_SUB_REPAIRLIST_DETAILS where repairid='$sbid' ")->queryAll();
					
					$rbid=$service_details[0]['repairid'];
					$repair_name=Yii::app()->db->createCommand("select sname as name from MPS_CARSERVICESLIST_DETAILS where id='$rbid' ")->queryAll();
					
				  
								   $html.= '<div class="col-md-4">
											 <h3 class="block-title">'.$repair_name[0]['name'].'</h3><ul class="list-check">';
							
							 foreach($service_details as $basiclist)
							{
								//echo $basiclist['subvalue'];
								 $html.= '<li>'.$basiclist['subvalue'].'</li>';
							} 
							 $html.= '</ul></div>';
											   
				}
				
			}elseif(isset($_POST['service_job'])&&$_POST['service_job']=='general_serv')
			{
			$ser_name="General Service";
			$brand_id=$_POST['post_brand_id'];
			$model_id=$_POST['post_mod_id'];
			
			$post_brand_id=$_POST['post_brand_nm'];
			$post_mod_id=$_POST['post_mod_nm'];
			$payamount=$_POST['payamount'];
			$sernm=$_POST['sernm'];			
			$plannm=$_POST['plannm'];
			$planid=$_POST['planid'];
			$pkid=$_POST['planid'];
			$mod_path=$_POST['mod_path'];
			$service=$_POST['services1'];
			
			$adrs=$_POST['hidadrs'];
			$picdate=$_POST['hidpicdate'];
			$pickhr=$_POST['hidpickhr'];
			
			$cat_id=Yii::app()->db->createCommand("select category_id as id from MPS_VEHICLES where makes_id='$brand_id' and models_id='$model_id'")->queryAll();
			$cid=$cat_id[0]['id'];
			
		

				$basicid=Yii::app()->db->createCommand("SELECT mcd.sname as name,mcd.id as id FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$plannm=$planid group by mcd.id")->queryAll();
				
				foreach($basicid as $basicids)
				{
					$subservices[]=$basicids['id'];
				}
				
			$html.='';
					
				for($i=0;$i<sizeof($subservices);$i++)
				{
					$sbid=$subservices[$i];
					$service_details=Yii::app()->db->createCommand("select * from MPS_SUB_REPAIRLIST_DETAILS where repairid='$sbid' ")->queryAll();
					
					$rbid=$service_details[0]['repairid'];
					$rbidarray[]=$service_details[0]['repairid'];
					$repair_name=Yii::app()->db->createCommand("select sname as name from MPS_CARSERVICESLIST_DETAILS where id='$rbid'")->queryAll();
					
				   $html.= '<div class="col-md-4">
											 <h3 class="block-title">'.$repair_name[0]['name'].'</h3><ul class="list-check">';
							
							 foreach($service_details as $basiclist)
							{
								//echo $basiclist['subvalue'];
								 $html.= '<li>'.$basiclist['subvalue'].'</li>';
							} 
							 $html.= '</ul></div>';
							 
											   
				}
			
			}
		    $repair_id_lists=implode(',',$rbidarray);
			
			/* if(!empty(Yii::app()->session['username']))
			{
				 $lastid=Yii::app()->session['lastid'];
				 $getuserinfo=Yii::app()->db->createCommand("SELECT `username`,  `emailid`, `mobile_no` FROM `MPS_CUSTOMER_INFO` where id=$lastid")->queryAll();
				
				 foreach($getuserinfo as $getuser)
				 {
					 $pickadrs=$getuser['pickadrs'];
					 $pickhr=$getuser['pickhr'];
					 $pickdate=$getuser['pickdate'];
					 $payamount=$getuser['amout'];
				 }  
				
				
			} */
			
			 $this->render('user_book',array("brand_name"=>$post_brand_id,"model_name"=>$post_mod_id,"html"=>$html,"sernm"=>$sernm,
			"img_path"=>$mod_path,"payamount"=>$payamount,"servicename"=>$ser_name,"planname"=>$plannm,
			"repair_ids"=>$repair_id_lists,"category_id"=>$cid,"brand_id"=>$brand_id,"model_id"=>$model_id,"adrs"=>$adrs,
			"picdate"=>$picdate,"pickhr"=>$pickhr));
		 
		}
		public function FetchRepairListsall()
		{		
		
			     //$makes_id=$_POST['makes_id'];
				  $model_id=$_POST['model_id'];
				//exit;
				
				$GETCATEIDs=Yii::app()->db->createCommand("SELECT  `category_id` FROM `MPS_VEHICLES` WHERE models_id=$model_id")->queryAll();
			foreach($GETCATEIDs as $GETCATEID)
					{
						echo $category_id=$GETCATEID['category_id'];
					} 
			exit;
					$basicid=Yii::app()->db->createCommand("SELECT distinct mcd.sname,mcd.id,count(mcd.id) FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as 	msr where mcd.id=msr.repairid and msr.basic=1 group by mcd.id")->queryAll();
					$html='';
					foreach($basicid as $basici)
					{
						 $id=$basici['id'];
						// echo "SELECT msr.sname,msr.subvalue FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and basic in (1) and repairid =$id";
						 $html.= '<div class="col-md-4">
                                        <h3 class="block-title">'.$basici['sname'].'</h3>
										<ul class="list-check">';
						$basiclists=Yii::app()->db->createCommand("SELECT msr.sname,msr.subvalue FROM 
						`MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr
						where mcd.id=msr.repairid and msr.basic=1 and repairid =$id")->queryAll();
						
						
						
						
						 foreach($basiclists as $basiclist)
						{
							//echo $basiclist['subvalue'];
							 $html.= '<li>'.$basiclist['subvalue'].'</li>';
						} 
						 $html.= '</ul></div>';
					}
				
					
					echo  $html;
		}
        
		public function actionLoginSession()
		{
			if(empty(Yii::app()->session['username']))
			{
				$this->redirect('Booking');
			}
			
		}
		public function actionFetchRepairListsPeriodic()
		{
			  session_start();
			  $sess_id=session_id();
			  $model_id=$_POST['model_id'];
			  $pkid=$_POST['pkid'];
		
		
            $GETdetails=Yii::app()->db->createCommand("SELECT  `pkname` FROM `MPS_SERVICE_PACKAGE_DETAILS` 
			where packageid = $pkid ")->queryAll();
			
			 foreach($GETdetails as $GETdet)
					{	 
					 $pknm=$GETdet['pkname'];
					}
			$GETCATEIDs=Yii::app()->db->createCommand("SELECT  category_id as cat_id FROM MPS_VEHICLES WHERE models_id='$model_id'")->queryAll();
		
						$category_id=$GETCATEIDs[0]['cat_id'];
					
					 $html='<script src="'.Yii::app()->baseUrl.'/assets/plugins/jquery/jquery-1.11.1.min.js"></script>
					 <input type="hidden" name="disamt" id="disamt'.$pkid.'"/>';
					 
					 $amtvalue='';
				

					 $fetchrepiarid=Yii::app()->db->createCommand("SELECT `repid` FROM `MPS_RECOMENDED_SERVICE` WHERE `pkid`=$pkid and periodicstatus=10")->queryAll();
					// $fetchrestatus=Yii::app()->db->createCommand("SELECT mcd.sname,msr.srepairid,mcd.id,count(mcd.id) FROM `MPS_CARSERVICESLIST_DETAILS` 
					// as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$pknm=$pkid group by mcd.id")->queryAll();
					/* if(count($fetchrepiarid)>0)
					{
						
							foreach($fetchrepiarid as $fetchrepia)
							{
								$repid[]=$fetchrepia['repid'];
							}
							 $repid=implode(',',$repid);
					}
					else{ */
					$sub_amtt=0;
						    foreach($fetchrepiarid as $fetchres)
							{
								 $repid=$fetchres['repid'];
								 $fetchsrepairid=Yii::app()->db->createCommand("SELECT  srepairid FROM `MPS_SUB_REPAIRLIST_DETAILS` WHERE `repairid`=$repid and $pknm=$pkid")->queryAll();
					
					
								 foreach($fetchsrepairid as $fetchsrepai)
									{
										//echo $basiclist['subvalue'];
										 $basicsubid= $fetchsrepai['srepairid'];
										 $fetch_amount=Yii::app()->db->createCommand("select  `amount` FROM `repairlist_package_details` WHERE `subrepair_id`=$basicsubid and `repair_id`= $repid and category_id=$category_id")->queryAll();
										
									/*  */
										
								
									}
								
								foreach($fetch_amount as $sub_amt)
										{
											    $sub_amtt+=$sub_amt['amount'];
										}
								
									
									
							}
						
					
				
				
				
			
						
				$basicamts=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from repairlist_package_details as a,MPS_RECOMENDED_SERVICE as b where  b.repid=a.repair_id and a.repair_id in ($repid) and b.pkid=$pkid and a.category_id=$category_id")->queryAll();
					
					
					 foreach($basicamts as $basicamt)
						{
							//echo $basiclist['subvalue'];
							$basicamt= $basicamt['amount'];
						}
						
						
				 
			 	 $basicid=Yii::app()->db->createCommand("SELECT mcd.sname,msr.srepairid,mcd.id,count(mcd.id) FROM `MPS_CARSERVICESLIST_DETAILS` 
				 as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.$pknm=$pkid group by mcd.id")->queryAll();
					
					foreach($basicid as $basici)
					{
						 $id=$basici['id'];
						 $sid=$basici['srepairid'];
						 //echo "SELECT sum(`amount`) as amt FROM `repairlist_package_details` WHERE 
						 //repair_id= $id and subrepair_id= $sid and category_id=$category_id";
						 $getsum=Yii::app()->db->createCommand("SELECT sum(`amount`) as amt FROM `repairlist_package_details` WHERE 
						 repair_id in ($repid) and subrepair_id= $sid and category_id=$category_id")->queryAll();
						 foreach($getsum as $amout)
						 {
							 $amt=$amout['amt'];
							 
						 }
						 
						 $basicamtspak=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from 
						 MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a 
						 where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.repairid=$id and b.$pknm=$pkid and a.category_id=$category_id")->queryAll();
						foreach($basicamtspak as $basicpak)
						{
							//echo $basiclist['subvalue'];
							 $basicamtpack= $basicpak['amount'];
						}
						 if(empty($basicamtpack))
						 {
							 $basicamtpack = 0;
						 }
						// $total=$amt+=$amt;
						 $getcoun1t=Yii::app()->db->createCommand("SELECT  `repairid` FROM `MPS_PACKAGEWISE_AMT_DETAILS` WHERE repairid=$id and 
						 planid=$pkid and categoryid=$category_id and status=1 and sess_id='$sess_id'")->queryAll();
						
						if(count($getcoun1t)>0)
						{
						 foreach($getcoun1t as $getco)
						 {
							 $idty[]=$getco['repairid'];
						 }
						 if(!empty($idty))
						{
						  $rat=implode(',',$idty);
						}
						else
						{
							$rat=0;
						}
						}
						else{
							 $getcoun1t=Yii::app()->db->createCommand("SELECT  `repid` FROM `MPS_RECOMENDED_SERVICE` WHERE repid=$id and 
							 pkid=$pkid and cat_id=$category_id and periodicstatus=10")->queryAll();
							 foreach($getcoun1t as $getco)
							 {
								 $idty[]=$getco['repid'];
							 }
							 if(!empty($idty))
							{
							  $rat=implode(',',$idty);
							}
							else
							{
								$rat=0;
							}
						}
						 
						 /*  $getcount=Yii::app()->db->createCommand("SELECT  `id` FROM `MPS_PACKAGEWISE_AMT_DETAILS` WHERE 
						  repairid=$id and planid=$pkid and status=1 and categoryid=$category_id and sess_id='$sess_id'")->queryAll();
						   */
						  $count=Yii::app()->db->createCommand("SELECT id  FROM MPS_RECOMENDED_SERVICE WHERE periodicstatus=10 and repid='$id' and 
			             pkid='$pkid' and cat_id='$category_id'")->queryAll();
						
						/* if(count($getcount)>0)
						{ */
						 if(count($count)>0)
							{
							
							
								$html.= '<div class="col-md-4">
                                      <h3 class="block-title"><font color="green">'.$basici['sname'].'</font></h3>
										<ul class="list-check">';
										
							}
							else
							{
								
								$html.= '<div class="col-md-4">
                                      <h3 class="block-title"><input type="checkbox" id="chk1'.($id).''.$pkid.'"  
									  name="check" class="checkbox_check" onclick="check1('.$id.','.$pkid.');" />'.$basici['sname'].'</h3>
										<ul class="list-check">';
							}
					/* 	}
						else{
							 if(count($count)>0)
							{
						
							 $html.= '<div class="col-md-4">
                                      <h3 class="block-title"><font color="green">'.$basici['sname'].'</font></h3>
										<ul class="list-check">';
							}
							else
							{
								 $html.= '<div class="col-md-4">
                                      <h3 class="block-title"><input type="checkbox" id="chk1'.($id+1).'chk1'.$pkid.'" value="'.$id.'-'.$amt.'-'.$pkid.'" 
									  name="check" class="checkbox_check"/>'.$basici['sname'].'</h3>
										<ul class="list-check">';
							}
						} */
						$basiclists=Yii::app()->db->createCommand("SELECT distinct msr.sname,msr.srepairid,msr.subvalue FROM 
						`MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr 
						where mcd.id=msr.repairid and msr.$pknm=$pkid and msr.repairid=$id")->queryAll();
						
						
						
						
						 foreach($basiclists as $basiclist)
						{
							//echo $basiclist['subvalue'];
							 $html.= '<li>'.$basiclist['subvalue'].'</li>';
							 $srepairid=$basiclist['srepairid'];
						} 
						
						$basnan=Yii::app()->db->createCommand("SELECT sum(`amout`) as amt
						FROM `MPS_PACKAGEWISE_AMT_DETAILS` WHERE `planid`=$pkid and categoryid=$category_id and sess_id='$sess_id'")->queryAll();
						
						
						
						
						 foreach($basnan as $basna)
						{
							//echo $basiclist['subvalue'];
							
							 $planamt=$basna['amt'];
						} 
						$total = $basicamt+$amt;
						if($basicamt == $planamt)
						{
							$finalvalue = $basicamt;
						}
						else
						{
							 $finalvalue = $basicamt+$planamt;
						}
						//$$basicamt-$amt;
						 $html.= '</ul></div>';
					}
				
					 
						 $servicehr=Yii::app()->db->createCommand("SELECT servicehr as hour from MPS_SERVICE_PACKAGE_DETAILS where id=$pkid")->queryAll();
						  foreach($servicehr as $hour)
						{
							//echo $basiclist['subvalue'];
							 $servhr= $hour['hour'];
						} 
				$html.='<input type="hidden" name="val" id="val'.$pkid.'" value="'.$rat.'-'.$pkid.'-'.Yii::app()->session['lastid'].'"/>';
			
				echo  $html.'**'.'Package:'.($sub_amtt).'**'.$servhr.'**'.$pkid.'**'.($sub_amtt+$planamt);
		}
		public function actionSaveOthers()
		{
			
				
				
				if(isset($_POST['other_makes_id'],$_POST['other_model_id'],$_POST['addinfo']))
				{
					$makeid = $_POST['other_makes_id'];
					$modelid = $_POST['other_model_id'];
					$addinfo = $_POST['addinfo'];
					$url2 = 'upload/'.$_FILES['vefinfo']['name'];
					$logoencrypted = base64_encode($url2);
				
			    $allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
				$extension = pathinfo($_FILES['vefinfo']['name'], PATHINFO_EXTENSION);

				if ((($_FILES["vefinfo"]["type"] == "video/mp4")
				|| ($_FILES["vefinfo"]["type"] == "audio/mp3")
				|| ($_FILES["vefinfo"]["type"] == "audio/wma")
				|| ($_FILES["vefinfo"]["type"] == "image/pjpeg")
				|| ($_FILES["vefinfo"]["type"] == "image/gif"))

				&& ($_FILES["vefinfo"]["size"] < 20000000)
				&& in_array($extension, $allowedExts))
					{
				  if ($_FILES["vefinfo"]["error"] > 0)
					{
					echo "Return Code: " . $_FILES["vefinfo"]["error"] . "<br />";
					}
				  else
					{
					
					if (file_exists("mpsvedioes/" . $_FILES["vefinfo"]["name"]))
					  {
					  echo $_FILES["vefinfo"]["name"] . " already exists. ";
					  }
					else
					  {
					  move_uploaded_file($_FILES["vefinfo"]["tmp_name"],
					  "mpsvedioes/" . $_FILES["vefinfo"]["name"]);
					  
					  }
					}
				  }
				else
				  {
				  $message = "Invalid file";
				  }
				  
				  $fetcount=Yii::app()->db->createCommand("SELECT id FROM MPS_OTHER_SERVICE_INFO WHERE makeid=$makeid and modelid=$modelid")->queryAll();
				  if(count($fetcount)>0)
				  {
					  $sql=Yii::app()->db->createCommand("UPDATE MPS_OTHER_SERVICE_INFO SET comments='$addinfo',vediopath='$logoencrypted' WHERE makeid=$makeid and modelid=$modelid")->execute();
				  }
				  else{
					$MPS_OTHER=new MPS_OTHER_SERVICE_INFO();	
					$MPS_OTHER->makeid=$makeid;
					$MPS_OTHER->modelid=$modelid;
					$MPS_OTHER->comments=$addinfo;
					$MPS_OTHER->vediopath=$logoencrypted;
					$MPS_OTHER->save();   
				  }
				  $message='success';
				  if(!isset($message))
				  {
					  $message='';
				  }
				  //$this->redirect('bookService',array('message'=>$message));
				  $this->redirect('Booking?message='.$message.'');
				}
				 else
				 {
					 $this->redirect('Booking');
				 }					 
				  //$uploadfile1 = $url2 .basename($_FILES['vefinfo']['tmp_name']);
				   
		}
		public function actionSaveamoutbyPackage()
		{
			$arr=array_unique($_POST['datas']);
			
			$packid=$_POST['rpackage'];
			//$val=implode(',',$arr);
			$rt=explode(',',$arr);
			//print_r($rt);
			 foreach($rt as $rtt=>$val)
			{
				 
				$MPSCUSTOMER=new MPSPACKAGEWISEAMTDETAILS();	
				$MPSCUSTOMER->planid=$packid;
				$MPSCUSTOMER->total=$val;
				$MPSCUSTOMER->serviceid=2;
				$MPSCUSTOMER->save(); 
				//echo '0';
			} 
			
		
		}
		public function actionsaveInput()
		{
			     session_start();
				 $sess_id=session_id();
			     $userid=Yii::app()->session['lastid'];
				 Yii::app()->session['sess_id']=$sess_id;
				 
			     $model_id=$_POST['model_id'];
				 $makes_id=$_POST['makes_id'];
				 $repairid=$_POST['repair_id'];
				 $checked=1;
				 $amount=$_POST['amount'];
				 $planid=$_POST['planid'];
				 $serviceid=$_POST['serviceid'];
			     $categoryid=$_POST['category_id'];
				 
				  $pickadrs=$_POST['pickadrs'];
				 $pickdate=$_POST['pickdate'];
				 $pickhr=$_POST['pickhr']; 
				
				//echo $model_id.'**'. $makes_id.'**'. $planid.'**'.$categoryid;
				//exit;
				
			     $MPSpak=new MPSPACKAGEWISEAMTDETAILS();
				 $MPSpak->bookid='BOK'.rand(1111111111,9999999999);
				 $MPSpak->sess_id=$sess_id;
				$MPSpak->serviceid=$serviceid;
				$MPSpak->planid=$planid;
				$MPSpak->userid=$userid;
				$MPSpak->model_id=$model_id;
				$MPSpak->makes_id=$makes_id;
				$MPSpak->repairid=$repairid;
				$MPSpak->status=$checked;
				$MPSpak->amout=$amount; 
				$MPSpak->pickadrs=$pickadrs; 
				$MPSpak->pickdate=$pickdate;
				$MPSpak->pickhr=$pickhr; 
				$MPSpak->categoryid=$categoryid; 

				
				$MPSpak->save(); 
				
				echo '1';
				/* }
				else
				{ */
					
					/* if(isset(Yii::app()->session['lastid']))
					{
						$userid=Yii::app()->session['lastid'];
						$getcount2=Yii::app()->db->createCommand("update  MPS_PACKAGEWISE_AMT_DETAILS set status=1,userid=$userid WHERE repairid=$repairid 
						and planid=$planid and sess_id='$sess_id'")->execute();
					}
					else{
					$getcount2=Yii::app()->db->createCommand("update  MPS_PACKAGEWISE_AMT_DETAILS set status=1,userid=0 WHERE repairid=$repairid 
					 and planid=$planid and sess_id='$sess_id'")->execute();
					} */
				//}
		}
		
		public function actionUncheckInput()
		{
			    $repairid=$_POST['repairid'];
				$sess_id=$_POST['sess_id'];
				$checked=$_POST['checked'];
				$planid=$_POST['planid'];
				$categoryid=$_POST['categoryid'];
				$getcount=Yii::app()->db->createCommand("SELECT  `id` FROM `MPS_PACKAGEWISE_AMT_DETAILS` WHERE repairid=$repairid and planid=$planid
				and categoryid=$categoryid and sess_id='$sess_id'")->queryAll();
				if(count($getcount)>0)
				{
					//echo count($getcount);
					 $getcount2=Yii::app()->db->createCommand("update  MPS_PACKAGEWISE_AMT_DETAILS set status=0 WHERE repairid=$repairid 
					 and planid=$planid and categoryid=$categoryid and sess_id='$sess_id'")->execute();
					echo 'updated';
				}
				
		}
		
		public function actionFetchRepairLists()
		{
			//echo "inside";
			  //$makes_id=$_POST['makes_id'];
			 $model_id=$_POST['model_id'];
			//exit;
			
			$GETCATEIDs=Yii::app()->db->createCommand("SELECT  `category_id` FROM `MPS_VEHICLES` WHERE models_id=$model_id")->queryAll();
			foreach($GETCATEIDs as $GETCATEID)
					{
						$category_id=$GETCATEID['category_id'];
					} 
					
			    $amtvalue='';
				$basicid=Yii::app()->db->createCommand("SELECT mcd.sname,mcd.id,count(mcd.id) FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.basic=1 group by mcd.id")->queryAll();
					$html='';
					foreach($basicid as $basici)
					{
						 $id=$basici['id'];
						// echo "SELECT msr.sname,msr.subvalue FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and basic in (1) and repairid =$id";
						 $html.= '<div class="col-md-4">
                                        <h3 class="block-title">'.$basici['sname'].'</h3>
										<ul class="list-check">';
						$basiclists=Yii::app()->db->createCommand("SELECT distinct msr.sname,msr.subvalue FROM `MPS_CARSERVICESLIST_DETAILS` as mcd,MPS_SUB_REPAIRLIST_DETAILS as msr where mcd.id=msr.repairid and msr.basic=1 and repairid =$id")->queryAll();
						
						
						
						
						 foreach($basiclists as $basiclist)
						{
							//echo $basiclist['subvalue'];
							 $html.= '<li>'.$basiclist['subvalue'].'</li>';
						} 
						 $html.= '</ul></div>';
					}
				
					 $basicamts=Yii::app()->db->createCommand("SELECT sum(a.amount) as amount from 
					 MPS_SUB_REPAIRLIST_DETAILS as b,repairlist_package_details as a 
					 where a.repair_id=b.repairid and a.subrepair_id=b.srepairid and b.basic=1 and a.category_id=$category_id")->queryAll();
					 foreach($basicamts as $basicamt)
						{
							//echo $basiclist['subvalue'];
							 $basicamt= $basicamt['amount'];
						} 
						 $servicehr=Yii::app()->db->createCommand("SELECT servicehr as hour from MPS_SERVICE_PACKAGE_DETAILS where id=1")->queryAll();
						  foreach($servicehr as $hour)
						{
							//echo $basiclist['subvalue'];
							 $servhr= $hour['hour'];
						} 
				//	exit;
					echo  $html.'**'.$basicamt.'**'.$servhr;
					//echo $amts;
			
				
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
			$MPSCUSTOMER->loginid=$lastid;			
			$MPSCUSTOMER->username=$Usernmame;
			$MPSCUSTOMER->password=md5($upwd);
			$MPSCUSTOMER->otp_status=1;
			$MPSCUSTOMER->save(); 
			Yii::app()->session['username'] = $uname;
			echo '1';
		}
		public function actionRegister()
		{
			/* if(!isset(Yii::app()->session['lastid']))
			{ */
			$picdate=$_POST['picdate'];
			$pickhr=$_POST['pickhr'];
		    $adrs=$_POST['adrs'];
			$amount=$_POST['amount']; 	
			$makes_id=$_POST['makes_id'];
			//$makes_id=$_POST['makes_id'];
			$packageid=$_POST['packageid'];
			$model_id=$_POST['model_id'];
			$upwd=$_POST['upwd'];
			$mobNo=$_POST['mobNo'];
			$uname=$_POST['uname'];
			$hideamt=$_POST['hideamt'];
			
			//$adrs=$_POST['adrs'];
			if(empty($_POST['location']))
		      {
			//echo 'sjflk';
			    $bodytag = str_replace(" ", "+", "$adrs");
				/*$url = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$bodytag&sensor=false&region=india");
				$response = json_decode($url);
				$latitude = $response->results[0]->geometry->location->lat;
				$longitude = $response->results[0]->geometry->location->lng;*/
				$url = "http://maps.google.com/maps/api/geocode/json?address=$bodytag&sensor=false&region=India";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$response = curl_exec($ch);
				curl_close($ch);
				$response_a = json_decode($response);
				 $latitude = $response_a->results[0]->geometry->location->lat;
				//echo "<br />";
				 $longitude = $response_a->results[0]->geometry->location->lng;
		
		       }
				else{
					  //echo 'dvhxlk';
					$location=$_POST['location'];
					$explode=explode(',',$location);
					$longitude=$explode[0];
					$latitude=$explode[1]; 
				}
		
		
			//
				
		
		 $Usernmame=$_POST['regemail'];
		
		//exit;
		$MPSCUSTOMERINFO=new MPSCUSTOMERINFO();	
		$MPSCUSTOMERINFO->username=$uname;
		$MPSCUSTOMERINFO->emailid=$Usernmame; 
		$MPSCUSTOMERINFO->mobile_no=$mobNo; 
		$MPSCUSTOMERINFO->location=$adrs; 
		$MPSCUSTOMERINFO->longitude=$longitude; 
		$MPSCUSTOMERINFO->latitude=$latitude; 
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
			
		 $MPSCUSTSERVICEDETAILS=new MPSCUSTSERVICEDETAILS();
		 $MPSCUSTSERVICEDETAILS->variant='car';	
		 $MPSCUSTSERVICEDETAILS->bookid='BOK'.rand(1111111111,9999999999);		 
		 $MPSCUSTSERVICEDETAILS->pickadrs=$adrs;		 
		 $MPSCUSTSERVICEDETAILS->pickdate=$picdate;
		 $MPSCUSTSERVICEDETAILS->pickhr=$pickhr;
		 $MPSCUSTSERVICEDETAILS->amount=$hideamt;
		 $MPSCUSTSERVICEDETAILS->packageid=$packageid;
		 $MPSCUSTSERVICEDETAILS->makesid=$makes_id;
		 $MPSCUSTSERVICEDETAILS->modelid=$model_id;
		 
		 $MPSCUSTSERVICEDETAILS->save();
				 
				 
				 
				 
		$getcarImages=Yii::app()->db->createCommand("SELECT 
		`car_img` FROM `MPS_VEHICLES` WHERE makes_id=$makes_id and models_id=$model_id")->queryAll();
	    foreach($getcarImages as $carimgg)
		{
			 $carimg=$carimgg['car_img'];
		}	
		if(!empty($carimg))
		{
			Yii::app()->session['car_img'] = $carimg;
			$carimgg=$carimg;
		}
		else
		{
			 Yii::app()->session['car_img'] = '/images/uploadimages/models/car/php2C3E.tmp';
			 $carimgg='/images/uploadimages/models/car/php2C3E.tmp';
		}
		
		//fetch makes name and model name
		$getcarnames=Yii::app()->db->createCommand("SELECT distinct MPS_VEHICLE_MODELS.`models_name`,MPS_VEHICLE_MAKES.makes_name 
		FROM `MPS_VEHICLE_MODELS`,MPS_VEHICLE_MAKES WHERE MPS_VEHICLE_MODELS.makes_id=MPS_VEHICLE_MAKES.makes_id
		and MPS_VEHICLE_MAKES.makes_id=$makes_id and MPS_VEHICLE_MODELS.models_id=$model_id")->queryAll();
	    foreach($getcarnames as $getcarname)
		{
			 $getcarnmodel=$getcarname['models_name'];
			 $getcarmake=$getcarname['makes_name'];
		}
		
		$MPSVEHADDEDDETAIL=new MPSVEHADDEDDETAILS();	
		$MPSVEHADDEDDETAIL->makes_id=$makes_id;
		$MPSVEHADDEDDETAIL->model_id=$model_id;
		$MPSVEHADDEDDETAIL->user_id=$lastid;
		$MPSVEHADDEDDETAIL->imgpath=$carimgg;
		$MPSVEHADDEDDETAIL->makes_name=$getcarmake;
		$MPSVEHADDEDDETAIL->models_name=$getcarnmodel;
		$MPSVEHADDEDDETAIL->save();
		  
		echo '1';
			/* }
			else{
				echo '2';
			} */
		//exit;
			
		
		
			
		}
		public function actionChecklogin()
	     {
			 
				  /* if(!Yii::app()->user->isGuest)
				 {
						   $this->redirect(array('login'));
				 } */
			 
				 $uname=$_POST['uname'];
				 $password=$_POST['password'];
				 
				 $getpassword=Yii::app()->db->createCommand("SELECT `id`, `username`, `password`, `status` FROM `MPS_CUSTOMERACC_INFO` 
				 WHERE username='$uname' and password='".md5($password)."' and otp_status=1")->queryAll();
					 foreach($getpassword as $getpwd)
					{
						 $userid=$getpwd['id'];
						 $username=$getpwd['username'];
					}
				
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
		public function actionloginuser()
	     {
			
			if(empty(Yii::app()->session['username']))
			{
			   $uname=$_POST['uname'];
			  $getuserid=Yii::app()->db->createCommand("SELECT  username,id FROM  `MPS_CUSTOMER_INFO` WHERE emailid =  '$uname'")->queryAll();
					 foreach($getuserid as $getuser)
					{
						  $username=$getuser['username'];
						  $userid=$getuser['id'];
						 
					}
			  $password=$_POST['password'];
			  $pickadrs=$_POST['pickadrs'];
			 $picdate=$_POST['picdate'];
			 $pickhr=$_POST['pickhr'];
			 $makes_id=$_POST['makes_id'];
			 $model_id=$_POST['model_id']; 
			 $amount=$_POST['amount']; 
			 $amountp=explode('Rs.',$amount);
			 $packageid=$_POST['packageid']; 
			 
			 
			 
			 
			
			
			Yii::app()->session['username']=$username;
			/* $model_idd=$_POST['model_idd'];
			$makes_idd=$_POST['makes_idd']; */
			
		$getpassword=Yii::app()->db->createCommand("SELECT `id`, `username`, `password`, `status` FROM `MPS_CUSTOMERACC_INFO` 
		WHERE username='$uname' and password='$password'")->queryAll();
		 foreach($getpassword as $getpwd)
		{
			 $userid=$getpwd['id'];
		} 
		if(empty($userid))
		{
			$userid=0;
			
		}
		else
		{
			Yii::app()->session['lastid']=$userid;
			$userid=$userid;
		}
		
		
		
		if(count($getpassword)>0)
		{
		$getcountmodel=Yii::app()->db->createCommand("SELECT  id FROM  `MPSCUSTSERVICE_DETAILS` WHERE makesid =  $makes_id and modelid = $model_id and packageid=$packageid")->queryAll();
		if(count($getcountmodel)>0)
		{
			$getcount2=Yii::app()->db->createCommand("update MPSCUSTSERVICE_DETAILS set amount=$amountp[1] WHERE packageid=$packageid")->execute();
		}
		else{
			     Yii::app()->session['lastid']=$userid;
				
				 $MPSCUSTSERVICEDETAILS=new MPSCUSTSERVICEDETAILS();
				 $MPSCUSTSERVICEDETAILS->bookid='BOK'.rand(1111111111,9999999999);			 
				 $MPSCUSTSERVICEDETAILS->pickadrs=$pickadrs;
				 $MPSCUSTSERVICEDETAILS->custid=$userid;
				 $MPSCUSTSERVICEDETAILS->pickdate=$picdate; 
				 $MPSCUSTSERVICEDETAILS->pickhr=$pickhr; 
				 $MPSCUSTSERVICEDETAILS->modelid=$model_id; 
				 $MPSCUSTSERVICEDETAILS->makesid=$makes_id; 
				
				 $MPSCUSTSERVICEDETAILS->packageid=$packageid; 
				 $MPSCUSTSERVICEDETAILS->amount=$amountp[1]; 
				 $MPSCUSTSERVICEDETAILS->save();
		}				 

		}
		else if(empty($userid))
		{
			echo '1';
		}
		else
		{
			echo '1';
		}
		}
			
	
}
	public function actionFetchmechanicPersons()
	{
		
		//$var=$_POST['adrs'];
		
		$dom = new DOMDocument("1.0");
		$node = $dom->createElement("markers");
		$parnode = $dom->appendChild($node);
		header("Content-type: text/xml");
		$detailslogos=Yii::app()->db->createCommand("SELECT distinct MPS_CUSTOMER_INFO.location,MPS_CUSTOMER_INFO.longitude,MPS_CUSTOMER_INFO.latitude
							FROM MPS_CUSTOMER_INFO")->queryAll();
							foreach($detailslogos as $del)
							{
								  $node = $dom->createElement("marker");
								  $newnode = $parnode->appendChild($node);
								  //$newnode->setAttribute("location",$del['location']);	
								  $newnode->setAttribute("longitude",$del['longitude']);
								  $newnode->setAttribute("latitude",$del['latitude']);
								  
							}
		echo $data= $dom->saveXML();
		//$this->render('googlemap');
	}
	public function actionFetchmechanicsonLocations()
	{
		$locations=Yii::app()->session['location'];
		
		
		
		$dom = new DOMDocument("1.0");
		$node = $dom->createElement("markers");
		$parnode = $dom->appendChild($node);
		header("Content-type: text/xml");
		$detailslogos=Yii::app()->db->createCommand("SELECT distinct MPS_CUSTOMER_INFO.location,MPS_CUSTOMER_INFO.longitude,MPS_CUSTOMER_INFO.latitude
							FROM MPS_CUSTOMER_INFO where MPS_CUSTOMER_INFO.location='$locations'")->queryAll();
							foreach($detailslogos as $del)
							{
								  $node = $dom->createElement("marker");
								  $newnode = $parnode->appendChild($node);
								 
								  $newnode->setAttribute("longitude",$del['longitude']);
								  $newnode->setAttribute("latitude",$del['latitude']);
								  
							}
		echo $data= $dom->saveXML();
		
		
	}
	public function actionDashboard()
	{
		
		/* if($session->isActive)
		{} */
	  unset(Yii::app()->session['username']);
	  unset(Yii::app()->session['lastid']);
	    
//		$session->destroy();
		//$session->close();

// destroys all data registered to a session.
		//$session->destroy();
		$this->actionAddVehicle();
	}
	public function actionAddVehicle()
	{  
	
	if(isset($_GET['name']))
	{
		Yii::app()->session['username']=$_GET['name'];
	}
			$fetcheconomiccar=Yii::app()->db->createCommand("SELECT distinct SLD_ADD_VEHICLE.model_id,SLD_ADD_VEHICLE.seating_capacity,SLD_ADD_VEHICLE.img_path,mpk.makes_name,mvm.models_name,
		 SLD_ADD_VEHICLE.price_per_hour as price_per_hour, SLD_ADD_VEHICLE.price as price, SLD_ADD_VEHICLE.total_kms
		FROM SLD_ADD_VEHICLE,MPS_VEHICLE_MAKES as mpk,MPS_VEHICLE_MODELS as mvm where  vehicle_category='economic' and mpk.makes_id=SLD_ADD_VEHICLE.makes_id and SLD_ADD_VEHICLE.model_id=mvm.models_id")->queryAll();
		
	    $fetchebusinesscar=Yii::app()->db->createCommand("SELECT distinct SLD_ADD_VEHICLE.model_id,SLD_ADD_VEHICLE.seating_capacity,SLD_ADD_VEHICLE.img_path,mpk.makes_name,mvm.models_name,
		 SLD_ADD_VEHICLE.price_per_hour as price_per_hour, SLD_ADD_VEHICLE.price as price, SLD_ADD_VEHICLE.total_kms
		FROM SLD_ADD_VEHICLE,MPS_VEHICLE_MAKES as mpk,MPS_VEHICLE_MODELS as mvm where  vehicle_category='business' and mpk.makes_id=SLD_ADD_VEHICLE.makes_id and SLD_ADD_VEHICLE.model_id=mvm.models_id")->queryAll();
		 
	    $fetcheprium=Yii::app()->db->createCommand("SELECT distinct SLD_ADD_VEHICLE.model_id,SLD_ADD_VEHICLE.seating_capacity,SLD_ADD_VEHICLE.img_path,mpk.makes_name,mvm.models_name,
	    SLD_ADD_VEHICLE.price_per_hour as price_per_hour, SLD_ADD_VEHICLE.price as price, SLD_ADD_VEHICLE.total_kms
	    FROM SLD_ADD_VEHICLE,MPS_VEHICLE_MAKES as mpk,MPS_VEHICLE_MODELS as mvm where  vehicle_category='premium' and mpk.makes_id=SLD_ADD_VEHICLE.makes_id and SLD_ADD_VEHICLE.model_id=mvm.models_id")->queryAll();
	
		$fetcheluxury=Yii::app()->db->createCommand("SELECT distinct SLD_ADD_VEHICLE.model_id,SLD_ADD_VEHICLE.seating_capacity,SLD_ADD_VEHICLE.img_path,mpk.makes_name,mvm.models_name,
		 SLD_ADD_VEHICLE.price_per_hour as price_per_hour, SLD_ADD_VEHICLE.price as price, SLD_ADD_VEHICLE.total_kms
		FROM SLD_ADD_VEHICLE,MPS_VEHICLE_MAKES as mpk,MPS_VEHICLE_MODELS as mvm where  vehicle_category='luxury' and mpk.makes_id=SLD_ADD_VEHICLE.makes_id and SLD_ADD_VEHICLE.model_id=mvm.models_id")->queryAll(); 
        
		 $vmake=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MAKES.makes_id,MPS_VEHICLE_MAKES.makes_name,MPS_VEHICLES.logo_img
							FROM MPS_VEHICLES left JOIN MPS_VEHICLE_MAKES ON MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id
							group by  MPS_VEHICLE_MAKES.makes_name")->queryAll();
							
							$this->render('MPSaddVehicle',array('vmakelist'=>$vmake,"fetcheconomic"=>$fetcheconomiccar,"fetchebusinesscar"=>$fetchebusinesscar,"premiumcars"=> $fetcheprium,"fetchluxury"=>$fetcheluxury));
						//$this->render('MPSaddVehicle',array('vmakelist'=>$vmake,"fetcheconomic"=>$fetcheconomiccar));
			
		
	}
	public function actionSaveModificationdetails()
	{
		     $Usernmame=$_POST['regemail'];
			
			$upwd=$_POST['upwd'];
			$mobNo=$_POST['mobNo'];
			$uname=$_POST['uname'];
			
			$makes_id=$_POST['makes_id'];
			$models_id=$_POST['models_id'];
			$modlist=$_POST['modlist'];
			$formFindCarDate=$_POST['formFindCarDate'];
			
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
		
			
			/* $modlist=$_POST['modlist'];
			$formFindCarDate=$_POST['formFindCarDate']; */
			
			$MPSMODINFO=new MPSMODIFICATIONDETAILS();	
			$MPSMODINFO->makes_id=$makes_id;
			$MPSMODINFO->models_id=$models_id; 
			 $MPSMODINFO->use_id=$lastid; 
			$MPSMODINFO->mod_type_id=$modlist; 
			$MPSMODINFO->pickdate=$formFindCarDate;
			$MPSMODINFO->save();
			
			echo '1'; 
		
	}
	public function actionVehicleList()
	{   
	
		$userid=Yii::app()->session['lastid'];
	    $carimgess=Yii::app()->db->createCommand("SELECT distinct MPSVEHADDED_DETAILS.makes_name,MPSVEHADDED_DETAILS.models_name,MPSVEHADDED_DETAILS.`imgpath`
		FROM MPSVEHADDED_DETAILS
		right JOIN  MPS_VEHICLE_MODELS
		ON MPSVEHADDED_DETAILS.model_id= MPS_VEHICLE_MODELS.models_id and MPSVEHADDED_DETAILS.user_id=$userid")->queryAll();
		$carimges=array_filter($carimgess);
		//print_r($carimgess);
//		exit;
		
		$this->render('MPSVehiclelists',array('carimges'=>$carimges,"message"=>"Vehicle added successfully"));
	}
	public function actionPartnersInfo()
	{
		$shopnm=$_POST['shopnm'];
		$ownernm=$_POST['ownernm'];
		$selfemail=$_POST['selfemail'];
		$mechadrs=$_POST['mechadrs'];
		
		
	}
	
	public function actionFetchMoreVehicles()
	{
		$fetcheconomiccar=Yii::app()->db->createCommand("SELECT distinct SLD_ADD_VEHICLE.model_id,SLD_ADD_VEHICLE.seating_capacity,SLD_ADD_VEHICLE.img_path,mpk.makes_name,mvm.models_name,
		 SLD_ADD_VEHICLE.price_per_hour as price_per_hour, SLD_ADD_VEHICLE.price as price, SLD_ADD_VEHICLE.total_kms
		FROM SLD_ADD_VEHICLE,MPS_VEHICLE_MAKES as mpk,MPS_VEHICLE_MODELS as mvm where  vehicle_category='economic' and mpk.makes_id=SLD_ADD_VEHICLE.makes_id and SLD_ADD_VEHICLE.model_id=mvm.models_id")->queryAll();
		
	    $fetchebusinesscar=Yii::app()->db->createCommand("SELECT distinct SLD_ADD_VEHICLE.model_id,SLD_ADD_VEHICLE.seating_capacity,SLD_ADD_VEHICLE.img_path,mpk.makes_name,mvm.models_name,
		 SLD_ADD_VEHICLE.price_per_hour as price_per_hour, SLD_ADD_VEHICLE.price as price, SLD_ADD_VEHICLE.total_kms
		FROM SLD_ADD_VEHICLE,MPS_VEHICLE_MAKES as mpk,MPS_VEHICLE_MODELS as mvm where  vehicle_category='business' and mpk.makes_id=SLD_ADD_VEHICLE.makes_id and SLD_ADD_VEHICLE.model_id=mvm.models_id")->queryAll();
		 
	    $fetcheprium=Yii::app()->db->createCommand("SELECT distinct SLD_ADD_VEHICLE.model_id,SLD_ADD_VEHICLE.seating_capacity,SLD_ADD_VEHICLE.img_path,mpk.makes_name,mvm.models_name,
	    SLD_ADD_VEHICLE.price_per_hour as price_per_hour, SLD_ADD_VEHICLE.price as price, SLD_ADD_VEHICLE.total_kms
	    FROM SLD_ADD_VEHICLE,MPS_VEHICLE_MAKES as mpk,MPS_VEHICLE_MODELS as mvm where  vehicle_category='premium' and mpk.makes_id=SLD_ADD_VEHICLE.makes_id and SLD_ADD_VEHICLE.model_id=mvm.models_id")->queryAll();
	
		$fetcheluxury=Yii::app()->db->createCommand("SELECT distinct SLD_ADD_VEHICLE.model_id,SLD_ADD_VEHICLE.seating_capacity,SLD_ADD_VEHICLE.img_path,mpk.makes_name,mvm.models_name,
		 SLD_ADD_VEHICLE.price_per_hour as price_per_hour, SLD_ADD_VEHICLE.price as price, SLD_ADD_VEHICLE.total_kms
		FROM SLD_ADD_VEHICLE,MPS_VEHICLE_MAKES as mpk,MPS_VEHICLE_MODELS as mvm where  vehicle_category='luxury' and mpk.makes_id=SLD_ADD_VEHICLE.makes_id and SLD_ADD_VEHICLE.model_id=mvm.models_id")->queryAll(); 
        
		 $vmake=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MAKES.makes_id,MPS_VEHICLE_MAKES.makes_name,MPS_VEHICLES.logo_img
							FROM MPS_VEHICLES left JOIN MPS_VEHICLE_MAKES ON MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id
							group by  MPS_VEHICLE_MAKES.makes_name")->queryAll();
		$this->render('MPS_addnewvehicle',array('vmakelist'=>$vmake,"fetcheconomic"=>$fetcheconomiccar,"fetchebusinesscar"=>$fetchebusinesscar,"premiumcars"=> $fetcheprium,"fetchluxury"=>$fetcheluxury));
	}
	public function actionAddMoreVehicle()
	{
		
		 $makes_id=$_POST['make_id'];
		 
		 $model_id=$_POST['model_id'];
		
		$getcarImages=Yii::app()->db->createCommand("SELECT 
		`car_img` FROM `MPS_VEHICLES` WHERE makes_id=$makes_id and models_id=$model_id")->queryAll();
	    foreach($getcarImages as $carimgg)
		{
			  $carimg=$carimgg['car_img'];
		}	
		
		if(!empty($carimg))
		{
			Yii::app()->session['car_img'] = $carimg;
			$carimgg=$carimg;
		}
		else
		{
			 Yii::app()->session['car_img'] = '/images/uploadimages/models/car/php2C3E.tmp';
			 $carimgg='/images/uploadimages/models/car/php2C3E.tmp';
		}
		
		//fetch makes name and model name
		$getcarnames=Yii::app()->db->createCommand("SELECT distinct MPS_VEHICLE_MODELS.`models_name`,MPS_VEHICLE_MAKES.makes_name 
		FROM `MPS_VEHICLE_MODELS`,MPS_VEHICLE_MAKES WHERE MPS_VEHICLE_MODELS.makes_id=MPS_VEHICLE_MAKES.makes_id
		and MPS_VEHICLE_MAKES.makes_id=$makes_id and MPS_VEHICLE_MODELS.models_id=$model_id")->queryAll();
	    foreach($getcarnames as $getcarname)
		{
			 $getcarnmodel=$getcarname['models_name'];
			 $getcarmake=$getcarname['makes_name'];
		}
		
		$MPSVEHADDEDDETAIL=new MPSVEHADDEDDETAILS();	
		$MPSVEHADDEDDETAIL->makes_id=$makes_id;
		$MPSVEHADDEDDETAIL->model_id=$model_id;
		$MPSVEHADDEDDETAIL->user_id=Yii::app()->session['lastid'];
		$MPSVEHADDEDDETAIL->imgpath=$carimgg;
		$MPSVEHADDEDDETAIL->makes_name=$getcarmake;
		$MPSVEHADDEDDETAIL->models_name=$getcarnmodel;
		$MPSVEHADDEDDETAIL->save();
		  
		echo '1';
	}
	public function actionPayment()
	{
		$this->render('payment');
	}
	public function actionBooking()
	{   
	     
					$vmake=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MAKES.makes_id,MPS_VEHICLE_MAKES.makes_name,MPS_VEHICLES.logo_img
							FROM MPS_VEHICLES left JOIN MPS_VEHICLE_MAKES ON MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id and MPS_VEHICLES.status=0
							group by  MPS_VEHICLE_MAKES.makes_name")->queryAll();
					$getservices=Yii::app()->db->createCommand("SELECT `id`, `servicenames` FROM `MPS_SERVICES_DETAILS`")->queryAll();
			
					
					
					//echo $html;
					
					$this->render('bookService',array("getservices"=>$getservices,"vmakelist"=>$vmake));
		
		
		//$this->redirect('bookService');
	}
	public function actionPartners()
	{
		$this->render('partnership');
	}
	public function actionBookingsevicedetails()
	{
		
		$adrs=$_POST['adrs'];
		$picdate=$_POST['picdate'];
		$pickhr=$_POST['pickhr'];
		$makes_id=$_POST['makes_id'];
		$model_id=$_POST['model_id'];
		$location=$_POST['location'];
		$explode=explode(',',$location);
		$longitude=$explode[0];
		$latitude=$explode[1];
		
		$userid=Yii::app()->session['lastid'];
		 
		if(!empty($userid))
		{
		
		if(!empty(Yii::app()->session['username']))
		{
					$MPSCUSTOMERINFO=new MPSCUSTOMERINFO();	
					
					$MPSCUSTOMERINFO->location=$adrs; 
					$MPSCUSTOMERINFO->longitude=$longitude; 
					$MPSCUSTOMERINFO->latitude=$latitude; 
					$MPSCUSTOMERINFO->save();
					if($MPSCUSTOMERINFO->save())
					{
						$lastid=$MPSCUSTOMERINFO->id;
						
					}
					Yii::app()->session['lastid']=$lastid;
		}
		
		else
		{
		Yii::app()->session['lastid']=$lastid;
		$model=new MPSCUSTSERVICEDETAILS();
		$model->modelid=$model_id;
		$model->makesid=$makes_id;
		$model->pickadrs=$adrs;
		$model->pickdate=$picdate;
		$model->pickhr=$pickhr;
	
		$model->save(); 	
		echo 'success';
		}
		}
		else{
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
		ON MPS_VEHICLES.makes_id=MPSVEHADDED_DETAILS.makes_id and MPS_VEHICLES.models_id=MPSVEHADDED_DETAILS.model_id")->queryAll(); 
		
		
		
		$this->render('MPSVehiclelists',array('carimges'=>$carimges,"message"=>"Vehicle added successfully"));
			
		}
		/* $MPSCUSTOMERINFO=new MPSCUSTOMERINFO();	
		$MPSCUSTOMERINFO->location=$adrs; 
		$MPSCUSTOMERINFO->longitude=$longitude; 
		$MPSCUSTOMERINFO->latitude=$latitude; 
		$MPSCUSTOMERINFO->save();
		if($MPSCUSTOMERINFO->save())
		{
			$lastid=$MPSCUSTOMERINFO->id;
			Yii::app()->session['lastid']=$lastid;
		} */
		
	    /* $MPSCUSTOMER=new MPSCUSTOMERACCINFO();	
		$MPSCUSTOMER->username=$Usernmame;
		$MPSCUSTOMER->password=$upwd;
		Yii::app()->session['username']=$Usernmame;
		if($MPSCUSTOMER->save())
		{
			$lastid=$MPSCUSTOMER->id;
			Yii::app()->session['lastid']=$lastid;
		} */
		
		/* $model=new MPSCUSTSERVICEDETAILS();
		$model->custid=$lastid;		
		$model->modelid=$model_id;
		$model->makesid=$makes_id;
		$model->pickadrs=$adrs;
		$model->pickdate=$picdate;
		$model->variant=$variant;
		$model->addinfo=$addinfo;
		$model->vediofile=basename($_FILES['vefinfo']['tmp_name']);
		$model->seviceid=$servnm;
		$model->save();  */
		
		
		
		/* $getcarImages=Yii::app()->db->createCommand("SELECT 
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
		ON MPS_VEHICLES.makes_id=MPSVEHADDED_DETAILS.makes_id and MPS_VEHICLES.models_id=MPSVEHADDED_DETAILS.model_id")->queryAll(); 
		
		
		
		$this->render('MPSVehiclelists',array('carimges'=>$carimges,"message"=>"Vehicle added successfully")); */
		
	}
	
	public function actionModificationdetails()
	{   
	
		$vmake=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MAKES.makes_id,MPS_VEHICLE_MAKES.makes_name,MPS_VEHICLES.logo_img
							FROM MPS_VEHICLES right JOIN MPS_VEHICLE_MAKES ON MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id
							group by  MPS_VEHICLE_MAKES.makes_name")->queryAll();
							
		$this->render('Modification',array('vmakelist'=>$vmake));
	}
	
	public function actionVehicleguidedetails()
	{   
		$this->render('vehguide');
	}
	public function actionFetchmodelImage()
	{
		   $makes_id = $_POST['makeid'];
		  $modelid = $_POST['modelid'];
		
		 
			$datas=Yii::app()->db->createCommand("SELECT MPS_VEHICLES.car_img,MPS_VEHICLE_MAKES.makes_name,MPS_VEHICLE_MODELS.models_name FROM `MPS_VEHICLES`,MPS_VEHICLE_MAKES,MPS_VEHICLE_MODELS WHERE  MPS_VEHICLE_MODELS.models_id=MPS_VEHICLES.models_id and MPS_VEHICLE_MAKES.makes_id=MPS_VEHICLES.makes_id and MPS_VEHICLE_MODELS.models_id=$modelid")->queryAll();
			  foreach($datas as $car)
			{
				$car_img = $car['car_img'];
				$brand = $car['makes_name'];
				$models_name = $car['models_name'];
			}
			echo $car_img.'**'.$brand.'**'.$models_name;
	}
	public function actionFetchbikemodelImage()
	{
		   //$makes_id = $_POST['makeid'];
		   $modelid = $_POST['modelid'];
		
		 
			$datas=Yii::app()->db->createCommand("SELECT bike_brands.brand_name, bike_models.`bike_model_name`, bike_models.`bike_model_img_path` FROM `bike_models`,bike_brands WHERE bike_brands.brand_id = bike_models.brand_id and bike_models.`bike_model_id`= $modelid")->queryAll();
			  foreach($datas as $car)
			{
				$car_img = $car['bike_model_img_path'];
				$brand = $car['brand_name'];
				$models_name = $car['bike_model_name'];
			}
			echo $car_img.'**'.$brand.'**'.$models_name;
	}
	public function actionGetvmodel()
	{
		//echo 'dfjksfkdkjl';
		
		
		 $makes_id = $_POST['Maker'];
		// exit;
		
		 $carModelsdata=Yii::app()->db->createCommand("SELECT `models_id`, `models_name`, `makes_id` FROM `MPS_VEHICLE_MODELS` WHERE makes_id=$makes_id")->queryAll();
		 foreach($carModelsdata as $vmodel)
		{
			
			 $models_id[]=$vmodel['models_id'];
			 $models_name[]=$vmodel['models_name'];
			 $makes_ids[]=$vmodel['makes_id']; 
		}
		$html='';
		for($i=0;$i<count($models_id);$i++)
		{
			
			
			$carimagesdata=Yii::app()->db->createCommand("SELECT `models_id`,`car_img` FROM `MPS_VEHICLES` WHERE makes_id=$makes_ids[$i] and models_id=$models_id[$i] and status = 0 ")->queryAll();
			if(!empty($carimagesdata))
			{
						 foreach($carimagesdata as $carimages)
						{
									$html.='<li id="'.$carimages['models_id'].'"><a href="#">'.$models_name[$i].'<img src="http://metrepersecond.com/MPS'.$carimages['car_img'].'"></a></li>';
									
								
								
								 
						}  
						
			}
			
				
		}
		
		echo $html;
		
		
	}
/* 	public function actionMPSaddVehicledetails()
	
	{
		$this->render('MPSaddVehicledetails');
	} */
	public function actionSavebookservice()
	{
		if(!isset(Yii::app()->session['username']))
		{
			
			 $bookloc=$_POST['bookloc'];
		     $picdate=$_POST['picdate'];
		     $bookhour=$_POST['pictimer'];			
			 Yii::app()->session['bookloc'] =$bookloc;
			 Yii::app()->session['picdate'] = $picdate;
			 Yii::app()->session['bookhour'] = $bookhour;
		
			
			 if(isset(Yii::app()->session['bookloc'],Yii::app()->session['picdate'],Yii::app()->session['bookhour'])) {
			
							 $vmake=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MAKES.makes_id,MPS_VEHICLE_MAKES.makes_name,MPS_VEHICLES.logo_img
							FROM MPS_VEHICLES left JOIN MPS_VEHICLE_MAKES ON MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id and MPS_VEHICLES.status=0
							group by  MPS_VEHICLE_MAKES.makes_name")->queryAll();
							
							$vmodel=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MODELS.models_id, MPSVEHADDED_DETAILS.imgpath,MPS_VEHICLE_MODELS.models_name 
							FROM MPS_VEHICLE_MODELS,MPSVEHADDED_DETAILS
							where MPS_VEHICLE_MODELS.models_id=MPSVEHADDED_DETAILS.model_id")->queryAll();
							
	       
			$getservices=Yii::app()->db->createCommand("SELECT `id`, `servicenames` FROM `MPS_SERVICES_DETAILS`")->queryAll();
			$this->render('bookService',array("getservices"=>$getservices,"vmakelist"=>$vmake,"vmodel"=>$vmodel));
	
	   }
	   else if(!isset(Yii::app()->session['bookloc'],Yii::app()->session['picdate'],Yii::app()->session['bookhour']))
	   {
		   
		    $vmake=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MAKES.makes_id,MPS_VEHICLE_MAKES.makes_name,MPS_VEHICLES.logo_img
							FROM MPS_VEHICLES left JOIN MPS_VEHICLE_MAKES ON MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id and MPS_VEHICLES.status=0
							group by  MPS_VEHICLE_MAKES.makes_name")->queryAll();
							
							$vmodel=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MODELS.models_id, MPSVEHADDED_DETAILS.imgpath,MPS_VEHICLE_MODELS.models_name 
							FROM MPS_VEHICLE_MODELS,MPSVEHADDED_DETAILS
							where MPS_VEHICLE_MODELS.models_id=MPSVEHADDED_DETAILS.model_id")->queryAll();
							
	       
			$getservices=Yii::app()->db->createCommand("SELECT `id`, `servicenames` FROM `MPS_SERVICES_DETAILS`")->queryAll();
			$this->render('bookService',array("getservices"=>$getservices,"vmakelist"=>$vmake,"vmodel"=>$vmodel));
	   }  
	   else if(empty($_POST['bookloc']))
	   {
		  // echo 'else if';
		   //exit;
		  $vmodel=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MODELS.models_id, MPSVEHADDED_DETAILS.imgpath,MPS_VEHICLE_MODELS.models_name 
							FROM MPS_VEHICLE_MODELS,MPSVEHADDED_DETAILS
							where MPS_VEHICLE_MODELS.models_id=MPSVEHADDED_DETAILS.model_id")->queryAll();
		   $vmake=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MAKES.makes_id,MPS_VEHICLE_MAKES.makes_name,MPS_VEHICLES.logo_img
							FROM MPS_VEHICLES left JOIN MPS_VEHICLE_MAKES ON MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id and MPS_VEHICLES.status=0
							group by  MPS_VEHICLE_MAKES.makes_name")->queryAll();
			$getservices=Yii::app()->db->createCommand("SELECT `id`, `servicenames` FROM `MPS_SERVICES_DETAILS`")->queryAll();
			$this->render('bookService',array("getservices"=>$getservices,"vmakelist"=>$vmake,"vmodel"=>$vmodel));
	   }
	   else{
		 // echo 'else';
//			exit;
		$lastid=Yii::app()->session['lastid'];
		$bookloc=$_POST['bookloc'];
		$picdate=$_POST['picdate'];
		$bookhour=$_POST['bookhour'];
		
		 Yii::app()->session['bookloc'] ='';
		 Yii::app()->session['picdate'] = '';
		 Yii::app()->session['bookhour'] = '';
		 $vmodel=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MODELS.models_id, MPSVEHADDED_DETAILS.imgpath,MPS_VEHICLE_MODELS.models_name 
							FROM MPS_VEHICLE_MODELS,MPSVEHADDED_DETAILS
							where MPS_VEHICLE_MODELS.models_id=MPSVEHADDED_DETAILS.model_id and MPSVEHADDED_DETAILS.user_id=2")->queryAll();
		$this->render('bookService',array("getservices"=>$getservices,"vmodel"=>$vmodel));
	   }
			
			
			
			
		
		
		if(isset($lastid))
		{
			 $vmodel=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MODELS.models_id, MPSVEHADDED_DETAILS.imgpath,MPS_VEHICLE_MODELS.models_name 
							FROM MPS_VEHICLE_MODELS,MPSVEHADDED_DETAILS
							where MPS_VEHICLE_MODELS.models_id=MPSVEHADDED_DETAILS.model_id and MPSVEHADDED_DETAILS.user_id=2")->queryAll();
		}
		else{
			 $vmodel=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MODELS.models_id, MPSVEHADDED_DETAILS.imgpath,MPS_VEHICLE_MODELS.models_name 
							FROM MPS_VEHICLE_MODELS,MPSVEHADDED_DETAILS
							where MPS_VEHICLE_MODELS.models_id=MPSVEHADDED_DETAILS.model_id")->queryAll();
		}
		
		Yii::app()->session['bookloc'] = $bookloc;
		Yii::app()->session['picdate'] = $picdate;
		Yii::app()->session['bookhour'] = $bookhour;
		
		}
		else
		{
			
			//exit;
		$bookloc=$_POST['bookloc'];
		$picdate=$_POST['picdate'];
		$bookhour=$_POST['bookhour'];
		$lastid=Yii::app()->session['lastid'];
		
		Yii::app()->session['bookloc'] = $bookloc;
		Yii::app()->session['picdate'] = $picdate;
		Yii::app()->session['bookhour'] = $bookhour;
		if(isset(Yii::app()->session['bookloc'],Yii::app()->session['picdate'],Yii::app()->session['bookhour'])) {
	    $vmodel=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MODELS.models_id, MPSVEHADDED_DETAILS.imgpath,MPS_VEHICLE_MODELS.models_name 
							FROM MPS_VEHICLE_MODELS,MPSVEHADDED_DETAILS
							where MPS_VEHICLE_MODELS.models_id=MPSVEHADDED_DETAILS.model_id and MPSVEHADDED_DETAILS.user_id=2")->queryAll();
	        $vmake=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MAKES.makes_id,MPS_VEHICLE_MAKES.makes_name,MPS_VEHICLES.logo_img
							FROM MPS_VEHICLES left JOIN MPS_VEHICLE_MAKES ON MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id
							group by  MPS_VEHICLE_MAKES.makes_name")->queryAll();
			$getservices=Yii::app()->db->createCommand("SELECT `id`, `servicenames` FROM `MPS_SERVICES_DETAILS`")->queryAll();
			$this->render('bookService',array("getservices"=>$getservices,"vmakelist"=>$vmake,"vmodel"=>$vmodel));
	
	   }
	   else{
		  
			//exit;
		 Yii::app()->session['bookloc'] ='';
		Yii::app()->session['picdate'] = '';
		Yii::app()->session['bookhour'] = '';
		 $vmodel=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MODELS.models_id, MPSVEHADDED_DETAILS.imgpath,MPS_VEHICLE_MODELS.models_name 
							FROM MPS_VEHICLE_MODELS,MPSVEHADDED_DETAILS
							where MPS_VEHICLE_MODELS.models_id=MPSVEHADDED_DETAILS.model_id and MPSVEHADDED_DETAILS.user_id=2")->queryAll();
		$this->render('bookService',array("getservices"=>$getservices,"vmodel"=>$vmodel));
	   }
		}
		 
		
	}
	public function actionsaveVehicle()
	{
		
		
		$username = Yii::app()->session['username'];
		$userid=Yii::app()->session['lastid'];
		if(isset($username))
		{
		$carimgg=Yii::app()->session['car_img'];
	    $modeladddel=new MPSVEHADDEDDETAILS();	
		$modeladddel->makes_id=$_POST['makes_id'];
	    $modeladddel->model_id=$_POST['model_id'];
		$modeladddel->imgpath="$carimgg";
		$modeladddel->models_name=Yii::app()->session['getcarnmodel'] ;
		$modeladddel->makes_name=Yii::app()->session['getcarmake'];
		$modeladddel->user_id=Yii::app()->session['lastid'];
		$modeladddel->save();  
		$carimges=Yii::app()->db->createCommand("SELECT distinct MPSVEHADDED_DETAILS.makes_name,MPSVEHADDED_DETAILS.models_name,MPSVEHADDED_DETAILS.`imgpath`
		FROM MPSVEHADDED_DETAILS
		right JOIN  MPS_VEHICLE_MODELS
		ON MPSVEHADDED_DETAILS.model_id= MPS_VEHICLE_MODELS.models_id and MPSVEHADDED_DETAILS.user_id=$userid")->queryAll();
		
		
		
		$this->render('MPSVehiclelists',array('carimges'=>$carimges,"message"=>"Vehicle added successfully"));
		//$this->render('VehicleList');
		}
		else
		{
		if(isset($_POST['makes_id'],$_POST['variant'],$_POST['model_id'],$_POST['lastservice_on'],$_POST['vehicle_age'],$_POST['regno']))
		{
		$makes_id=$_POST['makes_id'];
		
		$variant=$_POST['variant'];
		$vehicle_type='Car';
		$model_id=$_POST['model_id'];
		//$year=$_POST['year'];
		$lastservice_on=$_POST['lastservice_on'];
		$vehicle_age=$_POST['vehicle_age'];
		$regno=$_POST['regno'];  
		
		$model=new MPSVEHICLEDETAILS();	
		$model->model_id=$model_id;
		$model->makes_id=$makes_id;
		$model->variant=$variant;
		$model->vehicle_type=$vehicle_type;
		//$model->year=2222;
		$model->lastserviceon=$lastservice_on;$getcarImages=Yii::app()->db->createCommand("SELECT 
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
		$model->age=$vehicle_age;
		$model->reg_no=$regno; 
		$model->save();  
		Yii::app()->session['Variant'] = $variant;
		Yii::app()->session['LastService'] = $lastservice_on;
		Yii::app()->session['Age'] = $vehicle_age;
		Yii::app()->session['VehicleNo'] = $regno;
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
		
		
		$this->render('MPSaddVehicledetails');
		}
		else
		{
			$this->render('MPSaddVehicledetails');
		}
		}
	}
	public function actionVehicleInfo()
	{
		if(isset(Yii::app()->session['username']))
		{
		$makeid=$_POST['makeid'];
		$modelid=$_POST['modelid'];
		$getcarnmodel=$_POST['getcarnmodel'];
		$getcarmake=$_POST['getcarmake'];
		
	    $uname=$_POST['uname'];
		$emailId=$_POST['emailId'];
	    $mobNo=$_POST['mobNo'];
		$location1=$_POST['location1'];
		
		$location=$_POST['location']; 
		$datas=explode(',',$location);
		$longitude=$datas[0]; 
		$latitude=$datas[1]; 
		$Usernmame=$_POST['Usernmame'];
		Yii::app()->session['username'] = $Usernmame;
		$upwd=$_POST['upwd']; 
		
		$carimgg=Yii::app()->session['car_img'];
		
		
		if(isset($uname,$emailId,$mobNo,$location,$Usernmame,$upwd))
		{
		$MPSCUSTOMERINFO=new MPSCUSTOMERINFO();	
		$MPSCUSTOMERINFO->username=$uname;
		
		$MPSCUSTOMERINFO->emailid=$emailId;
		$MPSCUSTOMERINFO->mobile_no=$mobNo;
		$MPSCUSTOMERINFO->location=$location1; 
		$MPSCUSTOMERINFO->longitude=$longitude; 
		$MPSCUSTOMERINFO->latitude=$latitude; 
		$MPSCUSTOMERINFO->save();
		
		
	    $MPSCUSTOMER=new MPSCUSTOMERACCINFO();	
		$MPSCUSTOMER->username=$Usernmame;
		$MPSCUSTOMER->password=$upwd;
		
		if($MPSCUSTOMER->save())
		{
			$lastid=$MPSCUSTOMER->id;
			Yii::app()->session['lastid'] = $lastid;
			$this->actionVehicleList();
			
		}
		
		$modeladddel=new MPSVEHADDEDDETAILS();	
		$modeladddel->makes_id=$makeid;
	    $modeladddel->model_id=$modelid;
		$modeladddel->imgpath="$carimgg";
		$modeladddel->models_name="$getcarnmodel";
		$modeladddel->makes_name="$getcarmake";
		$modeladddel->user_id=Yii::app()->session['lastid'];
		$modeladddel->save();  
		}
		else
		{
			echo '0';
		}
		}
		else
		{
		$makeid=$_POST['makeid'];
		$modelid=$_POST['modelid'];
		$getcarnmodel=$_POST['getcarnmodel'];
		$getcarmake=$_POST['getcarmake'];
		
	    $uname=$_POST['uname'];
		$emailId=$_POST['emailId'];
	    $mobNo=$_POST['mobNo'];
		$location1=$_POST['location1'];
		
		$location=$_POST['location']; 
		$datas=explode(',',$location);
		$longitude=$datas[0]; 
		$latitude=$datas[1]; 
		$Usernmame=$_POST['Usernmame'];
		Yii::app()->session['username'] = $uname;
		$upwd=$_POST['upwd']; 
		
		$carimgg=Yii::app()->session['car_img'];
		
		
		if(isset($uname,$emailId,$mobNo,$location,$Usernmame,$upwd))
		{
		$MPSCUSTOMERINFO=new MPSCUSTOMERINFO();	
		$MPSCUSTOMERINFO->username=$uname;
		
		$MPSCUSTOMERINFO->emailid=$emailId;
		$MPSCUSTOMERINFO->mobile_no=$mobNo;
		$MPSCUSTOMERINFO->location=$location1; 
		$MPSCUSTOMERINFO->longitude=$longitude; 
		$MPSCUSTOMERINFO->latitude=$latitude; 
		$MPSCUSTOMERINFO->save();
		
		
	    $MPSCUSTOMER=new MPSCUSTOMERACCINFO();	
		$MPSCUSTOMER->username=$Usernmame;
		$MPSCUSTOMER->password=$upwd;
		
		if($MPSCUSTOMER->save())
		{
			$lastid=$MPSCUSTOMER->id;
			Yii::app()->session['lastid'] = $lastid;
			$this->actionVehicleList();
			
		}
		
		$modeladddel=new MPSVEHADDEDDETAILS();	
		$modeladddel->makes_id=$makeid;
	    $modeladddel->model_id=$modelid;
		$modeladddel->imgpath="$carimgg";
		$modeladddel->models_name="$getcarnmodel";
		$modeladddel->makes_name="$getcarmake";
		$modeladddel->user_id=Yii::app()->session['lastid'];
		$modeladddel->save();  
		}
		else
		{
			echo '0';
		}
		}
		
		//$this->redirect('mPSVEHICLES_DETAILS/VehicleList');
		
	}
	public function actionemailValidation()
	{
		 $own_emailid=$_POST['emailid'];
		 $rawData=Yii::app()->db->createCommand("SELECT emailid
        FROM MPS_CUSTOMER_INFO
        WHERE emailid='$own_emailid'")->queryAll();
		echo $emailcount=count($rawData);
	}
	public function actionListofVehicle()
	{
			 $rawData=Yii::app()->db->createCommand("SELECT  mvdd.`makes_id`, mvdd.`model_id`, mvdd.`user_id`, mvdd.`imgpath`, mvdd.`makes_name`,mvd.lastserviceon,mvd.year, mvd.reg_no,mvdd.`models_name` FROM `MPSVEHADDED_DETAILS` as mvdd,MPS_VEHICLE_DETAILS as mvd WHERE mvdd.model_id=mvd.model_id and mvdd.makes_id=mvd.makes_id  and mvdd.`user_id`=1")->queryAll();
			/*  foreach($rawData as $rawDat)
			{
				$imgcode['vehicle'][]=$rawDat['makes_id'];//encode
				$imgcode['model_id'][]=$rawDat['model_id'];//encode
				$imgcode['user_id'][]=$rawDat['user_id'];//encode
				
			}
			echo '<pre>';
			echo $endata =json_encode($imgcode); */
			/* if(empty($imgcode))
					{
						
					echo 'No data available';	
					}
					else{
						
						
						
						
					} */
	}
	 public function actionMaps()
     {
            $services=Yii::app()->db->createCommand("SELECT * from HIRE_A_MECHANIC")->queryAll();
            $out=array();
            foreach($services as $service)
            {
                $out[]=array($service['location'],$service['lag'],$service['lat'],$service['booking_charge'],$service['name']);
            }
            echo json_encode($out); 
           die;
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
  
	public function actiongetintouch()
	{
		$name=$_POST['name'];
		$email=$_POST['email'];
		$message=$_POST['message'];
		//mail("pvenkateshnaidu@gmail.com","Subject: $subject", $message, $header);
		echo "Thank You ..Contact Soon";
	}	
	public function actionUpdatecarRepairjobamounts()
	{
			$id=$_POST['id'];
			$brandid=$_POST['brandid'];
			$model_id=$_POST['modelid'];			
			$getcatid=Yii::app()->db->createCommand("SELECT category_id  FROM MPS_VEHICLES WHERE models_id='$model_id'")->queryAll();
			$cat_id=$getcatid[0]['category_id'];			
			$getRepairIdamount=Yii::app()->db->createCommand("select sum(amount) as amount from	
			repairlist_package_details where repair_id='$id' and category_id='$cat_id'")->queryAll();
			echo $getRepairIdamount[0]['amount'];
		
	}
	
}