<div id="page-title">
	<h3>
		系统
		<small> >>首页 </small>
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
<div>
	<style type="text/css">
.dl-horizontal dt {
float: left;
width: 110px;
overflow: hidden;
clear: left;
text-align: right;
text-overflow: ellipsis;
white-space: nowrap;
}
.dl-horizontal dd {
margin-left: 130px;
}
table.table-h tr td {
border: 1px solid #DDDDDD;

}
.table tbody tr:last-child th, .table tbody tr:last-child td {
border: 1px solid #DDDDDD;

}
.form-input{
line-height: 32px;
}
</style>
	<div id="main">
		<div class="row-fluid">
			<div class="span12">
				<div class="box ">
					<div class="box-title">
						<h3>
							<i class="glyph-icon icon-user" style="padding-left: 20px;"></i>
							账户信息
						</h3>
					</div>
					<div class="box-content">
						<dl class="dl-horizontal">
							<dt>
								 <img width="88" style="border-radius: 10px;" src="<?php 
							if(!empty(user()->headimg)){ echo user()->headimg;}else{ echo $this->assets()."/images/gravatar.jpg";}
                       ?>" alt="">
							</dt>
							
							<dd>

								
								
								系统信息
									<div class="row">
		<div class="col-md-6">
			<div class="example-code clearfix">
				<form class="form-bordered" action="" method="">
					<div class="form-row">
						<div class="form-label col-md-2">
							<label for=""> 用户名: </label>
						</div>
						<div class="form-input col-md-10"><?php echo user()->username;?></div>
					</div>
					<div class="form-row">
						<div class="form-label col-md-2">
							<label for=""> 所属会员组: </label>
						</div>
						<div class="form-input col-md-10"><?php echo user()->group->groupname?user()->group->groupname:'超级管理员';?></div>
					</div>
					<div class="form-row">
						<div class="form-label col-md-2">
							<label for=""> 最后登陆时间: </label>
						</div>
						<div class="form-input col-md-10"><?php echo date('Y-m-d H:i:s',user()->last_login_time)?></div>
					</div>
					<div class="form-row pad0B">
						<div class="form-label col-md-2">
							<label for=""> 最后登录ip: </label>
						</div>
						<div class="form-input col-md-10"><?php echo user()->last_login_ip?></div>
					</div>
					<div class="form-row pad0B">
						<div class="form-label col-md-2">
							<label for=""> 登陆次数: </label>
						</div>
						<div class="form-input col-md-10"><?php echo user()->login_count;?></div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-6">
			<div class="example-code clearfix">
				<form class="form-bordered" action="" method="">
					<div class="form-row">
						<div class="form-label col-md-2">
							<label for=""> 版本: </label>
						</div>
						<div class="form-input col-md-10">V1.2</div>
					</div>
					<div class="form-row">
						<div class="form-label col-md-2">
							<label for=""> 授权类型: </label>
						</div>
						<div class="form-input col-md-10">永久</div>
					</div>
					<div class="form-row">
						<div class="form-label col-md-2">
							<label for=""> 设计与开发: </label>
						</div>
						<div class="form-input col-md-10"><a target="_blank" style="text-decoration: none" href="http://wintrue.cn">wintrue</a></div>
					</div>
					<div class="form-row pad0B">
						<div class="form-label col-md-2">
							<label for=""> 更新时间: </label>
						</div>
						<div class="form-input col-md-10">
							2015年5月11日
						</div>
					</div>
					<div class="form-row pad0B">
						<div class="form-label col-md-2">
							<label for=""> 操作安全: </label>
						</div>
						<div class="form-input col-md-10">
							<b id="soms_update" style="color: red">※ 建议使用谷歌浏览器、不支持IE9以下浏览器</b>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
							</dd>
						</dl>
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
<!-- #page-content -->