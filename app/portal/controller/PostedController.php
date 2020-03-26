<?php
# @Author: JokenLiu <Jason>
# @Date:   2018-01-24 22:10:41
# @Email:  190646521@qq.com
# @Project: Demon
# @Filename: IndexController.php
# @Last modified by:   Jason
# @Last modified time: 2018-03-21 20:39:05
# @License: 北京乐维世纪网络科技有限公司开发者协议
# @Copyright: DemonLive


namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use Qiniu\Auth;
use think\Db;
use app\user\model\UserPostedModel;  // 引入上传类
class PostedController extends HomeBaseController
{
    public function index()
    {
        if(!cmf_is_user_login()){
            $this->success('请登录','/user/login/index');
        }
        $uid = session('user.id');

        $auth_info = db('user_auth_info')->where('user_id', $uid)->find();
        if ($auth_info) {
            if ($auth_info['status'] == 1) {
                $status = '已认证';
            } else {
                $status = '审核中';
            }
        } else {
            $status = '未认证';
        }

        $key = input('key');
        //dump($key);
        $map = ['name'=>['like','%'.$key.'%']];
        $user = Db::name("user")->where("id=$uid ")->find();
        session('user', $user);//
        $result = Db::name("user_posted")->where("uid=$uid and status = 1 and is_open_super_sign != 1  and endtime>" . time())->where($map)->order("id desc")->paginate(5);
        $zuoc = $this->zuoc($uid);
        // var_dump($zuoc);die();
        $cishu = $this->cishu($uid);
        //$buylist = $this->buylist();
        $this->assign('assets', $result->items());
        $this->assign('page', $result->render());
        $this->assign('zuoc', $zuoc);
        $this->assign('cishu', $cishu);
        //$this->assign('buylist', $buylist);
        $this->assign('user', $user);
        $this->assign('status', $status);

        $config = get_config();
        $this->assign('config', $config);
        $this->assign('key',$key);
        return $this->fetch();
    }

    public function supindex(){
        if(!cmf_is_user_login()){
            $this->success('请登录','/user/login/index');
        }
        $uid = session('user.id');

        $auth_info = db('user_auth_info')->where('user_id', $uid)->find();
        if ($auth_info) {
            if ($auth_info['status'] == 1) {
                $status = '已认证';
            } else {
                $status = '审核中';
            }
        } else {
            $status = '未认证';
        }

        $key = input('key');
        //dump($key);
        $map = ['name'=>['like','%'.$key.'%']];
        $user = Db::name("user")->where("id=$uid ")->find();
        session('user', $user);//
        $result = Db::name("user_posted")->where("uid=$uid and status = 1 and is_open_super_sign = 1  and endtime>" . time())->where($map)->order("id desc")->paginate(5);
        $zuoc = $this->zuoc($uid);
        // var_dump($zuoc);die();
        $cishu = $this->cishu($uid);

        //公有剩余
        $user['sup_down_public'];
        $public = db('super_download_log')->where('type',1)->where('uid',$uid)->count();
        $public_all = $user['sup_down_public']+$public;

        if($user['sup_down_public']==0 || $public_all==0){
            $public_y = 0;
        }else{
            $public_y = round(($user['sup_down_public']/$public_all)*100,2);
        }
        
        //私有剩余
        $user['sup_down_prive'];
        $prive = db('super_download_log')->where('type',2)->where('uid',$uid)->count();
        $prive_all = $prive+$user['sup_down_prive'];
        if($prive_all==0 || $user['sup_down_prive']==0){
            $prive_y = 0;
        }else{
            $prive_y = round(($user['sup_down_prive']/$prive_all)*100,2); 
        }
        $this->assign('sup_down_public', $user['sup_down_public']);
        $this->assign('sup_down_prive', $user['sup_down_prive']);
        $this->assign('public_all', $public_all);
        $this->assign('prive_all', $prive_all);
        $this->assign('prive_y', $prive_y);
        $this->assign('public_y', $public_y);
        //$buylist = $this->buylist();
        $this->assign('assets', $result->items());
        $this->assign('page', $result->render());
        $this->assign('zuoc', $zuoc);
        $this->assign('cishu', $cishu);
        //$this->assign('buylist', $buylist);
        $this->assign('user', $user);
        $this->assign('status', $status);

        $config = get_config();
        $this->assign('config', $config);
        $this->assign('key',$key);
        return $this->fetch();
    }

    public function deduction(){

        if(!cmf_is_user_login()){
            $this->success('请登录','/user/login/index');
        }
        $uid = session('user.id');
        $appid = input('param.appid');

        $auth_info = db('user_auth_info')->where('user_id', $uid)->find();
        if ($auth_info) {
            if ($auth_info['status'] == 1) {
                $status = '已认证';
            } else {
                $status = '审核中';
            }
        } else {
            $status = '未认证';
        }

        $key = input('key');
        //dump($key);
        $map = ['name'=>['like','%'.$key.'%']];
        $user = Db::name("user")->where("id=$uid ")->find();
        session('user', $user);//
        $app = db('user_posted')->find($appid);
        $appAll = db('user_posted')->where('bundle',$app['bundle'])->where('uid',$uid)->select();
        $id = '';
        foreach($appAll as $key=>$val){
            if($key==0){
                $val['id'] = $val['id'];
            }else{
                $val['id'] = ','.$val['id'];

            }
            $id .=$val['id'];
        }
        //echo $id;
        //die();
        $result = db('super_download_log')
                    ->alias('s')
                    ->join('user_posted u','u.id=s.app_id')
                    ->field('s.id,s.udid,s.device,s.addtime,s.ip,u.name,u.img,version')
                    ->where('s.app_id','in',$id)
                    ->order('s.addtime desc')
                    ->group('s.udid')
                    ->paginate(5);


        //Db::name("user_posted")->where("uid=$uid and is_open_super_sign = 1  and endtime>" . time())->where($map)->order("id desc")->paginate(5);
        $zuoc = $this->zuoc($uid);
        // var_dump($zuoc);die();
        $cishu = $this->cishu($uid);
    
        

        $this->assign('assets', $result->items());
        $this->assign('page', $result->render());
        $this->assign('zuoc', $zuoc);
        $this->assign('cishu', $cishu);
        //$this->assign('buylist', $buylist);
        $this->assign('user', $user);
        $this->assign('status', $status);

       

        $config = get_config();
        $this->assign('config', $config);
        $this->assign('key',$key);
        return $this->fetch();
    }

    public function supernumber(){
        //echo phpinfo();
        //die();
        $uid = session('user.id');

        $user = Db::name("user")->where("id=$uid ")->find();
        session('user', $user);//
        //公有池购买类型
        $public = db('super_num')->where('type',1)->order('orderno')->select();
        //私有池购买类型
        $private = db('super_num')->where('type',2)->order('orderno')->select();
        
        if(!empty($public[0])){
            $coin = $public[0]['coin'];
        }else{
            $coin = 0;
        }
        $this->assign('private',$private);
        $this->assign('public',$public);
        $this->assign('coin',$coin);
        $this->assign('user', $user);
    

        $config = get_config();
        $this->assign('config', $config);
        return $this->fetch();
    }

    /*我的应用左侧*/
    public function zuoc($uid)
    {
        // $result=Db::name("user_posted")->where("uid=$uid and endtime > ".time())->order('addtime desc')->buildSql();//加入了过期时间
        $result = Db::name("user_posted")->where("uid=$uid")->group('type,addtime')->order('addtime desc')->buildSql();//未加入过期时间
        // $result=Db::name("user_posted")->where("uid=$uid")->order('addtime desc')->select()->toarray();//未加入过期时间
        //dump($result);die();
        $results = Db::table($result . ' a')->group('bundle,type')->select()->toarray();
        return $results;
    }

    /*用户下载次数*/
    public function cishu($uid)
    {
        $time = strtotime(date("Y-m-d"));
        $daytime['day'] = Db::name("user_posted_log")->join("user_posted b", "b.id=a.posted_id")->alias("a")->where("b.uid=$uid and a.creattime > '$time'")->count();
        $daytime['gong'] = Db::name("user_posted_log")->join("user_posted b", "b.id=a.posted_id")->alias("a")->where("b.uid=$uid")->count();
        return $daytime;
    }


    public function pay_super(){
        $pay_type =  input('param.pay_type');
        if($pay_type==1){
            require_once(APP_ROOT . '/lib/alipay/config.php');
            require_once(APP_ROOT . '/lib/alipay/pagepay/service/AlipayTradeService.php');
            require_once(APP_ROOT . '/lib/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');
            //1充值成功 2充值失败 3订单未支付 4订单支付失败 5订单支付成功

            $id =  input('param.id');
            $coin =  input('param.coin');
            //$d_gift = input('param.d_gift');
            $type = '支付宝';
            $uid=session('user.id');
            $super = db('super_num')->find($id);

            $subject = '充值超级签名下载次数 ' . $super['num'] . ' 送' . $super['gift'];
            $order_id = input('param.order_id');
            $d = array(
                'download_id' => $id,
                'download_coin' => $coin,
                'download_download' => $super['num'],
                'd_gift' => $super['gift'],
                'order_id' => $order_id,
                'uid' => $uid,
                'addtime' => time(),
                'subject' => $subject,
                'body' => $subject,
                'type' => $type,
                'status' => 3,
                'goods_type' => 2,
            );
            $r = Db::name('charge_log')->insert($d);
            //echo $r;die();
            if($r){
                $url = 'https://'.$_SERVER['HTTP_HOST'].'/lib/alipay/pagepay/pagepay.php';
                $data['order_id'] = $order_id;
                $data['coin'] = $coin;
                $data['subject'] = $subject;
                $data['body'] = $subject;
                //dump($data);
                //die();
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
        }else{
            $this->success('暂未开放！');
        }
        
    }

    public function download_link(){
        $result = ['code'=>0,'msg'=>'','url'=>'http://'.$_SERVER['HTTP_HOST']];
        $appid =  input('param.appid');
        $url =  input('param.url');
        $uid = session('user.id');
        $code = md5(time().$appid);
        $data = [
            'uid'=>$uid,
            'appid'=>$appid,
            'addtime'=>time(),
            'code'=>$code,
            'status'=>0,
        ];
        $res = db('user_link_log')->insert($data);
        if($res){
            $result = [
                'code'=>1,
                'msg'=>'生成链接成功',
                'url'=>$url.'?'.$code,
            ]; 
        }else{
            $result = ['code'=>2,'msg'=>'生成链接失败'];
        }
        
        echo json_encode($result);
    }


}
