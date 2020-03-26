<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace app\user\controller;

use cmf\controller\HomeBaseController;
use think\Validate;
use think\Db;
use AlibabaCloud\Client\AlibabaCloud;

class VerificationCodeController extends HomeBaseController
{
    public function send()
    {
        $validate = new Validate([
            'username' => 'require',
        ]);

        $validate->message([
            'username.require' => '请输入手机号或邮箱!',
        ]);

        $data = $this->request->param();
        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }

        $accountType = '';

        if (Validate::is($data['username'], 'email')) {
            $accountType = 'email';
        } else if (preg_match('/(^(13\d|15[^4\D]|17[0135678]|18\d)\d{8})$/', $data['username'])) {
            $accountType = 'mobile';
        } else {
            $this->error("请输入正确的手机或者邮箱格式!");
        }

        //TODO 限制 每个ip 的发送次数

        $code = cmf_get_verification_code($data['username']);
       // print_r($data['username']);exit;
        if (empty($code)) {
            $this->error("验证码发送过多,请明天再试!");
        }

        if ($accountType == 'email') {

            $emailTemplate = cmf_get_option('email_template_verification_code');

            $user     = cmf_get_current_user();
            $username = empty($user['user_nickname']) ? $user['user_login'] : $user['user_nickname'];

            $message = htmlspecialchars_decode($emailTemplate['template']);
            $message = $this->display($message, ['code' => $code, 'username' => $username]);
            $subject = empty($emailTemplate['subject']) ? 'ThinkCMF验证码' : $emailTemplate['subject'];
            $result  = cmf_send_email($data['username'], $subject, $message);

            if (empty($result['error'])) {
                cmf_verification_code_log($data['username'], $code);
                $this->success("验证码已经发送成功!");
            } else {
                $this->error("邮箱验证码发送失败:" . $result['message']);
            }

        } else if ($accountType == 'mobile') {
            $config = get_config();
            if($config['system_type']==1){
                $gets = $this->alicode($data['username'],$code);
                if($gets['Message']=='OK'){
                    cmf_verification_code_log($data['username'], $code);
                    $rs['code']=0;
                    $rs['msg']='验证码已经发送成功!';
                }else{
                    $rs['code']=1002;
                    $rs['msg']=$gets['SubmitResult']['msg'];
                }
            }else{
                //互亿无线
                $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
                $key=Db::name('config')->where("code='system_sms_key'")->field("val")->find();
                $key_id=Db::name('config')->where("code='system_sms_id'")->field("val")->find();

                $post_data = "account=".$key['val']."&password=".$key_id['val']."&mobile=".$data['username']."&content=".rawurlencode("您的验证码是：".$code."。请不要把验证码泄露给其他人。");
                //密码可以使用明文密码或使用32位MD5加密
                $gets = $this->xml_to_array($this->Post($post_data, $target));


                if($gets['SubmitResult']['code']==2){
                    cmf_verification_code_log($data['username'], $code);
                    $rs['code']=0;
                    $rs['msg']='验证码已经发送成功!';
                }else{
                    $rs['code']=1002;
                    $rs['msg']=$gets['SubmitResult']['msg'];
                }
            }
            return $rs;

        }


    }
    public function Post($curlPost,$url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $return_str = curl_exec($curl);
        curl_close($curl);
        return $return_str;
    }

    public function xml_to_array($xml){
        $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
        if(preg_match_all($reg, $xml, $matches)){
            $count = count($matches[0]);
            for($i = 0; $i < $count; $i++){
                $subxml= $matches[2][$i];
                $key = $matches[1][$i];
                if(preg_match( $reg, $subxml )){
                    $arr[$key] = $this->xml_to_array( $subxml );
                }else{
                    $arr[$key] = $subxml;
                }
            }
        }
        return $arr;
    }

    public function alicode($mobile,$code){
        
        require_once(PLUGINS_PATH . 'alicloud/autoload.php');

        // Download：https://github.com/aliyun/openapi-sdk-php
        // Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md
        $config = get_config();
        
        $accessKeyId = $config['aliyun_access_key_id'];//'LTAI4FfaRAyJbhk1iVpSVyeD';
        $accessSecret = $config['aliyun_access_secret'];//'zzSnqGM6ky43ReiRTPp5ZDcAfe41fb';
        //$PhoneNumbers = ;
        $SignName = $config['aliyun_sms_sign'];
        $TemplateCode = $config['aliyun_sms_tpl_id'];
        //$TemplateParam = ;
        AlibabaCloud::accessKeyClient($accessKeyId, $accessSecret)
                                ->regionId('cn-hangzhou')
                                ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                                  ->product('Dysmsapi')
                                  // ->scheme('https') // https | http
                                  ->version('2017-05-25')
                                  ->action('SendSms')
                                  ->method('POST')
                                  ->host('dysmsapi.aliyuncs.com')
                                  ->options([
                                                'query' => [
                                                  'RegionId' => "cn-hangzhou",
                                                  'PhoneNumbers' => "$mobile",
                                                  'SignName' => "$SignName",
                                                  'TemplateCode' => "$TemplateCode",
                                                  'TemplateParam' => "{\"code\":$code}",
                                                ],
                                            ])
                                  ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        }
    }
}
