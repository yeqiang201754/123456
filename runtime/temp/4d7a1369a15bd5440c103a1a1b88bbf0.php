<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:61:"D:\web\point\public/../module/admin\view\role\action_set.html";i:1514454070;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
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
        
<form class="layui-form" action="">
 <div class="layui-form-item">
    <div class="layui-input-inline">
        <button class="layui-btn" lay-submit lay-filter="submit"><i class="layui-icon">&#x1005;</i> 保存权限</button>
    </div>
  </div>
<div class="layui-collapse "> 
<?php if(is_array($ctrls) || $ctrls instanceof \think\Collection || $ctrls instanceof \think\Paginator): $i = 0; $__LIST__ = $ctrls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ctrl): $mod = ($i % 2 );++$i;?>
  <div class="layui-colla-item">
    <h2 class="layui-colla-title">【<?php echo $ctrl['note']; ?>】<?php echo $ctrl['title']; ?></h2>
    <div class="layui-colla-content layui-show">
        <?php if(is_array($ctrl['data']) || $ctrl['data'] instanceof \think\Collection || $ctrl['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $ctrl['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ctrl_child): $mod = ($i % 2 );++$i;?>
            <input type="checkbox" name="<?php echo $ctrl_child['title']; ?>" value="" title="<?php echo $ctrl_child['note']; ?> (<?php echo $ctrl_child['action']; ?>)" lay-skin="primary" <?php if($ctrl_child['selected'] == 'true'): ?>checked<?php endif; ?> />          
        <?php endforeach; endif; else: echo "" ;endif; ?> 
    </div>
  </div>
<?php endforeach; endif; else: echo "" ;endif; ?>
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
    function goback(data){
        if(data.code=='1') window.history.go(-1);
    }    
    layui.use(['form', 'layedit', 'laydate','element'], function(){
        var form = layui.form
        ,layer = layui.layer
        ,layedit = layui.layedit
        ,laydate = layui.laydate
        ,element = layui.element; 
        form.on('submit(submit)', function(data) {        
            parent.$.fn.jcb.post('<?php echo $url; ?>',data.field,false,goback);
            return false;
        });
    });
</script>

</html>