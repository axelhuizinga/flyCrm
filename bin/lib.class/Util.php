<?php
/**
 * Generated by Haxe 4.0.0-preview.4+1e3e5e016
 */

use \haxe\ds\StringMap;
use \php\Boot;
use \php\_NativeArray\NativeArrayIterator;

class Util {
	/**
	 * @param mixed $v
	 * 
	 * @return bool
	 */
	static public function any2bool ($v) {
		#src/Util.hx:19: characters 10-41
		if (($v !== null) && !Boot::equal($v, 0)) {
			#src/Util.hx:19: characters 34-40
			return $v !== "";
		} else {
			#src/Util.hx:19: characters 10-41
			return false;
		}
	}

	/**
	 * @param StringMap $source
	 * 
	 * @return StringMap
	 */
	static public function copyStringMap ($source) {
		#src/Util.hx:25: characters 3-43
		$copy = new StringMap();
		#src/Util.hx:26: characters 3-28
		$keys = new NativeArrayIterator(array_map("strval", array_keys($source->data)));
		#src/Util.hx:27: lines 27-31
		while ($keys->hasNext()) {
			#src/Util.hx:29: characters 4-31
			$k = $keys->next();
			#src/Util.hx:30: characters 4-30
			$value = ($source->data[$k] ?? null);
			#src/Util.hx:30: characters 4-30
			$copy->data[$k] = $value;

		}
		#src/Util.hx:32: characters 3-14
		return $copy;
	}
}

Boot::registerClass(Util::class, 'Util');
