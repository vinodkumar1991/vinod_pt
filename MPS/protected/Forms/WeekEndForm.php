<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class WeekEndForm extends CFormModel
{

    public $weekend_kmperhr;
    public $weekend_deposit;
    public $weekend_extrarate;
    public $weekend_priceperhr;
    /**
     * @author digital today
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() 
    {
        return array(
                      array('weekend_kmperhr,weekend_deposit,weekend_extrarate,weekend_priceperhr', 'required'), 
                      //rules for Kms per Hour fields
                      array('weekend_kmperhr', 'numerical', 'integerOnly'=>true, 'min'=>1),
                      array('weekend_kmperhr', 'length', 'min'=>1, 'max'=>3),  
            
                     // rules Security Deposit
                      array('weekend_deposit', 'numerical', 'integerOnly'=>true),
            
                      //rules for Extra Rate Per Kms
                      array('weekend_extrarate', 'numerical', 'integerOnly'=>true),
            
                      
                       //rules for Price Hour fields
                      array('weekend_priceperhr', 'numerical', 'integerOnly'=>true),
                    
            );
    }
    
   public function attributeLabels() {
        return array(
            'weekend_kmperhr' => 'Kms per Hour',
            'weekend_priceperhr' => 'Price Per Hour',
            'weekend_extrarate' =>  'Extra Rate Per Kms',
            'weekend_deposit' => 'Security Deposit',
 );
    }
}
