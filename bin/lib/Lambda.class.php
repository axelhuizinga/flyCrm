<?php

// Generated by Haxe 3.4.0 (git build development @ e08d018)
class Lambda {
	public function __construct(){}
	static function harray($it) {
		$a = new _hx_array(array());
		{
			$i = $it->iterator();
			while($i->hasNext()) {
				$a->push($i->next());
			}
		}
		return $a;
	}
	static function hlist($it) {
		$l = new HList();
		{
			$i = $it->iterator();
			while($i->hasNext()) {
				$l->add($i->next());
			}
		}
		return $l;
	}
	static function map($it, $f) {
		$l = new HList();
		{
			$x = $it->iterator();
			while($x->hasNext()) {
				$l->add(call_user_func_array($f, array($x->next())));
			}
		}
		return $l;
	}
	static function mapi($it, $f) {
		$l = new HList();
		$i = 0;
		{
			$x = $it->iterator();
			while($x->hasNext()) {
				$i = $i + 1;
				$l->add(call_user_func_array($f, array($i - 1, $x->next())));
			}
		}
		return $l;
	}
	static function has($it, $elt) {
		{
			$x = $it->iterator();
			while($x->hasNext()) {
				if((is_object($_t = $x->next()) && ($_t instanceof Enum) ? $_t == $elt : _hx_equal($_t, $elt))) {
					return true;
				}
				unset($_t);
			}
		}
		return false;
	}
	static function exists($it, $f) {
		{
			$x = $it->iterator();
			while($x->hasNext()) {
				if(call_user_func_array($f, array($x->next()))) {
					return true;
				}
			}
		}
		return false;
	}
	static function hforeach($it, $f) {
		{
			$x = $it->iterator();
			while($x->hasNext()) {
				if(!call_user_func_array($f, array($x->next()))) {
					return false;
				}
			}
		}
		return true;
	}
	static function forone($it, $f) {
		{
			$x = $it->iterator();
			while($x->hasNext()) {
				if(call_user_func_array($f, array($x->next()))) {
					return true;
				}
			}
		}
		return false;
	}
	static function iter($it, $f) {
		$x = $it->iterator();
		while($x->hasNext()) {
			call_user_func_array($f, array($x->next()));
		}
	}
	static function filter($it, $f) {
		$l = new HList();
		{
			$x = $it->iterator();
			while($x->hasNext()) {
				$x1 = $x->next();
				if(call_user_func_array($f, array($x1))) {
					$l->add($x1);
				}
				unset($x1);
			}
		}
		return $l;
	}
	static function fold($it, $f, $first) {
		{
			$x = $it->iterator();
			while($x->hasNext()) {
				$first = call_user_func_array($f, array($x->next(), $first));
			}
		}
		return $first;
	}
	static function count($it, $pred = null) {
		$n = 0;
		if($pred === null) {
			$_ = $it->iterator();
			while($_->hasNext()) {
				$_->next();
				$n = $n + 1;
			}
		} else {
			$x = $it->iterator();
			while($x->hasNext()) {
				if(call_user_func_array($pred, array($x->next()))) {
					$n = $n + 1;
				}
			}
		}
		return $n;
	}
	static function hempty($it) {
		return !$it->iterator()->hasNext();
	}
	static function indexOf($it, $v) {
		$i = 0;
		{
			$v2 = $it->iterator();
			while($v2->hasNext()) {
				if((is_object($_t = $v) && ($_t instanceof Enum) ? $_t == $v2->next() : _hx_equal($_t, $v2->next()))) {
					return $i;
				}
				$i = $i + 1;
				unset($_t);
			}
		}
		return -1;
	}
	static function find($it, $f) {
		{
			$v = $it->iterator();
			while($v->hasNext()) {
				$v1 = $v->next();
				if(call_user_func_array($f, array($v1))) {
					return $v1;
				}
				unset($v1);
			}
		}
		return null;
	}
	static function concat($a, $b) {
		$l = new HList();
		{
			$x = $a->iterator();
			while($x->hasNext()) {
				$l->add($x->next());
			}
		}
		{
			$x1 = $b->iterator();
			while($x1->hasNext()) {
				$l->add($x1->next());
			}
		}
		return $l;
	}
	function __toString() { return 'Lambda'; }
}
