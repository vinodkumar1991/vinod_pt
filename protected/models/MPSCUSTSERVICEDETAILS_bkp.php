<?php

/**
 * This is the model class for table "MPSCUSTSERVICE_DETAILS".
 *
 * The followings are the available columns in table 'MPSCUSTSERVICE_DETAILS':
 * @property integer $id
 * @property integer $custid
 * @property string $pickadrs
 * @property string $pickdate
 * @property integer $modelid
 * @property integer $makesid
 * @property string $addinfo
 * @property string $vediofile
 */
class MPSCUSTSERVICEDETAILS extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MPSCUSTSERVICEDETAILS the static model class
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
		return 'MPSCUSTSERVICE_DETAILS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('custid, modelid, makesid', 'numerical', 'integerOnly'=>true),
			array('pickadrs, addinfo', 'length', 'max'=>500),
			array('pickdate', 'length', 'max'=>10),
			array('vediofile', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, custid, pickadrs, pickdate, modelid, makesid, addinfo, vediofile', 'safe', 'on'=>'search'),
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
			'custid' => 'Custid',
			'pickadrs' => 'Pickadrs',
			'pickdate' => 'Pickdate',
			'modelid' => 'Modelid',
			'makesid' => 'Makesid',
			'addinfo' => 'Addinfo',
			'vediofile' => 'Vediofile',
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
		$criteria->compare('custid',$this->custid);
		$criteria->compare('pickadrs',$this->pickadrs,true);
		$criteria->compare('pickdate',$this->pickdate,true);
		$criteria->compare('modelid',$this->modelid);
		$criteria->compare('makesid',$this->makesid);
		$criteria->compare('addinfo',$this->addinfo,true);
		$criteria->compare('vediofile',$this->vediofile,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}