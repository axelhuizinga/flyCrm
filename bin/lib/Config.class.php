<?php
require_once dirname(__FILE__).'/php/Services_JSON.extern.php';

class Config {
	public function __construct(){}
	static function load($cjs) {
		$js = file_get_contents($cjs);
		$vars = _hx_explode("var", $js);
		$vars->shift();
		$result = new haxe_ds_StringMap();
		haxe_Log::trace($vars->length, _hx_anonymous(array("fileName" => "Config.hx", "lineNumber" => 20, "className" => "Config", "methodName" => "load")));
		$jsonS = new Services_JSON(48);
		{
			$_g = 0;
			while($_g < $vars->length) {
				$v = $vars[$_g];
				++$_g;
				$data = _hx_explode("=", $v);
				$json = $jsonS->decode($data[1]);
				$result->set(trim($data[0]), $json);
				unset($v,$json,$data);
			}
		}
		return $result;
	}
	function __toString() { return 'Config'; }
}
