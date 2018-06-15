<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"D:\web\point\public/../module/admin\view\role\set_menu.html";i:1514444256;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
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
        
<div class="layui-btn-group"> 
  <a class="layui-btn layui-btn-sm" href="javascript:window.history.go(-1);"><i class="layui-icon">&#xe65c;</i> 返回</a>
</div>
<table class="layui-table" lay-data="{ url:'<?php echo $url; ?>', page:false, id:'data', limit:1000}" lay-filter="data">
	<thead>
		<tr> 	
            <th lay-data="{field:'selected', width:110, templet: '#menu', unresize: true}">权限</th>    
			<th lay-data="{field:'id',width:60}">ID</th>                     
            <th lay-data="{field:'title',width:200}">菜单名称</th>
			<th lay-data="{field:'pid',width:60}">父ID</th> 
            <th lay-data="{field:'istop', width:110, templet: '#ico', unresize: true}">图标</th>     
            <th lay-data="{field:'istop', width:110, templet: '#istop', unresize: true}">位置</th>
            <th lay-data="{field:'isshow', width:110, templet: '#isshow', unresize: true}">是否显示</th>
            <th lay-data="{field:'sort',width:100}">排序</th> 
            <th lay-data="{field:'url'}">链接(模块/控制器/方法)</th>
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
	<input type="checkbox" name="" value="{{d.id}}" lay-filter="roleclick" lay-skin="primary" {{ d.selected == true ? 'checked' : '' }}>
</script>

<script type="text/html" id="isshow"> 
  <input type="checkbox" name="lock" value="{{d.id}}" title="显示" lay-filter="lockshow" {{ d.isshow == 1 ? 'checked' : '' }}>
</script>
<script type="text/html" id="istop">
   <input type="checkbox" name="switch" lay-skin="switch" value="{{d.id}}" lay-filter="locktop" lay-text="顶部|左侧"  {{ d.istop == 1 ? 'checked' : ''}}>
</script>
<script type="text/html" id="ico">
    <a class="icoselect" data-id="{{d.id}}"> <i class="layui-icon" >{{d.ico}}</i></a>
</script>
<script>  
    function table_reload(){ 
        table.reload('data', {'url':'<?php echo $url; ?>'});
    } 

    layui.use(['form', 'table', 'laydate'], function(){
        table = layui.table;
        form = layui.form;   
        form.on('checkbox(roleclick)', function(obj){   
            console.log(obj);
			var postdata ={'val':obj.elem.checked ==true ? 1 :0,id:obj.value};
			parent.$.fn.jcb.post('<?php echo $posturl; ?>',postdata,false); 						
		});
    });
</script> 

</html>