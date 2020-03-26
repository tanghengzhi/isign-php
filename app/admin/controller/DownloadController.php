<?php
# @Author: JokenLiu <Jason>
# @Date:   2018-02-01 15:30:38
# @Email:  190646521@qq.com
# @Project: Demon
# @Filename: DownloadController.php
# @Last modified by:   Jason
# @Last modified time: 2018-02-04 14:46:13
# @License: 北京乐维世纪网络科技有限公司开发者协议
# @Copyright: DemonLive



/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/13 0013
 * Time: 下午 14:13
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use app\admin\model\AdminMenuModel;
use Qiniu\Auth;    // 引入鉴权类
use Qiniu\Storage\UploadManager;    // 引入上传类
//下载管理
class DownloadController extends AdminBaseController{
    public function index(){
        $download=Db::name("download")->select();

        $this->assign('download', $download);
        return $this->fetch();
    }
    //添加下载次数
    public function add(){
        $id=input('param.id');
        if($id){
            $download=Db::name("download")->where("id=$id")->find();
            $this->assign('download', $download);
        }
        return $this->fetch();
    }
    //添加
    public function upd(){
        $id=input('param.id');
        $download=input('param.download');
        $coin=input('param.coin');
        $gift=input('param.gift');
        $recommend=input('param.recommend');
        $status=input('param.status');
        if(!$recommend){
            $recommend = 0;
        }else{
            $recommend = 1;
        }
        if(!$status){
            $status = 0;
        }else{
            $status = 1;
        }
        $data=array(
            'download' =>$download,
            'coin'     =>$coin,
            'addtime'  =>time(),
            'gift'     =>$gift,
            'recommend'=>$recommend,
            'status'   =>$status
        );
        if($id){
            $result=Db::name("download")->where("id=$id")->update($data);
        }else{
            $result=Db::name("download")->insert($data);
        }

        if($result){
            $this->success("操作成功");
        }else{
            $this->error("操作失败");
        }
    }
    //删除
    public function del(){
        $id=input('param.id');
        $result=Db::name("download")->where("id=$id")->delete();
        if($result){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }
    //手动添加下载数
    public function charge(){
        $download=Db::name("charge")->select();
        $users=array();
        foreach($download as $k=>$v){
            $id=$v['uid'];
            $name=Db::name("user")->where("id=$id")->find();
            $v['name']=$name['user_nickname'];
            $users[$k]=$v;
        }
        $this->assign('download', $users);
        return $this->fetch();
    }
    //手动添加下载
    public function add_charge(){
        return $this->fetch();
    }
    //手动添加下载数
    public function upd_charge(){
        $download=input('param.download');
        $uid=input('param.uid');
        $data=array(
            'download' =>$download,
            'uid'     =>$uid,
            'addtime'  =>time()
        );
        $user=Db::name("user")->where("id=$uid")->setInc("downloads",$download);
        if($user){
            $result=Db::name("charge")->insert($data);
            if($result){
                $this->success("操作成功");
            }else{
                $this->error("操作失败");
            }
        }else{
            $this->error("操作失败");
        }

    }

    public function supindex(){
        $download=Db::name("super_num")->order('type,orderno')->select();

        $this->assign('download', $download);
        return $this->fetch();
    }

    public function add_sup(){
        $id=input('param.id');
        if($id){
            $download=Db::name("super_num")->where("id=$id")->find();
            $this->assign('download', $download);
        }
        return $this->fetch();
    }

    public function supupd(){
        $id=input('param.id');
        $type=input('param.type');
        $num=input('param.num');
        $coin=input('param.coin');
        $gift=input('param.gift');
        $num=input('param.num');
        $orderno=input('param.orderno');
        
        $data=array(
            'type' =>$type,
            'num' =>$num,
            'coin'     =>$coin,
            'addtime'  =>time(),
            'gift'     =>$gift,
            'num'=>$num,
            'orderno'   =>$orderno
        );
        if($id){
            $result=Db::name("super_num")->where("id=$id")->update($data);
        }else{
            $result=Db::name("super_num")->insert($data);
        }

        if($result){
            $this->success("操作成功");
        }else{
            $this->error("操作失败");
        }
    }

    public function supdel(){
       $id=input('param.id');
        $result=Db::name("super_num")->where("id=$id")->delete();
        if($result){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        } 
    }
    //手动添加
    public function sup_add_charge(){
        $res = db('sup_charge_log')->order('id desc')->select();
        $users=array();
        foreach($res as $k=>$v){
            $id=$v['uid'];
            $name=Db::name("user")->where("id=$id")->find();
            $v['name']=$name['user_nickname'];
            $users[$k]=$v;
        }
        $this->assign('download', $users);
        return $this->fetch();
    }
    
    public function add_sup_charge(){

        return $this->fetch();
    }

    public function add_sup_charge_post(){
        $num=input('param.num');
        $type=input('param.type');
        $uid=input('param.uid');
        $data=array(
            'num' =>$num,
            'uid'     =>$uid,
            'type'     =>$type,
            'addtime'  =>time()
        );
        
        if($type==2){
            $user=Db::name("user")->where("id=$uid")->setInc("sup_down_prive",$num);
        }else{
            $user=Db::name("user")->where("id=$uid")->setInc("sup_down_public",$num);
            $res = db('user')->find($uid);
            //dump($res);
            //die();
        }
        
        if($user){
            $result=Db::name("sup_charge_log")->insert($data);
            if($result){
                $this->success("操作成功");
            }else{
                $this->error("操作失败");
            }
        }else{
            $this->error("操作失败");
        }
    }
}
