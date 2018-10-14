<?php

class MechanicShopDetails extends CActiveRecord {

    public $strTable = 'mechanic_shop_details';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param array $arrMechanic
     * @return integer It will return mechanic shop id
     */
    public static function create($arrMechanic) {
        $intMechanicShop = NULL;
        $objMechanicShop = new MechanicShopDetails();
        $objMechanicShop->mechanic_shops_id = $arrMechanic['mechanic_shop_id'];
        $objMechanicShop->address = $arrMechanic['address'];
        $objMechanicShop->total_mechanics = $arrMechanic['total_mechanics']; // Need to change
        $objMechanicShop->service_capability = $arrMechanic['service_capability'];
        $objMechanicShop->cities_id = $arrMechanic['cities_id'];
        $objMechanicShop->areas_id = $arrMechanic['areas_id'];
        $objMechanicShop->pincode = $arrMechanic['pincode'];
        $objMechanicShop->location = $arrMechanic['location'];
        $objMechanicShop->longitude = $arrMechanic['longitude'];
        $objMechanicShop->latitude = $arrMechanic['latitude'];
        $objMechanicShop->address_image = $arrMechanic['address_image'];
        $objMechanicShop->address_original_image = $arrMechanic['address_original_image'];
        $objMechanicShop->id_image = $arrMechanic['id_image'];
        $objMechanicShop->id_original_image = $arrMechanic['id_original_image'];
        $objMechanicShop->photo_image = $arrMechanic['photo_image'];
        $objMechanicShop->photo_original_image = $arrMechanic['photo_original_image'];
        $objMechanicShop->created_date = $arrMechanic['created_date'];
        $objMechanicShop->created_by = $arrMechanic['created_by'];
        $objMechanicShop->ip_address = $arrMechanic['ip_address'];
        $objMechanicShop->device_id = $arrMechanic['device_id'];
        if ($objMechanicShop->save()) {
            $intMechanicShop = $objMechanicShop->id;
        }
        return $intMechanicShop;
    }

    public static function updateShopDetails($arrShop, $intShop) {
        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('mechanic_shop_details', $arrShop, 'mechanic_shops_id=:shopId', array(':shopId' => $intShop));
        return $intUpdate;
    }

}
