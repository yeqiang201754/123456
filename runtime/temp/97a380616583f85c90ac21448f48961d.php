<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"D:\web\point\public/../module/index\view\index\exchange.html";i:1526348752;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        积分兑换
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
    <script src="__PUBLIC__/js/addons.js"></script>

</head>

<body style="background-color: white;">
    <form method="post" id="form1">
        <div class="layout">
            <div class="header">
                <a href="/index/index/index" class="return"></a>
                <h2>兑换介绍</h2>
            </div>
            <div class="table-list2">
                <table width="100%" border="0">
                    <tr>

                        <th scope="col">积分数</th>
                        <th scope="col">兑换商品</th>
                        <th scope="col">兑换次数</th>
                    </tr>
                    <?php if(is_array($exchange) || $exchange instanceof \think\Collection || $exchange instanceof \think\Paginator): $i = 0; $__LIST__ = $exchange;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo $data['price']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <?php if(!empty($data['click'])): ?>
                        <td><?php echo $data['click']; ?>次/月</td>
                        <?php else: ?>
                        <td>无限制</td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </table>


            </div>
            <div class="table-info">
                等级越高回收价格越高，详情见“代理”版块
            </div>

            <div class="step-box">
                <div class="head">
                    <strong>兑换步骤详情</strong>
                </div>
                <div class="body">
                    <?php echo $bank['step']; ?>
                </div>
            </div>


        </div>
        <div class="h100"></div>
        <div class="footer-btn" style="position:fixed; bottom:0; left:0; width:100%;">
            <a href="/index">
                <i></i>
                <span>兑换首页</span>
            </a>
            <a href="javascript:;" class="btn btn1" style="width:37.5%;">微信咨询</a><!--/index/index/customs?bankid=<?php echo $bank['id']; ?>-->
            <a href="javascript:;" onclick="tijiao()" class="btn btn2" style="width:37.5%;">提交报单</a>
        </div>

        <!--导航结束-->
        <!--弹出1-->
        <div class="dialog_blank"></div>
        <div class="dialog_pub dialog_pub1">
            <div class="dialog_title">
                <h2>长按图片识别二维码 咨询客服</h2>
                <span class="close"></span>
            </div>
            <div class="wxImg">
                <img src="http://jifen.fenrunbao.cn/upload/news/20180410114547.jpg">
            </div>


        </div>
        <!--/弹出-->

        <script>
            $(".dialog_pub .close").click(function () {
                $(".dialog_blank,.dialog_pub").fadeOut()

            });
            $(".footer-btn .btn1").click(function () {
                $(".dialog_blank,.dialog_pub1").fadeIn()

            });

            function tijiao(){
                var bankid = "<?php echo $bank['id'];?>"
                $.ajax({
                    url:'/index/index/click',
                    type:'post',
                    dataType:'json',
                    data:{bankid:bankid},
                    success:function(data){
                        if(data.code == 0){
                            alert(data.msg);
                        }else{
                            window.location.href="/index/index/customs?bankid="+bankid; 
                        }

                    }
                });
            }
        </script>
    </form>
</body>

</html>