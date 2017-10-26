<div class="explain-col">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array(
		'style' => 'margin: 0'
	),
)); ?>




	<?php echo $form->label($model,'openid'); ?>:
	<?php echo $form->textField($model,'openid',array('class'=>'input-text')); ?>



	<?php echo $form->label($model,'nickname'); ?>:
	<?php echo $form->textField($model,'nickname',array('class'=>'input-text')); ?>

	<?php echo $form->label($model,'sex'); ?>:
    <?php echo  $form->dropDownList($model,'sex', array(1=>'男',2=>'女'),array('empty'=>'全部'))?>

	<?php echo $form->label($model,'province'); ?>:
	<?php echo $form->textField($model,'province',array('class'=>'input-text')); ?>


	<?php echo $form->label($model,'city'); ?>:
	<?php echo $form->textField($model,'city',array('class'=>'input-text')); ?>

<!-- 
	<?php echo $form->label($model,'subscribe'); ?>:
	<?php echo $form->textField($model,'subscribe',array($htmlOptions)); ?>
 -->
	<button class="btn primary-bg medium" style="margin-left: 10px;">
		<span class="button-content">
			<i class="glyph-icon icon-search"></i>
			&nbsp;搜索
		</span>
	</button>

<?php $this->endWidget(); ?>

</div>
<!-- search-form -->
