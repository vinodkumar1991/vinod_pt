<?php

class HireAMechanicAddress extends CActiveRecord {

    public $strTable = 'hire_a_mechanic_address';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrHireAddress
     * @return integer It will return last inserted live tracking 
     */
    public static function create($arrHireAddress) {
        $intHireAMechanic = NULL;
        $objHireAMechanic = new HireAMechanicAddress();
        $objHireAMechanic->hire_a_mechanic_id = $arrHireAddress['hire_a_mechanic_id'];
        $objHireAMechanic->permenant_address = $arrHireAddress['permanent_address'];
        $objHireAMechanic->present_address = $arrHireAddress['present_address'];
        $objHireAMechanic->status = $arrHireAddress['status'];
        $objHireAMechanic->is_primary = $arrHireAddress['is_primary'];
        if ($objHireAMechanic->save()) {
            $intHireAMechanic = $objHireAMechanic->id;
        }
        return $intHireAMechanic;
    }

}
