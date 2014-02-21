<?php
require_once("database.php");

$count = 0;

$array = explode(',', $_GET['array']);

if ($_GET['condition'] == "=")
{
	$sql = "select longitude, latitude, $_GET[titlefield], $_GET[linkfield], $_GET[array]
			from $table
				where $_GET[filter] = :value
					order by $_GET[filter]";
}
else
{
	$sql = "select longitude, latitude, $_GET[titlefield], $_GET[linkfield], $_GET[array]
			from $table
				where $_GET[filter] like :value
					order by $_GET[filter]";
}

$result = $connect->prepare($sql);

$result->bindValue(':value', $_GET['value']);

$result->execute()
		or die('Invalid Query');

$assets = '{"type": "FeatureCollection", "features": [';

while ($record = $result->fetch())
{
	$features = '{"type": "Feature", "geometry": {"type": "Point", "coordinates": [' . round($record['longitude'], 5) . ', ' . round($record['latitude'], 5) . ']}, "properties": {"' . $_GET['titlefield'] . '": "' . $record[$_GET['titlefield']] . '", "' . $_GET['linkfield'] . '": "' . $record[$_GET['linkfield']] . '"';

	foreach ($array as $value)
	{
		$features .= ', "' . $value . '": "' . $record[$value] . '"';
	}

	$assets .= $features . '}},';

	$count++;
}

$assets = substr($assets, 0, -1) . ']}';

if ($count > 0)
{
	echo $assets;
}
else
{
	echo '[]';
}

$connect = null;
?>