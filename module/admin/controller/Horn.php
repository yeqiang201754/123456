<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
/**
* @name='后台用户'
*/
class Horn extends Base
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
        $db = Db::name('horn');        
        $data = $db->order('id asc')->limit($current_begin,$pagenum)->select();

        $data_count = Db::name('horn')->count('id'); 
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
            $updata['title'] = $data['title'];            
            try{
			    $result =Db::name('horn')->insertGetId($updata);
                if(!$result){
                    $this->error('新增失败!');
                }
			} catch (\Exception $e) {
				$this->error('新增失败!');
			}
			$this->success('新增成功!',url('@admin/horn/index'));	 
       }else{
           
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
            try{
				$result = Db::name('horn')->where('id',intval($data['id']))->delete();
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
    public function edit()
    {
       $data=input('');
       !isset($data['id']) && $this->error('参数非法!');
       !is_numeric($data['id']) && $this->error('参数非法!');
       $data['id'] = intval($data['id']); 
       if(request()->isPost()){
            $updata= array();
            $updata['title'] = $data['title'];            
            try{
				Db::name('horn')->where('id',intval($data['id']))->update($updata);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('修改成功!');	 
       }else{
            $horn = Db::name('horn')->find($data['id']);
            $this->assign(['horn'=>$horn]);
            return view();
       }       
    }  

}