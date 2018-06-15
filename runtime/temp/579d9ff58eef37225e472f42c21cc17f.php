<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\web\point\public/../module/index\view\index\index.html";i:1527936192;s:11:"footer.html";i:1525945441;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        积分随心兑
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
    <script language="javascript">
        function getremark() {
            var bankno = document.getElementById("bank").value;
            var vdengji = document.getElementById("dengji").value;
            $.ajax({
                url:'/index/index/bank',
                type:'post',
                dataType:'json',
                data:{'bankid':bankno,'grade':vdengji},
                success:function(data){
                    if(data.code == 1){
                        // document.getElementById("dhremark").innerText = data.msg.remark;
                        $("#dhremark").html(data.msg.remark);
                        $("#price").val(data.msg.radio);
                        document.getElementById("pricehtml").innerText = "你当前等级为" + document.getElementById("dengjiname").value + "，每一万积分价格为" + data.msg.radio + "元。";
                    }else{
                        document.getElementById("dhremark").innerText = '';
                        $("#price").val('');
                        document.getElementById("pricehtml").innerText = "";
                    }
                }
            });
                // var strs = new Array(); //定义一数组 
                // strs = data.split("|"); //字符分割 
                // if (strs[0] == "succ") {
                //     document.getElementById("dhremark").innerText = strs[1];
                //     document.getElementById("price").value = strs[2];
                //     document.getElementById("pricehtml").innerText = "你当前等级为" + document.getElementById("dengjiname").value + "，每一万积分价格为" + strs[2] + "元。";
                // }
        }
        function jisuan() {
            var jifen = document.getElementById("jifen").value;
            var vprice = document.getElementById("price").value;
            
            if (jifen == "") {
                alert("请输入要兑换的积分");
                return;
            }
            if(vprice == ""){
                alert("请选择银行");
                return;
            }
            if (parseInt(jifen) < 10000) {
                alert("请输入大于1万的积分");
                return;
            }
            document.getElementById("totalcharge").value = parseInt(jifen) / 10000 * parseFloat(vprice);
        }

        function duihuan() {
            var bankno = document.getElementById("bank").value;
            if(bankno == ''){
                alert("请选择银行");
                return;
            }
            window.location.href = "/index/index/exchange?bankid=" + bankno;
        }
    </script>
</head>

<body style="background-color: white;">
    <form method="post" id="form1">
        <input name="dengji" type="hidden" id="dengji" value="<?php echo $grade; ?>" />

        <?php if($grade == 'zy'): ?>
        <input name="dengjiname" type="hidden" id="dengjiname" value="专员" />
        <?php elseif($grade == 'jl'): ?>
        <input name="dengjiname" type="hidden" id="dengjiname" value="经理" />
        <?php elseif($grade == 'hz'): ?>
        <input name="dengjiname" type="hidden" id="dengjiname" value="行长" />
        <?php else: ?>
        <input name="dengjiname" type="hidden" id="dengjiname" value="银行家" />
        <?php endif; ?>

        <input name="price" type="hidden" id="price" value="" />
        <div class="layout" style="background-color: #f4f4f4;">
            <div id="slideBox" class="slideBox">
                <div class="bd">
                    <ul>
                        <?php if(is_array($sowing) || $sowing instanceof \think\Collection || $sowing instanceof \think\Paginator): $i = 0; $__LIST__ = $sowing;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                        <li>
                            <!-- <a class="pic" href="javascript::">
                                <img src="__PUBLIC__/images/bann1.jpg" />
                            </a> -->
                            <a class="pic" href="javascript::">
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
            <div class="notice2 notice5" style="margin-bottom: 0;">
                <i></i>
                <ul>
                    <?php if(is_array($horn) || $horn instanceof \think\Collection || $horn instanceof \think\Paginator): $i = 0; $__LIST__ = $horn;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                    <li><?php echo $data['title']; ?></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <!-- <li>李**成功升级成为经理</li>

                    <li>王**成功升级成为经理</li>

                    <li>张**成功升级成为经理</li>

                    <li>孙**成功升级成为经理</li>

                    <li>张**成功升级成为经理</li>

                    <li>杨**成功升级成为经理</li> -->

                </ul>
            </div>
            <script type="text/javascript">jQuery(".notice5").slide({ mainCell: "ul", autoPlay: true, effect: "topLoop" });</script>
            <div class="bank">
                <div class="check-bannk">
                    <img src="/resource/images/xz5.jpg">
                    <select name="bank" id="bank" onchange="getremark();" style="width:14rem">
                        <option value="">请选择</option>
                        <?php if(is_array($bank) || $bank instanceof \think\Collection || $bank instanceof \think\Paginator): $i = 0; $__LIST__ = $bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['bankname']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <div class="body">
                    <div class="tip" id="dhremark">
                        <!-- 查询积分：使用银行预留手机号编辑短信“CXJF”发送到95533或关注“中国建设银行”公众号，绑定信用卡，回复“积分” -->
                    </div>
                    <div class="clearfix sys-inpt">
                        <div class="integral">
                            <div class="inpt">
                                <img src="/resource/images/xz6.png">
                                <input type="text" placeholder="请输入兑换积分" class="txt" id="jifen">
                            </div>
                            <div class="inpt">
                                <img src="/resource/images/xz7.png">
                                <input type="text" placeholder="约0.00元" class="txt colorred" id="totalcharge">
                            </div>

                        </div>
                        <div class="sys">
                            <img src="/resource/images/xz4.jpg" onclick="jisuan();">
                        </div>
                    </div>
                    <div class="sys-tip" id="pricehtml">
                        你当前等级为
                        <?php if($grade == 'zy'): ?>
                        专员
                        <?php elseif($grade == 'jl'): ?>
                        经理
                        <?php elseif($grade == 'hz'): ?>
                        行长
                        <?php else: ?>
                        银行家
                        <?php endif; ?>
                        <!-- ，每一万积分价格为12.5元。 -->
                    </div>
                    <a href="javascript:duihuan();" class="lzdh">
                        <img src="/resource/images/xz9.png">
                    </a>
                </div>
                <div class="jf-step">
                    <h3>积分兑换流程</h3>
                    <img src="/resource/images/jfdh.png">
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
    </form>
</body>

</html>