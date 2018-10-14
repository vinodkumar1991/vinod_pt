<?php

class MechanicShopsServices extends CActiveRecord {

    public $strTable = 'mechanic_shop_details';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrMechanicSkills
     * @return integer It will return mechanic skills id
     */
    public static function create($arrMechanicSkills) {
        $intInserted = NULL;
        if (!empty($arrMechanicSkills)) {
            foreach ($arrMechanicSkills as $arrEleSkill) {
                $objCommand = Yii::app()->db->createCommand();
                $intInserted = $objCommand->insert('mechanic_shops_services', $arrEleSkill);
            }
        }
        return $intInserted;
    }

}
