<?php

/**
 * This is the model class for table "app_down".
 *
 * The followings are the available columns in table 'app_down':
 * @property integer $id
 * @property integer $unid
 * @property string $name
 * @property double $size
 * @property string $ver
 * @property string $icon
 * @property string $imgs
 * @property string $desc
 * @property string $ios_url
 * @property string $andriod_url
 * @property integer $dowm_num
 * @property integer $clicks
 * @property string $ctm
 * @property string $utm
 * @property integer $uid
 * @property string $company
 * @property integer $type
 * @property integer $status
 */
class AppDown extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'app_down';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unid', 'required'),
			array('unid, dowm_num, clicks, uid, type, status', 'numerical', 'integerOnly'=>true),
			array('name, icon', 'length', 'max'=>150),
			array('ver,size', 'length', 'max'=>20),
			array('imgs', 'length', 'max'=>5000),
			array('ios_url, andriod_url', 'length', 'max'=>200),
			array('company', 'length', 'max'=>100),
			array('desc, utm', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, unid, name, size, ver, icon, imgs, desc, ios_url, andriod_url, dowm_num, clicks, ctm, utm, uid, company, type, status', 'safe', 'on'=>'search'),
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
			
			'app_uni'=>array(self::HAS_ONE,'AppUni',array('id'=>'unid'),'select'=>'name')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'unid' => '应用标记',//关联app_uni表的id
			'name' => '应用名称',
			'size' => '应用大小',//，一个小数点
			'ver' => '版本号',
			'icon' => '应用展示图标',
			'imgs' => '应用预览图',
			'desc' => '应用描述',
			'ios_url' => 'ios下载链接',
			'andriod_url' => '安卓下载链接',
			'dowm_num' => '下载次数',
			'clicks' => '点击次数',
			'ctm' => '添加时间',
			'utm' => '更新时间',
			'uid' => '操作人',
			'company' => '开发公司',
			'type' => '应用分类，0默认1应用2游戏',
			'status' => '状态',//1正常0下架
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('unid',$this->unid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('ver',$this->ver,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('imgs',$this->imgs,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('ios_url',$this->ios_url,true);
		$criteria->compare('andriod_url',$this->andriod_url,true);
		$criteria->compare('dowm_num',$this->dowm_num);
		$criteria->compare('clicks',$this->clicks);
		$criteria->compare('ctm',$this->ctm,true);
		$criteria->compare('utm',$this->utm,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>15
			),
		));
	}
	function getlist($pageSize=10){
		$criteria=new CDbCriteria;
		$criteria->compare('status',1);
		$criteria->select='id,name,size,icon';
		$criteria->order='utm desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>$pageSize
			),
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AppDown the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	function beforeSave(){
		if($this->isNewRecord){
			$this->ctm=date('Y-m-d H:i:s',time());
			$this->utm=date('Y-m-d H:i:s',time());
			$this->uid=user()->id;
			$this->type=0;
		}else{
			$this->utm=date('Y-m-d H:i:s',time());
		}
		$this->imgs=serialize($_POST['uploadImages']['imgs']);
		return parent::beforeSave();
	}
}
