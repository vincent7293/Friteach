<?php

            $db_host='db.mis.kuas.edu.tw';
            $db_name='s1102137107';
            $db_user ='s1102137107';
            $db_pass = '88888';
            $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
            $con=new mysqli($db_host,$db_user,$db_pass,$db_name);
            if(isset($_POST['submit']))
            {
                Usercheck();
            }

            function Passwordcheck()
            {
                 $U_Password=$_POST['U_Password'];
                 $U_Comfirm=$_POST["U_Comfirm"];
                 $String_pass=mb_strlen($_POST['U_Password']);
                 if($String_pass<6)
                 {
                    echo "<script language='javascript'>";
                    echo "alert('很抱歉，您的密碼字數不足，為了您的帳號安全，請遵循規定...');history.go(-1)";
                    echo "</script>";

                 }
                 else
                 {
                 	if ($U_Password==$U_Comfirm) 
                 	{
          		    Emailcheck();
                 	}
                 	else
                 	{
                    	    echo "<script language='javascript'>";
                            echo "alert('您輸入的密碼不一致，請重新輸入...');history.go(-1)";
                    	     echo "</script>";
                 	}

                 }
             }

            function Usercheck()
            {
                global $con;
                $U_Username=$_POST["U_Username"];
                $String_user=mb_strlen($_POST['U_Username']);
                if($String_user<3)
                {
                	echo "<script language='javascript'>";
                	echo "alert('很抱歉，您的帳號不符合規定字數..');history.go(-1)";
                	echo "</script>";
                }
                $query="SELECT * FROM user WHERE U_Username='$U_Username'";
                $data= mysqli_query($con,$query)or die(mysqli_connect_error());
                $result=$con -> query($query);
                if($row=mysqli_fetch_array($data))
                {
                    echo "<script language='javascript'>";
                    echo "alert('很抱歉，你輸入的帳號已經被使用了，請重新填寫...');history.go(-1)";
                    echo "</script>";
                }
                else
                {
                    Passwordcheck();
                }
            }

            function Emailcheck()
            {
            	   global $con;
                $U_Email=$_POST['U_Email'];
                if(!filter_var($U_Email,FILTER_VALIDATE_EMAIL))
                {
                     echo "<script language='javascript'>";
                     echo "alert('您的電子郵件格式不正確哦，請重新輸入...');history.go(-1)";
                     echo "</script>";
                }
                $query="SELECT * FROM user WHERE U_Email='$U_Email'";
                $data= mysqli_query($con,$query)or die(mysqli_connect_error());
                $result=$con -> query($query);
                if($row=mysqli_fetch_array($data))
                {
                    echo "<script language='javascript'>";
                    echo "alert('很抱歉，你輸入的電子郵件已經被使用了，請重新填寫...');history.go(-1)";
                    echo "</script>";
                }
                else
                {
                	Phonecheck();
                }
            }

            function Phonecheck()
            {
                 $U_Phone=$_POST['U_Phone'];
                 $String_phone=mb_strlen($_POST['U_Phone']);
                 if($String_phone<=9)
                 {
                    echo "<script language='javascript'>";
                    echo "alert('很抱歉，您的手機號碼字數不足，請輸入正確的手機號碼...');history.go(-1)";
                    echo "</script>";

                 }
                 else
                 {
                 	Newuser();
                 }
             }

    function Newuser()
    {
             global $con;
             $U_Username=$_POST['U_Username'];
             $U_Password=md5($_POST['U_Password']);
             $U_Name=$_POST['U_Name'];
             $U_Email=$_POST['U_Email'];
             $U_Gender=$_POST['U_Gender'];
             $U_Birthday=$_POST['U_Birthday']; //不知道為啥年份如果有6個數字就會當掉
             $U_Phone=$_POST['U_Phone'];
             $U_Ground=$_POST['U_Ground'];
             $U_Specialty=$_POST['U_Specialty'];
             $query= "INSERT INTO  user (U_Username,U_Password,U_Name,U_Email,U_Gender,U_Birthday,U_Phone,U_Ground,U_Specialty) VALUES ('$U_Username','$U_Password','$U_Name','$U_Email','$U_Gender','$U_Birthday','$U_Phone','$U_Ground','$U_Specialty')"  ;
             mysqli_set_charset($con,"utf8");
             $data= mysqli_query($con,$query)or die(mysqli_connect_error());
             if($data)
             {
                     echo "<script language='javascript'>";
                     echo "alert('Friteach歡迎您的加入，非常感謝您的註冊，現在將帶您回首頁～');location.href='../~s1102137107/'";
                     echo "</script>";
             }
             else
             {
                mysqli_connect_error();
             }
             mysqli_close($con);
         }

?>



