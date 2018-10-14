<?php

/**
 * This is the model class for table "MPS_VEHICLE_DETAILS".
 *
 * The followings are the available columns in table 'MPS_VEHICLE_DETAILS':
 * @property integer $id
 * @property integer $user_id
 * @property string $makes_id
 * @property string $model_id
 * @property integer $category_id
 * @property string $variant
 * @property string $vehicle_type
 * @property integer $year
 * @property string $lastserviceon
 * @property string $veh_distance
 * @property string $reg_no
 */
class MPSVEHICLEDETAILS extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'MPS_VEHICLE_DETAILS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('user_id, category_id, year', 'numerical', 'integerOnly'=>true),
			array('makes_id, model_id', 'length', 'max'=>11),
			array('variant, vehicle_type', 'length', 'max'=>20),
			array('lastserviceon', 'length', 'max'=>255),
			array('veh_distance, reg_no', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, makes_id, model_id, category_id, variant, vehicle_type, year, lastserviceon, veh_distance, reg_no', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'makes_id' => 'Makes',
			'model_id' => 'Model',
			'category_id' => 'Category',
			'variant' => 'Variant',
			'vehicle_type' => 'Vehicle Type',
			'year' => 'Year',
			'lastserviceon' => 'Lastserviceon',
			'veh_distance' => 'Veh Distance',
			'reg_no' => 'Reg No',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('makes_id',$this->makes_id,true);
		$criteria->compare('model_id',$this->model_id,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('variant',$this->variant,true);
		$criteria->compare('vehicle_type',$this->vehicle_type,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('lastserviceon',$this->lastserviceon,true);
		$criteria->compare('veh_distance',$this->veh_distance,true);
		$criteria->compare('reg_no',$this->reg_no,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MPSVEHICLEDETAILS the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
