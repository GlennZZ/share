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
	

	<?php echo $form->label($model,'unid'); ?>: &nbsp;
	<?php echo $form->dropDownList($model, 'unid',CHtml::listData(AppUni::model()->findAll(), 'id', 'name') ,array('data-trigger'=>"change", 'data-required'=>"true",'empty'=>'全部'));?>

<!--
	<?php echo $form->label($model,'type'); ?>: &nbsp;
	<?php echo $form->textField($model,'type',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'posid'); ?>: &nbsp;
	<?php echo $form->textField($model,'posid',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'clicks'); ?>: &nbsp;
	<?php echo $form->textField($model,'clicks',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'participation_num'); ?>: &nbsp;
	<?php echo $form->textField($model,'participation_num',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'participation_num_t'); ?>: &nbsp;
	<?php echo $form->textField($model,'participation_num_t',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'share_num'); ?>: &nbsp;
	<?php echo $form->textField($model,'share_num',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'share_num_t'); ?>: &nbsp;
	<?php echo $form->textField($model,'share_num_t',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'share_proportion'); ?>: &nbsp;
	<?php echo $form->textField($model,'share_proportion',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'share_proportion_t'); ?>: &nbsp;
	<?php echo $form->textField($model,'share_proportion_t',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'start_tm'); ?>: &nbsp;
	<?php echo $form->textField($model,'start_tm',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'stop_tm'); ?>: &nbsp;
	<?php echo $form->textField($model,'stop_tm',array($htmlOptions)); ?>
  -->
	
	<button class="btn primary-bg medium" style="margin-left: 50px;">
		<span class="button-content">查询</span>
	</button>

<?php $this->endWidget(); ?>

</div>
<!-- search-form -->
