<div id="page-title">
	<h3>
		添加操作
		<small> >添加 </small>
	</h3>
</div>
<div id="page-content">
	<div style="padding-bottom: 10px">
		<a href="<?php echo$this->createUrl('admin',array('category'=>$_GET['category']))?>" class="btn medium primary-bg">
			<span class="button-content">
				<i class="glyph-icon icon-reply float-left"></i>
				返回
			</span>
		</a>
	</div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
