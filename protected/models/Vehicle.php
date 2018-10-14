<?php

class Vehicle extends CActiveRecord {

    public $strTable = 'MPS_VEHICLES';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param string $strUsername
     * @return array It will return customer data
     */
  

    /**
     * @author Ctel
     * @param array $arrCustomer
     * @return integer It will return an integer response
     */
    public static function create($arrVehicle) {
        $intVehicleAutoId = NULL;
        $objectCarVehicle = new Vehicle();
        $objectCarVehicle->first_name = $arrCustomer['first_name'];
        $objectCarVehicle->username = $arrCustomer['username'];
        $objectCarVehicle->password = md5($arrCustomer['password']); // Need to change
        $objectCarVehicle->status = $arrCustomer['status'];
      
        if ($objectCarVehicle->save()) {
            $intVehicleId = $objectCarVehicle->id;
        }
        return $intCustomerId;
    }

    /**
     * @author Ctel
     * @param array $arrVerfication
     * @param integer $intCustomerId
     * @return integer It will return affected rows count
     */
    /*public static function updateCustomer($arrVerfication, $intCustomerId) {
        $intUpdateRows = Yii::app()->db->createCommand()
                ->update('customer', $arrVerfication, 'id=:id', array(':id' => $intCustomerId)
        );
        return $intUpdateRows;
    }*/

}
