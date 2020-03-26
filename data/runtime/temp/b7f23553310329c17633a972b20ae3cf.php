<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"themes/admin_simpleboot3/admin/rbac/index.html";i:1570008884;s:43:"themes/admin_simpleboot3/public/header.html";i:1570008884;}*/ ?>
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
			<li class="active"><a href="<?php echo url('rbac/index'); ?>"><?php echo lang('ADMIN_RBAC_INDEX'); ?></a></li>
			<li><a href="<?php echo url('rbac/roleAdd'); ?>"><?php echo lang('ADMIN_RBAC_ROLEADD'); ?></a></li>
		</ul>
		<form action="<?php echo url('Rbac/listorders'); ?>" method="post" class="margin-top-20">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th width="40">ID</th>
						<th align="left"><?php echo lang('ROLE_NAME'); ?></th>
						<th align="left"><?php echo lang('ROLE_DESCRIPTION'); ?></th>
						<th width="60" align="left"><?php echo lang('STATUS'); ?></th>
						<th width="160"><?php echo lang('ACTIONS'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($roles) || $roles instanceof \think\Collection || $roles instanceof \think\Paginator): if( count($roles)==0 ) : echo "" ;else: foreach($roles as $key=>$vo): ?>
					<tr>
						<td><?php echo $vo['id']; ?></td>
						<td><?php echo $vo['name']; ?></td>
						<td><?php echo $vo['remark']; ?></td>
						<td>
							<?php if($vo['status'] == 1): ?>
								<font color="red">√</font>
							<?php else: ?> 
								<font color="red">╳</font>
							<?php endif; ?>
						</td>
						<td>
							<?php if($vo['id'] == 1): ?>
								<font color="#cccccc"><?php echo lang('ROLE_SETTING'); ?></font>  <!-- <a href="javascript:openIframeDialog('<?php echo url('rbac/member',array('id'=>$vo['id'])); ?>','成员管理');">成员管理</a> | -->
								<font color="#cccccc"><?php echo lang('EDIT'); ?></font>  <font color="#cccccc"><?php echo lang('DELETE'); ?></font>
							<?php else: ?>
								<a href="<?php echo url('Rbac/authorize',array('id'=>$vo['id'])); ?>"><?php echo lang('ROLE_SETTING'); ?></a>
								<!-- <a href="javascript:openIframeDialog('<?php echo url('rbac/member',array('id'=>$vo['id'])); ?>','成员管理');">成员管理</a>| -->
								<a href="<?php echo url('Rbac/roleedit',array('id'=>$vo['id'])); ?>"><?php echo lang('EDIT'); ?></a>
								<a class="js-ajax-delete" href="<?php echo url('Rbac/roledelete',array('id'=>$vo['id'])); ?>"><?php echo lang('DELETE'); ?></a>
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