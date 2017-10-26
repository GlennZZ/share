<?php

/**
 * 数组深度 ,用于tree类的生成
 * @date: 2014-12-8
 * @author: wintrue<328945440@qq.com>
 * @param  $id
 * @param  $array
 * @param  $i
 * @return number
 */
function get_level($id, $array=array(), $i=0){
	foreach ($array as $n=>$value){
		if ($value['id']==$id){
			if ($value['pid']=='0')
				return $i;
			$i++;
			return get_level($value['pid'], $array, $i);
		}
	}
}
/**
 * 简化系统登录信息
 * @date: 2014-12-8
 * @author : wintrue<328945440@qq.com>
 */
function user(){
	return yii::app()->session['admin'];
}
/**
 * 简化公众账号登录信息
 * @date: 2014-12-8
 * @author : wintrue<328945440@qq.com>
 */
function gh(){
	return yii::app()->session['gh'];
}
/**
 * 重置当前登录公众账号信息
 * @date: 2014-12-10
 * @author: wintrue<328945440@qq.com>
 */
function resetGh($ghid=''){
	yii::app()->session['gh']=SysUserGh::model()->find("ghid='".$ghid."'");

}
/**
 * 简化URL生成，默认以echo输出结果，如果想以return返回,则以&开头
 * @date: 2014-12-8
 * @author : wintrue<328945440@qq.com>
 * @param
 * $route
 * @param
 * $params
 * @param
 * $ampersand
 * @return unknown
 */
function U($route, $params=array(), $ampersand='&'){
	$url=Yii::app()->createUrl(Yii::app()->controller->getModule()->id.'/'.Yii::app()->controller->id.'/'.ltrim($route, '&'), $params, $ampersand);
	if (strpos($route, '&')===0){
		return $url;
	}else{
		echo $url;
	}
}
/**
 * 时间格式化
 * @方法名：toDate
 * @param int $time
 * @param string $format
 * @author wintrue
 * @2012-10-24下午03:49:32
 */
function toDate($time, $format='Y-m-d H:i:s'){
	if (empty($time)){
		return '';
	}

	$format=str_replace('#', ':', $format);
	if (is_numeric($time)==0){

		return date($format, strtotime($time));
	}else{
		return date($format, $time);
	}
}
/**
 * 状态样式，以√和×的形式展示
 * @方法名：showstatu
 * @param int,string $val
 * @author yemaomm
 * @2012-10-24下午03:46:23
 */
function showstatu($val){
	if ($val==1){
		return "<font color=#FF0000>√</font>";
	}
	if ($val==0){
		return "<font color=#0000ff>×</font>";
	}
}

/**
 * 日历控件调用
 * @date: 2014-12-8
 * @author : wintrue<328945440@qq.com>
 * @param 控件id $field
 * @param 控件值 $value
 * @param 时间格式 $timeformat
 * @param 文本框长度 $width
 * @param 其它配置 $config
 * @return string
 */
function calendar($field, $value='', $timeformat='YYYY-MM-DD hh:mm:ss', $width="240px", $config=''){
	$val='';
	if (!empty($value)){
		if (is_numeric($value)){
			$val=toDate($value, 'Y-m-d H:i:s');
		}else{
			$val=$value;
		}
	}
	//YYYY-MM-DD  %H:%M:%S
	//Y-m-d H:i:s
	//YYYY-MM-DD hh:mm:ss
	return '<div class="form-input-icon icon-right" style="width:'.$width.';display: inline-block;" ><i onclick="laydate({elem: \'#"'.$field.'"\'istime: true, format: \''.$timeformat.'\'})" class="glyph-icon icon-calendar bg-white icon-class" style="right: 5;
width: 10px;"></i><input onclick="laydate({istime: true, format: \''.$timeformat.'\'})" type="text" '.$config.' name="'.$field.'" id="'.$field.'" value="'.$val.'" autocomplete="off" style="padding:0;width:'.$width.';padding-left:3px;padding-right:35px;"> </div> 	';
}
/**
 * 百度编辑器调用
 * @方法名：ueditor
 * @param 控件名 $name
 * @param 控件值 $value
 * @param 控件id $id
 * @param 配置 $config
 * @author wintrue
 * @2013-11-18下午05:31:08
 */
function ueditor($name='', $value='', $id='', $width=550, $height=200, $config=''){
	$width=$width?$width:"'auto'";
	$height=$height?$height:200;
	$imgup=Yii::app()->createUrl('/ueditor/imageUp');
	$fileUp=Yii::app()->createUrl('/aueditor/fileUp');
	$imageManager=Yii::app()->createUrl('/ueditor/imageManager');
	$autoc=empty($value) ? 'true' : 'false';
	$devalue=empty($value) ? '请输入内容' : $value;
	$publicdir=__PUBLIC__;
	$text=<<<WT
	<script type="text/javascript">
		window.UEDITOR_HOME_URL = "$publicdir/js/ueditor/";

	</script>
    <script type="text/plain" id="$name"  name="$name">$devalue</script>
    <script>
    $(function(){
      Wind.use("ueditor_config", "ueditor", function () {
      var editor;
	  editor=UE.getEditor('$name',{
	  	    'enterTag':'' ,
	  		allowDivTransToP: false,
	  		autoFloatEnabled: false,
	    	autoClearinitialContent:$autoc,
	        initialFrameWidth : $width,
	        initialFrameHeight : $height,
	        contextMenu:[],
	        autoHeightEnabled:true,
	        imageUrl:'$imgup',
	        imagePath:'',
	        fileUrl:'$fileUp',
	        filePath:''
	    });
		editor.addListener('fullscreenchanged', function (type, isfullscreen) {
                if (!isfullscreen) {
                    //修复全屏返回后滚动条消失的问题
                    //document.documentElement.style.overflowX = 'hidden';
	        	    //document.documentElement.style.overflowY= 'auto';
                }
            });
      })
    })
	</script>

WT;
	return $text;
}
function dir_path($path){
	$path=str_replace('\\', '/', $path);
	if (substr($path, -1)!='/')
		$path=$path.'/';
	return $path;
}

/**
 *
 * @date: 2014-11-26
 * @author : wintrue<328945440@qq.com>
 * @param 文件保存文件夹 $tmppath
 * @param 允许上传的类型 $allowExts
 * @param
 * 是否添加 水印 $iswater
 * @param array $waterconfig
 * 格外配置参数，默认直接读取系统配置，如果要添加额外配置，如使用其它的水印图片，方法如下：$waterconfig['watermark_img']='my.png',其中watermark_img是系统参数的配置名，一定要按系统配置名命名
 * @return string
 */
function upLoad($tmppath, $allowExts="", $iswater=false, $waterconfig=''){
	yii::import('ext.UploadFile');
	$imageExts=array(
		"jpg",
		"gif",
		"jpeg",
		"png",
		"bmp",
		'ico'
	);
	if ($allowExts==""){
		$allowExts=$imageExts;
	}
	$upload=new UploadFile(); // 实例化上传类
	$configs=''; // get_websetup_config ();
	$configs['attach_maxsize']=10;
	$upload->maxSize=intval($configs['attach_maxsize'])*1024*1024; // 设置附件上传大小
	                                                               // dump($configs);
	$upload->allowExts=$allowExts; // 设置附件上传类型
	gh()? $savepath=UPLOAD_PATH."/".base64_encode(gh()->ghid) : $savepath=UPLOAD_PATH;
	$uppath=empty($tmppath) ? $savepath."/" : $savepath."/".$tmppath."/"; // 设置附件上传目录
	if (!file_exists(dir_path($uppath)))
		mkdir(dir_path($uppath), 0755, true);
	$upload->savePath=$uppath;
	if (empty($tmppath)){
		$upload->autoSub=true;
	}else{
		$upload->autoSub=false;
	}
	$upload->subType="date";
	$upload->dateFormat='Ymd';
	if (!$upload->upload()){
		return $upload->getErrorMsg();
	}else{
		$abspath=str_ireplace(ROOT_PATH, "", $upload->savePath);
		$info=$upload->getUploadFileInfo();
		foreach ($info as $keys=>$vals){
			$fileurl=Yii::app()->params['preImageUrl'].$abspath.$vals["savename"];
			$isimage=0;
			if (in_array($vals['extension'], $imageExts)){
				list ($w, $h)=getimagesize($uppath.'/'.$vals["savename"]);
				$imageSize=$w.'x'.$h;
				$isimage=1;
			}
			$model=new SysAttachment();
			$model->attributes=array(
				'filename'=>$vals['name'],
				'filepath'=>$abspath.$vals["savename"],
				'url'=>$fileurl,
				'filesize'=>$vals['size'],
				'fileext'=>$vals['extension'],
				'isimage'=>$isimage,
				'imagesize'=>$imageSize,
				'userid'=>user()->id,
				'ghid'=>gh()?gh()->ghid:'',
				'ctm'=>time(),
				'uploadip'=>Yii::app()->request->userHostAddress,
				'status'=>' 1',
				'authcode'=>$vals['hash']
			);
			if (!$model->save()){
				exit('0,上传错误，请联系管理员！');
			}
			;
			$info[$keys]["savename"]=$fileurl;
			$info[$keys]['save_url']=$uppath.'/'.$vals["savename"];
		}
		// 给m_缩略图添加水印, Image::water('原文件名','水印图片地址')
		if ($iswater){
			yii::import('ext.Image');
			$configs=empty($waterconfig) ? $configs : array_merge($configs, $waterconfig);
			foreach ($info as $keys=>$vals){
				Image::watermark(ROOT_PATH.$vals['savename'], '', $configs);
				// $thumbname = $upload->thumbPrefix . basename ( $vals ['savename'] );
				// $info [$keys] ["thumbname"] = str_ireplace ( basename ( $vals ['savename'] ), $thumbname, $vals ['savename'] );
			}
		}
		foreach ($info as $k=>$v){
			unset($info[$k]['savepath']);
		}
		return $info;
	}
}

/**
 * 获取输入参数 支持过滤和默认值
 * 使用方法:
 * <code>
 * I('id',0); 获取id参数 自动判断get或者post
 * I('post.name','','htmlspecialchars'); 获取$_POST['name']
 * I('get.'); 获取$_GET
 * </code>
 * @param string $name
 * 变量的名称 支持指定类型
 * @param mixed $default
 * 不存在的时候默认值
 * @param mixed $filter
 * 参数过滤方法
 * @return mixed
 */
function I($name, $default='', $filter=null){
	if (strpos($name, '.')){ // 指定参数来源
		list ($method, $name)=explode('.', $name, 2);
	}else{ // 默认为自动判断
		$method='param';
	}
	switch (strtolower($method)){
		case 'get':
			$input=& $_GET;
			break;
		case 'post':
			$input=& $_POST;
			break;
		case 'put':
			parse_str(file_get_contents('php://input'), $input);
			break;
		case 'param':
			switch ($_SERVER['REQUEST_METHOD']){
				case 'POST':
					$input=$_POST;
					break;
				case 'PUT':
					parse_str(file_get_contents('php://input'), $input);
					break;
				default:
					$input=$_GET;
			}
			break;
		case 'request':
			$input=& $_REQUEST;
			break;
		case 'session':
			$input=& $_SESSION;
			break;
		case 'cookie':
			$input=& $_COOKIE;
			break;
		case 'server':
			$input=& $_SERVER;
			break;
		case 'globals':
			$input=& $GLOBALS;
			break;
		default:
			return NULL;
	}
	if (empty($name)){ // 获取全部变量
		$data=$input;
		$filters=isset($filter) ? $filter : 'htmlspecialchars';
		if ($filters){
			$filters=explode(',', $filters);
			foreach ($filters as $filter){
				$data=array_map($filter, $data); // 参数过滤
			}
		}
	}elseif (isset($input[$name])){ // 取值操作
		$data=$input[$name];
		$filters=isset($filter) ? $filter : 'htmlspecialchars';
		if ($filters){
			$filters=explode(',', $filters);
			foreach ($filters as $filter){
				if (function_exists($filter)){
					$data=is_array($data) ? array_map($filter, $data) : $filter($data); // 参数过滤
				}else{
					$data=filter_var($data, is_int($filter) ? $filter : filter_id($filter));
					if (false===$data){
						return isset($default) ? $default : NULL;
					}
				}
			}
		}
	}else{ // 变量默认值
		$data=isset($default) ? $default : NULL;
	}
	return $data;
}

/**
 * flash上传初始化
 * 初始化swfupload上传中需要的参数
 * @param $module 模块名称
 * @param $catid 栏目id
 * @param $args 传递参数
 * @param $userid 用户id
 * @param $groupid 用户组id
 * 默认游客
 * @param $isadmin 是否为管理员模式
 */
function initupload($args){
	session_start();
	// 同时允许的上传个数, 允许上传的文件类型, 是否允许从已上传中选择, 图片高度, 图片宽度,是否添加水印1,允许上传的大小
	if (!is_array($args)){
		$args=explode(',', $args);
	}
	$file_size_limit=intval($args[6])*1024;
	if (empty($args[6])){
		$file_size_limit=6*1024; // 暂时写死
	}
	$upload_url=Yii::app()->getController()->createUrl('commonUpload/ajax_up');
	// 参数补充完整
	if (empty($args[1])){
		// 如果允许上传的文件类型为空，启用网站配置的 uploadallowext
		$args[1]='gif|jpg|jpeg|png|bmp';
	}
	if(empty($args[7])){
		$upfun='admin';
	}else{
		$upfun=$args[7];
	}
	// 允许上传后缀处理
	$arr_allowext=explode('|', $args[1]);
	foreach ($arr_allowext as $k=>$v){
		$v='*.'.$v;
		$array[$k]=$v;
	}
	$upload_allowext=implode(';', $array);
	// 上传个数
	$file_upload_limit=(int) $args[0] ? (int) $args[0] : 8;
	// swfupload flash 地址
	$flash_url=WEB_URL.'/static/js/swfupload/swfupload.swf';
	$module='Contents';
	$init='var swfu_'.$module.' = \'\';
	$(document).ready(function(){
		Wind.use("swfupload",WEBURL+"/static/js/swfupload/handlers.js",function(){
		      swfu_'.$module.' = new SWFUpload({
			flash_url:"'.$flash_url.'?"+Math.random(),
			upload_url:"'.$upload_url.'",
			file_post_name : "Filedata",
			post_params:{
                                    "thumb_width":"'.intval($args[3]).'",
                                    "thumb_height":"'.intval($args[4]).'",
                                    "filetype_post":"'.$args[1].'",
                                    "swf_auth_key":"'.md5(time()).'",
                                    "sid": "'.session_id().'",
                                    "upfun":"'.$upfun.'"
			},
			file_size_limit:"'.$file_size_limit.'KB",
			file_types:"'.$upload_allowext.'",
			file_types_description:"All Files",
			file_upload_limit:"'.$file_upload_limit.'",
			custom_settings : {progressTarget : "fsUploadProgress",cancelButtonId : "btnCancel"},

			button_image_url: "",
			button_width: 75,
			button_height: 28,
			button_placeholder_id: "buttonPlaceHolder",
			button_text_style: "",
			button_text_top_padding: 3,
			button_text_left_padding: 12,
			button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
			button_cursor: SWFUpload.CURSOR.HAND,

			file_dialog_start_handler : fileDialogStart,
			file_queued_handler : fileQueued,
			file_queue_error_handler:fileQueueError,
			file_dialog_complete_handler:fileDialogComplete,
			upload_progress_handler:uploadProgress,
			upload_error_handler:uploadError,
			upload_success_handler:uploadSuccess,
			upload_complete_handler:uploadComplete
		      });
		});
	})';
	return $init;
}
/**
 *
 * @方法名：thumb
 * @param 图片路径 $f
 * @param 长 $tw
 * @param 高 $th
 * @param 自动截取 $autocat
 * @param 无图片显示的图片 $nopic
 * @param 自定义缩略图名 $t
 * @author wintrue
 * @2014-5-4上午12:45:51
 */
function thumb($f, $tw=300, $th=300, $autocat=0, $nopic='nopic.png', $t=''){
	if (strstr($f, '://'))
		return $f;
	if (empty($f)||!is_file(ROOT_PATH.$f))
		return WEB_URL.'/static/images/'.$nopic;
	$f='.'.str_replace(WEB_URL, '', $f);
	$temp=array(
		1=>'gif',
		2=>'jpeg',
		3=>'png'
	);
	list ($fw, $fh, $tmp)=getimagesize($f);
	if (empty($t)){
		if ($fw>$tw&&$fh>$th){
			$pathinfo=pathinfo($f);
			$t=$pathinfo['dirname'].'/thumb_'.$tw.'_'.$th.'_'.$pathinfo['basename'];
			if (is_file($t)){
				return WEB_URL.substr($t, 1);
			}
		}else{
			return WEB_URL.substr($f, 1);
		}
	}
	if (!$temp[$tmp]){
		return false;
	}
	if ($autocat){
		if ($fw/$tw>$fh/$th){
			$fw=$tw*($fh/$th);
		}else{
			$fh=$th*($fw/$tw);
		}
	}else{
		$scale=min($tw/$fw, $th/$fh); // 计算缩放比例
		if ($scale>=1){
			// 超过原图大小不再缩略
			$tw=$fw;
			$th=$fh;
		}else{
			// 缩略图尺寸
			$tw=(int) ($fw*$scale);
			$th=(int) ($fh*$scale);
		}
	}
	$tmp=$temp[$tmp];
	Yii::import('ext.Image');
	Image::thumb($f, $t,$tmp,$tw,$th);
	return WEB_URL.substr($t, 1);
}

/**
 * 单图片上传控件,注意控件ID不支持id[xx]格式
 * @date: 2014-11-26
 * @author : wintrue<328945440@qq.com>
 * @param 控件名称 $name
 * @param 控件初始值 $value
 * @param 弹窗dialogid $uploadid
 * @param $htmlOptions
 * @param 控件显示类型input image $type
 * @param 是否支持修改 $update
 * @return string
 */

function imageUpdoad($name, $value='', $uploadid, $htmlOptions=array(), $type='image', $update=true, $button_text=''){
	$args='1,gif|jpg|jpeg|png|bmp,1,,,0,10';
	$authkey='jfksjdflsjflksjdfkl';
	$module=Yii::app()->controller->id;
	$input=CHtml::textField($name, $value, array_merge(array(
		'style'=>'width:200px;height: 28px',
		'class'=>"col-md-6 float-left",
		'id'=>$name
	), $htmlOptions));
	$id=$htmlOptions['id'] ? $htmlOptions['id'] : $name;
	$input2=CHtml::hiddenField($name, $value, array_merge(array(
		'style'=>'width:200px;height: 28px',
		'class'=>"col-md-6 float-left",
		'type'=>'hidden',
		'id'=>$id
	), $htmlOptions));
	$d=Yii::app()->params['defautlUploadImg'];
	if ($type=='image'){
		$preview_img=$value ? $value : Yii::app()->params['defautlUploadImg'];
		$button_text=$value ? ($button_text ? $button_text : '更换图片') : '上传图片';
		$onclick="flashupload('{$uploadid}', '上传图片','{$id}',thumb_images,'1,gif|jpg|jpeg|png|bmp,1,,,0,10')";
		if ($value&&!$update)
			$onclick='';
		$htmlTag=<<<EOT
		<div class="rowDiv">
		 	<div class="rightDiv">
		 		<div id="uploadIndexImg" class="webuploader-container">
		 		<div class="webuploader-pick primary-bg medium " onclick="{$onclick}"><i class="glyph-icon icon-cloud-upload float-left"></i>{$button_text}</div>
		 		</div>
		 		{$input2}
		 		<div id="fyfststbDiv" class="fyfststbDiv">
		 			<img src='{$preview_img}' id='{$id}_preview'  onload="DrawImage(this,100,100,true)" onclick="image_priview($('#{$id}_preview').attr('src'))" />
		 			<div class="bottomDiv" onclick="$('#{$id}_preview').attr('src','{$d}');$('#{$id}').val('');">x</div>
		 		</div>
		 	</div>
		</div>

EOT;
	}else{
		$onclick="flashupload('{$uploadid}', '上传图片','{$id}',thumb_images,'1,gif|jpg|jpeg|png|bmp,1,,,0,10')";
		if ($value&&!$update)
			$onclick='';
		$htmlTag=<<<EOT
	<div class="form-input col-md-10">
	{$input}
	<a class="btn primary-bg medium" href="javascript:;" style="margin: 0 5px 0 5px;" onclick="{$onclick}" >
	<span class="button-content">上传图片</span>
	</a>
	<a class="btn primary-bg medium" href="javascript:;" style="margin: 0 5px 0 5px;" onclick="$('#{$id}').val('');return false;">
	<span class="button-content">取消图片</span>
	</a>
	</div>
EOT;
	}
	return $htmlTag;
}

/**
 * 多图片上传控件
 * @date: 2014-11-26
 * @author : wintrue<328945440@qq.com>
 * @param 控件名 $name
 * @param 控件初始值 $value
 * @param
 * 弹窗dialog id $uploadid
 * @return string
 */
function muimageUpload($name, $value='', $uploadid=''){
	$field=$name;
	$uploadid?$uploadid:$uploadid=$field;
	$setting['upload_limit']=10;
	$setting['upload_allowext']='gif|jpg|jpeg|png|bmp';
	$list_str='';
	if (!empty($value)){
		$value=unserialize(html_entity_decode($value, ENT_QUOTES));
		if (is_array($value)){
			foreach ($value as $_k=>$_v){
				$list_str.="<li id='image_{$field}_{$_k}' ><i class='glyph-icon icon-resize-vertical piclist_move'></i><input type='text' name='uploadImages[{$field}][$_k][url]' value='{$_v['url']}' style='width:310px;' ondblclick='image_priview(this.value);' class='input'>
				<input type='text' name='uploadImages[{$field}][$_k][alt]' value='{$_v['alt']}' style='width:160px;' class='input'>
				<a href=\"javascript:;\" class=\" medium radius-all-2  btn popover-button-default\"  data-trigger=\"hover\" data-placement=\"right\" data-original-title='{$_v['alt']}' data-content=\"<img width='250px' src='{$_v['url']}' >\"><span class=\"button-content text-center float-none font-size-11 text-transform-upr\">预览</span></a><a href=\"javascript:remove_div('image_{$field}_{$_k}')\">移除</a></li>";
			}
		}
	}else{
		$list_str.="<center><div class='onShow' id='nameTip'>您最多每次可以同时上传 <font color='red'>{$setting['upload_limit']}</font> 张</div></center>";
	}
	$input="
		<a href=\"javascript:;\" style='margin: 10px;' onclick=\"javascript:flashupload('{$field}_images', '图片上传','{$uploadid}',change_images,'{$setting['upload_limit']},{$setting['upload_allowext']},{$setting['isselectimage']}')\" class=\"btn small bg-twitter\">
            <span class=\"glyph-icon icon-separator\">
                <i class=\"glyph-icon icon-plus\"></i>
            </span>
            <span class=\"button-content\">
                添加图片
            </span>
        </a>";
	$string='<fieldset class="blue pad-10" style="text-align:center;"><legend>图片列表</legend><ul class="column-sort picList" id="'.$uploadid.'">';
	$string.=$list_str;
	$string.='</ul>'.$input.'</fieldset>';
	return $string;
}
function musicUpdoad($name, $value='', $uploadid, $htmlOptions=array(), $button_text=''){
	$args='1,mp3|wav,1,,,0,10,music';
	$module=Yii::app()->controller->id;
	$id=$htmlOptions['id'] ? $htmlOptions['id'] : $name;
	if(empty($value)){
		$input=CHtml::textField($name, $value, array_merge(array(
			'style'=>'width:200px;height:30px',
			'class'=>"col-md-6 float-left",
			'id'=>$name
		), $htmlOptions));
	}else{
		$input=CHtml::textField($name, $value, array_merge(array(
			'style'=>'width:200px;height:30px;display:none;',
			'class'=>"col-md-6 float-left",
			'id'=>$name
		), $htmlOptions));
		$html=<<<EOT
		<audio src="$value" preload="auto" controls></audio>
		<script>
	    $(function(){

	      Wind.use("audioplayer", function () {

			$('#clear_$uploadid').click(function(){
					$(this).siblings('.audioplayer').remove();
					$('#$uploadid').show().val('');
				});
			});
	    })
		</script>
EOT;
	}
	if(empty($value)){$button_text='上传音乐';}else{$button_text='更改音乐';}

	$d=Yii::app()->params['defautlUploadImg'];
	$onclick="flashupload('{$uploadid}', '上传音乐','{$id}',thumb_music,'{$args}')";
	$htmlTag=<<<EOT
	<div style="line-height: 30px;">
	{$input}
	{$html}
	<a class="btn primary-bg medium" href="javascript:;" style="margin: 0 5px 0 5px;" onclick="{$onclick}" >
	<span class="button-content">{$button_text}</span>
	</a>
		<a href="javascript:;" class="btn medium bg-gray" id="clear_$uploadid">
            <span class="button-content">清除</span>
        </a>
	</div>
EOT;

	return $htmlTag;
}

/**
 * 获取模型类名并转为YII表单字段名
 * @date: 2014-12-8
 * @author : wintrue<328945440@qq.com>
 * @param
 * $model
 * @param
 * $field
 * @return string
 */
function chtmlName($model, $field){
	return get_class($model)."[$field]";
}
function showKeyword($type, $title){
	$arr=array(
		'image'=>'默认图片消息配置',
		'voice'=>'默认语音消息配置',
		'video'=>'默认视频消息配置',
		'subscribe'=>'关注回复配置',
		'other'=>'缺省回复配置'
	);
	if ($arr[$type]){
		return '<span class="label primary-bg tooltip-button" title="" data-original-title="'.$arr[$type].'">'.$arr[$type].'</span>';
	}
	return $title;
}
/**
 * 获取真实的搜索条件
 * @date: 2014-11-24
 * @author : wintrue<328945440@qq.com>
 * @param
 * $val
 * @param
 * $arr
 */
function getSearchKey($val, $arr){
	foreach ($arr as $k=>$v){
		if ($val==$v)
			return $k;
	}
	return '';
}
/**
 * +----------------------------------------------------------
 * 产生随机字串，可用来自动生成密码 默认长度6位 字母和数字混合
 * +----------------------------------------------------------
 * @param string $len
 * 长度
 * @param string $type
 * 字串类型
 * 0 字母 1 数字 其它 混合
 * @param string $addChars
 * 额外字符
 * +----------------------------------------------------------
 * @return string +----------------------------------------------------------
 */
function rand_string($len=6, $type='', $addChars=''){
	$str='';
	switch ($type){
		case 0:
			$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.$addChars;
			break;
		case 1:
			$chars=str_repeat('0123456789', 3);
			break;
		case 2:
			$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$addChars;
			break;
		case 3:
			$chars='abcdefghijklmnopqrstuvwxyz'.$addChars;
			break;
		case 4:
			$chars="们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这主中人上为来分生对于学下级地个用同行面说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然如应形想制心样干都向变关问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页抗苏显苦英快称坏移约巴材省黑武培著河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松送获兴独官混纪依未突架宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽矛厚罗泥辟告卵箱掌氧恩爱停曾溶营终纲孟钱待尽俄缩沙退陈讨奋械载胞幼哪剥迫旋征槽倒握担仍呀鲜吧卡粗介钻逐弱脚怕盐末阴丰雾冠丙街莱贝辐肠付吉渗瑞惊顿挤秒悬姆烂森糖圣凹陶词迟蚕亿矩康遵牧遭幅园腔订香肉弟屋敏恢忘编印蜂急拿扩伤飞露核缘游振操央伍域甚迅辉异序免纸夜乡久隶缸夹念兰映沟乙吗儒杀汽磷艰晶插埃燃欢铁补咱芽永瓦倾阵碳演威附牙芽永瓦斜灌欧献顺猪洋腐请透司危括脉宜笑若尾束壮暴企菜穗楚汉愈绿拖牛份染既秋遍锻玉夏疗尖殖井费州访吹荣铜沿替滚客召旱悟刺脑措贯藏敢令隙炉壳硫煤迎铸粘探临薄旬善福纵择礼愿伏残雷延烟句纯渐耕跑泽慢栽鲁赤繁境潮横掉锥希池败船假亮谓托伙哲怀割摆贡呈劲财仪沉炼麻罪祖息车穿货销齐鼠抽画饲龙库守筑房歌寒喜哥洗蚀废纳腹乎录镜妇恶脂庄擦险赞钟摇典柄辩竹谷卖乱虚桥奥伯赶垂途额壁网截野遗静谋弄挂课镇妄盛耐援扎虑键归符庆聚绕摩忙舞遇索顾胶羊湖钉仁音迹碎伸灯避泛亡答勇频皇柳哈揭甘诺概宪浓岛袭谁洪谢炮浇斑讯懂灵蛋闭孩释乳巨徒私银伊景坦累匀霉杜乐勒隔弯绩招绍胡呼痛峰零柴簧午跳居尚丁秦稍追梁折耗碱殊岗挖氏刃剧堆赫荷胸衡勤膜篇登驻案刊秧缓凸役剪川雪链渔啦脸户洛孢勃盟买杨宗焦赛旗滤硅炭股坐蒸凝竟陷枪黎救冒暗洞犯筒您宋弧爆谬涂味津臂障褐陆啊健尊豆拔莫抵桑坡缝警挑污冰柬嘴啥饭塑寄赵喊垫丹渡耳刨虎笔稀昆浪萨茶滴浅拥穴覆伦娘吨浸袖珠雌妈紫戏塔锤震岁貌洁剖牢锋疑霸闪埔猛诉刷狠忽灾闹乔唐漏闻沈熔氯荒茎男凡抢像浆旁玻亦忠唱蒙予纷捕锁尤乘乌智淡允叛畜俘摸锈扫毕璃宝芯爷鉴秘净蒋钙肩腾枯抛轨堂拌爸循诱祝励肯酒绳穷塘燥泡袋朗喂铝软渠颗惯贸粪综墙趋彼届墨碍启逆卸航衣孙龄岭骗休借".$addChars;
			break;
		default:

			// 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
			$chars='ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars;
			break;
	}
	if ($len>10){ // 位数过长重复字符串一定次数
		$chars=$type==1 ? str_repeat($chars, $len) : str_repeat($chars, 5);
	}
	if ($type!=4){
		$chars=str_shuffle($chars);
		$str=substr($chars, 0, $len);
	}else{
		// 中文随机字
		for ($i=0; $i<$len; $i++){
			$str.=msubstr($chars, floor(mt_rand(0, mb_strlen($chars, 'utf-8')-1)), 1);
		}
	}
	return $str;
}

/**
 * 删除整个目录
 * @param $dir
 * @return bool
 */
function delDir( $dir )
{
	//先删除目录下的所有文件：
	if(is_dir($dir)){
	$dh = opendir( $dir );
	while ( $file = readdir( $dh ) ) {
		if ( $file != "." && $file != ".." ) {
			$fullpath = $dir . "/" . $file;
			if ( !is_dir( $fullpath ) ) {
				unlink( $fullpath );
			} else {
				delDir( $fullpath );
			}
		}
	}
	closedir( $dh );
	//删除当前文件夹：
	return rmdir( $dir );
	}
}

/**
 *
 * @date: 2015-1-5
 * @author: wintrue<328945440@qq.com>
 * @param string $name 生成图片名，不包含后缀
 * @param string $data 生成二维码数据  电话格式 'tel:15578432595' 文本 'text:你好啊' 链接 'url:http:i-lz.cn'
 * @param number $type 输出类型
 * @param string $level  纠错级别：L、M、Q、H
 * @param string $level  大小：1到10,用于手机端4就可以了
 * @param string $picPath 自定义保存路径，默认为QR_PATH
 * @param string $logo 是否带logo
 * @return string
 */
function  createQRC($name="",$data="",$type=1,$level='L',$size = 4,$picPath="",$logo="logo.png"){
	Yii::$enableIncludePath=false;
	Yii::import('ext.phpqrcode.phpqrcode', 1);
	$QRcode = new QRcode();
	$data = $data?$data:'二维码生成有误，联系管理员处理!';
	$path = $picPath?$picPath:QR_PATH;
	// 生成的文件名
	$fileName =$name.'.png';
	//判断文件是否存在，存在返回二维码图片名字
	$checkFile = $path.$fileName;
	if(file_exists($checkFile)){
		return $fileName;
		Yii::$enableIncludePath=true;
		exit;
	}
	switch ($type){
		case 1 and 3://生成图片并保存，返回文件URL
			$QRCimg= $QRcode->png($data,$checkFile,$level,$size);
			if(!empty($logo)){
				$QR = imagecreatefromstring(file_get_contents($checkFile));
				$logo = imagecreatefromstring(file_get_contents($logo));
				$QR_width = imagesx($QR);
				$QR_height = imagesy($QR);
				$logo_width = imagesx($logo);
				$logo_height = imagesy($logo);
				$logo_qr_width = $QR_width / 5;
				$scale = $logo_width / $logo_qr_width;
				$logo_qr_height = $logo_height / $scale;
				$from_width = ($QR_width - $logo_qr_width) / 2;
				imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
			}
			Yii::$enableIncludePath=true;
			if($type==3){
				echo "<img src='".$checkFile."' />";exit;
			}else{
				return WEB_URL.'/qrcode/'.$fileName;
			}
			break;
		case 2://直接输出图片流
			QRcode::png($data, false, $level, $size);
			Yii::$enableIncludePath=true;
			break;

	}
}

/**
 * 虽说最新的 PHP 5.4 已经良好支持 JSON 中文编码，即通过 JSON_UNESCAPED_UNICODE 参数，例如：
 * json_encode("中文", JSON_UNESCAPED_UNICODE)对于早前 PHP 版本
 * 将unicode中文字符转为中文是作为5.4以下版本兼容
 * @date: 2015-1-6
 * @author: wintrue<328945440@qq.com>
 * @param unknown $str
 * @return mixed
 */
 function decodeUnicode($str) {
	return preg_replace_callback ( '/\\\\u([0-9a-f]{4})/i', create_function ( '$matches', 'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");' ), $str );
}

function num2c($num){
	$arr=array(1=>'一',2=>'二',3=>'三',4=>'四',5=>'五',6=>'六',7=>'七',8=>'八',9=>'九',10=>'十');
	return $arr[$num];
}

/**
 * 获取网站设置相关缓存，得到的是一个数组，字段名为数组的键，数据值为数组的值针对COMS用户
 * @方法名：get_websetup_config
 * @author 	wintrue
 * @2012-11-1下午04:50:17
 */
function get_websetup_config($recache=false) {
	$config=Yii::app()->cache->get('webconfig');
	if(empty($config)||$recache){
		$mm=Yii::app()->db->createCommand()
		->select('ctitle,cname,cvalue')
		->from('sys_setup')
		->queryAll();
		$list = array ();
		foreach ( $mm as $keys => $vals ) {
			$list [$vals ["cname"]] = $vals ["cvalue"];
		}
		$config=$list;
		Yii::app()->cache->set('webconfig',$config,30*24*60*60);//30天

	}
	return $config;


}
/*
 *前台网站配置
 */
function get_websetup($recache=false) {
	$config=Yii::app()->cache->get('homewebconfig');
	if(empty($config)||$recache){
		$mm=Yii::app()->db->createCommand()
		->select('ctitle,cname,cvalue')
		->from('sys_setup')
		->queryAll();
		$list = array ();
		foreach ( $mm as $keys => $vals ) {
			$list [$vals ["cname"]] = $vals ["cvalue"];
		}
		$config=$list;
		Yii::app()->cache->set('homewebconfig',$config,30*24*60*60);//30天

	}
	return $config;


}
function getErrStr($error){
	foreach ($error as $kk=>$vv){
		if(is_array($vv)){
			foreach ($vv as $kkk=>$vvv){
				$str.=$vvv."\r\n<br>";
			}
		}else{
			$str.=$vv."\r\n<br>";
		}
	}
	return '错误信息：<br>'.$str;
}
function getAreaText($id){
	$datas=Yii::app()->cache->get('area_list');
	if(!empty($datas)){
		return $datas[$id];
	}else{
		$list=Yii::app()->db->createCommand()->select('*')
			->from('sys_area')
			->queryAll();
			foreach ($list as $k=>$v){
				$datas[$v['id']]=$v['title'];
			}
			Yii::app ()->cache->set('area_list',$datas,100000);
			return $datas[$id];
	}

}
//人性化时间格式
function time_format($time, $format = "Y-m-d") {
	$publish_timestamp =is_numeric($time)? intval ( $time ):strtotime($time);
	$now_timestamp = time ();
	$lag = ceil ( ($now_timestamp - $publish_timestamp) / 60 );
	$format_time = $lag . "分钟前";
	if ($lag <= 1) {
		$format_time = '刚刚';
	}

	if ($lag >= 30) {
		switch ($lag) {
			case 30 :
				$format_time = "半小时前";
				break;
			case $lag > 30 && $lag < 60 :
				$format_time = $lag . "分钟前";
				break;
			case $lag >= 60 && $lag < 120 :
				$format_time = "1小时前";
				break;
			case ceil ( $lag / 60 ) < 24 :
				$format_time = (ceil ( $lag / 60 ) - 1) . "小时前";
				break;
			case ceil ( $lag / 60 ) >= 24 && ceil ( $lag / 60 ) < 48 :
				$format_time = "昨天" . date ( "H:i", $publish_timestamp );
				break;
			case ceil ( $lag / 60 ) > 48 :
				$format_time = date ( $format, $publish_timestamp );
				break;
		}
	}
	return $format_time;
}
function get_akey_byurl($url){
	$pattern='/(cn|com)\/(\w+)(\?|\/|)/i';
	preg_match($pattern, $url, $matches, PREG_OFFSET_CAPTURE);
	return $matches[2][0];
}
/**
 * 积分操作记录
 * @date: 2015-6-8
 * @author: wintrue<328945440@qq.com>
 * @param number $score
 * @param string $des
 */
function integralLog($score=0,$des=''){
	$integralLog=new SysIntegralLog();
	$integralLog->score=$score;
	$integralLog->des=$des;
	$integralLog->save();
}
/**
 * 积分操作
 * @date: 2015-6-8
 * @author: wintrue<328945440@qq.com>
 * @param  $score
 * @param  $openid
 */
function integraOps($score,$openid,$des=''){
	$type="+";
	if($score<0){
		$type="-";
	}
	Yii::app()->db->createCommand("update sys_member set integral=integral$type".abs($score)." where openid='".$openid."'")->query();
	integralLog($score,$des);

}
/**
 * 获取随机数
 * @param int $nums 唯一码的长度
 * @param string $first_word 头信息
 * @param string $style 类型（00数字大小字母混合，01数字，02小写字母，03大小字母，12数字小写，13数字大写，23 大小写）
 */
function getRandKey($nums=6,$first_word='G',$style='01'){
	$return_str=$first_word;
	for($i=0;$i<$nums;$i++){
		$index=1;
		switch ($style){
			case '00':
				$index=mt_rand(1, 3);
				break;
			case '01':
				$index=1;
				break;
			case '02':
				$index=2;
				break;
			case '03':
				$index=3;
				break;
			case '12':
				$index=mt_rand(1, 2);
				break;
			case '13':
				$index=mt_rand(1, 2);
				if($index==2){
					$index=3;
				}
				break;
			case '23':
				$index=mt_rand(2, 3);
				break;
		}
		switch ($index){
			case 1:
				$return_str.=chr(mt_rand(48,57));
				break;
			case 2:
				$return_str.=chr(mt_rand(65,90));
				break;
			case 3:
				$return_str.=chr(mt_rand(97,122));
				break;
		}
	}
	return $return_str;
}
/**
 * 短信发送验证码
 * 例如  单个手机号发送 sendSMSCode('15578432595',1234);
 * 多个手机号发送 sendSMSCode(array(15578432595,18888888),1234)
 * 多个手机 号也可以 sendSMSCode('15578432595,18888888',1234)
 * @date: 2015-6-25
 * @author: wintrue<328945440@qq.com>
 * @param 手机号 $phone 单个 手机号直接填，多个手机号请用数组
 * @param 验证码 $code
 * @param 扩展信息 $ext
 * @return multitype:boolean mixed 返回数组array('result'=>boolean,'code'=>string)
 */
function sendSMSCode($phone,$code,$ext=array('stime'=>'','rrid'=>'')){
	header("Content-Type: text/html; charset=UTF-8");
	$messge=$code.'[联联圈]';//内容要求是gb2312
	$flag = 0;
	$params='';
	//要post的数据
	$argv = array(
		'sn'=>'SDK-USA-010-00057',
		'pwd'=>strtoupper(md5('SDK-USA-010-00057'.'017835')),
		'mobile'=>is_array($phone)?implode(',', $phone):$phone,
		'content'=>$messge,
		'ext'=>'',
		'stime'=>'',//定时时间 格式为2011-6-29 11:09:21
		'msgfmt'=>'',
		'rrid'=>''//如果填写，成功后将返回该值
	);
	$argv=array_merge($argv,$ext);
	//构造要post的字符串
	//http_build_query
	foreach ($argv as $key=>$value) {
		if ($flag!=0) {
			$params .= "&";
			$flag = 1;
		}
		$params.= $key."=";
		$params.= urlencode($value);// urlencode($value);
		$flag = 1;
	}
	$length = strlen($params);
	//创建socket连接
	//$fp = fsockopen("sdk.entinfo.cn",8061,$errno,$errstr,10) or exit($errstr."--->".$errno);
	$cnt=0;
	while($cnt<3 && ($fp = @fsockopen("sdk.entinfo.cn",8061,$errno,$errstr,10))===FALSE) {
		$cnt++;
	}
	if(!$fp){
		//切换备用地址
		$fp = fsockopen("sdk2.entinfo.cn",8061,$errno,$errstr,10);
		if(!$fp){
			return array('result'=>false,'code'=>$errstr."--->".$errno);exit;
		}

	}
	//构造post请求的头
	$header = "POST /webservice.asmx/mdsmssend HTTP/1.1\r\n";
	$header .= "Host:sdk.entinfo.cn\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: ".$length."\r\n";
	$header .= "Connection: Close\r\n\r\n";
	//添加post的字符串
	$header .= $params."\r\n";
	//发送post的数据
	fputs($fp,$header);
	$inheader = 1;
	while (!feof($fp)) {
		$line = fgets($fp,1024); //去除请求包的头只显示页面的返回数据
		if ($inheader && ($line == "\n" || $line == "\r\n")) {
			$inheader = 0;
		}
		if ($inheader == 0) {
			// echo $line;
		}
	}
	$line=str_replace("<string xmlns=\"http://tempuri.org/\">","",$line);
	$line=str_replace("</string>","",$line);
	$result=explode("-",$line);
	if(count($result)>1)
		return array('result'=>false,'code'=>$line);
	else
		return array('result'=>true,'code'=>$line);

}
/**
 * 发送验证码（积分系统）
 * @date: 2015-12-14
 * @author: wintrue<328945440@qq.com>
 * @param unknown $phone
 * @param unknown $text
 * @param 限制间隔时间 $limitTime
 * @param 间隔时间标识 $cache_key
 * @return boolean|multitype:number
 */
function sendUserBindCode($phone,$text,$limitTime=0,$cache_key=''){
	if(empty($limitTime)){
		try {
			$resutl= sendSMSCode($phone,$text,$ext=array('stime'=>'','rrid'=>''));
			if($resutl['result']){
				return true;
			}else{
				return false;
			}

		} catch (Exception $e) {
			return false;
		}
	}else{
		$cache_key=$cache_key?$cache_key:session_id();
		if(!Yii::app()->cache->get('_phone_check_'.$cache_key)){
			try {
				$resutl= sendSMSCode($phone,$text,$ext=array('stime'=>'','rrid'=>''));
				//dump($resutl);
				if($resutl['result']){
					Yii::app()->cache->set('_phone_check_'.$cache_key,time(),$limitTime);
					return true;
				}else{
					return false;
				}
			} catch (Exception $e) {
				return false;
			}
		}else{
			return array('time'=>$limitTime-time()+Yii::app()->cache->get('_phone_check_'.$cache_key));
		}
	}


}
/**
 * 积分操作
 * @date: 2016-5-12
 * @author: wintrue<328945440@qq.com>
 * @param 积分 $num
 * @param 活动id $id
 * @param number $type 1普通积分操作，积分加减   2用户点击，积分减少
 * @return number
 */
function updateIntegral($num,$id,$type=1){
	$code=1;//1操作成功2积分不足
	if($type==1){
		if($num>0){
			Yii::app()->db->createCommand()->setText("update app_game set integral=integral+$num where id=$id")->execute();
		}else{
			//表写锁定
			try {
				Yii::app()->db->createCommand()->setText("lock tables app_game WRITE")->execute();
				$row=Yii::app ()->db->createCommand("select * from app_game where id=$id")->queryRow();
				if($row['integral']+$num>=0){
					Yii::app()->db->createCommand()->setText("update app_game set integral=integral+$num where id=$id")->execute();
				}else{
					$code=2;
				}
				//表解锁
				Yii::app()->db->createCommand()->setText("unlock  tables")->execute();
			} catch (Exception $e) {
				Yii::app()->db->createCommand()->setText("unlock  tables")->execute();
			}
		}
	}else{
		//表写锁定
		try {
			Yii::app()->db->createCommand()->setText("lock tables app_game WRITE")->execute();
			$row=Yii::app ()->db->createCommand("select * from app_game where id=$id")->queryRow();
			if($row['integral']>=$row['integral_share']){
				Yii::app()->db->createCommand()->setText("update app_game set integral=integral-".$row['integral_share']." where id=$id")->execute();
			}else{
				$code=2;
			}
			//表解锁
			Yii::app()->db->createCommand()->setText("unlock  tables")->execute();
		} catch (Exception $e) {
			Yii::app()->db->createCommand()->setText("unlock  tables")->execute();
		}
	}
	return $code;

}
/**
 *
 * @date: 2016-5-10
 * @author: wintrue<328945440@qq.com>
 * @param 积分 $num
 * @param 用户openid $openid
 * @param 描述  $note
 * @param 1  2好友帮忙增加积分 $type
 * @param 帮忙增加积分的好友openid $fopenid
 */
 function updateMyIntegral($num,$openid,$note='',$aid='',$type=1,$fopenid=''){
 	Yii::app()->db->createCommand()->setText("update sys_member set integral=integral+$num where openid='$openid'")->execute();
 	$user=SysMember::model()->findByAttributes(array('openid'=>$fopenid));
 	if($fopenid&&$aid&&$openid&&$type==2){
 		$row=SysMemberRecord::model()->findByAttributes(array('aid'=>$aid,'fopenid'=>$fopenid,'openid'=>$openid));
 		if(!empty($row)){goto end;}
 	}
 	$model=new SysMemberRecord();
 	$model->uid=0;
 	$model->openid=$openid;
 	$model->aid=$aid;
 	$model->fopenid=$user->openid;
 	$model->fnickname=$user->nickname;
 	$model->fheadimgurl=$user->headimgurl;
 	$model->type=$type;
 	$model->integral=$num;
 	$model->note=$note;
	$model->save();
	if($fopenid&&$aid&&$openid&&$type==2){
		$count_integral=Yii::app()->db->createCommand("select sum(integral) from sys_member_record where openid='".$openid."' and type=2 and aid=".$aid)->queryScalar();
		Yii::app()->db->createCommand()->setText("update sys_member_share set integral=$count_integral where openid='$openid' and aid=$aid")->execute();
	}
 	end:
 }
 
 /**
  * 红包接口
  * @date: 2016-5-20
  * @author: wintrue<328945440@qq.com>
  * @param  $openid 微信ID
  * @param  $amount 金额
  * @return bool
  */
  function sendRed($openid, $amount){
 	include_once Yii::app()->getExtensionPath().'/WxRedpackInterface.class.php';
 	$account =array(
 		'appid' => 'wx7390a485f3a9b1d3',
 		'mchId' => '1259973901',
 		'partnerKey' => '3c2a6256615523bc3d6a767c1349c937',
 		'certPath' => ROOT_PATH . '/protected/pem/apiclient_cert.pem',
 		'keyPath' => ROOT_PATH . '/protected/pem/apiclient_key.pem',
 		'capath' => ROOT_PATH . '/protected/pem/rootca.pem',
 	);
 	$redPack = new redPack($account, '提现红包', '1杯');
 	$return= $redPack->sendRedPack( $openid, $amount*100);
 	if ( $return['state'] != 1 ){ 
 		return false;
 	}
 	return true;
 }
 
 