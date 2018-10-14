<?php

class HireOrdersCommunication extends CActiveRecord {

    public $strTable = 'hire_orders_communication';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrHireCommunication
     * @return integer It will return an customer phone id
     * @ignore Need to change and also add foreign key to phone type table
     */
    public static function create($arrHireCommunication) {

        $intHireOrderCommunication = NULL;
        $objHireOrdersCommunication = new HireOrdersCommunication();
        $objHireOrdersCommunication->hire_orders_id = $arrHireCommunication['hire_orders_id'];
        $objHireOrdersCommunication->location = $arrHireCommunication['location'];
        $objHireOrdersCommunication->latitude = $arrHireCommunication['latitude'];
        $objHireOrdersCommunication->longitude = $arrHireCommunication['longitude'];
        $objHireOrdersCommunication->hr_price = $arrHireCommunication['hire_price'];
        if ($objHireOrdersCommunication->save()) {
            $intHireOrderCommunication = $objHireOrdersCommunication->id;
        }
        return $intHireOrderCommunication;
    }

}
