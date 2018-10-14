<?php

class ShopOrderRejected extends CActiveRecord {

    public $strTable = 'shop_orders_rejected';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrShopOrders
     * @return integer It will return last inserted id of shop accepted orders
     */
    public static function create($arrShopOrders) {
        $intShop = NULL;
        $objShop = new ShopOrderRejected();
        $objShop->shop_id = $arrShopOrders['shop_id'];
        $objShop->order_id = $arrShopOrders['order_id'];
        $objShop->reasons_id = $arrShopOrders['reasons_id'];
        $objShop->other_reason = isset($arrShopOrders['other_reason']) ? $arrShopOrders['other_reason'] : NULL;
        $objShop->is_rejected = 1;
        $objShop->created_date = $arrShopOrders['created_date'];
        $objShop->created_by = $arrShopOrders['created_by'];
        $objShop->ip_address = $arrShopOrders['ip_address'];
        $objShop->device_id = $arrShopOrders['device_id'];
        $objShop->imei_no = $arrShopOrders['imei_no'];
        if ($objShop->save()) {
            $intShop = $objShop->id;
        }
        return $intShop;
    }

    /**
     * @author Digital Today
     * @param integer $intShop
     * @param integer $intStatus
     * @return array It will return shop orders
     */
    public static function shopRejectedOrders($intShop = 0) {
        $arrRejectedOrders = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('group_concat(concat("""",sor.order_id,"""")) as order_ids');
        $objectDB->from('shop_orders_rejected as sor');
        if (!empty($intShop)) {
            $objectDB->where('sor.shop_id=:shopId', array(':shopId' => $intShop));
        }
        $arrRejectedOrders = $objectDB->queryAll();
        return $arrRejectedOrders;
    }

}
