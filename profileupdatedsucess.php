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
                    $db=mysqli_query($con,$query)or die (mysqli_connect_error());
                    $rows=mysqli_num_rows($db);
                    $fetch=mysqli_fetch_assoc($db);
                    if($fetch['U_Password']==$U_Password)
                    {
                        Emailcheck();
                    }
                    else
                    {
                        echo "<script language='javascript'>";
                        echo "alert('您的密碼不正確，請重新輸入...');history.go(-1)";
                        echo "</script>";
                    }
                }
            }
          
             function Emailcheck()
            {
                $U_Email=$_POST['U_Email'];
                if(!filter_var($U_Email,FILTER_VALIDATE_EMAIL))
                {
                     echo "<script language='javascript'>";
                     echo "alert('您的電子郵件格式不正確哦，請重新輸入...');history.go(-1)";
                     echo "</script>";
                }
                else
                {
                    Updated();
                }
            }

            function Updated()
            {
                global $con;
                $U_ID=$_POST['U_ID'];
                $U_Email=$_POST['U_Email'];
                $U_Phone=$_POST['U_Phone'];
                $U_Specialty=$_POST['U_Specialty'];
                $U_Self_Introduction=$_POST['U_Self_Introduction'];
                $query= "UPDATE  user SET U_Email='$U_Email',U_Phone='$U_Phone',U_Specialty='$U_Specialty',U_Self_Introduction='$U_Self_Introduction' WHERE U_ID='$U_ID' ";
                mysqli_set_charset($con,"utf8");
                $data= mysqli_query($con,$query)or die(mysqli_connect_error());
                if($data)
                {
                     echo "<script language='javascript'>";
                     echo "alert('編輯成功～');location.href='userprofile.php'";
                     echo "</script>";
                }
                else
                {
                    mysqli_connect_error();
                }
                mysqli_close($con);
            }      

?>



