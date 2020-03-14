<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
    	include '../conn2db.php';
		$subjectID=$_GET['subjectid'];
		if(isset($_GET['ISpopular'])) {
			$ISpopular=$_GET['ISpopular'];
		} else {
			$ISpopular=false;
		}
		$subjectname = current($db->query("SELECT `S_Name` FROM `subject` WHERE S_ID=$subjectID")->fetch());
		$sql="SELECT ac.`AC_ID`, `AC_Title`, `AC_Detail`, `AC_ACTime`, `AC_SignupTime`,`AC_InsertTime` , `AC_Ground`, `ac_signup_overyet`, `ac_q_overyet`, ac.U_ID, `S_ID`,g.`City`, COUNT(`AC_A_id`) as countACNUM , `U_Gender`
			FROM `ac_q_list` ac LEFT JOIN `ac_a_list` j ON ac.AC_ID=j.AC_ID
			JOIN `ground` g ON ac.AC_Ground=g.G_ID
			JOIN `user` u ON u.U_ID=ac.U_ID
			WHERE S_ID=$subjectID
			GROUP BY ac.`AC_ID`, `AC_Title`, `AC_Detail`, `AC_ACTime`, `AC_SignupTime`, `AC_InsertTime` , `AC_Ground`, `ac_q_overyet`, ac.U_ID, `S_ID` ,g.`City` ";
		if($ISpopular){		
			$activitylist = $db->query($sql."ORDER BY countACNUM DESC");
		} else {
			$activitylist = $db->query($sql."ORDER BY AC_InsertTime DESC");
		}
		date_default_timezone_set('Asia/Taipei');
		$current_date = date('Y-m-d H:i:s');
	?>
    <title><?php echo $subjectname; ?></title>
    <style>
		.questionall {
			padding-right: 0px; 
     		padding-left: 0px; 
		}
		#BottomBar {
			background-color: #eee;
    		border-color: #eee;
			-webkit-clip-path: ellipse(70% 90% at 50% 90%);
			min-height: 40px;
			bottom: 0px;
			transition: bottom 0.4s ease-in-out;
		}
		.Overyet {
			text-align: center;
			display:none;
		}
		.page-header > .btn-group {
			float:right;
		}
		.questionblock {
			border-bottom: 1px solid #efefef;
			background-color: #fafafa;
			font-size:1.2em;
			cursor:pointer;
		}
		td {
			vertical-align: middle !important;
		}
		#BottomBar > .container > .text-center{
			padding-top: 2px;
		}
		.hideUp {
			bottom: -40px !important;//隱藏底部發問列
		}
	</style>
</head>

<body>

    <div id="wrapper">
		<nav class="navbar navbar-default navbar-fixed-bottom" id="BottomBar" role="navigation">
  <div class="container">
  	<div class="text-center">
    	<button type="button" class="btn btn-warning" onclick="location.href='InsertActivity.php?subjectid=<?php echo $subjectID;?>'">我要辦活動</button>
  	</div>
  </div>
</nav>
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
                    <li>
                        <a href="​ac_subjectlist.php"><i class="fa fa-fw fa-calendar-check-o"></i> 活動</a>
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
                        <a href="../logout.php"><i class="fa fa-fw fa-sign-out"></i> 登出</a>
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
                        <h1 class="page-header">
                            <?php echo $subjectname; ?>
                            <span class="btn-group" role="group" aria-label="...">
                                <button type="button" class="btn <?php if($ISpopular){echo "btn-default"; }else{ echo "btn-primary"; } ?> "
								onclick="location.replace('ac_questionlist.php?subjectid=<?php echo $subjectID; ?>')">最新</button>
                                <button type="button" class="btn <?php if($ISpopular){echo "btn-primary"; }else{ echo "btn-default"; } ?>" 
                                onclick="location.replace('ac_questionlist.php?subjectid=<?php echo $subjectID; ?>&ISpopular=true')">熱門</button>
                            </span>
                        </h1>
                    </div>
                <!-- /.row -->
                <div class="col-lg-12 questionall">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                	<?php foreach($activitylist as $value){ 
									if($value['U_Gender']=='Male'){
										$Genderhtml = '<img class="genderimg" src="../img/Male.png">';
									}elseif($value['U_Gender']=='Female'){
										$Genderhtml = '<img class="genderimg" src="../img/Female.png">';
									}elseif($value['U_Gender']=='ad'){
										$Genderhtml = '<img class="genderimg" src="../img/廣a告d.png">';
									}
									$ac_q_overyet=$value['ac_q_overyet'];
									$ac_signup_overyet=$value['ac_signup_overyet'];
									$AC_ID=$value['AC_ID'];
									if($ac_q_overyet==0 && $value['AC_ACTime'] <= $current_date){
										$sql="UPDATE `ac_q_list` SET `ac_q_overyet`=1 WHERE `AC_ID`=$AC_ID";
										$db->exec($sql);//更新活動overyet
									}
									if($ac_signup_overyet==0 && $value['AC_SignupTime'] <= $current_date){
										$sql="UPDATE `ac_q_list` SET `ac_signup_overyet`=1 WHERE `AC_ID`=$AC_ID";
										$db->exec($sql);//更新報名overyet
									}
									?>
                                    <tr class="questionblock" onclick="location.href='Activity_page.php?activityid=<?php echo $value['AC_ID']; ?>'">
                                        <td class="Overyet"><?php echo $Overyethtml; ?></td>
                                        <td><?php echo $Genderhtml; ?> </td>
                                        <td><?php echo $value['AC_Title']; ?></td>
                                        <td><?php echo $value['City']; ?></td>
                                    	<td><i class="fa fa-comment" aria-hidden="true"> <?php echo $value['countACNUM']; ?></i></td>
                                    </tr>
                    				<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
             </div>
            <!-- /.container-fluid -->
            <footer style="margin-top:500px">
            	copright 2016
            </footer>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <script src="../js/scroll.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>
