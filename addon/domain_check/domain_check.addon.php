<?php
    if(!defined("__ZBXE__")) exit();

    /**
     * @file domain_check.addon.php
     * @brief 도메인 체크 애드온
     *
     * 원하는 도메인으로 통일할 수 있도록 합니다.
     **/

    // called_position이 before_module_init일때만 실행, 관리자모드에서 작동 안하기
    if($called_position != 'before_module_init' || Context::get('module')=='admin') return;
    /*
    * referer 분리해서 이게 프레임에 들어있으면 빠져 나오기
    * 이렇게 만든 이유는?
    * 애드온중에 bgm 같은 것을 살리기위해
    */
    $referer=getenv("HTTP_REFERER");
    if(substr($referer,0,5)=="https"){
        $referer=str_replace("https://","",$referer);
        $referer=explode('/',$referer);
    }else{
        
        $referer=str_replace("http://","",$referer);
        $referer=explode('/',$referer);
    }
    
    if($referer[0]!=$addon_info->my_domain){
        Context::addHtmlHeader(
"
<script type=\"text/javascript\">
if(parent.frames.length > 0) { 
    top.location.href='http://".$addon_info->my_domain."';
}
</script>
"
        );
    }else{
        if(!isset($addon_info->except_domain)){
            if ($_SERVER[HTTP_HOST]!=$addon_info->my_domain) header("location:http://".$addon_info->my_domain.$_SERVER['REQUEST_URI']);
        }else{
            $except_domain = explode(",",$addon_info->except_domain);
            foreach($except_domain as $value) {
                if(stristr(trim($value),$_SERVER[HTTP_HOST])) return;
                /* 원하는 도메인으로만 접속하게 처리하고자 할 때  */ 
                if($_SERVER[HTTP_HOST]!=$addon_info->my_domain){
                    header("location:http://".$addon_info->my_domain.$_SERVER['REQUEST_URI']);
                }
            }
        }
    }
?>