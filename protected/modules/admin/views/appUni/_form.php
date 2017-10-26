<!-- form -->
<div class="form">
<?php

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'app-uni-form', 
	'htmlOptions'=>array(
		'class'=>'col-md-8 center-margin'
	), 
	'enableAjaxValidation'=>false
));
?>
<div class="infobox warning-bg" id='msgtip' style='display: none'>
		<p>
			<i class="glyph-icon icon-exclamation mrg10R"></i><?php echo $form->errorSummary($model); ?>
</p>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'name'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'note'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textArea($model,'note',array('size'=>60,'maxlength'=>255,'style'=>'height:200px')); ?>
		</div>
	</div>
	<div class="button-pane text-center">
		<button onclick="return $('#app-uni-form').parsley( 'validate' );" type="submit" class="btn medium primary-bg text-transform-upr font-size-11" id="demo-form-valid" title="Validate!">
			<span class="button-content">
				<i class="glyph-icon <?php echo $model->isNewRecord ? 'icon-plus' : 'icon-save'; ?> float-left"></i>
				<?php echo $model->isNewRecord ? '提交' : '保存'; ?>
			</span>
		</button>
		<button  type="reset" class="btn medium primary-bg text-transform-upr font-size-11" id="demo-form-valid" title="Validate!">
			<span class="button-content">
				<i class="glyph-icon icon-undo float-left"></i>
				取消
			</span>
		</button>
		
	</div>
<?php $this->endWidget(); ?>
</div>
<!-- form -->
