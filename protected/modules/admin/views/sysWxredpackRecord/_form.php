<!-- form -->
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sys-wxredpack-record-form',
	'htmlOptions' =>array('class' => 'col-md-8 center-margin'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="infobox warning-bg" id='msgtip' style='display: none'>
	<p><i class="glyph-icon icon-exclamation mrg10R"></i><?php echo $form->errorSummary($model); ?>
</p>
</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'appid'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'appid',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'mchid'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'mchid',array('size'=>15,'maxlength'=>15,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'billno'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'billno',array('size'=>30,'maxlength'=>30,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'proveName'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'proveName',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'sendName'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'sendName',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'re_openid'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'re_openid',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'money'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'money',array($htmlOptions)); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'wishing_words'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'wishing_words',array('size'=>60,'maxlength'=>150,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'ext_info'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'ext_info',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'statue'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'statue',array($htmlOptions)); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'msg'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'msg',array('size'=>60,'maxlength'=>100,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'ip'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'ip',array('size'=>20,'maxlength'=>20,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'ua'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'ua',array('size'=>60,'maxlength'=>250,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'ctm'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'ctm',array($htmlOptions)); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'utm'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'utm',array($htmlOptions)); ?>
		</div>
	</div>

<div class="button-pane text-center">
		<button onclick="return $('#sys-wxredpack-record-form').parsley( 'validate' );" type="submit" class="btn medium primary-bg text-transform-upr font-size-11" id="demo-form-valid" title="Validate!">
			<span class="button-content">
				<i class="glyph-icon <?php echo $model->isNewRecord ? 'icon-plus' : 'icon-save'; ?> float-left"></i>
				<?php echo $model->isNewRecord ? '提交' : '保存'; ?>
			</span>
		</button>
		<button  type="reset" class="btn medium primary-bg text-transform-upr font-size-11" id="demo-form-valid" >
			<span class="button-content">
				<i class="glyph-icon icon-undo float-left"></i>
				重置
			</span>
		</button>
</div>
<?php $this->endWidget(); ?>
</div>
<!-- form -->
