<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations
 */
class HireMechanicForm extends CFormModel
{
    public $name;
    public $email;
    public $phone;
    public $description;
    public $address;
    public $company_name;
    public $photo;
    public $license;
    public $experience;
    public $certificate;
    public $location;
    public $cost;
    public $vehicle_types_id;
    public $vehicle_brands_id;
    public $latlong;  
    
    /**
     * @author Ctel
     * @return array It will return array of erros if not satisfied the criteria
     */
    public function rules() 
    {
        return array(
            array('name,email,phone,address,company_name,photo,license,certificate,experience,location,cost,vehicle_types_id,latlong', 'required'),
            array('name,email,phone,address,company_name,photo,license,certificate,experience,location,cost,vehicle_types_id,vehicle_brands_id,latlong', 'filter', 'filter' => 'trim'),
            array('name', 'length', 'min' => 3, 'max' => 45),
            array('email', 'email'),
            array('email', 'isEmailExist'),
            array('phone', 'isMobileExist'),           
        );
    }

    /**
     * @author Ctel
     * @param array $attribute
     * @param array $params
     * @return boolean It will return either TRUE or FALSE
    */ 
    
    public function isEmailExist($attribute, $params)
    {
        if (!empty($this->email)) 
        {
            $arrCustomer = Mechanic::model()->getEmail($this->email);
            if (!empty($arrCustomer))
            {
                $this->addError('email', $this->email . Yii::t('user', 'hiremechanic.form.exist'));
                return FALSE;
            } else 
            {
                return TRUE;
            }
        }
    }

    /**
     * @author Ctel
     * @param array $attribute
     * @param array $params
     * @return boolean It will return either TRUE or FALSE
     */
    public function isMobileExist($attribute, $params) {
        if (!empty($this->phone)) {
            $arrCustomer = Mechanic::model()->getMobileNo($this->phone);
            if (!empty($arrCustomer)) {
                $this->addError('phone', $this->phone . Yii::t('user', 'hiremechanic.form.exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    /**
     * @author Ctel
     * @return array It will array of attributes with substituions
     */
    public function attributeLabels() 
   {
        return array(
            'name' => Yii::t('user', 'hiremechanic.form.name'),
            'email' => Yii::t('user', 'hiremechanic.form.email'),
            'mobile' => Yii::t('user', 'hiremechanic.form.mobile'),
          
        );
    }

}
