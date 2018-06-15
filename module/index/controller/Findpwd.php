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
class Findpwd extends Controller
{

  public function index()
  { 
    return view();
  }
  
  public function save()
  { 
    $data = $_POST;
    if(empty($data['mobile']) || empty($data['password']) || empty($data['password2'])){
      return $this->error('数据未填完整');
    }
    if($data['password'] != $data['password2']){
      return $this->error('两次输入的密码不一致');
    }

    //查询验证码是否正确
    $is = Session::has($data['mobile']);
    if(!$is){
      return $this->error('验证码错误');
    }
    $t_code = Session::get($data['mobile']);
    if($t_code != $data['txt_vcode']){
      return $this->error('验证码不正确，请重新输入');
    }

    $result = Db::name('user')->where('mobile',$data['mobile'])->update(array('password'=>md5($data['password'])));
    if($result){
      return $this->success('修改成功');
    }else{
      return $this->error('修改失败');
    }
  }

  public function verification(){
    //查询手机号是否存在
    $data = $_POST;
    if(!preg_match("/^1[34578]{1}\d{9}$/",$data['mobile'])){
      return $this->error('手机号码格式错误');
    }
    $user = Db::name('user')->where('mobile',$data['mobile'])->find();
    if(empty($user)){
      return $this->error('该手机号尚未注册');
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
