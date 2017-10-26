<?php
/* @var $this SysWordListController */
/* @var $model SysWordList */

$this->breadcrumbs=array(
	'Sys Word Lists'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SysWordList', 'url'=>array('index')),
	array('label'=>'Create SysWordList', 'url'=>array('create')),
	array('label'=>'Update SysWordList', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SysWordList', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysWordList', 'url'=>array('admin')),
);
?>

<h1>View SysWordList #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'keyword',
		'reurl',
	),
)); ?>
