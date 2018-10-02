<?php
/**
 * Generated by Haxe 4.0.0-preview.4+1e3e5e016
 */

namespace php\_Boot;

use \php\Boot;

class HxEnum {
	/**
	 * @var int
	 */
	public $index;
	/**
	 * @var mixed
	 */
	public $params;
	/**
	 * @var string
	 */
	public $tag;

	/**
	 * @param string $tag
	 * @param int $index
	 * @param mixed $arguments
	 * 
	 * @return void
	 */
	public function __construct ($tag, $index, $arguments = null) {
		#C:\HaxeToolkit\haxe\std/php/Boot.hx:594: characters 3-17
		$this->tag = $tag;
		#C:\HaxeToolkit\haxe\std/php/Boot.hx:595: characters 3-21
		$this->index = $index;
		#C:\HaxeToolkit\haxe\std/php/Boot.hx:596: characters 12-63
		$tmp = null;
		#C:\HaxeToolkit\haxe\std/php/Boot.hx:596: characters 12-63
		if ($arguments === null) {
			#C:\HaxeToolkit\haxe\std/php/Boot.hx:596: characters 33-50
			$this1 = [];
			#C:\HaxeToolkit\haxe\std/php/Boot.hx:596: characters 12-63
			$tmp = $this1;
		} else {
			#C:\HaxeToolkit\haxe\std/php/Boot.hx:596: characters 12-63
			$tmp = $arguments;
		}
		#C:\HaxeToolkit\haxe\std/php/Boot.hx:596: characters 3-63
		$this->params = $tmp;
	}

	/**
	 * @return string
	 */
	public function __toString () {
		#C:\HaxeToolkit\haxe\std/php/Boot.hx:611: characters 3-20
		$result = $this->tag;
		#C:\HaxeToolkit\haxe\std/php/Boot.hx:612: lines 612-615
		if (count($this->params) > 0) {
			#C:\HaxeToolkit\haxe\std/php/Boot.hx:613: characters 4-88
			$strings = array_map(function ($item) {
				#C:\HaxeToolkit\haxe\std/php/Boot.hx:613: characters 51-78
				return Boot::stringify($item);
			}, $this->params);
			#C:\HaxeToolkit\haxe\std/php/Boot.hx:614: characters 4-54
			$result = ($result??'null') . (("(" . (implode(",", $strings)??'null') . ")")??'null');
		}
		#C:\HaxeToolkit\haxe\std/php/Boot.hx:616: characters 3-16
		return $result;
	}

	/**
	 * @return string
	 */
	public function toString () {
		#C:\HaxeToolkit\haxe\std/php/Boot.hx:603: characters 3-22
		return $this->__toString();
	}
}

Boot::registerClass(HxEnum::class, 'php._Boot.HxEnum');
