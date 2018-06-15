<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session; 
use \databackup\Backup;
/**
* @name='数据库备份'
*/
class Databackup extends Base
{
  public function _initialize(){		
		parent::_initialize();   
	}
  /**
  ** @name='首页'
  */
  public function index(){
    $db= new Backup();
    return $this->fetch('index',['list'=>$db->dataList()]);
  }
  /**
  ** @name='数据'
  */
  public function data(){
    $db= new Backup();
    $data = $db->dataList();
    return $this->to_table_data($data,count($data));
  }
  /**
  ** @name='备份'
  */
  public function export(){
    $db= new Backup();
    if(Request::instance()->isPost()){
        $input=input('post.');          
        $fileinfo  =$db->getFile();
        //检查是否有正在执行的任务
        $lock = "{$fileinfo['filepath']}backup.lock";
        if(is_file($lock)){
            $this->error('检测到有一个备份任务正在执行，请稍后再试！');
        } else {
            //创建锁文件
            file_put_contents($lock,time());
        }
           // 检查备份目录是否可写
        is_writeable($fileinfo['filepath']) || $this->error('备份目录不存在或不可写，请检查后重试！');       
        //创建备份文件
        if(false !== $db->Backup_Init()){
            foreach($input['tables'] as $tb){
               $start= $db->setFile($fileinfo['file'])->backup($tb, 0);
               if($start === false){
                  $this->error('备份出错.！');
               }
            } 
            unlink($lock);                     
            $this->success('备份完成！');
           // $this->success('初始化成功！','',['tab'=>['id' => 0, 'start' => 0]]);
        }else{
            $this->error('初始化失败，备份文件创建失败！');
        }
    }      
  }
  /**
  ** @name='修复表'
  */
   public function repair($tables= null){
    $db= new Backup();
    if($db->repair($tables)){
           return $this->success("数据表修复完成！");
    }else{
           return $this->error("数据表修复出错请重试");
    }
  }
  /**
  ** @name='优化表'
  */
  public function optimize($tables= null){
    $db= new Backup();
    if($db->optimize($tables)){
      return $this->success("数据表优化完成！");
    }else{
      return $this->error("数据表优化出错请重试！");
    }
  }
 
  /**
  * @name='备份文件'
  */   
  public function importlist(){
    return view();
  }
  /**
  * @name='备份文件列表'
  */ 
  public function datalist(){
      $db= new Backup();
      $data = $db->fileList();
      foreach($data as $k=>$d){
         $data[$k]['t'] = date('Ymd-His',$d['time']);       
      }
      return $this->to_table_data($data,count($data)); 
  }
  /**
  * @name='删除备份'
  */
   public function del($time = 0){
       $db= new Backup();
       if($db->delFile($time)){       
           $this->success("备份文件删除成功！");
       }else{
           $this->error("备份文件删除失败，请检查权限！");
       }
   }
  /**
  * @name='还原备份'
  */   
  public function import($time = 0){
    if(Request::instance()->isPost()){
        $db= new Backup();
        if(is_numeric($time)){
            $list = $db->getFile('timeverif',$time);
            if(is_array($list)){  
                $start= $db->setFile($list)->import(0);      
                if($start === false ){
                    $this->error('还原文件出错！');
                }else{            
                    $this->success('还原完成！');
                }        
            }else{
              $this->error('备份文件可能已经损坏，请检查！');
            }
        }else{
            $this->error('参数错误！');
        }
    }
  }

}

 