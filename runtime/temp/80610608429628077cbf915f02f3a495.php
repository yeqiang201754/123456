<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"D:\project\point\point\public/../module/index\view\login\index.html";i:1526268669;}*/ ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1"><title>
	积分随心兑 会员登录
</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="X-UA-Compatible" content="IE=7" /><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" /><meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="stylesheet" href="__PUBLIC__/css/resqyxstyle.css" />
    <script src="__PUBLIC__/js/jquery-2.0.0.min.js"></script>
    <script src="__PUBLIC__/js/jquery.Slide.js"></script>
    <script type="text/javascript">
        function err_(control) {
            var Name = document.getElementById("Name");
            var Pwd = document.getElementById("Pwd");
            if (Name.value == "") {
                alert("手机号码不能为空!!")
                Name.focus();
                return false;
            }
            if (Pwd.value == "") {
                alert("密码不能为空!!")
                Pwd.focus();
                return false;
            }

            $.ajax({
                url:'/index/login/login',
                type:'post',
                dataType:'json',
                data:{'mobile':Name.value,'password':Pwd.value},
                success:function(data){
                    if(data.code == 0){
                        alert(data.msg);
                    }else{
                        window.location.href="/index/index"; 
                    }

                }
            });
        }
    </script>
</head>
<body style="background-color:white;">
<form method="post" id="Form1">
    <div class="layout">
        <div class="page_login">
            <div class="imgs">
                <img src="__PUBLIC__/images/bann1.jpg" id="pclogo" /></div>
            <div class="login_tab">
                <div class="hd">
                    <ul>
                        <li class="on">会员登录</li>
                        <i></i>
                    </ul>
                </div>
                <div class="bd">
                    <div>
                        <div class="login_wrap">
                            <ul>
                                <li class="i1">
                                    <input name="Name" type="text" id="Name" class="text" placeholder="手机号" /></li>
                                <li class="i2">
                                    <input name="Pwd" type="password" id="Pwd" class="text t_mm " placeholder="密码" /></li>
                                <li class="btn">
                                    <input class="sbt_zc" value="登录" OnClick="return err_(&#39;Submit1&#39;);" /></li>
                                <li class="cbt clearfix"><a href="/index/findpwd" class="fl" style="font-size:16px;">忘记密码？</a><a href="/index/register" class="fr" style="font-size:16px;">注册&gt;</a></li>

                            </ul>
                        </div>

                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</form>

</body>
</html>
