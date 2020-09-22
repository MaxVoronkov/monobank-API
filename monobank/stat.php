<?php
session_start();
include('./header.php') ;
if (isset($_SESSION['login'])) {

?>
<div  id="mono_info">
<h3>Карты:</h3>
<hr>
<?php

include('./function/get_user_info.php');
bal_card();

?>
<a href="info_acc.php">more </a>
</div>
<?php
include('./nav.php');
?>
<div id="pagemenu">

    <form id="lim" action="stat.php" method="POST" enctype="multipart/form-data">
       <select  name="Card_name">
<?php  
           include('../inludes/db.php'); 
            $users_mono = mysqli_query($connection, "SELECT DISTINCT name  FROM `mono_user`");
             while ( ($users_mono_data = mysqli_fetch_assoc($users_mono)) ){
            ?>   
              <option value="<?php echo $users_mono_data['name'];?> "> <?php echo $users_mono_data['name']; ?></option> 
<?php
}
?>
        </select>
        За последние  <input type="text" name="lim" > дней.
    <input type="submit" value="OK">
    </form>

    <button id="copy" onclick="selectElementContents( document.getElementById('report_table') );">Select</button>
</div>
<div class="table-result">
	<table class="table table-striped" id="report_table" border="1" width="100%" >
<?php

include ('./function/get_stat.php');
$lim = $_POST['lim'] - 1;
$bayer = $_POST['Card_name'];
if (isset($lim) and isset($bayer) ) {
	statistic_card_day($lim, $bayer);

}




?>
	</table>
</div>
<?php
}else{
?>
  <script type="text/javascript">
location.replace("../login.php");
</script>
<?php
}

include('./footer.php');