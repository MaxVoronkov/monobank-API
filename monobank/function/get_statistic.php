<?php
session_start();
if (isset($_SESSION['login'])) {


function all_stat($lim){
include('../inludes/db.php');
$mono_ta = mysqli_query($connection, "SELECT * FROM `mono_transaction` ORDER BY `date` DESC LIMIT ".$lim );
while ( $mono_ta_info = mysqli_fetch_assoc($mono_ta)) {
	$userinfo = $mono_ta_info['id_card'];
	$monouser = mysqli_query($connection, "SELECT * FROM `mono_user` WHERE `mono_id` = '$userinfo'" );
	$monouser_info = mysqli_fetch_assoc($monouser);
	if ($monouser_info['currency'] == '980') {
		$curr = 'UAH';
	}elseif ($monouser_info['currency'] == '978') {
		$curr = 'EUR';
	}elseif ($monouser_info['currency'] == '840') {
		$curr = 'USD';
	}elseif ($monouser_info['currency'] == '985') {
		$curr = 'PLN';
	}else{
		$curr = $monouser_info['currency'];
	}
	?>
	<tr>
     <th> <?php echo $mono_ta_info['date'] ?> </th>
     <th> <?php echo $mono_ta_info['description'] ?></th>
     <th> <?php echo str_replace(".", ",", $mono_ta_info['sum']/100) ?></th>
     <th> <?php echo str_replace(".", ",", $mono_ta_info['val_sum']/100) ?></th>
     <th> <?php echo $monouser_info['name'].' / '. $monouser_info['card_name'].'('.$curr.'/'.$monouser_info['type'].')' ?></th>
     <th>  <?php echo str_replace(".", ",", $mono_ta_info['ballance']/100) ?> </th>

   	</tr>
<?php
}
}

function stat_card($id){
	include('../inludes/db.php');
	$user_id = mysqli_query($connection, "SELECT * FROM `mono_user` WHERE `id` = ".(int) $id );
	$usr_data = mysqli_fetch_assoc($user_id);
	$monocardid = $usr_data['mono_id'];
	$mono_tra = mysqli_query($connection, "SELECT * FROM `mono_transaction`  WHERE `id_card` = '$monocardid' ORDER BY `date` DESC");
	while ( $mono_ta_info = mysqli_fetch_assoc($mono_tra)) {
	$userinfo = $mono_ta_info['id_card'];
	$monouser = mysqli_query($connection, "SELECT * FROM `mono_user` WHERE `mono_id` = '$userinfo'" );
	$monouser_info = mysqli_fetch_assoc($monouser);
	if ($monouser_info['currency'] == '980') {
		$curr = 'UAH';
	}elseif ($monouser_info['currency'] == '978') {
		$curr = 'EUR';
	}elseif ($monouser_info['currency'] == '840') {
		$curr = 'USD';
	}elseif ($monouser_info['currency'] == '985') {
		$curr = 'PLN';
	}else{
		$curr = $monouser_info['currency'];
	}
	?>
	<tr>
     <th> <?php echo $mono_ta_info['date'] ?> </th>
     <th> <?php echo $mono_ta_info['description'] ?></th>
     <th> <?php echo str_replace(".", ",", $mono_ta_info['sum']/100) ?></th>
     <th> <?php echo str_replace(".", ",", $mono_ta_info['val_sum']/100) ?></th>
     <th> <?php echo $monouser_info['name'].' / '. $monouser_info['card_name'].'('.$curr.'/'.$monouser_info['type'].')' ?></th>
     <th>  <?php echo str_replace(".", ",", $mono_ta_info['ballance']/100) ?> </th>

   	</tr>
<?php
}
}
}else{
?>
  <script type="text/javascript">
location.replace("../login.php");
</script>
<?php
}

