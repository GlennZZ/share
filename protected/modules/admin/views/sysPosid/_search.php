<div class="explain-col">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array(
		'style' => 'margin: 0'
	),
)); ?>
	

	<?php echo $form->label($model,'name'); ?>: &nbsp;
	<?php echo $form->textField($model,'name',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'listorder'); ?>: &nbsp;
	<?php echo $form->textField($model,'listorder',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'status'); ?>: &nbsp;
	<?php echo CHtml::dropDownList(chtmlName($model, 'status'), $model->status, array('1'=>'启用',0=>'禁用'),array('empty'=>'全部')) ?>
	
	<button class="btn primary-bg medium" style="margin-left: 50px;">
		<span class="button-content">查询</span>
	</button>

<?php $this->endWidget(); ?>

</div>
<!-- search-form -->
