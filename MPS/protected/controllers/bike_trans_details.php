<?php

/**
 * This is the model class for table "bike_trans_details".
 *
 * The followings are the available columns in table 'bike_trans_details':
 * @property integer $id
 * @property integer $userid
 * @property integer $make_id
 * @property integer $model_id
 * @property integer $repairid
 * @property integer $subrepairid
 * @property integer $amount
 */
class bike_trans_details extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return bike_trans_details the static model class
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
		return 'bike_trans_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		
			array('userid, make_id, model_id, repairid, subrepairid, amount', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userid, make_id, model_id, repairid, subrepairid, amount', 'safe', 'on'=>'search'),
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
			'userid' => 'Userid',
			'make_id' => 'Make',
			'model_id' => 'Model',
			'repairid' => 'Repairid',
			'subrepairid' => 'Subrepairid',
			'amount' => 'Amount',
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
		$criteria->compare('userid',$this->userid);
		$criteria->compare('make_id',$this->make_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('repairid',$this->repairid);
		$criteria->compare('subrepairid',$this->subrepairid);
		$criteria->compare('amount',$this->amount);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}