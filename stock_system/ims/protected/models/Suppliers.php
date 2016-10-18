<?php

/**
 * This is the model class for table "suppliers".
 *
 * The followings are the available columns in table 'suppliers':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $town
 * @property string $country
 * @property string $contact_number
 * @property string $email
 * @property string $website
 * @property integer $lead_time_days
 * @property double $free_carriage_min_amt
 * @property string $vat_reg_no
 * @property integer $prefered_supplier
 * @property string $logo_url
 * @property string $created
 * @property string $modified
 * @property integer $active
 * @property string $api_url
 * @property string $contact_person
 * 
 * The followings are the available model relations:
 * @property Items[] $items
 * @property PurchaseOrder[] $purchaseOrders
 */
class Suppliers extends CActiveRecord
{
	public $postcode;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Suppliers the static model class
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
		return 'suppliers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, town, postcode, country, contact_number, email', 'required'),
			array('lead_time_days, prefered_supplier, active', 'numerical', 'integerOnly'=>true),
			array('free_carriage_min_amt', 'numerical'),
			array('address, website, vat_reg_no, logo_url,created, modified, active, api_url, contact_person', 'safe'),
			array('email','email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, address, town, postcode, country, contact_number, email, website, lead_time_days, free_carriage_min_amt, vat_reg_no, prefered_supplier, created, modified', 'safe', 'on'=>'search'),
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
			'items' => array(self::HAS_MANY, 'Items', 'suppliers_id'),
			'purchaseOrders' => array(self::HAS_MANY, 'PurchaseOrder', 'suppliers_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Supplier Name',
			'address' => 'Address',
			'town' => 'Town',
			'postcode' => 'Postcode',
			'country' => 'Country',
			'contact_number' => 'Contact Number',
			'email' => 'Email',
			'website' => 'Website',
			'lead_time_days' => 'Lead Time Days',
			'free_carriage_min_amt' => 'Free Carriage Min Amt',
			'vat_reg_no' => 'Vat Reg No',
			'prefered_supplier' => 'Prefered Supplier',
			'logo_url' => 'Logo URL',
			'created' => 'Created',
			'modified' => 'Modified',
			'active' => 'Active',
			'api_url' => 'API Url',
			'contact_person' => 'Contact Person',
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
				//$this->user_id=Yii::app()->user->id;
				
			}
			else
			{
				$this->modified=time();
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('town',$this->town,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('lead_time_days',$this->lead_time_days);
		$criteria->compare('free_carriage_min_amt',$this->free_carriage_min_amt);
		$criteria->compare('vat_reg_no',$this->vat_reg_no,true);
		$criteria->compare('prefered_supplier',$this->prefered_supplier);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('api_url',$this->api_url,true);
		$criteria->compare('contact_person',$this->contact_person,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}



	public function getactivesupplierslist()
	{
		return  CHtml::listData(Suppliers::model()->findAll(array('condition' => 'active=1', 'order' => "`name` ASC")), 'id', 'name');

	}


}