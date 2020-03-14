
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<link href="http://fs.mis.kuas.edu.tw/~s1102137107/css/style.css" rel="stylesheet">
  <?php
session_start();

$Q_ID=$_POST['Q_ID'];
$Q_U_ID=$_POST['Q_U_ID'];
$U_ID=$_POST['U_ID'];
//echo $U_ID;

try{
	
	include 'conn2db.php';
	$count= $db->exec("UPDATE `q_list` SET `Q_Overyet`=1 WHERE `Q_ID`='$Q_ID' ");
			
			$sql = "UPDATE `ans_list` SET `A_Correct`=1 WHERE Q_ID='$Q_ID' AND U_ID='$U_ID' ";
			$stmt = $db->exec($sql);
			
			$A_Shop = $db->query("SELECT `S_Name`,`S_Phone`,`S_Address`,`S_discount` FROM `shop` s left join  `user` u on s.`S_Ground`=u.`U_Ground` join `ground` g on s.`S_Ground`=g.`G_ID` 
								WHERE u.`U_ID`=$Q_U_ID OR u.`U_ID`=$U_ID
								GROUP BY `S_Name`,`S_Phone`,`S_Address`,`S_discount` ");
			//echo "選擇成功";
			//echo '<meta http-equiv=REFRESH CONTENT=1;url=subjectlist.php>';
   
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
   

?>
<style>
.shopblock {
    background-color: #00554B;
    margin-top: 20px;
    color: white;
    box-shadow: 0 0 20px 0px #000000;
    border-radius: 20px;
    margin-left: 15px;
    width: calc(100vw - 30px);
    letter-spacing: 1px;
    font-family: "Light";
}
.page-header {
    margin-top: 10px;
}
img {
	margin-top: 10px;
	margin-bottom: 10px;
}
</style>
</head>
<body>
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
<div class="container">
 <div class="row">
		<div class="col-xs-12"><h3>根據您以及教師的地點</h3><h4>提供您以下幾間店家當做教學地點參考:</h4></div>
		<?php foreach ($A_Shop as $shop){?>
        <div class="shopblock col-xs-12">
		 <h4><div class="col-xs-12 page-header"><?php echo $shop['S_Name']?></div></h4>
         <h5>
         <div class="col-xs-12">電話:<?php echo $shop['S_Phone']?></div>
         <div class="col-xs-12">地址:<?php echo $shop['S_Address']?></div></h5>
         <div class="col-xs-12"><img class="img-responsive" src="UpdateShopIMG/<?php echo $shop['S_discount'];?>"></div>
         </div>
         		<?php } ?>

 <div class="col-xs-12">
 <button type="button" style="margin-bottom:40px; margin-top:20px;" class="btn btn-primary center-block" data-dismiss="modal"   onclick="location.href='Question_page.php?questionid=<?php echo $Q_ID?>'">確認</button>
 </div>
</div>
  
</div>
</body>
</html>
																			
																			