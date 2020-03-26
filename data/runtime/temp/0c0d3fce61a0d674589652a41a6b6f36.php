<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:46:"themes/97013266/portal/posted/supernumber.html";i:1570008884;s:32:"themes/97013266/public/head.html";i:1570008884;s:36:"themes/97013266/public/function.html";i:1570008884;s:35:"themes/97013266/public/nav_new.html";i:1570008884;s:35:"themes/97013266/public/scripts.html";i:1570008884;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <title>首页 <?php echo (isset($site_info['site_name']) && ($site_info['site_name'] !== '')?$site_info['site_name']:''); ?></title>
    <meta name="keywords" content="<?php echo (isset($site_info['site_seo_keywords']) && ($site_info['site_seo_keywords'] !== '')?$site_info['site_seo_keywords']:''); ?>"/>
    <meta name="description" content="<?php echo (isset($site_info['site_seo_description']) && ($site_info['site_seo_description'] !== '')?$site_info['site_seo_description']:''); ?>">
    
<?php 
/*可以加多个方法哟！*/
function _sp_helloworld(){
	echo "hello ThinkCMF!";
}

function _sp_helloworld2(){
	echo "hello ThinkCMF2!";
}


function _sp_helloworld3(){
	echo "hello ThinkCMF3!";
}

 ?>
<meta name="author" content="ThinkCMF">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">

<!-- No Baidu Siteapp-->
<meta http-equiv="Cache-Control" content="no-siteapp"/>

<!-- HTML5 shim for IE8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<link rel="icon" href="__TMPL__/public/assets/images/favicon.png" type="image/png">
<link rel="shortcut icon" href="__TMPL__/public/assets/images/favicon.png" type="image/png">
<link href="__TMPL__/public/assets/simpleboot3/themes/simpleboot3/bootstrap.min.css" rel="stylesheet">
<link href="__TMPL__/public/assets/simpleboot3/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"
      type="text/css">
<!--七牛样式-->
<link href="/themes/simpleboot3/public/assets/qiniu_sdk/main.css" rel="stylesheet">
<link href="/themes/simpleboot3/public/assets/qiniu_sdk/highlight.css" rel="stylesheet">
<link href="__TMPL__/public/assets/css/tube.css" rel="stylesheet">

<!--[if IE 7]>
<link rel="stylesheet" href="__TMPL__/public/assets/simpleboot3/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
<![endif]-->
<link href="__TMPL__/public/assets/css/style.css" rel="stylesheet">
<style>
    /*html{filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(1);}*/
    #backtotop {
        position: fixed;
        bottom: 50px;
        right: 20px;
        display: none;
        cursor: pointer;
        font-size: 50px;
        z-index: 9999;
    }

    #backtotop:hover {
        color: #333
    }

    #main-menu-user li.user {
        display: none
    }
</style>
<script type="text/javascript">
    //全局变量
    var GV = {
        ROOT: "__ROOT__/",
        WEB_ROOT: "__WEB_ROOT__/",
        JS_ROOT: "static/js/"
    };

    var log = function(d){
        console.log(d);
    }

</script>
<script src="__TMPL__/public/assets/js/jquery-1.10.2.min.js"></script>
<script src="__TMPL__/public/assets/js/jquery-migrate-1.2.1.js"></script>
<script src="__STATIC__/js/wind.js"></script>
<!--七牛js-->
<script src="/themes/simpleboot3/public/assets/qiniu_sdk/highlight.js"></script>
<!-- <script src="/themes/simpleboot3/public/assets/qiniu_sdk/main.js"></script> -->
<script src="/themes/simpleboot3/public/assets/qiniu_sdk/dist/qiniu.min.js"></script>
<script src="/themes/simpleboot3/public/assets/qiniu_sdk/ui.js"></script>
<!-- /*生成二维码*/ -->
<script src="__TMPL__/public/assets/js/jquery.qrcode.min.js"></script>

<!-- plist转换json -->
<script src="__TMPL__/public/assets/js/plist_parser.js"></script>


    <link href="__TMPL__/public/assets/simpleboot3/themes/simpleboot3/bootstrap.min.css" rel="stylesheet">
    
    <link href="__TMPL__/public/assets/css/tube.css" rel="stylesheet">
    <link href="__TMPL__/public/assets/css/posted.css" rel="stylesheet">

    <?php 
    \think\Hook::listen('before_head_end',$temp5e78abb905be0,null,false);
 ?>
</head>
<body class="body-white" style="background: #ECEEEE;">
<nav class="navbar navbar-default navbar-fixed-top active" style="box-shadow: 0px 1px 10px #ccc;">
    <div class=" active" style="width: 90%;margin: 0 auto;">

        <div class="navbar-header">
            <a style="background: transparent;margin-top: -15px" class="navbar-brand" href="__ROOT__/">
                <img height="50" src="/static/images/logo.png">
            </a>
        </div>

        <div class="collapse navbar-collapse active" id="bs-example-navbar-collapse-1">
            
            
            <ul class="nav navbar-nav navbar-right" id="main-menu-user">
                <!--
                <li class="login">
                    <a class="dropdown-toggle notifactions" href="/index.php/user/notification/index"> <i
                            class="fa fa-envelope"></i> <span class="count">0</span></a>
                </li>
                -->
                <?php 
                    $user=cmf_get_current_user();
                    if($user){
                    $is_login = 1;
                    }else{
                    $is_login = 0;
                    }
                 ?>
                        
            
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <?php if($is_login == 1): ?>
                    <li class="dropdown user login" style="display: block">
                        <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
                            <?php if(empty($user['avatar'])): ?>
                                <img src="__TMPL__/public/assets/images/admin1.png" class="headicon">
                                <?php else: ?>
                                <img src="<?php echo $user['avatar']; ?>" onerror='this.src="__TMPL__/public/assets/images/admin1.png"' class="headicon" width="30"/>
                            <?php endif; ?>
                            <span class="user-nickname"></span><b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo cmf_url('user/Profile/center'); ?>"><i class="fa fa-user"></i> &nbsp;个人中心</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?php echo cmf_url('user/Index/logout'); ?>"><i class="fa fa-sign-out"></i> &nbsp;退出</a>
                            </li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="dropdown user offline" style="display: list-item;">
                        <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
                            <img width="30" height="30" src="__TMPL__/public/assets/images/admin1.png" class="headicon">
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo cmf_url('user/Login/index'); ?>"><i class="fa fa-sign-in"></i> &nbsp;登录</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo cmf_url('user/Register/index'); ?>"><i class="fa fa-user"></i> &nbsp;注册</a></li>
                        </ul>
                    </li>
                <?php endif; ?>


            </ul>
        </div>
    </div>
</nav>


<div class="tube_left pad-left_right">
    <!--  我的应用左侧 -->
    <div class="col-sm-2 pad-left_right tube-left1">
    <a href="<?php echo cmf_url('user/tube/index'); ?>">
        <div class="col-sm-12 tube-lgs tube-bgs"><i class="fa"><img src="__TMPL__/public/assets/images/summarya.png"></i><span>概述</span></div>
    </a>
    <a href="/user/profile/center.html">
        <div class="col-sm-12 tube-lyy tube-bgs"><i class="fa"><img src="__TMPL__/public/assets/images/me.png"></i><span>个人中心</span></div>
    </a>
    <!-- <a href="/portal/index/posted">
        <div class="col-sm-12 tube-lyy tube-bgs"><i class="fa fa-plus-circle"></i><span>发布应用</span></div>
    </a> -->
    <a href="/portal/posted/index">
        <div class="col-sm-12 tube-lyy tube-bgs"><i class="fa"><img src="__TMPL__/public/assets/images/publish.png"></i><span>内测分发应用</span></div>
    </a>
    <a href="/portal/posted/supindex">
        <div class="col-sm-12 tube-lyy tube-bgs"><i class="fa"><img src="__TMPL__/public/assets/images/qianming1.png"></i><span>超级签名应用</span></div>
    </a>
    <a href="/user/certificate/index">
        <div class="col-sm-12 tube-lyy tube-bgs"><i class="fa"><img src="__TMPL__/public/assets/images/summary.png"></i><span>证书管理</span></div>
    </a>
    <!--todo 暂时没想好什么作用-->
    <!--    <a href="/user/tube/editor/id/0.html">-->
    <!--        <div class="col-sm-12 tube-lyy tube-bgs"><i class="fa fa-plus-circle"></i><span>发布空应用</span></div>-->
    <!--    </a>-->
    <div class="col-sm-12 tube-bor"></div>
    
</div>
<style type="text/css">
    .paysup-right{
        width: 79%;
        float: left;
        margin-left: 4%;
        margin-top: 100px;
    }
    .pay-s{
        color: #3BCDAE;
    }
    .paysup-right-top{
        columns: #666;
    }
    .paysup-right-bottom{
        width:95%;
        height:600px;
        background:rgba(255,255,255,1);
        box-shadow:0px 3px 17px 0px rgba(0, 0, 0, 0.07);
        border-radius:10px;
        margin-top: 20px;
        overflow: hidden;
    }
    .paysup-right-bottom-top{
        font-size: 16px;
        font-weight: bold;
        margin-top: 2%;
        margin-left: 4%;
    }
    .paysup-right-bottom-form{
        margin-left: 12%;
        margin-top: 2%;
    }
    .paysup-right-bottom-form-a{
        width: 100%;
        height: 60px;
    }
    .paysup-right-bottom-form-a-l{
        float: left;
        font-size: 16px;
        width: 100px;
        line-height: 30px;
    }
    .paysup-right-bottom-form-a-r{
        float: left;
        font-size: 16px;
        font-weight: bold;
    }
    .paysup-right-bottom-form-b-a{
        float: left;
    }
    .private{
        cursor: pointer;
    }
    .public{
        cursor: pointer;
    }
    .private-notice{
        position: absolute;
        width: 260px;
        
        background:rgba(255,255,255,1);
        box-shadow:0px 3px 17px 0px rgba(0, 0, 0, 0.07);
        border-radius:10px;
        padding: 5px 7px;
        display: none;
    }
    .public-notice{
        position: absolute;
        width: 260px;
        
        background:rgba(255,255,255,1);
        box-shadow:0px 3px 17px 0px rgba(0, 0, 0, 0.07);
        border-radius:10px;
        padding: 5px 7px;
        margin-left: 100px;
        display: none;
    }
    .paysup-right-bottom-form-b-num{
        font-size: 24px;
        color: #3BCDAE;
    }
    .paysup-button{
        width: 120px;
        height: 45px;
        background-color: #3BCDAE;
        border: none;
        border-radius: 4px;
        color: #fff;
        margin-top: 30px;
    }
    .paysup-right-bottom-form-b-b{
        display: none;
    }
    .super-czxy{
        margin-left: 100px;
    }
    .super-czxy  a{
        text-decoration: none;
    }
</style>   
<div class="paysup-right">
    <div class="paysup-right-top">超级签名 > <span class="pay-s">购买设备量</span></div>
    <div class="paysup-right-bottom">
        <div class="paysup-right-bottom-top">购买设备量</div>
        <div class="paysup-right-bottom-form">
            <div class="paysup-right-bottom-form-a">
              <div class="paysup-right-bottom-form-a-l">产品名称：</div>  
              <div class="paysup-right-bottom-form-a-r">ios专属签名</div>
            </div>
            <form class="js-ajax-form" action="<?php echo url('portal/Posted/pay_super'); ?>" method="post">
                <div class="paysup-right-bottom-form-a">
                    <div class="paysup-right-bottom-form-a-l">签名类型：</div>
                    <div class="paysup-right-bottom-form-b-a">
                        <label>
                            <input type="radio" name="type" value="2"> 私有池
                            <img class="private" width=15 height="15" src="__TMPL__/public/assets/images/question.png">
                        </label>
                        <div class="private-notice">
                            使用个人账号池给已上传并选择使用私有池的应用进行签名服务（私有池需自行上传证书）以签名次数为计费方式，若将应用切换至公有池，签名会以公有池计费方式重新计费。
                        </div>
                        <label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </label>
                        <label>
                            <input type="radio" name="type" value="1" checked> 公有池
                            <img class="public" width=15 height="15" src="__TMPL__/public/assets/images/question.png">
                        </label>
                        <div class="public-notice">
                            使用个人账号池给已上传并选择使用公有池的应用进行签名服务；以签名次数为计费方式，若将应用切换至私有池，签名会以私有池计费方式重新计费。
                        </div>
                    </div>
                  
                </div>
                <div class="paysup-right-bottom-form-a">
                    <div class="paysup-right-bottom-form-a-l">购买数量：</div>
                    <div class="paysup-right-bottom-form-b-a paysup-right-bottom-form-b-c">
                        
                        <?php if(is_array($public) || $public instanceof \think\Collection || $public instanceof \think\Paginator): if( count($public)==0 ) : echo "" ;else: foreach($public as $k=>$val): ?>
                            <label>
                                <input class="public<?php echo $k; ?>" data-num="<?php echo $val['coin']; ?>" type="radio" name="num" value="<?php echo $val['id']; ?>" <?php if($k == 0): ?>checked<?php endif; ?>> <?php echo $val['num']; ?>次
                                &nbsp;&nbsp;
                            </label>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div class="paysup-right-bottom-form-b-a paysup-right-bottom-form-b-b">
                        
                        <?php if(is_array($private) || $private instanceof \think\Collection || $private instanceof \think\Paginator): if( count($private)==0 ) : echo "" ;else: foreach($private as $k=>$val): ?>
                            <label>
                                <input class="private<?php echo $k; ?>" data-num="<?php echo $val['coin']; ?>" type="radio" name="num" value="<?php echo $val['id']; ?>"> <?php echo $val['num']; ?>次
                                &nbsp;&nbsp;
                            </label>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <div class="paysup-right-bottom-form-a">
                    <div class="paysup-right-bottom-form-a-l">支付方式：</div>
                    <div class="paysup-right-bottom-form-b-a">
                        <label>
                            <input type="radio" name="pay_type" value="1" checked> 
                            &nbsp;&nbsp;
                            <img src="__TMPL__/public/assets/images/zhifubao.png">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </label>
                        
                        <label>
                            <input type="radio" name="pay_type" value="2" > 
                            
                            &nbsp;&nbsp;
                            <img src="__TMPL__/public/assets/images/weixin.png">
                        </label>
                    </div>
                </div>
                <div class="paysup-right-bottom-form-a">
                    <div class="paysup-right-bottom-form-a-l">应付金额：</div>
                    <div class="paysup-right-bottom-form-b-a">
                        <p class="paysup-right-bottom-form-b-num"><?php echo (isset($coin) && ($coin !== '')?$coin:'0'); ?>元</p>
                        <input type="hidden" name="coin" value="<?php echo (isset($coin) && ($coin !== '')?$coin:'0'); ?>">
                    </div>
                </div>
                <div class="paysup-right-bottom-form-a">
                    
                    <div class="super-czxy">
                        <input type="checkbox" name="czxy" checked>
                        <a onclick="window.open('/portal/article/index/id/1')">超级签名充值协议</a>
                        
                    </div>
                        
                </div>
                <div class="paysup-right-bottom-form-a">
                    <div class="paysup-right-bottom-form-a-l">&nbsp;</div>
                    <div class="paysup-right-bottom-form-b-a">
                        <button type="button" class="paysup-button js-ajax-submit">立即支付</button>
                    </div>
                </div>
            </form>
            <label>
                
            </label>
        </div>
    </div>
</div>
    <!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="__TMPL__/public/assets/simpleboot3/bootstrap/js/bootstrap.min.js"></script>
<script src="__STATIC__/js/frontend.js"></script>
<script>
    $(function () {

        $("#main-menu li.dropdown").hover(function () {
            $(this).addClass("open");
        }, function () {
            $(this).removeClass("open");
        });

        $("#main-menu li").click(function () {
            $(this).addClass("active");
            $(this).siblings().removeClass("active");
        })

        $.post("<?php echo url('user/index/isLogin'); ?>", {}, function (data) {
            // console.log(data);
            if (data.code == 1) {
                if (data.data.user.avatar) {
                }

                $("#main-menu-user span.user-nickname").text(data.data.user.user_nickname ? data.data.user.user_nickname : data.data.user.user_login);
                $("#main-menu-user li.login").show();
                $("#main-menu-user li.offline").hide();

            }

            if (data.code == 0) {
                $("#main-menu-user li.login").hide();
                $("#main-menu-user li.offline").show();
            }

        });

        ;(function ($) {
            $.fn.totop = function (opt) {
                var scrolling = false;
                return this.each(function () {
                    var $this = $(this);
                    $(window).scroll(function () {
                        if (!scrolling) {
                            var sd = $(window).scrollTop();
                            if (sd > 100) {
                                $this.fadeIn();
                            } else {
                                $this.fadeOut();
                            }
                        }
                    });

                    $this.click(function () {
                        scrolling = true;
                        $('html, body').animate({
                            scrollTop: 0
                        }, 500, function () {
                            scrolling = false;
                            $this.fadeOut();
                        });
                    });
                });
            };
        })(jQuery);

        $("#backtotop").totop();


    });
</script>


    <link rel="stylesheet" href="__STATIC__/js/layui/css/layui.css" media="all">
    <script src="__STATIC__/js/layui/layui.js"></script>
    
    <?php 
    \think\Hook::listen('before_body_end',$temp5e78abb905bf1,null,false);
 ?>
</body>

</html>
<script type="text/javascript">
    $('.private').mouseover(function(){
        $('.private-notice').css('display','block');
    })
    $('.private').mouseout(function(){
        $('.private-notice').css('display','none');
    })

    $('.public').mouseover(function(){
        $('.public-notice').css('display','block');
    })
    $('.public').mouseout(function(){
        $('.public-notice').css('display','none');
    })

    $('input[name="num"]').click(function(){
        var num = $(this).attr('data-num');
        $('.paysup-right-bottom-form-b-num').text(num+'元');

        $('input[name="coin"]').val(num);
    })

    $("input[name='type']").click(function(){
        var types= $("input[name='type']:checked").val();
        if(types==2){
            $('.paysup-right-bottom-form-b-c').css('display','none');
            $('.paysup-right-bottom-form-b-b').css('display','block');
            var v = $('.private0').val();
            $("input[name=num][value="+v+"]").attr("checked",true);
            var num = $("input[name='num']:checked").attr('data-num');
            $('.paysup-right-bottom-form-b-num').text(num+'元');
            $('input[name="coin"]').val(num);
        }else{
            $('.paysup-right-bottom-form-b-c').css('display','block');
            $('.paysup-right-bottom-form-b-b').css('display','none');
            var v = $('.public0').val();
            $("input[name=num][value="+v+"]").attr("checked",true);
            var num = $("input[name='num']:checked").attr('data-num');
            $('.paysup-right-bottom-form-b-num').text(num+'元');
            $('input[name="coin"]').val(num);
        }
    })

    $('.paysup-button').click(function(){
        //var formdata = new FormData('form');
        //var id = $('input[name="num"]').val();
        //var date = $('form').serialize();
        var czxy = $("input[name='czxy']:checked").val();
        if(czxy != 'on'){
            alert('请同意签名充值协议！');
            return;
        }
        var id = $("input[name='num']:checked").val();
        var type = $("input[name='type']:checked").val();
        var pay_type = $("input[name='pay_type']:checked").val();
        var coin = $("input[name='coin']").val();
        var data = new Array();
        data['id'] = id;
        data['type'] = type;
        data['pay_type'] = pay_type;
        data['coin'] = coin;
        buy(id,type,pay_type,coin);
        //console.log(data);
    });

    function GetDateNow() {
        var vNow = new Date();
        var sNow = "";
        sNow += String(vNow.getFullYear());
        sNow += String(vNow.getMonth() + 1);
        sNow += String(vNow.getDate());
        sNow += String(vNow.getHours());
        sNow += String(vNow.getMinutes());
        sNow += String(vNow.getSeconds());
        sNow += String(vNow.getMilliseconds());
        return sNow;
    }

    function buy(did,type,pay_type,coin) {
        //log(GetDateNow());
        //return false;
        $.ajax({
            url: '/portal/posted/pay_super',
            type: 'POST', //GET
            async: true,    //或false,是否异步
            data: {
                id: did,
                type: type,
                pay_type: pay_type,
                //d_gift: gift,
                coin: coin,
                order_id: GetDateNow()
            },
            timeout: 5000,    //超时时间
            dataType: 'html',    //返回的数据格式：json/xml/html/script/jsonp/text
            beforeSend: function (xhr) {
                log(xhr)
                log('发送前')
            },
            success: function (data, textStatus, jqXHR) {

                $("body").append(data);
                log(data)
                //log(textStatus)
                //log(jqXHR)
            },
            error: function (xhr, textStatus) {
                log('错误')
                //log(xhr)
                //log(textStatus)
            },
            complete: function () {
                log('结束')
            }
        });
    }
</script>
