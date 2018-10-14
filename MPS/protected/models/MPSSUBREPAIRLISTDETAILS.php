<?php

/**
 * This is the model class for table "MPS_SUB_REPAIRLIST_DETAILS".
 *
 * The followings are the available columns in table 'MPS_SUB_REPAIRLIST_DETAILS':
 * @property integer $id
 * @property string $sname
 * @property string $subvalue
 *
 * The followings are the available model relations:
 * @property MPSCARSERVICESLISTDETAILS $sname0
 */
class MPSSUBREPAIRLISTDETAILS extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MPSSUBREPAIRLISTDETAILS the static model class
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
		return 'MPS_SUB_REPAIRLIST_DETAILS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sname, subvalue', 'required'),
			array('sname, subvalue', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sname, subvalue', 'safe', 'on'=>'search'),
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
			'sname0' => array(self::BELONGS_TO, 'MPSCARSERVICESLISTDETAILS', 'sname'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sname' => 'Sname',
			'subvalue' => 'Subvalue',
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
		$criteria->compare('sname',$this->sname,true);
		$criteria->compare('subvalue',$this->subvalue,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}