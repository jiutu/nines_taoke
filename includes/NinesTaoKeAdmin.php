<?php


class NinesTaoKeAdmin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * @description: 
	 * @param {type} 
	 * @return {type} 
	 * @author: BuWenGuiQi_
	 */
	public function nines_taoke_setting_menu()
	{
		wp_enqueue_media();
		add_menu_page('淘客配置', '淘宝客', 'administrator', 'nines_taoke_settings', '', 'dashicons-cart', 80);
		add_submenu_page(
			'nines_taoke_settings',
			'淘客配置',
			'淘客配置',
			'administrator',
			'nines_taoke_settings',
			function () { ?>
			<div class="wrap">
				<h1 class="wp-heading-inline">淘宝客插件配置(永久免费)</h1>
				<p>功能想法请联系或者留言( 地址: <a href="https://www.aliluv.cn/liuyan">https://www.aliluv.cn/liuyan </a> )</p>
				<hr class="wp-header-end">
				<div class="widget-liquid-left">
					<div id="widgets-right" class="wp-clearfix single-sidebar">
						<div class="widgets-holder-wrap">
							<div class="widgets-sortables ui-droppable ui-sortable">
								<div class="sidebar-name">
									<a class="handlediv" href="https://www.aliluv.cn/shop" target="_blank">演示</a>
									<h2>配置 <span class="spinner"></span></h2>
								</div>
								<form method="post" action="options.php">
									<?php settings_fields('nines-taoke-settings-group'); ?>
									<?php do_settings_sections('nines-taoke-settings-group'); ?>
									<div class="widget-content">
										<p>
											<label for="widget-pages-2-title">App Key：</label><br />
											<input class="widefat" name="nines_taoke_key" type="text" value="<?php echo esc_attr(get_option('nines_taoke_key')); ?>" style="width: 120px;">
										</p>
										<p>
											<label for="widget-pages-2-exclude">App Secret：</label><br />
											<input class="widefat" name="nines_taoke_secret" type="text" value="<?php echo esc_attr(get_option('nines_taoke_secret')); ?>">
										</p>
										<p>
											<label for="widget-pages-2-exclude">Pid：</label><br />
											<input class="widefat" name="nines_taoke_pid" type="text" value="<?php echo esc_attr(get_option('nines_taoke_pid')); ?>">
											<br>
											<small>网站推广位 PID</small>
										</p>
										<p>
											<label for="widget-pages-2-sortby">页面：</label>
											<select name="nines_taoke_pagename" class="widefat">
												<?php $config_name = esc_attr(get_option('nines_taoke_pagename'));;
												$pages = get_pages(array('post_type' => 'page', 'post_status' => 'publish')); ?>
												<option value=''>不选择</option>
												<?php foreach ($pages as $val) {
													//var_dump($val->post_name);
													$selected = ($val->ID == $config_name) ? 'selected="selected"' : "";
													$page_title = $val->post_title;
													$page_name = $val->ID; ?>
													<option value='<?php echo $page_name; ?>' <?php echo $selected; ?>>
														<?php echo $page_title; ?>
													</option>
												<?php } ?>
											</select>
											<br>
											<small>没有??
												<a href="<?php echo admin_url("post-new.php"); ?>?post_type=page" target="_blank">新增!!</a>
											</small>
										</p>

										<p>
											<label for="widget-pages-2-exclude">文章标签商品推荐：</label><br />
											<?php $nines_taoke_tag_switch = esc_attr(get_option('nines_taoke_tag_switch')); ?>
											<input type="radio" name="nines_taoke_tag_switch" value="1" <?php echo ($nines_taoke_tag_switch == '1') ? 'checked' : '' ?>> 开启

											<input type="radio" name="nines_taoke_tag_switch" value="0" <?php echo ($nines_taoke_tag_switch == '0') ? 'checked' : '' ?>> 关闭
											<br>
											<small>开启 = 默认开启商品推荐、 关闭 = 默认不推荐(需在文章内开启)</small>
										</p>

										<?php submit_button(); ?>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="widget-liquid-right">
					<div id="widgets-right" class="wp-clearfix single-sidebar">
						<div class="sidebars-column-1">
							<div class="widgets-holder-wrap">
								<div id="sidebar-1" class="widgets-sortables ui-droppable ui-sortable">
									<div class="sidebar-name">
										<a class="handlediv" href="https://www.aliluv.cn/18.html" target="_blank">帮助</a>
										<h2>常见问题<span class="spinner"></span></h2>
									</div>
									<div class="sidebar-description">
										<p>
											1、如果App key是刚通过审核的，淘宝联盟平台需要一天左右时间刷新服务器才能正常获取到商品信息
										</p>
										<p>
											2、本插件需要用到淘宝官方接口，没有权限请自行申请(如果没有权限会有提示,英文的、、看不懂自行翻译可好??) ->
											<a href="https://open.taobao.com/api.htm?docId=35896&docType=2&scopeId=16516" class="alert-link">
												去申请
											</a>
										</p>
										<p>
											3、其中pid必须是淘宝联盟->网站推广位 的pid(没有这个推广位的pid请申请),其它位置的pid将获取不到商品数据
										</p>
										<p>...</p>
										<p>...</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php }
		);
		add_submenu_page(
			'nines_taoke_settings',
			'菜单配置',
			'菜单配置',
			'administrator',
			'nines_menu',
			function () {
				wp_enqueue_script($this->plugin_name, NINES_TAOKE_PL_URL . '/static/vue.min.js');
				if (get_option('nines_taoke_menus') != '[]' && get_option('nines_taoke_menus') != '') {
					$menus = get_option('nines_taoke_menus');
				} else {
					$menus = nines_taoke_default_menus();
				} ?>
			<div class="wrap" id="menu">
				<h2>淘客菜单配置</h2>
				<p>!!删除所有菜单再点击保存会默认使用配置菜单!!</p>
				<form method="post" action="options.php">
					<?php settings_fields('nines-taoke-settings-menus'); ?>
					<?php do_settings_sections('nines-taoke-settings-menus'); ?>
					<div class="tablenav bottom">
						<div class="alignleft actions bulkactions">
							<input type="submit" name="submit" id="submit" value="保存数据" class="button action button-primary">
							<label>
								<span class="title">关键词:</span>
								<span class="input-text-wrap">
									<input type="text" name="nines_taoke_keyword" value="<?php echo esc_attr(get_option('nines_taoke_keyword')); ?>" style="width:170px;" placeholder="默认显示的商品分类">
								</span>
							</label>
						</div>
					</div>
					<fieldset id="nines_menu" class="filter-group " v-for="(v,k) in nines_taoke_menus" style="margin: 0 1% 7px 0; display:none;">
						<div class="filter-group-feature">
							<span class="media-icon image-icon" v-if="v.path === ''">
								<button type="button" class="upload_button button button-primary" :id="v.id" style="height: 66px;">设置特<br />色图像</button>
							</span>
							<span class="media-icon image-icon" v-else>
								<img width="60" height="60" :src="v.path" class="upload_button  attachment-60x60 size-60x60" :id="v.id" sizes="100vw">
							</span>
							<input type="text" placeholder="菜单名称" class="form-control" v-model="v.title" required style="float: right;">
						</div>
						<span class="delete" style="float: right;margin-top: -20px;">
							<a href="javascript:;" @click.prevent="del(k)" class="submitdelete aria-button-if-js">删除</a>
						</span>
					</fieldset>
					<div class="tablenav bottom">
						<div class="alignleft actions bulkactions">
							<input type="submit" @click.prevent="add" class="button action button-primary" value="添加菜单">
						</div>
					</div>
					<textarea name="nines_taoke_menus" hidden>{{nines_taoke_menus}}</textarea>
				</form>
			</div>
			<script type="text/javascript">
				window.onload = function() {
					jQuery('#nines_menu').show();
					new Vue({
						el: '#menu',
						data: {
							nines_taoke_menus: <?php echo $menus; ?>
						},
						mounted: function() {
							this.nines_taoke_menus.forEach(function(v) {
								upload(v);
							})
						},
						methods: {
							add: function() {
								var field = {
									title: '',
									path: '',
									id: Date.now()
								};
								this.nines_taoke_menus.push(field);
								setTimeout(function() {
									upload(field);
								}, 200);
							},
							del: function(k) {
								this.nines_taoke_menus.splice(k, 1);
							}
						}
					});

					function upload(field) {
						var upload_frame;
						var value_id = field.id;
						jQuery('#' + value_id).on('click', null, function(event) {
							event.preventDefault();
							if (upload_frame) {
								upload_frame.open();
								return;
							}
							upload_frame = wp.media({
								title: '选择图片',
								button: {
									text: '选择'
								},
								multiple: false
							});
							upload_frame.on('select', function() {
								attachment = upload_frame.state().get('selection').first().toJSON();
								field.path = attachment.url;
							});
							upload_frame.open();
						});
					}
				}
			</script>
		<?php }
		);
		add_submenu_page(
			'nines_taoke_settings',
			'淘客短链',
			'淘客短链',
			'administrator',
			'nines_short_url',
			function () { ?>
			<div class="wrap">
				<h2>淘宝客【公用】长链转短链</h2>
				<p>输入一个原始的链接，转换得到指定的传播方式，如二维码，淘口令，短连接； 现阶段只支持短连接。(原始url, 只支持uland.taobao.com，s.click.taobao.com， ai.taobao.com，temai.taobao.com的域名转换，否则判错)</p>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">长链接:</th>
						<td>
							<input type="text" name="nines_short_url" class="regular-text nm-color-picker" />
							<input type="button" onclick="nines_short_url()" class="button action" value="获取">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"></th>
						<td>
							<span style="color: red;font-size: 20px">
								<div id="url_data"></div>
							</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">接口调用:</th>
						<td>
							<span style="color: blue; font-size: 20px">
								<?php echo admin_url("admin-ajax.php"); ?>?action=nines_taoke_short_url&url=<code>淘客长链接</code>
							</span>
						</td>
					</tr>
				</table>
			</div>
			<script type="text/javascript">
				function nines_short_url() {
					jQuery.ajax({
						type: "GET",
						url: "<?php echo admin_url("admin-ajax.php"); ?>",
						data: {
							action: "nines_taoke_short_url",
							url: jQuery("input[name='nines_short_url']").val()
						},
						success: function(data) {
							var obj = JSON.parse(data);
							if (obj.code) {
								jQuery('#url_data').text('短链接: ' + obj.short_url);
							} else {
								alert(obj.msg);
							}
						}
					});
				}
			</script>
		<?php }
		);
		add_submenu_page(
			'nines_taoke_settings',
			'淘客口令',
			'淘客口令',
			'administrator',
			'nines_key_word',
			function () { ?>
			<div class="wrap" id="menu">
				<h2>淘宝客-公用-淘口令生成</h2>
				<p>示例值(现在只支持短链接):https://s.click.taobao.com/YI3Uopu (联盟官方渠道获取的淘客推广链接，请注意，不要随意篡改官方生成的链接，否则可能无法生成淘口令)</p>
				<form id="form_data">
					<table class="form-table">
						<tr valign="top">
							<th scope="row">短链接(如不清楚请看上面示例):</th>
							<td>
								<input type="text" name="url" class="regular-text nm-color-picker" placeholder="必须" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"></th>
							<td>
								<span style="color: red;font-size: 20px">
									<div id="key_word_data"></div>
								</span>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"></th>
							<td>
								<input type="hidden" name="action" value="nines_taoke_key_word">
								<input type="button" onclick="nines_taoke_key_word()" class="button action" value="获取">
							</td>
						</tr>
					</table>
				</form>
			</div>
			<script type="text/javascript">
				function nines_taoke_key_word() {
					jQuery.ajax({
						type: "GET",
						url: "<?php echo admin_url("admin-ajax.php"); ?>",
						data: jQuery('#form_data').serialize(),
						success: function(data) {
							var obj = JSON.parse(data);
							if (obj.code) {
								jQuery('#key_word_data').html('淘口令: ' + obj.data['password_simple'] + '<br/>文本: ' + obj.data['model']);
							} else {
								alert(obj.msg);
							}
						}
					});
				}
			</script>
		<?php }
		);
	}


	/**
	 * @Description: 淘宝客短链
	 * @author: BuWenGuiQi_
	 * @param {type} 
	 * @return {type} 
	 */
	public function nines_taoke_short_url()
	{
		if (!isset($_GET['url']) || $_GET['url'] == '') {
			exit(json_encode(['code' => false, 'short_url' => '', 'msg' => '链接不能为空'], JSON_UNESCAPED_UNICODE));
		}
		$c = new TopClient;
		$c->appkey = get_option('nines_taoke_key');
		$c->secretKey = get_option('nines_taoke_secret');
		$req = new TbkSpreadGetRequest;
		$req->setRequests(json_encode(['url' => $_GET['url']], JSON_UNESCAPED_UNICODE));
		$resp = $c->execute($req);
		if (!empty($resp->msg)) {
			exit(json_encode(['code' => false, 'short_url' => '', 'msg' => $resp->sub_msg . $resp->msg], JSON_UNESCAPED_UNICODE));
		}
		$res_data = $resp->results->tbk_spread[0];
		if ($res_data->err_msg != 'OK') {
			exit(json_encode(['code' => false, 'short_url' => '', 'msg' => $res_data->err_msg], JSON_UNESCAPED_UNICODE));
		}
		exit(json_encode(['code' => true, 'short_url' => $res_data->content, 'msg' => 'OK'], JSON_UNESCAPED_UNICODE));
	}

	/**
	 * @description: 
	 * @param {type} 
	 * @return {type} 
	 */
	function FunctionName()
	{
		# code...
	}

	/**
	 * @copyright 淘口令
	 * @author 不问归期__
	 * @time      2020-09-15
	 * @return    [type]      [description]
	 */
	public function nines_taoke_key_word()
	{
		if ($_GET['url'] == '') {
			exit(json_encode(['code' => false, 'short_url' => '', 'msg' => '必填参数不能为空'], JSON_UNESCAPED_UNICODE));
		}
		$c = new TopClient;
		$c->appkey = get_option('nines_taoke_key');
		$c->secretKey = get_option('nines_taoke_secret');
		$req = new TbkTpwdCreateRequest;
		// $req->setUserId($_GET['user_id']);
		// $req->setText($_GET['text']);
		$req->setUrl($_GET['url']);
		// $req->setLogo($_GET['logo']);
		$resp = $c->execute($req);
		if (!empty($resp->msg)) {
			exit(json_encode(['code' => false, 'data' => [], 'msg' => $resp->sub_msg . $resp->msg], JSON_UNESCAPED_UNICODE));
		}
		//$res_data = $resp->data;
		// if (empty($res_data->password_simple)) {
		// 	exit( json_encode([ 'code'=> false,'data' =>[],'msg'=>'获取失败' ],JSON_UNESCAPED_UNICODE));
		// }
		exit(json_encode(['code' => true, 'data' => $resp->data, 'msg' => 'OK'], JSON_UNESCAPED_UNICODE));
	}


	public function nines_taoke_register_mysettings()
	{
		register_setting('nines-taoke-settings-group', 'nines_taoke_key');
		register_setting('nines-taoke-settings-group', 'nines_taoke_secret');
		register_setting('nines-taoke-settings-group', 'nines_taoke_pid');
		register_setting('nines-taoke-settings-group', 'nines_taoke_pagename');
		register_setting('nines-taoke-settings-group', 'nines_taoke_tag_switch');
		register_setting('nines-taoke-settings-menus', 'nines_taoke_menus');
		register_setting('nines-taoke-settings-menus', 'nines_taoke_keyword');
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		// if ($_GET['page'] == 'nines_taoke_settings') {
		// wp_enqueue_style( $this->plugin_name.'_bootstrap',NINES_TAOKE_PL_URL. '/static/bootstrap.min.css',);
		// wp_enqueue_style( 
		// 	$this->plugin_name.'_bootstrap',
		// 	NINES_TAOKE_PL_URL. '/static/bootstrap.min.css',
		// 	array(), 
		// 	$this->version, 
		// 	'all' 
		//  );
		// }
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		// wp_enqueue_script(
		// 	$this->plugin_name.'_mdui',
		// 	NINES_TAOKE_PL_URL. '/static/mdui/js/mdui.min.js',
		// 	array(  ),
		// 	$this->version,
		// 	false
		// );
	}

	public function nines_taoke_tag()
	{
		add_meta_box(
			'nines_taoke_tag',
			'淘客商品推荐',
			function ($post) {
				wp_nonce_field('nines_taoke_tag', 'nines_taoke_tag_nonce');
				$value = get_post_meta($post->ID, 'nines_taoke_tag', TRUE);
				$value = ($value) ? '1' : '0'; ?>
			<input type="radio" name="nines_taoke_tag" value="1" <?php echo ($value == '1') ? 'checked' : '' ?>> 开启
			<br />
			<input type="radio" name="nines_taoke_tag" value="0" <?php echo ($value == '0') ? 'checked' : '' ?>> 关闭
		<?php
			},
			'post',
			'side',
			'core'
		);
	}

	/**
	 * 
	 * @author: BuWenGuiQi_
	 * @param {type} 
	 * @return {type} 
	 */
	public function nines_taoke_tag_save_meta_box($post_id)
	{
		if (!isset($_POST['nines_taoke_tag_nonce'])) {
			return;
		}
		if (!wp_verify_nonce($_POST['nines_taoke_tag_nonce'], 'nines_taoke_tag')) {
			return;
		}
		if (!current_user_can('edit_post', $post_id)) {
			return;
		}
		if (!isset($_POST['nines_taoke_tag'])) {
			return;
		}
		$product_director = sanitize_text_field($_POST['nines_taoke_tag']);
		update_post_meta($post_id, 'nines_taoke_tag', $product_director);
	}


	/**
	 * 编辑器淘客商品输入
	 *
	 * @return  [type]  [return description]
	 */
	public function nines_taoke_add_my_media_button()
	{
		echo '<label id="add_taoke" class="button">添加淘客商品</label>';
		?>
		<script type="text/javascript">
			jQuery('#add_taoke').click(function() {
				var taoke = prompt("目前仅支持商品名称获取商品信息!!!如: 华为P40 PRO");
				if (taoke == null) {
					return;
				}
				wp.media.editor.insert('<div class="nines_taoke_content_label">' + taoke + '</div>');
			});
		</script>
<?php
	}
}
