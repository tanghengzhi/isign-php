<?php
namespace app\admin\controller;
use think\Db;
use cmf\controller\AdminBaseController;

class ApplyController extends AdminBaseController{
    /**
     *上传应用
     */
    public function addindex(){
       
        return $this->fetch();
    }
}
