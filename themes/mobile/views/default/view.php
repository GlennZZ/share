<section class="playDetailSection ">
    <div class="titleImgDiv">
        <a href="<?php echo $this->createUrl('/default'); ?>"><img src="<?php echo $this->assets(); ?>/images/back.png"
                                                                   class="mycenterBack"></a>
        <img src=" <?php echo $model->icon; ?>">
        <span class="restScore">还剩<?php echo $model->integral; ?>积分</span>
    </div>
    <div class="playInfoDiv border1">
        <div class="playTitle border1">
            <span class="fl ftRed"><?php echo AppUni::model()->findByPk($model->unid)->name ?>：<?php echo $model->name ?></span>
        </div>
        <p class="playtimeP">
            <span>活动时间：<?php echo date('Y/m/d', strtotime($model->start_tm)); ?>
                -<?php echo date('Y/m/d', strtotime($model->stop_tm)); ?></span>
            <?php if (SysMemberCollect::model()->findByAttributes(array('aid' => $model->id, 'openid' => $this->userinfo['openid']))) {echo '<i class="ic-heart fr"></i>';} else {echo '<i class="ic-heart-empty fr"></i>';} ?>

        </p>

        <p class="playDetailP"><?php echo $model->note; ?> </p>
        <div class="detialIco">
            <div class="seeNum">
                <i class="ic-eye"></i>
                <span><?php echo $model->clicks; ?></span>
            </div>
            <div class="seeNum">
                <i class="ic-score"></i>
                <span><?php echo $model->integral_share; ?>分</span>
            </div>

        </div>

    </div>
    <p class="space1"></p>
    <div class="playIntroduction ">
        <div class="header border1">
            <i class="ic-book"></i>
            <span>活动简介</span>
        </div>
        <div class="contentDiv border1">
            <?php echo $model->desc; ?>
        </div>
    </div>
    <div class="playIntroduction " style="padding-bottom: 90px;">
        <div class="header border1">
            <i class="ic-gift"></i>
            <span>礼物明细</span>
        </div>
        <div class="contentDiv border1">
            <?php echo $model->desc1; ?>
        </div>
    </div>
    <div class='viewBtnDiv'>
        <p class="shareBtn fl" data='<?php echo $model->integral - $model->integral_share < 0 ? 2 : 1; ?>'>去赚钱</p>
        <a href="<?php echo $model->url; ?>"><p class="playBtn fl">我要玩</p></a>

    </div>

</section>
<section class='shareIip dis_none popup'>
    <img src="<?php echo $this->assets(); ?>/images/shareArrow.png" class="shareArrow">

</section>
<section class='noIip dis_none popup '>
    <img src="<?php echo $this->assets(); ?>/images/noen.png" class="shareArrow">

</section>
<script type="text/javascript">
   /* if (sysParam.isSharePage == 0) {
        $('.shareBtn').text('去赚钱');
        $('.mycenterBack').show()
    } else {
        $('.shareBtn').text('我要分享赚积分');
        $('.mycenterBack').hide()

    }*/
</script>
<script type="text/javascript">


    WX_STAT.init({
            hideToolbar: true,
            hideOptionMenu: <?php echo $model->integral - $model->integral_share < 0 ? 'true' : 'false';?>,
            shareTimelineType: 1,
            title: '<?php echo $model->name;?>',
            desc: '<?php echo $desc;?>',
            img: "<?php echo $model->icon;?>",
            //link:"<?php echo Yii::app()->request->hostInfo . Yii::app()->request->getUrl();?>?_from=<?php echo $this->userinfo['openid']?>"
            link: "<?php echo Yii::app()->request->hostInfo;?><?php echo $this->createUrl('/default/jump/') . '/id/' . $model->id;?>?_from=<?php echo $this->userinfo['openid']?>"

        },
        { // 分享取消
            cancel: function (resp) {
                //alert(resp);
            },
            // 分享失败
            fail: function (resp) {
                //alert(resp);
            },
            // 分享成功
            ok: function (resp) {
                $.ajax({
                    type: 'post',
                    url: '<?php echo $this->createUrl("/default/share");?>',
                    dataType: 'json',
                    data: {id:<?php echo $model->id;?>},
                    timeout: 15000,
                    success: function (data) {
                        if (data.result_code == 1) {
                            if (data.result_data.frist == 1) {
                                alert(data.result_msg);
                            } else {

                            }
                        } else if (data.result_code == -2) {
                            alert(data.result_msg);
                            location.href = '<?php echo $this->createUrl('/member/regester');?>';
                        } else {
                            alert(data.result_msg);
                        }
                    },
                    error: function (xhr, type) {
                        alert('网络超时，请刷新后再试！');
                    }
                });
            }
        });
</script>
