<?php
include('../../inludes/db.php');
include('./mono_api.php');
$exchange = mono_exchange();
date_default_timezone_set('Europe/Kiev');
foreach ($exchange as $k => $val) {
	if ($val['currencyCodeA'] == 840 && $val['currencyCodeB'] == 980 ) {
			$norm_date = date_create();
			$mono_ex_date = date_format($norm_date, 'Y-m-d H:i:s');
			$buy = $val['rateBuy'];
			$shell = $val['rateSell'];
			$curr = 'USD - UAH';
			mysqli_query($connection, "INSERT INTO `mono_exchange` (`id`, `date`, `currency`, `buy`, `Sell`) VALUES  (NULL, '$mono_ex_date', '$curr','$buy', '$shell');");
		}elseif ($val['currencyCodeA'] == 978 && $val['currencyCodeB'] == 980 ) {
			$norm_date = date_create();
			$mono_ex_date = date_format($norm_date, 'Y-m-d H:i:s');
			$buy = $val['rateBuy'];
			$shell = $val['rateSell'];
			$curr = 'EUR - UAH';
			mysqli_query($connection, "INSERT INTO `mono_exchange` (`id`, `date`, `currency`, `buy`, `Sell`) VALUES  (NULL, '$mono_ex_date', '$curr','$buy', '$shell');");
		}
}


