<?php

/**
 * This is the model class for table "shop_details".
 *
 * The followings are the available columns in table 'shop_details':
 * @property integer $id
 * @property string $shop_nm
 * @property string $shop_id
 * @property integer $role_id
 * @property string $shopowner_nm
 * @property integer $num_mechanic
 * @property string $address
 * @property integer $country
 * @property integer $state
 * @property string $city
 * @property string $sector
 * @property string $contact_num
 * @property string $zipcode
 * @property string $img_path
 * @property string $data
 * @property string $shop_img
 * @property integer $count_service
 * @property integer $status
 * @property string $created_date
 */
class ShopDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shop_nm, shop_id, role_id, shopowner_nm, num_mechanic, address, country, state, city, sector, contact_num, zipcode, img_path, data, shop_img, count_service, status, created_date', 'required'),
			array('role_id, num_mechanic, country, state, count_service, status', 'numerical', 'integerOnly'=>true),
			array('shop_nm, shopowner_nm', 'length', 'max'=>255),
			array('shop_id', 'length', 'max'=>250),
			array('address, shop_img', 'length', 'max'=>500),
			array('city, sector, img_path', 'length', 'max'=>50),
			array('contact_num', 'length', 'max'=>12),
			array('zipcode', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, shop_nm, shop_id, role_id, shopowner_nm, num_mechanic, address, country, state, city, sector, contact_num, zipcode, img_path, data, shop_img, count_service, status, created_date', 'safe', 'on'=>'search'),
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
			'shop_nm' => 'Shop Nm',
			'shop_id' => 'Shop',
			'role_id' => 'Role',
			'shopowner_nm' => 'Shopowner Nm',
			'num_mechanic' => 'Num Mechanic',
			'address' => 'Address',
			'country' => 'Country',
			'state' => 'State',
			'city' => 'City',
			'sector' => 'Sector',
			'contact_num' => 'Contact Num',
			'zipcode' => 'Zipcode',
			'img_path' => 'Img Path',
			'data' => 'Data',
			'shop_img' => 'Shop Img',
			'count_service' => 'Count Service',
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
		$criteria->compare('shop_nm',$this->shop_nm,true);
		$criteria->compare('shop_id',$this->shop_id,true);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('shopowner_nm',$this->shopowner_nm,true);
		$criteria->compare('num_mechanic',$this->num_mechanic);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('country',$this->country);
		$criteria->compare('state',$this->state);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('sector',$this->sector,true);
		$criteria->compare('contact_num',$this->contact_num,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('img_path',$this->img_path,true);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('shop_img',$this->shop_img,true);
		$criteria->compare('count_service',$this->count_service);
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
	 * @return ShopDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
