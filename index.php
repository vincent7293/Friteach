<?php
session_start();
    if(isset($_SESSION['U_ID'])){
		echo "<script>location = 'subjectlist.php';</script>";
	}else{
		echo "<script>location = 'login.php?error=1';</script>";
    }
	
?>
