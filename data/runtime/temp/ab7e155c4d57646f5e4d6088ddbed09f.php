<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"themes/admin_simpleboot3/admin/plugin/index.html";i:1570008884;s:43:"themes/admin_simpleboot3/public/header.html";i:1570008884;}*/ ?>
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
			<li class="active"><a href="<?php echo url('plugin/index'); ?>"><?php echo lang('ADMIN_PLUGIN_INDEX'); ?></a></li>
			<li><a href="http://www.thinkcmf.com/appstore/plugin.html" target="_blank">插件市场</a></li>
			<li><a href="http://www.thinkcmf.com/topic/index/index/cat/9.html" target="_blank">插件交流</a></li>
			<li><a href="http://www.thinkcmf.com/docs/cmfx/plugin.html" target="_blank">插件文档</a></li>
		</ul>
		<form method="post" class="js-ajax-form margin-top-20">
			<?php 
			$status=array("1"=>'开启',"0"=>'禁用',"3"=>'未安装');
			 ?>
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>插件名称</th>
						<th>插件标识</th>
						<th>描述</th>
						<th>作者</th>
						<th width="60">状态</th>
						<th width="210">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($plugins) || $plugins instanceof \think\Collection || $plugins instanceof \think\Paginator): if( count($plugins)==0 ) : echo "" ;else: foreach($plugins as $key=>$vo): ?>
					<tr>
						<td><?php echo $vo['title']; ?></td>
						<td><?php echo $vo['name']; ?></td>
						<td><?php echo $vo['description']; ?></td>
						<td><?php echo $vo['author']; ?></td>
						<td><?php echo $status[$vo['status']]; ?></td>
						<td>
							<?php if($vo['status']==3): ?>
								<a href="<?php echo url('plugin/install',array('name'=>$vo['name'])); ?>" class="js-ajax-dialog-btn" data-msg="确定安装该插件吗？">安装</a>
							<?php else: $config=json_decode($vo['config'],true); if(!empty($config)): ?>
									<a href="<?php echo url('plugin/setting',array('id'=>$vo['id'])); ?>">设置</a>
								<?php else: ?>
									<a href="javascript:;" style="color: #ccc;">设置</a>
								<?php endif; if(!empty($vo['has_admin'])): ?>
									<a href="javascript:parent.openapp('<?php echo cmf_plugin_url($vo['name'].'://AdminIndex/index'); ?>','plugin_<?php echo $vo['name']; ?>','<?php echo $vo['title']; ?>')">管理</a>
								<?php else: ?>
									<a href="javascript:;" style="color: #ccc;">管理</a>
								<?php endif; ?>

								<a href="<?php echo url('plugin/update',array('name'=>$vo['name'])); ?>" class="js-ajax-dialog-btn" data-msg="确定更新该插件吗？">更新</a>

								<?php if($vo['status']==0): ?>
									<a href="<?php echo url('plugin/toggle',array('id'=>$vo['id'],'enable'=>1)); ?>" class="js-ajax-dialog-btn" data-msg="确定启用该插件吗？">启用</a>
								<?php else: ?>
									<a href="<?php echo url('plugin/toggle',array('id'=>$vo['id'],'disable'=>1)); ?>" class="js-ajax-dialog-btn" data-msg="确定禁用该插件吗？">禁用</a>
								<?php endif; ?>

								<a href="<?php echo url('plugin/uninstall',array('id'=>$vo['id'])); ?>" class="js-ajax-dialog-btn" data-msg="确定卸载该插件吗？">卸载</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</form>
	</div>
	<script src="__STATIC__/js/admin.js"></script>
</body>
</html>