<?php
use think\route;
use think\Db;
use Aliyun\Core\Config;    
use Aliyun\Core\Profile\DefaultProfile;    
use Aliyun\Core\DefaultAcsClient;    
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
//应用公共文件
//路由别名 
function sendMsg($mobile,$tplParam){
    $tplCode = Db::name('config')->where('key','tplCode')->value('value');
    $accessKeyId = Db::name('config')->where('key','accessKeyId')->value('value');
    $accessKeySecret = Db::name('config')->where('key','accessKeySecret')->value('value');
    $signName = Db::name('config')->where('key','signName')->value('value');
    require_once '../extend/aliyunsms/vendor/autoload.php';    
    Config::load();             //加载区域结点配置     
   
    $templateParam = array("code"=>$tplParam);  //模板变量替换    
    //$signName = (empty(config('alisms_signname'))?'阿里大于测试专用':config('alisms_signname'));    
    //短信模板ID   
    $templateCode = $tplCode;     
    //短信API产品名（短信产品名固定，无需修改）    
    $product = "Dysmsapi";    
    //短信API产品域名（接口地址固定，无需修改）    
    $domain = "dysmsapi.aliyuncs.com";    
    //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）    
    $region = "cn-hangzhou";       
    // 初始化用户Profile实例    
    $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);    
    // 增加服务结点    
    DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);    
    // 初始化AcsClient用于发起请求    
    $acsClient= new DefaultAcsClient($profile);    
    // 初始化SendSmsRequest实例用于设置发送短信的参数    
    $request = new SendSmsRequest();    
    // 必填，设置雉短信接收号码    
    $request->setPhoneNumbers($mobile);    
    // 必填，设置签名名称    
    $request->setSignName($signName);    
    // 必填，设置模板CODE    
    $request->setTemplateCode($templateCode);    
    // 可选，设置模板参数       
    if($templateParam) {  
        $request->setTemplateParam(json_encode($templateParam));  
    }  
    //发起访问请求    
    $acsResponse = $acsClient->getAcsResponse($request);
    var_dump($acsResponse);exit;     
    //返回请求结果    
    $result = json_decode(json_encode($acsResponse),true);   
    return $result;    
}  


function get_option_byid($id){
    switch ($id){
        case 1: return '文本型'; break;  
        case 2: return '数值型'; break; 
        case 3: return '选择型'; break;  
        case 4: return '开关型'; break;  
        case 5: return '文本型1'; break;  
        case 6: return '文本型2'; break;
        default: return '';
    }
}
//判断是否在数组中
function is_in_arrary($i,$str){
    if(in_array($i,explode('|',$str))){
        return '1';
    }
    return '0';
}


/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}


//下拉列表
function get_datalist($k,$data){
    $a = array();
    foreach($data as $d){
        if($d['pid'] == $k){
            $a[] = $d;
        }
    }
    return $a;
}
//获取当前下拉列表
function get_current_datalist($id,$data){    
    $pid ='';
    foreach($data as $d){
        if($d['id'] == $id){
            $pid =$d['pid']; 
        }
    }
    return get_datalist($pid,$data);
}

