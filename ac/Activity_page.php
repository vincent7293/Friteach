<!DOCTYPE html>
<html lang="en">
<head>
	<!--countanser-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<!--table-->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
	.joinBlock {
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
	.joinBlock >  div {
		background-color: #EEE;
	}
	.modal-content {
		line-height: 25px;
	}
	.collapse {
		margin-bottom: 10px;
		transition-duration: 150ms;
	}
	.btn-info.collapsed:after {
		content: "\f078";
	}
	.btn-info:after {
    	content: "\f077";
	}
	.informationblock {
    	line-height: 23px;
	}
	</style>
	
<?php
session_start();
$U_Username = $_SESSION['U_Username']; 


	include '../conn2db.php';

	$AC_ID=$_GET['activityid'];
	//$Q_Overyet=$_GET['Q_Overyet'];//if over=1 clocked answer button;
	
	$AC_Title = current($db->query("SELECT `AC_Title` FROM `ac_q_list` WHERE AC_ID=$AC_ID")->fetch());
	$User_Name = current($db->query("SELECT `U_Name` FROM `user` u JOIN `ac_q_list` ac WHERE `AC_ID`=$AC_ID AND u.U_ID=ac.U_ID")->fetch());
	$JOIN_U_ID= current($db->query("SELECT `U_ID` FROM `user` WHERE `U_Username`='$U_Username'")->fetch());
	$G_ID = current($db->query("SELECT `G_ID` FROM `ground` g left join `user` u ON g.G_ID = u.U_Ground WHERE `U_Username`='$U_Username'")->fetch());
	
	
	$AC_Q_Gender = current($db->query("SELECT `U_Gender` FROM `user` u JOIN `ac_q_list` ac WHERE `AC_ID`=$AC_ID AND u.U_ID=ac.U_ID")->fetch());
	$Q_Gender = current($db->query("SELECT `U_Gender` FROM `user` u JOIN `ac_q_list` ac WHERE `AC_ID`=$AC_ID AND u.U_ID=ac.U_ID")->fetch());
	    
	$AC_data = $db->query("SELECT `AC_Title` , `AC_Detail` , `AC_Ground` , `AC_ACTime` , `AC_InsertTime` , u.`U_Username`, ac.`AC_ID` , `Ac_q_img`, `Ac_SignupTime`, `Ac_place`,ac.`S_ID` , ac.`U_ID`,g.`City`, s.`S_Name` , `ac_q_overyet` ,`ac_signup_overyet`, u.`U_Phone`,
	COUNT(`AC_A_id`) as countACNUM FROM `ac_q_list` ac 
	LEFT JOIN `ac_a_list` j ON ac.AC_ID=j.AC_ID JOIN `ground` g ON ac.AC_Ground=g.G_ID JOIN `user` u ON ac.U_ID=u.U_ID JOIN `subject` s ON s.S_ID= ac.S_ID WHERE ac.AC_ID=$AC_ID
    GROUP BY `AC_Title` , `AC_Detail` , `AC_Ground` , `AC_ACTime` , `AC_InsertTime` , u.`U_Username`, ac.`AC_ID` , `Ac_q_img`, `Ac_SignupTime`, `Ac_place`,ac.`S_ID` , ac.`U_ID`,g.`City`, s.`S_Name`, `ac_q_overyet` ,`ac_signup_overyet`, u.`U_Phone`");	
	
    $Join_data = $db->query("SELECT  ac.`AC_ID`, `AC_A_id`, j.`U_ID`, j.`G_ID`, g.`City`, `U_Name` , `U_Gender` FROM `ac_a_list` j 
	RIGHT JOIN `ac_q_list` ac ON ac.AC_ID=j.AC_ID JOIN `user` u ON u.U_ID=j.U_ID JOIN `ground` g ON j.G_ID=g.G_ID WHERE ac.AC_ID=$AC_ID
    GROUP BY ac.`AC_ID`, `AC_A_id`, j.`U_ID`, j.`G_ID`, g.`City`, `U_Name` , `U_Gender` ");

?>
<title><?php echo $AC_Title; ?></title>
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
                    <li>
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
                        <a href="../logout.php"><i class="fa fa-fw fa-sign-out"></i> 登出</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        </nav>

                           <?php foreach($AC_data as $data){ ?>

		 <div id="page-wrapper">

            <div class="container-fluid">
                <!-- 標題列 -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                           <div class="row">
                            <span class="col-sm-6"><?php echo $AC_Title?></span>
                            <span class="col-sm-6 pull-right"><small><?php echo $data['S_Name']?></small></span><br>
								<span class="col-sm-6">
                            	<small><?php echo $User_Name?> &nbsp;<small><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $data['City'] ?></small></small>
                                </span>
                                <span class="col-sm-6 pull-right">
                                	<small><small>
                                <?php echo date("Y/m/d H:i",strtotime($data['AC_InsertTime'])); //不顯示秒數 ?>
                                	</small></small>
                                </span>
                            </div>
						 </h2>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row" >
					<div class="col-xs-12 informationblock">
						<p><i class="fa fa-user" aria-hidden="true"></i>發起人：<?php echo $User_Name?></p>
						<p><i class="fa fa-clock-o" aria-hidden="true"></i>活動時間：<?php echo  date("Y/m/d H:i",strtotime($data['AC_ACTime']))?></p>

						<p><i class="fa fa-clock-o" aria-hidden="true"></i>報名截止：<?php echo  date("Y/m/d H:i",strtotime($data['Ac_SignupTime']))?></p>

						<p><i class="fa fa-map-marker" aria-hidden="true"></i>活動地點：<?php echo $data['Ac_place']?></p>

						<p><i class="fa fa-mobile" aria-hidden="true"></i>連絡電話：<?php echo $data['U_Phone']?></p>
						<p><i class="fa fa-pencil-square-o" aria-hidden="true"></i>活動詳情：<?php echo $data['AC_Detail']?></p>
					</div>
					<?php if($data['Ac_q_img'] != NULL){?>
					<div class="col-xs-12">
						<img src="UpdateActivityIMG/<?php echo $data['Ac_q_img'];?>">
					</div>
					<?php }?>
				</div>
                
				<div class="row">
                <div class="panel panel-primary col-xs-10 col-xs-offset-1">
                            <div class="panel-heading">
                            	<div class="row panel-primary">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $data['countACNUM']; ?></div>
                                        <div>目前參加者</div>
                                    </div>
                                </div>
								
                            </div>
                        </div>
				</div>
				<!-- Begin 最下方教導鈕-->
                <form method="POST" action="insert_ac_signup.php">
				
				<input type="hidden" name="AC_ID" value="<?php echo $AC_ID; ?>"/>
				<input type="hidden" name="JOIN_U_ID" value="<?php echo $JOIN_U_ID; ?>"/>
				<input type="hidden" name="G_ID" value="<?php echo $G_ID; ?>"/>
                
                <?php if($data['U_Username'] != $_SESSION['U_Username']){?>
      				<nav class="navbar navbar-default navbar-fixed-bottom" id="BottomBar" role="navigation">
  						<div class="container">
  							<div class="text-center">
				<?php if($data['ac_signup_overyet'] == 0){?>
                    	<button type="submit" class="btn btn-warning">我要參加</button>

				<?php }else if($data['ac_signup_overyet'] == 1){?>
						<button type="button" class="btn btn-warning"  disabled>已截止</button>
				<?php }?>
  							</div>
  						</div>
					</nav>
        		<?php } ?>
            	</form>
<!-- End 最下方教導鈕-->
<?php }?>
			
				<!--Begin 活動參加者清單-->
				
				
				<div class="col-xs-12"  style="margin-bottom:100px;">
                	<div class="row">
						<?php foreach($Join_data as $ans){ ?>
                        	<div class="joinBlock">
                    			<div class="col-xs-6">
                                      <img src="../img/<?php echo $ans['U_Gender']?>.png" class="img-circle" alt="Cinque Terre" width="30" height="30">
                                      <?php echo $ans['U_Name']?></div>
    
                                      <div class="col-xs-6"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $ans['City']?>
                                      </div>
                            </div>
						<?php }?>
                     </div>
                </div>
				 <!-- End 活動參加者清單 -->
			 </div>
            <!-- /.container-fluid -->
			<footer class="navbar-fixed-bottom">
            	©2016 Friteach
            </footer>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>