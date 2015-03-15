<?php

class S {
	public function __construct(){}
	static $debug = true;
	static $headerSent = false;
	static $conf;
	static $my;
	static $user;
	static function main() {
		haxe_Log::$trace = (isset(me_cunity_php_Debug::$_trace) ? me_cunity_php_Debug::$_trace: array("me_cunity_php_Debug", "_trace"));
		S::$conf = Config::load("appData.js");
		php_Session::start();
		$pd = php_Web::getPostData();
		$params = php_Web::getParams();
		if($params->get("debug") === "1") {
			header("Content-Type" . ": " . "text/html; charset=utf-8");
			S::$headerSent = true;
			php_Lib::println("<div><pre>");
			php_Lib::println($params);
		}
		haxe_Log::trace($params, _hx_anonymous(array("fileName" => "S.hx", "lineNumber" => 52, "className" => "S", "methodName" => "main")));
		$action = $params->get("action");
		if(strlen($action) === 0 || $params->get("className") === null) {
			S::dump(_hx_anonymous(array("error" => "required params missing")));
			return;
		}
		S::$my = new MySQLi("localhost", php_DBConfig::$user, php_DBConfig::$pass, php_DBConfig::$db, null, null);
		$auth = S::checkAuth();
		haxe_Log::trace(_hx_string_or_null($action) . ":" . Std::string($auth), _hx_anonymous(array("fileName" => "S.hx", "lineNumber" => 65, "className" => "S", "methodName" => "main")));
		if(!$auth) {
			S::hexit("AUTH FAILURE");
			return;
		}
		$result = Model::dispatch($params);
		haxe_Log::trace($result, _hx_anonymous(array("fileName" => "S.hx", "lineNumber" => 73, "className" => "S", "methodName" => "main")));
		if(!S::$headerSent) {
			header("Content-Type" . ": " . "application/json");
			S::$headerSent = true;
		}
		php_Lib::println($result);
	}
	static function checkAuth() {
		S::$user = php_Session::get("PHP_AUTH_USER");
		if(S::$user === null) {
			return false;
		}
		haxe_Log::trace(S::$user, _hx_anonymous(array("fileName" => "S.hx", "lineNumber" => 88, "className" => "S", "methodName" => "checkAuth")));
		$pass = php_Session::get("PHP_AUTH_PW");
		if($pass === null) {
			return false;
		}
		haxe_Log::trace($pass, _hx_anonymous(array("fileName" => "S.hx", "lineNumber" => 92, "className" => "S", "methodName" => "checkAuth")));
		$res = php_Lib::hashOfAssociativeArray(_hx_deref(new Model())->query("SELECT use_non_latin,webroot_writable,pass_hash_enabled,pass_key,pass_cost,hosted_settings FROM system_settings"));
		if(S_0($pass, $res) === "1") {
			S::hexit("ENCRYPTED PASSWORDS NOT IMPLEMENTED");
		}
		$res = php_Lib::hashOfAssociativeArray(_hx_deref(new Model())->query("SELECT count(*) AS cnt FROM vicidial_users WHERE user=\"" . _hx_string_or_null(S::$user) . "\" and pass=\"" . _hx_string_or_null($pass) . "\" and user_level > 7 and active=\"Y\""));
		return $res->exists("0") && S_1($pass, $res) === "1";
	}
	static function hexit($d) {
		if(!S::$headerSent) {
			header("Content-Type" . ": " . "application/json");
			S::$headerSent = true;
		}
		$exitValue = json_encode(_hx_anonymous(array("ERROR" => $d)));
		return exit($exitValue);
	}
	static function dump($d) {
		if(!S::$headerSent) {
			header("Content-Type" . ": " . "application/json");
			S::$headerSent = true;
		}
		php_Lib::println(haxe_Json::phpJsonEncode($d, null, null));
	}
	function __toString() { return 'S'; }
}
{
	require_once("/srv/www/htdocs/flyCRM/php/functions.php");
	me_cunity_php_Debug::$logFile = $appLog;
}
function S_0(&$pass, &$res) {
	{
		$this1 = php_Lib::hashOfAssociativeArray($res->get("0"));
		return $this1->get("pass_hash_enabled");
	}
}
function S_1(&$pass, &$res) {
	{
		$this2 = php_Lib::hashOfAssociativeArray($res->get("0"));
		return $this2->get("cnt");
	}
}
