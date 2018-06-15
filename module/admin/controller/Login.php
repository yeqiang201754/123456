<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;

class Login extends Jcb
{
    public function _initialize(){		
		parent::_initialize();
	} 
    
    public function index(){
		if (request()->isPost()) { 
            $data=input('post.');	
            $m = Db::name('jcb_sys_member')->where('username',$data['username'])->find();
            empty($m) && $this->error('登陆名不存在!');           
            strtolower(md5(trim($data['password']))) != $m['password'] && $this->error('密码错误!'); 
            $m['cstatus'] == 0 && $this->error('帐户已经被禁用!');
            session('uid',$m['id']); 
			$this->success('',url('@admin/index/index'));
		}else{
            if(Session::has('uid')){
                  Session::delete('uid');
            } 
            return view();
        }

	}

    public function upload(){
        $file = request()->file('file');   
        if($file){
            $info = $file->validate(['ext'=>$this->config['uploadtype']])->move(ROOT_PATH . 'public' . DS . 'uploads');          
            $data= array();
            if($info){ 
                $data['code'] = 1;
                $data['msg'] ='上传成功!';
                $data['data']['src'] ='/uploads/'.$info->getSaveName();  
            }else{               
                $data['code'] = 0;
                $data['msg'] ='上传失败,请检查文件类型是否允许上传!';
            }
            return $data;
        }
    
    }
 
}