<?php
# @Author: JokenLiu <Jason>
# @Date:   2018-01-19 22:50:12
# @Email:  190646521@qq.com
# @Project: Demon
# @Filename: InstallController.php
# @Last modified by:   Jason
# @Last modified time: 2018-03-22 16:57:31
# @License: 北京乐维世纪网络科技有限公司开发者协议
# @Copyright: DemonLive


//下载页面
namespace app\user\controller;

use cmf\controller\HomeBaseController;
use MingYuanYun\AppStore\Client;
use think\Db;
use cmf\controller\BaseController;
use think\View;
use think\Request;
use think\Response;
use cmf\controller\UserBaseController;
use app\user\model\UserModel;
use OSS\OssClient;
use OSS\Core\OssException;
class InstallController extends HomeBaseController
{

    public function index()
    {
        $is_ios = $this->get_device_type();
        $config = get_config();
        //$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        $request_url = substr($_SERVER['REQUEST_URI'], 1);
        $urlall = explode('?', $request_url);
        $url = $urlall[0];
        
        $num = strlen($url);
        if ($num > 6) {
            $arr = explode('?', $url);
            $url = $arr[0];
        }

        $user_posted = Db::name("user_posted");
        // $result=$user_posted->where("er_logo='$url' er_logoand endtime > ".time())->find();//加入到期时间
        $resultOld = $user_posted->where("er_logo='$url'")->find();//未加入到期时间
        $res = db('user')->find($resultOld['uid']);
        if($res['user_status']==0){
            echo '<h1 style="text-align: center;">应用被禁用</h1>';
            exit;
        }
        
        if (!$resultOld) {
            $this->success('该应用不存在或已过期...', '/', 3);
        }
        $uid = $resultOld['uid'];

        $where = "uid=$uid and type='" . $resultOld['type'] . "' and bundle='" . $resultOld['bundle'] . "'";
        $result = $user_posted->where($where)->order('addtime desc')->find();
        if (!$result) {
            echo '项目已到期，请联系管理员续费！';
            die();
        }
        $safari = 1;
        if($resultOld['is_open_super_sign']==1){
            $agent = $_SERVER['HTTP_USER_AGENT'];
            
            if(stripos($agent, 'qq') || stripos($agent, 'android') || !stripos($agent, 'safari')){
                $safari = 2;
            }
            
            $userInfo = db('user')->find($resultOld['uid']);
            if($resultOld['download_type']==1){
                if($userInfo['sup_down_public']<=0){
                    echo '项目公有池下载量不足，请联系管理员续费！';
                    die();
                }
            }else{
                if($userInfo['sup_down_prive']<=0){
                    echo '项目私有池下载量不足，请联系管理员续费！';
                    die();
                }
            }
            
            if($resultOld['only_download']==1){
                if(empty($urlall[1])){
                    echo '<h1 style="text-align: center;">该链接已失效请联系管理员获取！</h1>';
                    exit;
                }
                session('super_link_on',$urlall[1]);
            }
        }
        

        //echo $user_posted->getLastSql();die();
        if ($result['type'] !== $is_ios and $result['posted_id'] != '' and $is_ios != 'other') {
            $result = Db::name("user_posted")->where("id=" . $result['posted_id'] . " and endtime>" . time())->find();
        }
        $is_wx = $this->is_weixin();
        $qq = $this->is_qq();
        //$ym_url=explode('/D',$result['er_logo']);
        // $ios="itms-services://?action=download-manifest&url=".$this->downfile_ios($result);

        $result['ym_url'] = $result['er_logo'];
        $result['www_url'] = 'http://' . $_SERVER['HTTP_HOST'];
        $result['www_urls'] = 'https://' . $_SERVER['HTTP_HOST'];
        if($resultOld['only_download']==1){
            $result['er_logo'] = $result['www_url'] . '/' . $result['ym_url'].'?'.$urlall[1];  
        }else{
          $result['er_logo'] = $result['www_url'] . '/' . $result['ym_url'];  
        }

        //var_dump($result);die();

        $this->assign('result', $result);
        $this->assign('is_qq', $qq);
        $this->assign('is_wx', $is_wx);
        $this->assign('is_ios', $is_ios);
	

        $str = '<?xml version="1.0" encoding="UTF-8"?>
        <!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
        <plist version="1.0">
            <dict>
                <key>items</key>
                <array>
                    <dict>
                        <key>assets</key>
                        <array>
                            <dict>
                                <key>kind</key>
                                <string>software-package</string>
                                <key>url</key>
                                <string>' . $result["url"] . '</string>
                            </dict>
                        </array>
                        <key>metadata</key>
                        <dict>
                            <key>bundle-identifier</key>
                            <string>' . $result["bundle"] . '</string>
                            <key>bundle-version</key>
                            <string>' . $result["version"] . '</string>
                            <key>kind</key>
                            <string>software</string>
                            <key>title</key>
                            <string>' . $result["name"] . '</string>
                        </dict>
                    </dict>
                </array>
            </dict>
        </plist>';

        $filename = APP_ROOT . DS . 'upload' . DS . 'plist' . DS . md5($result['url']) . '.plist';

        if (!file_exists($filename) && $is_ios === 0) {
            $myfile = fopen($filename, "w") or die("Unable to open file!");
            fwrite($myfile, $str);
            fclose($myfile);
        }
        $this->assign('safari',$safari);
        $this->assign('config',$config);
    	trace("safari=".$safari);
        //echo $safari;
        $this->assign('ios', $result['www_urls'] . "/upload/plist/" . md5($result['url']) . ".plist");
        return $this->fetch('index_new');
    }

    //免责声明
    public function disclaimer()
    {
        return $this->fetch();
    }

    //举报应用
    public function report()
    {
        $this->assign('app_id', input('app_id'));
        return $this->fetch();
    }

    //提交举报信息
    public function add_report_post()
    {
        $app_id = intval(input('param.app_id'));
        $email = trim(input('param.email'));
        $reason = trim(input('param.reason'));
        $content = trim(input('param.content'));

        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        if (!$file) {
            $this->error('请上传证据文件！');
            exit;
        }
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->validate(['size' => 1024 * 1024 * 3, 'ext' => 'jpg,png,gif,zip,jpeg'])->move(ROOT_PATH . 'public' . DS . 'upload' . DS . 'report_reason');
        if ($info) {
            // 成功上传后 获取上传信息
            $file_path = DS . 'uploads' . DS . 'report_reason' . DS . $info->getSaveName();
        } else {
            $this->error('上传文件失败 错误：' . $file->getError());
            exit;
        }

        $data = [
            'app_id' => $app_id,
            'email' => $email,
            'reason' => $reason,
            'content' => $content,
            'file' => $file_path,
            'create_time' => time()
        ];

        db('report_record')->insert($data);
        $this->success('举报成功,感谢您的反馈！');
    }

    //判断是否在微信中打开
    public function is_weixin()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        } else {
            return false;
        }
    }

    //判断是否在qq打开
    public function is_qq()
    {
        $sUserAgent = strtolower($_SERVER["HTTP_USER_AGENT"]);
        //echo $sUserAgent;die();
        if (strpos($sUserAgent, "qq") !== false) {
            if (strpos($sUserAgent, "mqqbrowser") !== false && strpos($sUserAgent, "pa qq") === false || (strpos($sUserAgent, "qqbrowser") !== false && strpos($sUserAgent, "mqqbrowser") === false)) {
                return false;
            } else {
                return true;
            }
            //return true;
        } else {
            return false;
        }
    }

    //判断手机类型
    public function get_device_type()
    {
        //全部变成小写字母
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $type = 'other';
        //分别进行判断
        if (strpos($agent, 'iphone') || strpos($agent, 'ipad')) {
            $type = 0;
        }

        if (strpos($agent, 'android')) {
            $type = 1;
        }
        return $type;
    }

    //ios下载
    public function downfile_ios()
    {

        //$url=$_SERVER['HTTP_REFERER'];
        $url = $_GET['id'];
        //  $url='http://y14.com/D614';
        $result = Db::name("user_posted")->where("er_logo='$url' and endtime>" . time())->find();
        $this->assign('result', $result);
        echo $this->fetch('../app/user/view/install/downfile_ios.xml');
        exit;
    }

    //下载数据
    public function buts()
    {
        $id = $_POST['id'];
        $postedinfo = Db::name("user_posted")->where("id=$id")->find();
        $uid = $postedinfo['uid'];
        $userinfo = Db::name("user")->where("id=$uid")->find();

        //$type=$this->downfile_type($id,$uid,$userinfo['downloads']);
        //echo $type;
        //echo $id;die();
        if ($userinfo['downloads'] > 0) {
            //$ip=Request::instance()->ip();
            //$uid=session('user.id');

            $data = array(
                'uid' => $uid,
                'posted_id' => $id,
                'creattime' => time()
            );
            $result = Db::name("user_posted_log")->insertGetId($data);
            //下载次数减1
            Db::name("user")->where("id=$uid")->setDec('downloads');
            //echo Db::name("user_posted_log")->getLastSql();die();
            //echo $id;die();
            return $result ? '1' : '0';
        } else {
            return '3';
        }
    }

    public function downfile_type($id, $uid, $downloads)
    {
        $down = Db::name("user_posted_log")->join("user_posted b", "b.id=a.posted_id")->alias("a")->where("b.uid=$uid")->count();

        if ($downloads > $down) {
            $type = "1";
        } else {
            $type = "0";
        }
        return $type;
    }


    //获取UDID
    public function get_udid()
    {
        $data = file_get_contents('php://input');

        //file_put_contents('./udid.txt', $data);
        $plistBegin = '<?xml version="1.0"';
        $plistEnd = '</plist>';
        $pos1 = strpos($data, $plistBegin);
        $pos2 = strpos($data, $plistEnd);
        $data2 = substr($data, $pos1, $pos2 - $pos1);
        $xml = xml_parser_create();
        xml_parse_into_struct($xml, $data2, $vs);
        xml_parser_free($xml);
        $UDID = "";
        $CHALLENGE = "";
        $DEVICE_NAME = "";
        $DEVICE_PRODUCT = "";
        $DEVICE_VERSION = "";
        $iterator = 0;
        $arrayCleaned = array();
        foreach ($vs as $v) {
            if ($v['level'] == 3 && $v['type'] == 'complete') {
                $arrayCleaned[] = $v;
            }
            $iterator++;
        }
        $data = "";
        $iterator = 0;
        foreach ($arrayCleaned as $elem) {
            $data .= "\n==" . $elem['tag'] . " -> " . $elem['value'] . "<br/>";
            switch ($elem['value']) {
                case "CHALLENGE":
                    $CHALLENGE = $arrayCleaned[$iterator + 1]['value'];
                    break;
                case "DEVICE_NAME":
                    $DEVICE_NAME = $arrayCleaned[$iterator + 1]['value'];
                    break;
                case "PRODUCT":
                    $DEVICE_PRODUCT = $arrayCleaned[$iterator + 1]['value'];
                    break;
                case "UDID":
                    $UDID = $arrayCleaned[$iterator + 1]['value'];
                    break;
                case "VERSION":
                    $DEVICE_VERSION = $arrayCleaned[$iterator + 1]['value'];
                    break;
            }
            $iterator++;
        }

        $app_id = intval(input('param.app_id'));

        $this->redirect(get_site_url() . "/user/install/udid_redirect?udid=" . $UDID . '&app_id=' . $app_id, 301);

    }

    //超级签名下载
    public function ios_install()
    {
        $is_ios = $this->get_device_type();

        //$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        //$udid = input('param.udid');
        $url = input('param.sup_id');
        $cid = input('param.c_id');

        $user_posted = Db::name("user_posted");
        // $result=$user_posted->where("er_logo='$url' er_logoand endtime > ".time())->find();//加入到期时间
        $resultOld = db('super_signature_ipa')
                    ->alias('s')
                    ->join('user_posted p','p.id=s.appid')
                    ->where(['s.id'=>$url])
                    ->field('p.*')
                    ->find();//未加入到期时间
        $sup = db('super_signature_ipa')->find($url);
        $udid = $sup['udid'];
        
        if (!$resultOld) {
            $this->success('该应用不存在或已过期...', '/', 3);
        }
        $uid = $resultOld['uid'];
        $where = "uid=$uid and type='" . $resultOld['type'] . "' and bundle='" . $resultOld['bundle'] . "'";
        $result = $user_posted->where($where)->order('addtime desc')->find();
        $result['url'] = $sup['supurl'];
        if (!$result) {
            echo '项目已到期，请联系管理员续费！';
            die();
        }
        //echo $user_posted->getLastSql();die();
        //删除正在打包
        $downloading = db('downloading')->select()->toArray();
        if(!empty($downloading)){
            db('downloading')->delete($downloading[0]['id']);
        }

        if ($result['type'] !== $is_ios and $result['posted_id'] != '' and $is_ios != 'other') {
            $result = Db::name("user_posted")->where("id=" . $result['posted_id'] . " and endtime>" . time())->find();
        }
        $is_wx = $this->is_weixin();
        $qq = $this->is_qq();
        //$ym_url=explode('/D',$result['er_logo']);
        // $ios="itms-services://?action=download-manifest&url=".$this->downfile_ios($result);

        $result['ym_url'] = $result['er_logo'];
        $result['www_url'] = 'http://' . $_SERVER['HTTP_HOST'];
        $result['er_logo'] = $result['www_url'] . '/' . $result['ym_url'];
        $result['www_urls'] = 'https://' . $_SERVER['HTTP_HOST'];

        //var_dump($result);die();

        $this->assign('result', $result);
        $this->assign('is_qq', $qq);
        $this->assign('is_wx', $is_wx);
        $this->assign('is_ios', $is_ios);

        //更新证书udid数量
        include PLUGINS_PATH . "/ipaphp/vendor/autoload.php";
        include PLUGINS_PATH . "/ipaphp/vendor/yunchuang/appstore-connect-api/src/Client.php";

        //查询可用证书 TODO 证书是否可用，剩余udid次数是否足够 剩余设备不小于100

        $certificate_record = db('ios_certificate')->find($cid);
        if (!$certificate_record) {
            echo '没有可用证书！';
            exit;
        }

        $config = [
            'iss' => $certificate_record['iss'],
            'kid' => $certificate_record['kid'],
            'secret' => APP_ROOT . $certificate_record['p8_file']
        ];
        $client = new Client($config);

        // get jwt auth token, expired after 20 minutes later
        $token = $client->getToken();

        // set request auth header
        $headers = [
            'Authorization' => 'Bearer ' . $token,
        ];
        $client->setHeaders($headers);
        $queryParams = [
           'filter[platform]' => 'IOS'
        ];
        $devices = $client->api('device')->all($queryParams);

        $total_count = $devices['meta']['paging']['total'];
        $limit_count =100-$devices['meta']['paging']['total'];
        //更新总设备数，剩余设备数
        db('ios_certificate')->where('id',$cid)->update(['limit_count'=>$limit_count,'total_count'=>$total_count]);
        //更新下载次数
        $userInfo = db('user')->find($resultOld['uid']);
        //判断设备
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        //$type = 'other';
        //分别进行判断
        if (strpos($agent, 'iphone')) {
            $device = 'iphone';
        }else if(strpos($agent, 'ipad')){
            $device = 'ipad';
        }else{
            $device = '';
        }

        //查询证书是否添加过该UDID
        /*$queryParamsUdid = [
            'filter[udid]' => $udid,
            'limit' => 1
        ];

        $device_info = $client->api('device')->all($queryParamsUdid);*/
        $super_download = db('super_download_log')->where(['app_id'=>$resultOld['id'],'udid'=>$udid])->find();
        if($resultOld['download_type']==1){
            if(!$super_download){
                Db::name("user")->where("id=$uid")->setDec("sup_down_public");
            }
            //添加下载记录
            $dowlog = [
                'uid'=>$resultOld['uid'],
                'app_id'=>$resultOld['id'],
                'udid'=>$udid,
                'cid'=>$cid,
                'addtime'=>time(),
                'device'=>$device,
                'type'=>1,
                'ip'=>$this->getIp()
            ];
        }else{
            if(!$super_download){
               Db::name("user")->where("id=$uid")->setDec("sup_down_prive"); 
            }
            $dowlog = [
                'uid'=>$resultOld['uid'],
                'app_id'=>$resultOld['id'],
                'udid'=>$udid,
                'cid'=>$cid,
                'addtime'=>time(),
                'device'=>$device,
                'type'=>2,
                'ip'=>$this->getIp()
            ];
        }
        db('super_download_log')->insert($dowlog);

        $str = '<?xml version="1.0" encoding="UTF-8"?>
        <!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
        <plist version="1.0">
            <dict>
                <key>items</key>
                <array>
                    <dict>
                        <key>assets</key>
                        <array>
                            <dict>
                                <key>kind</key>
                                <string>software-package</string>
                                <key>url</key>
                                <string>' . $result["url"] . '</string>
                            </dict>
                        </array>
                        <key>metadata</key>
                        <dict>
                            <key>bundle-identifier</key>
                            <string>' . $result["bundle"] . '</string>
                            <key>bundle-version</key>
                            <string>' . $result["version"] . '</string>
                            <key>kind</key>
                            <string>software</string>
                            <key>title</key>
                            <string>' . $result["name"] . '</string>
                        </dict>
                    </dict>
                </array>
            </dict>
        </plist>';

        $filename = APP_ROOT . DS . 'upload' . DS . 'udidplist' . DS . $udid.'_'.md5($url) . '.plist';

        if (!file_exists($filename) && $is_ios === 0) {
            $myfile = fopen($filename, "w") or die("Unable to open file!");
            fwrite($myfile, $str);
            fclose($myfile);
        }

        $this->assign('ios', $result['www_urls'] . "/upload/udidplist/" . $udid.'_'.md5($url) . ".plist");

        return $this->fetch();
    }

    //下载描述文件
    public function getudid_mobileconfig()
    {
    	trace('测试');
        $app_id = intval(input('param.id'));
        $http = 'https://'.$_SERVER['HTTP_HOST'];
        
        /*echo "<script> 
            window.location.href =  '/ios_describe/{$app_id}.mobileconfig';
             setTimeout(function() {
                window.location.href = '".$http."/mobileprovision/embedded1.mobileprovision';
            }, 3000);
        </script>";*/
        $config = get_config();
        $count = db('downloading')->count();
        // trace($config.$count);
        $num = '';
        if($count>=$config['down_max_num']){
            $data = ['code'=>2,'msg'=>'正在排队请稍后获取！'];
            echo json_encode($data);
            exit;
        }else{
            //添加排队记录
            $rou = rand(1111,9999);
            $time = time();
            $num = $rou.$time;
            $add = [
                'appid'=>$app_id,
                'addtime'=>$time,
                'num'=>$num,
            ];
            db('downloading')->insert($add);
        }
        
        /*echo $count;
        exit;*/
        $location_href = "window.location.href =  '/ios_describe/{$app_id}.mobileconfig';
             setTimeout(function() {
                window.location.href = '".$http."/mobileprovision/embedded1.mobileprovision';
            }, 3000);";
        $data = ['code'=>1,'location_href'=>$location_href,'appid'=>$app_id,'http'=>$http,'id'=>$num];
        echo json_encode($data);
    }


    //UDID 301回调
    public function udid_redirect()
    {
		
        $udid = $_REQUEST['udid'];
      	//file_put_contents('./udida.txt', 22);
        $app_id = $_REQUEST['app_id'];
        //查询该APP剩余的设备下载数
        $app = db('user_posted')->find($app_id);
        if (!$app) {
            echo '内部错误！';
            exit;
        }

        // require_once("./vendor/autoload.php");
        include PLUGINS_PATH . "/ipaphp/vendor/autoload.php";
        include PLUGINS_PATH . "/ipaphp/vendor/yunchuang/appstore-connect-api/src/Client.php";
        //查询是否添加过udid
        $add_udid_log = db('ios_udid_list')->where(['udid'=>$udid,'app_id'=>$app_id])->find();
        if($add_udid_log){
            $certificate_record = db('ios_certificate')->find($add_udid_log['certificate']);
            if(!$certificate_record){
                //查询可用证书 TODO 证书是否可用，剩余udid次数是否足够 剩余设备不小于100。limit_count剩余设备数
                if($app['download_type']==1){
                    $certificate_record = db('ios_certificate')->where('user_id', '=', 1)->where('limit_count >0')->where('status',1)->find();
                }else{
                    $certificate_record = db('ios_certificate')->where('user_id', '=', $app['uid'])->where('limit_count >0')->where('status',1)->find();
                }
            }
        }else{
            //查询可用证书 TODO 证书是否可用，剩余udid次数是否足够 剩余设备不小于100。limit_count剩余设备数
            if($app['download_type']==1){
                $certificate_record = db('ios_certificate')->where('user_id', '=', 1)->where('limit_count >0')->where('status',1)->find();
            }else{
                $certificate_record = db('ios_certificate')->where('user_id', '=', $app['uid'])->where('limit_count >0')->where('status',1)->find();
            }
        }
        
        if (!$certificate_record) {
            echo '没有可用证书！';
            exit;
        }

        $config = [
            'iss' => $certificate_record['iss'],
            'kid' => $certificate_record['kid'],
            'secret' => APP_ROOT . $certificate_record['p8_file']
        ];
        $client = new Client($config);

        // get jwt auth token, expired after 20 minutes later
        $token = $client->getToken();

        // set request auth header
        $headers = [
            'Authorization' => 'Bearer ' . $token,
        ];
        $client->setHeaders($headers);

        // query devices 通过

//        $devices = $client->api('device')->all();
//
//        $total = 100 - count($devices['data']);
//        $limit = 100 - $total;
//        //更新该证书的剩余数量
//        db('ios_certificate')->where('id', $certificate['id'])
//            ->update(['total_count' => $total, 'limit_count' => $limit]);

        $bId = ''; #这里不是bid，而是列表的id
        $name = make_password(8);#每次不能重复
        $profileType = 'IOS_APP_ADHOC';
        $devices = [];
        $certificates = [
            $certificate_record['tid'],
        ];

        //新的Bundle ID
        $bundleId = $app['bundle'] . $certificate_record['tid'];
        //查询BID
        $params = [
            'fields[bundleIds]' => 'identifier',
            'filter[identifier]' => $bundleId
        ];
        $bid_result = $client->api('bundleId')->all($params);
        if (!$bid_result['data']) {
            //创建包名
            $platform = 'IOS';
            $result = $client->api('bundleId')->register($name, $platform, $bundleId);

            if (!isset($result['data'])) {
                echo '创建包名失败！';
                exit;
            }
            $bId = $result['data']['id'];
            
            $capability = 'PUSH_NOTIFICATIONS';
            $result = $client->api('bundleIdCapabilities')->enable($bId, $capability);
        } else {
            $bId = $bid_result['data'][0]['id'];
        }

        //查询证书是否添加过该UDID
        $queryParams = [
            'filter[udid]' => $udid,
            'limit' => 1
        ];

        $device_info = $client->api('device')->all($queryParams);

        if ($device_info['data']) {
            //已经添加过该UDID
            $devices[] = $device_info['data'][0]['id'];
        } else {
            if($app['only_download']==1){
                $user_link = db('user_link_log')->where('code',session('super_link_on'))->find();
                if($user_link['status']==1){
                    echo '下载链接失效，请联系管理员获取！';
                    exit;
                }else{
                    db('user_link_log')->where('code',session('super_link_on'))->update(['status'=>1]);
                }
            }
            
            //添加UDID
            $deviceName = $name;
            $platform = 'IOS';
            $deviceUdid = $udid;
            $result = $client->api('device')->register($deviceName, $platform, $deviceUdid);
            if (!isset($result['data'])) {
                echo '添加udid失败！';
                exit;
            }
            $devices[] = $result['data']['id'];
        }

        //查询是否添加过udid添加记录
        $udid_record = db('ios_udid_list')->where('udid="' . $udid . '" and certificate=' . $certificate_record['id'])->find();
        if (!$udid_record) {
            $add_udid_data = [
                'udid' => $udid,
                'app_id' => $app_id,
                'user_id' => $app['uid'],
                'certificate' => $certificate_record['id'],
                'create_time' => time(),
                'device' => $devices[0]
            ];
            //添加增加udid记录
            db('ios_udid_list')->insert($add_udid_data);
        }

        //更新UDID数量
        //$total_udid = 100 - $device_info['meta']['paging']['total'];
        //db('ios_certificate')->where('id=' . $certificate_record['id'])->update(['total_count' => $total_udid, 'limit_count' => (100 - $total_udid)]);

        //创建描述文件
        $result = $client->api('profiles')->create($name, $bId, $profileType, $devices, $certificates);

        if(empty($result['data']['attributes']['profileContent'])){
            $error_msg = $result['errors'][0]['detail'];
            echo '<h2>证书配置错误:'.$error_msg.'</h2>';
            exit;
        }
        $mobileprovision = base64_decode($result['data']['attributes']['profileContent']);
        file_put_contents("./ios_movileprovision/$udid.mobileprovision", $mobileprovision);
       
        
		//生成证书文件
        $absolute_path = config('absolute_path');

        exec('openssl pkcs12 -in '.$absolute_path.'public'.$certificate_record['p12_file'].' -out '.$absolute_path.'public/spcer/'.$certificate_record['id'].'certificate.pem -clcerts -nokeys -password pass:'.$certificate_record['p12_pwd']);
        exec('openssl pkcs12 -in '.$absolute_path.'public'.$certificate_record['p12_file'].' -out '.$absolute_path.'public/spcer/'.$certificate_record['id'].'key.pem -nocerts -nodes -password pass:'.$certificate_record['p12_pwd']);

     	$files = $absolute_path."public/ios_movileprovision/$udid.mobileprovision";

      	$ipa = $absolute_path."public/".$app['url'];

      	exec('export PATH=$PATH:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/root/bin;isign -c '.$absolute_path.'public/spcer/'.$certificate_record['id'].'certificate.pem -k '.$absolute_path.'public/spcer/'.$certificate_record['id'].'key.pem -p "'.$files.'"  -o '.$absolute_path.'public/upload/super_signature_ipa/'.$udid.md5($app['bundle']).$app['er_logo'].'.ipa "'.$ipa.'" 2>&1',$out,$status);
        //存储 super_signature_ipa
        //存储错误日志
        $ml = 'export PATH=$PATH:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/root/bin;isign -c '.$absolute_path.'public/spcer/'.$certificate_record['id'].'certificate.pem -k '.$absolute_path.'public/spcer/'.$certificate_record['id'].'key.pem -p "'.$files.'"  -o '.$absolute_path.'public/upload/super_signature_ipa/'.$udid.md5($app['bundle']).$app['er_logo'].'.ipa "'.$ipa.'" 2>&1';
		
        file_put_contents('./sign_error_log/'.$udid.$app['bundle'].time().'ml.txt',$ml);
        file_put_contents('./sign_error_log/'.$udid.$app['bundle'].time().'.txt',$out);
        

        $newname = md5($app['bundle']).$app['er_logo'];
        $surl = 'upload/super_signature_ipa/'.$udid.$newname.'.ipa';
        $param = [
                'filePath'=>$surl,
                'fileName'=>$udid.$newname.'.ipa',
            ];
        $supurl = $this->alupload($param);
        $supData = [
            'appid'=>$app_id,
            'supurl' =>$supurl,
            'udid' =>$udid,
            'addtime' =>time(),
        ];
        $sup_id = Db::name("super_signature_ipa")->insertGetId($supData);

      	//$ml =  'isign -c '.$absolute_path.'public/spcer/liufuqiang/certificate.pem -k /www/wwwroot/www.371.li/public/spcer/liufuqiang/key.pem -p "'.$files.'"  -o /www/wwwroot/www.371.li/public/testIpa/'.$udid.'resigned.ipa "'.$ipa.'" 2>&1'.'<br/>';
      	//
      	/*file_put_contents('./ml.txt', $ml);
      	dump($out);
      	die();*/
        //跳转下载页面
        $this->redirect(get_site_url() . "/user/install/ios_install?sup_id=" . $sup_id.'&c_id='.$certificate_record['id'], 301);
    }

    public function alupload($param){
        require_once(PLUGINS_PATH.'/aliyun/autoload.php');
        $config = get_config();
        $param['accessKeyId'] = $config['ali_save_access_key'];
        $param['accessKeySecret'] = $config['ali_save_access_secret'];
        $param['uploadUrl'] = $config['ali_save_upload_url'];
        $param['downUrl'] = $config['ali_save_down_url'];
        $param['bucket'] = $config['ali_save_bucket'];;

        /*$param['accessKeyId'] = "LTAIBUQrnfEHh9hH";
        $param['accessKeySecret'] = "PfipJYzbcfjVHUSTYEcA1Cgi0eQeUx";
        $param['uploadUrl'] = "https://oss-cn-huhehaote-internal.aliyuncs.com";
        $param['downUrl'] = "https://bogosignb5.oss-cn-huhehaote.aliyuncs.com";
        $param['bucket'] = "bogosignb5";*/
        //$param['filePath'] = "bogosignb5";
        //$param['fileName'] = "bogosignb5";
        // 阿里云主账号AccessKey拥有所有API的访问权限，风险很高。强烈建议您创建并使用RAM账号进行API访问或日常运维，请登录 https://ram.console.aliyun.com 创建RAM账号。
        $accessKeyId = $param['accessKeyId'];
        $accessKeySecret = $param['accessKeySecret'];
        // Endpoint以杭州为例，其它Region请按实际情况填写。
        $endpoint = $param['uploadUrl'];
        // 存储空间名称
        $bucket= $param['bucket'];
        // 文件名称
        $object = $param['fileName'];
        // <yourLocalFile>由本地文件路径加文件名包括后缀组成，例如/users/local/myfile.txt
        $filePath = $param['filePath'];

        try{
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            $ossClient->uploadFile($bucket, $object, $filePath);
        } catch(OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }
        return $param['downUrl'].'/'.$param['fileName'];
        //print(__FUNCTION__ . ": OK" . "\n");
    }

    public function getIp()
    {

        if(!empty($_SERVER["HTTP_CLIENT_IP"]))
        {
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        else if(!empty($_SERVER["REMOTE_ADDR"]))
        {
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        else
        {
            $cip = '';
        }
        preg_match("/[\d\.]{7,15}/", $cip, $cips);
        $cip = isset($cips[0]) ? $cips[0] : 'unknown';
        unset($cips);

        return $cip;
    }

    public function deldownloading(){
        $id = input('param.id');
        $res = db('downloading')->where('num',$id)->find();
        if($res){
            db('downloading')->where('num',$id)->delete();
        }
        exit;
    }

}
