
<tr>

<?php
$count = 0;
foreach ($this->tableSchema->columns as $column) {
	echo "<td><?php echo CHtml::encode(\$data->{$column->name}); ?></td>";
}

?>

	<td>
		<div class="dropdown">
			<a href="javascript:;" title="" class="btn medium bg-blue"
				data-toggle="dropdown">
				<span class="button-content">
					<i class="glyph-icon font-size-11 icon-cog"></i>
					<i class="glyph-icon font-size-11 icon-chevron-down"></i>
				</span>
			</a>
			<ul class="dropdown-menu float-right">
				<li>
				<?php echo CHtml::link('<i class="glyph-icon icon-edit mrg5R"></i>修改', array('update', 'id'=>$data->id)); ?>
				</li>
				<li>
				<?php echo CHtml::link('<i class="glyph-icon icon-calendar mrg5R"></i>权限管理', array('editflag', 'gid'=>$data->id)); ?>
				</li>
				<li class="divider"></li>
				<li>
					<?php echo CHtml::link('<i class="glyph-icon icon-remove mrg5R"></i>删除', array('delete', 'id'=>$data->id),array('class'=>"font-red",'encode'=>false )); ?>
				</li>
			</ul>
		</div>
	</td>
</tr>
