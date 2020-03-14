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

    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../lib/jquery.raty.min.js"></script>



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
        
    <div id="page-wrapper">

        <div class="container-fluid">

        <div class='row'><div class='col-lg-6'>
       <br><br><a href='../answerhistory.php'><button type='button' class='btn btn-lg btn-primary'>返回到活動歷史</button></a><br>
       </div></div>

                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">
                            給予這次活動的評分
                        </h3>
                    </div>
                </div>

            <div class="row">
                <div class="col-lg-12">

<?php

        $db_host="db.mis.kuas.edu.tw";
        $db_name="s1102137107";
        $db_user="s1102137107";
        $db_pass="88888";
        $Q_ID=8;
        $con=new mysqli($db_host,$db_user,$db_pass,$db_name);
        mysqli_set_charset($con,"utf8");
        $query=" SELECT  *  FROM q_list WHERE Q_ID='$Q_ID' ";
        $data=mysqli_query($con,$query) || die(mysqli_error()); 
        $fetch=mysqli_fetch_all($data,MYSQLI_BOTH);
        foreach ($fetch as $rows ){

            $star=$rows['Q_Star'];
            $starnum=(int)$star;

        if($rows['Q_Star']==null)
        {
            echo '<div class="row"><div class="col-lg-12">給對方的星星：</div></div>';
            echo '<div class="demo">';
            echo '<div id="star_none"></div>';
            echo '</div><br>';
        }
        else
        {
            echo '<div class="row"><div class="col-lg-12">給對方的星星：</div></div>';
            echo '<div class="demo">';
            echo '<div id="star_already"></div>';
            echo '</div><br>';
        }

        if($rows['Q_Comment']==null)
        {
            echo '<form role="form"  method="POST" action="a-commentsucess.php">';
            echo '<input type="hidden" name="starvalue" id="starvalue">';
            echo '<input type="hidden" name="Q_ID" id="Q_ID" value='.$Q_ID.'>';
            echo '<div class="form-group">';
            echo '<label>給予對方的評論</label>';
            echo '<textarea class="form-control" rows="5" name="comment" id="comment"></textarea>';
            echo '</div>';
        }
        else
        {
            echo "<div class='row'><div class='col-lg-3'>";
            echo "給予對方的評論：</div><br><div class='col-lg-6'>";
            echo  $rows['Q_Comment'];
            echo "</div></div>";

        }

        if($rows['Q_Star']==null)
        {
            echo '<input id="submit" name="submit" type="submit"  class="btn btn-primary"  value="進行提交">';
            echo "</form>";
        }

    }
            echo  '<div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">
                            對方給你的評分
                        </h3>
                    </div>
                </div>';
        $query=" SELECT *  FROM ans_list AS a JOIN q_list AS Q WHERE a.Q_ID='$Q_ID' AND a.Q_ID=q.Q_ID AND A_Correct=1";
        $data=mysqli_query($con,$query) || die(mysqli_error()); 
        $fetch=mysqli_fetch_all($data,MYSQLI_BOTH);

        foreach ($fetch as $rows ){

            $star2=$rows['A_Star'];
            $starnum2=(int)$star2;

        if(!$rows['A_Star']==null)
        {
            echo '<div class="row"><div class="col-lg-12">對方給你的星星：</div></div>';
            echo '<div class="demo">';
            echo '<div id="star_already2"></div>';
            echo '</div><br>';
        }

        if($rows['A_Comment']==null)
        {
            echo '對方尚未進行評分哦～';
        }
        else
        {
            echo "<div class='row'><div class='col-lg-3'>";
            echo "對方給你的評論：</div><br><div class='col-lg-6'>";
            echo  $rows['A_Comment'];
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
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
</html>

<script type="text/javascript">

    $(function()
    {

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