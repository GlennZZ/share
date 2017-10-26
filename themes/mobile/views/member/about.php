<section class="aboutUsSection bgColor ">
    <div class="title">
        <i class="ic-back"></i>
        <span>关于联联圈</span>
    </div>
    <div class="usDiv">
        <img src="<?php echo $this->assets(); ?>/images/aboutText.jpg">
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


