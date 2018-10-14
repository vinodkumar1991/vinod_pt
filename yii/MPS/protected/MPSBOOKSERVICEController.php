<?php

class MPSBOOKSERVICEController extends Controller
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
			/*$year=$_POST['year'];
		$lastservice_on=$_POST['lastservice_on'];
		$vehicle_age=$_POST['veh_age'];
		$regno=$_POST['regno'];  */
		
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
	  /*	$model->year=$year;
		$model->lastserviceon="$lastservice_on";
		$model->age="$vehicle_age";
		$model->reg_no="$regno"; */
		$model->save();
		
		/* if($model->save())
		{
			 $lastid=$model->id;
		} */
		
		$arr=array("Response"=>"Add vehicle Successfully");
	    echo json_encode($arr);
			 }
				 else{
					$arr=array("Response"=>"error","Regid"=>$lastid);
					echo json_encode($arr);
				}  
				
		//exit;
		
		
		
		
		
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
}