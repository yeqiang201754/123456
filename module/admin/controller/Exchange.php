<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
/**
* @name='积分兑换规则' 
*/
class Exchange extends Base
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
        $v_bankid = isset($data["bankname"]) ? trim($data["bankname"]):null;

        $db = Db::name("exchange")->field('exchange.*,bank.bankname')->join('bank','exchange.bankid = bank.id');
        !empty($v_bankid) && $db = $db->where("bank.bankname",$v_bankid);
        $data_list = $db->order("id desc")->limit($current_begin,$pagenum)->select();

        
        $db = Db::name("exchange")->field('exchange.*,bank.bankname')->join('bank','exchange.bankid = bank.id');
        !empty($v_bankid) && $db = $db->where("bank.bankname",$v_bankid);
        $data_count = $db->count("exchange.id"); 
        return $this->to_table_data($data_list,$data_count);           
    }  
        
    /**
    * @name='添加'
    */
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $updata= array();
            !isset($data["price"]) && $this->error("参数非法!");
            $updata["price"] = trim($data["price"]);
            empty($updata['price']) && $this->error('参数不允许为空!');
            !is_numeric($updata['price']) && $this->error('参数类型不正确!');
            $updata["click"] = trim($data["click"]);
            $updata["name"] = trim($data["name"]);
            !isset($data["bankid"]) && $this->error("参数非法!");
            $updata["bankid"] = trim($data["bankid"]);
            empty($updata['bankid']) && $this->error('参数不允许为空!');
            !is_numeric($updata['bankid']) && $this->error('参数类型不正确!');          
            /*引用型的请自行验证 
            !empty(Db::name('user')->where('username',$updata['username'])->find()) && $this->error('不存在,请重新输入!');
            */
            try{
                $result =Db::name('exchange')->insertGetId($updata);
                if(!$result){
                    $this->error('新增失败!');
                }
            } catch (\Exception $e) {
                $this->error('新增失败!');
            }
            $this->success('新增成功!');	 
        }else{ 
            $bank = Db::name('bank')->select();
            $this->assign('bank',$bank);
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
				$result = Db::name('exchange')->where('id',intval($data['id']))->delete();
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
            $updata["price"] = trim($data["price"]);
            empty($updata['price']) && $this->error('参数不允许为空!');
            !is_numeric($updata['price']) && $this->error('参数类型不正确!');
            $updata["click"] = trim($data["click"]);
            $updata["name"] = trim($data["name"]);
            $updata["bankid"] = trim($data["bankid"]);
            empty($updata['bankid']) && $this->error('参数不允许为空!');
            !is_numeric($updata['bankid']) && $this->error('参数类型不正确!');
            try{
				Db::name('exchange')->where('id',intval($data['id']))->update($updata);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('修改成功!');	 
       }else{

            $bank = Db::name('bank')->select();
            $list = Db::name('exchange')->where('id',intval($data['id']))->find();
            $this->assign('list',$list);
            $this->assign('bank',$bank);
            return view();
       } 
    }
    
    
    /**
    ** @name='修改字段'
    */    
    public function modify_field(){
		if(request()->isPost()){
			$data=input('post.'); 
            if(!in_array($data['field'],['price','click','bankid'])){ 
               $this->error('字段非法!'); 
            }	
			$data['value'] = trim($data['value']);
            try{
                $id = intval($data['data']['id']);
            }catch(\Exception $e){
                $this->error('ID错误!');
            }	            
			try{
				Db::name('exchange')->where('id',$id)->setField($data['field'],$data['value']);
			} catch (\Exception $e) {
				$this->error('修改失败!');
			}
			$this->success('');	
		}
    }
    
}