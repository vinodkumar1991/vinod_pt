<?php

/**
 * This is the model class for table "MPSCUSTSERVICE_DETAILS".
 *
 * The followings are the available columns in table 'MPSCUSTSERVICE_DETAILS':
 * @property integer $id
 * @property integer $custid
 * @property string $variant
 * @property string $pickadrs
 * @property string $pickdate
 * @property string $pickhr
 * @property integer $modelid
 * @property integer $makesid
 * @property integer $packageid
 * @property integer $amount
 * @property string $addinfo
 * @property string $vediofile
 * @property string $seviceid
 * @property string $orderdate
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
			
			array('custid, modelid, makesid, packageid, amount', 'numerical', 'integerOnly'=>true),
			array('variant, pickdate, pickhr', 'length', 'max'=>10),
			array('pickadrs, addinfo', 'length', 'max'=>500),
			array('vediofile', 'length', 'max'=>30),
			array('seviceid', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, custid, variant, pickadrs, pickdate, pickhr, modelid, makesid, packageid, amount, addinfo, vediofile, seviceid, orderdate', 'safe', 'on'=>'search'),
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
			'variant' => 'Variant',
			'pickadrs' => 'Pickadrs',
			'pickdate' => 'Pickdate',
			'pickhr' => 'Pickhr',
			'modelid' => 'Modelid',
			'makesid' => 'Makesid',
			'packageid' => 'Packageid',
			'amount' => 'Amount',
			'addinfo' => 'Addinfo',
			'vediofile' => 'Vediofile',
			'seviceid' => 'Seviceid',
			'orderdate' => 'Orderdate',
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
		$criteria->compare('variant',$this->variant,true);
		$criteria->compare('pickadrs',$this->pickadrs,true);
		$criteria->compare('pickdate',$this->pickdate,true);
		$criteria->compare('pickhr',$this->pickhr,true);
		$criteria->compare('modelid',$this->modelid);
		$criteria->compare('makesid',$this->makesid);
		$criteria->compare('packageid',$this->packageid);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('addinfo',$this->addinfo,true);
		$criteria->compare('vediofile',$this->vediofile,true);
		$criteria->compare('seviceid',$this->seviceid,true);
		$criteria->compare('orderdate',$this->orderdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}