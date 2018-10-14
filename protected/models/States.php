<?php

/**
 * @author Digital Today
 * @access public
 * @ignore It will handle Sector activities
 */
class States extends CActiveRecord {

    private $strTable = 'states';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrState
     * @return integer It will return sector item id
     */
    public static function create($arrState) {
        $intState = NULL;
        try {
            $objState = new States();
            if (isset($arrState['id']) && !empty($arrState['id'])) {
                $objState = States::model()->find('id=:id', array(':id' => $arrState['id']));
            }
            $objState->countries_id = $arrState['state_countries_id'];
            $objState->name = $arrState['state_name'];
            $objState->code = $arrState['state_code'];
            $objState->description = $arrState['state_description'];
            $objState->status = $arrState['state_status'];
            $objState->device_types_id = $arrState['device_id'];
            if (isset($arrState['id']) && !empty($arrState['id'])) {
                $objState->last_modified_by = $arrState['last_modified_by'];
            } else {
                $objState->created_date = $arrState['created_date'];
                $objState->created_by = $arrState['created_by'];
            }
            $objState->ip_address = $arrState['ip_address'];
            if ($objState->save()) {
                $intState = $objState->id;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $intState;
    }

    public static function statesReport($arrInputs = array()) {

        $arrStates = array();
        try {
            $objDB = Yii::app()->db->createCommand();
            $objDB->select('s.id as state_id,'
                    . 's.name as state_name,'
                    . 's.code as state_code,'
                    . 's.description as state_description,'
                    . 's.status as state_status,c.id as country_id,c.name as country_name'
            );
            $objDB->from('states as s');
            $objDB->join('countries as c', 'c.id = s.countries_id');
            if (isset($arrInputs['status'])) {
                $objDB->where('s.status=:status', array(':status' => $arrInputs['status']));
            }
            if (isset($arrInputs['country_type']) && !empty($arrInputs['country_type'])) {
                $objDB->where('s.countries_id=:countryId', array(':countryId' => $arrInputs['country_type']));
            }
            if (isset($arrInputs['search']) && !empty($arrInputs['search'])) {
                $objDB->where(array('like', 's.name', '%' . $arrInputs['search'] . '%'));
            }
            $objDB->order(array('s.name', 's.id asc'));
            $arrStates = $objDB->queryAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $arrStates;
    }

}
