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
use think\Db;
use app\user\model\UserPostedModel;
use Qiniu\entry;
use Qiniu\Auth;    // 引入鉴权类
use Qiniu\Storage\UploadManager;    // 引入上传类
use OSS\OssClient;
use OSS\Core\OssException;
class TestController extends HomeBaseController
{
    public function index(){
    	$out = md5('com.yuliao.chen');
        //exec('export PATH=$PATH:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/root/bin;isign -c /www/wwwroot/www.371.li/public/spcer/liufuqiang/certificate.pem -k /www/wwwroot/www.371.li/public/spcer/liufuqiang/key.pem -p "/www/wwwroot/www.371.li/public/ios_movileprovision/cd13d338e78ba64814771ad97b97be5ae837fedb.mobileprovision"  -o /www/wwwroot/www.371.li/public/testIpa/cd13d338e78ba64814771ad97b97be5ae837fedbresigned.ipa "/www/wwwroot/www.371.li/public/upload/super_signature/20190824/8fe04df45a22b63156ebabbb064fcd5e.ipa" 2>&1',$out,$status);
        //exec('ping www.371.li 2>&1',$out);
        // exec('/www/wwwroot/www.371.li/test.sh 2>&1',$out,$status);
            var_dump($out);
    }

    public function upload(){

    	require_once(PLUGINS_PATH . '/qiniu/autoload.php');
    	//use Qiniu\Auth;
		// 引入上传类
		//use Qiniu\Storage\UploadManager;
		// 需要填写你的 Access Key 和 Secret Key
		$plugin = db('plugin')->where('name', '=', 'Qiniu')->find();
        $qiniu = json_decode($plugin['config'], true);
        //dump($qiniu);
        //die();
		$accessKey =$qiniu['accessKey'];
		$secretKey = $qiniu['secretKey'];
		$bucket = $qiniu['bucket'];
		// 构建鉴权对象
		$auth = new Auth($accessKey, $secretKey);
		// 生成上传 Token
		$token = $auth->uploadToken($bucket);
		// 要上传文件的本地路径
		$filePath = 'upload/super_signature_ipa/92730aca5c58216868418148e7114be4172a046eb8a83a8bcd2521e411736fabd1660a47.ipa';
		// 上传到七牛后保存的文件名
		$key = '92730'.md5('sedcef').'.ipa';
		// 初始化 UploadManager 对象并进行文件的上传。
		$uploadMgr = new UploadManager();
		// 调用 UploadManager 的 putFile 方法进行文件的上传。
		list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
		echo "\n====> putFile result: \n";
		if ($err !== null) {
		    var_dump($err);
		} else {
		    var_dump($ret['key']);
		}
    }

    public function alupload(){
    	//echo PLUGINS_PATH . '/qiniu/autoload.php';
    	//die();
    	require_once(PLUGINS_PATH.'/aliyun/autoload.php');

		// 阿里云主账号AccessKey拥有所有API的访问权限，风险很高。强烈建议您创建并使用RAM账号进行API访问或日常运维，请登录 https://ram.console.aliyun.com 创建RAM账号。
		$accessKeyId = "LTAIBUQrnfEHh9hH";
		$accessKeySecret = "PfipJYzbcfjVHUSTYEcA1Cgi0eQeUx";
		// Endpoint以杭州为例，其它Region请按实际情况填写。
		$endpoint = "https://oss-cn-huhehaote-internal.aliyuncs.com";
		// 存储空间名称
		$bucket= "bogosignb5";
		// 文件名称
		$object = "o_1dh1029i61nnj1vkvr5e1es.ipa";
		// <yourLocalFile>由本地文件路径加文件名包括后缀组成，例如/users/local/myfile.txt
		$filePath = "upload/super_signature_ipa/o_1dh1029i61nnj1vkvr5e1es51paja.ipa";

		try{
		    $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

		    $ossClient->uploadFile($bucket, $object, $filePath);
		} catch(OssException $e) {
		    printf(__FUNCTION__ . ": FAILED\n");
		    printf($e->getMessage() . "\n");
		    return;
		}
		print(__FUNCTION__ . ": OK" . "\n");
    }
}
