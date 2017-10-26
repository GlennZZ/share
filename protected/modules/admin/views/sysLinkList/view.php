<?php
/* @var $this SysLinkListController */
/* @var $model SysLinkList */

$this->breadcrumbs=array(
	'Sys Link Lists'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SysLinkList', 'url'=>array('index')),
	array('label'=>'Create SysLinkList', 'url'=>array('create')),
	array('label'=>'Update SysLinkList', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SysLinkList', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysLinkList', 'url'=>array('admin')),
);
?>

<h1>View SysLinkList #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'listorder',
		'webname',
		'weburl',
		'ispass',
		'img',
	),
)); ?>
