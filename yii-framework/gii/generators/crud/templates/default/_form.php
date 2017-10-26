<!-- form -->
<div class="form">
<?php
echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'" . $this->class2id($this->modelClass) . "-form',
	'htmlOptions' =>array('class' => 'col-md-8 center-margin'),
	'enableAjaxValidation'=>false,
)); ?>\n";
?>
<div class="infobox warning-bg" id='msgtip' style='display: none'>
	<p><i class="glyph-icon icon-exclamation mrg10R"></i><?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?></p>
</div>
<?php
foreach ($this->tableSchema->columns as $column) {
	if ($column->autoIncrement)
		continue;
	?>

	<div class="form-row">
		<div class="form-label col-md-2">
			<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>"; ?> 
		</div>
		<div class="form-input col-md-8">
			<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
		</div>
	</div>
<?php
}
?>

<div class="button-pane text-center">
		<button onclick="return $('#<?php echo $this->class2id($this->modelClass);?>-form').parsley( 'validate' );" type="submit" class="btn medium primary-bg text-transform-upr font-size-11" id="demo-form-valid" title="Validate!">
			<span class="button-content">
				<i class="glyph-icon <?php echo "<?php echo \$model->isNewRecord ? 'icon-plus' : 'icon-save'; ?>"; ?> float-left"></i>
				<?php echo "<?php echo \$model->isNewRecord ? '提交' : '保存'; ?>\n"; ?>
			</span>
		</button>
		<button  type="reset" class="btn medium primary-bg text-transform-upr font-size-11" id="demo-form-valid" >
			<span class="button-content">
				<i class="glyph-icon icon-undo float-left"></i>
				重置
			</span>
		</button>
</div>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
</div>
<!-- form -->
