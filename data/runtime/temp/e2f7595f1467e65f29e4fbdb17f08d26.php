<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"themes/admin_simpleboot3/admin/members/index.html";i:1570008884;s:43:"themes/admin_simpleboot3/public/header.html";i:1570008884;}*/ ?>
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
        <li class="active"><a href="javascript:;">会员管理</a></li>
    </ul>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url('members/index'); ?>">
        会员id:
        <input type="text" class="form-control" name="id" style="width: 200px;"
               value="<?php echo (isset($members['id']) && ($members['id'] !== '')?$members['id']:''); ?>" placeholder="请输入会员id...">
        手机号:
        <input type="text" class="form-control" name="mobile" style="width: 200px;"
               value="<?php echo (isset($members['mobile']) && ($members['mobile'] !== '')?$members['mobile']:''); ?>" placeholder="请输入手机号...">
        <input type="submit" class="btn btn-primary" value="搜索"/>

    </form>
    <form class="js-ajax-form" action="" method="post">
        <table class="table table-hover table-bordered table-list">
            <thead>
            <tr>
                <th width="50">ID</th>
                <th>会员名称</th>
                <th>金额</th>
                <th>手机号码</th>
                <th>邮箱</th>
                <th>总下载数</th>
                <th>已下载</th>
                <th width="65">状态</th>
                <th width="90">操作</th>
            </tr>
            </thead>
            <?php if(is_array($user) || $user instanceof \think\Collection || $user instanceof \think\Paginator): if( count($user)==0 ) : echo "" ;else: foreach($user as $key=>$vo): ?>
                <tr>
                    <td><b><?php echo $vo['id']; ?></b></td>
                    <td><?php echo $vo['user_nickname']; ?></td>
                    <td><?php echo $vo['coin']; ?>元</td>
                    <td><?php echo $vo['mobile']; ?></td>
                    <td><?php echo $vo['user_email']; ?></td>
                    <td><?php echo $vo['downloads']; ?></td>
                    <td><?php echo $vo['num']; ?> 次</td>
                    <td>
                        <?php if($vo['user_status'] == '0'): ?>
                                禁用
                        <?php elseif($vo['user_status'] == '1'): ?>
                            正常
                        <?php else: ?>
                            未验证
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="<?php echo url('members/sele',array('id'=>$vo['id'])); ?>">详 情</a> |
                        <?php if($vo['user_status'] == '1'): ?>
                            <a href="<?php echo url('members/upd',array('id'=>$vo['id'],'user_status'=>0)); ?>">禁用</a>
                        <?php else: ?>
                            <a href="<?php echo url('members/upd',array('id'=>$vo['id'],'user_status'=>1)); ?>" >通过</a>
                        <?php endif; ?>

                    </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </table>

        <ul class="pagination"><?php echo (isset($page) && ($page !== '')?$page:''); ?></ul>
    </form>
</div>
<script src="__STATIC__/js/admin.js"></script>

</body>
</html>