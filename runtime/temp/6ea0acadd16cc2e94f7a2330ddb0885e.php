<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\web\point\public/../module/index\view\user\order.html";i:1526365255;s:11:"footer.html";i:1525945441;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>
    交易中订单查询
  </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=7" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <link rel="stylesheet" href="__PUBLIC__/css/style_info.css" />
  <link rel="stylesheet" href="__PUBLIC__/css/style.css" />
  <link rel="stylesheet" href="__PUBLIC__/css/addons.css" />
  <script src="__PUBLIC__/js/jquery.min.js"></script>
  <script src="__PUBLIC__/js/jquery.extend.js?t=<?=time()?>" charset="utf-8"></script>
  <script src="__PUBLIC__/js/jquery.slide.js"></script>
  <script src="__PUBLIC__/js/touchslide.1.1.js"></script>
  <script src="__PUBLIC__/js/addons.js"></script>
</head>

<body style="background-color:white;">
  <form method="post" id="form1">
    <div class="layout" style="overflow-y:auto;max-height:400px;">
      <div class="header">
        <div class="inner">
          <a href="index" class="return"></a>
          <h2>兑换订单查询</h2>
        </div>
      </div>
      <div class="myMod">
        <div class="head clearfix">
          <ul>
            <li <?php if($status == 1): ?>class="on" <?php endif; ?> style="width:33.33%;">
              <a href="order?status=1">交易中</a>
            </li>
            <li <?php if($status == 2): ?>class="on" <?php endif; ?> style="width:33.33%;">
              <a href="order?status=2">成功</a>
            </li>
            <li <?php if($status == 3): ?>class="on" <?php endif; ?> style="width:33.33%;">
              <a href="order?status=3">失败</a>
            </li>
          </ul>
        </div>
        <div class="body">
          <div class="mylist">
            <ul class="cont">
              <?php if(is_array($order) || $order instanceof \think\Collection || $order instanceof \think\Paginator): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
              <li>
                <div class="tt">
                  <span class="s2"><?php echo $data['bankname']; ?></span>
                  <span class="s3"><?php if($status == 1): ?>待审核<?php elseif($status == 2): ?>成功<?php else: ?> 失败<?php endif; ?></span>
                </div>
                <div class="desc">
                  <a href="#">
                    <dl>
                      <dd>
                        <strong>申请时间：</strong><?php echo $data['addtime']; ?></dd>
                      <dd>
                        <strong>兑换码：</strong><?php echo $data['code']; ?></dd>
                      <dd>
                        <strong>备注：</strong><?php echo $data['mark']; ?></dd>
                    </dl>
                  </a>
                </div>
              </li>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </div>
        </div>
      </div>
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
  </form>
  <script src="__PUBLIC__/js/jquery.min.js" charset="utf-8"></script>
  <script src="__PUBLIC__/plugins/layui2.2.3/layui.js" charset="utf-8"></script>
  
  
  <script type="text/javascript">
    layui.use(['form', 'table', 'laydate'], function () { 

    });
    
    $(function () {
      var nScrollHight = 0;
      var nScrollTop = 0;
      var is_scroll = true;
      var num = 2;
      function show(data) {
        if (data.code === 1) {
          num = num + 1;
          var data = eval(data.data);
          console.log(data);
          for (var i = 0; i < data.length; i++) {
            $('.cont').append(
              "<li>"
              + "<div class='tt'>"
              + "<span class='s2'>"+data[i].bankname+"</span>"
              + "<span class='s3'>"+data[i].status+"</span>"
              + "</div>"
              + "<div class='desc'>"
              + "<a href='#'>"
              + "<dl>"
              + "<dd>"
              + "<strong>申请时间：</strong>"+data[i].addtime+"</dd>"
              + "<dd>"
              + "<strong>兑换码：</strong>"+data[i].code+"</dd>"
              + "<dd>"
              + "<strong>备注：</strong>"+data[i].mark+"</dd>"
              + "</dl>"
              + "</a>"
              + "</div>"
              + "</li>"
            );
          }
          if (data.length === 0) {
            layer.msg('没有更多数据.', { time: 2000 });
            is_scroll = false;
          }
        } else if (data.code === 0) {
          layer.msg('请求数据错误!', { time: 2000 })
        }
      }
      $(".layout").scroll(function () {
        if (is_scroll) {
          nScrollHight = $(this)[0].scrollHeight;
          nScrollTop = $(this)[0].scrollTop;
          var status = "<?php echo $status; ?>";
          if (nScrollTop + $(this).height() >= nScrollHight) {
             $.fn.jcb.post("/index/user/get_order", { page: num, status: status }, false, show);
          }
        }
      });
    });
  </script>
</body>

</html>