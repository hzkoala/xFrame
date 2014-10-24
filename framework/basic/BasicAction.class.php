<?php
class BasicAction {
	protected $response;


	public function __construct () {
		$this->response = new Response(Response::HTML);
		$templatePath = TEMPLATE . "/{$GLOBALS['action']}/{$GLOBALS['method']}.tpl";
		$this->response->setTemplate($templatePath);
		$this->response->setValue('_action', $GLOBALS['action']);
		$this->response->setValue('_method', $GLOBALS['method']);
	}


	/**
	 * 返回Response
	 * 
	 * @return NULL
	 */
	public function display () {
		$this->response->show();
	}
}
