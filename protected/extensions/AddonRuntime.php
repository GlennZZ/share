<?php

/**
* 插件机制核心类
* addonCore.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2015-3-11
* @author: wintrue <328945440@qq.com>
*/
class AddonRuntime extends Controller{
	public $layout='/layouts/main';
	public $controllerMap=array();
	protected $_addonName;
	protected $_controllerPath;
	protected $_controller;
	protected $controllerNamespace;
	function __construct(){
		parent::__construct($this->getAction(), $this->module);
		YiiBase::setPathOfAlias('addons', Yii::getPathOfAlias('webroot').'/addons/');
	}
	/**
	 * 重写redirect，使能在插件中正常使用
	 * @see CController::redirect()
	 */
	function redirect($url, $terminate=true, $statusCode=302){
		parent::redirect(Yii::app()->baseUrl.'/'.$_GET['_akey'].'/'.ltrim($url, '/'), $terminate, $statusCode);
	}
	/**
	 * 获取控制器路径
	 * @date: 2014-9-16
	 * @author : wintrue<328945440@qq.com>
	 */
	public function getControllerPath(){
		return $this->_controllerPath=YiiBase::getPathOfAlias("addons.".$this->_addonName);
	}
	/**
	 * 运行插件路径下的controller
	 * @date: 2014-9-16
	 * @author : wintrue<328945440@qq.com>
	 * @param url路径，pathInfo，支持路由，与YII中的用法一致 $route 
	 * @param 当前活动信息 $activity 
	 * @throws CHttpException
	 */
	public function runController($route, $activity){
		if (($ca=$this->createController($route))!==null){
			list ($controller, $actionID)=$ca;
			$oldController=$this->_controller;
			$this->_controller=$controller;
			$controller->init();
			if (strtotime($activity['starttime'])>time()){
				$controller->preStart();
			}
			if (!empty($activity['endtime'])){
				if (strtotime($activity['endtime'])<time()){
					$controller->preEnd();
				}
			}
			$controller->run($actionID);
			$this->_controller=$oldController;
		}else
			throw new CHttpException(404, Yii::t('yii', 'Unable to resolve the request "{route}".', array(
				'{route}'=>$route==='' ? $this->defaultController : $route
			)));
	}
	/**
	 * action参数处理
	 * @date: 2014-9-16
	 * @author : wintrue<328945440@qq.com>
	 * @param unknown_type $pathInfo 
	 */
	protected function parseActionParams($pathInfo){
		if (($pos=strpos($pathInfo, '/'))!==false){
			$manager=Yii::app()->getUrlManager();
			$manager->parsePathInfo((string) substr($pathInfo, $pos+1));
			$actionID=substr($pathInfo, 0, $pos);
			return $manager->caseSensitive ? $actionID : strtolower($actionID);
		}else
			return $pathInfo;
	}
	/**
	 * 创建controller
	 * @date: 2014-9-16
	 * @author : wintrue<328945440@qq.com>
	 * @param uri $route 
	 * @param
	 * $owner
	 */
	public function createController($route, $owner=null){
		if ($owner===null)
			$owner=$this;
		if (($route=trim($route, '/'))==='')
			$route=$owner->defaultController;
		$caseSensitive=Yii::app()->getUrlManager()->caseSensitive;
		$route.='/';
		while (($pos=strpos($route, '/'))!==false){
			$id=substr($route, 0, $pos);
			if (!preg_match('/^\w+$/', $id))
				return null;
			if (!$caseSensitive)
				$id=strtolower($id);
			$route=(string) substr($route, $pos+1);
			if (!isset($basePath)){
				if (isset($owner->controllerMap[$id])){
					return array(
						Yii::createComponent($owner->controllerMap[$id], $id, $owner===$this ? null : $owner), 
						$this->parseActionParams($route)
					);
				}
				if (($module=$owner->getModule($id))!==null)
					return $this->createController($route, $module);
				$basePath=$owner->getControllerPath();
				$controllerID='';
			}else
				$controllerID.='/';
			$className=ucfirst($id).'Controller';
			$classFile=$basePath.DIRECTORY_SEPARATOR.$className.'.php';
			if ($owner->controllerNamespace!==null)
				$className=$owner->controllerNamespace.'\\'.$className;
			if (is_file($classFile)){
				if (!class_exists($className, false))
					require ($classFile);
				if (class_exists($className, false)&&is_subclass_of($className, 'CController')){
					$id[0]=strtolower($id[0]);
					return array(
						new $className($controllerID.$id, $owner===$this ? null : $owner), 
						$this->parseActionParams($route)
					);
				}
				return null;
			}
			$controllerID.=$id;
			
			$basePath.=DIRECTORY_SEPARATOR.$id;
		}
	}
}