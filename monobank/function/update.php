<?php
session_start();
if (isset($_SESSION['login'])) {
	date_default_timezone_set('Europe/Kiev');
	include('./mono_api.php');
	include('../../inludes/db.php');
	$mono_user = mysqli_query($connection, "SELECT DISTINCT token FROM `mono_user`" );
	while ( $mono_user_info = mysqli_fetch_assoc($mono_user)) {
		$tok = $mono_user_info['token'];
		$returned_mono_acc = acc_api($tok);
		$mono_accounts = $returned_mono_acc['accounts'];
foreach ($mono_accounts as $value) {
	$mono_id = $value['id'] ;
	$mono_bal = $value['balance'] ;
	mysqli_query($connection, "UPDATE `mono_user` SET `balance` = '$mono_bal' WHERE `mono_id` = '$mono_id'"   );
}unset($value);

}

$time = '-30 day';
$monouser = mysqli_query($connection, "SELECT * FROM `mono_user`" );
while ( $monouser_info = mysqli_fetch_assoc($monouser)) {
$tok = $monouser_info['token'];
$id_acc = $monouser_info['mono_id'];
$mono_ta = transaction($tok, $id_acc, $time);
foreach ($mono_ta as $k => $value1) {
	$mono_ta_id = $value1['id'];
	$normdate = date_create();
	date_timestamp_set($normdate, $value1['time']) ;
	$mono_ta_date = date_format($normdate, 'Y-m-d H:i:s');
	$mono_amount = $value1['operationAmount'];
	$mono_amount_val = $value1['amount'];
	$mono_description = $value1['description'];
	$mono_balance = $value1['balance'];
	mysqli_query($connection, "INSERT INTO `mono_transaction` (`id`, `ta_mono_id`, `date`, `description`, `sum`, `val_sum`, `id_card`, `ballance`) VALUES  (NULL, '$mono_ta_id', '$mono_ta_date','$mono_description', '$mono_amount', '$mono_amount_val', '$id_acc', '$mono_balance');");
}
}
?>
  <script type="text/javascript">
location.replace(history.go(-1));
</script>
<?php
}else{
?>
  <script type="text/javascript">
location.replace("../../login.php");
</script>
<?php
}

