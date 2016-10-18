<?php

/**
 * This is the model class for table "item_on_order".
 *
 * The followings are the available columns in table 'item_on_order':
 * @property integer $id
 * @property integer $purchase_order_id
 * @property integer $items_id
 * @property integer $suppliers_id
 * @property integer $item_status
 * @property string $out_of_stock_factory_date
 * @property string $factory_due_date
 * @property double $quantity_ordered
 * @property double $unit_price
 * @property double $total_price
 * @property string $created
 * @property string $modified
 * @property string $comments
 * @property integer $user_id
 * @property double $quantity_recieved
 * @property double $quantity_damaged
 * @property integer $servicecall_id
 * @property integer $reference_id
 * 
 *  The followings are the available model relations:
 * @property InboundItemsHistory[] $inboundItemsHistories
 * @property Suppliers $suppliers
 * @property PurchaseOrder $purchaseOrder
 * @property Items $items
 * @property Status $status
 */
class ItemOnOrder extends CActiveRecord
{
	public $item_name;
	public $part_number;
	public $order_number;
	public $supplier_name;
	public $ordered_recieved_difference;
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return ItemOnOrder the static model class
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
		return 'item_on_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('quantity_ordered, unit_price', 'required'),
			array('purchase_order_id, items_id, user_id suppliers_id, item_status', 'numerical', 'integerOnly'=>true),
			array('quantity_ordered, quantity_recieved, unit_price, total_price', 'numerical'),
			array('servicecall_id, reference_id, quantity_damaged ,ordered_recieved_difference, out_of_stock_factory_date, factory_due_date, created, modified,comments', 'safe'),
			//customised rules.
			//array('quantity_ordered', 'nonzero'),
						
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
//			array('id',  'modified', 'comments', 'safe', 'on'=>'search'),

			array('id, purchase_order_id, order_number, supplier_name, items_id, suppliers_id, item_name, part_number, item_status, out_of_stock_factory_date, factory_due_date, quantity_ordered, unit_price, total_price, created, modified, comments', 'safe', 'on'=>'search'),
		);
	}
	
	public function nonzero($attribute,$params)
    {    
        if($this->$attribute<=0)
        {
            $this->addError($attribute,$attribute.' can not be less than zero.');
           
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
			'inboundItemsHistories' => array(self::HAS_MANY, 'InboundItemsHistory', 'items_on_order_id'),
			'suppliers' => array(self::BELONGS_TO, 'Suppliers', 'suppliers_id'),
			'purchaseOrder' => array(self::BELONGS_TO, 'PurchaseOrder', 'purchase_order_id'),
			'items' => array(self::BELONGS_TO, 'Items', 'items_id'),
			'status' => array(self::BELONGS_TO, 'Status', 'item_status'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'purchase_order_id' => 'Purchase Order',
			'items_id' => 'Items',
			'suppliers_id' => 'Suppliers',
			'user_id' => 'User ',
			'item_status' => 'Item Status',
			'out_of_stock_factory_date' => 'Out Of Stock Factory Date',
			'factory_due_date' => 'Factory Due Date',
			'quantity_ordered' => 'Quantity Ordered',
			'quantity_recieved' => 'Quantity Recieved',
			'unit_price' => 'Unit Price',
			'total_price' => 'Total Price',
			'created' => 'Created',
			'modified' => 'Modified',
			'comments' => 'Comments',
			
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
		
		$criteria->with = array('items', 'purchaseOrder', 'suppliers');	
// 		$criteria->with = array();
// 		$criteria->with = array();
		
 		$criteria->order = 'purchase_order_id DESC';

		
// 		$criteria->compare('id',$this->id);
// 		$criteria->compare('purchase_order_id',$this->purchase_order_id);
// 		$criteria->compare('items_id',$this->items_id);
// 		$criteria->compare('suppliers_id',$this->suppliers_id);
		$criteria->compare('item_status',$this->item_status);
		$criteria->compare('out_of_stock_factory_date',$this->out_of_stock_factory_date,true);
		$criteria->compare('factory_due_date',$this->factory_due_date,true);
		$criteria->compare('quantity_ordered',$this->quantity_ordered);
// 		$criteria->compare('unit_price',$this->unit_price);
		$criteria->compare('total_price',$this->total_price);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('comments',$this->comments);
		
		$criteria->compare( 'items.name', $this->item_name, true );
		$criteria->compare( 'items.part_number', $this->part_number, true );
		$criteria->compare( 'purchaseOrder.order_number', $this->order_number, true );
		$criteria->compare( 'suppliers.name', $this->supplier_name, true );
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
// 			'sort'=>array(
// 		        'attributes'=>array(
// 		            'order_number'=>array(
// 		                'asc'=>'purchaseOrder.order_number',
// 		                'desc'=>'purchaseOrder.order_number DESC',
// 		            ),
// 				 ),
// 		    ),
		));
	}//END OF SEARCH.
	
	protected function beforeSave()
	{
		
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				
				$this->created=time();
				$this->total_price=$this->unit_price*$this->quantity_ordered;
				$x=$this->unit_price;
				$itemModel = Items::model()->updateByPk(
													$this->items_id,
													array
														(
														'sale_price'=>$x
														)														
														);		
			
			}
			else
			{

				$x=$this->unit_price;
				$itemModel = Items::model()->updateByPk(
													$this->items_id,
													array
														(
														'sale_price'=>$x
														)														
														);
				$this->modified=time();
			}
			return true;
		}
		else
			return false;
	}//end of beforeSave().
	
	protected function afterSave()
	{

	$vat_percentage=Yii::app()->params['vat_in_percentage'];


	$purchaseOrderQueryModel = PurchaseOrder::model()->findByPk(
													$this->purchase_order_id
														);	
	
	
	$total_cost=$purchaseOrderQueryModel->total_cost+$this->total_price;
	
	$vat_amount=($total_cost*$vat_percentage)/100;
	
	$net_cost=$total_cost+$vat_amount;
	
	//echo $total_cost;
	$purchaseOrderUpdateModel = PurchaseOrder::model()->updateByPk(
													$this->purchase_order_id,
													
													array
														(
															'total_cost'=>$total_cost,
															'vat'=>$vat_amount,
															'net_cost'=>$net_cost
																
														)														
														);		
	 
	}//end of afterSave().
	
	public function getItemStatus($item_status)
	{
		$str="<span style='color:red;'><b>Status Not Found :(</b></span>"; 
		//echo $staus_code;
		switch ($item_status)
		{
			case 1: $str="Draft"; break;
			case 2: $str="<span style='color:orange;'><b>On Order</b></span>"; break;
			case 3: $str="<span style='color:green;'><b>Recieved</b></span>"; break;
			case 4: $str="<span style='color:orange;'><b>Partially Recieved</b></span>"; break;
			case 5: $str="<span style='color:red;'><b>Missing</b></span>"; break;
			case 6: $str="<span style='color:red;'><b>Damaged</b></span>"; break;
			case 7: $str="<span style='color:red;'><b>Paritally Damaged</b></span>"; break;
			
			case 10: $str="<span style='color:red;'><b>Complete</b></span>"; break;
			case 11: $str="<span style='color:red;'><b>Cancelled</b></span>"; break;
			case 12: $str="<span style='color:red;'><b>Deleted</b></span>"; break;
			
			case 101: $str="<span style='color:orange;'><b>Pick Up</b></span>"; break;
									//default: break;
			//case 2: $str="<span style='color:green;'><b>Sent</b></span>"; break;
			
		}
		return $str;
	}//end of getItemStatus.
	
}