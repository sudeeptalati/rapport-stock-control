<?php

/**
 * This is the model class for table "status".
 *
 * The followings are the available columns in table 'status':
 * @property integer $id
 * @property string $name
 * @property string $information
 * @property integer $published
 * @property string $htmlname
 * @property integer $view_order
 * @property integer $updated_by_user
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property User $updatedByUser
 */
class Status extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Status the static model class
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
		return 'status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('published, view_order, updated_by_user', 'numerical', 'integerOnly'=>true),
			array('name, information, htmlname, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, information, published, htmlname, view_order, updated_by_user, updated', 'safe', 'on'=>'search'),
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
			'updatedByUser' => array(self::BELONGS_TO, 'User', 'updated_by_user'),
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
			'information' => 'Information',
			'published' => 'Published',
			'htmlname' => 'Htmlname',
			'view_order' => 'View Order',
			'updated_by_user' => 'Updated By User',
			'updated' => 'Updated',
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
		$criteria->compare('information',$this->information,true);
		$criteria->compare('published',$this->published);
		$criteria->compare('htmlname',$this->htmlname,true);
		$criteria->compare('view_order',$this->view_order);
		$criteria->compare('updated_by_user',$this->updated_by_user);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
	//////////////////////////
	
	private static $_items=array();
	
	/**
	 * Returns the items for the specified type.
	 * @param string item type (e.g. 'PostStatus').
	 * @return array item names indexed by item code. The items are order by their position values.
	 * An empty array is returned if the item type does not exist.
	 */
	public static function items($type)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return self::$_items[$type];
	}//end of items.
	
	/**
	 * Returns the item name for the specified type and code.
	 * @param string the item type (e.g. 'PostStatus').
	 * @param integer the item code (corresponding to the 'code' column value)
	 * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
	 */
	public static function item($type,$code)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
	}//end of item.
	
	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	private static function loadItems($type)
	{
		self::$_items[$type]=array();
		$models=self::model()->findAll(array('order'=>"`name` ASC"));
		//$models=self::model()->findAll(array('order'=>'company ASC'));
		foreach($models as $model)
			self::$_items[$type][$model->id]=$model->name;
	}//end of loaditems.

	
	
	
	///////////////////
}