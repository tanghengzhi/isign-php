<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"themes/admin_simpleboot3/admin/main/index.html";i:1574672306;s:43:"themes/admin_simpleboot3/public/header.html";i:1570008884;}*/ ?>
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
<link href="__TMPL__/public/assets/simpleboot3/css/main.css" rel="stylesheet">

<?php 
    \think\Hook::listen('admin_before_head_end',$temp5e78a95dba07a,null,false);
 ?>
</head>
<body>

<div class="main-box">
    <div class="main-box-left">
        <div class="main-box-left-top">分发托管</div>
        <div class="main-box-left-center">
            <div class="main-box-left-center-left">
                <i class="glyphicon glyphicon-calendar"></i>
            </div>
            <p class="main-box-left-center-right"><?php echo $fent; ?>个应用</p>
        </div>
        <div class="main-box-left-bottom">
            
            <div class="main-box-left-bottom-box">
                <div><?php echo $fendow; ?></div>
                <p>总下载</p>
            </div>
            <div class="main-box-left-bottom-box">
                <div><?php echo $fent_day; ?></div>
                <p>今日上传</p>
            </div>
            <div class="main-box-left-bottom-box">
                <div><?php echo $fendow_day; ?></div>
                <p>今日下载</p>
            </div>
        </div>

    </div>
    <div class="main-box-right">
          <div id="chart-composite-1">

          </div>
        
    </div>
</div>

<div class="main-box">
    <div class="main-box-left">
        <div class="main-box-left-top">超级签名</div>
        <div class="main-box-left-center">
            <div class="main-box-left-center-left">
                <i class="glyphicon glyphicon-pencil"></i>
            </div>
            <p class="main-box-left-center-right"><?php echo $super; ?>个应用</p>
        </div>
        <div class="main-box-left-bottom">
            <div class="main-box-left-bottom-box">
                <div><?php echo $superdow; ?></div>
                <p>总下载</p>
            </div>
            <div class="main-box-left-bottom-box">
                <div><?php echo $super_day; ?></div>
                <p>今日上传</p>
            </div>
            <div class="main-box-left-bottom-box">
                <div><?php echo $superdow_day; ?></div>
                <p>今日下载</p>
            </div>
        </div>

    </div>
    <div class="main-box-right">
          <div id="chart-composite-2">

          </div>
        
    </div>
</div>
<div class="main-box">
    <div class="main-box-left">
        <div class="main-box-left-top">总充值</div>
        <div class="main-box-left-center">
            <div class="main-box-left-center-left" style="background: #3886D4;">
                <i class="glyphicon glyphicon-yen"></i>
            </div>
            <p class="main-box-left-center-right">¥<?php echo $new['coin']; ?></p>
        </div>
        <div class="main-box-left-bottom">
            <div class="main-box-left-bottom-box">
                <div>¥<?php echo $new['down_goods']; ?></div>
                <p>下载充值</p>
            </div>
            <div class="main-box-left-bottom-box">
                <div>¥<?php echo $new['sup_goods']; ?></div>
                <p>超级签名充值</p>
            </div>
            <div class="main-box-left-bottom-box">
                <div>¥<?php echo $new['day_coin']; ?></div>
                <p>今日充值</p>
            </div>
        </div>

    </div>
    <div class="main-box-right">
          <div id="chart-composite-3">

          </div>
        
    </div>
</div>
<div class="main-box">
    <div class="main-box-left">
        <div class="main-box-left-top">总注册</div>
        <div class="main-box-left-center">
            <div class="main-box-left-center-left" style="background: #64D57C;">
                <i class="glyphicon glyphicon-yen"></i>
            </div>
            <p class="main-box-left-center-right"><?php echo $new['user']; ?></p>
        </div>
        <div class="main-box-left-bottom">
            <div class="main-box-left-bottom-box">
                <div><?php echo $new['user']; ?></div>
                <p>&#x603B;&#x6CE8;&#x518C;&#xFF0C;&#x66F4;&#x591A;&#x6E90;&#x7801;&#x8BF7;&#x767E;&#x5EA6;&#x641C;&#x7D22;&#x8BBF;&#x95EE;&#xFF1A;&#x7C73;&#x7C92;&#x5C0F;&#x5C4B;</p>
            </div>
            <div class="main-box-left-bottom-box">
                <div><?php echo $new['day_user']; ?></div>
                <p>今日注册</p>
            </div>
            <!-- <div class="main-box-left-bottom-box">
                <div><?php echo $new['day_coin']; ?></div>
                <p>今日充值</p>
            </div> -->
        </div>

    </div>
    <div class="main-box-right">
          <div id="chart-composite-4">

          </div>
        
    </div>
</div>
<!-- <div class="col-sm-6">
    <div class="col-sm-6">
        <div class="col-sm-12 main">
        <div class="col-sm-12 main-when1"><i class="glyphicon glyphicon-download-alt"></i></div>
        <div class="col-sm-12 main-when2">下载总量 : <span> <?php echo $new['download']; ?> 次</span></div>
        <div class="col-sm-12 main-when3">当日下载总量 : <span> <?php echo $new['day_download']; ?> 次</span></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="col-sm-12 main2">
            <div class="col-sm-12 main-when1"><i class="glyphicon glyphicon-yen"></i></div>
            <div class="col-sm-12 main-when2">充值总金额 : <span> <?php echo $new['coin']; ?> 元</span></div>
            <div class="col-sm-12 main-when3">当日充值金额 : <span> <?php echo $new['day_coin']; ?> 元</span></div>
        </div>
    </div>
</div>

<div class="col-sm-6">

    <div class="col-sm-6">
        <div class="col-sm-12 main3">
            <div class="col-sm-12 main-when1"><i class="glyphicon glyphicon-user"></i></div>
            <div class="col-sm-12 main-when2">当日注册用户 : <span> <?php echo $new['user']; ?> </span></div>
            <div class="col-sm-12 main-when3">当日注册用户 : <span> <?php echo $new['day_user']; ?> </span></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="col-sm-12 main4">
            <div class="col-sm-12 main-when1"><i class="glyphicon glyphicon-open-file"></i></div>
            <div class="col-sm-12 main-when2">上传总应用 : <span> <?php echo $new['posted']; ?> 次</span></div>
            <div class="col-sm-12 main-when3">当日上传应用 : <span> <?php echo $new['day_posted']; ?> 次</span></div>
        </div>
    </div>
</div> -->

<script src="__STATIC__/js/admin.js"></script>
<script src="__TMPL__/public/assets/simpleboot3/js/frappe-charts.min.js"></script>

<?php 
    \think\Hook::listen('admin_before_body_end',$temp5e78a95dba084,null,false);
 ?>
</body>
</html>

<script type="text/javascript">

    var reportCountList = <?php echo $fendow_week; ?>;

    var reportCountList2 = <?php echo $superdow_week; ?>;
    var reportCountList3 = <?php echo $coin_week; ?>;
    var reportCountList4 = <?php echo $user_week; ?>;

    var lineCompositeData = {
        labels: <?php echo $week; ?>,

        /*yMarkers: [
            {
                label: "Average 100 reports/month",
                value: 1200,
            }
        ],*/

        datasets: [{
            "name": "Events",
            "values": reportCountList
        }]
    };

    var lineCompositeData2 = {
        labels: <?php echo $week; ?>,

        /*yMarkers: [
            {
                label: "Average 100 reports/month",
                value: 1200,
            }
        ],*/

        datasets: [{
            "name": "Events",
            "values": reportCountList2
        }]
    };

    var lineCompositeData3 = {
        labels: <?php echo $week; ?>,

        /*yMarkers: [
            {
                label: "Average 100 reports/month",
                value: 1200,
            }
        ],*/

        datasets: [{
            "name": "Events",
            "values": reportCountList3
        }]
    };

    var lineCompositeData4 = {
        labels: <?php echo $week; ?>,

        /*yMarkers: [
            {
                label: "Average 100 reports/month",
                value: 1200,
            }
        ],*/

        datasets: [{
            "name": "Events",
            "values": reportCountList4
        }]
    };


var c1 = document.querySelector("#chart-composite-1");
var c2 = document.querySelector("#chart-composite-2");
var c3 = document.querySelector("#chart-composite-3");
var c4 = document.querySelector("#chart-composite-4");

var lineCompositeChart = new Chart (c1, {
    title: "分发托管一周下载",
    data: lineCompositeData,
    type: 'line',
    height: 130,
    colors: ['#2E6EE6'],
    isNavigable: 1,
    valuesOverPoints: 1,

    lineOptions: {
        dotSize: 6
    },
    // yAxisMode: 'tick'
    // regionFill: 1
});

var lineCompositeChart = new Chart (c2, {
    title: "超级签名一周下载",
    data: lineCompositeData2,
    type: 'line',
    height: 130,
    colors: ['#2E6EE6'],
    isNavigable: 1,
    valuesOverPoints: 1,

    lineOptions: {
        dotSize: 6
    },
    // yAxisMode: 'tick'
    // regionFill: 1
});

var lineCompositeChart = new Chart (c3, {
    title: "一周充值",
    data: lineCompositeData3,
    type: 'line',
    height: 130,
    colors: ['#3886D4'],
    isNavigable: 1,
    valuesOverPoints: 1,

    lineOptions: {
        dotSize: 6
    },
    // yAxisMode: 'tick'
    // regionFill: 1
});

var lineCompositeChart = new Chart (c4, {
    title: "一周注册",
    data: lineCompositeData4,
    type: 'line',
    height: 130,
    colors: ['#64D57C'],
    isNavigable: 1,
    valuesOverPoints: 1,

    lineOptions: {
        dotSize: 6
    },
    // yAxisMode: 'tick'
    // regionFill: 1
});
</script>