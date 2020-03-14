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
    <style>
		.img-circle {
			float: right;
		}
	</style>
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
                        <h1 class="page-header">
                            基本資料
                            <?php
		include 'conn2db.php';
        $sql="SELECT * FROM user WHERE U_ID='$U_ID' ";
        $fetch=$db->query($sql);
        foreach ($fetch as $row) {
    ?>

        <?php
                        if($row['U_Gender']=='Male')
                        {
                            echo '<img src="img/Male.png" class="img-circle" alt="Cinque Terre" height="40" width="40"><br>';
                        }
                        else
                        {
                            echo '<img src="img/Female.png" class="img-circle" alt="Cinque Terre" height="40" width="40"><br>';
                        }
    ?>
                            </h1>
                    </div>
                </div>
            <div class="row">
                <div class="col-lg-12">
                       <div class="panel panel-default">


            <div class="row">
                <div class="col-lg-12">

                        </div>
                        </div>

                               <div class="table-responsive">
                                    <table class="table table-striped table-hover ">
                                            <tr>
                                                <td>名字</td>
                                                <td> <?php echo $row['U_Name'];?></td>
                                            </tr>
                                            <tr>
                                                <td>性別</td>
                                                <td><?php echo $row['U_Gender'];?></td>
                                            </tr>
                                            <tr>
                                                <td>電子郵件</td>
                                                <td><?php echo $row['U_Email'];?></td>
                                            </tr>
                                            <tr>
                                                <td>生日</td>
                                                <td><?php echo $row['U_Birthday'];?></td>
                                            </tr>
                                            <tr>
                                                <td>電話</td>
                                                <td><?php echo $row['U_Phone'];?></td>
                                            </tr>
                                            <tr>
                                                <td>專長</td>
                                                <td><?php echo $row['U_Specialty'];?></td>
                                            </tr>
                                            <tr>
                                                <td>自我介紹</td>
                                                <td><?php echo $row['U_Self_Introduction'];?></td>
                                            </tr>
                                            <tr>
                                                <td>工作</td>
                                                <td><?php echo $row['U_Job'];  }?></td>
                                            </tr>
                                            <tr>
                                                <td>提問次數（已被評分）</td>

                                    <?php 
                                               $sql="SELECT u.U_ID,COUNT(q.Q_star) AS q_star FROM user AS u JOIN q_list AS q  WHERE q.U_ID='$U_ID'  AND u.U_ID='$U_ID'  GROUP BY u.U_ID ";
                                                $fetch=$db->query($sql);
                                                foreach ($fetch as $row) {
                                    ?>
                                                <td><?php echo $row['q_star'];}  ?></td>
                                            </tr>

                                            <tr>
                                                <td>提問總分</td>

                                    <?php 
                                               $sql="SELECT u.U_ID,IFNULL(ROUND(SUM(q.Q_Star)/COUNT(q.Q_star),1),0) AS q_star FROM user AS u JOIN q_list AS q  WHERE q.U_ID='$U_ID'  AND u.U_ID='$U_ID'  GROUP BY u.U_ID ";
                                                $fetch=$db->query($sql);
                                                foreach ($fetch as $row) {
                                    ?>
                                                <td><?php echo $row['q_star'];}  ?></td>
                                           </tr>
                                           <tr>
                                                <td>教導次數（已被評分）</td>

                                    <?php 
                                               $sql="SELECT u.U_ID,COUNT(a.A_star) AS a_star FROM user AS u JOIN ans_list AS a  WHERE a.U_ID='$U_ID'  AND u.U_ID='$U_ID'  GROUP BY u.U_ID ";
                                                $fetch=$db->query($sql);
                                                foreach ($fetch as $row) {
                                    ?>
                                                <td><?php echo $row['a_star'];  }?></td>
                                            </tr>                
                                           <tr>
                                                <td>教導總分</td>

                                    <?php 
                                               $sql="SELECT u.U_ID,IFNULL(ROUND(SUM(a.A_Star)/COUNT(a.A_star),1),0) AS a_star FROM user AS u JOIN ans_list AS a  WHERE a.U_ID='$U_ID'  AND u.U_ID='$U_ID'  GROUP BY u.U_ID ";
                                                $fetch=$db->query($sql);
                                                foreach ($fetch as $row) {
                                    ?>
                                                <td><?php echo $row['a_star'];  ?></td>
                                            </tr>                                            



                                    </table>
                                </div>

<?php }?>
                            </div>
                       
         
                <a href="profileupdated.php"><button type="button" class="btn btn-md btn-primary">編輯個人資料</button></a>
                <a href="passwordupdated.php"><button type="button" class="btn btn-md btn-primary">更換密碼</button></a>

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