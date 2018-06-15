<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"D:\web\point\public/../module/admin\view\system\index.html";i:1517537750;s:57:"D:\web\point\public/../module/admin\view\public\base.html";i:1516416741;}*/ ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo \think\Config::get('SITE_NAME'); ?>-后台管理中心</title>      
        <link rel="stylesheet" href="__PUBLIC__/plugins/layui2.2.3/css/layui.css">
	    <link rel="stylesheet" href="__PUBLIC__/plugins/font-awesome/css/font-awesome.min.css" media="all" />  
         
 <style>
    .layui-upload-img {width: 92px;height: 92px;margin: 0 10px 10px 0;}
</style>

        <style>
            .container{min-height: 600px;padding: 10px 10px 10px 10px;}
        </style>
	</head> 
    <body>
        <div class="container">
        
<form class="layui-form  layui-form-pane" action="">
<div class="layui-tab">
  <ul class="layui-tab-title"> 
    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
    <li <?php if($k == '1'): ?>class="layui-this"<?php endif; ?>><?php echo $vo['title']; ?></li>
    <?php endforeach; endif; else: echo "" ;endif; ?> 
  </ul>
  <div class="layui-tab-content"> 
        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
        <div class="layui-tab-item <?php if($k == '1'): ?>layui-show<?php endif; ?>">
            <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?>
            <div class="layui-form-item <?php if($child['ctype'] == '5'): ?>layui-form-text<?php endif; ?>" <?php if($child['ctype'] == '4'): ?>pane<?php endif; ?>>
                <label class="layui-form-label"><?php echo $child['title']; ?></label>
                <div class="layui-input-block">
                    <?php switch($child['ctype']): case "1": ?>
                            <input type="text" name="<?php echo $child['key']; ?>" tip="<?php echo $child['cmark']; ?>"  <?php if($child['allowempty'] == '0'): ?>required  lay-verify="required"<?php endif; ?> value="<?php echo $child['val']; ?>" placeholder="<?php echo $child['cmark']; ?>" autocomplete="off" class="tip layui-input">
                        <?php break; case "2": ?>
                            <input type="number" name="<?php echo $child['key']; ?>" tip="<?php echo $child['cmark']; ?>" <?php if($child['allowempty'] == '0'): ?>required  lay-verify="required"<?php endif; ?> value="<?php echo $child['val']; ?>" placeholder="<?php echo $child['cmark']; ?>" autocomplete="off" class="tip layui-input">
                         <?php break; case "3": ?>
                            <select name="<?php echo $child['key']; ?>" <?php if($child['allowempty'] == '0'): ?>lay-verify="required"<?php endif; ?>>
                                <option value="">请选择</option>
                              <?php  
                                $items = explode('|',$child['item']); 
                               if(is_array($items) || $items instanceof \think\Collection || $items instanceof \think\Paginator): $i = 0; $__LIST__ = $items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $item; ?>" <?php if($child['val'] == $item): ?>selected<?php endif; ?>><?php echo $item; ?></option>
                              <?php endforeach; endif; else: echo "" ;endif; ?> 
                            </select>  
                        <?php break; case "4": ?>
                            <input type="checkbox" name="<?php echo $child['key']; ?>" value="<?php echo $child['val']; ?>" lay-skin="switch" lay-text="ON|OFF" <?php if($child['val'] == '1'): ?>checked<?php endif; ?>>
                        <?php break; case "5": ?>
                            <textarea tip="<?php echo $child['cmark']; ?>" placeholder="<?php echo $child['cmark']; ?>" name="<?php echo $child['key']; ?>" class="layui-textarea tip"><?php echo $child['val']; ?></textarea>                            
                        <?php break; default: ?>default
                    <?php endswitch; ?> 
                </div>
                
            </div> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?> 
  </div>

  <div>
        <div class="layui-form-item">
            <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="submit"><i class="layui-icon">&#xe618;</i> 保存设置</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>

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
    var form = layui.form,layer = layui.layer,layedit = layui.layedit
    ,laydate = layui.laydate,upload = layui.upload,element = layui.element,table = layui.table;    

    function goback(data){
        if(data.code=='1') parent.close_current_tb();
    } 
    $('.tip').mouseenter(function(e){
        var tip= $(this).attr('tip');
        if(tip != '') layer.tips(tip, $(this),{tips: [1, '#0FA6D8']});
    });
    form.on('submit(submit)', function(data){ 
		parent.$.fn.jcb.post("<?php echo url('@admin/system/save'); ?>",data.field,false,goback);  
		return false;
	}); 
});
</script>

</html>