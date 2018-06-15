<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\web\point\public/../module/admin\view\notice\edit.html";i:1526032368;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
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
        <label class="layui-form-label">标题</label>
        <div class="layui-input-inline">
            <input type="text" name="title" lay-verify="required" value="<?php echo $list['title']; ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item  layui-form-text">
        <label class="layui-form-label">内容</label>
        <div class="layui-input-block">
             <script id="content" name="content" type="text/plain"><?php echo $list['content']; ?></script>
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
    var content = UE.getEditor('content');
    function goback(data){
        if(data.code=='1') window.history.go(-1);
    }    
    form.on('submit(submit)', function(data){
        data.field.content = UE.getEditor('content').getContent();       
		parent.$.fn.jcb.post("<?php echo $config['current_url']; ?>",data.field,false,goback);  
		return false;
	});
});
</script>

</html>