<?php

/**
 * This is the model class for table "setup".
 *
 * The followings are the available columns in table 'setup':
 * @property integer $id
 * @property string $company
 * @property string $address
 * @property string $town
 * @property string $postcode_s
 * @property string $postcode_e
 * @property string $county
 * @property string $country
 * @property string $email
 * @property string $telephone
 * @property string $mobile
 * @property string $alternate
 * @property string $fax
 * @property string $postcodeanywhere_account_code
 * @property string $postcodeanywhere_license_key
 * @property string $website
 * @property string $vat_reg_no
 * @property string $company_number
 * @property string $postcode
 * @property string $custom5
 */
class Setup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Setup the static model class
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
		return 'setup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company, address, town, postcode_s, postcode_e, county, country, email, telephone, mobile, alternate, fax, postcodeanywhere_account_code, postcodeanywhere_license_key, website, vat_reg_no, company_number, postcode, custom5', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company, address, town, postcode_s, postcode_e, county, country, email, telephone, mobile, alternate, fax, postcodeanywhere_account_code, postcodeanywhere_license_key, website, vat_reg_no, company_number, postcode, custom5', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'company' => 'Company',
			'address' => 'Address',
			'town' => 'Town',
			'postcode_s' => 'Postcode S',
			'postcode_e' => 'Postcode E',
			'county' => 'County',
			'country' => 'Country',
			'email' => 'Email',
			'telephone' => 'Telephone',
			'mobile' => 'Mobile',
			'alternate' => 'Alternate',
			'fax' => 'Fax',
			'postcodeanywhere_account_code' => 'Postcodeanywhere Account Code',
			'postcodeanywhere_license_key' => 'Postcodeanywhere License Key',
			'website' => 'Website',
			'vat_reg_no' => 'Vat Reg No',
			'company_number' => 'Company Number',
			'postcode' => 'Postcode',
			'custom5' => 'Custom5',
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
		$criteria->compare('company',$this->company,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('town',$this->town,true);
		$criteria->compare('postcode_s',$this->postcode_s,true);
		$criteria->compare('postcode_e',$this->postcode_e,true);
		$criteria->compare('county',$this->county,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('alternate',$this->alternate,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('postcodeanywhere_account_code',$this->postcodeanywhere_account_code,true);
		$criteria->compare('postcodeanywhere_license_key',$this->postcodeanywhere_license_key,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('vat_reg_no',$this->vat_reg_no,true);
		$criteria->compare('company_number',$this->company_number,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('custom5',$this->custom5,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}