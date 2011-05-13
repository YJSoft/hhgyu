<?php
       /**
       * @file location_helper.addon.php
       * @author hhgyu (hhgyu15@gmail.com)
       * @brief Loction Helper
       **/
      if(!defined('__ZBXE__')) exit();
      // before_display_content 일때에 ie6nomore 동작
     if(($called_position == 'before_display_content'&&$addon_info->www_uri!="no")||(Context::get('module')!='admin'&&Context::get('module')!='module'&&Context::get('module')!='addon')){
        $setting_c=$addon_info->other_uri;
        $setting_www=$addon_info->www_uri;
        if($setting_c!="") $http_host=substr($_SERVER[HTTP_HOST],0,strlen($setting_c))==$setting_c ? "":$setting_c.".".$_SERVER[HTTP_HOST];
        elseif($setting_www=="www") $http_host=substr($_SERVER[HTTP_HOST],0,4)=="www." ? "":"www.".$_SERVER[HTTP_HOST];
        elseif($setting_www=="no_www") $http_host_no=substr($_SERVER[HTTP_HOST],0,3)=="www." ? str_replace("www.","",$_SERVER[HTTP_HOST]):"";
        if($http_host!=''){
          if(Context::get('_use_ssl') == "always"){
            $port=Context::get("_https_port")!="" ? ":".Context::get("_https_port"):"";
            $current_url="https://". $http_host.$port.$_SERVER['PHP_SELF'];
          }
          else{
            $port=Context::get("_http_port")!="" ? ":".Context::get("_http_port"):"";
            $current_url="http://". $http_host.$port.$_SERVER['PHP_SELF'];
          }
          header("Location: $current_url");
        }
        elseif($http_host_no!=""){
          if(Context::get('_use_ssl') == "always"){
            $port=Context::get("_https_port")!="" ? ":".Context::get("_https_port"):"";
            $current_url="https://". $http_host_no.$port.$_SERVER['PHP_SELF'];
          }
          else{
            $port=Context::get("_http_port")!="" ? ":".Context::get("_http_port"):"";
            $current_url="http://". $http_host_no.$port.$_SERVER['PHP_SELF'];
          }
          
          header("Location: $current_url");
        }
      }
?>