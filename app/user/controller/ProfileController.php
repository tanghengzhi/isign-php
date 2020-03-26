<?php
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

use cmf\lib\Storage;
use Qiniu\entry;
use think\Validate;
use think\Image;
use cmf\controller\UserBaseController;
use app\user\model\UserModel;
use think\Db;
use Qiniu\Auth;    // 引入鉴权类
use Qiniu\Storage\UploadManager;    // 引入上传类
use qrcode;

class ProfileController extends UserBaseController
{

    function _initialize()
    {
        parent::_initialize();
    }

    //实名认证
    public function real_name_auth()
    {
        $uid = session('user.id');
        if (cmf_is_user_login()) {
            $auth_info = db('user_auth_info')->where('user_id', $uid)->find();
            $this->assign('auth_info', $auth_info);
        }

        if ($auth_info) {
            if ($auth_info['status'] == 1) {
                $status = '审核通过';
            } else {
                $status = '审核中';
            }
        } else {
            $status = '未认证';
        }
        $this->assign('status',$status);
        return $this->fetch();
    }

    //提交认证信息
    public function editAuthInfoPost()
    {
        $user_real_name = trim(input('param.user_real_name'));
        $user_card_number = input('param.user_card_number');
        $card_img1 = trim(input('param.card_img1'));
        $card_img2 = trim(input('param.card_img2'));

        $uid = session('user.id');
        if (cmf_is_user_login()) {
            $auth_info = db('user_auth_info')->where('user_id', $uid)->find();
            if ($auth_info) {
                $this->error('已经提交过认证！');
                exit;
            }

            $plugin = db('plugin')->where('name', '=', 'Qiniu')->find();
            $qiniu = json_decode($plugin['config'], true);

            $data = [
                'user_id' => $uid,
                'user_real_name' => $user_real_name,
                'card_img1' => 'http://' . $qiniu['domain'] . '/' . $card_img1,
                'card_img2' => 'http://' . $qiniu['domain'] . '/' . $card_img2,
                'create_time' => time(),
                'card_number' => $user_card_number,
            ];

            db('user_auth_info')->insert($data);
            $this->success('提交成功，等待审核！');
            exit;
        } else {
            $this->error('请登录后操作！');
            exit;
        }
    }

    /**
     * 会员中心首页
     */
    public function center()
    {
        $user = cmf_get_current_user();

        $this->assign($user);
        return $this->fetch();
    }

    /**
     * 编辑用户资料
     */
    public function edit()
    {

        $user = cmf_get_current_user();
        $this->assign($user);
        return $this->fetch('edit');
    }

    /**
     * 编辑用户资料提交
     */
    public function editPost()
    {
        if ($this->request->isPost()) {
            $validate = new Validate([
                'user_nickname' => 'chsDash|max:32',
                'user_url' => 'url|max:64',
            ]);
            $validate->message([
                'user_nickname.chsDash' => '昵称只能是汉字、字母、数字和下划线_及破折号-',
                'user_nickname.max' => '昵称最大长度为32个字符',
                'user_url.url' => '个人网址错误',
                'user_url.max' => '个人网址长度不得超过64个字符',
            ]);

            $data = $this->request->post();
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }

            $plugin = db('plugin')->where('name', '=', 'Qiniu')->find();
            $qiniu = json_decode($plugin['config'], true);
            $id = cmf_get_current_user_id();
            $user = db('user')->find($id);
            if($data['avatar']!=$user['avatar']){
                $data['avatar'] = 'http://' . $qiniu['domain'] . '/' . $data['avatar'];
            }
            
            $editData = new UserModel();
            if ($editData->editData($data)) {
                $this->success("保存成功！", "user/profile/center");
            } else {
                $this->error("没有新的修改信息！");
            }
        } else {
            $this->error("请求错误");
        }
    }

    /**
     * 个人中心修改密码
     */
    public function password()
    {
        $user = cmf_get_current_user();
        $this->assign($user);
        return $this->fetch();
    }

    /**
     * 个人中心修改密码提交
     */
    public function passwordPost()
    {
        if ($this->request->isPost()) {
            $validate = new Validate([
                'old_password' => 'require|min:6|max:32',
                'password' => 'require|min:6|max:32',
                'repassword' => 'require|min:6|max:32',
            ]);
            $validate->message([
                'old_password.require' => '旧密码不能为空',
                'old_password.max' => '旧密码不能超过32个字符',
                'old_password.min' => '旧密码不能小于6个字符',
                'password.require' => '新密码不能为空',
                'password.max' => '新密码不能超过32个字符',
                'password.min' => '新密码不能小于6个字符',
                'repassword.require' => '重复密码不能为空',
                'repassword.max' => '重复密码不能超过32个字符',
                'repassword.min' => '重复密码不能小于6个字符',
            ]);

            $data = $this->request->post();
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }

            $login = new UserModel();
            $log = $login->editPassword($data);
            switch ($log) {
                case 0:
                    $this->success('修改成功');
                    break;
                case 1:
                    $this->error('密码输入不一致');
                    break;
                case 2:
                    $this->error('原始密码不正确');
                    break;
                default :
                    $this->error('未受理的请求');
            }
        } else {
            $this->error("请求错误");
        }

    }

    // 用户头像编辑
    public function avatar()
    {


        $user = cmf_get_current_user();
        $this->assign($user);
        return $this->fetch();
    }

    // 用户头像上传
    public function avatarUpload()
    {
        $file = $this->request->file('file');
        $result = $file->validate([
            'ext' => 'jpg,jpeg,png',
            'size' => 1024 * 1024
        ])->move('.' . DS . 'upload' . DS . 'avatar' . DS);

        if ($result) {
            $avatarSaveName = str_replace('//', '/', str_replace('\\', '/', $result->getSaveName()));
            $avatar = 'avatar/' . $avatarSaveName;
            session('avatar', $avatar);

            return json_encode([
                'code' => 1,
                "msg" => "上传成功",
                "data" => ['file' => $avatar],
                "url" => ''
            ]);
        } else {
            return json_encode([
                'code' => 0,
                "msg" => $file->getError(),
                "data" => "",
                "url" => ''
            ]);
        }
    }

    // 用户头像裁剪
    public function avatarUpdate()
    {
        $avatar = session('avatar');
        if (!empty($avatar)) {
            $w = $this->request->param('w', 0, 'intval');
            $h = $this->request->param('h', 0, 'intval');
            $x = $this->request->param('x', 0, 'intval');
            $y = $this->request->param('y', 0, 'intval');

            $avatarPath = "./upload/" . $avatar;

            $avatarImg = Image::open($avatarPath);
            $avatarImg->crop($w, $h, $x, $y)->save($avatarPath);

            $result = true;
            if ($result === true) {
                $storage = new Storage();
                $result = $storage->upload($avatar, $avatarPath, 'image');

                $userId = cmf_get_current_user_id();
                Db::name("user")->where(["id" => $userId])->update(["avatar" => $avatar]);
                session('user.avatar', $avatar);
                $this->success("头像更新成功！");
            } else {
                $this->error("头像保存失败！");
            }

        }
    }

    /**
     * 绑定手机号或邮箱
     */
    public function binding()
    {
        $user = cmf_get_current_user();
        $this->assign($user);
        return $this->fetch();
    }

    /**
     * 绑定手机号
     */
    public function bindingMobile()
    {
        if ($this->request->isPost()) {
            $validate = new Validate([
                'username' => 'require|number|unique:user,mobile',
                'verification_code' => 'require',
            ]);
            $validate->message([
                'username.require' => '手机号不能为空',
                'username.number' => '手机号只能为数字',
                'username.unique' => '手机号已存在',
                'verification_code.require' => '验证码不能为空',
            ]);

            $data = $this->request->post();
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
            $errMsg = cmf_check_verification_code($data['username'], $data['verification_code']);
            if (!empty($errMsg)) {
                $this->error($errMsg);
            }
            $userModel = new UserModel();
            $log = $userModel->bindingMobile($data);
            switch ($log) {
                case 0:
                    $this->success('手机号绑定成功');
                    break;
                default :
                    $this->error('未受理的请求');
            }
        } else {
            $this->error("请求错误");
        }
    }

    /**
     * 绑定邮箱
     */
    public function bindingEmail()
    {
        if ($this->request->isPost()) {
            $validate = new Validate([
                'username' => 'require|email|unique:user,user_email',
                'verification_code' => 'require',
            ]);
            $validate->message([
                'username.require' => '邮箱地址不能为空',
                'username.email' => '邮箱地址不正确',
                'username.unique' => '邮箱地址已存在',
                'verification_code.require' => '验证码不能为空',
            ]);

            $data = $this->request->post();
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
            $errMsg = cmf_check_verification_code($data['username'], $data['verification_code']);
            if (!empty($errMsg)) {
                $this->error($errMsg);
            }
            $userModel = new UserModel();
            $log = $userModel->bindingEmail($data);
            switch ($log) {
                case 0:
                    $this->success('邮箱绑定成功');
                    break;
                default :
                    $this->error('未受理的请求');
            }
        } else {
            $this->error("请求错误");
        }
    }

    /*七牛配置*/
    public function cattle()
    {
        $user = cmf_get_current_user();
        $this->assign($user);
        return $this->fetch();
    }

    /*修改七牛配置*/
    public function cattle_upd()
    {

        if ($this->request->isPost()) {
            $validate = new Validate([
//                'accessKey' => 'require',
//                'secretKey' => 'require',
//                'bucket' => 'require',
//                'domain' => 'require',
            ]);
//            $validate->message([
//                'accessKey.require' => 'AK密钥不能为空',
//                'secretKey.require' => 'sk密钥不能为空',
//                'bucket.require' => '储存名称不能为空',
//                'domain.require' => '七牛储存外链默认域名不能为空',
//            ]);

            $data = $this->request->post();

            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
            $userModel = new UserModel();
            $log = $userModel->cattleData($data);
            if ($log == 1) {
                $this->success('七牛配置成功');
            } else {
                $this->error('未受理的请求');
            }

        } else {
            $this->error("请求错误");
        }

    }

    /**
     * CURL下载文件 成功返回文件名，失败返回false
     * @param $url
     * @param string $savePath
     * @return bool|string
     * @author Zou Yiliang
     */
    public function downFile()
    {
        //  print_r($_POST['type']);exit;
        $name = $_POST['name'];
        $big = $_POST['big'];
        $savePath = './upload/app';
        $url = "http://" . session('user.domain') . "/" . $name;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_HEADER, TRUE);    //需要response header
        curl_setopt($ch, CURLOPT_NOBODY, FALSE);    //需要response body

        $response = curl_exec($ch);

        //分离header与body
        $header = '';
        $body = '';
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {
            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE); //头信息size
            $header = substr($response, 0, $headerSize);
            $body = substr($response, $headerSize);
        }

        curl_close($ch);
        // print_r($header);exit;
        //文件名
        $arr = array();
        if (preg_match('/filename="(.*?)"/', $header, $arr)) {

            $file = date('Ym') . '/' . $arr[1];
            $fullName = rtrim($savePath, '/') . '/' . $file;

            //创建目录并设置权限
            $basePath = dirname($fullName);
            if (!file_exists($basePath)) {
                @mkdir($basePath, 0777, true);
                @chmod($basePath, 0777);
            }
            if (file_put_contents($fullName, $body)) {
                $ur = Db::name('config')->where("code='system_parsing'")->find();
                $urls = $ur['val'];
                $files = $this->filesd($file, $urls);
                $arr = json_decode($files);
                $arr = json_decode(json_encode($arr), true);

                $add_qiniu = $this->add_qiniu($arr, $url, $urls, $big);

                return $add_qiniu;
            }
        }

        return false;
    }

    //获取文件信息
    public function filesd($file, $url)
    {
        header("Content-type: text/html; charset=utf-8");

        // $filePath =dirname(__FILE__)."/../../../public/upload/app/".$file;
        $filePath = "upload/app/" . $file;
        $post_data = array(
            "package" => "@" . $filePath   //要上传的本地文件地址
        );
        $ch = curl_init();
        if (class_exists('\CURLFile')) {
            $post_data['package'] = new \CURLFile(realpath($filePath));
        } else {
            if (defined('CURLOPT_SAFE_UPLOAD')) {
                curl_setopt($ch, CURLOPT_SAFE_UPLOAD, FALSE);
            }
        }
        //关闭https验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    //上传保存数据库
    public function add_qiniu($file, $url, $urls, $big, $imgs, $files)
    {
        $utype = substr($urls, 0, -6);
        $img = $utype . "icon/" . $file['guid'] . ".png";
        $down = $this->download($img);
        $url_name = $files['upfile']['name'];
        $version = Db::name("user_posted")->where("uid=" . session('user.id') . " and  url_name='" . $url_name . "'")->find();
        if ($version and ($version['version'] != $file['version'])) {
            $er_logo = $version['er_logo'];
        } else {
            $er_logo = 'http://' . $_SERVER['HTTP_HOST'] . '/D' . rand(000, 999);
        }
        $valid = session('user.valid_time');
        $validtime = Db::name("valid_time")->where("id", $valid)->find();
        $big = round($big / 1024 / 1024, 2);
        $vtime = $validtime['mun'] * 3600 * 24 + time();
        $data = array(
            'name' => $file['name'] . rand(000, 999),
            'url_name' => $url_name,
            'url' => $url,
            'uid' => session('user.id'),
            'addtime' => time(),
            'version' => $file['version'],
            'build' => $file['build'],
            'type' => $file['platform'],
            'img' => $down,
            'bundle' => $file['bundleID'],
            'big' => $big,
            'er_img' => $imgs,
            'er_logo' => $er_logo,
            'endtime' => $vtime
        );
        $sert = Db::name("user_posted")->where("uid=" . session('user.id') . " and version='" . $file['version'] . "'")->find();
        if ($sert) {
            Db::name("user_posted")->where("id=" . $sert['id'])->update($data);
            return $sert['id'];
        } else {
            $result = Db::name("user_posted")->insertGetId($data);
            return $result;
        }
    }

    //添加数据
    public function add_Files()
    {
        $result = array('code' => 0, 'msg' => '');
        $name = $_FILES['upfile']['name'];
        $type = substr($name, -3);

        if ($type == 'apk' || $type == 'ipa') {
            if ($_FILES["upfile"]["error"] > 0) {
                //   print_r("上传已超出上线");exit;
                $result['msg'] = "上传已超出上线";
            } else {
                $flie_abk = substr($_FILES['upfile']["name"], -4, 4);
                $file_name = md5(rand(0000, 9999)) . $flie_abk;

                $domain = Db::name('user')->where("id=" . session('user.id'))->find();

                if (file_exists("upload/app/" . $file_name)) {
                    //文件存在，重复上传
                    $tok = $this->upd_tok($_FILES, $file_name);  //上传七牛

                    $tok_url = "http://" . $domain['domain'] . "/" . $tok['key'];
                    $img = '';
                    $retype = $this->acquire_file($_FILES, $tok_url, $img, $file_name);

                    if ($retype) {
                        $result['msg'] = "上传成功";
                        unlink("upload/app/" . $file_name);
                        $result['id'] = $retype;
                    } else {
                        $result['msg'] = "上传失败";
                    }
                } else {
                    $res = move_uploaded_file($_FILES["upfile"]["tmp_name"], "upload/app/" . $file_name);
                    if ($res) {
                        $tok = $this->upd_tok($_FILES, $file_name);  //上传七牛

                        $tok_url = "http://" . $domain['domain'] . "/" . $tok['key'];
                        $img = '';
                        $retype = $this->acquire_file($_FILES, $tok_url, $img, $file_name);

                        if ($retype) {
                            $result['msg'] = "上传成功";

                            unlink("upload/app/" . $file_name);
                            $result['id'] = $retype;
                        } else {
                            $result['msg'] = "上传失败";
                        }
                    } else {
                        $result['msg'] = "上传失败";
                    }
                }
            }
        } else {
            $result['msg'] = "上传格式不正确";
        }
        echo json_encode($result);
        exit;
    }

    //存数据库
    public function acquire_file($file, $tok_url, $img, $file_name)
    {
        $ur = Db::name('config')->where("code='system_parsing'")->find();
        $urls = $ur['val'];
        $files = $this->filesd($file_name, $urls); //获取文件信息
        $arr = json_decode($files);
        $arr = json_decode(json_encode($arr), true);

        $add_qiniu = $this->add_qiniu($arr, $tok_url, $urls, $file["upfile"]["size"], $img, $file);//入数据库

        return $add_qiniu;
    }

    //上传七牛
    public function upd_tok($file, $file_name)
    {
        require_once(PLUGINS_PATH . '/qiniu/autoload.php');
        // 需要填写你的 Access Key 和 Secret Key
        //$user=Db::name('user')->where("id=".session('user.id'))->find();
        //$accessKey = $user['accessKey'];
        //$secretKey =$user['secretKey'];
        //$bucket = $user['bucket'];
        $user_info = Db::name('user')->where("id=" . session('user.id'))->find();
        if ($user_info['accessKey'] && $user_info['secretKey'] && $user_info['bucket'] && $user_info['domain']) {
            $accessKey = $user_info['accessKey'];
            $secretKey = $user_info['secretKey'];
            $bucket = $user_info['bucket'];
        } else {
            $user = Db::name('user')->find('1');
            $accessKey = $user['accessKey'];
            $secretKey = $user['secretKey'];
            $bucket = $user['bucket'];
        }

        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
        // 上传到七牛后保存的文件名

        $key = $_FILES['upfile']["name"] . rand(0, 9);
        // 生成上传 Token
        $token = $auth->uploadToken($bucket, $key);

        // 要上传文件的本地路径
        $filePath = "upload/app/" . $file_name;


        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();

        try {
            // 调用 UploadManager 的 putFile 方法进行文件的上传。
            list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        } catch (\Exception $exception) {
            $result['msg'] = "配置文件错误，请查看七牛配置";
            echo json_encode($result);
            exit;
        }

        if ($err !== null) {
            return $err;
        } else {

            return $ret;
        }
    }

    //查询七牛配置
    public function find_buts()
    {
        $user = Db::name('user')->where("id=" . session('user.id'))->find();
        if (empty($user['accessKey']) || empty($user['secretKey']) || empty($user['bucket']) || empty($user['domain'])) {
            return "0";
        } else {
            return "1";
        }
    }

    //下载图片
    public function download($url, $path = 'upload/img/')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        //关闭https验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $file = curl_exec($ch);
        curl_close($ch);
        $filename = pathinfo($url, PATHINFO_BASENAME);
        $resource = fopen($path . $filename, 'a');
        fwrite($resource, $file);
        fclose($resource);
        return "/" . $path . $filename;
    }


}
