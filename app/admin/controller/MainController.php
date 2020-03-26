<?php
# @Author: JokenLiu <Jason>
# @Date:   2018-02-01 15:30:38
# @Email:  190646521@qq.com
# @Project: Demon
# @Filename: MainController.php
# @Last modified by:   Jason
# @Last modified time: 2018-04-21 10:28:09
# @License: 北京乐维世纪网络科技有限公司开发者协议
# @Copyright: DemonLive



// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 208620005@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use app\admin\model\Menu;

class MainController extends AdminBaseController
{

    public function _initialize()
    {
        parent::_initialize();
    }

    /**
     *  后台欢迎页
     */
    public function index()
    {
        $time=strtotime(date("Y-m-d"));
        //下载
        $new['download']=Db::name("user_posted_log")->count();
        $new['day_download']=Db::name("user_posted_log")->where("creattime >".$time)->count();
        //充值金额
        $new['coin']=Db::name("charge_log")->where("status = 1")->sum("download_coin");
        $new['day_coin']=Db::name("charge_log")->where("status = 1 && addtime >".$time)->sum("download_coin");
        //普通充值
        $new['down_goods'] = Db::name("charge_log")->where("status = 1 and goods_type=1")->sum("download_coin");
        $new['sup_goods'] = Db::name("charge_log")->where("status = 1 and goods_type=2")->sum("download_coin");
        //用户注册
        $new['user']=Db::name("user")->count();
        $new['day_user']=Db::name("user")->where("create_time >".$time)->count();
        //上传应用
        $new['posted']=Db::name("user_posted")->count();
        $new['day_posted']=Db::name("user_posted")->where("addtime >".$time)->count();

        //充值用户
        $charges=Db::name("charge_log")->order("status = 1 && addtime desc")->limit(8)->select();
        $charge=array();
        foreach($charges as $v){
            $id=$v['uid'];
            $cha=Db::name("user")->where("id=$id")->find();
            $v['name']=$cha['user_nickname'];
            $charge[]=$v;
        }

        //最新用户注册
        $user=Db::name("user")->where("user_type=2")->order("create_time desc")->limit(8)->select();
        $this->assign("new",$new);
        $this->assign("charge",$charge);
        $this->assign("user",$user);

        //分发总上传
        $fent = db('user_posted')->where('is_open_super_sign',0)->count();
        //分发总下载
        $fendow = db('user_posted_log')
            ->alias('l')
            ->join('user_posted p','p.id=l.posted_id')
            ->where('p.is_open_super_sign',0)
            ->count();
        //今日上传
        $time = strtotime(date('Y-m-d'));
        $fent_day = db('user_posted')->where('is_open_super_sign = 0 and addtime >='.$time)->count();
        //今日下载
        $fendow_day = db('user_posted_log')
            ->alias('l')
            ->join('user_posted p','p.id=l.posted_id')
            ->where('p.is_open_super_sign = 0 and l.creattime >='.$time)
            ->count();

        //今日一周日期
        $week = [date('Y-m-d',$time-86400*6),date('Y-m-d',$time-86400*5),date('Y-m-d',$time-86400*4),date('Y-m-d',$time-86400*3),date('Y-m-d',$time-86400*2),date('Y-m-d',$time-86400*1),date('Y-m-d')];
        //今日一周下载
        $fendow_week = [];
        foreach($week as $val){
            $times = strtotime($val); 
            $fendow_week[] = db('user_posted_log')
            ->alias('l')
            ->join('user_posted p','p.id=l.posted_id')
            ->where('p.is_open_super_sign = 0 and l.creattime >='.$times)
            ->count();
        }
        
        //超级签名总上传
        $super = db('user_posted')->where('is_open_super_sign',1)->count();
        //超级签名总下载
        $superdow = db('user_posted_log')
            ->alias('l')
            ->join('user_posted p','p.id=l.posted_id')
            ->where('p.is_open_super_sign',1)
            ->count();
        //今日上传
        $time = strtotime(date('Y-m-d'));
        $super_day = db('user_posted')->where('is_open_super_sign = 1 and addtime >='.$time)->count();
        //今日下载
        $superdow_day = db('user_posted_log')
            ->alias('l')
            ->join('user_posted p','p.id=l.posted_id')
            ->where('p.is_open_super_sign = 1 and l.creattime >='.$time)
            ->count();
            
        //今日一周下载
        $superdow_week = [];
        foreach($week as $val){
            $times = strtotime($val); 
            $superdow_week[] = db('user_posted_log')
            ->alias('l')
            ->join('user_posted p','p.id=l.posted_id')
            ->where('p.is_open_super_sign = 1 and l.creattime >='.$times)
            ->count();
        }
        //一周充值
        $coin_week = [];
        foreach($week as $val){
            $times = strtotime($val); 
            $coin_week[] = Db::name("charge_log")->where("status = 1 && addtime >".$times)->sum("download_coin");
        }
        //一周注册
        $user_week = [];
        foreach($week as $val){
            $times = strtotime($val); 
            $user_week[] = Db::name("user")->where("create_time >".$times)->count();
        }
        $dataAll = [
            'fent'=>$fent,
            'fendow'=>$fendow,
            'fent_day'=>$fent_day,
            'fendow_day'=>$fendow_day,
            'week'=>json_encode($week),
            'fendow_week'=>json_encode($fendow_week),

            'super'=>$super,
            'superdow'=>$superdow,
            'super_day'=>$super_day,
            'superdow_day'=>$superdow_day,
            'coin_week'=>json_encode($coin_week),
            'user_week'=>json_encode($user_week),
            'superdow_week'=>json_encode($superdow_week),
        ];
        $this->assign($dataAll);
        return $this->fetch();
    }

    public function dashboardWidget()
    {
        $dashboardWidgets = [];
        $widgets          = $this->request->param('widgets/a');
        if (!empty($widgets)) {
            foreach ($widgets as $widget) {
                if ($widget['is_system']) {
                    array_push($dashboardWidgets, ['name' => $widget['name'], 'is_system' => 1]);
                } else {
                    array_push($dashboardWidgets, ['name' => $widget['name'], 'is_system' => 0]);
                }
            }
        }

        cmf_set_option('admin_dashboard_widgets', $dashboardWidgets, true);

        $this->success('更新成功!');

    }

}
