<?php

/**
 * This is the model class for table "MPS_CUSTOMER_INFO".
 *
 * The followings are the available columns in table 'MPS_CUSTOMER_INFO':
 * @property integer $id
 * @property string $username
 * @property string $surname
 * @property string $emailid
 * @property integer $mobile_no
 * @property string $location
 * @property string $longitude
 * @property string $latitude
 * @property integer $status
 */
class MPSCUSTOMERINFO extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MPSCUSTOMERINFO the static model class
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
		return 'MPS_CUSTOMER_INFO';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username', 'required'),
			array('mobile_no, status', 'numerical', 'integerOnly'=>true),
			array('username, surname, emailid', 'length', 'max'=>50),
			array('location, longitude, latitude', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, surname, emailid, mobile_no, location, longitude, latitude, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'surname' => 'Surname',
			'emailid' => 'Emailid',
			'mobile_no' => 'Mobile No',
			'location' => 'Location',
			'longitude' => 'Longitude',
			'latitude' => 'Latitude',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('emailid',$this->emailid,true);
		$criteria->compare('mobile_no',$this->mobile_no);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}