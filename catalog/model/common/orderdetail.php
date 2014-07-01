<?php
class ModelCommonOrderdetail extends Model {	
	
	public function getOrderDetail($data=array()){
		$query = $this->db->query("SELECT * from aa_lines_orders where id='".$data['order_id']."' order by create_date desc");
		$row=$query->row;
		
		return $row;
	}
	
	public function getLine($data=array()){
		$query = $this->db->query("SELECT * from aa_lines where id='".$data['id']."'");
		$row=$query->row;
		
		return $row;
	}
	
	public function getBoardinglocation($data=array()){
		$query = $this->db->query("SELECT title from aa_boardinglocations where id='".$data['id']."'");
		$row=$query->row;

		return isset($row['title'])?$row['title']:"";
	}
	
}
?>