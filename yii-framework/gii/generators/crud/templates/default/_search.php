<div class="explain-col">
<?php
echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl(\$this->route),
	'method'=>'get',
	'htmlOptions' => array(
		'style' => 'margin: 0'
	),
)); ?>\n";
?>
<?php foreach($this->tableSchema->columns as $column): ?>
<?php

	$field=$this->generateInputField($this->modelClass, $column);
	if (strpos($field, 'password')!==false)
		continue;
	?>
	
	<?php echo "<?php echo \$form->label(\$model,'{$column->name}'); ?>:\n"; ?>
	<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column,"'class'=>'input-text'",false)."; ?>\n"; ?>
	
<?php endforeach; ?>
	<button class="btn primary-bg medium" style="margin-left: 10px;">
		<span class="button-content">
			<i class="glyph-icon icon-search"></i>
			&nbsp;搜索
		</span>
	</button>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div>
<!-- search-form -->
