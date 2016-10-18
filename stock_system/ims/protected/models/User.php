<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $password
 * @property string $email
 * @property string $profile
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Brand[] $brands
 * @property Contract[] $contracts
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email', 'required'),
			array('profile,name, modified', 'safe'),
			array('email', 'email'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,name, username, email, profile, created, modified', 'safe', 'on'=>'search'),
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
// 			'brands' => array(self::HAS_MANY, 'Brand', 'created_by_user_id'),
// 			'contracts' => array(self::HAS_MANY, 'Contract', 'inactivated_by_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'password' => 'Password',
			'email' => 'Email',
			'profile' => 'Profile',
			'created' => 'Created',
			'modified' => 'Modified',
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
		$criteria->compare('name',$this->name,true);
		//$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}//end of search.
	
	public function validatePassword($password)	
    {
    	if (!empty($this->newPassword))
    	
                    $this->password = hash('sha256', $this->newPassword);
    }//end of validatePassword().
    
    protected function beforeSave()
    {
    	if(parent::beforeSave())
        {
        	$this->password = hash('sha256', $this->password);
        	
        	if($this->isNewRecord)  // Creating new record 
            {
        		$this->created=time();
    			return true;
            }
            else
            {
            	$this->modified=time();
                return true;
            }
        }//end of if(parent())
        else
        	return false;
    }//end of beforeSave()          
}//end of class.