<?php
//在开始加载
Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_BEGIN;
//这些不加载
Yii::app()->clientScript->scriptMap=array('jquery.js'=>false,'jquery.min.js'=>false);

//在底部加载自定义JS
//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/test.js",CClientScript::POS_END);
?>

<html><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo CHtml::encode(Yii::app()->params['title']); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Favicons -->
		<style type="text/css">
			html{_overflow-y:scroll}
		</style>
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->assets(); ?>/images/icons/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->assets(); ?>/images/icons/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->assets(); ?>/images/icons/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo $this->assets(); ?>/images/icons/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo $this->assets(); ?>/images/icons/favicon.png">

        <!--[if lt IE 9]>
          <script src="<?php echo $this->assets(); ?>/js/minified/core/html5shiv.min.js"></script>
          <script src="<?php echo $this->assets(); ?>/js/minified/core/respond.min.js"></script>
        <![endif]-->
		<script language="JavaScript">
		<!--
			if(top!=self)
			if(self!=top) top.location=self.location;
		//-->
		</script>
        <!-- Fides Admin CSS Core -->

        <link rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/css/minified/aui-production.min.css">

        <!-- Theme UI -->

        <link id="layout-theme" rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/themes/minified/fides/color-schemes/dark-blue.min.css">

        <!-- Fides Admin Responsive -->

        <link rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/themes/minified/fides/common.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->assets(); ?>/themes/minified/fides/responsive.min.css">

        <!-- Fides Admin JS -->
		<script type="text/javascript">var WEB_URL='<?php echo WEB_URL;?>',statics='<?php echo WEB_URL.'/static';?>';</script>
        <script type="text/javascript" src="<?php echo $this->assets(); ?>/js/minified/aui-production.min.js"></script><style type="text/css"></style>
 		<script type="text/javascript" src="<?php echo $this->assets(); ?>/js/wind.js?k=1"></script>
        <script type="text/javascript" src="<?php echo $this->assets(); ?>/js/artDialog.js?skin=idialog"></script>
        <script type="text/javascript" src="<?php echo $this->assets(); ?>/js/artiframeTools.js?skin=idialog"></script>
        <script>
            jQuery(window).load(
                function(){
                    var wait_loading = window.setTimeout( function(){
                      $('#loading').slideUp('fast');
                    },1000
                    );

                });

        </script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style><style type="text/css">.lb_translate_span_6142570132:hover{background:#f1f0a0 !important;}.lb_translate_span_6142570132{display:inline !important;width:auto !important;margin:0 !important;padding:0 !important;font-family:inherit !important;font-size:inherit !important;line-height:inherit !important;float:none !important;text-transform:initial !important;color:inherit !important;font-weight:inherit !important;cursor:inherit !important;}</style></head>
    <body  scroll='no'  >

        <div id="loading" class="ui-front loader ui-widget-overlay bg-white opacity-100" style="">
            <img src="<?php echo $this->assets(); ?>/images/loader-dark.gif" alt="">
        </div>

        <div id="page-wrapper" class="main_page">
            <div id="page-header" class="clearfix">
                <div id="header-logo">
                    <a href="javascript:;" class="tooltip-button" data-placement="bottom" title="" id="close-sidebar" data-original-title="收起左侧菜单">
                        <i class="glyph-icon icon-caret-left"></i>
                    </a>
                    <a href="javascript:;" class="tooltip-button hidden" data-placement="bottom" title="" id="rm-close-sidebar" data-original-title="开启左侧菜单">
                        <i class="glyph-icon icon-caret-right"></i>
                    </a>
                    <a href="javascript:;" class="tooltip-button hidden" title="" id="responsive-open-menu" data-original-title="导航">
                        <i class="glyph-icon icon-align-justify"></i>
                    </a><?php echo CHtml::encode(Yii::app()->params['title']); ?><i class="opacity-80"></i>
                </div>

                <div class="user-profile dropdown">
                    <a href="javascript:;" title="" class="user-ico clearfix" data-toggle="dropdown">
                        <img width="36" src="<?php 
							if(!empty(user()->headimg)){ echo user()->headimg;}else{ echo $this->assets()."/images/gravatar.jpg";}
                       ?>" alt="">
                        <span class="userinfo"><?php echo user()->nickname;?> <br><?php echo user()->username;?></span>

                        <i class="glyph-icon icon-chevron-down"></i>
                    </a>
                     <ul class="dropdown-menu float-right qmenu" style="padding: 0">
                    <div class="bg-gray text-transform-upr font-size-12 font-bold font-gray-dark pad10A" style="background: #2E7FCA;color: #FFF!important;">账号管理</div>
                        <li>
                            <a href='javascript:;_MP(0,"<?php echo $this->createUrl('baseinfo/index');?>")'  title="">
                                <i class="glyph-icon icon-user mrg5R"></i>基本信息</a>
                        </li>
                        <li>
                            <a href='javascript:;_MP(0,"<?php echo $this->createUrl('baseinfo/modifypwd');?>")' title="">
                                <i class="glyph-icon icon-cog mrg5R"></i>修改密码</a>
                        </li>
                        <li>
                            <a href="javascript:;" title="">
                                <i class="glyph-icon icon-flag mrg5R"></i>通知</a>
                        </li>
                       <li>
                            <a href="<?php echo $this->createUrl('login/logout');?>" class="btn medium display-block float-none primary-bg" style="color: #fff;line-height: 25px;">
                                <i class="glyph-icon icon-power-off" style="color: #fff;"></i>退出
                            </a>
                        </li>



                    </ul>
                </div>
                <?php if(!empty(gh()->ghid)){?>
                <!--
                <div class="user-profile dropdown">
                    <a href="javascript:;" title="" class="user-ico clearfix" data-toggle="dropdown">
                        <img width="36" src="<?php echo $this->assets(); ?>/images/wx.png" alt="">
                        <span ><?php echo gh()->name;?> </span>
                        <i class="glyph-icon icon-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu float-right qmenu" style="padding: 0">
                    <div class="bg-gray text-transform-upr font-size-12 font-bold font-gray-dark pad10A" style="background: #2E7FCA;color: #FFF!important;">快捷菜单</div>
                        <li>
                            <a href='javascript:;_MP(0,"<?php echo $this->createUrl('sysUserGh/info');?>")'  >
                                <i class="glyph-icon icon-user mrg5R"></i>公众号设置</a>
                        </li>
                        <li>
                            <a href='javascript:;_MP(0,"<?php echo $this->createUrl('activity/admin');?>")' >
                                <i class="glyph-icon icon-cog mrg5R"></i>活动管理</a>
                        </li>
						 <li>
                            <a href='javascript:;' >
                                <i class="glyph-icon icon-plus mrg5R"></i>添加快捷菜单</a>
                        </li>

                    </ul>
                </div>
                  -->
                <?php }?>
                <div class="dropdown dash-menu" style="display: none">
                    <a href="javascript:;" data-toggle="dropdown" data-placement="bottom" class="medium btn primary-bg float-right popover-button-header hidden-mobile tooltip-button" title="" data-original-title="快捷菜单">
                        <i class="glyph-icon icon-th"></i>
                    </a>
                    <div class="dropdown-menu">
                        <div class="small-box">
                            <div class="bg-gray text-transform-upr font-size-12 font-bold font-gray-dark pad10A">快捷菜单</div>
                            <div class="pad10A dashboard-buttons clearfix">
                                <a href="javascript:;" class="btn vertical-button remove-border bg-blue" title="">
                                    <span class="glyph-icon icon-separator-vertical pad0A medium">
                                        <i class="glyph-icon icon-dashboard opacity-80 font-size-20"></i>
                                    </span>
                                    <span class="button-content">个人中心</span>
                                </a>
                                <a href="javascript:;" class="btn vertical-button remove-border bg-red" title="">
                                    <span class="glyph-icon icon-separator-vertical pad0A medium">
                                        <i class="glyph-icon icon-tags opacity-80 font-size-20"></i>
                                    </span>
                                    <span class="button-content">互动营销</span>
                                </a>
                                <a href="javascript:;" class="btn vertical-button remove-border bg-purple" title="">
                                    <span class="glyph-icon icon-separator-vertical pad0A medium">
                                        <i class="glyph-icon icon-reorder opacity-80 font-size-20"></i>
                                    </span>
                                    <span class="button-content">管理</span>
                                </a>
                                <a href="javascript:aa();" class="btn vertical-button remove-border bg-azure" title="">
                                    <span class="glyph-icon icon-separator-vertical pad0A medium">
                                        <i class="glyph-icon icon-bar-chart opacity-80 font-size-20"></i>
                                    </span>
                                    <span class="button-content">系统</span>
                                </a>
                                <a href="javascript:;" class="btn vertical-button remove-border bg-yellow" title="">
                                    <span class="glyph-icon icon-separator-vertical pad0A medium">
                                        <i class="glyph-icon icon-laptop opacity-80 font-size-20"></i>
                                    </span>
                                    <span class="button-content">按钮</span>
                                </a>
                                <a href="javascript:;" class="btn vertical-button remove-border bg-orange" title="">
                                    <span class="glyph-icon icon-separator-vertical pad0A medium">
                                        <i class="glyph-icon icon-code opacity-80 font-size-20"></i>
                                    </span>
                                    <span class="button-content">面板</span>
                                </a>
                                <a href="javascript:;" class="btn vertical-button hover-blue-alt" title="">
                                    <span class="glyph-icon icon-separator-vertical pad0A medium">
                                        <i class="glyph-icon icon-plus opacity-80 font-size-20"></i>
                                    </span>
                                    <span class="button-content">添加菜单</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top-icon-bar">

                
                    <!-- 
                    <marquee behavior="scroll"  onstart="this.firstChild.innerHTML+=this.firstChild.innerHTML;" scrollamount="3" width="300">
					<a href="javascript:;" title="" style="color:#ffffff;font-size: 14px;line-height: 45px;margin-left: 5px;"><i class="glyph-icon font-green icon-volume-up"></i>&nbsp;您有一条新消息,请及时查收！</a>
					</marquee>
                      -->		     
                

<!--                 
                    <div class="dropdown">

                        <a data-toggle="dropdown" href="javascript:;" data-placement="bottom" class="tooltip-button" data-original-title="主题选择">
                            
                            <i class="glyph-icon icon-lightbulb"></i>
                        </a>
                        <div class="dropdown-menu">

                            <div class="small-box">
                                 
                                <div class="popover-title">背景颜色</div>
                                <div class="pad10A clearfix">
                                    <a href="javascript:;" class="choose-bg" boxed-bg="#000" style="background: #000;" title=""></a>
                                    <a href="javascript:;" class="choose-bg" boxed-bg="#333" style="background: #333;" title=""></a>
                                    <a href="javascript:;" class="choose-bg" boxed-bg="#666" style="background: #666;" title=""></a>
                                    <a href="javascript:;" class="choose-bg" boxed-bg="#888" style="background: #888;" title=""></a>
                                    <a href="javascript:;" class="choose-bg" boxed-bg="#383d43" style="background: #383d43;" title=""></a>
                                    <a href="javascript:;" class="choose-bg" boxed-bg="#fafafa" style="background: #fafafa; border: #ccc solid 1px;" title=""></a>
                                    <a href="javascript:;" class="choose-bg" boxed-bg="#fff" style="background: #fff; border: #eee solid 1px;" title=""></a>
                                </div>
                                 
                                <div class="popover-title">主题方案</div>
                                <div class="pad10A clearfix change-layout-theme">
                             
                                    <div class="divider mrg10T mrg10B"></div>
                                    <a href="javascript:;" class="choose-theme" layout-theme="dark-blue" title="">
                                        <span style="background: #3588D6;"></span>
                                    </a>
                                    <a href="javascript:;" class="choose-theme " layout-theme="dark-blue2" title="">
                                        <span style="background: #438eb9;"></span>
                                    </a>
                                    <a href="javascript:;" class="choose-theme" layout-theme="dark-blue3" title="">
                                        <span style="background: #354b66;"></span>
                                    </a>
                                    <a href="javascript:;" class="choose-theme" layout-theme="dark-green" title="D">
                                        <span style="background: #78CE12;"></span>
                                    </a>
                                    
                                    <a href="javascript:;" class="choose-theme opacity-30 mrg15R" layout-theme="white-green" title="D">
                                        <span style="background: #78CE12;"></span>
                                    </a>
                                    <a href="javascript:;" class="choose-theme" layout-theme="dark-orange" title="">
                                        <span style="background: #FF6041;"></span>
                                    </a>
                                    <a href="javascript:;" class="choose-theme opacity-30 mrg15R" layout-theme="white-orange" title="">
                                        <span style="background: #FF6041;"></span>
                                    </a>
                                     
                                </div>

                                <div class="pad10A button-pane button-pane-alt text-center">
                                    <a href="javascript:;" class="btn medium bg-black">
                                        <span class="button-content text-transform-upr font-bold font-size-11">关闭</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
-->

                </div>

            </div><!-- #page-header -->

            <div id="page-sidebar" class="scrollable-content" style="overflow: hidden; outline: none; height: 925px;" tabindex="5003">
                <div id="sidebar-menu">
				<div class="top_menu" style="margin-top: 5px;">
				<div style="text-align:left">
				<?php
				foreach ($this->getTopMenu() as $kk=>$vv){
					$ii++;
					?>
					<a href="javascript:;" class="btn vertical-button remove-border <?php
						switch ($ii){
							/*case 1:
								echo 'bg-blue';
								break;
							case 2:
								echo 'bg-red';
								break;
							case 3:
								echo 'bg-purple';
								break;
							case 4:
								echo 'bg-yellow';
								break;
							case 5:
								echo 'bg-azure';
								break;
							case 6:
								echo 'bg-orange';
								break;*/
						    case 1:
						        echo 'hover-blue';
						        break;
						    case 2:
						        echo 'hover-red';
						        break;
						    case 3:
						        echo 'hover-purple';
						        break;
						    case 4:
						        echo 'hover-yellow';
						        break;
						    case 5:
						        echo 'hover-azure';
						        break;
						    case 6:
						        echo 'hover-orange';
						        break;
						}
					?>" title="" style="padding: 0;margin-bottom: 5px;">
                                    <span class="glyph-icon icon-separator-vertical pad0A medium">
                                        <i class="glyph-icon <?php echo $vv['icon'];?> opacity-80 font-size-20"></i>
                                    </span>
                                    <span class="button-content" style='margin-top: -5px;'><?php echo $vv['title'];?></span>
                      </a>
					<?php

				}
				?>
                   </div>
                    <div class="divider mrg5T mobile-hidden"></div>
                       <?php
					    	foreach ($this->leftmenu() as $k=>$l){

						    	$iii++;
						    		?>

						    		<div  style="<?php if($iii>1){echo 'display: none;';}?>" class='next_menu'>
								 <ul>
								<?php
										if(!$l){echo '</ul></div>';	continue;}
								    	foreach ($l as $k=>$list){
								    	$i++;
								    	?>
								    	<li id="_MP<?php echo $list['id']+200;?>" <?php if(!empty($list['sublist'])){echo "class='more'";}?> <?php if(Yii::app()->controller->id=='default') echo 'class="current-page"' ;?>>
								    	<?php
											if(!empty($list['modelname'])&&$list['modelname']!='-'){
												$tmodel=$list['modelname'];
												?>
												<a href="javascript:;/*当前地址：<?php echo $this->createUrl('/'.$tmodel).$list['parameter'];?> */" onclick=_MP(<?php echo $list['id']+200;?>,"<?php echo $this->createUrl("/".$list['modelname']).$list['parameter'];?>") hidefocus="true" style="outline:none;">
												<?php
											}else{
												?>
												<a href="javascript:;" class="next_menu_2">
												<?php
											}
								    	?>
								               <i class="glyph-icon <?php echo $list['icon'];?>"></i><?php echo $list['title'];?></a>
										 <?php
										 if(!empty($list['sublist'])){
										 	?>
										 	<ul style="">
										 	<?php
								   			 foreach ($list['sublist'] as $kk=>$mmss){
								    			$ii++;
								    		?>
								    		<li id="_MP<?php echo $mmss['id'];?>">
								               <a href="javascript:; /*当前地址：  <?php echo $this->createUrl('/'.$mmss[modelname]).$mmss['parameter'];?> */" onclick=_MP(<?php echo $mmss['id'];?>,"<?php echo $this->createUrl('/'.$mmss[modelname]).$mmss['parameter'];?>") hidefocus="true" style="outline:none;">
								                  <i class="glyph-icon icon-caret-right"></i><?php echo $mmss['title'];?>
								               </a>
								            </li>

								    		<?php
								   			 }
								   			 ?>
								   			 </ul>
								   		<?php
										 }else{
								   			 	?>
								   			 	</li>
								   			 	<?php

								   			 }
								    }
								    ?>

								</ul>
								</div>

						    		<?php

					    	}
					    ?>
                    	    	

				</div>
				<script>
				$('.top_menu a.vertical-button').click(function(){
					$('.top_menu div.next_menu').hide();
					$('.top_menu div.next_menu').eq($(this).index()).show();
					var fristlink=$('.top_menu div.next_menu').eq($(this).index()).children('ul').children('li').eq(0);
					if(fristlink.children('a').eq(0).attr('hidefocus')=='true'){
						fristlink.children('a').eq(0).click();
					}else{
						fristlink.children('a').eq(0).next('ul').children('li').children('a').eq(0).click();
					}
				});
				</script>
                    <div class="divider mrg5T mobile-hidden"></div>

                </div>

            </div><!-- #page-sidebar -->
            <div id="page-content-wrapper">
            <div class="content" style="position:relative; overflow:hidden">
                <iframe name="right" id="rightMain" src="<?php echo $this->createUrl('/admin/index')?>" frameborder="false" scrolling="auto" style="border: none; height: 463px; " width="100%" height="auto" allowtransparency="true"></iframe>
            </div>
            </div><!-- #page-main -->
        </div><!-- #page-wrapper -->
<script  type="text/javascript" src="<?php echo $this->assets(); ?>/js/minified/admin.js?v=1.1"></script>
</body></html>
