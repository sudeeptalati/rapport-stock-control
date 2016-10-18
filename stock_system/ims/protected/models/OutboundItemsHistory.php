<?php

/**
 * This is the model class for table "outbound_items_history".
 *
 * The followings are the available columns in table 'outbound_items_history':
 * @property integer $history_id_item
 * @property integer $main_item_id
 * @property double $quantity_moved
 * @property double $current_quantity_in_stock
 * @property double $available_quantity_in_stock
 * @property string $comments
 * @property integer $user_id
 * @property string $created
 *
 * The followings are the available model relations:
 * @property UsergroupsUser $user
 * @property Items $mainItem
 * @property Items $user
 */
class OutboundItemsHistory extends CActiveRecord
{
	public $item_search;
	public $part_number;
	public $username;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return OutboundItemsHistory the static model class
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
		return 'outbound_items_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('main_item_id, quantity_moved, current_quantity_in_stock, available_quantity_in_stock', 'required'),
			array('main_item_id, user_id', 'numerical', 'integerOnly'=>true),
			array('quantity_moved, current_quantity_in_stock, available_quantity_in_stock', 'numerical'),
			array('comments, created', 'safe'),
			//customised rules.
			array('quantity_moved, available_quantity_in_stock', 'compare'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('history_id_item, main_item_id, quantity_moved, current_quantity_in_stock, available_quantity_in_stock, comments, user_id, created', 'safe', 'on'=>'search'),
			array( 'item_search', 'safe', 'on'=>'search' ),
		);
	}
	
	public function compare($attribute,$params)
	{
		if($this->quantity_moved>$this->available_quantity_in_stock)
		{
			$this->addError('quantity_moved','Quantity moved can not be more than quantity available in stock');
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'user' => array(self::BELONGS_TO, 'UsergroupsUser', 'user_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'mainItem' => array(self::BELONGS_TO, 'Items', 'main_item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'history_id_item' => 'History Id Item',
			'main_item_id' => 'Main Item',
			'quantity_moved' => 'Quantity Removed',
			'current_quantity_in_stock' => 'Current Quantity In Stock When Item Removed',
			'available_quantity_in_stock' => 'Available Quantity In Stock When Item Removed',
			'comments' => 'Comments',
			'user_id' => 'Processed By User',
			'created' => 'Processed On',
		);
	}
	
	public function getUserName()
    {
        //return array(
          //return CHtml::listData(User::model()->findAll(), 'id', 'username');
          //return Yii::app()->user->name;
        
    }
	
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				
				$this->created=time();
				$this->current_quantity_in_stock=$this->current_quantity_in_stock-$this->quantity_moved;
				$this->available_quantity_in_stock=$this->available_quantity_in_stock-$this->quantity_moved;
				$this->user_id=Yii::app()->user->id;
				
			}
			else
			{
				$this->created=time();
				//$this->update_time=time();
			}
				
			return true;
		}
		else
			return false;
	}//end of beforeSave()
	

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->with = array('mainItem');
		$criteria->order = 'history_id_item DESC';
		$criteria->compare('history_id_item',$this->history_id_item);
		$criteria->compare('main_item_id',$this->main_item_id);
		$criteria->compare('quantity_moved',$this->quantity_moved);
		$criteria->compare('current_quantity_in_stock',$this->current_quantity_in_stock);
		$criteria->compare('available_quantity_in_stock',$this->available_quantity_in_stock);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('created',$this->created,true);
		
		$criteria->compare( 'mainItem.name', $this->item_search, true );

//		return new CActiveDataProvider($this, array(
//			'criteria'=>$criteria,
//		));

		return new CActiveDataProvider( 'OutboundItemsHistory', array(
				'criteria'=>$criteria,
				'sort'=>array(
						'attributes'=>array(
								'item_search'=>array(
										'asc'=>'mainItem.name',
										'desc'=>'mainItem.name DESC',
								),
								'*',
						),
				),
		));
	}
	
	}