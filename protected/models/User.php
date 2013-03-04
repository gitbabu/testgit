<?php

/**
 * This is the model class for table "tbl_users".
 *
 * The followings are the available columns in table 'tbl_users':
 * @property integer $userid
 * @property string $password
 * @property string $email
 * @property string $secondary_email
 * @property string $profile_image
 * @property string $fname
 * @property string $lname
 * @property integer $gender
 * @property string $location
 * @property string $description
 * @property string $age
 * @property string $socialnetwork
 * @property string $socialnetworkid
 * @property integer $usertypeid
 * @property integer $zipcode
 * @property string $createtime
 * @property integer $createdby
 * @property integer $updatedby
 * @property string $updatedate
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'tbl_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password, email, zipcode, createtime, createdby', 'required'),
			array('gender, usertypeid, zipcode, createdby, updatedby', 'numerical', 'integerOnly'=>true),
			array('password, email, secondary_email', 'length', 'max'=>128),
			array('profile_image', 'length', 'max'=>750),
			array('fname, lname, location', 'length', 'max'=>100),
			array('description', 'length', 'max'=>500),
			array('age', 'length', 'max'=>20),
			array('socialnetwork, socialnetworkid', 'length', 'max'=>45),
			array('updatedate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, password, email, secondary_email, profile_image, fname, lname, gender, location, description, age, socialnetwork, socialnetworkid, usertypeid, zipcode, createtime, createdby, updatedby, updatedate', 'safe', 'on'=>'search'),
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
			'userid' => 'Userid',
			'password' => 'Password',
			'email' => 'Email',
			'secondary_email' => 'Secondary Email',
			'profile_image' => 'Profile Image',
			'fname' => 'Fname',
			'lname' => 'Lname',
			'gender' => 'Gender',
			'location' => 'Location',
			'description' => 'Description',
			'age' => 'Age',
			'socialnetwork' => 'Socialnetwork',
			'socialnetworkid' => 'Socialnetworkid',
			'usertypeid' => 'Usertypeid',
			'zipcode' => 'Zipcode',
			'createtime' => 'Createtime',
			'createdby' => 'Createdby',
			'updatedby' => 'Updatedby',
			'updatedate' => 'Updatedate',
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

		$criteria->compare('userid',$this->userid);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('secondary_email',$this->secondary_email,true);
		$criteria->compare('profile_image',$this->profile_image,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('socialnetwork',$this->socialnetwork,true);
		$criteria->compare('socialnetworkid',$this->socialnetworkid,true);
		$criteria->compare('usertypeid',$this->usertypeid);
		$criteria->compare('zipcode',$this->zipcode);
		$criteria->compare('createtime',$this->createtime,true);
		$criteria->compare('createdby',$this->createdby);
		$criteria->compare('updatedby',$this->updatedby);
		$criteria->compare('updatedate',$this->updatedate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}