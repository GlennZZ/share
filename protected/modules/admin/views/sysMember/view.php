<?php
/* @var $this SysMemberController */
/* @var $model SysMember */

$this->breadcrumbs=array(
	'Sys Members'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SysMember', 'url'=>array('index')),
	array('label'=>'Create SysMember', 'url'=>array('create')),
	array('label'=>'Update SysMember', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SysMember', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysMember', 'url'=>array('admin')),
);
?>

<h1>View SysMember #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'openid',
		'ghid',
		'srcOpenid',
		'nickname',
		'sex',
		'province',
		'city',
		'headimgurl',
		'privilege',
		'accessToken',
		'refreshToken',
		'scope',
		'ctm',
		'utm',
		'expires',
		'ua',
		'channel',
		'subscribe',
	),
)); ?>
