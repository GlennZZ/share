
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sys-slide-img-form',
	'htmlOptions' =>array('class' => 'col-md-10 center-margin'),
	'enableAjaxValidation'=>false,
)); ?>

<div class="infobox warning-bg" id='msgtip' style='display: none'>
		<p>
			<i class="glyph-icon icon-exclamation mrg10R"></i><?php echo $form->errorSummary($model); ?>
</p>
	</div>

	<?php 
	if($model->isNewRecord){
		echo  CHtml::hiddenField(chtmlName($model, 'sid'),intval($_GET['sid']));
	}else{
		echo  $form->hiddenField($model,'sid');
	}
	?>

	


	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'title'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>


	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'url'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>200,'class'=>'col-md-6 float-left')); ?>
		</div>
	</div>


	
	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'pic'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo imageUpdoad(chtmlName($model, 'pic'), $model->pic,'pic',array('id'=>'pic'));?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'minpic'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			  <?php echo imageUpdoad(chtmlName($model, 'minpic'), $model->minpic,'minpic',array('id'=>'minpic'));?>
		</div>
	</div>
<div class="form-row">
		<div class="form-label col-md-2">
			<label for=""><?php echo $form->labelEx($model,'note'); ?> </label>
		</div>
		<div class="form-input col-md-10">
			<?php echo $form->textarea($model,'note',array('class'=>'col-md-6 float-left','style'=>'height:200px')); ?>
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

<div class="divider"></div>
	<div class="form-row">
		<div class="form-input col-md-10 col-md-offset-2">
			<button class="btn primary-bg medium"
				onclick="javascript:return $('#sys-slide-img-form').parsley( 'validate' );">
				<span class="button-content"><?php echo $model->isNewRecord ? '提交' : '保存'; ?>
</span>
			</button>
			<a
				href="javascript:return $('#sys-slide-img-form').reset();"
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
