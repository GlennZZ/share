<?php
/* @var $this AppDownController */
/* @var $data AppDown */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unid')); ?>:</b>
	<?php echo CHtml::encode($data->unid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('size')); ?>:</b>
	<?php echo CHtml::encode($data->size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ver')); ?>:</b>
	<?php echo CHtml::encode($data->ver); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('icon')); ?>:</b>
	<?php echo CHtml::encode($data->icon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imgs')); ?>:</b>
	<?php echo CHtml::encode($data->imgs); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ios_url')); ?>:</b>
	<?php echo CHtml::encode($data->ios_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('andriod_url')); ?>:</b>
	<?php echo CHtml::encode($data->andriod_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dowm_num')); ?>:</b>
	<?php echo CHtml::encode($data->dowm_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clicks')); ?>:</b>
	<?php echo CHtml::encode($data->clicks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ctm')); ?>:</b>
	<?php echo CHtml::encode($data->ctm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('utm')); ?>:</b>
	<?php echo CHtml::encode($data->utm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company')); ?>:</b>
	<?php echo CHtml::encode($data->company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>