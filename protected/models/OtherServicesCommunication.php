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
        $objOther = new OtherServicesCommunication();
        $objOther->other_orders_id = $arrOther['other_orders_id'];
        $objOther->name = $arrOther['other_name'];
        $objOther->mobile = $arrOther['other_mobile'];
        $objOther->description = $arrOther['additional_information'];
        $objOther->path = isset($arrOther['path']) ? $arrOther['path'] : NULL;
        $objOther->original_file_name = isset($arrOther['original_file_name']) ? $arrOther['original_file_name'] : NULL;
        $objOther->location = isset($arrOther['location']) ? $arrOther['location'] : NULL;
        $objOther->lati_longitude = isset($arrOther['lati_longitude']) ? $arrOther['lati_longitude'] : NULL;
        if (isset($arrOther['lati_longitude']) && !empty($arrOther['lati_longitude'])) {
            $objOther->longitude = explode(',', $arrOther['lati_longitude'])[0];
            $objOther->latitude = explode(',', $arrOther['lati_longitude'])[1];
        }
        $objOther->booked_date = $arrOther['booked_date'];
        $objOther->booked_time = $arrOther['booked_time'];
        $objOther->sms_token = $arrOther['sms_token'];
        if ($objOther->save()) {
            $intOtherServiceId = $objOther->id;
        }
        return $intOtherServiceId;
    }

}
