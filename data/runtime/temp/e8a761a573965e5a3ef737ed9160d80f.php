<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"themes/admin_simpleboot3/admin/user/index.html";i:1570008884;s:43:"themes/admin_simpleboot3/public/header.html";i:1570008884;}*/ ?>
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
			<li class="active"><a href="<?php echo url('user/index'); ?>"><?php echo lang('ADMIN_USER_INDEX'); ?></a></li>
			<li><a href="<?php echo url('user/add'); ?>"><?php echo lang('ADMIN_USER_ADD'); ?></a></li>
		</ul>
        <form class="well form-inline margin-top-20" method="post" action="<?php echo url('User/index'); ?>">
            用户名:
            <input type="text" class="form-control" name="user_login" style="width: 120px;" value="<?php echo input('request.user_login/s',''); ?>" placeholder="请输入<?php echo lang('USERNAME'); ?>">
            邮箱:
            <input type="text" class="form-control" name="user_email" style="width: 120px;" value="<?php echo input('request.user_email/s',''); ?>" placeholder="请输入<?php echo lang('EMAIL'); ?>">
            <input type="submit" class="btn btn-primary" value="搜索" />
            <a class="btn btn-danger" href="<?php echo url('User/index'); ?>">清空</a>
        </form>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="50">ID</th>
					<th><?php echo lang('USERNAME'); ?></th>
					<th><?php echo lang('LAST_LOGIN_IP'); ?></th>
					<th><?php echo lang('LAST_LOGIN_TIME'); ?></th>
					<th><?php echo lang('EMAIL'); ?></th>
					<th><?php echo lang('STATUS'); ?></th>
					<th width="130"><?php echo lang('ACTIONS'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $user_statuses=array("0"=>lang('USER_STATUS_BLOCKED'),"1"=>lang('USER_STATUS_ACTIVATED'),"2"=>lang('USER_STATUS_UNVERIFIED')); if(is_array($users) || $users instanceof \think\Collection || $users instanceof \think\Paginator): if( count($users)==0 ) : echo "" ;else: foreach($users as $key=>$vo): ?>
				<tr>
					<td><?php echo $vo['id']; ?></td>
					<td><?php if($vo['user_url']): ?><a href="<?php echo $vo['user_url']; ?>" target="_blank" title="<?php echo $vo['signature']; ?>"><?php echo $vo['user_login']; ?></a><?php else: ?><?php echo $vo['user_login']; endif; ?></td>
					<td><?php echo $vo['last_login_ip']; ?></td>
					<td>
						<?php if($vo['last_login_time'] == 0): ?>
							<?php echo lang('USER_HAVE_NOT_LOGIN'); else: ?>
							<?php echo date('Y-m-d H:i:s',$vo['last_login_time']); endif; ?>
					</td>
					<td><?php echo $vo['user_email']; ?></td>
					<td><?php echo $user_statuses[$vo['user_status']]; ?></td>
					<td>
						<?php if($vo['id'] == 1 || $vo['id'] == cmf_get_current_admin_id()): ?>
						<font color="#cccccc"><?php echo lang('EDIT'); ?></font>  <font color="#cccccc"><?php echo lang('DELETE'); ?></font>
							<?php if($vo['user_status'] == 1): ?>
								<font color="#cccccc"><?php echo lang('BLOCK_USER'); ?></font>
							<?php else: ?>
								<font color="#cccccc"><?php echo lang('ACTIVATE_USER'); ?></font>
							<?php endif; else: ?>
							<a href='<?php echo url("user/edit",array("id"=>$vo["id"])); ?>'><?php echo lang('EDIT'); ?></a>
							<a class="js-ajax-delete" href="<?php echo url('user/delete',array('id'=>$vo['id'])); ?>"><?php echo lang('DELETE'); ?></a>
							<?php if($vo['user_status'] == 1): ?>
								<a href="<?php echo url('user/ban',array('id'=>$vo['id'])); ?>" class="js-ajax-dialog-btn" data-msg="<?php echo lang('BLOCK_USER_CONFIRM_MESSAGE'); ?>"><?php echo lang('BLOCK_USER'); ?></a>
							<?php else: ?>
								<a href="<?php echo url('user/cancelban',array('id'=>$vo['id'])); ?>" class="js-ajax-dialog-btn" data-msg="<?php echo lang('ACTIVATE_USER_CONFIRM_MESSAGE'); ?>"><?php echo lang('ACTIVATE_USER'); ?></a>
							<?php endif; endif; ?>
					</td>
				</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
		<div class="pagination"><?php echo $page; ?></div>
	</div>
	<script src="__STATIC__/js/admin.js"></script>
</body>
</html>