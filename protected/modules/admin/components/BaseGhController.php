<?php

/**
* BaseController.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2014-11-18
* @author: wintrue <328945440@qq.com>
*/
class BaseGhController extends BaseController{
	function init() {
		parent::init();
		if (! gh()->ghid) {
			$this->error('请先绑定公众号!');
		}
		
	}
	
}