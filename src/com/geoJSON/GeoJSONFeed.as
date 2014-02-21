package com.geoJSON
{
	import com.esri.ags.Graphic;
	import com.esri.ags.geometry.Geometry;
	import com.esri.ags.geometry.MapPoint;
	import com.esri.ags.portal.supportClasses.PopUpInfo;
	import com.esri.ags.symbols.Symbol;
	
	import flash.events.EventDispatcher;
	
	[Bindable]
	[RemoteClass(alias="com.geoJSON.GeoJSONFeed")]
	
	public class GeoJSONFeed extends EventDispatcher
	{
		public var content:String;
		
		public var geometry:Geometry;
		
		public var graphic:Graphic;
		
		public var id:String;
		
		public var link:String;
		
		public var point:MapPoint;
		
		public var popUpInfo:PopUpInfo;
		
		public var symbol:Symbol;
		
		public var title:String;
	}
}