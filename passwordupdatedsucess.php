<?php

            $db_host='db.mis.kuas.edu.tw';
            $db_name='s1102137107';
            $db_user ='s1102137107';
            $db_pass = '88888';
            $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
            $con=new mysqli($db_host,$db_user,$db_pass,$db_name);
            if(isset($_POST['submit']))
            {
                Passwordcheck();
            }

            function Passwordcheck()
            {
                 $U_Password=md5($_POST['U_Password']);
                 $U_ID=$_POST['U_ID'];
                 if(empty($U_Password))
                {
                    echo "<script language='javascript'>";
                    echo "alert('密碼未填寫，請返回輸入...')；history.go(-1)";
                    echo "</script>";
                }
                else
                {
                    global $con;
                    $query="SELECT * FROM user WHERE `U_ID`='$U_ID' AND `U_Password`='$U_Password' ";
                    $db=mysqli_query($con,$query) || die (mysqli_connect_error());
                    $fetch=mysqli_fetch_assoc($db);
                    if($fetch['U_Password']==$U_Password)
                    {
                        Newpasswordcheck();
                    }
                    else
                    {
                        echo "<script language='javascript'>";
                        echo "alert('您的密碼不正確，請重新輸入...');history.go(-1)";
                        echo "</script>";
                    }
                }
            }
          
             function Newpasswordcheck()
            {
                 $U_Newpassword=$_POST['U_Newpassword'];
                 $U_Newpasswordcheck=$_POST["U_Newpasswordcheck"];
                 $String_pass=mb_strlen($_POST['U_Newpassword']);
                 if($String_pass<6)
                 {
                    echo "<script language='javascript'>";
                    echo "alert('很抱歉，您的密碼字數不足，為了您的帳號安全，請遵循規定...');history.go(-1)";
                    echo "</script>";
                 }
                 else
                 {
                    if ($U_Newpassword==$U_Newpasswordcheck) 
                    {
                    Updated();
                    }
                    else
                    {
                            echo "<script language='javascript'>";
                            echo "alert('您輸入的密碼不一致，請重新輸入...');history.go(-1)";
                             echo "</script>";
                    }

                 }
             }

            function Updated()
            {
                global $con;
                $U_ID=$_POST['U_ID'];
                $U_Newpassword=md5($_POST['U_Newpassword']);
                $query= "UPDATE  user SET U_Password='$U_Newpassword' WHERE U_ID='$U_ID' ";
                mysqli_set_charset($con,"utf8");
                $data= mysqli_query($con,$query)|| die(mysqli_connect_error());
                if($data)
                {
                     echo "<script language='javascript'>";
                     echo "alert('密碼變更成功～');location.href='userprofile.php'";
                     echo "</script>";
                }
                else
                {
                    mysqli_connect_error();
                }
                mysqli_close($con);
            }      

?>



