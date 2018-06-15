<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
/**
* @name='角色' 
*/
class Role extends Base
{
	public function _initialize(){		
		parent::_initialize();
	}    

    /**
    * 获取类的所有方法
    */
    protected function get_class_all_methods($class){
        $arr = array();       
		$r = new \ReflectionClass($class);
		foreach($r->getMethods() as $key=>$methodObj){	 
            if($methodObj->class != 'think\Controller' && $methodObj->isPublic() && $methodObj->name != '_initialize'){
               //有效
               $strs = explode('\\',strtolower($methodObj->class));
               $note = $this->get_annotation($methodObj);
               $arr[] =array('title'=>$strs[1].'|'.$strs[3].'|'.$methodObj->name,'action'=>$methodObj->name,'selected'=>false,'note'=>$note);      
            }
		}
		return $arr;
	}
    /**
    * @获取当前模块下面的所有控制器文件
    * @Return 文件名数组
    */
    protected function get_class_file(){      
        $dir = @ dir(__DIR__);
        $files= array();
        while (($file = $dir->read())!==false)  
        {  
            $info = pathinfo($file); 
            if($info['extension'] == 'php' && !in_array($info['filename'], ['Jcb','Base','Login'])){ 
                $files[]= $info['filename'];
            }            
        }  
        $dir->close(); 
        return $files; 
    }
    /**
    * @name=' 权限设置 '
    * @param $id bigint 角色ID
    */
    public function action_set(){
         $id=intval(input()['id']); 
         if (request()->isPost()) { 
            $data=input('post.');	
            $insert_data= array();
            foreach($data as $k=>$v){
                $insert_data[] =array('roleid'=>$id,'action'=>$k);
            }
            Db::startTrans();
			try{
                Db::name('jcb_sys_action_role')->where('roleid',$id)->delete();
                Db::name('jcb_sys_action_role')->insertAll($insert_data);
                Db::commit();    
			} catch (\Exception $e) { 
				Db::rollback();
				$this->error('操作失败!');
			} 
            $this->success('操作成功!');
        }else{             
            //所有可用权限
            $actions = Db::name('jcb_sys_action_role')->field('action')->where('roleid', $id)->select();
            $ctrls = $this->get_class_file(); 
            $new_ctrls = array();
            foreach($ctrls as $k => $ctrl){ 
                $data = $this->get_class_all_methods(controller($ctrl));  
                foreach($data as $ks => $d){
                    foreach($actions as $action){
                        if($action['action'] == $d['title']){
                            $data[$ks]['selected']  = true; 
                        }
                    }
                }
                $note = $this->get_annotation(new \ReflectionClass(controller($ctrl)));
                $new_ctrls[] = array('title'=>$ctrl,'note'=>$note,'data'=>$data);      
            }  
            $url = Request::instance()->url(true);
            $this->assign(['ctrls'=>$new_ctrls,'url'=>$url]); 
            return view();
        }
    }
    
    /**
    * @name='权限列表页 '
    */
    public function index(){
        return view();
    }

    /**
    * @name='权限列表数据'
    * @return arrary
    */
    public function role_data(){
        $data=$_GET; 
		$data['page'] = isset($data['page']) ? $data['page'] : 1; 
		$pagenum = isset($data['limit']) ? intval($data['limit']) : config('page_num');  
		$current_begin = (intval($data['page']) -1) * $pagenum;  
        $db = Db::name('jcb_sys_menu_role')->field('id,rolename,cstatus,sort,cmark');        
        $data = $db->order('sort asc')->limit($current_begin,$pagenum)->select();       
        $data_count = Db::name('jcb_sys_menu_role')->count('id'); 
        return $this->to_table_data($data,$data_count);
    }
    
    /**
    * @name='添加角色'
    * @return bool
    */   
    public function add(){
        if(request()->isPost()){
			$data=input('post.');	 
			try{
			  $id =	Db::name('jcb_sys_menu_role')->insertGetId(array('rolename'=>'---------','sort'=>0));
			  !$id && $this->error('添加失败!'); 
			} catch (\Exception $e) {
				$this->error('添加失败!');
			}
			$this->success('添加成功,请设置详情!');	
		}
    }
    /**
    * @name='删除角色'
    */
    public function del(){
         if (request()->isPost()) { 
            $data=input('post.');	
            $id = intval($data['id']);
            $count = Db::name('jcb_sys_member')->where('roleid',$id)->count('id');
            $count > 0 && $this->error('此权限下面存在用户,不允许删除!');
            Db::startTrans();
			try{
                Db::name('jcb_sys_menu_role')->where('id',$id)->delete();
                Db::name('jcb_sys_action_role')->where('roleid',$id)->delete();
                Db::commit();    
			} catch (\Exception $e) { 
				Db::rollback();
				$this->error('操作失败!');
			} 
            $this->success('操作成功!');
         }
    }
    /**
	* @name='修改'
	*/
	public function modify(){
		if(request()->isPost()){
			$data=input('post.');	
			$data['value'] = trim(str_replace("├╌","",$data['value']));	 
			try{
				Db::name('jcb_sys_menu_role')->where('id',intval($data['data']['id']))->update([$data['field']=>$data['value']]);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('');	
		}
	}
    /**
    * @name='设置菜单'
    */
    public function set_menu(){
        $id=intval(input()['id']);	
        if(request()->isPost()){
            $rolevalue = Db::name('jcb_sys_menu_role')->where('id',intval($id))->value('roleval');  
            $roles = explode(',',$rolevalue);
            $data=input('post.');
            if($data['val'] == 1){
                if(!in_array($data['id'],$roles)){
                    $roles[] = $data['id'];
                }
            }else{
                if(in_array($data['id'],$roles)){
                   foreach( $roles as $k=>$v) {
                        if($data['id'] == $v) unset($roles[$k]);
                   }
                }
            }           
            try{
				Db::name('jcb_sys_menu_role')->where('id',$id)->setField('roleval',implode(',',$roles));
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('');	            
        }else{
            $url=  url('@admin/role/menu_data',array('id'=>$id));  
            $posturl=  url('@admin/role/set_menu',array('id'=>$id));  
            $this->assign(['url'=>$url,'posturl'=>$posturl]);
            return view();  
        }     
    }
    /**
	* @name='菜单数据'
	*/
	public function menu_data($id){
        $rolevalue = Db::name('jcb_sys_menu_role')->where('id',intval($id))->value('roleval');  
        $roles = explode(',',$rolevalue);   
        $data = controller('Menu')->menu_data();
        $data_data= $data['data'];
        foreach($data_data as $k => $d){
            if(in_array($d['id'],$roles)){
                $d['selected'] = true;               
            }else{
                $d['selected'] = false;
            } 
            $data_data[$k] = $d;
        }
        $data['data'] = $data_data;
        return $data; 
	}

}