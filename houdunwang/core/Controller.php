<?php
/**
 * Created by PhpStorm.
 * User: mazhenyu
 * Date: 28/07/2017
 * Time: 14:52
 */

namespace houdunwang\core;


class Controller {
	private $url = 'window.history.back()';
	private $template;
	private $msg;

	/**
	 * 跳转
	 * @param $url
	 *
	 * @return $this
	 */
	protected function setRedirect($url){
		$this->url = "location.href='{$url}'";
		return $this;
	}

	/**
	 * 成功的时候
	 * @param $msg
	 *
	 * @return $this
	 */
	protected function success($msg){
		$this->msg = $msg;
		$this->template = './view/success.php';
		return $this;
	}

	/**
	 * 失败的时候
	 */
	protected function error($msg){
		$this->msg = $msg;
		$this->template = './view/error.php';
		return $this;
	}

	public function __toString() {
		include $this->template;
		return '';
	}
}