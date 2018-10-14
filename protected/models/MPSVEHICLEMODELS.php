<?php

/**
 * This is the model class for table "MPS_VEHICLE_MODELS".
 *
 * The followings are the available columns in table 'MPS_VEHICLE_MODELS':
 * @property integer $models_id
 * @property string $models_name
 * @property integer $makes_id
 */
class MPSVEHICLEMODELS extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'MPS_VEHICLE_MODELS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('makes_id', 'numerical', 'integerOnly'=>true),
			array('models_name', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('models_id, models_name, makes_id', 'safe', 'on'=>'search'),
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
			'models_id' => 'Models',
			'models_name' => 'Models Name',
			'makes_id' => 'Makes',
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

		$criteria->compare('models_id',$this->models_id);
		$criteria->compare('models_name',$this->models_name,true);
		$criteria->compare('makes_id',$this->makes_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MPSVEHICLEMODELS the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
