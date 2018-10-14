<?php

class MechanicShopsServices extends CActiveRecord {

    public $strTable = 'mechanic_shops_services';

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
    public static function create($arrMechanicSkills, $intShop = NULL) {
        $intInserted = NULL;
        if (!empty($arrMechanicSkills)) {
            self::deleteServices($intShop);
            foreach ($arrMechanicSkills as $arrEleSkill) {
                $objCommand = Yii::app()->db->createCommand();
                $intInserted = $objCommand->insert('mechanic_shops_services', $arrEleSkill);
            }
        }
        return $intInserted;
    }

    public static function getMechanicServices($intMechanic = NULL) {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('mss.service_types_id as serviceTypeId,mss.total_mechanics,mss.service_capability');
        $objectDB->from('mechanic_shops_services as mss');
        if (!empty($intMechanic)) {
            $objectDB->where('mss.mechanic_shops_id=:shopId', array(':shopId' => $intMechanic));
        }
        $objectDB->order('mss.id asc');
        $arrServiceType = $objectDB->queryAll();
        return $arrServiceType;
    }

    public static function deleteServices($intShop) {
        $objCommand = Yii::app()->db->createCommand();
        $intDelete = $objCommand->delete('mechanic_shops_services', 'mechanic_shops_id=:shopId', array(':shopId' => $intShop));
        return $intDelete;
    }

}
