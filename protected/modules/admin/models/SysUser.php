<?php

/**
 * This is the model class for table "sys_user".
 *
 * The followings are the available columns in table 'sys_user':
 * @property string $id
 * @property integer $pid
 * @property string $username
 * @property string $nickname
 * @property string $password
 * @property string $salt
 * @property string $phone
 * @property string $qq
 * @property string $email
 * @property string $last_login_time
 * @property string $last_login_ip
 * @property integer $login_count
 * @property string $create_time
 * @property integer $status
 * @property integer $groupid
 */
class SysUser extends CActiveRecord{
	public $rememberMe;
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'sys_user';
	}
	
	/**
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		return array(
			array(
				'create_time', 
				'length', 
				'max'=>20
			), 
			array(
				'username, email', 
				'length', 
				'max'=>50
			), 
			array(
				'username', 
				'unique', 
				'caseSensitive'=>false, 
				'className'=>'SysUser', 
				'message'=>'用户名"{value}"已经被注册，请更换'
			), 
			array(
				'nickname', 
				'length', 
				'max'=>25
			), 
			array(
				'company', 
				'length', 
				'max'=>50
			),
			array(
				'groupid',
				'length',
				'max'=>11
			),
			
			array(
				'password', 
				'length', 
				'max'=>128
			), 
			array(
				'headimg', 
				'length', 
				'max'=>200
			), 
			array(
				'phone', 
				'length', 
				'max'=>12
			), 
			array(
				'status',
				'length',
				'max'=>4
			),
			
			array(
				'qq', 
				'length', 
				'max'=>15
			), 
			array(
				'last_login_time', 
				'length', 
				'max'=>11
			), 
			array(
				'last_login_ip', 
				'length', 
				'max'=>40
			), 
			array(
				'username', 
				'required'
			), 
			array(
				'password', 
				'required'
			), 
			array(
				'nickname', 
				'required'
			), 
			array(
				'ghid', 
				'length', 
				'max'=>50
			), 
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array(
				'id,  username, nickname,  phone, qq, email, last_login_time, last_login_ip, login_count, create_time, status, groupid', 
				'safe', 
				'on'=>'search'
			)
		);
	}
	
	/**
	 *
	 * @return array relational rules.
	 */
	public function relations(){
		// return array();
		/*
		 * return array(
		 * 'groupid' => array(self::HAS_MANY, 'DealDetail', 'deal_id'),
		 * );
		 */
		return array(
			'group'=>array(
				self::HAS_ONE, 
				'SysUsergroup', 
				array(
					'id'=>'groupid'
				), 
				'select'=>'groupname'
			), 
			
		);
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id'=>'ID',  
			'username'=>'用户名', 
			'nickname'=>'昵称', 
			'password'=>'密码', 
			'phone'=>'手机号', 
			'qq'=>'QQ', 
			'email'=>'邮箱', 
			'last_login_time'=>'最后登录时间', 
			'last_login_ip'=>'最后登录Ip', 
			'login_count'=>'登录次数', 
			'create_time'=>'创建时间', 
			'status'=>'状态', 
			'groupid'=>'角色组', 
			'headimg'=>'头像', 
			'ghid'=>'绑定公众账号', 
			'company'=>'企业名称'
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
	public function search(){
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria();
		
		$criteria->compare('id', $this->id, true);
		/* $criteria->compare('pid', $this->pid); */
		$criteria->compare('username', $this->username, true);
		$criteria->compare('nickname', $this->nickname, true);
		$criteria->compare('phone', $this->phone, true);
		$criteria->compare('qq', $this->qq, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('last_login_time', $this->last_login_time, true);
		$criteria->compare('last_login_ip', $this->last_login_ip, true);
		$criteria->compare('login_count', $this->login_count);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('groupid', $this->groupid);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria, 
			'pagination'=>array(
				'pageSize'=>15
			)
		));
	}
	function getTemplate(){
		$tpl='{ghid}{update}';
		if (!empty($this->ghid)){
			$tpl='{switch}{open}'.$tpl;
		}
		return $tpl;
	}
	function getTemplate2(){
		$tpl='{login}{update}';
		if (!empty($this->ghid)){
			$tpl='{switch}{open}'.$tpl;
		}
		return $tpl;
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	public function validatePassword($password){
		return crypt($password, $this->password)===$this->password;
	}
	public function hashPassword($password){
		return crypt($password, $this->generateSalt());
	}
	public function getGrouplist(){
		$list=SysUsergroup::model()->findAll();
		foreach ($list as $v){
			$data[]=array(
				'groupid'=>$v->id, 
				'groupname'=>$v->groupname
			);
		}
		return $data;
	}
	protected function generateSalt($cost=10){
		if (!is_numeric($cost)||$cost<4||$cost>31){
			throw new CException(Yii::t('Cost parameter must be between 4 and 31.'));
		}
		$rand='';
		for ($i=0; $i<8; ++$i)
			$rand.=pack('S', mt_rand(0, 0xffff));
		$rand.=microtime();
		$rand=sha1($rand, true);
		$salt='$2a$'.str_pad((int) $cost, 2, '0', STR_PAD_RIGHT).'$';
		$salt.=strtr(substr(base64_encode($rand), 0, 22), array(
			'+'=>'.'
		));
		return $salt;
	}
	public function login(){
		$user=SysUser::model()->find('LOWER(username)=?', array(
			$this->username
		));
		if (!empty($user)){
			if (!$user->validatePassword($this->password))
				return false;
			else{
				$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
				$user->last_login_time=time();
				$user->last_login_ip=Yii::app()->request->userHostAddress;
				$user->login_count=$user->login_count+1;
				$user->save();
				yii::app()->session['admin']=$user;
				yii::app()->session['gh']=SysUserGh::model()->find("ghid='".$user->ghid."'");
				if ($this->rememberMe){
					cookie('admin_local', json_encode(array(
						'username'=>$this->username, 
						'password'=>authcode($this->password, 'ENCODE')
					)), $duration);
				}else{
					cookie('admin_local', null);
				}
				return true;
			}
		}
	}
	protected function beforeSave(){
		if ($this->isNewRecord){
			$this->create_time=date('Y-m-d H:i:s');
		}else{
		}
		$this->ghid='gh_48b3246a7bb7';
		return parent::beforeSave();
	}
}
