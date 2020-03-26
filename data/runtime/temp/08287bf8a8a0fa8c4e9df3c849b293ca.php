<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:31:"themes/97013266/user/login.html";i:1570008884;s:32:"themes/97013266/public/head.html";i:1570008884;s:36:"themes/97013266/public/function.html";i:1570008884;s:35:"themes/97013266/public/scripts.html";i:1570008884;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="keywords" content=""/>
    <meta name="description" content="">
    <link href="__TMPL__/public/assets/css/tube.css" rel="stylesheet">
    
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

</head>
<style>
.login-box{
    width:1050px;
    height:556px;
    background:rgba(255,255,255,1);
    box-shadow:0px 3px 7px 0px rgba(0, 0, 0, 0.35);
    border-radius:10px;
    margin: 0 auto;
    margin-top: 50px;
    overflow: hidden;
}
.login-box-logo{
    width: 221px;
    height: 61px;
    margin-bottom: 36px;
}
.login-box-bottom{
    width: 100%;
    margin-top: 36px;
}
.login-box-bottom-left{
    width: 463px;
    height: 361px;
    margin-left: 29px;
    float: left;
}
.login-box-bottom-right{
    width: 450px;
    float: right;
    margin-right: 29px;
}
.form-group input{
    width: 420px;
    background: #fff;
    border: 0;
    outline:none;
    height: 50px;
    
    margin-top: 10px;
}
.captcha-f{
    width: 420px;
    height: 50px;
    border-bottom: solid 1px #DBDBDB;
    margin-bottom: 10px;
}
.captcha-f input{
    width: 259px;
    height: 49px;
    background: #fff;
    border: 0;
    outline:none;
}
.form-group-ou input{
    border-bottom: solid 1px #DBDBDB;
}
.register-left{
    float: left;
}
.register-left a{
    color: #3BCDAE;
    font-size: 16px;
}
.findpassword-right{
    float: right;;
    margin-right: 29px;
}
.findpassword-right a{
    color: #999;
    font-size: 16px;
}
</style>

<body class="body-white">


<div class="login-box">
    <div class="login-box-bottom">
        <div class="login-box-bottom-left">
            <div class="login-box-logo">
                <img width="100%" src="/static/images/logo.png">
            </div>
            <img width="100%" src="/themes/simpleboot3/public/assets/images/login_bac.png">
        </div>
        <div class="login-box-bottom-right">
            <h2 class="text-center user-login">用户登录</h2>
            <form class="js-ajax-form" action="<?php echo url('user/login/doLogin'); ?>" method="post">
                <div class="form-group form-group-ou">
                    <input type="text" id="input_username" name="username" placeholder="手机号">
                </div>

                <div class="form-group form-group-ou">
                    <input type="password" id="input_password" name="password" placeholder="密码">
                </div>

                <div class="captcha-f">
                    <div class="">
                        <input type="text" name="captcha" placeholder="验证码" class="captcha" style="float: left;">
                        <?php $__CAPTCHA_SRC=url('/captcha/new').'?height=38&width=160&font_size=20'; ?>
<img src="<?php echo $__CAPTCHA_SRC; ?>" onclick="this.src='<?php echo $__CAPTCHA_SRC; ?>&time='+Math.random();" title="换一张" class="captcha captcha-img verify_img" style="cursor: pointer;"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="register-left">
                        <a href="<?php echo cmf_url('user/Register/index'); ?>">免费注册</a>
                    </div>
                    <div class="findpassword-right">
                        <a href="<?php echo cmf_url('user/Login/findPassword'); ?>">忘记密码 ？</a>
                    </div>
                    
                </div>
                <div class="form-group">&nbsp;</div>
                <div class="form-group" style="margin-top:50px;">
                    <input type="hidden" name="redirect" value="">
                    <button class="btn btn-primary btn-block js-ajax-submit" type="submit" style="width:418px; height:56px; background:rgba(21,235,191,1);border-radius:10px;border: none;font-size: 22px;">
                        登录
                    </button>
                </div>

               
            </form>
        </div>
    </div>
</div>

<!-- /container -->

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