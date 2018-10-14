<?php

class HireAMechanicCommunication extends CActiveRecord {

    public $strTable = 'hire_a_mechanic_communication';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrHireCommunication
     * @return integer It will return last inserted live tracking 
     */
    public static function create($arrHireCommunication) {
        $intHireAMechanic = NULL;
        $objHireAMechanic = new HireAMechanicCommunication();
        $objHireAMechanic->hire_a_mechanic_id = $arrHireCommunication['hire_a_mechanic_id'];
        $objHireAMechanic->image_name = $arrHireCommunication['image_name'];
        $objHireAMechanic->original_image_name = $arrHireCommunication['original_image_name'];
        $objHireAMechanic->id_proof_name = $arrHireCommunication['id_proof_name'];
        $objHireAMechanic->id_proof_original_name = $arrHireCommunication['id_proof_original_name'];
        $objHireAMechanic->address_proof_name = $arrHireCommunication['address_proof_name'];
        $objHireAMechanic->original_address_proof_name = $arrHireCommunication['original_address_proof_name'];
        $objHireAMechanic->location = $arrHireCommunication['location'];
        $objHireAMechanic->latitude = $arrHireCommunication['latitude'];
        $objHireAMechanic->longitude = $arrHireCommunication['longitude'];
        if ($objHireAMechanic->save()) {
            $intHireAMechanic = $objHireAMechanic->id;
        }
        return $intHireAMechanic;
    }

}
