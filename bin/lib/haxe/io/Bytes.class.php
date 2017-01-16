<?php

// Generated by Haxe 3.4.0 (git build development @ e08d018)
class haxe_io_Bytes {
	public function __construct($length, $b) {
		if(!php_Boot::$skip_constructor) {
		$this->length = $length;
		$this->b = $b;
	}}
	public $length;
	public $b;
	public function blit($pos, $src, $srcpos, $len) {
		$tmp = null;
		$tmp1 = null;
		$tmp2 = null;
		$tmp3 = null;
		if($pos >= 0) {
			$tmp3 = $srcpos < 0;
		} else {
			$tmp3 = true;
		}
		if(!$tmp3) {
			$tmp2 = $len < 0;
		} else {
			$tmp2 = true;
		}
		if(!$tmp2) {
			$tmp1 = $pos + $len > $this->length;
		} else {
			$tmp1 = true;
		}
		if(!$tmp1) {
			$tmp = $srcpos + $len > $src->length;
		} else {
			$tmp = true;
		}
		if($tmp) {
			throw new HException(haxe_io_Error::$OutsideBounds);
		}
		{
			$this1 = $this->b;
			$src1 = $src->b;
			$this1->s = substr($this1->s, 0, $pos) . substr($src1->s, $srcpos, $len) . substr($this1->s, $pos+$len);
		}
	}
	public function sub($pos, $len) {
		$tmp = null;
		$tmp1 = null;
		if($pos >= 0) {
			$tmp1 = $len < 0;
		} else {
			$tmp1 = true;
		}
		if(!$tmp1) {
			$tmp = $pos + $len > $this->length;
		} else {
			$tmp = true;
		}
		if($tmp) {
			throw new HException(haxe_io_Error::$OutsideBounds);
		}
		$this1 = $this->b;
		$x = new php__BytesData_Wrapper(substr($this1->s, $pos, $len));
		return new haxe_io_Bytes($len, $x);
	}
	public function getString($pos, $len) {
		$tmp = null;
		$tmp1 = null;
		if($pos >= 0) {
			$tmp1 = $len < 0;
		} else {
			$tmp1 = true;
		}
		if(!$tmp1) {
			$tmp = $pos + $len > $this->length;
		} else {
			$tmp = true;
		}
		if($tmp) {
			throw new HException(haxe_io_Error::$OutsideBounds);
		}
		$this1 = $this->b;
		return substr($this1->s, $pos, $len);
	}
	public function toString() {
		return $this->b->s;
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
	static function alloc($length) {
		$x = new php__BytesData_Wrapper(str_repeat(chr(0), $length));
		return new haxe_io_Bytes($length, $x);
	}
	static function ofString($s) {
		$x = new php__BytesData_Wrapper($s);
		$x1 = $x;
		return new haxe_io_Bytes(strlen($x1->s), $x1);
	}
	function __toString() { return $this->toString(); }
}
