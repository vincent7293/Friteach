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
  
  <meta name="viewport" content="width=device-width, initial-scale=1">  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="css/style.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
  #G_ID {
    padding-left: calc(50vw - 45px);
  }
  </style>
  
<?php
$U_Username=$_SESSION['U_Username'];


  include 'conn2db.php';

  $Q_ID=$_GET['questionid'];
  $U_ID= current($db->query("SELECT `U_ID` FROM `user` WHERE `U_Username`='$U_Username'")->fetch());
  
  $Q_name = current($db->query("SELECT `Q_Title` FROM `q_list` WHERE Q_ID=$Q_ID")->fetch());
  $User_Name = current($db->query("SELECT `U_Name` FROM `user` u JOIN `q_list` q WHERE `Q_ID`=$Q_ID AND u.U_ID=q.U_ID")->fetch());
  $Q_Gender = current($db->query("SELECT `U_Gender` FROM `user` u JOIN `q_list` q WHERE `Q_ID`=$Q_ID AND u.U_ID=q.U_ID")->fetch());
    
    $Q_data = $db->query("SELECT  q.`Q_ID`, `Q_Title`, `Q_Detail`, `Q_Time`, `Q_Ground` ,`Q_Overyet` , u.`U_Username`, q.U_ID, `Q_Subject`,g.`City`, s.`S_Name`, COUNT(`A_ID`) as countANS FROM `q_list` q 
  LEFT JOIN `ans_list` a ON q.Q_ID=a.Q_ID JOIN `ground` g ON q.Q_Ground=g.G_ID JOIN `user` u ON q.U_ID=u.U_ID JOIN `subject` s ON s.S_ID= q.Q_Subject WHERE q.Q_ID=$Q_ID
    GROUP BY q.`Q_ID`, `Q_Title`, `Q_Detail`, `Q_Time`, `Q_Ground`, `Q_Overyet` ,q.U_ID, `Q_Subject`, s.`S_Name` ");
   
    $A_data = $db->query("SELECT  q.`Q_ID`, `A_ID`, a.`U_ID`, `A_Time`, `A_Detail` ,`A_Correct` ,g.`City`, `U_Name` , `U_Gender`,g.`City` FROM `ans_list` a 
  RIGHT JOIN `q_list` q ON q.Q_ID=a.Q_ID JOIN `user` u ON u.U_ID=a.U_ID JOIN `ground` g ON a.A_Ground=G.G_ID WHERE q.Q_ID=$Q_ID
    GROUP BY q.`Q_ID`, `A_ID`, a.`U_ID`, `A_Time`, `A_Detail` ,`A_Correct` , g.`City`, `U_Name` , `U_Gender` ,g.`City` ");
  
  $A_City=$db->query("SELECT * from ground ORDER BY G_ID ASC");
  $Now_City=$db->query("SELECT * from ground g join user u ON g.G_ID=u.U_Ground WHERE u.U_Username='$U_Username' ");
  
  


?>
<title><?php echo $Q_name; ?></title>
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

                <!-- Page Heading -->
                <div class="row">
                    
                    <div class="col-lg-12">
                    <?php foreach($Q_data as $data){ ?>
                        <h2 class="page-header">
                           <div class="row">
                            <span class="col-sm-6"><?php echo $Q_name?></span>
                            <span class="col-sm-6 pull-right"><small><?php echo $data['S_Name']?></small></span><br>
                <span class="col-sm-6"><img src="img/<?php echo $Q_Gender?>.png" class="img-circle" alt="Cinque Terre" width="30" height="30">
                              <small><?php echo $User_Name?> &nbsp;<small><i class="fa fa-map-marker" aria-hidden="true"><?php echo $data['City'] ?></i></small></small>
                                </span>
                                <span class="col-sm-6 pull-right">
                                  <small><small>
                                <?php echo $data['Q_Time']?>
                                </small></small>
                                </span>
                            </div>
             </h2>
                         <?php } ?>
                    </div>
                </div>
                <!-- /.row -->
        <form method="POST" action="insert_answer.php">
        <input type="hidden" name="Q_ID" value="<?php echo $Q_ID; ?>"/>
        <input type="hidden" name="U_ID" value="<?php echo $U_ID; ?>"/>
                <div class="row">
        
        <div class="col-md-6">
          <select class="form-control" name="G_ID" id="G_ID">
            <?php foreach($Now_City as $now){ ?>
            <option value="<?php echo $now['G_ID']; ?>" selected><?php echo $now['City'] ?></option>
            <?php }?>
              <?php foreach($A_City as $anscity){?>
              <option value="<?php echo $anscity['G_ID']; ?>"><?php echo $anscity['City']?></option>
              <?php }?>
          </select>
        </div>
        <div class="form-group col-md-12">
          <label for="comment">自我推薦:</label>
          <textarea class="form-control" rows="5" id="comment" name="A_Detail" placeholder="可以寫點個人資料以外的強項，強力推薦自己的優點，或是留下聯絡方式及可教學的時間地點"></textarea>
        </div>
        
        <div class="col-md-6">
         <input type="submit" value="GO-TEACH" class="btn btn-primary center-block" />
        </div>
                </div>
        </form>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>