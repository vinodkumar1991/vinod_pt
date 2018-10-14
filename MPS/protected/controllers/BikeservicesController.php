<?php

class BikeservicesController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actiongetBikeBrands()
	{
	
				
			    $vbikemodels=Yii::app()->db->createCommand("SELECT brand_id,brand_name, brand_logo_path, brand_logo_img FROM bike_brands")->queryAll();
				
				
				$i=0;
				//echo '<pre>';
				foreach($vbikemodels as $vbikemodel=>$logosDeta)
				{
					
					
					$arrCarLogos['Bike Brands'][] = $logosDeta;
					
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
}