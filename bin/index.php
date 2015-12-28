<?php

	require("php/functions.php");
	require("../config/flyCRM.db.php");
	//edump($_SERVER);
	session_start();
	$user = (isset($_SESSION['PHP_AUTH_USER']) ? $_SESSION['PHP_AUTH_USER'] : 'NONO');
	$basePath = preg_replace("/index.php$/", "", $_SERVER['PHP_SELF']);
	$base = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}$basePath";
	$actionPath = preg_replace("|^{$basePath}|", "", $_SERVER['REQUEST_URI']);
	$action = $actionParam = '';
	if ($actionPath)
	{
		$actionParam = preg_split("/\//", $actionPath);
		#edump($actionParam);
		$action = array_pop($actionParam);
		#exit(printf("<div><pre>%s</pre></div>",print_r($actionParam,1)));
	}
	$params = array2json($actionParam);

?>
<!DOCTYPE html>
<html lang="de">
  	<head>
    	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=0">
		<link rel="stylesheet" href="css/jquery-ui.css">
		<link rel="stylesheet" href="css/app.css">
		<base href="<?php echo $base;?>">
	</head>
	<body>

		<!-- MAIN APP SCREEN -->
		<div  class="bgBox" id="bgBox">
			<div  id="mtabs" >
				<ul id="mainmenu"></ul>
			</div>
		</div>
		
		<!-- MAIN TABS -->
		
		<script type="text/x-jquery-tmpl" id="t-mtabs">						
			<li><a href="${id}" rel="pushstate">${label}</a></li>								
		</script>
		
		<!-- DATETIME -->
		
		<script type="text/x-jquery-tmpl"  id="t-datetime" >					
			<li id="datetime" class="tabs-header" >${datetime}</li>			
		</script>
		
		<!-- QC TAB -->
	
		<script type="text/x-jquery-tmpl"  id="t-qc">
			<div id="qc"  class="tabContent" >
				<form  id="qc-list-anchor" action="qc" class="main-left">
				</form>
			</div>
		</script>
		
		<!--  QC LIST -  {{if $data.hidden  && $data.fields.indexOf($data.hidden) >-1}}-->
		
		<script type="text/x-jquery-tmpl"  id="t-qc-list">
		
			<table id="qc-list">
				<tr class="headrow" >
				{{each(i,v) $data.fields}}
					{{if v!=$data.primary_id && !has($data.hidden,v)}}
					 <th data-order="${v}">${fieldNames[v]}</th>
					{{/if}}
				{{/each}}
				</tr>
				{{each(i,v) $data.rows}}					
					<tr id="${v[$data.primary_id]}" class="${((i+1) % 2 ? 'odd' : 'even')}" ${data($data.hidden,v)} >
					{{each(ri,rv) v}}
						{{if ri!=$data.primary_id && !has($data.hidden,ri)}}
							{{if displayFormats[ri] }}
						<td data-name="${ri}" >${display(displayFormats[ri],rv)}</td>												
							{{else}}
						<td data-name="${ri}" >${rv}</td>	
							{{/if}}
						{{/if}}
					{{/each}}
					</tr>
				{{/each}}
			</table>		
		</script>
		
		<!-- QC EDITOR ${trace($data.typeMap)}-->
		
		<script type="text/x-jquery-tmpl"  id="t-qc-editor">
		<div id="overlay" class="overlay-left">
		<div  class="scrollbox">		
			<form  id="qc-edit-form" action="qc" class="main-left">
			{{each(i,v) $data.rows}}
				<table id="qc-edit-data-${i}">
				{{each(k,val) v}}
				{{if $data.typeMap[k] == 'HIDDEN'}}
					<input type="hidden" name="${k}" value="${val}">
				{{else}}
				<tr>
					<td>{{html $data.fieldNames[k]}}:</td>
					<td class="nowrap">
					{{if $data.typeMap[k] == 'TEXT' || $data.typeMap[k] == 'READONLY' }}
						{{if displayFormats[k]}}
					<input {{if displayFormats[k].indexOf('_')==0}} name="_${k}"  data-value="${val}" {{else}} name="${k}"{{/if}} value="${display(displayFormats[k],val)}"
						{{else}}
					<input name="${k}" value="${val}"
						{{/if}}
						{{if $data.typeMap[k] == 'READONLY'}}readonly="readonly"{{/if}}>
					{{else $data.typeMap[k] == 'AREA'}}
					<textarea name="${k}">${val}</textarea>
					{{else $data.typeMap[k] == 'SELECT'}}
					<select name="${k}" >
					{{each(oi, ov) $data.optionsMap[k]}}
						<option value="${ov[0]}" {{if ov[0]==val}}selected="selected"{{/if}}>${ov[1]}</option>
					{{/each}}
					</select>
					{{else $data.typeMap[k] == 'RADIO'}}
					{{each(oi, ov) $data.optionsMap[k]}}
						<input type="radio" name="${k}"  value="${ov[0]}" {{if ov[0]==val}}checked="checked"{{/if}}
						><span class="optLabel">${ov[1]}</span>
					{{/each}}
					{{else $data.typeMap[k] == 'DATE'}}
						<input type="text" size="11" name="${k}" class="datepicker" >
					{{/if}}					
					</td>
				</tr>
				{{/if}}
				{{/each}}
				<tr>
				<td>Agent:</td><td>
				<select name="owner">
				{{each(ui,uv) $data.userMap.a}}
					<option value="${uv.user}" {{if uv.user==$data.user}}selected="selected"{{/if}}>${uv.full_name}</option>
				{{/each}}
				</select>
				</td>
				</tr>
				</table>
			</form>
			{{/each}}
		</div>
		</div>
		</script>
		
		
		<!-- QC MENU -->
		
		<script type="text/x-jquery-tmpl" id="t-qc-menu">		
			<div id="qc-menu" class="menu-right">
			${trace($data)}
			{{each(i,v) $data.items}}
				<h3>${v.label}</h3>
				<div>
					<form >
						<input type="hidden" name="action" value="${action}">
						<table>
							{{each(fi,fv) v.fields}}					
							{{if rangeFields[fv]}}
							<tr class="lh32">
								<td><div class="lpad" >${rangeLabels.from}</div>
								</td>
								<td colspan="2">
								<input type="text" size="11" name="range_from_${fv}" class="datepicker"  >
								</td>
							</tr>		
							<tr class="lh32">
								<td>
								<div class="lpad" >${rangeLabels.to}</div>
								</td>
								<td colspan="2">
								<input type="text" size="11" name="range_to_${fv}" class="datepicker" >
								</td>				
							</tr>

							{{else}}
							<tr class="lh32">
								<td>
								<div class="lpad" >${fieldNames[fv]}</div>
								</td>
								{{if $data.typeMap[fv] == 'SELECT'}}
								<td colspan="2">
									<select name="${fv}" >
									{{each(oi, ov) $data.optionsMap[fv]}}
										<option value="${ov[0]}" {{if ov[0]==fv}}selected="selected"{{/if}}>${ov[1]}</option>
									{{/each}}
									</select>
								</td>
								{{else}}
								<td >																
								<input type="${ fieldTypes[fv] ? fieldTypes[fv] : 'text' }" name="${fv}" class="menu-input-right">
								</td>
								<td >
								<div class="rpad" >{{tmpl(fv) "#t-find-match"}}</div>
								</td>
								{{/if}}
							</tr>							
							{{/if}}																					
							{{/each}}
						{{each(bi,bv) v.buttons}}
						<tr>
							<td colspan="3">
								<button data-contextaction="${bi}">${bv}</button>							
							</td>						
						</tr>
						{{/each}}
						</table>
					</form>
				</div>
			{{/each}}	
			</div>	
		</script>
				
		<!-- QC MENU RECORDINGS ${trace($data)} ${trace(v)}-->
		<script type="text/x-jquery-tmpl"  id="t-qc-recordings">
			<div class="recordings"  >			
			{{each(i,v) $data.recordings}}
				<span class="label">${v.start_time} </span><br>
				<audio controls  >
					<source src="/RECORDINGS/MP3/${v.filename}" type="audio/mpeg">
				</audio><br>
			{{/each}}
			</div>
		</script>
		
		<!-- QC MENU RECORDINGS ${trace($data)} ${trace(v)}-->
		<script type="text/x-jquery-tmpl"  id="t-clients-recordings">
			<div class="recordings"  >			
			{{each(i,v) $data.recordings}}
				<span class="label">${v.start_time} </span><br>
				<audio controls  >
					<source src="/RECORDINGS/MP3/${v.filename}" type="audio/mpeg">
				</audio><br>
			{{/each}}
			</div>
		</script>
		
		<!-- MEMBERS TAB -->
	
		<script type="text/x-jquery-tmpl"  id="t-clients">
			<div id="clients" class="tabContent" >
				<form  id="clients-list-anchor" action="clients" class="main-left">
				</form>
			</div>
		</script>
		
		<!--  MEMBERS LIST data-direction="ASC" v!=$data.primary_id && ri!=$data.primary_id && -->
		
		<script type="text/x-jquery-tmpl"  id="t-clients-list">
		
			<table id="clients-list">
				${($data.oddi=0,'')}
				<tr class="headrow" >
				{{each(i,v) $data.fields}}
					{{if hasNot($data.hidden,v)}}
					<th data-order="${v}" >${fieldNames[v]}</th>
					{{/if}}
				{{/each}}
				</tr>
				{{each(i,v) $data.rows}}
					<tr id="${v.client_id}" class="${((i+1) % 2 ? 'odd' : 'even')}"  ${data($data.hidden,v)} >
					{{each(ri,rv) v}}
						{{if   hasNot($data.hidden,ri)}}
							{{if displayFormats[ri] }}
						<td data-name="${ri}" >${display(displayFormats[ri],rv)}</td>												
							{{else}}
						<td data-name="${ri}" >${rv}</td>	
							{{/if}}
						{{/if}}
					{{/each}}
					</tr>
				{{/each}}
			</table>		
		</script>
		
	 <!-- MEMBERS EDITOR ${trace(v)}${trace(k + ':' + $data.typeMap[k])}${trace(k +':' + $data.typeMap[k] )}-->
		
		<script type="text/x-jquery-tmpl"  id="t-clients-editor">
		<div id="overlay" class="overlay-left">
		<div  class="scrollbox">
			<form  id="clients-edit-form" action="clients" class="2main-left">
			{{each(i,v) $data.editData.clients.h}}				
				<table id="edit-client">
				{{each(k,val) v}}
				{{if $data.typeMap[k] == 'HIDDEN'}}
					<input type="hidden" name="${k}" value="${val}">
				{{else}}
				<tr>
					<td>{{html $data.fieldNames[k]}}:</td>
					<td class="nowrap">
					{{if $data.typeMap[k] == 'TEXT' || $data.typeMap[k] == 'READONLY' }}
						<input name="${k}" value="${displayFormats[k]?display(displayFormats[k],val):val}"
							{{if $data.typeMap[k] == 'READONLY'}}readonly="readonly"{{/if}}>
					{{else $data.typeMap[k] == 'AREA'}}
					<textarea name="${k}">${val}</textarea>
					{{else $data.typeMap[k] == 'SELECT'}}
					<select name="${k}" >
					{{each(oi, ov) $data.optionsMap[k]}}
						<option value="${ov[0]}" {{if ov[0]==val}}selected="selected"{{/if}}>${ov[1]}</option>
					{{/each}}
					</select>
					{{else $data.typeMap[k] == 'RADIO'}}
					{{each(oi, ov) $data.optionsMap[k]}}
						{{if k=='state'}}
						<input type="radio" name="${k}"  value="${ov[0]}" {{if ov[0]==val}}checked="checked"{{else}} disabled="disabled"{{/if}}>
						{{else}}
						<input type="radio" name="${k}"  value="${ov[0]}" {{if ov[0]==val}}checked="checked"{{/if}}>
						{{/if}}						
						<span class="optLabel">${ov[1]}</span>
					{{/each}}
					{{else $data.typeMap[k] == 'CHECKBOX'}}					
						<input type="checkbox" name="${k}" {{if val==1}}checked="checked"{{/if}}>
					{{else $data.typeMap[k] == 'DATE'}}
						<input type="text" size="11" name="${k}" class="datepicker" >
					{{/if}}
					</td>
				</tr>
				{{/if}}
				{{/each}}
				</table>
			</form>
			{{/each}}
		</div>
		</div>
		</script>
		
		<!-- MEMBERS  PAY_<SOMETHING> EDITOR  ${primary_id=$data.table+'_id'}${id=1;}-->
		
		<script type="text/x-jquery-tmpl"  id="t-pay-editor">
		<div id="overlay" class="overlay-left">
		<div  class="scrollbox">
			<form  id="${$data.table}-form" action="clients" class="2main-left">
			{{each(i,v) $data.h}}
			<table  >
				{{each(k,val) v}}
				{{if $data.typeMap[k] != 'HIDDEN'}}
				<tr>
					<td>{{html $data.fieldNames[k]}}:</td>
					<td class="nowrap">
					{{if $data.typeMap[k] == 'TEXT' || $data.typeMap[k] == 'READONLY' }}
						<input name="${nID(k,v[$data.table+'_id'])}" value="${displayFormats[k]?display(displayFormats[k],val):val}"
							{{if $data.typeMap[k] == 'READONLY'}}readonly="readonly"{{/if}}>
					{{else $data.typeMap[k] == 'AREA'}}
					<textarea name="${nID(k,v[$data.table+'_id'])}">${val}</textarea>
					{{else $data.typeMap[k] == 'SELECT'}}
					<select name="${nID(k,v[$data.table+'_id'])}" >
					{{each(oi, ov) $data.optionsMap[k]}}
						<option value="${ov[0]}" {{if ov[0]==val}}selected="selected"{{/if}}>${ov[1]}</option>
					{{/each}}
					</select>
					{{else $data.typeMap[k] == 'RADIO'}}
					{{each(oi, ov) $data.optionsMap[k]}}
						<input type="radio" name="${nID(k,v[$data.table+'_id'])}"  value="${ov[0]}" {{if ov[0]==val}}checked="checked"{{/if}}><span class="optLabel">${ov[1]}</span>
					{{/each}}
					{{else $data.typeMap[k] == 'CHECKBOX'}}					
						<input type="checkbox" name="${nID(k,v[$data.table+'_id'])}" {{if val==1}}checked="checked"{{/if}}>	
					{{/if}}
					</td>
				</tr>
				{{/if}}
				{{/each}}
				</table>
			{{/each}}
			</form>
		</div>
		</div>
		</script>
		
		<!-- MEMBERS MENU ${testinc( '666' )}${trace('members.menu:' + i + ':' + v.label)}<input type="hidden" name="page" value="${data.page}">
						<input type="hidden" name="limit" value="${data.limit}">${trace($data)}-->
		
		<script type="text/x-jquery-tmpl" id="t-clients-menu">
		${trace($data)}
			<div id="clients-menu" class="menu-right">
			{{each(i,v) $data.items}}			
				<h3>${v.label}</h3>
				<div>
					<form >
					<table>
						<input type="hidden" name="action" value="${action}">
						
						{{each(fi,fv) v.fields}}						
							{{if rangeFields[fv]}}
							<tr class="lh32">
								<td><div class="lpad" >${rangeLabels.from}</div>
								</td>
								<td colspan="2">
								<input type="text" size="11" name="range_from_${fv}" class="datepicker"  >
								</td>
							</tr>		
							<tr class="lh32">
								<td>
								<div class="lpad" >${rangeLabels.to}</div>
								</td>
								<td colspan="2">
								<input type="text" size="11" name="range_to_${fv}" class="datepicker" >
								</td>				
							</tr>							
							{{else}}
							<tr class="lh32">
								<td>
								<div class="lpad" >${fieldNames[fv]}</div>
								</td>
								<td >																
								<input type="${ fieldTypes[fv] ? fieldTypes[fv] : 'text' }" name="${fv}" class="menu-input-right">
								</td>
								<td >
								<div class="rpad" >{{tmpl(fv) "#t-find-match"}}</div>
								</td>
							</tr>														
							{{/if}}								
							{{/each}}

							{{if v.pay_source_fields}}
							<tr>
								<td colspan="3">
									<h5>${appLabel.pay_source}</h5>							
								</td>						
							</tr>
							{{/if}}
							{{each(k,pv) v.pay_source_fields}}
				
							<tr class="lh32" data-table="pay_source" >
								<td>
								<div class="lpad" >${pv}</div>
								</td>
								
								<td >																
								<input type="${ fieldTypes[pv] ? fieldTypes[pv] : 'text' }" name="pay_source.${k}" class="menu-input-right" >
								</td>
								<td >
								<div class="rpad" >{{tmpl('pay_source.'+k) "#t-find-match"}}</div>
								</td>						
						
							</tr>								
							
							{{/each}}
							{{if v.pay_plan_fields}}
								<tr>
									<td colspan="3">
										<h5>${appLabel.pay_plan}</h5>							
									</td>						
								</tr>
							{{/if}}
							{{each(k,pv) v.pay_plan_fields}}
														
							<tr class="lh32" data-table="pay_plan" >
								<td>
								<div class="lpad" >${pv}</div>
								</td>
								{{if $data.typeMap[k] == 'TEXT' || $data.typeMap[k] == 'READONLY' }}	
								<td >																
								<input type="${ fieldTypes[pv] ? fieldTypes[pv] : 'text' }" name="pay_plan.${k}" class="menu-input-right" >
								</td>
								<td >
								<div class="rpad" >{{tmpl('pay_plan.'+k) "#t-find-match"}}</div>
								</td>
								{{else $data.typeMap[k] == 'SELECT'}}
								<td colspan="2">
									<select name="pay_plan.${k}" >
									{{each(oi, ov) $data.optionsMap[k]}}
										<option value="${ov[0]}" {{if ov[0]==pv}}selected="selected"{{/if}}>${ov[1]}</option>
									{{/each}}
									</select>
								</td>
								{{/if}}
							</tr>								
							
							{{/each}}							
							
						{{each(bi,bv) v.buttons}}
						<tr>
							<td colspan="3">
								<button data-contextaction="${bi}">${bv}</button>							
							</td>						
						</tr>						
						{{/each}}						
						</table>
					</form>
				</div>
			{{/each}}	
			</div>	
		</script>
		<!-- -{{if $data.typeMap[k] == 'TEXT' || $data.typeMap[k] == 'READONLY' }} {{/if}} -->
		<script type="text/x-jquery-tmpl" id="t-find-match">
			<select name="${$item.data}_match_option"  class="menu-end-right">
			{{each(i,v) matchOptions}}
				<option value="${i}" title="${v}" >${v.substr(0,1)}</option>
			{{/each}}
			</select>
		</script>
		
		<!-- CAMPAIGNS TAB -->
	
		<script type="text/x-jquery-tmpl"  id="t-campaigns">
			<div id="campaigns"  class="tabContent" >
				<form  id="campaigns-list-anchor" action="campaigns" class="main-left">
				</form>
			</div>
		</script>
		
		<!--  CAMPAIGNS LEAD RESULTS LIST -->
		
		<script type="text/x-jquery-tmpl"  id="t-campaigns-list">
		
			<table id="campaigns-list">
				${($data.oddi=0,'')}
				<tr class="headrow" >
				{{each(i,v) $data.fields}}
					
					<th data-order="${v}">${fieldNames[v]}</th>
					
				{{/each}}
				</tr>
				{{each(i,v) $data.rows}}
					<tr id="${v.vendor_lead_code}" class="${((i+1) % 2 ? 'odd' : 'even')}">
					{{each(ri,rv) v}}
						
							{{if displayFormats[ri]}}
						<td data-name="${ri}" >${sprintf(displayFormats[ri],rv)}</td>	
							{{else}}
						<td data-name="${ri}" >${rv}</td>	
							{{/if}}
					{{/each}}
					</tr>
				{{/each}}
			</table>		
		</script>
		
		<!-- CAMPAIGNS MENU -->
		<!--  {{each(oi,ov) sv.options}}
							<option value="${ov.value}">${ov.label}</option>
							{{/each}}size="${sv.options.length>0&&sv.options.length<15 ? sv.options.length :2}"-->
		
		<script type="text/x-jquery-tmpl" id="t-campaigns-menu">		
			<div id="campaigns-menu" class="menu-right">
			{{each(i,v) $data.items}}
				<h3>${v.label}</h3>
				<div>
					<form >
						<input type="hidden" name="action" value="${action||''}">
						{{each(si,sv) v.Select}}
						<div class="menuTable" >
							<select name="${sv.name}" ${sv.multi ? 'multiple="multiple"':''} id="campaigns-menu_${sv.name}" >							
							</select>						
						</div>	

						<div class="menuTable" >
							{{each(ci,cv) sv.check}}
							<span class="label">${cv.label?cv.label:appLabel[cv.name]}</span>
							<input type="checkbox" checked="${cv.checked}" name="${cv.name}">
							{{/each}}
						</div>	
						{{/each}}						
						{{each(bi,bv) v.buttons}}
						<button data-contextaction="${bi}">${bv}</button>
						{{/each}}
					</form>
				</div>
			{{/each}}	
			</div>	
		</script>
		
		<!-- PAGER TEMPLATE -->
		<script type="text/x-jquery-tmpl" id="t-pager">
		  <tr id="${$data.id}-pager" class="pager">
				<td colspan="${$data.colspan}" style="text-align: center">
					 <table >
						  <tr>
								<td><a href="#" data-action="first">&lt;&lt;</a></td>
								<td><a href="#" data-action="previous">&lt;</a></td>
								<td><button data-action="go2page">${appLabel.go2page}</button></td>
								<td><input size="3" name="page" value="${$data.page}"></td>
								<td>${appLabel.of + ' ' +  Math.ceil($data.count/uiData.limit)}</td>
								<td><a href="#" data-action="next">&gt;</a></td>
								<td><a href="#" data-action="last">&gt;&gt;</a></td>
						  </tr>
					 </table>
				</td>
		  </tr>
		</script>

	 <!-- SELECT  GENERIC OPTIONS TEMPLATE  -->
		<script type="text/x-jquery-tmpl" id="t-options">
			{{each(i,v) $data.rows}}
			<option value="${v[$data.id]}">${v[$data.label]}</option>
			{{/each}}
		</script>		

		<!-- SELECT  CAMPAIGN OPTIONS TEMPLATE  -->
		<script type="text/x-jquery-tmpl" id="t-campaign_id">
			{{each(i,v) $data.rows}}
			<option value="${v.campaign_id}">${v.campaign_name}</option>
			{{/each}}
		</script>		
		
		<!--  WAIT SCREEN TEMPLATE ${trace($data)}-->
		<script type="text/x-jquery-tmpl" id="t-wait">		
			<div id="wait" class="overlay">
			<div  class="scrollbox">			
				<div id="wait-content" class="content">
					<h3>${$data.wait}</h3>					
				</div>
			</div>
			</div>
		</script>
		
		<!-- OVERLAY CHOICE TEMPLATE ${trace($data)} ${trace(i + ':' + v.status)}-->
		<script type="text/x-jquery-tmpl" id="t-choice">		
		  <div id="choice" class="overlay">
		  <div  class="scrollbox">			
				<table id="choice-content" class="ccontent">
					<caption>${$data.header}</caption>
					{{each(i,v) $data.choice}}					
					<tr>
						<td><button data-choice="${v.status}">${v.status + ' - ' + v.status_name}</button></td>
					</tr>						
					{{/each}}
					<tr>
						<td><button onclick="choice()">${appLabel.close}</button></td>
					</tr>	
				</table>
		  </div>
		  </div>
		</script>
		
		  <!-- OVERLAY CONFIRM TEMPLATE ${trace($data)} ${trace(i + ':' + v.status)}-->
		  <script type="text/x-jquery-tmpl" id="t-confirm">
				<div id="confirm" class="overlay">
				<div  class="scrollbox">			
					 <table id="confirm-content" class="ccontent">
						  <caption>${$data.header}</caption>
						  <tr>
							  <td>${$data.info}</td>
						  </tr>							  
						  {{each(i,v) $data.confirm}}					
						  <tr>
							  <td><button data-confirm="${v.command}">${v.label}</button></td>
						  </tr>						
						  {{/each}}
						  <tr>
							  <td>
							  <button onclick="modal('${$data.mID}')" > ${appLabel.close}</button></td>
						  </tr>	
					 </table>
				</div>
				</div>
		</script>
		
			<!-- test template ${fieldNames[pi]}{{tmpl(pv) "#t-find-match"}}-->
			<script type="text/x-jquery-tmpl" id="t-test">		
				<tr class="lh32">
					<td>
					<div class="lpad" >${ti}</div>
					</td>
					<td >																
					<input type="${ fieldTypes[pv] ? fieldTypes[pv] : 'text' }" name="${pv}" class="menu-input-right" >
					</td>
					<td >
					<div class="rpad" ></div>
					</td>
				</tr>
			</script>
		
		<script src="js/LAB.src.js"></script>
		<!--
		<table style="height:100%;width:100%;margin:auto;position:absolute;top:0px;" id="loader">
		<tr><td style="text-align:center;vertical-align: middle;"><img style="margin:auto;" src="design/loading2.gif"></td><tr>
		</table>
		<script src="js/jquery-2.1.3.min.js"></script>
		<script src="js/stacktrace.js"></script>		
		<script src="js/debugJq.js"></script>		
		
		<script src="js/jquery-ui.js"></script>
		<script src="js/datepicker-de.js"></script>
		<script src="js/jquery.tmpl.js"></script>
		<script src="js/spin.min.js"></script>
		<script src="js/sprintf.min.js"></script>
		<script src="flyCRM.js"></script>
		<script src="appData.js"></script>		-->	
		<script 	>
		
			$LAB.setGlobalDefaults({Debug:false}).
			script('js/jquery-2.1.3.js.gz').
			script('js/stacktrace.js.gz').
			script('js/debugJq.js.gz').
			script('js/jquery-ui.min.js.gz').
			script('js/datepicker-de.js.gz').
			script('flyCRM.js').
			script('js/jquery.tmpl.js.gz').
			script('js/sprintf.min.js.gz').
			script('js/spin.min.js.gz').
			script('js/iban-tool.js.gz').
			script('appData.js').
			script('uiData.js').wait(function()
		  {
				console.log('should be done...');
				//trace('clientFields:' + getFields(clientFields));
				uiData.action="<?php echo $action;?>";
				uiData.basePath="<?php echo $basePath;?>";
				uiData.company="<?php echo $company;?>";
				uiData.params="<?php echo $params;?>";
				uiData.user="<?php echo $user;?>";
				//console.log('uiData.company:' + uiData.company);
				$.post('server.php',{
					className:'App',
					action:'getGlobals',
					firstLoad:'true'
				},function(data){
					trace(data);
					//$('#dev').append('<pre>' + data[0].full_name + '</pre>');
					app = initApp(uiData);
					app.globals = data;
					app.globals.templates = templates;
					app.initUI(uiData.views);
					$('#loader').remove();
				},'json');
				
				//setTimeout(function(){trace('title:' + document.title)},1500);
		  });
			
			function check2tinyint (checkVal) {
				return checkVal ^= 1;
			}
		  
		  function getFields(obj)
		  {
				var fields = [];
				for(e in obj)
					 fields.push(e);
				return fields;
		  }
		  
		  function trace(m) {//debug from template
			  console.log(m);
			  return '';
		  }
		  var ti=0;
		  function testinc(m) {//debug from template
			  console.log('ti:' + ++ti + ':' + m);
			  return ti;
		  }
		  
		  function replace(r,b,s)
		  {
				//var re = new RegExp(r, "g");
				return s.replace(r, b);
		  }
		  
		  function spin(id) {
			  trace(id);
			  return new Spinner(
			  {
				  direction:-1,
				  zIndex:0
			  }).spin(document.getElementById(id));
		  }
		  
		  function data(keyNames,data) {
				if (!keyNames) {
					 return '';
				}
			  var keys = keyNames.split(',');
			  var ret = new Array();
			  for(k in keys)
			  {
				  if (data[keys[k]]) {
					  ret.push( 'data-' + keys[k] + '=' + data[keys[k]] );
				  }
			  }
			  return ret.join(' ');
		  }
		  
		  function display(format,value) {
				//trace(format + ':' + value);
				switch(format)
				{
					case 'datetime':
					 var t = value.split(/[- :]/);
					 return sprintf('%s.%s.%s %s:%s:%s', t[2], t[1], t[0], t[3], t[4], t[5]);
					 break;
					 case '_datetime':
					 case 'date':
					 if (!value) {
						return '';
					 }
					 var t = value.split(/\s/);
					 var t = t[0].split(/-/);
					 //trace(t.join('_'));
					 return sprintf('%s.%s.%s', t[2], t[1], t[0]);
					 break;
					case 'gFloat':
					//trace(value)
						return sprintf('%.2f',value).replace('.', ',');
						break;
					case 'grund':
						switch (value)
						{
							case 'AC01':
							return 'IBAN FEHLERHAFT';
							break;
							case 'AC04':
							return 'KONTO AUFGELOEST';
							break;
							case 'MD06':
							return 'WIDERSPRUCH DURCH ZAHLER';
							break;
							case 'MS03':
							return 'SONSTIGE GRUENDE';
							break;							
						}
						break;
					 default:
					return sprintf(format, value);
				}
				return value;
		  }
		  
		  function has(keyNames,key)
		  {
				if (!keyNames) {
					 return false;
				}
				//trace(keyNames + ':' + key);
				var keys = keyNames.split(',');
				for(k in keys)
				{
					var re = new RegExp('.'+keys[k]+'$','');
					if (keys[k]==key || key.match(re) ) 
						  return true;
				}
				return false;
		  }
		  
		  	function hasNot(keyNames,key)
		  {
				if (!keyNames) {
					 return true;
				}
				//trace(keyNames + ':' + key);
				var keys = keyNames.split(',');
				for(k in keys)
				{
					var re = new RegExp('.'+keys[k]+'$','');
					if (keys[k]==key || key.match(re) ) 
						  return false;
				}
				return true;
		  }
		  
		  function kM(keyName,key)
		  {
				if (!keyName) {
					 return false;
				}
				//trace(keyName + ':' + key);
				var re = new RegExp('.'+keyName+'$','');
				if (keyName==key || key.match(re)) 
					 return true;

				return false;
		  }		  
		  
		  function nID(k, id)
		  {
			//${k}[{$data.table+'_id'}]
				//trace(k + '[' + id + ']');
				return k + '[' + id + ']';
		  }
		  
		  /*IBAN GENERATE + CHECK FUNCTIONS*/
		  var gIBAN;
			
		  function repeat(s, n){
				var a = [];
				while(a.length < n){
					 a.push(s);
				}
				return a.join('');
		  }
		  
		  function buildIBAN(konto, blz, onsuccess, onerror)
		  {
				konto = new String(konto);
				blz = new String(blz);
				debug( konto + ' ' + blz);
				if (konto.length<10) {
					konto = repeat('0', 10-konto.length) + konto;
				}
				if (blz.length<8) {
					blz = repeat('0', 8-blz.length) + blz;
				}					
				IBAN.generate('DE',blz, konto).success(onsuccess).error(onerror);
		  }
		  
		  function checkIBAN(iban)
		  {
				return IBANCheck.isValid(iban) 
		  }
		</script>
		<table style="height:100%;width:100%;margin:auto;position:absolute;top:0px;" id="loader">
		<tr><td style="text-align:center;vertical-align: middle;"><img style="margin:auto;" src="design/loading2.gif"></td><tr>
		</table>
	</body>
</html>
