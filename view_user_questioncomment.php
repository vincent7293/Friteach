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

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script type="text/javascript" src="js/jquery.js"></script>

  <script type="text/javascript" src="lib/jquery.raty.min.js"></script>



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

       <div class='row'><div class='col-lg-6'>
       <br><br><button type='button' onclick="history.back()" class='btn btn-lg btn-primary'>返回到提問記錄</button></a><br>
       </div></div>

                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header">
                            給予教學者的評分
                        </h4>
                    </div>
                </div>



            <div class="row">
                <div class="col-lg-12">

<?php

        $db_host="db.mis.kuas.edu.tw";
        $db_name="s1102137107";
        $db_user="s1102137107";
        $db_pass="88888";
        $Q_ID=$_POST['Q_ID'];
        $con=new mysqli($db_host,$db_user,$db_pass,$db_name);
        mysqli_set_charset($con,"utf8");
        $query=" SELECT *  FROM ans_list AS a JOIN q_list AS Q WHERE a.Q_ID='$Q_ID' AND a.Q_ID=q.Q_ID AND A_Correct=1";
        $data=mysqli_query($con,$query)or die(mysqli_error()); 
        $fetch=mysqli_fetch_all($data,MYSQLI_BOTH);

        foreach ($fetch as $rows ){

            $star=$rows['A_Star'];
            $starnum=(int)$star;

        if(!$rows['A_Star']==null)
        {
            echo '<div class="row"><div class="col-lg-12">教導者給予該用戶的星星：</div></div>';
            echo '<div class="demo"><br>';
            echo '<div id="star_already"></div>';
            echo '</div><br>';
        }

        if($rows['A_Comment']==null)
        {
            echo '該用戶尚未對教學者進行評分';
        }
        else
        {
            echo "<div class='row'><div class='col-lg-3'>";
            echo "給予教學者的評論：</div><br><div class='col-lg-6'>";
            echo  $rows['A_Comment'];
            echo "</div></div>";

        }

    }
    echo '<br>';

    echo '    <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header">
                            對方給你的評分
                        </h4>
                    </div>
                </div>';


     $db_host="db.mis.kuas.edu.tw";
        $db_name="s1102137107";
        $db_user="s1102137107";
        $db_pass="88888";
        $Q_ID=$_POST['Q_ID'];
        $con=new mysqli($db_host,$db_user,$db_pass,$db_name);
        mysqli_set_charset($con,"utf8");
        $query=" SELECT  *  FROM q_list WHERE Q_ID='$Q_ID' ";
        $data=mysqli_query($con,$query)or die(mysqli_error()); 
        $fetch=mysqli_fetch_all($data,MYSQLI_BOTH);
        foreach ($fetch as $rows ){

            $star2=$rows['Q_Star'];
            $starnum2=(int)$star2;

        if(!$rows['Q_Star']==null)
        {
            echo '<div class="row"><div class="col-lg-12">教導者給予該用戶的星星：</div></div>';
            echo '<div class="demo"><br>';
            echo '<div id="star_already2"></div>';
            echo '</div><br>';
        }

        if($rows['Q_Comment']==null)
        {
            echo '教導者尚未對該用戶進行評分';
        }
        else
        {
            echo "<div class='row'><div class='col-lg-3'>";
            echo "教導者給予用戶的評分的評論：</div><br><div class='col-lg-6'>";
            echo  $rows['Q_Comment'];
            echo "</div></div>";

        }

    }
?>

                        </div>
                       
                    </div>
                </div>

            </div><!--row-end-->

        </div><!--container-fluid-end-->

    </div><!--page-wrapper-end-->

</body>

</html>

<script type="text/javascript">

    $(function()
    {

      $.fn.raty.defaults.path = 'lib/img';

        $('#star_none').raty({

            click: function(score, evt)
            {
                document.getElementById("starvalue").value=score;   
            }
         });

        $('#star_already').raty({

                halfShow: false,

                readOnly: true,

                score   :  <?php  echo $starnum; ?>

        });

        $('#star_already2').raty({

                halfShow: false,

                readOnly: true,

                score   :  <?php  echo $starnum2; ?>

        });
    });

  </script>