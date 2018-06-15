<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
/**
* @name='分享赚钱'
*/
class Share extends Controller
{
  public function __construct(){
		parent::__construct();
		$is = Session::has('user_id');
		if($is){
      $this->user_id = Session::get('user_id');
      $this->user = Db::name('user')->where('id',$this->user_id)->find();
		}else{
			$this->redirect('/index/Login/index');
		}
	} 
	/**
	* @name='分享赚钱'
	*/
    public function index()
    {
      //查询用户基本信息
      //查询团队人数
      $team_count = Db::name('user')->where('team',$this->user['team'])->where('team','neq','0')->count();
      $sowing = Db::name('sowing')->where('position',3)->select();  
		  $this->assign('sowing',$sowing);
      $this->assign('team_count',$team_count+1);
		  $this->assign('user',$this->user);
      return view();
    }
    
    public function qrcode()
    {
		  return view('share/qrcode');
    }
    public function erweima(){
      
      vendor("phpqrcode.phpqrcode");
      $object = new \QRcode();
      $value = $_SERVER['HTTP_HOST'].'/index/register/index?invite='.$this->user_id;
      $errorCorrectionLevel = 'H';//容错级别
      $matrixPointSize = 10;//生成图片大小
      //生成二维码图片png(跳转地址, 生成的二维码图片名称, 容错级别, 生成图片大小, 白边大小0~4);
      $qr = $object->png($value, 'qrcode.png', $errorCorrectionLevel, $matrixPointSize, 1);
      $bigImgPath = '000.png';//准备好的logo图片erwei.png
      $qCodePath = 'qrcode.png';//已经生成的原始二维码图
      $bigImg = imagecreatefromstring(file_get_contents($bigImgPath));
      $qCodeImg = imagecreatefromstring(file_get_contents($qCodePath));
      list($qCodeWidth, $qCodeHight, $qCodeType) = getimagesize($qCodePath);
      // 二维码图片和背景图的位置
      imagecopymerge($bigImg, $qCodeImg, 165, 650, 0, 0, $qCodeWidth, $qCodeHight, 100);
      
      list($bigWidth, $bigHight, $bigType) = getimagesize($bigImgPath);
      switch ($bigType) {
        case 1: //gif
          header('Content-Type:image/gif');
          imagegif($bigImg);
          break;
        case 2: //jpg
          header('Content-Type:image/jpg');
          imagejpeg($bigImg);
          break;
        case 3: //jpg
          header('Content-Type:image/png');
          imagepng($bigImg);
          break;
        default:
          # code...
          break;
      }
      imagedestroy($bigImg);
      imagedestroy($qCodeImg);
    }

    public function invite()
    {
      //直接邀请人数
      $invite_one = Db::name('user')->where('invite_one',$this->user_id)->select();
      //间接邀请人数
      $invite_two = Db::name('user')->where('invite_two',$this->user_id)->select();
      //团队人数
      $team = Db::name('user')->where('team',$this->user['team'])->where('team','neq','0')->select();

      $team_count = count($team)+1;
      $people_one = count($invite_one);
      $people_two = count($invite_two);
      $this->assign('people_one',$people_one);  
      $this->assign('invite_one',$invite_one);
      $this->assign('people_two',$people_two);  
      $this->assign('invite_two',$invite_two);
      $this->assign('team',$team);  
      $this->assign('team_count',$team_count);
		  return view('share/invite');
    }
    
    public function commission()
    {
      $data = $_GET;
      $data['page'] = isset($data['page']) ? $data['page'] : 1;
      $pagenum = isset($data['limit']) ? intval($data['limit']) : 10;
      $current_begin = (intval($data['page']) -1) * $pagenum;

      $begin = isset($_GET['beginTime'])?$_GET['beginTime']:'';
      $end = isset($_GET['endTime'])?$_GET['endTime']:'';
      if($begin == ''){
        $begin = date('Y-m-d',strtotime('-30 day'));
      }
      if($end == ''){
        $end = date('Y-m-d',strtotime('+30 day'));
      }
      $where = array();
      if($begin){
        $where['addtime'] = array('between',array($begin,$end));
      }
      $comlog = Db::name('comlog')->where('user_id',$this->user_id)->where($where)->limit($current_begin,$pagenum)->select();
      $this->assign('comlog',$comlog);
      $this->assign('begin',$begin);
      $this->assign('end',$end);
		  return view('share/commission');
    }

    public function get_commission(){
      $data = $_POST;
      $begin = isset($data['beginTime'])?$data['beginTime']:'';
      $end = isset($data['endTime'])?$data['endTime']:'';
      $data['page'] = isset($data['page']) ? $data['page'] : 1;
      $pagenum = isset($data['limit']) ? intval($data['limit']) : 10;
      $current_begin = (intval($data['page']) -1) * $pagenum;

      $where = array();
      if($begin && $end){
        $where['addtime'] = array('between',array($begin,$end));
      }
      $comlog = Db::name('comlog')->where('user_id',$this->user_id)->where($where)->limit($current_begin,$pagenum)->select();
      return $this->success('','',$comlog);
    }

    public function rule()
    {
      $bank = Db::name('bank')->select();
      $this->assign('bank',$bank);
		  return view('share/rule');
    }
}
