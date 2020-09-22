<?php
session_start();
if (isset($_SESSION['login'])) {
include('../../inludes/db.php');
$nameacc = $_POST['mono_nameAcc'];
$tok = $_POST['mono_tokenAcc'];
include('./mono_api.php');


$returned_mono_acc = acc_api($tok);

$mono_name = $returned_mono_acc['name'];
$mono_accounts = $returned_mono_acc['accounts'];

foreach ($mono_accounts as $value) {
	$mono_id = $value['id'] ;
	$mono_curr = $value['currencyCode'] ;
	$mono_bal = $value['balance'] ;
	$mono_card_type = $value['type'] ;
	mysqli_query($connection, "INSERT INTO `mono_user`(`id`, `token`, `name`, `card_name`, `mono_id`, `balance`, `currency`, `type`) VALUES  (NULL, '$tok', '$nameacc','$mono_name', '$mono_id', '$mono_bal', '$mono_curr', '$mono_card_type');");
}
?>
  <script type="text/javascript">
location.replace("../index.php");
</script>
<?php
}else{
?>
  <script type="text/javascript">
location.replace("../../login.php");
</script>
<?php
}

