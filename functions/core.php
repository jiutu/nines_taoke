<?php 

// add_shortcode('nines', 'tk_shortcode');
	// function tk_shortcode( $att, $content = null ) {
//     return taoke_data_output();
// }

add_action('template_redirect', 'nines_taoke_template', 1 );
function nines_taoke_template(){
	$page_id = get_option('nines_taoke_pagename');

	if( !$page_id ){
		return ;
	}

	if( !is_page($page_id) ){
		return ;
	}

	include( NINES_PATH . '/functions/template.php' );
	exit();
}
function nines_taoke_template_output(){
	include(NINES_PATH.'/functions/taobao.php');
	nines_taoke_data_output();
}
add_action('admin_menu', 'nines_taoke_setting_menu');
function nines_taoke_setting_menu() {
	add_menu_page('nines_tk', '淘宝客配置', 'manage_options', 'nines_taoke_settings', 'nines_taoke_settings_page', '');
	add_action( 'admin_init', 'nines_taoke_register_mysettings' );
}

function nines_taoke_register_mysettings() {
	register_setting( 'nines-taoke-settings-group', 'nines_taoke_key' );
	register_setting( 'nines-taoke-settings-group', 'nines_taoke_secret' );
	register_setting( 'nines-taoke-settings-group', 'nines_taoke_pid' );
	register_setting( 'nines-taoke-settings-group', 'nines_taoke_pagename' );
}



add_action('wp_enqueue_scripts', 'nines_taoke_scripts', 20);
function nines_taoke_scripts(){
	wp_register_style( 'nines_tk_css', NINES_PL_URL . '/build/css/nines_tk.css', array(), NINES_VERSION );
}


function nines_taoke_page_output()
{
	$page = nines_taoke_get_paging(nines_taoke_page(),nines_taoke_get(1));
	echo '<a type="button" href="'.$page[0].'" class="btn btn-secondary">上一页</a>
	<a type="button" href="'.$page[1].'" class="btn btn-secondary">下一页</a>';

}

function nines_taoke_keyword_list()
{
	$key_word = ['女装','男装','鞋品','配饰','箱包','美妆','内衣','数码','母婴'];
	return $key_word;
}

function nines_taoke_keyword_output()
{
	$key_word = nines_taoke_keyword_list();
	$key_html = '<li class="flex-shrink-0"><a href="?q=all" class="btn btn-link btn-sm">最新优惠</a></li>';
	for ($i=0; $i < count($key_word) ; $i++) { 
		if (nines_taoke_get() == $key_word[$i]) {
			$key_html .= '<li class="flex-shrink-0">
			<a href="?q='.$i.'" class="btn btn-link btn-sm active">'.$key_word[$i].'</a>
			</li>';
		}else{
			$key_html .= '<li class="flex-shrink-0">
			<a href="?q='.$i.'" class="btn btn-link btn-sm">'.$key_word[$i].'</a>
			</li>';
		}
	}
	echo $key_html;
}

function nines_taoke_data_output(){
	wp_enqueue_style( 'nines_tk_css');
	$data = nines_taoke_shop_get(nines_taoke_get(),nines_taoke_page());
	$data = json_decode($data);
	$states = $data->states;
	if (!$states) {
		echo $data->msg;
		return;
	}
	$thml = '';
	for ($i=0; $i < count($data->data); $i++) { 
		if($i%4==0){
			$thml .= '<div class="item-card item-topic d-flex col-12 col-sm-6 col-md-3 col-lg-3">
			<article class="card flex-fill mb-4 mb-sm-4-2 mb-md-4 mb-lg-4-2">
			<a href="'.$data->data[$i]->coupon_click_url.'" target="_blank" class="custom-hover d-flex flex-fill">
			<div class="custom-hover-img image" style="background-image: url('.$data->data[$i]->pict_url.');background-repeat: no-repeat;background-size: 100% 100%;"></div>
			<div class="position-relative d-flex flex-fill flex-column content-topic p-4 p-md-3">
			<div class="content-body d-flex flex-grow-1 flex-column  mb-5 mb-lg-0 pb-5 pb-md-0">
			<div class="data font-12 text-light mb-1 mb-md-1"><span>'.$data->data[$i]->coupon_info.'</span></div>
			<div class="title"><h2 class="font-24 font-md-22 font-xs-20 weight-600 color-white">$.'.$data->data[$i]->final_price.'</h2>
			</div></div><div class="content-footer"><p class="font-16 font-xs-14 weight-600 light-14 color-white">'.$data->data[$i]->title.'</p></div></div></a></article></div>';
		}else{
			$thml .= '<div class="item-card d-flex col-12 col-sm-6 col-md-3 col-lg-3">
			<article class="card flex-fill mb-4 mb-sm-4-2 mb-md-4 mb-lg-4-2">
			<div class="image"><a target="_blank" href="'.$data->data[$i]->coupon_click_url.'" >
			<div class="custom-hover d-block"><img src="'.$data->data[$i]->pict_url.'" style="background-repeat: no-repeat;background-size: 100% 100%;" class="custom-hover-img timthumb_php lazyloaded" >
			</div></a></div><div class="card-body d-flex flex-column content mt-1 mt-md-2">
			<div class="meta mt-2 light-12 " ><span><a class="text-primary" style="color:#f5079b;">$.'.$data->data[$i]->final_price.'</a></span>
			</div><div class="title flex-grow-1 mt-2"><h2 class="font-16 font-md-14 font-xs-16 text-l2 font-weight-normal light-14"><a target="_blank" href="'.$data->data[$i]->coupon_click_url.'" style="color:#262626;">'.$data->data[$i]->title.'</a>
			</h2></div><div class="data nodots d-flex align-items-center flex-row font-12 font-md-10 text-muted mt-2 mt-lg-3 light-12 d-flex d-lg-flex"><div class="flex-fill d-flex "><span class="u-time">优惠券剩余量:'.$data->data[$i]->coupon_remain_count.'</span></div><div class="text-nowrap"><span class="u-like d-inline-block d-lg-none d-lg-inline-block"><i class="fal fa-heart"></i>'.$data->data[$i]->coupon_info.'</span></div></div></div></article></div>';
		}

	}
	echo $thml;
}

function nines_taoke_get($page = false)
{	
	if (!isset($_GET['q'])) {
		return '';
	}
	$q = $_GET['q'];
	if ($q == 'all') {
		return '';
	}
	$key_word = nines_taoke_keyword_list();
	if(array_key_exists($_GET['q'],$key_word)){
		return ($page) ? $q : $key_word[$q] ;
	}
	return '';
}


function nines_taoke_page()
{
	return(isset($_GET['page'])) ? $_GET['page'] : '1' ;
}


?>