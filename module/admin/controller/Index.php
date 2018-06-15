<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
/**
* @name='首页'
*/
class Index extends Base
{
	public function _initialize(){		
		parent::_initialize();
	}

	/**
	* @name='首页'
	*/
    public function index()
    { 
		$menu_all  = Db::name('jcb_sys_menu')->where('isshow',1)->where('id','in',$this->member['roleval'])->order('sort asc')->select(); 
		$menu_data = ['left'=>array(),'top'=>array()];  
		foreach($menu_all as $menu){
			if($menu['pid'] == 0){
				if($menu['istop'] == 1){
					$menu_data['top'][] = $menu;
				}else if($menu['istop'] == 0){
					$menu_data['left'][] = $menu;
				}
			}			
		}
	 
		foreach($menu_data as $k => $menus){
			$new_menus= array();		 
			foreach($menus as $menu){
				$menu['child'] = array();
				$child_menu =array();
				foreach($menu_all as $a){
					if($a['pid'] == $menu['id']){
						$child_menu[] = $a;
					} 
				} 
				count($child_menu) > 0 && $menu['child'] = $child_menu;
				$new_menus[] = $menu;
			}		
			$menu_data[$k] = $new_menus;  
		}	
		$this->assign('menu',$menu_data);		
		return view();
	}
	/**
	* @name='控制台'
	*/
	public function main(){		
		$info = array(
		'操作系统'=>PHP_OS,
		'运行环境'=>$_SERVER["SERVER_SOFTWARE"],
		'PHP运行方式'=>php_sapi_name(),
		'ThinkPHP版本'=>THINK_VERSION.' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]',
		'上传附件限制'=>ini_get('upload_max_filesize'),
		'执行时间限制'=>ini_get('max_execution_time').'秒',
		'服务器时间'=>date("Y年n月j日 H:i:s"),
		'北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
		'服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
		'剩余空间'=>'未知',//round((disk_free_space(".")/(1024*1024)),2).'M',
		'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
		'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
		'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
		);
		$this->assign('info',$info); 
		return view();
	}
	/**
	* @name='修改密码'
	*/
	public function pwd(){
		if (request()->isPost()) { 
			$data=input('post.');				
			empty(trim($data['oldpwd'])) && $this->error('旧密码不能为空!');
			$data['oldpwd'] = strtolower($data['oldpwd']);
			empty(trim($data['newpwd'])) && $this->error('新密码不能为空!');
			$data['newpwd'] = strtolower($data['newpwd']);
			$data['repwd'] = strtolower($data['repwd']);
			md5(trim($data['oldpwd'])) != $this->member['password']	&& $this->error('旧密码输入不正确!');
			
			trim($data['newpwd']) != trim($data['repwd']) && $this->error('两次新密码不一样!');
			$result = Db::name('jcb_sys_member')->where('id',$this->member['id'])->setField('password',md5(trim($data['newpwd'])));
			if($result){
				$this->success('修改密码成功!');
			}else{
				$this->error('修改密码失败!');
			}
		}
	}
	/**
	* @name='清除缓存'
	*/
	public function clearcache(){
		if (request()->isPost()) { 
			$data=input('post.'); 
			if(is_dir(CACHE_PATH) && isset($data['cache'])) $this->delDirAndFile(CACHE_PATH);
			if(is_dir(LOG_PATH) && isset($data['log'])) $this->delDirAndFile(LOG_PATH);
			if(is_dir(TEMP_PATH) && isset($data['temp'])) $this->delDirAndFile(TEMP_PATH);	
			$this->success('清除成功!');
		
		}
	}

	//遍历删除文件
	protected function delDirAndFile( $dirName )
	{		
		if ($handle = opendir( "$dirName")){
			while ( false !== ( $item = readdir( $handle ) ) ) {
				if( $item != "." && $item != ".." ){
					if(is_dir( "$dirName/$item" ) ){
						$this->delDirAndFile( "$dirName/$item" );
					}else{
						unlink( "$dirName/$item" );
					}
				}
			}
			closedir($handle);
			rmdir($dirName);
		}
	} 
}
