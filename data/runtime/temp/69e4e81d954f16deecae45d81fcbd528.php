<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:42:"themes/97013266/user/tube/sup_details.html";i:1570008884;s:32:"themes/97013266/public/head.html";i:1570008884;s:36:"themes/97013266/public/function.html";i:1570008884;s:35:"themes/97013266/public/nav_new.html";i:1570008884;s:32:"themes/97013266/public/tube.html";i:1570008884;s:35:"themes/97013266/public/scripts.html";i:1570008884;}*/ ?>
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
    \think\Hook::listen('before_head_end',$temp5dd3474b8fa91,null,false);
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


<div class="col-sm-12 tube_left pad-left_right">
    <!--  我的应用左侧 -->
    <!--  我的应用左侧 -->
<div class="col-sm-2 pad-left_right tube-left1">
    
    <a href="<?php echo cmf_url('user/tube/index'); ?>">
        <div class="col-sm-12 tube-lgs tube-bgs"><i class="fa"><img src="__TMPL__/public/assets/images/summarya1.png"></i><span>概述</span></div>
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
    <!-- <div class="col-sm-15 tube-hei pad-left_right">
        <?php if(is_array($zuoc) || $zuoc instanceof \think\Collection || $zuoc instanceof \think\Paginator): if( count($zuoc)==0 ) : echo "" ;else: foreach($zuoc as $key=>$vo): ?>
            <a href="<?php echo cmf_url('user/tube/details',array('id'=>$vo['id'],'bundle'=>$vo['bundle'],'type'=>$vo['type'])); ?>">
                <div class="col-sm-20 tube-type pad-left_right tube-bgs">
                    <div class="col-sm-3 tube-img">
                        <img src="<?php echo $vo['img']; ?>" class="headicon">
                    </div>
                    <div class="col-sm-9 tube-title  pad-left_right">
                        <div class="col-sm-12 tube-title1"><?php echo $vo['name']; ?></div>
                        <div class="col-sm-12 tube-title2">
                            <?php if($vo['type'] != '0'): ?>
                                <i class="fa fa-apple"></i>
                                <span class="details-type-p2-2"> iOS 应用</span>
                                <?php else: ?>
                                <i class="fa fa-android"></i>
                                <span class="details-type-p2-2"> Android 应用</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; endif; else: echo "" ;endif; ?>

    </div> -->
</div>


    <!--  我的应用右侧 概述 -->
    <div class="col-sm-10 pad-left_right tube-right">
        <!--     应用管理详情 -->
        <div class="col-sm-12 details-til  pad-left_right box_card">
            <div class="col-sm-12 details-type">
                <div class="col-sm-6 details-type-tou">
                    <div class="col-sm-2 details-type-to">
                        <?php $user=cmf_get_current_user(); ?>
                        <img src="<?php echo $assets['img']; ?>" class="headicon">
                    </div>
                    <div class="col-sm-6 details-type-p pad-left_right">
                        <div class="col-sm-12 details-type-p1"><?php echo $assets['name']; ?></div>
                        <div class="col-sm-12 "><span class="details-type-p2-1">内测版</span>
                            <?php if($assets['type'] != '0'): ?>
                                <i class="fa fa-apple"></i>
                                <span class="details-type-p2-2"> 适用于 iOS 设备</span>
                                <?php else: ?>
                                <i class="fa fa-android"></i>
                                <span class="details-type-p2-2"> 适用于 Android 设备</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-3 details-but"><a
                            href="<?php echo cmf_url('user/tube/editor',array('id'=>$assets['id'])); ?>">编辑</a></div>
                    <div class="col-sm-3 details-but2"><a style="background: #0097FF;" href="/">上传</a></div>

                    
                </div>
            </div>
            <div class="col-sm-12 details-ner pad-left_right">
                <div class="posted-edit-t">
                    <div class="col-sm-12 details-ner-lei-1">版本</div>
                    <div class="col-sm-12 details-ner-lei-2"><?php echo $assets['version']; ?></div>
                </div>
                <div class="posted-edit-t">
                    <div class="col-sm-12 details-ner-lei-1">Build</div>
                    <div class="col-sm-12 details-ner-lei-2"><?php echo $assets['build']; ?></div>
                </div>
                <div class="posted-edit-t">
                    <div class="col-sm-12 details-ner-lei-1">大小</div>
                    <div class="col-sm-12 details-ner-lei-2"><?php echo $assets['big']; ?>MB</div>
                </div>
                <div class="posted-edit-t ">
                    <div class="col-sm-12 details-ner-lei-1">总下载次数</div>
                    <div class="col-sm-12 details-ner-lei-2 details-ner-lei-3"><?php echo $sum; ?></div>
                </div>
                <div class="posted-edit-t">
                    <div class="col-sm-12 details-ner-lei-1">Bundle ID</div>
                    <div class="col-sm-12 details-ner-lei-2"><?php echo $assets['bundle']; ?></div>
                </div>
                <div class="posted-edit-t">
                    <div class="col-sm-12 details-ner-lei-1">过期时间</div>
                    <div class="col-sm-12 details-ner-lei-2"><?php echo date("Y-m-d H:i:s",$assets['endtime'] ); ?></div>
                </div>
                <div class="posted-edit-t">
                    <div class="col-sm-12 details-ner-lei-1">下载地址</div>
                    <div class="col-sm-12 details-ner-lei-2">
                        <a href="<?php echo $assets['er_logo']; ?>" target="_blank" style="color:#848484;text-decoration:none;"><?php echo $assets['er_logo']; ?></a>
                    </div>
                </div>
                <div class="posted-edit-t ">
                    <div class="col-sm-12 details-ner-lei-1">下载二维码</div>
                    <div class="col-sm-12 details-ner-lei-2 details-ner-lei-3 erweim" style="height: 60px;"
                         date-url="<?php echo $assets['er_logo']; ?>">
                        <i class="fa fa-qrcode " aria-hidden="true"></i>
                        <div class="erweidws"></div>
                    </div>
                    <!-- <div class="col-sm-12 details-ner-lei-2 details-ner-lei-3 ermxz"><img src="<?php echo $assets['er_img']; ?>" class="headicon"></div>-->
                </div>
            </div>

        </div>
        <div class="col-sm-12 tube-zil pad-left_right">版本信息</div>
        <div class="col-sm-12 tube-panel panel-default pad-left_right box_card">
            <table class="table">
                <thead class="thead1">
                <tr>
                    <th>版本</th>
                    <th>Build</th>
                    <th>大小</th>
                    <th>下载次数</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                
                <tr>
                    <th scope="row"><?php echo $assets['version']; ?></th>
                    <td><?php echo $assets['build']; ?></td>
                    <td><?php echo $assets['big']; ?> MB</td>
                    <td><?php echo $sum; ?></td>
                    <td><?php echo date("Y-m-d H:i",$assets['addtime'] ); ?></td>
                    <td class="tube-tiz details-tiz">
                        <a class="bogo-global-btn" href="<?php echo $assets['www_url']; ?>/<?php echo $assets['url']; ?>" data-url="<?php echo $assets['url']; ?>"
                           data-urls="<?php echo cmf_url('user/tube/downfile',array('id'=>$assets['id'])); ?>"
                           data-id="<?php echo $assets['id']; ?>" class="downfile">下载</a>
                        <a class="bogo-global-btn tube-hebing">合并</a>
                        <a class="bogo-global-btn tube-tiz12"
                           href="<?php echo cmf_url('user/tube/del',array('id'=>$assets['id'])); ?>" date-url="">删除</a>

                    </td>
                </tr>
                <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): if( count($type)==0 ) : echo "" ;else: foreach($type as $key=>$vo): ?>
                    <tr>
                        <th scope="row"><?php echo $vo['version']; ?></th>
                        <td><?php echo $vo['build']; ?></td>
                        <td><?php echo $vo['big']; ?> MB</td>
                        <td><?php echo $vo['sum']; ?></td>
                        <td><?php echo date("Y-m-d H:i",$vo['addtime'] ); ?></td>
                        <td class="tube-tiz details-tiz">
                            <a class="bogo-global-btn" href="<?php echo $assets['www_url']; ?>/<?php echo $vo['url']; ?>" data-url="<?php echo $vo['url']; ?>"
                               data-urls="<?php echo cmf_url('user/tube/downfile',array('id'=>$vo['id'])); ?>"
                               data-id="<?php echo $vo['id']; ?>" class="downfile">下载</a>
                            <a class="bogo-global-btn tube-hebing">合并</a>
                            <a class="bogo-global-btn tube-tiz12"
                               href="<?php echo cmf_url('user/tube/del',array('id'=>$vo['id'])); ?>" date-url="">删除</a>

                        </td>
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

    <link rel="stylesheet" href="__STATIC__/js/layui/css/layui.css" media="all">
    <script src="__STATIC__/js/layui/layui.all.js"></script>
    <script>
        $(function () {
            $(".erweim").click(function () {
                var url = $(this).attr("date-url");
                $(".erweim").find("div").html("");
                $(this).find("div").qrcode({
                    render: "canvas", //table方式
                    width: 98, //宽度
                    height: 98, //高度
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
            $(".tube-tiz12").click(function () {
                var $url = $(this).attr("date-url");
                alert("确定删除");
                window.location.href = url;
            })
            //iframe层
            $(".tube-hebing").click(function () {
                layer.open({
                    type: 2,
                    title: '合并',
                    shadeClose: true,
                    shade: 0.8,
                    area: ['50%', '50%'],
                    content: "<?php echo cmf_url('user/tube/hebing',array('id'=>$assets['id'])); ?>" //iframe的url
                });
            });
            $(".downfile").click(function () {
                return true;
                var url = $(this).attr("data-url");
                var id = $(this).attr("data-id");
                $.ajax({
                    type: 'POST',
                    url: "<?php echo cmf_url('user/tube/downfile_type'); ?>",
                    data: {id: id},
                    success: function (data) {
                        if (data['type'] == '0') {
                            layer.msg('可用下载点数不足', {icon: 2, time: 1000});
                        } else if (data['type'] == '3') {
                            layer.msg('下载失败，请重新下载', {icon: 2, time: 1000});
                        } else {
                            alert(1);
                            window.location.href = "<?php echo $assets['www_url']; ?>"+url;
                        }
                    }
                });
            })


        });
    </script>
    <?php 
    \think\Hook::listen('before_body_end',$temp5dd3474b8faea,null,false);
 ?>
</body>
</html>
