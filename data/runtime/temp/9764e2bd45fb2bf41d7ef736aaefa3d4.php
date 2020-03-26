<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"themes/admin_simpleboot3/admin/download/add_sup_charge.html";i:1570008884;s:43:"themes/admin_simpleboot3/public/header.html";i:1570008884;}*/ ?>
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
<style type="text/css">
    .pic-list li {
        margin-bottom: 5px;
    }
    .form-control{width:30%!important;}
</style>

</head>
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li><a href="<?php echo url('download/sup_add_charge'); ?>">手动添加超级签名下载记录</a></li>
        <li  class="active"><a href="<?php echo url('download/add_sup_charge'); ?>">添加超级签名下载</a></li>
    </ul>
    <form action="<?php echo url('download/add_sup_charge_post'); ?>" method="post" class="form-horizontal js-ajax-form margin-top-20">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered">
                	<tr>
                        <th width="150">类型<span class="form-required">*</span></th>
                        <td>
                            <select name="type" class="form-control secleta">
                            	<option value="1">公有</option>
                            	<option value="2">私有</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>会员(id)<span class="form-required">*</span></th>
                        <td>
                            <input class="form-control" type="text" name="uid"
                                   id="title" required placeholder="请输入会员id" value="<?php echo (isset($download['uid'] ) && ($download['uid']  !== '')?$download['uid'] :''); ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <th width="150">添加下载次数(次)<span class="form-required">*</span></th>
                        <td>
                            <input class="form-control" type="text" name="num"
                                   required  placeholder="请输入下载次数" value="<?php echo (isset($download['num']) && ($download['num'] !== '')?$download['num']:''); ?>"/>
                        </td>
                    </tr>


                </table>
                <input type="hidden" name="id" value="<?php echo (isset($download['id'] ) && ($download['id']  !== '')?$download['id'] :''); ?>"/>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('ADD'); ?></button>
                        <a class="btn btn-default" href="<?php echo url('download/index'); ?>"><?php echo lang('BACK'); ?></a>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

</body>
</html>
