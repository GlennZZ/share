<!-- form -->
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'app-game-form',
	'htmlOptions' =>array('class' => 'col-md-8 center-margin'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="infobox warning-bg" id='msgtip' style='display: none'>
	<p><i class="glyph-icon icon-exclamation mrg10R"></i><?php echo $form->errorSummary($model); ?>
</p>
</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'unid'); ?> 
		</div>
		<div class="form-input col-md-8">
			
			<?php echo $form->dropDownList($model, 'unid', CHtml::listData(AppUni::model()->findAll(),  'id','name'),array('data-trigger'=>"change", 'data-required'=>"true",'empty'=>'请选择商户'));?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'name'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100,'data-trigger'=>"change", 'data-required'=>"true",'empty'=>'请输入游戏名称')); ?>
		</div>
	</div>
<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'url'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>150, 'data-required'=>"true",'empty'=>'请输入游戏链接')); ?>
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
			<?php echo $form->labelEx($model,'note'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textArea($model,'note',array('rows'=>2, 'cols'=>50)); ?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'desc'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo ueditor(chtmlName($model, 'desc'), $model->desc, $id='desc', '', $height=200, $config='');; ?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'desc1'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo ueditor(chtmlName($model, 'desc1'), $model->desc1, $id='desc1', '', $height=200, $config='');; ?>
		</div>
	</div>

	
		<!--  
<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'posid'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo CHtml::multipleListButton(chtmlName($model, 'posid'), $model->isNewRecord?0:explode(',', $model->posid), CHtml::listData(SysPosid::model()->findAllByAttributes(array('status'=>1)), 'id', 'name'),array('data-trigger'=>"change", 'data-required'=>"true"))?>
		</div>
	</div>



<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'classify'); ?>
		</div>
		<div class="form-input col-md-8">

			<?php echo $form->dropDownList($model, 'classify', Yii::app()->params['classify'],array('data-trigger'=>"change", 'data-required'=>"true"));?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'classify_text'); ?>
		</div>
		<div class="form-input col-md-8">

			<?php echo $form->textField($model,'classify_text');?>
			
		</div>
	</div>

			
<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'area'); ?>
		</div>
		<div class="form-input col-md-8">

			<?php echo $form->dropDownList($model, 'area', CHtml::listData($this->getAreaList(),  'id','title'),array('data-trigger'=>"change", 'data-required'=>"true",'empty'=>'请选择地区'));?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'company'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>150)); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'prize_name'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'prize_name',array('size'=>50,'maxlength'=>50)); ?>
		</div>
	</div>

			
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'company'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>150)); ?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'prize_name'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'prize_name',array('size'=>50,'maxlength'=>50)); ?>
		</div>
	</div>

			


	<?php echo CHtml::hiddenField(chtmlName($model, 'category'),$model->isNewRecord?intval($_GET['category']):$model->category); ?>



	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'type'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'type',array($htmlOptions)); ?>
		</div>
	</div>


 -->

	<?php if($model->isNewRecord){?>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'integral_all'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'integral_all',array($htmlOptions)); ?>
		</div>
	</div>
	<?php }?>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'integral_limit'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'integral_limit',array($htmlOptions)); ?>
			<p>限制单个用户能获取的最大积分,0代表不限制</p>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'integral_self'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'integral_self',array($htmlOptions)); ?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'integral_share'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'integral_share',array($htmlOptions)); ?>
			<p>好友帮点击分享连接，发起分享的用户可获取的积分数</p>
		</div>
	</div>
	
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'clicks'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'clicks',array($htmlOptions)); ?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'promote'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'promote',array($htmlOptions)); ?>
		</div>
	</div>
<!--  
	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'participation_num'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'participation_num',array($htmlOptions)); ?>
		</div>
	</div>


	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'share_num'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'share_num',array($htmlOptions)); ?>
		</div>
	</div>


	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'share_proportion'); ?>
		</div>
		<div class="form-input col-md-8">
			<?php echo $form->textField($model,'share_proportion',array($htmlOptions)); ?>
		</div>
	</div>
	 -->

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'start_tm'); ?>
		</div>
		<div class="form-input col-md-8">

			<?php echo calendar(chtmlName($model, 'start_tm'),$model->isNewRecord?time():$model->start_tm);?>
		</div>
	</div>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'stop_tm'); ?>
		</div>
		<div class="form-input col-md-8">

			<?php echo calendar(chtmlName($model, 'stop_tm'),$model->isNewRecord?'':$model->stop_tm);?>
		</div>
	</div>




<div class="button-pane text-center">
		<button onclick="return $('#app-game-form').parsley( 'validate' );" type="submit" class="btn medium primary-bg text-transform-upr font-size-11" id="demo-form-valid" title="Validate!">
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
