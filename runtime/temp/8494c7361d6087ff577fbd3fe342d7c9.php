<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\web\point\public/../module/admin\view\menu\index.html";i:1517219912;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo \think\Config::get('SITE_NAME'); ?>-后台管理中心</title>      
        <link rel="stylesheet" href="__PUBLIC__/plugins/layui2.2.3/css/layui.css">
	    <link rel="stylesheet" href="__PUBLIC__/plugins/font-awesome/css/font-awesome.min.css" media="all" />  
        
 <style>
 .layui-form-switch{border-color: #009688;background-color: #009688;}
 .layui-form-onswitch {border-color: #5FB878;background-color: #5FB878;}
 .layui-form-switch em {color: white!important;}
 .site-doc-icon {margin-bottom: 50px;font-size: 0;}
 .site-doc-icon li {display: inline-block;vertical-align: middle;width: 80px;line-height: 25px;padding: 20px 0;margin-right: -1px;margin-bottom: -1px;
    border: 1px solid #e2e2e2;font-size: 10px;text-align: center;color: #666;transition: all .3s;-webkit-transition: all .3s;cursor: pointer
} 
.site-doc-icon li .layui-icon {display: inline-block;font-size: 28px;}
.site-doc-icon li .name {color: #c2c2c2;}
.site-doc-icon li:hover {background-color: #f2f2f2;color: #000;} 
.icoselect{cursor: pointer;min-width: 50px;min-height: 30px; display: block;}

</style>
 
        <style>
            .container{min-height: 600px;padding: 10px 10px 10px 10px;}
        </style>
	</head> 
    <body>
        <div class="container">
        
<div class="layui-btn-group">
  <button class="layui-btn layui-btn-sm" id="add"><i class="layui-icon">&#xe61f;</i> 添加菜单</button>
  <a class="layui-btn layui-btn-sm" href="javascript:parent.location.reload();"><i class="layui-icon">&#x1002;</i>刷新后台</a>
</div>
<table class="layui-table" lay-data="{ url:'<?php echo url("@admin/menu/menu_data"); ?>', page:false, id:'data', limit:1000}" lay-filter="data">
	<thead>
		<tr> 			
			<th lay-data="{field:'id',width:60}">ID</th>                     
            <th lay-data="{field:'title',width:200,edit:'text'}">菜单名称</th>
			<th lay-data="{field:'pid',width:60,edit:'text',align:'center'}">父ID</th> 
            <th lay-data="{field:'istop', width:110, templet: '#ico', unresize: true,align:'center'}">图标</th>     
            <th lay-data="{field:'istop', width:110, templet: '#istop', unresize: true,align:'center'}">位置</th>
            <th lay-data="{field:'isshow', width:110, templet: '#isshow', unresize: true,align:'center'}">是否显示</th>
            <th lay-data="{field:'sort',width:60,edit:'text',align:'center'}">排序</th> 
            <th lay-data="{field:'url',edit:'text'}">链接(模块/控制器/方法)</th>
			<th lay-data="{fixed: 'right', align:'center', toolbar: '#menu',width:150}">可用操作</th> 
		</tr>
	</thead>
</table> 
<div class="icons" style="display:none">
    <ul class="site-doc-icon"> 
    <?php if(is_array($icos) || $icos instanceof \think\Collection || $icos instanceof \think\Paginator): $i = 0; $__LIST__ = $icos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ico): $mod = ($i % 2 );++$i;?>    
      <li>
        <i class="layui-icon">&<?php echo $ico['code']; ?></i>
        <div class="name"><?php echo $ico['name']; ?></div>
        <div class="code"><?php echo $ico['code']; ?></div>
      </li>
    <?php endforeach; endif; else: echo "" ;endif; ?> 
     <li>
        <i class="layui-icon">无</i>
        <div class="name">空</div>
        <div class="code"></div>
      </li>
    </ul>
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
    
<script type="text/html" id="menu">	
	<a class="layui-btn layui-btn-sm layui-btn-danger" lay-event="del"><i class="layui-icon">&#xe640;</i>删除</a>
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
    $(function(){
        var icoid= '';
        $('.container').on('click','li',function(){           
            var icoval= $(this).children(".code").html();
            icoval = (icoval == ''?'':'&'+icoval);
            var postdata ={'field':'ico','value':icoval,data:{'id':icoid} }  
			parent.$.fn.jcb.post('<?php echo url("@admin/menu/menu_set"); ?>',postdata,false,table_reload); 
            layer.closeAll();           
        }); 
        $('.container').on('click','.icoselect',function(){   
             icoid = $(this).attr('data-id');       
             layer.open({type: 1,title:'图标选择',skin: 'layui-layer-molv',area: ['670px', '450px'],closeBtn: 1,anim: 2,shadeClose: true,content: $('.icons')});
        });
    });

    function table_reload(){ 
        table.reload('data', {'url':'<?php echo url("@admin/menu/menu_data"); ?>'});
    } 
    layui.use(['form', 'table', 'laydate'], function(){
        table = layui.table;
        form = layui.form; 
        table.on('edit(data)', function(obj){ 
                var r = /^\+?[0-9][0-9]*$/;
                if(obj.field == 'pid' || obj.field == 'sort'){　	 
                    if(!r.test(obj.value)){
                        table.reload('data', {'url':'<?php echo url("@admin/menu/menu_data"); ?>'});
                        $.fn.jcb.alert('必须输入整数','error');
                        return false; 
                    }  
                }              
                parent.$.fn.jcb.post('<?php echo url("@admin/menu/menu_set"); ?>',obj,false,table_reload); 
        });  
        //修改可用状态
		form.on('checkbox(lockshow)', function(obj){
			var postdata ={'field':'isshow','value':obj.elem.checked ==true ? 1 :0,data:{'id':this.value} }  
			parent.$.fn.jcb.post('<?php echo url("@admin/menu/menu_set"); ?>',postdata,false,table_reload); 						
		});

       $('#add').on('click',function(){
            parent.$.fn.jcb.post('<?php echo url("@admin/menu/menu_add"); ?>',null,false,table_reload); 
       });          

        form.on('switch(locktop)', function(obj){           
			var postdata ={'field':'istop','value':obj.elem.checked ==true ? 1 :0,data:{'id':this.value} }  
			parent.$.fn.jcb.post('<?php echo url("@admin/menu/menu_set"); ?>',postdata,false,table_reload); 						
		});
        table.on('tool(data)', function(obj){           
            var data = obj.data; //获得当前行数据
            var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
            var tr = obj.tr; //获得当前行 tr 的DOM对象            
            if(layEvent === 'del'){ 
                parent.$.fn.jcb.confirm(true,'确定要删除吗?','<?php echo url("@admin/menu/menu_del"); ?>',table_reload,data);  
            }
        });
    });
</script> 

</html>