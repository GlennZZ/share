<?php
/**
* 全局公共函数1
* globals.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2014-12-8
* @author: wintrue <328945440@qq.com>
*/
function dump($var, $echo=true, $label=null, $strict=true){
	$label=($label===null) ? '' : rtrim($label).' ';
	if (!$strict){
		if (ini_get('html_errors')){
			$output=print_r($var, true);
			$output='<pre>'.$label.htmlspecialchars($output, ENT_QUOTES).'</pre>';
		}else{
			$output=$label.print_r($var, true);
		}
	}else{
		ob_start();
		var_dump($var);
		$output=ob_get_clean();
		if (!extension_loaded('xdebug')){
			$output=preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
			$output='<pre>'.$label.htmlspecialchars($output, ENT_QUOTES).'</pre>';
		}
	}
	if ($echo){
		echo ($output);
		return null;
	}else
		return $output;
}
/**
 * 字符串加密函数
 * @param string $string
 * 原文或者密文
 * @param string $operation
 * 操作(ENCODE | DECODE), 默认为 DECODE
 * @param string $key
 * 密钥
 * @param int $expiry
 * 密文有效期, 加密时候有效， 单位 秒，0 为永久有效
 * @return string 处理后的 原文或者 经过 base64_encode 处理后的密文
 * @example $a = authcode('abc', 'ENCODE', 'key');
 * $b = authcode($a, 'DECODE', 'key'); // $b(abc)
 * $a = authcode('abc', 'ENCODE', 'key', 3600);// 密文一个小时内生效
 * $b = authcode('abc', 'DECODE', 'key'); // 在一个小时内，$b(abc)，否则 $b 为空
 */
function authcode($string, $operation='DECODE', $key='hfgh654hf6g4htrr5h4fgh45', $expiry=0){
	// 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
	$ckey_length=4;
	// 随机密钥长度 取值 0-32;
	// 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
	// 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
	// 当此值为 0 时，则不产生随机密钥
	// 密匙a会参与加解密
	$keya=md5(substr($key, 0, 16));
	// 密匙b会用来做数据完整性验证
	$keyb=md5(substr($key, 16, 16));

	// 密匙c用于变化生成的密文
	$keyc=$ckey_length ? ($operation=='DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';
	// 参与运算的密匙
	$cryptkey=$keya.md5($keya.$keyc);

	$key_length=strlen($cryptkey);
	// 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
	// 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
	$string=$operation=='DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry+time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length=strlen($string);

	$result='';
	$box=range(0, 255);

	$rndkey=array();
	// 产生密匙簿
	for ($i=0; $i<=255; $i++){
		$rndkey[$i]=ord($cryptkey[$i%$key_length]);
	}
	// 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度
	for ($j=$i=0; $i<256; $i++){
		$j=($j+$box[$i]+$rndkey[$i])%256;
		$tmp=$box[$i];
		$box[$i]=$box[$j];
		$box[$j]=$tmp;
	}
	// 核心加解密部分
	for ($a=$j=$i=0; $i<$string_length; $i++){
		$a=($a+1)%256;
		$j=($j+$box[$a])%256;
		$tmp=$box[$a];
		$box[$a]=$box[$j];
		$box[$j]=$tmp;
		// 从密匙簿得出密匙进行异或，再转成字符
		$result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
	}

	if ($operation=='DECODE'){
		// substr($result, 0, 10) == 0 验证数据有效性
		// substr($result, 0, 10) - time() > 0 验证数据有效性
		// substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16) 验证数据完整性
		// 验证数据有效性，请看未加密明文的格式
		if ((substr($result, 0, 10)==0||substr($result, 0, 10)-time()>0)&&substr($result, 10, 16)==substr(md5(substr($result, 26).$keyb), 0, 16)){
			return substr($result, 26);
		}else{
			return '';
		}
	}else{
		// 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
		// 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}
/**
 * 加密方法，让authcode加密方法支持对数组进行加密;
 * @方法名：endecode
 * @param
 * $mix
 * @param
 * $operation
 * @param
 * $key
 * @param
 * $expiry
 * @author wintrue
 * @2012-11-5下午01:29:31
 */
function endecode($mix, $operation='DECODE', $key='', $expiry=0){
	if ($operation=='DECODE'){
		return json_decode(authcode($mix, $operation, $key, $expiry), true);
	}else{
		return authcode(json_encode($mix), $operation, $key, $expiry);
	}
}

/**
 * 将数据写入某文件，如果文件或目录不存在，则创建
 * @param string $filename
 * 要写入的目标
 * @param string $data
 * 要写入的数据
 * @return bool
 */
function file_write($filename, $data){
	mkdirs(dirname($filename));
	file_put_contents($filename, $data);
	return is_file($filename);
}
/**
 * 递归创建目录树
 * @param string $path
 * 目录树
 * @return bool
 */
function mkdirs($path){
	if (!is_dir($path)){
		mkdirs(dirname($path));
		mkdir($path);
	}
	return is_dir($path);
}

/**
 * 删除目录（递归删除内容）
 * @param string $path
 * 目录位置
 * @param bool $clean
 * 不删除目录，仅删除目录内文件
 * @return bool
 */
function rmdirs($path, $clean=false){
	if (!is_dir($path)){
		return false;
	}
	$files=glob($path.'/*');
	if ($files){
		foreach ($files as $file){
			is_dir($file) ? rmdirs($file) : @unlink($file);
		}
	}
	return $clean ? true : @rmdir($path);
}

/**
 * 是否包含子串
 */
function strexists($string, $find){
	return !(strpos($string, $find)===FALSE);
}
/**
 * 简化 Yii::app()
 *
 * @return CWebApplication
 */
function app(){
	return Yii::app();
}

/**
 * Yii::app()->clientScript
 *
 * @return CClientScript
 */
function cs(){
	return Yii::app()->getClientScript();
}

/**
 * 插件URL生成
 *
 * @param string $route
 * @param array $params
 * @param string $ampersand
 * @return string
 */
function AU($route, $params=array(), $ampersand='&'){
	return Yii::app()->createUrl($_GET['_akey'].'/'.ltrim($route, '/'), $params, $ampersand);
}
/**
 * 插件后台URL生成
 *
 * @param string $route
 * @param array $params
 * @param string $ampersand
 * @return string
 */
function AAU($route, $params=array(), $ampersand='&'){
	return Yii::app()->createUrl('addonAdmin/'.$_GET['_akey'].'/'.ltrim($route, '/'), $params, $ampersand);
}
function MAU($route){
	return $_GET['_akey'].'/admin/'.ltrim($route, '/');
}

/**
 * This is the shortcut to CHtml::encode
 *
 * @param string $text
 * @return string
 */
function h($text){
	return htmlspecialchars($text, ENT_QUOTES, Yii::app()->charset);
}

/*
 * PHP截取中英文字符串，不按字符数而是按宽度来截取
 * 仅针对UTF-8字符
 */
function msubstr($str, $start=0, $length, $suffix=true, $charset="utf-8"){
	if (StrLenW($str)<$length){
		return $str;
	}
	if (function_exists("mb_substr"))
		$slice=mb_substr($str, $start, $length, $charset);
	elseif (function_exists('iconv_substr')){
		$slice=iconv_substr($str, $start, $length, $charset);
		if (false===$slice){
			$slice='';
		}
	}else{
		$re['utf-8']="/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312']="/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk']="/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5']="/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice=join("", array_slice($match[0], $start, $length));
	}
	return $suffix ? $slice.'...' : $slice;
}
/**
 * 准确判断字符串长度，UTF8 需在php.ini中加载了php_mbstring.dll扩展
 * @方法名：StrLenW
 * @param unknown_type $str
 * @author wintrue
 * @2013-1-16下午04:09:47
 */
function StrLenW($str){
	return mb_strlen($str, 'UTF8');
}
function xml2array(&$xml, $isnormal=FALSE){
	yii::import('ext.XMLparse');
	$xml_parser=new XMLparse($isnormal);
	$data=$xml_parser->parse($xml);
	$xml_parser->destruct();
	return $data;
}
function array2xml($arr, $htmlon=TRUE, $isnormal=FALSE, $level=1){
	$s=$level==1 ? "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<root>\r\n" : '';
	$space=str_repeat("\t", $level);
	foreach ($arr as $k=>$v){
		if (!is_array($v)){
			$s.=$space."<item id=\"$k\">".($htmlon ? '<![CDATA[' : '').$v.($htmlon ? ']]>' : '')."</item>\r\n";
		}else{
			$s.=$space."<item id=\"$k\">\r\n".array2xml($v, $htmlon, $isnormal, $level+1).$space."</item>\r\n";
		}
	}
	$s=preg_replace("/([\x01-\x08\x0b-\x0c\x0e-\x1f])+/", ' ', $s);
	return $level==1 ? $s."</root>" : $s;
}
/**
 * Cookie 设置、获取、删除 默认前缀为addon_
 * cookie('a','b') 设置cookie a值为b，cookie('a','b',60)设置时间为1分钟，cookie('a',null)删除cookie a，cookie(null)删除所有cookie,
 * cookie(null,'addon_')删除事有addon_前缀的所有cookie，cookie('a')获取cookie a
 * @param string $name
 * cookie名称
 * @param mixed $value
 * cookie值
 * @param mixed $options
 * cookie参数
 * @return mixed
 */
function cookie($name, $value='', $option=array()){
	// 默认设置
	$config=array(
		'prefix'=>'addon_',  // cookie 名称前缀
		'expire'=>0,  // cookie 保存时间
		'path'=>'/',  // cookie 保存路径
		'domain'=>ROOT_HOST
	); // cookie 有效域名

	// 参数设置(会覆盖黙认设置)
	if (!empty($option)){
		if (is_numeric($option))
			$option=array(
				'expire'=>$option
			);
		$config=array_merge($config, array_change_key_case($option));
	}
	// 清除指定前缀的所有cookie
	if (is_null($name)){
		if (empty($_COOKIE))
			return;
			// 要删除的cookie前缀，不指定则删除config设置的指定前缀
		$prefix=empty($value) ? $config['prefix'] : $value;
		if (!empty($prefix)){ // 如果前缀为空字符串将不作处理直接返回
			foreach ($_COOKIE as $key=>$val){
				if (0===stripos($key, $prefix)){
					setcookie($key, '', time()-3600, $config['path'], $config['domain']);
					unset($_COOKIE[$key]);
				}
			}
		}
		return;
	}
	$name=$config['prefix'].$name;
	if (''===$value){
		return isset($_COOKIE[$name]) ?$_COOKIE[$name]: null; // 获取指定Cookie
	}else{
		if (is_null($value)){
			setcookie($name, '', time()-3600, $config['path'], $config['domain']);
			unset($_COOKIE[$name]); // 删除指定cookie
		}else{
			// 设置cookie
			$expire = !empty($config['expire']) ? time() + intval($config['expire']) : 0;
			setcookie($name, $value, $expire, $config['path'], $config['domain']);
			$_COOKIE[$name]=$value;
		}
	}
}
/**
 * 判断一维数组中是否存在某个一项，返回true或者该项（判断区分大上写）
 * @date: 2014-10-8
 * @author : wintrue<328945440@qq.com>
 * @param
 * $string
 * @param
 * $arr
 * @param
 * $returnvalue
 */
function dstrpos($string, $arr, $returnvalue=false){
	if (empty($string))
		return false;
	foreach ((array) $arr as $v){
		if (strpos($string, $v)!==false){
			$return=$returnvalue ? $v : true;
			return $return;
		}
	}
	return false;
}
/**
 * 判断是否是微信浏览器
 * @date: 2014-10-8
 * @author : wintrue<328945440@qq.com>
 */
function checkWeixinbrower(){
	static $browser_list=array(
		'micromessenger',
		'windows phone'
	);
	$useragent=strtolower($_SERVER['HTTP_USER_AGENT']);
	if (dstrpos($useragent, $browser_list)){
		return true;
	}
	return false;
	/*
	 * $brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
	 * if(dstrpos($useragent, $brower)) {
	 * return false;
	 * }
	 */
}
/**
 * 信息提示
 * @param string $msg
 * @param string $url
 * @param boolean $isAutoGo
 * @param int $time
 */
function exMsg($msg, $url='javascript:history.back(-1);', $isAutoGo=false, $time=2, $tiptitle='抱歉，出错了', $icon=1, $js=''){
	if ($msg=='404'){
		header("HTTP/1.1 404 Not Found");
		$msg='404 请求页面不存在！';
	}
	$icon--;
	$iconarr=array(
		'http://www.playwx.com/hd/static/whd/images/icon_smali.png',
		'http://www.playwx.com/hd/static/whd/images/icon_smali2.png'
	);
	$icon=$iconarr[$icon];
	echo <<<JOT
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Cache-control" content="no-cache">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
JOT;
	if ($isAutoGo){
		echo "<meta http-equiv=\"refresh\" content=\"$time;url=$url\" />";
	}
	echo <<<JOT
<title>提示-联众互动</title>
<style>
*{word-wrap: break-word;}*{margin:0; padding:0;}html,body{height:100%; font:12px/1.6 Microsoft YaHei, Helvetica, sans-serif; color:#4C4C4C;}body, ul, ol, li, dl, dd, p, h1, h2, h3, h4, h5, h6, form, fieldset, .pr, .pc{margin: 0; padding: 0;}a:link,a:visited,a:hover{color:#4C4C4C; text-decoration:none;}.jump_c{padding:130px 25px; font-size:15px;}.grey{color:#A5A5A5;}.jump_c a{color:#2782BA;font-size: 14px;}.footer{text-align:center; line-height:2em; color:#A5A5A5; padding:10px 0 0 0; bottom: 10PX;width: 100%; position: fixed;}.footer a{margin:0 6px; color:#A5A5A5;}.nav{position: relative;height: 44px;border-top-color: #4a4f57;border-top-style: solid;border-top-width: 1px;background: rgba(53, 59, 68, 0.09);padding: 0; /*reset default*/}.header-tit{display: block;height: 44px;line-height: 44px;font-size: 20px;font-weight: bold;color: #cfdae5;text-align: center;}.header-tit .name{display: block;width: auto;height: 44px;margin: 0 50px;padding: 0;color: inherit;text-shadow: 0 2px 3px rgba(0, 0, 0, 0.5);overflow: hidden;text-overflow: ellipsis;}.header-tit .name.name_narrow{margin: 0 100px;}body{background-image: url(http://www.playwx.com/hd/static/whd/images/cssbg.png);background: -webkit-linear-gradient(top, rgba(58, 98, 201, 0.8), #093624);background: -moz-linear-gradient(top, #0099FF, #0D5D64);background: -o-linear-gradient(top, #0099FF, #0D5D64);background: -ms-linear-gradient(top, #0099FF, #0D5D64);}
</style>
</head>
<body class="bg">
<header class="header">
    <div class="nav">
        <div class="header-tit">
            <span class="name">联众互动</span>
        </div>

    </div>
</header>
 <div style="width:100%;margin-top: 100px;">
	<div style=" width: 320px; margin-left: auto; margin-right: auto;font-size: 12PX;text-align: center;">
		<img class="pic-weixiao" src="$icon" style="height: 90px;">
	    <div style="text-align: center;margin-top: 10px;color:#FFFFFF">
			<h3 style=" margin-bottom: 15px;padding-top: 8px;">$tiptitle</h3>
JOT;
	if (!empty($msg))
		echo '错误提示：'.$msg;
	echo <<<JOT
		</div>
	</div>
   </div>
<div class="footer">
<p>© 联众互动 Inc.</p>
</div>
</body>
$js
</html>
JOT;
	exit();
}
/**
 * 解密x.js加密后传输过来的数据
 * @date: 2014-10-14
 * @author : wintrue<328945440@qq.com>
 * @param str $s
 */
function xDecode($s){
	$a=str_split($s, 2);
	$s='%'.implode('%', $a);
	$s=urldecode($s);
	if (strpos($s, session_id())!==false){
		$re=str_replace(session_id(), '', $s);
		return $re;
	}else{
		return false;
	}
}
function success($msg="", $jumpurl="", $wait=3){
	_jump($msg, $jumpurl, $wait, 1);
}
/**
 * 错误提示
 * @param type $msg
 * 提示信息
 * @param type $jumpurl
 * 跳转url
 * @param type $wait
 * 等待时间
 */
function error($msg="", $jumpurl="", $wait=3){
	_jump($msg, $jumpurl, $wait, 0);
}
/**
 * 最终跳转处理
 * @param type $msg
 * 提示信息
 * @param type $jumpurl
 * 跳转url
 * @param type $wait
 * 等待时间
 * @param int $type
 * 消息类型 0或1
 */
function _jump($msg="", $jumpurl="", $wait=3, $type=0){
	$title=($type==1) ? "提示信息" : "错误信息";
	if (empty($jumpurl)){
		if ($type==1){
			$jumpurl=isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "javascript:window.close();";
		}else{
			$jumpurl="javascript:history.back(-1);";
		}
	}
	echo <<<JOT
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>跳转提示</title>
	<style type="text/css">
		*{ padding: 0; margin: 0; }
		body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
		.system-message{ width:500px;height:100px; margin:auto;border:6px solid #999;text-align:center; position:relative;top:50px;}
		.system-message legend{font-size:24px;font-weight:bold;color:#999;margin:auto;width:100px;}
		.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
		.system-message .jump{ padding-right:10px;height:25px;line-height:25px;font-size:14px;position:absolute;bottom:0px;left:0px;background-color:#e6e6e1 ; display:block;width:490px;text-align:right;}
		.system-message .jump a{ color: #333;}
		.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 15px }
		.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
    </style>
    </head>
	<body>
	<fieldset class="system-message">
	    <legend>$title</legend>
	    <div style="text-align:left;padding-left:10px;height:75px;width:490px;  ">
JOT;
	if ($type==1){
		echo "<p class='success'>恭喜^_^!~".$msg."</p>";
	}else{
		echo "<p class='error'>Sorry!~".$msg."</p>";
	}
	echo <<<JOT
	   <p class="detail"></p>
	    </div>
	    <p class="jump">
	        页面自动 <a id="href" href="$jumpurl">跳转</a> 等待时间： <b id="wait">$wait</b>
	    </p>
	</fieldset>
	<script type="text/javascript">

	(function(){
	var wait = document.getElementById('wait'),href = document.getElementById('href').href;
	totaltime=parseInt(wait.innerHTML);
	var interval = setInterval(function(){
		var time = --totaltime;
	        wait.innerHTML=""+time;
		if(time === 0) {
			location.href = href;
			clearInterval(interval);
		};
	}, 1000);
	})();
	</script>
	</body>
	</html>
JOT;
}
