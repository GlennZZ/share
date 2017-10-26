<?php

/**
 * This is the model class for table "sys_user_gh".
 *
 * The followings are the available columns in table 'sys_user_gh':
 * @property integer $id
 * @property string $ghid
 * @property string $name
 * @property string $icon_url
 * @property string $qrcode
 * @property string $qrcode_small
 * @property integer $type
 * @property string $wxh
 * @property string $company
 * @property string $desc
 * @property string $tenancy
 * @property string $appid
 * @property string $appsecret
 * @property string $notes
 * @property integer $status
 * @property string $ctm
 * @property string $utm
 * @property integer $operator_uid
 * @property integer $interact
 * @property integer $tenant_id
 * @property string $ec_cid
 * @property integer $oauth
 * @property string $access_token
 * @property string $at_expires
 */
class SysUserGh extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sys_user_gh';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ghid, name, company', 'required'),
			array('type, status, tenant_id, oauth,jsapi', 'numerical', 'integerOnly'=>true),
			array('ghid, name, wxh, appid, appsecret, notes, partnerId,partnerKey,mchId', 'length', 'max'=>50),
			array('icon_url, qrcode, qrcode_small, desc,  access_token,paySignKey', 'length', 'max'=>200),
			array('company', 'length', 'max'=>100),
			array('tenancy, ctm, at_expires', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ghid, name, icon_url, qrcode, qrcode_small, type, wxh, company, desc, tenancy,  appid, appsecret, notes, status,  ctm, utm,  tenant_id, ec_cid, oauth, access_token, at_expires', 'safe', 'on'=>'search'),
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
			'id' => '主键id',
			'ghid' => '公众号ID',//（原始ID）
			'name' => '公众号名称',
			'icon_url' => '公众号图标',
			'qrcode' => '二维码图片地址-大，可在大屏幕显示',
			'qrcode_small' => '二维码图片(小)',//，可在微信显示
			'type' => '公众号类型',//，0普通订阅号，1认证订阅号，2普通服务号，3认证服务号
			'wxh' => '微信号',
			'company' => '公司名',
			'desc' => '公众号介绍',
			'appid' => '微信公众平台AppID',
			'appsecret' => '微信公众平台AppSecret',
			'paySignKey' => '微信支付paySignKey的值',
			'partnerId' => '财付通商户号partnerId',
			'partnerKey' => '财付通商户密钥partnerKey',
			'mchId'=>'微信支付分配的商户号',
			'notes' => '备注',
			'status' => '状态',//1正常可用，其他值为非正常状态。
			'ctm' => 'Ctm',
			'utm' => '最近修改时间',
			'tenant_id' => '商户ID',
			'oauth' => '微信授权方式。1精准分众传媒，2联众互动，100自己',
			'access_token' => '公众号的全局唯一票据',
			'at_expires' => 'access_token的过期时间。',
			'jsapi'=>'微信分享方式'
			
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
		$criteria->compare('ghid',$this->ghid,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('icon_url',$this->icon_url,true);
		$criteria->compare('qrcode',$this->qrcode,true);
		$criteria->compare('qrcode_small',$this->qrcode_small,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('wxh',$this->wxh,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('appid',$this->appid,true);
		$criteria->compare('appsecret',$this->appsecret,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('ctm',$this->ctm,true);
		$criteria->compare('utm',$this->utm,true);
		$criteria->compare('operator_uid',$this->operator_uid);
		$criteria->compare('oauth',$this->oauth);
		$criteria->compare('access_token',$this->access_token,true);
		$criteria->compare('at_expires',$this->at_expires,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>15,
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SysUserGh the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	protected function beforeSave(){
		parent::beforeSave();
		$this->appid=trim($this->appid);
		$this->appsecret=trim($this->appsecret);
		$this->paySignKey=trim($this->paySignKey);
		$this->partnerId=trim($this->partnerId);
		$this->partnerKey=trim($this->partnerKey);
		$this->mchId=trim($this->mchId);
		return true;
	}
}
