<?php 
session_start();
include_once 'QuestionAction.php';
$U_Username=$_SESSION["U_Username"];
$groundkind=$_POST["groundkind"];
$classkind=$_POST["classkind"];
$title=$_POST["title"];
$content=$_POST["content"];
$ynupdata=$_POST["ynupdata"];

if($ynupdata == "udy")
{
  //上傳圖片
  if(!empty($_FILES['imgupdate']))
  {  
    $imgupdate=$_FILES['imgupdate'];
    $img_name=$imgupdate['name'];
      if($imgupdate['error'] != UPLOAD_ERR_OK)
      {
        echo "上傳失敗" ;
        return;
      }
    
    $upload_path=realpath(".").'/'.'UpdateQuestionIMG';
    $uploadfile_path=$upload_path .'/'.$imgupdate['name'];
    $url_path='http://fs.mis.kuas.edu.tw/~s1102137107/UpdateQuestionIMG';
    
      if(!is_writable($upload_path))
      {
        echo "目錄權限錯誤";
        return;
      }
    
    move_uploaded_file($imgupdate['tmp_name'], $uploadfile_path);
    
    $urlfile_path=$url_path.'/'.$imgupdate['name'];
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
$insert_action=new QuestionAction();
$response=$insert_action->InsertQuestionAction($U_Username,$groundkind,$classkind,$title,$content,$img_name);
?>
<script>
  alert("新增成功");
  location.href= ('questionlist.php?subjectid=<?php echo $classkind?>'); 
</script>
