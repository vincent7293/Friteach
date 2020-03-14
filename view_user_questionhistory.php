<?php
    session_start();
    if(isset($_SESSION['U_ID'])){
        $U_ID=$_SESSION['U_ID'];
	}else{
		echo "<script>location = 'login.php?error=1';</script>";
    }
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Friteach</title>

      <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


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
                <a class="navbar-brand" href="../~s1102137107/">教藝</a>
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
                        <a href="userprofile.php"><i class="fa fa-fw fa-user-circle"></i> ​個人資料</a>
                    </li>
                    <li>
                        <a href="ac/ac_subjectlist.php"><i class="fa fa-fw fa-calendar-check-o"></i> 活動</a>
                    </li>
                    <li id="navbarhistory">
                        <a href="javascript:;" data-toggle="collapse" data-target="#collapsehistory"><i class="fa fa-fw fa-file-o"></i> 紀錄 <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="collapsehistory" class="collapse navbar-collapse">
                            <li>
                        		<a href="answerhistory.php"><i class="fa fa-fw fa-file-text-o"></i> 教導紀錄</a>
                    		</li>
                    		<li>
                        		<a href="questionhistory.php"><i class="fa fa-fw fa-file-text"></i> 提問紀錄</a>
                    		</li>
                            <li>
                        		<a href="ac/add_ac_history.php"><i class="fa fa-fw fa-file-text-o"></i> 活動舉辦紀錄</a>
                    		</li>
                    		<li>
                        		<a href="ac/signuphistory.php"><i class="fa fa-fw fa-file-text"></i> 活動參與紀錄</a>
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
                        <h3 class="page-header">
                            提問歷史
                        </h3>
                    </div>
                </div>


            <div class="row">
                <div class="col-lg-12">
                       <div class="panel panel-default">
    <?php
        include 'conn2db.php';
        $view_U_ID=$_GET['userid'];
        $sql=" SELECT DATE_FORMAT(Q_Time,'%m/%d')AS Q_Time,Q_ID,Q_Title,Q_Overyet FROM q_list q  WHERE U_ID='$view_U_ID' ";
        $fetch=$db->query($sql);
    ?>
    	                     <div class="table-responsive">
                                    <table class="table table-striped table-hover ">
                                            <tr>
                                                <th>發問問題</th>
                                                <th>發問日期</th>
                                                <th>回答狀態</th>
                                                <th>評分</th>
                                            </tr>
      <?php        
                    foreach ($fetch as $row) 
                    {
                        ?>
                        <tr onclick='location.href="Question_page.php?questionid=<?php echo $row['Q_ID']?>"'> 
     <?php
                        echo "<td>".$row['Q_Title']."</td>";
                        echo "<td>".$row['Q_Time']."</td>";
                        if($row['Q_Overyet']==1)
                        {
                            $Overyet="已解決";
                        }
                        else
                        {
                            $Overyet="未解決";
                        }
                        echo "<form class='form-horizontal' method='POST' action='view_user_questioncomment.php'>";
                        echo "<td>".$Overyet."</td>";
                        echo "<input type='hidden' name='Q_ID' id='Q_ID' value='".$row['Q_ID']."''/>";

                       if($row['Q_Overyet']==1)
                        {                         
                            echo "<td><input type='submit'  class='btn btn-sm btn-primary' value='評分' /></td>";
                        }
                        else
                        {
                            echo "<td>×</td>";
                        }

                        echo "</tr>";
                        echo "</form>";
                    
                    }
      ?>
                                    </table>
                                  </div>
                               </div>
                               <button type="button" onclick="history.back()" class="btn btn-md btn-primary">返回上一頁</button>
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