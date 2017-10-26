
<div id="page-title">
	<h3>
		系统设置
		<small> >>配置系统</small>
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
	<div class="tabs ui-tabs ui-widget ui-widget-content ui-corner-all">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li>
				<a href="#icon-only-tabs-1">
					<i class="glyph-icon icon-trello float-left opacity-80"></i>
					系统参数配置
				</a>
			</li>
			
		</ul>
		<div id="icon-only-tabs-1" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="false" aria-hidden="true" style="display: block;">
			<div class="form">
				<form class="col-md-20 center-margin" id="myform" action="<?php U('updateh'); ?>" method="post">
					
					<div class="form-row">
						<div class="form-label col-md-3">
							<label for="">
								<strong>首次满多少积分可提现:</strong>
							</label>
						</div>
				<div class="form-input col-md-6">
					<?php echo CHtml::telField("info[frist_integral]", $list['frist_integral']);?>
				</div>
					</div>
					<div class="form-row">
						<div class="form-label col-md-3">
							<label for="">
								<strong> 平时可提现最低积分:</strong>
							</label>
						</div>
				<div class="form-input col-md-6">
						<?php echo CHtml::telField("info[custom_ntegral]", $list['custom_ntegral']);?>
				</div>
					</div>
					<div class="form-row">
						<div class="form-label col-md-3">
							<label for="">
								<strong> 积分兑换比例:</strong>
							</label>
						</div>
				<div class="form-input col-md-6">
						<?php echo CHtml::telField("info[rule_integral]", $list['rule_integral']);?>
						<p>0.01代表100积分可以兑换1元</p>
				</div>
					</div>
					<div class="form-row">
						<div class="form-label col-md-3">
							<label for="">
								<strong>活动分享描述:</strong>
							</label>
						</div>
						<div class="form-input col-md-6">
						<?php echo CHtml::textArea("info[share_desc]", $list['share_desc']);?>
						<p>其中"{商家}""{活动标题}""{获得积分}""{还差积分}"会被替换为相应的内容</p>
				</div>
					</div>
					<div class="form-row">
						<div class="form-label col-md-3">
							<label for="">
								<strong> 跳转页面停留时间:</strong>
							</label>
						</div>
				<div class="form-input col-md-6">
						<?php echo CHtml::telField("info[jump_time]", $list['jump_time']);?>
						<p>请填写整数</p>
				</div>
					</div>
					<div class="form-row">
						<div class="form-label col-md-3">
							<label for="">
								<strong>全局分享标题:</strong>
							</label>
						</div>
				<div class="form-input col-md-6">
					<?php echo CHtml::telField("info[index_shareTitle]", $list['index_shareTitle']);?>
				</div>
					</div>
					<div class="form-row">
						<div class="form-label col-md-3">
							<label for="">
								<strong>全局分享描述:</strong>
							</label>
						</div>
						<div class="form-input col-md-6">
						<?php echo CHtml::textArea("info[index_shareDesc]", $list['index_shareDesc']);?>
				</div>
					</div>
					<div class="form-row">
						<div class="form-label col-md-3">
							<label for="">
								<strong> 全局分享图标:</strong>
							</label>
						</div>
						<div class="form-input col-md-6">
						
						<?php echo imageUpdoad('info[index_shareIcon]',  $list['index_shareIcon'],'index_shareIcon',array('id'=>'index_shareIcon'));?>
				</div>
					</div>
					<div class="divider"></div>
					<div class="button-pane text-center">
						<button onclick="javascript:return $('#myform').reset();" type="button" class="btn large  text-transform-upr font-size-11" id="demo-form-valid" title="Validate!">
							<span class="button-content">重置</span>
						</button>
						<button onclick="javascript:return $('#myform').parsley( 'validate' );" type="submit" class="btn large primary-bg text-transform-upr font-size-11" id="demo-form-valid" title="Validate!">
							<span class="button-content">提交</span>
						</button>
					</div>
				</form>
			</div>
		</div>
		

	<script>
$(document).ready(function(){
	ajax_up('#lup',cfun,'watermark_img','0','0','0','0');
});
function cfun(res,obj){
	$("#watermark_img_div").html('<img src="'+weburl+res.msg+'"/>  <input type="hidden" name="info[watermark_img]" id="watermark_img" value="'+res.msg+'"/>');
}
	
</script>
</div>
</div>
</div>
</div>
