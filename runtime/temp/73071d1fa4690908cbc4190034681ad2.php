<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"D:\web\point\public/../module/index\view\user\withdraw.html";i:1525943281;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        提现申请
    </title>
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;"
    />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection" content="telephone=no" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="__PUBLIC__/css/style_info.css" />
    <link rel="stylesheet" href="__PUBLIC__/css/style.css" />
    <link rel="stylesheet" href="__PUBLIC__/css/resreg_style.css" />
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="__PUBLIC__/js/jquery.slide.js"></script>
    <script src="__PUBLIC__/js/touchslide.1.1.js"></script>
    <script src="__PUBLIC__/js/addons.js"></script>
    <script type="text/javascript" src="res_submit/js/jquery.js"></script>
    <script language="javascript">
        function sj() {
            var vjine = document.getElementById("totalcharge").value;
            var vbank = document.getElementById("bankname").value;
            var vbankzh = document.getElementById("bankzh").value;
            var vhuming = document.getElementById("huming").value;
            var vkahao = document.getElementById("kahao").value;

            if (parseInt(document.getElementById("totalcharge").value) < parseInt(document.getElementById("zuidi").value)) {
                alert("提现金额不允许低于最低提现金额，请修改!!")
                document.getElementById("jine").focus();
                return false;
            }
            if (document.getElementById("bankname").value == "") {
                alert("开户行不能为空!!")
                document.getElementById("bankname").focus();
                return false;
            }
            if (document.getElementById("huming").value == "") {
                alert("户名不能为空!!")
                document.getElementById("huming").focus();
                return false;
            }
            if (document.getElementById("kahao").value == "") {
                alert("卡号不能为空!!")
                document.getElementById("kahao").focus();
                return false;
            }

            $.ajax({
                url:'/index/user/withdraw_save',
                type:'post',
                dataType:'json',
                data:{'amount':vjine,'bank':vbank,'branch':vbankzh,'name':vhuming,'idnum':vkahao},
                success:function(data){
                    if(data.code == 0){
                        alert(data.msg);
                    }else{
                        alert(data.msg);
                        window.location.href="/index/user/index"; 
                    }

                }
            });
        }
    </script>
</head>

<body>
    <form method="post" action="tixian.aspx" id="form1">
        <input name="hidjine" type="hidden" id="hidjine" class="inputBottomLine" maxlength="100" style="width: 100%" />
        <div class="layout">
            <div class="header">
                <div class="inner">
                    <a href="/index/user" class="return"></a>
                    <h2>提现申请</h2>
                </div>
            </div>

            <input name="hidmemlogin" type="hidden" id="hidmemlogin" value="18883313376" />
            <input name="shuidian" type="hidden" id="shuidian" value="0" />
            <input name="shouxufei" type="hidden" id="shouxufei" value="<?php echo $withdraw_fee; ?>" />
            <input name="zuidi" type="hidden" id="zuidi" value="<?php echo $withdraw_min; ?>" />
            <input name="bank" type="hidden" id="bank" />
            <div class="alert-warning">请核对您的结算银行卡信息，确认无误后再点击申请提现。
                <br /> 最低提现金额：<?php echo $withdraw_min; ?>元。
                <br /> 提现手续费为：<?php echo $withdraw_fee; ?>元/笔。
                <br />
            </div>
            <div class="formBlock">
                <div class="title">
                    <h3>提现申请</h3>
                </div>
                <ul>
                    <li>
                        <div class="inner">
                            <label>可提金额</label>
                            <input name="totalcharge" type="text" id="totalcharge" class="text" value="<?php echo $user['balance']; ?>" />
                        </div>
                    </li>
                    <li>
                        <div class="selectDiv">
                            <label>开户行</label>
                            <select name="bankname" id="bankname">
                                <option selected="selected" value="">请选择</option>
                                <?php if(is_array($bank) || $bank instanceof \think\Collection || $bank instanceof \think\Paginator): $i = 0; $__LIST__ = $bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $data['bankname']; ?>"><?php echo $data['bankname']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="inner">
                            <label>支行名称</label>
                            <input name="bankzh" type="text" id="bankzh" class="text" />
                        </div>
                    </li>
                    <li>
                        <div class="inner">
                            <label>户名</label>
                            <input name="huming" type="text" id="huming" class="text" />
                        </div>
                    </li>
                    <li>
                        <div class="inner">
                            <label>卡号</label>
                            <input name="kahao" type="text" id="kahao" class="text" />
                        </div>

                    </li>
                </ul>
                <div class="submit">
                    <input name="cz_btn" type="button" id="cz_btn" value="确认提交" class="btn-sub" onclick="javascript: sj();" />
                </div>
            </div>
        </div>
    </form>
</body>

</html>