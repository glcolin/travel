<?php
class Url {
	
	public function __construct() {
	
	}
		
	public function link($route, $args = '') {
	
		$url = 'index.php?route=' . $route;
			
		if ($args) {
			$url .= str_replace('&', '&amp;', '&' . ltrim($args, '&')); 
		}
				
		return $url;
	}
}
?>