package com.geoJSON
{
	import mx.core.ClassFactory;
	
	import spark.components.DataGroup;
	
	[Event(name="geoJSONSearchClick", type="flash.events.Event")] // bubbles up from the GeoJSONSearchItemRenderer
	
	public class GeoJSONSearchDataGroup extends DataGroup
	{
	    public function GeoJSONSearchDataGroup()
	    {
	        super();
	
	        this.itemRenderer = new ClassFactory(GeoJSONSearchItemRenderer);
	    }
	}
}