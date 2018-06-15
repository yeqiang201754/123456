<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"D:\web\point\public/../module/index\view\index\customs.html";i:1526027207;s:11:"footer.html";i:1525945441;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        积分兑换 报单提交
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
        function baodan() {
            var code = $("#code").val();
            var num = $("#num").val();
            var amount = $("#jine").val();
            if (document.getElementById("code").value == "") {
                alert('兑换码不能为空!!');
                document.getElementById("code").focus();
                return false;
            }
            
            var form = new FormData(document.getElementById("form1")); 
            $.ajax({  
                url:"/index/index/upload",  
                type:"post",  
                data:form,  
                cache: false,  
                processData: false,  
                contentType: false,  
                success:function(data){ 
                    if(data.code==1){
                        alert(data.msg);
                        window.location.href="/index/index/index";
                    }else{
                        alert(data.msg);
                    }
                },  
                error:function(e){  
                    alert("网络错误，请重试！！");  
                    }  
                });         
            }
    </script>
</head>

<body style="background-color: white;">
    <form id="form1" method="POST"  enctype="multipart/form-data">
        <div class="layout" style="background-color: #f8f8f8;">
            <div class="header">
                <div class="inner">
                    <a href="/index/index/exchange" class="return"></a>
                    <h2>积分兑换</h2>
                </div>
            </div>
            <div class="exchange">
                <div class="tip">
                    请提交正确的券码等信息，恶意提交无关卷码，一经核实将扣款或永久封号。
                </div>
                <div class="exchange-li">
                    <span>兑换码</span>
                    <textarea name="code" id="code" placeholder="请输入电子凭证码，多个码请用/分割区分"></textarea>
                </div>
                <ul class="from">
                    <li class="inp">
                        <label for="">总数量</label>
                        <input name="num" type="text" id="num" placeholder="请输入兑换码总数量" class="text" />
                        <input type="hidden" value="<?php echo $bankid; ?>" name="bankid" id="bankid">
                    </li>
                    <li class="inp">
                        <label for="">总金额</label>
                        <input name="amount" type="text" id="amount" placeholder="请输入兑换总金额" class="text" />
                    </li>
                </ul>
                <div class="exchange-li">
                    <span>备注</span>
                    <textarea name="mark" id="mark" placeholder="无特殊情况请勿填写"></textarea>
                </div>
                <ul class="from">
                    <li class="inp">
                        <label for="">上传截图</label>
                        <input name="file"  type="file" id="file" class="file" value="" />
                    </li>
                </ul>
            </div>
            <div class="btnDiv">
                <input onclick="baodan()" name="cz_btn" type="button" id="cz_btn" class="btn" value="确定提交报单"/>
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