<?php
/**
 * Generated by Haxe 3.4.0
 */

namespace model;

use \haxe\ds\StringMap;
use \php\Boot;
use \haxe\Log;
use \php\_Boot\HxString;
use \php\_Boot\HxAnon;

class Select extends Input {
	/**
	 * @param StringMap $param
	 * 
	 * @return mixed
	 */
	static public function create ($param) {
		$self = new Select();
		(Log::$trace)($param, new HxAnon([
			"fileName" => "Select.hx",
			"lineNumber" => 16,
			"className" => "model.Select",
			"methodName" => "create",
		]));
		return \Reflect::callMethod($self, \Reflect::field($self, ($param->data["action"] ?? null)), \Array_hx::wrap([$param]));
	}


	/**
	 * @return void
	 */
	public function __construct () {
		parent::__construct();
	}


	/**
	 * @param string $where
	 * 
	 * @return string
	 */
	public function prepare ($where) {
		$wParam = HxString::split($where, ",");
		$where = "";
		if (\Lambda::has($wParam, "filter=1")) {
			$wParam = $wParam->filter(function ($f) {
				return $f !== "filter=1";
			});
		}
		$tmp = null;
		if ($wParam->length > 0) {
			$tmp = true;
		} else {
			$tmp = false;
		}
		if ($tmp) {
			$where = "";
		}
		$_g = 0;
		while ($_g < $wParam->length) {
			unset($w);
			$w = ($wParam->arr[$_g] ?? null);
			$_g = $_g + 1;
			if ($where === "") {
				$where = "WHERE " . ($w??'null');
			} else {
				$where = " AND " . ($w??'null');
			}
		}

		(Log::$trace)($where, new HxAnon([
			"fileName" => "Select.hx",
			"lineNumber" => 62,
			"className" => "model.Select",
			"methodName" => "prepare",
		]));
		return $where;
	}


	/**
	 * @param StringMap $param
	 * 
	 * @return mixed
	 */
	public function selectCampaign ($param) {
		return $this->json_encode();
	}
}


Boot::registerClass(Select::class, 'model.Select');
