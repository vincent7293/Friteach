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
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

  <script type="text/javascript">
  function submitForm($sid){
    
    $('#teacherlist-'+$sid).submit();
    }
  </script>

  <style>
  .panel-primary {
    background-color: #337ab7;
  }
  .panel{
    margin-top: 10px;
  }
  #BottomBar {   /*控制最下方教導鈕*/
    background-color: #eee;
    border-color: #eee;
    -webkit-clip-path: ellipse(70% 90% at 50% 90%);
    min-height: 40px;
    bottom: 0px;
    transition: bottom 0.4s ease-in-out;
  }
  #BottomBar > .container > .text-center{
    padding-top: 2px;
  }
  .col-xs-12 > img {  
    float: none;
    display: block;
    margin: 0px auto;
    max-width:100%;
    height: auto;
    margin-top: 10px;
  }
  .ansblock {
    height: 40px;
    line-height:40px;
    margin-bottom:10px;
    border-radius: 50px;
    /*transition: bottom 0.4s ease-in-out;*/
  }
  .ansblock > form > div >button {
      vertical-align: baseline;
  }
  .ansblock > form > .col-xs-6 {
      text-align: right;
  }
  .ansblock > form > div {
    background-color: #EEE;
  }
  .modal-content {
    line-height: 25px;
  }
  .ansblock > form > .collapse {
    margin-bottom: 10px;
    transition-duration: 150ms;
  }
  .ansblock > form > div > .btn-primary.collapsed:after {
    content: "\f078";
  }
  .ansblock > form > div > .btn-primary:after {
      content: "\f077";
  }
  .selected {
      text-align: center;
      margin-bottom: -18px;
    margin-top: -10px;
      z-index: 1;
      background-color: transparent !important;
  }
  .selected > span {
    box-shadow: 0px 0px 10px 0px #333;
    font-size: small;
    border-radius: 50px;
  }
  </style>
  
<?php
include 'conn2db.php';

  $Q_ID=$_GET['questionid'];
  
  $Q_name = current($db->query("SELECT `Q_Title` FROM `q_list` WHERE Q_ID=$Q_ID")->fetch());
  $User_Name = current($db->query("SELECT `U_Name` FROM `user` u JOIN `q_list` q WHERE `Q_ID`=$Q_ID AND u.U_ID=q.U_ID")->fetch());
  $Q_Gender = current($db->query("SELECT `U_Gender` FROM `user` u JOIN `q_list` q WHERE `Q_ID`=$Q_ID AND u.U_ID=q.U_ID")->fetch());
  
  
    $Q_data = $db->query("SELECT  q.`Q_ID`, `Q_Title`, `Q_Detail`, `Q_Time`, `Q_Ground` ,`Q_Overyet` , u.`U_Username`, q.U_ID, `Q_img`,`Q_Subject`,g.`City`, s.`S_Name`, COUNT(`A_ID`) as countANS FROM `q_list` q 
  LEFT JOIN `ans_list` a ON q.Q_ID=a.Q_ID JOIN `ground` g ON q.Q_Ground=g.G_ID JOIN `user` u ON q.U_ID=u.U_ID JOIN `subject` s ON s.S_ID= q.Q_Subject WHERE q.Q_ID=$Q_ID
    GROUP BY q.`Q_ID`, `Q_Title`, `Q_Detail`, `Q_Time`, `Q_Ground`, `Q_Overyet` ,q.U_ID, `Q_img`,`Q_Subject`, s.`S_Name` ");
    
  $A_data = $db->query("SELECT  q.`Q_ID`, `A_ID`, a.`U_ID`, `A_Time`, `A_Detail` ,`A_Correct` ,g.`City`, `U_Name` , `U_Gender`,g.`City` FROM `ans_list` a 
  RIGHT JOIN `q_list` q ON q.Q_ID=a.Q_ID JOIN `user` u ON u.U_ID=a.U_ID JOIN `ground` g ON a.A_Ground=G.G_ID WHERE q.Q_ID=$Q_ID
    GROUP BY q.`Q_ID`, `A_ID`, a.`U_ID`, `A_Time`, `A_Detail` ,`A_Correct` , g.`City`, `U_Name` , `U_Gender` ,g.`City` ");
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

                <!-- 標題列 -->
                <div class="row">
                    <div class="col-xs-12">
                    <?php foreach($Q_data as $data){ ?>
					$U_Username = $data['U_Username'];
					$Q_Overyet = $data['Q_Overyet'];
                        <h2 class="page-header">
                           <div class="row">
                            <span class="col-sm-6"><?php echo $Q_name?></span>
                            <span class="col-sm-6 pull-right"><small><?php echo $data['S_Name']?></small></span><br>
                <span class="col-sm-6"><img src="img/<?php echo $Q_Gender?>.png" class="img-circle" alt="Cinque Terre" width="30" height="30">
                              <small><?php echo $User_Name?> &nbsp;<small><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $data['City'] ?></small></small>
                                </span>
                                <span class="col-sm-6 pull-right">
                                  <small><small>
                                <?php echo date("Y/m/d H:i",strtotime($data['Q_Time'])); //不顯示秒數 ?>
                                  </small></small>
                                </span>
                            </div>
             </h2>
                    </div>
                </div>
                <!-- /.row -->
        <div class="row" >
          <div class="margin col-xs-12" rows="5">
            <?php echo $data['Q_Detail']?>
          </div>
          <?php if($data['Q_img'] != NULL){?>
          <div class="col-xs-12">
            <img src="UpdateQuestionIMG/<?php echo $data['Q_img'];?>">
          </div>
          <?php }?>
                        <div class="panel panel-primary col-xs-10 col-xs-offset-1">
                            <div class="panel-heading">
                              <div class="row panel-primary">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $data['countANS']; ?></div>
                                        <div>New Answers!</div>
                                    </div>
                                </div>
                
                            </div>
                        </div>
                </div>
<!-- Begin 最下方教導鈕-->
                <?php if($U_Username!=$_SESSION['U_Username']){?>
      <nav class="navbar navbar-default navbar-fixed-bottom" id="BottomBar" role="navigation">
        <div class="container">
          <div class="text-center">
        <?php if($Q_Overyet == 0){?>
                      <button type="button" class="btn btn-warning" onclick="location.href='Answer_selfintroduction.php?questionid=<?php echo $data['Q_ID']; ?>'">我要教導</button>

        <?php }else if($Q_Overyet == 1){?>
        <button type="button" class="btn btn-warning"  disabled>FINISHED</button>
        <?php }?>
          </div>
        </div>
    </nav>
          <?php } ?>
<!-- End 最下方教導鈕-->


<!-- Begin 應徵人員列表 -->
  <?php if($U_Username == $_SESSION['U_Username']) {?>
    <div class="col-xs-12">
            <div class="row">
        <?php foreach($A_data as $ans){ ?>
                   <?php if($ans['A_Correct'] == 1){ ?>
          <!--被選為最佳解-->
                      <div class="ansblock" style="margin-bottom:25px;">
                        <div class="col-xs-12 selected">
                            <span class="label label-warning">已選擇此家教</span>
                        </div>
                   <?php }else{?>
                    <div class="ansblock">
                    <?php } ?>
                    <form method="POST" action="update_Q_Overyet.php" id="teacherlist-<?php echo $ans['U_ID']?>">
                            <input type="hidden" name="Q_ID" value="<?php echo $Q_ID; ?>"/>
                            <input type="hidden" name="Q_U_ID" value="<?php echo $data['U_ID'];?>"/>
                            <input type="hidden" name="U_ID" value="<?php echo $ans['U_ID'];?>"/>
                                  
                                      <div class="col-xs-2">
                                       <button type="button" class="btn btn-primary fa collapsed" data-toggle="collapse" data-target="#collapse-<?php echo $ans['U_ID']?>" id="collapsebtn-<?php echo $ans['U_ID']?>" data-parent="#mainans"></button><!-- 展開詳細內容紐 -->
                                       
                                        <!-- Begin 建議、提醒視窗 -->
                                            <div class="modal fade" id="myModal-<?php echo $ans['U_ID']?>" role="dialog">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h2 class="modal-title">建議</h2>
                                                  </div>
                                                  <div class="modal-body">
                                                    <h3>您選擇這位當教師之前，有以下幾點需要先提醒您:</h3>
                                                    <ul class="list-unstyled">
                                                      <li>◆若對方約您在深夜時刻到偏僻的地方，請慎重考慮</li>
                                                      <li>◆若遇到怪老師
                                                        <ul>
                                                          <li>趕緊向店家求救</li>
                                                          <li>播打110報警</li>
                                                        </ul>
                                                      </li>
                                                      <li>◆對方開價若是太高，請適當的商談</li>
                                                      <li>◆對方評價分數若是太低，請慎思</li>
                                                      <li>◆每個人的教學方式及學習能力都有落差，教導後若覺得良好，請給予相對應評價；若覺得不好，也請給予建議，請勿留下不當言論</li>
                                                    </ul>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="submitForm('<?php echo $ans['U_ID'] ?>')">確定</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        <!-- End 建議、提醒視窗 -->
                                        </div>
                                      <div class="col-xs-4" onclick="location.href='view_userprofile.php?U_ID=<?php echo $ans['U_ID']; ?>'">
                                      <img src="img/<?php echo $ans['U_Gender']?>.png" class="img-circle" alt="Cinque Terre" width="30" height="30">
                                      <?php echo $ans['U_Name']?></div>
    
                                      <div class="col-xs-6"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $ans['City']?>
                                      <?php echo date("m/d H:i",strtotime($ans['A_Time']))?>
                                      </div>
                                    <!-- Begin 展開的詳細內容 -->
                                    <div id="collapse-<?php echo $ans['U_ID']?>" class="collapse col-xs-12">
                                        <?php echo $ans['A_Detail']?> 
                                        
                                        <?php if($Q_Overyet == 0){?>
                                  <!--問題還未有解-->
                                        <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#myModal-<?php echo $ans['U_ID']?>" >
                                          選我<i class="fa fa-hand-paper-o" aria-hidden="true"></i></button>
                                        <?php }?>
                                    </div>
                                    <!-- End 展開的詳細內容 -->
                 </form>
                 </div>
       <?php }?><!--$ans-->
          </div>
      </div>
  <?php }?><!--$SESSION-->
    <!-- End 應徵人員列表 -->

<?php }?><!--$data-->
       </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<footer class="navbar-fixed-bottom">
              ©2016 Friteach
            </footer>
    </div>
    <!-- /#wrapper -->

</body>

</html>