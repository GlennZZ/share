<?php echo "<?php\n"; ?>
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#<?php echo $this->class2id($this->modelClass); ?>-grid').yiiGridView('update', {
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
		<a href="<?php echo "<?php echo \$this->createUrl('create');?>"; ?>" class="btn medium primary-bg ">
			<span class="button-content">
				<i class="glyph-icon icon-plus float-left "></i>
				添加
			</span>
		</a>
	</div>
	<div class="search-form">
<?php

echo "<?php \$this->renderPartial('_search',array(
	'model'=>\$model,
)); ?>\n";
?>
</div>
	<!-- search-form -->

<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
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
<?php
$count = 0;
foreach ($this->tableSchema->columns as $column) {
	if (++ $count == 7)
		echo "\t\t/*\n";
	echo "\t\t'" . $column->name . "',\n";
}
if ($count >= 7)
	echo "\t\t*/\n";
?>
			array(
			'class' => 'CButtonColumn',
			'template' => '{config}{view}{update}{delete}',
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
