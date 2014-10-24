<?php
final class Response {
	const HTML = 'html';
	const JSON = 'json';
	const XML = 'xml';
	private $smarty;
	private $type;
	private $template;
	private $data;


	public function __construct ($type = self::HTML) {
		$this->smarty = new Smarty();
		$this->smarty->template_dir = TEMPLATE;
		$this->smarty->compile_dir = CACHE . '/template_c';
		$this->smarty->cache_dir = CACHE . '/template_cache';
		$this->smarty->config_dir = CONFIG;
		$this->smarty->ldelim = '{';
		$this->smarty->rdelim = '}';
		$this->smarty->caching = isset($GLOBALS['switch']['cache']) ?  : true;
	}


	/**
	 * 设置Smarty模版变量
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @return NULL
	 */
	public function setValue ($name, $value) {
		$this->data[$name] = $value;
	}


	/**
	 * 设置Json返回值
	 * 
	 * @param mixed $value
	 * @return NULL
	 */
	public function setData ($data) {
		$this->data = $data;
	}


	public function setType ($type) {
		$this->type = $type;
	}


	public function setTemplate ($templatePath) {
		$this->template = $templatePath;
	}


	public function show () {
		switch ($this->type) {
			case self::JSON:
				{
					echo is_string($this->data) ? $this->data : json_encode($this->data);
					break;
				}
			
			case self::XML:
				{
					break;
				}
			
			case self::HTML:
			default:
				{
					foreach ($this->data as $k => $v) {
						$this->smarty->assign($k, $v);
					}
					$this->smarty->display($this->template);
					break;
				}
		}
	}
}
