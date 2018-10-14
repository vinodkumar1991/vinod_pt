<?php

class OtherServicesCommunication extends CActiveRecord {

    public $strTable = 'other_services_communication';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrOther
     * @return integer It will return an integer response
     */
    public static function create($arrOther) {
        $intOtherServiceId = NULL;
        $objOther = new OtherServices();
        $objOther->name = $arrOther['other_name'];
        $objOther->mobile = $arrOther['other_mobile'];
        $objOther->description = $arrOther['additional_information'];
        $objOther->path = NULL;
        $objOther->status = $arrOther['status'];
        $objOther->created_date = $arrOther['created_date'];
        $objOther->created_by = $arrOther['created_by'];
        $objOther->ip_address = $arrOther['ip_address'];
        $objOther->device_id = $arrOther['device_id'];
        if ($objOther->save()) {
            $intOtherServiceId = $objOther->id;
        }
        return $intOtherServiceId;
    }

}
