<?php


namespace app\admin\controller;


use cmf\controller\AdminBaseController;
use think\Db;

class ReportController extends AdminBaseController
{
    public function index()
    {
        $where = [];
        $request = input('request.');

        if (!empty($request['uid'])) {
            $where['id'] = intval($request['uid']);
        }
        $keywordComplex = [];
        if (!empty($request['keyword'])) {
            $keyword = $request['keyword'];

            //$keywordComplex['user_login|user_nickname|user_email']    = ['like', "%$keyword%"];
        }
        $usersQuery = Db::name('report_record r');

        $list = $usersQuery->join('user_posted p', 'p.id=r.app_id')
            ->field('r.*,p.name')
            ->whereOr($keywordComplex)->where($where)->order("create_time DESC")->paginate(20);
        // 获取分页显示
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        // 渲染模板输出

        return $this->fetch();
    }

}