<?php

/**
 * This is the model class for table "SLD_ADD_VEHICLE".
 *
 * The followings are the available columns in table 'SLD_ADD_VEHICLE':
 * @property integer $id
 * @property string $vehicle_id
 * @property string $username
 * @property string $vehicle_category
 * @property string $vehicle_type
 * @property string $brand_name
 * @property string $model_name
 * @property string $seating_capacity
 * @property integer $price_per_hour
 * @property integer $price
 * @property integer $security_deposit
 * @property integer $total_kms
 * @property integer $extra_rate_per_kms
 * @property string $vehicle_features
 * @property string $variant
 *
 * The followings are the available model relations:
 * @property MPSUSER $username0
 */
class SLDADDVEHICLE extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SLDADDVEHICLE the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'SLD_ADD_VEHICLE';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	/* public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vehicle_id, username, vehicle_category, vehicle_type, brand_name, model_name, seating_capacity, price_per_hour, price, security_deposit, total_kms, extra_rate_per_kms, vehicle_features, variant', 'required'),
			array('price_per_hour, price, security_deposit, total_kms, extra_rate_per_kms', 'numerical', 'integerOnly'=>true),
			array('vehicle_id, username, vehicle_category', 'length', 'max'=>50),
			array('vehicle_type, brand_name, model_name', 'length', 'max'=>100),
			array('seating_capacity, variant', 'length', 'max'=>140),
			array('vehicle_features', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, vehicle_id, username, vehicle_category, vehicle_type, brand_name, model_name, seating_capacity, price_per_hour, price, security_deposit, total_kms, extra_rate_per_kms, vehicle_features, variant', 'safe', 'on'=>'search'),
		);
	}
 */
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'username0' => array(self::BELONGS_TO, 'MPSUSER', 'username'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'vehicle_id' => 'Vehicle',
			'username' => 'Username',
			'vehicle_category' => 'Vehicle Category',
			'vehicle_type' => 'Vehicle Type',
			'makes_id' => 'Makes Id',
			'model_id' => 'Model Id',
			'seating_capacity' => 'Seating Capacity',
			'price_per_hour' => 'Price Per Hour',
			'price' => 'Price',
			'security_deposit' => 'Security Deposit',
			'total_kms' => 'Total Kms',
			'extra_rate_per_kms' => 'Extra Rate Per Kms',
			'vehicle_features' => 'Vehicle Features',
			'variant' => 'Variant',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('vehicle_id',$this->vehicle_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('vehicle_category',$this->vehicle_category,true);
		$criteria->compare('vehicle_type',$this->vehicle_type,true);
		$criteria->compare('brand_name',$this->brand_name,true);
		$criteria->compare('model_name',$this->model_name,true);
		$criteria->compare('seating_capacity',$this->seating_capacity,true);
		$criteria->compare('price_per_hour',$this->price_per_hour);
		$criteria->compare('price',$this->price);
		$criteria->compare('security_deposit',$this->security_deposit);
		$criteria->compare('total_kms',$this->total_kms);
		$criteria->compare('extra_rate_per_kms',$this->extra_rate_per_kms);
		$criteria->compare('vehicle_features',$this->vehicle_features,true);
		$criteria->compare('variant',$this->variant,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}