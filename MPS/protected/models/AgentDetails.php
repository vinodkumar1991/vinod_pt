<?php

class AgentDetails extends CActiveRecord {

    public $strTable = 'agents_details';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function create($arrAgentDetails) {
        $intAgentDetails = NULL;
        $objAgentDetails = new AgentDetails();
        $objAgentDetails->agents_id = $arrAgentDetails['agents_id'];
        $objAgentDetails->address = $arrAgentDetails['address'];
        $objAgentDetails->cities_id = $arrAgentDetails['cities_id'];
        $objAgentDetails->pincode = $arrAgentDetails['pincode'];
        $objAgentDetails->areas_id = $arrAgentDetails['areas_id'];
        $objAgentDetails->original_photo = $arrAgentDetails['original_photo'];
        $objAgentDetails->photo = $arrAgentDetails['photo'];
        $objAgentDetails->address_original_image = $arrAgentDetails['address_original_image'];
        $objAgentDetails->address_image = $arrAgentDetails['address_image'];
        $objAgentDetails->id_original_proof = $arrAgentDetails['id_original_proof'];
        $objAgentDetails->id_image = $arrAgentDetails['id_image'];
        $objAgentDetails->created_date = $arrAgentDetails['created_date'];
        $objAgentDetails->created_by = $arrAgentDetails['created_by'];
        $objAgentDetails->ip_address = $arrAgentDetails['ip_address'];
        $objAgentDetails->location = $arrAgentDetails['location'];
        $objAgentDetails->latitude = $arrAgentDetails['latitude'];
        $objAgentDetails->longitude = $arrAgentDetails['longitude'];
        $objAgentDetails->register_original_image = $arrAgentDetails['register_original_image'];
        $objAgentDetails->register_image = $arrAgentDetails['register_image'];
        if ($objAgentDetails->save()) {
            $intAgentDetails = $objAgentDetails->id;
        }
        return $intAgentDetails;
    }

    public static function updateAgentsDetails($arrAgents, $intAgentId) {
        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('agents_details', $arrAgents, 'agents_id=:agentId', array(':agentId' => $intAgentId));
        return $intUpdate;
    }

}
