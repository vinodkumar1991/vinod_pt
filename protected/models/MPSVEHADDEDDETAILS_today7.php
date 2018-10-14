<?php

/**
 * This is the model class for table "MPSVEHADDED_DETAILS".
 *
 * The followings are the available columns in table 'MPSVEHADDED_DETAILS':
 * @property integer $id
 * @property integer $makes_id
 * @property integer $model_id
 * @property string $imgpath
 * @property string $makes_name
 * @property string $models_name
 */
class MPSVEHADDEDDETAILS extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MPSVEHADDEDDETAILS the static model class
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
		return 'MPSVEHADDED_DETAILS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('makes_id, model_id', 'numerical', 'integerOnly'=>true),
			array('imgpath', 'length', 'max'=>50),
			array('makes_name', 'length', 'max'=>30),
			array('models_name', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, makes_id, model_id, imgpath, makes_name, models_name', 'safe', 'on'=>'search'),
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
			'model_id' => 'Model',
			'imgpath' => 'Imgpath',
			'makes_name' => 'Makes Name',
			'models_name' => 'Models Name',
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
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('imgpath',$this->imgpath,true);
		$criteria->compare('makes_name',$this->makes_name,true);
		$criteria->compare('models_name',$this->models_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}