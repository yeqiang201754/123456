<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\web\point\public/../module/index\view\user\index.html";i:1526347522;s:11:"footer.html";i:1525945441;}*/ ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
	个人中心
</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="X-UA-Compatible" content="IE=7" /><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" /><meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="stylesheet" href="__PUBLIC__/css/style_mem.css" />
<link rel="stylesheet" href="__PUBLIC__/css/style.css" />
<link rel="stylesheet" href="__PUBLIC__/css/addons.css" />
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/jquery.slide.js"></script>
    <script src="__PUBLIC__/js/touchslide.1.1.js"></script>
    <script src="__PUBLIC__/js/addons.js"></script>
</head> 
<body style="background-color: white;">
    <form method="post" action="memcenter.aspx?bh=M004998" id="form1">
    <div class="layout">
        <div class="userHead clearfix" style="background-image:none;">
            <a href="#" class="clearfix" style="background-image:none;">
                <div class="thumb" style="background-image:none;">
                    <div class="img">
                        <?php if($user['grade'] == '专员'): ?>
                        <img src="__PUBLIC__/images/zy.jpg" id="djimg" /> 
                        <?php elseif($user['grade'] == '经理'): ?>
                        <img src="__PUBLIC__/images/jl.jpg" id="djimg" /> 
                        <?php elseif($user['grade'] == '行长'): ?>
                        <img src="__PUBLIC__/images/hz.jpg" id="djimg" /> 
                        <?php else: ?>
                        <img src="__PUBLIC__/images/yhj.jpg" id="djimg" /> 
                        <?php endif; ?>
                    </div>
                </div>
                <div class="desc" style="background-image:none;">
                    <h3><?php echo $user['username']; ?></h3>
                    <div class="txt">
                    <h3>等级：<?php echo $user['grade']; ?></h3>
                    </div>
                </div>
            </a>
        </div>
        <script type="text/javascript">jQuery(".txt").slide({ mainCell: "ul", autoPlay: true, effect: "topLoop" });</script>
        <div class="firstMod">
            <ul class="ul_info">
                <li onclick="javascript:window.location.href='/index/share/invite'"><span><?php echo $team_count; ?></span>
                    <p>团队人数</p>
                </li>
                <li onclick="javascript:window.location.href='/index/share/commission'"><span><?php echo $user['profit']; ?></span>
                    <p>累计收益</p>
                </li>
                <li class="last" onclick="javascript:window.location.href='/index/user/withdraw'"><span><?php echo $user['balance']; ?></span>
                    <p>可提现余额</p>
                </li>
            </ul>
        </div>
        <div id="slideBox3" class="slideBox slideBox_ad">
            <div class="bd">
                <ul>
                    
    <li> <a class="pic" href="" target="_blank"><img src="__PUBLIC__/images/bann.jpg" /></a> </li>
    
                </ul>
            </div>
            <div class="hd">
                <ul>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
            TouchSlide({
                slideCell: "#slideBox3",
                titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
                mainCell: ".bd ul",
                effect: "leftLoop",
                autoPage: true,//自动分页
                autoPlay: true,//自动播放
                interTime: 4000
            });
        </script>
        <div class="userBody">
            <div class="item">
                <div class="head">
                    <h2>兑换报单查询</h2>
                </div>
                <div class="body">
                    <ul class="clearfix">
                        <li><a href="order?status=1">
                            <div class="img"><?php echo $waite; ?></div>
                            <h3>交易中</h3>
                        </a></li>
                        <li><a href="order?status=2">
                            <div class="img"><?php echo $success; ?></div>
                            <h3>成功</h3>
                        </a></li>
                        <li class="last"><a href="order?status=3">
                            <div class="img"><?php echo $fail; ?></div>
                            <h3>失败</h3>
                        </a></li>
                    </ul>
                </div>
            </div>
            <!--homeMod-->
            <div class="item2">
                <div class="head">
                    <h2>必备工具</h2>
                </div>
                <div class="body">
                    <ul class="clearfix">
                        <li><a href="/index/share">
                            <div class="img">
                                <img src="/resource/images/img3.png"></div>
                            <h3>我的分享码</h3>
                        </a></li>
                        <li><a href="/index/share/invite">
                            <div class="img">
                                <img src="/resource/images/img7.png"></div>
                            <h3>我的好友</h3>
                        </a></li>
                        <li><a href="/index/upgrade/index">
                            <div class="img">
                                <img src="/resource/images/img6.png"></div>
                            <h3>佣金政策</h3>
                        </a></li>
                        <li><a href="/index/user/order">
                            <div class="img">
                                <img src="/resource/images/img5.png"></div>
                            <h3>兑换查询</h3>
                        </a></li>
                        <li><a href="/index/share/commission">
                            <div class="img">
                                <img src="/resource/images/img4.png"></div>
                            <h3>收益查询</h3>
                        </a></li>
                        <li><a href="/index/user/withdraw">
                            <div class="img">
                                <img src="/resource/images/img2.png"></div>
                            <h3>申请提现</h3>
                        </a></li>
                        <li><a href="/index/user/withdraw_log">
                            <div class="img">
                                <img src="/resource/images/img18.png"></div>
                            <h3>提现查询</h3>
                        </a></li>
                        <li>
                            <a href="/index/user/notice">
                                <div class="img">
                                    <img src="/resource/images/j5.png"></div>
                                <h3>站内公告</h3>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" id="btn">
                                <div class="img">
                                    <img src="/resource/images/zxkf.jpg"></div>
                                <h3>招商加盟</h3>
                            </a>
                        </li>
                        <li>
                            <a href="/index/login/loginout">
                                <div class="img">
                                    <img src="/resource/images/img1.png"></div>
                                <h3>退出登录</h3>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--homeMod-->

        </div>

        <!--homeMod-->
        

        <div class="h100"></div>
        <div class="naver3">
            <div class="nav">
            <ul class="clearfix">
                <li><a href="/index"> <i class="i1"></i> <strong>兑换</strong></a></li>
                <li><a href="/index/upgrade/index"> <i class="i2"></i> <strong>升级</strong></a></li>
                <li><a href="/index/share/index"> <i class="i3"></i> </a></li>
                <li><a href="/index/article/index"> <i class="i4"></i> <strong>百科</strong></a></li>
                <li><a href="/index/user/index"> <i class="i5"></i> <strong>我的</strong></a></li>
            </ul>
            </div>
        </div>
            <!--导航结束-->
        </div>
        <!--导航结束-->
    </div>
    <!--弹出1-->
  <div class="dialog_blank"></div>
  <div class="dialog_pub dialog_pub1">
   <div class="dialog_title">
   <h2>长按图片加我微信，免费咨询</h2>
    <span class="close"></span>
   </div>
   <div class="wxImg"><img src="http://jifen.fenrunbao.cn/upload/news/20180410114642.jpg"></div>
   
   
    </div>
  <!--/弹出--> 
   
<script>


    $(".dialog_pub .close").click(function () {
        $(".dialog_blank,.dialog_pub").fadeOut()

    });


    $("#btn").click(function () {
        $(".dialog_blank,.dialog_pub1").fadeIn()

    });

</script>
    </form>
</body>
</html>
