<?php

/**
 * This is the model class for table "SELF_DRIVE_AGENCY_USERS".
 *
 * The followings are the available columns in table 'SELF_DRIVE_AGENCY_USERS':
 * @property integer $id
 * @property string $self_unique_id
 * @property string $username
 * @property string $password
 * @property string $owner_emailid
 * @property integer $email_status
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property MPSSELFDRIVEAGENCYDETAILS[] $mPSSELFDRIVEAGENCYDETAILSs
 */
class SELFDRIVEAGENCYUSERS extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SELFDRIVEAGENCYUSERS the static model class
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
		return 'SELF_DRIVE_AGENCY_USERS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
/* 	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('self_unique_id, username, password, owner_emailid, email_status, status', 'required'),
			array('email_status, status', 'numerical', 'integerOnly'=>true),
			array('self_unique_id, username, password, owner_emailid', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, self_unique_id, username, password, owner_emailid, email_status, status', 'safe', 'on'=>'search'),
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
			'mPSSELFDRIVEAGENCYDETAILSs' => array(self::HAS_MANY, 'MPSSELFDRIVEAGENCYDETAILS', 'self_unique_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'self_unique_id' => 'Self Unique',
			'username' => 'Username',
			'password' => 'Password',
			'owner_emailid' => 'Owner Emailid',
			'email_status' => 'Email Status',
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
		$criteria->compare('self_unique_id',$this->self_unique_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('owner_emailid',$this->owner_emailid,true);
		$criteria->compare('email_status',$this->email_status);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}