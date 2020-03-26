<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:43:"themes/97013266/user/install/index_new.html";i:1570008884;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="telephone=no" name="format-detection"/>
    <title><?php echo $result['name']; ?> 下载</title>
    <link href="/themes/simpleboot3/public/assets/css/install.css" rel="stylesheet">
    <link href="/themes/simpleboot3/public/assets/simpleboot3/font-awesome/4.4.0/css/font-awesome.min.css"
          rel="stylesheet" type="text/css">
</head>
<body>

<div class="install">
    <div class="install-top"><img src="<?php echo $result['img']; ?>"/></div>
    <div class="install-title">
        <?php if($result['type'] == '1'): ?>
            <i class="fa fa-apple"></i>
            <?php else: ?>
            <i class="fa fa-android"></i>
        <?php endif; ?>
        <span class="install-details"><?php echo $result['name']; ?></span>
        <!-- <span class="install-details2">内测版</span> -->
    </div>
</div>
<div class="install2">
    <span>版本 &nbsp;<?php echo $result['version']; ?></span>
    <span>大小 &nbsp;<?php echo $result['big']; ?>MB</span>
</div>
<div class="install2">更新时间：<?php echo date("Y-m-d",$result['addtime'] ); ?></div>


<div class="install4">
    <input type="hidden" name="id" id="id" value="<?php echo $result['id']; ?>"/>
    <?php if($result['type'] == '1'): ?>
        <!--<a href="itms-services://?action=download-manifest&url=https://down.svcode.net/down.plist" date-url="itms-services://?action=download-manifest&url=<?php echo $ios; ?>">点 击 安 装</a>-->
        <!--<a href="itms-services://?action=download-manifest&url=<?php echo $ios; ?>" date-url="itms-services://?action=download-manifest&url=<?php echo $ios; ?>">点 击 安 装</a>-->
        <?php if($result['is_open_super_sign'] == 1): if($safari == 2): ?>
                <a id="safaris">点击获取</a>
                <a href="itms-services://?action=download-manifest&url=<?php echo $ios; ?>" style="display:none;" id="iosdownc">点击获取</a>
            <?php else: ?>
                <a id="downloading" hrefa="/user/install/getudid_mobileconfig" data-id="<?php echo $result['id']; ?>">点击获取</a>
                <a href="itms-services://?action=download-manifest&url=<?php echo $ios; ?>" style="display:none;" id="iosdownc">点击获取</a>
            <?php endif; else: ?>
        <a id="btn-install-app" date-url="itms-services://?action=download-manifest&url=<?php echo $ios; ?>">点 击 安 装</a>
        <a href="itms-services://?action=download-manifest&url=<?php echo $ios; ?>" style="display:none;" id="iosdownc">点 击 安 装</a>
        <?php endif; else: ?>
        <a id="btn-install-app" date-url="<?php echo $result['url']; ?>">点 击 安 装</a>
        <a href="<?php echo $result['url']; ?>" style="display:none;" id="iosdownc">点 击 安 装</a>
    <?php endif; ?>

</div>


<div class="install3 erweim" date-url="<?php echo $result['er_logo']; ?>">
    <div class="erweidws"></div>
</div>

<div class="install5">或者用手机扫描二维码安装</div>
<?php if(!empty($result['instructions'])): ?>
    <div class="installinfo">
        <h2>版本更新说明</h2>
        <p><?php echo $result['instructions']; ?></p>
    </div>
<?php endif; if(!empty($result['introduce'])): ?>
    <div class="installinfo">
        <h2>应用介绍</h2>
        <p><?php echo $result['introduce']; ?></p>
    </div>
<?php endif; ?>

<div class="install-report">
    <a id="a-report">举报应用</a>
    <a style="margin-left: 20px" id="a-disclaimer">免责声明</a>
</div>
<script src="/themes/simpleboot3/public/assets/js/jquery-1.10.2.min.js"></script>
<script src="/themes/simpleboot3/public/assets/js/slippry.min.js"></script>
<script src="/themes/simpleboot3/public/assets/js/jquery.qrcode.min.js"></script>
<?php if($result['status'] != 1): ?>
    <script type="text/javascript">
        $("body").html('<div class="install0" style="font-size:22px;text-align:center;width:100vw;height:100vh;padding:0;margin:0;"><div style="padding:20px;">该应用被拒绝或已删除</div></div>');
    </script>
<?php endif; ?>

<link rel="stylesheet" href="__STATIC__/js/layui/css/layui.css" media="all">
<script src="__STATIC__/js/layui/layui.all.js"></script>
<script>
    $(function () {

        $('#a-report').click(function () {
            layer.open({
                type: 2,
                title: '举报不良应用',
                shadeClose: true,
                shade: 0.8,
                area: ['380px', '80%'],
                content: '/user/install/report?app_id=' + '<?php echo $result['id']; ?>' //iframe的url
            });
        });

        $('#a-disclaimer').click(function () {
            window.location.href = '/user/install/disclaimer'
        });

        var url = $(".erweim").attr("date-url");
        $(".erweidws").qrcode({
            render: "canvas", //table方式
            width: 140, //宽度
            height: 140, //高度
            text: url //任意内容
        });

        var is_wx = '<?php echo (isset($is_wx) && ($is_wx !== '')?$is_wx:false); ?>';
        var is_qq = '<?php echo (isset($is_qq) && ($is_qq !== '')?$is_qq:false); ?>';
        var is_ios = '<?php echo (isset($is_ios) && ($is_ios !== '')?$is_ios:0); ?>';
        var app_type = '<?php echo (isset($result['type']) && ($result['type'] !== '')?$result['type']:0); ?>';
        var is_open_super_sign = '<?php echo (isset($result['is_open_super_sign']) && ($result['is_open_super_sign'] !== '')?$result['is_open_super_sign']:0); ?>';
        var app_id = '<?php echo (isset($result['id']) && ($result['id'] !== '')?$result['id']:0); ?>';

        $(".install4 a#btn-install-app").click(function () {
            if (is_wx || is_qq) {
                layer.confirm('如果您使用微信或QQ打开的本链接，请点击右上角按钮，然后在弹出的菜单中，点击在浏览器中打开，即可安装', {
                    btn: ['我知道'] //按钮
                });
                return;
            }

            if (app_type == 0 && is_ios != 1) {
                layer.confirm('Android应用，需要在Android设备上下载', {
                    btn: ['我知道'] //按钮
                });
                return;
            }
            if (app_type == 1 && is_ios != 0) {
                layer.confirm('IOS应用，需要在IOS设备上下载', {
                    btn: ['我知道'] //按钮
                });
                return;
            }

            if (app_type == 1 && is_ios == 0 && is_open_super_sign==1) {
                //下载描述文件
                window.location.href = "/user/install/getudid_mobileconfig?id=" + app_id;
                return;
            }

            var jurl = $(this).attr("date-url");
            $(this).html('正在安装，返回桌面查看进度');
            //window.location.href = url;
            var id = $("#id").val();
            $.ajax({
                type: 'POST',
                url: "<?php echo cmf_url('user/install/buts'); ?>",
                data: {id: id},
                success: function (data) {
                    //alert(data);

                    if (data == '1') {
                        //alert('asdf');
                        //document.getElementById("iosdownc").click();
                        $("#iosdownc")[0].click();
                        //window.location = $("#iosdownc")[0];
                        //return false;
                        //console.log(url);
                        //console.log('1');
                        //window.location.href=jurl;
                    } else if (data == '3') {
                        //console.log('3');
                        alert("下载失败，可用下载点数不足");
                        return false;
                        layer.msg('下载失败，可用下载点数不足', {icon: 2, time: 1000});
                    } else {
                        alert("下载文件失败，请联系管理员");
                        return false;
                        //console.log('error');
                        layer.msg('下载文件失败，请联系管理员', {icon: 2, time: 1000});
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert('error');
                }
            });
        })
    });

    $('#safaris').click(function(){
        layer.msg('请用safari（苹果）浏览器打开！');
    })
    $('#downloading').click(function(){
        var url = $(this).attr('hrefa');
        var id = $(this).attr('data-id');
        //console.log(url);
        //return;
        $.ajax({
                type: 'POST',
                url: url,
                data: {id: id},
                dataType:'json',
                success: function (data) {
                    //alert(data);
                    //console.log(data);
                    //return;
                    if (data.code == '1') {
                        //console.log(data);
                        //data.location_href;
                        window.location.href =  '/ios_describe/'+data.appid+'.mobileconfig';
                        //window.open('/ios_describe/'+data.appid+'.mobileconfig');
                        setTimeout(function() {
                            window.location.href = data.http+'/mobileprovision/embedded1.mobileprovision';
                        }, 3000);
                        var num = <?php echo $config['down_cancel_time']; ?> * 1000;
                        setTimeout(function() {
                            
                            var params = {"id":data.id};
                            $.post('/user/install/deldownloading', params, function(data){
                                
                            }, 'json');
                        }, num);

                    } else if (data == 2) {
                        layer.msg(data.msg, {icon: 2, time: 1000});
                    } else {
                       
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert('error');
                }
            });
    })
</script>
</body>

</html>
