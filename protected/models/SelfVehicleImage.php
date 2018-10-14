<?php

class SelfVehicleImage extends CActiveRecord {

    public $strTable = 'self_vehicles_images';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Ctel
     * @param array $arrVehicleImages
     * @return array It will return VehicleTypes data
     */
//    public static function create($arrVehicleImages) {
//        $intVehImageId = NULL;
//        if (!empty($arrVehicleImages)) {
//            foreach ($arrVehicleImages as $arrImage) {
//                $objectVehImage = new SelfVehicleImage();
//                $objectVehImage->self_vehicles_id = $arrImage['self_vehicles_id'];
//                $objectVehImage->original_name = $arrImage['original_name'];
//                $objectVehImage->image_name = $arrImage['image_name'];
//                $objectVehImage->is_parent = $arrImage['is_parent'];
//                $objectVehImage->status = $arrImage['status'];
//                if ($objectVehImage->save()) {
//                    $intVehImageId = $objectVehImage->id;
//                }
//            }
//        }
//        return $intVehImageId;
//    }

    public static function getVehicleImages($intStatus = 1, $intSelfVehicle = NULL) {
        $arrVehicleImages = array();
        $intInActive = 0;
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('svi.id as self_vehicle_image_id,svi.image_name as self_vehicle_image,'
                . '(CASE WHEN (svi.is_parent = 2 and sv.vehicle_types_id = 1) THEN "/selfdrive/multi_images/cars/mobile/280X162/" ELSE "/selfdrive/multi_images/cars/mobile/450X260/" END) AS vehicle_multi_image_path,'
                . '(CASE WHEN (svi.is_parent = 2 and sv.vehicle_types_id = 2) THEN "/selfdrive/multi_images/bikes/mobile/280X162/" ELSE "/selfdrive/multi_images/bikes/mobile/450X260/" END) AS vehicle_bike_multi_image_path,'
                . '(CASE WHEN (svi.is_parent = 1 and sv.vehicle_types_id = 2) THEN "/selfdrive/bikes/mobile/280X162/" ELSE "/selfdrive/bikes/mobile/450X260/" END) AS vehicle_bike_parent_image_path,'
                . '(CASE WHEN (svi.is_parent = 1 and sv.vehicle_types_id = 1) THEN "/selfdrive/cars/mobile/280X162/" ELSE "/selfdrive/cars/mobile/450X260/" END) AS vehicle_parent_image_path,svi.is_parent');
        $objectDB->from('self_vehicles_images as svi');
        $objectDB->join('self_vehicles as sv', 'sv.id = svi.self_vehicles_id');
        $objectDB->where('svi.status=:status', array(':status' => $intStatus));
        if (!empty($intSelfVehicle)) {
            $objectDB->andWhere('svi.self_vehicles_id=:selfVehicleId', array(':selfVehicleId' => $intSelfVehicle));
        }
        $arrVehicleImages = $objectDB->queryAll();
        return $arrVehicleImages;
    }

}
