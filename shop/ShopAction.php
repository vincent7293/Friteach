<?php
include_once '../Dblink.php';
class ShopAction{
	private $conn;
	public function __construct(){
		$dblink=new Dblink();
		$this->conn=$dblink->getConn();
	}
	
	//取得地區資料
	public function SelectGroundAction(){
		$sql="SELECT `G_ID`, `City` FROM `ground` ORDER BY `G_ID` ASC;"; 
		$result=$this->conn->query($sql);
		return $result;
	}
	
	//新增店家
	public function InsertShopAction($U_Username,$groundkind,$S_Name,$S_Phone,$S_Address,$img_name){
		
		
		var_dump($S_Name);
		var_dump($S_Phone);
		var_dump($S_Address);
		var_dump($groundkind);
		var_dump($img_name);
		
		
		$sql="INSERT INTO `shop`( `S_Name`, `S_Phone`, `S_Address`, `S_Ground`, `S_discount` ) VALUES ('$S_Name','$S_Phone','$S_Address','$groundkind','$img_name')"; 
		
		var_dump($sql);
		return $this->conn->exec($sql);
	}
	
	
	
}
?>