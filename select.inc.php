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
$action = addslashes($_GET['action']);
$bl_name= addslashes($_GET['bl']);
$lid = intval($_GET['lid']);
	if($action == 'cate') {
		$show = '';
		if($lid) {
			$subid = DB::result_first("SELECT subid FROM ".DB::table('plugin_mini_pet_cate')." WHERE id='{$lid}'");
			if($subid) {
				$show = '<select class="ps" name="'.$bl_name.'" id="'.$bl_name.'"><option value=""></option>';
				$query = DB::query("SELECT * FROM ".DB::table('plugin_mini_pet_cate')." WHERE id IN ($subid)");
				while($row = DB::fetch($query)) {
					$show .= '<option value="'.$row['id'].'">'.$row['subject'].'</option>';
				}
				$show .= '</select>';
			} else {
				$show = '';
			}
		}
	}elseif($action=='area'){
		$show = '';
		if($lid) {
			$subid = DB::result_first("SELECT subid FROM ".DB::table('plugin_mini_pet_area')." WHERE id='{$lid}'");
			if($subid) {
				$show = '<select class="ps" name="'.$bl_name.'" id="'.$bl_name.'"><option value=""></option>';
				$query = DB::query("SELECT * FROM ".DB::table('plugin_mini_pet_area')." WHERE id IN ($subid)");
				while($row = DB::fetch($query)) {
					$show .= '<option value="'.$row['id'].'">'.$row['subject'].'</option>';
				}
				$show .= '</select>';
			} else {
				$show = '';
			}
		}
	}
include template("mini_pet:select");
?>