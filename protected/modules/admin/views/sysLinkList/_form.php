
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sys-link-list-form',
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
			<label for=""><?php echo $form->labelEx($model,'webname'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo $form->textField($model,'webname',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>


	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'weburl'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo $form->textField($model,'weburl',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>


	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'img'); ?> </label>
		</div>
		<div class="form-input col-md-10">
		    <?php echo imageUpdoad(chtmlName($model, 'img'), $model->img,'img',array('id'=>'img'));?>
			
		</div>
	</div>
<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'listorder'); ?> </label>
		</div>
		<div class="form-input col-md-5">
			<?php echo $form->textField($model,'listorder',array($htmlOptions)); ?>
		</div>
	</div>
	<!-- 
	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'ispass'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo CHtml::switchButton(chtmlName($model, 'ispass'), $model->isNewRecord?1:$model->ispass,array(1=>'通过',0=>'未通过')); ?>
		</div>
	</div>
	 -->
<div class="divider"></div>
	<div class="form-row">
		<div class="form-input col-md-10 col-md-offset-2">
			<button class="btn primary-bg medium"
				onclick="javascript:return $('#sys-link-list-form').parsley( 'validate' );">
				<span class="button-content"><?php echo $model->isNewRecord ? '提交' : '保存'; ?>
</span>
			</button>
			<a
				href="javascript:return $('#sys-link-list-form').reset();"
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
