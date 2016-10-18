<?php

/**
 * This is the model class for table "items".
 *
 * The followings are the available columns in table 'items':
 * @property integer $item_id
 * @property integer $company_id
 * @property string $part_number
 * @property string $name
 * @property string $description
 * @property string $barcode
 * @property string $location_room
 * @property string $location_row
 * @property string $location_column
 * @property string $location_shelf
 * @property integer $category_id
 * @property double $current_quantity
 * @property double $available_quantity
 * @property double $recommended_lowest_quantity
 * @property double $recommended_highest_quantity
 * @property string $remarks
 * @property integer $active
 * @property string $image_url
 * @property double $sale_price
 * @property string $factory_due_date
 * @property integer $suppliers_id
 * @property string $fits_in_model
 * @property string $created
 * @property string $modified
 * @property string $deleted
 *
 * @property string $stock_date
 * @property string $purchase_date
 * @property string $unit_price
 * @property string $vat_percentage
 * @property string $vat_amount
 * @property string $total_price_exc_vat
 * @property string $total_price_inc_vat
 * @property string $comments

 * The followings are the available model relations:
 * @property InboundItemsHistory[] $inboundItemsHistories
 * @property ItemOnOrder[] $itemOnOrders
 * @property Suppliers $suppliers
 * @property OutboundItemsHistory[] $outboundItemsHistories
 * @property PurchaseOrder[] $purchaseOrders
 */
class Items extends CActiveRecord
{
	
	public $supplier_name;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Items the static model class
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
		return 'items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unit_price, vat_percentage, vat_amount, total_price_exc_vat, total_price_inc_vat, name, current_quantity, available_quantity', 'required'),
			array('company_id, category_id, active, suppliers_id', 'numerical', 'integerOnly'=>true),
			array('unit_price, vat_percentage, vat_amount, total_price_exc_vat, total_price_inc_vat, current_quantity, available_quantity, recommended_lowest_quantity, recommended_highest_quantity, sale_price', 'numerical'),
			array('part_number,description, remarks,  stock_date, purchase_date, unit_price, vat_percentage, vat_amount, total_price_exc_vat, total_price_inc_vat, , comments, location_room, location_row, location_column, location_shelf, image_url, factory_due_date, fits_in_model, created, modified, deleted', 'safe'),

			//customised rulers. 
			array('available_quantity, current_quantity', 'nonzero'),
			array('barcode','unique','message'=>'{attribute}:{value} already exists!'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('stock_date, supplier_name, item_id, company_id, part_number, name, description, barcode, location_room, location_row, location_column, location_shelf, category_id, current_quantity, available_quantity, recommended_lowest_quantity, recommended_highest_quantity, remarks, image_url, sale_price, factory_due_date, suppliers_id, fits_in_model', 'safe', 'on'=>'search'),
			array('item_id, company_id, part_number, name, description, barcode, location_room, location_row, location_column, location_shelf, category_id, current_quantity, available_quantity, recommended_lowest_quantity, recommended_highest_quantity, remarks, active, image_url, sale_price, factory_due_date, suppliers_id, fits_in_model, created, modified, deleted, stock_date, purchase_date, unit_price, vat_percentage, vat_amount, total_price_exc_vat, total_price_inc_vat, comments', 'safe', 'on'=>'search'),

			);
	}
	
	public function nonzero($attribute,$params)
    {    
        if($this->$attribute<0)
            $this->addError($attribute,$attribute.' can not be less than zero.');
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'inboundItemsHistories' => array(self::HAS_MANY, 'InboundItemsHistory', 'main_item_id'),
			'itemOnOrders' => array(self::HAS_MANY, 'ItemOnOrder', 'items_id'),
			'suppliers' => array(self::BELONGS_TO, 'Suppliers', 'suppliers_id'),
			'outboundItemsHistories' => array(self::HAS_MANY, 'OutboundItemsHistory', 'main_item_id'),
			'purchaseOrders' => array(self::HAS_MANY, 'PurchaseOrder', 'items_item_id'),
		);
	}
	
	protected function beforeSave()
	{

        $setupmodel = Setup::model();

		if (!empty($this->stock_date))
			$this->stock_date=strtotime($this->stock_date);

		if (!empty($this->purchase_date))
			$this->purchase_date=strtotime($this->purchase_date);

		if (!empty($this->factory_due_date))
			$this->factory_due_date=strtotime($this->factory_due_date);
		
		$this->company_id=0;
		$this->category_id=0;
		
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->created=time();
				$this->modified=time();
                $this->comments=$setupmodel->initiatetimestampnotesorcomments($this->comments);
            }
			else
			{
				$this->modified=time();
                $this->comments=$setupmodel->updatenotesorcomments($this->comments, $this, 'comments');
			}
			return true;
		}
		else
			return false;
	}//end of beforeSave().
	
	public function getSuppliersName()
    {
        //return array(
          return CHtml::listData(Suppliers::model()->findAll(), 'id', 'name');
        
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'item_id' => 'Item',
			'company_id' => 'Company',
			'part_number' => 'Alternate Part Numbers (Part number by different sellers)',
			'name' => 'Name',
			'description' => 'Description',
			'barcode' => 'Barcode',
			'category_id' => 'Category',
            'active' => 'Active',
			'image_url' => 'Image Url',

            'location_room' => 'Location Room',
            'location_row' => 'Location Row',
            'location_column' => 'Location Column',
            'location_shelf' => 'Location Shelf',


            'available_quantity' => 'Available Quantity',
            'current_quantity' => 'Current Quantity',
            'recommended_lowest_quantity' => 'Recommended Lowest Quantity',
            'recommended_highest_quantity' => 'Recommended Highest Quantity',

            'factory_due_date' => 'Factory Due Date',
			'suppliers_id' => 'Suppliers',
			'fits_in_model' => 'Fits In Model',
			'created' => 'Created',
			'modified' => 'Last Modified',
			'deleted' => 'Deleted',
			'status' => 'Status',

			'stock_date' => 'Stock Date',
			'purchase_date	' => 'Purchase Date',

            'sale_price' => 'Sale Price (Inc VAT)',
            'unit_price' => 'Unit Price (Exc VAT)',
            'vat_percentage' => 'Vat % (Unit Price)',
			'vat_amount' => 'VAT Amount (Unit Price)',
            'total_price_exc_vat' => 'Total Price (Exc. VAT)',
            'total_price_inc_vat' => 'Total Price (Inc. VAT)',

            'comments' => 'Comments',
            'remarks' => 'Remarks',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('part_number',$this->part_number,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('location_room',$this->location_room,true);
		$criteria->compare('location_row',$this->location_row,true);
		$criteria->compare('location_column',$this->location_column,true);
		$criteria->compare('location_shelf',$this->location_shelf,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('current_quantity',$this->current_quantity);
		$criteria->compare('available_quantity',$this->available_quantity);
		$criteria->compare('recommended_lowest_quantity',$this->recommended_lowest_quantity);
		$criteria->compare('recommended_highest_quantity',$this->recommended_highest_quantity);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('sale_price',$this->sale_price);
		$criteria->compare('factory_due_date',$this->factory_due_date,true);
		$criteria->compare('suppliers_id',$this->suppliers_id);
		$criteria->compare('fits_in_model',$this->fits_in_model,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('deleted',$this->deleted,true);
		$criteria->compare('stock_date',$this->stock_date,true);
		$criteria->compare('purchase_date',$this->purchase_date,true);
		$criteria->compare('unit_price',$this->unit_price,true);
		$criteria->compare('vat_percentage',$this->vat_percentage,true);
		$criteria->compare('vat_amount',$this->vat_amount,true);
		$criteria->compare('total_price_exc_vat',$this->total_price_exc_vat,true);
		$criteria->compare('total_price_inc_vat',$this->total_price_inc_vat,true);
		$criteria->compare('comments',$this->comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function freeSearch($keyword)
	{	
		
		$criteria = new CDbCriteria;
		$criteria->compare('name', $keyword, true, 'OR');
		$criteria->compare('barcode', $keyword, true, 'OR');
		$criteria->compare('part_number', $keyword, true, 'OR');


		$criteria2 = new CDbCriteria;
		$criteria2->compare('active', '1', false);

		$criteria->mergeWith($criteria2, 'AND');

		/*result limit*/
		//$criteria->limit = 100;
		/*When we want to return model*/
		//return	Items::model()->findAll($criteria);
		
		/*To return active dataprovider uncomment the following code*/
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));

		
	}



	public function getinboundhistoryofthisitem($item_id)
	{
		$inbounds=InboundItemsHistory::model()->findAllByAttributes(array('main_item_id'=>$item_id));
		return $inbounds;

	}///end of 	public function getinboundhistoryofthisitem($item_id)

	public function getoutboundhistoryofthisitem($item_id)
	{
		$outbounds=OutboundItemsHistory::model()->findAllByAttributes(array('main_item_id'=>$item_id));
		return $outbounds;

	}///end of 	public function getoutboundhistoryofthisitem($item_id)



	public function generateyearlystockvaluedata()
	{

		$result_data=array();

		$allitems=Items::model()->findAll();


		$report_dates=AdvanceSettings::model()->getdatesforyearlyreport();






		$run_for_years=8;

		$present_year=date('Y');

		$current_year=$present_year-$run_for_years+1;
		$previous_year=$present_year-$run_for_years;
		$full_yearly_data=array();

		for($i=0;$i<$run_for_years;$i++){



			$yearlydata=array();

			$yearlydata['int_start_date']=mktime(0, 0, 0, $report_dates['start_month'],$report_dates['start_day'] , $previous_year);
			$yearlydata['int_end_date']=mktime(23, 59, 59, $report_dates['end_month'],$report_dates['end_day'] , $current_year);

			$criteria=new CDbCriteria();
			$criteria->addBetweenCondition('stock_date', $yearlydata['int_start_date'], $yearlydata['int_end_date']);
			$yearlystockeditems=Items::model()->findAll($criteria);

			$yearlydata['data']=$this->totalvaluesofitems($yearlystockeditems);
			$yearlydata['stock_start_date']=date('d-M-y H:i:s', $yearlydata['int_start_date']);
			$yearlydata['stock_end_date']=date('d-M-y H:i:s', $yearlydata['int_end_date']);

			$full_yearly_data[$previous_year.'-'.$current_year]=$yearlydata;
			//$full_yearly_data[$yearlydata['stock_start_date'].'-'.$yearlydata['stock_end_date']]=$yearlydata;
			$current_year++;
			$previous_year++;

		}////end of 		for($i=0;$i<5;$i++)


		$other_info=array();
		$other_info['date_range']='Date Range per Year from '.date('d-F', $yearlydata['int_start_date']).' to '.date('d-F', $yearlydata['int_end_date']);


		$result_data['yearly_data']=$full_yearly_data;


		$result_data['totalvalueofallstock']=$this->totalvaluesofitems($allitems);
		$result_data['other_info']=$other_info;


		return $result_data;



	}///end of 	public function generateyearlystockvaluedata()


	public function totalvaluesofitems($items)
	{
		$alltotalarray=array();

		$alltotalarray['total_exc_vat']=0;
		$alltotalarray['total_vat_amount']=0;
		$alltotalarray['total_inc_vat']=0;

		foreach ($items as $item) {
			$alltotalarray['total_exc_vat']=$alltotalarray['total_exc_vat']+($item->unit_price*$item->current_quantity);
			$alltotalarray['total_vat_amount']=$alltotalarray['total_vat_amount']+($item->vat_amount*$item->current_quantity);
			$alltotalarray['total_inc_vat']=$alltotalarray['total_inc_vat']+($item->sale_price*$item->current_quantity);


		}

		$alltotalarray['total_exc_vat']='£ '.$alltotalarray['total_exc_vat'];
		$alltotalarray['total_vat_amount']='£ '.$alltotalarray['total_vat_amount'];
		$alltotalarray['total_inc_vat']='£ '.$alltotalarray['total_inc_vat'];


		return $alltotalarray;
	}///end of 	public function totalvaluesofitems($items)

	
	public function formatdate()
	{
	  if ($this->stock_date===null)
		return;

	  return Yii::app()->dateFormatter->format("d-M-y", $this->stock_date);
	}


}