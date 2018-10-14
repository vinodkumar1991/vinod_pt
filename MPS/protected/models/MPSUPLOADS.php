<?php

class MPSUPLOADS extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'MPS_UPLOADS';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('description, image_name, imagepath, data', 'required'),
            array('description, image_name, imagepath', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Id, description, image_name, imagepath, data', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'Id' => 'ID',
            'description' => 'Description',
            'image_name' => 'Image Name',
            'imagepath' => 'Imagepath',
            'data' => 'Data',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('Id', $this->Id);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('image_name', $this->image_name, true);
        $criteria->compare('imagepath', $this->imagepath, true);
        $criteria->compare('data', $this->data, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @author Digital Today
     * @param integer $intScreenType
     * @return array It will return an array of screens
     */
    public static function getScreens($intScreenType = 2) {
        $arrScreens = array();
        $objectDB = Yii::app()->db->createCommand();
        $objectDB->select('mu.imagepath');
        $objectDB->from('MPS_UPLOADS as mu');
        $objectDB->where('mu.description=:screenType', array(':screenType' => $intScreenType));
        $arrScreens = $objectDB->queryAll();
        return $arrScreens;
    }

}
