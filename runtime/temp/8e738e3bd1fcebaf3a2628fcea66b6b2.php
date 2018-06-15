<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\web\point\public/../module/admin\view\role\index.html";i:1516593327;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
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
    <button class="layui-btn layui-btn-sm" id="add"><i class="layui-icon">&#xe61f;</i> 添加</button>
</div>
<table class="layui-table" lay-data="{ url:'<?php echo url("@admin/role/role_data"); ?>', page:true, id:'data', limit:<?php echo $config['page_num']; ?>}" lay-filter="data">
	<thead>
		<tr> 			
			<th lay-data="{field:'id',width:60}">ID</th>                     
            <th lay-data="{field:'rolename',width:200,align:'center',edit:'text'}">权限名称</th>
			<th lay-data="{field:'sort',width:60,align:'center',edit:'text'}">排序</th>       
            <th lay-data="{field:'cstatus', width:110, templet: '#cstatus', unresize: true,align:'center'}">状态</th> 
            <th lay-data="{field:'cmark',edit:'text'}">备注</th>
			<th lay-data="{fixed: 'right', align:'center', toolbar: '#menu',width:300}">可用操作</th> 
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
    <a class="layui-btn layui-btn-sm layui-bg-green" lay-event="set_menu"><i class="layui-icon">&#xe632;</i>设置菜单</a>
    <a class="layui-btn layui-btn-sm layui-bg-green" lay-event="set_role"><i class="layui-icon">&#xe631;</i>设置权限</a>
	<a class="layui-btn layui-btn-sm layui-btn-danger" lay-event="del"><i class="layui-icon">&#xe640;</i>删除</a>
</script>
<script type="text/html" id="cstatus"> 
  <input type="checkbox" name="lock" value="{{d.id}}" title="启用" lay-filter="cstatus" {{ d.cstatus == 1 ? 'checked' : '' }}>
</script>


<script>
//注意：折叠面板 依赖 element 模块，否则无法进行功能性操作
layui.use(['form', 'layedit','table', 'laydate','element'], function(){
    var form = layui.form
    ,layer = layui.layer
    ,layedit = layui.layedit
    ,laydate = layui.laydate
    ,element = layui.element,table = layui.table;
    form.on('submit(submit)', function(data) {
        console.log(data);
        parent.$.fn.jcb.post('<?php echo url("@admin/role/action_save"); ?>',data.field,false);
		return false;
    });

    //重新加载数据
 	function table_reload(data){
        if(data.code=='1'){
            table.reload('data', {
                url: '<?php echo url("@admin/role/role_data"); ?>', page: {
                        curr: 1 //重新从第 1 页开始
                }
            });
        }
    } 

    $('#add').on('click',function(){
            parent.$.fn.jcb.post('<?php echo url("@admin/role/add"); ?>',null,false,table_reload); 
    });  
    table.on('edit(data)', function(obj){ 
        var r = /^\+?[0-9][0-9]*$/;
        if(obj.field == 'sort'){　	 
            if(!r.test(obj.value)){               
                $.fn.jcb.alert('必须输入整数','error');
                return false; 
            }  
        }              
        parent.$.fn.jcb.post('<?php echo url("@admin/role/modify"); ?>',obj,false,table_reload); 
    });  

    form.on('checkbox(cstatus)', function(obj){
			var postdata ={'field':'cstatus','value':obj.elem.checked ==true ? 1 :0,data:{'id':this.value} }  
			parent.$.fn.jcb.post('<?php echo url("@admin/role/modify"); ?>',postdata,false,table_reload); 						
	});

	table.on('tool(data)', function(obj){
		var data = obj.data;
		if(obj.event === 'set_menu'){ 
			location.href = '<?php echo url("@admin/role/set_menu"); ?>?id='+ data.id; 
        }else if(obj.event === 'set_role'){ 
			location.href = '<?php echo url("@admin/role/action_set"); ?>?id='+ data.id;
		}else if(obj.event==='del'){
			parent.$.fn.jcb.confirm(true,'确定删除吗?','<?php echo url("@admin/role/del"); ?>',table_reload,{'id':data.id}); 				
		} 
	});    

});
</script>

</html>