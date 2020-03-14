<?php
        $db_host="db.mis.kuas.edu.tw";
        $db_name="s1102137107";
        $db_user="s1102137107";
        $db_pass="88888";
        $con=new mysqli($db_host,$db_user,$db_pass,$db_name);
        if(isset($_POST['submit']))
        {
                star();
        }

        function star()
        {
          $starvalue=$_POST['starvalue'];
          if($starvalue==null)
          {
                  echo "<script language='javascript'>";
                    echo "alert('您忘了為回答者進行評級了哦，請填寫後再繼續～');history.go(-1)";
                    echo "</script>";
          }
          else
          {
                 db();          
         }

        }

        function db()
        {
          global $con;
          $starvalue=$_POST['starvalue'];
          $comment=$_POST['comment'];
          $A_ID=$_POST['A_ID'];
          $query="UPDATE ans_list SET A_Star='$starvalue',A_Comment='$comment' WHERE A_ID='$A_ID'";
          mysqli_set_charset($con,"utf8");
          $data=mysqli_query($con,$query)|| die(mysql_connect_error());
          if($data)
             {
                     echo "<script language='javascript'>";
                     echo "alert('感謝您的評分～');location.href='questionhistory.php'";
                     echo "</script>";
             }
             else
             {
                mysqli_connect_error();
             }
             mysqli_close($con);
         }

   
?>