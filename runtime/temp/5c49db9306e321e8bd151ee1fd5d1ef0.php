<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"D:\web\point\public/../module/admin\view\withdraw\index.html";i:1526110380;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
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
        <label class="layui-form-label">开户行:</label>
        <div class="layui-input-inline">
            <input type="text" name="bank" autocomplete="off" class="layui-input">
        </div>
        <label class="layui-form-label">用户名:</label>
        <div class="layui-input-inline">
            <input type="text" name="username" autocomplete="off" class="layui-input">
        </div>
        <label class="layui-form-label" style="width:100px;">是否审核:</label>
        <div class="layui-input-inline">
            <select name="status">
                <option value="">请选择</option>
                <option value="0">待审核</option>
                <option value="1">审核通过</option>
                <option value="2">审核未通过</option>
            </select>
        </div>
        <button class="layui-btn layui-btn-sm" lay-submit lay-filter="serach" ><i class="layui-icon">&#xe615;</i> 搜索</button>
               
        
    </div>
 </form> 

<table class="layui-table" lay-data="{ url:'<?php echo url("@admin/withdraw/data"); ?>', page:true, id:'data', limit:<?php echo $config['page_num']; ?>}" lay-filter="data">
	<thead>
		<tr> 			
            <th lay-data="{type:'numbers', fixed: 'left'}"></th>
            <th lay-data="{field:'username',width:100,align:'center'}">用户名</th>
            <th lay-data="{field:'amount',width:100,align:'center'}">提现金额</th>
            <th lay-data="{field:'bank',width:200,align:'center'}">开户行</th>
            <th lay-data="{field:'branch',width:300,align:'center'}">支行名称</th>
            <th lay-data="{field:'name',width:100,align:'center'}">户名</th>
            <th lay-data="{field:'idnum',width:180,align:'center'}">卡号</th>
            <th lay-data="{field:'status',width:100,align:'center'}">审核状态</th>
            <th lay-data="{field:'addtime',align:'left'}">提现时间</th>
            <th lay-data="{align:'center', toolbar: '#menu',width:320}">可用操作</th>   
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
    <button class="layui-btn layui-btn-sm layui-btn-danger layui-btn-radius" lay-event="del"><i class="layui-icon">&#xe640;</i>删除</button>
    {{#  if(d.status == '待审核'){ }}
    <button class="layui-btn layui-btn-sm layui-btn-radius" lay-event="success"><i class="layui-icon">&#xe640;</i>审核通过</button> 
    <button class="layui-btn layui-btn-sm layui-btn-normal layui-btn-radius" lay-event="fail"><i class="layui-icon">&#xe640;</i>审核不通过</button>  
    {{#  } }} 
</script>  
 
<script type="text/javascript"> 
var serachobj=null;
layui.use(['form', 'layedit','table', 'laydate','element'], function(){
    var form = layui.form,layer = layui.layer,layedit = layui.layedit,laydate = layui.laydate,element = layui.element,table = layui.table;   
         
    function reload_go_one(data){
        if(data.code=='1'){
            table.reload('data', {
                url: '<?php echo url("@admin/withdraw/data"); ?>',where:serachobj, page: {curr: 1}
            });
            layer.closeAll();
        }
    }
    function reload(data){
        if(data.code=='1'){
            table.reload('data', {
                url: '<?php echo url("@admin/withdraw/data"); ?>',where:serachobj
            });
            layer.closeAll();
        }
    }
    form.on('submit(serach)', function(obj){
       serachobj = eval('('+JSON.stringify(obj.field)+')');
       table.reload('data', { url:'<?php echo url("@admin/withdraw/data"); ?>',where:serachobj, page:{curr: 1} });
       return false;
    }); 
          
    table.on('tool(data)', function(obj){
        var data = obj.data;
        if(obj.event==='del'){
            parent.$.fn.jcb.confirm(true,'确定删除吗?','<?php echo url("@admin/withdraw/del"); ?>',reload_go_one,{'id':data.id}); 				
        }

        if(obj.event==='success'){
            parent.$.fn.jcb.confirm(true,'确定审核通过吗?','<?php echo url("@admin/withdraw/status"); ?>',reload_go_one,{'id':data.id,'status':1}); 				
        }

        if(obj.event==='fail'){
            parent.$.fn.jcb.confirm(true,'确定审核通过吗?','<?php echo url("@admin/withdraw/status"); ?>',reload_go_one,{'id':data.id,'status':2}); 				
        }
                  
    });
});
</script>

</html>