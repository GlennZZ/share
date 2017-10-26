<?php
/* @var $this SysPosidController */
/* @var $model SysPosid */

$this->breadcrumbs=array(
	'Sys Posids'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SysPosid', 'url'=>array('index')),
	array('label'=>'Create SysPosid', 'url'=>array('create')),
	array('label'=>'Update SysPosid', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SysPosid', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysPosid', 'url'=>array('admin')),
);
?>

<h1>View SysPosid #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'listorder',
		'status',
	),
)); ?>
