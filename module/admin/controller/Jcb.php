<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Request;

class Jcb extends Controller
{
    protected $config = array(); 
    public function _initialize(){	
        $request = Request::instance();      
        foreach(Db::name('jcb_sys_config')->field('key,val')->where('ishead',0)->select() as $item){
             $this->config[$item['key']] = $item['val'];
        }        
        $this->config['current_url'] = $request->url(true);  
        $this->assign('config',$this->config);  
    }
}