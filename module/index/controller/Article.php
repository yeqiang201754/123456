<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
/**
* @name='文章'
*/
class Article extends Controller
{

	/**
	* @name='文章'
	*/
    public function index()
    {
			$type = isset($_GET['type'])?$_GET['type']:'';
			$where = array();
			if($type){
				$where['type'] = $type;
			}
			$article_type = Db::name('article_type')->select();
			$article = Db::name('article')->where($where)->select();
			$sowing = Db::name('sowing')->where('position',1)->select();
			$this->assign('sowing',$sowing);
			$this->assign('article',$article);
			$this->assign('article_type',$article_type);
			return view();
    }
    
    public function detail()
    {
			
			$id = isset($_GET['id'])?$_GET['id'] :'';
			//增加点击次数
			Db::name('article')->where('id',$id)->setInc('click',1);
			$detail = Db::name('article')
			->field('article.*,article_type.name')
			->join('article_type','article.type = article_type.id')
			->where('article.id',$id)->find();
			
			$this->assign('detail',$detail);
			return view('article/detail');
	}
	
}
