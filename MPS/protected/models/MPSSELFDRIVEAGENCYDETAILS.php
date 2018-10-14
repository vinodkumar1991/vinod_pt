<?php

/**
 * This is the model class for table "MPS_SELFDRIVEAGENCY_DETAILS".
 *
 * The followings are the available columns in table 'MPS_SELFDRIVEAGENCY_DETAILS':
 * @property integer $id
 * @property integer $role_id
 * @property string $self_unique_id
 * @property string $agency_name
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $sector
 * @property integer $zipcode
 * @property string $contact_num
 * @property string $email
 * @property string $img_path
 * @property string $id_proof
 * @property integer $status
 * @property string $created_date
 * @property string $address
 *
 * The followings are the available model relations:
 * @property SELFDRIVEAGENCYUSERS $selfUnique
 */
class MPSSELFDRIVEAGENCYDETAILS extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MPSSELFDRIVEAGENCYDETAILS the static model class
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
		return 'MPS_SELFDRIVEAGENCY_DETAILS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	/* public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, self_unique_id, agency_name, country, state, city, sector, zipcode, contact_num, email, img_path, id_proof, status, created_date, address', 'required'),
			array('role_id, zipcode, status', 'numerical', 'integerOnly'=>true),
			array('self_unique_id, contact_num', 'length', 'max'=>12),
			array('agency_name', 'length', 'max'=>255),
			array('country, city, sector, email', 'length', 'max'=>50),
			array('state', 'length', 'max'=>11),
			array('img_path, address', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, role_id, self_unique_id, agency_name, country, state, city, sector, zipcode, contact_num, email, img_path, id_proof, status, created_date, address', 'safe', 'on'=>'search'),
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
			'selfUnique' => array(self::BELONGS_TO, 'SELFDRIVEAGENCYUSERS', 'self_unique_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role_id' => 'Role',
			'self_unique_id' => 'Self Unique',
			'agency_name' => 'Agency Name',
			'country' => 'Country',
			'state' => 'State',
			'city' => 'City',
			'sector' => 'Sector',
			'zipcode' => 'Zipcode',
			'contact_num' => 'Contact Num',
			'email' => 'Email',
			'img_path' => 'Img Path',
			'id_proof' => 'Id Proof',
			'status' => 'Status',
			'created_date' => 'Created Date',
			'address' => 'Address',
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
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('self_unique_id',$this->self_unique_id,true);
		$criteria->compare('agency_name',$this->agency_name,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('sector',$this->sector,true);
		$criteria->compare('zipcode',$this->zipcode);
		$criteria->compare('contact_num',$this->contact_num,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('img_path',$this->img_path,true);
		$criteria->compare('id_proof',$this->id_proof,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('address',$this->address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}