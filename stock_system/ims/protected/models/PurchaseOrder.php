
<?php

/**
 * This is the model class for table "purchase_order".
 *
 * The followings are the available columns in table 'purchase_order':
 * @property integer $id
 * @property integer $suppliers_id
 * @property integer $user_id
 * @property integer $order_number
 * @property integer $order_status
 * @property string $date_of_order
 * @property double $total_cost
 * @property double $vat
 * @property double $net_cost
 * @property string $created
 * @property string $modified
 * @property string $cancelled
 * @property string $comments
 * @property double $shipping_cost
 * @property string $delivery_address_id
 * @property string $date_of_order_recieved
 * 
 *  
 * The followings are the available model relations:
 * @property ItemOnOrder[] $itemOnOrders
 * @property ItemOnOrderBack[] $itemOnOrderBacks
 * @property User $user
 * @property Suppliers $suppliers
 * @property Status $status
 */
class PurchaseOrder extends CActiveRecord
{
	public $orderNum;
	public $str;
	public $supplier_name;
	public $user_name;
	public $status_of_order;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return PurchaseOrder the static model class
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
		return 'purchase_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				
			array('suppliers_id, user_id, order_number, order_status', 'numerical', 'integerOnly'=>true),
			array('total_cost, shipping_cost, vat, net_cost', 'numerical'),
			array('date_of_order, date_of_order_recieved, created, modified, cancelled', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, suppliers_id, user_id, order_number, user_name, status_of_order, order_status, date_of_order, total_cost, vat, net_cost, created, modified, cancelled', 'safe', 'on'=>'search'),
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
			'itemOnOrders' => array(self::HAS_MANY, 'ItemOnOrder', 'purchase_order_id'),
			//'itemOnOrderBacks' => array(self::HAS_MANY, 'ItemOnOrderBack', 'purchase_order_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'suppliers' => array(self::BELONGS_TO, 'Suppliers', 'suppliers_id'),
			'status' => array(self::BELONGS_TO, 'Status', 'order_status'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'suppliers_id' => 'Suppliers',
			'user_id' => 'Raised By',
			'order_number' => 'Order Number',
			'order_status' => 'Order Status',
			'date_of_order' => 'Date Of Order',
			'total_cost' => 'Total Cost',
			'vat' => 'Vat',
			'net_cost' => 'Net Cost',
			'created' => 'Created',
			'modified' => 'Modified',
			'cancelled' => 'Cancelled',
			'shipping_cost' => 'Shipping Cost',
			'date_of_order_recieved' => 'Date Of Order Recieved',
		);
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
							
				$this->created=time();
				$this->modified=time();
				
				$this->user_id=Yii::app()->user->id;
				
								
				$count_sql = "SELECT COUNT(*) FROM purchase_order";
				$total_records = Yii::app()->db->createCommand($count_sql)->queryScalar();
				
				//echo "TOTAL ".$total_records;
				
				if ($total_records==0)
				{
					$this->order_number=10000001;					
				}//end of id
				else 
				{
					$last_po_number = Yii::app()->db->createCommand()
                                ->select('id , order_number')                                
                                ->from('purchase_order')
                                ->order('id DESC')
                                ->limit(1,0)
                                ;
                	$data = $last_po_number->query();				
					foreach ($data as $out)
					{
						$orderNum=$out['order_number'];
						$this->order_number=$orderNum+1;
					}///end of foreach
					
				}//end of else

				//echo $this->order_number;
				
            }//end of if($this->isNewRecord).
			else
			{
				$this->modified=time();
				
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
		/*working*/
		$criteria->with=array('status', 'suppliers');
		$criteria->compare('status.name', $this->status_of_order, true);
		$criteria->compare( 'suppliers.name', $this->supplier_name, true );

		$criteria->order = 'order_number DESC';
		$criteria->compare('id',$this->id);
		$criteria->compare('suppliers_id',$this->suppliers_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('order_number',$this->order_number);
		$criteria->compare('order_status',$this->order_status);
		$criteria->compare('date_of_order',$this->date_of_order,true);
		$criteria->compare('total_cost',$this->total_cost);
		$criteria->compare('vat',$this->vat);
		$criteria->compare('net_cost',$this->net_cost);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('cancelled',$this->cancelled,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		
//		return new CActiveDataProvider( 'PurchaseOrder' , array(
//				'criteria'=>$criteria,
//		));
	}
	
	public function getOrderStatus($staus_code)
	{
		$str='';
		//echo $staus_code;
		switch ($staus_code)
		{
			case 1: $str="Draft"; break;
			case 2: $str="<span style='color:orange;'><b>On Order</b></span>"; break;
			case 3: $str="<span style='color:green;'><b>Recieved</b></span>"; break;
			case 4: $str="<span style='color:orange;'><b>Partially Recieved</b></span>"; break;
			case 5: $str="<span style='color:red;'><b>Partially Damaged</b></span>"; break;
			case 6: $str="<span style='color:red;'><b>All Missing</b></span>"; break;
			case 7: $str="<span style='color:red;'><b>All Damaged</b></span>"; break;
			
			case 10: $str="<span style='color:green;'><b>Complete</b></span>"; break;
			case 11: $str="<span style='color:red;'><b>Cancelled</b></span>"; break;
			case 12: $str="<span style='color:red;'><b>Deleted</b></span>"; break;
			
			case 101: $str="<span style='color:orange;'><b>Pick Up</b></span>"; break;
			
			//default: break;
		}
			
		return $str;
		
	}//end of getStatus
	
	public function getItemsOnOrder($purchase_id) 
	{
		//return "Yeppy;";
   	 return ItemOnOrder::model()->findAllByAttributes(array('purchase_order_id'=>$purchase_id));
	}
	
	public function getItemOnOrder($item_on_order_id)
	{
		//return "Yeppy;";
		return ItemOnOrder::model()->findByPk($item_on_order_id);
	}//end of getItemOnOrder.
	
	public function getStatus()
	{
		//return array(1=>'Draft', 2=>'Complete');
		return CHtml::dropDownList('', 'Status_of_order', array(1=>'draft', 2=>'<span style="color:green;"><b>Complete</b></span>'), $htmlOptions=array('type'=>'html'));
	}//end of getStatus.
	
	
	
}//end of class.