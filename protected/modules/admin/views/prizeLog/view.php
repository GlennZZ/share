<?php
/* @var $this PrizeLogController */
/* @var $model PrizeLog */

$this->breadcrumbs=array(
	'Prize Logs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List PrizeLog', 'url'=>array('index')),
	array('label'=>'Create PrizeLog', 'url'=>array('create')),
	array('label'=>'Update PrizeLog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PrizeLog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PrizeLog', 'url'=>array('admin')),
);
?>

<h1>View PrizeLog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'unid',
		'name',
		'pid',
		'create_time',
	),
)); ?>
