<?php
/*
 * CopyRight  : [DisM!] (C)2001-2099 DisM Inc.
 * Created on : 2020-02-11,11:00:52
 * Author     : DisM!Ӧ������ dism.taobao.com $
 * Description: ����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!.
 * ����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 * ����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$sql = <<<EOT

EOT;
@unlink(DISCUZ_ROOT.'source/plugin/mini_pet/discuz_plugin_mini_pet_SC_GBK.xml');
@unlink(DISCUZ_ROOT.'source/plugin/mini_pet/discuz_plugin_mini_pet_SC_UTF8.xml');
@unlink(DISCUZ_ROOT.'source/plugin/mini_pet/discuz_plugin_mini_pet_TC_BIG5.xml');
@unlink(DISCUZ_ROOT.'source/plugin/mini_pet/discuz_plugin_mini_pet_TC_UTF8.xml');
@unlink(DISCUZ_ROOT.'source/plugin/mini_pet/install.php');
@unlink(DISCUZ_ROOT.'source/plugin/mini_pet/upgrade.php');
runquery($sql);
$finish = TRUE;
?>