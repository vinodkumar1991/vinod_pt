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
 * @property integer $makes_id
 * @property integer $model_id
 * @property string $seating_capacity
 * @property integer $price_per_hour
 * @property integer $price
 * @property integer $security_deposit
 * @property integer $total_kms
 * @property integer $extra_rate_per_kms
 * @property string $vehicle_features
 * @property string $variant
 * @property string $created_date
 * @property string $vehicle_image
 * @property string $img_path
 * @property string $from_date
 * @property string $to_date
 * @property integer $status
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
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vehicle_id, username, vehicle_category, vehicle_type, makes_id, model_id, seating_capacity, price_per_hour, price, security_deposit, total_kms, extra_rate_per_kms, vehicle_features, variant, created_date, vehicle_image, img_path, from_date, to_date, status', 'required'),
			array('makes_id, model_id, price_per_hour, price, security_deposit, total_kms, extra_rate_per_kms, status', 'numerical', 'integerOnly'=>true),
			array('vehicle_id, from_date, to_date', 'length', 'max'=>45),
			array('username, vehicle_category', 'length', 'max'=>50),
			array('vehicle_type, img_path', 'length', 'max'=>100),
			array('seating_capacity, variant', 'length', 'max'=>140),
			array('vehicle_features', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, vehicle_id, username, vehicle_category, vehicle_type, makes_id, model_id, seating_capacity, price_per_hour, price, security_deposit, total_kms, extra_rate_per_kms, vehicle_features, variant, created_date, vehicle_image, img_path, from_date, to_date, status', 'safe', 'on'=>'search'),
		);
	}

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
			'makes_id' => 'Makes',
			'model_id' => 'Model',
			'seating_capacity' => 'Seating Capacity',
			'price_per_hour' => 'Price Per Hour',
			'price' => 'Price',
			'security_deposit' => 'Security Deposit',
			'total_kms' => 'Total Kms',
			'extra_rate_per_kms' => 'Extra Rate Per Kms',
			'vehicle_features' => 'Vehicle Features',
			'variant' => 'Variant',
			'created_date' => 'Created Date',
			'vehicle_image' => 'Vehicle Image',
			'img_path' => 'Img Path',
			'from_date' => 'From Date',
			'to_date' => 'To Date',
			'status' => 'Status',
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
		$criteria->compare('makes_id',$this->makes_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('seating_capacity',$this->seating_capacity,true);
		$criteria->compare('price_per_hour',$this->price_per_hour);
		$criteria->compare('price',$this->price);
		$criteria->compare('security_deposit',$this->security_deposit);
		$criteria->compare('total_kms',$this->total_kms);
		$criteria->compare('extra_rate_per_kms',$this->extra_rate_per_kms);
		$criteria->compare('vehicle_features',$this->vehicle_features,true);
		$criteria->compare('variant',$this->variant,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('vehicle_image',$this->vehicle_image,true);
		$criteria->compare('img_path',$this->img_path,true);
		$criteria->compare('from_date',$this->from_date,true);
		$criteria->compare('to_date',$this->to_date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}