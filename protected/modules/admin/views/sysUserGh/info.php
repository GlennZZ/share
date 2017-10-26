
<div id="page-title">
	<h3>
		公众号设置
		<small> &gt;&gt;更新账号 </small>
	</h3>
	<div id="breadcrumb-right">
		<div class="float-right">
			<a href="<?php echo WEB_URL.Yii::app()->request->getUrl();?>" class="btn medium bg-white tooltip-button black-modal-60 mrg5R" data-placement="bottom" data-original-title="刷新">
				<span class="button-content">
					<i class="glyph-icon icon-refresh"></i>
				</span>
			</a>
		</div>
	</div>
</div>
<div id="page-content">
	<div class="example-code">
		<div class="form">
					<?php
					$form=$this->beginWidget('CActiveForm', array(
						'id'=>'sys-user-gh-form', 
						'htmlOptions'=>array(
							'class'=>'col-md-10 center-margin'
						)
					)
					);
					?>	
					
						<div class="infobox warning-bg" id="msgtip" style="display: none">
				<p>
					<i class="glyph-icon icon-exclamation mrg10R"></i>
				</p>
			</div>
			<div class="form-row">
				<div class="form-row">
					<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'ghid'); ?>
		</div>
					<div class="form-input col-md-6">
			<?php echo $form->textField($model,'ghid',array('size'=>50,'maxlength'=>50, )); ?>

		</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'name'); ?>
		</div>
					<div class="form-input col-md-6">
			<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>

		</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'qrcode_small'); ?>
		</div>
					<div class="form-input col-md-6">

		<?php  echo imageUpdoad(get_class($model).'[qrcode_small]',$model->qrcode_small,'qrcode_small',array('id'=>'qrcode_small'),'image')?>

		</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
						<label>公众号类型</label>
					</div>
					<div class="form-input col-md-6">

<?php echo CHtml::groupButton(chtmlName($model, 'type'), $model->type, Yii::app()->params['ghtype'])?>
		</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'wxh'); ?>
		</div>
					<div class="form-input col-md-6">
			<?php echo $form->textField($model,'wxh',array('size'=>50,'maxlength'=>50)); ?>

		</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'company'); ?>
		</div>
					<div class="form-input col-md-6">
			<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>100)); ?>

		</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'desc'); ?>
		</div>
					<div class="form-input col-md-6">
			<?php echo $form->textArea($model,'desc',array('size'=>120,'maxlength'=>200)); ?>

		</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'notes'); ?>
		</div>
					<div class="form-input col-md-6">
			<?php echo $form->textArea($model,'notes',array('size'=>50,'maxlength'=>50)); ?>

		</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'appid'); ?>
		</div>
					<div class="form-input col-md-6">
			<?php echo $form->textField($model,'appid',array('size'=>50,'maxlength'=>50)); ?>

		</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'appsecret'); ?>
		</div>
					<div class="form-input col-md-6">
			<?php echo $form->textField($model,'appsecret',array('size'=>50,'maxlength'=>50)); ?>

		</div>
				</div>
				
				<div class="form-row">
					<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'paySignKey'); ?>
		</div>
					<div class="form-input col-md-6">
			<?php echo $form->textField($model,'paySignKey',array('size'=>200,'maxlength'=>200)); ?>
<p style="color: #9D9D9D; margin-top: 5px;">开通微信支付配置，V2版本必填</p>
					</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'partnerId'); ?>
		</div>
					<div class="form-input col-md-6">
			<?php echo $form->textField($model,'partnerId',array('size'=>20,'maxlength'=>20)); ?>
<p style="color: #9D9D9D; margin-top: 5px;">开通微信支付配置</p>
					</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'partnerKey'); ?>
		</div>
					<div class="form-input col-md-6">
			<?php echo $form->textField($model,'partnerKey',array('size'=>50,'maxlength'=>50)); ?>
<p style="color: #9D9D9D; margin-top: 5px;">开通微信支付配置</p>
					</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
			<?php echo $form->labelEx($model,'mchId'); ?>
		</div>
					<div class="form-input col-md-6">
			<?php echo $form->textField($model,'mchId',array('size'=>32,'maxlength'=>32)); ?>
<p style="color: #9D9D9D; margin-top: 5px;">开通微信支付配置，V3版本必填</p>
					</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
						<label>oauth授权方式 </label>
					</div>
					<div class="form-input col-md-6">


<?php echo CHtml::groupButton(chtmlName($model, 'oauth'), $model->oauth, Yii::app()->params['oauthtype'])?>
		</div>
				</div>
				<div class="form-row">
					<div class="form-label col-md-2">
						<label>微信分享方式 </label>
					</div>
					<div class="form-input col-md-6">
	<?php echo CHtml::groupButton(chtmlName($model, 'jsapi'), $model->jsapi, Yii::app()->params['oauthtype'])?>
		</div>
				</div>
				<div class="divider"></div>
				<div class="form-row">
					<div class="button-pane text-center">
						<button class="btn primary-bg medium" onclick="javascript:return $('#sys-user-gh-form').parsley( 'validate' );">
							<span class="button-content">
								<i class="glyph-icon icon-check float-left"></i>
								绑定
							</span>
						</button>
						<a href="javascript:return $('#sys-user-gh-form').reset();" class="btn medium primary-bg">
							<span class="button-content">
								<i class="glyph-icon icon-undo float-left"></i>
								取消
							</span>
						</a>
					</div>
				</div>
					
					<?php $this->endWidget(); ?>
				</div>
		</div>
	</div>