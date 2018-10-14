<?php

/**
 * This is the model class for table "hire_mechanic_trans".
 *
 * The followings are the available columns in table 'hire_mechanic_trans':
 * @property integer $id
 * @property string $book_id
 * @property integer $userid
 * @property integer $mechanic_id
 * @property integer $amount
 * @property string $billingaddrs
 * @property string $city
 * @property string $location
 * @property string $created_date
 * @property integer $status
 */
class HireMechanicTrans extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hire_mechanic_trans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	/* public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('book_id, userid, mechanic_id, amount, billingaddrs, city, location, created_date, status', 'required'),
			array('userid, mechanic_id, amount, status', 'numerical', 'integerOnly'=>true),
			array('book_id, billingaddrs, location', 'length', 'max'=>100),
			array('city', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, book_id, userid, mechanic_id, amount, billingaddrs, city, location, created_date, status', 'safe', 'on'=>'search'),
		);
	} */

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
			'book_id' => 'Book',
			'userid' => 'Userid',
			'mechanic_id' => 'Mechanic',
			'amount' => 'Amount',
			'billingaddrs' => 'Billingaddrs',
			'city' => 'City',
			'location' => 'Location',
			'created_date' => 'Created Date',
			'status' => 'Status',
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
		$criteria->compare('book_id',$this->book_id,true);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('mechanic_id',$this->mechanic_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('billingaddrs',$this->billingaddrs,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HireMechanicTrans the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
