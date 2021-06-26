<?php

/**
 * 插件面向公众的功能。
 */
class NinesTaoKePublic
{
	private $plugin_name;
	private $version;
	/**
	 * @copyright 初始化类并设置其属性。
	 * @author 不问归期__
	 * @time      2020-08-14
	 * @param     [type]      $plugin_name [description]
	 * @param     [type]      $version     [description]
	 */
	public function __construct($plugin_name, $version)
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}
	/**
	 * @copyright 为站点面向公众的一面注册样式表。
	 * @author 不问归期__
	 * @time      2020-08-14
	 * @return    [type]      [description]
	 */
	public function enqueue_styles()
	{
		$page_id = get_option('nines_taoke_pagename');
		if ($page_id && is_page($page_id)) {
			$act = $this->nines_taoke_request_parameter('act');
			switch ($act) {
				case 'search':
					wp_enqueue_style(
						'nines_taoke_taoke',
						NINES_TAOKE_PL_URL . '/static/taoke.css'
					);
					wp_enqueue_style(
						'nines_taoke_bootstrap',
						NINES_TAOKE_PL_URL . '/static/bootstrap.min.css'
					);
					break;
				default:
					wp_enqueue_style(
						'nines_taoke_optimusmaterial',
						NINES_TAOKE_PL_URL . '/static/optimusmaterial.css'
					);
					break;
			}
		}
		// if ( is_single() ) {
		// 	wp_enqueue_style(
		// 		'nines_taoke_optimusmaterial',
		// 		NINES_TAOKE_PL_URL.'/static/optimusmaterial.css',
		// 		false, 
		// 		$this->version,
		// 		false
		// 	);
		// }
	}
	/**
	 * @copyright 为站点面向公众的一面注册JavaScript。
	 * @author 不问归期__
	 * @time      2020-08-14
	 * @return    [type]      [description]
	 */
	public function enqueue_scripts()
	{
		// wp_enqueue_script( 
		// 	$this->plugin_name, 
		// 	plugin_dir_url( __FILE__ ) . 'js/plugin-name-public.js', 
		// 	array( 'jquery' ), 
		// 	$this->version,
		// 	false ,
		// );
	}


	public function nines_taoke_template()
	{
		//判断是否是页面、是否已配置页面
		$page_id = get_option('nines_taoke_pagename');
		if (!$page_id || !is_page($page_id)) {
			return;
		}
		$act = $this->nines_taoke_request_parameter('act');
		switch ($act) {
			case 'search':
				$this->nines_taoke_search_template();
				break;
			default:
				$this->nines_taoke_public_template();
				break;
		}
		exit();
	}
	/**
	 * @copyright 前端商品模版输出
	 * @author 不问归期__
	 * @time      2020-08-16
	 * @param     string      $value [description]
	 * @return    [type]             [description]
	 */
	public function nines_taoke_public_template($value = '')
	{
		get_header(); ?>
		<div class="tk_scroll-wrapper">
			<div class="tk_scroll-container">
				<div class="tk_head-container">
					<?php echo $this->nines_taoke_template_menus() ?>
				</div>
			</div>
			<?php $this->nines_taoke_goods_output(); ?>
			<a id="tk_nice-back-to-top" href="<?php echo nines_taoke_current_url(['act' => 'search']); ?>">
				<span class="tk_icon-stack">
					<span class="tk_back-to-top-text">搜索</span>
				</span>
			</a>
			<div class="tk_whole-pagination-wrapper">
				<div class="tk_pagination-wrapper">
					<?php $this->nines_taoke_page_output(); ?>
				</div>
			</div>
		</div>
	<?php get_footer();
	}

	public function nines_taoke_goods_output()
	{
		$c = new TopClient;
		$c->appkey = get_option('nines_taoke_key');
		$c->secretKey = get_option('nines_taoke_secret');
		$req = new TbkDgMaterialOptionalRequest;
		$req->setPageSize(8);
		$req->setPageNo($this->nines_taoke_request_parameter('paging'));
		$req->setAdzoneId($this->nines_get_pid(get_option('nines_taoke_pid')));
		$req->setQ($this->nines_taoke_get_q());
		$req->setHasCoupon("true");
		$resp = $c->execute($req);
		if (!empty($resp->msg)) {
			echo '<script language="javascript">
			alert("' . $resp->msg . '");history.go(-1);
			</script>';
			return;
		}
		$this->nines_template_view($resp->result_list->map_data);
	}

	/**
	 * @Description: 分页输出
	 * @Date: 2020-03-28 19:37:19
	 * @param {type}
	 */
	public function nines_taoke_page_output()
	{
		$p = (!isset($_GET['paging'])) ? 0 : intval($_GET['paging']);
		$p = ($p < 0 || $p == 0) ? 1 : $p;
		$prev = ($p > 1) ? $p - 1 : $p;
		$next = $p + 1;
		if (isset($_GET['q'])) {
			$next = '?q=' . trim($_GET['q']) . '&paging=' . $next;
			$prev = '?q=' . trim($_GET['q']) . '&paging=' . $prev;
		} else {
			$next = '?paging=' . $next;
			$prev = '?paging=' . $prev;
		}
	?>
		<div style="width: 60px;float: left;margin-left: 20px">
			<a href="<?php echo nines_taoke_current_url() . $prev; ?>">
				<button class="tk_ant-btn tk_ant-btn-primary">上页</button>
			</a>
		</div>
		<div style="width: 60px;float: left;margin-left: 20px">
			<a href="<?php echo nines_taoke_current_url() . $next; ?>">
				<button class="tk_ant-btn tk_ant-btn-primary">下页</button>
			</a>
		</div>
		<?php }



	public function nines_template_view($data)
	{
		foreach ($data as $key => $value) {
			$resUrl = (nines_taoke_get_isMobile()) ? 'taobao:' : 'https:';
			$value->coupon_share_url = $resUrl . $value->coupon_share_url;
			$value->description = $value->item_description ? $value->item_description : $value->shop_title; ?>
			<a class="tk_goods-container tk_clearfix" href="<?php echo $value->coupon_share_url; ?>" target="_blank">
				<div class="tk_img-container">
					<div class="tk_normal-img-container" style="background: rgb(255, 255, 255); height: 142px;">
						<img src="<?php echo $value->pict_url; ?>" class="img">
					</div>
				</div>
				<div class="tk_info-container">
					<div class="tk_desc-container">
						<span class="tk_desc tk_word-ellipsis-2"><?php echo $value->title; ?></span>
						<span class="tk_brief tk_line-ellipsis-1"><?php echo $value->description; ?></span>
					</div>
					<div class="tk_tag-list">
						<div class="tk_tag">
							<span>券:<?php echo $value->coupon_amount; ?>元</span>
						</div>
					</div>
					<span class="tk_price">
						<span class="tk_symbol">¥ </span>
						<span class="tk_number">
							<?php echo ($value->zk_final_price - $value->coupon_amount); ?>
						</span>
					</span>
					<span class="tk_like">
						<span style="text-decoration:line-through;">
							原价:<?php echo $value->zk_final_price; ?>
						</span>
						<span>/ 已售<?php echo $value->volume; ?>件</span>
					</span>
				</div>
			</a>
		<?php }
	}
	/**
	 * @copyright 分割pid
	 * @author 不问归期__
	 * @time      2020-08-09
	 * @param     boolean     $pid [description]
	 * @return    [type]           [description]
	 */
	public function nines_get_pid($pid = false)
	{
		$res = explode('_', $pid);
		if (count($res) < 4) {
			return false;
		}
		return $res[3];
	}
	/**
	 * @copyright 获取q参数
	 * @author 不问归期__
	 * @time      2020-08-09
	 * @return    [type]      [description]
	 */
	function nines_taoke_get_q()
	{
		if ($this->nines_taoke_request_parameter('q') == '') {
			$keyword = get_option('nines_taoke_keyword') ? get_option('nines_taoke_keyword') : '少女装';
		} else {
			$keyword = $this->nines_taoke_request_parameter('q');
		}
		return $keyword;
	}

	/**
	 * @copyright 前端菜单输出
	 * @author 不问归期__
	 * @time      2020-08-16
	 * @return    [type]      [description]
	 */
	public function nines_taoke_template_menus()
	{
		if (get_option('nines_taoke_menus') != '[]' && get_option('nines_taoke_menus') != '') {
			$menus = json_decode(get_option('nines_taoke_menus'));
		} else {
			$menus = json_decode(nines_taoke_default_menus());
		} ?>
		<div class="tk_second-categories">
			<?php
			foreach ($menus as $key => $value) { ?>
				<a class="tk_item" href="<?php echo nines_taoke_current_url(['q' => $menus[$key]->title]); ?>">
					<div class="tk_img-container tk_mobile_type">
						<img src="<?php echo $menus[$key]->path; ?>" class="img">
					</div>
					<p class="tk_desc"><?php echo $menus[$key]->title; ?></p>
				</a>
			<?php }; ?>
		</div>
	<?php }



	public function nines_taoke_get_taoke_data($value = '')
	{
		# code...
	}

	/**
	 * @Description: 获取参数值
	 * @Date: 2020-02-22 21:25:01
	 * @param {type}
	 */
	public function nines_taoke_request_parameter($key, $default = '')
	{
		if (!isset($_REQUEST[$key]) || empty($_REQUEST[$key])) {
			return $default;
		}
		return (is_array($_REQUEST[$key])) ? $_REQUEST[$key] : strip_tags((string) wp_unslash($_REQUEST[$key]));
	}

	/**
	 * @copyright 前端商品模版输出
	 * @author 不问归期__
	 * @time      2020-08-16
	 * @param     string      $value [description]
	 * @return    [type]             [description]
	 */
	public function nines_taoke_search_template($value = '')
	{
		get_header(); ?>
		<div class="col-10 col-lg-8" style="margin-left: 25px;margin-top: 25px;">
			<div class="tk_widget-title mb-4">
				<span class="tk_nice-b-line">搜索</span>
			</div>
			<form onsubmit="return false;">
				<div class="tk_search-input tk_form-group mb-4">
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="keyword" placeholder="请输入关键词" required="">
						<div class="input-group-append">
							<button class="btn btn-outline-info" type="submit" onclick="query()">Go!!!</button>
						</div>
					</div>
				</div>
			</form>
			<script type="text/javascript">
				function query() {
					var input = document.getElementById("keyword");
					if (!input.value) {
						return false;
					} else {
						var url = "<?php echo nines_taoke_current_url(); ?>";
						window.location.href = url + "?q=" + input.value;
					}
				}
			</script>
		</div>
		<div class="col-11 col-lg-11" style="margin-left: 25px;margin-top: 25px;">
			<div id="tag_cloud-2" class="widget widget_tag_cloud mb-5">
				<div class="tk_widget-title mb-4">
					<span class="tk_nice-b-line">女装</span>
				</div>
				<div class="tk_tagcloud">
					<a href="<?php echo nines_taoke_current_url(['q' => '女装衬衫']); ?>">衬衫</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装T恤']); ?>">T恤</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装风衣']); ?>">风衣</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装马甲裙']); ?>">马甲裙</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装牛仔裙']); ?>">牛仔裙</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装学院风']); ?>">学院风</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装仙女系']); ?>">仙女系</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装阔腿裤']); ?>">阔腿裤</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装破洞裤']); ?>">破洞裤</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装打底裤']); ?>">打底裤</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装小脚裤']); ?>">小脚裤</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装9分裤']); ?>">9分裤</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装背带裤']); ?>">背带裤</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装紧身牛仔']); ?>">紧身牛仔</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装优雅长款']); ?>">优雅长款</a></a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女装显高短款']); ?>">显高短款</a>
				</div>
			</div>
		</div>
		<div class="col-11 col-lg-11" style="margin-left: 25px;margin-top: 25px;">
			<div id="tag_cloud-2" class="widget widget_tag_cloud mb-5">
				<div class="tk_widget-title mb-4">
					<span class="tk_nice-b-line">男装</span>
				</div>
				<div class="tk_tagcloud">
					<a href="<?php echo nines_taoke_current_url(['q' => '男装韩风']); ?>">韩风</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装落肩']); ?>">落肩</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装条纹']); ?>">条纹</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装街头']); ?>">街头</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装嘻哈']); ?>">嘻哈</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装国潮']); ?>">国潮</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装铆钉']); ?>">铆钉</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装破洞']); ?>">破洞</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装卫衣']); ?>">卫衣</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装九分']); ?>">九分</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装七分']); ?>">七分</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装衬衫']); ?>">衬衫</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装T恤']); ?>">T恤</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装长款T恤']); ?>">长款T恤</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装休闲裤']); ?>">休闲裤</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男装运动裤']); ?>">运动裤</a>
				</div>
			</div>
		</div>
		<div class="col-11 col-lg-11" style="margin-left: 25px;margin-top: 25px;">
			<div id="tag_cloud-2" class="widget widget_tag_cloud mb-5">
				<div class="tk_widget-title mb-4">
					<span class="tk_nice-b-line">内衣</span>
				</div>
				<div class="tk_tagcloud">
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣少女']); ?>">少女</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣蕾丝']); ?>">蕾丝</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣睡裙']); ?>">睡裙</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣抹胸']); ?>">抹胸</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣薄款']); ?>">薄款</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣真丝']); ?>">真丝</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣运动']); ?>">运动</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣胸贴']); ?>">胸贴</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣隐形']); ?>">隐形</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣情侣']); ?>">情侣</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣家居服']); ?>">家居服</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '女内裤']); ?>">女内裤</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '男内裤']); ?>">男内裤</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣水晶袜']); ?>">水晶袜</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣无钢圈']); ?>">无钢圈</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣平角裤']); ?>">平角裤</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '七了个三']); ?>">七了个三</a>
					<a href="<?php echo nines_taoke_current_url(['q' => '内衣二次元']); ?>">二次元</a>
				</div>
			</div>
		</div>
		<style type="text/css">
			#taoke-back-to-top {
				opacity: 1;
				visibility: visible;
				position: fixed;
				right: 12px;
				bottom: 76px;
			}

			#taoke-back-to-top .taoke-icon-stack {
				display: flex;
				border-radius: 20px;
				color: #fff;
				background-color: #ff5687;
			}

			#taoke-back-to-top .taoke-icon-stack .back-to-top-text {
				display: inline-block;
				font-size: 13px;
				text-transform: uppercase;
				letter-spacing: 0.40em;
				line-height: 3em;
				margin-left: 4px;
			}
		</style>
		<a id="taoke-back-to-top" href="<?php echo nines_taoke_current_url(); ?>">
			<span class="taoke-icon-stack">
				<span class="back-to-top-text">返回</span>
			</span>
		</a>
	<?php get_footer();
	}


	public function nines_taoke_template_footer()
	{
		$res_tag = $this->nines_taoke_content_auth();
		if ($res_tag) {
			$c = new TopClient;
			$c->appkey = get_option('nines_taoke_key');
			$c->secretKey = get_option('nines_taoke_secret');
			$req = new TbkDgMaterialOptionalRequest;
			$req->setPageSize(1);
			$req->setAdzoneId($this->nines_get_pid(get_option('nines_taoke_pid')));
			$req->setHasCoupon("true");
			$this->nines_taoke_content_style();
			$shop_data = '';
			foreach ($res_tag as $tag) {
				$keyword = $tag->name;
				$req->setQ($keyword);
				$resp = $c->execute($req);
				if (!empty($resp->msg)) {
					continue;
				}
				$data = $resp->result_list->map_data[0];
				if ($data) {
					$shop_data .= '<br/><code>Tag:' . $keyword . ' 推荐商品:</code><a class="tk_goods-container tk_clearfix" href="' . $data->coupon_share_url . '" target="_blank" style="text-decoration:none;"><div class="tk_img-container"><div class="tk_normal-img-container" style="background: rgb(255, 255, 255); height: 142px;"><img src="' . $data->pict_url . '" class="img"></div></div><div class="tk_info-container"><div class="tk_desc-container"><span class="tk_desc tk_word-ellipsis-2">' . $data->title . '</span><span class="tk_brief tk_line-ellipsis-1">' . $data->item_description . '</span></div><div class="tk_tag-list"><div class="tk_tag"><span>优惠券:' . $data->coupon_amount . ' 元</span></div></div><span class="tk_price"><span class="tk_symbol">¥ </span><span class="tk_number">' . ($data->zk_final_price - $data->coupon_amount) . '</span></span><span class="tk_like"><span style="text-decoration:line-through;">原价:' . $data->zk_final_price . '</span> / 销量:' . $data->volume . ' </span></div></a>';
					usleep(500000);
				}
			}
			echo '<script> window.onload = function() {var testdiv = document.getElementById("nines_taoke");testdiv.innerHTML=\'' . $shop_data . '\';}</script>';
		}
	}

	/**
	 * @copyright 判断权限
	 * @author 不问归期__
	 * @time      2020-09-13
	 * @return    [type]      [description]
	 */
	protected function nines_taoke_content_auth()
	{
		if (!is_admin()) {
			if (is_singular('post')) {
				$tag = get_post_meta(get_the_ID(), 'nines_taoke_tag', TRUE);
				if ($tag == '1') {
					$posttags = get_the_tags();
					if ($posttags) {
						return $posttags;
					}
				}
			}
		}
		return false;
	}
	/**
	 * @copyright 通过标签获取商品信息
	 * @author 不问归期__
	 * @time      2020-07-02
	 * @param     [type]
	 * @return    [type]
	 */
	public function nines_taoke_content_tag($content)
	{
		//$res_tag = $this->nines_taoke_content_auth();
		if ($this->nines_taoke_content_auth()) {
			$shop = '<div id="nines_taoke"></div>';
			return $content . $shop;
		}
		return $content;
	}



	/**
	 * 解析文章中的淘宝标签获取商品
	 *
	 * @return  [type]  [return description]
	 */
	public function nines_taoke_content_label()
	{ ?>
		<script>
			// var items = document.getElementsByClassName("nines_taoke_content_label");
			// for (var i = 0; i < items.length; i++) {

			// 	// var value = items[i].firstChild.nodeValue;
			// 	console.log(items[i].firstChild.nodeValue);
			// }

			// window.onload = function() {
			// console.log('测试');
			// document.getElementById("nines_taoke_content_label").each((i, v) => {
			// 	let taoke = jQuery(v).text();
			// 	arr.push(taoke);
			// });
			// // taoke = jQuery("#nines_taoke_content_label").text();
			// fsfsdf = document.getElementById("nines_taoke_content_label");
			// console.log(taoke);
			// }
			// console.log('sdfs');
		</script>
	<?php
		// return $content;
	}


	public function nines_taoke_content_style()
	{ ?>
		<style>
			.tk_mobile_type {
				width: 72px;
				height: 72px;
				margin: 0px auto;
			}

			.tk_clearfix:after {
				display: block;
				visibility: hidden;
				font-size: 0;
				clear: both;
				width: 0;
				height: 0;
				content: "."
			}

			.tk_line-ellipsis-1 {
				-webkit-line-clamp: 1
			}

			.tk_line-ellipsis-1,
			.tk_word-ellipsis-2 {
				display: -webkit-box;
				-webkit-box-orient: vertical;
				word-break: break-all;
				overflow: hidden;
				text-overflow: ellipsis
			}

			.tk_word-ellipsis-2 {
				-webkit-line-clamp: 2
			}

			.tk_img-container {
				overflow: hidden
			}

			.tk_normal-img-container img {
				display: block;
				width: 100%;
				height: 100%
			}

			.tk_head-container .tk_second-categories {
				overflow: scroll;
				display: -webkit-box;
				display: -webkit-flex;
				display: -ms-flexbox;
				display: flex;
				box-sizing: border-box;
				height: 120px;
				margin: 15px 0px 20px;
				padding: 0 20px
			}

			.tk_head-container .tk_second-categories .tk_item {
				-webkit-box-flex: 1;
				-webkit-flex: 1;
				-ms-flex: 1;
				flex: 1;
				height: 80px
			}

			.tk_head-container .tk_second-categories .tk_item:not(:last-child) {
				margin-right: 1px
			}

			.tk_head-container .tk_second-categories .tk_item i {
				display: block;
				width: 48px;
				height: 48px;
				margin: 5px auto 10px
			}

			.tk_head-container .tk_second-categories .tk_item .tk_desc {
				margin-top: 0px;
				font-size: 14px;
				text-align: center
			}

			.tk_goods-container .tk_img-container {
				width: 142px;
				height: 142px;
				margin: 5px 0 0 5px;
				padding-top: 0;
				border-radius: 4px
			}

			.tk_goods-container {
				position: relative;
				display: -webkit-box;
				display: -webkit-flex;
				display: -ms-flexbox;
				display: flex;
				width: 100%;
				height: 152px;
				margin-bottom: 12px;
				border-radius: 8px;
				background-color: #fff;
				box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .1)
			}

			.tk_goods-container>.tk_info-container {
				position: relative;
				box-sizing: border-box;
				-webkit-box-flex: 1;
				-webkit-flex: 1;
				-ms-flex: 1;
				flex: 1;
				height: 100%;
				padding-top: 13px
			}

			.tk_goods-container>.tk_info-container .tk_desc-container {
				position: relative;
				margin: 0 11px 0 8px
			}

			.tk_goods-container>.tk_info-container .tk_desc-container .tk_desc {
				margin-bottom: 10px;
				font-family: PingFangSC;
				font-size: 16px;
				line-height: 22px
			}

			.tk_goods-container>.tk_info-container .tk_desc-container .tk_brief {
				height: 12px;
				font-size: 12px;
				color: #999;
				line-height: 12px
			}

			.tk_goods-container>.tk_info-container .tk_tag-list {
				position: absolute;
				bottom: 45px;
				left: 8px;
				height: 16px;
				font-size: 0
			}

			.tk_goods-container>.tk_info-container .tk_tag-list .tk_tag {
				display: inline-block;
				width: 108%;
				height: 22px;
			}

			.tk_goods-container>.tk_info-container .tk_tag-list .tk_tag span {
				display: inline;
				white-space: nowrap;
				padding-left: 5px;
				font-size: 15px;
				line-height: 22px;
			}

			.tk_goods-container>.tk_info-container .tk_tag-list .tk_tag.hot,
			.tk_goods-container>.tk_info-container .tk_tag-list .tk_tag {
				border: 1px solid #ff5687;
				border-radius: 25px;
				color: #ff5687
			}

			.tk_goods-container>.tk_info-container .tk_tag-list .tk_tag:not(:first-child) {
				margin-left: 4px
			}

			.tk_goods-container>.tk_info-container .tk_price {
				position: absolute;
				bottom: 12px;
				left: 8px;
				height: 18px;
				font-size: 0;
				line-height: 18px;
				letter-spacing: 0;
				color: #ff5687
			}

			.tk_goods-container>.tk_info-container .tk_price>.tk_symbol {
				font-size: 14px
			}

			.tk_goods-container>.tk_info-container .tk_price>.tk_number,
			.tk_goods-container>.tk_info-container .tk_price>.tk_symbol {
				font-size: 32px
			}

			.tk_goods-container>.tk_info-container .tk_like {
				position: absolute;
				bottom: 12px;
				right: 10px;
				font-size: 12px;
				color: #999;
				line-height: 12px
			}

			@media screen and (max-width: 1000px) {
				.tk_goods-container>.tk_info-container .tk_like {
					position: absolute;
					bottom: 12px;
					right: 10px;
					font-size: 10px;
					color: #999;
					line-height: 12px
				}
			}
		</style>
<?php }
}
