<?php

class model_Select extends model_Input {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function selectCampaign($param) {
		return $this->json_encode();
	}
	public function prepare($where) {
		$wParam = _hx_explode(",", $where);
		$where = "";
		if(Lambda::has($wParam, "filter=1")) {
			$wParam = $wParam->filter(array(new _hx_lambda(array(&$wParam, &$where), "model_Select_0"), 'execute'));
		}
		if($wParam->length > 0 && $where === "") {
			$where = "";
		}
		{
			$_g = 0;
			while($_g < $wParam->length) {
				$w = $wParam[$_g];
				++$_g;
				if($where === "") {
					$where = "WHERE " . _hx_string_or_null($w);
				} else {
					$where = " AND " . _hx_string_or_null($w);
				}
				unset($w);
			}
		}
		return $where;
	}
	static function create($param) {
		$self = new model_Select();
		haxe_Log::trace($param, _hx_anonymous(array("fileName" => "Select.hx", "lineNumber" => 16, "className" => "model.Select", "methodName" => "create")));
		return Reflect::callMethod($self, Reflect::field($self, $param->get("action")), (new _hx_array(array($param))));
	}
	function __toString() { return 'model.Select'; }
}
function model_Select_0(&$wParam, &$where, $f) {
	{
		return $f !== "filter=1";
	}
}
