<?php

class Agent extends CActiveRecord {

    public $strTable = 'agents';

    public function tableName() {
        return $this->strTable;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @author Digital Today
     * @param string $strUsername
     * @return array It will return customer data
     */
    public static function create($arrAgentDetails) {
        $intUserId = NULL;
        $objAgent = new Agent();
        $objAgent->users_id = $arrAgentDetails['user_id'];
        $objAgent->name = $arrAgentDetails['name'];
        $objAgent->owner = $arrAgentDetails['owner'];
        $objAgent->code = $arrAgentDetails['code'];
        $objAgent->email = $arrAgentDetails['email'];
        $objAgent->phone = $arrAgentDetails['phone'];
        $objAgent->landline = $arrAgentDetails['landline'];
        $objAgent->description = NULL;
        $objAgent->status = $arrAgentDetails['status'];
        $objAgent->created_date = $arrAgentDetails['created_date'];
        $objAgent->created_by = $arrAgentDetails['created_by'];
        $objAgent->ip_address = $arrAgentDetails['ip_address'];
        $objAgent->device_id = $arrAgentDetails['device_id'];
        if ($objAgent->save()) {
            $intUserId = $objAgent->id;
        }
        return $intUserId;
    }

    public static function agentsReoport($arrInputs = array()) {
        $arrAgents = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('u.id as agent_user_id,ag.id as agent_id,ag.name as agency_name,ag.owner as agent_owner,ag.email as agent_email,ag.phone as agent_phone,ad.address as agent_address,ad.pincode as agent_pincode,ag.landline as agent_landline,'
                . 'ad.location as agent_location,c.name as city_name,a.name as area_name,u.username as agent_user_name,ag.code as agent_code,ag.status as agent_status,cy.id as agent_country_id,s.id as agent_state_id,'
                . 'ad.cities_id as agent_city_id,'
                . 'ad.areas_id as agent_area_id,'
                . 'ad.original_photo as agent_original_photo,'
                . 'ad.photo as agent_photo,ad.address_original_image,ad.address_image,'
                . 'ad.id_original_proof,'
                . 'ad.id_image,ad.register_original_image,'
                . 'ad.register_image,ag.code as agent_code');
        $objectDB->from('agents as ag');
        $objectDB->join('agents_details as ad', 'ad.agents_id = ag.id');
        $objectDB->join('users as u', 'u.id = ag.users_id');
        $objectDB->join('cities as c', 'c.id = ad.cities_id');
        $objectDB->join('areas as a', 'a.id = ad.areas_id');
        $objectDB->join('states as s', 's.id = c.states_id');
        $objectDB->join('countries as cy', 'cy.id = s.countries_id');
        if (isset($arrInputs['agent_id']) && !empty($arrInputs['agent_id'])) {
            $objectDB->where('ag.id=:agentId', array(':agentId' => $arrInputs['agent_id']));
        }
        if (isset($arrInputs['agent_user_id']) && !empty($arrInputs['agent_user_id'])) {
            $objectDB->where('ag.users_id=:agentUserId', array(':agentUserId' => $arrInputs['agent_user_id']));
        }
        $arrAgents = $objectDB->queryAll();
        return $arrAgents;
    }

    public static function isNameExist($strAgentName, $intAgent = NULL) {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ag.id');
        $objectDB->from('agents as ag');
        $objectDB->where('ag.name=:name', array(':name' => $strAgentName));
        if (!empty($intAgent)) {
            $objectDB->andWhere('ag.id!=:agentId', array(':agentId' => $intAgent));
        }
        $arrAgentName = $objectDB->queryRow();
        return $arrAgentName;
    }

    public static function isPhoneExist($strAgentNum, $intAgent = NULL) {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ag.id');
        $objectDB->from('agents as ag');
        $objectDB->where('ag.phone=:phone', array(':phone' => $strAgentNum));
        if (!empty($intAgent)) {
            $objectDB->andWhere('ag.id!=:agentId', array(':agentId' => $intAgent));
        }
        $arrAgentNum = $objectDB->queryRow();
        return $arrAgentNum;
    }

    public static function isEmailExist($email_id, $intAgent = NULL) {
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ag.id');
        $objectDB->from('agents as ag');
        $objectDB->where('ag.email=:email', array(':email' => $email_id));
        if (!empty($intAgent)) {
            $objectDB->andWhere('ag.id!=:agentId', array(':agentId' => $intAgent));
        }
        $intAgentEmail = $objectDB->queryRow();
        return $intAgentEmail;
    }

    public static function updateAgents($arrAgents, $intAgentId) {
        $objDB = Yii::app()->db->createCommand();
        $intUpdate = $objDB->update('agents', $arrAgents, 'id=:id', array(':id' => $intAgentId));
        return $intUpdate;
    }
   
    public static function getAgentCode(){
        $arrCodeDetails = array();
        try {
            $strQuery = 'select code,id from agents order by id desc limit 1';
            $arrCodeDetails = Yii::app()->db->createCommand($strQuery)->queryAll();
        } catch (Exception $ex) {
            $arrCodeDetails = $ex->getMessage();
        }

        return $arrCodeDetails;
    }
     public static function isAgentCodeExist($agent_code, $intAgent = NULL){
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('ag.id');
        $objectDB->from('agents as ag');
        $objectDB->where('ag.code=:code', array(':code' => $agent_code));
        if (!empty($intAgent)) {
            $objectDB->andWhere('ag.id!=:agentId', array(':agentId' => $intAgent));
        }
        $intAgentCode = $objectDB->queryRow();
        return $intAgentCode;
    }

}
