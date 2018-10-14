<?php

class HireAMechanicEmail extends CActiveRecord {

    public $strTable = 'hire_a_mechanic_email';

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
        $objHireAMechanic = new HireAMechanicEmail();
        $objHireAMechanic->hire_a_mechanic_id = $arrHireEmail['hire_a_mechanic_id'];
        $objHireAMechanic->email = $arrHireEmail['email'];
        $objHireAMechanic->status = $arrHireEmail['status'];
        $objHireAMechanic->is_primary = $arrHireEmail['is_primary'];
        if ($objHireAMechanic->save()) {
            $intHireAMechanic = $objHireAMechanic->id;
        }
        return $intHireAMechanic;
    }

    public static function isEmailExist($strEmail, $intHire = NULL) {
        $arrHire = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('hme.id');
        $objectDB->from('hire_a_mechanic_email as hme');
        $objectDB->where('hme.email=:email', array(':email' => $strEmail));
        if (!empty($intHire)) {
            $objectDB->andWhere('hme.hire_a_mechanic_id!=:hireId', array(':hireId' => $intHire));
        }
        $arrHire = $objectDB->queryRow();
        return $arrHire;
    }

    public static function updateHireEmail($arrHire, $intHire) {
        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('hire_a_mechanic_email', $arrHire, 'hire_a_mechanic_id=:hireId', array(':hireId' => $intHire));
        return $intUpdate;
    }

}
