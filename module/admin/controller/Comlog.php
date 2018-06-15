<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
/**
* @name='佣金收益明细' 
*/
class Comlog extends Base
{
	public function _initialize(){		
		parent::_initialize();
	} 
    /**
    * @name='首页'
    */
    public function index(){
        
        return view();
    } 
    /**
    * @name='数据'
    */
    public function data(){
        $data=$_GET;        
		$data['page'] = isset($data['page']) ? $data['page'] : 1;
		$pagenum = isset($data['limit']) ? intval($data['limit']) : config('page_num');
		$current_begin = (intval($data['page']) -1) * $pagenum;
        $v_user_id = isset($data["username"]) ? trim($data["username"]):null;
        $db = Db::name("comlog")->field('comlog.*,user.username,user.mobile')->join('user','user.id = comlog.user_id');
        !empty($v_user_id) && $db = $db->where("user.username",$v_user_id);
        $data_list = $db->order("id desc")->limit($current_begin,$pagenum)->select();
        
        $db = Db::name("comlog")->field('comlog.*,user.username,user.mobile')->join('user','user.id = comlog.user_id');
        !empty($v_user_id) && $db = $db->where("user.username",$v_user_id);
        $data_count = $db->count("comlog.id"); 
        return $this->to_table_data($data_list,$data_count);           
    }  
        
    
    
    /**
    * @name='删除'
    */  
    public function del(){
        if(request()->isPost()){
			$data=input('post.');
            try{
                /*请自己增加删除前判断*/
				$result = Db::name('comlog')->where('id',intval($data['id']))->delete();
                if(!$result){
                    $this->error('删除失败!');
                }
			} catch (\Exception $e) {
				$this->error('删除失败!');
			}
            $this->success('删除成功!');
        }     
    }
    
    
}