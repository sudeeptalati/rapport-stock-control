<?php

/**
 * This is the model class for table "alternate_part_numbers".
 *
 * The followings are the available columns in table 'alternate_part_numbers':
 * @property integer $id
 * @property integer $main_item_id
 * @property integer $alternate_item_id
 *
 * The followings are the available model relations:
 * @property Items $alternateItem
 * @property Items $mainItem
 */
class AlternatePartNumbers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AlternatePartNumbers the static model class
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
		return 'alternate_part_numbers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('main_item_id, alternate_item_id', 'required'),
			array('main_item_id, alternate_item_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, main_item_id, alternate_item_id', 'safe', 'on'=>'search'),
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
			'alternateItem' => array(self::BELONGS_TO, 'Items', 'alternate_item_id'),
			'mainItem' => array(self::BELONGS_TO, 'Items', 'main_item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'main_item_id' => 'Main Item',
			'alternate_item_id' => 'Alternate Item',
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
		$criteria->compare('main_item_id',$this->main_item_id);
		$criteria->compare('alternate_item_id',$this->alternate_item_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}