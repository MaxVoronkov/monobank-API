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












}else{
?>
  <script type="text/javascript">
location.replace("../login.php");
</script>
<?php
}

include('./footer.php');