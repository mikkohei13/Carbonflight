<?php
header('Content-Type: text/html; charset=utf-8'); 
   
   
echo "<pre>"; // DEBUG

$from = ($_GET['from']); // DEBUG
$to = ($_GET['to']); // DEBUG


require_once "../testdata.php";


foreach ($to as $key => $singleTo)
{
	$result[$key] =  $distance[$from][$singleTo] * $carbonKgPerKm;
}


$json = json_encode($result);


echo "<hr />";
print_r ($result);
print_r ($json);

?>