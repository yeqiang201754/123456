<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\web\point\public/../module/index\view\user\notice.html";i:1525945212;s:11:"footer.html";i:1525945441;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>
    通知
  </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=7" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <link rel="stylesheet" href="__PUBLIC__/css/style.css" />
  <link rel="stylesheet" href="__PUBLIC__/css/addons.css" />
  <script src="__PUBLIC__/js/jquery-2.0.0.min.js"></script>
  <script src="__PUBLIC__/js/jquery.slide.js"></script>
  <script src="__PUBLIC__/js/touchslide.1.1.js"></script>
</head>

<body style="background-color:white;">
  <form method="post" action="mygonggao.aspx" id="form1">
    <div class="aspNetHidden">
      <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="XUhPn3biPhVKwP0plM/rzf2e//Eb98qE5fLnBPjhBnwSUkbNqrMPIdDj9E+WXbDGLShlGCawHESnyKoHRCRlxHuVCW+fVOFy/c9h9dmGqZbiyrCZ9K27CEfS+lcx+q0S2zmE3aHsCJiGfywghv8EJN37q5G3nXJ3901NyImnvvN6DGi2gp48IMkv6tUKYVaDrSp8Zfu/Z57BMA8IhujMheG9hJLvOVaDXeWkZpfWQf6oVNpH8em3wB5vSFBxJXvyUsfIreJlbx97lsR/30P9MJ9wVQw="
      />
    </div>

    <div class="layout">
      <div class="header">
        <div class="inner">
          <a href="/index/user" class="return"></a>
          <h2>通知</h2>
        </div>
      </div>
      <div class="help-mod">
        <ul class="list">
          <?php if(is_array($notice) || $notice instanceof \think\Collection || $notice instanceof \think\Paginator): $i = 0; $__LIST__ = $notice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
          <li>
            <a href="/index/user/notice_detail?id=<?php echo $data['id']; ?>"><?php echo $data['title']; ?></a>
          </li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
      <!--homeMod-->

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