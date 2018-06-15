<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"D:\web\point\public/../module/admin\view\article\index.html";i:1526433195;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
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
        <label class="layui-form-label">类型:</label>
        <div class="layui-input-inline">
            <select name="type">
                <option value="">全部</option>
                <?php if(is_array($l_type) || $l_type instanceof \think\Collection || $l_type instanceof \think\Paginator): $i = 0; $__LIST__ = $l_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
        <label class="layui-form-label">标题:</label>
        <div class="layui-input-inline">
            <input type="text" name="title" autocomplete="off" class="layui-input">
        </div>
        <button class="layui-btn layui-btn-sm" lay-submit lay-filter="serach" ><i class="layui-icon">&#xe615;</i> 搜索</button>
               
        
        <a class="layui-btn layui-btn-sm" href="<?php echo url('@admin/article/add'); ?>"><i class="layui-icon">&#xe61f;</i> 添加</a>
        
    </div>
 </form> 

<table class="layui-table" lay-data="{ url:'<?php echo url("@admin/article/data"); ?>', page:true, id:'data', limit:<?php echo $config['page_num']; ?>}" lay-filter="data">
	<thead>
		<tr> 			
            <th lay-data="{type:'numbers', fixed: 'left'}"></th>
            <th lay-data="{field:'name',align:'left'}">类型</th>
            <th lay-data="{field:'title',align:'left'}">标题</th>
            <th lay-data="{field:'front',align:'left'}">简介</th>
            <th lay-data="{field:'picture',width:120,templet: '#picture', unresize: true}">图片</th>
            <th lay-data="{field:'addtime',align:'left'}">添加时间</th>
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
<script type="text/html" id="picture">
 <img src = {{d.picture != '' ? d.picture : 'http://t.cn/RCzsdCq' }} class="layui-nav-img" id="pic" onclick="pic(this)">
</script> 
<script type="text/javascript"> 
function pic(obj){
    var src = obj.src; 
    layer.open({
        title: '查看图片'
        ,content: "<div style='text-align:center'><img src="+src+" style='width:500px;height:300px'></div>"
        ,btn:false
        ,area: ['600px', '400px']
    });     
}
var serachobj=null;
layui.use(['form', 'layedit','table', 'laydate','element'], function(){
    var form = layui.form,layer = layui.layer,layedit = layui.layedit,laydate = layui.laydate,element = layui.element,table = layui.table;   
         
    function reload_go_one(data){
        if(data.code=='1'){
            table.reload('data', {
                url: '<?php echo url("@admin/article/data"); ?>',where:serachobj, page: {curr: 1}
            });
            layer.closeAll();
        }
    }
    function reload(data){
        if(data.code=='1'){
            table.reload('data', {
                url: '<?php echo url("@admin/article/data"); ?>',where:serachobj
            });
            layer.closeAll();
        }
    }
    form.on('submit(serach)', function(obj){
       serachobj = eval('('+JSON.stringify(obj.field)+')');
       table.reload('data', { url:'<?php echo url("@admin/article/data"); ?>',where:serachobj, page:{curr: 1} });
       return false;
    }); 
          
    table.on('tool(data)', function(obj){
        var data = obj.data;
        
        if(obj.event === 'edit'){ 
            location.href = "<?php echo url('@admin/article/edit'); ?>" +'?id='+ data.id; 
        }
         
                       
        if(obj.event==='del'){
            parent.$.fn.jcb.confirm(true,'确定删除吗?','<?php echo url("@admin/article/del"); ?>',reload_go_one,{'id':data.id}); 				
        }
                  
    });
});
</script>

</html>