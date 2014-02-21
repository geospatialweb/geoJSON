package com.geoJSON
{
	import mx.core.ClassFactory;
	
	import spark.components.DataGroup;
	
	[Event(name="geoJSONFeedClick", type="flash.events.Event")] // bubbles up from the GeoJSONFeedItemRenderer
	
	public class GeoJSONFeedDataGroup extends DataGroup
	{
	    public function GeoJSONFeedDataGroup()
	    {
	        super();
	
	        this.itemRenderer = new ClassFactory(GeoJSONFeedItemRenderer);
	    }
	}
}