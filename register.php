<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>註冊</title>

    <!-- Bootstrap Core CSS -->
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
                		 <h2 class="page-header">新用戶註冊 <small><small>您好，歡迎您使用  Friteach！</small></small></h2>
            		</div>
                </div>
              <div class="row">
              	<div class="col-sm-12">
                  	<form method="POST" action="registeredsucess.php">
                    <div class="form-group">
                                <label for="U_Username">請輸入欲使用之賬號名稱*  :</label>
                                <input class="form-control" maxlength="15" name="U_Username" maxlength="15" onkeyup="value=value.replace(/[\W]/g,'')"
                                 onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" required>
                                <p class="help-block">請用15字以內的英文或數字作為賬號</p>
                            </div>

                            <div class="form-group">
                                <label for="U_Password">請輸入您欲使用的密碼*  :</label>
                                <input class="form-control" type="password" maxlength="15" id="U_Password" name="U_Password" required>
                                <p class="help-block">密碼至少需要6個字</p>
                            </div>

                            <div class="form-group">
                                <label for="U_Comfirm">請確認您的密碼*  :</label>
                                <input class="form-control" type="password" maxlength="15" id="U_Comfirm" name="U_Comfirm" required>
                                <p class="help-block">確保與您輸入的密碼一致</p>
                            </div>

                            <div class="form-group">
                                <label for="U_Email">電子郵件  ：</label>
                                <input class="form-control" name="U_Email" id="U_Email" required>
                                <p class="help-block"></p>
                            </div>

                            <div class="form-group">
                                <label for="U_Name">真實名字*  :</label>
                                <input class="form-control" name="U_Name" required>
                                <p class="help-block"></p>
                            </div>
                                           
                            <div class="form-group">
                                <label>性別  ：</label>
                                <div class="radio">
                                    <label for="U_Gender">
                                        <input type="radio" name="U_Gender" id="U_Gender" value="Male" checked="checked">男·Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="U_Gender">
                                        <input type="radio" name="U_Gender" id="U_Gender" value="Female">女·Female
                                    </label>
                                </div>
                            </div>
                                  
                            <div class="form-group">
                                <label for="U_Birthday">生日  ：</label>
                                <input type="date" id="U_Birthday" name="U_Birthday" min="1900-01-01" max="2016-09-30">
                                <p class="help-block"></p>
                            </div>

                            <div class="form-group">
                                <label for="U_Ground">地區：</label>
                                <select  id="U_Ground" name="U_Ground" class="form-control">
                                    <option value='1'>台北市</option>
                                    <option value='2'>基隆市</option>
                                    <option value='3'>新北市</option>
                                    <option value='4'>宜蘭縣</option>
                                    <option value='5'>新竹市</option>
                                    <option value='6'>新竹縣</option>
                                    <option value='7'>桃園縣</option>
                                    <option value='8'>苗栗縣</option>
                                    <option value='9'>台中市</option>
                                    <option value='10'>彰化縣</option>
                                    <option value='11'>南投縣</option>
                                    <option value='12'>雲林縣</option>
                                    <option value='13'>嘉義市</option>
                                    <option value='14'>嘉義縣</option>
                                    <option value='15'>台南市</option>
                                    <option value='16'>高雄市</option>
                                    <option value='17'>屏東縣</option>
                                    <option value='18'>台東縣</option>
                                    <option value='19'>花蓮縣</option>
                                </select>
                            </div>
                                                              
                            <div class="form-group">
                                <label for="U_Phone">手機   ：</label>
                                <input class="form-control" name="U_Phone" maxlength="10" onkeyup="value=value.replace(/[^\d]/g,'')" required>
                                <p class="help-block"></p>
                            </div>
    
                            <div class="form-group">
                                <label for="U_Specialty">專長   ：</label>
                                <input class="form-control" name="U_Specialty" maxlength="30" required>
                                <p class="help-block">可簡短表達，例：”桌球、數學、烹飪等“</p>
                            </div>

                            <br><input id="submit" name="submit" type="submit"  class="btn btn-lg btn-primary"  value="進行提交">
                            <input id="reset" name="reset" type="reset"  class="btn btn-lg btn-primary"  value="我想重新填寫">
                            </form>
                            </div>
                </div>
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
