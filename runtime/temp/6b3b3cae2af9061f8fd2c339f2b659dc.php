<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"D:\project\point\point\public/../module/admin\view\sowing\index.html";i:1527488721;s:67:"D:\project\point\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo \think\Config::get('SITE_NAME'); ?>-后台管理中心</title>      
        <link rel="stylesheet" href="__PUBLIC__/plugins/layui2.2.3/css/layui.css">
	    <link rel="stylesheet" href="__PUBLIC__/plugins/font-awesome/css/font-awesome.min.css" media="all" />  
        
<style>
.layui-nav-img {
    width: 40px;
    height: 40px;
    margin-right: 10px;
    border-radius: 50%;
}
.layui-table-cell {
    height: 40px;
    line-height: 40px;
}
</style>

        <style>
            .container{min-height: 600px;padding: 10px 10px 10px 10px;}
        </style>
	</head> 
    <body>
        <div class="container">
        
<div class="layui-btn-group">
    <a class="layui-btn layui-btn-sm" href="<?php echo url('@admin/sowing/add'); ?>"><i class="layui-icon">&#xe61f;</i> 添加</a>
</div>
<table class="layui-table" lay-data="{ url:'<?php echo url("@admin/sowing/data"); ?>', page:true, id:'data', limit:<?php echo $config['page_num']; ?>}" lay-filter="data">
	<thead>
		<tr> 			
            <th lay-data="{type:'numbers', fixed: 'left'}"></th>	
            <th lay-data="{field:'position',fixed: 'left'}">显示位置</th>
            <th lay-data="{field:'picture',templet: '#picture', unresize: true}">图片</th>
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
    <a class="layui-btn layui-btn-sm layui-bg-green" lay-event="edit"><i class="layui-icon">&#xe632;</i>修改</a> 
	<a class="layui-btn layui-btn-sm layui-btn-danger" lay-event="del"><i class="layui-icon">&#xe640;</i>删除</a>
</script>
<script type="text/html" id="picture">
    <img src = {{d.picture != '' ? d.picture : 'http://t.cn/RCzsdCq' }} class="layui-nav-img" id="pic" onclick="pic(this)">
   </script> 
<script>
function pic(obj){
    var src = obj.src; 
    layer.open({
        title: '查看图片'
        ,content: "<div style='text-align:center'><img src="+src+" style='width:100%;height:300px'></div>"
        ,btn:false
        ,area: ['800px', '400px']
    });     
}    
layui.use(['form', 'layedit','table', 'laydate','element'], function(){
    var form = layui.form
    ,layer = layui.layer
    ,layedit = layui.layedit
    ,laydate = layui.laydate
    ,element = layui.element,table = layui.table;    
    


 	function table_reload(data){
        if(data.code=='1'){
            table.reload('data', {
                url: '<?php echo url("@admin/sowing/data"); ?>', page: {
                        curr: 1 //重新从第 1 页开始
                }
            });
        }
    } 

	table.on('tool(data)', function(obj){
		var data = obj.data;
		if(obj.event === 'edit'){ 
			location.href = "<?php echo url('@admin/sowing/edit'); ?>" +'?id='+ data.id; 
        }else if(obj.event==='del'){
			parent.$.fn.jcb.confirm(true,'确定删除吗?','<?php echo url("@admin/sowing/del"); ?>',table_reload,{'id':data.id}); 				
		} 
	}); 
});
</script>

</html>