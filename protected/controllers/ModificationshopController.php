<?php

class ModificationshopController extends Controller
{
	public function actionCar()
	{     
                $intVehicle = 1;		                
		$arrServices=  ModificationShop::getModificationServices();
                $arrCarBrands=  VehicleBrands::getVehicleBrands(1, $intVehicle);
                $arrBikeBrands= VehicleBrands::getVehicleBrands(1, 2);
                //echo'<pre>';print_r($arrCarBrands);die();                
		$this->render('index',array('vmakelist'=>$arrCarBrands,
                              'types'=>$arrServices,
                              'bikebrands'=>$arrBikeBrands,
                              'vehicleType' => $intVehicle,
                              'vehicleFolderPath' => '/cars/web/brands/60X40/',
                              'vehicleModelFolderPath' => '/cars/web/models/60X35/',
                              'vehicleModelRightFolderPath' => '/cars/web/models/180X104/')
                              );
	}
	public function actionBike(){
                $intVehicle = 2;				
                $arrServices=  ModificationShop::getModificationServices();
                $arrCarBrands=  VehicleBrands::getVehicleBrands(1, 1);
                $arrBikeBrands= VehicleBrands::getVehicleBrands(1, $intVehicle);                		
		$this->render('Bike',
                               array('vmakelist'=>$arrCarBrands,
                                     'types'=>$arrServices,                                   
                                     'bikebrands'=>$arrBikeBrands,
                                     'vehicleType' => $intVehicle,
                                     'vehicleFolderPath' => '/bikes/web/brands/60X40/',
                                     'vehicleModelFolderPath' => '/bikes/web/models/60X35/',
                                     'vehicleModelRightFolderPath' => '/bikes/web/models/220X127/')
                        );
	}
	public function actionSearchModificationShops(){       
                $arrInputs=$_POST;
		$vehicleType='';
                $intServices=NULL;
                $intModelID=NULL;
                $intBrandID=NULL;
                $strLocation=NULL;
                
                /*if(isset($_GET['vehicleType']) && !empty($_GET['vehicleType'])){
                        $vehicleType=$_GET['vehicleType'];
                   }else{
                        $vehicleType=$arrInputs['vehicle_type'];
                   }
                if(isset($_POST['search'])){                                        
                    $intServices=$arrInputs['modlist'];
                    $intBrandID=$arrInputs['makes_id'];                                   
                    }*/
                
                if(isset($_GET)){
                    $vehicleType=$_GET['vehicleType'];
                    $intServices=$_GET['serviceID'];               
                    $intBrandID=$_GET['brandID'];                    
                }
                    
                $arrServices=  ModificationShop::getModificationServices();
                $arrCarBrands=  VehicleBrands::getVehicleBrands(1, 1);//Need to Change
                $arrBikeBrands= VehicleBrands::getVehicleBrands(1, 2);//Need to Change
                $arrShops=  ModificationShop::getModificationShops($intShopID=NULL,$vehicleType,$intServices,$intBrandID,$strLocation);
                
		$this->render('searchmshops',
                        array('vmakelist'=>$arrCarBrands,
                              'types'=>$arrServices,
                              'brand'=>$arrBikeBrands,
                              'serchlist'=>$arrShops,
                              'vehicleType' => $vehicleType,                            
                              'modificationShopImagePath'=>'/modificationshop/shop_image/original/',
                              'modlist'=>$intServices,
                              'makes_id'=>$intBrandID,
                              )
                              );                
                    
                }
/* 	public function actionModificationdetails()
	{   
	
		$vmake=Yii::app()->db->createCommand("SELECT distinct  MPS_VEHICLE_MAKES.makes_id,MPS_VEHICLE_MAKES.makes_name,MPS_VEHICLES.logo_img
							FROM MPS_VEHICLES left JOIN MPS_VEHICLE_MAKES ON MPS_VEHICLES.makes_id=MPS_VEHICLE_MAKES.makes_id
							group by  MPS_VEHICLE_MAKES.makes_name")->queryAll();
	
		
		$this->render('index',array('vmakelist'=>$vmake));
	
	
	}
	public function actionmodifysearch()
	{
		
	
	} */
		public function actionFetchBikeModels()
	{
		$makeid=$_POST['makeid'];
	
		$vbikemodel=Yii::app()->db->createCommand("SELECT bike_model_id, brand_id,bike_model_name,bike_model_img_path FROM bike_models WHERE brand_id=$makeid")->queryAll();
		
		$html='<label>Select Model</label><div class="form-group selectpicker-wrapper"><select class="selectpicker name="bike_model" input-price" data-live-search="true" data-width="100%"
                                                    data-toggle="tooltip" title="Select">';
		foreach($vbikemodel as $vbikemo)
						{
							$html.='<option value="'.$vbikemo['bike_model_id'].'">'.$vbikemo['bike_model_name'].'</option>';
						}  
							$html.='</select></div><div id="mods" class="form-group selectpicker-wrapper">
                                <label for="formFindCarCategory">Type of Modifications</label>
                                <select class="form-control selectpicker" name="modlist" id="modlist" required><option value="">Select Modification Type</option>';
                                	$types=Yii::app()->db->createCommand("select * from MPS_MODIFICATION_TYPES")->queryAll();
                                	foreach($types as $type) { 
									$html.='<option value="'.$type['mods'].'">'.$type['mods'].'</option>';
									 } 
                                $html.='</select>
                            </div>';
		echo $html;
		 
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
			$html.='<label>Select Model</label><div class="form-group selectpicker-wrapper"><select name="car_model" class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                    data-toggle="tooltip" title="Select">';
		
		for($i=0;$i<count($models_id);$i++)
		{
			
			
			$carimagesdata=Yii::app()->db->createCommand("SELECT `models_id`,`car_img` FROM `MPS_VEHICLES` WHERE makes_id=$makes_ids[$i] and models_id=$models_id[$i] and status = 0 ")->queryAll();
			if(!empty($carimagesdata))
			{
						 foreach($carimagesdata as $carimages)
						{
									$html.='<option value="'.$carimages['models_id'].'">'.$models_name[$i].'</option>';
									
								
								
								 
						}  
						
			}
			
				
		}
		$html.='</select></div><div id="mods" class="form-group selectpicker-wrapper">
                                <label for="formFindCarCategory">Type of Modifications</label>
                                <select class="form-control selectpicker" name="modlist" id="modlist" required><option value="">Select Modification Type</option>';
                                	$types=Yii::app()->db->createCommand("select * from MPS_MODIFICATION_TYPES")->queryAll();
                                	foreach($types as $type) { 
									$html.='<option value="'.$type['mods'].'">'.$type['mods'].'</option>';
									 } 
                                $html.='</select>
                            </div>';
		
		echo $html;
		
		
	}
        
        public  function actiongetBrands(){
            $arrVehicleBrands=NULL;
            $strInput=NULL;
            if (Yii::app()->request->isPostRequest) {
                //print_r($arrInput);die();
                $intVehicleType = $_POST['VehicleTypeID'];
                $strInput='<select id="brandlist" name="brandlist" class="selectpicker input-price" data-live-search="true" data-width="100%"
                            data-toggle="tooltip" title="--Select Brand--">
                            <option value="">--Select Brand--</soption>';
                    $arrVehicleBrands=  VehicleBrands::getVehicleBrands(1, $intVehicleType);
                    if(isset($arrVehicleBrands) && !empty($arrVehicleBrands)){
                    foreach ($arrVehicleBrands as $key=>$value){                        
                        $strInput.='<option value='.$value['id'].'>'.$value['name'].'</option>';
                    }
                    }
                    $strInput.='</select>';
            }
            echo $strInput;
            
        }
        
        public function actionGetVehicleBrandModels() {
        $strVehicleModel ='<option value="">--Select Brand--</soption>';
        $arrVehicleModels = array();
        if (Yii::app()->request->isPostRequest) {           
            $intVehicleBrandType = $_POST['brandId'];                        
            $arrVehicleModels = VehicleBrandModels::getVehicleBrandModels($intVehicleBrandType);
            if (!empty($arrVehicleModels)) {
                
                foreach ($arrVehicleModels as $arrModel) {
                    $strVehicleModel .='<option value='.$arrModel['id'].'>'.$arrModel['name'].'</option>';                    
                }
            }       
        }
        echo $strVehicleModel;
    }
    
    public function actionFindModificationShops(){
         $arrShops= array();
         if (Yii::app()->request->isPostRequest) {                
                $strContent='';
                $arrInput=$_POST;
                $vehicleType=$arrInput['vehicleTypeID'];
                $intServices=$arrInput['serviceTypeID'];
                $intBrandID=$arrInput['brandId'];
                $strLocation=$arrInput['locationStr'];
                if(!empty($arrInput['locationLatitudeLongitude'])){
                    $strLatitude=explode(',',$arrInput['locationLatitudeLongitude'])[0];
                    $strLongitude=explode(',',$arrInput['locationLatitudeLongitude'])[1]; 
                }else{
                    $strLatitude=NULL;
                    $strLongitude=NULL;
                }
                $modificationShopImagePath='/modificationshop/shop_image/original/';
                $arrShops=  ModificationShop::getModificationShops($intShopID=NULL,$vehicleType,$intServices,$intBrandID,$strLocation,$strLatitude,$strLongitude);
                
                if(isset($arrShops) && !empty($arrShops)){
                    foreach ($arrShops as $list){
                       $strContent.='<div class="thumbnail no-border no-padding thumbnail-car-card clearfix">
                            <div class="media col-md-5">                                
                                ';
                        if (empty($list['shop_image'])) {
                        $strContent.= '<img src="'.Yii::app()->params['imgURL'].'modification-default-img.jpg" alt=""/>';
                        } else {
                        $strContent.= '<img src="'.Yii::app()->params['adminImgURL'] . $modificationShopImagePath . $list['shop_image'].'" alt=""/>';
                        }
                        $strContent.='</div>
                            <div class="caption">
                                <div class="rating">
                                    <span class="star"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                    <span class="star active"></span>
                                </div>
                                <h4 class="caption-title"><a href="#">'.$list['name'].'</a></h4>
                                <div class="caption-text">'.$list['description'].'</div>
                                <table class="table">
                                    <tr>
                                        <td><i class="fa fa-mobile" aria-hidden="true" title="Call Us"></i>'.$list['phone'].'</td>
                                        <td><i class="fa fa-envelope-o" aria-hidden="true" title="Mail Us"></i>'.$list['email'].'</td>
                                        <td>';
                                   if ($list['vehicle_type'] == '1') {
                                       $strContent.='<i class="fa fa-car" aria-hidden="true" title="Vehicle Type Car"></i>';                                       
                                   }else{
                                       $strContent.='<i class="fa fa-motorcycle" aria-hidden="true"></i>';                                       
                                   }
                                        $strContent.='</td>
                                    </tr>
                                </table>';
                                if(!empty(Yii::app()->session['customerID'])){
                                   $strContent.='<a class="btn btn-theme pull-right" href="#" style="margin-top:10px;" id="btnsub1"  data-toggle = "modal" onclick="sendRequestEmailtoShop('.$list['id'].')">Send Request</a>';
                                }else{
                                     $strContent.='<a class="btn btn-theme pull-right" id="btnsub1"  data-toggle = "modal" data-target = "#signup-model">Send Request</a>';
                                }                                  
                                $strContent.='</div></div>'; 
                    }
                }else{
                    $strContent='No Modification shops in this type';
                }
                echo $strContent;
         }
            
    }
    
    //This is for Send Request Test Mail , 
    public function actionSendRequestEmail(){
            $arrResponse=array();
            $arrMailContent=array();
            $arrPost=$_POST;
            $intCustomerID=Yii::app()->session['customerID'];
            if(!empty($intCustomerID)){
                 if (Yii::app()->request->isPostRequest) {
                    $intShopID=$_POST['shopID'];
                    $vehicleType=$_POST['VehicleType'];
                    $intBrandID=$_POST['brandID'];
                    $intServices=$_POST['serviceTypeID'];
                    $strLocation=$_POST['locationStr'];
                    if(!empty($_POST['locationLatitudeLongitude'])){
                        $strLatitude=explode(',',$_POST['locationLatitudeLongitude'])[0];
                        $strLongitude=explode(',',$_POST['locationLatitudeLongitude'])[1]; 
                    }else{
                        $strLatitude=NULL;
                        $strLongitude=NULL;
                    }
                    
                    $arrCustomer=  ModificationShop::getCustomerDetails($intCustomerID);                    
                    $arrShops=  ModificationShop::getModificationShops($intShopID,$vehicleType,$intServices,$intBrandID,$strLocation,$strLatitude,$strLongitude);
                                      
                    $arrDataOne=array_shift($arrCustomer); //Logged in customer details
                    $arrDataTwo=array_shift($arrShops); // Selected Modification shop details
                    $arrInput=  array_merge($arrDataOne,$arrDataTwo);
                   
                    //Email Reciver
                    $toShop=$arrInput['email'];
                    $toCustomer='pandiya110@yahoo.com';//$arrInput['custmail'];
                    $toAdmin='support@metrepersecond.com';
                    $receiverArray=array('shop'=>$toShop,'customer'=>$toCustomer,'admin'=>$toAdmin);
                                                                               
                   if(!empty($arrInput)){
                            if($arrInput['vehicle_type']==1){
                                $Type='Car';                            
                            }else{
                                $Type='Bike';
                            }
                    $saveOrder=$this->actionSaveModificationOrders($arrPost,$arrInput,$intCustomerID);                
                    if(!empty($saveOrder)){                                           
                          foreach($receiverArray as $key=>$value){
                           if(!empty($value)){  
                                if($key=='shop'){
                                  //SMS Content  
                                  $toMobile= $arrInput['phone'];  
                                  $smsContent='Hi '.$arrInput['name'].',The Following Customer Send Request for '.$Type.' Modification,Kindly find the below Customer details.Customer Info :: Name :- '.$arrInput['custname'].'; E-Mail :-  '.$arrInput['custmail'].'
                                               Mobile :-  '.$arrInput['custphone'].'; Address :-  '.$arrInput['custadrs'].' ; Vehicle Brand :-  '.$arrInput['vehicle_brand'].'
                                               Modification Type :-  '.$arrInput['service_name'].' ';
                                  
                                  //Email Content
                                  $Content='<div>
                                            Hi '.$arrInput['name'].',<br/><br/>
                                            The Following Customer Send Request for '.$Type.' Modification,
                                            Kindly find the below Customer details.
                                            <br/>                                    
                                            <div>Name :- '.$arrInput['custname'].'</div>
                                            <div>E-Mail :-  '.$arrInput['custmail'].'</div>
                                            <div>Mobile :-  '.$arrInput['custphone'].'</div>                    
                                            <div>Address :-  '.$arrInput['custadrs'].'</div>                                                                        
                                            <div>Vehicle Brand :-  '.$arrInput['vehicle_brand'].'</div>
                                            <div>Modification Type :-  '.$arrInput['service_name'].'</div>    
                                            <br/><br/>
                                            <div>';
                                  }
                                  if($key=='customer'){
                                      //SMS Content
                                      $toMobile= $arrInput['custphone'];
                                      $smsContent='Hi '.$arrInput['custname'].',' .'Your Request for '.$Type.' Modification successfully send to '.$arrInput['name'].' shop, Kindly find the modification shop details.Shop Name :- '.$arrInput['name'].'; E-Mail :-  '.$arrInput['email'].'; Mobile :-  '.$arrInput['phone'].'                    
                                                   Address :-  '.$arrInput['shop_adress'].'; Pincode :-  '.$arrInput['shop_pincode'].'; Location :-  '.$arrInput['shop_location'].' ';
                                      
                                      //E-Mail Content
                                      $Content='<div>
                                            Hi '.$arrInput['custname'].',<br/><br/>
                                            Your Request for '.$Type.' Modification successfully send to '.$arrInput['name'].' shop,
                                            Kindly find the modification shop details.    
                                            <br/>                                                                        
                                            <div>Shop Name :- '.$arrInput['name'].'</div>
                                            <div>E-Mail :-  '.$arrInput['email'].'</div>
                                            <div>Mobile :-  '.$arrInput['phone'].'</div>                    
                                            <div>Address :-  '.$arrInput['shop_adress'].'</div>
                                            <div>Address :-  '.$arrInput['shop_pincode'].'</div>
                                            <div>Location :-  '.$arrInput['shop_location'].'</div>    
                                            <br/><br/>
                                            <div>';

                                  }
                                  if($key=='admin'){
                                      //SMS Content
                                      $toMobile='8125371946';//Need to change
                                      $smsContent='Hi Admin,Request for '.$Type.' Modification ,Kondly find the modification shop & customer details.Shop Info :: Shop Name :- '.$arrInput['name'].'; E-Mail :-  '.$arrInput['email'].'; Mobile :-  '.$arrInput['phone'].'                    
                                                   Address :-  '.$arrInput['shop_adress'].'; Pincode :-  '.$arrInput['shop_pincode'].'; Location :-  '.$arrInput['shop_location'].' Customer Info :: Name :- '.$arrInput['custname'].'; E-Mail :-  '.$arrInput['custmail'].' Mobile :-  '.$arrInput['custphone'].'; Address :-  '.$arrInput['custadrs'].' ; Vehicle Brand :-  '.$arrInput['vehicle_brand'].'
                                                   Modification Type :-  '.$arrInput['service_name'].'';
                                      
                                      //Email Content
                                      $Content='<div>
                                            Hi Admin,<br/><br/>
                                            Request for '.$Type.' Modification ,Kondly find the modification shop & customer details.    
                                            <br/>                               
                                            <b>Customer Info:-</b><br/>
                                            <div>Name :- '.$arrInput['custname'].'</div>
                                            <div>E-Mail :-  '.$arrInput['custmail'].'</div>
                                            <div>Mobile :-  '.$arrInput['custphone'].'</div>                    
                                            <div>Address :-  '.$arrInput['custadrs'].'</div>                                                                        
                                            <div>Vehicle Brand :-  '.$arrInput['vehicle_brand'].'</div>
                                            <div>Modification Type :-  '.$arrInput['service_name'].'</div>    
                                            <br/><br/>
                                            <b>Shop Info:-</b><br/>
                                            <div>Shop Name :- '.$arrInput['name'].'</div>
                                            <div>E-Mail :-  '.$arrInput['email'].'</div>
                                            <div>Mobile :-  '.$arrInput['phone'].'</div>                    
                                            <div>Address :-  '.$arrInput['shop_adress'].'</div>
                                            <div>Address :-  '.$arrInput['shop_pincode'].'</div>
                                            <div>Location :-  '.$arrInput['shop_location'].'</div>    
                                            <br/><br/>
                                            <div>';

                                  }
                                  $Html='<div style="">
                                           <table align="center" width="100%" cellspacing="5" cellpadding="5">
                                           <tr>
                                           <td>
                                           <div class="logo">
                                           <img src="http://www.metrepersecond.com/Staging/bookaservice/assets/img/logo-mps.png" height="70">                   
                                            </div> 
                                            </td>
                                            </tr>
                                            <tr><td coslpan="2"></td></tr>                    
                                            </table>
                                            <div style=" font-family: trebuchet ms;margin: -3px 28px 12px;">
                                            '.$Content.'
                                            Thanks & Regards,<br/>
                                            Metrepersecond,<br/>
                                            www.metrepersecond.com,<br/>
                                            support@metrepersecond.com.
                                            </div>
                                           </div>'; 

                                    //E-MAIL
                                    $mail=  SMTPConfiguration::getSMTPConfig();                                    
                                    $mail->Subject = 'Request For Modification';           
                                    $mail->Body=$Html;                                    
                                    $mail->AddAddress($value);                            
                                    if(!$mail->Send()) {
                                         $error =$mail->ErrorInfo;
                                         $arrResponse=array('Type'=>'fail','Error'=>$error);                    
                                    }else {
                                         //SMS
                                         $sendSMS=$this->actionSendSMS($toMobile,$smsContent);
                                         $error = 'Message sent successfully!';                    
                                         $arrResponse=array('Type'=>'success','Error'=>$error);
                                    }
                              }
                        }
                        }else{
                            $arrResponse=array('Type'=>'fail','Error'=>'Failure to send your request, Try agian after sometimes!.');
                        } // Save order condition End
                        
                    }else{
                            $arrResponse=array('Type'=>'fail','Error'=>'Failure to send mail , Try agian after sometimes!.');
                    }//$arrInput Condition End 
                    
                }//Ajax Post Condtion End
            }else{
                $arrResponse=array('Type'=>'fail','Error'=>'Failure to send, Try agian after sometimes!.');
            }
            echo json_encode($arrResponse);exit;
                
    }
    
    //This is SendSMS for Testing
    public function actionSendSMS($Mobile, $smsContent) {
        
        $strSMSToken = NULL;        
        $arrCustomer=array('mobile'=>$Mobile,'message'=>$smsContent); //Need to Change
        $arrSmsData = Yii::app()->params['sms'];
        $objDataManager = new DataManager();
        //$arrCustomer['message'] = $objDataManager->getOTPTemplate($arrCustomer['message']);
        $arrSmsData = array_merge($arrSmsData, $arrCustomer);
        $objectSMSManager = new SMSManager($arrSmsData);
        $strSMSToken = $objectSMSManager->fireSMS();        
        //return $strSMSToken;
    }
    
    //Save Modification Orders 
    public function actionSaveModificationOrders($arrPost,$arrInputs,$intCustomerID){ 
      
                $arrInput=  array_merge($arrPost,$arrInputs);
                if(!empty($arrPost['locationLatitudeLongitude'])){
                        $arrInput['latitude']=explode(',',$_POST['locationLatitudeLongitude'])[0];
                        $arrInput['longitude']=explode(',',$_POST['locationLatitudeLongitude'])[1]; 
                    }else{
                        $arrInput['latitude']=NULL;
                        $arrInput['longitude']=NULL;
                    }
                    
                $objTransaction=Yii::app()->db->beginTransaction();
                $objData=new DataManager();
                $arrData=$objData->makeModificationShopOrders($arrInput);
                
                //Orders
                $intOrderID=  ModificationOrders::create($arrData['modification_orders']);
                
                //Orders Communication
                $intOrderCommID=  ModificationOrdersCommunication::create($arrData['modification_orders_communication'],$intOrderID);
                
                if(!empty($intOrderCommID)){
                    $objTransaction->commit();
                }else{
                    $objTransaction->rollback();
                }
                
               return $intOrderID;
         
    }
}