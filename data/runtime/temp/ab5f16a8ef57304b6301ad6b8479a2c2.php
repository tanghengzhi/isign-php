<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:41:"themes/97013266/user/tube/sup_editor.html";i:1570008884;s:32:"themes/97013266/public/head.html";i:1570008884;s:36:"themes/97013266/public/function.html";i:1570008884;s:35:"themes/97013266/public/nav_new.html";i:1570008884;s:35:"themes/97013266/public/scripts.html";i:1570008884;}*/ ?>
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
    <link rel="stylesheet" href="__STATIC__/js/layui/css/layui.css" media="all">

    <?php 
    \think\Hook::listen('before_head_end',$temp5dd348134a2f4,null,false);
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
    </div>

    <!--  我的应用右侧 概述 -->
    <div class="col-sm-10 pad-left_right tube-right">
        <!-- 编辑应用管理 -->
        <div class="col-sm-12 tube-zil pad-left_right"><?php echo $assets['name']; ?></div>
        <div class="col-sm-12 editor-use  pad-left_right">
            <div class="col-sm-11 editor-left">
                <form class="reg-page sky-form" id="form" enctype="multipart/form-data" method="POST"
                      action="<?php echo cmf_url('tube/sup_upd'); ?>">
                    <input type="hidden" name="url_name" value="<?php echo $assets['url_name']; ?>">
                    <div class="editor-form-box">
                        <div class="editor-left2">
                            <span id="img">
                                <input id="imginput" type="file" name="img" onchange="imgshow()" value="">
                            </span>

                            <!-- <img src="<?php echo (isset($assets['img']) && ($assets['img'] !== '')?$assets['img']:'/nologo.png'); ?>"/> -->
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <label class="form-label">名称:</label>
                            <div class="controls">
                                <div class="input-group state-success">
                                    <input type="text" class="form-control valid" id="name" name="name"
                                           value="<?php echo $assets['name']; ?>" placeholder="请输入应用名称">
                                    <span class="input-group-addon"><span class="arrow"></span><i
                                            class="fa fa-pencil"></i></span>
                                </div>
                            </div>
                        </div>
                        <?php if($assets['url_name'] == '1'): ?>
                            <div class="form-group">
                                <label class="form-label">应用版本号：默认为1.0.0</label>
                                <div class="controls">
                                    <div class="input-group state-success">
                                        <input type="text" class="form-control valid" id="version" name="version"
                                               value="<?php echo (isset($assets['version']) && ($assets['version'] !== '')?$assets['version']:'1.0.0'); ?>" placeholder="请输入应用版本号">
                                        <span class="input-group-addon"><span class="arrow"></span><i
                                                class="fa fa-pencil"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">应用构建版本：默认为1</label>
                                <div class="controls">
                                    <div class="input-group state-success">
                                        <input type="text" class="form-control valid" id="build" name="build"
                                               value="<?php echo (isset($assets['build']) && ($assets['build'] !== '')?$assets['build']:'1'); ?>" placeholder="请输入应用构建版本">
                                        <span class="input-group-addon"><span class="arrow"></span><i
                                                class="fa fa-pencil"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">应用包名：<span
                                        style="color:#f00;">例如：com.demonlive.demon</span></label>
                                <div class="controls">
                                    <div class="input-group state-success">
                                        <input type="text" class="form-control valid" id="bundle" name="bundle"
                                               value="<?php echo $assets['bundle']; ?>" placeholder="请输入应用包名">
                                        <span class="input-group-addon"><span class="arrow"></span><i
                                                class="fa fa-pencil"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">应用大小：<span style="color:#f00;">单位(M)</span></label>
                                <div class="controls">
                                    <div class="input-group state-success">
                                        <input type="text" class="form-control valid" id="big" name="big"
                                               value="<?php echo (isset($assets['big']) && ($assets['big'] !== '')?$assets['big']:'10'); ?>" placeholder="请输入应用大小">
                                        <span class="input-group-addon"><span class="arrow"></span><i
                                                class="fa fa-pencil"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">应用地址:</label>
                                <div class="controls">
                                    <div class="input-group state-success">
                                        <input type="text" class="form-control valid" id="url" name="url"
                                               value="<?php echo $assets['url']; ?>" placeholder="请输入应用地址">
                                        <span class="input-group-addon"><span class="arrow"></span><i
                                                class="fa fa-pencil"></i></span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label class="form-label">应用页面地址：不可更改</label>
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon"><?php echo $assets['www_url']; ?></span>
                                    <input type="text" class="form-control" id="shortcutURL" name="er_logo"
                                           value="<?php echo $assets['ym_url']; ?>" placeholder="请输入页面地址后缀" style="padding-left: 30px;"
                                           disabled="readonly">
                                </div>
                            </div>
                        </div>
                        <!-- <?php if($assets['name'] == '请输入应用名字'): ?>
                            <div class="form-group">
                                <label class="form-label">应用类型：<span style="color:#f00;">Android请填 0，iOS请填 1。不填默认为Android</span></label>
                                <div class="controls">
                                    <div class="input-group state-success">
                                        <input type="text" class="form-control valid" id="type" name="type" value="<?php echo $assets['type']; ?>" placeholder="请输入应用类型">
                                        <span class="input-group-addon"><span class="arrow"></span><i class="fa fa-pencil"></i></span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?> -->
                        <!--  <div class="form-group">
                              <label class="form-label">安装方式</label>
                              <div class="controls">
                                  <select class="form-control m-bot15" name="installType" id="installType">
                                      <option value="1" selected="">公开</option>
                                      <option value="2">密码安装</option>
                                      <option value="3">邀请安装</option>
                                  </select>
                              </div>
                          </div>-->
                        <div class="form-group">
                            <label class="form-label">版本更新说明:</label>
                            <div class="controls">
                                <textarea class="form-control" rows="3" placeholder="请输入该版本的更新说明" name="instructions"><?php echo $assets['instructions']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">应用介绍: </label>
                            <div class="controls">
                                <textarea class="form-control" rows="3" placeholder="请输入该版本的更新说明" name="introduce"><?php echo $assets['introduce']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">唯一下载链接: </label>
                            <div class="controls">
                                <label style="font-weight: 1;">
                                    <input type="radio" name="only_download" value="1" <?php if($assets['only_download'] == 1): ?>checked<?php endif; ?>> 开启
                                </label>
                                <label style="font-weight: 1;margin-left: 20px;">
                                    <input type="radio" name="only_download" value="0" <?php if($assets['only_download'] == 0): ?>checked<?php endif; ?>> 不开启
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">下载渠道: </label>
                            <div class="controls">
                                <label style="font-weight: 1;">
                                    <input type="radio" name="download_type" value="2" <?php if($assets['download_type'] == 2): ?>checked<?php endif; ?>> 私有池
                                </label>
                                <label style="font-weight: 1;margin-left: 20px;">
                                    <input type="radio" name="download_type" value="1" <?php if($assets['download_type'] == 1): ?>checked<?php endif; ?>> 公有池
                                </label>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="editor-button-left">
                                <input type="hidden" name="id" value="<?php echo $assets['id']; ?>">
                                <button class="btn btn-primary btn-radius-4" type="submit" id="submitButton">修改信息
                                </button>
                            </div>
                            <div class="editor-button-right">
                                <div class="editor-left3">
                                    <a href="<?php echo $assets['er_logo']; ?>" style="background: #3BCDAE;" target="_blank">查 看 下 载</a>
                                </div>
                                <div class="editor-left4">
                                    <a href="/" target="_blank">上 传 应 用</a>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                    <style media="screen">
                    .controls{
                        margin-top: 20px;
                    }
                        span#img {
                            background: url("<?php echo (isset($assets['img']) && ($assets['img'] !== '')?$assets['img']:'/nologo.png'); ?>") center center no-repeat;
                            background-size: cover;
                            display: block;
                            width: 100px;
                            height: 100px;
                        }

                        input#imginput {
                            width: 100px;
                            height: 100px;
                            opacity: 0
                        }
                    </style>
                    
                </form>
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


    <script src="__TMPL__/public/assets/js/slippry.min.js"></script>

    <script>
        $(function () {
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

        function imgshow() {
            var r = new FileReader();
            f = document.getElementById('imginput').files[0];
            r.readAsDataURL(f);
            r.onload = function (e) {
                //alert(this.result);
                $("#img").css('background', 'url(' + this.result + ')');
                $("#img").css('background-size', 'cover');
                // document.getElementById('show').src=this.result;
            };
        }
    </script>
    <?php 
    \think\Hook::listen('before_body_end',$temp5dd348134a557,null,false);
 ?>
</body>
</html>
