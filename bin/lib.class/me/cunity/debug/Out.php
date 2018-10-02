<?php
/**
 * Generated by Haxe 4.0.0-preview.4+1e3e5e016
 */

namespace me\cunity\debug;

use \php\_Boot\HxClosure;
use \php\Boot;
use \php\_Boot\HxException;
use \sys\Http;
use \haxe\Log;
use \haxe\StackItem;
use \sys\io\File;
use \haxe\CallStack;
use \php\_Boot\HxAnon;
use \sys\io\FileOutput;

class Out {
	/**
	 * @var \Closure
	 */
	static public $aStack;
	/**
	 * @var \Array_hx
	 */
	static public $dumpedObjects;
	/**
	 * @var FileOutput
	 */
	static public $log;
	/**
	 * @var Tracer
	 */
	static public $logg;
	/**
	 * @var bool
	 */
	static public $once = false;
	/**
	 * @var \Array_hx
	 */
	static public $skipFields;
	/**
	 * @var bool
	 */
	static public $skipFunctions = true;
	/**
	 * @var bool
	 */
	static public $suspended = false;
	/**
	 * @var DebugOutput
	 */
	static public $traceTarget;
	/**
	 * @var bool
	 */
	static public $traceToConsole = false;

	/**
	 * @param mixed $v
	 * @param object $i
	 * 
	 * @return void
	 */
	static public function _trace ($v, $i = null) {
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:104: lines 104-105
		if (Out::$suspended) {
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:105: characters 4-10
			return;
		}
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:106: characters 3-22
		$warned = false;
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:107: lines 107-109
		if (($i !== null) && \Reflect::hasField($i, "customParams")) {
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:108: characters 4-25
			$i = ($i->customParams->arr[0] ?? null);
		}
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:111: characters 3-87
		$msg = ($i !== null ? ($i->fileName??'null') . ":" . ($i->methodName??'null') . ":" . ($i->lineNumber??'null') . ":" : "");
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:112: characters 3-11
		$msg = ($msg??'null') . (\Std::string($v)??'null');
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:115: lines 115-129
		if (Out::$log !== null) {
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:116: characters 4-29
			Out::$log->writeString(($msg??'null') . "\x0A");
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:117: characters 4-15
			Out::$log->flush();
		} else {
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:120: characters 10-21
			$_g = Out::$traceTarget;
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:120: characters 10-21
			switch ($_g->index) {
				case 0:
					#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:125: characters 5-28
					echo(\Std::string(($msg??'null') . "\x0D\x0A"));
					break;
				case 1:
					#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:127: characters 5-57
					echo(\Std::string((htmlspecialchars($msg, (null ? ENT_QUOTES | ENT_HTML401 : ENT_NOQUOTES))??'null') . "<br/>"));
					break;
				case 2:
					#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:123: characters 13-39
					error_log($msg);
					break;
				case 3:
										break;
			}
		}
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:131: lines 131-136
		if (Out::$once) {
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:133: characters 4-16
			Out::$once = false;
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:134: characters 4-33
			Out::_trace("i:" . (\Std::string(\Type::typeof($i))??'null'), new HxAnon([
				"fileName" => "me/cunity/debug/Out.hx",
				"lineNumber" => 134,
				"className" => "me.cunity.debug.Out",
				"methodName" => "_trace",
			]));
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:135: characters 4-17
			Out::dumpObject($i, new HxAnon([
				"fileName" => "me/cunity/debug/Out.hx",
				"lineNumber" => 135,
				"className" => "me.cunity.debug.Out",
				"methodName" => "_trace",
			]));
		}
	}

	/**
	 * @param mixed $ob
	 * @param object $i
	 * 
	 * @return void
	 */
	static public function dumpObject ($ob, $i = null) {
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:354: characters 3-34
		$tClass = \Type::getClass($ob);
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:355: characters 3-79
		$m = "dumpObject:" . (\Std::string(($ob !== null ? \Type::getClass($ob) : $ob))??'null') . "\x0A";
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:356: characters 3-41
		$names = new \Array_hx();
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:359: characters 4-45
		$names = (\Type::getClass($ob) !== null ? \Type::getInstanceFields(\Type::getClass($ob)) : \Reflect::fields($ob));
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:361: lines 361-363
		if (\Type::getClass($ob) !== null) {
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:363: characters 4-51
			$m = (\Type::getClassName(\Type::getClass($ob))??'null') . ":\x0A";
		}
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:365: lines 365-380
		$_g = 0;
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:365: lines 365-380
		while ($_g < $names->length) {
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:365: characters 9-13
			$name = ($names->arr[$_g] ?? null);
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:365: lines 365-380
			$_g = $_g + 1;
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:366: lines 366-370
			if (\Lambda::has(Out::$skipFields, $name)) {
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:368: characters 6-28
				$m = ($m??'null') . (("" . ($name??'null') . ":skipped\x0A")??'null');
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:369: characters 6-14
				continue;
			}
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:371: lines 371-379
			try {
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:372: characters 6-63
				$t = \Std::string(\Type::typeof(\Reflect::field($ob, $name)));
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:373: characters 11-44
				$tmp = Out::$skipFunctions && ($t === "TFunction");
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:375: characters 6-62
				$m = ($m??'null') . ((($name??'null') . ":" . (\Std::string(\Reflect::field($ob, $name))??'null') . ":" . ($t??'null') . "\x0A")??'null');
			} catch (\Throwable $__hx__caught_e) {
				$__hx__real_e = ($__hx__caught_e instanceof HxException ? $__hx__caught_e->e : $__hx__caught_e);
				$ex = $__hx__real_e;
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:378: characters 6-26
				$m = ($m??'null') . ((($name??'null') . ":" . (\Std::string($ex)??'null'))??'null');
			}
		}

		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:385: characters 3-15
		Out::_trace($m, $i);
	}

	/**
	 * @param \Array_hx $sA
	 * @param object $i
	 * 
	 * @return void
	 */
	static public function dumpStack ($sA, $i = null) {
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:420: characters 3-37
		$b = new \StringBuf();
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:421: characters 3-66
		$b->add("StackDump:" . ($sA->length??'null') . "<br/>");
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:422: lines 422-426
		$_g = 0;
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:422: lines 422-426
		while ($_g < $sA->length) {
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:422: characters 8-12
			$item = ($sA->arr[$_g] ?? null);
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:422: lines 422-426
			$_g = $_g + 1;
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:424: characters 4-25
			Out::itemToString($item, $b);
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:425: characters 4-40
			$b->add("<br/>");
		}

		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:429: characters 3-8
		(Log::$trace)($b->b, new HxAnon([
			"fileName" => "me/cunity/debug/Out.hx",
			"lineNumber" => 429,
			"className" => "me.cunity.debug.Out",
			"methodName" => "dumpStack",
			"customParams" => \Array_hx::wrap([$i]),
		]));
	}

	/**
	 * @param mixed $v
	 * @param object $i
	 * 
	 * @return void
	 */
	static public function dumpVar ($v, $i = null) {
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:342: lines 342-346
		
			ob_start();
			print_r($v);
			$ret =  ob_get_clean();
		;
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:347: characters 3-22
		Out::_trace(ret, new HxAnon([
			"fileName" => "me/cunity/debug/Out.hx",
			"lineNumber" => 347,
			"className" => "me.cunity.debug.Out",
			"methodName" => "dumpVar",
		]));
	}

	/**
	 * @param string $str
	 * @param \Array_hx $arr
	 * @param object $i
	 * 
	 * @return void
	 */
	static public function fTrace ($str, $arr, $i = null) {
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:478: characters 3-34
		$str_arr = \Array_hx::wrap(explode(" @", $str));
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:479: characters 3-44
		$str_buf = new \StringBuf();
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:481: lines 481-485
		$_g1 = 0;
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:481: lines 481-485
		$_g = $str_arr->length;
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:481: lines 481-485
		while ($_g1 < $_g) {
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:481: lines 481-485
			$_g1 = $_g1 + 1;
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:481: characters 8-9
			$i1 = $_g1 - 1;
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:482: characters 4-30
			$str_buf->add(($str_arr->arr[$i1] ?? null));
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:483: lines 483-484
			if (($arr->arr[$i1] ?? null) !== null) {
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:484: characters 4-26
				$str_buf->add(($arr->arr[$i1] ?? null));
			}
		}

		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:486: characters 3-33
		Out::_trace($str_buf->b, $i);
	}

	/**
	 * @return void
	 */
	static public function init () {
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:69: characters 3-34
		File::saveContent("log.txt", "");
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:70: characters 3-36
		Out::$log = File::write("log.txt", true);
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:71: characters 3-14
		Out::$log->flush();
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:72: characters 3-25
		Log::$trace = new HxClosure(Out::class, '_trace');
	}

	/**
	 * @param StackItem $s
	 * @param \StringBuf $b
	 * 
	 * @return void
	 */
	static public function itemToString ($s, $b) {
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:434: lines 434-459
		switch ($s->index) {
			case 0:
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:436: characters 4-25
				$b->add("a C function");
				break;
			case 1:
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:439: characters 15-16
				$m = $s->params[0];
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:440: characters 4-20
				$b->add("module ");
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:441: characters 4-12
				$b->add($m);

				break;
			case 2:
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:442: characters 23-27
				$line = $s->params[2];
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:442: characters 18-22
				$file = $s->params[1];
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:442: characters 16-17
				$s1 = $s->params[0];
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:443: lines 443-446
				if ($s1 !== null) {
					#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:444: characters 5-23
					Out::itemToString($s1, $b);
					#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:445: characters 5-16
					$b->add(" (");
				}
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:447: characters 4-15
				$b->add($file);
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:448: characters 4-19
				$b->add(" line ");
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:449: characters 4-15
				$b->add($line);
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:450: characters 4-59
				if ($s1 !== null) {
					#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:450: characters 20-59
					$b->add(")<br/>");
				}

				break;
			case 3:
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:451: characters 21-25
				$meth = $s->params[1];
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:451: characters 15-20
				$cname = $s->params[0];
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:452: characters 4-16
				$b->add($cname);
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:453: characters 4-14
				$b->add(".");
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:454: characters 4-15
				$b->add($meth);
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:455: characters 4-41
				$b->add("<br/>");

				break;
			case 4:
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:437: characters 22-23
				$v = $s->params[0];
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:438: characters 4-31
				$b->add("LocalFunction:" . ($v??'null'));
				break;
		}
	}

	/**
	 * @param mixed $v
	 * @param object $i
	 * 
	 * @return void
	 */
	static public function log2 ($v, $i = null) {
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:196: characters 3-93
		$msg = ($i !== null ? ($i->fileName??'null') . ":" . ($i->lineNumber??'null') . ":" . ($i->methodName??'null') . ":" : "");
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:197: characters 3-23
		$msg = ($msg??'null') . (\Std::string($v)??'null');
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:198: characters 3-68
		$http = new Http("http://localhost/devel/php/jsLog.php");
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:199: characters 3-32
		$http->setParameter("log", $msg);
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:203: characters 3-66
		$http->onData = function ($data) {
			#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:203: characters 34-63
			if ($data !== "OK") {
				#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:203: characters 52-57
				(Log::$trace)($data, new HxAnon([
					"fileName" => "me/cunity/debug/Out.hx",
					"lineNumber" => 203,
					"className" => "me.cunity.debug.Out",
					"methodName" => "log2",
				]));
			}
		};
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:204: characters 3-21
		$http->request(true);
	}

	/**
	 * @param string $data
	 * @param object $i
	 * 
	 * @return void
	 */
	static public function printCDATA ($data, $i = null) {
		#//AXEL-PC/cunity_lib/me/cunity/debug/Out.hx:337: characters 3-78
		Out::_trace("<pre>" . (((htmlspecialchars ($data)??'null') . "</pre>")??'null'), $i);
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


		self::$skipFields = new \Array_hx();
		self::$traceTarget = DebugOutput::NATIVE();
		self::$aStack = new HxClosure(CallStack::class, 'callStack');
	}
}

Boot::registerClass(Out::class, 'me.cunity.debug.Out');
Out::__hx__init();
