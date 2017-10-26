<section class="index " id="index">
    <div class="headerDiv">
        <div class="logoDiv">
            <img src="<?php echo $this->assets(); ?>/images/logo.png">
        </div>
        <div class="searchDiv">
           <span style="FLOAT: LEFT;">全部</span>
            <i class="ic-more"></i>
        </div>
        <div class="goCenterDiv">
            <a href="<?php echo Yii::app()->createUrl('/member/index'); ?>"> <i class="ic-sort"></i></a>
        </div>
    </div>
    <div class="cf">
    <div class="sortDiv">
        <span class="fontRed newList">最新</span>
        <span class="hot1">火热</span>
        <span class="hot2">推荐</span>
    </div>
    <div class="mainIndexDiv" id="indexScroll">
        <ul>

        </ul>
    </div>
    </div>
    <div class="searchResultDiv dis_none ">
        <div class="cf bgwhite">
            <div class="border1 marLf2 searchInputDiv">
                <i class="ic-search"></i>
                <input placeholder="输入商户名" class="searchName" oninput="searchStore($(this))">
            </div>
            <div class="storeName">
                <ul class="marLf2">
                <?php 
                foreach ($tenant as $k=>$v){
                ?>
                <li >
                      <p data-id='<?php echo $v->id; ?>' class=" font bor2" ><?php echo $v->name?></p>
                </li>
                <?php 	
                }
                ?>
                </ul>
            </div>
        </div>

    </div>
</section>

<script type="text/javascript">
WX_STAT.init({
  	hideToolbar:true,
	hideOptionMenu:false,
	title:'<?php echo $this->webconfig['index_shareTitle'];?>',
	desc: '<?php echo $this->webconfig['index_shareDesc'];?>',
	img:"<?php echo $this->webconfig['index_shareIcon'];?>",
	link:"<?php echo Yii::app()->request->hostInfo.Yii::app()->request->getUrl();?>"
  } );
</script>
<script type="text/javascript">
	var hei=document.documentElement.clientHeight-160;
	if($("#indexScroll").length>0){
	$("#indexScroll").css('height',hei+'px');
	var indexScroll= new IScroll("#indexScroll",{tap:true});
	indexScroll.on("scrollEnd",function(){
		//var a=fun.pagenum();
		if(indexAllPage>=index_page){
			//判定是否划到底
//	  console.log(indexAllPage,index_page);
	  if(issearch==0){
	    indexSort(sortId,index_page);
	  }else{
	    var searchName= $('.searchDiv span').text();
            searchStore1(searchId,searchName)
	  }

			setTimeout(function(){
				indexScroll.refresh();
			},20)
		}
	});
	 indexSort(1,1);
	}
</script>
