<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
/**
* @name='订单' 
*/
class Order extends Base
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
        $username = isset($data["username"]) ? trim($data["username"]):null;
        $v_status = isset($data["status"]) ? trim($data["status"]):null;

		$current_begin = (intval($data['page']) -1) * $pagenum;
        $db = Db::name("order")->field('user.username,user.mobile,bank.bankname,order.*')->join('user','order.user_id = user.id')->join('bank','bank.id = order.bankid');
        !empty($username) && $db = $db->where("user.username",$username);
        !empty($v_status) && $db = $db->where("order.status",$v_status);
        $data_list = $db->order("id desc")->limit($current_begin,$pagenum)->select();
        foreach($data_list as $key => $val){
            if($val['status'] ==1){
                $data_list[$key]['status'] = '未审核';
            }
            if($val['status'] ==2){
                $data_list[$key]['status'] = '审核通过';
            }
            if($val['status'] ==3){
                $data_list[$key]['status'] = '审核未通过';
            }
        }
        $db = Db::name("order")->field('user.username,user.mobile,bank.bankname,order.*')->join('user','order.user_id = user.id')->join('bank','bank.id = order.bankid');
        !empty($username) && $db = $db->where("user.username",$username);
        !empty($v_status) && $db = $db->where("order.status",$v_status);
        $data_count = $db->count("order.id"); 
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
				$result = Db::name('order')->where('id',intval($data['id']))->delete();
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
            $order = Db::name('order')->where('id',intval($data['id']))->find();

            $user = Db::name('user')->where('id',$order['user_id'])->find();

            Db::startTrans();
            if($data['status'] == 2){//审核成功
                try{
                    //查询用户的等级,每1W积分兑换金额
                    $bank = Db::name('bank')->where('id',$order['bankid'])->find();
                    //用户对应的银行兑换积分比例
                    $radio = $bank[$user['grade'].'_radio'];
                    $bla = $order['num'] / 10000 * $radio;
                    // $bla = $order['amount'];
                    $member = Db::name('user')->where('id',$user['id'])->inc('balance',$bla)->inc('profit',$bla)->update();
                    //增加佣金记录
                    $arr = array();
                    $arr['user_id'] = $user['id'];
                    $arr['amount'] = $bla;
                    $arr['remark'] = '用户'.$user['username'].'兑换积分获得金额';
                    $arr['addtime'] = date('Y-m-d H:i:s');
                    $comlogmem = Db::name('comlog')->insert($arr);

                    //查询用户的上级
                    $shangji = Db::name('user')->where('id',$user['invite_one'])->find();
                    
                    if($shangji){
                        $radiosj = $bank[$shangji['grade'].'_radio'];
                        //如果用户的上级不是专员，则赚取积分兑换差价
                        if($shangji['grade'] != 'zy'){
                            if($radiosj > $radio){//上级等级高于用户才赚取差价
                                $chajia = $radiosj-$radio;
                                $totalcj = $chajia * $order['num'] / 10000;
                                $shangji = Db::name('user')->where('id',$user['invite_one'])->inc('balance',$totalcj)->inc('profit',$totalcj)->update();
                                // $profit = Db::name('user')->where('id',$user['invite_one'])->setInc('profit',$totalcj);
                                //增加佣金记录
                                $row = array();
                                $row['user_id'] = $user['invite_one'];
                                $row['amount'] = $totalcj;
                                $row['remark'] = '您的下级用户'.$user['username'].'兑换积分获得佣金';
                                $row['addtime'] = date('Y-m-d H:i:s');
                                $comlog = Db::name('comlog')->insert($row);
                            }
                        }
                    }
                    $result = Db::name('order')->where('id',intval($data['id']))->update(['status' => '2']);
                    Db::commit();
                } catch (\Exception $e) {
                    Db::rollback();
                    $this->error('操作失败!');
                }
                $this->success('操作成功!');
            }else{//审核失败
                try{
                    $result = Db::name('order')->where('id',intval($data['id']))->update(['status' => '3']);
                    if(!$result){
                        $this->error('操作失败!');
                    }
                } catch (\Exception $e) {
                    $this->error('操作失败!');
                }
                $this->success('操作成功!');
            }
        }     
    }
    
}