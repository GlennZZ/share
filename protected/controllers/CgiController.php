<?php

class CgiController extends WapBController{
	public function actionHot(){
		$id=intval($_POST['id']);
		$model=$_POST['_mo'];
		switch ($model){
			case 1:
				Yii::app()->db->createCommand('update app_game set clicks=clicks+1 where id='.$id)->query();
				break;
			case 2:
				Yii::app()->db->createCommand('update app_down set dowm_num=dowm_num+1 where id='.$id)->query();
				break;
		}
	}
}