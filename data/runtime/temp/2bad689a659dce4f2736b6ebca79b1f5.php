<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:53:"themes/admin_simpleboot3/admin/certificate/index.html";i:1570008884;s:43:"themes/admin_simpleboot3/public/header.html";i:1570008884;}*/ ?>
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
        <li class="active"><a href="<?php echo url('certificate/index'); ?>">证书列表</a></li>
        <li><a href="<?php echo url('certificate/add_certificate'); ?>">添加证书</a></li>
    </ul>

    <table class="table table-hover table-bordered margin-top-20">
        <thead>
        <tr>
            <th width="50">ID</th>
            <th>证书作者</th>
            <th>Team ID</th>
            <th>Iss</th>
            <th>Kid</th>
            <th>Tid</th>
            <th>P12密码</th>
            <th>剩余UDID数</th>
            <th>已添加UDID数</th>
            <th>备注</th>
            <th>点击下载P12</th>
            <th>点击下载P8</th>
            <th>创建时间</th>
            <th>状态</th>
            <th width="130"><?php echo lang('ACTIONS'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
            <tr>
                <td><?php echo $vo['id']; ?></td>
                <td><?php echo $vo['user_id']; ?></td>
                <td><?php echo $vo['team_id']; ?></td>
                <td><?php echo $vo['iss']; ?></td>
                <td><?php echo $vo['kid']; ?></td>
                <td><?php echo $vo['tid']; ?></td>
                <td><?php echo $vo['p12_pwd']; ?></td>
                <td><?php echo $vo['limit_count']; ?></td>
                <td><?php echo $vo['total_count']; ?></td>
                <td><?php echo $vo['mark']; ?></td>
                <td>
                    <a>点击下载</a>
                </td>
                <td>
                    <a>点击下载</a>
                </td>
                <td><?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></td>
                <td>
                    <?php if($vo['status'] == 1): ?>
                        <font color="green">启用</font>
                        <?php elseif($vo['status'] == 0): ?>
                        <font color="red">未启用</font>
                    <?php endif; ?>
                </td>
                <td>
                    <a href='<?php echo url("certificate/certificate_status",array("id"=>$vo["id"])); ?>'>启用</a>
                    <a href='<?php echo url("certificate/certificate_status",array("id"=>$vo["id"])); ?>'>禁用</a>
                    <br/>
                    <a href='<?php echo url("certificate/edit_certificate",array("id"=>$vo["id"])); ?>'><?php echo lang('EDIT'); ?></a>
                    <br/>
                    <a class="js-ajax-delete" href="<?php echo url('certificate/certificate_del',array('id'=>$vo['id'])); ?>"><?php echo lang('DELETE'); ?></a>
                </td>
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
<script src="__STATIC__/js/admin.js"></script>

</body>
</html>
