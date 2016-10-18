<?php

/**
 * This is the model class for table "inbound_items_history".
 *
 * The followings are the available columns in table 'inbound_items_history':
 * @property integer $history_id_item
 * @property integer $main_item_id
 * @property double $quantity_moved
 * @property double $current_quantity_in_stock
 * @property double $available_quantity_in_stock
 * @property string $comments
 * @property integer $user_id
 * @property integer $items_on_order_id
 * @property string $created
 * @property integer $supplier_id
 * @property integer $item_purchase_date

 * @property integer $unit_price_exc_vat
 * @property integer $unit_price_inc_vat
 * @property integer $vat_amount
 * @property integer $vat_percentage
 * @property integer $total_amount_exc_vat
 * @property integer $total_amount_inc_vat
 *
 * The followings are the available model relations:
 * @property UsergroupsUser $user
 * @property ItemOnOrder $itemsOnOrder
 * @property Items $mainItem
 */
class InboundItemsHistory extends CActiveRecord
{
	public $item_search;
	public $part_number;
	public $barcode;

	public $username;
	/**
	 * Returns the static model of the specified AR class.
	 * @return InboundItemsHistory the static model class
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
		return 'inbound_items_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('supplier_id, main_item_id, quantity_moved, current_quantity_in_stock, available_quantity_in_stock', 'required'),
			array('main_item_id, user_id, items_on_order_id', 'numerical', 'integerOnly'=>true),
			array('unit_price_exc_vat, unit_price_inc_vat, vat_amount, vat_percentage, total_amount_exc_vat, total_amount_inc_vat,  supplier_id, quantity_moved, current_quantity_in_stock, available_quantity_in_stock', 'numerical'),
			array('item_purchase_date, supplier_id, comments, created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('supplier_id, history_id_item, main_item_id, quantity_moved, current_quantity_in_stock, available_quantity_in_stock, comments, user_id, items_on_order_id, created', 'safe', 'on'=>'search'),
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
			//'user' => array(self::BELONGS_TO, 'UsergroupsUser', 'user_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'itemsOnOrder' => array(self::BELONGS_TO, 'ItemOnOrder', 'items_on_order_id'),
			'mainItem' => array(self::BELONGS_TO, 'Items', 'main_item_id'),
			'supplier' => array(self::BELONGS_TO, 'Suppliers', 'supplier_id'),


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
			'quantity_moved' => 'Quantity Added',
			'current_quantity_in_stock' => 'Current Quantity In Stock When Item Added',
			'available_quantity_in_stock' => 'Available Quantity In Stock When Item Added',
			'comments' => 'Comments',
			'user_id' => 'Processed By User',
			'items_on_order_id' => 'Purchase Order No.',
			'created' => 'Processed On',
			'supplier_id' => 'Supplier',
			'item_purchase_date'=> 'Item Purchase Date',

			'unit_price_exc_vat' => 'Unit Price (Exc VAT)',
			'unit_price_inc_vat' => 'Unit Price (Inc VAT) ',
			'vat_amount' => 'VAT Amount',
			'vat_percentage' => 'VAT Percentage',
			'total_amount_exc_vat' => 'Total Amount (Exc VAT)',
			'total_amount_inc_vat' => 'Total Amount (Inc VAT)',

			);
	}
	
protected function beforeSave()
	{
		if(parent::beforeSave())
		{

			if (!empty($this->item_purchase_date))
				$this->item_purchase_date=strtotime($this->item_purchase_date);


			if($this->isNewRecord)
			{
				$this->created=time();
				//$this->created=time();
				$this->current_quantity_in_stock=$this->current_quantity_in_stock+$this->quantity_moved;
				$this->available_quantity_in_stock=$this->available_quantity_in_stock+$this->quantity_moved;
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
		
		$criteria->order = 'history_id_item DESC';
		$criteria->compare('history_id_item',$this->history_id_item);
		$criteria->compare('main_item_id',$this->main_item_id);
		$criteria->compare('quantity_moved',$this->quantity_moved);
		$criteria->compare('current_quantity_in_stock',$this->current_quantity_in_stock);
		$criteria->compare('available_quantity_in_stock',$this->available_quantity_in_stock);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('items_on_order_id',$this->items_on_order_id);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}