<?php
session_start();
if (isset($_SESSION['login'])) {

function statistic_card_day($lim, $bayer){
include('../inludes/db.php');
$card_result = array();
$balance_sf = array();
$card_curr = mysqli_query($connection, "SELECT * FROM `mono_user` WHERE `name` = '$bayer'");
while ( $card_info_curr = mysqli_fetch_assoc($card_curr)) {
	if ($card_info_curr['currency'] == '980') {
				$curr = 'UAH';
			}elseif ($card_info_curr['currency'] == '978') {
				$curr = 'EUR';
			}elseif ($card_info_curr['currency'] == '840') {
				$curr = 'USD';
			}elseif ($card_info_curr['currency'] == '985') {
				$curr = 'PLN';
			}else{
				$curr = $card_info_curr['currency'];
			}
	$mono_id_card = $card_info_curr['mono_id'];
	$mono_type_card = $card_info_curr['type'];
	$cur_type_card = $mono_type_card.'/'.$curr;


$last = '-'.$lim.' day';
$today = date("H:i:s");
$date_cr = date_create($today);
date_modify($date_cr, $last);
$new_date = date_format($date_cr, 'Y-m-d');

$start = new DateTime($new_date);
$interval = new DateInterval('P1D');
$end = new DateTime($today);
$period = new DatePeriod($start, $interval, $end);
$day_result = array();
$day_sf = array();
foreach ($period as $date) {
$datedate = $date->format('Y-m-d');
	
	$mono_sell_exchange = '1';
	if ($curr == 'USD' or $curr == 'EUR') {
		$exchdate = $datedate.' 12'.'%' ;
		$cuurexsearch = $curr.'%';
		$mono_exch = mysqli_query($connection, "SELECT * FROM `mono_exchange` WHERE `date` LIKE '$exchdate' AND `currency` LIKE '$cuurexsearch'");
		$mono_exch_sell_data = mysqli_fetch_assoc($mono_exch);
		$mono_sell_exchange = $mono_exch_sell_data['Sell'];
	}

$day_sf["$datedate"] = array();
$day_result["$datedate"] = array();
$date_search = $datedate.'%';
$desc_search = 'Facebook';
$descor_search = 'FBPAY%';
$descor_search1 = 'Скасування. Facebook%';
$descor_search2 = 'Скасування. FBPAY%';




$ta_stat = mysqli_query($connection, "SELECT * FROM `mono_transaction` WHERE `date` LIKE '$date_search' AND (
`description` = '$desc_search' OR `description` LIKE '$descor_search' OR `description` LIKE '$descor_search1' OR `description` LIKE '$descor_search2') AND `id_card` = '$mono_id_card'");
while ($ta_sum = mysqli_fetch_assoc($ta_stat)) {
	$sum_exchange = floatval($ta_sum['val_sum'])*$mono_sell_exchange;
	array_push( $day_result[$datedate], $sum_exchange);
}
$bal_finish_date = mysqli_query($connection, "SELECT * FROM `mono_day_balance` WHERE `date` = '$datedate'  AND `acc_id` = '$mono_id_card' ");
$bal_finish = mysqli_fetch_assoc($bal_finish_date);
$bal_uah_finish = floatval($bal_finish['balance'])*$mono_sell_exchange;
array_push( $day_sf[$datedate], $bal_uah_finish);
}

$card_result["$cur_type_card"] = $day_result;
$balance_sf["$cur_type_card"] = $day_sf;
}




?>
	<thead class="thead-dark">
		<th> Дата</th>
		<th> Начало дня</th>
<?php
	foreach ($card_result as $key => $value) {
			 echo '<th>'.$key.'<br>Сумма гривны</th>';
			}unset($value);
?>
		<th> Со всех карт</th>
		<th> Конец дня</th>
	</thead>	
<?php
	 $datearr = array();
	 
	 $datearrfinish = array();
	 	foreach ($card_result as $k => $val) {
			foreach ($val as $key1 => $value1) {
				$datearr["$key1"] = array() ;
				
				$datearrfinish["$key1"] = array() ;
		}unset($value1);
	}unset($val);
	foreach ($card_result as $k => $val) {
			foreach ($val as $key1 => $value1) {
				$sum = array_sum($value1);
				array_push( $datearr["$key1"], $sum);
				
				array_push( $datearrfinish["$key1"], $balance_sf[$k][$key1][0]);
		}unset($value1);
	}unset($val);



foreach ($datearr as $key => $value) {
	
?>

<tr>
	<th><?php echo $key?></th>
	<th><?php echo $next_start ; ?></th>
<?php
	foreach ($value as $key1 => $value1) {
?>
	<th><?php echo str_replace(".", ",", round($value1/100, 2))?></th>
	
<?php
	}
?>
	<th><?php echo str_replace(".", ",", round(array_sum($value)/100, 2));?></th>
	<th><?php echo $next_start = str_replace(".", ",", round(array_sum($datearrfinish[$key])/100, 2)); ?></th>
</tr>

<?php
}
}
}
else{
?>
  <script type="text/javascript">
location.replace("../login.php");
</script>
<?php
}