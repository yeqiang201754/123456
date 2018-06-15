<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
/**
* @name='银行' 
*/
class Bank extends Base
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
        $v_bankname = isset($data["bankname"]) ? trim($data["bankname"]):null;
        $db = Db::name("bank");
        !empty($v_bankname) && $db = $db->where("bankname",$v_bankname);
        $data_list = $db->order("id desc")->limit($current_begin,$pagenum)->select();
        $db = Db::name("bank");
        !empty($v_bankname) && $db = $db->where("bankname",$v_bankname);
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
            !isset($data["bankname"]) && $this->error("参数非法!");
            $updata["bankname"] = trim($data["bankname"]);
            empty($updata['bankname']) && $this->error('参数不允许为空!');
            !isset($data["img"]) && $this->error("参数非法!");
            $updata["img"] = trim($data["img"]);
            empty($updata['img']) && $this->error('参数不允许为空!');
            !isset($data["zy_radio"]) && $this->error("参数非法!");
            $updata["zy_radio"] = trim($data["zy_radio"]);
            empty($updata['zy_radio']) && $this->error('参数不允许为空!');
            !is_numeric($updata['zy_radio']) && $this->error('参数类型不正确!');
            !isset($data["jl_radio"]) && $this->error("参数非法!");
            $updata["jl_radio"] = trim($data["jl_radio"]);
            empty($updata['jl_radio']) && $this->error('参数不允许为空!');
            !is_numeric($updata['jl_radio']) && $this->error('参数类型不正确!');
            !isset($data["hz_radio"]) && $this->error("参数非法!");
            $updata["hz_radio"] = trim($data["hz_radio"]);
            empty($updata['hz_radio']) && $this->error('参数不允许为空!');
            !is_numeric($updata['hz_radio']) && $this->error('参数类型不正确!');
            !isset($data["yhj_radio"]) && $this->error("参数非法!");
            $updata["yhj_radio"] = trim($data["yhj_radio"]);
            empty($updata['yhj_radio']) && $this->error('参数不允许为空!');
            !is_numeric($updata['yhj_radio']) && $this->error('参数类型不正确!');
            !isset($data["remark"]) && $this->error("参数非法!");
            $updata["remark"] = trim($data["remark"]);
            empty($updata['remark']) && $this->error('参数不允许为空!');
            !isset($data["step"]) && $this->error("参数非法!");
            $updata["step"] = trim($data["step"]);
            empty($updata['step']) && $this->error('参数不允许为空!');          
            /*引用型的请自行验证 
            !empty(Db::name('user')->where('username',$updata['username'])->find()) && $this->error('不存在,请重新输入!');
            */
            try{
                $result =Db::name('bank')->insertGetId($updata);
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
				$result = Db::name('bank')->where('id',intval($data['id']))->delete();
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
            $updata["bankname"] = trim($data["bankname"]);
            empty($updata['bankname']) && $this->error('参数不允许为空!');
           $updata["img"] = trim($data["img"]);
           empty($updata['img']) && $this->error('参数不允许为空!');
            $updata["zy_radio"] = trim($data["zy_radio"]);
            empty($updata['zy_radio']) && $this->error('参数不允许为空!');
            !is_numeric($updata['zy_radio']) && $this->error('参数类型不正确!');
            $updata["jl_radio"] = trim($data["jl_radio"]);
            empty($updata['jl_radio']) && $this->error('参数不允许为空!');
            !is_numeric($updata['jl_radio']) && $this->error('参数类型不正确!');
            $updata["hz_radio"] = trim($data["hz_radio"]);
            empty($updata['hz_radio']) && $this->error('参数不允许为空!');
            !is_numeric($updata['hz_radio']) && $this->error('参数类型不正确!');
            $updata["yhj_radio"] = trim($data["yhj_radio"]);
            empty($updata['yhj_radio']) && $this->error('参数不允许为空!');
            !is_numeric($updata['yhj_radio']) && $this->error('参数类型不正确!');
            $updata["remark"] = trim($data["remark"]);
            empty($updata['remark']) && $this->error('参数不允许为空!');
            $updata["step"] = trim($data["step"]);
            empty($updata['step']) && $this->error('参数不允许为空!');
            try{
				Db::name('bank')->where('id',intval($data['id']))->update($updata);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('修改成功!');	 
       }else{
            $list = Db::name('bank')->where('id',intval($data['id']))->find();
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
            if(!in_array($data['field'],['bankname','zy_radio','jl_radio','hz_radio','yhj_radio','remark','step'])){ 
               $this->error('字段非法!'); 
            }	
			$data['value'] = trim($data['value']);
            try{
                $id = intval($data['data']['id']);
            }catch(\Exception $e){
                $this->error('ID错误!');
            }	            
			try{
				Db::name('bank')->where('id',$id)->setField($data['field'],$data['value']);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('');	
		}
    }
    
}