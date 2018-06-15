<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Request;

class Base extends Jcb
{
    protected $member = null;  
    public function _initialize(){	
        parent::_initialize();  
        if(!Session::has('uid')){
            $this->redirect(url('@admin/login/index'));exit;
        }else{
            $uid = session('uid');
            $this->member = Db::name('jcb_sys_member')->find(intval($uid));
            empty($this->member) && $this->redirect(url('@admin/login/index')); 
            $this->member['cstatus'] == 0 && $this->redirect(url('@admin/login/index'));          
            $role = Db::name('jcb_sys_menu_role')->where('id',$this->member['roleid'])->find();
            $this->member['roleval'] = $role['roleval']; 
            $this->member['roleid'] = $role['id'];             
            $this->check_role();
            $this->assign(['member'=>$this->member]); 
        }   
	}
    protected function check_role(){
        $request = Request::instance();
        $action = $request->module().'|'.$request->controller().'|'.$request->action();  
        $roleresult = Db::name('jcb_sys_action_role')->where('roleid',$this->member['roleid'])->where('action',strtolower($action))->find();
        // empty($roleresult) && $this->error('没有权限!'); 
    } 

    protected function get_annotation($c){
        $annotation ='';
        $doc = $c->getDocComment();  
        $pattern="/@name=\'(.*?)\'/i";  
		if(preg_match_all($pattern, $doc, $match) >0){ 
			 $annotation = $match[1][0]; 
		}       
        return trim($annotation);   
    }
    protected function to_table_data($data,$data_count=null){
		$arr['code']=0;
		$arr['msg']='';
		$arr['count']= ($data_count==null ? count($data) :$data_count) ;
		$arr['data']=$data;
		return $arr;  
	}

}