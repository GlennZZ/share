<div class="explain-col">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array(
		'style' => 'margin: 0'
	),
)); ?>
	

	
	<?php echo $form->label($model,'unid'); ?>: &nbsp;
	<?php echo $form->dropDownList($model, 'unid', CHtml::listData(AppUni::model()->findAll(),  'id','name'),array('data-trigger'=>"change", 'data-required'=>"true",'empty'=>'全部'));?>
	
	
	<?php echo $form->label($model,'name'); ?>: &nbsp;
	<?php echo $form->textField($model,'name',array('class'=>'input-text')); ?>
	
	

<!-- 
	<?php echo $form->label($model,'ctm'); ?>: &nbsp;
	<?php echo $form->textField($model,'ctm',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'utm'); ?>: &nbsp;
	<?php echo $form->textField($model,'utm',array($htmlOptions)); ?>
 -->	
	
	
	

	
	
	
	<?php echo $form->label($model,'status'); ?>: &nbsp;
	<?php echo $form->dropDownList($model, 'status', array(1=>'上架',0=>'下架'),array('data-trigger'=>"change", 'data-required'=>"true",'empty'=>'全部')); ?>
	
	<button class="btn primary-bg medium" style="margin-left: 50px;">
		<span class="button-content">查询</span>
	</button>

<?php $this->endWidget(); ?>

</div>
<!-- search-form -->
