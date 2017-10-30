<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#prize-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="page-title">
	<h3>
		奖品管理
		<small> <列表 </small>
	</h3>
</div>
<div id="page-content">

	<div style="padding-bottom: 10px">
		<a href="<?php echo $this->createUrl('create');?>" class="btn medium primary-bg ">
			<span class="button-content">
				<i class="glyph-icon icon-plus float-left "></i>
				添加
			</span>
		</a>
	</div>
	<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>
	<!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'prize-grid',
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
		'id',
		'name',

        array(
            'name'=>'图片',
            'value'=>'CHtml::image("$data->img","",
                    array(
                        "style"=>"height:120px;",
                        "class"=>"medium radius-all-2",
                        "onclick"=>"image_priview($(this).attr(\"src\"))"
                    )
                )',
            'type'=>'html'
        ),


		'integral',
//		'unid',
		'code',
		'num',
		/*
		'status',
		'create_time',
		*/
			array(
			'class' => 'CButtonColumn',
			'template' => '{update}{delete}',
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
			
		)
	),
)); ?>
</div>
