<?php

/**
* 图片上传公众controller
* CommonUploadController.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2014-11-25
* @author: wintrue <328945440@qq.com>
*/
class CommonUploadController extends Controller{
	private $isthumb, // 是否缩略
$width, // 缩略长
$height, // 缩略高
$iswater, // 是否添加 水印
$fun; // 上传方法
	function _post($var=''){
		if (empty($var))
			return $_POST;
		return $_POST[$var];
	}
	function json_ok($msg, $data=''){
		echo json_encode(array(
			'code'=>'ajaxok', 
			'msg'=>$msg, 
			'data'=>$data
		));
		exit();
	}
	function json_error($msg, $data=''){
		echo json_encode(array(
			'code'=>'ajaxerror', 
			'msg'=>$msg, 
			'data'=>$data
		));
		exit();
	}
	/**
	 * 上传初始化
	 * @see CController::init()
	 */
	public function init(){
		if (user()->id==null){
			session_destroy();
			session_id($this->_post("sid"));
			session_start();
		}
		if (user()->id==null){
			exit('0,会话过期，请重新登录！');
		}
		$this->isthumb=$this->_post("isthumb");
		$this->width=$this->_post("width");
		$fun=$this->_post("upfun");
		if (empty($fun)){
			$this->fun='index';
		}else{
			$this->fun=$this->_post("upfun");
		}
		$this->height=$this->_post("height");
		if ($this->_post("iswater")=="1"){
			$this->iswater=true;
		}else{
			$this->iswater=false;
		}
		if ($this->_post("isthumb")=="1"){
			$this->isthumb=true;
		}else{
			$this->isthumb=false;
		}
	}
	// 无刷新上传,动态方法
	public function actionAjax_up(){
		$fun=$this->fun;
		$this->$fun();
	}
	/**
	 * 默认上传方法
	 * @方法名：shoppic
	 * @author wintrue
	 * @2013-7-5下午05:16:10
	 */
	private function admin(){
		$args=$this->_post();
		$info=upLoad('temp', $args['watermark_enable'], $this->isthumb);
		
		if (is_array($info)){
			if (in_array(strtolower($info[0]['extension']), array(
				"jpg", 
				"png", 
				"jpeg", 
				"gif"
			))){
				// 附件ID 附件网站地址 图标(图片时为1) 文件名
				$fileext='1';
			}else{
				$fileext=$info[0]['extension'];
				if ($fileext=='zip'||$fileext=='rar')
					$fileext='rar';
				elseif ($fileext=='doc'||$fileext=='docx')
					$fileext='doc';
				elseif ($fileext=='xls'||$fileext=='xlsx')
					$fileext='xls';
				elseif ($fileext=='ppt'||$fileext=='pptx')
					$fileext='ppt';
				elseif ($fileext=='flv'||$fileext=='swf'||$fileext=='rm'||$fileext=='rmvb')
					$fileext='flv';
				else
					$fileext='do';
			}
			echo time().",".$info[0]['savename'].",".$fileext.",".str_replace(array(
				"\\", 
				"/"
			), "", $info[0]['name']);
			exit();
		}else{
			exit('0,'.$info);
		}
	}
	/*
	 * private function index(){
	 * $info=upLoad('temp', "", $this->iswater, $this->isthumb, $this->width, $this->height);
	 * // dump($info);
	 * if (is_array($info)){
	 *
	 * $this->json_ok($info[0]['savename'], $info[0]['thumbname']);
	 * }else{
	 * $this->json_error($info);
	 * }
	 * }
	 */
	
	/**
	 * 模型控件image图片上传
	 * @方法名：modfile
	 * @author wintrue
	 * @2013-11-26上午11:30:25
	 */
	private function modfile(){
		$ismin=$this->_get("ismin");
		if ($ismin=="1"){
			$info=upLoad('image/'.date("Y")."/".date("m")."/".date("d"), "", true, true, "200", "200");
		}else{
			$info=upLoad('image/'.date("Y")."/".date("m")."/".date("d"), "", true);
		}
		if (is_array($info)){
			echo json_encode(array(
				'error'=>0, 
				'url'=>$info[0]['savename'], 
				'preurl'=>$info[0]['thumbname']
			));
		}else{
			echo json_encode(array(
				'error'=>1, 
				'message'=>$info
			));
		}
	}
	private function music(){
		$args=$this->_post();
		$info=upLoad('temp', explode('|', 'mp3|wav'), $this->isthumb);
		if (is_array($info)){
			
			$fileext=$info[0]['extension'];
			if ($fileext=='zip'||$fileext=='rar')
				$fileext='rar';
			elseif ($fileext=='doc'||$fileext=='docx')
				$fileext='doc';
			elseif ($fileext=='xls'||$fileext=='xlsx')
				$fileext='xls';
			elseif ($fileext=='ppt'||$fileext=='pptx')
				$fileext='ppt';
			elseif ($fileext=='flv'||$fileext=='swf'||$fileext=='rm'||$fileext=='rmvb')
				$fileext='flv';
			elseif ($fileext=='mp3'||$fileext=='wav')
				$fileext='mp3';
			else
				$fileext='do';
			
			echo time().",".$info[0]['savename'].",".$fileext.",".str_replace(array(
				"\\", 
				"/"
			), "", $info[0]['name']);
			exit();
		}else{
			exit('0,'.$info);
		}
	}
	/**
	 * 资源上传
	 * @方法名：uploadzip
	 * @author wintrue
	 * @2013-11-26上午09:52:51
	 */
	private function uploadzip(){
		$info=upLoad('activityResource', explode('|', 'zip|7z'));
		if (is_array($info)){
			$aid=$_POST['order_p'];
			$activity=Activity::model()->findByPk($aid);
			if (!$activity||$activity->ghid!=gh()->ghid){
				$this->json_error('活动不存在！');
			}
			$res_name='res_'.$activity->type.'_'.$activity->aid.'.zip';
			$pu=Plugin::model()->findByAttributes(array(
				'ptype'=>$activity->type
			));
			if (!$pu){
				$this->json_error('插件不存在！');
			}
			@list ($addondir, $controller, $action)=explode('.', $pu->processor_class);
			$addon_path=ROOT_PATH.'/addons/'.$addondir.'/resources/';
			Yii::$enableIncludePath=false;
			Yii::import('ext.pclzip.pclzip', 1);
			$file=$info[0]['save_url'];
			// dump($info);exit;
			$archive=new PclZip($file);
			if ($archive->extract(PCLZIP_OPT_PATH, $addon_path.$aid) == 0) {
				$this->json_error($archive->errorInfo(true));
			}
			Yii::$enableIncludePath=true;
			$this->json_ok($info[0]['savename']);
		}else{
			$this->json_error($info);
		}
	}
}