<?php

/**
 * This is the model class for table "MPSVEHADDED_DETAILS".
 *
 * The followings are the available columns in table 'MPSVEHADDED_DETAILS':
 * @property integer $id
 * @property integer $makes_id
 * @property integer $model_id
 * @property string $variant
 * @property integer $user_id
 * @property string $imgpath
 * @property string $makes_name
 * @property string $models_name
 * @property integer $status
 * @property string $timestamp
 */
class MPSVEHADDEDDETAILS extends CActiveRecord
{
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
			
			array('makes_id, model_id, user_id, status', 'numerical', 'integerOnly'=>true),
			array('variant', 'length', 'max'=>10),
			array('imgpath', 'length', 'max'=>100),
			array('makes_name', 'length', 'max'=>30),
			array('models_name', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, makes_id, model_id, variant, user_id, imgpath, makes_name, models_name, status, timestamp', 'safe', 'on'=>'search'),
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
			'variant' => 'Variant',
			'user_id' => 'User',
			'imgpath' => 'Imgpath',
			'makes_name' => 'Makes Name',
			'models_name' => 'Models Name',
			'status' => 'Status',
			'timestamp' => 'Timestamp',
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
		$criteria->compare('makes_id',$this->makes_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('variant',$this->variant,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('imgpath',$this->imgpath,true);
		$criteria->compare('makes_name',$this->makes_name,true);
		$criteria->compare('models_name',$this->models_name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MPSVEHADDEDDETAILS the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
