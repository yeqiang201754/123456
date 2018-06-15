<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Cookie;
use think\Request;
use think\Session;
/**
* @name='登录'
*/
class Login extends Controller
{

  public function index()
  {
    return view();
  }
  
	public function login()
  {
    $data = $_POST;
    if(!preg_match("/^1[34578]{1}\d{9}$/",$data['mobile'])){
      return $this->error('手机号码格式错误');
    }

    $user = Db::table('user')->where('mobile',$data['mobile'])->find();
    if(md5($data['password']) != $user['password']){
      return $this->error('手机号或密码错误');
    }else{
      Session::set('user_id',$user['id']);
      return $this->success('登录成功');
    }

  }

  public function loginout()
  {
    Session::pull('user_id');
    $this->redirect('Login/index');
  }
	
}
