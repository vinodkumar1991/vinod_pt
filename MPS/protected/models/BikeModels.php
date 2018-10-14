<?php

/**
 * This is the model class for table "bike_models".
 *
 * The followings are the available columns in table 'bike_models':
 * @property integer $bike_model_id
 * @property string $bike_model_name
 * @property string $bike_model_img_path
 * @property string $bike_model_img
 */
class BikeModels extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bike_models';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
/* 	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bike_model_name, bike_model_img_path, bike_model_img', 'required'),
			array('bike_model_name', 'length', 'max'=>50),
			array('bike_model_img_path', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('bike_model_id, bike_model_name, bike_model_img_path, bike_model_img', 'safe', 'on'=>'search'),
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
			'bike_model_id' => 'Bike Model',
			'bike_model_name' => 'Bike Model Name',
			'bike_model_img_path' => 'Bike Model Img Path',
			'bike_model_img' => 'Bike Model Img',
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

		$criteria->compare('bike_model_id',$this->bike_model_id);
		$criteria->compare('bike_model_name',$this->bike_model_name,true);
		$criteria->compare('bike_model_img_path',$this->bike_model_img_path,true);
		$criteria->compare('bike_model_img',$this->bike_model_img,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BikeModels the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
