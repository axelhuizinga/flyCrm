<?php

// Generated by Haxe 3.4.0
class StringBuf {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->b = "";
	}}
	public $b;
	public function add($x) {
		if(is_null($x)) {
			$x = "null";
		} else {
			if(is_bool($x)) {
				$x1 = null;
				if($x) {
					$x1 = "true";
				} else {
					$x1 = "false";
				}
				$x = $x1;
			}
		}
		$tmp = $this;
		$tmp1 = $tmp->b;
		$tmp->b = _hx_string_or_null($tmp1) . Std::string($x);
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	function __toString() { return 'StringBuf'; }
}
