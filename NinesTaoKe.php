<?php

/*
Plugin Name: 淘宝客
Plugin URI: https://wordpress.org/plugins/nines-taoke/
Description: 淘宝客插件(通过淘宝开发平台->淘宝客Api 所获取淘客商品信息并展示在一个页面上)
Version:2.7.2
Author: 不问归期_
Author URI: https://www.aliluv.cn/
*/



if (!defined('WPINC')) {
	die;
}
//版本号
$version = '2.7.2';

define('NINES_TAOKE_VERSION', $version);
define('NINES_TAOKE_PL_URL', plugins_url('', __FILE__));
define('NINES_TAOKE_PATH', dirname(__FILE__));
define("NINES_TAOKE_TOP_SDK_WORK_DIR", NINES_TAOKE_PATH . '/tmp/');

//自动加载类库
require(NINES_TAOKE_PATH . '/Autoloader.php');
//加载函数库
require(NINES_TAOKE_PATH . '/includes/NinesTaoKeFunctions.php');
/**
 * 开始执行插件。
 * 因为插件中的所有内容都是通过钩子注册的，
 * 然后从文件中的这一点开始启动插件
 * 不影响页面生命周期。
 * @author 不问归期__
 * @time      2020-08-14
 * @return    [type]      [description]
 */
function nines_taoke_run($version)
{
	$plugin = new NinesTaoKePluginRun($version, 'nines_taoke');
	$plugin->run();
}
nines_taoke_run($version);

/**
 * 插件激活期间运行的代码。
 * @author: BuWenGuiQi_
 * @param {type} 
 * @return {type} 
 */
function nines_taoke_activate()
{
	NinesTaoKeActivator::activate();
}
register_activation_hook(__FILE__, 'nines_taoke_activate');


/**插件停用期间运行的代码。
 * @author: BuWenGuiQi_
 * @param {type} 
 * @return {type} 
 */
function nines_taoke_deactivate()
{
	NinesTaoKeDeactivator::deactivate();
}
register_deactivation_hook(__FILE__, 'nines_taoke_deactivate');
