<?php
/**
 * 注册插件的所有操作和过滤器
 */
class NinesTaoKeLoader {

	protected $actions;
	protected $filters;

	/**
	 * @copyright 初始化用于维护操作和筛选器的集合。
	 * @author 不问归期__
	 * @time      2020-08-14
	 */
	public function __construct() {
		$this->actions = array();
		$this->filters = array();
	}

	/**
	 * @copyright 向要向WordPress注册的集合添加新操作。
	 * @author 不问归期__
	 * @time      2020-08-14
	 * @param     [type]      $hook          [description]
	 * @param     [type]      $component     [description]
	 * @param     [type]      $callback      [description]
	 * @param     integer     $priority      [description]
	 * @param     integer     $accepted_args [description]
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * @copyright 向要向WordPress注册的集合添加新筛选器。
	 * @author 不问归期__
	 * @time      2020-08-14
	 * @param     [type]      $hook          [description]
	 * @param     [type]      $component     [description]
	 * @param     [type]      $callback      [description]
	 * @param     integer     $priority      [description]
	 * @param     integer     $accepted_args [description]
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * @copyright 一个实用函数，用于将操作和挂钩注册到单个集合中。
	 * @author 不问归期__
	 * @time      2020-08-14
	 * @param     [type]      $hooks         [description]
	 * @param     [type]      $hook          [description]
	 * @param     [type]      $component     [description]
	 * @param     [type]      $callback      [description]
	 * @param     [type]      $priority      [description]
	 * @param     [type]      $accepted_args [description]
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {
		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;

	}

	/**
	 * @copyright 用WordPress注册过滤器和操作。
	 * @author 不问归期__
	 * @time      2020-08-14
	 * @return    [type]      [description]
	 */
	public function run() {
		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}
		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

}
