<?php
/*
 * @Description: 函数列表
 * @Autor: BuWenGuiQi_
 * @Date: 2020-08-16 10:11:32
 * @LastEditTime: 2020-10-02 16:33:26
 */


/**
 * @copyright 默认菜单
 * @author 不问归期__
 * @time      2020-08-16
 * @return    [type]      [description]
 */
function nines_taoke_default_menus()
{
	$menu = array([
		'title' => '女装',
		'path' => 'https://jiutu.oss-cn-qingdao.aliyuncs.com/taoketubiao/nvzhuang.png',
		'id' => 1590449745031
	], [
		'title' => '男装',
		'path' => 'https://jiutu.oss-cn-qingdao.aliyuncs.com/taoketubiao/nanzhuang.png',
		'id' => 1590449745331
	], [
		'title' => '内衣',
		'path' => 'https://jiutu.oss-cn-qingdao.aliyuncs.com/taoketubiao/neiyi.png',
		'id' => 1590449745431
	], [
		'title' => '母婴',
		'path' => 'https://jiutu.oss-cn-qingdao.aliyuncs.com/taoketubiao/muying.png',
		'id' => 1590449545031
	], [
		'title' => '家居家装',
		'path' => 'https://jiutu.oss-cn-qingdao.aliyuncs.com/taoketubiao/jiajujiazhuang.png',
		'id' => 1590439545031
	], [
		'title' => '鞋包配饰',
		'path' => 'https://jiutu.oss-cn-qingdao.aliyuncs.com/taoketubiao/xiebaopeishi.png',
		'id' => 1590435545031
	], [
		'title' => '美妆个护',
		'path' => 'https://jiutu.oss-cn-qingdao.aliyuncs.com/taoketubiao/meizhuanggehu.png',
		'id' => 1593439545031
	], [
		'title' => '数码家电',
		'path' => 'https://jiutu.oss-cn-qingdao.aliyuncs.com/taoketubiao/shumajiadian.png',
		'id' => 1590439545231
	]);
	return json_encode($menu);
}

/**
 * @copyright 获取当前域名地址
 * @author 不问归期__
 * @time      2020-08-16
 * @param     array       $param [description]
 * @return    [type]             [description]
 */
function nines_taoke_current_url($param = [])
{
	global $wp;
	$url = get_option('permalink_structure') == '' ? add_query_arg($wp->query_string, '', home_url($wp->request)) : home_url(add_query_arg([], $wp->request));
	$paramurl = http_build_query($param, '', '&');
	return (!$param) ? $url : $url . '?' . $paramurl;
}

/**
 * @copyright 判断是否移动端
 * @author 不问归期__
 * @time      2020-08-16
 * @return    [type]      [description]
 */
function nines_taoke_get_isMobile()
{
	if (isset($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'], "wap")) {
		return true;
	} elseif (isset($_SERVER['HTTP_ACCEPT']) && strpos(strtoupper($_SERVER['HTTP_ACCEPT']), "VND.WAP.WML")) {
		return true;
	} elseif (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
		return true;
	} elseif (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])) {
		return true;
	} else {
		return false;
	}
}
