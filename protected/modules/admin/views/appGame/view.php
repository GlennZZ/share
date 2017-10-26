<?php
/* @var $this AppGameController */
/* @var $model AppGame */

$this->breadcrumbs=array(
	'App Games'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List AppGame', 'url'=>array('index')),
	array('label'=>'Create AppGame', 'url'=>array('create')),
	array('label'=>'Update AppGame', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AppGame', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AppGame', 'url'=>array('admin')),
);
?>

<h1>View AppGame #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'desc',
		'icon',
		'url',
		'classify',
		'area',
		'company',
		'prize_name',
		'recommend_type',
		'category',
		'type',
		'posid',
		'clicks',
		'participation_num',
		'participation_num_t',
		'share_num',
		'share_num_t',
		'share_proportion',
		'share_proportion_t',
		'start_tm',
		'stop_tm',
		'ctm',
		'utm',
	),
)); ?>
