<?php

/**
 * @author Digital Today
 * @access public
 * @ignore It will handle Sector activities
 */
class Cities extends CActiveRecord {

    private $strTable = 'cities';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrCity
     * @return integer It will return sector item id
     */
    public static function create($arrCity) {
        $intCity = NULL;
        try {
            $objCity = new Cities();
            if (isset($arrCity['id']) && !empty($arrCity['id'])) {
                $objCity = Cities::model()->find('id=:id', array(':id' => $arrCity['id']));
            }
            $objCity->states_id = $arrCity['city_state_id'];
            $objCity->name = $arrCity['city_name'];
            $objCity->code = $arrCity['city_code'];
            $objCity->description = $arrCity['city_description'];
            $objCity->status = $arrCity['city_status'];
            $objCity->device_types_id = $arrCity['device_id'];
            if (isset($arrCity['id']) && !empty($arrCity['id'])) {
                $objCity->last_modified_by = $arrCity['last_modified_by'];
            } else {
                $objCity->created_date = $arrCity['created_date'];
                $objCity->created_by = $arrCity['created_by'];
            }
            $objCity->ip_address = $arrCity['ip_address'];

            if ($objCity->save()) {
                $intCity = $objCity->id;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $intCity;
    }

    public static function citiesReport($arrInputs = array()) {

        $arrCities = array();
        try {
            $objDB = Yii::app()->db->createCommand();
            $objDB->select('c.id as city_id,'
                    . 'c.name as city_name,'
                    . 'c.code as city_code,'
                    . 'c.description as city_description,'
                    . 'c.status as city_status,s.id as state_id,s.name as state_name'
            );
            $objDB->from('cities as c');
            $objDB->join('states as s', 's.id = c.states_id');
            if (isset($arrInputs['status'])) {
                $objDB->where('c.status=:status', array(':status' => $arrInputs['status']));
            }
            if (isset($arrInputs['state_type']) && !empty($arrInputs['state_type'])) {
                $objDB->where('c.states_id=:stateId', array(':stateId' => $arrInputs['state_type']));
            }
            if (isset($arrInputs['city_id']) && !empty($arrInputs['city_id'])) {
                $objDB->where('c.id=:id', array(':id' => $arrInputs['city_id']));
            }
            if (isset($arrInputs['search']) && !empty($arrInputs['search'])) {
                $objDB->where(array('like', 'c.name', '%' . $arrInputs['search'] . '%'));
            }
            $objDB->order(array('c.name', 'c.id asc'));
            $arrCities = $objDB->queryAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $arrCities;
    }

    public static function FetchCityDetails($state_id) {

        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('mc.id,mc.name');
        $objectDB->from('cities as mc');
        $objectDB->where('mc.states_id=:states_id', array(':states_id' => $state_id));
        $arrCities = $objectDB->queryAll();
        return $arrCities;
    }

}
