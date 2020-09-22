<?php


function bal_card(){
	include('../inludes/db.php');
	$monouser = mysqli_query($connection, "SELECT * FROM `mono_user` ORDER BY `balance` ASC LIMIT 5" );
	while ($monouser_info = mysqli_fetch_assoc($monouser)) {
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
		echo $monouser_info['name'].'('.$curr.'/'.$monouser_info['type'].') - '.$monouser_info['balance']/100;
		echo '<hr>';
	}
}

function info_all(){
?>
	<div class="accordion" id="accordionExample">
	<?php
	include('../inludes/db.php');
	$take_bayer= mysqli_query($connection, "SELECT DISTINCT card_name, token, name FROM `mono_user`");
	$h = 1;

	while ( $mono_bay_name = mysqli_fetch_assoc($take_bayer)) {
?>
	  <div class="card">
	    <div class="card-header" id="heading<?php echo $h;?>">
	      <h5 class="mb-0">
	        <button id="mbut" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $h;?>" aria-expanded="false" aria-controls="collapse<?php echo $h;?>">
	         	<?php echo $mono_bay_name['card_name'].' ('.$mono_bay_name['name'].')'; ?>
	        </button>
	      </h5>
	    </div>
	    <div id="collapse<?php echo $h;?>" class="collapse" aria-labelledby="heading<?php echo $h;?>" data-parent="#accordionExample">
	      <div class="card-body">
	        <div id="cardtable">
	        <table class="table table-striped">
	<?php
	$tokkk = $mono_bay_name['token'];
	$mono_gc = mysqli_query($connection, "SELECT * FROM `mono_user` WHERE `token` = '$tokkk'");
	$n = 1;
	while ($mono_carrds = mysqli_fetch_assoc($mono_gc)) {
			if ($mono_carrds['currency'] == '980') {
				$curr = 'UAH';
			}elseif ($mono_carrds['currency'] == '978') {
				$curr = 'EUR';
			}elseif ($mono_carrds['currency'] == '840') {
				$curr = 'USD';
			}elseif ($mono_carrds['currency'] == '985') {
				$curr = 'PLN';
			}else{
				$curr = $monouser_info['currency'];
			}
	    ?>
	      <tr>
	        <th><?php echo $n.'.';?></th>
	        <th><?php echo $mono_carrds['balance']/100;?></th>
	        <th><?php echo $curr;?></th>
	         <th><?php echo $mono_carrds['type'];?></th>

	          <th><a href="onecardta.php?id=<?php echo $mono_carrds['id'];?>"><button>ИНФО</button></a></th>
	      </tr>
	<?php
	$n++;
	}
	?>
	        </table>
	      </div>
	     </div>
	    </div>
	  </div>
	<?php
	$h++;
	}
	?>

	</div>
<?php	
}


