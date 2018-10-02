<?php
/**
 * Generated by Haxe 4.0.0-preview.4+1e3e5e016
 */

namespace model;

use \haxe\ds\StringMap;
use \php\Boot;
use \php\_Boot\HxDynamicStr;
use \haxe\Log;
use \php\_Boot\HxString;
use \php\_Boot\HxAnon;

class ClientHistory extends Clients {
	/**
	 * @var \Array_hx
	 */
	static public $clients_fields;
	/**
	 * @var StringMap
	 */
	static public $custom_fields_map;
	/**
	 * @var \Array_hx
	 */
	static public $pay_plan_fields;
	/**
	 * @var \Array_hx
	 */
	static public $pay_source_fields;
	/**
	 * @var \Array_hx
	 */
	static public $vicdial_list_fields;

	/**
	 * @param StringMap $param
	 * 
	 * @return mixed
	 */
	static public function create ($param) {
		#src/model/ClientHistory.hx:113: characters 3-47
		$self = new ClientHistory($param);
		#src/model/ClientHistory.hx:114: characters 3-31
		$self->table = "vicidial_list";
		#src/model/ClientHistory.hx:116: characters 3-84
		return \Reflect::callMethod($self, \Reflect::field($self, ($param->data["action"] ?? null)), \Array_hx::wrap([$param]));
	}

	/**
	 * @param StringMap $param
	 * 
	 * @return void
	 */
	public function __construct ($param = null) {
		#src/model/ClientHistory.hx:17: lines 17-244
		parent::__construct($param);
	}

	/**
	 * @param \Array_hx $where
	 * @param \Array_hx $phValues
	 * 
	 * @return string
	 */
	public function addCond ($where, $phValues) {
		#src/model/ClientHistory.hx:33: lines 33-34
		if ($where->length === 0) {
			#src/model/ClientHistory.hx:34: characters 4-13
			return "";
		}
		#src/model/ClientHistory.hx:35: characters 3-38
		$sb = new \StringBuf();
		#src/model/ClientHistory.hx:39: characters 3-25
		$first = true;
		#src/model/ClientHistory.hx:40: lines 40-107
		$_g = 0;
		#src/model/ClientHistory.hx:40: lines 40-107
		while ($_g < $where->length) {
			#src/model/ClientHistory.hx:40: characters 8-9
			$w = ($where->arr[$_g] ?? null);
			#src/model/ClientHistory.hx:40: lines 40-107
			$_g = $_g + 1;
			#src/model/ClientHistory.hx:43: characters 4-43
			$wData = HxDynamicStr::wrap($w)->split("|");
			#src/model/ClientHistory.hx:44: characters 4-46
			$values = $wData->slice(2);
			#src/model/ClientHistory.hx:46: characters 4-43
			$filter_tables = null;
			#src/model/ClientHistory.hx:47: characters 8-98
			$tmp = null;
			#src/model/ClientHistory.hx:47: characters 8-24
			$v = $this->param;
			#src/model/ClientHistory.hx:47: characters 8-98
			if (($v !== null) && !Boot::equal($v, 0) && ($v !== "") && array_key_exists("filter_tables", $this->param->data)) {
				#src/model/ClientHistory.hx:47: characters 61-98
				$v1 = ($this->param->data["filter_tables"] ?? null);
				#src/model/ClientHistory.hx:47: characters 8-98
				$tmp = ($v1 !== null) && !Boot::equal($v1, 0) && ($v1 !== "");
			} else {
				#src/model/ClientHistory.hx:47: characters 8-98
				$tmp = false;
			}
			#src/model/ClientHistory.hx:47: lines 47-51
			if ($tmp) {
				#src/model/ClientHistory.hx:49: characters 5-48
				$jt = ($this->param->data["filter_tables"] ?? null);
				#src/model/ClientHistory.hx:50: characters 5-34
				$filter_tables = \Array_hx::wrap(explode(",", $jt));
			}
			#src/model/ClientHistory.hx:53: characters 4-9
			(Log::$trace)((\Std::string($wData)??'null') . ":" . ($this->joinTable??'null') . ":" . (\Std::string($filter_tables)??'null'), new HxAnon([
				"fileName" => "src/model/ClientHistory.hx",
				"lineNumber" => 53,
				"className" => "model.ClientHistory",
				"methodName" => "addCond",
			]));
			#src/model/ClientHistory.hx:54: characters 8-83
			$tmp1 = null;
			#src/model/ClientHistory.hx:54: characters 8-83
			if ((new \EReg("^pay_[a-zA-Z_]+\\.", ""))->match(($wData->arr[0] ?? null))) {
				#src/model/ClientHistory.hx:54: characters 48-67
				$_this = ($wData->arr[0] ?? null);
				#src/model/ClientHistory.hx:54: characters 8-83
				$tmp1 = (\Array_hx::wrap(explode(".", $_this))->arr[0] ?? null) !== $this->joinTable;
			} else {
				#src/model/ClientHistory.hx:54: characters 8-83
				$tmp1 = false;
			}
			#src/model/ClientHistory.hx:54: lines 54-57
			if ($tmp1) {
				#src/model/ClientHistory.hx:56: characters 5-13
				continue;
			}
			#src/model/ClientHistory.hx:59: lines 59-65
			if ($first) {
				#src/model/ClientHistory.hx:61: characters 5-22
				$sb->add(" WHERE ");
				#src/model/ClientHistory.hx:62: characters 5-18
				$first = false;
			} else {
				#src/model/ClientHistory.hx:65: characters 5-20
				$sb->add(" AND ");
			}
			#src/model/ClientHistory.hx:67: characters 11-33
			$_g1 = strtoupper(($wData->arr[1] ?? null));
			#src/model/ClientHistory.hx:67: characters 11-33
			switch ($_g1) {
				case "BETWEEN":
					#src/model/ClientHistory.hx:70: lines 70-71
					if (($values->length !== 2) && \Lambda::foreach($values, function ($s) {
						#src/model/ClientHistory.hx:70: characters 76-88
						$v2 = $s;
						#src/model/ClientHistory.hx:70: characters 76-88
						if (($v2 !== null) && !Boot::equal($v2, 0)) {
							#src/model/ClientHistory.hx:70: characters 76-88
							return $v2 !== "";
						} else {
							#src/model/ClientHistory.hx:70: characters 76-88
							return false;
						}
					})) {
						#src/model/ClientHistory.hx:71: characters 7-71
						\S::exit("BETWEEN needs 2 values - got only:" . ($values->join(",")??'null'));
					}
					#src/model/ClientHistory.hx:72: characters 6-34
					$sb->add($this->quoteField(($wData->arr[0] ?? null)));
					#src/model/ClientHistory.hx:73: characters 6-32
					$sb->add(" BETWEEN ? AND ?");
					#src/model/ClientHistory.hx:74: characters 6-42
					$phValues->arr[$phValues->length] = \Array_hx::wrap([
						($wData->arr[0] ?? null),
						($values->arr[0] ?? null),
					]);
					#src/model/ClientHistory.hx:74: characters 6-42
					++$phValues->length;

					#src/model/ClientHistory.hx:75: characters 6-42
					$phValues->arr[$phValues->length] = \Array_hx::wrap([
						($wData->arr[0] ?? null),
						($values->arr[1] ?? null),
					]);
					#src/model/ClientHistory.hx:75: characters 6-42
					++$phValues->length;

					break;
				case "IN":
					#src/model/ClientHistory.hx:77: characters 6-34
					$sb->add($this->quoteField(($wData->arr[0] ?? null)));
					#src/model/ClientHistory.hx:78: characters 6-20
					$sb->add(" IN(");
					#src/model/ClientHistory.hx:79: lines 79-82
					$result = [];
					#src/model/ClientHistory.hx:79: lines 79-82
					$_g11 = 0;
					#src/model/ClientHistory.hx:79: lines 79-82
					$_g2 = $values->length;
					#src/model/ClientHistory.hx:79: lines 79-82
					while ($_g11 < $_g2) {
						#src/model/ClientHistory.hx:79: lines 79-82
						$_g11 = $_g11 + 1;
						#src/model/ClientHistory.hx:79: lines 79-82
						$i = $_g11 - 1;
						#src/model/ClientHistory.hx:79: lines 79-82
						$s1 = $values->arr[$i];
						#src/model/ClientHistory.hx:80: characters 22-30
						$wData1 = ($wData->arr[0] ?? null);
						#src/model/ClientHistory.hx:80: characters 32-46
						if ($values->length > 0) {
							#src/model/ClientHistory.hx:80: characters 32-46
							$values->length--;
						}
						#src/model/ClientHistory.hx:80: characters 7-48
						$x = \Array_hx::wrap([
							$wData1,
							array_shift($values->arr),
						]);
						#src/model/ClientHistory.hx:80: characters 7-48
						$phValues->arr[$phValues->length] = $x;
						#src/model/ClientHistory.hx:80: characters 7-48
						++$phValues->length;

						#src/model/ClientHistory.hx:79: lines 79-82
						$result[] = "?";

					}

					#src/model/ClientHistory.hx:79: lines 79-82
					$sb->add(\Array_hx::wrap($result)->join(","));
					#src/model/ClientHistory.hx:83: characters 6-17
					$sb->add(")");
					break;
				case "LIKE":
					#src/model/ClientHistory.hx:85: characters 6-34
					$sb->add($this->quoteField(($wData->arr[0] ?? null)));
					#src/model/ClientHistory.hx:86: characters 6-23
					$sb->add(" LIKE ?");
					#src/model/ClientHistory.hx:87: characters 6-41
					$phValues->arr[$phValues->length] = \Array_hx::wrap([
						($wData->arr[0] ?? null),
						($wData->arr[2] ?? null),
					]);
					#src/model/ClientHistory.hx:87: characters 6-41
					++$phValues->length;

					break;
				default:
					#src/model/ClientHistory.hx:89: characters 6-34
					$sb->add($this->quoteField(($wData->arr[0] ?? null)));
					#src/model/ClientHistory.hx:90: lines 90-98
					if ((new \EReg("^(<|>)", ""))->match(($wData->arr[1] ?? null))) {
						#src/model/ClientHistory.hx:92: characters 7-31
						$eR = new \EReg("^(<|>)", "");
						#src/model/ClientHistory.hx:93: characters 7-25
						$eR->match(($wData->arr[1] ?? null));
						#src/model/ClientHistory.hx:94: characters 7-51
						$val = \Std::parseFloat($eR->matchedRight());
						#src/model/ClientHistory.hx:95: characters 7-34
						$sb->add(($eR->matched(0)??'null') . "?");
						#src/model/ClientHistory.hx:96: characters 7-36
						$phValues->arr[$phValues->length] = \Array_hx::wrap([
							($wData->arr[0] ?? null),
							$val,
						]);
						#src/model/ClientHistory.hx:96: characters 7-36
						++$phValues->length;

						#src/model/ClientHistory.hx:97: characters 7-15
						continue 2;
					}
					#src/model/ClientHistory.hx:100: lines 100-105
					if (($wData->arr[1] ?? null) === "NULL") {
						#src/model/ClientHistory.hx:101: characters 7-25
						$sb->add(" IS NULL");
					} else {
						#src/model/ClientHistory.hx:103: characters 7-21
						$sb->add(" = ?");
						#src/model/ClientHistory.hx:104: characters 7-41
						$phValues->arr[$phValues->length] = \Array_hx::wrap([
							($wData->arr[0] ?? null),
							($wData->arr[1] ?? null),
						]);
						#src/model/ClientHistory.hx:104: characters 7-41
						++$phValues->length;

					}
					break;
			}

		}

		#src/model/ClientHistory.hx:108: characters 3-23
		return $sb->b;
	}

	/**
	 * @param StringMap $param
	 * 
	 * @return mixed
	 */
	public function find ($param) {
		#src/model/ClientHistory.hx:228: characters 3-38
		$sb = new \StringBuf();
		#src/model/ClientHistory.hx:229: characters 3-52
		$phValues = new \Array_hx();
		#src/model/ClientHistory.hx:230: characters 3-8
		(Log::$trace)($param, new HxAnon([
			"fileName" => "src/model/ClientHistory.hx",
			"lineNumber" => 230,
			"className" => "model.ClientHistory",
			"methodName" => "find",
		]));
		#src/model/ClientHistory.hx:231: characters 3-50
		$count = $this->countJoin($param, $sb, $phValues);
		#src/model/ClientHistory.hx:233: characters 3-23
		$sb = new \StringBuf();
		#src/model/ClientHistory.hx:234: characters 3-25
		$phValues = new \Array_hx();
		#src/model/ClientHistory.hx:235: characters 3-8
		(Log::$trace)((($param->data["joincond"] ?? null)??'null') . " count:" . ($count??'null') . ":" . (($param->data["page"] ?? null)??'null') . ": " . (((array_key_exists("page", $param->data) ? "Y" : "N"))??'null'), new HxAnon([
			"fileName" => "src/model/ClientHistory.hx",
			"lineNumber" => 235,
			"className" => "model.ClientHistory",
			"methodName" => "find",
		]));
		#src/model/ClientHistory.hx:238: characters 9-71
		$tmp = (array_key_exists("page", $param->data) ? \Std::parseInt(($param->data["page"] ?? null)) : 1);
		#src/model/ClientHistory.hx:236: lines 236-240
		$this->data = new HxAnon([
			"count" => $count,
			"page" => $tmp,
			"rows" => $this->doJoin($param, $sb, $phValues),
		]);
		#src/model/ClientHistory.hx:241: characters 3-23
		return $this->json_encode();
	}

	/**
	 * @param StringMap $param
	 * @param bool $dataOnly
	 * 
	 * @return mixed
	 */
	public function findClient ($param, $dataOnly = null) {
		#src/model/ClientHistory.hx:122: characters 3-39
		$sql = new \StringBuf();
		#src/model/ClientHistory.hx:123: characters 3-52
		$phValues = new \Array_hx();
		#src/model/ClientHistory.hx:125: characters 3-24
		$cond = "";
		#src/model/ClientHistory.hx:126: characters 3-38
		$limit = ($param->data["limit"] ?? null);
		#src/model/ClientHistory.hx:127: characters 8-24
		$v = $limit;
		#src/model/ClientHistory.hx:127: lines 127-132
		if (!(($v !== null) && !Boot::equal($v, 0) && ($v !== ""))) {
			#src/model/ClientHistory.hx:129: characters 4-46
			$limit = (\S::$conf->data["sql"] ?? null)["LIMIT"];
			#src/model/ClientHistory.hx:130: characters 9-25
			$v1 = $limit;
			#src/model/ClientHistory.hx:130: lines 130-131
			if (!(($v1 !== null) && !Boot::equal($v1, 0) && ($v1 !== ""))) {
				#src/model/ClientHistory.hx:131: characters 5-15
				$limit = 15;
			}
		}
		#src/model/ClientHistory.hx:134: characters 3-30
		$globalCond = "";
		#src/model/ClientHistory.hx:135: characters 3-27
		$reasons = "";
		#src/model/ClientHistory.hx:136: characters 3-41
		$where = ($param->data["where"] ?? null);
		#src/model/ClientHistory.hx:137: lines 137-155
		if (strlen($where) > 0) {
			#src/model/ClientHistory.hx:139: characters 4-48
			$where1 = \Array_hx::wrap(explode(",", $where));
			#src/model/ClientHistory.hx:140: characters 39-106
			$result = [];
			#src/model/ClientHistory.hx:140: characters 39-106
			$_g1 = 0;
			#src/model/ClientHistory.hx:140: characters 39-106
			$_g = $where1->length;
			#src/model/ClientHistory.hx:140: characters 39-106
			while ($_g1 < $_g) {
				#src/model/ClientHistory.hx:140: characters 39-106
				$_g1 = $_g1 + 1;
				#src/model/ClientHistory.hx:140: characters 39-106
				$i = $_g1 - 1;
				#src/model/ClientHistory.hx:140: characters 39-106
				if (!Boot::equal(HxDynamicStr::wrap($where1->arr[$i])->indexOf("reason"), 0)) {
					#src/model/ClientHistory.hx:140: characters 39-106
					$result[] = $where1->arr[$i];
				}
			}

			#src/model/ClientHistory.hx:140: characters 4-107
			$whereElements = \Array_hx::wrap($result);
			#src/model/ClientHistory.hx:143: lines 143-152
			$_g2 = 0;
			#src/model/ClientHistory.hx:143: lines 143-152
			while ($_g2 < $where1->length) {
				#src/model/ClientHistory.hx:143: characters 9-10
				$w = ($where1->arr[$_g2] ?? null);
				#src/model/ClientHistory.hx:143: lines 143-152
				$_g2 = $_g2 + 1;
				#src/model/ClientHistory.hx:145: characters 5-44
				$wData = HxDynamicStr::wrap($w)->split("|");
				#src/model/ClientHistory.hx:146: characters 12-20
				$_g11 = ($wData->arr[0] ?? null);
				#src/model/ClientHistory.hx:146: characters 12-20
				if ($_g11 === "reason") {
					#src/model/ClientHistory.hx:149: characters 6-40
					$reasons = $wData->slice(1)->join(" ");
				}

			}

			#src/model/ClientHistory.hx:153: lines 153-154
			if ($whereElements->length > 0) {
				#src/model/ClientHistory.hx:154: characters 5-50
				$globalCond = $this->addCond($whereElements, $phValues);
			}
		}
		#src/model/ClientHistory.hx:159: characters 3-48
		$sql->add("SELECT SQL_CALC_FOUND_ROWS * FROM(");
		#src/model/ClientHistory.hx:160: characters 3-25
		$first = true;
		#src/model/ClientHistory.hx:162: lines 162-169
		if (HxString::indexOf($reasons, "AC04") > -1) {
			#src/model/ClientHistory.hx:164: lines 164-165
			if ($first) {
				#src/model/ClientHistory.hx:165: characters 5-18
				$first = false;
			}
			#src/model/ClientHistory.hx:166: characters 4-171
			$sql->add("(SELECT d, e AS amount, SUBSTR(j,17,8) AS m_ID, z AS IBAN, \"AC04\" AS reason FROM `konto_auszug` WHERE i LIKE \"%AC04 KONTO AUFGELOEST%\" " . ($cond??'null') . "  LIMIT 0,10000)");
			#src/model/ClientHistory.hx:167: characters 4-21
			$sql->add("UNION ");
			#src/model/ClientHistory.hx:168: characters 4-174
			$sql->add("(SELECT d, e AS amount, SUBSTR(k, 17, 8) AS m_ID, z AS IBAN, \"AC04\" AS reason FROM `konto_auszug` WHERE j LIKE \"%AC04 KONTO AUFGELOEST%\" " . ($cond??'null') . "  LIMIT 0, 10000)");
		}
		#src/model/ClientHistory.hx:171: lines 171-182
		if (HxString::indexOf($reasons, "AC01") > -1) {
			#src/model/ClientHistory.hx:173: lines 173-176
			if ($first) {
				#src/model/ClientHistory.hx:174: characters 5-18
				$first = false;
			} else {
				#src/model/ClientHistory.hx:176: characters 5-22
				$sql->add("UNION ");
			}
			#src/model/ClientHistory.hx:179: characters 4-170
			$sql->add("(SELECT d, e AS amount, SUBSTR(j,17,8) AS m_ID, z AS IBAN, \"AC01\" AS reason FROM `konto_auszug` WHERE i LIKE \"%AC01 IBAN FEHLERHAFT%\" " . ($cond??'null') . "  LIMIT 0,10000)");
			#src/model/ClientHistory.hx:180: characters 4-21
			$sql->add("UNION ");
			#src/model/ClientHistory.hx:181: characters 4-173
			$sql->add("(SELECT d, e AS amount, SUBSTR(k, 17, 8) AS m_ID, z AS IBAN, \"AC01\" AS reason FROM `konto_auszug` WHERE j LIKE \"%AC01 IBAN FEHLERHAFT%\" " . ($cond??'null') . "  LIMIT 0, 10000)");
		}
		#src/model/ClientHistory.hx:184: lines 184-197
		if (HxString::indexOf($reasons, "MD06") > -1) {
			#src/model/ClientHistory.hx:186: lines 186-189
			if ($first) {
				#src/model/ClientHistory.hx:187: characters 5-18
				$first = false;
			} else {
				#src/model/ClientHistory.hx:189: characters 5-22
				$sql->add("UNION ");
			}
			#src/model/ClientHistory.hx:192: lines 192-194
			$sql->add("(SELECT d, e AS amount, SUBSTR(j,17,8) AS m_ID, z AS IBAN, \"MD06\" AS reason FROM `konto_auszug` \x0D\x0A\x09\x09\x09WHERE (i LIKE \"%MD06%\" OR i LIKE \"%AC06%\"\x0D\x0A\x09\x09\x09" . ($cond??'null') . "  LIMIT 0,10000)");
			#src/model/ClientHistory.hx:195: characters 4-21
			$sql->add("UNION ");
			#src/model/ClientHistory.hx:196: characters 4-157
			$sql->add("(SELECT d, e AS amount, SUBSTR(k, 17, 8) AS m_ID, z AS IBAN, \"MD06\" AS reason FROM `konto_auszug` WHERE j LIKE \"%MD06%\" " . ($cond??'null') . "  LIMIT 0, 10000)");
		}
		#src/model/ClientHistory.hx:199: lines 199-210
		if (HxString::indexOf($reasons, "MS03") > -1) {
			#src/model/ClientHistory.hx:201: lines 201-204
			if ($first) {
				#src/model/ClientHistory.hx:202: characters 5-18
				$first = false;
			} else {
				#src/model/ClientHistory.hx:204: characters 5-22
				$sql->add("UNION ");
			}
			#src/model/ClientHistory.hx:207: characters 4-171
			$sql->add("(SELECT d, e AS amount, SUBSTR(j,17,8) AS m_ID, z AS IBAN, \"MS03\" AS reason FROM `konto_auszug` WHERE i LIKE \"%MS03 SONSTIGE GRUENDE%\" " . ($cond??'null') . "  LIMIT 0,10000)");
			#src/model/ClientHistory.hx:208: characters 4-21
			$sql->add("UNION ");
			#src/model/ClientHistory.hx:209: characters 4-174
			$sql->add("(SELECT d, e AS amount, SUBSTR(k, 17, 8) AS m_ID, z AS IBAN, \"MS03\" AS reason FROM `konto_auszug` WHERE j LIKE \"%MS03 SONSTIGE GRUENDE%\" " . ($cond??'null') . "  LIMIT 0, 10000)");
		}
		#src/model/ClientHistory.hx:211: characters 3-45
		$sql->add(" )_lim " . ($globalCond??'null') . " LIMIT " . ($limit??'null'));
		#src/model/ClientHistory.hx:213: characters 3-28
		\S::$my->select_db("fly_crm");
		#src/model/ClientHistory.hx:214: characters 3-60
		$rows = $this->execute($sql->b, $phValues);
		#src/model/ClientHistory.hx:215: lines 215-216
		if ($dataOnly) {
			#src/model/ClientHistory.hx:216: characters 4-15
			return $rows;
		}
		#src/model/ClientHistory.hx:218: characters 19-66
		$tmp = $this->query("SELECT FOUND_ROWS()")[0]["FOUND_ROWS()"];
		#src/model/ClientHistory.hx:217: lines 217-221
		$this->data = new HxAnon([
			"count" => $tmp,
			"page" => (array_key_exists("page", $param->data) ? \Std::parseInt(($param->data["page"] ?? null)) : 1),
			"rows" => $rows,
		]);
		#src/model/ClientHistory.hx:223: characters 3-23
		return $this->json_encode();
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


		self::$vicdial_list_fields = \Array_hx::wrap(explode(",", "lead_id,entry_date,modify_date,status,user,vendor_lead_code,source_id,list_id,gmt_offset_now,called_since_last_reset,phone_code,phone_number,title,first_name,middle_initial,last_name,address1,address2,address3,city,state,province,postal_code,country_code,gender,date_of_birth,alt_phone,email,security_phrase,comments,called_count,last_local_call_time,rank,owner,entry_list_id"));
		self::$clients_fields = \Array_hx::wrap(explode(",", "client_id,lead_id,creation_date,state,use_email,register_on,register_off,register_off_to,teilnahme_beginn,title,namenszusatz,co_field,storno_grund,birth_date"));
		self::$pay_source_fields = \Array_hx::wrap(explode(",", "pay_source_id,client_id,lead_id,debtor,bank_name,account,blz,iban,sign_date,pay_source_state,creation_date"));
		self::$pay_plan_fields = \Array_hx::wrap(explode(",", "pay_plan_id,client_id,creation_date,pay_source_id,target_id,start_day,start_date,buchungs_tag,cycle,amount,product,agent,pay_plan_state,pay_method,end_date,end_reason"));
		$_g = new StringMap();
		$_g->data["title"] = "anrede";
		$_g->data["geburts_datum"] = "birth_date";
		self::$custom_fields_map = $_g;
	}
}

Boot::registerClass(ClientHistory::class, 'model.ClientHistory');
ClientHistory::__hx__init();
