<?php
/* @var $this AppDownController */
/* @var $model AppDown */

$this->breadcrumbs=array(
	'App Downs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List AppDown', 'url'=>array('index')),
	array('label'=>'Create AppDown', 'url'=>array('create')),
	array('label'=>'Update AppDown', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AppDown', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AppDown', 'url'=>array('admin')),
);
?>

<h1>View AppDown #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'unid',
		'name',
		'size',
		'ver',
		'icon',
		'imgs',
		'desc',
		'ios_url',
		'andriod_url',
		'dowm_num',
		'clicks',
		'ctm',
		'utm',
		'uid',
		'company',
		'type',
		'status',
	),
)); ?>
