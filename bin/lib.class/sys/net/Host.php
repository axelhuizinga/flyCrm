<?php
/**
 * Generated by Haxe 4.0.0-preview.4+1e3e5e016
 */

namespace sys\net;

use \php\Boot;

class Host {
	/**
	 * @var string
	 */
	public $_ip;
	/**
	 * @var string
	 */
	public $host;
	/**
	 * @var int
	 */
	public $ip;

	/**
	 * @param string $name
	 * 
	 * @return void
	 */
	public function __construct ($name) {
		#C:\HaxeToolkit\haxe\std/php/_std/sys/net/Host.hx:36: characters 3-14
		$this->host = $name;
		#C:\HaxeToolkit\haxe\std/php/_std/sys/net/Host.hx:37: lines 37-45
		if ((new \EReg("^(\\d{1,3}\\.){3}\\d{1,3}\$", ""))->match($name)) {
			#C:\HaxeToolkit\haxe\std/php/_std/sys/net/Host.hx:38: characters 5-15
			$this->_ip = $name;
		} else {
			#C:\HaxeToolkit\haxe\std/php/_std/sys/net/Host.hx:40: characters 4-29
			$this->_ip = gethostbyname($name);
			#C:\HaxeToolkit\haxe\std/php/_std/sys/net/Host.hx:41: lines 41-44
			if ($this->_ip === $name) {
				#C:\HaxeToolkit\haxe\std/php/_std/sys/net/Host.hx:42: characters 5-11
				$this->ip = 0;
				#C:\HaxeToolkit\haxe\std/php/_std/sys/net/Host.hx:43: characters 5-11
				return;
			}
		}
		#C:\HaxeToolkit\haxe\std/php/_std/sys/net/Host.hx:46: characters 11-25
		$_this = $this->_ip;
		#C:\HaxeToolkit\haxe\std/php/_std/sys/net/Host.hx:46: characters 3-26
		$p = \Array_hx::wrap(explode(".", $_this));
		#C:\HaxeToolkit\haxe\std/php/_std/sys/net/Host.hx:47: characters 3-71
		$this->ip = intval(sprintf("%02X%02X%02X%02X", ($p->arr[3] ?? null), ($p->arr[2] ?? null), ($p->arr[1] ?? null), ($p->arr[0] ?? null)), 16);
	}
}

Boot::registerClass(Host::class, 'sys.net.Host');
