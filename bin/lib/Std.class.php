<?php

// Generated by Haxe 3.4.0 (git build development @ e08d018)
class Std {
	public function __construct(){}
	static function is($v, $t) {
		return _hx_instanceof($v, $t);
	}
	static function string($s) {
		return _hx_string_rec($s, "");
	}
	static function int($x) {
		$i = fmod($x, -2147483648) & -1;
		if($i & -2147483648) {
			$i = -((~$i & -1) + 1);
		}
		return $i;
	}
	static function parseInt($x) {
		$x = ltrim($x);
		$firstCharIndex = null;
		if(_hx_char_at($x, 0) === "-") {
			$firstCharIndex = 1;
		} else {
			$firstCharIndex = 0;
		}
		$firstCharCode = _hx_char_code_at($x, $firstCharIndex);
		$tmp = null;
		$tmp1 = null;
		if($firstCharCode !== null) {
			$tmp1 = $firstCharCode >= 48;
		} else {
			$tmp1 = false;
		}
		if($tmp1) {
			$tmp = $firstCharCode <= 57;
		} else {
			$tmp = false;
		}
		if(!$tmp) {
			return null;
		}
		$secondChar = _hx_char_at($x, $firstCharIndex + 1);
		$tmp2 = null;
		if($secondChar !== "x") {
			$tmp2 = $secondChar === "X";
		} else {
			$tmp2 = true;
		}
		if($tmp2) {
			return intval($x, 0);
		} else {
			return intval($x, 10);
		}
	}
	static function parseFloat($x) {
		$result = floatval($x);
		if($result != 0) {
			return $result;
		}
		$x = ltrim($x);
		$firstCharIndex = null;
		if(_hx_char_at($x, 0) === "-") {
			$firstCharIndex = 1;
		} else {
			$firstCharIndex = 0;
		}
		$charCode = _hx_char_code_at($x, $firstCharIndex);
		if($charCode === 46) {
			$charCode = _hx_char_code_at($x, $firstCharIndex + 1);
		}
		$tmp = null;
		$tmp1 = null;
		if($charCode !== null) {
			$tmp1 = $charCode >= 48;
		} else {
			$tmp1 = false;
		}
		if($tmp1) {
			$tmp = $charCode <= 57;
		} else {
			$tmp = false;
		}
		if($tmp) {
			return 0.0;
		} else {
			return Math::$NaN;
		}
	}
	static function random($x) {
		if($x <= 0) {
			return 0;
		} else {
			return mt_rand(0, $x - 1);
		}
	}
	function __toString() { return 'Std'; }
}
