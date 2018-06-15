<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
/**
* @name='公告' 
*/
class Notice extends Base
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
        $v_title = isset($data["title"]) ? trim($data["title"]):null;
        $db = Db::name("notice");
        !empty($v_title) && $db = $db->where("title",$v_title);
        $data_list = $db->order("id desc")->limit($current_begin,$pagenum)->select();
        $db = Db::name("notice");
        !empty($v_title) && $db = $db->where("title",$v_title);
        $data_count = $db->count("id");  
        return $this->to_table_data($data_list,$data_count);           
    }  
        
    /**
    * @name='添加'
    */
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $updata= array();
            !isset($data["title"]) && $this->error("参数非法!");
            $updata["title"] = trim($data["title"]);
            empty($updata['title']) && $this->error('参数不允许为空!');
            !isset($data["content"]) && $this->error("参数非法!");
            $updata["content"] = trim($data["content"]);
            empty($updata['content']) && $this->error('参数不允许为空!');          
            /*引用型的请自行验证 
            !empty(Db::name('user')->where('username',$updata['username'])->find()) && $this->error('不存在,请重新输入!');
            */
            try{
                $result =Db::name('notice')->insertGetId($updata);
                if(!$result){
                    $this->error('新增失败!');
                }
            } catch (\Exception $e) {
                $this->error('新增失败!');
            }
            $this->success('新增成功!');	 
        }else{ 
            
            return view();
        }
    }
        
    
    /**
    * @name='删除'
    */  
    public function del(){
        if(request()->isPost()){
			$data=input('post.');
            try{
                /*请自己增加删除前判断*/
				$result = Db::name('notice')->where('id',intval($data['id']))->delete();
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
            $updata["title"] = trim($data["title"]);
            empty($updata['title']) && $this->error('参数不允许为空!');
            $updata["content"] = trim($data["content"]);
            empty($updata['content']) && $this->error('参数不允许为空!');
            try{
				Db::name('notice')->where('id',intval($data['id']))->update($updata);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('修改成功!');	 
       }else{
            $list = Db::name('notice')->where('id',intval($data['id']))->find();
            $this->assign('list',$list);

            
            return view();
       } 
    }
    
    
    /**
    ** @name='修改字段'
    */    
    public function modify_field(){
		if(request()->isPost()){
			$data=input('post.'); 
            if(!in_array($data['field'],['title','content'])){ 
               $this->error('字段非法!'); 
            }	
			$data['value'] = trim($data['value']);
            try{
                $id = intval($data['data']['id']);
            }catch(\Exception $e){
                $this->error('ID错误!');
            }	            
			try{
				Db::name('notice')->where('id',$id)->setField($data['field'],$data['value']);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('');	
		}
    }
    
}