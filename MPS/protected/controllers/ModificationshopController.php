<?php

class ModificationshopController extends Controller
{
	 public $defaultAction = 'ModificationSave';

	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionModificatioshoprequest()
	{
		$this->render('modificationrequest');
	}
	public function actiongetIds()
	{
		$id=$_POST['roleval'];		 
		if($id>5)
		{
	
			 $rawData=Yii::app()->db->createCommand("SELECT max(shop_id) as self_unique_id
        FROM modification_shop where role_id = $id")->queryAll();
		$shop_unique_id=$rawData[0]['self_unique_id'];
		
		//$dlbshopid=explode('dlb',$shop_unique_id);
		if(!isset($shop_unique_id))
		{
			echo $shop_unique_id='MSP001'; 
		}
		else
		{
			
			$shop_unique_id=explode('MSP',$shop_unique_id);
			$sp= $shop_unique_id[1]+1; 
			echo 'MSP00'.$sp;
		}
		
		}
		
	}
	public function actionModificationSave()
	{
		$message='';
		if(isset($_POST['addmodification']))
		{
		$model=new ModificationShop();
		$model->id=$this->id;
		$model->role_id=$_POST['mroletype'];
		$model->shop_id=$_POST['modification_id'];
		$model->shop_name=$_POST['mshopname'];
		$model->retiler_name=$_POST['retiler_name'];
		$model->country=$_POST['mcountry'];
		$model->state=$_POST['mstate'];
		$model->city=$_POST['mcity'];
		$model->vehicle_type=$_POST['vehicle_type']; 
		$model->sector=$_POST['marea']; 
		$model->zipcode=$_POST['mzipcode'];
		$model->brand_id=$_POST['brand_id'];
		$model->description=$_POST['description'];
		$model->location=$_POST['name'];
		$model->list_mofdifications=serialize($_POST['list_mofdifications']);
		$model->email=$_POST['email'];
		$model->adress=$_POST['adress'];
		$model->contact_no=$_POST['contact_no'];
		$idproof= Yii::app()->request->baseUrl;
		$url2=$_SERVER['DOCUMENT_ROOT']."$idproof/images/modification/";
		$uploadfile1 = $url2 .basename($_FILES['idproof']['tmp_name']);
		$urlsaved="/images/modification/".basename($_FILES['idproof']['tmp_name']);
		move_uploaded_file($_FILES['idproof']['tmp_name'], $uploadfile1);
		$image1=file_get_contents($upladfile1);
		$encrypted=base64_encode($image1);
		$model->id_proof_path=$urlsaved;
		$lotlat=$_POST['location'];
		$latarray=explode(',',$lotlat);
		$model->lan=$latarray[0];
		$model->lat=$latarray[1];
		
		$model->save();
		$message="Added succefully";
		}
			 $details=Yii::app()->db->createCommand("SELECT * FROM modification_shop")->queryAll();
		$this->render('../mPSUserRegistration/manageModification',array("message"=>$message,"modification_details"=>$details));
	}
	public function actionDeleteself()
	{
		
		$id=$_POST['id'];
		$delsql='DELETE FROM modification_shop WHERE id='.$id.'';
		$res = Yii::app()->db->createcommand($delsql)->execute();
		


	}
	public function actionupdateModificationdetails()
	{
		$id=$_POST['id'];
		$self_details=Yii::app()->db->createCommand("SELECT * FROM `modification_shop` where id='$id'")->queryAll();	
		echo json_encode($self_details); 
        die;
	}
		public function actionUpdatedetails()
		{
					
			$message='';
			if(isset($_POST['updatemodification']))
			{
				
				$updateuser =ModificationShop::model()->findByPk($_POST['id']);
			 $updateuser->shop_name=$_POST['shop_name'];
			 $updateuser->retiler_name=$_POST['retiler_name'];
			 $updateuser->email=$_POST['email'];
			 $updateuser->contact_no=$_POST['contact_no'];
			 $updateuser->adress=$_POST['adress'];
			 if(!empty($_FILES['shop_image']['tmp_name'])){
			 $idproof= Yii::app()->request->baseUrl;
			 $url2=$_SERVER['DOCUMENT_ROOT']."$idproof/images/modification/";
		$uploadfile1 = $url2 .basename($_FILES['shop_image']['tmp_name']);
		$urlsaved="/images/modification/".basename($_FILES['shop_image']['tmp_name']);
		move_uploaded_file($_FILES['shop_image']['tmp_name'], $uploadfile1);
		$image1=file_get_contents($upladfile1);
		$encrypted=base64_encode($image1);
		$updateuser->id_proof_path=$urlsaved;
			 }
			 if(!empty($_FILES['brandlogo']['tmp_name'])){
			 $idproof1= Yii::app()->request->baseUrl;
			 $url1=$_SERVER['DOCUMENT_ROOT']."$idproof1/images/modification/";
		$uploadfile2 = $url1 .basename($_FILES['brandlogo']['tmp_name']);
		$urlsaved1="/images/modification/".basename($_FILES['brandlogo']['tmp_name']);
		move_uploaded_file($_FILES['brandlogo']['tmp_name'], $uploadfile2);
		$image=file_get_contents($upladfile2);
		$encrypted1=base64_encode($image);
		$updateuser->brandlogo=$urlsaved1;
			 }
			 $updateuser->update();
			 $message="Update Sucessfully";
			}
		 $details=Yii::app()->db->createCommand("SELECT * FROM modification_shop")->queryAll();
	
		$this->render('../mPSUserRegistration/manageModification',array('message'=>$message,"modification_details"=>$details));
			
		}
	//services
		public function actionModificationService()
				{
					if(isset($_GET['mods'])&&isset($_GET['makes_id'])&&isset($_GET['vehicle_type']))
					{
						if($_GET['vehicle_type']=='car')
						{
						$vehicle_type=$_GET['vehicle_type'];
						$type=$_GET['mods'];
						$serchlist=Yii::app()->db->createCommand("select * from modification_shop 
						where vehicle_type='$vehicle_type' and list_mofdifications like '%$type%' ")->queryAll();
						
							if(empty($serchlist))
							{
								$data="no available data";
							}else
							{
								foreach($serchlist as $key=>$value)
								{
									$data['modification_shops'][]=$value;
								}
							}
						
						}else
						{
							$data="no data available";
						}
					}
					else if(isset($_GET['vehicle_type']))
					{
						$vehicletype=$_GET['vehicle_type'];
						if($vehicletype=='car')
						{
						$vehicle_guide_details=Yii::app()->db->createCommand("SELECT * FROM MPS_VEHICLE_MAKES  ORDER BY makes_name ASC")->queryAll();
						foreach($vehicle_guide_details as $key=>$value)
						{
							$data['vehicle-brands'][]=$value;
						}
						
						$vehicle_guide_details1=Yii::app()->db->createCommand("SELECT * FROM MPS_MODIFICATION_TYPES")->queryAll();
						foreach($vehicle_guide_details1 as $key=>$value)
						{
							$data['modify_types'][]=$value;
						}
						
						
						}else
						{
							$data="no data available";
						}
						
					}else
					{
						$data="invalid parameters";
					}
					echo json_encode($data);
					die;
				}
}