<?php
/*
 * CopyRight  : [DisM!] (C)2001-2099 DisM Inc.
 * Created on : 2020-02-11,11:00:52
 * Author     : DisM!Ӧ������ dism.taobao.com $
 * Description: ����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!.
 * ����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 * ����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$catecachefile = DISCUZ_ROOT.'data/sysdata/cache_mini_pet_catecachedata.php';
$areacachefile = DISCUZ_ROOT.'data/sysdata/cache_mini_pet_areacachedata.php';
if(file_exists($catecachefile)){
		require_once DISCUZ_ROOT.'data/sysdata/cache_mini_pet_catecachedata.php';
}else{
	mini_pet_updatacatecache();
}
if(file_exists($areacachefile)){
		require_once DISCUZ_ROOT.'data/sysdata/cache_mini_pet_areacachedata.php';
}else{
	mini_pet_updataareacache();
}
function  mini_pet_updatacatecache(){
	require_once libfile('function/cache');
    $typecatequery = DB::query("SELECT * FROM " . DB::table('plugin_mini_pet_cate') . " WHERE  upid='0' ORDER BY displayorder ASC,id ASC");
    $typecatedata = array();
    $upidcatedata = array();
    while ($typecate = DB::fetch($typecatequery)) {
        $typecatedata[$typecate['id']] = $typecate;
        $upidcatequery = DB::query("SELECT * FROM " . DB::table('plugin_mini_pet_cate') . " where upid = " . $typecate['id'] . "  ORDER BY displayorder ASC,id ASC");
        while ($upidcate = DB::fetch($upidcatequery)) {
            $upidcatedata[$typecate['id']][$upidcate['id']] = $upidcate;
        }
    }
	writetocache('mini_pet_catecachedata', getcachevars(array('typecatedata' => $typecatedata,  'upidcatedata' => $upidcatedata)));
}
function  mini_pet_updataareacache(){
	require_once libfile('function/cache');
    $typeareaquery = DB::query("SELECT * FROM " . DB::table('plugin_mini_pet_area') . " WHERE  upid='0' ORDER BY displayorder ASC,id ASC");
    $typeareadata = array();
    $upidareadata = array();
    while ($typearea = DB::fetch($typeareaquery)) {
        $typeareadata[$typearea['id']] = $typearea;
        $upidareaquery = DB::query("SELECT * FROM " . DB::table('plugin_mini_pet_area') . " where upid = " . $typearea['id'] . "  ORDER BY displayorder ASC,id ASC");
        while ($upidarea = DB::fetch($upidareaquery)) {
            $upidareadata[$typearea['id']][$upidarea['id']] = $upidarea;
        }
    }
	writetocache('mini_pet_areacachedata', getcachevars(array('typeareadata' => $typeareadata,  'upidareadata' => $upidareadata)));
}
//From: Dism_taobao-com
?>