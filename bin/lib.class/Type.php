<?php
/**
 * Generated by Haxe 4.0.0-preview.4+1e3e5e016
 */

use \php\_Boot\HxClosure;
use \php\Boot;
use \php\_Boot\HxString;
use \php\_Boot\HxClass;
use \php\_Boot\HxEnum;
use \php\_Boot\HxAnon;

class Type {
	/**
	 * @param mixed $o
	 * 
	 * @return Class
	 */
	static public function getClass ($o) {
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:44: lines 44-51
		if (is_object($o) && !($o instanceof HxClass) && !($o instanceof HxEnum)) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:45: characters 4-54
			$cls = Boot::getClass(get_class($o));
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:46: characters 11-54
			if ($cls === Boot::getClass(HxAnon::class)) {
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:46: characters 38-42
				return null;
			} else {
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:46: characters 45-53
				return $cls;
			}
		} else if (is_string($o)) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:48: characters 4-22
			return Boot::getClass('String');
		} else {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:50: characters 4-15
			return null;
		}
	}

	/**
	 * @param Class $c
	 * 
	 * @return string
	 */
	static public function getClassName ($c) {
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:67: characters 3-28
		if ($c === null) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:67: characters 17-28
			return null;
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:68: characters 3-34
		return Boot::getHaxeName($c);
	}

	/**
	 * @param Class $c
	 * 
	 * @return \Array_hx
	 */
	static public function getInstanceFields ($c) {
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:169: characters 3-29
		if ($c === null) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:169: characters 18-29
			return null;
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:170: lines 170-176
		if ($c === Boot::getClass('String')) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:171: lines 171-175
			return \Array_hx::wrap([
				"substr",
				"charAt",
				"charCodeAt",
				"indexOf",
				"lastIndexOf",
				"split",
				"toLowerCase",
				"toUpperCase",
				"toString",
				"length",
			]);
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:178: characters 3-67
		$reflection = new \ReflectionClass($c->phpClassName);
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:180: characters 17-34
		$this1 = [];
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:180: characters 3-35
		$methods = $this1;
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:181: characters 13-36
		$_g_arr = $reflection->getMethods();
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:181: characters 13-36
		$_g_hasMore = reset($_g_arr) !== false;
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:181: lines 181-189
		while ($_g_hasMore) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:181: lines 181-189
			$result = current($_g_arr);
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:181: lines 181-189
			$_g_hasMore = next($_g_arr) !== false;
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:181: lines 181-189
			$m = $result;
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:182: characters 4-36
			$method = $m;
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:183: lines 183-188
			if (!$method->isStatic()) {
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:184: characters 5-33
				$name = $method->getName();
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:185: lines 185-187
				if (!(($name === "__construct") || (HxString::indexOf($name, "__hx__") === 0))) {
					#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:186: characters 6-30
					array_push($methods, $name);
				}
			}
		}

		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:191: characters 20-37
		$this2 = [];
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:191: characters 3-38
		$properties = $this2;
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:192: characters 13-39
		$_g_arr1 = $reflection->getProperties();
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:192: characters 13-39
		$_g_hasMore1 = reset($_g_arr1) !== false;
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:192: lines 192-200
		while ($_g_hasMore1) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:192: lines 192-200
			$result1 = current($_g_arr1);
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:192: lines 192-200
			$_g_hasMore1 = next($_g_arr1) !== false;
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:192: lines 192-200
			$p = $result1;
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:193: characters 4-40
			$property = $p;
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:194: lines 194-199
			if (!$property->isStatic()) {
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:195: characters 5-35
				$name1 = $property->getName();
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:196: lines 196-198
				if (!(($name1 === "__construct") || (HxString::indexOf($name1, "__hx__") === 0))) {
					#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:197: characters 6-33
					array_push($properties, $name1);
				}
			}
		}

		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:201: characters 3-13
		$properties = array_diff($properties, $methods);
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:203: characters 3-56
		$fields = array_merge($properties, $methods);
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:205: characters 3-44
		return \Array_hx::wrap($fields);
	}

	/**
	 * @param string $name
	 * 
	 * @return Class
	 */
	static public function resolveClass ($name) {
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:76: characters 3-32
		if ($name === null) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:76: characters 21-32
			return null;
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:77: lines 77-85
		switch ($name) {
			case "Bool":
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:81: characters 18-34
				return Boot::getClass('Bool');
				break;
			case "Class":
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:83: characters 18-35
				return Boot::getClass('Class');
				break;
			case "Dynamic":
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:78: characters 20-39
				return Boot::getClass('Dynamic');
				break;
			case "Enum":
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:84: characters 17-33
				return Boot::getClass('Enum');
				break;
			case "Float":
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:80: characters 18-35
				return Boot::getClass('Float');
				break;
			case "Int":
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:79: characters 16-31
				return Boot::getClass('Int');
				break;
			case "String":
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:82: characters 19-32
				return Boot::getClass('String');
				break;
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:87: characters 3-40
		$phpClass = Boot::getPhpName($name);
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:88: characters 3-88
		if (!class_exists($phpClass) && !interface_exists($phpClass)) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:88: characters 77-88
			return null;
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:90: characters 3-41
		$hxClass = Boot::getClass($phpClass);
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:92: characters 3-22
		return $hxClass;
	}

	/**
	 * @param mixed $v
	 * 
	 * @return \ValueType
	 */
	static public function typeof ($v) {
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:246: characters 3-30
		if ($v === null) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:246: characters 18-30
			return \ValueType::TNull();
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:248: lines 248-256
		if (is_object($v)) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:249: characters 4-47
			if (($v instanceof \Closure) || ($v instanceof HxClosure)) {
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:249: characters 31-47
				return \ValueType::TFunction();
			}
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:250: characters 4-43
			if (($v instanceof \StdClass)) {
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:250: characters 29-43
				return \ValueType::TObject();
			}
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:251: characters 4-39
			if (($v instanceof HxClass)) {
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:251: characters 25-39
				return \ValueType::TObject();
			}
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:253: characters 4-53
			$hxClass = Boot::getClass(get_class($v));
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:254: characters 4-55
			if (($v instanceof HxEnum)) {
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:254: characters 29-55
				return \ValueType::TEnum($hxClass);
			}
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:255: characters 4-31
			return \ValueType::TClass($hxClass);
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:258: characters 3-32
		if (is_bool($v)) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:258: characters 20-32
			return \ValueType::TBool();
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:259: characters 3-30
		if (is_int($v)) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:259: characters 19-30
			return \ValueType::TInt();
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:260: characters 3-34
		if (is_float($v)) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:260: characters 21-34
			return \ValueType::TFloat();
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:261: characters 3-43
		if (is_string($v)) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:261: characters 22-43
			return \ValueType::TClass(Boot::getClass('String'));
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:263: characters 3-18
		return \ValueType::TUnknown();
	}
}

Boot::registerClass(Type::class, 'Type');
