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
    public static function create($arrHireCertificates, $intHire = NULL) {
        $intHireAMechanic = NULL;
        if (!empty($arrHireCertificates)) {
            if (!empty($intHire)) {
                self::deleteCertificates($intHire);
            }
            foreach ($arrHireCertificates as $arrCertificate) {
                $objHireAMechanic = new HireAMechanicCertificates();
                $objHireAMechanic->hire_a_mechanic_id = isset($arrCertificate['hire_a_mechanic_id']) ? $arrCertificate['hire_a_mechanic_id'] : $intHire;
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

    public static function getCertificates($intHire) {
        $arrHire = array();
        $intStatus = 1;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('hamc.image_name');
        $objectDB->from('hire_a_mechanic_certificates as hamc');
        $objectDB->andWhere('hamc.hire_a_mechanic_id=:hireId and hamc.status=:status', array(':hireId' => $intHire, ':status' => $intStatus));
        $arrHire = $objectDB->queryAll();
        return $arrHire;
    }

    public static function deleteCertificates($intHire) {
        $objCommand = Yii::app()->db->createCommand();
        $intDelete = $objCommand->delete('hire_a_mechanic_certificates', 'hire_a_mechanic_id=:hireId', array(':hireId' => $intHire));
        return $intDelete;
    }

}
