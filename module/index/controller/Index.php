<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;

/**
 * @name='首页'
 */
class Index extends Controller
{

    /**
     * @name='首页'
     */
    public function __construct()
    {
        parent::__construct();
        $is = Session::has('user_id');
        if ($is) {
            $this->user_id = Session::get('user_id');
        } else {
            $this->grade = 'zy';
        }
        // $this->withdraw_min = Db::name('config')->where('key','withdraw_min')->value('value');
        // $this->withdraw_fee = Db::name('config')->where('key','withdraw_fee')->value('value');
        // $this->user = Db::name('user')->where('id',$this->user_id)->find();
    }

    public function index()
    {
        if (isset($this->user_id)) {
            $user = Db::name('user')->where('id', $this->user_id)->find();
            $grade = $user['grade'];
        } else {
            $grade = $this->grade;
        }
        $start = 0;
        $bank = Db::name('bank')->limit($start,8)->select();
        $count = Db::name('bank')->count();
        $horn = Db::name('horn')->select();
        $sowing = Db::name('sowing')->where('position', 1)->select();
        $this->assign('sowing', $sowing);
        $this->assign('horn', $horn);
        $this->assign('grade', $grade);
        $this->assign('bank', $bank);
        $this->assign('start', $start);
        $this->assign('count', $count);
        return view();
    }

    public function bank()
    {
        $data = $_POST;
        if (!empty($data['bankid'])) {
            $row = Db::name('bank')->field($data['grade'] . '_radio as radio,remark,img')->where('id', $data['bankid'])->find();
            if ($data['grade'] == 'zy') {
                $row['grade'] = '专员';
            }
            if ($data['grade'] == 'jl') {
                $row['grade'] = '经理';
            }
            if ($data['grade'] == 'hz') {
                $row['grade'] = '行长';
            }
            if ($data['grade'] == 'yhj') {
                $row['grade'] = '银行家';
            }
            return $this->success($row);
        } else {
            return $this->error();
        }
    }

    public function exchange()
    {
        $is = Session::has('user_id');
        if ($is) {
            $this->user_id = Session::get('user_id');
        } else {
            $this->redirect('/index/Login/index');
        }

        $bankid = isset($_GET['bankid']) ? $_GET['bankid'] : '';
        if (empty($bankid)) {
            $this->redirect('/index/index');
        }

        $exchange = Db::name('exchange')->where('bankid', $bankid)->select();
        $erweima = Db::name('config')->where('key', 'erweima')->value('value');
        $bank = Db::name('bank')->where('id', $bankid)->find();
        $this->assign('bank', $bank);
        $this->assign('erweima', $erweima);
        $this->assign('exchange', $exchange);
        return view();
    }

    public function customs()
    {
        $bankid = isset($_GET['bankid']) ? $_GET['bankid'] : '';
        if (empty($bankid)) {
            $this->redirect('/index/index');
        }
        $bk = Db::name('bank')->where('id', $bankid)->find();
        $user = Db::name('user')->where('id', Session::get('user_id'))->value('grade');
        $radio = $user . '_radio';
        $rradio = $bk[$radio];
        $this->assign('radio', $rradio);
        $this->assign('bankid', $bankid);
        return view();
    }

    public function upload()
    {
        $data = $_POST;
        if (empty($data['num']) || empty($data['amount']) || empty($data['code'])) {
            return $this->error('表单信息未填写完整');
        }

        if (empty($data['bankid'])) {
            return $this->error('网络错误');
        }

        $file = request()->file('file');
        if ($file) {
            $info = $file->validate(['ext' => 'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                $data['picture'] = '/uploads/' . $info->getSaveName();
            } else {
                return $this->error('上传失败,请检查文件类型是否允许上传!');
            }
        }

        $data['addtime'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        $data['user_id'] = Session::get('user_id');
        $order = Db::name('order')->insert($data);

        if ($order) {
            return $this->success('提交成功');
        } else {
            return $this->error('提交失败');
        }
    }

    public function click()
    {
        //验证用户的兑换次数
        $data = $_POST;
        //查询用户的兑换次数

        $firstday = date('Y-m-01', strtotime(date("Y-m-d")));
        $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
        $count = Db::name('order')->where('bankid', $data['bankid'])->where('user_id', Session::get('user_id'))->where('status', '2')->whereTime('addtime', 'between', [$firstday, $lastday])->count();
        //查询银行的兑换限制
        $xianzi = Db::name('exchange')->where('bankid', $data['bankid'])->value('click');
        if (!empty($xianzi)) {
            if ($count >= $xianzi) {
                return $this->error('您当月已成功兑换了' . $count . '次，已经超过了限制');
            } else {
                return $this->success();
            }
        } else {
            return $this->success();
        }
    }

    public function banks()
    {

        $data = $_POST;
        $count = Db::name('bank')->count();
        $start = $data['start'] + $data['num'];
        if ($count <= $start) {
            $start = $data['start'];
        }
        if ($start <= 0) {
            $start = 0;
        }
        $bank = Db::name('bank')->limit($start, 8)->select();
        $datas = ['bank' => $bank, 'start' => $start];
        $bank = json_encode($datas);
        echo $bank;
    }
}
