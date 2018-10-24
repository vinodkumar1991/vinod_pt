<?php

class VehicleCategoryBrandModels extends CActiveRecord
{

    public $strTable = 'vehicle_category_brand_models';

    public function tableName()
    {
        return $this->strTable;
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     *
     * @author Digital Today
     * @param string $strUsername
     * @return array It will return customer data
     */
    public static function create($arrCategoryDetails)
    {
        $intCategoryId = NULL;
        $objVehicleCategoryBrandModels = new VehicleCategoryBrandModels();
        $objVehicleCategoryBrandModels->vehicle_brand_id = $arrCategoryDetails['vehicle_brand_id'];
        $objVehicleCategoryBrandModels->vehicle_brand_model_id = $arrCategoryDetails['vehicle_model_id'];
        $objVehicleCategoryBrandModels->vehicle_category_id = $arrCategoryDetails['vehicle_category_id'];
        $objVehicleCategoryBrandModels->status = $arrCategoryDetails['status'];
        if ($objVehicleCategoryBrandModels->save()) {
            $intCategoryId = $objVehicleCategoryBrandModels->id;
        }
        return $intCategoryId;
    }

    public static function vehicleBrandModelCategories($arrInputs = array())
    {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vcbm.id');
        $objectDB->from('vehicle_category_brand_models as vcbm');
        // Brand
        if (isset($arrInputs['brand_id']) && ! empty($arrInputs['brand_id'])) {
            $objectDB->andWhere('vcbm.vehicle_brand_id=:brandId', array(
                ':brandId' => $arrInputs['brand_id']
            ));
        }
        // Model
        if (isset($arrInputs['model_id']) && ! empty($arrInputs['model_id'])) {
            $objectDB->andWhere('vcbm.vehicle_brand_model_id=:modelId', array(
                ':modelId' => $arrInputs['model_id']
            ));
        }
        // Category
        if (isset($arrInputs['category_id']) && ! empty($arrInputs['category_id'])) {
            $objectDB->andWhere('vcbm.vehicle_category_id=:categoryId', array(
                ':categoryId' => $arrInputs['category_id']
            ));
        }
        $arrResponse = $objectDB->queryAll();
        return $arrResponse;
    }

    public static function report($arrInputs = array())
    {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('vb.name as brand_name, vbm.name as model_name, vc.name as category_name, vcbm.id as bmc_id,vcbm.status');
        $objectDB->from('vehicle_category_brand_models as vcbm');
        $objectDB->join('vehicle_brands as vb', 'vb.id = vcbm.vehicle_brand_id');
        $objectDB->join('vehicle_brand_models as vbm', 'vbm.id = vcbm.vehicle_brand_model_id');
        $objectDB->join('vehicle_categories as vc', 'vc.id = vcbm.vehicle_category_id');
        $arrResponse = $objectDB->queryAll();
        return $arrResponse;
    }

    public static function updateBrandModeCategory($arrUpdates, $intBMCId)
    {
        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('vehicle_category_brand_models', $arrUpdates, 'id=:id', array(
            ':id' => $intBMCId
        ));
        return $intUpdate;
    }
}
