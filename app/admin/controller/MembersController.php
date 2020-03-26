<?php
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
//会员管理
class MembersController extends AdminBaseController
{
    public function index()
    {
        if ($_POST) {
            session('members', $_POST);
        }
        if (!isset($_GET['page']) and empty($_POST)) {
            session('members', null);
        }
        $where = "user_type=2";
        $where .= session('members.id') ? " and id=" . session('members.id') : '';
        $where .= session('members.mobile') ? " and mobile='" . session('members.mobile') . "'" : '';
        $user = Db::name("user")->where($where)->paginate(10);

        $tmpUser = array();
        foreach ($user as &$v) {
            $id = $v['id'];
            $v['num'] = $this->cishu($id);
            $tmpUser[] = $v;
        }

        $this->assign('user', $tmpUser);
        $this->assign('members', session('members'));
        $this->assign('page', $user->render());
        return $this->fetch();
    }

    /*用户下载次数*/
    public function cishu($uid)
    {
        $daytime = Db::name("user_posted_log")->join("user_posted b", "b.id=a.posted_id")->alias("a")->where("b.uid=$uid")->count();
        return $daytime ? $daytime : '0';
    }

    /*文件下载次数*/
    public function file_num($id)
    {
        $daytime = Db::name("user_posted_log")->where("posted_id=$id")->count();
        return $daytime ? $daytime : '0';
    }

    //禁用
    public function upd()
    {
        $id = input('param.id');
        $data = array(
            'user_status' => input('param.user_status')
        );
        $user = Db::name("user")->where("id=$id")->update($data);
        if ($user) {
            $this->success("操作成功");
        } else {
            $this->success("操作失败");
        }
    }

    //文件详情
    public function sele()
    {
        if ($_POST) {
            session('sele', $_POST);
        }
        if (!isset($_GET['page']) and empty($_POST)) {
            session('sele', null);
        }
        $zid = input('param.id') ? input('param.id') : session('sele.id');
        $where = "uid=$zid";
        $where .= session('sele.sid') ? " and id=" . session('sele.sid') : '';
        $where .= session('sele.er_logo') ? " and er_logo='" . session('sele.er_logo') . "'" : '';

        $result = Db::name("user_posted")->where($where)->paginate(10);
        $tmpUser = array();
        foreach ($result as &$v) {
            $id = $v['id'];
            $v['num'] = $this->file_num($id);
            $tmpUser[] = $v;
        }
        $this->assign('result', $tmpUser);
        $this->assign('uid', $zid);
        $this->assign('sele', session('sele'));
        $this->assign('page', $result->render());
        return $this->fetch();
    }

    //删除文件包
    public function del()
    {
        $id = input('param.id');
        $name = Db::name("user_posted")->where("id=" . $id)->find();
        $ymurl = explode('/', $name['url']);
        $type = $this->del_tok($ymurl[3]);
        if (!$type) {
            $result = Db::name("user_posted")->where("id=" . $id)->delete();
            if ($result) {
                $this->success("删除成功");
            } else {
                $this->success("删除失败");
            }
        } else {
            $this->success("删除失败");
        }

    }

    //删除七牛文件
    public function del_tok($url)
    {
        require_once(PLUGINS_PATH . '/qiniu/autoload.php');
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = $_SESSION['think']['user']['accessKey'];
        $secretKey = $_SESSION['think']['user']['secretKey'];
        $bucket = $_SESSION['think']['user']['bucket'];

        // 构建鉴权对象
        $key = $url;
        $auth = new Auth($accessKey, $secretKey);
        $config = new \Qiniu\Config();
        $bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
        $err = $bucketManager->delete($bucket, $key);
        return $err ? true : false;
    }

    //充值记录
    public function charge()
    {
        if ($_POST) {
            session('charge', $_POST);
        }
        if (!isset($_GET['page']) and empty($_POST)) {
            session('charge', null);
        }
        $where = session('charge.end_time') ? "addtime <" . strtotime(session('charge.end_time')) : "addtime <" . time();
        $where .= session('charge.id') ? " and uid=" . session('charge.id') : '';
        $where .= session('charge.status') > "0" ? " and status='" . session('charge.status') . "'" : '';
        $where .= session('charge.start_time') ? " and addtime >" . strtotime(session('charge.start_time')) : "";
        $user = Db::name("charge_log")->where($where) -> order('addtime desc')->paginate(10);

        $tmpUser = array();
        foreach ($user as &$v) {
            $id = $v['uid'];
            $name = Db::name("user")->where("id=" . $id)->find();
            $v['name'] = $name['user_nickname'];
            $tmpUser[] = $v;
        }

        $this->assign('user', $tmpUser);
        $this->assign('charge', session('charge'));
        $this->assign('page', $user->render());
        return $this->fetch();
    }
}