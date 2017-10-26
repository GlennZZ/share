<section class="myshareSection ">
    <div class="title">
        <i class="ic-back"></i>
        <span>我的分享</span>
    </div>
    <div class="mainShareDiv" id="shareScroll">
        <ul>

        <p class="noneData">数据加载中..</p>
        </ul>
    </div>
</section>

<script type="text/javascript">
WX_STAT.init({
  	hideToolbar:true,
	hideOptionMenu:false,
	title:'<?php echo $this->webconfig['index_shareTitle'];?>',
	desc: '<?php echo $this->webconfig['index_shareDesc'];?>',
	img:"<?php echo $this->webconfig['index_shareIcon'];?>",
	link:"<?php echo Yii::app()->request->hostInfo;?>"
  } );
</script>
<script type="text/javascript">
    goshare(1)
      var hei=document.documentElement.clientHeight-85;
       $("#shareScroll").css('height',hei+'px');
        $("#shareScroll").css('overflow','hidden');
          shareScroll= new IScroll("#shareScroll",{
                    bounce :false,
                    useTransform:true,
                    tap:true,
                    zoom:true,
                    probeType:2

                });
 shareScroll.on("scrollEnd",function(){
            //var a=fun.pagenum();
             var page=share_page-1
            if(shareAllPage>page&&!isloading){
                //判定是否划到底
                goshare(share_page);
                setTimeout(function(){

                    shareScroll.refresh();
                },20)
            }
        })

</script>


