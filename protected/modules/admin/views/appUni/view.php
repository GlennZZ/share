<?php
/* @var $this AppUniController */
/* @var $model AppUni */

$this->breadcrumbs=array(
	'App Unis'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List AppUni', 'url'=>array('index')),
	array('label'=>'Create AppUni', 'url'=>array('create')),
	array('label'=>'Update AppUni', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AppUni', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AppUni', 'url'=>array('admin')),
);
?>

<h1>View AppUni #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'ctm',
		'utm',
		'note',
	),
)); ?>
