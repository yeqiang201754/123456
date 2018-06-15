<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"D:\web\point\public/../module/index\view\register\index.html";i:1526459166;}*/ ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1"><title>
	新会员注册
</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="X-UA-Compatible" content="IE=7" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="stylesheet" href="__PUBLIC__/css/style_info.css" />
    <script type="text/javascript" src="__PUBLIC__/js/jquery-2.0.0.min.js"></script>
    <script language="javascript">
        function zhuce() {
            if (document.getElementById("mingcheng").value == "") {
                alert('真实姓名不能为空!!');
                document.getElementById("mingcheng").focus();
                return false;
            }
            if (document.getElementById("mingcheng").value.length > 15) {
                alert('真实姓名太长!!');
                document.getElementById("mingcheng").focus();
                return false;
            }
            if (document.getElementById("Mobile").value == "") {
                alert('手机号不能为空!!');
                document.getElementById("Mobile").focus();
                return false;
            }
            if (document.getElementById("txt_vcode").value == "") {
                alert("短信验证码不能为空!!")
                document.getElementById("txt_vcode").focus();
                return false;
            }
            
            if (document.getElementById("MemPwd2").value == "") {
                alert("新密码不能为空!!")
                document.getElementById("MemPwd2").focus();
                return false;
            }
            if (document.getElementById("MemPwd3").value == "") {
                alert("确认新密码不能为空!!")
                document.getElementById("MemPwd3").focus();
                return false;
            }
            if (document.getElementById("MemPwd2").value != document.getElementById("MemPwd3").value) {
                alert("新密码和确认新密码不一样!!")
                document.getElementById("MemPwd3").focus();
                return false;
            }
            
            var vshangji = document.getElementById("shangji").value;
            var vloginname = document.getElementById("Mobile").value;
            var vmingcheng = document.getElementById("mingcheng").value;
            var vMobile = document.getElementById("Mobile").value;
            var vpwd = document.getElementById("MemPwd2").value;
            var vpwd2 = document.getElementById("MemPwd3").value;
            var txt_vcode = $("#txt_vcode").val();
            if(vpwd.length < 6){
                alert("密码必须设置6位以上!")
                document.getElementById("MemPwd2").focus();
                return false;
            }
            // var invite_one = document.getElementById("vshangji").value;

           
            $.ajax({
                url:'/index/register/save',
                type:'post',
                dataType:'json',
                data:{'username':vmingcheng,'mobile':vMobile,'password':vpwd,'password2':vpwd2,'invite_one':vshangji,'txt_vcode':txt_vcode},
                success:function(data){
                    if(data.code == 0){
                        alert(data.msg);
                    }else{
                        alert(data.msg);
                        window.location.href="/index/index/index"; 
                    }

                }
            });
        }
        
    </script>
</head>
<body style="background-color:white;">
    <form method="post" id="Form1">
        <input name="hidyzm" type="hidden" id="hidyzm" />
        <div class="layout">
            <div class="header"> <a href="login/index" class="ico ico_back">登录</a>
                <h1>新会员注册</h1>
            </div>
            <div class="h44"></div>
            <div class="orderMod">
                <div class="body">
                    <div class="form">
                        <input name="shangji" type="hidden" id="shangji" value="<?php echo $invite; ?>" />
                        <ul>
                        <li> <strong>推荐人</strong>
                            <div class="inp">
                                <input name="tuijianren" type="text" id="tuijianren" value="<?php echo $username; ?>" class="text" readonly="readonly" />
                            </div>
                        </li>
                        <li> <strong>真实姓名</strong>
                            <div class="inp">
                            <input name="mingcheng" type="text" id="mingcheng" class="text" placeholder="请输入真实姓名" />
                            </div>
                        </li>
                        <li> <strong>手机号</strong>
                            <div class="inp">
                            <input name="Mobile" type="text" id="Mobile" class="text" placeholder="请输入常用的手机号码" />
                            </div>
                        </li>
                        <li> <strong>动态码</strong>
                            <div class="inp">
                            <input name="txt_vcode" type="text" id="txt_vcode" class="text" placeholder="请输入验证码" />
                            <input type="button" value="点击获取" class="code" id="btnGetYzm">
                            </div>
                        </li>
                        <li> <strong>登录密码</strong>
                            <div class="inp">
                            <input name="MemPwd2" type="password" id="MemPwd2" class="text" placeholder="请输入登录密码" />
                            </div>
                        </li>
                        <li> <strong>确认密码</strong>
                            <div class="inp">
                            <input name="MemPwd3" type="password" id="MemPwd3" class="text" placeholder="请输入确认密码" />
                            </div>
                        </li>
                        </ul>
                    </div>
                    <div class="btnDiv">
                        <input name="cz_btn" type="button" id="cz_btn" class="btn" value="确定提交" onclick="javascript: zhuce();" />
                    </div>
                </div>
            </div>
        </div>
        <script language="javascript">
            $(function () {
                $("#btnGetYzm,#aGetChkCodeAgain").bind("click", function () {
                    if (checkSubmitMobil() == true) {
                        
                        var mobile = $("#Mobile").val();
                        $.ajax({
                            url:'/index/register/verification',
                            type:'post',
                            dataType:'json',
                            data:{mobile:mobile},
                            success:function(data){
                                if(data.code == 0){
                                    alert(data.msg);
                                }
                            }
                        });

                        count = 90;
                        GetYzm();
                        return true;
                    }
                    else {
                        //手机号验证
                        //手机号不合法
                        return false;
                    }
                });
            });

        //设置发送验证码的按钮的倒计时效果
        //var count = 30;
        function GetYzm() {
            $("#btnGetYzm").attr("disabled", "disabled");

            $("#btnGetYzm").val(count + "秒之后获取")
            count--;
            if (count > 0) {
                setTimeout(GetYzm, 1000);
            }
            else {
                $("#btnGetYzm").val("获取验证码");
                $("#btnGetYzm").attr("disabled", false);
            }
            //return result;
        }

        //jquery验证手机号码
        function checkSubmitMobil() {
            if ($("#Mobile").val() == "") {
                alert("手机号码不能为空！");
                //$("#moileMsg").html("<font color='red'>手机号码不能为空！</font>"); 
                $("#Mobile").focus();
                return false;
            }

            if (!$("#Mobile").val().match(/^(?:13\d|15\d|17\d|18\d)\d{5}(\d{3}|\*{3})$/)) {
               alert("手机号码格式不正确！");
               //$("#moileMsg").html("<font color='red'>手机号码格式不正确！请重新输入！</font>"); 
               $("#Mobile").focus();
               return false;
            }

            return true;
        }
        </script>
    </form>
</body>
</html>
