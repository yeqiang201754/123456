<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
/**
* @name='{tb_mark}' 
*/
class {tb_controller} extends Base
{
	public function _initialize(){		
		parent::_initialize();
	} 
    /**
    * @name='首页'
    */
    public function index(){
        {_index_}
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
        {_index_data_db_}  
        return $this->to_table_data($data_list,$data_count);           
    }  
    {_add_begin_}    
    /**
    * @name='添加'
    */
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $updata= array();           
            {_add_post_}          
            /*引用型的请自行验证 
            !empty(Db::name('user')->where('username',$updata['username'])->find()) && $this->error('不存在,请重新输入!');
            */
            try{
                $result =Db::name('{tb_name}')->insertGetId($updata);
                if(!$result){
                    $this->error('新增失败!');
                }
            } catch (\Exception $e) {
                $this->error('新增失败!');
            }
            $this->success('新增成功!');	 
        }else{ 
            {_add_field_}
            return view();
        }
    }
    {_add_end_}    
    {_del_begin_}
    /**
    * @name='删除'
    */  
    public function del(){
        if(request()->isPost()){
			$data=input('post.');
            try{
                /*请自己增加删除前判断*/
				$result = Db::name('{tb_name}')->where('id',intval($data['id']))->delete();
                if(!$result){
                    $this->error('删除失败!');
                }
			} catch (\Exception $e) {
				$this->error('删除失败!');
			}
            $this->success('删除成功!');
        }     
    }
    {_del_end_}
    {_edit_begin_}
    /**
    * @name='编辑'
    */  
    public function edit(){
       $data=input('');
       !isset($data['id']) && $this->error('参数非法!');
       !is_numeric($data['id']) && $this->error('参数非法!');
       $data['id'] = intval($data['id']); 
       if(request()->isPost()){
            $updata= array();
            /*引用型的请自行验证 
            !empty(Db::name('user')->where('username',$updata['username'])->find()) && $this->error('不存在,请重新输入!');
            */
            {_edit_updata_}
            try{
				Db::name('{tb_name}')->where('id',intval($data['id']))->update($updata);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('修改成功!');	 
       }else{
            $list = Db::name('{tb_name}')->where('id',intval($data['id']))->find();
            $this->assign('list',$list);

            {_edit_field_}
            return view();
       } 
    }
    {_edit_end_}
    {_modify_field_begin_}
    /**
    ** @name='修改字段'
    */    
    public function modify_field(){
		if(request()->isPost()){
			$data=input('post.'); 
            if(!in_array($data['field'],[{_modify_where_}])){ 
               $this->error('字段非法!'); 
            }	
			$data['value'] = trim($data['value']);
            try{
                $id = intval($data['data']['id']);
            }catch(\Exception $e){
                $this->error('ID错误!');
            }	            
			try{
				Db::name('{tb_name}')->where('id',$id)->setField($data['field'],$data['value']);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('');	
		}
    }
    {_modify_field_end_}
}