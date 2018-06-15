<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\web\point\public/../module/admin\view\index\main.html";i:1515811144;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo \think\Config::get('SITE_NAME'); ?>-后台管理中心</title>      
        <link rel="stylesheet" href="__PUBLIC__/plugins/layui2.2.3/css/layui.css">
	    <link rel="stylesheet" href="__PUBLIC__/plugins/font-awesome/css/font-awesome.min.css" media="all" />  
         
 

        <style>
            .container{min-height: 600px;padding: 10px 10px 10px 10px;}
        </style>
	</head> 
    <body>
        <div class="container">
        
 <div class="layui-form ayui-form-pane" action="">    

  <div class="layui-form-item">
    <label class="layui-form-label">系统版本:</label>
    <div class="layui-input-block">
      <input type="text" value ="1.0" readonly class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">操作系统:</label>
    <div class="layui-input-block">
      <input type="text" value ="<?php echo $info['操作系统']; ?>" readonly class="layui-input">
    </div>
  </div>
    <div class="layui-form-item">
    <label class="layui-form-label">运行环境:</label>
    <div class="layui-input-block">
      <input type="text" value ="<?php echo $info['运行环境']; ?>" readonly class="layui-input">
    </div>
  </div>
      <div class="layui-form-item">
    <label class="layui-form-label">PHP运行方式:</label>
    <div class="layui-input-block">
      <input type="text" value ="<?php echo $info['PHP运行方式']; ?>" readonly class="layui-input">
    </div>
  </div>
        <div class="layui-form-item">
    <label class="layui-form-label">上传附件限制:</label>
    <div class="layui-input-block">
      <input type="text" value ="<?php echo $info['上传附件限制']; ?>" readonly class="layui-input">
    </div>
  </div>
    <div class="layui-form-item">
    <label class="layui-form-label">服务器时间:</label>
    <div class="layui-input-block">
      <input type="text" value ="<?php echo $info['服务器时间']; ?>" readonly class="layui-input">
    </div>
  </div>
    <div class="layui-form-item">
    <label class="layui-form-label">剩余空间:</label>
    <div class="layui-input-block">
      <input type="text" value ="<?php echo $info['剩余空间']; ?>" readonly class="layui-input">
    </div>
  </div>
   
 
</div> 

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
    var form = layui.form,layer = layui.layer,layedit = layui.layedit
    ,laydate = layui.laydate,upload = layui.upload,element = layui.element,table = layui.table;     
  
});
</script>

</html>