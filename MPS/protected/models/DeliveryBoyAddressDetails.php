<?php

/**
 * @author Digital Today
 * @access public
 * @ignore It will handle Sector activities
 */
class DeliveryBoyAddressDetails extends CActiveRecord {

    private $strTable = 'delivery_boys_details';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrDelivery
     * @return integer It will return sector item id
     */
    public static function create($arrDelivery) {
        $intDelivery = NULL;
        try {
            $objDelivery = new DeliveryBoyAddressDetails();
            $objDelivery->delivery_boys_id = $arrDelivery['delivery_boys_id'];
            $objDelivery->address_one = $arrDelivery['address_one'];
            $objDelivery->address_two = $arrDelivery['address_two'];
            $objDelivery->driving_original_path = $arrDelivery['driving_original_path'];
            $objDelivery->driving_license_path = $arrDelivery['driving_license_path'];
            $objDelivery->address_original_path = $arrDelivery['address_original_path'];
            $objDelivery->address_proof_path = $arrDelivery['address_proof_path'];
            $objDelivery->photo_original_path = $arrDelivery['photo_original_path'];
            $objDelivery->photo_path = $arrDelivery['photo_path'];
            if ($objDelivery->save()) {
                $intDelivery = $objDelivery->id;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $intDelivery;
    }

    public static function updateDeliveryBoyDetails($arrDeliveryBoy, $intDelivery) {
        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('delivery_boys_details', $arrDeliveryBoy, 'delivery_boys_id=:deliveryBoyId', array(':deliveryBoyId' => $intDelivery));
        return $intUpdate;
    }

}
