<?php
/* @var $this SysWxredpackRecordController */
/* @var $model SysWxredpackRecord */

$this->breadcrumbs=array(
	'Sys Wxredpack Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SysWxredpackRecord', 'url'=>array('index')),
	array('label'=>'Create SysWxredpackRecord', 'url'=>array('create')),
	array('label'=>'Update SysWxredpackRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SysWxredpackRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysWxredpackRecord', 'url'=>array('admin')),
);
?>

<h1>View SysWxredpackRecord #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'appid',
		'mchid',
		'billno',
		'proveName',
		'sendName',
		're_openid',
		'money',
		'wishing_words',
		'ext_info',
		'statue',
		'msg',
		'ip',
		'ua',
		'ctm',
		'utm',
	),
)); ?>
