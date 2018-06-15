<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
/**
* @name='提现列表' 
*/
class Withdraw extends Base
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
        $v_bank = isset($data["bank"]) ? trim($data["bank"]):null;
        $username = isset($data["username"]) ? trim($data["username"]):null;
        $v_status = isset($data["status"]) ? trim($data["status"]):null;
        
        if($v_status != ''){
            $v_status = $v_status+1;
        }
        

        $db = Db::name("withdraw")->field('withdraw.*,user.username,user.mobile')->join('user','user.id = withdraw.user_id'); 
        !empty($v_bank) && $db = $db->where("withdraw.bank",$v_bank);
        !empty($username) && $db = $db->where("user.username",$username);
        !empty($v_status) && $db = $db->where("withdraw.status",$v_status-1);
        $data_list = $db->order("id desc")->limit($current_begin,$pagenum)->select();
        foreach($data_list as $key => $val){
            if($val['status'] == 0){
                $data_list[$key]['status'] = '待审核';
            }
            if($val['status'] == 1){
                $data_list[$key]['status'] = '审核通过';
            }
            if($val['status'] == 2){
                $data_list[$key]['status'] = '审核未通过';
            }
        }
        $db = Db::name("withdraw")->field('withdraw.*,user.username,user.mobile')->join('user','user.id = withdraw.user_id'); 
        !empty($v_bank) && $db = $db->where("withdraw.bank",$v_bank);
        !empty($username) && $db = $db->where("user.username",$username);
        !empty($v_status) && $db = $db->where("withdraw.status",$v_status-1);
        $data_count = $db->count("withdraw.id"); 
        return $this->to_table_data($data_list,$data_count);           
    }  
        
    
    /**
    * @name='删除'
    */  
    public function del(){
        if(request()->isPost()){
			$data=input('post.');
            try{
                /*请自己增加删除前判断*/
				$result = Db::name('withdraw')->where('id',intval($data['id']))->delete();
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
     * 审核
     */
    public function status(){


        if(request()->isPost()){
            $data=input('post.');
            $withdraw = Db::name('withdraw')->where('id',intval($data['id']))->find();

            Db::startTrans();
            if($data['status'] == 1){//审核成功
                try{
                    Db::name('withdraw')->where('id',intval($data['id']))->update(['status' => '1']);
                    //减去用户锁定的金额
                    Db::name('user')->where('id',$withdraw['user_id'])->setDec('lock_balance',$withdraw['withdraw_fee']+$withdraw['amount']);
                    Db::commit();
                } catch (\Exception $e) {
                    Db::rollback();
                    $this->error('操作失败!');
                }
                $this->success('操作成功!');
            }else{//审核失败

                try{
                    Db::name('withdraw')->where('id',intval($data['id']))->update(['status' => '2']);
                    //减去用户锁定的金额,返还用户扣除的金额
                    Db::name('user')->where('id',$withdraw['user_id'])->setDec('lock_balance',$withdraw['withdraw_fee']+$withdraw['amount']);
                    Db::name('user')->where('id',$withdraw['user_id'])->setInc('balance',$withdraw['withdraw_fee']+$withdraw['amount']);
                    Db::commit();
                } catch (\Exception $e) {
                    Db::rollback();
                    $this->error('操作失败!');
                }
                $this->success('操作成功!');
            }
        }     
    }
    
    
    
}