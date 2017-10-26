<!-- form -->
<div class="form">
<?php

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'app-down-form', 
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
			<?php echo $form->labelEx($model,'unid'); ?> 
		</div>
		<div class="form-input col-md-8">
			
			<?php echo $form->dropDownList($model, 'unid', CHtml::listData(AppUni::model()->findAll(),  'id','name'),array('data-trigger'=>"change", 'data-required'=>"true",'empty'=>'请选择应用标记'));?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'name'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>150,'data-trigger'=>"change", 'data-required'=>"true")); ?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'size'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'size',array($htmlOptions)); ?>
			<P>请加上单位M或者k,如1.2M</P>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'ver'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'ver',array('size'=>20,'maxlength'=>20,'class'=>'')); ?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'icon'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo imageUpdoad(chtmlName($model, 'icon'), $model->icon,'icon',array('id'=>'icon','data-trigger'=>"change", 'data-required'=>"true"));?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'imgs'); ?> 
		</div>
		<div class="form-input col-md-8">
			
			
			<?php echo muimageUpload('imgs',$model->imgs);?>
		</div>
	</div>
	
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'ios_url'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'ios_url',array('size'=>60,'maxlength'=>200,'class'=>'')); ?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'andriod_url'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'andriod_url',array('size'=>60,'maxlength'=>200,'class'=>'')); ?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'desc'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
		</div>
	</div>
	<!-- 
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'company'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>100,'class'=>'')); ?>
		</div>
	</div>
	 -->
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'status'); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo CHtml::switchButton(chtmlName($model, 'status'), $model->isNewRecord?1:$model->status,array(1=>'上架',0=>'下架')); ?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo CHtml::label('下架所有旧版本', ''); ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo CHtml::switchButton('down_old', $model->isNewRecord?1:0,array(1=>'YES',0=>'NO')); ?>
		</div>
	</div>
	<div class="button-pane text-center">
		<button onclick="javascript:return $('#app-down-form').parsley( 'validate' );" type="submit" class="btn medium primary-bg text-transform-upr font-size-11" id="demo-form-valid" title="Validate!">
			<span class="button-content">
				<i class="glyph-icon <?php echo $model->isNewRecord ? 'icon-plus' : 'icon-save'; ?>
 float-left"></i>
				<?php echo $model->isNewRecord ? '提交' : '保存'; ?>
			</span>
		</button>
		<a href="javascript:return $('#app-down-form').reset();" class="btn medium primary-bg">
			<span class="button-content">
				<i class="glyph-icon icon-undo float-left"></i>
				取消
			</span>
		</a>
	</div>
<?php $this->endWidget(); ?>
</div>
<!-- form -->
