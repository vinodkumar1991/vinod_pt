<?php

class SelfVehiclesDetails extends CActiveRecord {

    public $strTable = 'self_vehicles_details';

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
    public static function create($arrAddSelfdrive,$self_vehicles_id)
    {
        
        $intAddSelfdriveId = NULL;
        $intStatus = 1;
        $objectAddSelfdrive = new SelfVehiclesDetails();
     
        $date = date('d-m-Y h:i:s');
        $locations = explode(',',$arrAddSelfdrive['location']);
        $objectAddSelfdrive->self_vehicles_id = $self_vehicles_id;
        $objectAddSelfdrive->kmperhr = $arrAddSelfdrive['kmperhr'];
        $objectAddSelfdrive->latitude =  $locations[0];
        $objectAddSelfdrive->longitude =  $locations[1];
        $objectAddSelfdrive->location = $arrAddSelfdrive['location'];
        $objectAddSelfdrive->priceperhr = $arrAddSelfdrive['priceperhr'];
        $objectAddSelfdrive->extrarate = $arrAddSelfdrive['extrarate'];
        $objectAddSelfdrive->deposit = $arrAddSelfdrive['deposit'];
        $objectAddSelfdrive->from_date = date('d-m-Y h:i');
        $objectAddSelfdrive->to_date = date('d-m-Y h:i');
         $objectAddSelfdrive->start_time = strtotime($date);
        $objectAddSelfdrive->end_time = strtotime($date);
        $objectAddSelfdrive->deposit = $arrAddSelfdrive['deposit'];
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

   public static function GetVehicleDetails($vehicleId) {

        $arrVehicleDetails = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('svd.from_date,svd.to_date');
        $objectDB->from('self_vehicles_details as svd');
        $objectDB->where('svd.self_vehicles_id=:self_vehicles_id', array(':self_vehicles_id' => $vehicleId));
        $arrVehicleDetails = $objectDB->queryRow();
        return $arrVehicleDetails;
    }
    
    public static function UpdateVehicleDetails($strFromDate, $strToDate, $vehicleId) {
       echo $strFrom_Date = mktime($strFromDate).'----';
       echo $strTo_Date = mktime($strToDate);
	   die();
       $intVehicleDetails=Yii::app()->db->createCommand("UPDATE  self_vehicles_details SET `from_date`='".$strFromDate."',to_date='".$strToDate."',start_time='".$strFrom_Date."',end_time = '".$strTo_Date."'  WHERE self_vehicles_id = $vehicleId")->execute();
       echo $intVehicleDetails;
    }

}
