<?php
session_start();

$AC_ID=$_POST['AC_ID'];
$U_ID=$_POST['JOIN_U_ID'];
$G_ID=$_POST['G_ID'];

try{
	
	include '../conn2db.php';
	
		  	 
	$A_ID_Record=$db->query("SELECT `AC_ID`,`U_ID` FROM `ac_a_list`");
	$AC_Q_ARR=$A_ID_Record->fetchALL();
	$successful[]=0;
	$error[]=0;
	$result=0;
	$result2=0;

		 for($i=0;$i<count($AC_Q_ARR);$i++){
			 
				 if($AC_ID == $AC_Q_ARR[$i]['AC_ID'] && $U_ID != $AC_Q_ARR[$i]['U_ID']){ 
			        $successful[$i]=1;
					//echo "successful-";
					}elseif($AC_ID == $AC_Q_ARR[$i]['AC_ID'] && $U_ID == $AC_Q_ARR[$i]['U_ID']){
						$error[$i]=1;
						//echo "-error-";
				}
			}
			 $result=count($successful);
			 $result2=count($error);
			 
			 if($result2>1){
				 ?>
				 <script>
				 alert("報名過啦");
				 location.href=('Activity_page.php?activityid=<?php echo $AC_ID;?>');
				 
				 </script>
				 <?php
			}else{
				?>
				<script>
				alert("成功參加");
				</script>
				<?php $count= $db->exec("INSERT INTO `ac_a_list`(`AC_ID`, `U_ID`, `G_ID`) VALUES('$AC_ID','$U_ID','$G_ID')");
				
			    $A_ID=$db->lastInsertId();
				?>
				<script>
				location.href=('Activity_page.php?activityid=<?php echo $AC_ID?>');
				</script>
				<?php
			}
   
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
   

?>
