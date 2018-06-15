<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
/**
* @name='菜单'
*/
class Menu extends Base
{
	public function _initialize(){		
		parent::_initialize();
	}
	/**
	* @name='首页'
	*/	
	public function index(){ 
		$icos = Db::name('jcb_sys_ico')->order('id asc')->select(); 
		$this->assign('icos',$icos);
		return view();
	}
	//返回重组数组
	protected function get_menu($pid,$menus){
		$arr = array();
		foreach($menus as $k => $m){
			if($m['pid']==$pid){
				$m['title'] = '├╌ '.$m['title'];
				$arr[] = $m;
				unset($this->data[$k]);
			}
		}
		return $arr;
	} 
	protected $data = array();
	/**
	* @name='菜单数据'
	*/
	public function menu_data(){
		$this->data = Db::name('jcb_sys_menu')->order('sort asc')->select();
		$new_data= array();
		foreach($this->data as $k => $d){
			if($d['pid'] == 0){
				$new_data[]=$d;
				$new_data = array_merge($new_data,$this->get_menu($d['id'],$this->data)); 
			 	 
				unset($this->data[$k]);
			}
		} 		 
		$new_data = array_merge($new_data,$this->data);  
        $data_count = Db::name('jcb_sys_menu')->count('id'); 
        return $this->to_table_data($new_data,$data_count);
	}
	/**
	* @name='修改'
	*/
	public function menu_set(){
		if(request()->isPost()){
			$data=input('post.');	
			$data['value'] = trim(str_replace("├╌","",$data['value']));	 
			try{
				Db::name('jcb_sys_menu')->where('id',intval($data['data']['id']))->update([$data['field']=>$data['value']]);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('');	
		}
	}
	/**
	* @name='删除'
	*/
	public function menu_del(){
		if(request()->isPost()){
			$data=input('post.');	 
			try{
			  $id =	Db::name('jcb_sys_menu')->where('id',intval($data['id']))->delete();
			  !$id && $this->error('删除失败!'); 
			} catch (\Exception $e) {
				$this->error('删除失败!');
			}
			$this->success('');	
		}
	}
	/**
	* @name='添加'
	*/
	public function menu_add(){
		if(request()->isPost()){
			$data=input('post.');	 
			try{
			  $id =	Db::name('jcb_sys_menu')->insertGetId(array('pid'=>0,'sort'=>0));
			  !$id && $this->error('添加失败!'); 
			} catch (\Exception $e) {
				$this->error('添加失败!');
			}
			$this->success('添加成功,请补充菜单详情!');	
		}
	}	
	
}