<?php

/**
 * This is the model class for table "MPS_PACKAGEWISE_AMT_DETAILS".
 *
 * The followings are the available columns in table 'MPS_PACKAGEWISE_AMT_DETAILS':
 * @property integer $id
 * @property string $sess_id
 * @property string $bookid
 * @property integer $userid
 * @property string $f_name
 * @property string $emailid
 * @property string $mobno
 * @property string $pickadrs
 * @property string $vehicle_type
 * @property string $billingadrs
 * @property string $pickhr
 * @property string $pickdate
 * @property integer $makes_id
 * @property integer $model_id
 * @property string $serviceid
 * @property string $planid
 * @property string $repairid
 * @property integer $categoryid
 * @property integer $amout
 * @property integer $status
 * @property integer $mech_status
 * @property string $mechp_id
 * @property integer $delv_status
 * @property integer $delv_id
 * @property string $total
 * @property string $timestamp
 */
class MPSPACKAGEWISEAMTDETAILS extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'MPS_PACKAGEWISE_AMT_DETAILS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
/* 	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sess_id, bookid, userid, f_name, emailid, mobno, pickadrs, vehicle_type, billingadrs, pickhr, pickdate, makes_id, model_id, serviceid, planid, repairid, categoryid, amout, status, mech_status, mechp_id, delv_status, delv_id, total, timestamp', 'required'),
			array('userid, makes_id, model_id, categoryid, amout, status, mech_status, delv_status, delv_id', 'numerical', 'integerOnly'=>true),
			array('sess_id, f_name, emailid, billingadrs, pickhr, pickdate, serviceid, planid, mechp_id', 'length', 'max'=>50),
			array('bookid, repairid', 'length', 'max'=>500),
			array('mobno', 'length', 'max'=>20),
			array('pickadrs', 'length', 'max'=>200),
			array('vehicle_type', 'length', 'max'=>4),
			array('total', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sess_id, bookid, userid, f_name, emailid, mobno, pickadrs, vehicle_type, billingadrs, pickhr, pickdate, makes_id, model_id, serviceid, planid, repairid, categoryid, amout, status, mech_status, mechp_id, delv_status, delv_id, total, timestamp', 'safe', 'on'=>'search'),
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
			'sess_id' => 'Sess',
			'bookid' => 'Bookid',
			'userid' => 'Userid',
			'f_name' => 'F Name',
			'emailid' => 'Emailid',
			'mobno' => 'Mobno',
			'pickadrs' => 'Pickadrs',
			'vehicle_type' => 'Vehicle Type',
			'billingadrs' => 'Billingadrs',
			'pickhr' => 'Pickhr',
			'pickdate' => 'Pickdate',
			'makes_id' => 'Makes',
			'model_id' => 'Model',
			'serviceid' => 'Serviceid',
			'planid' => 'Planid',
			'repairid' => 'Repairid',
			'categoryid' => 'Categoryid',
			'amout' => 'Amout',
			'status' => 'Status',
			'mech_status' => 'Mech Status',
			'mechp_id' => 'Mechp',
			'delv_status' => 'Delv Status',
			'delv_id' => 'Delv',
			'total' => 'Total',
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
		$criteria->compare('sess_id',$this->sess_id,true);
		$criteria->compare('bookid',$this->bookid,true);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('f_name',$this->f_name,true);
		$criteria->compare('emailid',$this->emailid,true);
		$criteria->compare('mobno',$this->mobno,true);
		$criteria->compare('pickadrs',$this->pickadrs,true);
		$criteria->compare('vehicle_type',$this->vehicle_type,true);
		$criteria->compare('billingadrs',$this->billingadrs,true);
		$criteria->compare('pickhr',$this->pickhr,true);
		$criteria->compare('pickdate',$this->pickdate,true);
		$criteria->compare('makes_id',$this->makes_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('serviceid',$this->serviceid,true);
		$criteria->compare('planid',$this->planid,true);
		$criteria->compare('repairid',$this->repairid,true);
		$criteria->compare('categoryid',$this->categoryid);
		$criteria->compare('amout',$this->amout);
		$criteria->compare('status',$this->status);
		$criteria->compare('mech_status',$this->mech_status);
		$criteria->compare('mechp_id',$this->mechp_id,true);
		$criteria->compare('delv_status',$this->delv_status);
		$criteria->compare('delv_id',$this->delv_id);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MPSPACKAGEWISEAMTDETAILS the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
