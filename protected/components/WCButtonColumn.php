<?php

/**
* WCButtonColumn.php
* ----------------------------------------------
* 版权所有 2014-2015 联众互动
* ----------------------------------------------
* @date: 2014-12-15
* @author: wintrue <328945440@qq.com>
*/
class WCButtonColumn extends CButtonColumn{
	public $buttons=array(
		'delete'=>array(
			'imageUrl'=>null, 
			'label'=>'<i class="glyph-icon icon-remove"></i>删除', 
			'options'=>array(
				'class'=>'ext-cbtn delete tooltip-button', 
				'title'=>'', 
				'data-original-title'=>"删除"
			)
		), 
		'update'=>array(
			'imageUrl'=>null, 
			'label'=>'<i class="glyph-icon icon-edit"></i>编辑', 
			'options'=>array(
				'class'=>'ext-cbtn',
				'title'=>'',
				'data-original-title'=>"编辑"
			)
		), 
		'link'=>array(
			'imageUrl'=>null, 
			'label'=>'<i class="glyph-icon icon-paperclip"></i>链接', 
			'url'=>' "javascript:showlink(\'".Yii::app()->params["addonUrl"]."qrcode/".createQRC($data->akey,Yii::app()->params["addonUrl"].$data->akey,$type=1)."\',\'".Yii::app()->params["addonUrl"].$data->akey."\');"',
			'options'=>array(
				'class'=>'link ext-cbtn tooltip-button',
				'title'=>'',
				'data-original-title'=>"链接"
			)
		)
		, 
		'copy'=>array(
			'imageUrl'=>null,
			'label'=>'<i class="glyph-icon icon-copy"></i>克隆',
			'url'=>' "javascript:copy(\'".Yii::app()->createUrl("/activity/copy", array("id"=>$data->aid))."\');"',
			'options'=>array(
				'class'=>'link ext-cbtn tooltip-button',
				'title'=>'',
				'data-original-title'=>"克隆"
			)
		)
		,
		'view_'=>array(
			'imageUrl'=>null,
			'label'=>'<i class="glyph-icon icon-eye-open"></i>预览',
			'url'=>' "javascript:view_(\'". Yii::app()->params["addonUrl"]."/".$data->akey."?debug-wintrue=1\');"',
			'options'=>array(
				'class'=>'link ext-cbtn tooltip-button',
				'title'=>'',
				'data-original-title'=>"预览"
			)
		)
		,
		'config'=>array(
			'label'=>'<i class="glyph-icon icon-cogs"></i>配置', 
			'options'=>array(
				'class'=>'ext-cbtn tooltip-button',
				'title'=>'',
				'data-original-title'=>"配置"
			), 
			'url'=>'Yii::app()->createUrl("/pluginProp/config", array("aid"=>$data->aid))'
		)
	)
	;
	public $template='{link}{config}{copy}{update}{view_}{delete}';
	function getButtons($data){
		$addtpl='';
		$addbtn=array();
		$setting=unserialize($data->plugin->setting);
		$sn=$setting['sn'];
		$prize=$setting['prize'];
		if ($sn){
			$addtpl.='{sn}';
			$addbtn['sn']=array(
				'label'=>'<i class="glyph-icon icon-cogs"></i>SN配置', 
				'options'=>array(
					'class'=>'ext-cbtn tooltip-button',
					'title'=>'',
					'data-original-title'=>"SN配置"
				), 
				'url'=>'Yii::app()->createUrl("/commonSn/admin", array("aid"=>$data->aid))'
			);
		}else{
			
		}
		if($prize){
			$addtpl.='{prize}';
			$addbtn['prize']=array(
				'label'=>'<i class="glyph-icon icon-cogs"></i>奖品配置',
				'options'=>array(
					'class'=>'ext-cbtn tooltip-button',
					'title'=>'',
					'data-original-title'=>"奖品配置"
				),
				'url'=>'Yii::app()->createUrl("/commonPrize/admin", array("aid"=>$data->aid))'
			);
		}else{
			
		}
		$template=$addtpl.$this->template;
		$buttons=array_merge($this->buttons,$addbtn);
		unset($addbtn);unset($addtpl);
		return array($template,$buttons);
	
	}
	protected function renderDataCellContent($row, $data){
		list($template,$buttons)=$this->getButtons($data);
		$tr=array();
		ob_start();
		foreach ($buttons as $id=>$button){
			$this->renderButton($id, $button, $row, $data);
			$tr['{'.$id.'}']=ob_get_contents();
			ob_clean();
		}
		ob_end_clean();
		echo strtr($template, $tr);
	}
	
}
