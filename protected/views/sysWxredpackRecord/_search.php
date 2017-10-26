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
	
	
	<?php echo $form->label($model,'appid'); ?>:
	<?php echo $form->textField($model,'appid',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'mchid'); ?>:
	<?php echo $form->textField($model,'mchid',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'billno'); ?>:
	<?php echo $form->textField($model,'billno',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'proveName'); ?>:
	<?php echo $form->textField($model,'proveName',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'sendName'); ?>:
	<?php echo $form->textField($model,'sendName',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'re_openid'); ?>:
	<?php echo $form->textField($model,'re_openid',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'money'); ?>:
	<?php echo $form->textField($model,'money',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'wishing_words'); ?>:
	<?php echo $form->textField($model,'wishing_words',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'ext_info'); ?>:
	<?php echo $form->textField($model,'ext_info',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'statue'); ?>:
	<?php echo $form->textField($model,'statue',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'msg'); ?>:
	<?php echo $form->textField($model,'msg',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'ip'); ?>:
	<?php echo $form->textField($model,'ip',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'ua'); ?>:
	<?php echo $form->textField($model,'ua',array('class'=>'input-text')); ?>
	
	
	<?php echo $form->label($model,'ctm'); ?>:
	<?php echo $form->textField($model,'ctm',array($htmlOptions)); ?>
	
	
	<?php echo $form->label($model,'utm'); ?>:
	<?php echo $form->textField($model,'utm',array($htmlOptions)); ?>
	
	<button class="btn primary-bg medium" style="margin-left: 10px;">
		<span class="button-content">
			<i class="glyph-icon icon-search"></i>
			&nbsp;搜索
		</span>
	</button>

<?php $this->endWidget(); ?>

</div>
<!-- search-form -->
