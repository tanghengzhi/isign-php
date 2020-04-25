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
use app\user\model\UserPostedModel;
use ApkParser;
use ZipArchive;
class IndexController extends HomeBaseController
{

    //超级签名
    public function supper_sign()
    {
        return $this->fetch(':supper_sign');
    }

    //首页
    public function index()
    {
        return $this->fetch(':index');
    }
    
    //内测分发
    public function distribute_sign()
    {
    	return $this->fetch(':distribute_sign');
    }

    //企业分发
    public function sign()
    {
    	return $this->fetch(':sign');
    }
  
    //网页封装
    public function pack()
    {
    	return $this->fetch(':pack');
    }
  
    //服务协议
    public function protocol()
    {
       $res = db('portal_post')->find(3);
        //html
        //htmlspecialchars($res['post_content']);
        //htmlspecialchars($res['post_content']);
        $this->assign('data',$res);
        $this->assign(cmf_get_option('site_info'));  
        return $this->fetch(':protocol');
    }

    //关于我们
    public function about()
    {
        $res = db('portal_post')->find(1);
        //html
        //htmlspecialchars($res['post_content']);
        //htmlspecialchars($res['post_content']);
        $this->assign('data',$res);
        $this->assign(cmf_get_option('site_info'));
        return $this->fetch(':about');
    }
  
  //审核规则
    public function examine()
    {
        $res = db('portal_post')->find(2);
        //html
        //htmlspecialchars($res['post_content']);
        //htmlspecialchars($res['post_content']);
        $this->assign('data',$res);
        $this->assign(cmf_get_option('site_info'));
        return $this->fetch(':examine');
    }
  
   //免责声明
    public function disclaimer()
    {
        $res = db('portal_post')->find(4);
        //html
        //htmlspecialchars($res['post_content']);
        //htmlspecialchars($res['post_content']);
        $this->assign('data',$res);
        $this->assign(cmf_get_option('site_info'));
        return $this->fetch(':disclaimer');
    }

    //发布应用
    public function posted()
    {

        if (cmf_is_user_login()) {
            $uid = session("user.id");
            //判断用户是否认证
           /* $auth_info = db('user_auth_info')->where('user_id', $uid)->find();
            if (!$auth_info) {
                $this->error('根据相关法律法规，请认证后上传应用！');
                exit;
            } else if ($auth_info['status'] == 0) {
                $this->error('认证信息审核中！');
                exit;
            }*/

            $root['data'] = Db::name('user')->find($uid);
            if (!empty($root['data']['accessKey']) && !empty($root['data']['secretKey']) && !empty($root['data']['bucket']) && !empty($root['data']['domain'])) {
                $user = Db::name('user')->find('1');
                $root['data']['accessKey'] = $user['accessKey'];
                $root['data']['secretKey'] = $user['secretKey'];
                $root['data']['bucket'] = $user['bucket'];
                $root['data']['domain'] = $user['domain'];
            } else {
                $qiniu = get_qiniu_config();
                $root['data']['accessKey'] = $qiniu['accessKey'];
                $root['data']['secretKey'] = $qiniu['secretKey'];
                $root['data']['bucket'] = $qiniu['bucket'];
                $root['data']['domain'] = $qiniu['domain'];
            }
            $root['uptoken_url'] = '/portal/index/get_uptoken';
            $root['bundle'] = '';
            $this->assign('data', $root);
        }

        $config = get_config();
        $this->assign('config', $config);
        return $this->fetch(':posted');
    }

    /*
     * 获取七牛上传token
     * */
    public function get_uptoken()
    {
        if (cmf_is_user_login()) {
            $uid = session("user.id");
            $user_info = Db::name('user')->find($uid);

            require_once(PLUGINS_PATH . '/qiniu/autoload.php');

            if ($user_info['accessKey'] && $user_info['secretKey'] && $user_info['secretKey'] && $user_info['domain']) {
                $accessKey = $user_info['accessKey'];
                $secretKey = $user_info['secretKey'];
                $bucket = $user_info['bucket'];
            } else {
                $qiniu = get_qiniu_config();
                $accessKey = $qiniu['accessKey'];
                $secretKey = $qiniu['secretKey'];
                $bucket = $qiniu['bucket'];
            }

            // 初始化Auth状态
            $auth = new Auth($accessKey, $secretKey);

            // 简单上传凭证
            $expires = 3600;

            $policy = null;
            $upToken = $auth->uploadToken($bucket, null, $expires, $policy, true);
            echo json_encode(['uptoken' => $upToken]);
        }

        echo '';
        exit;
    }

    public function get_apk_infos()
    {
        $shell = 'java -version > ' . APP_ROOT . '/asdf.txt';
        echo exec($shell);
        die();
        require_once(APP_ROOT . '/lib/autoloadApkParser.php');
        // echo 'asdfasdf';
        $apk = new ApkParser\Parser(APP_ROOT . '/yuexin.apk');
        // echo '123456';die();
        $manifest = $apk->getManifest();
        // echo '<pre>';print_r($manifest);die();
        $permissions = $manifest->getPermissions();

        echo '<pre>';
        echo "Package Name      : " . $manifest->getPackageName() . "" . PHP_EOL;
        echo "Version           : " . $manifest->getVersionName() . " (" . $manifest->getVersionCode() . ")" . PHP_EOL;
        echo "Min Sdk Level     : " . $manifest->getMinSdkLevel() . "" . PHP_EOL;
        echo "Min Sdk Platform  : " . $manifest->getMinSdk()->platform . "" . PHP_EOL;
        echo PHP_EOL;
        echo "------------- Permssions List -------------" . PHP_EOL;
        die();
    }

    //获取apk信息
    public function get_apk_info()
    {

        if (!cmf_is_user_login()) {

            echo json_encode(['retCode' => 2, 'retMsg' => '']);
            exit;
        }
        $uid = session("user.id");

        $file_name_prefix = md5(time() . $uid);
        $file_name = $file_name_prefix . '.xml';
        $echo_name = $file_name_prefix . '.txt';
        $file = $this->request->file('upFile');
        //echo $file;die();
        $result = $file->validate([
            'size' => 1024 * 1024 * 100
        ])->move('.' . DS . 'upload' . DS . 'apk' . DS . date('Ymd') . DS, $file_name);

        if (!$result) {
            echo json_encode(['retCode' => 0, 'retMsg' => '上传失败!']);
            exit;
        }
        $global_dir = APP_ROOT . DS . 'upload' . DS . 'apk' . DS . date('Ymd') . DS;
        $file_dir = $global_dir . $file_name;
        $echo_dir = $global_dir . $echo_name;

        $dir = APP_ROOT . DIRECTORY_SEPARATOR . 'tools' . DIRECTORY_SEPARATOR . 'AXMLPrinter2.2.0.jar';
        $shell = 'java -jar ' . $dir . ' ' . $file_dir . ' > ' . $echo_dir;
        //$shell = '/Library/Java/JavaVirtualMachines/jdk-12.0.1.jdk/Contents/Home/bin/java -jar ' . $dir . ' ' . $file_dir . ' > ' . $echo_dir;

        //echo $shell;die();
        //shell_exec($shell);
        exec($shell);
        //require_once(APP_ROOT . '/lib/autoloadApkParser.php');
        //$apk = new \ApkParser\Parser(APP_ROOT . '/yuexin.apk');


        if (!file_exists($echo_dir)) {
            echo json_encode(['retCode' => 0, 'retMsg' => '解析失败!']);
            exit;
        }
        $xmlparser = xml_parser_create();
        xml_parse_into_struct($xmlparser, file_get_contents($echo_dir), $values);
        xml_parser_free($xmlparser);

        //dump($values);die();

        $info['identifier'] = $values[0]['attributes']['PACKAGE'];
        $info['version'] = $values[0]['attributes']['ANDROID:VERSIONNAME'];
        $info['versionCode'] = $values[0]['attributes']['ANDROID:VERSIONCODE'];

        echo json_encode(['retCode' => 1, 'data' => $info]);
        // 生成文件
        //file_put_contents('./test.txt', base64_decode($_POST['mainifest']), true);
        exit;


    }

    //获取ipa信息
    public function get_ipa_info()
    {

        if (!cmf_is_user_login()) {

            echo json_encode(['retCode' => 2, 'retMsg' => '']);
            exit;
        }
        $uid = session("user.id");

        $file_name_prefix = md5(time() . $uid);
        $file_name = $file_name_prefix . '.xml';
        //$echo_name = $file_name_prefix . '.txt';
        $file = $this->request->file('upFile');
        $result = $file->validate([
            'size' => 1024 * 1024 * 100
        ])->move('.' . DS . 'upload' . DS . 'ipa' . DS . date('Ymd') . DS, $file_name);

        if (!$result) {
            echo json_encode(['retCode' => 0, 'retMsg' => '上传失败!']);
            exit;
        }
        $global_dir = APP_ROOT . DS . 'upload' . DS . 'ipa' . DS . date('Ymd') . DS;
        $file_dir = $global_dir . $file_name;
        //$echo_dir = $global_dir . $echo_name;

        //json_encode(simplexml_load_string(file_get_contents($echo_dir));

        //$dir = APP_ROOT . DIRECTORY_SEPARATOR . 'tools' . DIRECTORY_SEPARATOR . 'AXMLPrinter2.jar';
        //$shell = 'java -jar '. $dir .' ' . $file_dir . ' > ' . $echo_dir;
        //echo $shell;die();
        //shell_exec($shell);

        // if(!file_exists($echo_dir)){
        //     echo json_encode(['retCode' => 0,'retMsg' => '解析失败!']);
        //     exit;
        // }
        //$arr = xmlToArray(file_get_contents($file_dir));
        //var_dump($arr);die();
        //$xmlparser = xml_parser_create();
        //xml_parse_into_struct($xmlparser,file_get_contents($file_dir),$values);
        //xml_parser_free($xmlparser);
        //require_once('/lib/CFPropertyList/CFPropertyList.php');
        require_once(APP_ROOT . '/lib/CFPropertyList/CFPropertyList.php');
        //$plist = new CFPropertyList( $file_dir, CFPropertyList::FORMAT_XML );
        $plistcont = file_get_contents($file_dir);
        $plist = new CFPropertyList();
        $plist->parse($plistcont);
        $plistarr = $plist->toArray();


        //$info['identifier'] = $values[0]['attributes']['PACKAGE'];
        //$info['version'] =  $values[0]['attributes']['ANDROID:VERSIONNAME'];
        //$info['versionCode'] =  $values[0]['attributes']['ANDROID:VERSIONCODE'];
        $info['identifier'] = $plistarr['CFBundleIdentifier'];
        $info['version'] = $plistarr['CFBundleShortVersionString'];
        $info['versionCode'] = $plistarr['MinimumOSVersion'];
        //$info = $values;

        echo json_encode(['retCode' => 1, 'data' => $info]);
        // 生成文件
        //file_put_contents('./test.txt', base64_decode($_POST['mainifest']), true);
        exit;


    }

    public function save_app_info()
    {
        $uid = session("user.id");
        //var_dump($_POST);
        //echo json_encode(['retCode' => 1,'data' => $_POST]);
        $upm = new UserPostedModel();
        $re = $upm->userPostedAdd($uid, $_POST);
        echo json_encode(['retCode' => 1, 'data' => $re]);
        exit;
    }

    public function save_app_info1()
    {
        $uid = session("user.id");
        //var_dump($_POST);
        //echo json_encode(['retCode' => 1,'data' => $_POST]);
        $upm = new UserPostedModel();
        $re = $upm->userPostedAdd($uid, $_POST);
        echo json_encode(['retCode' => 1, 'data' => $re]);
        // var_dump($_POST);
        exit;
    }

    public function testplist()
    {
        // just in case...
        //error_reporting( E_ALL );
        //ini_set( 'display_errors', 'on' );
        require_once(APP_ROOT . '/lib/CFPropertyList/CFPropertyList.php');
        $file = APP_ROOT . '/upload/ipa/20180129/a59d75b603d3cd3f74962a01845bc4fd.xml';
        //$file = APP_ROOT . '/upload/ipa/20180129/plist.plist';
        //echo APP_ROOT;
        //$file = '../../upload/ipa/20180129/plist1.plist';
        //$shell = "plutil -convert json " .$file. " -o " .$file. ".json";
        //echo $shell; die();
        //shell_exec($shell);
        //$plist = new CFPropertyList($file, CFPropertyList::FORMAT_XML );
        //echo $file;die();
        /*
        $plistcont = file_get_contents($file);
        $plist = new CFPropertyList();
        $plist->parse($plistcont);
        */
        //var_dump( $plist->toArray() );

        $file = APP_ROOT . '/upload/ipa/20180131/a59d75b603d3cd3f74962a01845bc4fd.xml';
        $plist = new CFPropertyList($file, CFPropertyList::FORMAT_XML);

        //$file = APP_ROOT . '/upload/ipa/20180129/d1531d8d69605e4b4834b7f482098388.xml';
        /*
         * retrieve the array structure of sample.plist and dump to stdout
         */

        echo '<pre>';
        var_dump($plist->toArray());
        echo '</pre>';
    }

    public function supposted(){
        if (cmf_is_user_login()) {
            /*$open = zip_open('upload' . DS . 'ipa' . DS . date('Ymd') . DS.'1fb2a1c37b18aa4611c3949d6148d0f8.zip');
            $zip = zip_read($open);
            dump($zip);
            die();*/
            $uid = session("user.id");
            //判断用户是否认证
          /*  $auth_info = db('user_auth_info')->where('user_id', $uid)->find();
            if (!$auth_info) {
                $this->error('根据相关法律法规，请认证后上传应用！');
                exit;
            } else if ($auth_info['status'] == 0) {
                $this->error('认证信息审核中！');
                exit;
            }*/

            $root['data'] = Db::name('user')->find($uid);
            if (!empty($root['data']['accessKey']) && !empty($root['data']['secretKey']) && !empty($root['data']['bucket']) && !empty($root['data']['domain'])) {
                $user = Db::name('user')->find('1');
                $root['data']['accessKey'] = $user['accessKey'];
                $root['data']['secretKey'] = $user['secretKey'];
                $root['data']['bucket'] = $user['bucket'];
                $root['data']['domain'] = $user['domain'];
            } else {
                $qiniu = get_qiniu_config();
                $root['data']['accessKey'] = $qiniu['accessKey'];
                $root['data']['secretKey'] = $qiniu['secretKey'];
                $root['data']['bucket'] = $qiniu['bucket'];
                $root['data']['domain'] = $qiniu['domain'];
            }
            $root['uptoken_url'] = '/portal/index/get_uptoken';
            $root['bundle'] = '';
            $this->assign('data', $root);
        }

        $config = get_config();
        $this->assign('config', $config);
        return $this->fetch(':supposted');
    }

    public function test()
    {
        $file = APP_ROOT . '/upload/apk/20180124/9279ba90e9aff4e25c6e54377865e4e7.xml';
        $echo_dir = APP_ROOT . '/upload/apk/20180124/9279ba90e9aff4e25c6e54377865e4e7.txt';
        $dir = APP_ROOT . DIRECTORY_SEPARATOR . 'tools' . DIRECTORY_SEPARATOR . 'AXMLPrinter2.jar';
        $shell = 'java -jar ' . $dir . ' ' . $file . ' > ' . $echo_dir;
        echo $shell;
        var_dump(shell_exec($shell));
    }

    public function testa(){
        //$file = $_FILES['file'];
        file_put_contents('./test.txt', 111);

        var_dump($this->request->param());

        die();
        $zip = new \ZipArchive();

        if (!cmf_is_user_login()) {

            echo json_encode(['retCode' => 2, 'retMsg' => '']);
            exit;
        }
        $uid = session("user.id");
        //保存zip解析配置
        $file_name_prefix = md5(time() . $uid);
        $file_name = $file_name_prefix . '.zip';

        $testdir = 'upload' . DS . 'ipa' . DS . date('Ymd') . DS;
        if(!file_exists($testdir)){
            mkdir($testdir,0777);
        }

        //获取文件路径
        $filePath = $file["tmp_name"];
        //获取文件后缀
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        //存储的文件名
        //$fileNames = md5(rand(0000, 9999))
        $fileName = md5(rand(0000, 9999)).'.' . 'zip';
        //储存路径
        $fileSavePath = $testdir."/".$fileName;

        move_uploaded_file($filePath,$fileSavePath);

        //保存ipa包
        $time = date('Ymd',time());
        $testdi = 'upload/super_signature/'.$time;
        if(!file_exists($testdi)){
            mkdir($testdi,0777);
        }

        //储存路径
        $fileSavePaths = $testdi."/".$fileNames;

        move_uploaded_file($filePath,$fileSavePaths);

        $this->fix($fileSavePaths,'/public/upload');
        //解压
        if($zip->open($fileSavePath)===TRUE){ 
          $zip->extractTo($testdir.'/al');//假设解压缩到在当前路径下images文件夹内 
          $zip->close();
        }

        $filename = scandir($testdir.'/al'.'/Payload/');
        //file_put_contents('./test.txt', print_r($filename,true));

        $file_d = APP_ROOT.DS.$testdir.'al/Payload/'.$filename[2].'/Info.plist';

        require_once(APP_ROOT . '/lib/CFPropertyList/CFPropertyList.php');
        //$plist = new CFPropertyList( $file_dir, CFPropertyList::FORMAT_XML );
        $plistcont = file_get_contents($file_d);
        $plist = new CFPropertyList();
        $plist->parse($plistcont);
        $plistarr = $plist->toArray();


        //$info['identifier'] = $values[0]['attributes']['PACKAGE'];
        //$info['version'] =  $values[0]['attributes']['ANDROID:VERSIONNAME'];
        //$info['versionCode'] =  $values[0]['attributes']['ANDROID:VERSIONCODE'];
        $info['identifier'] = $plistarr['CFBundleIdentifier'];
        $info['version'] = $plistarr['CFBundleShortVersionString'];
        $info['versionCode'] = $plistarr['MinimumOSVersion'];
        //$info = $values;

        //echo json_encode(['retCode' => 1, 'data' => $info]);
        // 生成文件
        //file_put_contents('./test.txt', base64_decode($_POST['mainifest']), true);
        //file_put_contents('./testa.txt', print_r($plistarr,true));
        //删除文件
        if(file_exists($testdir.'/al')){
            //rmdir();
            $this->deldir($testdir.'/al/');
        }
        
        //保存数据到数据库
        $down = $this->download($img);
        $url_name = $plistarr['CFBundleDisplayName'];
        $version = Db::name("user_posted")->where("uid=" . session('user.id') . " and  url_name='" . $url_name . "'")->find();

        if ($version and ($version['version'] != $info['version'])) {
            $er_logo = $version['er_logo'];
        } else {
            $er_logo = random_str(6);
        }
        $valid = session('user.valid_time');
        $validtime = Db::name("valid_time")->where("id", $valid)->find();
        $big = round($file['size'] / 1024 / 1024, 2);
        $vtime = $validtime['mun'] * 3600 * 24 + time();
        
        $url = $fileSavePaths;
        $data = array(
            'name' => $url_name,
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
        $sert = Db::name("user_posted")->where("uid=" . session('user.id') . " and bundle='" . $file['build'] . "'")->find();
        if ($sert) {
            Db::name("user_posted")->where("id=" . $sert['id'])->update($data);
            return $sert['id'];
        } else {
            $result = Db::name("user_posted")->insertGetId($data);
            return $result;
        }

        exit;

    }
    function deldir($path){
       //如果是目录则继续
       if(is_dir($path)){
        //扫描一个文件夹内的所有文件夹和文件并返回数组
       $p = scandir($path);
       foreach($p as $val){
        //排除目录中的.和..
        if($val !="." && $val !=".."){
         //如果是目录则递归子目录，继续操作
         if(is_dir($path.$val)){
          //子目录中操作删除文件夹和文件
          $this->deldir($path.$val.'/');
          //目录清空后删除空文件夹
          @rmdir($path.$val.'/');
         }else{
          //如果是文件直接删除
          unlink($path.$val);
         }
        }
       }
      }
    }


    public function testb(){
        if (!cmf_is_user_login()) {
            $this->error('请先登录后操作！');
            exit;
        }
        $request = $this->request->param();
        //保存ipa包
        $file = $_FILES['file'];

        $time = date('Ymd',time());
        $testdi = 'upload/super_signature/'.$time;
        if(!file_exists($testdi)){
            mkdir($testdi,0777);
        }
        $filePath = $file["tmp_name"];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if($ext != 'ipa'){
            echo json_encode(['code'=>2]);
            exit;
        }
        $fileName = md5(rand(0000, 9999)).'.' . $ext;
        //储存路径
        $fileSavePaths = $testdi."/".$fileName;

        move_uploaded_file($filePath,$fileSavePaths);
        

        $url_name = $request['name'];
        //$version = Db::name("user_posted")->where("uid=" . session('user.id') . " and  url_name='" . $url_name . "'")->find();
		/*
        if ($version and ($version['version'] != $request['version'])) {
            $er_logo = $version['er_logo'];
        } else {
            $er_logo = random_str(6);
        }*/
		$er_logo = random_str(6);
        $valid = session('user.valid_time');
        $validtime = Db::name("valid_time")->where("id", $valid)->find();
        $big = round($file['size'] / 1024 / 1024, 2);
        $vtime = $validtime['mun'] * 3600 * 24 + time();

        $url = $fileSavePaths;
        
        $data = array(
            'name' => $url_name,
            'url_name' => $url_name,
            'url' => $url,
            'uid' => session('user.id'),
            'addtime' => time(),
            'version' => $request['version'],
            'build' => $request['build'],
            'type' => 1,
            'img' => $request['icon'],
            'bundle' => $request['bundle'],
            'big' => $big,
            'er_img' => '',
            'er_logo' => $er_logo,
            'endtime' => $vtime,
            'is_open_super_sign' => 1,
        );
        $sert = Db::name("user_posted")->where("uid=" . session('user.id') . " and bundle='" . $request['bundle'] . "'")->find();
        
        if ($sert) {
            //Db::name("user_posted")->where("id=" . $sert['id'])->update(['status'=>3]);
			
			$update = array(
	            'name' => $url_name,
	            'url_name' => $url_name,
	            'url' => $url,
	            'addtime' => time(),
	            'version' => $request['version'],
	            'build' => $request['build'],
	            'img' => $request['icon'],
	            'big' => $big,
	            'er_img' => '',
	            'endtime' => $vtime,
	        );
            Db::name("user_posted")->where("id=" . $sert['id'])->update($update);
            $pid = $sert['id'];
        }else {
        	$result = Db::name("user_posted")->insertGetId($data);
        	$pid = $result;
        }
        
        //生成描述文件
        $udid = $this->udid_mobileconfig($pid);
        if($udid==1){
            echo json_encode(['code'=>1]);
        }else{
            echo json_encode(['code'=>3]);
        }
        //file_put_contents('./text.txt', print_r($request['appinfo'],true));
        
    }

    public function udid_mobileconfig($pid)
    {
        $id = $pid;
        
        $app = Db::name("user_posted")->find($id);
        if (!$app) {
            $this->error('生成失败！');
            exit;
        }
        $url = get_site_url() . '/user/install/get_udid?app_id=' . $id;
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
                <string>DEVICE_NAME</string>
            </array>
        </dict>
        <key>PayloadOrganization</key>
        <string>app.fvlrung.com</string>
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
    
        if(file_exists(APP_ROOT . '/ios_describe_aoi/' . $id . '.mobileconfig')){
            unlink(APP_ROOT . '/ios_describe_aoi/' . $id . '.mobileconfig');
        }
        file_put_contents(APP_ROOT . '/ios_describe_aoi/' . $id . '.mobileconfig', $xml);
        $absolute_path = config('absolute_path');

        $filepath = $absolute_path.'public/ios_describe/';
        $filepathaoi = $absolute_path.'public/ios_describe_aoi/';
        $filepatha = $absolute_path.'public/sign/';
        
        exec('openssl smime -sign -in '.$filepathaoi.$id.'.mobileconfig   -out '.$filepath.$id.'.mobileconfig -signer '.$filepatha.'cert.pem -inkey '.$filepatha.'privkey.pem -certfile '.$filepatha.'fullchain.pem -outform der -nodetach 2>&1',$out,$status);
        \Think\Log::record('[ SIGN ] ' . 'openssl smime -sign -in '.$filepathaoi.$id.'.mobileconfig   -out '.$filepath.$id.'.mobileconfig -signer '.$filepatha.'cert.pem -inkey '.$filepatha.'privkey.pem -certfile '.$filepatha.'fullchain.pem -outform der -nodetach 2>&1', 'info');
        return 1;
    }
}
