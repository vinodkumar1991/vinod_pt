<?php

/**
 * This is the model class for table "MPS_VEHICLES".
 *
 * The followings are the available columns in table 'MPS_VEHICLES':
 * @property integer $id
 * @property integer $makes_id
 * @property integer $models_id
 * @property integer $year
 * @property string $logo_img
 * @property string $car_img
 * @property string $logo_data
 * @property string $car_data
 * @property string $maker_model_name
 */
class MPSVEHICLES extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MPSVEHICLES the static model class
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
		return 'MPS_VEHICLES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('makes_id', 'required'),
			array('makes_id, models_id, year', 'numerical', 'integerOnly'=>true),
			array('logo_img, car_img', 'length', 'max'=>50),
			array('maker_model_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, makes_id, models_id, year, logo_img, car_img, logo_data, car_data, maker_model_name', 'safe', 'on'=>'search'),
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
			'year' => 'Year',
			'logo_img' => 'Logo Img',
			'car_img' => 'Car Img',
			'logo_data' => 'Logo Data',
			'car_data' => 'Car Data',
			'maker_model_name' => 'Maker Model Name',
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
		$criteria->compare('year',$this->year);
		$criteria->compare('logo_img',$this->logo_img,true);
		$criteria->compare('car_img',$this->car_img,true);
		$criteria->compare('logo_data',$this->logo_data,true);
		$criteria->compare('car_data',$this->car_data,true);
		$criteria->compare('maker_model_name',$this->maker_model_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}