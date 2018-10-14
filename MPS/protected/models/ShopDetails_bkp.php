<?php

/**
 * This is the model class for table "shop_details".
 *
 * The followings are the available columns in table 'shop_details':
 * @property integer $id
 * @property string $shop_nm
 * @property integer $shop_id
 * @property string $shopowner_nm
 * @property integer $num_mechanic
 * @property integer $address
 * @property string $city
 * @property string $sector
 * @property integer $zipcode
 * @property string $owner_emailid
 * @property string $img_path
 * @property integer $count_service
 */
class ShopDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShopDetails the static model class
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
			//array('shop_nm, shop_id, shopowner_nm, num_mechanic, address, city, sector, zipcode, owner_emailid, img_path, count_service', 'required'),
			//array('shop_nm, city,shop_id,sector,shopowner_nm,num_mechanic', 'required'),
			array('shop_nm,city,shop_id', 'required'),
			array('num_mechanic,zipcode, count_service', 'numerical', 'integerOnly'=>true),
			array('shop_nm, shopowner_nm', 'length', 'max'=>255),
			array('city, sector', 'length', 'max'=>50),
			array('img_path', 'length', 'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, shop_nm, shop_id, shopowner_nm, num_mechanic, address, city, sector, zipcode,  img_path, count_service', 'safe', 'on'=>'search'),
			
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
			'shopowner_nm' => 'Shopowner Nm',
			'num_mechanic' => 'Num Mechanic',
			'address' => 'address',
			'city' => 'City',
			'sector' => 'Sector',
			'zipcode' => 'Zipcode',
			
			'img_path' => 'Img Path',
			'count_service' => 'Count Service',
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
		$criteria->compare('shop_nm',$this->shop_nm,true);
		$criteria->compare('shop_id',$this->shop_id);
		$criteria->compare('shopowner_nm',$this->shopowner_nm,true);
		$criteria->compare('num_mechanic',$this->num_mechanic);
		$criteria->compare('address',$this->address);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('sector',$this->sector,true);
		$criteria->compare('zipcode',$this->zipcode);
		
		$criteria->compare('img_path',$this->img_path,true);
		$criteria->compare('count_service',$this->count_service);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}