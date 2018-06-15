<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:64:"D:\web\point\public/../module/index\view\user\notice_detail.html";i:1525945289;s:11:"footer.html";i:1525945441;}*/ ?>
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

    <div class="layout">
        <div class="header">
            <div class="inner">
                <a href="/index/user/notice" class="return"></a>
                <h2>通知</h2>
            </div>
        </div>

        <div class="home_product">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="line-height: 34px;
                font-size: 14px;">
                <tr>
                    <td colspan="2" style="text-align: center; padding: 5px; font-size:16px; font-weight:bold;" align="center">
                        <?php echo $notice['title']; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: left; padding: 5px;">
                        <span style="font-size:16px;line-height:2;"><?php echo $notice['content']; ?></span>
                    </td>
                </tr>
            </table>
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
    <script src="res/js/addons.js"></script>
    </form>
</body>

</html>