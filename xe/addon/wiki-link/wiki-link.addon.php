<?php
/**
 * @file wiki-link.addon.php
 * @author 홍학규 (webmaster@us7.kr)
 * @brief  위키 태그에 링크를 걸어줍니다.
 **/
if(!defined('__ZBXE__')) exit();
if($called_position != 'before_display_content') return; // before_display_content type 만 처리
if(Context::getResponseMethod() != 'HTML') return; // HTML 만 처리
if(!(Context::get('act')=="dispBoardWrite"||Context::get('act')=="dispBoardModifyComment"||Context::get('act')=="dispAddonAdminSetup")){
    if($_COOKIE['lang_type']=="ko")    $url_wiki_lang="ko";
    elseif($_COOKIE['lang_type']=="ja")    $url_wiki_lang="ja";
    elseif($_COOKIE['lang_type']=="es")    $url_wiki_lang="es";
    elseif($_COOKIE['lang_type']=="en")    $url_wiki_lang="en";
    else    $url_wiki_lang="ko";
    $patten='([0-9a-zA-Z가-힣\040]+)';
    $url_wiki_http=array("http://".$url_wiki_lang.".wikipedia.org/wiki/",
                         "http://www.angelhalowiki.com/r1/wiki.php/"
                         );
    if(!$addon_info->wiki_link)   $addon_info->wiki_link="3";
    /*$pattens=array("wp","enha");
    for($index = 0 ; $index < count($pattens) ; $index++){
            $output=preg_replace("/\[\[".$pattens[$index].":".$patten."\]\]/i" , 
              	"<a href=\"$url_wiki_http[$index]$1\" target=\"_blank\" title=\"$title\">$1</a>", 
                $output);
    }*/
    $patten_url='([0-9a-zA-Z가-힣:\/\040\*\.]+)';
            $output=preg_replace("/\[\[\(url\|".$patten_url."\):".$patten."\]\]/i" , 
              	"<a href=\"$1$2\" target=\"_blank\" title=\"$title\">$2</a>", 
                $output);
    if($addon_info->wiki_link!="3"){
        if($$addon_info->wiki_link=="1"){
            $output=preg_replace("/\[\[".$patten."\]\]/i" , 
        					"<a href=\"$url_wiki_http[0]$1\" target=\"_blank\" title=\"$title\">$1</a>", 
        					$output);
            $output=preg_replace("/\{\{".$patten."\}\}/i" , 
        					"<a href=\"$url_wiki_http[0]$1\" target=\"_blank\" title=\"$title\">$1</a>", 
        					$output);
        }else if($$addon_info->wiki_link=="2"){
            $output=preg_replace("/\[\[".$patten."\]\]/i" ,
        					"<a href=\"$url_wiki_http[1]$1\" target=\"_blank\" title=\"$title\">$1</a>", 
        					$output);
            $output=preg_replace("/\{\{".$patten."\}\}/i" , 
        					"<a href=\"$url_wiki_http[1]$1\" target=\"_blank\" title=\"$title\">$1</a>", 
        					$output);
        }
    }else{
        $output=preg_replace("/\[\[".$patten."\]\]/i" , 
        					"<a href=\"$url_wiki_http[0]$1\" target=\"_blank\" title=\"$title\">$1</a>", 
        					$output);
        $output=preg_replace("/\{\{".$patten."\}\}/i" , 
        					"<a href=\"$url_wiki_http[1]$1\" target=\"_blank\" title=\"$title\">$1</a>", 
        					$output);
    
    }
}
?>