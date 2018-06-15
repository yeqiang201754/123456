<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
/**
* @name='文章' 
*/
class Article extends Base
{
	public function _initialize(){		
		parent::_initialize();
	} 
    /**
    * @name='首页'
    */
    public function index(){
        $l_type = Db::name("article_type")->select();
        $this->assign(["l_type"=>$l_type]);
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
        $v_type = isset($data["type"]) ? trim($data["type"]):null;
        $v_title = isset($data["title"]) ? trim($data["title"]):null;
        $db = Db::name("article")->field('article.*,article_type.name')->join('article_type','article_type.id = article.type');
        !empty($v_type) && $db = $db->where("article.type",$v_type);
        !empty($v_title) && $db = $db->where("article.title",$v_title);
        $data_list = $db->order("id desc")->limit($current_begin,$pagenum)->select();
        // $db = Db::name("article");
        // !empty($v_type) && $db = $db->where("type",$v_type);
        // !empty($v_title) && $db = $db->where("title",$v_title);
        $db = Db::name("article")->field('article.*,article_type.name')->join('article_type','article_type.id = article.type');
        !empty($v_type) && $db = $db->where("article.type",$v_type);
        !empty($v_title) && $db = $db->where("article.title",$v_title);
        $data_count = $db->count("article.id"); 
        // $data_count = count($data_list);  
        return $this->to_table_data($data_list,$data_count);           
    }  
        
    /**
    * @name='添加'
    */
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $updata= array();
            $updata["type"] = trim($data["type"]);
            empty($updata['type']) && $this->error('参数不允许为空1!');
            !is_numeric($updata['type']) && $this->error('参数类型不正确!');
            !isset($data["title"]) && $this->error("参数非法!");
            $updata["title"] = trim($data["title"]);
            empty($updata['title']) && $this->error('参数不允许为空2!');
            !isset($data["front"]) && $this->error("参数非法!");
            $updata["front"] = trim($data["front"]);
            empty($updata['front']) && $this->error('参数不允许为空3!');
            !isset($data["content"]) && $this->error("参数非法!");
            $updata["content"] = trim($data["content"]);
            empty($updata['content']) && $this->error('参数不允许为空4!');
            
            !isset($data["picture"]) && $this->error("参数非法!");
            $updata["picture"] = trim($data["picture"]);
            empty($updata['picture']) && $this->error('参数不允许为空5!');
            
            $updata["addtime"] = date('Y-m-d H:i:s');
            /*引用型的请自行验证 
            !empty(Db::name('user')->where('username',$updata['username'])->find()) && $this->error('不存在,请重新输入!');
            */
            try{
                $result =Db::name('article')->insertGetId($updata);
                if(!$result){
                    $this->error('新增失败!');
                }
            } catch (\Exception $e) {
                $this->error('新增失败!');
            }
            $this->success('新增成功!');	 
        }else{
            $type = Db::name('article_type')->select();
            $this->assign('type',$type);
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
				$result = Db::name('article')->where('id',intval($data['id']))->delete();
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
            $updata["type"] = trim($data["type"]);
            empty($updata['type']) && $this->error('参数不允许为空!');
            !is_numeric($updata['type']) && $this->error('参数类型不正确!');
            $updata["title"] = trim($data["title"]);
            empty($updata['title']) && $this->error('参数不允许为空!');
            $updata["front"] = trim($data["front"]);
            empty($updata['front']) && $this->error('参数不允许为空!');
            $updata["content"] = trim($data["content"]);
            empty($updata['content']) && $this->error('参数不允许为空!');
           
            $updata["picture"] = trim($data["picture"]);
            empty($updata['picture']) && $this->error('参数不允许为空!');
            $updata["addtime"] = date('Y-m-d H:i:s');
            try{
				Db::name('article')->where('id',intval($data['id']))->update($updata);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('修改成功!');	 
       }else{
            $list = Db::name('article')->where('id',intval($data['id']))->find();
            $type = Db::name('article_type')->select();
            $this->assign('list',$list);
            $this->assign('type',$type);
            return view();
       } 
    }
    
    
    /**
    ** @name='修改字段'
    */    
    public function modify_field(){
		if(request()->isPost()){
			$data=input('post.'); 
            if(!in_array($data['field'],['type','title','front','content','click','picture'])){ 
               $this->error('字段非法!'); 
            }	
			$data['value'] = trim($data['value']);
            try{
                $id = intval($data['data']['id']);
            }catch(\Exception $e){
                $this->error('ID错误!');
            }	            
			try{
				Db::name('article')->where('id',$id)->setField($data['field'],$data['value']);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('');	
		}
    }
    
}