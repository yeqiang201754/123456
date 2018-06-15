<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\web\point\public/../module/index\view\share\index.html";i:1526269876;s:11:"footer.html";i:1525945441;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>
    推广素材
  </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=7" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <link rel="stylesheet" href="__PUBLIC__/css/style_mem.css" />
  <link rel="stylesheet" href="__PUBLIC__/css/style.css" />
  <link rel="stylesheet" href="__PUBLIC__/css/addons.css" />
  <script src="__PUBLIC__/js/jquery.min.js"></script>
  <script src="__PUBLIC__/js/jquery.slide.js"></script>
  <script src="__PUBLIC__/js/touchslide.1.1.js"></script>
  <script src="__PUBLIC__/js/addons.js"></script>
</head>

<body style="background-color:white;">
  <form method="post" id="form1">

    <div class="layout">

      <div id="slideBox" class="slideBox">
        <div class="bd">
          <ul>

            <li>
              <a class="pic" href="" target="_blank">
                <img src="http://jifen.fenrunbao.cn/upload/news/20180410121750.jpg" />
              </a>
            </li>

          </ul>
        </div>
        <div class="hd">
          <ul>
          </ul>
        </div>
      </div>
      <script type="text/javascript">
        TouchSlide({
          slideCell: "#slideBox",
          titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
          mainCell: ".bd ul",
          effect: "leftLoop",
          autoPage: true,//自动分页
          autoPlay: true,//自动播放
          interTime: 4000
        });
      </script>

      <!--homeMod-->
      <div class="yq-infobox">
        <ul class="nums clearfix">
          <li>
            <strong><?php echo $team_count; ?>人</strong>
            <span>团队人数</span>
          </li>
          <li>
            <strong><?php echo $user['profit']; ?>元</strong>
            <span>累计收益</span>
          </li>
        </ul>
        <div class="ybar">
          <div class="fl">我都邀请了谁</div>
          <a href="/index/share/invite" class="btn fr">邀请记录</a>
        </div>
        <div class="ybar">
          <div class="fl">我都赚了多少钱</div>
          <a href="/index/share/commission" class="btn fr">佣金查询</a>
        </div>
        <div class="yinfo">
          <h4>邀请好友加入积分兑换</h4>
          <p>好友本人兑换积分您赚佣金</p>
          <p>好友推荐兑换积分您还赚佣金</p>
        </div>
        <div class="btns clearfix">
          <a href="/index/share/qrcode" class="btn btn1 fl">二维码分享</a>
          <a href="/index/share/rule" class="btn btn2 fr">代理政策</a>
        </div>
      </div>

      <!--导航-->
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
  </form>
</body>

</html>