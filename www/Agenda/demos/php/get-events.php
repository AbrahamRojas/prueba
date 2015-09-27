<?php

//--------------------------------------------------------------------------------------------------
// This script reads event data from a JSON file and outputs those events which are within the range
// supplied by the "start" and "end" GET parameters.
//
// An optional "timezone" GET parameter will force all ISO8601 date stings to a given timezone.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
$usuario=$_REQUEST['user'];
// Require our Event class and datetime utilities
require dirname(__FILE__) . '/utils.php';
$range_start = parseDateTime("2015-09-04");//$_GET['start']
$range_end = parseDateTime("2015-09-24");//$_GET['end']

// Short-circuit if the client did not give us a date range.
if (!isset($range_start) || !isset($range_end)) {
	die("Please provide a date range.");
}

// Parse the start/end parameters.
// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
// Since no timezone will be present, they will parsed as UTC.

// Parse the timezone parameter if it is present.
$timezone = null;
if (isset($_GET['timezone'])) {
	$timezone = new DateTimeZone($_GET['timezone']);
}

// Read and parse our events JSON file into an array of event data arrays.

$link = mysqli_connect("localhost", "sumaton", "3quipo3mpowerL4bs");
//$link = mysqli_connect("localhost", "root", "");	
mysqli_select_db($link, "ecolearning_sumaton");
//$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
$result = mysqli_query($link, "SELECT * FROM logs WHERE '$usuario' = usuario ORDER BY 'Date' ASC");// WHERE '$usuario' = usuario 
$i=1;

while ($fila = mysqli_fetch_array($result)){

$resultados=$fila; 
if($i==1)
{
$array1[]=array('title'=>utf8_encode($resultados['Activities']),'color' => '#A1A6BB' ,'start'=>utf8_encode($resultados['Date']."T".$resultados['StartTime']));	
}

$array1[]=array('id'=>utf8_encode($resultados['ID_Logs']),'color' => '#A1A6BB' ,'title'=>utf8_encode($resultados['Activities']),'start'=>utf8_encode($resultados['Date']."T".$resultados['StartTime']));

$i++;
}
$Arrays=array(json_encode($array1));
$recorse= implode($Arrays);
$rect1 =json_decode($recorse);
echo json_encode($rect1);
$encoder =  json_encode($rect1);



mysqli_free_result($result);
mysqli_close($link);


/*
//$json = file_get_contents(dirname(__FILE__) . '/../json/events.json');
$input_arrays = $rect1;

// Accumulate an output array of event data arrays.
$output_arrays = array();
foreach ($input_arrays as $array) {

	// Convert the input array into a useful Event object
	$event = new Event($array, $timezone);

	// If the event is in-bounds, add it to the output
	if ($event->isWithinDayRange($range_start, $range_end)) {
		$output_arrays[] = $event->toArray();
	}
}

// Send JSON to the client.
echo json_encode($output_arrays);*/
?>