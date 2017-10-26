$(document).ready(function () {
    //media({
    //    musicSrc:"audio/way.mp3",
    //    musicPlaySrc:"images/mPlay.png",
    //    musicPauseSrc:"images/mPaused.png"
    //});

    // function stopScrolling( e ) {
    //    e.preventDefault();
    // }
    // document.addEventListener( 'touchmove' , stopScrolling , false );
    //关闭弹窗
    $('.titile i').on('click', function () {
        sessionStorage.refresh = 1;
        window.history.go(-1);
    });
    $(".close").on("click", function () {
        var Id = $(this).parents(".popup");
        close(Id)
    });

    $('.searchDiv').on('click', function () {
        if (!isclicked) {
            $('.searchResultDiv').removeClass('dis_none');
            isclicked = true
        } else {
            $('.searchResultDiv').addClass('dis_none');
            isclicked = false;
        }
    });
    $('.mainIndexDiv li img').on('click', function () {
        var id = $(this).parents('li').attr('data-id');
        goPlayDetail(id)
    });
    $('.myCenterSection .mycenterBack').on('click', function () {
        window.history.go(-1);
    });
    $('.playDetailSection .mycenterBack').on('click', function () {
        window.history.go(-1);
    });
    $('.myshareSection .title i').on('click', function () {
        window.history.go(-1);
        //$('.myshareSection ').addClass('dis_none')
        //$('.myCenterSection ').removeClass('dis_none')
        //goshare();
        //var hei=document.documentElement.clientHeight-85;
        //$("#shareScroll").css('height',hei+'px');


    });
    $('.shareDetailSection  .title i').on('click', function () {
        window.history.go(-1);
    });
    $('body').on('tap', '.myshareSection .mainShareDiv li', function () {

        var id = $(this).attr('data-id');
        window.location.href = sysParam.ajax_myshareDetailUrl + id;
    })
    $('body').on('tap', '.mainfavorDiv li', function () {
        var id = $(this).attr('data-aid')
        window.location.href = sysParam.detailView + id;
    })
    $('.myCenterSection .shareDiv').on('click', function () {
        $('.myCenterSection ').addClass('dis_none')
        $('.myshareSection ').removeClass('dis_none')
    })
    $('.myCenterSection .mycenterRulesDiv').on('click', function () {
        $('.myCenterSection ').addClass('dis_none')
        $('.scoreRules ').removeClass('dis_none')
    })
    $('.scoreRules  .title i').on('click', function () {
        window.history.go(-1);
    })
    $('.myCenterSection .aboutDiv').on('click', function () {
        $('.myCenterSection ').addClass('dis_none')
        $('.aboutUsSection ').removeClass('dis_none')
    })
    $('.aboutUsSection  .title i').on('click', function () {
        window.history.go(-1);
    })
    $('.myCenterSection .favorDiv').on('click', function () {
        //window.location.href=sysParam.ajax_myfavorUrl

    });
    $('.myfavorSection .title i').on('click', function () {
        window.history.go(-1);
    });
    $('.withdrawRecordSection .title i').on('click', function () {
        window.history.go(-1);
    });
    $('.numDiv .center p').on('click', function () {
        $('.myCenterSection  ').addClass('dis_none');
        $('.withdrawSection').removeClass('dis_none')
    });
    $('.withdrawSection .title i').on('click', function () {
        window.history.go(-1);
    });
    $('.ensureBtn').on('click', function () {
        //if(sysParam.isRegister==0){//如果没有注册
        //        window.location.href='';
        //}else{
        //    if(sysParam.isAttention==0){//已注册，但是没有关注
        //        showId($('.codeSection'))
        //    }else{
        var num = $('.mainDrawDiv .num').val();
        if (num == '') {
            alert('请输入提现金额')
        } else {
            submitScore(num)
        }
        //    }
        //
        //}

    });
    $('.sortDiv .newList').on('click', function () {
        $(this).addClass('fontRed').siblings().removeClass('fontRed');
        sortId = 1;
        var page = 1;
        index_page = 1;
        indexSort(sortId, page);
        indexScroll.scrollTo(0, 0, 200)
    });
    $('.sortDiv .hot1').on('click', function () {
        $(this).addClass('fontRed').siblings().removeClass('fontRed');
        sortId = 2;
        var page = 1;
        index_page = 1;
        indexSort(sortId, page);
        indexScroll.scrollTo(0, 0, 200)
    });
    $('.sortDiv .hot2').on('click', function () {
        $(this).addClass('fontRed').siblings().removeClass('fontRed');
        sortId = 3;
        var page = 1;
        index_page = 1;
        indexSort(sortId, page);
        indexScroll.scrollTo(0, 0, 200)
    });
    $('.codeSection').on('click', function () {
        close($(this))
    });
    $('.scoreDetail').on('click', function () {
        $('.withdrawSection').addClass('dis_none');
        $('.withdrawRecordSection').removeClass('dis_none')
    });
    //$('.playTime i').on('click',function(){
    //    var id =$(this).parents('li').attr('data-id')
    //    clickZan(id,$(this))
    //})
    $('.myCenterSection .recordDiv').on('click', function () {
        recordDetail(1)

    })

    $("#verifyCodeVBtn").on('click', function () {
        var phone = $('.telInput').val();
        getVerifyCode2(phone)
    });
    $(".registerBtn").on('click', function () {
        $.ajax({
            type: 'post',
            url: '/member/regester',
            dataType: 'json',
            data: $('#regester').serialize(),
            timeout: 15000,
            success: function (data) {
                if (data.result_code == 1) {
                    alert("注册成功！");
                    location.href=sysParam.index;
                } else {
                    alert(data.result_msg);
                }
            },
            error: function (xhr, type) {
                alert('网络超时，请刷新后再试！');
            }
        });
    })
    $('body').on('tap', '.indeximgDiv', function () {
        var id = $(this).parents('li').attr('data-id')
        window.location.href = sysParam.detailView + id;
    })
    $('body').on('tap', '.playTime i', function () {
        var id = $(this).parents('li').attr('data-id')
        clickClect(id, $(this))
    })
    $('body').on('click', '.storeName li', function () {
        searchId = $(this).find('p').attr('data-id');
        var searchName = $(this).find('p').text();
        index_page = 1;
        issearch = 1;
        searchStore1(searchId, searchName)

    })
    $('.shareBtn').on('click', function () {
        if ($(this).attr('data') == '1') {
            showId($('.shareIip'))
        } else {
           showId($('.noIip'))
        }
    })
    $('.shareIip,.noIip').on('click', function () {
        close($(this))
    })
});
function getName(str) {
    var str_length = 0, len = 70, str_len = 0, str_cut = new String(), a;
    str_len = str.length;
    for (var i = 0; i < str_len; i++) {
        a = str.charAt(i);
        str_length++;
        if (escape(a).length > 4) {
            str_length++;
        }
        str_cut = str_cut.concat(a);
        if (str_length > len) {
            str_cut = str_cut.concat("...");
            return str_cut;
        }
    }
    if (str_length <= len) {
        return str;
    }
}
var issearch = 0, searchId = 0;
function clickClect(id, _this) {
    $.ajax({
        type: 'post',
        url: sysParam.ajax_submitCollect,
        dataType: 'json',
        data: {
            id: id,
        },
        timeout: 15000,
        success: function (data) {
            if (data.result_code == 1) {
                alert(data.result_msg);
                var status = _this.attr('data-id')
                if (status == 1) {
                    _this.removeClass('ic-heart').addClass('ic-heart-empty')
                    _this.attr('data-id', 2)
                } else {
                    _this.removeClass('ic-heart-empty').addClass('ic-heart')
                    _this.attr('data-id', 1)
                }
            } else {
                alert(data.result_msg);
            }
        },
        error: function (xhr, type) {
            alert('网络超时，请刷新后再试！');

        }
    });
}
var recorScroll, recod_ok = 0, record_page = 1, recodeAllpage = 1;
var shareScroll, share_ok = 0, share_page = 1, shareAllPage = 1;
var scoreDetailScroll, scoreDetail_ok = 0, scoreDetail_page = 1, shareDetailPage = 1;
var favorScore, favor_ok = 0, favor_page = 1, favorAllpage = 1;
var index_ok = 0, index_page = 1;
var code_click = false;
function getVerifyCode2(phone) {
    if (code_click)return;
    var reg = $(".regesterSection ").attr('data-reg');
    var REG = {
        name: /^[a-zA-Z0-9\u4e00-\u9fa5]{2,12}$/,
        phone: /(^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$)|(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/
    };
    if (!REG.phone.test(phone)) {
        alert("请输入正确的手机号码");
    } else {
        console.log(phone)
        $.ajax({
            type: 'post',
            url: '/member/regester?get_code=1',
            dataType: 'json',
            data: {
                phone: phone,
            },
            timeout: 15000,
            success: function (data) {
                if (data.result_code == 1) {
                    //    倒计时
                    //fun.time2();
                    $('#verifyCodeVBtn').attr("disabled", false);
                    code_click = true;
                    var time = 60;
                    var t = setInterval(function () {
                        time--;
                        $('#verifyCodeVBtn').text(time + '秒后可重发');
                        if (time <= 0) {
                            $('#verifyCodeVBtn').attr("disabled", true).text('获取验证码');
                            code_click = false;
                            clearInterval(t);
                        }
                    }, 1000);
                    alert("验证码已发送至您的手机");
                } else {
                    alert(data.result_msg);
                }
            },
            error: function (xhr, type) {
                alert('网络超时，请刷新后再试！');

            }
        });
    }
}
var wait = 60;
function time() {
    var btntxt = $("#verifyCodeVBtn");
    var btntxt2 = $("#verifyCodeVBtn2");
    if (wait == 0) {
        btntxt.removeClass("dis_none");
        btntxt2.addClass("dis_none");
        btntxt.text("获取验证码");
        wait = 60;
    } else {
        btntxt2.removeClass("dis_none");
        btntxt.addClass("dis_none");
        wait--;
        btntxt2.text("重新发送(" + wait + ")s");
        setTimeout(function () {
            time();
        }, 1000)
    }
}
var isclicked = false;
function searchStore1(id, searchName) {
    $.ajax({
        type: 'post',
        url: sysParam.ajax_searchStore,
        dataType: 'json',
        timeout: 15000,
        data: {
            id: id
        },
        success: function (data) {
            if (data.result_code == 1) {
                $('.searchResultDiv').addClass('dis_none');
                isclicked = true;
                var html = '';
                var length = data.gameList.length;
                if (length > 0) {
                    for (var i = 0; i < length; i++) {
                        html += '<li data-id=' + data.gameList[i].id + '>';
                        html += '<div class="titleDiv"><span class="ftRed">' + data.gameList[i].tenant + ':' + data.gameList[i].name + '</span>';//标题
                        html += '<div class="scoreDiv"><i class="ic-score"></i><span class="score">' + data.gameList[i].integral_share + '积分</span>';//积分
                        html += '</div></div><div class="indeximgDiv"><img src=' + data.gameList[i].icon + '></div>';//图片
                        html += '<div class="detailDiv"> <p class="detailText">' + data.gameList[i].note; //描述
                        html += '<span class="pageView"><i class="ic-eye"></i><span>' + data.gameList[i].clicks + '</span></span></p>';//浏览数
                        html += '<div class="playTime"> <p>活动时间：<span>' + data.gameList[i].start_tm + '</span>-<span>' + data.gameList[i].stop_tm + '</span></p>'//活动起止时间
                        if (data.gameList[i].collect == 1) {
                            html += '<i class="ic-heart1" data-id=1></i>'
                        } else {
                            html += '<i class="ic-heart2" data-id=2></i>'
                        }
                        html += '</div></div><div class="space"></div></li>';
                    }
                } else {
                    html += '<p class="noneData">还没有分类哦</p>';
                }
                if (index_page == 1) {
                    $('.index .mainIndexDiv ul').html('').append(html);
                } else {
                    $('.index .mainIndexDiv ul').append(html);
                }
                $('.searchDiv span').text(searchName)
                sortId = 1;
                indexAllPage = data.allPage
                index_page++;
                // indexScroll.refresh();
                setTimeout(function(){
                   indexScroll.refresh();
                },20)
            }
        },
        error: function (xhr, type) {
            data.msg('网络超时，请刷新后再试！');
        }
    })
}
function searchStore(_this) {
    var name = _this.val();
    $.ajax({
        type: 'post',
        url: sysParam.ajax_search2,
        dataType: 'json',
        timeout: 15000,
        data: {
            name: name
        },
        success: function (data) {
            if (data.result_code == 1) {
                isclicked = true;
                var html = '';
                var length = data.result_data.list.length;
                if (length > 0) {
                    for (var i = 0; i < length; i++) {
                        html += '<li >';
                        html += '<p data-id=' + data.result_data.list[i].id + ' class=" font bor2" >' + data.result_data.list[i].name + '</p>'
                        html += '  </li>';
                    }
                } else {
                    html += '<p class="noneData">还没有分类哦</p>';
                }

                $('.storeName ul').html('').append(html)
                $('.searchDiv span').text(name)
            }
        },
        error: function (xhr, type) {
            data.msg('网络超时，请刷新后再试！');
        }
    })
}
function clickZan(id, _this) {
    $.ajax({
        type: 'post',
        url: sysParam + 'ajax_submitZan',
        dataType: 'json',
        timeout: 15000,
        data: {
            id: id
        },
        success: function (data) {
            if (data.result_code == 1) {
                _this.removeClass('ic-heart1').addClass('ic-heart2');
                alert(data.msg)
            }
        },
        error: function (xhr, type) {
            data.msg('网络超时，请刷新后再试！');
        }
    })
}

var indexAllPage = 1, sortId = 1;
function indexSort(sortId, page) {
    $.ajax({
        type: 'post',
        url: sysParam.postSort,
        dataType: 'json',
        timeout: 15000,
        data: {
            type: sortId,
            page: page
        },
        success: function (data) {
            if (data.result_code == 1) {
                var html = '';
                var length = data.gameList.length;
                if (length > 0) {
                    for (var i = 0; i < length; i++) {
                        //$('.detailDiv p.detailText').text( )
                        html += '<li data-id=' + data.gameList[i].id + '>';
                        html += '<div class="titleDiv"><span class="ftRed">' + data.gameList[i].tenant + ':' + data.gameList[i].name + '</span>';//标题
                        html += '<div class="scoreDiv"><i class="ic-score"></i><span class="score">' + data.gameList[i].integral_share + '积分</span>';//积分
                        html += '</div></div><div class="indeximgDiv"><img src=' + data.gameList[i].icon + '></div>';//图片
                        html += '<div class="detailDiv"> <p class="detailText">' + getName(data.gameList[i].note); //描述
                        html += '<span class="pageView"><i class="ic-eye"></i><span>' + data.gameList[i].clicks + '</span></span></p>';//浏览数
                        html += '<div class="playTime"> <p>活动时间：<span>' + data.gameList[i].start_tm + '</span>-<span>' + data.gameList[i].stop_tm + '</span></p>'//活动起止时间
                        if (data.gameList[i].collect == 1) {
                            html += '<i class="ic-heart" data-id=1></i>'
                        } else {
                            html += '<i class=" ic-heart-empty" data-id=2></i>'
                        }
                        html += '</div></div><div class="space"></div></li>';
                    }
                } else {
                    html += '<p class="noneData">还没有分类哦</p>';
                }
                if (index_page == 1) {
                    $('.index .mainIndexDiv ul').html('').append(html);
                } else {
                    $('.index .mainIndexDiv ul').append(html);
                }
                //console.log($('.detailDiv p:nth-of-type(1)').text())

                indexAllPage = data.allPage;
                index_page++;
                setTimeout(function(){
                   indexScroll.refresh();
                },20)
            }
        },
        error: function (xhr, type) {
            data.msg('网络超时，请刷新后再试！');
        }
    })
}
function beforeAjaxSend() {
    console.log($("#progressImgage").attr('data-id'))
    //imgloading.removeClass('dis_none')
    //maskloading.removeClass('dis_none')
    $("#progressImgage").show().css({
        "position": "fixed",
        "top": "40%",
        "left": "45%",
        "margin-top": function () {
            return -1 * img.height() / 2;
        },
        "margin-left": function () {
            return -1 * img.width() / 2;
        }
    });
    $("#maskOfProgressImage").show().css("opacity", "0.1");
}

function completeAjaxSend() {
    $("#progressImgage").hide();
    $("#maskOfProgressImage").hide();
}
function submitScore(num) {
    $.ajax({
        type: 'post',
        url: sysParam.ajax_submitScore,
        dataType: 'json',
        timeout: 15000,
        data: {
            num: num
        }, beforeSend: function (xhr) {
            beforeAjaxSend()
        },
        success: function (data) {
            if (data.result_code == 1) {
                showId($('.textTip'));
                $('.textTip').text(data.result_msg);
                setTimeout(function () {
                    close($('.textTip'))
                }, 2000)
            } else if (data.result_code == -1) {
                showId($('.codeSection'))
            } else if (data.result_code == -2) {
                showId($('.textTip'));
                $('.textTip').text(data.result_msg);
                setTimeout(function () {
                    close($('.textTip'))
                }, 2000)
            } else if (data.result_code == -3) {
            	alert(data.result_msg);
                location.href='/member/regester';
            }
        },
        error: function (xhr, type) {
            data.msg('网络超时，请刷新后再试！');
        },
        complete: function (xhr) {
            completeAjaxSend()
        }
    })
}
var isloading = false;
function gofavor(page) {
    isloading = true;
    $.ajax({
        type: 'post',
        url: sysParam.ajax_myfavorUrl,
        dataType: 'json',
        timeout: 15000,
        data: {
            page: page
        },
        success: function (data) {
            if (data.result_code == 1) {
                var html = '';
                var length = data.gameList.length;  //收藏的条数
                if (length > 0) {
                    for (var i = 0; i < length; i++) {
                        html += '<li data-id=' + data.gameList[i].id + ' data-aid=' + data.gameList[i].aid + '><div class="favorImgDiv">';
                        html += '<img src=' + data.gameList[i].icon + '></div>';//收藏的图片
                        html += '<div class="favorInfoDiv">';
                        html += ' <p><span>' + data.gameList[i].uname + ':' + data.gameList[i].name + '</span>';//收藏的图片
                        if (data.gameList[i].status == 1) {//如果是正在进行
                            html += '<span class="ftRed fr staus">进行中</span></p>';
                        } else if (data.gameList[i].status == 2) {
                            html += '<span class=" fr staus">活动未开始</span>';
                        } else if (data.gameList[i].status == 3) {
                            html += '<span class=" fr staus">活动结束</span>';
                        }
                        html += ' <p>活动时间：' + data.gameList[i].start_tm + '-' + data.gameList[i].stop_tm + '</p>';//具体时间
                        html += ' <p><i class="ic-score"></i> <span>' + data.gameList[i].integral + '</span></p></div></li>'   //已获得多少积分
                    }
                } else {
                    html = '<p class="noneData">您还没有分享哟</p>';
                    $('.myfavorSection .mainfavorDiv ul').html('').append(html);
                }
                favorAllpage = data.allPage;
                if (favorAllpage == 1 || length == 0) {
                    $('.myfavorSection .mainfavorDiv ul').html('').append(html);
                } else {
                    $('.myfavorSection .mainfavorDiv ul').append(html);
                    favor_page++;
                    console.log(favor_page)
                }
                setTimeout(function () {
                    favorScore.refresh();
                }, 20)
                isloading = false;
            } else {
                alert(data.msg)
                isloading = false;
            }
        },
        error: function (xhr, type) {
            data.msg('网络超时，请刷新后再试！');
            isloading = false;
        }
    })
}
function goshare(page) {
    isloading = true;
    $.ajax({
        type: 'post',
        url: sysParam.ajax_myshareUrl,
        dataType: 'json',
        timeout: 15000,
        data: {
            page: page
        },
        success: function (data) {
            if (data.result_code == 1) {
                var html = '';
                var length = data.gameList.length;  //分享的条数
                if (length > 0) {
                    for (var i = 0; i < length; i++) {
                        if (data.gameList[i].status == 1) {//如果是正在进行
                            html += '<li data-id=' + data.gameList[i].id + '><div class="shareImgDiv">';
                            html += '<img src=' + data.gameList[i].icon + '></div>';//分享的图片
                            html += '<div class="shareInfoDiv">';
                            html += ' <p><span>' + data.gameList[i].uname + ':' + data.gameList[i].name + '</span>';//分享的标题
                            html += '<span class="ftRed fr staus">进行中</span></p>';
                            html += '<p class="ftRed scoreNum">已获得' + data.gameList[i].integral + '积分</p>';//已获得多少积分
                            html += ' <p>活动时间：' + data.gameList[i].start_tm + '-' + data.gameList[i].stop_tm + '</p></div> </li>';//具体时间
                        } else if (data.gameList[i].status == 3) {
                            html += '<li data-id=' + data.gameList[i].id + '><div class="shareImgDiv">';
                            html += '<img src=' + data.gameList[i].icon + '></div>';//分享的图片
                            html += '<div class="shareInfoDiv">';
                            html += ' <p><span>' + data.gameList[i].uname + ':' + data.gameList[i].name + '</span>';//分享的标题
                            html += '<span class=" fr staus">活动结束</span></p>';
                            html += '<p class=" scoreNum">已获得' + data.gameList[i].integral + '积分</p>';//已获得多少积分
                            html += ' <p>活动时间：' + data.gameList[i].start_tm + '-' + data.gameList[i].stop_tm + '</p></div> </li>';//具体时间
                        } else if (data.gameList[i].status == 2) {
                            html += '<li data-id=' + data.gameList[i].id + '><div class="shareImgDiv">';
                            html += '<img src=' + data.gameList[i].icon + '></div>';//分享的图片
                            html += '<div class="shareInfoDiv">';
                            html += ' <p><span>' + data.gameList[i].uname + ':' + data.gameList[i].name + '</span>';//分享的标题
                            html += '<span class=" fr staus">活动未开始</span></p>';
                            html += '<p class=" scoreNum">已获得' + data.gameList[i].integral + '积分</p>';//已获得多少积分
                            html += ' <p>活动时间：' + data.gameList[i].start_tm + '-' + data.gameList[i].stop_tm + '</p></div> </li>';//具体时间
                        }
                    }
                } else {
                    html = '<p class="noneData">您还没有分享哟</p>';

                }
                shareAllPage = data.allPage
                if (data.allPage == 1) {
                    $('.myshareSection .mainShareDiv ul').html('').append(html);
                } else {
                    $('.myshareSection .mainShareDiv ul').append(html);
                    share_page++;
                }
                setTimeout(function () {
                    shareScroll.refresh();
                }, 20)
                isloading = true;
            } else {
                alert(data.msg)
                isloading = true;
            }
        },
        error: function (xhr, type) {
            data.msg('网络超时，请刷新后再试！');
            isloading = true;
        }
    })
}
function recordDetail(page) {
    $.ajax({
        type: 'post',
        url: sysParam.ajax_goPlayDetail,
        dataType: 'json',
        data: {
            page: page
        },
        timeout: 15000,
        success: function (data) {
            if (data.result_code == 1) {
                var html = '';
                var length = data.gameList.length;  //提现记录的条数
                if (length > 0) {
                    for (var i = 0; i < length; i++) {
                        //if(data.gameList[0]){//如果是每月份第一条数据
                        //    html+='<li ><div class="recordLeft fl">';
                        //    html+='<span>'+data.data.month+'</span>' ;//月份
                        //    html+='<img src="images/time1.png"></div>';
                        //    html+='<div class="recordRight border1 fl">';
                        //    html+='<div class="rightLeft fl">';
                        //    html+='<p  class="fontTitle">积分提现</p>';
                        //    html+=' <p class="fontTime">'+data.data.time+'</p></div>';//具体时间
                        //    html+='<div class="rightRight fr">;';
                        //    html+='<p>'+data.data.money+'</p></div></div></li>';//多少钱
                        //}else{
                        html += '<li><div class="recordLeft fl" style="padding-top: 0">';
                        html += '<img src=' + sysParam.baseUrl + 'images/time2.png>';
                        html += '</div><div class="recordRight border1 fl">';
                        html += '<div class="rightLeft fl">';
                        html += '<p  class="fontTitle">积分提现</p>';
                        html += ' <p class="fontTime">' + data.gameList[i].ctm + '</p></div>';//具体时间
                        html += '<div class="rightRight fr">';
                        html += '<p>+' + data.gameList[i].money + '</p></div></div></li>';//多少钱
                        //}
                    }
                    recodeAllpage = data.allPage
                    $('.withdrawRecordSection .recordDiv ul').html('').append(html);
                    record_page++;
                    setTimeout(function () {
                        recorScroll.refresh();
                    }, 20)
                } else {
                    html = '<p class="noneData">还没有您的提现记录哟</p>';
                    $('.withdrawRecordSection .recordDiv ul').html('').append(html);
                }
            } else {
                alert(data.msg)
            }
        },
        error: function (xhr, type) {
            data.msg('网络超时，请刷新后再试！');
        }
    })
}
function goPlayDetail(id) {
    $.ajax({
        type: 'post',
        url: sysParam + 'ajax_goPlayDetail',
        dataType: 'json',
        data: {
            id: id
        },
        timeout: 15000,
        success: function (data) {
            if (data.result_code == 1) {
                var html = ''
                html += '<div class="titleImgDiv"><img src="images/back.png" class="mycenterBack">';
                html += '<img src=' + data.data.img + '>'//图片
                html += '<span class="restScore">还剩' + data.data.restScore + '积分</span></div>'//剩余积分
                html += '<div class="playInfoDiv border1"><div class="playTitle border1">'//
                html += '<span class="fl ftRed">' + data.data.title + '</span>'//标题
                html += '<div class="seeNum fl"><i class="ic-eye"></i>';
                html += '<span>' + data.data.num + '</span></div>';//浏览量
                html += '<div class="seeNum fr"><i class="ic-score"></i> <span>' + data.data.score + '分</span>'//积分
                html += ' </div> </div><p class="playtimeP">';
                html += ' <span>活动时间：' + data.data.time + '</span>';//活动时间
                html += '<i class="ic-heart1 fr"></i> </p>'
                html += ' <p class="playDetailP">' + data.data.detail + ' </p></div> <p class="space1"></p>';//活动详情
                html += '<div class="playIntroduction "><div class="header border1"> <i class="ic-book"></i><span>活动简介</span></div>';
                html += '<div class="contentDiv border1">';
                html += '<p>' + data.data.content + '</p></div></div>';//活动内容
                html += '<div class="playIntroduction " style="padding-bottom: 90px;"><div class="header border1"> <i class="ic-gift"></i><span>礼物明细</span></div>'
                html += '<div class="contentDiv border1">';
                html += '<p>' + data.data.gift + '</p></div></div>';//礼物明细
                html += '<a href=' + data.data.href + '><p class="playBtn">我要玩</p>'//跳转链接
                $('.playDetailSection').html('').append(html);
            } else {
                alert(data.msg)
            }
        },
        error: function (xhr, type) {
            data.msg('网络超时，请刷新后再试！');
        }
    })
}
function goShareDetail(id, page) {
    $.ajax({
        type: 'post',
        url: sysParam.ajax_myshareRecodList,
        dataType: 'json',
        data: {
            id: id,
            page: page
        },
        timeout: 15000,
        success: function (data) {
            if (data.result_code == 1) {
                var html = '', htmlScore = '';
                var length = data.gameList.length;//获积分的条数
                if (length > 0) {
                    for (var i = 0; i < length; i++) {
                        htmlScore += '<li> <img src=' + data.gameList[i].fheadimgurl + ' class="headImg">';//头像
                        htmlScore += '<span class="nickname">' + data.gameList[i].fnickname + '</span>';//昵称
                        htmlScore += '<div class="siggleScoreDiv"><span>点击+' + data.gameList[i].integral + '</span>';
                        htmlScore += '<span>积分</span></div>'//积分
                        htmlScore += '    <div class="siggledateDiv"><span>' + data.gameList[i].ctm + '</span></div></li>';//时间
                    }
                } else {
                    htmlScore += '<p class="noneData">还没有您的积分哦</p>'
                }
                shareDetailPage = data.allPage
                if (data.allPage == 1 || length == 0) {
                    $('.scoreDetailDiv .singleScore ul').html('').append(htmlScore);
                } else {
                    $('.scoreDetailDiv .singleScore ul').append(htmlScore);
                    scoreDetail_page++;
                }
                setTimeout(function () {
                    scoreDetailScroll.refresh();
                }, 20)

            } else {
                alert(data.msg)
            }
        },
        error: function (xhr, type) {
            data.msg('网络超时，请刷新后再试！');
        }
    })
}
function popupMT(Id) {
    var h1, $boxItem = $(Id).find(".boxItem");
    h1 = $boxItem.height();
    $boxItem.css({marginTop: -h1 / 2});
}
function close(id) {
    id.removeClass("show").addClass("hide");
    id.find(".boxItem").removeClass("zoomIn").addClass("zoomOut");
    setTimeout(function () {
        id.hide().addClass("show").removeClass("hide");
    }, 500)
}
function media(b) {
    var audio = new Audio(b.musicSrc), $music = $("#musicCtrl");
    audio.setAttribute("autoplay", "autoplay");
    audio.setAttribute("loop", "loop");
    document.onreadystatechange = function () {
        if (document.readyState == "complete" && audio.paused) {
            audioPlay();
        }
    };
    $("body").one("touchstart", function () {
        if (audio.paused) {
            audioPlay();
        }
    });
    $music.on("click", musicCtrl);
    function musicCtrl() {
        if (audio.paused) {
            audioPlay();
            return;
        }
        audioPause();
    }

    function audioPlay() {
        audio.play();
        $music.attr("src", b.musicPlaySrc);
        $music.addClass("mAnim");
    }

    function audioPause() {
        audio.pause();
        $music.attr("src", b.musicPauseSrc);
        $music.removeClass("mAnim");
    }
}