<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Cookie;
use think\Request;
use think\Session;
use think\Cache;
/**
* @name='登录'
*/
class Register extends Controller
{

  public function index()
  {
    $invite = isset($_GET['invite'])?$_GET['invite']:'';
    $this->assign('invite',$invite);
    
    $username = Db::table('user')->where('id',$invite)->value('username');
    $this->assign('username',$username);
    return view();
  }

  public function save()
  {
    $data = $_POST;

    if(empty($data['username']) || empty($data['password']) || empty($data['password2'])){
      return $this->error('用户名和密码不能为空');
    }

    if($data['password'] != $data['password2']){
      return $this->error('两次输入的密码不一致');
    }
    if(strlen($data['password']) < 6){
      return $this->error('密码必须设置6个字符以上');
    }
    if(!preg_match("/^1[34578]{1}\d{9}$/",$data['mobile'])){
      return $this->error('手机号码格式错误');
    }
    
    //查询手机号是否存在
    $is = Db::table('user')->where('mobile',$data['mobile'])->find();
    if(!empty($is)){
      return $this->error('手机号码已注册');
    }
    //查询验证码是否正确
    $t_code = Session::get($data['mobile']);
    if($t_code != $data['txt_vcode']){
      return $this->error('验证码不正确，请重新输入');
    }
    //有推荐人
    $user = Db::table('user')->where('id',$data['invite_one'])->find();
    if($user){
      $data['invite_two'] = $user['invite_one'];
      if($user['team'] ==0){
        $data['team'] = $user['id'];
      }else{
        $data['team'] = $user['team'];
      }
    }else{//若没有推荐人，则为创始人
      $data['team'] = 0;
    }

    $data['password'] = md5($data['password']);
    unset($data['password2']);
    unset($data['txt_vcode']);
    $data['addtime'] = date('Y-m-d H:i:s');
    $data['grade'] = 'zy';
    $user_id = Db::table('user')->insertGetId($data);
    if($user_id){
      Session::set('user_id',$user_id);
      return $this->success('注册成功');
    }else{
      return $this->error('注册失败');
    }

    //return view(); 
  } 

  public function verification(){
    //查询手机号是否存在
    $data = $_POST;
    if(!preg_match("/^1[34578]{1}\d{9}$/",$data['mobile'])){
      return $this->error('手机号码格式错误');
    }
    $is = Db::table('user')->where('mobile',$data['mobile'])->find();
    if(!empty($is)){
      return $this->error('手机号码已注册');
    }else{
      $code = mt_rand(10000, 99999); 
      
      Session::set($data['mobile'],$code); 
      $result = sendMsg($data['mobile'],$code);
      // if ($result['Code'] == 'OK') {  
      // return $this->success('验证码已发送，请注意查看');  
      // }  
    }
  }
	
}
