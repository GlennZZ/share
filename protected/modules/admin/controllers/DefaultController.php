<?php

/**
* DefaultController.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2014-11-13
* @author: wintrue <328945440@qq.com>
*/
class DefaultController extends BaseController {
	public function actionIndex() {
		$this->renderPartial('index');
	}
}