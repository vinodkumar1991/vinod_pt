<?php

/**
 * This is the model class for table "modification_shop".
 *
 * The followings are the available columns in table 'modification_shops':
 * @property integer $id
 * @property integer $role_id
 * @property string $shop_id
 * @property string $shop_name
 * @property string $retiler_name
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $sector
 * @property integer $zipcode
 * @property string $list_mofdifications
 * @property string $email
 * @property string $contact_no
 * @property string $id_proof_path
 * @property integer $lan
 * @property integer $lat
 * @property integer $status
 * @property string $created_date
 * @property string $location
 * @property string $adress
 */
class ModificationShop extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'modification_shop';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, shop_id, shop_name, retiler_name, country, state, city, sector, zipcode, list_mofdifications, email, contact_no, id_proof_path, lan, lat, status, location, adress', 'required'),
			array('role_id, zipcode, lan, lat, status', 'numerical', 'integerOnly'=>true),
			array('shop_id, shop_name, retiler_name, country, state, city, sector, email, contact_no', 'length', 'max'=>50),
			array('list_mofdifications, id_proof_path, adress', 'length', 'max'=>500),
			array('location', 'length', 'max'=>100),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, role_id, shop_id, shop_name, retiler_name, country, state, city, sector, zipcode, list_mofdifications, email, contact_no, id_proof_path, lan, lat, status, created_date, location, adress', 'safe', 'on'=>'search'),
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
			'role_id' => 'Role',
			'shop_id' => 'Shop',
			'shop_name' => 'Shop Name',
			'retiler_name' => 'Retiler Name',
			'country' => 'Country',
			'state' => 'State',
			'city' => 'City',
			'sector' => 'Sector',
			'zipcode' => 'Zipcode',
			'list_mofdifications' => 'List Mofdifications',
			'email' => 'Email',
			'contact_no' => 'Contact No',
			'id_proof_path' => 'Id Proof Path',
			'lan' => 'Lan',
			'lat' => 'Lat',
			'status' => 'Status',
			'created_date' => 'Created Date',
			'location' => 'Location',
			'adress' => 'Adress',
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
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('shop_id',$this->shop_id,true);
		$criteria->compare('shop_name',$this->shop_name,true);
		$criteria->compare('retiler_name',$this->retiler_name,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('sector',$this->sector,true);
		$criteria->compare('zipcode',$this->zipcode);
		$criteria->compare('list_mofdifications',$this->list_mofdifications,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('contact_no',$this->contact_no,true);
		$criteria->compare('id_proof_path',$this->id_proof_path,true);
		$criteria->compare('lan',$this->lan);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('adress',$this->adress,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ModificationShop the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getModificationServices(){
            $arrServices=array();
            $objectDB=Yii::app()->db->createCommand();
            $objectDB->select('ms.id, ms.name');
            $objectDB->from('modification_services as ms');            
            $arrServices = $objectDB->queryAll();
            return $arrServices;
    }
    
    public static function getModificationShops($intShopID=NULL,$vehicleType,$intServices,$intBrandID,$strLocation =NULL,$strLatitude = NULL,$strLongitude =NULL){
               $arrShops=array();               
               $Query='SELECT
                                DISTINCT ms.id,
                                ms.code, 
                                ms.name,
                                ms.description,
                                ms.email, 
                                ms.phone, 
                                ms.vehicle_types_id AS vehicle_type,
                                shop_image AS shop_image,
                                vb.name AS vehicle_brand,
                                m.name AS service_name,
                                msd.address AS shop_adress, 
                                msd.pincode AS shop_pincode,
                                msd.location AS shop_location
                        FROM modification_shops AS ms
                        INNER JOIN modification_shop_details AS msd ON msd.modification_shops_id=ms.id
                        INNER JOIN modification_shops_services AS mss ON mss.modification_shops_id=ms.id
                        INNER JOIN modification_shops_brands AS msb ON msb.modification_shops_id=ms.id
                        INNER JOIN vehicle_brands AS vb ON vb.id=msb.vehicle_brands_id
                        INNER JOIN modification_services AS m ON m.id=mss.modification_service_id
                        WHERE ms.vehicle_types_id='.$vehicleType.'';
                        if(!empty($intShopID)){
                            $Query.=' AND ms.id='.$intShopID.'';                            
                        }
                        if(isset($intServices) && !empty($intServices)){
                            $Query.=' AND mss.modification_service_id='.$intServices.'';
                        }
                        if(isset($intBrandID) && !empty($intBrandID)){
                            $Query.=' AND msb.vehicle_brands_id='.$intBrandID.'';
                        }
                        if(!empty($strLongitude) && !empty($strLatitude)){
                                $Query.=' AND latitude='.$strLatitude.' AND longitude='.$strLongitude.'';                            
                        }else{
                            if(!empty($strLocation)){
                                $Query.=' AND msd.location LIKE "%'.$strLocation.'%"';
                            }
                        }                 
                        //echo'<pre>';echo $Query;echo'</pre>';die();
                        
               $arrShops=$objectDB=Yii::app()->db->createCommand($Query)->queryAll();
               return $arrShops;
    }
    
    public static function getCustomerDetails($intCustomerID){
        $arrCustomer=array();
        $objectDB=Yii::app()->db->createCommand();
        $objectDB->select('c.id AS custid, 
                           CONCAT(IFNULL(c.first_name,"")," ",IFNULL(middle_name,"")," ",IFNULL(last_name,"")) AS custname,
                           ce.email AS custmail,
                           cp.phone AS custphone,
                           CONCAT(address," ,",pincode) AS custadrs,pincode AS pincode');
        $objectDB->from('customer AS c ');
        $objectDB->leftJoin('customer_email AS ce','ce.customer_id=c.id');
        $objectDB->leftJoin('customer_phone AS cp','cp.customer_id=c.id');
        $objectDB->leftJoin('customer_address AS ca','c.id=ca.customer_id');
        $objectDB->where('c.id=:id',array('id'=>$intCustomerID));
        $arrCustomer=$objectDB->queryAll();
        return $arrCustomer;
    }
        
}
