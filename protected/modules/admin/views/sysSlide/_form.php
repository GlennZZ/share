
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sys-slide-form',
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
			<label for=""><?php echo $form->labelEx($model,'name'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo $form->textField($model,'name',array('size'=>25,'maxlength'=>25,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>


	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'note'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo $form->textField($model,'note',array('size'=>60,'maxlength'=>255,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

<!-- 
	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'tpl'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo $form->textField($model,'tpl',array('size'=>30,'maxlength'=>30,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>


	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'width'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo $form->textField($model,'width',array($htmlOptions)); ?>
		</div>
	</div>


	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'height'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo $form->textField($model,'height',array($htmlOptions)); ?>
		</div>
	</div>


	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'num'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo $form->textField($model,'num',array($htmlOptions)); ?>
		</div>
	</div>

 -->
	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'status'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo CHtml::switchButton(chtmlName($model, 'status'), $model->isNewRecord?1:$model->status,array(1=>'启用',0=>'禁用')); ?>
		</div>
	</div>

<div class="divider"></div>
	<div class="form-row">
		<div class="form-input col-md-10 col-md-offset-2">
			<button class="btn primary-bg medium"
				onclick="javascript:return $('#sys-slide-form').parsley( 'validate' );">
				<span class="button-content"><?php echo $model->isNewRecord ? '提交' : '保存'; ?>
</span>
			</button>
			<a
				href="javascript:return $('#sys-slide-form').reset();"
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
