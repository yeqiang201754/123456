<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\web\point\public/../module/admin\view\config\edit.html";i:1527930552;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
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
    input{width:500px !important;}
</style>

        <style>
            .container{min-height: 600px;padding: 10px 10px 10px 10px;}
        </style>
	</head> 
    <body>
        <div class="container">
        
<form class="layui-form layui-form-pane" action="">
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;if($data['key'] == 'erweima'): ?>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:200px;">二维码图片</label>
        <div class="layui-input-block">
        <div class="layui-upload-list">
            <img class="layui-upload-img" src="<?php echo (isset($data['value']) && ($data['value'] !== '')?$data['value']:'/resource/images/bakimg.png'); ?>" id="img_picture">
        </div>
        </div>
    </div> 
    <?php else: ?>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:200px;"><?php echo $data['name']; ?></label>
        <div class="layui-input-inline">
            <input type="text" name="<?php echo $data['key']; ?>" lay-verify="required" value="<?php echo $data['value']; ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
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
    upload.render({
        elem: '#img_picture'
        ,url: '<?php echo url("@admin/login/upload"); ?>'
        ,done: function(res){
            if(res.code == 1){
                $("#img_picture").attr('src',res.data.src);
            }else{
                parent.$.fn.jcb.alert(res.msg,'error');
            }
        }
    });
    function goback(data){
        if(data.code=='1') window.history.go();
    }    
    form.on('submit(submit)', function(data){  
        data.field.erweima = $('#img_picture').attr('src');
        if(data.field.erweima == '/resource/images/bakimg.png'){
                 data.field.erweima ='';
         }    
		parent.$.fn.jcb.post("<?php echo $config['current_url']; ?>",data.field,false,goback);  
		return false;
	});
});
</script>

</html>