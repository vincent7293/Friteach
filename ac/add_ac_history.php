<?php
    session_start();
    if(isset($_SESSION['U_ID'])){
        $U_ID=$_SESSION['U_ID'];
  }else{
    echo "<script>location = 'login.php?error=1';</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>選擇科目</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .subject {
            margin-bottom: 10px;
        }
    </style>
    <?php
        include '../conn2db.php';
        $subjectlist = $db->query("SELECT `S_ID`, `S_Name` FROM `subject`");
    ?>
</head>

<body>

    <div id="wrapper">

      <!-- 導覽列 -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Logo+下拉式選單按鈕-->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../~s1102137107/">教藝</a>
            <!-- 搜尋列 -->
                <span>
                    <form action="search.php" method="get">
                        <input class="form-control" id="search" type="search" name="keyword" placeholder="Search">
                        <button class="btn btn-primary" type="submit">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                    </form>
                </span>
            <!-- 下拉式選單 -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="../userprofile.php"><i class="fa fa-fw fa-user-circle"></i> ​個人資料</a>
                    </li>
                    <li >
                        <a href="ac_subjectlist.php"><i class="fa fa-fw fa-calendar-check-o"></i> 活動</a>
                    </li>
                    <li id="navbarhistory">
                        <a href="javascript:;" data-toggle="collapse" data-target="#collapsehistory"><i class="fa fa-fw fa-file-o"></i> 紀錄 <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="collapsehistory" class="collapse navbar-collapse">
                            <li>
                                <a href="../answerhistory.php"><i class="fa fa-fw fa-file-text-o"></i> 教導紀錄</a>
                            </li>
                            <li>
                                <a href="../questionhistory.php"><i class="fa fa-fw fa-file-text"></i> 提問紀錄</a>
                            </li>
                            <li>
                                <a href="add_ac_history.php"><i class="fa fa-fw fa-file-text-o"></i> 活動舉辦紀錄</a>
                            </li>
                            <li>
                                <a href="signuphistory.php"><i class="fa fa-fw fa-file-text"></i> 活動參與紀錄</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="logout.php"><i class="fa fa-fw fa-sign-out"></i> 登出</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            提問歷史
                        </h1>
                    </div>
                </div>


            <div class="row">
                <div class="col-lg-12">
                       <div class="panel panel-default">
    <?php

        $db_host="db.mis.kuas.edu.tw";
        $db_name="s1102137107";
        $db_user="s1102137107";
        $db_pass="88888";
        $con=new mysqli($db_host,$db_user,$db_pass,$db_name);
        mysqli_set_charset($con,"utf8");
        $query=" SELECT * FROM ac_q_list WHERE U_ID='$U_ID'";
        $data=mysqli_query($con,$query) || die(mysqli_error()); 
        $fetch=mysqli_fetch_all($data,MYSQLI_BOTH);
    ?>
                           <div class="table-responsive">
                                    <table class="table table-striped table-hover ">
                                            <tr>
                                                <th>發起活動</th>
                                                <th>發布日期</th>
                                                <th>活動狀態</th>
                                                <th>參與人數</th>
                                            </tr>
      <?php        
                    foreach ($fetch as $row) 
                    {
                        $AC_ID = $row['AC_ID'];
                        ?>
                        <tr onclick='location.href="Activity_page.php?activityid=<?php echo $AC_ID?>"'> 
     <?php
                        echo "<td>".$row['AC_Title']."</td>";
                        echo "<td>".$row['AC_InsertTime']."</td>";
                        if($row['ac_q_overyet']==1)
                        {
                            $Overyet="已結束";
                        }
                        else
                        {
                            $Overyet="未結束";
                        }
                        echo "<form class='form-horizontal' method='POST' action='questioncomment.php'>";
                        echo "<td>".$Overyet."</td>";
                        echo "<input type='hidden' name='AC_ID' id='AC_ID' value='".$AC_ID."''/>";

                       if($row['ac_q_overyet']==1)
                        {
                                $query=" SELECT COUNT(U_ID) AS People FROM `ac_a_list` WHERE AC_ID=".$AC_ID."";
                                $data=mysqli_query($con,$query) || die(mysqli_error()); 
                                $fetch222=mysqli_fetch_all($data,MYSQLI_BOTH);  
                                $rows= $fetch222;
                                echo "<td>".$rows['People']."</td>";
                         }
                        else
                        {
                            echo "<td>活動未結束</td>";
                        }

                        echo "</tr>";
                        echo "</form>";
                    
                    }
      ?>
                                    </table>
                                  </div>
                               </div>
                           </div>
                       
                    </div>
                </div>

            </div><!--row-end-->

        </div><!--container-fluid-end-->

    </div><!--page-wrapper-end-->

</body>
  <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</html>