<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\web\point\public/../module/admin\view\bank\index.html";i:1526103986;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
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
        <label class="layui-form-label" style="width:150px;">银行名称:</label>
        <div class="layui-input-inline">
            <input type="text" name="bankname" autocomplete="off" class="layui-input">
        </div>
        <button class="layui-btn layui-btn-sm" lay-submit lay-filter="serach" ><i class="layui-icon">&#xe615;</i> 搜索</button>
               
        
        <a class="layui-btn layui-btn-sm" href="<?php echo url('@admin/bank/add'); ?>"><i class="layui-icon">&#xe61f;</i> 添加</a>
        
    </div>
 </form> 

<table class="layui-table" lay-data="{ url:'<?php echo url("@admin/bank/data"); ?>', page:true, id:'data', limit:<?php echo $config['page_num']; ?>}" lay-filter="data">
	<thead>
		<tr> 			
            <th lay-data="{type:'numbers', fixed: 'left'}"></th>
            <th lay-data="{field:'bankname',align:'left'}">银行名称</th>
            <th lay-data="{field:'zy_radio',align:'left'}">专员每1W积分兑换金额</th>
            <th lay-data="{field:'jl_radio',align:'left'}">ji经理每1W积分兑换金额</th>
            <th lay-data="{field:'hz_radio',align:'left'}">行长每1W积分兑换金额</th>
            <th lay-data="{field:'yhj_radio',align:'left'}">银行家每1W积分兑换金额</th>
            <th lay-data="{field:'remark',align:'left'}">描述</th>
            <th lay-data="{field:'step',align:'left'}">兑换步骤</th>
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
                url: '<?php echo url("@admin/bank/data"); ?>',where:serachobj, page: {curr: 1}
            });
            layer.closeAll();
        }
    }
    function reload(data){
        if(data.code=='1'){
            table.reload('data', {
                url: '<?php echo url("@admin/bank/data"); ?>',where:serachobj
            });
            layer.closeAll();
        }
    }
    form.on('submit(serach)', function(obj){
       serachobj = eval('('+JSON.stringify(obj.field)+')');
       table.reload('data', { url:'<?php echo url("@admin/bank/data"); ?>',where:serachobj, page:{curr: 1} });
       return false;
    }); 
          
    table.on('tool(data)', function(obj){
        var data = obj.data;
        
        if(obj.event === 'edit'){ 
            location.href = "<?php echo url('@admin/bank/edit'); ?>" +'?id='+ data.id; 
        }
         
                       
        if(obj.event==='del'){
            parent.$.fn.jcb.confirm(true,'确定删除吗?','<?php echo url("@admin/bank/del"); ?>',reload_go_one,{'id':data.id}); 				
        }
                  
    });
});
</script>

</html>