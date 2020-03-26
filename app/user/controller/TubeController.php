<?php
# @Author: JokenLiu <Jason>
# @Date:   2018-01-20 00:11:16
# @Email:  190646521@qq.com
# @Project: Demon
# @Filename: TubeController.php
# @Last modified by:   Jason
# @Last modified time: 2018-03-22 16:46:06
# @License: 北京乐维世纪网络科技有限公司开发者协议
# @Copyright: DemonLive


//我的应用
namespace app\user\controller;

use cmf\lib\Storage;
use Qiniu\entry;
use think\Validate;
use think\Image;
use cmf\controller\UserBaseController;
use app\user\model\UserModel;
use think\Db;
use Qiniu\Auth;    // 引入鉴权类
use Qiniu\Storage\UploadManager;    // 引入上传类

class TubeController extends UserBaseController
{

    function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 我的应用概述
     */
    public function index()
    {
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


        $user = Db::name("user")->where("id=$uid ")->find();
        session('user', $user);
        $result = Db::name("user_posted")->where("uid=$uid and endtime>" . time())->where('status',1)->order("id desc")->paginate(5);
        $zuoc = $this->zuoc($uid);
        // var_dump($zuoc);die();
        $cishu = $this->cishu($uid);
        $buylist = $this->buylist();
        $this->assign('assets', $result->items());
        $this->assign('page', $result->render());
        $this->assign('zuoc', $zuoc);
        $this->assign('cishu', $cishu);
        $this->assign('buylist', $buylist);
        $this->assign('user', $user);
        $this->assign('status', $status);

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

    /*用户购买下载次数列表*/
    public function buylist()
    {
        $result = Db::name("download")->where("status = 1")->select()->toarray();
        return $result;
    }

    /**
     * 我的应用详情
     */
    public function details($id, $bundle, $type)
    {
        $uid = session('user.id');
        $zuoc = $this->zuoc($uid);
        $where = "uid=$uid and type=$type and bundle='" . $bundle . "'";
        $er_logo = Db::name("user_posted")->field('er_logo,type')->where($where)->order('addtime desc')->find();
     
        $result = Db::name("user_posted")->where($where)->order('addtime desc')->find();
        // dump($result);die();
        $type = Db::name("user_posted")->where($where . " and id !='" . $result['id'] . "'")->order('addtime desc')->select()->toArray();
    //  var_dump($type);exit;
        // $type=Db::name("user_posted")->where("uid=$uid and id !=$id and url_name='".$result['url_name']."'")->select()->toArray();
        foreach ($type as &$v) {
            $id = $v['id'];
            $v['sum'] = Db::name("user_posted_log")->join("user_posted b", "b.id=a.posted_id")->alias("a")->where("b.uid=$uid and a.posted_id=$id")->count(); //下载次数
        }
        $sum = Db::name("user_posted_log")->join("user_posted b", "b.id=a.posted_id")->alias("a")->where("b.uid=$uid and a.posted_id=$id")->count(); //下载次数

        $result['ym_url'] = $er_logo['er_logo'];
        $result['www_url'] = 'http://' . $_SERVER['HTTP_HOST'];
        $result['er_logo'] = $result['www_url'] . '/' . $result['ym_url'];
        $this->assign('assets', $result);
        $this->assign('zuoc', $zuoc);
        $this->assign('sum', $sum);
        $this->assign('type', $type);

        return $this->fetch();
    }

    public function sup_details($id, $bundle, $type){
        
        $uid = session('user.id');
        $zuoc = $this->zuoc($uid);
        $where = "uid=$uid and type=$type and bundle='" . $bundle . "'";
        $er_logo = Db::name("user_posted")->field('er_logo,type')->where($where)->order('id asc')->find();
        // dump($er_logo);die();
        $result = Db::name("user_posted")->where($where)->order('addtime desc')->find();
        // dump($result);die();
        $type = Db::name("user_posted")->where($where . " and id !='" . $result['id'] . "'")->order('addtime desc')->select()->toArray();
        // $type=Db::name("user_posted")->where("uid=$uid and id !=$id and url_name='".$result['url_name']."'")->select()->toArray();
        foreach ($type as &$v) {
            $id = $v['id'];
            $v['sum'] = Db::name("user_posted_log")->join("user_posted b", "b.id=a.posted_id")->alias("a")->where("b.uid=$uid and a.posted_id=$id")->count(); //下载次数
        }
        $sum = Db::name("user_posted_log")->join("user_posted b", "b.id=a.posted_id")->alias("a")->where("b.uid=$uid and a.posted_id=$id")->count(); //下载次数

        $result['ym_url'] = $er_logo['er_logo'];
        $result['www_url'] = 'https://' . $_SERVER['HTTP_HOST'];
        $result['er_logo'] = $result['www_url'] . '/' . $result['ym_url'];
        $this->assign('assets', $result);
        $this->assign('zuoc', $zuoc);
        $this->assign('sum', $sum);
        $this->assign('type', $type);

        return $this->fetch();
    }

    /**
     * 我的应用编辑
     */
    public function editor($id)
    {
        $uid = session('user.id');
        // $id0 = $id;
        if ($id === 0 or $id === '0') {
            $data = [
                'url' => '',
                'addtime' => time(),
                'name' => '请输入应用名字',
                'uid' => $uid,
                'way' => 0,   //0公开 1密码安装 2邀请安装
                'instructions' => '',//版本更新说明
                'introduce' => '',//应用介绍
                'version' => '',
                'big' => '',//应用大小
                'build' => '',//编译版本号
                'bundle' => 'kongbao',//文件包名
                'endtime' => (60 * 60 * 24 * 30) + time(),//结束时间
                'type' => 0,//0 android 1 ios 类型
                'img' => '/nologo.png',//文件包图片存储base64
                "er_img" => '',//二维码图片路径
                "er_logo" => random_str(6),//二维码标识
                "posted_id" => '',//合并id
                "url_name" => '1',//文件原文件名
            ];
            $id = Db::name("user_posted")->insertGetId($data);
            $this->redirect('/user/tube/editor/id/' . $id, 0, '创建中...');
        }
        $zuoc = $this->zuoc($uid);
        $result = Db::name("user_posted")->where("uid=$uid and id=$id")->find();
        // echo '<pre>';var_dump($result);die();
        //$ym_url=explode('/D',$result['er_logo']);
        //$result['ym_url']=$ym_url[1];
        //$result['www_url']=$ym_url[0]."/D";
        $result['ym_url'] = $result['er_logo'];
        $result['www_url'] = 'http://' . $_SERVER['HTTP_HOST'];
        $result['er_logo'] = $result['www_url'] . '/' . $result['ym_url'];

        $this->assign('assets', $result);
        $this->assign('zuoc', $zuoc);
        return $this->fetch();
    }

    /*编辑*/

    public function upd()
    {
        $data = array(
            'name' => $_POST['name'],
            'instructions' => $_POST['instructions'],
            'introduce' => $_POST['introduce']
        );
        if ($_POST['url_name'] == 1) {
            if (empty($_POST['bundle'])) {
                $this->success("请填写应用包名");
            } else {
                $data['bundle'] = $_POST['bundle'];
            }
            if (empty($_POST['url'])) {
                $this->success("请填写应用地址");
            } else {
                $data['url'] = $_POST['url'];
            }

            $types = substr($_POST['url'], -3);
            if ($types == 'ipa') {
                $type = 1;
            } else {
                $type = 0;
            }
            $data['type'] = $type;
            $data['version'] = $_POST['version'];
            $data['build'] = $_POST['build'];
            $data['big'] = $_POST['big'];
        }
        $file = $this->request->file('img');
        if ($file) {
            $result = $file->validate([
                'ext' => 'jpg,jpeg,png',
                'size' => 1024 * 1024
            ])->move('.' . DS . 'upload' . DS . 'img' . DS);

            if ($result) {
                $imgSaveName = str_replace('//', '/', str_replace('\\', '/', $result->getSaveName()));
                $img = '/upload/img/' . $imgSaveName;
            } else {
                $this->success("图片上传失败请刷新重试");
            }
            $data['img'] = $img;
        }
        if (!empty($_POST['er_logo'])) {
            $data['er_logo'] = $_POST['er_logo'];
        }

        $result = Db::name("user_posted")->where("id=" . $_POST['id'])->update($data);
        if ($result) {
            $this->success("修改成功");
        } else {
            $this->success("修改失败");
        }
    }

    public function sup_editor(){
        $id = input('param.id');
        $uid = session('user.id');
        // $id0 = $id;
        if ($id === 0 or $id === '0') {
            $data = [
                'url' => '',
                'addtime' => time(),
                'name' => '请输入应用名字',
                'uid' => $uid,
                'way' => 0,   //0公开 1密码安装 2邀请安装
                'instructions' => '',//版本更新说明
                'introduce' => '',//应用介绍
                'version' => '',
                'big' => '',//应用大小
                'build' => '',//编译版本号
                'bundle' => 'kongbao',//文件包名
                'endtime' => (60 * 60 * 24 * 30) + time(),//结束时间
                'type' => 0,//0 android 1 ios 类型
                'img' => '/nologo.png',//文件包图片存储base64
                "er_img" => '',//二维码图片路径
                "er_logo" => random_str(6),//二维码标识
                "posted_id" => '',//合并id
                "url_name" => '1',//文件原文件名
            ];
            $id = Db::name("user_posted")->insertGetId($data);
            $this->redirect('/user/tube/editor/id/' . $id, 0, '创建中...');
        }
        $zuoc = $this->zuoc($uid);
        $result = Db::name("user_posted")->where("uid=$uid and id=$id")->find();
        // echo '<pre>';var_dump($result);die();
        //$ym_url=explode('/D',$result['er_logo']);
        //$result['ym_url']=$ym_url[1];
        //$result['www_url']=$ym_url[0]."/D";
        $result['ym_url'] = $result['er_logo'];
        $result['www_url'] = 'http://' . $_SERVER['HTTP_HOST'];
        $result['er_logo'] = $result['www_url'] . '/' . $result['ym_url'];

        $this->assign('assets', $result);
        $this->assign('zuoc', $zuoc);
        return $this->fetch();
    }

    public function sup_upd(){
        $data = array(
            'name' => $_POST['name'],
            'instructions' => $_POST['instructions'],
            'introduce' => $_POST['introduce'],
            'download_type' => $_POST['download_type'],
            'only_download' => $_POST['only_download'],
        );
        if ($_POST['url_name'] == 1) {
            if (empty($_POST['bundle'])) {
                $this->success("请填写应用包名");
            } else {
                $data['bundle'] = $_POST['bundle'];
            }
            if (empty($_POST['url'])) {
                $this->success("请填写应用地址");
            } else {
                $data['url'] = $_POST['url'];
            }

            $types = substr($_POST['url'], -3);
            if ($types == 'ipa') {
                $type = 1;
            } else {
                $type = 0;
            }
            $data['type'] = $type;
            $data['version'] = $_POST['version'];
            $data['build'] = $_POST['build'];
            $data['big'] = $_POST['big'];
        }
        $file = $this->request->file('img');
        if ($file) {
            $result = $file->validate([
                'ext' => 'jpg,jpeg,png',
                'size' => 1024 * 1024
            ])->move('.' . DS . 'upload' . DS . 'img' . DS);

            if ($result) {
                $imgSaveName = str_replace('//', '/', str_replace('\\', '/', $result->getSaveName()));
                $img = '/upload/img/' . $imgSaveName;
            } else {
                $this->success("图片上传失败请刷新重试");
            }
            $data['img'] = $img;
        }
        if (!empty($_POST['er_logo'])) {
            $data['er_logo'] = $_POST['er_logo'];
        }

        $result = Db::name("user_posted")->where("id=" . $_POST['id'])->update($data);
        if ($result) {
            $this->success("修改成功");
        } else {
            $this->success("修改失败");
        }
    }


    //删除文件
    public function del($id)
    {
        if (cmf_is_user_login()) {
            $uid = session('user.id');
            $record = Db::name("user_posted")->where('uid', $uid)->where("id=" . $id)->find();
            $type = false;
            if (!$record) {
                $this->error('应用不存在！');
            }
            if ($record['url_name'] != '1') {
                $ymurl = explode('/', $record['url']);
                // print_r($ymurl);exit;
                $type = $this->del_tok($ymurl[3]);
            }

            $result = Db::name("user_posted")->where("id=" . $id)->delete();
            if ($result) {
                $this->success("删除成功", "/user/tube/index");
            } else {
                $this->success("文件删除失败", "/user/tube/index");
            }
        } else {
            $this->error('请登录后再操作！');
        }

    }

    //删除七牛文件
    public function del_tok($url)
    {
        require_once(PLUGINS_PATH . '/qiniu/autoload.php');

        $qiniu_config = get_qiniu_config();
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = $qiniu_config['accessKey'];
        $secretKey = $qiniu_config['secretKey'];
        $bucket = $qiniu_config['bucket'];
        if (empty($accessKey) || empty($secretKey) || empty($bucket)) {
            $user = Db::name('user')->find('1');
            $accessKey = $user['accessKey'];
            $secretKey = $user['secretKey'];
            $bucket = $user['bucket'];
        }

        // 构建鉴权对象
        $key = $url;
        $auth = new Auth($accessKey, $secretKey);
        $config = new \Qiniu\Config();
        $bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
        $err = $bucketManager->delete($bucket, $key);
        return $err ? true : false;
    }

    //下载文件
    public function downfile($id)
    {
        $uid = session('user.id');
        $result = Db::name("user_posted")->where("uid=$uid and id=$id")->order("addtime desc")->find();

        $filename = $result['url']; //文件名
        $date = date("Ymd-H:i:m");
        Header("Content-type:  application/octet-stream ");
        Header("Accept-Ranges:  bytes ");
        Header("Accept-Length: " . $filename);
        header("Content-Disposition:  attachment;  filename= {$date}.doc");
        echo file_get_contents($filename);
        readfile($filename);

    }

    //ios 下载文件
    public function downfile_type()
    {
        $id = input('param.id');
        $type['id'] = $id;
        $uid = session('user.id');
        $down = Db::name("user_posted_log")->join("user_posted b", "b.id=a.posted_id")->alias("a")->where("b.uid=$uid")->count();

        if (session('user.downloads') > $down) {

            $ip = Request::instance()->ip();
            $data = array(
                'uid' => $ip,
                'posted_id' => $id,
                'creattime' => time()
            );
            $result = Db::name("user_posted_log")->insert($data);
            if ($result) {
                $type['type'] = "1";
            } else {
                $type['type'] = "3";
            }

        } else {
            $type['type'] = "0";
        }
        return $type;
        //itms-services://?action=download-manifest&url=https://192.168.0.107:1234/plist/33230177-80b7-4bd8-aac9-8c63250c3a3d
    }

    //合并文件
    public function hebing($id)
    {
        $uid = session('user.id');
        $result = Db::name("user_posted")->where("uid=$uid and id=$id")->find();
        $type = Db::name("user_posted")->where("uid=$uid and type!='" . $result['type'] . "'")->select()->toArray();

        $this->assign('type', $type);
        $this->assign('result', $result);
        return $this->fetch();
    }

    public function hebing_add()
    {
        $id = $_POST['id'];
        $sid = $_POST['sid'];
        $data = array('posted_id' => $sid);
        $uid = session('user.id');
        $result = Db::name("user_posted")->where("uid=$uid and id=$id")->update($data);
        return $result ? '1' : '0';
    }

    //下载数据
    public function buts()
    {
        $ip = Request::instance()->ip();
        $id = $_POST['id'];
        $data = array(
            'uid' => $ip,
            'posted_id' => $id,
            'creattime' => time()
        );
        $result = Db::name("user_posted_log")->insert($data);
        return $result ? '1' : '0';
    }


    //生成描述文件
    public function create_udid_mobileconfig()
    {
        $id = intval(input('param.id'));
        if (!cmf_is_user_login()) {
            $this->error('请先登录后操作！');
            exit;
        }
        $app = Db::name("user_posted")->find($id);
        if (!$app) {
            $this->error('生成失败！');
            exit;
        }
        $url = 'https://www.371.li/user/install/get_udid?app_id=' . $id;
        //header("Content-type: text/xml");       //  请求头
        $xml = '<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
 
<plist version="1.0">
    <dict>
        <key>PayloadContent</key>
        <dict>
            <key>URL</key>
            <string>' . $url . '</string>
            <key>DeviceAttributes</key>
            <array>
                <string>UDID</string>
                <string>IMEI</string>
                <string>ICCID</string>
                <string>VERSION</string>
                <string>PRODUCT</string>
            </array>
        </dict>
        <key>PayloadOrganization</key>
        <string>www.371.li</string>
        <key>PayloadDisplayName</key>
        <string>' . $app['name'] . '</string>
        <key>PayloadVersion</key>
        <integer>1</integer>
        <key>PayloadUUID</key>
        <string>8C7AD0B8-3900-44DF-A52F-3C4F92921807</string>
        <key>PayloadIdentifier</key>
        <string>com.yun-bangshou.profile-service</string>
        <key>PayloadDescription</key>
        <string>该配置文件将帮助用户获取当前iOS设备的UDID号码。This temporary profile will be used to find and display your current device\'s UDID.</string>
        <key>PayloadType</key>
        <string>Profile Service</string>
    </dict>
</plist>';

        file_put_contents(APP_ROOT . '/ios_describe/' . $id . '.mobileconfig', $xml);
        $this->success('生成成功！');
        exit;
    }
}
