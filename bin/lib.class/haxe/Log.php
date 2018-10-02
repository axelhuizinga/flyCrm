<?php
/**
 * Generated by Haxe 4.0.0-preview.4+1e3e5e016
 */

namespace haxe;

use \php\Boot;

class Log {
	/**
	 * @var \Closure
	 */
	static public $trace;

	/**
	 * @param mixed $v
	 * @param object $infos
	 * 
	 * @return string
	 */
	static public function formatOutput ($v, $infos) {
		#C:\HaxeToolkit\haxe\std/haxe/Log.hx:34: characters 3-27
		$str = \Std::string($v);
		#C:\HaxeToolkit\haxe\std/haxe/Log.hx:35: lines 35-36
		if ($infos === null) {
			#C:\HaxeToolkit\haxe\std/haxe/Log.hx:36: characters 4-14
			return $str;
		}
		#C:\HaxeToolkit\haxe\std/haxe/Log.hx:37: characters 3-54
		$pstr = ($infos->fileName??'null') . ":" . ($infos->lineNumber??'null');
		#C:\HaxeToolkit\haxe\std/haxe/Log.hx:38: characters 3-111
		if (($infos !== null) && ($infos->customParams !== null)) {
			#C:\HaxeToolkit\haxe\std/haxe/Log.hx:38: characters 53-111
			$_g = 0;
			#C:\HaxeToolkit\haxe\std/haxe/Log.hx:38: characters 53-111
			$_g1 = $infos->customParams;
			#C:\HaxeToolkit\haxe\std/haxe/Log.hx:38: characters 53-111
			while ($_g < $_g1->length) {
				#C:\HaxeToolkit\haxe\std/haxe/Log.hx:38: characters 58-59
				$v1 = ($_g1->arr[$_g] ?? null);
				#C:\HaxeToolkit\haxe\std/haxe/Log.hx:38: characters 53-111
				$_g = $_g + 1;
				#C:\HaxeToolkit\haxe\std/haxe/Log.hx:38: characters 84-111
				$str = ($str??'null') . ((", " . (\Std::string($v1)??'null'))??'null');
			}
		}
		#C:\HaxeToolkit\haxe\std/haxe/Log.hx:39: characters 3-23
		return ($pstr??'null') . ": " . ($str??'null');
	}

	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


		self::$trace = function ($v, $infos = null) {
			#C:\HaxeToolkit\haxe\std/haxe/Log.hx:61: characters 3-35
			$str = Log::formatOutput($v, $infos);
			#C:\HaxeToolkit\haxe\std/haxe/Log.hx:68: characters 3-19
			echo((\Std::string($str)??'null') . "\x0A");
		};
	}
}

Boot::registerClass(Log::class, 'haxe.Log');
Log::__hx__init();
