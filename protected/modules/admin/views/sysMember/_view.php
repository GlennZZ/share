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

	<b><?php echo CHtml::encode($data->getAttributeLabel('openid')); ?>:</b>
	<?php echo CHtml::encode($data->openid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ghid')); ?>:</b>
	<?php echo CHtml::encode($data->ghid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('srcOpenid')); ?>:</b>
	<?php echo CHtml::encode($data->srcOpenid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nickname')); ?>:</b>
	<?php echo CHtml::encode($data->nickname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode($data->sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('province')); ?>:</b>
	<?php echo CHtml::encode($data->province); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('headimgurl')); ?>:</b>
	<?php echo CHtml::encode($data->headimgurl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('privilege')); ?>:</b>
	<?php echo CHtml::encode($data->privilege); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accessToken')); ?>:</b>
	<?php echo CHtml::encode($data->accessToken); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refreshToken')); ?>:</b>
	<?php echo CHtml::encode($data->refreshToken); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scope')); ?>:</b>
	<?php echo CHtml::encode($data->scope); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ctm')); ?>:</b>
	<?php echo CHtml::encode($data->ctm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('utm')); ?>:</b>
	<?php echo CHtml::encode($data->utm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expires')); ?>:</b>
	<?php echo CHtml::encode($data->expires); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ua')); ?>:</b>
	<?php echo CHtml::encode($data->ua); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel')); ?>:</b>
	<?php echo CHtml::encode($data->channel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subscribe')); ?>:</b>
	<?php echo CHtml::encode($data->subscribe); ?>
	<br />

	*/ ?>

<style>
table.detail-view tr.odd {
background: #f5f7f9;
border-left: 1px #FFF solid;
}
</style>