<?php

// Generated by Haxe 3.4.0 (git build development @ e08d018)
class haxe_Http {
	public function __construct($url) {
		if(!isset($this->onData)) $this->onData = array(new _hx_lambda(array(&$this), "haxe_Http_0"), 'execute');
		if(!isset($this->onError)) $this->onError = array(new _hx_lambda(array(&$this), "haxe_Http_1"), 'execute');
		if(!isset($this->onStatus)) $this->onStatus = array(new _hx_lambda(array(&$this), "haxe_Http_2"), 'execute');
		if(!php_Boot::$skip_constructor) {
		$this->url = $url;
		$this->headers = new HList();
		$this->params = new HList();
		$this->cnxTimeout = 10;
		$this->noShutdown = !function_exists("stream_socket_shutdown");
	}}
	public $url;
	public $responseData;
	public $noShutdown;
	public $cnxTimeout;
	public $responseHeaders;
	public $chunk_size;
	public $chunk_buf;
	public $file;
	public $postData;
	public $headers;
	public $params;
	public function setParameter($param, $value) {
		$this->params = Lambda::filter($this->params, array(new _hx_lambda(array(&$param), "haxe_Http_3"), 'execute'));
		$this->params->push(_hx_anonymous(array("param" => $param, "value" => $value)));
		return $this;
	}
	public function request($post = null) {
		$_gthis = $this;
		$me = $this;
		$output = new haxe_io_BytesOutput();
		$old = (property_exists($this, "onError") ? $this->onError: array($this, "onError"));
		$err = false;
		$this->onError = array(new _hx_lambda(array(&$_gthis, &$err, &$me, &$old, &$output), "haxe_Http_4"), 'execute');
		$this->customRequest($post, $output, null, null);
		if(!$err) {
			$me1 = (property_exists($me, "onData") ? $me->onData: array($me, "onData"));
			call_user_func_array($me1, array($me->responseData = $output->getBytes()->toString()));
		}
	}
	public function customRequest($post, $api, $sock = null, $method = null) {
		$this->responseData = null;
		$url_regexp = new EReg("^(https?://)?([a-zA-Z\\.0-9_-]+)(:[0-9]+)?(.*)\$", "");
		if(!$url_regexp->match($this->url)) {
			$this->onError("Invalid URL");
			return;
		}
		$secure = $url_regexp->matched(1) === "https://";
		if($sock === null) {
			if($secure) {
				$sock = new php_net_SslSocket();
			} else {
				$sock = new sys_net_Socket();
			}
		}
		$host = $url_regexp->matched(2);
		$portString = $url_regexp->matched(3);
		$request = $url_regexp->matched(4);
		if($request === "") {
			$request = "/";
		}
		$port = null;
		$port1 = null;
		if($portString !== null) {
			$port1 = $portString === "";
		} else {
			$port1 = true;
		}
		if($port1) {
			if($secure) {
				$port = 443;
			} else {
				$port = 80;
			}
		} else {
			$port = Std::parseInt(_hx_substr($portString, 1, strlen($portString) - 1));
		}
		$data = null;
		$multipart = _hx_field($this, "file") !== null;
		$boundary = null;
		$uri = null;
		if($multipart) {
			$post = true;
			$boundary1 = Std::string(Std::random(1000));
			$boundary2 = _hx_string_or_null($boundary1) . Std::string(Std::random(1000));
			$boundary3 = _hx_string_or_null($boundary2) . Std::string(Std::random(1000));
			$boundary = _hx_string_or_null($boundary3) . Std::string(Std::random(1000));
			while(strlen($boundary) < 38) {
				$boundary = "-" . _hx_string_or_null($boundary);
			}
			$b = new StringBuf();
			{
				$p = $this->params->iterator();
				while($p->hasNext()) {
					$p1 = $p->next();
					$b->add("--");
					$b->add($boundary);
					$b->add("\x0D\x0A");
					$b->add("Content-Disposition: form-data; name=\"");
					$b->add($p1->param);
					$b->add("\"");
					$b->add("\x0D\x0A");
					$b->add("\x0D\x0A");
					$b->add($p1->value);
					$b->add("\x0D\x0A");
					unset($p1);
				}
			}
			$b->add("--");
			$b->add($boundary);
			$b->add("\x0D\x0A");
			$b->add("Content-Disposition: form-data; name=\"");
			$b->add($this->file->param);
			$b->add("\"; filename=\"");
			$b->add($this->file->filename);
			$b->add("\"");
			$b->add("\x0D\x0A");
			$b->add("Content-Type: " . _hx_string_or_null($this->file->mimeType) . "\x0D\x0A" . "\x0D\x0A");
			$uri = $b->b;
		} else {
			$p2 = $this->params->iterator();
			while($p2->hasNext()) {
				$p3 = $p2->next();
				if($uri === null) {
					$uri = "";
				} else {
					$uri = _hx_string_or_null($uri) . "&";
				}
				$s = $p3->param;
				$uri1 = _hx_string_or_null(rawurlencode($s)) . "=";
				$s1 = $p3->value;
				$uri = _hx_string_or_null($uri) . _hx_string_or_null((_hx_string_or_null($uri1) . _hx_string_or_null(rawurlencode($s1))));
				unset($uri1,$s1,$s,$p3);
			}
		}
		$b1 = new StringBuf();
		if($method !== null) {
			$b1->add($method);
			$b1->add(" ");
		} else {
			if($post) {
				$b1->add("POST ");
			} else {
				$b1->add("GET ");
			}
		}
		if(_hx_field(_hx_qtype("haxe.Http"), "PROXY") !== null) {
			$b1->add("http://");
			$b1->add($host);
			if($port !== 80) {
				$b1->add(":");
				$b1->add($port);
			}
		}
		$b1->add($request);
		$tmp = null;
		if(!$post) {
			$tmp = $uri !== null;
		} else {
			$tmp = false;
		}
		if($tmp) {
			if(_hx_index_of($request, "?", 0) >= 0) {
				$b1->add("&");
			} else {
				$b1->add("?");
			}
			$b1->add($uri);
		}
		$b1->add(" HTTP/1.1\x0D\x0AHost: " . _hx_string_or_null($host) . "\x0D\x0A");
		if($this->postData !== null) {
			$b1->add("Content-Length: " . _hx_string_rec(strlen($this->postData), "") . "\x0D\x0A");
		} else {
			$tmp1 = null;
			if($post) {
				$tmp1 = $uri !== null;
			} else {
				$tmp1 = false;
			}
			if($tmp1) {
				$tmp2 = null;
				if(!$multipart) {
					$tmp2 = !Lambda::exists($this->headers, array(new _hx_lambda(array(), "haxe_Http_5"), 'execute'));
				} else {
					$tmp2 = true;
				}
				if($tmp2) {
					$b1->add("Content-Type: ");
					if($multipart) {
						$b1->add("multipart/form-data");
						$b1->add("; boundary=");
						$b1->add($boundary);
					} else {
						$b1->add("application/x-www-form-urlencoded");
					}
					$b1->add("\x0D\x0A");
				}
				if($multipart) {
					$b1->add("Content-Length: " . _hx_string_rec((strlen($uri) + $this->file->size + strlen($boundary) + 6), "") . "\x0D\x0A");
				} else {
					$b1->add("Content-Length: " . _hx_string_rec(strlen($uri), "") . "\x0D\x0A");
				}
			}
		}
		$b1->add("Connection: close\x0D\x0A");
		{
			$h1 = $this->headers->iterator();
			while($h1->hasNext()) {
				$h2 = $h1->next();
				$b1->add($h2->header);
				$b1->add(": ");
				$b1->add($h2->value);
				$b1->add("\x0D\x0A");
				unset($h2);
			}
		}
		$b1->add("\x0D\x0A");
		if($this->postData !== null) {
			$b1->add($this->postData);
		} else {
			$tmp3 = null;
			if($post) {
				$tmp3 = $uri !== null;
			} else {
				$tmp3 = false;
			}
			if($tmp3) {
				$b1->add($uri);
			}
		}
		try {
			if(_hx_field(_hx_qtype("haxe.Http"), "PROXY") !== null) {
				$sock->connect(new sys_net_Host(haxe_Http::$PROXY->host), haxe_Http::$PROXY->port);
			} else {
				$sock->connect(new sys_net_Host($host), $port);
			}
			$sock->write($b1->b);
			if($multipart) {
				$bufsize = 4096;
				$buf = haxe_io_Bytes::alloc($bufsize);
				while($this->file->size > 0) {
					$size = null;
					if($this->file->size > $bufsize) {
						$size = $bufsize;
					} else {
						$size = $this->file->size;
					}
					$len = 0;
					try {
						$len = $this->file->io->readBytes($buf, 0, $size);
					}catch(Exception $__hx__e) {
						$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
						if(($e = $_ex_) instanceof haxe_io_Eof){
							break;
						} else throw $__hx__e;;
					}
					$sock->output->writeFullBytes($buf, 0, $len);
					$tmp4 = $this->file;
					$tmp4->size = $tmp4->size - $len;
					unset($tmp4,$size,$len,$e);
				}
				$sock->write("\x0D\x0A");
				$sock->write("--");
				$sock->write($boundary);
				$sock->write("--");
			}
			$this->readHttpResponse($api, $sock);
			$sock->close();
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
			$e1 = $_ex_;
			{
				try {
					$sock->close();
				}catch(Exception $__hx__e) {
					$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
					$e2 = $_ex_;
					{}
				}
				$tmp5 = (property_exists($this, "onError") ? $this->onError: array($this, "onError"));
				call_user_func_array($tmp5, array(Std::string($e1)));
			}
		}
	}
	public function readHttpResponse($api, $sock) {
		$b = new haxe_io_BytesBuffer();
		$k = 4;
		$s = haxe_io_Bytes::alloc(4);
		$sock->setTimeout($this->cnxTimeout);
		while(true) {
			$p = $sock->input->readBytes($s, 0, $k);
			while($p !== $k) {
				$p = $p + $sock->input->readBytes($s, $p, $k - $p);
			}
			{
				$tmp = null;
				if($k >= 0) {
					$tmp = $k > $s->length;
				} else {
					$tmp = true;
				}
				if($tmp) {
					throw new HException(haxe_io_Error::$OutsideBounds);
				}
				$b1 = $b;
				$b2 = $b1->b;
				$this1 = $s->b;
				$x = new php__BytesData_Wrapper(substr($this1->s, 0, $k));
				$b1->b = _hx_string_or_null($b2) . _hx_string_or_null($x->s);
				unset($x,$tmp,$this1,$b2,$b1);
			}
			switch($k) {
			case 1:{
				$this2 = $s->b;
				$c = ord($this2->s[0]);
				if($c === 10) {
					break 2;
				}
				if($c === 13) {
					$k = 3;
				} else {
					$k = 4;
				}
			}break;
			case 2:{
				$this3 = $s->b;
				$c1 = ord($this3->s[1]);
				if($c1 === 10) {
					$this4 = $s->b;
					if(ord($this4->s[0]) === 13) {
						break 2;
					}
					$k = 4;
				} else {
					if($c1 === 13) {
						$k = 3;
					} else {
						$k = 4;
					}
				}
			}break;
			case 3:{
				$this5 = $s->b;
				$c2 = ord($this5->s[2]);
				if($c2 === 10) {
					$this6 = $s->b;
					if(ord($this6->s[1]) !== 13) {
						$k = 4;
					} else {
						$this7 = $s->b;
						if(ord($this7->s[0]) !== 10) {
							$k = 2;
						} else {
							break 2;
						}
					}
				} else {
					if($c2 === 13) {
						$tmp1 = null;
						$this8 = $s->b;
						if(ord($this8->s[1]) === 10) {
							$this9 = $s->b;
							$tmp1 = ord($this9->s[0]) !== 13;
						} else {
							$tmp1 = true;
						}
						if($tmp1) {
							$k = 1;
						} else {
							$k = 3;
						}
					} else {
						$k = 4;
					}
				}
			}break;
			case 4:{
				$this10 = $s->b;
				$c3 = ord($this10->s[3]);
				if($c3 === 10) {
					$this11 = $s->b;
					if(ord($this11->s[2]) !== 13) {
						continue 2;
					} else {
						$tmp2 = null;
						$this12 = $s->b;
						if(ord($this12->s[1]) === 10) {
							$this13 = $s->b;
							$tmp2 = ord($this13->s[0]) !== 13;
						} else {
							$tmp2 = true;
						}
						if($tmp2) {
							$k = 2;
						} else {
							break 2;
						}
					}
				} else {
					if($c3 === 13) {
						$tmp3 = null;
						$this14 = $s->b;
						if(ord($this14->s[2]) === 10) {
							$this15 = $s->b;
							$tmp3 = ord($this15->s[1]) !== 13;
						} else {
							$tmp3 = true;
						}
						if($tmp3) {
							$k = 3;
						} else {
							$k = 1;
						}
					}
				}
			}break;
			}
			unset($p);
		}
		$headers = _hx_explode("\x0D\x0A", $b->getBytes()->toString());
		$response = $headers->shift();
		$status = Std::parseInt(_hx_array_get(_hx_explode(" ", $response), 1));
		$tmp4 = null;
		if($status !== 0) {
			$tmp4 = $status === null;
		} else {
			$tmp4 = true;
		}
		if($tmp4) {
			throw new HException("Response status error");
		}
		$headers->pop();
		$headers->pop();
		$this->responseHeaders = new haxe_ds_StringMap();
		$size = null;
		$chunked = false;
		{
			$_g = 0;
			while($_g < $headers->length) {
				$hline = $headers[$_g];
				$_g = $_g + 1;
				$a = _hx_explode(": ", $hline);
				$hname = $a->shift();
				$hval = null;
				if($a->length === 1) {
					$hval = $a[0];
				} else {
					$hval = $a->join(": ");
				}
				$s1 = rtrim($hval);
				$hval = ltrim($s1);
				$this->responseHeaders->set($hname, $hval);
				switch(strtolower($hname)) {
				case "content-length":{
					$size = Std::parseInt($hval);
				}break;
				case "transfer-encoding":{
					$chunked = strtolower($hval) === "chunked";
				}break;
				}
				unset($s1,$hval,$hname,$hline,$a);
			}
		}
		$this->onStatus($status);
		$chunk_re = new EReg("^([0-9A-Fa-f]+)[ ]*\x0D\x0A", "m");
		$this->chunk_size = null;
		$this->chunk_buf = null;
		$bufsize = 1024;
		$buf = haxe_io_Bytes::alloc($bufsize);
		if($chunked) {
			try {
				while($this->readChunk($chunk_re, $api, $buf, $sock->input->readBytes($buf, 0, $bufsize))) {
				}
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
				if(($e = $_ex_) instanceof haxe_io_Eof){
					throw new HException("Transfer aborted");
				} else throw $__hx__e;;
			}
		} else {
			if($size === null) {
				if(!$this->noShutdown) {
					$sock->shutdown(false, true);
				}
				try {
					while(true) {
						$api->writeBytes($buf, 0, $sock->input->readBytes($buf, 0, $bufsize));
					}
				}catch(Exception $__hx__e) {
					$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
					if(($e1 = $_ex_) instanceof haxe_io_Eof){} else throw $__hx__e;;
				}
			} else {
				try {
					while($size > 0) {
						$len = null;
						if($size > $bufsize) {
							$len = $bufsize;
						} else {
							$len = $size;
						}
						$len1 = $sock->input->readBytes($buf, 0, $len);
						$api->writeBytes($buf, 0, $len1);
						$size = $size - $len1;
						unset($len1,$len);
					}
				}catch(Exception $__hx__e) {
					$_ex_ = ($__hx__e instanceof HException) && $__hx__e->getCode() == null ? $__hx__e->e : $__hx__e;
					if(($e2 = $_ex_) instanceof haxe_io_Eof){
						throw new HException("Transfer aborted");
					} else throw $__hx__e;;
				}
			}
		}
		$tmp5 = null;
		if($chunked) {
			if($this->chunk_size === null) {
				$tmp5 = $this->chunk_buf !== null;
			} else {
				$tmp5 = true;
			}
		} else {
			$tmp5 = false;
		}
		if($tmp5) {
			throw new HException("Invalid chunk");
		}
		$tmp6 = null;
		if($status >= 200) {
			$tmp6 = $status >= 400;
		} else {
			$tmp6 = true;
		}
		if($tmp6) {
			throw new HException("Http Error #" . _hx_string_rec($status, ""));
		}
		$api->close();
	}
	public function readChunk($chunk_re, $api, $buf, $len) {
		if($this->chunk_size === null) {
			if($this->chunk_buf !== null) {
				$b = new haxe_io_BytesBuffer();
				{
					$b1 = $b;
					$b1->b = _hx_string_or_null($b1->b) . _hx_string_or_null($this->chunk_buf->b->s);
				}
				{
					$tmp = null;
					if($len >= 0) {
						$tmp = $len > $buf->length;
					} else {
						$tmp = true;
					}
					if($tmp) {
						throw new HException(haxe_io_Error::$OutsideBounds);
					}
					$b2 = $b;
					$b3 = $b2->b;
					$this1 = $buf->b;
					$x = new php__BytesData_Wrapper(substr($this1->s, 0, $len));
					$b2->b = _hx_string_or_null($b3) . _hx_string_or_null($x->s);
				}
				$buf = $b->getBytes();
				$len = $len + $this->chunk_buf->length;
				$this->chunk_buf = null;
			}
			if($chunk_re->match($buf->toString())) {
				$p = $chunk_re->matchedPos();
				if($p->len <= $len) {
					$cstr = $chunk_re->matched(1);
					$this->chunk_size = Std::parseInt("0x" . _hx_string_or_null($cstr));
					if($cstr === "0") {
						$this->chunk_size = null;
						$this->chunk_buf = null;
						return false;
					}
					$len = $len - $p->len;
					return $this->readChunk($chunk_re, $api, $buf->sub($p->len, $len), $len);
				}
			}
			if($len > 10) {
				$this->onError("Invalid chunk");
				return false;
			}
			$this->chunk_buf = $buf->sub(0, $len);
			return true;
		}
		if($this->chunk_size > $len) {
			$tmp1 = $this;
			$tmp1->chunk_size = $tmp1->chunk_size - $len;
			$api->writeBytes($buf, 0, $len);
			return true;
		}
		$end = $this->chunk_size + 2;
		if($len >= $end) {
			if($this->chunk_size > 0) {
				$api->writeBytes($buf, 0, $this->chunk_size);
			}
			$len = $len - $end;
			$this->chunk_size = null;
			if($len === 0) {
				return true;
			}
			return $this->readChunk($chunk_re, $api, $buf->sub($end, $len), $len);
		}
		if($this->chunk_size > 0) {
			$api->writeBytes($buf, 0, $this->chunk_size);
		}
		$tmp2 = $this;
		$tmp2->chunk_size = $tmp2->chunk_size - $len;
		return true;
	}
	public function onData($data) { return call_user_func_array($this->onData, array($data)); }
	public $onData = null;
	public function onError($msg) { return call_user_func_array($this->onError, array($msg)); }
	public $onError = null;
	public function onStatus($status) { return call_user_func_array($this->onStatus, array($status)); }
	public $onStatus = null;
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	static $PROXY = null;
	static function requestUrl($url) {
		$h = new haxe_Http($url);
		$r = null;
		$h->onData = array(new _hx_lambda(array(&$r), "haxe_Http_6"), 'execute');
		$h->onError = array(new _hx_lambda(array(), "haxe_Http_7"), 'execute');
		$h->request(false);
		return $r;
	}
	function __toString() { return 'haxe.Http'; }
}
function haxe_Http_0(&$__hx__this, $data) {
	{}
}
function haxe_Http_1(&$__hx__this, $msg) {
	{}
}
function haxe_Http_2(&$__hx__this, $status) {
	{}
}
function haxe_Http_3(&$param, $p) {
	{
		return $p->param !== $param;
	}
}
function haxe_Http_4(&$_gthis, &$err, &$me, &$old, &$output, $e) {
	{
		$me->responseData = $output->getBytes()->toString();
		$err = true;
		$_gthis->onError = $old;
		$_gthis->onError($e);
	}
}
function haxe_Http_5($h) {
	{
		return $h->header === "Content-Type";
	}
}
function haxe_Http_6(&$r, $d) {
	{
		$r = $d;
	}
}
function haxe_Http_7($e) {
	{
		throw new HException($e);
	}
}
