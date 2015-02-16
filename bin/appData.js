var fieldNames =
{
	first_name:'Vorname',
	last_name:'Name',
	phone_number:'Telefon',
	address1:'Straße',
	postal_code:'PLZ',
	city:'Ort',
	last_local_call_time:'Anrufdatum',
	vendor_lead_code:'Mitgliedsnr.'
}

var matchOptions =
{
	exact:'Genauso',
	any:'Bestandteil',
	start:'Anfang',
	end:'Ende'	
}

var dbFieldTypes =
{
	first_name:'s',
	last_name:'s',
	list_id:'s',
	phone_number:'s',
	address1:'s',
	postal_code:'s',
	city:'s',
	last_local_call_time:'s',
	vendor_lead_code:'s'
}

var dbQueryFormats =
{
	last_local_call_time:['DATE_FORMAT','%d.%m.%Y %H:%i:%s'],
	entry_date:['DATE_FORMAT','%d.%m.%Y %H:%i:%s'],
	modify_date:['DATE_FORMAT','%d.%m.%Y %H:%i:%s']
}

var displayFormats =
{
	phone_number:'0%d'
}

var storeFormats =
{
	phone_number:['replace', '^0+','']
}

var fieldTypes =
{
	title:'select'
}

var uiData = {
	appName:"flyCRM",
	company:"X-Press Marketing GmbH",
	storeFormats:storeFormats,
	views:
	[
		{
			DateTime:
			{
				id:"datetime",
				format:"%s, %d.%d.%s %02d:%02d",
				interval:60000
			}
		},
		{
			TabBox:
			{
				id:"mtabs",
				isNav:true,
				append2header:'datetime',
				tabs:
				[{				
					link:"clients",
					label:"Mitglieder",
					views:
					[{	
						Clients:{
							action:'find',
							fields:['vendor_lead_code','first_name','last_name','phone_number','address1', 'city','last_local_call_time'],
							id:"clients",
							limit:15,
							order:'vendor_lead_code',
							//where:"list_id=10000",
							where:"list_id|10000|exact",
							table:'vicidial_list',
							//attach2:'#clients-list-anchor',
							listattach2:'#clients-list-anchor',
							views:[
							{
								ContextMenu:{
									id:"clients-menu",
									heightStyle: "auto",
									items:[
										{
											action:'find',
											label:'Finden',
											fields:['first_name','last_name','phone_number','address1', 'city','last_local_call_time'],
											table:'vicidial_list',
											buttons:
											{
												find:'Finden'
											}
										},
										{
											action:'edit',
											label:'Bearbeiten',
											buttons:
											{
												edit:'Bearbeiten',
												add:'Hinzufügen',
												delete:'Löschen'
											}
										}										
									],
									attach2:'#clients'
								}
							}
							]
						}
					}
					]									
				},
				{
					link:"campaigns",
					label:"Kampagnen",
					views:[]									
				},	
				{
					link:"stats",
					label:"Statistik",
					views:[]									
				},
				{
					link:"settings",
					label:"Einstellungen",
					views:[]									
				}],
				heightStyle: "fill"
			}
		}
	]}
