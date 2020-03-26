<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:50:"themes/admin_simpleboot3/admin/plugin/setting.html";i:1570008884;s:52:"themes/admin_simpleboot3/admin/plugin/functions.html";i:1570008884;s:43:"themes/admin_simpleboot3/public/header.html";i:1570008884;}*/ ?>
<?php 
    function _parse_plugin_config($pluginConfig){

 if(is_array($pluginConfig) || $pluginConfig instanceof \think\Collection || $pluginConfig instanceof \think\Paginator): if( count($pluginConfig)==0 ) : echo "" ;else: foreach($pluginConfig as $key=>$form): switch($form['type']): case "text": ?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="<?php echo $key; ?>">
                    <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); if(!(empty($form['rule']['require']) || (($form['rule']['require'] instanceof \think\Collection || $form['rule']['require'] instanceof \think\Paginator ) && $form['rule']['require']->isEmpty()))): ?>
                        <span class="form-required">*</span>
                    <?php endif; ?>
                </label>
                <div class="col-md-6 col-sm-10">
                    <input type="text" name="config[<?php echo $key; ?>]" class="form-control" value="<?php echo $form['value']; ?>" id="<?php echo $key; ?>">
                    <?php if(isset($form['tip'])): ?>
                        <p class="help-block"><?php echo $form['tip']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php break; case "password": ?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="<?php echo $key; ?>">
                    <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); if(!(empty($form['rule']['require']) || (($form['rule']['require'] instanceof \think\Collection || $form['rule']['require'] instanceof \think\Paginator ) && $form['rule']['require']->isEmpty()))): ?>
                        <span class="form-required">*</span>
                    <?php endif; ?>
                </label>
                <div class="col-md-6 col-sm-10">
                    <input type="password" name="config[<?php echo $key; ?>]" class="form-control" value="<?php echo $form['value']; ?>"
                           id="<?php echo $key; ?>">
                    <?php if(isset($form['tip'])): ?>
                        <p class="help-block"><?php echo $form['tip']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php break; case "number": ?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="<?php echo $key; ?>">
                    <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); if(!(empty($form['rule']['require']) || (($form['rule']['require'] instanceof \think\Collection || $form['rule']['require'] instanceof \think\Paginator ) && $form['rule']['require']->isEmpty()))): ?>
                        <span class="form-required">*</span>
                    <?php endif; ?>
                </label>
                <div class="col-md-6 col-sm-10">
                    <input type="number" name="config[<?php echo $key; ?>]" class="form-control" value="<?php echo $form['value']; ?>"
                           id="<?php echo $key; ?>">
                    <?php if(isset($form['tip'])): ?>
                        <p class="help-block"><?php echo $form['tip']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php break; case "hidden": ?>
            <input type="hidden" name="config[<?php echo $key; ?>]" value="<?php echo $form['value']; ?>">
        <?php break; case "radio": ?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="<?php echo $key; ?>">
                    <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); if(!(empty($form['rule']['require']) || (($form['rule']['require'] instanceof \think\Collection || $form['rule']['require'] instanceof \think\Paginator ) && $form['rule']['require']->isEmpty()))): ?>
                        <span class="form-required">*</span>
                    <?php endif; ?>
                </label>
                <div class="col-md-6 col-sm-10">
                    <?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): if( count($form['options'])==0 ) : echo "" ;else: foreach($form['options'] as $opt_k=>$opt): ?>
                        <label class="radio-inline">
                            <?php $radio_checked=$opt_k==$form['value']?"checked":""; ?>
                            <input type="radio" name="config[<?php echo $key; ?>]" value="<?php echo $opt_k; ?>" <?php echo $radio_checked; ?>><?php echo $opt; ?>
                        </label>
                    <?php endforeach; endif; else: echo "" ;endif; if(isset($form['tip'])): ?>
                        <p class="help-block"><?php echo $form['tip']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php break; case "checkbox": ?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="<?php echo $key; ?>">
                    <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); if(!(empty($form['rule']['require']) || (($form['rule']['require'] instanceof \think\Collection || $form['rule']['require'] instanceof \think\Paginator ) && $form['rule']['require']->isEmpty()))): ?>
                        <span class="form-required">*</span>
                    <?php endif; ?>
                </label>
                <div class="col-md-6 col-sm-10">
                    <?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): if( count($form['options'])==0 ) : echo "" ;else: foreach($form['options'] as $opt_k=>$opt): ?>
                        <label class="checkbox-inline">
                            <?php 
                                is_null($form["value"]) && $form["value"] = array();
                             ?>
                            <input type="checkbox" name="config[<?php echo $key; ?>][]" value="<?php echo $opt_k; ?>"
                            <?php if(in_array(($opt_k), is_array($form['value'])?$form['value']:explode(',',$form['value']))): ?> checked<?php endif; ?>
                            ><?php echo $opt; ?>
                        </label>
                    <?php endforeach; endif; else: echo "" ;endif; if(isset($form['tip'])): ?>
                        <p class="help-block"><?php echo $form['tip']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php break; case "select": ?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="<?php echo $key; ?>">
                    <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); if(!(empty($form['rule']['require']) || (($form['rule']['require'] instanceof \think\Collection || $form['rule']['require'] instanceof \think\Paginator ) && $form['rule']['require']->isEmpty()))): ?>
                        <span class="form-required">*</span>
                    <?php endif; ?>
                </label>
                <div class="col-md-6 col-sm-10">
                    <select class="form-control" name="config[<?php echo $key; ?>]" id="<?php echo $key; ?>">
                        <?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): if( count($form['options'])==0 ) : echo "" ;else: foreach($form['options'] as $opt_k=>$opt): ?>
                            <option value="<?php echo $opt_k; ?>"
                            <?php if($form['value'] == $opt_k): ?> selected<?php endif; ?>
                            ><?php echo $opt; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <?php if(isset($form['tip'])): ?>
                        <p class="help-block"><?php echo $form['tip']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php break; case "textarea": ?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="<?php echo $key; ?>">
                    <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); if(!(empty($form['rule']['require']) || (($form['rule']['require'] instanceof \think\Collection || $form['rule']['require'] instanceof \think\Paginator ) && $form['rule']['require']->isEmpty()))): ?>
                        <span class="form-required">*</span>
                    <?php endif; ?>
                </label>
                <div class="col-md-6 col-sm-10">
                    <textarea class="form-control" name="config[<?php echo $key; ?>]" id="<?php echo $key; ?>"><?php echo $form['value']; ?></textarea>
                    <?php if(isset($form['tip'])): ?>
                        <p class="help-block"><?php echo $form['tip']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php break; case "group": ?>
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): if( count($form['options'])==0 ) : echo "" ;else: $groupIndex=0; foreach($form['options'] as $groupKey=>$groupItem): ++$groupIndex; ?>
                        <li role="presentation" class="<?php echo $groupIndex==1?'active':''; ?>">
                            <a href="#tab-<?php echo $groupKey; ?>" role="tab" data-toggle="tab" aria-controls="home"
                               aria-expanded="true"><?php echo (isset($groupItem['title']) && ($groupItem['title'] !== '')?$groupItem['title']:''); ?></a>
                        </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="tab-content margin-top-20">
                    <?php if(is_array($form['options']) || $form['options'] instanceof \think\Collection || $form['options'] instanceof \think\Paginator): if( count($form['options'])==0 ) : echo "" ;else: $groupIndex=0; foreach($form['options'] as $groupKey=>$groupItem): ++$groupIndex; ?>
                        <div role="tabpanel" class="tab-pane fade in <?php echo $groupIndex==1?'active':''; ?>" id="tab-<?php echo $groupKey; ?>"
                             aria-labelledby="home-tab">
                            <?php echo _parse_plugin_config($groupItem['options']); ?>
                        </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        <?php break; case "date": ?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="<?php echo $key; ?>">
                    <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); if(!(empty($form['rule']['require']) || (($form['rule']['require'] instanceof \think\Collection || $form['rule']['require'] instanceof \think\Paginator ) && $form['rule']['require']->isEmpty()))): ?>
                        <span class="form-required">*</span>
                    <?php endif; ?>
                </label>
                <div class="col-md-6 col-sm-10">
                    <input class="form-control js-bootstrap-date" name="config[<?php echo $key; ?>]" id="<?php echo $key; ?>"
                           value="<?php echo $form['value']; ?>">
                    <?php if(isset($form['tip'])): ?>
                        <p class="help-block"><?php echo $form['tip']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php break; case "datetime": ?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="<?php echo $key; ?>">
                    <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); if(!(empty($form['rule']['require']) || (($form['rule']['require'] instanceof \think\Collection || $form['rule']['require'] instanceof \think\Paginator ) && $form['rule']['require']->isEmpty()))): ?>
                        <span class="form-required">*</span>
                    <?php endif; ?>
                </label>
                <div class="col-md-6 col-sm-10">
                    <input class="form-control js-bootstrap-datetime" name="config[<?php echo $key; ?>]" id="<?php echo $key; ?>"
                           value="<?php echo $form['value']; ?>">
                    <?php if(isset($form['tip'])): ?>
                        <p class="help-block"><?php echo $form['tip']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php break; case "color": ?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="<?php echo $key; ?>">
                    <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); if(!(empty($form['rule']['require']) || (($form['rule']['require'] instanceof \think\Collection || $form['rule']['require'] instanceof \think\Paginator ) && $form['rule']['require']->isEmpty()))): ?>
                        <span class="form-required">*</span>
                    <?php endif; ?>
                </label>
                <div class="col-md-6 col-sm-10">
                    <input class="form-control js-color" name="config[<?php echo $key; ?>]" id="<?php echo $key; ?>"
                           value="<?php echo $form['value']; ?>">
                    <?php if(isset($form['tip'])): ?>
                        <p class="help-block"><?php echo $form['tip']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php break; case "image": ?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="<?php echo $key; ?>">
                    <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); if(!(empty($form['rule']['require']) || (($form['rule']['require'] instanceof \think\Collection || $form['rule']['require'] instanceof \think\Paginator ) && $form['rule']['require']->isEmpty()))): ?>
                        <span class="form-required">*</span>
                    <?php endif; ?>
                </label>
                <div class="col-md-6 col-sm-10">
                    <input type="hidden" name="config[<?php echo $key; ?>]" class="form-control"
                           value="<?php echo $form['value']; ?>" id="js-<?php echo $key; ?>-input">
                    <div>
                        <a href="javascript:uploadOneImage('图片上传','#js-<?php echo $key; ?>-input');">
                            <?php if(empty($form['value'])): ?>
                                <img src="__TMPL__/public/assets/images/default-thumbnail.png"
                                     id="js-<?php echo $key; ?>-input-preview"
                                     width="135" style="cursor: pointer"/>
                                <?php else: ?>
                                <img src="<?php echo cmf_get_image_preview_url($form['value']); ?>"
                                     id="js-<?php echo $key; ?>-input-preview"
                                     width="135" style="cursor: pointer"/>
                            <?php endif; ?>
                        </a>
                    </div>
                    <?php if(isset($form['tip'])): ?>
                        <p class="help-block"><?php echo $form['tip']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php break; case "location": ?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="<?php echo $key; ?>">
                    <?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); if(!(empty($form['rule']['require']) || (($form['rule']['require'] instanceof \think\Collection || $form['rule']['require'] instanceof \think\Paginator ) && $form['rule']['require']->isEmpty()))): ?>
                        <span class="form-required">*</span>
                    <?php endif; ?>
                </label>
                <div class="col-md-6 col-sm-10">
                    <input class="form-control" name="config[<?php echo $key; ?>]" id="<?php echo $key; ?>" value="<?php echo $form['value']; ?>"
                           onclick="doSelectLocation(this)"
                           data-title="请选择<?php echo (isset($form['title']) && ($form['title'] !== '')?$form['title']:''); ?>">
                    <?php if(isset($form['tip'])): ?>
                        <p class="help-block"><?php echo $form['tip']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php break; endswitch; endforeach; endif; else: echo "" ;endif; 
    }
 ?>
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
        <li><a href="<?php echo url('plugin/index'); ?>"><?php echo lang('ADMIN_PLUGIN_INDEX'); ?></a></li>
        <li class="active"><a><?php echo lang('ADMIN_PLUGIN_SETTING'); ?></a></li>
    </ul>
    <form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('plugin/settingPost'); ?>">
        <?php if(empty($custom_config) || (($custom_config instanceof \think\Collection || $custom_config instanceof \think\Paginator ) && $custom_config->isEmpty())): ?>
            <?php echo _parse_plugin_config($data['config']); else: if(isset($custom_config)): ?>
                <?php echo $custom_config; endif; endif; ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="hidden" name="id" value="<?php echo $id; ?>" readonly>
                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">保存</button>
                <a class="btn btn-default" href="javascript:history.back(-1);">返回</a>
            </div>
        </div>
    </form>
</div>
<script src="__STATIC__/js/admin.js"></script>
<script>

    Wind.use('colorpicker',function(){
        $('.js-color').each(function () {
            var $this=$(this);
            $this.ColorPicker({
                livePreview:true,
                onChange: function(hsb, hex, rgb) {
                    $this.val('#'+hex);
                },
                onBeforeShow: function () {
                    $(this).ColorPickerSetColor(this.value);
                }
            });
        });

    });

    function doSelectLocation(obj) {
        var $obj       = $(obj);
        var title      = $obj.data('title');
        var $realInput = $obj;
        var location   = $realInput.val();

        parent.openIframeLayer(
            "<?php echo url('dialog/map'); ?>?location=" + location,
            title,
            {
                area: ['700px', '90%'],
                btn: ['确定', '取消'],
                yes: function (index, layero) {
                    var iframeWin = parent.window[layero.find('iframe')[0]['name']];
                    var location  = iframeWin.confirm();
                    $realInput.val(location.lng + ',' + location.lat);
                    //$obj.val(location.address);
                    parent.layer.close(index); //如果设定了yes回调，需进行手工关闭
                }
            }
        );
    }
</script>
</body>
</html>