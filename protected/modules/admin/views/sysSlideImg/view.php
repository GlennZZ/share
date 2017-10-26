<?php
/* @var $this SysSlideImgController */
/* @var $model SysSlideImg */

$this->breadcrumbs=array(
	'Sys Slide Imgs'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SysSlideImg', 'url'=>array('index')),
	array('label'=>'Create SysSlideImg', 'url'=>array('create')),
	array('label'=>'Update SysSlideImg', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SysSlideImg', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysSlideImg', 'url'=>array('admin')),
);
?>

<h1>View SysSlideImg #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sid',
		'pic',
		'title',
		'url',
		'note',
		'minpic',
		'listorder',
	),
)); ?>
