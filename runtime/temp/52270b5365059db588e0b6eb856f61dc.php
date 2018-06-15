<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\web\point\public/../module/index\view\share\rule.html";i:1525944411;s:11:"footer.html";i:1525945441;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>
    代理政策
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

<body style="background-color: white;">
  <form method="post" action="zhengce.aspx" id="form1">
    <div class="aspNetHidden">
      <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="vN5sIiv/NJn4DMPGygOsMn4ZEY1tfYuS28yh5LzTEZ1tX598s7ce8rd9YOH7A8ZpjagZxL3OL1puNrP/kSltH8XpLIvyp3C2//QKXlNWhF4KIgz3pJYkP76Uw+vVSoDDQ6orjgfmIFFMQnnnsvqS0sCinKgcvZYjZzjocZsTzkMlsa/UMIwVNTX66CpKXJrMgZs/D8z64rwlppcVcc/ikKY7CXEda1+wGSnN+TGkob+71f4PU7nD8DnVi/Fl0DCUYwGPVLm13Ri6ix6tvUgEpzc4BPI2Ump6Wp3HtrkkAcAuaMEXfDiMftko4OJarGNlk2D2LM63T+5+r9yShfNuzws2cXpwdSas+6IitPs9aL07buAgb+pxtWgPtMrwv2ey+nhQ8Kc2Tp8wer+NMJnHk2a4k1tKXPK1F2/QjrjeXYo3PEiwOvN62vMGHYwSI55U/oAScHq7G62VCsqpPn5Xpe7voz9uiTjd3xVgyaAjK7u1Ot18szA9r0FKuysTrEC/VGxsIToNwIAa6pSR8FV1kNsSPLlY1aGuc63/tWPl6B4EwmN8TGTAviMZFpzN49i4qFw9NieFjJm3CTcBWLsbrtDp1C1gWNNWCXaK9fndG1RF9r3gm7pCOE+f10pXef/yv0ypyw=="
      />
    </div>

    <div class="layout">
      <div class="header">
        <div class="inner">
          <a href="/index/share" class="return"></a>
          <h2>代理政策</h2>
        </div>
      </div>
      <div class="table-info" style="text-align:left; background-color:white; color:gray; padding-bottom:0rem; margin-bottom:0rem;margin-top:-30px">
          <span style="font-size:16px;line-height:2;">
            <span style="font-size:16px;color:#E53333;">
              <img src="http://jifenm.fenrunbao.cn/kindeditor/attached/image/20180409/20180409105325_4038.jpg" alt="" />
              <br /> 信用卡积分兑换，市场空白，潜力巨大，聪明的您做好准备了吗？快快来加入
            </span>
          </span>
      </div>
      <div class="table-list2">
        <table width="100%" border="0">
          <tr>
            <th scope="col" style="background-color:#37c2e9; color:white;">银行</th>
            <th scope="col" style="background-color:#37c2e9; color:white;">专员</th>
            <th scope="col" style="background-color:#37c2e9; color:white;">经理</th>
            <th scope="col" style="background-color:#37c2e9; color:white;">行长</th>
            <th scope="col" style="background-color:#37c2e9; color:white;">银行家</th>
          </tr>
          <?php if(is_array($bank) || $bank instanceof \think\Collection || $bank instanceof \think\Paginator): $i = 0; $__LIST__ = $bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
          <tr>
            <td style="width:30%;color:gray;"><?php echo $data['bankname']; ?></td>
            <td style="width:17.5%;"><?php echo $data['zy_radio']; ?></td>
            <td style="width:17.5%;"><?php echo $data['jl_radio']; ?></td>
            <td style="width:17.5%;"><?php echo $data['hz_radio']; ?></td>
            <td style="width:17.5%;"><?php echo $data['yhj_radio']; ?></td>
          </tr>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </table>


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
    <script src="__PUBLIC__/js/addons.js"></script>
  </form>
</body>

</html>