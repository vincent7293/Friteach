<?php
session_start();
date_default_timezone_set("Asia/Taipei");

$Q_ID=$_POST['Q_ID'];
$U_ID=$_POST['U_ID'];
$A_Time=date("Y-m-d H:i:s");
$A_Ground=$_POST['G_ID'];
$A_Detail=$_POST['A_Detail'];

try{
	
	include 'conn2db.php';
	
		  	 
	$A_ID_Record=$db->query("SELECT `Q_ID`,`U_ID` FROM `ans_list`");
	$Q_ARR=$A_ID_Record->fetchALL();
	$successful[]=0;
	$error[]=0;
	$result=0;
	$result2=0;

		 for($i=0;$i<count($Q_ARR);$i++){
			 
				 if($Q_ID == $Q_ARR[$i]['Q_ID'] && $U_ID != $Q_ARR[$i]['U_ID']){ 
			        $successful[$i]=1;
					//echo "successful";
					}elseif($Q_ID == $Q_ARR[$i]['Q_ID'] && $U_ID == $Q_ARR[$i]['U_ID']){
						$error[$i]=1;
						//echo "error";
				}
			}
			 $result=count($successful);
			 $result2=count($error);
			 
			 if($result2>1){
				 ?>
				 <script>
				 alert("回答過啦");
				 location.href=('Question_page.php?questionid=<?php echo $Q_ID?>');
				 
				 </script>
				 <?php
			}else{
				?>
				<script>
				alert("成功應徵");
				</script>
				<?php $count= $db->exec("INSERT INTO `ans_list`(`Q_ID`, `U_ID`, `A_Time`, `A_Ground`, `A_Detail`) VALUES ('$Q_ID','$U_ID','$A_Time','$A_Ground','$A_Detail')");
				
			    $A_ID=$db->lastInsertId();
				?>
				<script>
				location.href=('Question_page.php?questionid=<?php echo $Q_ID?>');
				</script>
				<?php
			}
   
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
   

?>
