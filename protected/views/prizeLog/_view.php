<div id="page-title">
	<h3>
		内容
		<small> >>详细内容 </small>
	</h3>
</div>
<div id="page-content">

	<div style="padding-bottom: 10px">
		<a href="<?php echo$this->createUrl('admin');?>" class="btn medium primary-bg ">
			<span class="button-content">
				<i class="glyph-icon icon-reply float-left "></i>
				返回
			</span>
		</a>
	</div>


	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unid')); ?>:</b>
	<?php echo CHtml::encode($data->unid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pid')); ?>:</b>
	<?php echo CHtml::encode($data->pid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />


<style>
table.detail-view tr.odd {
background: #f5f7f9;
border-left: 1px #FFF solid;
}
</style>