<?php

/**
 * This is the model class for table "selfdrive_bookings".
 *
 * The followings are the available columns in table 'selfdrive_bookings':
 * @property integer $id
 * @property string $book_id
 * @property integer $make_id
 * @property integer $model_id
 * @property string $booking_date
 * @property integer $user_id
 * @property integer $amount
 * @property integer $status
 */
class SelfdriveBookings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'selfdrive_bookings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('id, make_id, model_id, user_id, amount, status', 'numerical', 'integerOnly'=>true),
			array('book_id', 'length', 'max'=>50),
			array('booking_date', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, book_id, make_id, model_id, booking_date, user_id, amount, status', 'safe', 'on'=>'search'),
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
			'book_id' => 'Book',
			'make_id' => 'Make',
			'model_id' => 'Model',
			'booking_date' => 'Booking Date',
			'user_id' => 'User',
			'amount' => 'Amount',
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
		$criteria->compare('make_id',$this->make_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('booking_date',$this->booking_date,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SelfdriveBookings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
