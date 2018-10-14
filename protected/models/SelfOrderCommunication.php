<?php

class SelfOrderCommunication extends CActiveRecord {

    public $strTable = 'self_order_communication';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    
    public static function create($arrAddSelfdriveCommuniDetails,$intSelfOrderId)
    {
        $intAddSelfdriveCommuId = '';
       
        $objectSelfOrderCommu = new SelfOrderCommunication();
        $objectSelfOrderCommu->self_order_id = $intSelfOrderId;
        $objectSelfOrderCommu->name = $arrAddSelfdriveCommuniDetails['name'];
        $objectSelfOrderCommu->additional_info = $arrAddSelfdriveCommuniDetails['additional'];
        $objectSelfOrderCommu->city = $arrAddSelfdriveCommuniDetails['city'];
        $objectSelfOrderCommu->address_one = $arrAddSelfdriveCommuniDetails['address1'];
        $objectSelfOrderCommu->address_two = $arrAddSelfdriveCommuniDetails['address2'];
        $objectSelfOrderCommu->pincode = $arrAddSelfdriveCommuniDetails['pincode'];
        $objectSelfOrderCommu->email = $arrAddSelfdriveCommuniDetails['email'];
        $objectSelfOrderCommu->phone = $arrAddSelfdriveCommuniDetails['phone'];
        $objectSelfOrderCommu->location = $arrAddSelfdriveCommuniDetails['Location'];
        $objectSelfOrderCommu->longitude = $arrAddSelfdriveCommuniDetails['Longitude'];
        $objectSelfOrderCommu->latitude = $arrAddSelfdriveCommuniDetails['latitude'];

        if ($objectSelfOrderCommu->save())
        {
            $intAddSelfdriveCommuId = $objectSelfOrderCommu->id;
        }
        return $intAddSelfdriveCommuId;
    }

   
}
