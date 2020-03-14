<?php

      session_start();
      $db_host="db.mis.kuas.edu.tw";
      $db_name="s1102137107";
      $db_user="s1102137107";
      $db_pass="88888";
      $con=new mysqli($db_host,$db_user,$db_pass,$db_name);

      $U_Username=$_POST['U_Username'];
      $U_Password=md5($_POST['U_Password']);
      $BackToPreviousPage=$_POST['BackToPreviousPage'];
      $PreviousPagePath=$_POST['PreviousPagePath'];
      if(isset($_POST['submit']))
      {
        if(empty($U_Password)||empty($U_Username))
        {
          echo "<script language='javascript'>";
          echo "alert('您的帳號或密碼尚未填寫，請重新輸入...')；history.go(-1)";
          echo "</script>";
        }
        else
        {

          $stmt = $mysqli->prepare("SELECT * FROM user WHERE `U_Username`=? AND `U_Password`=?";)
          $stmt->bind_param('sss',$U_Username,$U_Password);
          $db=mysqli_query($con,$sql) || die (mysqli_connect_error());
          $rows=mysqli_num_rows($db);
          $fetch=mysqli_fetch_assoc($db);
          if($fetch['U_Username']==$U_Username)
          {
            $_SESSION['Login_User']=$U_Username;
            $_SESSION["U_Username"]=$U_Username;
                $_SESSION["U_ID"]=$fetch["U_ID"];
        if($BackToPreviousPage){
           header("location:$PreviousPagePath");
        }else{
              header("location:../~s1102137107/");
        }
          }
          else
          {
            echo "<script language='javascript'>";
            echo "alert('您的帳號或密碼不正確，請重新輸入...');history.go(-1)";
            echo "</script>";
          }
          mysqli_close($con);
        }
      }else{
      echo "eeee";
    }

?>