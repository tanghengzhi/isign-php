<?php

namespace app\user\controller;

use cmf\controller\BaseController;
use cmf\controller\HomeBaseController;
use think\Db;

class CertificateController extends HomeBaseController
{

    //证书管理
    public function index()
    {
        if (!cmf_is_user_login()) {
            $this->error('请先登录后操作！');
            exit;
        }

        $uid = session('user.id');
        $where = 'user_id=' . $uid;
        $list = Db::name('ios_certificate')
            ->where($where)
            ->order("create_time DESC")
            ->paginate(20);
        // 获取分页显示
        $page = $list->render();

        $this->assign("page", $page);
        $this->assign("list", $list);
        return $this->fetch();
    }

    //添加证书
    public function add_certificate()
    {

        return $this->fetch();
    }

    //提交证书
    public function save_certificate()
    {
        if (!cmf_is_user_login()) {
            $this->error('请登录后再操作！');
            exit;
        }

        $uid = session("user.id");
        $team_id = input('param.team_id');
        $iss = input('param.iss');
        $kid = input('param.kid');
        $tid = input('param.tid');
        $p12_pwd = input('param.p12_pwd');
        $mark = trim(input('param.mark'));

        $record = db('ios_certificate')->where('tid', $team_id)->find();
        if ($record) {
            $this->error('该证书已存在！');
            exit;
        }
        $data = [
            'type' => 0,
            'user_id' => $uid,
            'team_id' => $team_id,
            'iss' => $iss,
            'kid' => $kid,
            'tid' => $tid,
            'p12_pwd' => $p12_pwd,
            'create_time' => time(),
            'mark' => $mark,
            'status' => 1,
            'limit_count'=>100,
            'total_count'=>0,
        ];

        // 获取表单上传文件 例如上传了001.jpg
        $p12_file = request()->file('p12_file');
        $p8_file = request()->file('p8_file');

        if (!$p12_file || !$p8_file) {
            $this->error('请上传p12或p8文件！');
            exit;
        }

        $p8_info = $p8_file->validate(['size' => 15678, 'ext' => 'p12,p8'])->move(ROOT_PATH . 'public' . DS . 'certificate' . DS . $team_id);

        if ($p8_info) {
            // 成功上传后 获取上传信息
            $p8_file_path = DS . 'certificate' . DS . $team_id . DS . $p8_info->getSaveName();
        } else {
            // 上传失败获取错误信息
            $this->error($p8_info->getError());
            exit;
        }

        // 移动到框架应用根目录/public/uploads/ 目录下
        $p12_info = $p12_file->validate(['size' => 15678, 'ext' => 'p12,p8'])->move(ROOT_PATH . 'public' . DS . 'certificate' . DS . $team_id);
        if ($p12_info) {
            // 成功上传后 获取上传信息
            $p12_file_path = DS . 'certificate' . DS . $team_id . DS . $p12_info->getSaveName();
        } else {
            // 上传失败获取错误信息
            $this->error($p12_info->getError());
            exit;
        }

        $data['p12_file'] = $p12_file_path;
        $data['p8_file'] = $p8_file_path;

        db('ios_certificate')->insert($data);
        $this->success('添加成功！');

    }

    //添加证书
    public function edit_certificate()
    {
        if (!cmf_is_user_login()) {
            $this->error('请登录后再操作！');
            exit;
        }

        $id = input('param.id');
        $uid = session("user.id");

        $certificate = db('ios_certificate')->where('user_id=' . $uid)->find($id);
        if (!$certificate) {
            $this->error('证书不存在！');
            exit;
        }

        $this->assign('certificate', $certificate);
        return $this->fetch();
    }

    //编辑保存
    public function edit_certificate_post()
    {
        if (!cmf_is_user_login()) {
            $this->error('请登录后再操作！');
            exit;
        }

        $id = input('param.id');
        $uid = session("user.id");

        $team_id = input('param.team_id');
        $iss = input('param.iss');
        $kid = input('param.kid');
        $tid = input('param.tid');
        $p12_pwd = input('param.p12_pwd');
        $mark = trim(input('param.mark'));

        $data = [
            'type' => 0,
            'user_id' => $uid,
            'team_id' => $team_id,
            'iss' => $iss,
            'kid' => $kid,
            'tid' => $tid,
            'p12_pwd' => $p12_pwd,
            'create_time' => time(),
            'mark' => $mark,
        ];

        // 获取表单上传文件 例如上传了001.jpg
        $p12_file = request()->file('p12_file');
        $p8_file = request()->file('p8_file');

        if ($p12_file) {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $p12_info = $p12_file->validate(['size' => 15678, 'ext' => 'p12,p8'])->move(ROOT_PATH . 'public' . DS . 'certificate' . DS . $team_id);
            if ($p12_info) {
                // 成功上传后 获取上传信息
                $p12_file_path = DS . 'certificate' .DS.$team_id. DS . $p12_info->getSaveName();
            } else {
                // 上传失败获取错误信息
                $this->error($p12_info->getError());
                exit;
            }
            $data['p12_file'] = $p12_file_path;
        }

        if ($p8_file) {
            $p8_info = $p8_file->validate(['size' => 15678, 'ext' => 'p12,p8'])->move(ROOT_PATH . 'public' . DS . 'certificate' . DS . $team_id);

            if ($p8_info) {
                // 成功上传后 获取上传信息
                $p8_file_path = DS . 'certificate' .DS.$team_id. DS . $p8_info->getSaveName();
            } else {
                // 上传失败获取错误信息
                $this->error($p8_info->getError());
                exit;
            }
            $data['p8_file'] = $p8_file_path;
        }

        db('ios_certificate')->where('id', $id)->where('user_id', '=', $uid)->update($data);
        $this->success('编辑成功！');

    }
}