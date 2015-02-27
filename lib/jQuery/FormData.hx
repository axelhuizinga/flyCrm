package jQuery;

/**
 * ...
 * @author axel@cunity.me
 */

using Lambda;
 
typedef FData = 
{
	var name:String;
	var value:Dynamic;
}

@:expose("FD")
class FormData
{
	/*
	 * Merge Data|Settings with Form 
	 */
	
	public static function query(jForm:JQuery, ?eData:Dynamic) :String
	{
		var fD:Array<FData> = cast jForm.serializeArray();
		var ret:String = '';
		var d:FData = null;
		for (f in Reflect.fields(eData))
		{
			d = Reflect.field(eData, f);
			if ( d != null && Std.string(d) != '')
			{
				if (ret != '')
					ret += '&';		
				ret += f + '=' + d;
			}

		}
		for (item in fD)
		{
			if (item.value != null && item.value != '')
			{
				if(ret != '')
					ret += '&';
				ret +=  item.name + '=' + item.value;
			}
		}
		return ret;
	}
	/*
	 * Regex replace parameter order switched
	 */
	
	public static function replace(e:String, by:String, source:String):String
	{		
		var eR:EReg =  new EReg(e, '');
		trace(eR + ' replace:' + source + ' by:' + by);
		return eR.replace(source, by);
	}
	
	/*
	 * Build WHERE data string based on match type options 4 LIKE: exact|start|end|any
	 * and BETWEEN
	 */
	
	public static function where(jForm:JQuery, fields:Array<String>):String
	{
		var ret:Array<String> = new Array();
		var fD:Array<FData> = cast jForm.serializeArray();
		//trace(fD);
		for (item in fD)
		{
			if (!(fields.has(item.name) || item.name.indexOf('range_from_') == 0))
				continue;
			if (item.value != null && item.value != '' || item.name.indexOf('range_from_') == 0)
			{
				if (Reflect.hasField(App.storeFormats, item.name))
				{
					var sForm:Array<Dynamic> = Reflect.field(App.storeFormats, item.name);
					var callParam:Array<Dynamic> = sForm.length>1 ? sForm.slice(1) : [];
					var method:String = sForm[0];
					trace('call FormData' + method);
					callParam.push(item.value);
					item.value = Reflect.callMethod(FormData, Reflect.field(FormData, method), callParam);
				}
				var matchTypeOption:JQuery =  jForm.find('[name="' + item.name + '_match_option"]');
				if (matchTypeOption.length == 1)
				{
					ret.push(switch(matchTypeOption.val())
					{
						case 'exact':
							item.name + '|' + item.value;
						case 'start':
							item.name + '|LIKE|' + item.value + '%';
						case 'end':
							item.name + '|LIKE|%' + item.value;
						case 'any':
							item.name + '|LIKE|%' + item.value + '%';		
						case _:
							trace('ERROR: unknown matchTypeOption value:' + matchTypeOption.val());
							'ERROR|unknown matchTypeOption value:' + matchTypeOption.val();							
					});
				}
				else if (item.name.indexOf('range_from_') == 0 )
				{
					var from:String = item.value;
					if (from.length > 0)
						from = gDate2mysql(from);
					var name:String = item.name.substr(11);
					trace(name + ':' +  jForm.find('[name="' + name + '"]').val() );
					var to:String = jForm.find('[name="range_to_' + name + '"]').val();
					if (to.length > 0)
						to = gDate2mysql(to);
					if (from.length > 0 && to.length > 0)
						ret.push(name + '|BETWEEN|' + from + '|' + to);
					else if (from.length > 0)
						ret.push(name + '|BETWEEN|' + from + '|' + DateTools.format(Date.now(), '%Y-%m-%d'));
					else if (to.length > 0)//	TODO: CONFIG SYSTEM START DATE
						ret.push(name + '|BETWEEN|2015-01-01|' + to);
				}
				else if (item.name.indexOf('range_to_') == 0)
					continue;
				else
					ret.push (item.name + '|' + item.value );
			}
		}
		trace(ret.join(','));		
		return ret.join(',');		
	}
	
	@:expose('gDate2mysql')
	public static function gDate2mysql(gDate:String):String
	{
		var d:Array<String> = gDate.split('.').map(function(s:String) return StringTools.trim(s));
		if (d.length != 3)
		{			
			trace('Falsches Datumsformat');
			return 'Falsches Datumsformat:' + gDate;
		}
		return d[2] + '-' + d[1] + '-' + d[0];
	}
	
}