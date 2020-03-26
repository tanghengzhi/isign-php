<?php
# @Author: JokenLiu <Jason>
# @Date:   2018-01-29 11:31:54
# @Email:  190646521@qq.com
# @Project: Demon
# @Filename: UserPostedModel.php
# @Last modified by:   Jason
# @Last modified time: 2018-01-31 16:36:43
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
namespace app\user\model;

use think\Db;
use think\Model;

class UserPostedModel extends Model
{

    public function userPostedAdd($uid, $d)
    {
        if (!empty($d['appLogo'])) {
            $logo = $d['appLogo'];
        } else {
            $logo = '';
        }

        //查询是否存在相同包名应用
        $exits = db('user_posted')->where('bundle', '=', $d['identifier'])->where('is_open_super_sign',0)->where('id',$uid)->find();
        $er_logo = random_str(6);
        if ($exits) {
            $er_logo = $exits['er_logo'];
        }

        if(empty($d['provisionedDevices'])){
            $test_type = 2;
        }else{
            $test_type = 1;
        }

        $data = [
            'url' => $d['ipaFilePath'],
            'addtime' => time(),
            'name' => $d['appName'],
            'uid' => $uid,
            'way' => 0,   //0公开 1密码安装 2邀请安装
            'instructions' => '',//版本更新说明
            'introduce' => '',//应用介绍
            'version' => $d['version'],
            'big' => round($d['ipaSize'] / 1024 / 1024, 2),//应用大小
            'build' => $d['versionCode'],//编译版本号
            'bundle' => $d['identifier'],//文件包名
            'endtime' => (60 * 60 * 24 * 30) + time(),//结束时间
            'type' => $d['appType'],//0 android 1 ios 类型
            'img' => $logo,//文件包图片存储base64
            "er_img" => '',//二维码图片路径
            "er_logo" => $er_logo,//二维码标识
            "posted_id" => '',//合并id
            "url_name" => $d['appName'],//文件原文件名
            "test_type" => $test_type,//1内测版，2企业版
        ];

        $id = Db::name("user_posted")->insertGetId($data);
        return $id;
    }

}
