<?php 
session_start();
include_once 'ShopAction.php';
$U_Username=$_SESSION["U_Username"];
$groundkind=$_POST["groundkind"];

$S_Name=$_POST["S_Name"];
$S_Phone=$_POST["S_Phone"];
$S_Address=$_POST["S_Address"];

$ynupdata=$_POST["ynupdata"];

if($ynupdata == "udy")
{
	//上傳圖片
	if(!empty($_FILES['S_discount']))
	{	
		$S_discount=$_FILES['S_discount'];
		//var_dump($S_discount);
		$img_name=$S_discount['name'];
			if($S_discount['error'] != UPLOAD_ERR_OK)
			{
				echo "上傳失敗" ;
				return;
			}
		
		$upload_path=realpath(".").'/'.'UpdateShopIMG';
		$uploadfile_path=$upload_path .'/'.$S_discount['name'];
		$url_path='http://fs.mis.kuas.edu.tw/~s1102137107/UpdateShopIMG';
		
		/*$file_type='image/jpeg';
		var_dump($S_discount);
		if($S_discount['type']!=$file_type)
		{
			echo "檔案格式不符合";
			return;
		}*/
		
			if(!is_writable($upload_path))
			{
				echo "目錄權限錯誤";
				return;
			}
		
		move_uploaded_file($S_discount['tmp_name'], $uploadfile_path);
		
		$urlfile_path=$url_path.'/'.$S_discount['name'];
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

//將INSERT資料傳到QuestionAction.php之InsertQuestionAction()進行新增
$insert_action=new ShopAction();
$response=$insert_action->InsertShopAction($U_Username,$groundkind,$S_Name,$S_Phone,$S_Address,$img_name);
?>
<script>
	alert("新增成功");
	location.href= ('../subjectlist.php'); 
</script>
