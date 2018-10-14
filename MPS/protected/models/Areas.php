<?php

/**
 * @author Digital Today
 * @access public
 * @ignore It will handle Sector activities
 */
class Areas extends CActiveRecord {

    private $strTable = 'areas';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrArea
     * @return integer It will return sector item id
     */
    public static function create($arrArea) {
        $intArea = NULL;
        try {
            $objArea = new Areas();
            if (isset($arrArea['id']) && !empty($arrArea['id'])) {
                $objArea = Areas::model()->find('id=:id', array(':id' => $arrArea['id']));
            }
            $objArea->cities_id = $arrArea['area_city_id'];
            $objArea->name = $arrArea['area_name'];
            $objArea->code = $arrArea['area_code'];
            $objArea->pincode = $arrArea['area_pincode'];
            $objArea->description = $arrArea['area_description'];
            $objArea->status = $arrArea['area_status'];
            $objArea->device_types_id = $arrArea['device_id'];
            if (isset($arrArea['id']) && !empty($arrArea['id'])) {
                $objArea->last_modified_by = $arrArea['last_modified_by'];
            } else {
                $objArea->created_date = $arrArea['created_date'];
                $objArea->created_by = $arrArea['created_by'];
            }
            $objArea->ip_address = $arrArea['ip_address'];

            if ($objArea->save()) {
                $intArea = $objArea->id;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $intArea;
    }

    public static function areasReport($arrInputs = array()) {

        $arrrAreas = array();
        try {
            $objDB = Yii::app()->db->createCommand();
            $objDB->select('a.id as area_id,'
                    . 'a.name as area_name,'
                    . 'a.code as area_code,'
                    . 'a.description as area_description,'
                    . 'a.status as area_status,c.id as city_id,c.name as city_name'
            );
            $objDB->from('areas as a');
            $objDB->join('cities as c', 'c.id = a.cities_id');
            if (isset($arrInputs['status'])) {
                $objDB->where('a.status=:status', array(':status' => $arrInputs['status']));
            }
            if (isset($arrInputs['city_type']) && !empty($arrInputs['city_type'])) {
                $objDB->where('a.cities_id=:cityId', array(':cityId' => $arrInputs['city_type']));
            }
            if (isset($arrInputs['search']) && !empty($arrInputs['search'])) {
                $objDB->where(array('like', 'a.name', '%' . $arrInputs['search'] . '%'));
            }
            if (isset($arrInputs['area_id']) && !empty($arrInputs['area_id'])) {
                $objDB->where('a.id=:areaId', array(':areaId' => $arrInputs['area_id']));
            }
            $objDB->order(array('a.name', 'a.id asc'));
            $arrrAreas = $objDB->queryAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $arrrAreas;
    }

    public static function FetchAreaDetails($city_id) {

        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('area.id,area.name');
        $objectDB->from('areas as area');
        $objectDB->where('area.cities_id=:cities_id', array(':cities_id' => $city_id));
        $arrArea = $objectDB->queryAll();
        return $arrArea;
    }

}
