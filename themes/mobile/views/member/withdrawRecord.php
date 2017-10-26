<section class="withdrawRecordSection  ">
    <div class="title border1">
        <i class="ic-back"></i>
        <span>提现记录</span>
    </div>
    <div class="recordDiv" id="recorScroll">
        <ul>
<p class="noneData">数据加载中..</p>
        </ul>
    </div>
</section>
<script type="text/javascript">
 var hei=document.documentElement.clientHeight-85;
        $("#recorScroll").css('height',hei+'px');
        recorScroll= new IScroll("#recorScroll",{
            bounce :false,
            useTransform:true,
            click:true,
            zoom:true,
            probeType:2
        });
        recorScroll.on("scrollEnd",function(){
            //var a=fun.pagenum();
             var page=record_page-1
            if(recodeAllpage>page){
                //判定是否划到底
                recordDetail(record_page);
                setTimeout(function(){
                    recorScroll.refresh();
                },20)
            }
        })
          recordDetail(1)
WX_STAT.init({
  	hideToolbar:true,
	hideOptionMenu:false,
	title:'<?php echo $this->webconfig['index_shareTitle'];?>',
	desc: '<?php echo $this->webconfig['index_shareDesc'];?>',
	img:"<?php echo $this->webconfig['index_shareIcon'];?>",
	link:"<?php echo Yii::app()->request->hostInfo;?>"
  } );
</script>


