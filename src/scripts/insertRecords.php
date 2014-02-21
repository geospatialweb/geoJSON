<?php
require_once('database.php');

$records = 0;

$array = json_decode($_GET['json'], true);

$geometry = "POINT(" . $array[0]['Longitude'] . " " . $array[0]['Latitude'] . ")";

$sql = "insert into $table (Category, CatCode, SubCategory, SubCatCode, Name, Keywords, Description, Address, Unit, City, Postal_Code, Street_Number, Street_Name, Street_Type, Street_Dir, Phone, Fax, Email, URL, HTTP_URL, Latitude, Longitude, Comp_ID, geom)
		values (:category, :catcode, :subcategory, :subcatcode, :name, :keywords, :description, :address, :unit, :city, :postal_code, :street_number, :street_name, :street_type, :street_dir, :phone, :fax, :email, :url, :http_url, :latitude, :longitude, :comp_id, geography::STPointFromText(:geometry, 4326))";

$result = $connect->prepare($sql);
	
$result->bindValue(':category', $array[0]['Category']);
$result->bindValue(':catcode', $array[0]['CatCode']);
$result->bindValue(':subcategory', $array[0]['SubCategory']);
$result->bindValue(':subcatcode', $array[0]['SubCatCode']);
$result->bindValue(':name', $array[0]['Name']);
$result->bindValue(':keywords', $array[0]['Keywords']);
$result->bindValue(':description', $array[0]['Description']);
$result->bindValue(':address', $array[0]['Address']);
$result->bindValue(':unit', $array[0]['Unit']);
$result->bindValue(':city', $array[0]['City']);
$result->bindValue(':postal_code', $array[0]['Postal_Code']);
$result->bindValue(':street_number', $array[0]['Street_Number']);
$result->bindValue(':street_name', $array[0]['Street_Name']);
$result->bindValue(':street_type', $array[0]['Street_Type']);
$result->bindValue(':street_dir', $array[0]['Street_Dir']);
$result->bindValue(':phone', $array[0]['Phone']);
$result->bindValue(':fax', $array[0]['Fax']);
$result->bindValue(':email', $array[0]['Email']);
$result->bindValue(':url', $array[0]['URL']);
$result->bindValue(':http_url', $array[0]['HTTP_URL']);
$result->bindValue(':latitude', $array[0]['Latitude']);
$result->bindValue(':longitude', $array[0]['Longitude']);
$result->bindValue(':comp_id', $array[0]['Comp_ID']);
$result->bindValue(':geometry', $geometry);

$result->execute()
	or die('Invalid Query');

$records++;

echo $records;

$connect = null;
?>