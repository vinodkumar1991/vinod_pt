<?php

class BikeListController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionCreateBikeBrand()
	{
		$message='';
		if(isset($_POST['addbrand']))
		{
			
			$brand_name=$_POST['brand_name'];
			$model=new BikeBrands();
			$model->brand_name=$brand_name;
			$path='/images/uploadimages/bikes/brands/'.basename($_FILES['bikelogofile']['tmp_name']);
			$idproof= Yii::app()->request->baseUrl;
			$url2=$_SERVER['DOCUMENT_ROOT']."$idproof/images/uploadimages/bikes/brands/";
			$uploadfile1 = $url2 .basename($_FILES['bikelogofile']['tmp_name']);
			move_uploaded_file($_FILES['bikelogofile']['tmp_name'], $uploadfile1);
			$logos=file_get_contents($uploadfile1);
			$logoencrypted=base64_encode($logos);
			$model->brand_logo_path=$path;
			$model->brand_logo_img=$logos;
			$model->save();
			$message="added succesfully";
		}
		
			$this->render('CreateBikeBrand');
	}
	public function actionCreateBikeModel()
	{
				
		$message="";
		if(isset($_POST['addmodel']))
		{			
			$brandid=$_POST['brand_name'];
			$i=0;
			foreach($_POST['model_name'] as $m)
			{
				$model1=new BikeModels();
				$model1->bike_model_name=$_POST['model_name'][$i];
				$model1->category_id=$_POST['category_name'][$i];
				$model1->brand_id=$brandid;
				$path1='/images/uploadimages/bikes/models/'.basename($_FILES['bikemodelfile']['tmp_name'][$i]);
				$idproof= Yii::app()->request->baseUrl;
				$url=$_SERVER['DOCUMENT_ROOT']."$idproof/images/uploadimages/bikes/models/";
				$uploadfile = $url.basename($_FILES['bikemodelfile']['tmp_name'][$i]);
				move_uploaded_file($_FILES['bikemodelfile']['tmp_name'][$i], $uploadfile);
				$logos1=file_get_contents($uploadfile);
				$logoencrypted1=base64_encode($logos1);
				$model1->bike_model_img_path=$path1;
				$model1->bike_model_img=$logoencrypted1;
				$model1->save();
				$i++;
			}
		}
		
		$brands = BikeBrands::model()->findAll();
		$this->render('CreateBikeModel',array('message'=>$message,'brands'=>$brands));
	}
		public function actionDeleteBike_data()
		{
			$bike_brand_id=$_POST['bike_brand_id'];
			
			//$bike_cat=$_POST['bike_cat'];
			//echo "UPDATE `bike_models` SET `status`=1 WHERE `bike_model_id`=$bike_brand_id";
			$bikelist=Yii::app()->db->createCommand("UPDATE `bike_models` SET `status`=1 WHERE `bike_model_id`=$bike_brand_id")->execute();
			echo 'Deleted';
		}
	public function actionFetchBike_data()
	{ 
		$bike_cat=$_POST['bike_cat'];
		
		$bikelist=Yii::app()->db->createCommand("SELECT bm.bike_model_id,bb.brand_logo_path as brandlogo,bb.brand_name as brand_name,bm.bike_model_name as model_name from bike_brands as bb,bike_models as bm where bb.brand_id=bm.brand_id AND bm.category_id=$bike_cat and bm.status=0 order by bb.brand_name asc ")->queryAll();
		 $i=1;
					$html='';
                    foreach ($bikelist as $self_detail) {

                    	

                                              

											    $html.= ' <tr>';

											   $html.= ' 

											    <td>'.$i.'</td>

											   <td>

									<img src="'.Yii::app()->request->baseUrl.'/'.$self_detail['brandlogo'].'" width="50px" / ></td>

												<td>'.$self_detail['brand_name'].'</td>	  

												<td>'.$self_detail['model_name'].'</td>

												<td>

                                                    <a href="#" id="'.$self_detail['bike_model_id'].'" title="Trash" data-toggle = "modal" data-target = "#warning-model" class="delete-u btndelete1"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';

											   $html.= '</tr>';

											   $i++;

                                               

                    }
			echo $html; 
	}
	public function actionallBikeList()
        {
			
			$services=Yii::app()->db->createCommand("SELECT bm.bike_model_id,bb.brand_logo_path as brandlogo,bb.brand_name as brand_name,bm.bike_model_name as model_name from bike_brands as bb,bike_models as bm where bb.brand_id=bm.brand_id and bm.status=0 order by bb.brand_name asc")->queryAll();
			
			$bike_categories=Yii::app()->db->createCommand("SELECT `id`, `category_name` FROM `bike_categories`")->queryAll();
          
				$this->render('services',array("bikelist"=>$services,"bike_categories"=>$bike_categories));
        }
		
		
			public function actionbikePackageList()
			{
				  $bikerepairLists=Yii::app()->db->createCommand("select * from mps_bike_repair_lists where service_id=1")->queryAll();
		$html1='<table id="td1" class=" table responsive" cellspacing="0" width="100%" border="1">
                                        <thead bgcolor="#eaeaea">
                                            <tr>
											<th>Slno<th>
											Repair List
											<th>Sub Repairs List</th>';
                               
									 $html1.='<th>Action</th>';
								
								$html1.='</tr>
                                        </thead>
           
		   <tbody>';
		  $i=0;
		// $arr=array("4","2");
		$br='';
		 foreach($bikerepairLists as $repairList)
		{    
				$repairsubLists=Yii::app()->db->createCommand("SELECT * from bike_sub_repairlists where repair_id='$repairid'")->queryAll();
				$repairid = $repairList['repair_id'];
				$repairsubcount=Yii::app()->db->createCommand("SELECT count(id) as scount from bike_sub_repairlists where repair_id='$repairid'")->queryAll();

				$html1.='<tr><td rowspan="'.$repairsubcount[0]['scount'].'">'.$repairid.'</td><th rowspan="'.$repairsubcount[0]['scount'].'">'.$repairList['repair_name'].'</th>';
				
				$repairsubLists=Yii::app()->db->createCommand("SELECT * from bike_sub_repairlists where repair_id=$repairid")->queryAll();
				//echo '<pre>';
			foreach($repairsubLists as $repairsubList)
				{
					
					$html1.= '<td>'.$repairsubList['sub_name'].'</td>
												<form name="" action="Repairlist" method="post">
												';
											 $bikecats=Yii::app()->db->createCommand("select id as cat_id ,category_name as name from bike_categories")->queryALL();
									
								 $rid=$repairList['repair_id'];
								 $srid=$repairsubList['sub_repair_id'];
								 $cat_id=$names['cat_id'];
								 $repaircatamount=Yii::app()->db->createCommand("SELECT amount as amt from bike_repair_package_list where repair_id='$rid' and sub_repair_id='$srid' and category_id='$cat_id'")->queryAll();
								
												$html1.='<td>
											<input type="hidden" name="rid" value="'.$repairList['repair_id'].'" />
													<input type="hidden" name="srid" value="'.$repairsubList['sub_repair_id'].'" /><input type="checkbox" class="'.$i.'" value="'.$repairList['repair_id'].'/'.$repairsubList['sub_repair_id'].'" id="id'.$repairList['repair_id'].'/'.$repairsubList['sub_repair_id'].'"  onclick=checkper('.$repairList['repair_id'].','.$repairsubList['sub_repair_id'].');';
													if($repairsubList['status']=='1')
													{
														$html1.=' checked ';
													}
													$html1.=' /></td>';
											$html1.=' </tr>';
											
											 
			
			
				}
	 
		} 
		$html1.='</tbody></table>';
		 $bikerepairLists1=Yii::app()->db->createCommand("select * from mps_bike_repair_lists where service_id=2")->queryAll();
		$html='<table id="td2" class=" table responsive" cellspacing="0" width="100%" border="1">
                                        <thead bgcolor="#eaeaea">
                                            <tr>
											<th>Slno<th>
											Repair List
											<th>Sub Repairs List</th>';
                               
									 $html.='<th>Action</th>';
								
								$html.='</tr>
                                        </thead>
           
		   <tbody>';
		  $i=0;
		// $arr=array("4","2");
		$br='';
		 foreach($bikerepairLists1 as $repairList)
		{    
				$repairsubLists=Yii::app()->db->createCommand("SELECT * from bike_sub_repairlists where repair_id='$repairid'")->queryAll();
				$repairid = $repairList['repair_id'];
				$repairsubcount=Yii::app()->db->createCommand("SELECT count(id) as scount from bike_sub_repairlists where repair_id='$repairid'")->queryAll();

				$html.='<tr><td rowspan="'.$repairsubcount[0]['scount'].'">'.$repairid.'</td><th rowspan="'.$repairsubcount[0]['scount'].'">'.$repairList['repair_name'].'</th>';
				
				$repairsubLists=Yii::app()->db->createCommand("SELECT * from bike_sub_repairlists where repair_id=$repairid")->queryAll();
				//echo '<pre>';
			foreach($repairsubLists as $repairsubList)
				{
					
					$html.= '<td>'.$repairsubList['sub_name'].'</td>
												<form name="" action="Repairlist" method="post">
												';
											 $bikecats=Yii::app()->db->createCommand("select id as cat_id ,category_name as name from bike_categories")->queryALL();
								
								 $rid=$repairList['repair_id'];
								 $srid=$repairsubList['sub_repair_id'];
								 $cat_id=$bikecats[0]['cat_id'];
								 $repaircatamount=Yii::app()->db->createCommand("SELECT amount as amt from bike_repair_package_list where repair_id='$rid' and sub_repair_id='$srid' and category_id='$cat_id'")->queryAll();
								
												$html.='<td>
											<input type="hidden" name="rid" value="'.$repairList['repair_id'].'" />
												<input type="hidden" name="srid" value="'.$repairsubList['sub_repair_id'].'" /><input type="checkbox" class="'.$i.'" value="'.$repairList['repair_id'].'/'.$repairsubList['sub_repair_id'].'" id="id'.$repairList['repair_id'].'/'.$repairsubList['sub_repair_id'].'"  onclick=checkper('.$repairList['repair_id'].','.$repairsubList['sub_repair_id'].');';
													if($repairsubList['status']=='1')
													{
														$html.=' checked ';
													}
													$html.=' /></td>';
								
											$html.='</tr>';
											
											 
			
			
				}
	 
		} 
		$html.='</tbody></table>';
		 
				$services=Yii::app()->db->createCommand("SELECT * from MPS_SERVICES_DETAILS")->queryAll();
				$categories=Yii::app()->db->createCommand("SELECT * from MPS_VEHICLE_CAT")->queryAll();
		
		

				 $bikecats=Yii::app()->db->createCommand("select id ,category_name from bike_categories")->queryALL();
				 $services1=Yii::app()->db->createCommand("select id ,snames from bike_service_names")->queryALL();
							
				$this->render('../site/bikepackage',array('services'=>$services,'categories'=>$categories,'html'=>$html1,'html1'=>$html,'bikecat'=>$bikecats,'services1'=>$services1));
			}
			public function actionupdatepackages()
			{
				$id=$_POST['id'];
				$subid=$_POST['subid'];
				$catid=$_POST['cid'];
				$sid=$_POST['sid'];
				 $sql=Yii::app()->db->createCommand("UPDATE bike_sub_repairlists SET status ='1' WHERE repair_id='$id' and sub_repair_id='$subid'")->execute();
				 $sql1=Yii::app()->db->createCommand("UPDATE bike_repair_package_list SET status ='1' WHERE repair_id='$id' and sub_repair_id='$subid'")->execute();
				 if($sql){ 
				 $sqlamount=Yii::app()->db->createCommand("SELECT sum( bp.amount ) AS amount
FROM bike_repair_package_list AS bp, mps_bike_repair_lists AS rp
WHERE rp.repair_id = bp.repair_id
AND rp.service_id ='$sid'
AND bp.category_id ='$catid' and bp.status=1")->queryALL();
				 }
				echo "Total Package Amount: <strong>".$sqlamount[0]['amount']."</strong>";
				
			}
				public function actionUncheckupdatepackages()
			{
				$id=$_POST['id'];
				$subid=$_POST['subid'];
				$catid=$_POST['cid'];
				$sid=$_POST['sid'];
				 $sql=Yii::app()->db->createCommand("UPDATE bike_sub_repairlists SET status ='0' WHERE repair_id='$id' and sub_repair_id='$subid'")->execute();
				 $sql1=Yii::app()->db->createCommand("UPDATE bike_repair_package_list SET status ='0' WHERE repair_id='$id' and sub_repair_id='$subid'")->execute();
				 if($sql){ 
					$sqlamount=Yii::app()->db->createCommand("SELECT sum( bp.amount ) AS amount
					FROM bike_repair_package_list AS bp, mps_bike_repair_lists AS rp
					WHERE bp.repair_id = rp.repair_id
					AND rp.service_id ='$sid'
					AND bp.category_id ='$catid' and bp.status=1")->queryALL();
									 }
				echo "Total Package Amount: <strong>".$sqlamount[0]['amount']."</strong>";
			}
			public function actionamountcal()
			{
				$catid=$_POST['cid'];
				$sid=$_POST['sid'];
				$sqlamount=Yii::app()->db->createCommand("SELECT sum( bp.amount ) AS amount
				FROM bike_repair_package_list AS bp, mps_bike_repair_lists AS rp
				WHERE bp.repair_id = rp.repair_id
				AND rp.service_id ='$sid'
				AND bp.category_id ='$catid' and bp.status=1")->queryALL();
				 
				echo "Total Package Amount: <strong>".$sqlamount[0]['amount']."</strong>";
			}
}