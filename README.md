geoJSON
=======

I got tired of working with XML so I decided to give geoJSON a whirl. I wanted a lightweight transport format relative to XML and JSON is just the ticket. I must admit that geoJSON was a challenge but it was an emerging standard at the time so I figured it was a good thing to learn and promote.

geoJSON is an unbalanced multi-dimensional construct that is difficult to parse on the client and a bitch to create on the server without an available PHP class one can import. And PHP is nuts with single and double quote marks - sometimes they are interchangeable and sometimes you have to guess which one you must use from one line of code to the next. And SQL statements with embedded GET variables adds to the complexity.

I was lucky I had any hair left, but eventually I did manage to create a routine in PHP to produce perfect geoJSON output. (scripts\partial_geoJSON_output_string.txt) That piece of magic is the geoJSONFeed.php script that I wrote trial and error without any debugging tools. I know enough PHP to write REST scripts on the server to get the data from a SQL database and ship it back to the client.

I want to work with node.js and express.js so I can use JavaScript on both ends to simplify the process and that is my next project.

In this case, I was working with MS SQL so the geographic coordinates were stored as text lat and lng plus as an OGC-compliant spatial Point datatype so spatial intersect queries could be performed in the database - which wins hands down relative to the same process using ArcGIS Server and REST geoprocessing services.

As an aside, if one needs to perform a spatial intersect with a polygon, ArcGIS Server cannot handle geometry with more than 250 vertices. It just craps out forcing one to generalize the geometry using distance deviation factors that vary for each geometry. I also needed to convert my geometry into WKT for the REST services since ESRI does not provide a class to do that.

I figure ESRI wants us all to pay outrageous licensing fees for ArcGIS Server so one can use their JPEG map services with no objects returned to the developer.

That is the reason why I have moved to open source and away from proprietary solutions.
