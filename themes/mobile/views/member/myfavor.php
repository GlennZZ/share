<section class="myfavorSection ">
    <div class="title">
        <i class="ic-back"></i>
        <span>我的收藏</span>
    </div>
    <div class="mainfavorDiv" id="favorScore">
        <ul>
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
   var hei=document.documentElement.clientHeight-85;
          $("#favorScore").css('height',hei+'px');
            $("#favorScore").css('overflow','hidden');
    gofavor(1);
          favorScore= new IScroll("#favorScore",{
              bounce :false,
              useTransform:true,
              tap:true,
              zoom:true,
              probeType:2

          });
          favorScore.on("scrollEnd",function(){
              //var a=fun.pagenum();
              var page=favor_page-1

              if(favorAllpage>page&&!isloading){
                  //判定是否划到底
                  gofavor(favor_page);
                  setTimeout(function(){
                      favorScore.refresh();
                  },20)
              }
          })
</script>


