<?php
# @Author: JokenLiu <Jason>
# @Date:   2017-05-10 22:55:10
# @Email:  190646521@qq.com
# @Project: Demon
# @Filename: pagepay.php
# @Last modified by:   Jason
# @Last modified time: 2018-02-04 19:13:54
# @License: 北京乐维世纪网络科技有限公司开发者协议
# @Copyright: DemonLive



require_once dirname(dirname(__FILE__)).'/config.php';
require_once dirname(__FILE__).'/service/AlipayTradeService.php';
require_once dirname(__FILE__).'/buildermodel/AlipayTradePagePayContentBuilder.php';
	
    //商户订单号，商户网站订单系统中唯一订单号，必填
    $out_trade_no = trim($_POST['order_id']);

    //订单名称，必填
    $subject = trim($_POST['subject']);

    //付款金额，必填
    $total_amount = trim($_POST['coin']);

    //商品描述，可空
    $body = trim($_POST['body']);

	//构造参数
	$payRequestBuilder = new AlipayTradePagePayContentBuilder();
	$payRequestBuilder->setBody($body);
	$payRequestBuilder->setSubject($subject);
	$payRequestBuilder->setTotalAmount($total_amount);
	$payRequestBuilder->setOutTradeNo($out_trade_no);

	$aop = new AlipayTradeService($config);

	/**
	 * pagePay 电脑网站支付请求
	 * @param $builder 业务参数，使用buildmodel中的对象生成。
	 * @param $return_url 同步跳转地址，公网可以访问
	 * @param $notify_url 异步通知地址，公网可以访问
	 * @return $response 支付宝返回的信息
 	*/
	$response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);
	return $response;
	//输出表单
	//var_dump($response);
?>
