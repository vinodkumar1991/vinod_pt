<?php

/**
 * This is the model class for table "delv_details".
 *
 * The followings are the available columns in table 'delv_details':
 * @property integer $id
 * @property string $shop_id
 * @property string $delv_id
 * @property integer $roleid
 * @property string $del_nm
 * @property integer $age
 * @property string $adrs
 * @property string $adrs2
 * @property string $contact
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $area
 * @property string $reg_cert
 * @property string $img_path
 * @property string $adrs_proof
 * @property string $data
 * @property string $latitude
 * @property string $longitude
 * @property integer $status
 * @property string $created_date
 */
class DelvDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'delv_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('roleid, age, status', 'numerical', 'integerOnly'=>true),
			array('shop_id, delv_id, del_nm, country, state, city, area, reg_cert, img_path, adrs_proof, latitude, longitude', 'length', 'max'=>50),
			array('adrs', 'length', 'max'=>500),
			array('adrs2', 'length', 'max'=>250),
			array('contact', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, shop_id, delv_id, roleid, del_nm, age, adrs, adrs2, contact, country, state, city, area, reg_cert, img_path, adrs_proof, data, latitude, longitude, status, created_date', 'safe', 'on'=>'search'),
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
			'shop_id' => 'Shop',
			'delv_id' => 'Delv',
			'roleid' => 'Roleid',
			'del_nm' => 'Del Nm',
			'age' => 'Age',
			'adrs' => 'Adrs',
			'adrs2' => 'Adrs2',
			'contact' => 'Contact',
			'country' => 'Country',
			'state' => 'State',
			'city' => 'City',
			'area' => 'Area',
			'reg_cert' => 'Reg Cert',
			'img_path' => 'Img Path',
			'adrs_proof' => 'Adrs Proof',
			'data' => 'Data',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'status' => 'Status',
			'created_date' => 'Created Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('shop_id',$this->shop_id,true);
		$criteria->compare('delv_id',$this->delv_id,true);
		$criteria->compare('roleid',$this->roleid);
		$criteria->compare('del_nm',$this->del_nm,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('adrs',$this->adrs,true);
		$criteria->compare('adrs2',$this->adrs2,true);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('reg_cert',$this->reg_cert,true);
		$criteria->compare('img_path',$this->img_path,true);
		$criteria->compare('adrs_proof',$this->adrs_proof,true);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DelvDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
