<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"D:\web\point\public/../module/admin\view\interest\edit.html";i:1526094815;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo \think\Config::get('SITE_NAME'); ?>-后台管理中心</title>      
        <link rel="stylesheet" href="__PUBLIC__/plugins/layui2.2.3/css/layui.css">
	    <link rel="stylesheet" href="__PUBLIC__/plugins/font-awesome/css/font-awesome.min.css" media="all" />  
         
 <style>
    .layui-upload-img {width: 150px;margin: 0 10px 10px 0;}
</style>

        <style>
            .container{min-height: 600px;padding: 10px 10px 10px 10px;}
        </style>
	</head> 
    <body>
        <div class="container">
        
<form class="layui-form layui-form-pane" action="">
    <!-- <div class="layui-form-item">
        <label class="layui-form-label">会员等级</label>
        
        <div class="layui-input-inline">
            <select name="level" lay-verify="required">
                <option value="">请选择</option>
                <option value="zy" <?php if($list['level'] == 'zy'): ?> selected <?php endif; ?>>专员</option>
                <option value="jl" <?php if($list['level'] == 'jl'): ?> selected <?php endif; ?>>经理</option>
                <option value="hz" <?php if($list['level'] == 'hz'): ?> selected <?php endif; ?>>专员</option>
                <option value="yhj" <?php if($list['level'] == 'yhj'): ?> selected <?php endif; ?>>银行家</option>
            </select>
        </div>
    </div> -->
    
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:120px;">推荐奖比例</label>
        <div class="layui-input-inline">
            <input type="text" name="tjj" lay-verify="required" value="<?php echo $list['tjj']; ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:120px;">升级返佣比例</label>
        <div class="layui-input-inline">
            <input type="text" name="sjfy" lay-verify="required" value="<?php echo $list['sjfy']; ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:120px;">团队分红</label>
        <div class="layui-input-inline">
            <input type="text" name="team" lay-verify="required" value="<?php echo $list['team']; ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:120px;">升级所需费用</label>
        <div class="layui-input-inline">
            <input type="text" name="up" lay-verify="required" value="<?php echo $list['up']; ?>" autocomplete="off" class="layui-input">
        </div>
    </div> 
    <div class="layui-form-item  layui-form-text">
        <label class="layui-form-label">简介</label>
        <div class="layui-input-block">
             <script id="bewriter" name="bewriter" type="text/plain"><?php echo $list['bewriter']; ?></script>
        </div>
    </div>
    <div class="layui-form-item  layui-form-text">
        <label class="layui-form-label">权益</label>
        <div class="layui-input-block">
             <script id="content" name="content" type="text/plain"><?php echo $list['content']; ?></script>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="submit">提交修改</button>
            <button type="reset" class="layui-btn layui-btn-primary">重  置</button>
        </div>
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
layui.use(['form','upload', 'layedit','table', 'laydate','element'], function(){
    var form = layui.form,layer = layui.layer,layedit = layui.layedit,laydate = layui.laydate,upload = layui.upload,element = layui.element,table = layui.table;
    var bewriter = UE.getEditor('bewriter');
    var content = UE.getEditor('content');
    function goback(data){
        if(data.code=='1') window.history.go(-1);
    }    
    form.on('submit(submit)', function(data){
        data.field.bewriter = UE.getEditor('bewriter').getContent();
        data.field.content = UE.getEditor('content').getContent();       
		parent.$.fn.jcb.post("<?php echo $config['current_url']; ?>",data.field,false,goback);  
		return false;
	});
});
</script>

</html>