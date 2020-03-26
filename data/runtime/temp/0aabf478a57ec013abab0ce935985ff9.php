<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"themes/admin_simpleboot3/admin/systems/index.html";i:1570008884;s:43:"themes/admin_simpleboot3/public/header.html";i:1570008884;}*/ ?>
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
<style>
.form-img{width:;}
</style>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">

			<?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): if( count($type)==0 ) : echo "" ;else: foreach($type as $key=>$vo): ?>

				<li <?php if($key == 0): ?> class="active" <?php endif; ?>>
				    <a href="#<?php echo $key; ?>" data-toggle="tab"><?php echo $vo['group_id']; ?></a>
				</li>
				
			<?php endforeach; endif; else: echo "" ;endif; ?>
				<li>
				    <a href="<?php echo url('systems/add_sys'); ?>" >添加配置</a>
				</li>
		</ul>
		<form class="form-horizontal margin-top-20" role="form" action="<?php echo url('systems/upd_post'); ?>" method="post">
			<fieldset>
				<div class="tabbable">
					<div class="tab-content">
						<?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): if( count($type)==0 ) : echo "" ;else: foreach($type as $k=>$vo): ?>
							<div id="<?php echo $k; ?>" <?php if($k == 0): ?> class="tab-pane active" <?php else: ?>  class="tab-pane" <?php endif; ?> >
								<?php if(is_array($config) || $config instanceof \think\Collection || $config instanceof \think\Paginator): if( count($config)==0 ) : echo "" ;else: foreach($config as $key=>$v): if(($v['group_id'] == $vo['group_id']) and ($v['type'] == 0)): ?>
										<div class="form-group">
											<label for="input-site-name" class="col-sm-2 control-label"><span class="form-required">*</span><?php echo $v['title']; ?></label>
											<div class="col-md-6 col-sm-10">
												<input type="text" class="form-control" id="input-site-name" name="<?php echo $v['code']; ?>" value="<?php echo (isset($v['val']) && ($v['val'] !== '')?$v['val']:''); ?>">
											</div>
										</div>
									<?php endif; if(($v['group_id'] == $vo['group_id']) and ($v['type'] == 1)): ?>	
										<div class="form-group">
											<label for="input-site-name" class="col-sm-2 control-label"><span class="form-required">*</span><?php echo $v['title']; ?></label>
											<div class="col-md-6 col-sm-10">
												 <textarea name="<?php echo $v['code']; ?>"><?php echo $v['val']; ?></textarea>
											</div>
										</div>
									<?php endif; if(($v['group_id'] == $vo['group_id']) and ($v['type'] == 2)): ?>
										<div class="form-group">
												<label for="input-mobile_tpl_enabled" class="col-sm-2 control-label">缩略图</label>
												<div class="col-md-6 col-sm-10">
													
													<div style="text-align: center;">
							                                <input type="hidden" name="<?php echo $v['code']; ?>" id="thumb" value="<?php echo (isset($v['val']) && ($v['val'] !== '')?$v['val']:''); ?>">
							                                <a href="javascript:uploadOneImage('图片上传','#thumb');">
							                                    <?php if(empty($v['val'])): ?>
							                                        <img src="__TMPL__/public/assets/images/default-thumbnail.png"
							                                             id="thumb-preview" width="135" style="cursor: hand"/>
							                                        <?php else: ?>
							                                        <img src="<?php echo cmf_get_image_preview_url($v['val']); ?>" id="thumb-preview"
							                                             width="135" style="cursor: hand"/>
							                                    <?php endif; ?>
							                                </a>
							                                <input type="button" class="btn btn-sm"
							                                       onclick="$('#thumb-preview').attr('src','__TMPL__/public/assets/images/default-thumbnail.png');$('#thumb').val('');return false;"
							                                       value="取消图片">
							                            </div>
												</div>
										</div>
									<?php endif; if(($v['group_id'] == $vo['group_id']) and ($v['type'] == 3)): ?>
										<div class="form-group">
											<label for="input-mobile_tpl_enabled" class="col-sm-2 control-label"><?php echo $v['title']; ?></label>
											<div class="col-md-6 col-sm-10">
												<div class="checkbox">
												    <?php if(is_array($v['checkbox_val']) || $v['checkbox_val'] instanceof \think\Collection || $v['checkbox_val'] instanceof \think\Paginator): if( count($v['checkbox_val'])==0 ) : echo "" ;else: foreach($v['checkbox_val'] as $i=>$tv): ?>
														<label>
															<input type="checkbox" name="<?php echo $v['code']; ?>[]" value="<?php echo $i; ?>" <?php if(is_array($v['checkbox_check']) || $v['checkbox_check'] instanceof \think\Collection || $v['checkbox_check'] instanceof \think\Paginator): if( count($v['checkbox_check'])==0 ) : echo "" ;else: foreach($v['checkbox_check'] as $key=>$cv): if($i == $cv): ?> checked <?php endif; endforeach; endif; else: echo "" ;endif; ?> > <?php echo $tv; ?>
														</label>
													<?php endforeach; endif; else: echo "" ;endif; ?>
												</div>
											</div>
										</div>
									<?php endif; if(($v['group_id'] == $vo['group_id']) and ($v['type'] == 4)): ?>
										<div class="form-group">
											<label for="input-mobile_tpl_enabled" class="col-sm-2 control-label"><?php echo $v['title']; ?></label>
											<div class="col-md-6 col-sm-10">
												<div class="checkbox">
												    <?php if(is_array($v['type_val']) || $v['type_val'] instanceof \think\Collection || $v['type_val'] instanceof \think\Paginator): if( count($v['type_val'])==0 ) : echo "" ;else: foreach($v['type_val'] as $key=>$tv): ?>
														<label>
															<input type="radio" name="<?php echo $v['code']; ?>" value="<?php echo $key; ?>" <?php if($v['val'] == $key): ?> checked <?php endif; ?> > <?php echo $tv; ?>
														</label>
													<?php endforeach; endif; else: echo "" ;endif; ?>
												</div>
											</div>
										</div>
									<?php endif; if(($v['group_id'] == $vo['group_id']) and ($v['type'] == 5)): ?>
										<div class="form-group">
											<label for="input-site-name" class="col-sm-2 control-label"><span class="form-required">*</span><?php echo $v['title']; ?></label>
											<div class="col-md-6 col-sm-10">
												 <input type="text" class="form-control js-bootstrap-datetime" name="<?php echo $v['code']; ?>"
              											 value="<?php echo $v['val']; ?>" style="width: 140px;" autocomplete="off">
											</div>
										</div>
					               <?php endif; endforeach; endif; else: echo "" ;endif; ?>	
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="1"><?php echo lang('SAVE'); ?></button>
									</div>
								</div>
							</div>	
						<?php endforeach; endif; else: echo "" ;endif; ?>						
					</div>
				</div>
			</fieldset>
		</form>

	</div>
	<script type="text/javascript" src="__STATIC__/js/admin.js"></script>
</body>
</html>