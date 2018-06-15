<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"D:\project\point\point\public/../module/index\view\article\index.html";i:1527487573;s:11:"footer.html";i:1525945441;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>
    卡友百科
  </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=7" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
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
            <?php if(is_array($sowing) || $sowing instanceof \think\Collection || $sowing instanceof \think\Paginator): $i = 0; $__LIST__ = $sowing;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
            <li>
              <a class="pic" href="" target="_blank">
                <img src="<?php echo $data['picture']; ?>" />
              </a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
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
      <div class="bkMenu" style=" margin-bottom:0.5rem;">
        <ul class="list clearfix">
          <?php if(is_array($article_type) || $article_type instanceof \think\Collection || $article_type instanceof \think\Paginator): $i = 0; $__LIST__ = $article_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
          <li>
            <a href="/index/article/index?type=<?php echo $data['id']; ?>">
              <div class="thumb">
                <img src="<?php echo $data['picture']; ?>" />
              </div>
              <strong><?php echo $data['name']; ?></strong>
            </a>
          </li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          <!-- <li>
            <a href="/index/article/index?type=2">
              <div class="thumb">
                <img src="http://jifen.fenrunbao.cn/upload/news/20180314111956.png" />
              </div>
              <strong>优惠活动</strong>
            </a>
          </li>

          <li>
            <a href="/index/article/index?type=3">
              <div class="thumb">
                <img src="http://jifen.fenrunbao.cn/upload/news/20180410103340.png" />
              </div>
              <strong>积分攻略</strong>
            </a>
          </li>

          <li>
            <a href="/index/article/index?type=4">
              <div class="thumb">
                <img src="http://jifen.fenrunbao.cn/upload/news/20180410103354.png" />
              </div>
              <strong>撸羊毛</strong>
            </a>
          </li> -->

        </ul>
      </div>
      <div class="bkList">
        <ul class="list clearfix">
          <?php if(is_array($article) || $article instanceof \think\Collection || $article instanceof \think\Paginator): $i = 0; $__LIST__ = $article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
          <li>
            <a href="/index/article/detail?id=<?php echo $data['id']; ?>">
              <div class="thumb">
                <img src="<?php echo $data['picture']; ?>" />
              </div>
              <div class="desc">
                <h3><?php echo $data['title']; ?></h3>
                <div class="txt"><?php echo $data['front']; ?></div>
                <div class="tool">
                  <span class="s1"><?php echo $data['addtime']; ?></span>
                  <span class="s2"><?php echo $data['click']; ?></span>
                </div>
              </div>
            </a>
          </li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
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