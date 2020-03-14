<?php
include_once '../Dblink.php';
class ActivityAction{
	private $conn;
	public function __construct(){
		$dblink=new Dblink();
		$this->conn=$dblink->getConn();
	}
	
	//取得地區資料
	public function SelectGroundAction(){
		$sql="SELECT `G_ID`, `City` FROM `ground` ORDER BY `G_ID`;"; 
		$result=$this->conn->query($sql);
		return $result;
	}
	
	//取得科目資料
	public function SelectSubjectAction(){
		$sql="SELECT `S_ID`, `S_Name` FROM `subject`;"; 
		$result=$this->conn->query($sql);
		return $result;
	}
	
	//新增活動
	public function InsertActivityAction($U_Username,$ac_groundkind,$ac_classkind,$ac_actime,$ac_deadtime,$ac_place,$ac_title,$ac_content,$img_name){
		$sql="SELECT `U_ID` FROM `user` WHERE `U_Username`= '$U_Username';"; 
		$result=$this->conn->query($sql);
		$U_IDdate=$result->fetchALL();
		
		for($i=0;$i<count($U_IDdate);$i++){
			$U_ID=$U_IDdate[$i]["U_ID"];
		}
		$time=date("Y-m-d H:i:s");
		$sql="INSERT INTO `ac_q_list`(`AC_Title`, `AC_Detail`, `AC_Ground`, `AC_ACTime`, `AC_SignupTime`, `AC_InsertTime`, `AC_place`, `S_ID`, `U_ID`, `Ac_q_img`) 
		VALUES ('$ac_title','$ac_content','$ac_groundkind','$ac_actime','$ac_deadtime','$time','$ac_place','$ac_classkind','$U_ID','$img_name')"; 
		return $this->conn->exec($sql);
	}
	
	
	
}
?>