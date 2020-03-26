<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:48:"themes/97013266/user/profile/real_name_auth.html";i:1570008884;s:32:"themes/97013266/public/head.html";i:1570008884;s:36:"themes/97013266/public/function.html";i:1570008884;s:35:"themes/97013266/public/nav_new.html";i:1570008884;s:35:"themes/97013266/public/scripts.html";i:1570008884;}*/ ?>
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
    <link href="__TMPL__/public/assets/css/user-center.css" rel="stylesheet">

    <?php 
    \think\Hook::listen('before_head_end',$temp5e78aa1eb46b2,null,false);
 ?>
</head>
<body class="body-all">
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


    <!--  我的应用左侧 -->
    <div class="col-sm-2 pad-left_right tube-left1" >
    <a href="<?php echo cmf_url('user/tube/index'); ?>">
        <div class="col-sm-12 tube-lgs tube-bgs"><i class="fa"><img src="__TMPL__/public/assets/images/summarya.png"></i><span>概述</span></div>
    </a>
    <a href="/user/profile/center.html">
        <div class="col-sm-12 tube-lyy tube-bgs">
        	<i class="fa"><img src="__TMPL__/public/assets/images/me.png"></i><span>个人中心</span>
        </div>
        <div class="user-center">
        	<div>
        		<a href="<?php echo cmf_url('user/Profile/center'); ?>">修改资料</a>
        	</div>
        	<div class="user-center-c">
        		<a href="<?php echo cmf_url('user/Profile/real_name_auth'); ?>">实名认证</a>
        	</div>
        	<div>
        		<a href="<?php echo cmf_url('user/Profile/password'); ?>">修改密码</a>
        	</div>
        	<div>
        		<a href="<?php echo cmf_url('user/Profile/binding'); ?>">绑定账号</a>
        	</div>
        	
        	
        </div>
    </a>
    <!-- <a href="/portal/index/posted">
        <div class="col-sm-12 tube-lyy tube-bgs"><i class="fa fa-plus-circle"></i><span>发布应用</span></div>
    </a> -->
    <a href="/portal/posted/index">
        <div class="col-sm-12 tube-lyy tube-bgs"><i class="fa"><img src="__TMPL__/public/assets/images/publish.png"></i><span>内测分发应用</span></div>
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

<div class="user-left">
	<div class="user-left-top">
		<p>个人中心> <span class="span-c">实名认证</span></p>
	</div>
    <div class="user-left-bottom">
        <div class="tab-content">
        	<div class="tab-content-top">实名认证  <span><?php echo $status; ?></span></div>
            
                <div class="tab-content">
                    <div class="tab-pane active" id="one">
                        
                        <form class="js-ajax-form" action="<?php echo url('user/profile/editAuthInfoPost'); ?>" method="post">
                            <div class="auth-user-input-box">
                                <label for="input-user_nickname" class="auth-user-l">真实姓名</label>
                                <input type="text" class="form-control auth-user-i" id="input-user_nickname" placeholder="真实姓名"
                                       name="user_real_name" value="<?php echo (isset($auth_info['user_real_name'] ) && ($auth_info['user_real_name']  !== '')?$auth_info['user_real_name'] :''); ?>">
                            </div>

                            <div class="auth-user-input-box">
                                <label for="input-user_num" class="auth-user-l">身份证号</label>
                                <input class="form-control auth-user-i" type="text" id="input-user_num"
                                       placeholder="" name="user_card_number"
                                       value="<?php echo (isset($auth_info['card_number'] ) && ($auth_info['card_number']  !== '')?$auth_info['card_number'] :''); ?>">
                            </div>

                            <div class="auth-user-car-box">
                                <label class="auth-user-l">身份证正面</label>
                                <div style="">
                                    <input type="hidden" name="card_img1" id="card_img1"
                                           value="<?php echo (isset($auth_info['card_img1'] ) && ($auth_info['card_img1']  !== '')?$auth_info['card_img1'] :''); ?>">
                                    <a href="javascript:uploadOneImage('图片上传','#card_img1');">
                                        <?php if(!empty($auth_info['card_img1'])): ?>
                                            <img src="<?php echo $auth_info['card_img1']; ?>"
                                                 id="card_img1-preview"
                                                 width="135" style="cursor: pointer"/>
                                            <?php else: ?>
                                            <img src="__TMPL__/public/assets/images/default-thumbnail.png"
                                                 id="card_img1-preview"
                                                 width="135" style="cursor: pointer"/>
                                        <?php endif; ?>

                                    </a>
                                    <input type="button" class="btn btn-sm btn-cancel-thumbnail" value="取消图片">
                                </div>

                            </div>
                            <div class="auth-user-car-box">
                                <label class="auth-user-l">身份证反面</label>
                                <div style="">
                                    <input type="hidden" name="card_img2" id="card_img2"
                                           value="<?php echo (isset($auth_info['card_img2'] ) && ($auth_info['card_img2']  !== '')?$auth_info['card_img2'] :''); ?>">
                                    <a href="javascript:uploadOneImage('图片上传','#card_img2');">
                                        <?php if(!empty($auth_info['card_img1'])): ?>
                                            <img src="<?php echo $auth_info['card_img1']; ?>"
                                                 id="card_img2-preview"
                                                 width="135" style="cursor: pointer"/>
                                            <?php else: ?>
                                            <img src="__TMPL__/public/assets/images/default-thumbnail.png"
                                                 id="card_img2-preview"
                                                 width="135" style="cursor: pointer"/>
                                        <?php endif; ?>

                                    </a>
                                    <input type="button" class="btn btn-sm btn-cancel-thumbnail" value="取消图片">
                                </div>
                            </div>


                            <div class="auth-user-button">
                                <button type="submit" class="btn btn-primary js-ajax-submit">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
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


</body>
</html>