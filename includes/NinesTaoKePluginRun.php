<?php

/**
 * 定义核心插件类的文件
 */
class NinesTaoKePluginRun
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Plugin_Name_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct($version, $plugin_name)
	{
		$this->version = $version;
		$this->plugin_name = $plugin_name;
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 * Include the following files that make up the plugin:
	 */
	private function load_dependencies()
	{
		$this->loader = new NinesTaoKeLoader();
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new NinesTaoKeAdmin($this->get_plugin_name(), $this->get_version());
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
		$this->loader->add_action('add_meta_boxes', $plugin_admin, 'nines_taoke_tag');
		$this->loader->add_action('save_post', $plugin_admin, 'nines_taoke_tag_save_meta_box');
		$this->loader->add_action('admin_menu', $plugin_admin, 'nines_taoke_setting_menu');
		$this->loader->add_action('admin_init', $plugin_admin, 'nines_taoke_register_mysettings');


		$this->loader->add_action('wp_ajax_nopriv_nines_taoke_short_url', $plugin_admin, 'nines_taoke_short_url');
		$this->loader->add_action('wp_ajax_nines_taoke_short_url', $plugin_admin, 'nines_taoke_short_url');

		$this->loader->add_action('wp_ajax_nopriv_nines_taoke_key_word', $plugin_admin, 'nines_taoke_key_word');
		$this->loader->add_action('wp_ajax_nines_taoke_key_word', $plugin_admin, 'nines_taoke_key_word');
		//add_action('media_buttons', 'add_my_media_button');

		//新增文章页面淘客按钮
		// $this->loader->add_action('media_buttons', $plugin_admin, 'nines_taoke_add_my_media_button');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{
		$plugin_public = new NinesTaoKePublic($this->get_plugin_name(), $this->get_version());
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
		$this->loader->add_action('template_redirect', $plugin_public, 'nines_taoke_template', 1);
		$this->loader->add_action('the_content', $plugin_public, 'nines_taoke_content_tag', 1);
		// $this->loader->add_action('wp_footer', $plugin_public, 'nines_taoke_content_label', 1);
		$this->loader->add_action('wp_footer', $plugin_public, 'nines_taoke_template_footer');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Plugin_Name_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
