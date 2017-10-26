<div class="explain-col">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array(
		'style' => 'margin: 0'
	),
)); ?>
	

	
	<?php echo $form->label($model,'keyword'); ?>: &nbsp;
	<?php echo $form->textField($model,'keyword',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'reurl'); ?>: &nbsp;
	<?php echo $form->textField($model,'reurl',array('class'=>'input-text')); ?>
	
	<button class="btn primary-bg medium" style="margin-left: 50px;">
		<span class="button-content">查询</span>
	</button>

<?php $this->endWidget(); ?>

</div>
<!-- search-form -->
