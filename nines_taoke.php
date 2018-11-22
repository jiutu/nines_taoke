<?php
/*
Plugin Name: Nines-taoke
Plugin URI: https://wordpress.org/plugins/nines-taoke/
Description: 淘宝客插件(通过淘宝开发平台->淘宝客Api 所获取淘客商品信息并展示在一个页面上)
Version:1.0.0
Author: 不问归期_
Author URI: https://www.aliluv.cn/
*/

define('NINES_VERSION', '1.0.0');
define('NINES_PL_URL', plugins_url('', __FILE__));
define('NINES_PATH', dirname( __FILE__ ));


require NINES_PATH . '/functions/core.php';
require NINES_PATH . '/functions/setting.php';


