<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:40:"themes/97013266/portal/posted/index.html";i:1570008884;s:32:"themes/97013266/public/head.html";i:1570008884;s:36:"themes/97013266/public/function.html";i:1570008884;s:35:"themes/97013266/public/nav_new.html";i:1570008884;s:35:"themes/97013266/public/scripts.html";i:1570008884;}*/ ?>
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
    <link rel="stylesheet" href="__STATIC__/js/layui/css/layui.css" media="all">
    <link href="__TMPL__/public/assets/css/tube.css" rel="stylesheet">
     <link href="__TMPL__/public/assets/css/posted.css" rel="stylesheet">

    <?php 
    \think\Hook::listen('before_head_end',$temp5dd2bbfc180bb,null,false);
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
        <div class="col-sm-12 tube-lyy tube-bgs"><i class="fa"><img src="__TMPL__/public/assets/images/publish1.png"></i><span>内测分发应用</span></div>
    </a>
    <a href="/portal/posted/supindex">
        <div class="col-sm-12 tube-lyy tube-bgs"><i class="fa"><img src="__TMPL__/public/assets/images/qianming.png"></i><span>超级签名应用</span></div>
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
    <!--  我的应用右侧 概述 -->
    <div class="col-sm-10 pad-left_right tube-right">
        <!--     账户资料 -->
        <div class="col-sm-12 tube-zil pad-left_right">内测分发应用</div>

        <div class="col-sm-12 ">
            <form action="<?php echo url('Portal/posted/index'); ?>" method="post">
            <div class="box_card secou" style="width:72%;">
                    <input type="text" name="key" value="<?php echo $key; ?>" placeholder="搜索应用名称">
                    <img width="20" height="20" src="__TMPL__/public/assets/images/seach.png">
            </div>
            <div class="secou-button">
                <input type="submit" name="" value="搜索" style="">
            </div>
                
            </form>
            <div class="secou-right" onclick="location.href='/portal/index/posted'">
                发布应用
            </div>
            <div class="col-sm-12 tube-zil pad-left_right">&nbsp;</div>
            <div class="col-sm-12 tube-panel panel-default pad-left_right box_card tube-panel-bottom">
                <table class="table">
                    <thead style="">
                    <tr>
                        <th>应用名称</th>
                        <th>版本</th>
                        <th>下载方式</th>
                        <th>更新时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($assets) || $assets instanceof \think\Collection || $assets instanceof \think\Paginator): if( count($assets)==0 ) : echo "" ;else: foreach($assets as $key=>$v): ?>
                        <tr>
                            <th scope="row">
                                <div class="col-sm-3 pad-left_right tube-row">
                                    <img src="<?php echo $v['img']; ?>" class="headicon">
                                </div>
                                <div class="col-sm-8 pad-left_right">
                                    <div class="col-sm-12 pad-left_right tube-yingy"><?php echo $v['name']; ?></div>
                                    <div class="col-sm-12 pad-left_right tube-ying-t ">
                                        <?php if($v['type'] != '0'): ?>
                                            <i class="fa fa-apple"></i>&nbsp;&nbsp;苹果
                                            <?php else: ?>
                                            <i class="fa fa-android"></i>&nbsp;&nbsp;安卓
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </th>
                            <td><?php echo $v['version']; ?></td>
                            <!-- <td class="erweim" date-url="<?php echo $v['er_logo']; ?>"><?php echo $v['url']; ?> <i class="fa fa-qrcode " aria-hidden="true"></i><div  class="erweidw" ><img src="<?php echo $v['er_img']; ?>"/></div>  </td>-->
                            <td class="erweim" date-url="<?php echo getsite(); ?>/<?php echo $v['er_logo']; ?>"><?php echo getsite(); ?>/<?php echo $v['er_logo']; ?> <i
                                    class="fa fa-qrcode " aria-hidden="true"></i>
                                <div class="erweidw"></div>
                            </td>
                            <td><?php echo date("Y-m-d",$v['addtime'] ); ?></td>
                            <td class="tube-tiz">
                                <a class="bogo-global-btn" style="background: #0095FC;" 
                                   href="<?php echo cmf_url('user/tube/details',array('id'=>$v['id'],'bundle'=>$v['bundle'],'type'=>$v['type'])); ?>">详情</a>
                                <a href="<?php echo cmf_url('user/tube/editor',array('id'=>$v['id'])); ?>"
                                   class="bogo-global-btn">编辑</a></td>
                        </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                    </tbody>
                </table>

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


        <script src="__TMPL__/public/assets/js/slippry.min.js"></script>
        <script src="__STATIC__/js/layui/layui.js"></script>

        <script>
            $(function () {

                $(".erweim").click(function () {
                    var url = $(this).attr("date-url");
                    $(".erweim").find("div").html("");
                    $(this).find("div").qrcode({
                        render: "canvas", //table方式
                        width: 80, //宽度
                        height: 80, //高度
                        text: url //任意内容
                    });
                    $(this).find("div").toggle();
                });

                $("#home-slider").slippry({
                    transition: 'fade',
                    useCSS: true,
                    captions: false,
                    speed: 1000,
                    pause: 3000,
                    auto: true,
                    preload: 'visible'
                });
                $("#home-slider").show();
            });
        </script>
        <script>
            layui.use('layer', function () { //独立版的layer无需执行这一句
                var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句

                //触发事件
                var active = {
                    notice: function () {
                        //示范一个公告层
                        layer.open({
                            type: 1
                            , title: false //不显示标题栏
                            , closeBtn: true
                            , area: '750px;'
                            , shade: 0.8
                            , id: 'LAY_layuipro' //设定一个id，防止重复弹出
                            // ,btn: ['火速围观', '残忍拒绝']
                            // ,btnAlign: 'c'
                            , moveType: 1 //拖拽模式，0或者1
                            , content: $("#buybox")
                            , success: function (layero) {
                                // var btn = layero.find('.layui-layer-btn');
                                // btn.find('.layui-layer-btn0').attr({
                                //   href: 'http://www.layui.com/'
                                //   ,target: '_blank'
                                // });
                            }
                        });
                    }

                };

                $('#btn-recharge').on('click', function () {
                    var othis = $(this), method = othis.data('method');
                    active[method] ? active[method].call(this, othis) : '';
                });

            });
        </script>
        <?php 
    \think\Hook::listen('before_body_end',$temp5dd2bbfc18118,null,false);
 ?>
</body>
<style media="screen">
    .pricing-dialog.dialog .packages {
        /* display:-webkit-box;
        display:-ms-flexbox; */
        display: block;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin-bottom: 32px;
        zoom: 1;
        overflow: hidden;
    }

    .pricing-dialog.dialog .package-item {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        border-right: 1px solid transparent;
        padding: 8px 48px;
        text-align: center;
        position: relative;
        float: left;
        margin-bottom: 20px;
    }

    .pricing-dialog.dialog .package-item {
        border-right-color: #DBE0E3;
    }

    .pricing-dialog.dialog .package-item.threeaction {
        border-right: 0;
    }

    .pricing-dialog.dialog .package-item .money {
        font-size: 30px;
        color: #F8BA0B;
        line-height: 42px
    }

    .pricing-dialog.dialog .package-item .times {
        font-size: 24px;
        line-height: 28px;
        color: #4F5156
    }

    .pricing-dialog.dialog .package-item .unit {
        font-size: 14px;
        color: #869096
    }

    .pricing-dialog.dialog .package-item .package-content {
        margin-bottom: 0
    }

    .text-gift {
        height: 22px;
        color: #f00;
    }

    .pricing-dialog.dialog .package-actions .btn {
        background-color: #fff;
        border: 1px solid #B6BDC1;
        border-radius: 30px;
        min-width: 120px;
        height: 40px
    }

    .pricing-dialog.dialog .package-actions .btn:hover {
        color: #fff;
        background-color: #F8BA0B;
        border-color: #F8BA0B
    }

    .pricing-dialog.dialog .package-loading {
        width: 100%
    }

    .pricing-dialog.dialog .package-dialog-footer {
        color: #333;
        clear: both;
    }

    .pricing-dialog.dialog .package-dialog-footer a {
        color: #1AA79A;
        text-decoration: none
    }

    .pricing-dialog.dialog .package-dialog-footer a:hover {
        text-decoration: none
    }

    .pricing-dialog.dialog .arraw-badge {
        position: absolute;
        background-color: #F87335;
        color: #fff;
        left: -1px;
        top: 0;
        width: 30px;
        height: 40px;
        text-align: center;
        padding-top: 5px;
        font-weight: bold;
    }

    .pricing-dialog.dialog .arraw-badge .arraw {
        width: 0;
        height: 0;
        overflow: hidden;
        border: 15px solid transparent;
        border-bottom: 10px solid #fff;
        border-top: none;
        position: absolute;
        bottom: 0;
        left: 0
    }

</style>

</html>
