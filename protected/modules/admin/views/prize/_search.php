<div class="explain-col">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array(
		'style' => 'margin: 0'
	),
)); ?>
	
	<?php echo $form->label($model,'id'); ?>:
	<?php echo $form->textField($model,'id',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'name'); ?>:
	<?php echo $form->textField($model,'name',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'img'); ?>:
	<?php echo $form->textField($model,'img',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'integral'); ?>:
	<?php echo $form->textField($model,'integral',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'unid'); ?>:
	<?php echo $form->textField($model,'unid',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'code'); ?>:
	<?php echo $form->textField($model,'code',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'status'); ?>:
	<?php echo $form->textField($model,'status',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'create_time'); ?>:
	<?php echo $form->textField($model,'create_time',array($htmlOptions)); ?>
	
	<button class="btn primary-bg medium" style="margin-left: 10px;">
		<span class="button-content">
			<i class="glyph-icon icon-search"></i>
			&nbsp;搜索
		</span>
	</button>

<?php $this->endWidget(); ?>

</div>
<!-- search-form -->
