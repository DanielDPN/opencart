<?php
class ControllerEventLanguage extends Controller {
	public function index(&$route, &$args) {
		foreach ($this->language->all() as $key => $value) {
			if (!isset($args[$key])) {
				$args[$key] = $value;
			}
		}
	}	
	
	// 1. Before controller load store all current loaded language data
	public function before(&$route, &$output) {
		$this->language->set($route, $this->language->all());
	}
	
	// 2. After controller load restore old language data
	public function after(&$route, &$args, &$output) {
		$data = $this->language->get($route);
		
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$this->language->set($key, $value);
			}
		}
	}
}