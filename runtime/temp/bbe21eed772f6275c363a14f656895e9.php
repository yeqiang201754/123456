<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"D:\web\point\public/../module/admin\view\config\index.html";i:1526093100;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo \think\Config::get('SITE_NAME'); ?>-后台管理中心</title>      
        <link rel="stylesheet" href="__PUBLIC__/plugins/layui2.2.3/css/layui.css">
	    <link rel="stylesheet" href="__PUBLIC__/plugins/font-awesome/css/font-awesome.min.css" media="all" />  
        
<style>
.layui-input, .layui-select, .layui-textarea {height: 30px; line-height: 30px;}
.layui-form-pane .layui-form-label {width: 50px;height: 30px; line-height: 30px;padding: 0px;}
.layui-inline{float:left}
.layui-btn-sm {height: 26px;line-height: 26px;font-size: 12px;padding: 0px 10px;}
</style>

        <style>
            .container{min-height: 600px;padding: 10px 10px 10px 10px;}
        </style>
	</head> 
    <body>
        <div class="container">
         
 <form class="layui-form layui-form-pane">
    <div class="layui-form-item layui-form-pane">          
               
        
        <a class="layui-btn layui-btn-sm" href="<?php echo url('@admin/config/add'); ?>"><i class="layui-icon">&#xe61f;</i> 添加</a>
        
    </div>
 </form> 

<table class="layui-table" lay-data="{ url:'<?php echo url("@admin/config/data"); ?>', page:true, id:'data', limit:<?php echo $config['page_num']; ?>}" lay-filter="data">
	<thead>
		<tr> 			
            <th lay-data="{type:'numbers', fixed: 'left'}"></th>
            <th lay-data="{field:'id',align:'left'}">ID</th>
            <th lay-data="{field:'key',align:'left'}">字段名称</th>
            <th lay-data="{field:'name',align:'left'}">配置名称</th>
            <th lay-data="{field:'value',align:'left'}">值</th>
            <th lay-data="{align:'center', toolbar: '#menu',width:180}">可用操作</th>   
		</tr>
	</thead>
</table> 

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
      
<script type="text/html" id="menu">
    <button class="layui-btn layui-btn-sm layui-btn-primary layui-btn-radius" lay-event="edit"><i class="layui-icon">&#xe642;</i>修改</button>
    <button class="layui-btn layui-btn-sm layui-btn-danger layui-btn-radius" lay-event="del"><i class="layui-icon">&#xe640;</i>删除</button>  
</script>  
 
<script type="text/javascript"> 
var serachobj=null;
layui.use(['form', 'layedit','table', 'laydate','element'], function(){
    var form = layui.form,layer = layui.layer,layedit = layui.layedit,laydate = layui.laydate,element = layui.element,table = layui.table;   
         
    function reload_go_one(data){
        if(data.code=='1'){
            table.reload('data', {
                url: '<?php echo url("@admin/config/data"); ?>',where:serachobj, page: {curr: 1}
            });
            layer.closeAll();
        }
    }
    function reload(data){
        if(data.code=='1'){
            table.reload('data', {
                url: '<?php echo url("@admin/config/data"); ?>',where:serachobj
            });
            layer.closeAll();
        }
    }  
     
          
    table.on('tool(data)', function(obj){
        var data = obj.data;
        
        if(obj.event === 'edit'){ 
            location.href = "<?php echo url('@admin/config/edit'); ?>" +'?id='+ data.id; 
        }
         
                       
        if(obj.event==='del'){
            parent.$.fn.jcb.confirm(true,'确定删除吗?','<?php echo url("@admin/config/del"); ?>',reload_go_one,{'id':data.id}); 				
        }
                  
    });
});
</script>

</html>