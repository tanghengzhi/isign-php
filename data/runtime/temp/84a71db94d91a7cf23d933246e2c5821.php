<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:44:"themes/admin_simpleboot3/admin/app/edit.html";i:1570008884;s:43:"themes/admin_simpleboot3/public/header.html";i:1570008884;}*/ ?>
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
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo url('app/index'); ?>">应用管理</a></li>
			<!-- <li><a href="<?php echo url('user/add'); ?>"><?php echo lang('ADMIN_USER_ADD'); ?></a></li> -->
			<li class="active"><a>编辑应用信息</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('App/editPost'); ?>">
			<div class="form-group">
				<label for="input-user_pass" class="col-sm-2 control-label"><span class="form-required">*</span>应用名称</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-name" name="name" value="<?php echo $name; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_login" class="col-sm-2 control-label"><span class="form-required">*</span>七牛上传文件的地址</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-url" name="url" value="<?php echo $url; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>用户id</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-uid" name="uid" value="<?php echo $uid; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>版本更新说明</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-instructions" name="instructions" value="<?php echo $instructions; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>应用介绍</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-introduce" name="introduce" value="<?php echo $introduce; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>版本号</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-version" name="version" value="<?php echo $version; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>文件大小 单位MB</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-big" name="big" value="<?php echo $big; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>编译版本号</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-build" name="build" value="<?php echo $build; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>应用包名</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-bundle" name="bundle" value="<?php echo $bundle; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>结束时间</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-endtime" name="endtime" value="<?php echo $endtime; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>类型：0-android,1-iOS</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-type" name="type" value="<?php echo $type; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>图片地址|base64</label>
				<div class="col-md-6 col-sm-10">
					<!-- <input type="text" class="form-control" id="input-img" name="img" value="<?php echo $img; ?>"> -->
					<div style="text-align: center;">
						<input type="hidden" name="img" id="thumbnail"
							   value="<?php echo cmf_get_image_preview_url($img); ?>">
						<a href="javascript:uploadOneImage('图片上传','#thumbnail');">
							<?php if(empty($img)): ?>
								<img src="__TMPL__/public/assets/images/default-thumbnail.png"
									 id="thumbnail-preview"
									 width="135" style="cursor: pointer"/>
								<?php elseif(strpos($img,'base64')!==false): ?>
								<img src="<?php echo $img; ?>"
									 id="thumbnail-preview"
									 width="135" style="cursor: pointer"/>
								<?php else: ?>
	 							<img src="<?php echo cmf_get_image_preview_url($img); ?>"
	 									 id="thumbnail-preview"
	 									 width="135" style="cursor: pointer"/>
							<?php endif; ?>
						</a>
						<!-- <input type="button" class="btn btn-sm btn-cancel-thumbnail" value="取消图片"> -->
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>二维码图片路径</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-er_img" name="er_img" value="<?php echo $er_img; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>二维码标识</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-er_logo" name="er_logo" value="<?php echo $er_logo; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>合并id</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-posted_id" name="posted_id" value="<?php echo $posted_id; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>文件原文件名</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-url_name" name="url_name" value="<?php echo $url_name; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>状态：1正常，2审核中，3已删除，4官方删除</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-status" name="status" value="<?php echo $status; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>0公开 1密码安装 2邀请安装</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-way" name="way" value="<?php echo $way; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span>添加时间</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-addtime" name="addtime" value="<?php echo $addtime; ?>">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('SAVE'); ?></button>
					<a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a>
				</div>
			</div>
		</form>
	</div>
	<script src="__STATIC__/js/admin.js"></script>
</body>
</html>
