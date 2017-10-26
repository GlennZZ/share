<section class="shareDetailSection ">
    <div class="title">
        <i class="ic-back"></i>
        <span>我的分享</span>
    </div>
    <input type="hidden" id="myshare_id" value='<?php echo $model->aid?>'>
    <div class="shareObjectDiv">
        <div class="shareImgDiv">
            <img src="<?php echo $game->icon; ?>" style='width: 124px;height:124px;border-radius: 100%;' />
        </div>
        <div class="shareInfoDiv">
            <p>
                <span><?php echo AppUni::model()->findByPk($game->unid)->name?>：<?php echo $game->name?></span>
               <?php 
                        if(strtotime($game->start_tm)<=time()&&strtotime($game->stop_tm)>=time()){
                        ?>
                        <span class="ftRed fr staus">进行中</span>
                         <?php 	
                        }else if(strtotime($game->start_tm)>time()){
                        ?>
                        <span class=" fr staus" style="color:red">未开始</span>
                        <?php 	
                        }else{
                        ?>
                        <span class=" fr staus">已结束</span>
                        <?php 	
                        }
                        ?>
            </p>
            <p>活动时间：<?php echo date('Y/m/d',strtotime($game->start_tm))?>-<?php echo date('Y/m/d',strtotime($game->stop_tm))?></p>
        </div>
        <p class="space1"></p>
    </div>
    <div class="scoreDetailDiv cf marLf">
        <p class="border1 scoreP ftRed">
            <i class="ic-score"></i>
            <span>获得积分：<span class="score"><?php echo intval($count_integral);?></span>分</span>
        </p>
        <div class="singleScore" id="scoreDetailScroll">
            <ul>
			<!--
				<li>
                    <img src="<?php echo $vv->fheadimgurl;?>" class="headImg">
                    <span class="nickname"><?php echo $vv->fnickname;?></span>
                    <div class="siggleScoreDiv">
                        <span>点击</span>
                        <span>+<?php echo $vv->integral;?>积分</span>
                    </div>
                    <div class="siggledateDiv">
                        <span><?php echo date('m/d',strtotime($vv->ctm));?></span>
                    </div>
                </li>
			-->
            </ul>
        </div>
    </div>
</section>
<script type="text/javascript">
    var id=$('#myshare_id').val();
     goShareDetail(id,1)
        var hei=document.documentElement.clientHeight-257;
            $("#scoreDetailScroll").css('height',hei+'px');
             $("#scoreDetailScroll").css('overflow','hidden');
               scoreDetailScroll= new IScroll("#scoreDetailScroll",{
                         bounce :false,
                         useTransform:true,
                         tap:true,
                         zoom:true,
                         probeType:2

                     });
      scoreDetailScroll.on("scrollEnd",function(){
                 //var a=fun.pagenum();
                  var page=scoreDetail_page-1
                 if(shareDetailPage>page){
                     //判定是否划到底
                      goShareDetail(id,scoreDetail_page)
                     setTimeout(function(){
                         scoreDetailScroll.refresh();
                     },20)
                 }
             })
WX_STAT.init({
  	hideToolbar:true,
	hideOptionMenu:false,
	title:'<?php echo $this->webconfig['index_shareTitle'];?>',
	desc: '<?php echo $this->webconfig['index_shareDesc'];?>',
	img:"<?php echo $this->webconfig['index_shareIcon'];?>",
	link:"<?php echo Yii::app()->request->hostInfo;?>"
  } );
</script>


