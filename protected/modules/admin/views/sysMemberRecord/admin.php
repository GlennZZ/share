<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sys-member-record-grid').yiiGridView('update', {
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

	<div style="padding-bottom: 10px">
		<a href="<?php echo $this->createUrl('/admin/SysMember/admin');?>" class="btn medium primary-bg ">
			<span class="button-content">
				<i class="glyph-icon icon-reply float-left "></i>
				返回
			</span>
		</a>
	</div>

	<!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sys-member-record-grid',
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
		//'uid',
		//'openid',
		
		//'fopenid',
		
		//'type',
		'integral',
		'note',
		//'aid',
		array('name'=>'分享的活动','value'=>'$data->act->name'),
		'fnickname',
		//'fheadimgurl',
		array(
			'name'=>'fheadimgurl',
			'value'=>'$data->fheadimgurl?CHtml::image($data->fheadimgurl,"",
				array(
				"height"=>150,
				"class"=>"medium radius-all-2",
			 	"onclick"=>"image_priview($(this).attr(\"src\"))",
				"style"=>"cursor: -webkit-zoom-in;"
				)
			):\'\'',  // 这里显示图片
			'type'=>'raw',  // 这里是原型输出
			'htmlOptions'=>array(
				'width'=>'200',
				'style'=>'text-align:center'
			)
		),
		'ctm',
		//'utm',
			/*array(
			'class' => 'CButtonColumn',
			'template' => '',
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
					'label' => '<i class="glyph-icon icon-cogs"></i>配置',
					'options' => array(
						'class' => 'ext-cbtn'
					),
					'url' => 'Yii::app()->getController()->createUrl("/pluginProp/config", array("aid"=>"xxx"))'
				)
			)
			
		)*/
	),
)); ?>
</div>
