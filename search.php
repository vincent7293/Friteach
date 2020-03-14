<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>搜尋結果</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
		.genderimg {
			width: 40px;
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
		.questionall {
			padding-right: 0px; 
     		padding-left: 0px; 
			margin-left: -15px;
   			margin-right: -15px;
		}
		small{
			color:#777;
		}
	</style>
	<?php
    	include 'conn2db.php';
		$keyword = $_GET['keyword'];
		$subjectname="所有科目";
		if(isset($_GET['type'])) { //先判斷是否為搜尋活動
			$subjectname="活動";
			$sql="SELECT q.AC_ID as Q_ID, AC_Title as Q_Title, AC_Detail as Q_Detail, S_Name ,`City`, COUNT(`AC_A_id`) as countANS , `U_Gender`
			FROM ac_q_list q LEFT JOIN ac_a_list a ON q.AC_ID=a.AC_ID
			JOIN `ground` g ON q.AC_Ground=g.G_ID
			JOIN `user` u ON u.U_ID=q.U_ID
			JOIN `subject` s ON s.S_ID=q.S_ID
			WHERE `AC_Title` LIKE '%$keyword%'
			GROUP BY q.AC_ID, AC_Title, AC_Detail, AC_Ground, S_Name,City, U_Gender";
		}else{
			if(isset($_GET['subjectid'])) {   //在特定科目內搜尋
				$subjectID=$_GET['subjectid'];
				$subjectname = current($db->query("SELECT `S_Name` FROM `subject` WHERE S_ID=$subjectID")->fetch()); //取科目名稱
				
				$sql="SELECT q.`Q_ID`, `Q_Title`, `Q_Detail`, `Q_Time`, `Q_Ground`, `Q_Overyet`, q.U_ID, `Q_Subject`,`City`, COUNT(`A_ID`) as countANS , `U_Gender`
				FROM `q_list` q LEFT JOIN `ans_list` a ON q.Q_ID=a.Q_ID
				JOIN `ground` g ON q.Q_Ground=g.G_ID
				JOIN `user` u ON u.U_ID=q.U_ID
				WHERE `Q_Title` LIKE '%$keyword%' AND `Q_Subject`=$subjectID
				GROUP BY q.`Q_ID`, `Q_Title`, `Q_Detail`, `Q_Time`, `Q_Ground`, `Q_Overyet`, q.U_ID, `Q_Subject`";
			} else {    //在所有科目搜尋
				$sql="SELECT q.`Q_ID`, `Q_Title`, `Q_Detail`, `Q_Time`, `Q_Ground`, `Q_Overyet`, q.U_ID, `Q_Subject`,`City`, COUNT(`A_ID`) as countANS , `U_Gender` , `S_Name`
				FROM `q_list` q LEFT JOIN `ans_list` a ON q.Q_ID=a.Q_ID
				JOIN `ground` g ON q.Q_Ground=g.G_ID
				JOIN `user` u ON u.U_ID=q.U_ID
				JOIN `subject` s ON s.S_ID=q.Q_Subject
				WHERE `Q_Title` LIKE '%$keyword%'
				GROUP BY q.`Q_ID`, `Q_Title`, `Q_Detail`, `Q_Time`, `Q_Ground`, `Q_Overyet`, q.U_ID, `Q_Subject`";
			}
		}
		$questionlist = $db->query($sql);

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
                		<h2 class="page-header">搜尋結果 <small><?php echo $subjectname; ?></small></h2>
            		</div>
                </div>
                <div class="col-lg-12 questionall">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                	<?php foreach($questionlist as $value){
									if($value['U_Gender']=='Male'){
										$Genderhtml = '<img class="genderimg" src="img/Male.png">';
									}else{
										$Genderhtml = '<img class="genderimg" src="img/Female.png">';
									}
									?>
                                    <?php if(isset($_GET['type'])){?>
                                    	<tr class="questionblock" onclick="location.href='ac/Activity_page.php?activityid=<?php echo $value['Q_ID']; ?>'">
									<?php }else{ ?>
										<tr class="questionblock" onclick="location.href='Question_page.php?questionid=<?php echo $value['Q_ID']; ?>'">
									<?php }?>
                                        <td><?php echo $Genderhtml; ?> </td>
                                        <td><?php echo $value['Q_Title']; ?></td>
                                        <td><small><small><?php if(isset($value['S_Name'])){echo $value['S_Name'];} ?></small></small></td>
                                        <td><?php echo $value['City']; ?></td>
                                    	<td><i class="fa fa-comment" aria-hidden="true"> <?php echo $value['countANS']; ?></i></td>
                                    </tr>
                    				<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<footer class="navbar-fixed-bottom" style="bottom: 0">
            	©2016 Friteach
            </footer>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
