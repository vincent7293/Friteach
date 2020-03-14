<?php
include_once 'ActivityAction.php';
$ActivityAction=new ActivityAction();
$GroundData=$ActivityAction->SelectGroundAction();
$GroundArr=$GroundData->fetchALL();
$SubjectData=$ActivityAction->SelectSubjectAction();
$SubjectArr=$SubjectData->fetchALL();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>教藝-免費家庭教師搜尋平台</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	
	<!-- Jquery TimePicker -->
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	
	<link href="../jQuery-Timepicker-Addon-master/src/jquery-ui-timepicker-addon.css" rel="stylesheet"></link>
	<script src="../jQuery-Timepicker-Addon-master/src/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
	<script src="../jQuery-Timepicker-Addon-master/src/jquery-ui-sliderAccess.js" type="text/javascript"></script>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript">
		function updateFile(){
			var id1=document.getElementById("y_updatechoose");
			if(id1.checked != true)
			{
				document.getElementById("activityimg").disabled=true;
			}
			else
			{
				document.getElementById("activityimg").disabled=false;
			}
		}
		
		function submitForm(){
			var is_null=false;
			var tit=$('[name=ac_title]').val();
			var con=$('[name=ac_content]').val();
			var astime=$('[name=ac_actime]').val();
			var deadtime=$('[name=ac_deadtime]').val();
			var place=$('[name=ac_place]').val();
			var str='請輸入：\n';
			
			
			
			if(tit == '')
			{
				
				str+='                  主題名稱\n';
				$('[name=ac_title]').parent().addClass(' has-error');
				is_null=true;
			}
			
			if(con == '')
			{
				str+='                  討論內容\n';
				$('[name=ac_content]').parent().addClass(' has-error');
				is_null=true;
			}
			
			if(astime == '')
			{
				str+='                  活動時間\n';
				is_null=true;
			}
			
			if(deadtime == '')
			{
				str+='                  報名截止時間\n';
				is_null=true;
			}
			
			if(place == '')
			{
				
				str+='                  舉辦地點\n';
				$('[name=ac_place]').parent().addClass(' has-error');
				is_null=true;
			}
			
			if(is_null == true)
			{
				alert(str);
				return;
			}
			
			$('#editForm').submit();
		}
	</script>
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

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            發起活動
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" id="editForm" action="InsertActivityAction.php" method="post" enctype="multipart/form-data" >
                            <div class="form-group">
                                <h3><label>地區</label></h3> 
                                <select class="form-control" name="ac_groundkind">
									<?php for($i=0;$i<count($GroundArr);$i++){ ?>
										<option value="<?php echo $GroundArr[$i]["G_ID"]; ?>"><?php echo $GroundArr[$i]["City"]; ?></option>
									<?php } ?>
                                </select>
                            </div>
							
							<div class="form-group">
                                <h3><label>分類</label></h3> 
                                <select class="form-control" name="ac_classkind">
									<?php for($i=0;$i<count($SubjectArr);$i++){ ?>
										<option value="<?php echo $SubjectArr[$i]["S_ID"]; ?>"><?php echo $SubjectArr[$i]["S_Name"]; ?></option>
									<?php } ?>
                                </select>
                            </div>
							
							<div class="form-group">
                                <h3><label>活動時間</label></h3> 
								<input id="datetimepicker1" type="text" name="ac_actime" class="form-control"/>
								 <script language="JavaScript">
								    $(document).ready(function(){ 
								      $.datepicker.regional['zh-TW']={
								        dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
								        dayNamesMin:["日","一","二","三","四","五","六"],
								        monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
								        monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
								        prevText:"上月",
								        nextText:"次月",
								        weekHeader:"週"
								        };
								      $.timepicker.regional['zh-TW']={
								        timeOnlyTitle:"選擇時分秒",
								        timeText:"時間",
								        hourText:"時",
								        minuteText:"分",
								        timezoneText:"時區",
								        closeText:"確定",
								        amNames:["上午","AM","A"],
								        pmNames:["下午","PM","P"]
								        };
								      $.datepicker.setDefaults($.datepicker.regional["zh-TW"]);
								      $.timepicker.setDefaults($.timepicker.regional["zh-TW"]);
								      $("#datetimepicker1").datetimepicker({dateFormat:"yy-mm-dd",
								                                            timeFormat:"HH:mm", 
								                                            showSecond:false,
																			controlType:"select"
								                                            });
								      });
								  </script>
							</div>
							
							<div class="form-group">
                                <h3><label>報名截止</label></h3> 
								<input id="datetimepicker2" type="text" name="ac_deadtime" class="form-control"/>
								 <script language="JavaScript">
								    $(document).ready(function(){ 
								      $.datepicker.regional['zh-TW']={
								        dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
								        dayNamesMin:["日","一","二","三","四","五","六"],
								        monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
								        monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
								        prevText:"上月",
								        nextText:"次月",
								        weekHeader:"週"
								        };
								      $.timepicker.regional['zh-TW']={
								        timeOnlyTitle:"選擇時分秒",
								        timeText:"時間",
								        hourText:"時",
								        minuteText:"分",
								        timezoneText:"時區",
								        closeText:"確定",
								        amNames:["上午","AM","A"],
								        pmNames:["下午","PM","P"]
								        };
								      $.datepicker.setDefaults($.datepicker.regional["zh-TW"]);
								      $.timepicker.setDefaults($.timepicker.regional["zh-TW"]);
								      $("#datetimepicker2").datetimepicker({dateFormat:"yy-mm-dd",
								                                            timeFormat:"HH:mm", 
								                                            showSecond:false,
																			controlType:"select"
								                                            });
								      });
								  </script>
							</div>
							
							<div class="form-group">
                                <h3><label>舉辦地點</label></h3>
                                <input class="form-control" placeholder="請輸入舉辦地點" name="ac_place" >
                            </div>   
							
                            <div class="form-group">
                                <h3><label>主題名稱</label></h3>
                                <input class="form-control" placeholder="請輸入主題名稱" name="ac_title" >
                            </div>   


                            <div class="form-group">
                                <h3><label>討論內容</label></h3>
                                <textarea class="form-control" rows="3" name="ac_content"></textarea>
                            </div>
							
							<h3><label>是否需上傳相關檔案(例如：活動海報或地點位置圖等)</label></h3>
							<div class="radio">
								<label>
									<input type="radio" name="ynupdata" value="udy" onclick="updateFile()" id="y_updatechoose"><h4>是</h4>
									<input type="radio" name="ynupdata" value="udn" onclick="updateFile()" id="n_updatechoose" checked><h4>否</h4>
								</label>
							</div>
								
							<div class="form-group">
                                <h3><label>檔案上傳</label></h3>
                                <input type="file" id="activityimg" name="ac_imgupdate" disabled>
                            </div>
							
							<center><input type="button" class="btn btn-default btn-lg" value="送出" onclick="submitForm()"/></center>
							<div width="auto" height="20px"></div>
                        </form>      

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery 暫時不用
    <script src="js/jquery.js"></script>
-->
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	

</body>

</html>