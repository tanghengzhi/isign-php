<?php


namespace app\admin\controller;


use cmf\controller\AdminBaseController;
use think\Db;

class CertificateController extends AdminBaseController
{

    //证书管理
    public function index()
    {
        $where = [];
        /**搜索条件**/
        $team_id = $this->request->param('team_id');

        if ($team_id) {
            $where['team_id'] = ['like', "%$team_id%"];
        }

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
        $userAll = db('user')->where(['user_type'=>2,'user_status'=>1])->order('id desc')->select();
        $this->assign('userAll',$userAll);
        return $this->fetch();

    }

    //编辑证书
    public function edit_certificate()
    {
        $id = input('param.id');
        $certificate = db('ios_certificate')->find($id);
        if (!$certificate) {
            $this->error('证书不存在！');
            exit;
        }
        $userAll = db('user')->where(['user_type'=>2,'user_status'=>1])->order('id desc')->select();
        $this->assign('userAll',$userAll);
        $this->assign('certificate', $certificate);
        return $this->fetch();
    }

    //编辑保存
    public function edit_certificate_post()
    {

        $id = input('param.id');

        $team_id = input('param.team_id');
        $iss = input('param.iss');
        $kid = input('param.kid');
        $tid = input('param.tid');
        $user_id = input('param.user_id');
        $p12_pwd = input('param.p12_pwd');
        $mark = trim(input('param.mark'));

        $data = [
            'type' => 1,
            'user_id' => $user_id,
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
                $p12_file_path = DS . 'certificate' . DS .$team_id. DS . $p12_info->getSaveName();
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
                $p8_file_path = DS . 'certificate' . DS  .$team_id. DS .$p8_info->getSaveName();
            } else {
                // 上传失败获取错误信息
                $this->error($p8_info->getError());
                exit;
            }
            $data['p8_file'] = $p8_file_path;
        }

        db('ios_certificate')->where('id', $id)->update($data);
        $this->success('编辑成功！');

    }

    //保存证书
    public function save_certificate()
    {
        $team_id = input('param.team_id');
        $iss = input('param.iss');
        $kid = input('param.kid');
        $tid = input('param.tid');
        $user_id = input('param.user_id');
        $p12_pwd = input('param.p12_pwd');
        $mark = trim(input('param.mark'));

        $record = db('ios_certificate')->where('tid', $team_id)->find();
        if ($record) {
            $this->error('该证书已存在！');
            exit;
        }
        $data = [
            'type' => 1,
            'user_id' => $user_id,
            'team_id' => $team_id,
            'iss' => $iss,
            'kid' => $kid,
            'tid' => $tid,
            'p12_pwd' => $p12_pwd,
            'create_time' => time(),
            'mark' => $mark,
            'total_count' => 100,
            'limit_count' => 100,
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
            $p8_file_path = DS . 'certificate' . DS .$team_id. DS . $p8_info->getSaveName();
        } else {
            // 上传失败获取错误信息
            $this->error($p8_info->getError());
            exit;
        }

        // 移动到框架应用根目录/public/uploads/ 目录下
        $p12_info = $p12_file->validate(['size' => 15678, 'ext' => 'p12,p8'])->move(ROOT_PATH . 'public' . DS . 'certificate' . DS . $team_id);
        if ($p12_info) {
            // 成功上传后 获取上传信息
            $p12_file_path = DS . 'certificate' . DS .$team_id. DS . $p12_info->getSaveName();
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

    public function certificate_status(){
        $id = input('param.id');
        $info = db('ios_certificate')->find($id);
        if($info['status']==1){
            db('ios_certificate')->where('id',$id)->update(['status'=>0]);
        }else{
            db('ios_certificate')->where('id',$id)->update(['status'=>1]);
        }
        $this->success('操作成功！');
    }

    public function certificate_del(){
        $id = input('param.id');
        db('ios_certificate')->where('id',$id)->delete();
        $this->success('删除成功！');
    }

}