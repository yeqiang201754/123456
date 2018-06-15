<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
/**
* @name='首页'
*/
class User extends Controller
{

	/**
	* @name='首页'
	*/
	public function __construct(){
		parent::__construct();
		$is = Session::has('user_id');
		if($is){
			$this->user_id = Session::get('user_id');
		}else{
			$this->redirect('Login/index');
		}
		$this->withdraw_min = Db::name('config')->where('key','withdraw_min')->value('value');
		$this->withdraw_fee = Db::name('config')->where('key','withdraw_fee')->value('value');
		$this->user = Db::name('user')->where('id',$this->user_id)->find();
	} 
	public function index()
	{
		//查询用户基本信息
		$user = Db::name('user')->where('id',$this->user_id)->find();
		if($user['grade'] == 'zy'){
			$user['grade'] = '专员';
		}
		if($user['grade'] == 'jl'){
			$user['grade'] = '经理';
		}
		if($user['grade'] == 'hz'){
			$user['grade'] = '行长';
		}
		if($user['grade'] == 'yhj'){
			$user['grade'] = '银行家';
		}
		//查询团队人数
		$team_count = Db::name('user')->where('team',$user['team'])->where('team','neq','0')->count();
		//查询订单
		$waite = Db::name('order')->where('user_id',$this->user_id)->where('status',1)->count();
		$success = Db::name('order')->where('user_id',$this->user_id)->where('status',2)->count();
		$fail = Db::name('order')->where('user_id',$this->user_id)->where('status',3)->count();

		$erweima = Db::name('config')->where('key','erweima')->value('value');
		$sowing = Db::name('sowing')->where('position',2)->select();  
		$this->assign('sowing',$sowing);
		$this->assign('erweima',$erweima);
		$this->assign('waite',$waite);
		$this->assign('success',$success);
		$this->assign('fail',$fail);
		$this->assign('team_count',$team_count+1);
		$this->assign('user',$user);
		return view();
	}

	public function order()
	{
		$data = $_GET;
		$status = isset($_GET['status'])?$_GET['status']:'1';
		$data['page'] = isset($data['page']) ? $data['page'] : 1;
		$pagenum = isset($data['limit']) ? intval($data['limit']) : 5;
		$current_begin = (intval($data['page']) -1) * $pagenum;
		$order = Db::name('order')->field('order.*,bank.bankname')->join('bank','bank.id=order.bankid')->where('user_id',$this->user_id)->where('status',$status)->limit($current_begin,$pagenum)->select();
		$this->assign('order',$order);
		$this->assign('status',$status);
		return view();
	}

	public function get_order(){
		$data = $_POST;
		$status = isset($_POST['status'])?$_POST['status']:'1';
		$data['page'] = isset($data['page']) ? $data['page'] : 1;
		$pagenum = isset($data['limit']) ? intval($data['limit']) : 5;
		$current_begin = (intval($data['page']) -1) * $pagenum;
		$order = Db::name('order')->field('order.*,bank.bankname')->join('bank','bank.id=order.bankid')->where('user_id',$this->user_id)->where('status',$status)->limit($current_begin,$pagenum)->select();
		foreach($order as $key=> $val){
			if($val['mark'] == null){
				$order[$key]['mark'] = '没有备注'; 
			}
			if($val['status'] == 1){
				$order[$key]['status'] = '交易中';
			}
			if($val['status'] == 2){
				$order[$key]['status'] = '成功';
			}
			if($val['status'] == 3){
				$order[$key]['status'] = '失败';
			}
		}
		return $this->success('','',$order);
	}

	public function withdraw()
	{
		
		//银行
		$bank = Db::name('bank')->select();
		$this->assign('bank',$bank);
		$this->assign('withdraw_min',$this->withdraw_min);
		$this->assign('withdraw_fee',$this->withdraw_fee);
		$this->assign('user',$this->user);
		return view();
	}

	public function withdraw_save()
	{
		$data = $_POST;
		if(empty($data['amount']) || empty($data['bank']) || empty($data['branch']) || empty($data['name']) || empty($data['idnum'])){
			return $this->error('信息未填写完整');
		}

		if($data['amount'] < $this->withdraw_fee){
			return $this->error('最低提现不低于'.$this->withdraw_fee);
		}

		if($data['amount'] > $this->user['balance'] - $this->withdraw_fee){
			return $this->error('您的可用余额不足');
		}

		$data['addtime'] = date('Y-m-d H:i:s');
		$data['user_id'] = $this->user_id;
		$data['status'] = 0;
		$data['withdraw_fee'] = $this->withdraw_fee;
		//存入提现表和减少用户的可用余额
		// 启动事务
		Db::startTrans();
		try{
			$dec = Db::name('user')->where('id',$this->user_id)->setDec('balance',$data['amount']+$this->withdraw_fee);
			$inc = Db::name('user')->where('id',$this->user_id)->setInc('lock_balance',$data['amount']+$this->withdraw_fee);
			$result = Db::name('withdraw')->insert($data);
			// 提交事务
			Db::commit();
		} catch (\Exception $e) {
			// 回滚事务
			Db::rollback();
			return $this->error('提交失败');
		}
		return $this->success('提交成功，请等待管理员审核');
		
	}

	public function withdraw_log()
	{
		$data = $_GET;
		$data['page'] = isset($data['page']) ? $data['page'] : 1;
		$pagenum = isset($data['limit']) ? intval($data['limit']) : 10;
		$current_begin = (intval($data['page']) -1) * $pagenum;
		$begin = isset($_GET['beginTime'])?$_GET['beginTime']:'';
		$end = isset($_GET['endTime'])?$_GET['endTime']:'';

		if($begin == ''){
			$begin = date('Y-m-d',strtotime('-30 day'));
		}
		if($end == ''){
			$end = date('Y-m-d',strtotime('+30 day'));
		}

		$where = array();
		if($begin){
			$where['addtime'] = array('between',array($begin,$end));
		}
		$withdraw_log = Db::name('withdraw')->where('user_id',$this->user_id)->where($where)->limit($current_begin,$pagenum)->select();
		
		$this->assign('withdraw_log',$withdraw_log);
		$this->assign('begin',$begin);
		$this->assign('end',$end);
		return view();
	}

	public function get_withdraw_log()
	{
		$data = $_POST;
		$begin = isset($data['beginTime'])?$data['beginTime']:'';
		$end = isset($data['endTime'])?$data['endTime']:'';
		$data['page'] = isset($data['page']) ? $data['page'] : 1;
		$pagenum = isset($data['limit']) ? intval($data['limit']) : 10;
		$current_begin = (intval($data['page']) -1) * $pagenum;

		$where = array();
		if($begin){
			$where['addtime'] = array('between',array($begin,$end));
		}
		$withdraw_log = Db::name('withdraw')->where('user_id',$this->user_id)->where($where)->limit($current_begin,$pagenum)->select();
		foreach($withdraw_log as $key => $val){
			$withdraw_log[$key]['addtime'] = date('Y-m-d',strtotime($val['addtime']));
			if($val['status'] == '0'){
				$withdraw_log[$key]['status'] = '待审核';
			}
			if($val['status'] == '1'){
				$withdraw_log[$key]['status'] = '审核已通过';
			}
			if($val['status'] == '2'){
				$withdraw_log[$key]['status'] = '审核未通过';
			}
		}
		return $this->success('','',$withdraw_log);
	}
	
	public function notice()
	{
		$notice = Db::name('notice')->select();
		$this->assign('notice',$notice);
		return view();
	}

	public function notice_detail()
	{
		$id = isset($_GET['id'])?$_GET['id'] :'';
		$notice = Db::name('notice')->where('id',$id)->find();
		$this->assign('notice',$notice);
		return view();
	}
}
