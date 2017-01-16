<?php

// Generated by Haxe 3.4.0 (git build development @ e08d018)
class haxe_io_Input {
	public function __construct(){}
	public function readByte() {
		throw new HException("Not implemented");
	}
	public function readBytes($s, $pos, $len) {
		$k = $len;
		$b = $s->b;
		$tmp = null;
		$tmp1 = null;
		if($pos >= 0) {
			$tmp1 = $len < 0;
		} else {
			$tmp1 = true;
		}
		if(!$tmp1) {
			$tmp = $pos + $len > $s->length;
		} else {
			$tmp = true;
		}
		if($tmp) {
			throw new HException(haxe_io_Error::$OutsideBounds);
		}
		try {
			while($k > 0) {
				{
					$val = $this->readByte();
					$b->s[$pos] = chr($val);
					unset($val);
				}
				$pos = $pos + 1;
				$k = $k - 1;
			}
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			if(($eof = $_ex_) instanceof haxe_io_Eof){} else throw $__hx__e;;
		}
		return $len - $k;
	}
	public function close() {}
	function __toString() { return 'haxe.io.Input'; }
}
