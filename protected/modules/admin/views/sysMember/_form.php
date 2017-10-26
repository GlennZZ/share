<!-- form -->
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sys-member-form',
	'htmlOptions' =>array('class' => 'col-md-8 center-margin'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="infobox warning-bg" id='msgtip' style='display: none'>
	<p><i class="glyph-icon icon-exclamation mrg10R"></i><?php echo $form->errorSummary($model); ?>
</p>
</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'openid'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'openid',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'ghid'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'ghid',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'srcOpenid'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'srcOpenid',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'nickname'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'nickname',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'sex'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'sex',array('size'=>2,'maxlength'=>2,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'province'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'province',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'city'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'city',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'headimgurl'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'headimgurl',array('size'=>60,'maxlength'=>500,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'privilege'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'privilege',array('size'=>60,'maxlength'=>100,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'accessToken'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'accessToken',array('size'=>60,'maxlength'=>200,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'refreshToken'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'refreshToken',array('size'=>60,'maxlength'=>200,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'scope'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'scope',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
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

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'expires'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'expires',array($htmlOptions)); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'ua'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'ua',array('size'=>60,'maxlength'=>500,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'channel'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'channel',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'subscribe'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'subscribe',array($htmlOptions)); ?>
		</div>
	</div>

<div class="button-pane text-center">
		<button onclick="return $('#sys-member-form').parsley( 'validate' );" type="submit" class="btn medium primary-bg text-transform-upr font-size-11" id="demo-form-valid" title="Validate!">
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
