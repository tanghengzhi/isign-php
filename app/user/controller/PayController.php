<?php
# @Author: JokenLiu <Jason>
# @Date:   2018-02-04 17:33:11
# @Email:  190646521@qq.com
# @Project: Demon
# @Filename: PayController.php
# @Last modified by:   Jason
# @Last modified time: 2018-02-06 15:01:23
# @License: 北京乐维世纪网络科技有限公司开发者协议
# @Copyright: DemonLive



// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Powerless < wzxaini9@gmail.com>
// +----------------------------------------------------------------------
namespace app\user\controller;

use cmf\controller\HomeBaseController;
use think\Db;
//use Alipay;

class PayController extends HomeBaseController{

    /**
     * 前台用户首页(公开)
     */
    public function index(){
        require_once(APP_ROOT . '/lib/alipay/config.php');
        require_once(APP_ROOT . '/lib/alipay/pagepay/service/AlipayTradeService.php');
        require_once(APP_ROOT . '/lib/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');
        //1充值成功 2充值失败 3订单未支付 4订单支付失败 5订单支付成功

        $download_id =  input('param.download_id');
        $download_coin =  input('param.download_coin');
        $download_download =  input('param.download_download');
        $d_gift = input('param.d_gift');
        $type = input('param.type');
        $uid=session('user.id');
        $subject = '充值下载次数 ' . $download_download . ' 送' . $d_gift;
        $order_id = input('param.order_id');
        $d = array(
            'download_id' => $download_id,
            'download_coin' => $download_coin,
            'download_download' => $download_download,
            'd_gift' => $d_gift,
            'order_id' => $order_id,
            'uid' => $uid,
            'addtime' => time(),
            'subject' => $subject,
            'body' => $subject,
            'type' => $type,
            'status' => 3,
            'goods_type' => 1,
        );
        $r = Db::name('charge_log')->insert($d);
        //echo $r;die();
        if($r){
            $url = 'https://'.$_SERVER['HTTP_HOST'].'/lib/alipay/pagepay/pagepay.php';
            $data['order_id'] = $order_id;
            $data['coin'] = $download_coin;
            $data['subject'] = $subject;
            $data['body'] = $subject;
            $re = post_curls($url,$data);
            echo $re;
            //echo '<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=0,minimum-scale=0.5"><title></title></head><body>'.$re.'</body></html>';
            //echo $re;
            //echo $re;die();
            //$res = json_decode($re,true);
            //dump($res);
            //构造参数
        	/*$payRequestBuilder = new Alipay\AlipayTradePagePayContentBuilder();
        	$payRequestBuilder->setBody($subject);
        	$payRequestBuilder->setSubject($subject);
        	$payRequestBuilder->setTotalAmount($download_coin);
        	$payRequestBuilder->setOutTradeNo($order_id);
            */

        	//$aop = new Alipay\AlipayTradeService($config);

        	/**
        	 * pagePay 电脑网站支付请求
        	 * @param $builder 业务参数，使用buildmodel中的对象生成。
        	 * @param $return_url 同步跳转地址，公网可以访问
        	 * @param $notify_url 异步通知地址，公网可以访问
        	 * @return $response 支付宝返回的信息
         	*/
        	//$response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        	//输出表单
        	//var_dump($response);
        }

    }

    public function notify(){
        $arr = $_POST;
        $signs = md5($arr['sign'].md5('DEMONLIVE'));
        if($arr['signs'] ==  $signs){
            $trade_id = $arr['out_trade_no'];
            $d['trade_id'] = $arr['trade_no'];
            $d['trade_time'] = time();
            $d['status'] = 1;
            $uid = session('user.id');
            $downs = Db::name('charge_log')->where(["uid" => $uid, "order_id" => $trade_id])->find();
            if(!empty($downs['status']) && $downs['status'] !=1){
                $result = Db::name('charge_log')->where(["uid" => $uid, "order_id" => $trade_id, "status" => 3])->update($d);
            }else{
                return 1;
            }

            if($result){
                //$re = Db::name('user')->where('id='.$uid)->setInc('downloads',$downs['download_download']+$downs['d_gift']);
                if($downs['goods_type']==1){
                    $re = Db::name('user')->where('id='.$uid)->setInc('downloads',$downs['download_download']+$downs['d_gift']);
                }else if($downs['goods_type']==2){
                    $super = db('super_num')->find($downs['download_id']);
                    if($super['type']==1){
                        $sup_down_public = $super['num']+$super['gift'];
                        $re = Db::name('user')->where('id='.$uid)->setInc('sup_down_public',$sup_down_public);
                    }else{
                        $sup_down_prive = $super['num']+$super['gift'];
                        $re = Db::name('user')->where('id='.$uid)->setInc('sup_down_prive',$sup_down_prive);
                    } 
                }
                if($re){
                    return 1;
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    public function return_s(){
        $arr = $_GET;
        $signs = md5($arr['sign'].md5('DEMONLIVE'));
        if($arr['signs'] ==  $signs){
            $trade_id = $arr['out_trade_no'];
            $d['trade_id'] = $arr['trade_no'];
            $d['trade_time'] = time();
            $d['status'] = 1;
            $uid = session('user.id');
            $downs = Db::name('charge_log')->where(["uid" => $uid, "order_id" => $trade_id])->find();
            if(!empty($downs['status']) && $downs['status'] !=1){
                $result = Db::name('charge_log')->where(["uid" => $uid, "order_id" => $trade_id, "status" => 3])->update($d);
            }else{
                $this->success('充值成功', $this->request->root().'/user/tube');
            }

            if($result){
                //$re = Db::name('user')->where('id='.$uid)->setInc('downloads',$downs['download_download']+$downs['d_gift']);
                if($downs['goods_type']==1){
                    $re = Db::name('user')->where('id='.$uid)->setInc('downloads',$downs['download_download']+$downs['d_gift']);
                }else if($downs['goods_type']==2){
                    $super = db('super_num')->find($downs['download_id']);
                    if($super['type']==1){
                        $sup_down_public = $super['num']+$super['gift'];
                        $re = Db::name('user')->where('id='.$uid)->setInc('sup_down_public',$sup_down_public);
                    }else{
                        $sup_down_prive = $super['num']+$super['gift'];
                        $re = Db::name('user')->where('id='.$uid)->setInc('sup_down_prive',$sup_down_prive);
                    } 
                }

                if($re){
                    if($downs['goods_type']==2){
                        $this->success('充值成功', $this->request->root().'/portal/posted/supindex ');
                    }else{
                        $this->success('充值成功', $this->request->root().'/user/tube');
                    }
                    
                }else{
                    $this->error("充值失败请联系管理员！");
                }
            }else{
                $this->error("订单已过期或者没有该订单，请确认后重新支付！");
            }
        }else{
            echo '非法操作，已报警。';die();
        }
        //dump($_GET);
    }

}
