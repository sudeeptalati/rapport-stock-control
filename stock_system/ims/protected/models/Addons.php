<?php

/**
 * This is the model class for table "addons".
 *
 * The followings are the available columns in table 'addons':
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $addon_label 
 
 * @property string $information
 * @property integer $active
 * @property string $created_on
 * @property integer $created_by
 * @property string $inactivated_on
 * @property integer $inactivated_by
 */
class Addons extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Addons the static model class
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
		return 'addons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active, created_by, inactivated_by', 'numerical', 'integerOnly'=>true),
			array('type, name, addon_label ,information, created_on, inactivated_on', 'safe'),
			array('name', 'unique','message'=>'{attribute}:{value} 	already exists!'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, name,addon_label , information, active, created_on, created_by, inactivated_on, inactivated_by', 'safe', 'on'=>'search'),
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
		'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by'),
		'inactivatedByUser' => array(self::BELONGS_TO, 'User', 'inactivated_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'name' => 'Addon Name',
			'addon_label' => 'Addon Label',
			'information' => 'Information',
			'active' => 'Active',
			'created_on' => 'Created On',
			'created_by' => 'Created By',
			'inactivated_on' => 'Inactivated On',
			'inactivated_by' => 'Inactivated By',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('addon_label',$this->addon_label,true);
		
		$criteria->compare('information',$this->information,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('inactivated_on',$this->inactivated_on,true);
		$criteria->compare('inactivated_by',$this->inactivated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function upload()
	{
		$msg='';
		if(isset($_POST['finish']))/////if form Submitted
	    {
			if(isset($_POST['addon_url']))
			{
				/////Logic To Install from URL			
			}
			else
			{
				echo "Problems in Installing from URL";

			}
			
			
			$zip_mimes = array('application/zip', 'application/x-zip', 'application/octet-stream', 'application/x-zip-compressed');
			if (in_array($_FILES["addon_zip"]["type"], $zip_mimes))
			{
				$msg.=  "<br>File name is ".$_FILES["addon_zip"]["tmp_name"];
				$uploadedname="tempaddonfile.zip";
	    		$uploaded_file= $_FILES["addon_zip"]["tmp_name"];
				$location="temp/".$uploadedname;
				if (move_uploaded_file($uploaded_file,$location))
	    			{
	    				$msg.= "<br>Temp zip Uploaded<br>";
						 
	    			}
	    			else
	    			{
	    				$msg.=  "Problem in storing";
	    			}
			}
			else
			{
				$msg.= "Problems in Installing ZIP file";

			}
			
			
			
		}////end of if form submitted
		return $msg;
	}//end of upload
	
	public function unzip()
	{
		$msg='';
		//echo "File unzipped*";
		$zip = new ZipArchive;
		$res = $zip->open('temp/tempaddonfile.zip');
		if ($res === TRUE)
		{
		$zip->extractTo('temp/tempaddonfile');
		$msg.=  "File unzipped<br>";
		$zip->close();
		}
		
	}//end of unzip
	
	public function readscript()
	{ 	
		$msg='';
		$db = new PDO('sqlite:protected/data/ims.db');
		$file_handle = fopen("temp/tempaddonfile/sql.txt","r");
		$i=0;
		while (!feof($file_handle) ) 
							{
							
							$line_of_text = fgets($file_handle);
							if(!empty($line_of_text)){
							$db->exec($line_of_text);
							$msg.=  "db changed";
							}
							else
							{
							$msg.= "Database querry not executed";
							}
							}
		$i++;
		fclose($file_handle);
	}
	
	
	public function copyfiles()
	{	
		$msg='';
		defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
		$xml=simplexml_load_file("temp/tempaddonfile/install_addon.xml");
		$source_file=getcwd().DS."temp".DS."tempaddonfile".DS.$xml->install->source->folder;
		$desti_file=getcwd().DS.$xml->install->destination->folder;
		
		$msg.="<br>Source file ". $source_file;
		$msg.="<br>Destination file ". $desti_file;
		Setup::model()->recurse_copy($source_file,$desti_file);
		
		
		$source_file=getcwd().DS."temp".DS."tempaddonfile".DS.$xml->install->source->js;
		$desti_file=getcwd().DS.$xml->install->destination->js;
		
		$msg.="<br>Source file ". $source_file;
		$msg.="<br>Destination file ". $desti_file;
		Setup::model()->recurse_copy($source_file,$desti_file);
		
		$source_file=getcwd().DS."temp".DS."tempaddonfile".DS.$xml->install->source->images;
		$desti_file=getcwd().DS.$xml->install->destination->images;
		
		$msg.="<br>Source file ". $source_file;
		$msg.="<br>Destination file ". $desti_file;
		Setup::model()->recurse_copy($source_file,$desti_file);
	}//end of copyfiles..
	
	
	public function appendaddonsxml_forinstall($addonname)
	{	
		$msg='';
	
		defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
		 
		$xmladdonfile = getcwd().DS.'protected'.DS.'config'.DS.'addons.xml';

		$xmldoc = new DOMDocument();
		$xmldoc->load($xmladdonfile);
		
		$root = $xmldoc->firstChild;
		$newElement = $xmldoc->createElement('modules');
		$root->appendChild($newElement);
		$newText = $xmldoc->createTextNode($addonname);
		$newElement->appendChild($newText);
		
		if ($xmldoc->save($xmladdonfile))
		{
			$msg.='Addon added to config file';
		}else{
				$msg.='Error in Adding Addon config file';
			}
		
		
		return $msg;
	}//end of appendaddonsxml_forinstall
	
	public function appendaddonsxml_foruninstall($addonname)
	{	
		$msg='';
		
		$addonname=trim($addonname);
		defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
		
		$xmladdonfile = getcwd().DS.'protected'.DS.'config'.DS.'addons.xml';
 
		$doc = new DOMDocument; 	
		$doc->load($xmladdonfile);

		$thedocument = $doc->documentElement;

		//this gives you a list of the modules
		$list = $thedocument->getElementsByTagName('modules');

		//figure out which ones you want -- assign it to a variable (ie: $nodeToRemove )
		$nodeToRemove = null;

		foreach ($list as $domElement){
			//echo "<br>***".$domElement->nodeValue;
			$value=$domElement->nodeValue;
			$attrValue = $domElement->getAttribute('time');
			
			//echo '<br>--'.$attrValue;
			if ($value == $addonname) {
				$nodeToRemove = $domElement; //will only remember last one- but this is just an example :)
			}
		}//end of foreach 

		//Now remove it.
		if ($nodeToRemove != null)
			$thedocument->removeChild($nodeToRemove);

		
		$doc->save($xmladdonfile);
 	
	}//end of appendaddonsxml_foruninstall UNISTALL
	
	
	
	
	public function deletemodulefolder($addonname)
	{
		defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
		
		//echo $addonname;
		$addon_to_be_deleted = getcwd().DS.'protected'.DS.'modules'.DS.$addonname;
		echo $addon_to_be_deleted; 
		
		$this->delete_directory($addon_to_be_deleted);
		
	}///end of deletemodulefolder
	
	public function delete_directory($dirname) {
		
	
      if (is_dir($dirname))
			$dir_handle = opendir($dirname);
			if (!$dir_handle)
				return false;
			while($file = readdir($dir_handle)) {
				if ($file != "." && $file != "..") {
	            if (!is_dir($dirname."/".$file))
	                 unlink($dirname."/".$file);
	            else
	                 $this->delete_directory($dirname.'/'.$file);
				}
			}
	 closedir($dir_handle);
	 rmdir($dirname);
	 return true;
	}///end of delete_directory
	
	
	
	protected function beforeSave()
	{
				if(parent::beforeSave())
        {
        	if($this->isNewRecord)  // Creating new record 
            {
        		$this->created_by=Yii::app()->user->id;
        		$this->created_on=time();
    			return true;
            }
            else
            {
            	if ($this->active==0)
				{
					$this->inactivated_by=Yii::app()->user->id;
					$this->inactivated_on=time();
            	}
            	return true;
            }
        }//end of if(parent())
    }//end of beforeSave().
	
}