<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"D:\web\point\public/../module/index\view\share\invite.html";i:1526285722;s:11:"footer.html";i:1525945441;}*/ ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
	会员管理
</title><meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta charset="utf-8" />
<link rel="stylesheet" href="__PUBLIC__/css/style_mem.css" />
<link rel="stylesheet" href="__PUBLIC__/css/style.css" />
<link rel="stylesheet" href="__PUBLIC__/css/addons.css" />
<script src="__PUBLIC__/js/jquery.min.js"></script>
<script src="__PUBLIC__/js/jquery.slide.js"></script>
<script src="__PUBLIC__/js/touchslide.1.1.js"></script>
<script src="__PUBLIC__/js/addons.js"></script>
</head>
<body style="background-color: white;">
    <form method="post" id="form1">
        <div class="layout">
            <!--导航-->
            <div class="top_text"> 
                <h2>推广累计（人）</h2>
                <b><?php echo $people_one+$people_two; ?></b>
                <ul class="ul_info">
                    <li>
                        <p>直接</p>
                        <span><?php echo $people_one; ?></span>
                    </li>
                    <li>
                        <p>间接</p>
                        <span><?php echo $people_two; ?></span>
                    </li>
                    <li>
                        <p>团队</p>
                        <span><?php echo $team_count; ?></span>
                    </li>
                </ul>
            </div>
            <div class="menber">
                <ul class="clearfix">
                    <!-- <li><span style=" width:200px;" >用户名</span><span style="margin-left:100px;">电话</span></li>
                    <?php if(is_array($invite_one) || $invite_one instanceof \think\Collection || $invite_one instanceof \think\Paginator): $i = 0; $__LIST__ = $invite_one;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                    <li><span style=" width:200px"><?php echo $data['username']; ?></span><span style="margin-left:100px;"><?php echo $data['mobile']; ?></span></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?> -->
                </ul>
            </div>
            
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
        <script src="res_new/js/addons.js"></script>
    </form>
</body>
</html>
