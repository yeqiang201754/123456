<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
/**
* @name='系统设置' 
*/
class System extends Base
{
	public function _initialize(){		
		parent::_initialize();
	}
    /**
    * @name='首页'
    */
    public function index(){
        $data = Db::name('jcb_sys_config')->where('ishide',0)->select();
        $new_data= array();
        foreach($data as $k => $d){
            if($d['pid']==0){
                $new_data[] = $d;
                unset($data[$k]);
            }
        }  
        foreach($new_data as $k => $d){ 
            $new_data[$k]['child'] = array();
            foreach($data as $kk => $dd){
                if($d['id'] == $dd['pid']){
                    $new_data[$k]['child'][]=$dd;
                    unset($data[$kk]);
                }
            } 
        }  
        $this->assign('data',$new_data);
        return view();
    }
    /**
    * @name='保存设置'
    */
    public function save(){
        if(request()->isPost()){
			$data=input('post.');            
            $open_item = Db::name('jcb_sys_config')->where('ctype',4)->where('pid','neq',0)->where('ishide',0)->select();
            foreach($open_item as $item){
                if(array_key_exists($item['key'],$data)){
                    $data[$item['key']] = 1;
                }else{
                     $data[$item['key']] = 0;
                }
            }           
           	Db::startTrans();            	  
			try{
                foreach($data as $k=>$d){ 
                    $data[$k] = trim($d);
                    Db::name('jcb_sys_config')->where('key',$k)->setField('val',trim($d));
                }
			    Db::commit();    
			} catch (\Exception $e) { 
				Db::rollback();
				$this->error('设置失败!');
			} 
            $this->success('设置成功!');
		}
    }

    protected $data = array();    
	protected function get_args($pid,$menus){
		$arr = array();
		foreach($menus as $k => $m){
			if($m['pid']==$pid){
				$m['title'] = '├╌ '.$m['title'];
				$arr[] = $m;
				unset($this->data[$k]);
			}
		}
		return $arr;
	} 

    /**
    * @name='参数列表'
    */
    public function args(){
        $this->data =  Db::name('jcb_sys_config')->order('sort asc')->select();
        $new_data= array();
		foreach($this->data as $k => $d){
			if($d['pid'] == 0 && $d['ishead'] == 1){
				$new_data[]=$d;
				$new_data = array_merge($new_data,$this->get_args($d['id'],$this->data));  
				unset($this->data[$k]);
			}
		}
        $new_data = array_merge($new_data,$this->data);  
        $this->assign('data',$new_data);
        return view();	
    }

    /**
    * @name='增加参数'
    */
    public function add_args(){
        if(request()->isPost()){
			$data=input('post.'); 
            empty(trim($data['title'])) && $this->error('标题必须填写!');
            $new_data =array();
            $new_data['title'] = trim($data['title']);
            $new_data['sort'] = intval($data['sort']);
            if(isset($data['ishead'])){
                $new_data['ishead'] = 1;
                $new_data['pid'] = 0;   
            }else{
                $new_data['ishead'] = 0;
                $new_data['pid'] = intval($data['pid']);
                $new_data['ctype'] = intval($data['ctype']);                
                empty($new_data['ctype']) && $this->error('类型必需选');                
                $new_data['key'] = trim($data['key']);
                empty($new_data['key']) && $this->error('KEY为必填项');
                Db::name('jcb_sys_config')->where('key',$new_data['key'])->find() && $this->error('参数名已经存在,请更换!');
                $new_data['val'] = trim($data['val']);
                $new_data['item'] = trim($data['item']);
                $new_data['cmark'] = trim($data['cmark']);
                isset($data['allowempty']) && $new_data['allowempty'] = 1;
                isset($data['issys']) && $new_data['issys'] = 1;
                isset($data['ishide']) && $new_data['ishide'] = 1;
            }
           $result = Db::name('jcb_sys_config')->insertGetId($new_data); 
           if($result){
                $this->success('新增成功!');
           }else{
                $this->error('新增失败!');
           }
        }else{
            $head = Db::name('jcb_sys_config')->where('ishead',1)->select();
            $option = [1=>'文本',2=>'数值',3=>'选择型',4=>'开关型',5=>'备注型'];
            $this->assign(['head'=>$head,'option'=>$option]);
            return view();
        }
    }

    /**
    * @name='修改'
    */
    public function modify($id){ 
        $old_data = Db::name('jcb_sys_config')->find(intval($id));
        empty($old_data) && $this->error('数据不存在!');
        if(request()->isPost()){
			$data=input('post.'); 
            empty(trim($data['title'])) && $this->error('标题必须填写!');
            $new_data =array();
            $new_data['title'] = trim($data['title']);
            $new_data['sort'] = intval($data['sort']);
            if(isset($data['ishead'])){
                $new_data['ishead'] = 1;
                $new_data['pid'] = 0;
                $new_data['ctype'] = 0;
                $new_data['key'] ='';
                $new_data['val'] ='';
                $new_data['item'] ='';
                $new_data['cmark'] ='';
                $new_data['allowempty'] = 1; 
                $new_data['issys'] = 0; 
                $new_data['ishide'] = 0;
            }else{
                $new_data['ishead'] = 0;
                $new_data['pid'] = intval($data['pid']);
                $new_data['ctype'] = intval($data['ctype']);                
                empty($new_data['ctype']) && $this->error('类型必需选');                
                $new_data['key'] = trim($data['key']);
                empty($new_data['key']) && $this->error('KEY为必填项');
                Db::name('jcb_sys_config')->where('id','<>',intval($id))->where('key',$new_data['key'])->find() && $this->error('参数名已经存在,请更换!');
                $new_data['val'] = trim($data['val']);
                $new_data['item'] = trim($data['item']);
                $new_data['cmark'] = trim($data['cmark']);
                $new_data['allowempty'] = isset($data['allowempty']) ? 1:0;
                $new_data['issys'] = isset($data['issys']) ? 1:0;
                $new_data['ishide'] = isset($data['ishide']) ? 1:0;
            }
            try{
                Db::name('jcb_sys_config')->where('id',intval($id))->update($new_data); 
            }catch (\Exception $e) {
                $this->error('修改失败!');
            }           
            $this->success('修改成功!'); 
        }else{ 
            $head = Db::name('jcb_sys_config')->where('ishead',1)->select();
            $option = [1=>'文本',2=>'数值',3=>'选择型',4=>'开关型',5=>'备注型']; 
            $this->assign(['head'=>$head,'option'=>$option,'data'=>$old_data]);
            return view();
        }
    }
    /**
    * @name='删除'
    */
    public function del($id){
        $sys = Db::name('jcb_sys_config')->find(intval($id));
        empty($sys) && $this->error('数据不存在!');
        $sys['issys'] == 1 && $this->error('系统菜单不允许删除!');
        Db::name('jcb_sys_config')->where('pid',intval($id))->find() &&  $this->error('有子参数不允许删除!');
        try{
			$result = Db::name('jcb_sys_config')->where('id',intval($id))->delete();
			!$result && $this->error('删除失败!'); 
		} catch (\Exception $e) {
			$this->error('删除失败!');
		}
        $this->success('删除成功!');
    }

}