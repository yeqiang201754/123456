<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
/**
* @name='后台用户'
*/
class Member extends Base
{
	public function _initialize(){		
		parent::_initialize();   
	}
    /**
    ** @name='首页'
    */
    public function index()
    {        
        return view();
    }

    /**
    ** @name='用户数据'
    */
    public function data()
    {
        $data=$_GET; 
		$data['page'] = isset($data['page']) ? $data['page'] : 1; 
		$pagenum = isset($data['limit']) ? intval($data['limit']) : config('page_num'); 
		$current_begin = (intval($data['page']) -1) * $pagenum;  
        $db = Db::name('jcb_sys_member')->field('id,username,nickname,avatar,cstatus,roleid,roleid as rolename');        
        $data = $db->order('id asc')->limit($current_begin,$pagenum)->select();
        $role = Db::name('jcb_sys_menu_role')->field('id,rolename')->select();

        foreach($data as $k=>$d){
            foreach($role as $r){
                $d['roleid'] == $r['id'] && $data[$k]['rolename']= $r['rolename']; 
            } 
        }
        $data_count = Db::name('jcb_sys_member')->count('id'); 
        return $this->to_table_data($data,$data_count);
    }
    /**
    ** @name='添加'
    */
    public function add()
    {
         if(request()->isPost()){
            $data=input('post.');
            $updata= array();
            $updata['username'] = trim($data['username']);
            !empty(Db::name('jcb_sys_member')->where('username',$updata['username'])->find()) && $this->error('登陆名已存在,请重新输入!'); 
            $updata['nickname'] = trim($data['nickname']); 
            $updata['password'] = md5(trim($data['password']));
            $updata['cstatus'] = isset($data['cstatus']) ? 1 : 0;
            $updata['avatar'] = $data['avatar'];
            empty(Db::name('jcb_sys_menu_role')->find(intval($data['roleid']))) && $this->error('角色不正确!');
            $updata['roleid'] = intval($data['roleid']);            
            try{
			    $result =Db::name('jcb_sys_member')->insertGetId($updata);
                if(!$result){
                    $this->error('新增失败!');
                }
			} catch (\Exception $e) {
				$this->error('新增失败!');
			}
			$this->success('新增成功!',url('@admin/member/index'));	 
       }else{
            $roles= Db::name('jcb_sys_menu_role')->select();
            $this->assign(['roles'=>$roles]);
            return view();
       }
    }   

    /**
    ** @name='删除'
    */
    public function del()
    {
        if(request()->isPost()){
			$data=input('post.');
            Db::name('sys_member')->where('id',intval($data['id']))->where('username','admin')->find() && $this->error('admin不能删除!');
            try{
				$result = Db::name('sys_member')->where('id',intval($data['id']))->delete();
                if(!$result){
                    $this->error('删除失败!');
                }
			} catch (\Exception $e) {
				$this->error('删除失败!');
			}
            $this->success('删除成功!');
        }      
    } 

    /**
    ** @name='修改'
    */
    public function modfiy()
    {
       $data=input('');
       !isset($data['id']) && $this->error('参数非法!');
       !is_numeric($data['id']) && $this->error('参数非法!');
       $data['id'] = intval($data['id']); 
       if(request()->isPost()){
            $updata= array();
            $updata['username'] = trim($data['username']);
            $originalname = Db::name('sys_member')->where('id',intval($data['id']))->where('username','admin')->value('username');
            if($originalname == 'admin' && $updata['username'] != 'admin'){
                $this->error('admin登陆名不能修改!');
            }


            !empty(Db::name('sys_member')->where('username',$updata['username'])->where('id','neq',intval($data['id']))->find()) && $this->error('登陆名已存在,请重新输入!');             
            $updata['nickname'] = trim($data['nickname']); 
            !empty(trim($data['password'])) && $updata['password'] = md5($data['password']);
            $updata['cstatus'] = isset($data['cstatus']) ? 1 : 0;
            $updata['avatar'] = $data['avatar'];
            empty(Db::name('sys_menu_role')->find(intval($data['roleid']))) && $this->error('角色不正确!');
            $updata['roleid'] = intval($data['roleid']);            
            try{
				Db::name('sys_member')->where('id',intval($data['id']))->update($updata);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('修改成功!');	 
       }else{
            $roles= Db::name('sys_menu_role')->select();
            $u = Db::name('sys_member')->find($data['id']);
            empty($u) && $this->error('用户不存在!');
            $this->assign(['u'=>$u,'roles'=>$roles]);
            return view();
       }       
    }  

    /**
    ** @name='修改状态'
    */    
    public function modify_field(){
		if(request()->isPost()){
			$data=input('post.');          
            if($data['field'] != 'cstatus'){
               $this->error('字段非法!'); 
            }	
			$data['value'] = trim($data['value']);	
            $data['id'] == 1 &&  $this->error('默认管理员状态不能修改!'); 
			try{
				Db::name('sys_member')->where('id',intval($data['id']))->setField($data['field'],$data['value']);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('');	
		}
    }
        
}