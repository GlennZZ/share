<?php
/* @var $this SysSlideController */
/* @var $model SysSlide */

$this->breadcrumbs=array(
	'Sys Slides'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SysSlide', 'url'=>array('index')),
	array('label'=>'Create SysSlide', 'url'=>array('create')),
	array('label'=>'Update SysSlide', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SysSlide', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysSlide', 'url'=>array('admin')),
);
?>

<h1>View SysSlide #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'note',
		'tpl',
		'width',
		'height',
		'num',
		'status',
	),
)); ?>
