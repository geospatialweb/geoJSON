package com.geoJSON
{
	import com.esri.ags.Graphic;
	import com.esri.ags.geometry.MapPoint;
	import com.esri.ags.geometry.WebMercatorMapPoint;
	import com.esri.ags.symbols.PictureMarkerSymbol;
	import com.esri.ags.portal.PopUpRenderer;
	import com.esri.ags.portal.supportClasses.PopUpInfo;
	import com.esri.viewer.AppEvent;
	import com.geoJSON.GeoJSONSearch;
	
	import flash.events.MouseEvent;
	
	import mx.collections.ArrayCollection;
	import mx.core.ClassFactory;
	
	public class GeoJSONSearchCollection extends ArrayCollection
	{
		private static const GEOJSONFEED_GRAPHIC_CLICK:String = "geoJSONFeedGraphicClick";
		
		public static function createCollection(data:Object, aliasArray:Array, fieldsArray:Array, params:Object):ArrayCollection
		{
			var geoJSONSearchCollection:ArrayCollection = new ArrayCollection();
			
			for (var i:int = 0; i < data.features.length; i++)
			{
				var content:String = "";
				var fieldArray:Array = [];
				var geoJSONSearch:GeoJSONSearch = new GeoJSONSearch();
				
				for (var field:String in data.features[i].properties)
				{
					var fields:Object = new Object();
					fields.fieldname = field;
					fields.value = data.features[i].properties[field];
					
					fieldArray.push(fields);
				}	
				
				for (var j:int = 0; j < fieldsArray.length; j++)
				{
					for (var k:int = 0; k < fieldArray.length; k++)
					{
						if (j == 0)
						{
							switch (fieldArray[k].fieldname)
							{	
								case params.titlefield:
								{
									geoJSONSearch.title = fieldArray[k].value;
									break;
								}
									
								case params.linkfield:
								{
									geoJSONSearch.link = fieldArray[k].value;
									break;
								}
							}
						}
						
						if (fieldArray[k].fieldname == fieldsArray[j])
						{
							content += aliasArray[j] + ": " + fieldArray[k].value + "\n";
						}
					}
				}
				
				for (j = 0; j < params.container.widgets.length; j++)
				{
					if (params.container.widgets[j].label == data.features[i].properties[params.filterfield])
					{
						geoJSONSearch.symbol = new PictureMarkerSymbol(params.container.widgets[j].icon, params.iconwidth, params.iconheight);
						break;
					}
				}
				
				geoJSONSearch.content = content;
				geoJSONSearch.geometry = new WebMercatorMapPoint(data.features[i].geometry.coordinates[0], data.features[i].geometry.coordinates[1]);
				geoJSONSearch.point = geoJSONSearch.geometry as MapPoint;
				geoJSONSearch.graphic = new Graphic(geoJSONSearch.geometry, geoJSONSearch.symbol, geoJSONSearch);
				geoJSONSearch.graphic.addEventListener(MouseEvent.CLICK, geoJSONFeed_graphicClickHandler);
				
				// add infoWindowRenderer to each graphic
				var infoWindowRenderer:ClassFactory = new ClassFactory(PopUpRenderer);
				infoWindowRenderer.properties = {popUpInfo: configurePopUpInfo(geoJSONSearch.link)};
				
				geoJSONSearch.graphic.infoWindowRenderer = infoWindowRenderer;
				geoJSONSearch.popUpInfo = infoWindowRenderer.properties.popUpInfo;
				
				geoJSONSearchCollection.addItem(geoJSONSearch);
			}
		
			function configurePopUpInfo(link:String):PopUpInfo
			{
				var popUpInfo:PopUpInfo = new PopUpInfo;
				
				popUpInfo.title = "{title}";
				popUpInfo.description = "{content}<br/><a href='{link}'>{link}</a>";
				
				return popUpInfo;
			}
			
			function geoJSONFeed_graphicClickHandler(event:MouseEvent):void
			{
				AppEvent.dispatch(GEOJSONFEED_GRAPHIC_CLICK, event.currentTarget.attributes.title);
			}
			
			return geoJSONSearchCollection;
		}
	}
}