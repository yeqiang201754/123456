<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
/**
* @name='用户' 
*/
class User extends Base
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
        $username = isset($data["username"]) ? trim($data["username"]):null;
        $mobile = isset($data["mobile"]) ? trim($data["mobile"]):null;
        $db = Db::name("user");
        !empty($username) && $db = $db->where("username",$username);
        !empty($mobile) && $db = $db->where("mobile",$mobile);
        $data_list = $db->order("id desc")->limit($current_begin,$pagenum)->select();
        foreach($data_list as $key=> $val){
            if($val['grade'] == 'zy'){
                $data_list[$key]['grade'] = '专员';
            }elseif($val['grade'] == 'jl'){
                $data_list[$key]['grade'] = '经理';
            }
            elseif($val['grade'] == 'hz'){
                $data_list[$key]['grade'] = '行长';
            }else{
                $data_list[$key]['grade'] = '银行家';
            }
            $data_list[$key]['zj'] = Db::name("user")->where('id',$val['invite_one'])->value('username'); 
            $data_list[$key]['jj'] = Db::name("user")->where('id',$val['invite_two'])->value('username'); 
        }
        $db = Db::name("user");
        !empty($username) && $db = $db->where("username",$username);
        !empty($mobile) && $db = $db->where("mobile",$mobile);
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
            !isset($data["username"]) && $this->error("参数非法!");
            $updata["username"] = trim($data["username"]);
            empty($updata['username']) && $this->error('参数不允许为空!');
            !isset($data["mobile"]) && $this->error("参数非法!");
            $updata["mobile"] = trim($data["mobile"]);
            empty($updata['mobile']) && $this->error('参数不允许为空!');
            !isset($data["balance"]) && $this->error("参数非法!");
            $updata["balance"] = trim($data["balance"]);
            empty($updata['balance']) && $this->error('参数不允许为空!');
            !is_numeric($updata['balance']) && $this->error('参数类型不正确!');
            !isset($data["lock_balance"]) && $this->error("参数非法!");
            $updata["lock_balance"] = trim($data["lock_balance"]);
            empty($updata['lock_balance']) && $this->error('参数不允许为空!');
            !is_numeric($updata['lock_balance']) && $this->error('参数类型不正确!');
            !isset($data["profit"]) && $this->error("参数非法!");
            $updata["profit"] = trim($data["profit"]);
            empty($updata['profit']) && $this->error('参数不允许为空!');
            !is_numeric($updata['profit']) && $this->error('参数类型不正确!');
            !isset($data["grade"]) && $this->error("参数非法!");
            $updata["grade"] = trim($data["grade"]);
            empty($updata['grade']) && $this->error('参数不允许为空!');
            $updata["addtime"] = date('Y-m-d H:i:s');
            $updata["invite_one"] = $data['invite_one'];
            $updata["invite_two"] = $data['invite_two'];
            $updata["password"] = $data['password '];
            /*引用型的请自行验证 
            !empty(Db::name('user')->where('username',$updata['username'])->find()) && $this->error('不存在,请重新输入!');
            */
            try{
                $result =Db::name('user')->insertGetId($updata);
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
				$result = Db::name('user')->where('id',intval($data['id']))->delete();
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
            $updata["username"] = trim($data["username"]);
            empty($updata['username']) && $this->error('参数不允许为空!');
            $updata["mobile"] = trim($data["mobile"]);
            empty($updata['mobile']) && $this->error('参数不允许为空!');
            $updata["balance"] = trim($data["balance"]);
            empty($updata['balance']) && $this->error('参数不允许为空!');
            !is_numeric($updata['balance']) && $this->error('参数类型不正确!');
            $updata["lock_balance"] = trim($data["lock_balance"]);
            empty($updata['lock_balance']) && $this->error('参数不允许为空!');
            !is_numeric($updata['lock_balance']) && $this->error('参数类型不正确!');
            $updata["profit"] = trim($data["profit"]);
            empty($updata['profit']) && $this->error('参数不允许为空!');
            !is_numeric($updata['profit']) && $this->error('参数类型不正确!');
            $updata["grade"] = trim($data["grade"]);
            empty($updata['grade']) && $this->error('参数不允许为空!');
            $updata["invite_one"] = $data['invite_one'];
            $updata["invite_two"] = $data['invite_two'];
            try{
				Db::name('user')->where('id',intval($data['id']))->update($updata);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('修改成功!');	 
       }else{
            $list = Db::name('user')->where('id',intval($data['id']))->find();
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
            if(!in_array($data['field'],['username','mobile','balance','lock_balance','profit','grade'])){ 
               $this->error('字段非法!'); 
            }	
			$data['value'] = trim($data['value']);
            try{
                $id = intval($data['data']['id']);
            }catch(\Exception $e){
                $this->error('ID错误!');
            }	            
			try{
				Db::name('user')->where('id',$id)->setField($data['field'],$data['value']);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('');	
		}
    }
    
}