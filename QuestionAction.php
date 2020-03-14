<?php
include_once 'Dblink.php';
class QuestionAction{
  private $conn;
  public function __construct(){
    $dblink=new Dblink();
    $this->conn=$dblink->getConn();
  }
  public function IsDefaultSubject($subjectID){
    if(isset($_GET['subjectid']) && $subjectID==$_GET['subjectid']){
      return "selected";
    }else{
      return "";
    }
    
  }
  //取得地區資料
  public function SelectGroundAction(){
    $sql="SELECT `G_ID`, `City` FROM `ground` ORDER BY `G_ID` ASC;"; 
    return $this->conn->query($sql);
  }
  
  //取得科目資料
  public function SelectSubjectAction(){
    $sql="SELECT `S_ID`, `S_Name` FROM `subject`;"; 
    return $this->conn->query($sql);
  }
  
  //新增提問
  public function InsertQuestionAction($U_Username,$groundkind,$classkind,$title,$content,$img_name){
    $sql="SELECT `U_ID` FROM `user` WHERE `U_Username`= '$U_Username';"; 
    $result=$this->conn->query($sql);
    $U_IDdate=$result->fetchALL();
    var_dump($U_IDdate);
    for($i=0;$i<count($U_IDdate);$i++){
      $U_ID=$U_IDdate[$i]["U_ID"];
    }
    $time=date("Y-m-d H:i:s");
    
    $sql="INSERT INTO `q_list`( `Q_Title`, `Q_Detail`, `Q_Time`, `Q_Ground`, `U_ID`, `Q_Subject`, `Q_img` ) VALUES ('$title','$content','$time','$groundkind','$U_ID','$classkind','$img_name')"; 
    return $this->conn->exec($sql);
  }
  
  
  
}
?>