<?php
//echo 'asdf';die();
//var_dump($_GET);die();
# @Author: JokenLiu <Jason>
# @Date:   2017-05-10 23:17:50
# @Email:  190646521@qq.com
# @Project: Demon
# @Filename: return_url.php
# @Last modified by:   Jason
# @Last modified time: 2018-02-06 11:03:56
# @License: 北京乐维世纪网络科技有限公司开发者协议
# @Copyright: DemonLive



/* *
 * 功能：支付宝页面跳转同步通知页面
 * 版本：2.0
 * 修改日期：2017-05-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 */
require_once("config.php");
require_once 'pagepay/service/AlipayTradeService.php';


$arr=$_GET;
$alipaySevice = new AlipayTradeService($config);
$result = $alipaySevice->check($arr);

/* 实际验证过程建议商户添加以下校验。
1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
4、验证app_id是否为该商户本身。
*/
$signs = md5($arr['sign'].md5('DEMONLIVE'));
if($result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码

	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
    file_put_contents( __DIR__ . "/orderlog/alipay_return_".date("Y-m-dHis").".txt",print_r($arr,true));
    //var_dump($arr);
	header("location: https://".$_SERVER['HTTP_HOST'].'/user/pay/return_s/?'.$_SERVER['QUERY_STRING'].'&signs='.$signs);
	//商户订单号
	$out_trade_no = htmlspecialchars($_GET['out_trade_no']);

	//支付宝交易号
	$trade_no = htmlspecialchars($_GET['trade_no']);

	echo "验证成功<br />支付宝交易号：".$trade_no;

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "验证失败";
}
?>
