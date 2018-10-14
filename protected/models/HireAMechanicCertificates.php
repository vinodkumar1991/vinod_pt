<?php

class HireAMechanicCertificates extends CActiveRecord {

    public $strTable = 'hire_a_mechanic_certificates';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrHireCertificates
     * @return integer It will return last inserted live tracking 
     */
    public static function create($arrHireCertificates) {
        $intHireAMechanic = NULL;
        if (!empty($arrHireCertificates)) {
            foreach ($arrHireCertificates as $arrCertificate) {
                $objHireAMechanic = new HireAMechanicCertificates();
                $objHireAMechanic->hire_a_mechanic_id = $arrCertificate['hire_a_mechanic_id'];
                $objHireAMechanic->image_name = $arrCertificate['image_name'];
                $objHireAMechanic->original_image_name = $arrCertificate['original_image_name'];
                $objHireAMechanic->status = $arrCertificate['status'];
                if ($objHireAMechanic->save()) {
                    $intHireAMechanic = $objHireAMechanic->id;
                }
            }
        }
        return $intHireAMechanic;
    }

}
