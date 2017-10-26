
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sys-word-list-form',
	'htmlOptions' =>array('class' => 'col-md-10 center-margin'),
	'enableAjaxValidation'=>false,
)); ?>

<div class="infobox warning-bg" id='msgtip' style='display: none'>
		<p>
			<i class="glyph-icon icon-exclamation mrg10R"></i><?php echo $form->errorSummary($model); ?>
</p>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'keyword'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo $form->textField($model,'keyword',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>


	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'reurl'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo $form->textField($model,'reurl',array('size'=>60,'maxlength'=>255,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

<div class="divider"></div>
	<div class="form-row">
		<div class="form-input col-md-10 col-md-offset-2">
			<button class="btn primary-bg medium"
				onclick="javascript:return $('#sys-word-list-form').parsley( 'validate' );">
				<span class="button-content"><?php echo $model->isNewRecord ? '提交' : '保存'; ?>
</span>
			</button>
			<a
				href="javascript:return $('#sys-word-list-form').reset();"
				class="btn medium primary-bg">
				<span class="button-content">
					<i class="glyph-icon icon-undo float-left"></i>
					取消
				</span>
			</a>
		</div>
	</div>
<?php $this->endWidget(); ?>

</div>
<!-- form -->
