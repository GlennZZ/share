
<link rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/css/stat.css">
<?php
Yii::app()->clientScript->registerScript('search_detail', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#stat-data-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="page-title">
	<h3>
		统计
		<small> >>访问明细 </small>
	</h3>
</div>
<div id="page-content">

		<div class="search-form">
<div class="explain-col">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array(
		'style' => 'margin: 0'
	),
)); ?>
	

	<?php echo $form->label($model,'aid'); ?>: 
    <?php echo CHtml::dropDownList(chtmlName($model, 'aid'), $model->aid,CHtml::listData($this->getActList(), 'aid', 'title'),array('empty'=>'全部','style'=>"width:200px;") )?>

	<?php echo $form->label($model,'rtime'); ?>: 
	<?php echo calendar(chtmlName($model, 'rtime').'[1]',date('Y-m-d', strtotime("-2 day")), 'YYYY-MM-DD','180px');?>--
	<?php echo calendar(chtmlName($model, 'rtime').'[2]',date('Y-m-d'), 'YYYY-MM-DD','180px');?>
	
	<button class="btn primary-bg medium" style="margin-left: 50px;">
		<span class="button-content">查询</span>
	</button>

<?php $this->endWidget(); ?>

</div>
<!-- search-form -->
		
</div>
		<div class="row">
		
	</div>
	

	<!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'stat-data-grid',
	'template' =>'<div class="content-box">
		<table class="table table-hover text-center">
			<tbody>{items}
			</tbody>
		</table>
	</div>
	<div class="summary" style="float: left;">{summary}</div>
	<div class="pager">{pager}</div>',
	'dataProvider'=>$model->search_detail(),
	/*'filter'=>$model,*/
	'columns'=>array(
		    'title',
		    /*'id' => 'ID',*/
			/*'aid' ,*/
			/*'wxid' ,*/
			//'fromWxid',
			/*'ghid',*/
			/*'cid',*/
			/*'tid',*/
			
			'url' ,
			/*'ip' ,*/
			'pv' ,
			'screen',
			//'referrer',
			//'brv' ,
			'brvsub',
			/*'lg' ,*/
			'netType',
			'os' ,
			'osv' ,
			'mobile' ,
			/*'mobileName',*/
			/*'srcType',
			'logType',
			'shareType' ,*/
			/*'shareUrl',*/
			/*'country',*/
			/*'region',*/
			'city',
			'area',
			'isp',
			'rtime',
			/*'ua' => 'Ua',
			'realUrl'=>'真实URL',*/
	),
)); ?>
</div>



