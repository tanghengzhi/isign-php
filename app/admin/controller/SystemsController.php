<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 208620005@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\model\RouteModel;
use cmf\controller\AdminBaseController;

use think\Db;
class SystemsController extends AdminBaseController{

    /**
     *  系统设置
     * @adminMenu(
     *     'code'   => '系统唯一标识',
     *     'titlt' => '系统名称',
     *     'group_id'=> 系统分类,
     *     'val'=> 设置系统的值,
     *     'type'  => 系统的属性 0 input 1文本域 2图片地址 3多选 4单选 5时间 ,
     *     'sort'   => '排序',
     *     'value_scope' => '值的范围',
     *     'title_scope'  => '对应value_scope的中文解释'
     *     'desc'  => '描述'
     * )
     */
    public function index(){
        //系统设置分类
        $type=Db::name('config')->where('status',1)->distinct("group_id")->field('group_id')->select();
        $config=Db::name('config')->where('status',1)->select()->toArray();
         foreach($config as &$v){
            if($v['type'] ==4){
                $keys= explode(",", $v['value_scope']); 
                $val = explode(",", $v['title_scope']); 
                $value= array_combine($keys, $val);   
                $v['type_val']=  $value;              
            }else if($v['type'] ==3){
                $keys= explode(",", $v['value_scope']); 
                $val = explode(",", $v['title_scope']); 
                $check = explode(",", $v['val']); 
                $value= array_combine($keys, $val);   
                $v['checkbox_check']=  $check; 
                $v['checkbox_val']=  $value; 

            }
         }

        $this->assign('config',$config);
        $this->assign('type',$type);
        return $this->fetch();
    }

    /**
     * 网站信息设置提交
     * @adminMenu(
     *     'name'   => '网站信息设置提交',
     *     'parent' => 'site',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '网站信息设置提交',
     *     'param'  => ''
     * )
     */
    public function upd_post(){
        $nam=input('post.');
          
            foreach($nam as $k=>$v){
                if(is_array($v)){
                    $arr=implode(',',$v);
                    $config=Db::name('config')->where("code='$k'")->setField('val',$arr);
                }else{
                    $config=Db::name('config')->where("code='$k'")->setField('val',$v);
                }
                
            }
            $this->success("保存成功！", url("systems/index"));

        }
    //添加配置信息
    public function add_sys(){
        //系统设置分类
        $type=Db::name('config')->distinct("group_id")->field('group_id')->select();
         $this->assign('type',$type);
        return $this->fetch();
    }
     //添加配置信息
    public function add_post(){
         $nam=input('post.');
       
         if($nam['type'] =='3'){
            $nam['val']=$nam['val'][$nam['type']]-1;
            $nam['title_scope']=$nam['title_scope'][0];
            $nam['value_scope']=$this->jsm($nam['title_scope']);
         }else if($nam['type'] =='4'){
             $nam['val']=$nam['val'][$nam['type']]-1;
             $nam['title_scope']=$nam['title_scope'][1];
            $nam['value_scope']=$this->jsm($nam['title_scope']);
         }else{
            $nam['val']=$nam['val'][$nam['type']];
            $nam['title_scope']='';
            $nam['value_scope']='';
         }
        $type=Db::name('config')->insert($nam);
        if($type){
            $this->success("保存成功！", url("systems/index"));
        }else{
            $this->error("保存失败！", url("systems/index"));
        }
       
    }
    //字符串转换数组
    public function jsm($all){
        $vas=explode(',',$all);
        $keys=array_keys($vas);
        $check = implode(",", $keys);
        return $check;
    }
}