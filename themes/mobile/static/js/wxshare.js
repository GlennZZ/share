
/**!
 * 微信内置浏览器的Javascript API及联众互动js统一封装，功能包括：
 * 1、分享到微信朋友圈
 * 2、分享给微信好友
 * 3、分享到腾讯微博
 * 4、隐藏/显示右上角的菜单入口
 * 5、隐藏/显示底部浏览器工具栏
 * 6、自动调用统计函数
 * @author wintrue(http://wintrue.cn)
 */
(function(W) {
	var WX_STAT = W.WX_STAT = {};
	WX_STAT.debug=false;
	var dataForWeixin;
	var setting = {
		aid : 0,
		wxid : '',
		fromType : 0,
		fromWxid : '',
		attent : 0
	};
	WX_STAT.dataForWeixin = {
		shareTimelineType:0,
		hideToolbar : true,
		hideOptionMenu : false,
		networkType : "",
		title : "",
		desc : "",
		img : "",
		link : "",
		appId : ""

	};
	var _extend = function () {
        var result = {}, obj, k;
        for (var i = 0, len = arguments.length; i < len; i++) {
            obj = arguments[i];
            if (typeof obj === 'object') {
                for (k in obj) {
                    obj[k] && (result[k] = obj[k]);
                }
            }
        }
        return result;
    };
	var shareCallback = {};
	WX_STAT.init = function(config, shareCallbackfun, seting_config) {
		var body = document.body;
		if (!body) {
			alert('"documents.body" not ready')
		}
		
		var ua = window.navigator.userAgent.toLowerCase(); 
		if(ua.match(/MicroMessenger/i) != 'micromessenger'){ 
			return ; 
		} 
		var regroup = function(shareCallbackfun) {
			config = config || {};
			dataForWeixin = WX_STAT.dataForWeixin;
			for ( var i in dataForWeixin) {
				if (config[i] !== undefined) {
					dataForWeixin[i] = config[i];
				}
				if(config[i+'_vars']){
					for ( var ii in config[i+'_vars']) {
						var _var=config[i+'_vars'][ii];
						dataForWeixin[i]=dataForWeixin[i].replace(ii, eval(_var));
					}
				}
			}
			return dataForWeixin;
			
		}
		
		seting_config = seting_config || {};
		for ( var i in setting) {
			if (seting_config[i] !== undefined) {
				setting[i] = seting_config[i];
			}
		}
		shareCallback = shareCallbackfun;
		regroup();
		wx.ready(function () {
			// 隐藏或显示右上角按钮
			if (dataForWeixin.hideOptionMenu) {
				 wx.hideOptionMenu();
			} else {
				 wx.showOptionMenu();
			}
			// 2.1 监听“分享给朋友”，按钮点击、自定义分享内容及分享结果接口
			wx.onMenuShareAppMessage({
			  title: dataForWeixin.title,
			  desc: dataForWeixin.desc,
			  link: dataForWeixin.link,
			  imgUrl: dataForWeixin.img,
			  trigger: function (res) {
							
			  },
			  success: function (res) {
				shareCallback.ok && shareCallback.ok(res);
			  },
			  cancel: function (res) {
				shareCallback.cancel && shareCallback.cancel(res);
			  },
			  fail: function (res) {
				shareCallback.fail && shareCallback.fail(res);
			  }
			});
			// 2.2 监听“分享到朋友圈”按钮点击、自定义分享内容及分享结果接口
			wx.onMenuShareTimeline({
			  title: dataForWeixin.shareTimelineType?dataForWeixin.desc:dataForWeixin.title,
			  link: dataForWeixin.link,
			  imgUrl: dataForWeixin.img,
			  success: function (res) {
					shareCallback.ok && shareCallback.ok(res);
			  },
			  cancel: function (res) {
				shareCallback.cancel && shareCallback.cancel(res);
			  },
			  fail: function (res) {
				shareCallback.fail && shareCallback.fail(res);
			  }
			});
			// 2.3 监听“分享到QQ”按钮点击、自定义分享内容及分享结果接口
			wx.onMenuShareQQ({
			  title: dataForWeixin.title,
			  desc: dataForWeixin.desc,
			  link: dataForWeixin.link,
			  imgUrl: dataForWeixin.img,
			  success: function (res) {
				shareCallback.ok && shareCallback.ok(res);
			  },
			  cancel: function (res) {
				shareCallback.cancel && shareCallback.cancel(res);
			  },
			  fail: function (res) {
				shareCallback.fail && shareCallback.fail(res);
			  }
			});
			 // 2.4 监听“分享到微博”按钮点击、自定义分享内容及分享结果接口
			wx.onMenuShareWeibo({
			  title: dataForWeixin.title,
			  desc: dataForWeixin.desc,
			  link: dataForWeixin.link,
			  imgUrl: dataForWeixin.img,
			  success: function (res) {
				shareCallback.ok && shareCallback.ok(res);
			  },
			  cancel: function (res) {
				shareCallback.cancel && shareCallback.cancel(res);
			  },
			  fail: function (res) {
				shareCallback.fail && shareCallback.fail(res);
			  }
			});
		})
		
	};
})(window);
