<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:62:"D:\web\point\public/../module/index\view\share\commission.html";i:1526371341;s:11:"footer.html";i:1525945441;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        佣金收益明细
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" href="__PUBLIC__/css/style.css" />
    <link rel="stylesheet" href="__PUBLIC__/css/addons.css" />
    <link rel="stylesheet" href="__PUBLIC__/css/resstyle.css" />

    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/jquery.slide.js"></script>
    <script src="__PUBLIC__/js/touchslide.1.1.js"></script>
    <script src="__PUBLIC__/js/addons.js"></script>

    <script src="__PUBLIC__/js/date.js"></script>
    <script src="__PUBLIC__/js/iscroll.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#beginTime').date({ theme: "" });
            $('#endTime').date({ theme: "" });
        });
    </script>
    <style>
        .tjBar {
            height: 42px;
            line-height: 42px;
            background: #E8E8E8;
            text-align: center;
            font-size: 12px;
            clear: both;
            padding-bottom: 5px;
        }

        .tjBar .text {
            width: 32%;
            border: 1px solid #ddd;
            height: 28px;
            font-size: 11px;
            margin-right: 3px;
            background: #fff url(../images/down.png) no-repeat right center;
            background-size: 14px 7px;
            padding-left: 2%;
            border-radius: 4px
        }

        .tjBar .button {
            height: 28px;
            line-height: 28px;
            border: none;
            background: #5db75d;
            width: 14%;
            color: #fff;
            border-radius: 4px;
        }

        /*时间插件样式*/

        .page {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        #datescroll div {
            float: left;
            margin-left: 10%;
            margin-top: 15px;
            padding-right: 22px;
        }

        #datescroll_datetime div {
            float: left;
            margin-left: 10%;
            padding-right: 22px;
        }

        #yearwrapper {
            position: absolute;
            left: 0;
            top: 45px;
            bottom: 60px;
            width: 80%;
        }

        #monthwrapper {
            position: absolute;
            left: 26%;
            top: 45px;
            bottom: 60px;
            width: 80%;
        }

        #daywrapper {
            position: absolute;
            left: 50%;
            top: 45px;
            bottom: 60px;
            width: 80%;
        }

        #Hourwrapper {
            position: absolute;
            left: 0;
            top: 195px;
            bottom: 68px;
            width: 80%;
        }

        #Minutewrapper {
            position: absolute;
            left: 26%;
            top: 195px;
            bottom: 68px;
            width: 80%;
        }

        #Secondwrapper {
            position: absolute;
            left: 50%;
            top: 195px;
            bottom: 68px;
            width: 80%;
        }

        /*增加手指滑动触摸面积*/

        #Hourwrapper ul li {
            color: #898989;
            font-size: 12px;
        }

        #Minutewrapper ul li {
            color: #898989;
            font-size: 12px;
        }

        #Secondwrapper ul li {
            color: #898989;
            font-size: 12px;
        }

        #yearwrapper ul li {
            color: #898989;
            font-size: 12px;
        }

        #monthwrapper ul li {
            color: #898989;
            font-size: 12px;
        }

        #daywrapper ul li {
            color: #898989;
            font-size: 12px;
        }

        #markyear {
            position: relative;
            margin-left: 76px;
            top: -2px;
        }

        #markmonth {
            position: relative;
            margin-left: 40px;
            top: -2px;
        }

        #markday {
            position: relative;
            margin-left: 42px;
            top: -2px;
        }

        #markhour {
            position: relative;
            margin-left: 62px;
            top: -2px;
        }

        #markminut {
            position: relative;
            margin-left: 58px;
            top: -2px;
        }

        #marksecond {
            position: relative;
            margin-left: 68px;
            top: -2px;
        }

        #dateheader {
            width: 100%;
            height: 50px;
            background: #79C12F;
            text-align: center;
            color: #fff;
            line-height: 50px;
            font-size: 20px;
        }

        #setcancle ul {
            text-align: center;
            line-height: 30px;
            margin: 1px auto;
            font-size: 20px;
        }

        #setcancle ul li {
            border-radius: 4px;
            float: left;
            width: 40%;
            height: 30px;
            list-style-type: none;
        }

        #dateconfirm {
            position: absolute;
            background: #3D84C6;
            color: #fff;
            font-size: 18px;
            left: 20px;
        }

        #datecancle {
            position: absolute;
            background: #dcdddd;
            font-size: 18px;
            right: 20px;
            width: 40%;
        }

        #dateshadow {
            display: none;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: #000;
            filter: alpha(Opacity=50);
            -moz-opacity: 0.5;
            opacity: 0.5;
        }

        #datePage {
            font-size: 22px;
            border-radius: 3px;
            position: fixed;
            top: 110px;
            vertical-align: middle;
            width: 80%;
            height: 240px;
            background: #FFFFFF;
            z-index: 9999999;
            margin: 0 auto;
            overflow: hidden;
        }

        #datetitle {
            width: 100%;
            height: 50px;
            background: #3D84C6;
            text-align: center;
            color: #fff;
            line-height: 50px;
            font-size: 20px;
        }

        #datemark {
            font-size: 18px;
            left: 5%;
            width: 90%;
            height: 20px;
            border: 1px solid #3D84C6;
            background: -webkit-gradient(linear, 0 0, 0 100%, from(#dbeeff), to(#9dd2ff));
            position: absolute;
            top: 108px;
        }

        #timemark {
            font-size: 18px;
            left: 5%;
            width: 90%;
            height: 20px;
            border: 1px solid #E0E0E0;
            background: -webkit-gradient(linear, 0 0, 0 100%, from(#dbeeff), to(#9dd2ff));
            position: absolute;
            top: 242px;
        }

        #datescroll {
            background: #F8F8F8;
            width: 94%;
            margin: 10px 3%;
            border: 1px solid #E0E0E0;
            border-radius: 4px;
            height: 120px;
            text-align: center;
            line-height: 40px;
        }

        #datescroll_datetime {
            display: none;
            background: #F8F8F8;
            width: 94%;
            margin: 10px 3%;
            margin-top: 10px;
            border: 1px solid #E0E0E0;
            border-radius: 4px;
            height: 120px;
            text-align: center;
            line-height: 40px;
        }

        #yearwrapper ul,
        #monthwrapper ul,
        #daywrapper ul {
            width: 40%;
        }

        #Hourwrapper ul,
        #Minutewrapper ul,
        #Secondwrapper ul {
            width: 40%;
        }

        #dateFooter {
            width: 100%;
            background: #fff;
            height: 50px;
            bottom: 0px;
            position: absolute;
        }

        table {
            margin-top: 10px;
        }

        .the {
            text-align: center;
        }

        .thr {
            width:30%;
        }

        .two {
            width:30%;
        }

        .five {
            width:40%;
        }

        table{margin-top:0;width:100%}
        th {
            border-bottom: 1px solid #f0f0f0; color:#000;font-size:16px;line-height:50px;
        }
        td{ line-height:30px;} 
        html body{overflow:hidden}
    </style>
</head>

<body style="background-color:white;">
    <form method="get" action="/index/share/commission" id="form1">
        <div class="layout" >
            <div class="header">
                <div class="inner">
                    <a href="index" class="return"></a>
                    <h2>佣金收益明细</h2>
                </div>
            </div>
            <div class="tjBar">
                <input name="beginTime" type="text" id="beginTime" class="text" value="<?php echo $begin; ?>" />
                <label>-</label>
                <input name="endTime" type="text" id="endTime" class="text" value="<?php echo $end; ?>" />
                <input onclick="search()" type="submit" class="button" value="查询" />
            </div>
            <?php if(!empty($comlog)): ?>
            <div class="zd-mod ubd" style="overflow-y:auto;max-height:500px;">
                <!-- <ul class="list">
                <li >
                    <div class="tt"></div>
                </li>
            </ul> -->
                <table style="height:510px">
                    <thead class="tb_thead" >
                        <tr>
                            <th class="the thr">时间</th>
                            <th class="the two">金额</th>
                            <th class="the five">备注</th>
                        </tr>
                    </thead>     
                    <tbody class="tb_body tb_dh">
                        <?php if(is_array($comlog) || $comlog instanceof \think\Collection || $comlog instanceof \think\Paginator): $i = 0; $__LIST__ = $comlog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td class="the thr"><?php echo $data['addtime']; ?></td>
                            <td class="the two"><?php echo $data['amount']; ?></td>
                            <td class="the five"><?php echo $data['remark']; ?></td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>  
                </table>
            </div>
            <?php endif; ?>
            <!--时间插件弹出-->
            <div id="datePlugin"></div>
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
    <script src="__PUBLIC__/plugins/layui2.2.3/layui.js" charset="utf-8"></script> 
    <script src="__PUBLIC__/js/jquery.extend.js" charset="utf-8"></script>
    <script type="text/javascript">
    layui.use(['form', 'table', 'laydate'], function(){ });
    $(function() { 			
        var nScrollHight = 0;  
        var nScrollTop = 0;   
        var is_scroll = true;
        var num = 2; 
        function show(data){
            console.log(data);
            if(data.code===1){
                num = num + 1; 
                var data =eval(data.data);
                for(var i= 0;i<data.length;i++){  
                    $('.tb_body').append(
                        '<tr><td class="the thr">'+data[i]['addtime']+'</td><td class="the two">'+data[i]['amount']+'</td><td class="the five">'+data[i]['remark']+'</td></tr>'
                    );                  
                }
                if(data.length ===0){
                    layer.msg('没有更多数据.',{time: 2000});
                    is_scroll = false;
                }                 
            }else if(data.code===0){
            layer.msg('请求数据错误!',{time: 2000})
            }
        }
        $(".ubd").scroll(function(){   
            if(is_scroll){        
            nScrollHight = $(this)[0].scrollHeight;
            nScrollTop = $(this)[0].scrollTop;
                if(nScrollTop + $(this).height() >= nScrollHight){
                    // var beginTime = "<?php isset($_GET['beginTime'])?$_GET['beginTime']:'';?>";
                    var beginTime = $("#beginTime").val();
                    var endTime = $("#endTime").val();
                    // var endTime = "<?php isset($_GET['endTime'])?$_GET['endTime']:'';?>";
                    $.fn.jcb.post("/index/share/get_commission",{page:num,beginTime:beginTime,endTime:endTime},false,show);
                } 
            }
        });
    });
    </script>
</body>

</html>