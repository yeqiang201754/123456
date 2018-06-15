<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
/**
* @name='会员等级' 
*/
class Interest extends Base
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
        $v_level = isset($data["level"]) ? trim($data["level"]):null;
        $db = Db::name("interest");
        !empty($v_level) && $db = $db->where("level",$v_level);
        $data_list = $db->order("id desc")->limit($current_begin,$pagenum)->select();
        foreach($data_list as $key => $val){
            if($val['level'] == 'zy'){
                $data_list[$key]['level'] = '专员';
            }elseif($val['level'] == 'jl'){
                $data_list[$key]['level'] = '经理';
            }elseif($val['level'] == 'hz'){
                $data_list[$key]['level'] = '行长';
            }else{
                $data_list[$key]['level'] = '银行家';
            }
        }
        $db = Db::name("interest");
        !empty($v_level) && $db = $db->where("level",$v_level);
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
            !isset($data["level"]) && $this->error("参数非法!");
            $updata["level"] = trim($data["level"]);
            empty($updata['level']) && $this->error('参数不允许为空!');
            !isset($data["bewriter"]) && $this->error("参数非法!");
            $updata["bewriter"] = trim($data["bewriter"]);
            empty($updata['bewriter']) && $this->error('参数不允许为空!');
            !isset($data["content"]) && $this->error("参数非法!");
            $updata["content"] = trim($data["content"]);
            empty($updata['content']) && $this->error('参数不允许为空!');
            // $updata["tjj"] = trim($data["tjj"]);
            // empty($updata['tjj']) && $this->error('参数不允许为空!'); 
            // !is_numeric($updata['tjj']) && $this->error('参数类型不正确!');
            $updata["sjfy"] = trim($data["sjfy"]);
            empty($updata['sjfy']) && $this->error('参数不允许为空!');
            !is_numeric($updata['sjfy']) && $this->error('参数类型不正确!');
            // !isset($data["team"]) && $this->error("参数非法!");
            // $updata["team"] = trim($data["team"]);
            // empty($updata['team']) && $this->error('参数不允许为空!');
            !isset($data["up"]) && $this->error("参数非法!");
            $updata["up"] = trim($data["up"]);
            empty($updata['up']) && $this->error('参数不允许为空!');
            !is_numeric($updata['up']) && $this->error('参数类型不正确!');           
            /*引用型的请自行验证 
            !empty(Db::name('user')->where('username',$updata['username'])->find()) && $this->error('不存在,请重新输入!');
            */
            
            $lev =Db::name('interest')->where('level',$data["level"])->find();
            if($lev){
                $this->error('已经存在此会员等级!');
            }
            try{
                $result =Db::name('interest')->insertGetId($updata);
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
				$result = Db::name('interest')->where('id',intval($data['id']))->delete();
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
            // $updata["level"] = trim($data["level"]);
            // empty($updata['level']) && $this->error('参数不允许为空!');
            $updata["bewriter"] = trim($data["bewriter"]);
            empty($updata['bewriter']) && $this->error('参数不允许为空!');
            $updata["content"] = trim($data["content"]);
            empty($updata['content']) && $this->error('参数不允许为空!');
            // $updata["tjj"] = trim($data["tjj"]);
            // empty($updata['tjj']) && $this->error('参数不允许为空!');
            // !is_numeric($updata['tjj']) && $this->error('参数类型不正确!');
            $updata["sjfy"] = trim($data["sjfy"]);
            empty($updata['sjfy']) && $this->error('参数不允许为空!');
            !is_numeric($updata['sjfy']) && $this->error('参数类型不正确!');
            // $updata["team"] = trim($data["team"]);
            // empty($updata['team']) && $this->error('参数不允许为空!');
            $updata["up"] = trim($data["up"]);
            empty($updata['up']) && $this->error('参数不允许为空!');
            !is_numeric($updata['up']) && $this->error('参数类型不正确!');

            
            try{
				Db::name('interest')->where('id',intval($data['id']))->update($updata);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('修改成功!');	 
       }else{
            $list = Db::name('interest')->where('id',intval($data['id']))->find();
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
            if(!in_array($data['field'],['level','bewriter','content','tjj','sjfy','team','up'])){ 
               $this->error('字段非法!'); 
            }	
			$data['value'] = trim($data['value']);
            try{
                $id = intval($data['data']['id']);
            }catch(\Exception $e){
                $this->error('ID错误!');
            }	            
			try{
				Db::name('interest')->where('id',$id)->setField($data['field'],$data['value']);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('');	
		}
    }
    
}