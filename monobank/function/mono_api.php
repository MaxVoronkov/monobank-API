<?php
function acc_api($tok){

$url = "https://api.monobank.ua/personal/client-info";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//для возврата результата в виде строки, вместо прямого вывода в браузер
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
	"Content-Type: application/json",
 	"X-Token: ".$tok
));
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$returned_mono = curl_exec($ch);
curl_close ($ch);
$result_mono = json_decode($returned_mono, true);
return $result_mono;
}


function transaction($tok, $id_acc, $time){

$today = date("Y-m-d H:i:s");
$date_end = date_create($today);
$date_cr = date_create($today);
date_modify($date_cr, $time);
$new_date = date_format($date_cr, 'Y-m-d H:i:s');
$unix_date_start = date_timestamp_get($date_cr);
$unix_date_end = date_timestamp_get($date_end );


$url = "https://api.monobank.ua/personal/statement/".$id_acc."/".$unix_date_start;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//для возврата результата в виде строки, вместо прямого вывода в браузер
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
	"Content-Type: application/json",
 	"X-Token: ".$tok
));
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$returned = curl_exec($ch);
curl_close ($ch);
$result_mono = json_decode($returned, true);
return $result_mono;
}

function mono_exchange (){
	$url = "https://api.monobank.ua/bank/currency";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//для возврата результата в виде строки, вместо прямого вывода в браузер
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    "Accept: application/json",
		"Content-Type: application/json"
	));
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	$returned = curl_exec($ch);
	curl_close ($ch);
	$result_mono = json_decode($returned, true);
	return $result_mono;

}