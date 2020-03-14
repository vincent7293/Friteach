<?php 
session_start();
include_once 'ActivityAction.php';
$U_Username=$_SESSION["U_Username"];
$ac_groundkind=$_POST["ac_groundkind"];
$ac_classkind=$_POST["ac_classkind"];
$ac_place=$_POST["ac_place"];
$ac_actime=$_POST["ac_actime"];
$ac_deadtime=$_POST["ac_deadtime"];
$ac_title=$_POST["ac_title"];
$ac_content=$_POST["ac_content"];
$ynupdata=$_POST["ynupdata"];

if($ynupdata == "udy")
{
	//上傳圖片
	if(!empty($_FILES['ac_imgupdate']))
	{	
		$ac_imgupdate=$_FILES['ac_imgupdate'];
		var_dump($ac_imgupdate);
		$img_name=$ac_imgupdate['name'];
			if($ac_imgupdate['error'] != UPLOAD_ERR_OK)
			{
				echo "上傳失敗" ;
				return;
			}
		
		$upload_path=realpath(".").'/'.'UpdateQuestionIMG';
		$uploadfile_path=$upload_path .'/'.$ac_imgupdate['name'];
		$url_path='http://fs.mis.kuas.edu.tw/~s1102137107/ac/UpdateActivityIMG';
		
		/*$file_type='image/jpeg';
		var_dump($ac_imgupdate);
		if($ac_imgupdate['type']!=$file_type)
		{
			echo "檔案格式不符合";
			return;
		}*/
		
			if(!is_writable($upload_path))
			{
				echo "目錄權限錯誤";
				return;
			}
		
		move_uploaded_file($ac_imgupdate['tmp_name'], $uploadfile_path);
		
		$urlfile_path=$url_path.'/'.$ac_imgupdate['name'];
		echo "上傳成功";
	}
	else
	{
		$img_name='';
	}
}
else
{
	$img_name='';
}

//將INSERT資料傳到ActivityAction.php之InsertActivityAction()進行新增
$insert_action=new ActivityAction();
$response=$insert_action->InsertActivityAction($U_Username,$ac_groundkind,$ac_classkind,$ac_actime,$ac_deadtime,$ac_place,$ac_title,$ac_content,$img_name);
?>
<script>
	alert("新增成功");
	location.href= ('ac_questionlist.php?subjectid=<?php echo $ac_classkind?>'); 
</script>