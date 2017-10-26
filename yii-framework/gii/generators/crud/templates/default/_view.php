<div id="page-title">
	<h3>
		内容
		<small> >>详细内容 </small>
	</h3>
</div>
<div id="page-content">

	<div style="padding-bottom: 10px">
		<a href="<?php echo "<?php echo\$this->createUrl('admin');?>"; ?>" class="btn medium primary-bg ">
			<span class="button-content">
				<i class="glyph-icon icon-reply float-left "></i>
				返回
			</span>
		</a>
	</div>


<?php
echo "\t<b><?php echo CHtml::encode(\$data->getAttributeLabel('{$this->tableSchema->primaryKey}')); ?>:</b>\n";
echo "\t<?php echo CHtml::link(CHtml::encode(\$data->{$this->tableSchema->primaryKey}), array('view', 'id'=>\$data->{$this->tableSchema->primaryKey})); ?>\n\t<br />\n\n";
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if($column->isPrimaryKey)
		continue;
	if(++$count==7)
		echo "\t<?php /*\n";
	echo "\t<b><?php echo CHtml::encode(\$data->getAttributeLabel('{$column->name}')); ?>:</b>\n";
	echo "\t<?php echo CHtml::encode(\$data->{$column->name}); ?>\n\t<br />\n\n";
}
if($count>=7)
	echo "\t*/ ?>\n";
?>

<style>
table.detail-view tr.odd {
background: #f5f7f9;
border-left: 1px #FFF solid;
}
</style>