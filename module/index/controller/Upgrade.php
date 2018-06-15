<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Log;
use think\Session;

/**
* @name='首页'
*/
class Upgrade extends Controller
{

	/**
	* @name='首页'
	*/
	public function __construct(){
		parent::__construct();
		
		$is = Session::has('user_id');
		
		if(request()->action() != 'notify'){
			if($is){
			$this->user_id = Session::get('user_id');
			$this->user = Db::name('user')->where('id',$this->user_id)->find();
			}else{
				$this->redirect('/index/login/index');
			}
		}
		
	} 
    public function index()
    {
		if($this->user['grade'] == 'zy'){
			$this->user['grade'] = '专员';
		}
		if($this->user['grade'] == 'jl'){
			$this->user['grade'] = '经理';
		}
		if($this->user['grade'] == 'hz'){
			$this->user['grade'] = '行长';
		}
		if($this->user['grade'] == 'yhj'){
			$this->user['grade'] = '银行家';
		}

		$zy = Db::name('interest')->where('level','zy')->find();
		$bank = Db::name('bank')->select();
		$jl = Db::name('interest')->where('level','jl')->find();
		$hz = Db::name('interest')->where('level','hz')->find();
		$yhj = Db::name('interest')->where('level','yhj')->find();
		
		$this->assign('zy',$zy);
		$this->assign('jl',$jl);
		$this->assign('hz',$hz);
		$this->assign('yhj',$yhj);
		$this->assign('bank',$bank);
		$this->assign('user',$this->user);
		return view('Upgrade/index');
	}

	 
/*******************支付所需的逻辑********************** */
	public function pay(){
		//判断用户需要支付
		$level_jl = Db::name('interest')->where('level','jl')->find();
		$level_hz = Db::name('interest')->where('level','hz')->find();
		$level_yhj = Db::name('interest')->where('level','yhj')->find();

		$data = $_GET;
		$data['type'] = isset($data['type']) ? $data['type'] : '';
		if(empty($data['type'])){
			return $this->error('未知错误');
		}
		if($this->user['grade'] == 'zy'){
			if($data['type'] == 'jl'){
				$up_pay = $level_jl['up'];
			}elseif($data['type'] == 'hz'){
				$up_pay = $level_jl['up']+$level_hz['up'];
			}elseif($data['type'] == 'yhj'){
				$up_pay = $level_jl['up']+$level_hz['up']+$level_yhj['up'];
			}
		}elseif($this->user['grade'] == 'jl'){
			if($data['type'] == 'hz'){
				$up_pay = $level_hz['up'];
			}elseif($data['type'] == 'yhj'){
				$up_pay = $level_hz['up']+$level_yhj['up'];
			}
		}elseif($this->user['grade'] == 'hz'){
			if($data['type'] == 'yhj'){
				$up_pay = $level_yhj['up'];
			}
		}

		$APPID = Db::name('config')->where('key','APPID')->value('value');
		$MCHID = Db::name('config')->where('key','MCHID')->value('value');
		$KEY = Db::name('config')->where('key','KEY')->value('value');
		$APPSECRET = Db::name('config')->where('key','APPSECRET')->value('value');

		$config = array('APPID' => $APPID,
						'MCHID'=> $MCHID,
						'KEY' => $KEY,
						'APPSECRET'=>$APPSECRET,
					);
		
		$wechat = new \wechat\pay($config);
		$order_num = time().rand(100,999);
		//$order = array('Total_fee' => $up_pay*100,'order_num' => $order_num);		
		$order = array('Total_fee' => 1,'order_num' => $order_num);				
		$pay_data = $wechat->pay($order);
		//var_dump($pay_data);exit;
		$insert_data = array(
			'user_id' => $this->user_id,
			'order_num' => $order_num,
			'pay' => $up_pay,
			'addtime' => date('Y-m-d H:i:s'),
			'grade' => $data['type']
		);

		$result = Db::name('paylog')->insertGetid($insert_data);
		if(empty($result)){
			echo '订单生成失败';exit;
		}
		//var_dump($pay_data['jsApiParameters']);exit;
		$this->assign('pay_data',$pay_data);
		$this->assign('order_num',$order_num);
		$this->assign('total_fee',$up_pay);
		return view('Upgrade/pay');
		
	}
	
	
	public function notify(){
		
		//$xml = $GLOBALS['HTTP_RAW_POST_DATA'];  
		$xml = file_get_contents("php://input");
		// 这句file_put_contents是用来查看服务器返回的XML数据 测试完可以删除了  
		//file_put_contents('log22.txt',$xml."\r\n",FILE_APPEND);  
		  
		//将服务器返回的XML数据转化为数组  
		$data = json_decode(json_encode(simplexml_load_string($xml,'SimpleXMLElement',LIBXML_NOCDATA)),true);  
		 
		file_put_contents('log1000.txt',var_export($data,true)."\r\n",FILE_APPEND);  
			
			
		// 判断签名是否正确  判断支付状态  
		if ( ($data['return_code']=='SUCCESS') && ($data['result_code']=='SUCCESS') ) {  
			//$result = $data;  
			$order_num = $data['out_trade_no']; 
			//file_put_contents('1.txt',$order_num."\r\n",FILE_APPEND);
			$order = Db::name('paylog')->where('order_num',$order_num)->find();
			//file_put_contents('cccc.txt',"--".var_export($order,true)."\r\n",FILE_APPEND);
			if($order['status'] == 1){
				echo 'SUCCESS';exit;
			}
			Db::startTrans();
			try{
				//修改用户的等级
				
				$dengji = Db::name('user')->where('id',$order['user_id'])->update(array('grade' => $order['grade']));
				
				$user_info = Db::name('user')->where('id',$order['user_id'])->find();
				//用户的直接邀请人
				//$user_info_one = Db::name('user')->where('id',$user_info['invite_one'])->find();
				//查询用户的上级
				
				if($user_info['invite_one']){
					//用户的直接邀请人
					$user_one = Db::name('user')->where('id',$user_info['invite_one'])->find();
					$levelzj = Db::name('interest')->where('level',$user_one['grade'])->value('sjfy');
					$fanyong = $order['pay']*$levelzj/100;
					//直接推荐用户返佣
					//$shangji = $this->fanyong($this->user['invite_one'],$fanyong);
					$fy = Db::name('user')->where('id',$order['user_id'])->inc('balance',$fanyong)->inc('profit',$fanyong)->update();
					//增加佣金记录
					$remark = '您的直接推荐用户'.$user_info['invite_one'].'升级获得佣金';
					$arr = array();
					$arr['user_id'] = $user_info['invite_one'];
					$arr['amount'] = $fanyong;
					$arr['remark'] = $remark;
					$arr['addtime'] = date('Y-m-d H:i:s');
					
					$result = Db::name('comlog')->insert($arr);
					//查询推荐人的上级
					$user_two = Db::name('user')->where('id',$user_info['invite_two'])->find();
					if($user_two){
						$leveljj = Db::name('interest')->where('level',$user_two['grade'])->value('jjsjfy');
						$fanyong2 = $order['pay']*$leveljj/100;
						//间接推荐用户返佣
						$u_f_t = Db::name('user')->where('id',$user_info['invite_two'])->inc('balance',$fanyong2)->inc('profit',$fanyong2)->update();
						//增加佣金记录
						$remark = '您的间接推荐用户'.$user_info['username'].'升级获得佣金';
						$arr = array();
						$arr['user_id'] = $user_info['invite_two'];
						$arr['amount'] = $fanyong2;
						$arr['remark'] = $remark;
						$arr['addtime'] = date('Y-m-d H:i:s');
						
						$comlogtwo = Db::name('comlog')->insert($arr);
						
					}
				}
				
				$upda = Db::name('paylog')->where('order_num',$order_num)->update(array('status'=>1));
				Db::commit();
				
			} catch (\Exception $e) {
				// 回滚事务
				Db::rollback();
				echo 'FAIL';exit;
			}
			echo 'SUCCESS';exit;

		}
		
		/*	
		$config = array('APPID' => 'wxda449a3ea330db75',
						'MCHID'=> '1489037672',
						'KEY' => 'GOkQU8WRJB9817AEjrmCuHKNYYLm75d8',
						'APPSECRET'=>'4247301715d8a534688bb39ebb878354',
					);
		*/
		//$notify = new \wechat\notify();
		
		
		//file_put_contents("23nnnn.txt","--------".var_export($notify,true),FILE_APPEND);
		//return $notify->result;
		//var_dump($notify->result);exit;
		//file_put_contents("0aaaaa.txt","--------".var_export($notify->result,true),FILE_APPEND);exit;
		
	}
	
	//增加佣金记录
	private function addcomlog($userid,$amount,$remark){
		$arr = array();
		$arr['user_id'] = $userid;
		$arr['amount'] = $amount;
		$arr['remark'] = $remark;
		$arr['addtime'] = date('Y-m-d H:i:s');
		
		$result = Db::name('comlog')->insert($arr);
		return $result;
		
	}
	//用户返佣
	private function fanyong($userid,$fanyong){
		$result = Db::name('user')->where('id',$userid)->inc('balance',$fanyong)->inc('profit',$fanyong)->update();
		return $result;
	}
	//用户详情
	private function userinfo($userid){
		$result =  Db::name('user')->where('id',$userid)->find();
		return $result;
	}
	
	public function order(){
		$order_num = isset($_GET['order_num'])?$_GET['order_num']:'';
		if(!empty($order_num)){
			$order = Db::name('paylog')->where('status',1)->where('order_num',$order_num)->find();
			if($order){
				return $this->success();
			}
		}
		
	}
	
}
