package model;
import haxe.ds.StringMap;
import haxe.EitherType;
import haxe.Json;
import me.cunity.php.db.MySQLi;
import me.cunity.php.db.MySQLi_Result;
import me.cunity.php.db.MySQLi_STMT;
import php.Lib;
import php.NativeArray;
import php.Web;

using Lambda;

/**
 * ...
 * @author axel@cunity.me
 */
@:keep
 class Clients extends Model
{
		
	public static function create(param:StringMap<String>):EitherType<String,Bool>
	{
		var self:Clients = new Clients();		
		trace(param);
		return Reflect.callMethod(self, Reflect.field(self,param.get('action')), [param]);
	}
	
	public function find(param:StringMap<String>):EitherType<String,Bool>
	{
		doQuery(param);
		/*var sb:StringBuf = new StringBuf();		
		var phValues:Array<Array<Dynamic>> = new Array();
		trace(param.get('where') + ':' );
		sb.add('SELECT ');
		sb.add(fieldFormat(param.get('fields')) + ' FROM ');
		sb.add(param.get('table')+ ' ');
		if (param.exists('join'))
			sb.add(param.get('join') + ' ');
		//sb.add('WHERE ' + param.get('where') + ' ');
		sb.add(whereParam2sql(param.get('where'), phValues));
		trace(phValues.toString());
		if(param.exists('group'))
			sb.add('GROUP BY ' +param.get('group') + ' ');
		if(param.exists('order'))
			sb.add('ORDER BY ' + param.get('order') + ' ');				
		if(param.exists('limit'))
			sb.add('LIMIT ' + param.get('limit'));			
			
		//trace(sb.toString());
		data =  {
			rows: execute(sb.toString(), param, phValues)
		}*/
		return json_encode();
	}

	
	
}