<?php

/**
 * This is the model class for table "MPS_MODIFICATION_DETAILS".
 *
 * The followings are the available columns in table 'MPS_MODIFICATION_DETAILS':
 * @property integer $id
 * @property integer $makes_id
 * @property integer $models_id
 * @property integer $use_id
 * @property string $comments
 * @property string $pickdate
 * @property string $pictime
 * @property integer $status
 */
class MPSMODIFICATIONDETAILS extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MPSMODIFICATIONDETAILS the static model class
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
		return 'MPS_MODIFICATION_DETAILS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('makes_id, models_id, use_id, comments, pickdate, pictime, status', 'required'),
			array('makes_id, models_id, use_id, status', 'numerical', 'integerOnly'=>true),
			array('comments', 'length', 'max'=>500),
			array('pickdate, pictime', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, makes_id, models_id, use_id, comments, pickdate, pictime, status', 'safe', 'on'=>'search'),
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
			'makes_id' => 'Makes',
			'models_id' => 'Models',
			'use_id' => 'Use',
			'comments' => 'Comments',
			'pickdate' => 'Pickdate',
			'pictime' => 'Pictime',
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
		$criteria->compare('makes_id',$this->makes_id);
		$criteria->compare('models_id',$this->models_id);
		$criteria->compare('use_id',$this->use_id);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('pickdate',$this->pickdate,true);
		$criteria->compare('pictime',$this->pictime,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}