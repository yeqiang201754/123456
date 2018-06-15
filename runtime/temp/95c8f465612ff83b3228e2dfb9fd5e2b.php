<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:65:"D:\project\point\point\public/../module/admin\view\bank\edit.html";i:1528533162;s:67:"D:\project\point\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo \think\Config::get('SITE_NAME'); ?>-后台管理中心</title>      
        <link rel="stylesheet" href="__PUBLIC__/plugins/layui2.2.3/css/layui.css">
	    <link rel="stylesheet" href="__PUBLIC__/plugins/font-awesome/css/font-awesome.min.css" media="all" />  
         
 <style>
    .layui-upload-img {width: 150px;margin: 0 10px 10px 0;}
</style>

        <style>
            .container{min-height: 600px;padding: 10px 10px 10px 10px;}
        </style>
	</head> 
    <body>
        <div class="container">
        
<form class="layui-form layui-form-pane" action="">
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:200px;">银行名称</label>
        <div class="layui-input-inline">
            <input type="text" name="bankname" lay-verify="required" value="<?php echo $list['bankname']; ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">图片</label>
        <div class="layui-input-block">
            <div class="layui-upload-list">
                <img class="layui-upload-img" src="<?php echo (isset($list['img']) && ($list['img'] !== '')?$list['img']:'/resource/images/bakimg.png'); ?>" id="img_img">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:200px;">专员每1W积分兑换金额</label>
        <div class="layui-input-inline">
            <input type="text" name="zy_radio" lay-verify="required" value="<?php echo $list['zy_radio']; ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:200px;">经理每1W积分兑换金额</label>
        <div class="layui-input-inline">
            <input type="text" name="jl_radio" lay-verify="required" value="<?php echo $list['jl_radio']; ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:200px;">行长每1W积分兑换金额</label>
        <div class="layui-input-inline">
            <input type="text" name="hz_radio" lay-verify="required" value="<?php echo $list['hz_radio']; ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:200px;">银行家每1W积分兑换金额</label>
        <div class="layui-input-inline">
            <input type="text" name="yhj_radio" lay-verify="required" value="<?php echo $list['yhj_radio']; ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item  layui-form-text">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-block">
             <script id="remark" name="remark" type="text/plain"><?php echo $list['remark']; ?></script>
        </div>
    </div>
    <div class="layui-form-item  layui-form-text">
        <label class="layui-form-label">兑换步骤</label>
        <div class="layui-input-block">
             <script id="step" name="step" type="text/plain"><?php echo $list['step']; ?></script>
        </div>
    </div> 
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="submit">提交修改</button>
            <button type="reset" class="layui-btn layui-btn-primary">重  置</button>
        </div>
    </div>
</form>

        </div>
    </body> 
    <script src="__PUBLIC__/plugins/layui2.2.3/layui.js" charset="utf-8"></script> 
	<script src="__PUBLIC__/js/jquery.min.js" charset="utf-8"></script>
	<script src="__PUBLIC__/js/jquery.extend.js" charset="utf-8"></script>	 

    <!-- 百度编辑器 -->
    <script type="text/javascript" src="__PUBLIC__/plugins/umeditor/ueditor.config.js"></script>   
    <script type="text/javascript" src="__PUBLIC__/plugins/umeditor/ueditor.all.min.js"></script>

    <script type="text/javascript">
        var table,form,laydate; 
        layui.use(['form', 'table', 'laydate'], function(){
            table = layui.table;form = layui.form;laydate = layui.laydate;  
        });
    </script>
    
<script>
layui.use(['form','upload', 'layedit','table', 'laydate','element'], function(){
    var form = layui.form,layer = layui.layer,layedit = layui.layedit,laydate = layui.laydate,upload = layui.upload,element = layui.element,table = layui.table;
    upload.render({
        elem: '#img_img'
        ,url: '<?php echo url("@admin/login/upload"); ?>'
        ,done: function(res){
            if(res.code == 1){
                $("#img_img").attr('src',res.data.src);
            }else{
                parent.$.fn.jcb.alert(res.msg,'error');
            }
        }
    });

    var remark = UE.getEditor('remark');
    var step = UE.getEditor('step');
    function goback(data){
        if(data.code=='1') window.history.go(-1);
    }    
    form.on('submit(submit)', function(data){
        data.field.img = $('#img_img').attr('src');
        if(data.field.img == '/resource/images/bakimg.png'){
            data.field.img ='';
        }
        data.field.remark = UE.getEditor('remark').getContent();
        data.field.step = UE.getEditor('step').getContent();       
		parent.$.fn.jcb.post("<?php echo $config['current_url']; ?>",data.field,false,goback);  
		return false;
	});
});
</script>

</html>