<?php
class redPack {
	private  $sslcertPath;       //证书pem格式路径./apiclient_cert.pem
	private  $sslkeyPath;        //证书密钥pem格式路径./apiclient_key.pem
	private  $capath;            //CA证书路径 ./rootca.pem
	private  $partnerKey;        //支付密钥          
	private  $appid;             //商户的appid
	private  $mchid;             //微信支付分配的商户号
	public   $proveName;         //红包提供方名称srting(32)
	public   $actName;           //活动名称string(32)
	public   $shareContent;      //分享文案string(256),暂未开放
	public   $shareUrl;          //分享链接string(128),暂未开放
	public   $shareImgurl;       //分享图片string(128),暂未开放
	var  $parameters;            //请求参数，类型为关联数组
	
	public   $sign_str;       //记录签名字符串
	
	/**
	 * 构造函数，进行现金红包的初始化
	 * @param array  $account 账户参数
	 * @param string $aid  活动aid
	 * @param string $actName 活动名称
	 * @param string $proveName 红包提供方名称
	 * @param array  $share 分享参数数组
	 *  
	 */
	function __construct($account,$actName,$proveName,$share=array()){
		$this->sslcertPath = $account['certPath'];
		$this->sslkeyPath = $account['keyPath'];
		$this->capath = $account['capath'];
		$this->partnerKey = $account['partnerKey'];
		$this->appid = $account['appid'];
		$this->mchid = $account['mchId'];
		$this->actName = $actName;
		$this->proveName = $proveName;
		if (empty($share)){
			$this->shareContent = "";
			$this->shareUrl = "";
			$this->shareImgurl = "";
		} else {
			$this->shareContent = $share['content'];
			$this->shareUrl = $share['url'];
			$this->shareImgurl = $share['imgUrl'];
		}
	}
	/**
	 * 封装请求参数，发送红包
	 * @param string(32) $re_openid  红包接受者 openid（在wxappid下）
	 * @param int $amount 付款金额（单位：分 ）
	 * @param string(128) $wishing 红包祝福语，如 ：感谢您参加猜灯谜活劢，祝您元 宵节快乐！ 
	 * @param string(256) $remark 备注信息
	 * @param string(32) $sendName 红包发送者姓名
	 * @param string(32) $send_openid 红包发送者openid（在wxappid下）
	 * @param string(128) $logo 商户logo的URL（暂未开放）
	 */
	public function sendRedPack( $re_openid, $amount, $wishing='', $sendName='',$send_openid='', $remark='',$logo=""){
		$url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";  //微信红包接口调用URL地址
		$orderInfo = array(); //订单信息
		
		if (empty($wishing)){
			$wishing = "1杯推广平台提现！";
		}
		if (empty($remark)){
			$remark = "提现红包， 快来抢！ ";
		}
		if (empty($sendName)){
			$sendName = $this->proveName;
		} else {
			$orderInfo['ext_info'] = $send_openid;
		}
		$orderInfo['ua'] = $_SERVER ['HTTP_USER_AGENT'];
		$this->parameters["wxappid"] = $orderInfo['appid'] = $this->appid;
		$this->parameters["mch_id"] =  $orderInfo['mchid'] = $this->mchid;
		$this->parameters["mch_billno"] =  $orderInfo['billno'] = $this->createOrderid(); //生成商户订单号（28位）
		$this->parameters["nonce_str"] =  $this->createNoncestr();
		$this->parameters["nick_name"] = $orderInfo['proveName'] = $this->proveName;                 //提供方名称
		$this->parameters["send_name"] = $orderInfo['sendName'] = $sendName; //红包发送者名称
		$this->parameters["re_openid"] = $orderInfo['re_openid'] = $re_openid;
		$this->parameters["total_amount"] = $orderInfo['money'] = (string) $amount;
		$this->parameters["min_value"] = $amount;
		$this->parameters["max_value"] = $amount;
		$this->parameters["total_num"] = 1;
		$this->parameters["wishing"] = $orderInfo['wishing_words'] = $wishing;
		$this->parameters["client_ip"] = $orderInfo['ip'] = $_SERVER['REMOTE_ADDR'];//终端ip
		$this->parameters["act_name"] = $this->actName;
		$this->parameters["remark"] = $remark; 
		$orderInfo['statue'] = 0;
		$orderInfo['ctm'] = date('Y-m-d H:i:s',time());
		$this->updateRedPackInfo($orderInfo);   //插入数据到记录表
		unset($orderInfo);
		if (!empty($logo)){ $this->parameters["logo_imgurl"] = $logo; }
		if (!empty($this->shareContent)){ $this->parameters["share_content"] = $this->shareContent; }
		if (!empty($this->shareUrl)){ $this->parameters["share_url"] = $this->shareUrl; }
		if (!empty($this->shareImgurl)){ $this->parameters["share_imgurl"] = $this->shareImgurl;}
		$this->parameters["sign"] = $this->getSign($this->parameters);
		$xml = $this->arrayToXml($this->parameters);
		$response = $this->postXmlSSLCurl($xml,$url,30);
		$data = $this->xmlToArray($response);
		if ($data['return_code'] == "SUCCESS" && $data['result_code'] == "SUCCESS"){ //红包发放成功
			$result = array(
				'billno' => $data['mch_billno'],
				'statue' => 1, //1表示发放成功
				'msg' => $data['return_msg'], 
			);
		} else {
			$result = array(
				'billno' => $data['mch_billno'],
				'statue' => 2, //2表示发放失败
				'msg' => $data['return_msg'],
			);
		}
		$this->updateRedPackInfo($result);      //更新订单状态
		$this->updateRedPackInfo($data,true);   //记录日志
		$arr = array('state'=>3,'msg'=>'一大波红包正在被哄抢，请再次挤入人群！');
		if ($result['statue'] == 1)$arr = array('state'=>1,'msg'=>'发放成功！');
		else if ($data['err_code'] == 'NOTENOUGH') $arr = array('state'=>2,'msg'=>'红包已抢完！');
//		else if ($data['err_code'] == 'NO_AUTH') $arr = array('state'=>2,'msg'=>'发放失败，此请求可能存在风险，已被微信拦截！');
		else if ($data['err_code'] == 'SENDNUM_LIMIT') $arr = array('state'=>2,'msg'=>'对不起，你今日领取红包个数超过限制，请明天再来！');
//		else if ($data['err_code'] == 'ILLEGAL_APPID') $arr = array('state'=>2,'msg'=>'非法appid，请确认是否为公众号的appid！');
//		else if ($data['err_code'] == 'CA_ERROR') $arr = array('state'=>2,'msg'=>'CA证书出错，请登录微信支付商户平台下载证书！');
//		else if ($data['err_code'] == 'SIGN_ERROR') $arr = array('state'=>2,'msg'=>'签名错误！');
//		else if ($data['err_code'] == 'OPENID_ERROR') $arr = array('state'=>2,'msg'=>'openid和appid不匹配(非授权公众号的账号)！');
		else if ($data['err_code'] == 'FREQ_LIMIT') $arr = array('state'=>2,'msg'=>'你领取红包过于频繁,请稍候重试！');
		unset($result);
		unset($data);
		return $arr;
	}
	/**
	 * 	作用：使用证书，以post方式提交xml到对应的接口url
	 */
	function postXmlSSLCurl($xml,$url,$second=30){
		$ch = curl_init();
		//超时时间
		curl_setopt($ch,CURLOPT_TIMEOUT,$second);
		//这里设置代理，如果有的话
		//curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
		//curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		//设置header
		curl_setopt($ch,CURLOPT_HEADER,FALSE);
		//要求结果为字符串且输出到屏幕上
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		//设置证书
		//使用证书：cert 与 key 分别属于两个.pem文件
		//默认格式为PEM，可以注释
		//curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
		curl_setopt($ch,CURLOPT_SSLCERT, $this->sslcertPath);
		//默认格式为PEM，可以注释
		//curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
		curl_setopt($ch,CURLOPT_SSLKEY, $this->sslkeyPath);
		//curl_setopt($ch,CURLOPT_CAINFO, $this->capath);
		//post提交方式
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$xml);
		$data = curl_exec($ch);
		//返回结果
		if($data){
			curl_close($ch);
			return $data;
		}
		else {
			$error = curl_errno($ch);
			echo "curl出错，错误码:$error"."<br>";
			echo "<a href='http://curl.haxx.se/libcurl/c/libcurl-errors.html'>错误原因查询</a></br>";
			curl_close($ch);
			return false;
		}
	}
	/**
	 * 	作用：生成签名
	 */
	public function getSign($Obj){
		foreach ($Obj as $k => $v){
			$Parameters[$k] = $v;
		}
		//签名步骤一：按字典序排序参数
		ksort($Parameters);
		$String = $this->formatBizQueryParaMap($Parameters, false);
		//签名步骤二：在string后加入支付密钥KEY
		$String = $String."&key=".$this->partnerKey;
		$this->sign_str=$String;
		//签名步骤三：MD5加密
		$String = md5($String);
		//签名步骤四：所有字符转为大写
		$result_ = strtoupper($String);
		return $result_;
	}
	/**
	 * 	作用：格式化参数，签名过程需要使用
	 */
	public function formatBizQueryParaMap($paraMap, $urlencode){
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v){
			if($urlencode){
				$v = urlencode($v);
			}
			$buff .= $k . "=" . $v . "&";
		}
		$reqPar = "";
		if (strlen($buff) > 0) {
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
	/**
	 * 	作用：生成28位的订单号
	 *  @param int $length 长度（默认为10）
	 */
	public function createOrderid( $length = 10 ){
		$str = "";
		for ($i = 0; $i < $length; $i += 1){
			$str .= rand(0,9);
		}
		$str =  $this->mchid . date('Ymd',time()) . $str;
		return $str;
	}
	/**
	 * 	作用：产生随机字符串，不长于32位
	 */
	public function createNoncestr( $length = 32 ) {
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {
			$str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
		}
		return $str;
	}
    /**
	 * 	作用：array转xml
	 */
	public function arrayToXml($arr){
        $xml = "<xml>";
        foreach ($arr as $key=>$val){
        	 if (is_numeric($val)){
        	 	$xml.="<".$key.">".$val."</".$key.">"; 
        	 }
        	 else
        	 	$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";  
        }
        $xml.="</xml>";
        return $xml; 
    }
    /**
     * 	作用：将xml转为array
     */
    public function xmlToArray($xml){
    	//将XML转为array
    	$array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    	return $array_data;
    }
    /**
     * 根据订单号更新红包发放记录表
     * @param array $data  订单数据
     * @param bool $flag false-订单插入、更新操作  true-日志插入
     * 
     */
    public function updateRedPackInfo($data,$flag = false){
    	if (!$flag){
	    	$row = Yii::app()->db->createCommand()
					->select('*')->from('sys_wxredpack_record')
					->where ( 'billno=:billno', array (':billno'=>$data['billno'] ) )
					->queryRow();
	    	if (empty($row)){
	    		Yii::app ()->db->createCommand()->insert('sys_wxredpack_record',$data );
	    	} else {
	    		Yii::app ()->db->createCommand()->update('sys_wxredpack_record',$data,'billno=:billno',array(':billno'=>$data['billno']));
	    	}
    	} else {
    		Yii::app ()->db->createCommand()->insert('sys_wxredpack_log',$data );
    		if(strtolower($data['return_code'])=='fail'){
    			$insert_date=array(
		    		'openid'=>$data['re_openid'],
		    		'headimgurl'=>'',
		    		'nickname'=>'cart',
		    		'retrueInfo'=>'mch_id:'.$data['mch_id'].';return_msg:'.$data['return_msg'].';sign_str:'.$this->sign_str.';sslcertPath'.$this->sslcertPath,
		    		'addtime'=> date('Y-m-d H:i:s'),
		    		'ip'=> Yii::app()->request->userHostAddress,
		    		'ua'=> $_SERVER ['HTTP_USER_AGENT']
		    	);
	    		Yii::app ()->db->createCommand()->insert('addred_history',$insert_date);
    		}
    	}
    }
    
}