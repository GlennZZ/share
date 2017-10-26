<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#app-game-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="page-title">
	<h3>
		活动发布管理
		<small> >>管理 </small>
	</h3>
</div>
<div id="page-content">
	<div style="padding-bottom: 10px">
		<a href="<?php echo $this->createUrl('create',array('category'=>$_GET['category']));?>" class="btn medium primary-bg ">
			<span class="button-content">
				<i class="glyph-icon icon-plus float-left "></i>
				添加活动
			</span>
		</a>
	</div>
	<div class="search-form">
<?php

$this->renderPartial('_search', array(
	'model'=>$model
));
?>
</div>
	<!-- search-form -->

<?php

$tpl='<div class="content-box">
		<table class="table table-hover text-center">
			<tbody>{items}
			</tbody>
		</table>
	<table class="items">
			<tbody>
	<tr><td style="text-align:left;">
	
		<button type="button" onclick="GetCheckbox(1);" class="label primary-bg">删除所选</button>
		<!--<button type="button" onclick="GetCheckbox(2);" class="label  primary-bg ">设为首发</button>-->
		<!--<button type="button" onclick="GetCheckbox(3);" class="label  primary-bg ">设为推荐</button>-->
		<button type="button" onclick="GetCheckbox(4);" class="label  primary-bg ">上架</button>
		<button type="button" onclick="GetCheckbox(5);" class="label  primary-bg ">下架</button>
		<!--<button type="button" onclick="GetCheckbox(6);" class="label  primary-bg ">设为搜索热推</button>-->
	</td></tr>
			</tbody>
		</table>
	</div>
	<div class="summary" style="float: left;">{summary}</div>
	<div class="pager">{pager}</div>';

	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'app-game-grid',
		'template'=>$tpl,
		'dataProvider'=>$model->search(),
		/*'ajaxUpdate'=>false,*/
		'enableHistory'=>true,
		/*'filter'=>$model,*/
		'columns'=>array(
			array(
				'name'=>'<input type="checkbox" id="checkall">',
				'value'=>'	CHtml::checkBox("selectopen[]",0,array("id"=>"plugin-grid_c0_".$data->id,"value"=>$data->id,"data-id"=>$data->id))',
				'type'=>'raw',
				'htmlOptions'=>array(
					'width'=>'10',
					'style'=>'text-align:center',
					'class'=>'form-checkbox-radio'
				),
				'headerHtmlOptions'=>array(
					'width'=>'24px',
					'style'=>'text-align:center',
					'class'=>'form-checkbox-radio'
				)
			),
			array(
				'name'=>'icon',
				'value'=>'CHtml::image($data->icon,"",
				array(
				"height"=>150,
				"class"=>"medium radius-all-2",
			 	"onclick"=>"image_priview($(this).attr(\"src\"))",
				"style"=>"cursor: -webkit-zoom-in;"
				)
			)',  // 这里显示图片
				'type'=>'raw',  // 这里是原型输出
				'htmlOptions'=>array(
					'width'=>'200',
					'style'=>'text-align:center'
				)
			),
			'name',
			/*'desc',*/
			/*'icon',*/
			/*'url',*/
			array(
				'name'=>'classify',
				'value'=>'Yii::app()->params[classify][$data->classify]'
			),
			/*
			 'area',
	'company',
	'prize_name',
	'category',
	'type',
	'posid',*/
	
			
			//'integral',
			array('name'=>'integral','value'=>'\'<font color=red><label id="num-2-\'.$data->id.\'">\'.$data->integral.\'</label></font>\'','type'=>'raw'),
			array(
				'name'=>'integral_all',
				'value'=>'\'<label id="num-\'.$data->id.\'">\'.$data->integral_all.\'</label><div class="dropdown">
                                <a href="javascript:;" class="btn medium bg-white" title="更改投放" data-toggle="dropdown">
                                    <span class="button-content">
                                        <i class="glyph-icon icon-pencil"></i>
		
                                    </span>
                                </a>
                                <div class="dropdown-menu pad0A float-right" >
                                    <div class="medium-box" style="width:300px">
                                        <div class="bg-gray text-transform-upr font-size-12 font-bold font-gray-dark pad10A">更改投放</div>
                                                <form id="num-form-\'.$data->id.\'" action="" class="col-md-12" method="" />
													<div class="form-row">
                                                        <div class="form-label col-md-3">
                                                            <label for="">
                                                               	 操作:
		
                                                            </label>
                                                        </div>
                                                        <div class="form-checkbox-radio col-md-8">
                                                            <input type="radio" name="num_type" value=1 checked="checked"> <label for="add_$data->id">增加</label>
			  												<input type="radio" name="num_type" value=2 ><label for="reduce_$data->id">减少</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-label col-md-3">
                                                            <label for="">
                                                               	 数量:
		
                                                            </label>
                                                        </div>
                                                        <div class="form-input col-md-8">
                                                            <input type="text" id="num" name="num" data-type="number" data-trigger="change" data-required="true" class="parsley-validated" />
		
			<p style="display: inline-block;">(份)库存不能少于1</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-row" >
                                                        <input type="hidden"  name="aid" value="\'.$data->id.\'" />
                                                        <div class="form-input col-md-8 col-md-offset-4 float-right">
                                                            <a href="javascript:;" class="btn medium primary-bg radius-all-4 float-right" id="demo-form-valid" onclick="updateNum(\'.$data->id.\')" title="Validate!">
                                                                <span class="button-content">
                                                                    确定
                                                                </span>
                                                            </a>
		
                                                        </div>
                                                    </div>
		
                                                </form>
                                    </div>
                                </div>
                                </div>\'',
				'type'=>'raw'
			),
			//'integral_all',
			/*
			 'participation_num',
	'participation_num_t',
	'share_num',
	'share_num_t',
	'share_proportion',
	'share_proportion_t',*/
			'clicks',
			'share_clicks',
			'share_num',
			'start_tm',
			array(
				'name'=>'stop_tm',
				'value'=>'$data->stop_tm?$data->stop_tm:无'
			),
			array(
				'name'=>'状态',
				'value'=>'$data->stop_tm?(strtotime($data->stop_tm)<time()?\'<font color=red>下架</font>\':\'<font color=green>上架中</font>\'):\'<font color=green>上架中</font>\'',
				'type'=>'html'
			),
			//'ctm',
			/*'utm',*/
			array(
				'class'=>'CButtonColumn',
				'template'=>'{config}{update}{delete}',
				'viewButtonOptions'=>array(
					'title'=>'查看',
					'style'=>'padding:10px'
				),
				'updateButtonOptions'=>array(
					'title'=>'修改',
					'style'=>'padding:10px'
				),
				'header'=>'管理操作',
				'htmlOptions'=>array(
					"width"=>'20%'
				),
				'buttons'=>array(
					'delete'=>array(
						'imageUrl'=>null,
						'label'=>'<i class="glyph-icon icon-remove"></i>删除',
						'options'=>array(
							'class'=>'ext-cbtn delete tooltip-button',
							'title'=>'',
							'data-original-title'=>"编辑"
						)
					),
					'update'=>array(
						'imageUrl'=>null,
						'title'=>'',
						'label'=>'<i class="glyph-icon icon-edit"></i>编辑',
						'options'=>array(
							'class'=>'ext-cbtn'
						)
					),
					'config' => array(
						'title' => '',
						'label' => '<i class="glyph-icon icon-eye-open"></i>积分消耗明细',
						'options' => array(
							'class' => 'ext-cbtn'
						),
						'url' => 'Yii::app()->getController()->createUrl("/admin/SysMemberRecord/admin2", array("aid"=>"$data->id"))'
					),
				)
			)
	
		)
	
	));
	
?>
</div>
<script>
$('input:radio[name="list"]:checked').val();
$('.js_is_friend').click(function(){
	$c('.js_is_friend_type').hide();
	$c('.js_is_friend_type_'+$(this).attr('data-id')).show();
});

function updateNum(frmid){
	if($('#num-form-'+frmid).parsley( 'validate' )){
		$($('#num-form-'+frmid)).parents('div.dropdown').removeClass('open');
		var tip=top.art.dialog({id: "Tips",title: false,cancel: false,fixed: true,lock: true,content:"正在提交..", icon: "succeed",time:30000, background:"#000000",  opacity: .3  }) ;
		$.ajax( {
		    url:'<?php U('updateNum')?>',
		    data:$('#num-form-'+frmid).serialize(),
		    type:'post',
		    dataType:'json',
		    success:function(data) {
		           if(data.code>0){
			           //$('#num-'+frmid).text(data.result);
		        	   tip.content('操作成功');
		        	   $('#num-2-'+frmid).text(data.result.integral);
		        	   $('#num-'+frmid).text(data.result.integral_all);
		        	   setTimeout(function(){
		        		   tip.close();
			        	  },800);
		        	   //location.reload();
			        }else{
			        	tip.close();
						alert(data.msg);
			       }

		     },
		     error : function() {

		          alert("网络异常！");
		     }
		});
	}
}
function GetCheckbox(type){
    var data=new Array();
    $("input:checkbox[name='selectopen[]']").each(function (){
            if($(this).is(":checked")){
                data.push([$(this).val(),$('#etime'+$(this).attr('data-id')).val(),$('#maxnum'+$(this).attr('data-id')).val()]);
            }

    });
    if(data.length > 0){
    	Wind.use("artDialog","iframeTools",function(){
    		art.dialog.confirm('确定要批量操作所选项吗？', function () {
    			$.post("<?php U('batchOps')?>?type="+type,{'data[]':data}, function (data) {
                   if (data=='ok') {                                   
                         top.art.dialog({
                        	    content: '操作成功!',
                        	    ok: function () {
                        	    	 location.reload();
                        	    },
                        	    lock:true,
                        	    icon: 'succeed',
                        	    cancel: function(){ location.reload();}
                        	});
                   }else{
 						alert("操作失败");
                   }
    			});
    		}, function () {
    		    art.dialog.tips('执行取消操作');
    		});
    		
        	
    		

        });
    	
    }else{
        alert("请选择要操作的选项!");
    }

}
jQuery(document).on('click','#checkall',function() {
var checked=this.checked;
jQuery("input[name='selectopen\[\]']:enabled").each(function() {this.checked=checked;});
});
jQuery(document).on('click', "input[name='selectdel\[\]']", function() {
jQuery('#checkall').prop('checked', jQuery("input[name='selectdel\[\]']").length==jQuery("input[name='selectdel\[\]']:checked").length);
});
</script>