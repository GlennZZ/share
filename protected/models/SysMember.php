<?php

/**
 * This is the model class for table "sys_member".
 *
 * The followings are the available columns in table 'sys_member':
 * @property integer $id
 * @property string $openid
 * @property string $ghid
 * @property string $srcOpenid
 * @property string $nickname
 * @property string $sex
 * @property string $province
 * @property string $city
 * @property string $headimgurl
 * @property string $privilege
 * @property string $accessToken
 * @property string $refreshToken
 * @property string $scope
 * @property string $ctm
 * @property string $utm
 * @property string $expires
 * @property string $ua
 * @property string $channel
 * @property integer $integral
 * @property integer $subscribe
 * @property string $username
 * @property string $phone
 * @property string $addr
 * @property integer $iscompleteinfo
 */
class SysMember extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sys_member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('openid', 'required'),
			array('integral, subscribe, iscompleteinfo', 'numerical', 'integerOnly'=>true),
			array('openid, ghid, srcOpenid, nickname, province, city, scope, channel, username', 'length', 'max'=>50),
			array('sex', 'length', 'max'=>2),
			array('headimgurl, ua', 'length', 'max'=>500),
			array('privilege', 'length', 'max'=>100),
			array('accessToken, refreshToken, addr', 'length', 'max'=>200),
			array('phone', 'length', 'max'=>20),
			array('ctm, utm, expires', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, openid, ghid, srcOpenid, nickname, sex, province, city, headimgurl, privilege, accessToken, refreshToken, scope, ctm, utm, expires, ua, channel, integral, subscribe, username, phone, addr, iscompleteinfo', 'safe', 'on'=>'search'),
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
			'openid' => 'Openid',
			'ghid' => 'Ghid',
			'srcOpenid' => 'Src Openid',
			'nickname' => '微信昵称',
			'sex' => '姓别',
			'province' => '省',
			'city' => '城市',
			'headimgurl' => '微信头像',
			'privilege' => 'Privilege',
			'accessToken' => 'Access Token',
			'refreshToken' => 'Refresh Token',
			'scope' => 'Scope',
			'ctm' => '创建时间',
			'utm' => '更新时间',
			'expires' => 'Expires',
			'ua' => 'Ua',
			'channel' => 'Channel',
			'integral' => '积分',
			'subscribe' => '是否关注',
			'username' => '姓名',
			'phone' => '电话',
			'addr' => '地址',
			'iscompleteinfo' => '是否完善用户信息',
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
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('ghid',$this->ghid,true);
		$criteria->compare('srcOpenid',$this->srcOpenid,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('headimgurl',$this->headimgurl,true);
		$criteria->compare('privilege',$this->privilege,true);
		$criteria->compare('accessToken',$this->accessToken,true);
		$criteria->compare('refreshToken',$this->refreshToken,true);
		$criteria->compare('scope',$this->scope,true);
		$criteria->compare('ctm',$this->ctm,true);
		$criteria->compare('utm',$this->utm,true);
		$criteria->compare('expires',$this->expires,true);
		$criteria->compare('ua',$this->ua,true);
		$criteria->compare('channel',$this->channel,true);
		$criteria->compare('integral',$this->integral);
		$criteria->compare('subscribe',$this->subscribe);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('addr',$this->addr,true);
		$criteria->compare('iscompleteinfo',$this->iscompleteinfo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>15
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SysMember the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
