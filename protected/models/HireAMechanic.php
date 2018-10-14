<?php

/**
 * This is the model class for table "HIRE_A_MECHANIC".
 *
 * The followings are the available columns in table 'HIRE_A_MECHANIC':
 * @property integer $id
 * @property string $hire_mechanic_id
 * @property integer $role_id
 * @property string $vehicle_type
 * @property string $profesional
 * @property integer $booking_charge
 * @property string $name
 * @property string $mobileno
 * @property string $email
 * @property string $upload_pic_path
 * @property string $upload_pic
 * @property string $company_name
 * @property integer $Year_of_exp
 * @property string $work_certificate_path
 * @property string $work_certificate_pic
 * @property string $id_proof_path
 * @property string $id_proof
 * @property string $address
 * @property string $created_date
 * @property string $description
 * @property string $location
 * @property string $lag
 * @property string $lat
 */
class HIREAMECHANIC extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HIREAMECHANIC the static model class
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
		return 'HIRE_A_MECHANIC';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hire_mechanic_id, role_id, vehicle_type, profesional, booking_charge, name, mobileno, email, upload_pic_path, upload_pic, company_name, Year_of_exp, work_certificate_path, work_certificate_pic, id_proof_path, id_proof, address, created_date, description, location, lag, lat', 'required'),
			array('role_id, booking_charge, Year_of_exp', 'numerical', 'integerOnly'=>true),
			array('hire_mechanic_id, vehicle_type', 'length', 'max'=>45),
			array('profesional, name, email', 'length', 'max'=>50),
			array('mobileno', 'length', 'max'=>11),
			array('upload_pic_path, work_certificate_path', 'length', 'max'=>400),
			array('company_name, location, lag, lat', 'length', 'max'=>100),
			array('id_proof_path', 'length', 'max'=>300),
			array('address, description', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, hire_mechanic_id, role_id, vehicle_type, profesional, booking_charge, name, mobileno, email, upload_pic_path, upload_pic, company_name, Year_of_exp, work_certificate_path, work_certificate_pic, id_proof_path, id_proof, address, created_date, description, location, lag, lat', 'safe', 'on'=>'search'),
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
			'hire_mechanic_id' => 'Hire Mechanic',
			'role_id' => 'Role',
			'vehicle_type' => 'Vehicle Type',
			'profesional' => 'Profesional',
			'booking_charge' => 'Booking Charge',
			'name' => 'Name',
			'mobileno' => 'Mobileno',
			'email' => 'Email',
			'upload_pic_path' => 'Upload Pic Path',
			'upload_pic' => 'Upload Pic',
			'company_name' => 'Company Name',
			'Year_of_exp' => 'Year Of Exp',
			'work_certificate_path' => 'Work Certificate Path',
			'work_certificate_pic' => 'Work Certificate Pic',
			'id_proof_path' => 'Id Proof Path',
			'id_proof' => 'Id Proof',
			'address' => 'Address',
			'created_date' => 'Created Date',
			'description' => 'Description',
			'location' => 'Location',
			'lag' => 'Lag',
			'lat' => 'Lat',
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
		$criteria->compare('hire_mechanic_id',$this->hire_mechanic_id,true);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('vehicle_type',$this->vehicle_type,true);
		$criteria->compare('profesional',$this->profesional,true);
		$criteria->compare('booking_charge',$this->booking_charge);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('mobileno',$this->mobileno,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('upload_pic_path',$this->upload_pic_path,true);
		$criteria->compare('upload_pic',$this->upload_pic,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('Year_of_exp',$this->Year_of_exp);
		$criteria->compare('work_certificate_path',$this->work_certificate_path,true);
		$criteria->compare('work_certificate_pic',$this->work_certificate_pic,true);
		$criteria->compare('id_proof_path',$this->id_proof_path,true);
		$criteria->compare('id_proof',$this->id_proof,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('lag',$this->lag,true);
		$criteria->compare('lat',$this->lat,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}