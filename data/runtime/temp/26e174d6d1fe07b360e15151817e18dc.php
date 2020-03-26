<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:45:"themes/admin_simpleboot3/admin/app/index.html";i:1570008884;s:43:"themes/admin_simpleboot3/public/header.html";i:1570008884;}*/ ?>
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
        <li class="active"><a href="<?php echo url('app/index'); ?>"><?php echo lang('ADMIN_USER_INDEX'); ?></a></li>
        <!-- <li><a href="<?php echo url('app/add'); ?>"><?php echo lang('ADMIN_USER_ADD'); ?></a></li> -->
    </ul>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url('App/index'); ?>">
        应用名字:
        <input type="text" class="form-control" name="name" style="width: 222px;" value="<?php echo input('request.name/s',''); ?>"
               placeholder="请输入应用名称">

        应用包名:
        <input type="text" class="form-control" name="bundle" style="width: 222px;"
               value="<?php echo input('request.bundle/s',''); ?>" placeholder="请输入应用包名">
        应用类型:
        <select name="type" class="select-type form-control">
            <option value="0">无</option>
            <option value="2">内测分发</option>
            <option value="1">超级签名</option>
        </select>
        <input type="submit" class="btn btn-primary" value="搜索"/>
        <a class="btn btn-danger" href="<?php echo url('App/index'); ?>">清空</a>
    </form>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th width="50">ID</th>
            <th>发布人</th>
            <th>应用</th>
            <th>应用名字</th>
            <th>复制地址</th>
            <th>应用版本</th>
            <th>应用大小</th>
            <th>应用包名</th>
            <th>应用类型</th>
            <th>应用发布时间</th>
            <th>状态</th>
            <th width="130"><?php echo lang('ACTIONS'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($app) || $app instanceof \think\Collection || $app instanceof \think\Paginator): if( count($app)==0 ) : echo "" ;else: foreach($app as $key=>$vo): ?>

            <tr>
                <td><?php echo $vo['id']; ?></td>
                <td><?php echo $vo['user_nickname']; ?></td>
                <td>
                    <img width="30" src="<?php echo $vo['img']; ?>">
                </td>
                <td><?php echo $vo['name']; ?></td>
                <td><a class="bogo-copy-url<?php echo $vo['id']; ?>" onclick="clickCopyUrl('<?php echo $vo['id']; ?>')" data-clipboard-text="<?php echo $vo['url']; ?>">点击复制</a>
                </td>
                <td><?php echo $vo['version']; ?></td>
                <td><?php echo (isset($vo['big']) && ($vo['big'] !== '')?$vo['big']:'0'); ?>M</td>
                <td><?php echo $vo['bundle']; ?></td>
                <td>
                    <?php if($vo['type'] == 1): ?>
                        <font color="#cccccc" class="fa fa-apple">&nbsp;&nbsp;IOS
                        <?php if($vo['is_open_super_sign'] == 1): ?>(超级签名)<?php endif; ?>
                        </font>
                        <?php else: ?>
                        <font color="#cccccc" class="fa fa-android">&nbsp;&nbsp;安卓</font>
                    <?php endif; ?>
                </td>
                <td><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></td>
                <td>
                    <?php if($vo['status'] == 1): ?>
                        <font color="#cccccc">正常</font>
                        <?php elseif($vo['status'] == 2): ?>
                        <font color="#cccccc">审核中</font>
                        <?php elseif($vo['status'] == 3): ?>
                        <font color="#cccccc">已删除</font>
                        <?php elseif($vo['status'] == 4): ?>
                        <font color="#cccccc">官方删除</font>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/<?php echo $vo['er_logo']; ?>" target="view_window">打开链接</a>
                    <br/>

                    <a href='<?php echo url("app/edit",array("id"=>$vo["id"])); ?>'><?php echo lang('EDIT'); ?></a>
                    <br/>
                    <?php if($vo['status'] == 1): ?>
                        <a href='<?php echo url("app/delete",array("id"=>$vo["id"])); ?>'>禁用</a>
                        <?php elseif($vo['status'] == 4): ?>
                        <a href='<?php echo url("app/edit_app_status",array("id"=>$vo["id"],"status"=>1)); ?>'>启用</a>
                        </else>
                    <?php endif; ?>
                    <br/>
                    <a class="js-ajax-delete"
                       href="<?php echo url('app/delete_file',array('id'=>$vo['id'])); ?>"><?php echo lang('DELETE'); ?></a>
                </td>
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="pagination"><?php echo $page; ?></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
<script src="__STATIC__/js/admin.js"></script>
<script type="text/javascript">
    function clickCopyUrl(id) {
        new ClipboardJS('.bogo-copy-url' + id);
    }

    $('.select-type').val(<?php echo input('request.type/s',''); ?>);
</script>
</body>
</html>
