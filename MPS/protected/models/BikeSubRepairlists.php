<?php

/**
 * This is the model class for table "bike_sub_repairlists".
 *
 * The followings are the available columns in table 'bike_sub_repairlists':
 * @property integer $id
 * @property integer $repair_id
 * @property integer $sub_repair_id
 * @property string $sub_name
 * @property integer $check
 * @property integer $status
 */
class BikeSubRepairlists extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bike_sub_repairlists';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	/* public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('repair_id, sub_repair_id, sub_name, check, status', 'required'),
			array('repair_id, sub_repair_id, check, status', 'numerical', 'integerOnly'=>true),
			array('sub_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, repair_id, sub_repair_id, sub_name, check, status', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'repair_id' => 'Repair',
			'sub_repair_id' => 'Sub Repair',
			'sub_name' => 'Sub Name',
			'check' => 'Check',
			'status' => 'Status',
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
		$criteria->compare('repair_id',$this->repair_id);
		$criteria->compare('sub_repair_id',$this->sub_repair_id);
		$criteria->compare('sub_name',$this->sub_name,true);
		$criteria->compare('check',$this->check);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BikeSubRepairlists the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
