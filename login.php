<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>登入</title>

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
		.loginBtn {
			background-color: transparent;
    		border-color: #fff;
			border-radius: 50px;
		    width: 100px;
		}
		.alert-dismissible {
		    margin-bottom: -30px;
    		margin-top: 10px;
			cursor: pointer;
		}
		.row {
			background-color: #6dc0a5;
		}
		body {
			background-color: #6dc0a5;
		}
		.row > form > .col-xs-12 {
			text-align: center;
    		color: #fff;
    		font-size: large;
    		font-family: Light;
		}
		.form-control {
		    border-radius: 50px;
		}
		.logoimg {
			margin-top: -90px;
			margin-bottom: -40px;
		}
	</style>
    <?php
		if(isset($_GET['error']) && $_GET['error']==1){
			$ShowError = true;
		}else{
			$ShowError = false;
		}
	?>
</head>

<body>

    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">
            	<!--<div class="row">
                <?php if($ShowError){?>
                	<div class="col-sm-10">
                        <div class="alert alert-warning alert-dismissible fade" id="errormsg" role="alert">
                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          <strong>請登入</strong> 以享受完整功能.
                        </div>
					</div>
				<?php } ?>
                </div>-->
                
              <div class="row">
              			<div class="col-xs-12 logoimg"><img class="img-responsive" src="img/Logo-01.png" width="1000" height="1000" alt=""/>
                        </div>
                        <form role="form" action="loginsucess.php" method="post">
                                <div class="col-xs-12"><p>帳號</p></div>
                                <div class="col-xs-12 form-group"><input class="form-control" placeholder="請輸入帳號" name="U_Username" required></div>
                                <div class="col-xs-12"><p>密碼</p></div>
                                <div class="col-xs-12 form-group"><input class="form-control" placeholder="請輸入密碼" name="U_Password" type="password" required></div>
								<div class="col-xs-12"><button type="submit" name="submit" class="btn btn-primary btn-lg loginBtn">登入</button></div>
                            	<div class="col-xs-12" style="margin-top: 5px;"><button type="button" class="btn btn-primary btn-lg loginBtn" onclick="javascript:location.href='register.php'">註冊</button></div>
                            <input type="hidden" name="BackToPreviousPage" value="<?php echo $ShowError;?>" />
                            <input type="hidden" name="PreviousPagePath" value="<?php echo $_SERVER["HTTP_REFERER"]; ?>" />
                        </form>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<footer class="navbar-fixed-bottom">
            	©2016 Friteach
            </footer>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
<script>
//延遲出現錯誤訊息
window.setTimeout(function(){
	$("#errormsg").addClass("in");
}, 500);

//點擊整個錯誤訊息可關閉
$("#errormsg").click(function(){
	$("#errormsg").slideUp();
});
</script>
</html>
