<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sys-member-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="page-title">
	<h3>
		管理
		<small> <管理 </small>
	</h3>
</div>
<div id="page-content">

	<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>
	<!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sys-member-grid',
	'template' =>'<div class="content-box">
		<table class="table table-hover text-center">
			<tbody>{items}
			</tbody>
		</table>
	</div>
	<div class="summary" style="float: left;">{summary}</div>
	<div class="pager">{pager}</div>',
	'dataProvider'=>$model->search(),
	/*'ajaxUpdate'=>false,*/
	'enableHistory'=>true,
	/*'filter'=>$model,*/
	'columns'=>array(
		//'id',
		array(
			'name'=>'headimgurl',
			'value'=>'CHtml::image($data->headimgurl,"",
				array(
				"height"=>150,
				"class"=>"medium radius-all-2",
			 	"onclick"=>"image_priview($(this).attr(\"src\"))",
				"style"=>"cursor: -webkit-zoom-in;"
				)
			)',  // 这里显示图片
			'type'=>'raw',  // 这里是原型输出
			'htmlOptions'=>array(
				'width'=>'200',
				'style'=>'text-align:center'
			)
		),
		//'openid',
		/*'ghid',
		'srcOpenid',*/
		'nickname',
		array('name'=>'sex','value'=>'$data->sex==1?男:女'),
		'province',
		'city',
		'integral',
		/*'privilege',
		'accessToken',
		'refreshToken',
		'scope',*/
		'ctm',
		'utm',
		/*'expires',
		'ua',
		'channel',*/
		//array('name'=>'subscribe','value'=>'$data->subscribe==1?是:否'),

			array(
			'class' => 'CButtonColumn',
			'template' => '{config}{config2}',
			'viewButtonOptions' => array(
				'title' => '查看',
				'style' => 'padding:10px'
			),
			'updateButtonOptions' => array(
				'title' => '修改',
				'style' => 'padding:10px'
			),
			'header' => '管理操作',
			'htmlOptions' => array(
				"width" => '20%'
			),
			'buttons' => array(
				'delete' => array(
					'imageUrl' => null,
					'label' => '<i class="glyph-icon icon-remove"></i>删除',
					'options' => array(
						'class' => 'ext-cbtn delete tooltip-button',
						'title' => '',
						'data-original-title' => "编辑"
					)
				),
				'update' => array(
					'imageUrl' => null,
					'title' => '',
					'label' => '<i class="glyph-icon icon-edit"></i>编辑',
					'options' => array(
						'class' => 'ext-cbtn'
					)
				),
				'config' => array(
					'title' => '',
					'label' => '<i class="glyph-icon icon-gear"></i>积分记录',
					'options' => array(
						'class' => 'ext-cbtn'
					),
					'url' => 'Yii::app()->getController()->createUrl("/admin/SysMemberRecord/admin", array("openid"=>"$data->openid"))'
				),
				'config2' => array(
					'title' => '',
					'label' => '<i class="glyph-icon icon-gear"></i>提现记录',
					'options' => array(
						'class' => 'ext-cbtn'
					),
					'url' => 'Yii::app()->getController()->createUrl("/admin/SysWxredpackRecord/admin", array("openid"=>"$data->openid"))'
				)
			)

		)
	),
)); ?>
</div>
