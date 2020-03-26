<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:44:"themes/97013266/portal/posted/deduction.html";i:1570008884;s:32:"themes/97013266/public/head.html";i:1570008884;s:36:"themes/97013266/public/function.html";i:1570008884;s:35:"themes/97013266/public/nav_new.html";i:1570008884;}*/ ?>
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
    
    <!--  我的应用右侧 概述 -->
    <div class="col-sm-10 pad-left_right tube-right">

        <!--     账户资料 -->
        <div class="col-sm-12 pad-left_right" style="font-size: 14px;padding: 0;margin-top:40px;margin-bottom: 20px;">超级签名应用 > <span style="color:#3BCDAE;">扣量明细</span></div>

            <div class="col-sm-12 tube-panel panel-default pad-left_right box_card tube-panel-bottom">
                <table class="table">
                    <thead style="">
                    <tr>
                        <th>应用名称</th>
                        <th>版本</th>
                        <th>udid</th>
                        <th>设备</th>
                        <th>下载IP</th>
                        <th>下载时间</th>
                        
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
                                            <i class="fa fa-apple"></i>&nbsp;&nbsp;苹果
                                        
                                    </div>
                                </div>
                            </th>
                            <td><?php echo $v['version']; ?></td>
                            <td><?php echo $v['udid']; ?></td>
                            <td><?php echo $v['device']; ?></td>
                            <td><?php echo $v['ip']; ?></td>
                            
                            
                            <td><?php echo date("Y-m-d H:i:s",$v['addtime'] ); ?></td>
                            
                            
                        </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <input class="sup-textarea" type="hidden" value="">

</body>
<script src="__TMPL__/public/assets/simpleboot3/bootstrap/js/bootstrap.min.js"></script>
<script src="__STATIC__/js/layui/layui.all.js"></script>

<script type="text/javascript">

  
    $('#dow-link').click(function(){
        var appid = $(this).attr('data-id');
        var url = $(this).attr('date-url');
        //date-url
        $.ajax({
            url: '/portal/posted/download_link',
            type: 'POST', //GET
            async: true,    //或false,是否异步
            data: {
                appid: appid,
                url: url,
            },
            timeout: 5000,    //超时时间
            dataType: 'json',    //返回的数据格式：json/xml/html/script/jsonp/text
            /*beforeSend: function (xhr) {
                log(xhr)
                log('发送前')
            },*/
            success: function (data) {

                log(data)
                layer.open({
                    type: 1
                    //,offset: type //具体配置参考：http://www.layui.com/doc/modules/layer.html#offset
                    //,id: 'layerDemo' //防止重复弹出
                    ,content: '<div style="padding: 20px 10px;">'+ data.url +'</div>'
                    ,btn: '关闭'
                    ,btnAlign: 'c' //按钮居中
                    ,shade: 0 //不显示遮罩
                    ,yes: function(){
                      layer.closeAll();
                    }
                });

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
    })

    

</script>
</html>

