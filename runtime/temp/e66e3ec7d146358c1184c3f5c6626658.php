<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\web\point\public/../module/admin\view\article\add.html";i:1526112097;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
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
    <div class="layui-form-item">
        <label class="layui-form-label">类型</label>
        <div class="layui-input-inline">
            <select lay-filter="type" name="type">
                <option value="">请选择</option>
                <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-inline">
            <input type="text" name="title" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">简介</label>
        <div class="layui-input-inline">
            <input type="text" name="front" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    
    
    <div class="layui-form-item">
        <label class="layui-form-label">图片</label>
        <div class="layui-input-block">
            <div class="layui-upload-list">
                <img class="layui-upload-img" src="__PUBLIC__/images/bakimg.png" id="img_picture">
            </div>
        </div>
    </div> 
    <div class="layui-form-item  layui-form-text">
        <label class="layui-form-label">内容</label>
        <div class="layui-input-block">
                <script id="content" name="content" type="text/plain"></script>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="submit">保存新增</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
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
    
    var content = UE.getEditor('content');
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
        if(data.code=='1') window.history.go(-1);
    }    
    form.on('submit(submit)', function(data){
        data.field.content = UE.getEditor('content').getContent();
        data.field.picture = $('#img_picture').attr('src');
        if(data.field.picture == '/resource/images/bakimg.png'){
                 data.field.picture ='';
         } 
		parent.$.fn.jcb.post("<?php echo $config['current_url']; ?>",data.field,false,goback);  
		return false;
	});
});
</script>

</html>