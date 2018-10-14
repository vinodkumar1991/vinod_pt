<?php

class HireAMechanicPhone extends CActiveRecord {

    public $strTable = 'hire_a_mechanic_phone';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrHireEmail
     * @return integer It will return last inserted live tracking 
     */
    public static function create($arrHireEmail) {
        $intHireAMechanic = NULL;
        $objHireAMechanic = new HireAMechanicPhone();
        $objHireAMechanic->hire_a_mechanic_id = $arrHireEmail['hire_a_mechanic_id'];
        $objHireAMechanic->phone = $arrHireEmail['phone'];
        $objHireAMechanic->status = $arrHireEmail['status'];
        $objHireAMechanic->is_primary = $arrHireEmail['is_primary'];
        if ($objHireAMechanic->save()) {
            $intHireAMechanic = $objHireAMechanic->id;
        }
        return $intHireAMechanic;
    }

    public static function isPhoneExist($strPhone, $intHire = NULL) {
        $arrHire = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('hmp.id');
        $objectDB->from('hire_a_mechanic_phone as hmp');
        $objectDB->where('hmp.phone=:phone', array(':phone' => $strPhone));
        if (!empty($intHire)) {
            $objectDB->andWhere('hmp.hire_a_mechanic_id!=:hireId', array(':hireId' => $intHire));
        }
        $arrHire = $objectDB->queryRow();
        return $arrHire;
    }

    public static function updateHirePhone($arrHire, $intHire) {
        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('hire_a_mechanic_phone', $arrHire, 'hire_a_mechanic_id=:hireId', array(':hireId' => $intHire));
        return $intUpdate;
    }

}
