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

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('icon')); ?>:</b>
	<?php echo CHtml::encode($data->icon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('classify')); ?>:</b>
	<?php echo CHtml::encode($data->classify); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area')); ?>:</b>
	<?php echo CHtml::encode($data->area); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('company')); ?>:</b>
	<?php echo CHtml::encode($data->company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prize_name')); ?>:</b>
	<?php echo CHtml::encode($data->prize_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recommend_type')); ?>:</b>
	<?php echo CHtml::encode($data->recommend_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('posid')); ?>:</b>
	<?php echo CHtml::encode($data->posid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clicks')); ?>:</b>
	<?php echo CHtml::encode($data->clicks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('participation_num')); ?>:</b>
	<?php echo CHtml::encode($data->participation_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('participation_num_t')); ?>:</b>
	<?php echo CHtml::encode($data->participation_num_t); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('share_num')); ?>:</b>
	<?php echo CHtml::encode($data->share_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('share_num_t')); ?>:</b>
	<?php echo CHtml::encode($data->share_num_t); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('share_proportion')); ?>:</b>
	<?php echo CHtml::encode($data->share_proportion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('share_proportion_t')); ?>:</b>
	<?php echo CHtml::encode($data->share_proportion_t); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_tm')); ?>:</b>
	<?php echo CHtml::encode($data->start_tm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stop_tm')); ?>:</b>
	<?php echo CHtml::encode($data->stop_tm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ctm')); ?>:</b>
	<?php echo CHtml::encode($data->ctm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('utm')); ?>:</b>
	<?php echo CHtml::encode($data->utm); ?>
	<br />

	*/ ?>

<style>
table.detail-view tr.odd {
background: #f5f7f9;
border-left: 1px #FFF solid;
}
</style>