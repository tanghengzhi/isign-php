<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"themes/admin_simpleboot3/admin/download/sup_add_charge.html";i:1570008884;s:43:"themes/admin_simpleboot3/public/header.html";i:1570008884;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->


    <link href="__TMPL__/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="__TMPL__/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <link href="__STATIC__/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style>
        form .input-order {
            margin-bottom: 0px;
            padding: 0 2px;
            width: 42px;
            font-size: 12px;
        }

        form .input-order:focus {
            outline: none;
        }

        .table-actions {
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0px;
        }

        .table-list {
            margin-bottom: 0px;
        }

        .form-required {
            color: red;
        }
    </style>
    <script type="text/javascript">
        //全局变量
        var GV = {
            ROOT: "__ROOT__/",
            WEB_ROOT: "__WEB_ROOT__/",
            JS_ROOT: "static/js/",
            APP: '<?php echo \think\Request::instance()->module(); ?>'/*当前应用名*/
        };
    </script>
    <script src="__TMPL__/public/assets/js/jquery-1.10.2.min.js"></script>
    <script src="__STATIC__/js/wind.js"></script>
    <script src="__TMPL__/public/assets/js/bootstrap.min.js"></script>
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        $(function () {
            $("[data-toggle='tooltip']").tooltip();
            $("li.dropdown").hover(function () {
                $(this).addClass("open");
            }, function () {
                $(this).removeClass("open");
            });
        });
    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; ?>
</head>
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:;">手动添加超级签名下载记录</a></li>
        <li><a href="<?php echo url('download/add_sup_charge'); ?>">添加超级签名下载</a></li>
    </ul>

    <form class="js-ajax-form" action="" method="post" style="margin-top:50px;">
        <table class="table table-hover table-bordered table-list">
            <thead>
            <tr>
                <th width="50">ID</th>
                <th>会员(id)</th>
                <th>类型</th>
                <th>添加下载数</th>
                <th>添加时间</th>
            </tr>
            </thead>
            <?php if(is_array($download) || $download instanceof \think\Collection || $download instanceof \think\Paginator): if( count($download)==0 ) : echo "" ;else: foreach($download as $key=>$vo): ?>
                <tr>
                    <td><b><?php echo $vo['id']; ?></b></td>
                    <td><?php echo $vo['name']; ?>(<?php echo $vo['uid']; ?>)</td>
                    <td><?php if($vo['type'] == 1): ?>公有<?php else: ?>私有<?php endif; ?></td>
                    <td><?php echo $vo['num']; ?></td>
                    <td><?php echo date("Y-m-d H:i:s",$vo['addtime'] ); ?> </td>

                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </table>
    </form>
</div>
<script src="__STATIC__/js/admin.js"></script>

</body>
</html>