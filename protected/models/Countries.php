<?php

/**
 * @author Digital Today
 * @access public
 * @ignore It will handle Sector activities
 */
class Countries extends CActiveRecord {

    private $strTable = 'countries';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrCountry
     * @return integer It will return sector item id
     */
    public static function create($arrCountry) {
        $intCountry = NULL;
        try {
            $objCountry = new Countries();
            if (isset($arrCountry['id']) && !empty($arrCountry['id'])) {
                $objCountry = Countries::model()->find('id=:id', array(':id' => $arrCountry['id']));
            }
            $objCountry->name = $arrCountry['country_name'];
            $objCountry->code = $arrCountry['country_code'];
            $objCountry->description = $arrCountry['country_description'];
            $objCountry->status = $arrCountry['country_status'];
            $objCountry->device_types_id = $arrCountry['device_id'];
            if (isset($arrCountry['id']) && !empty($arrCountry['id'])) {
                $objCountry->last_modified_by = $arrCountry['last_modified_by'];
            } else {
                $objCountry->created_date = $arrCountry['created_date'];
                $objCountry->created_by = $arrCountry['created_by'];
            }
            $objCountry->ip_address = $arrCountry['ip_address'];
            if ($objCountry->save()) {
                $intCountry = $objCountry->id;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $intCountry;
    }

    /**
     * @author Digital Today
     * @access public
     * @param string $strName
     * @return array It will return countries details
     */
    public static function isNameExist($strName, $intCountry) {
        $arrCountry = array();
        try {
            $objDB = Yii::app()->db->createCommand();
            $objDB->select('c.id');
            $objDB->from('countries as c');
            if (!empty($intCountry)) {
                $objDB->where('c.name=:name and c.id!=:id', array(':name' => $strName, ':id' => $intCountry));
            } else {
                $objDB->where('c.name=:name', array(':name' => $strName));
            }
            $arrCountry = $objDB->queryRow();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $arrCountry;
    }

    /**
     * @author Digital Today
     * @access public
     * @param string $strCode
     * @return array It will return countries details
     */
    public static function isCodeExist($strCode, $intCountry) {
        $arrCountry = array();
        try {
            $objDB = Yii::app()->db->createCommand();
            $objDB->select('c.id');
            $objDB->from('countries as c');
            if (!empty($intCountry)) {
                $objDB->where('c.code=:code and c.id!=:id', array(':code' => $strCode, ':id' => $intCountry));
            } else {
                $objDB->where('c.code=:code', array(':code' => $strCode));
            }

            $arrCountry = $objDB->queryRow();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $arrCountry;
    }

    public static function countriesReport($arrInputs = array()) {
        $arrCountries = array();
        try {
            $objDB = Yii::app()->db->createCommand();
            $objDB->select('c.id as country_id,'
                    . 'c.name as country_name,'
                    . 'c.code as country_code,'
                    . 'c.description as country_description,'
                    . 'c.status as country_status'
            );
            $objDB->from('countries as c');
            if (isset($arrInputs['status'])) {
                $objDB->where('c.status=:status', array(':status' => $arrInputs['status']));
            }
            if (isset($arrInputs['search']) && !empty($arrInputs['search'])) {
                $objDB->where(array('like', 'c.name', '%' . $arrInputs['search'] . '%'));
            }
            $objDB->order(array('c.name', 'c.id asc'));
            $arrCountries = $objDB->queryAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $arrCountries;
    }

}
