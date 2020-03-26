<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:64:"themes/admin_simpleboot3/admin/certificate/edit_certificate.html";i:1570008884;s:43:"themes/admin_simpleboot3/public/header.html";i:1570008884;}*/ ?>
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
        <li><a href="<?php echo url('certificate/index'); ?>">证书列表</a></li>
        <li class="active"><a href="#}">编辑证书</a></li>
    </ul>

    <div class="wrap js-check-wrap">
        <form class="form-horizontal" action="<?php echo url('certificate/edit_certificate_post'); ?>" method="post"
              enctype="multipart/form-data">
            <input name="id" type="hidden" value="<?php echo (isset($certificate['id']) && ($certificate['id'] !== '')?$certificate['id']:''); ?>">
            <div class="form-group">
                <label>备注信息</label>
                <input type="text" class="form-control" name="mark" id="mark" placeholder="请输入备注信息"
                       value="<?php echo (isset($certificate['mark']) && ($certificate['mark'] !== '')?$certificate['mark']:''); ?>">
            </div>
            <div class="form-group">
                <label>用户 <i>*不选择默认公有</i> </label>
                <select name="user_id" class="form-control selectuser">
                    <option value="1">无</option>
                    <?php if(is_array($userAll) || $userAll instanceof \think\Collection || $userAll instanceof \think\Paginator): if( count($userAll)==0 ) : echo "" ;else: foreach($userAll as $key=>$val): ?>
                        <option value="<?php echo $val['id']; ?>"><?php echo $val['user_nickname']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Team ID</label>
                <input type="text" class="form-control" name="team_id" id="team_id" placeholder="请输入Team ID"
                       value="<?php echo (isset($certificate['team_id']) && ($certificate['team_id'] !== '')?$certificate['team_id']:''); ?>">
            </div>
            <div class="form-group">
                <label>Iss</label>
                <input type="text" class="form-control" name="iss" id="iss" placeholder="请输入Iss"
                       value="<?php echo (isset($certificate['iss']) && ($certificate['iss'] !== '')?$certificate['iss']:''); ?>">
            </div>
            <div class="form-group">
                <label>Kid</label>
                <input type="text" class="form-control" name="kid" id="kid" placeholder="请输入Kid"
                       value="<?php echo (isset($certificate['kid']) && ($certificate['kid'] !== '')?$certificate['kid']:''); ?>">
            </div>
            <div class="form-group">
                <label>Tid</label>
                <input type="text" class="form-control" name="tid" id="tid" placeholder="请输入与Tid"
                       value="<?php echo (isset($certificate['tid']) && ($certificate['tid'] !== '')?$certificate['tid']:''); ?>">
            </div>
            <div class="form-group">
                <label>P12 密码</label>
                <input type="text" class="form-control" name="p12_pwd" id="p12_pwd" placeholder="请输入P12密码"
                       value="<?php echo (isset($certificate['p12_pwd']) && ($certificate['p12_pwd'] !== '')?$certificate['p12_pwd']:''); ?>">
            </div>

            <div class="form-group">
                <label>P12文件上传</label>
                <input type="file" id="p12_file" name="p12_file">
                <p class="help-block">请上传P12文件</p>
            </div>

            <div class="form-group">
                <label>P8文件上传</label>
                <input type="file" id="p8_file" name="p8_file">
                <p class="help-block">请上传P8文件</p>
            </div>
            <button type="submit" class="btn btn-default">保存</button>
        </form>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
<script src="__STATIC__/js/admin.js"></script>
<script type="text/javascript">
    $('.selectuser').val(<?php echo $certificate['user_id']; ?>);
</script>
</body>
</html>
