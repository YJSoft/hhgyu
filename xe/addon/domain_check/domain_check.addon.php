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
?>