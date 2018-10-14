<?php

class SelfVehicles extends CActiveRecord {

    public $strTable = 'self_vehicles';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param string $strUsername
     * @return array It will return AddSelfdrive data
     */
    /*  public static function getAddSelfdrive($intStatus = 1, $intAddSelfdrive = NULL) 
      {
      $arrAddSelfdrive = array();
      $objectDB = Yii::app()->db->createCommand();
      $objectDB->select('c.id,c.password,c.verify_token,c.access_token');
      $objectDB->from('vendor as v');
      if (!empty($intAddSelfdrive))
      {
      $objectDB->where('v.id=:id', array(':id' => $intAddSelfdrive));
      $arrAddSelfdrive = $objectDB->queryRow();
      }
      else
      {
      $objectDB->where('v.status=:status', array(':status' => $intStatus));
      $arrAddSelfdrive = $objectDB->queryAll();
      }


      return $arrAddSelfdrive;
      }
      /**
     * get email
     * @author Ctel
     * @param array $arrAddSelfdrive
     * @return integer It will return an integer response

      public static function getEmail($strEmail)
      {
      $arrCustomer = array();
      $objectDB = Yii::app()->db->createCommand();
      $objectDB->select('c.first_name');
      $objectDB->from('vendor as c');
      $objectDB->where('c.email=:email', array(':email' => $strEmail));
      $arrCustomer = $objectDB->queryRow();
      return $arrCustomer;
      }
      public static function getMobileNo($strMobile)
      {
      $arrCustomer = array();
      $objectDB = Yii::app()->db->createCommand();
      $objectDB->select('c.first_name');
      $objectDB->from('vendor as c');
      $objectDB->where('c.mobile=:mobile', array(':mobile' => $strMobile));
      $arrCustomer = $objectDB->queryRow();
      return $arrCustomer;
      }
     */

    /**
     * @author Ctel
     * @param array $arrAddSelfdrive
     * @return integer It will return an integer response
     */
    public static function create($arrAddSelfdrive)
    {
        $intAddSelfdriveId = NULL;
        $intStatus = 1;
        $objectAddSelfdrive = new SelfVehicles();
        $rand=rand(1111,9999);
        $arrAddSelfdrive['agents_id']=1; // session agent id
        $objectAddSelfdrive->vehicle_types_id = $arrAddSelfdrive['vehicle_types_id'];
        $objectAddSelfdrive->code = $rand;
        $objectAddSelfdrive->vehicle_classes_id = $arrAddSelfdrive['vehicle_classes_id'];
        $objectAddSelfdrive->vehicle_variants_id = $arrAddSelfdrive['vehicle_variants_id'];
        $objectAddSelfdrive->vehicle_brand_models_id = $arrAddSelfdrive['vehicle_brand_models_id'];
        $objectAddSelfdrive->agents_id = $arrAddSelfdrive['agents_id'];
        $objectAddSelfdrive->seating = $arrAddSelfdrive['seating'];
        $objectAddSelfdrive->status = $arrAddSelfdrive['status'];
        $objectAddSelfdrive->created_date = $arrAddSelfdrive['created_date'];
        $objectAddSelfdrive->created_by = $arrAddSelfdrive['created_by'];
        $objectAddSelfdrive->ip_address = $arrAddSelfdrive['ip_address'];

        if ($objectAddSelfdrive->save())
        {
            $intAddSelfdriveId = $objectAddSelfdrive->id;
        }
        return $intAddSelfdriveId;
    }

    public static function getEmail($strEmail) {
        $arrCustomer = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('c.email');
        $objectDB->from('mechanics as c');
        $objectDB->where('c.email=:email', array(':email' => $strEmail));
        $arrCustomer = $objectDB->queryRow();
        return $arrCustomer;
    }
    /**
     * @author Ctel
     * @param string $strMobile
     * @return integer It will return an integer response
     */
    public static function getMobileNo($strMobile) {
        $arrCustomer = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('c.name');
        $objectDB->from('mechanics as c');
        $objectDB->where('c.phone=:phone', array(':phone' => $strMobile));
        $arrCustomer = $objectDB->queryRow();
        return $arrCustomer;
    }
     public function deleteVehicle($vehicleId)
    {
      $intStatus = 0;
      $intUpdateStatus = Yii::app()->db->createCommand("UPDATE `self_vehicles` SET `status`= $intStatus where id = $vehicleId")->execute();
      return $intUpdateStatus;
    }
     public function UpdateVehicleDetails($vehicleId)
    {
      $intStatus = 0;
      $intUpdateStatus = Yii::app()->db->createCommand("UPDATE `self_vehicles` SET `status`= $intStatus where id = $vehicleId")->execute();
      return $intUpdateStatus;
    }
    public function getFeaturesDetails($featureId)
    {
        $arrVehicleFeatures= array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('group_concat(vc.name separator ",") as Features');
        $objectDB->from('vehicle_fetures as vc');
        $objectDB->join('self_vehicles_features svf', 'svf.vehicle_fetures_id=vc.id');
        $objectDB->where('svf.self_vehicles_id=:self_vehicles_id', array(':self_vehicles_id' => $featureId));
        $arrVehicleFeatures = $objectDB->queryAll();
        return $arrVehicleFeatures;
    }
    public function getVehicleClassesByAgentDetails($startDate, $endDate, $intVehicleClassesid, $longitude, $latitude)
    {
       
        $arrVehicleClassesDetails = array();
        try {
            if(0 == $longitude && 0 == $latitude)
            {
         $strQuery = "select distinct self_vehicles.id,vehicle_brands.name as BrandName,vehicle_brand_models.name as ModelName,
                        vehicle_variants.name as Variant,vehicle_classes.name as VehicleCategory,self_vehicles_details.kmperhr,
                        self_vehicles_details.priceperhr,self_vehicles_details.extrarate,
                        self_vehicles_details.extrarate,self_vehicles_details.deposit,
                        self_vehicles.created_date,self_vehicles.seating,self_vehicles_images.image_name  from
                        self_vehicles,vehicle_brand_models,vehicle_classes,vehicle_variants,vehicle_brands,self_vehicles_features,self_vehicles_details,vehicle_fetures,self_vehicles_images where  self_vehicles.vehicle_brand_models_id=vehicle_brand_models.id  and
                        self_vehicles.vehicle_classes_id=vehicle_classes.id and vehicle_variants.id=self_vehicles.vehicle_variants_id and vehicle_brands.id=vehicle_brand_models.vehicle_brands_id and self_vehicles_images.self_vehicles_id=self_vehicles.id and
                        vehicle_classes.id=self_vehicles.vehicle_classes_id
                        and self_vehicles_details.self_vehicles_id=self_vehicles.id 
                        and self_vehicles_features.vehicle_fetures_id=vehicle_fetures.id 
                        and self_vehicles_features.self_vehicles_id=self_vehicles.id  and self_vehicles_images.is_parent='1'
                        and self_vehicles_details.start_time <='".$startDate."' and  self_vehicles_details.end_time >='".$endDate."' and self_vehicles.vehicle_classes_id = ".$intVehicleClassesid." and  self_vehicles.status = 1  group by self_vehicles.id";
          $arrVehicleClassesDetails = Yii::app()->db->createCommand($strQuery)->queryAll();
            }
            else
            {
              
                 $strQuery = "select distinct self_vehicles.id,vehicle_brands.name as BrandName,vehicle_brand_models.name as ModelName,
                        vehicle_variants.name as Variant,vehicle_classes.name as VehicleCategory,self_vehicles_details.kmperhr,
                        self_vehicles_details.priceperhr,self_vehicles_details.extrarate,
                        self_vehicles_details.extrarate,self_vehicles_details.deposit,
                        self_vehicles.created_date,self_vehicles.seating,self_vehicles_images.image_name  from
                        self_vehicles,vehicle_brand_models,vehicle_classes,vehicle_variants,vehicle_brands,self_vehicles_features,self_vehicles_details,vehicle_fetures,self_vehicles_images where  self_vehicles.vehicle_brand_models_id=vehicle_brand_models.id  and
                        self_vehicles.vehicle_classes_id=vehicle_classes.id and vehicle_variants.id=self_vehicles.vehicle_variants_id and vehicle_brands.id=vehicle_brand_models.vehicle_brands_id and self_vehicles_images.self_vehicles_id=self_vehicles.id and
                        vehicle_classes.id=self_vehicles.vehicle_classes_id
                        and self_vehicles_details.self_vehicles_id=self_vehicles.id 
                        and self_vehicles_features.vehicle_fetures_id=vehicle_fetures.id 
                        and self_vehicles_features.self_vehicles_id=self_vehicles.id  and self_vehicles_images.is_parent='1'
                        and self_vehicles_details.start_time <='".$startDate."' and  self_vehicles_details.end_time >='".$endDate."' and self_vehicles.vehicle_classes_id = ".$intVehicleClassesid." and self_vehicles_details.latitude < ".$longitude." and self_vehicles_details.longitude > ".$latitude." and  self_vehicles.status = 1  group by self_vehicles.id";
            }
            $arrVehicleClassesDetails = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            $arrVehicleClassesDetails = $e->getMessage();
        }
        return $arrVehicleClassesDetails;
    }
     public function getTripByAgentDetails($startDate, $endDate, $latitude, $longitude)
    {
        $arrAddSelfVehicleList = array();
        try {
            if(0 == $longitude && 0 == $latitude)
            {
         $strQuery = "select distinct self_vehicles.id,vehicle_brands.name as BrandName,vehicle_brand_models.name as ModelName,
                        vehicle_variants.name as Variant,vehicle_classes.name as VehicleCategory,self_vehicles_details.kmperhr,
                        self_vehicles_details.priceperhr,self_vehicles_details.extrarate,
                        self_vehicles_details.extrarate,self_vehicles_details.deposit,
                        self_vehicles.created_date,self_vehicles.seating,self_vehicles_images.image_name  from
                        self_vehicles,vehicle_brand_models,vehicle_classes,vehicle_variants,vehicle_brands,self_vehicles_features,self_vehicles_details,vehicle_fetures,self_vehicles_images where  self_vehicles.vehicle_brand_models_id=vehicle_brand_models.id  and
                        self_vehicles.vehicle_classes_id=vehicle_classes.id and vehicle_variants.id=self_vehicles.vehicle_variants_id and vehicle_brands.id=vehicle_brand_models.vehicle_brands_id and self_vehicles_images.self_vehicles_id=self_vehicles.id and
                        vehicle_classes.id=self_vehicles.vehicle_classes_id
                        and self_vehicles_details.self_vehicles_id=self_vehicles.id 
                        and self_vehicles_features.vehicle_fetures_id=vehicle_fetures.id 
                        and self_vehicles_features.self_vehicles_id=self_vehicles.id  and self_vehicles_images.is_parent='1'
                        and self_vehicles_details.start_time <='".$startDate."' and  self_vehicles_details.end_time >='".$endDate."' and  self_vehicles.status = 1  group by self_vehicles.id";
          $arrAddSelfVehicleList = Yii::app()->db->createCommand($strQuery)->queryAll();
            }
            else
            {
				echo "select distinct self_vehicles.id,vehicle_brands.name as BrandName,vehicle_brand_models.name as ModelName,
                        vehicle_variants.name as Variant,vehicle_classes.name as VehicleCategory,self_vehicles_details.kmperhr,
                        self_vehicles_details.priceperhr,self_vehicles_details.extrarate,
                        self_vehicles_details.extrarate,self_vehicles_details.deposit,
                        self_vehicles.created_date,self_vehicles.seating,self_vehicles_images.image_name  from
                        self_vehicles,vehicle_brand_models,vehicle_classes,vehicle_variants,vehicle_brands,self_vehicles_features,self_vehicles_details,vehicle_fetures,self_vehicles_images where  self_vehicles.vehicle_brand_models_id=vehicle_brand_models.id  and
                        self_vehicles.vehicle_classes_id=vehicle_classes.id and vehicle_variants.id=self_vehicles.vehicle_variants_id and vehicle_brands.id=vehicle_brand_models.vehicle_brands_id and self_vehicles_images.self_vehicles_id=self_vehicles.id and
                        vehicle_classes.id=self_vehicles.vehicle_classes_id
                        and self_vehicles_details.self_vehicles_id=self_vehicles.id 
                        and self_vehicles_features.vehicle_fetures_id=vehicle_fetures.id 
                        and self_vehicles_features.self_vehicles_id=self_vehicles.id  and self_vehicles_images.is_parent='1'
                        and self_vehicles_details.start_time <='".$startDate."' and self_vehicles_details.latitude <=".$longitude." and self_vehicles_details.longitude >= ".$latitude." and self_vehicles_details.end_time >='".$endDate."'  and  self_vehicles.status = 1  group by self_vehicles.id";
						die();
            
                 $strQuery = "select distinct self_vehicles.id,vehicle_brands.name as BrandName,vehicle_brand_models.name as ModelName,
                        vehicle_variants.name as Variant,vehicle_classes.name as VehicleCategory,self_vehicles_details.kmperhr,
                        self_vehicles_details.priceperhr,self_vehicles_details.extrarate,
                        self_vehicles_details.extrarate,self_vehicles_details.deposit,
                        self_vehicles.created_date,self_vehicles.seating,self_vehicles_images.image_name  from
                        self_vehicles,vehicle_brand_models,vehicle_classes,vehicle_variants,vehicle_brands,self_vehicles_features,self_vehicles_details,vehicle_fetures,self_vehicles_images where  self_vehicles.vehicle_brand_models_id=vehicle_brand_models.id  and
                        self_vehicles.vehicle_classes_id=vehicle_classes.id and vehicle_variants.id=self_vehicles.vehicle_variants_id and vehicle_brands.id=vehicle_brand_models.vehicle_brands_id and self_vehicles_images.self_vehicles_id=self_vehicles.id and
                        vehicle_classes.id=self_vehicles.vehicle_classes_id
                        and self_vehicles_details.self_vehicles_id=self_vehicles.id 
                        and self_vehicles_features.vehicle_fetures_id=vehicle_fetures.id 
                        and self_vehicles_features.self_vehicles_id=self_vehicles.id  and self_vehicles_images.is_parent='1'
                        and self_vehicles_details.start_time <='".$startDate."' and self_vehicles_details.latitude <=".$longitude." and self_vehicles_details.longitude >= ".$latitude." and self_vehicles_details.end_time >='".$endDate."'  and  self_vehicles.status = 1  group by self_vehicles.id";
            }
            $arrAddSelfVehicleList = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            $arrAddSelfVehicleList = $e->getMessage();
        }
        return $arrAddSelfVehicleList;
    }
     
   /* public function getImageDetails($intVehicleId)
    {
        //echo $intVehicleId.'\n';
        //die();
        $arrVehicleImages= array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('img.image_name,img.is_parent');
        $objectDB->from('self_vehicles_images as img');
        $objectDB->join('self_vehicles sv', 'sv.id=img.self_vehicles_id');
        $objectDB->where('img.self_vehicles_id=:self_vehicles_id', array(':self_vehicles_id' => $intVehicleId));
        $arrVehicleImages = $objectDB->queryAll();
        return $arrVehicleImages;
    }*/
     public function getImageDetails($intVehicleId)
    {
         
       $arrSelfImageList = array();
        try {
            $strQuery = "SELECT self_vehicles_images.image_name,self_vehicles_images.is_parent
            FROM self_vehicles_images
            LEFT JOIN self_vehicles on self_vehicles.id=self_vehicles_images.self_vehicles_id
            WHERE self_vehicles_images.is_parent = '1' and self_vehicles_images.self_vehicles_id = ".$intVehicleId."";
         $arrSelfImageList = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $e) {
            $arrSelfImageList = $e->getMessage();
        }
        return $arrSelfImageList;
       
    }
    //------------
    public function getCustomerOrderedVehicleDetails($intSelfVehicle)
    {
        $arrSelfOrderedDetailsList = array();
        try {
             $strQuery="select distinct self_vehicles.id,vehicle_brands.name as BrandName,vehicle_brand_models.name as ModelName
                         from self_vehicles,vehicle_brand_models,vehicle_brands where  self_vehicles.vehicle_brand_models_id=vehicle_brand_models.id  and
                        
                          vehicle_brands.id=vehicle_brand_models.vehicle_brands_id and self_vehicles.id='".$intSelfVehicle."'
                          group by self_vehicles.id";
            $arrSelfOrderedDetailsList = Yii::app()->db->createCommand($strQuery)->queryAll();
           } catch (Exception $e) {
               $arrSelfOrderedDetailsList = $e->getMessage();
           }
           return $arrSelfOrderedDetailsList;
    }
     public function getImageChildDetails($intVehicleId)
    {
         
       $arrSelfImageList = array();
        try {
          /*  $strQuery="SELECT self_vehicles_images.image_name,self_vehicles_images.is_parent,self_vehicles_images.original_name
            FROM self_vehicles_images
            LEFT JOIN self_vehicles on self_vehicles.id=self_vehicles_images.self_vehicles_id
            WHERE  self_vehicles_images.self_vehicles_id=".$intVehicleId." and self_vehicles_images.is_parent=1";*/
            
             $strQuery="SELECT self_vehicles_images.image_name,self_vehicles_images.is_parent,self_vehicles_images.original_name
            FROM self_vehicles_images
            LEFT JOIN self_vehicles on self_vehicles.id=self_vehicles_images.self_vehicles_id
            WHERE  self_vehicles_images.self_vehicles_id=".$intVehicleId."";
            $arrSelfImageList = Yii::app()->db->createCommand($strQuery)->queryAll();
           } catch (Exception $e) {
               $arrSelfImageList = $e->getMessage();
           }
           return $arrSelfImageList;
       
    }
   
     public function getAgentDetails($intVehicleId) {
        $arrAddSelfVehicleList = array();
        try {
            if(0 == $intVehicleId)
            {
                
            $strQuery = "select distinct self_vehicles.id,vehicle_brands.name as BrandName,vehicle_brand_models.name as ModelName,
                        vehicle_variants.name as Variant,vehicle_classes.name as VehicleCategory,self_vehicles_details.kmperhr,
                        self_vehicles_details.priceperhr,self_vehicles_details.extrarate,
                        self_vehicles_details.extrarate,self_vehicles_details.deposit,
                        self_vehicles.created_date,self_vehicles.seating,self_vehicles_images.image_name  from
                        self_vehicles,vehicle_brand_models,vehicle_classes,vehicle_variants,vehicle_brands,self_vehicles_features,self_vehicles_details,vehicle_fetures,self_vehicles_images where  self_vehicles.vehicle_brand_models_id=vehicle_brand_models.id  and
                        self_vehicles.vehicle_classes_id=vehicle_classes.id and vehicle_variants.id=self_vehicles.vehicle_variants_id and vehicle_brands.id=vehicle_brand_models.vehicle_brands_id and self_vehicles_images.self_vehicles_id=self_vehicles.id and
                        vehicle_classes.id=self_vehicles.vehicle_classes_id
                        and self_vehicles_details.self_vehicles_id=self_vehicles.id 
                        and self_vehicles_features.vehicle_fetures_id=vehicle_fetures.id 
                        and self_vehicles_features.self_vehicles_id=self_vehicles.id  and self_vehicles_images.is_parent='1'
                        and self_vehicles.status = 1  group by self_vehicles.id";
         
            }
            else
            {
                $strQuery = "select distinct self_vehicles.id,vehicle_brands.name as BrandName,vehicle_brand_models.name as ModelName,
                        vehicle_variants.name as Variant,vehicle_classes.name as VehicleCategory,self_vehicles_details.kmperhr,
                        self_vehicles_details.priceperhr,self_vehicles_details.extrarate,
                        self_vehicles_details.extrarate,self_vehicles_details.deposit,
                        self_vehicles.created_date,self_vehicles.seating,self_vehicles_images.image_name  from
                        self_vehicles,vehicle_brand_models,vehicle_classes,vehicle_variants,vehicle_brands,
                        self_vehicles_features,self_vehicles_details,vehicle_fetures,self_vehicles_images where  
                        self_vehicles.vehicle_brand_models_id=vehicle_brand_models.id  and
                        self_vehicles.vehicle_classes_id=vehicle_classes.id and 
                        vehicle_variants.id=self_vehicles.vehicle_variants_id and 
                        vehicle_brands.id=vehicle_brand_models.vehicle_brands_id and self_vehicles_images.self_vehicles_id=self_vehicles.id and
                        vehicle_classes.id=self_vehicles.vehicle_classes_id
                        and self_vehicles_details.self_vehicles_id=self_vehicles.id 
                        and self_vehicles_features.vehicle_fetures_id=vehicle_fetures.id 
                        and self_vehicles_features.self_vehicles_id=self_vehicles.id  
                        and self_vehicles.status = 1 and self_vehicles_images.self_vehicles_id=".$intVehicleId." group by self_vehicles.id";
            }
         $arrAddSelfVehicleList = Yii::app()->db->createCommand($strQuery)->queryAll();
            
        } catch (Exception $e) {
            $arrAddSelfVehicleList = $e->getMessage();
        }
        return $arrAddSelfVehicleList;
    }
    
    
     /**
     * @author Ctel
     * @param string $intStatus
     * @return array It will return an array response
     */

    public static function getAllAddSelfdrives($intStatus = 1) {
        $arrAddSelfdrives = array();
        $objDBCommand = Yii::app()->db->createCommand();
        $objDBCommand->select('m.id,m.name,m.code,m.email,m.phone,m.description,m.created_date,md.address
            ,md.company_name,md.experience,md.photo,md.license,ms.location,ms.latitude,ms.longitude,
            ms.cost,vt.name as vehicle_name,group_concat(vb.name) as brand_name');
        $objDBCommand->from('mechanics as m');
        $objDBCommand->join('mechanics_details as md', 'md.mechanics_id = m.id');
        $objDBCommand->join('mechanics_skills as ms', 'ms.mechanics_id = m.id');
        $objDBCommand->join('vehicle_types as vt', 'vt.id = ms.vehicle_types_id');
        $objDBCommand->join('vehicle_brands as vb', 'vb.id = ms.vehicle_brands_id');
        $objDBCommand->where('m.status=:status', array(':status' => $intStatus));
        $objDBCommand->group('ms.mechanics_id');
        $arrAddSelfdrives = $objDBCommand->queryAll();
        return $arrAddSelfdrives;
    }
    /**
     * @author Ctel
     * @param integer $intAddSelfdriveId
     * @return string It will return an string response
     */
    public static function mechanicDelete($intAddSelfdriveId)
    {       
        $objectDB = Yii::app()->db->createCommand();               
        $objectDB->update('mechanics',array('status'=>0),'id=:id', array(':id'=>$intAddSelfdriveId));
        $strResponse=$objectDB->execute();
        $strResponse='yes';
        return $strResponse;
    
    }

}
