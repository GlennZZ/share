<?php
/* @var $this SysLinkListController */
/* @var $data SysLinkList */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('listorder')); ?>:</b>
	<?php echo CHtml::encode($data->listorder); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('webname')); ?>:</b>
	<?php echo CHtml::encode($data->webname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weburl')); ?>:</b>
	<?php echo CHtml::encode($data->weburl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ispass')); ?>:</b>
	<?php echo CHtml::encode($data->ispass); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('img')); ?>:</b>
	<?php echo CHtml::encode($data->img); ?>
	<br />


</div>